<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rule extends Model
{
    protected $fillable = [
        'disease_id',
        'symptom_id',
        'cf_value',
        'priority',
    ];

    protected $casts = [
        'cf_value' => 'decimal:2',
    ];

    /**
     * Relasi ke Disease
     */
    public function disease(): BelongsTo
    {
        return $this->belongsTo(Disease::class);
    }

    /**
     * Relasi ke Symptom
     */
    public function symptom(): BelongsTo
    {
        return $this->belongsTo(Symptom::class);
    }

    /**
     * Get rules by symptom codes
     */
    public static function getRulesBySymptomCodes(array $symptomCodes)
    {
        return static::whereHas('symptom', function ($query) use ($symptomCodes) {
            $query->whereIn('code', $symptomCodes);
        })->with(['disease', 'symptom'])->get();
    }

    /**
     * Forward Chaining: Get diseases that match given symptoms
     * Mengembalikan diseases yang memiliki symptoms yang diperlukan
     *
     * @param array $symptomIds Array of symptom IDs yang terdeteksi
     * @param string|null $deviceType Filter berdasarkan device type (laptop, pc, aio, printer)
     * @return array Hasil diagnosis sorted by CF combined
     */
    public static function forwardChain(array $symptomIds, ?string $deviceType = null): array
    {
        // Build query dengan filter device_type
        $query = static::with(['disease', 'symptom']);

        if ($deviceType) {
            $query->whereHas('disease', function ($q) use ($deviceType) {
                $q->where('device_type', $deviceType);
            });
        }

        // Grup rules berdasarkan disease_id
        $rulesByDisease = $query->get()->groupBy('disease_id');

        $results = [];

        foreach ($rulesByDisease as $diseaseId => $rules) {
            $requiredSymptomIds = $rules->pluck('symptom_id')->toArray();
            $totalRequired = count($requiredSymptomIds);
            $matchedSymptomIds = array_intersect($requiredSymptomIds, $symptomIds);
            $totalMatched = count($matchedSymptomIds);

            // Hitung persentase kecocokan
            $matchPercentage = ($totalMatched / $totalRequired) * 100;

            // Threshold dinamis berdasarkan jumlah gejala yang dibutuhkan:
            // - 1 gejala: harus 100% (exact match)
            // - 2 gejala: harus 50% (minimal 1 cocok)
            // - 3+ gejala: harus 20% (minimal 1 cocok, coverage factor akan adjust CF)
            $minThreshold = match (true) {
                $totalRequired <= 1 => 100,
                $totalRequired === 2 => 50,
                default => 20,
            };

            if ($matchPercentage < $minThreshold) {
                continue;
            }

            // Hitung CF Combined dari rules yang cocok
            $cfCombined = 0;
            $matchedRules = $rules->whereIn('symptom_id', $matchedSymptomIds);

            foreach ($matchedRules as $rule) {
                if ($cfCombined == 0) {
                    $cfCombined = $rule->cf_value;
                } else {
                    // CF Combine formula: CF1 + CF2 * (1 - CF1)
                    $cfCombined = $cfCombined + ($rule->cf_value * (1 - $cfCombined));
                }
            }

            // Bobot CF berdasarkan coverage: lebih banyak gejala cocok = CF lebih tinggi
            // Penalti coverage diperhalus agar persentase keyakinan tidak anjlok ke bawah 50%
            // Base modifier 0.6 + sisa proporsi, misal 1/3 (0.33) = 0.6 + 0.13 = 0.73 (penurunan wajar)
            $coverageFactor = 0.60 + (0.40 * ($totalMatched / $totalRequired));
            $adjustedCf = $cfCombined * $coverageFactor;

            $disease = $rules->first()->disease;
            $results[] = [
                'disease' => $disease,
                'matched_symptoms' => $matchedSymptomIds,
                'required_symptoms' => $requiredSymptomIds,
                'match_percentage' => round($matchPercentage, 2),
                'cf_combined' => round($adjustedCf, 4),
                'cf_raw' => round($cfCombined, 4),
                'coverage_factor' => round($coverageFactor, 2),
                'missing_symptoms' => array_diff($requiredSymptomIds, $symptomIds),
            ];
        }

        // Sort by adjusted CF combined (highest first)
        usort($results, fn($a, $b) => $b['cf_combined'] <=> $a['cf_combined']);

        return $results;
    }
}
