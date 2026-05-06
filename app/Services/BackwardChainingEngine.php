<?php

namespace App\Services;

use App\Models\Disease;
use App\Models\Rule;
use App\Models\Symptom;

/**
 * Backward Chaining Engine - Verifikasi Hipotesis Diagnosis
 *
 * Engine ini bekerja sebagai verifikasi kedua setelah Forward Chaining:
 *
 * ALUR KERJA:
 * 1. Menerima hipotesis (candidate diseases) dari Forward Chaining
 * 2. Untuk setiap hipotesis, telusuri mundur: "Gejala apa yang BELUM dikonfirmasi?"
 * 3. Generate pertanyaan verifikasi untuk gejala yang missing
 * 4. Jawaban user digunakan untuk:
 *    - KONFIRMASI → naikkan confidence (gejala terbukti ada)
 *    - TOLAK → turunkan confidence (gejala terbukti tidak ada)
 * 5. Hasilkan diagnosis final dengan confidence yang lebih akurat
 *
 * METODE:
 * - Goal-driven reasoning: mulai dari kesimpulan, telusuri ke fakta
 * - CF adjustment berdasarkan verifikasi
 * - Eliminasi false positive dari Forward Chaining
 */
class BackwardChainingEngine
{
    private string $deviceType;
    private array $hypotheses = [];           // Candidate diseases from FC
    private array $confirmedSymptomIds = [];   // Symptoms already confirmed (from FC)
    private array $verifiedSymptomIds = [];    // Symptoms verified through BC questions
    private array $deniedSymptomIds = [];      // Symptoms denied through BC questions
    private array $askedSymptomIds = [];       // Symptoms already asked about
    private array $verificationLog = [];       // Log of verification steps
    private int $maxVerificationQuestions = 3; // Max BC verification questions

    private int $maxVerificationQuestions = 3; // Max BC verification questions
    {
        $this->deviceType = $deviceType;
    }

    /**
     * Load state dari session/Livewire
     */
    public function loadState(array $state): void
    {
        $this->deviceType = $state['device_type'] ?? 'laptop';
        $this->hypotheses = $state['hypotheses'] ?? [];
        $this->confirmedSymptomIds = $state['confirmed_symptom_ids'] ?? [];
        $this->verifiedSymptomIds = $state['verified_symptom_ids'] ?? [];
        $this->deniedSymptomIds = $state['denied_symptom_ids'] ?? [];
        $this->askedSymptomIds = $state['asked_symptom_ids'] ?? [];
        $this->verificationLog = $state['verification_log'] ?? [];
    }

    /**
     * Export state untuk session/Livewire
     */
    public function exportState(): array
    {
        return [
            'device_type' => $this->deviceType,
            'hypotheses' => $this->hypotheses,
            'confirmed_symptom_ids' => $this->confirmedSymptomIds,
            'verified_symptom_ids' => $this->verifiedSymptomIds,
            'denied_symptom_ids' => $this->deniedSymptomIds,
            'asked_symptom_ids' => $this->askedSymptomIds,
            'verification_log' => $this->verificationLog,
        ];
    }

    /**
     * Inisialisasi dari hasil Forward Chaining
     *
     * @param array $fcResults Hasil dari ForwardChainingEngine::runInference()
     * @param array $confirmedSymptomIds Symptom IDs yang sudah dikonfirmasi di FC
     */
    public function initFromForwardChaining(array $fcResults, array $confirmedSymptomIds): void
    {
        $this->confirmedSymptomIds = $confirmedSymptomIds;

        // Ambil top hypotheses dari FC (maks 3 teratas)
        $diagnoses = $fcResults['diagnoses'] ?? [];

        $this->hypotheses = [];
        foreach (array_slice($diagnoses, 0, 3) as $index => $diagnosis) {
            $disease = Disease::where('code', $diagnosis['code'])
                ->where('device_type', $this->deviceType)
                ->first();

            if (!$disease) continue;

            // Ambil semua required symptoms untuk disease ini
            $rules = Rule::where('disease_id', $disease->id)
                ->with('symptom')
                ->get();

            $requiredSymptomIds = $rules->pluck('symptom_id')->toArray();
            $matchedIds = array_intersect($requiredSymptomIds, $confirmedSymptomIds);
            $missingIds = array_diff($requiredSymptomIds, $confirmedSymptomIds);

            $this->hypotheses[] = [
                'disease_id' => $disease->id,
                'disease_code' => $disease->code,
                'disease_name' => $disease->name,
                'original_confidence' => $diagnosis['confidence'],
                'required_symptom_ids' => $requiredSymptomIds,
                'matched_symptom_ids' => array_values($matchedIds),
                'missing_symptom_ids' => array_values($missingIds),
                'cf_rules' => $rules->mapWithKeys(fn($r) => [$r->symptom_id => (float) $r->cf_value])->toArray(),
                'priority' => $index,
            ];
        }
    }

    /**
     * Cek apakah BC harus di-skip (FC sudah cukup yakin)
     *
     * Skip jika:
     * - Top hypothesis confidence >= skipThreshold (75%)
     * - Atau tidak ada missing symptoms sama sekali
     */
    public function shouldSkipVerification(): bool
    {
        if (empty($this->hypotheses)) return true;

        // VERIFIKASI WAJIB: Kita HAPUS pengecekan skipThreshold di sini.
        // Berapa pun nilai CF-nya (walau 99%), sistem TETAP harus melakukan
        // verifikasi gejala yang belum terpenuhi untuk memastikan hipotesis.

        // Cek apakah masih ada missing symptoms yang bisa ditanyakan.
        // Jika semua gejala yang dibutuhkan oleh hipotesis sudah terpenuhi / ditanyakan,
        // baru kita boleh melakukan skip.
        $hasMissing = false;
        foreach ($this->hypotheses as $hyp) {
            $askable = array_diff(
                $hyp['missing_symptom_ids'],
                $this->confirmedSymptomIds,
                $this->askedSymptomIds
            );
            if (!empty($askable)) {
                $hasMissing = true;
                break;
            }
        }

        if (!$hasMissing) {
            return true; // Hanya skip jika BENAR-BENAR tidak ada gejala yang tersisa untuk divrifikasi
        }

        return false;
    }

    /**
     * GET ALL verification questions at once (one-shot checklist mode)
     *
     * Mengumpulkan semua pertanyaan verifikasi sekaligus (max 3)
     * agar bisa ditampilkan dalam satu layar checklist.
     *
     * @return array List pertanyaan verifikasi
     */
    public function getAllVerificationQuestions(): array
    {
        $questions = [];
        $tempAsked = $this->askedSymptomIds; // Temporary tracker

        for ($i = 0; $i < $this->maxVerificationQuestions; $i++) {
            $candidate = $this->findBestCandidate($tempAsked);
            if (!$candidate) break;

            $symptom = Symptom::find($candidate['symptom_id']);
            if (!$symptom) continue;

            $question = $this->generateVerificationQuestion($symptom, $candidate);
            $questions[] = $question;
            $tempAsked[] = $candidate['symptom_id'];
        }

        return $questions;
    }

    /**
     * Process ALL verification answers at once (batch mode)
     *
     * @param array $answers Array of ['symptom_id' => int, 'answer' => 'ya'|'tidak'|'tidak_tahu']
     * @return array Processing summary
     */
    public function processAllVerificationAnswers(array $answers): array
    {
        $results = [];
        foreach ($answers as $item) {
            $result = $this->processVerificationAnswer(
                $item['symptom_id'],
                $item['answer']
            );
            $results[] = $result;
        }
        return $results;
    }

    /**
     * Find best candidate symptom to ask about (internal helper)
     *
     * @param array $excludeIds Symptom IDs to exclude (already asked/planned)
     */
    private function findBestCandidate(array $excludeIds = []): ?array
    {
        $candidateSymptoms = [];

        foreach ($this->hypotheses as $hyp) {
            foreach ($hyp['missing_symptom_ids'] as $symptomId) {
                if (in_array($symptomId, $excludeIds)) continue;
                if (in_array($symptomId, $this->verifiedSymptomIds)) continue;
                if (in_array($symptomId, $this->deniedSymptomIds)) continue;

                if (!isset($candidateSymptoms[$symptomId])) {
                    $candidateSymptoms[$symptomId] = [
                        'symptom_id' => $symptomId,
                        'discrimination_score' => 0,
                        'hypothesis_count' => 0,
                        'max_cf' => 0,
                        'related_hypotheses' => [],
                    ];
                }

                $candidateSymptoms[$symptomId]['hypothesis_count']++;
                $candidateSymptoms[$symptomId]['related_hypotheses'][] = $hyp['disease_code'];

                $cfValue = $hyp['cf_rules'][$symptomId] ?? 0.5;
                $candidateSymptoms[$symptomId]['max_cf'] = max(
                    $candidateSymptoms[$symptomId]['max_cf'],
                    $cfValue
                );
                $candidateSymptoms[$symptomId]['discrimination_score'] += $cfValue;
            }
        }

        if (empty($candidateSymptoms)) return null;

        usort($candidateSymptoms, function ($a, $b) {
            $scoreDiff = $b['discrimination_score'] <=> $a['discrimination_score'];
            if ($scoreDiff !== 0) return $scoreDiff;
            return $b['hypothesis_count'] <=> $a['hypothesis_count'];
        });

        return reset($candidateSymptoms);
    }

    /**
     * Get pertanyaan verifikasi berikutnya (Backward Chaining)
     *
     * Delegates to findBestCandidate() for scoring logic.
     *
     * @return array|null Pertanyaan verifikasi, atau null jika tidak ada lagi
     */
    public function getNextVerificationQuestion(): ?array
    {
        if (count($this->askedSymptomIds) >= $this->maxVerificationQuestions) {
            return null;
        }

        $candidate = $this->findBestCandidate($this->askedSymptomIds);
        if (!$candidate) return null;

        $symptom = Symptom::find($candidate['symptom_id']);
        if (!$symptom) return null;

        return $this->generateVerificationQuestion($symptom, $candidate);
    }

    /**
     * Generate pertanyaan verifikasi untuk symptom tertentu
     */
    private function generateVerificationQuestion(Symptom $symptom, array $candidateInfo): array
    {
        // Gunakan follow_up_question dari symptom jika ada,
        // kalau tidak, generate dari nama gejala
        $questionText = $symptom->follow_up_question;

        if (empty($questionText)) {
            $questionText = "Apakah perangkat Anda mengalami: {$symptom->name}?";
        }

        // Tentukan hipotesis mana yang akan terdampak
        $relatedHypotheses = [];
        foreach ($this->hypotheses as $hyp) {
            if (in_array($symptom->id, $hyp['missing_symptom_ids'])) {
                $relatedHypotheses[] = $hyp['disease_name'];
            }
        }

        return [
            'type' => 'verification',
            'symptom_id' => $symptom->id,
            'symptom_code' => $symptom->code,
            'symptom_name' => $symptom->name,
            'question' => $questionText,
            'question_type' => 'yesno',
            'purpose' => 'Verifikasi gejala untuk memastikan diagnosis',
            'related_hypotheses' => $relatedHypotheses,
            'verification_number' => count($this->askedSymptomIds) + 1,
            'max_verifications' => $this->maxVerificationQuestions,
        ];
    }

    /**
     * Proses jawaban verifikasi dari user
     *
     * @param int $symptomId ID gejala yang diverifikasi
     * @param string $answer 'ya', 'tidak', atau 'tidak_tahu'
     * @return array Status proses
     */
    public function processVerificationAnswer(int $symptomId, string $answer): array
    {
        $this->askedSymptomIds[] = $symptomId;

        $symptom = Symptom::find($symptomId);
        $answerLower = strtolower(trim($answer));

        $logEntry = [
            'symptom_id' => $symptomId,
            'symptom_name' => $symptom ? $symptom->name : 'Unknown',
            'answer' => $answerLower,
            'result' => '',
            'affected_hypotheses' => [],
        ];

        if (in_array($answerLower, ['ya', 'yes', 'iya'])) {
            // KONFIRMASI: gejala terbukti ada → tambah ke verified
            $this->verifiedSymptomIds[] = $symptomId;
            $logEntry['result'] = 'confirmed';

            // Update hipotesis: pindahkan dari missing ke matched
            foreach ($this->hypotheses as &$hyp) {
                if (in_array($symptomId, $hyp['missing_symptom_ids'])) {
                    $hyp['missing_symptom_ids'] = array_values(
                        array_diff($hyp['missing_symptom_ids'], [$symptomId])
                    );
                    $hyp['matched_symptom_ids'][] = $symptomId;
                    $logEntry['affected_hypotheses'][] = [
                        'disease' => $hyp['disease_name'],
                        'effect' => 'confidence_up',
                    ];
                }
            }
            unset($hyp);

        } elseif (in_array($answerLower, ['tidak', 'no', 'nggak', 'ga'])) {
            // TOLAK: gejala terbukti TIDAK ada → penalti
            $this->deniedSymptomIds[] = $symptomId;
            $logEntry['result'] = 'denied';

            // Update hipotesis: tandai gejala ini sebagai denied
            foreach ($this->hypotheses as &$hyp) {
                if (in_array($symptomId, $hyp['missing_symptom_ids'])) {
                    $logEntry['affected_hypotheses'][] = [
                        'disease' => $hyp['disease_name'],
                        'effect' => 'confidence_down',
                    ];
                }
            }
            unset($hyp);

        } else {
            // TIDAK TAHU: skip, tidak ada perubahan evidence
            $logEntry['result'] = 'skipped';
        }

        $this->verificationLog[] = $logEntry;

        return [
            'status' => 'processed',
            'result' => $logEntry['result'],
            'symptom_name' => $symptom ? $symptom->name : 'Unknown',
            'remaining_questions' => $this->maxVerificationQuestions - count($this->askedSymptomIds),
        ];
    }

    /**
     * Cek apakah masih ada pertanyaan verifikasi
     */
    public function hasMoreQuestions(): bool
    {
        return $this->getNextVerificationQuestion() !== null;
    }

    /**
     * Jalankan kalkulasi final setelah Backward Chaining selesai
     *
     * BC berfungsi sebagai ADJUSTMENT terhadap hasil FC, bukan kalkulasi ulang.
     *
     * Formula:
     * - Start dari original_confidence (hasil FC)
     * - Confirmed symptoms: CF += boost (kecil, karena FC sudah menghitung)
     *   boost = CF_rule × 0.15 × (1 - CF_current)
     * - Denied symptoms: CF *= (1 - CF_rule × 0.2) → penalty ringan
     * - Missing (unasked): tidak berubah
     *
     * Prinsip: BC hanya memverifikasi, bukan mengubah drastis.
     *
     * @return array Hasil diagnosis final
     */
    public function calculateFinalDiagnosis(): array
    {
        $finalDiagnoses = [];

        foreach ($this->hypotheses as $hyp) {
            $disease = Disease::find($hyp['disease_id']);
            if (!$disease) continue;

            // Mulai dari confidence FC (0-1 scale)
            $cf = ($hyp['original_confidence'] ?? 50) / 100;

            // Hitung total matched (FC + BC verified)
            $allMatchedIds = array_unique(array_merge(
                $hyp['matched_symptom_ids'],
                array_intersect($this->verifiedSymptomIds, $hyp['required_symptom_ids'])
            ));

            // BOOST: gejala yang dikonfirmasi di BC (yang tadinya missing)
            $bcConfirmedIds = array_intersect($this->verifiedSymptomIds, $hyp['required_symptom_ids']);
            foreach ($bcConfirmedIds as $symptomId) {
                $cfRule = $hyp['cf_rules'][$symptomId] ?? 0.5;
                // Boost proporsional: semakin tinggi CF rule, semakin besar boost
                // Tapi dibatasi agar tidak over-inflate
                $boost = $cfRule * 0.15;
                $cf = $cf + $boost * (1 - $cf);
            }

            // PENALTY: gejala yang ditolak user di BC
            $deniedInHyp = array_intersect($this->deniedSymptomIds, $hyp['required_symptom_ids']);
            foreach ($deniedInHyp as $deniedId) {
                $cfRule = $hyp['cf_rules'][$deniedId] ?? 0.5;
                // Penalty ringan: maks ~20% per denied symptom
                $cf *= (1 - $cfRule * 0.2);
            }

            // Clamp ke range 0-1
            $cf = max(0, min(1, $cf));

            // Hitung remaining missing
            $remainingMissing = array_diff(
                $hyp['missing_symptom_ids'],
                $this->verifiedSymptomIds,
                $this->deniedSymptomIds
            );

            // Coverage info (untuk display, bukan untuk adjust CF)
            $totalRequired = count($hyp['required_symptom_ids']);
            $totalMatched = count($allMatchedIds);

            // Get symptom names
            $matchedSymptomNames = Symptom::whereIn('id', $allMatchedIds)
                ->pluck('name')->toArray();
            $deniedSymptomNames = Symptom::whereIn('id', $deniedInHyp)
                ->pluck('name')->toArray();
            $missingSymptomNames = Symptom::whereIn('id', $remainingMissing)
                ->pluck('name')->toArray();

            // Confidence percentage
            $confidencePercent = round($cf * 100);

            // Determine verification status
            $verificationStatus = $this->determineVerificationStatus(
                $confidencePercent,
                $hyp['original_confidence'],
                count($bcConfirmedIds),
                count($deniedInHyp),
                $totalMatched,
                $totalRequired
            );

            $finalDiagnoses[] = [
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
                'confidence' => $confidencePercent,
                'original_confidence' => $hyp['original_confidence'],
                'confidence_change' => $confidencePercent - $hyp['original_confidence'],
                'match_percentage' => round(($totalMatched / max($totalRequired, 1)) * 100, 2),
                'matched_symptoms' => $matchedSymptomNames,
                'denied_symptoms' => $deniedSymptomNames,
                'missing_symptoms' => $missingSymptomNames,
                'verification_status' => $verificationStatus,
                'total_required' => $totalRequired,
                'total_matched' => $totalMatched,
                'total_denied' => count($deniedInHyp),
                'bc_verified' => true,
            ];
        }

        // Sort by adjusted confidence (descending)
        usort($finalDiagnoses, fn($a, $b) => $b['confidence'] <=> $a['confidence']);

        // Filter out diagnoses with very low confidence (< 5%)
        $finalDiagnoses = array_values(array_filter(
            $finalDiagnoses,
            fn($d) => $d['confidence'] >= 5
        ));

        return [
            'status' => 'success',
            'method' => 'hybrid_fc_bc',
            'verification_log' => $this->verificationLog,
            'total_verifications' => count($this->askedSymptomIds),
            'total_confirmed' => count($this->verifiedSymptomIds),
            'total_denied' => count($this->deniedSymptomIds),
            'diagnoses' => $finalDiagnoses,
        ];
    }

    /**
     * Tentukan status verifikasi berdasarkan perubahan confidence
     */
    private function determineVerificationStatus(
        int $finalConfidence,
        int $originalConfidence,
        int $confirmedCount,
        int $deniedCount,
        int $totalMatched,
        int $totalRequired
    ): string {
        $change = $finalConfidence - $originalConfidence;

        // Confidence naik atau tetap tinggi + ada confirmed symptoms
        if ($confirmedCount > 0 && $finalConfidence >= $originalConfidence) {
            return 'strongly_verified';
        }

        // Confidence turun sedikit tapi masih di atas 40%
        if ($finalConfidence >= 40 && $change >= -10) {
            return $confirmedCount > 0 ? 'partially_verified' : 'inconclusive';
        }

        // Confidence turun signifikan (>15%) dan di bawah 25%
        if ($change < -15 && $finalConfidence < 25) {
            return 'rejected';
        }

        // Ada denied tapi masih reasonable
        if ($deniedCount > 0 && $finalConfidence >= 25) {
            return 'partially_verified';
        }

        return 'inconclusive';
    }

    /**
     * Get verification summary untuk UI
     */
    public function getVerificationSummary(): array
    {
        return [
            'total_asked' => count($this->askedSymptomIds),
            'total_confirmed' => count($this->verifiedSymptomIds),
            'total_denied' => count($this->deniedSymptomIds),
            'total_skipped' => count($this->askedSymptomIds) - count($this->verifiedSymptomIds) - count($this->deniedSymptomIds),
            'verification_log' => $this->verificationLog,
            'hypotheses_count' => count($this->hypotheses),
        ];
    }

    /**
     * Get label status verifikasi dalam Bahasa Indonesia
     */
    public static function getVerificationLabel(string $status): string
    {
        return match ($status) {
            'strongly_verified' => 'Terverifikasi Kuat',
            'partially_verified' => 'Terverifikasi Sebagian',
            'inconclusive' => 'Belum Pasti',
            'rejected' => 'Ditolak oleh Verifikasi',
            'unverified' => 'Belum Diverifikasi',
            'direct_confirmed' => 'Diagnosis Langsung',
            default => $status,
        };
    }

    /**
     * Get color untuk verification status badge
     */
    public static function getVerificationColor(string $status): string
    {
        return match ($status) {
            'strongly_verified' => 'green',
            'partially_verified' => 'blue',
            'inconclusive' => 'yellow',
            'rejected' => 'red',
            'direct_confirmed' => 'emerald',
            default => 'gray',
        };
    }
}
