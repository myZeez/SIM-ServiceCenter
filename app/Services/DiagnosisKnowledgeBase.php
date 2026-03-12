<?php

namespace App\Services;

use App\Models\Disease;
use App\Models\Rule;
use App\Models\Symptom;

/**
 * Knowledge Base untuk Sistem Pakar Diagnosis
 * Mendukung multi-device: Laptop, PC Desktop & AIO, Printer
 *
 * Data dimuat dari database sehingga otomatis mendukung
 * semua device type yang tersedia.
 */
class DiagnosisKnowledgeBase
{
    /**
     * Device types yang didukung
     */
    public const DEVICE_TYPES = [
        'laptop' => 'Laptop',
        'pc' => 'PC Desktop',
        'aio' => 'All-in-One (AIO)',
        'printer' => 'Printer',
    ];

    /**
     * Kategori masalah per device type
     */
    public const CATEGORIES = [
        'laptop' => [
            'display' => 'Display / Layar',
            'keyboard' => 'Keyboard',
            'network' => 'Network / Jaringan',
            'peripheral' => 'Peripheral / Port',
            'power' => 'Power / Daya',
            'software' => 'Software',
            'performance' => 'Performa',
            'audio' => 'Audio / Suara',
            'thermal' => 'Thermal / Suhu',
            'storage' => 'Storage / Penyimpanan',
            'physical' => 'Physical / Body',
            'water' => 'Water Damage / Kerusakan Air',
            'hardware' => 'Hardware / Motherboard',
        ],
        'pc' => [
            'psu' => 'PSU / Power Supply',
            'motherboard' => 'Motherboard',
            'cpu' => 'CPU / Prosesor',
            'ram' => 'RAM DIMM (DDR4/DDR5)',
            'gpu' => 'GPU Diskrit (PCIe)',
            'storage' => 'Storage (HDD/SSD/NVMe)',
            'casing' => 'Casing / Chassis',
            'thermal' => 'Thermal / Pendinginan',
            'audio' => 'Audio / Suara',
            'network' => 'Jaringan / Konektivitas',
            'peripheral' => 'Peripheral / Port',
            'software' => 'Software / OS',
            'overclocking' => 'Overclocking',
        ],
        'aio' => [
            'adaptor' => 'Adaptor / Daya',
            'display' => 'Display / Layar',
            'touchscreen' => 'Touchscreen',
            'motherboard' => 'Motherboard',
            'cpu' => 'CPU / Prosesor',
            'ram' => 'RAM SO-DIMM',
            'storage' => 'Storage (2.5" / M.2)',
            'thermal' => 'Thermal / Pendinginan',
            'audio' => 'Audio / Speaker',
            'konektivitas' => 'WiFi / LAN / Bluetooth',
            'webcam' => 'Kamera / Webcam',
            'peripheral' => 'Peripheral / Port',
            'software' => 'Software / OS',
        ],
        'printer' => [
            'kualitas' => 'Kualitas Cetak',
            'tinta' => 'Tinta / Toner',
            'kertas' => 'Kertas / Paper Jam',
            'koneksi' => 'Koneksi / Jaringan',
            'hardware_printer' => 'Hardware Printer',
            'driver' => 'Driver / Software',
            'mekanik' => 'Mekanik / Fisik',
            'scanner' => 'Scanner / Pemindai',
            'listrik' => 'Listrik / Power',
            'print_head' => 'Print Head',
            'fuser' => 'Fuser / Pemanas',
        ],
    ];

    /**
     * Get categories for a specific device type
     */
    public static function getCategoriesForDevice(string $deviceType = 'laptop'): array
    {
        return self::CATEGORIES[$deviceType] ?? self::CATEGORIES['laptop'];
    }

    /**
     * Daftar semua gejala dari database
     *
     * @param string $deviceType Device type filter
     * @return array Associative array [code => [...symptom data]]
     */
    public static function getSymptoms(string $deviceType = 'laptop'): array
    {
        $symptoms = Symptom::where('device_type', $deviceType)->get();
        $result = [];

        foreach ($symptoms as $symptom) {
            $result[$symptom->code] = [
                'category' => $symptom->category,
                'question' => $symptom->name,
                'weight' => (float) $symptom->weight,
            ];
        }

        return $result;
    }

    /**
     * Rule base dari database
     *
     * @param string $deviceType Device type filter
     * @return array Associative array [disease_code => [...rule data]]
     */
    public static function getRules(string $deviceType = 'laptop'): array
    {
        $diseases = Disease::where('device_type', $deviceType)->get();
        $result = [];

        foreach ($diseases as $disease) {
            $rules = Rule::where('disease_id', $disease->id)->with('symptom')->get();

            if ($rules->isEmpty()) continue;

            $symptomCodes = $rules->pluck('symptom.code')->filter()->toArray();

            // Determine min_match: at least 1, or 50% of total symptoms (rounded up)
            $minMatch = max(1, (int) ceil(count($symptomCodes) * 0.5));

            // Map severity/level to display severity
            $severity = match (strtolower($disease->level ?? '')) {
                'berat', 'critical', 'high' => 'high',
                'sedang', 'moderate', 'medium' => 'medium',
                'ringan', 'low' => 'low',
                default => 'medium',
            };

            // Parse actions
            $actions = [];
            if ($disease->actions) {
                $actions = is_array($disease->actions)
                    ? $disease->actions
                    : array_map('trim', explode("\n", $disease->actions));
            }

            $result[$disease->code] = [
                'name' => $disease->name,
                'symptoms' => $symptomCodes,
                'min_match' => $minMatch,
                'actions' => $actions,
                'severity' => $severity,
                'description' => $disease->description ?? '',
            ];
        }

        return $result;
    }

    /**
     * Proses diagnosis dengan Forward Chaining
     *
     * @param array $selectedSymptoms Kode gejala yang dipilih user
     * @param string $deviceType Device type
     * @return array Hasil diagnosis
     */
    public static function diagnose(array $selectedSymptoms, string $deviceType = 'laptop'): array
    {
        $rules = self::getRules($deviceType);
        $symptoms = self::getSymptoms($deviceType);
        $results = [];

        foreach ($rules as $ruleId => $rule) {
            $matchedSymptoms = array_intersect($rule['symptoms'], $selectedSymptoms);
            $matchCount = count($matchedSymptoms);
            $totalRuleSymptoms = count($rule['symptoms']);

            if ($matchCount >= $rule['min_match']) {
                // Hitung confidence factor
                $confidence = ($matchCount / $totalRuleSymptoms) * 100;

                // Tambahkan weight dari symptoms
                $totalWeight = 0;
                foreach ($matchedSymptoms as $symptomCode) {
                    $totalWeight += $symptoms[$symptomCode]['weight'] ?? 1;
                }
                $avgWeight = $totalWeight / max($matchCount, 1);

                // Adjust confidence dengan weight
                $adjustedConfidence = min($confidence * $avgWeight, 100);

                $results[] = [
                    'rule_id' => $ruleId,
                    'name' => $rule['name'],
                    'confidence' => round($adjustedConfidence, 1),
                    'matched_symptoms' => $matchedSymptoms,
                    'matched_count' => $matchCount,
                    'total_symptoms' => $totalRuleSymptoms,
                    'actions' => $rule['actions'],
                    'severity' => $rule['severity'],
                ];
            }
        }

        // Sort by confidence (descending)
        usort($results, function ($a, $b) {
            return $b['confidence'] <=> $a['confidence'];
        });

        return $results;
    }

    /**
     * Get symptom details by codes
     *
     * @param array $codes Symptom codes
     * @param string $deviceType Device type
     * @return array
     */
    public static function getSymptomDetails(array $codes, string $deviceType = 'laptop'): array
    {
        $symptoms = self::getSymptoms($deviceType);
        $details = [];

        foreach ($codes as $code) {
            if (isset($symptoms[$code])) {
                $details[$code] = $symptoms[$code];
            }
        }

        return $details;
    }

    /**
     * Get symptoms by category
     *
     * @param string|null $category Category filter
     * @param string $deviceType Device type
     * @return array
     */
    public static function getSymptomsByCategory(?string $category = null, string $deviceType = 'laptop'): array
    {
        $symptoms = self::getSymptoms($deviceType);

        if ($category === null) {
            return $symptoms;
        }

        return array_filter($symptoms, function ($symptom) use ($category) {
            return $symptom['category'] === $category;
        });
    }
}
