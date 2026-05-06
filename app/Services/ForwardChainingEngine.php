<?php

namespace App\Services;

use App\Models\Symptom;
use App\Models\Disease;
use App\Models\Rule;
use App\Models\CategoryQuestion;
use Illuminate\Support\Collection;

/**
 * Forward Chaining Engine v2 - Sistem Pakar Diagnosis Multi-Device
 *
 * Engine ini bekerja dalam mode wizard (step-by-step):
 * 1. User memilih masalah → initial symptom ditambahkan ke facts
 * 2. Engine mengajukan pertanyaan Ya/Tidak berdasarkan kategori
 * 3. Jawaban diproses: match expected_keyword → tambah gejala / negative evidence
 * 4. Forward Chaining dijalankan dengan filter device_type
 * 5. Negative evidence digunakan untuk penalti penyakit yang tidak relevan
 *
 * Metode CF Combine: CF1 + CF2 × (1 - CF1)
 */
class ForwardChainingEngine
{
    private Collection $facts;
    private Collection $allSymptoms;
    private array $askedQuestions = [];
    private ?string $currentCategory = null;
    private string $deviceType = 'laptop';

    /**
     * Negative evidence: disease IDs yang harus di-penalti
     * Diisi ketika user menjawab "Tidak" pada pertanyaan yang seharusnya
     * mengarah ke gejala tertentu (artinya gejala tersebut TIDAK ada)
     */
    private array $negativeEvidence = [];

    /**
     * Question filter: daftar nomor urut pertanyaan yang relevan
     * Jika tidak null, hanya pertanyaan dengan order di daftar ini yang ditampilkan.
     * Diisi berdasarkan sub-keluhan yang dipilih user (dari question_filters.php)
     */
    private ?array $questionFilter = null;

    public function __construct(string $deviceType = 'laptop')
    {
        $this->deviceType = $deviceType;
        $this->facts = collect();
        $this->allSymptoms = Symptom::where('device_type', $this->deviceType)->get();
    }

    /**
     * Set device type dan reload symptoms
     */
    public function setDeviceType(string $deviceType): void
    {
        $this->deviceType = $deviceType;
        $this->allSymptoms = Symptom::where('device_type', $this->deviceType)->get();
    }

    /**
     * Get current device type
     */
    public function getDeviceType(): string
    {
        return $this->deviceType;
    }

    /**
     * Reset engine state
     */
    public function reset(): void
    {
        $this->facts = collect();
        $this->askedQuestions = [];
        $this->currentCategory = null;
        $this->negativeEvidence = [];
        $this->allSymptoms = Symptom::where('device_type', $this->deviceType)->get();
    }

    /**
     * Load state dari session/Livewire
     */
    public function loadState(array $state): void
    {
        $this->facts = collect($state['facts'] ?? []);
        $this->askedQuestions = $state['asked_questions'] ?? [];
        $this->currentCategory = $state['current_category'] ?? null;
        $this->negativeEvidence = $state['negative_evidence'] ?? [];
        $this->questionFilter = $state['question_filter'] ?? null;

        if (isset($state['device_type'])) {
            $this->setDeviceType($state['device_type']);
        }
    }

    /**
     * Export state untuk session/Livewire
     */
    public function exportState(): array
    {
        return [
            'facts' => $this->facts->toArray(),
            'asked_questions' => $this->askedQuestions,
            'current_category' => $this->currentCategory,
            'negative_evidence' => $this->negativeEvidence,
            'device_type' => $this->deviceType,
            'question_filter' => $this->questionFilter,
        ];
    }

    // ================================================================
    // PERTANYAAN LANJUTAN
    // ================================================================

    /**
     * Dapatkan pertanyaan berikutnya berdasarkan kategori dan relevansi
     *
     * Prioritas:
     * 1. Pertanyaan yang relevan dengan gejala terdeteksi (keyword overlap)
     * 2. Pertanyaan sesuai urutan default (order)
     */
    public function getNextQuestion(): ?array
    {
        if (!$this->currentCategory) {
            return null;
        }

        // Kumpulkan keyword dari gejala terdeteksi untuk relevance scoring
        $detectedKeywords = [];
        $detectedNames = [];
        foreach ($this->facts as $fact) {
            $symptom = $this->allSymptoms->firstWhere('id', $fact['id']);
            if ($symptom) {
                $detectedNames[] = strtolower($symptom->name);
                foreach ($symptom->keywords ?? [] as $kw) {
                    $detectedKeywords[] = strtolower($kw);
                }
            }
        }
        $detectedKeywords = array_unique($detectedKeywords);

        // Ambil pertanyaan dari kategori saat ini yang belum ditanyakan
        $query = CategoryQuestion::where('category', $this->currentCategory)
            ->where('device_type', $this->deviceType)
            ->whereNotIn('id', $this->askedQuestions);

        // Terapkan question filter jika ada (hanya tampilkan pertanyaan yang relevan)
        $useFilter = !empty($this->questionFilter);
        if ($useFilter) {
            $query->whereIn('order', $this->questionFilter);
        }

        $questions = $query->orderBy('order')
            ->with('symptom')
            ->get();

        if ($questions->isEmpty()) {
            return null;
        }

        // Skip pertanyaan yang gejala targetnya sudah ada di facts
        $questions = $questions->filter(function ($q) {
            if (!$q->symptom) return true;
            return !$this->facts->contains('id', $q->symptom->id);
        });

        // Jika pertanyaan habis karena filter, tetapi belum mencapai batas minimal (4 pertanyaan),
        // lepas filter dan ambil pertanyaan lain di kategori yang sama
        if ($questions->isEmpty() && $useFilter && count($this->askedQuestions) < 4) {
            $fallbackQuery = CategoryQuestion::where('category', $this->currentCategory)
                ->where('device_type', $this->deviceType)
                ->whereNotIn('id', $this->askedQuestions);

            $questions = $fallbackQuery->orderBy('order')
                ->with('symptom')
                ->get()
                ->filter(function ($q) {
                    if (!$q->symptom) return true;
                    return !$this->facts->contains('id', $q->symptom->id);
                });
        }

        if ($questions->isEmpty()) {
            return null;
        }

        // Relevance scoring
        $scored = $questions->map(function ($q) use ($detectedKeywords, $detectedNames) {
            $relevance = 0;

            // Score: keyword pertanyaan cocok dengan keyword gejala terdeteksi
            $questionLower = strtolower($q->question);
            foreach ($detectedKeywords as $kw) {
                if (strlen($kw) >= 3 && str_contains($questionLower, $kw)) {
                    $relevance += 15;
                }
            }

            // Score: keyword gejala target overlap dengan keyword gejala terdeteksi
            if ($q->symptom) {
                $symKeywords = array_map('strtolower', $q->symptom->keywords ?? []);
                $overlap = count(array_intersect($symKeywords, $detectedKeywords));
                $relevance += $overlap * 10;

                // Score: nama gejala target mengandung kata dari gejala terdeteksi
                $symName = strtolower($q->symptom->name);
                foreach ($detectedNames as $name) {
                    $parts = array_filter(explode(' ', $name), fn($p) => strlen($p) > 3);
                    foreach ($parts as $part) {
                        if (str_contains($symName, $part)) {
                            $relevance += 8;
                        }
                    }
                }
            }

            return [
                'question' => $q,
                'relevance' => $relevance,
                'order' => $q->order,
            ];
        });

        // Sort: relevance DESC, lalu order ASC sebagai tiebreaker
        $sorted = $scored->sort(function ($a, $b) {
            if ($b['relevance'] !== $a['relevance']) {
                return $b['relevance'] - $a['relevance'];
            }
            return $a['order'] - $b['order'];
        });

        $best = $sorted->first();
        $question = $best['question'];

        return [
            'id' => $question->id,
            'question' => $question->question,
            'expected_keywords' => explode(',', $question->expected_keyword ?? ''),
            'leads_to_symptom' => $question->symptom ? [
                'code' => $question->symptom->code,
                'name' => $question->symptom->name,
            ] : null,
            'question_type' => $question->question_type ?? 'yesno',
            'options' => (function ($opts) {
                if (is_array($opts)) return $opts;
                if (is_string($opts) && !empty($opts)) return json_decode($opts, true) ?? null;
                return null;
            })($question->options),
        ];
    }

    // ================================================================
    // PROSES JAWABAN
    // ================================================================

    /**
     * Proses jawaban user untuk pertanyaan lanjutan
     *
     * Logika utama:
     * - Cocokkan jawaban dengan expected_keyword (BUKAN positive words generik)
     * - Jika COCOK → tambah gejala ke facts (positive evidence)
     * - Jika TIDAK COCOK → tambah penyakit terkait ke negative evidence (penalti)
     * - "Tidak Tahu" → skip, tidak ada evidence positif maupun negatif
     *
     * PENTING: Tidak ada "positive words override" seperti engine lama.
     * Alasan: Pertanyaan seperti "LED charger menyala?" punya expected_keyword
     * "tidak,ga nyala,mati". Jika user jawab "Ya" (LED nyala = port OK),
     * engine lama salah menambahkan gejala port rusak karena "ya" ada di
     * positive words. Fix: hanya gunakan expected_keyword.
     */
    public function processAnswer(int $questionId, string $answer): array
    {
        $question = CategoryQuestion::with('symptom')->find($questionId);

        if (!$question) {
            return ['status' => 'error', 'message' => 'Pertanyaan tidak ditemukan'];
        }

        // Tandai pertanyaan sudah dijawab
        $this->askedQuestions[] = $questionId;

        $answerLower = strtolower(trim($answer));

        // Skip "tidak tahu" — tidak ada evidence ke arah manapun
        if (in_array($answerLower, ['tidak tahu', 'skip', 'lewat'])) {
            return [
                'status' => 'skipped',
                'total_facts' => $this->facts->count(),
            ];
        }

        // Cocokkan jawaban dengan expected keywords
        $expectedKeywords = array_map(
            fn($k) => strtolower(trim($k)),
            explode(',', $question->expected_keyword ?? '')
        );

        $isMatch = false;
        foreach ($expectedKeywords as $keyword) {
            if (!empty($keyword) && str_contains($answerLower, $keyword)) {
                $isMatch = true;
                break;
            }
        }

        if ($isMatch && $question->symptom) {
            // ✅ POSITIVE EVIDENCE: Jawaban cocok → gejala ADA → tambah ke facts
            $symptom = $question->symptom;
            if (!$this->facts->contains('id', $symptom->id)) {
                $this->facts->push([
                    'id' => $symptom->id,
                    'code' => $symptom->code,
                    'name' => $symptom->name,
                    'category' => $symptom->category,
                    'weight' => $symptom->weight,
                ]);
            }

            return [
                'status' => 'processed',
                'is_positive' => true,
                'symptom_added' => $symptom->name,
                'total_facts' => $this->facts->count(),
            ];
        }

        if (!$isMatch && $question->symptom) {
            // ❌ NEGATIVE EVIDENCE: Jawaban tidak cocok → gejala TIDAK ADA
            // Cari semua penyakit yang membutuhkan gejala ini → penalti
            $relatedDiseaseIds = Rule::where('symptom_id', $question->symptom->id)
                ->pluck('disease_id')
                ->toArray();

            foreach ($relatedDiseaseIds as $diseaseId) {
                $this->negativeEvidence[] = $diseaseId;
            }

            return [
                'status' => 'processed',
                'is_positive' => false,
                'symptom_denied' => $question->symptom->name,
                'diseases_penalized' => count($relatedDiseaseIds),
                'total_facts' => $this->facts->count(),
            ];
        }

        return [
            'status' => 'processed',
            'is_positive' => false,
            'total_facts' => $this->facts->count(),
        ];
    }

    // ================================================================
    // KESIAPAN DIAGNOSIS
    // ================================================================

    /**
     * Cek apakah sudah cukup data untuk diagnosis
     *
     * Kondisi ready:
     * - Sudah menjawab minimal 2 pertanyaan
     * - DAN (punya minimal 2 gejala ATAU tidak ada pertanyaan lagi)
     */
    public function isReadyForDiagnosis(): bool
    {
        $answeredCount = count($this->askedQuestions);
        $noMoreQuestions = $this->getNextQuestion() === null;

        // Jika tidak ada lagi pertanyaan yang relevan, ya sudah kita diagnosis
        if ($noMoreQuestions) {
            return true;
        }

        // Jangan gegabah sebelum menanyakan minimal 2 soal
        if ($answeredCount < 2) {
            return false;
        }

        // Lakukan "intipan" (peek) hasil inferensi sementara (tanpa mengubah state)
        if ($this->facts->count() >= 1) {
            $peekResult = $this->runInference();
            
            // ADAPTIVE THRESHOLDING: 
            // Jika CF tertinggi sudah sangat meyakinkan (misal >= 85%), 
            // kita bisa berhenti lebih cepat secara otomatis!
            if (isset($peekResult['diagnoses']) && count($peekResult['diagnoses']) > 0) {
                $topDiagnosis = $peekResult['diagnoses'][0];
                if ($topDiagnosis['confidence'] >= 85) {
                    return true; // Berhenti awal (Early Stopping) karena sistem sudah cukup yakin
                }
            }
        }

        // Jika CF masih rendah (kurang dari 85%), sistem akan MEMAKSA bertanya terus 
        // sampai batas masksimal dari frontend / Livewire (yaitu 5 soal).
        return false;
    }

    // ================================================================
    // INFERENSI FORWARD CHAINING
    // ================================================================

    /**
     * Jalankan Forward Chaining dan hasilkan diagnosis
     *
     * Proses:
     * 1. Ambil semua symptom IDs dari facts
     * 2. Jalankan Rule::forwardChain() dengan filter device_type
     * 3. Terapkan penalti negative evidence
     * 4. Format dan return hasil diagnosis (top 3)
     */
    public function runInference(): array
    {
        if ($this->facts->isEmpty()) {
            return [
                'status' => 'insufficient_data',
                'message' => 'Tidak ada gejala yang terdeteksi.',
                'diagnoses' => [],
            ];
        }

        $symptomIds = $this->facts->pluck('id')->toArray();

        // Jalankan Forward Chaining dengan filter device_type
        $results = Rule::forwardChain($symptomIds, $this->deviceType);
        $rawResults = $results;

        if (empty($results)) {
            return $this->getFallbackDiagnosis();
        }

        // Terapkan penalti negative evidence
        $results = $this->applyNegativeEvidence($results);

        // Re-sort setelah penalti
        usort($results, fn($a, $b) => $b['cf_combined'] <=> $a['cf_combined']);

        // Filter hasil dengan CF terlalu rendah setelah penalti
        $results = array_values(array_filter($results, fn($r) => $r['cf_combined'] >= 0.1));

        if (empty($results)) {
            return $this->getFallbackDiagnosis($rawResults);
        }

        // Format hasil diagnosis
        $diagnoses = [];
        foreach ($results as $result) {
            $disease = $result['disease'];

            $matchedSymptomNames = $this->facts
                ->whereIn('id', $result['matched_symptoms'])
                ->pluck('name')
                ->toArray();

            $diagnoses[] = [
                'code' => $disease->code,
                'name' => $disease->name,
                'description' => $disease->description,
                'category' => $disease->category,
                'solution' => $disease->solution,
                'actions' => $disease->actions ?? [],
                'level' => $disease->level,
                'level_color' => $disease->level_color ?? null,
                'cost_range' => $disease->cost_range,
                'min_cost' => $disease->min_cost ?? null,
                'max_cost' => $disease->max_cost ?? null,
                'confidence' => round($result['cf_combined'] * 100),
                'match_percentage' => $result['match_percentage'],
                'matched_symptoms' => $matchedSymptomNames,
                'penalized' => $result['penalized'] ?? false,
            ];
        }

        return [
            'status' => 'success',
            'detected_symptoms' => $this->facts->pluck('name')->toArray(),
            'symptom_codes' => $this->facts->pluck('code')->toArray(),
            'category' => $this->currentCategory,
            'diagnoses' => array_slice($diagnoses, 0, 3),
            'total_rules_matched' => count($results),
        ];
    }

    /**
     * Terapkan penalti negative evidence pada hasil diagnosis
     *
     * Setiap penyakit yang ada di negative evidence mendapat penalti:
     * - 1 gejala yang ditolak: CF × 0.3 (penalti 70%)
     * - 2+ gejala yang ditolak: CF × 0.3^n (makin banyak ditolak, makin kecil)
     */
    private function applyNegativeEvidence(array $results): array
    {
        if (empty($this->negativeEvidence)) {
            return $results;
        }

        // Hitung berapa kali setiap disease muncul di negative evidence
        $penaltyCounts = array_count_values($this->negativeEvidence);

        foreach ($results as $key => $result) {
            $diseaseId = $result['disease']->id;

            if (isset($penaltyCounts[$diseaseId])) {
                $count = $penaltyCounts[$diseaseId];
                // Penalti eksponensial: setiap gejala yang ditolak mengurangi CF 70%
                $penalty = pow(0.3, $count);
                $results[$key]['cf_combined'] *= $penalty;
                $results[$key]['penalized'] = true;
            }
        }

        return $results;
    }

    /**
     * Fallback diagnosis jika tidak ada rule yang cocok
     */
    private function getFallbackDiagnosis(array $candidateResults = []): array
    {
        if (!empty($candidateResults)) {
            usort($candidateResults, fn($a, $b) => $b['cf_combined'] <=> $a['cf_combined']);

            $diagnoses = [];
            foreach (array_slice($candidateResults, 0, 3) as $result) {
                $disease = $result['disease'] ?? null;
                if (!$disease) {
                    continue;
                }

                $matchedSymptomNames = $this->facts
                    ->whereIn('id', $result['matched_symptoms'] ?? [])
                    ->pluck('name')
                    ->toArray();

                $diagnoses[] = [
                    'code' => $disease->code,
                    'name' => $disease->name,
                    'description' => $disease->description,
                    'category' => $disease->category,
                    'solution' => $disease->solution,
                    'actions' => $disease->actions ?? [],
                    'level' => $disease->level,
                    'level_color' => $disease->level_color ?? null,
                    'cost_range' => $disease->cost_range,
                    'min_cost' => $disease->min_cost ?? null,
                    'max_cost' => $disease->max_cost ?? null,
                    'confidence' => max(15, min(49, round(($result['cf_combined'] ?? 0) * 100))),
                    'match_percentage' => $result['match_percentage'] ?? 0,
                    'matched_symptoms' => $matchedSymptomNames,
                    'penalized' => true,
                    'low_confidence_fallback' => true,
                ];
            }

            if (!empty($diagnoses)) {
                return [
                    'status' => 'partial',
                    'message' => 'Diagnosis spesifik belum cukup kuat. Sistem menampilkan kandidat terdekat berdasarkan gejala yang cocok.',
                    'detected_symptoms' => $this->facts->pluck('name')->toArray(),
                    'symptom_codes' => $this->facts->pluck('code')->toArray(),
                    'category' => $this->currentCategory,
                    'diagnoses' => $diagnoses,
                    'total_rules_matched' => count($candidateResults),
                ];
            }
        }

        $categories = $this->facts->pluck('category')->unique();

        $diseases = Disease::where('device_type', $this->deviceType)
            ->whereIn('category', $categories)->get();

        if ($diseases->isEmpty()) {
            return [
                'status' => 'no_match',
                'message' => 'Tidak dapat menentukan diagnosis spesifik. Diperlukan pemeriksaan lebih lanjut oleh teknisi.',
                'detected_symptoms' => $this->facts->pluck('name')->toArray(),
                'diagnoses' => [],
            ];
        }

        $diagnoses = $diseases->take(2)->map(fn($d) => [
            'code' => $d->code,
            'name' => $d->name,
            'description' => $d->description,
            'category' => $d->category,
            'solution' => $d->solution,
            'actions' => $d->actions ?? [],
            'level' => $d->level,
            'cost_range' => $d->cost_range,
            'confidence' => 50,
            'matched_symptoms' => $this->facts->pluck('name')->toArray(),
        ])->toArray();

        return [
            'status' => 'partial',
            'message' => 'Diagnosis berdasarkan kategori masalah. Disarankan pemeriksaan lebih lanjut.',
            'detected_symptoms' => $this->facts->pluck('name')->toArray(),
            'category' => $this->currentCategory,
            'diagnoses' => $diagnoses,
        ];
    }

    // ================================================================
    // UTILITY METHODS
    // ================================================================

    /**
     * Get current facts
     */
    public function getFacts(): Collection
    {
        return $this->facts;
    }

    /**
     * Get symptom names dari facts
     */
    public function getSymptomNames(): array
    {
        return $this->facts->pluck('name')->toArray();
    }

    /**
     * Get current category
     */
    public function getCurrentCategory(): ?string
    {
        return $this->currentCategory;
    }

    /**
     * Set category
     */
    public function setCategory(string $category): void
    {
        $this->currentCategory = $category;
    }

    /**
     * Add symptom by code
     */
    public function addSymptomByCode(string $code): bool
    {
        $symptom = $this->allSymptoms->firstWhere('code', $code);

        if (!$symptom || $this->facts->contains('id', $symptom->id)) {
            return false;
        }

        $this->facts->push([
            'id' => $symptom->id,
            'code' => $symptom->code,
            'name' => $symptom->name,
            'category' => $symptom->category,
            'weight' => $symptom->weight,
        ]);

        if (!$this->currentCategory) {
            $this->currentCategory = $symptom->category;
        }

        return true;
    }

    // ================================================================
    // STATIC METHODS
    // ================================================================

    /**
     * Get available categories untuk device type
     */
    public static function getCategories(string $deviceType = 'laptop'): array
    {
        return Symptom::where('device_type', $deviceType)
            ->distinct()->pluck('category')->filter()->toArray();
    }

    /**
     * Get symptoms by category
     */
    public static function getSymptomsByCategory(string $category, string $deviceType = 'laptop'): Collection
    {
        return Symptom::where('device_type', $deviceType)
            ->where('category', $category)->get();
    }

    /**
     * Get available device types
     */
    public static function getDeviceTypes(): array
    {
        return [
            'laptop' => 'Laptop',
            'pc' => 'PC Desktop',
            'aio' => 'All-in-One (AIO)',
            'printer' => 'Printer',
        ];
    }
}
