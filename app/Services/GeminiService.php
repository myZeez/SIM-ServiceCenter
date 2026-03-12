<?php

namespace App\Services;

use App\Models\Symptom;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * GeminiService - HANYA untuk Natural Language Processing
 *
 * PENTING: Service ini TIDAK digunakan untuk menentukan diagnosis!
 * Diagnosis ditentukan oleh ForwardChainingEngine berdasarkan rules di database.
 *
 * Fungsi GeminiService:
 * 1. Membantu memahami input user dalam bahasa sehari-hari
 * 2. Mengekstrak keywords teknis dari bahasa non-teknis
 * 3. Menyempurnakan bahasa respons agar lebih natural
 * 4. Memberikan penjelasan hasil diagnosis dalam bahasa yang mudah dipahami
 */
class GeminiService
{
    protected string $apiKey;
    protected string $endpoint;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key', env('GEMINI_API_KEY', ''));
        $this->endpoint = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent';
    }

    /**
     * Ekstrak keywords teknis dari input user yang menggunakan bahasa sehari-hari
     *
     * Fungsi ini membantu sistem memahami variasi bahasa user seperti:
     * - "laptop gak bisa idup" -> ["mati total", "tidak menyala"]
     * - "lcd nya ancur" -> ["layar pecah", "layar rusak"]
     * - "batre abis mulu" -> ["baterai boros", "baterai cepat habis"]
     *
     * @param string $userInput Input text dari user
     * @return array Keywords teknis yang sudah di-extract
     */
    public function extractTechnicalKeywords(string $userInput): array
    {
        if (empty($this->apiKey)) {
            return []; // Fallback ke keyword matching biasa
        }

        // Ambil daftar semua gejala dari database untuk reference
        $symptoms = Symptom::all()->map(function ($s) {
            return "{$s->code}: {$s->name}";
        })->implode("\n");

        $prompt = <<<PROMPT
Kamu adalah sistem NLP untuk mengekstrak gejala teknis laptop dari bahasa sehari-hari Indonesia.

DAFTAR GEJALA YANG DIKENALI SISTEM:
{$symptoms}

INPUT USER: "{$userInput}"

TUGAS:
1. Pahami apa yang dimaksud user dalam bahasa sehari-hari
2. Identifikasi gejala teknis yang cocok dari DAFTAR di atas
3. Output HANYA kode gejala yang cocok, pisahkan dengan koma

CONTOH OUTPUT:
- Input: "laptop gak bisa idup" -> G023
- Input: "lcd nya ancur, ada garis2" -> G002,G005
- Input: "lemot banget terus panas" -> G038,G044
- Input: "wifi mati, bt juga gak konek" -> G014,G017

ATURAN:
- WAJIB pilih dari daftar gejala di atas
- Jika tidak yakin, output: UNKNOWN
- JANGAN mengarang gejala baru
- Output format: G001,G002,G003 (tanpa spasi, tanpa penjelasan)

OUTPUT:
PROMPT;

        try {
            $response = Http::timeout(10)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post("{$this->endpoint}?key={$this->apiKey}", [
                    'contents' => [['parts' => [['text' => $prompt]]]],
                    'generationConfig' => [
                        'temperature' => 0.2, // Low temperature for consistency
                        'maxOutputTokens' => 50,
                    ]
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $result = trim($data['candidates'][0]['content']['parts'][0]['text'] ?? '');

                Log::info('Gemini extracted keywords', ['input' => $userInput, 'result' => $result]);

                // Parse result
                if ($result === 'UNKNOWN' || empty($result)) {
                    return [];
                }

                // Extract symptom codes (G001, G002, etc.)
                preg_match_all('/G\d{3}/', $result, $matches);
                return $matches[0] ?? [];
            }

            return [];

        } catch (\Exception $e) {
            Log::error('Gemini API error in extractTechnicalKeywords', ['message' => $e->getMessage()]);
            return [];
        }
    }

    /**
     * Minta klarifikasi dari user saat input tidak jelas
     *
     * @param string $userInput Input text dari user
     * @return string|null Pertanyaan klarifikasi atau null jika tidak perlu
     */
    public function generateClarification(string $userInput): ?string
    {
        if (empty($this->apiKey)) {
            return null;
        }

        $prompt = <<<PROMPT
Kamu adalah asisten teknisi laptop dari Cellcom Service Center.

INPUT USER: "{$userInput}"

User sepertinya menjelaskan masalah laptop tapi sistem tidak bisa mengidentifikasi gejala spesifiknya.

TUGAS: Buat pertanyaan lanjutan untuk memperjelas masalah, fokus pada:
1. Apa yang terjadi secara spesifik?
2. Kapan masalah ini muncul?
3. Ada tanda-tanda lain?

FORMAT OUTPUT:
- 1 pertanyaan klarifikasi yang ramah
- Dalam Bahasa Indonesia
- Maksimal 2 kalimat
- Gunakan emoji yang sesuai

OUTPUT:
PROMPT;

        try {
            $response = Http::timeout(10)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post("{$this->endpoint}?key={$this->apiKey}", [
                    'contents' => [['parts' => [['text' => $prompt]]]],
                    'generationConfig' => [
                        'temperature' => 0.6,
                        'maxOutputTokens' => 100,
                    ]
                ]);

            if ($response->successful()) {
                $data = $response->json();
                return trim($data['candidates'][0]['content']['parts'][0]['text'] ?? '');
            }

            return null;

        } catch (\Exception $e) {
            Log::error('Gemini API error in generateClarification', ['message' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Format diagnosis result menjadi penjelasan yang mudah dipahami
     *
     * @param array $diagnosisResult Hasil dari ForwardChainingEngine
     * @return string Penjelasan dalam bahasa natural
     */
    public function formatDiagnosisExplanation(array $diagnosisResult): string
    {
        if (empty($this->apiKey)) {
            return $this->getStaticExplanation($diagnosisResult);
        }

        $symptoms = implode(', ', $diagnosisResult['detected_symptoms'] ?? []);
        $diagnoses = collect($diagnosisResult['diagnoses'] ?? [])->map(function($d) {
            return "{$d['name']} ({$d['confidence']}% confidence)";
        })->implode(', ');

        $prompt = <<<PROMPT
Kamu adalah asisten teknisi laptop profesional dari Cellcom Service Center.

HASIL DIAGNOSIS SISTEM PAKAR:
- Gejala terdeteksi: {$symptoms}
- Kemungkinan kerusakan: {$diagnoses}

TUGAS: Jelaskan hasil diagnosis di atas kepada customer dalam bahasa Indonesia yang:
- Ramah dan mudah dipahami (non-teknis)
- Singkat (maksimal 100 kata)
- Tidak menambahkan diagnosis baru, hanya menjelaskan yang sudah ada
- Berikan sedikit konteks mengapa gejala tersebut mengarah ke diagnosis ini

Jawab langsung tanpa format khusus.
PROMPT;

        try {
            $response = Http::timeout(15)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post("{$this->endpoint}?key={$this->apiKey}", [
                    'contents' => [['parts' => [['text' => $prompt]]]],
                    'generationConfig' => [
                        'temperature' => 0.5,
                        'maxOutputTokens' => 300,
                    ]
                ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['candidates'][0]['content']['parts'][0]['text'] ?? $this->getStaticExplanation($diagnosisResult);
            }

            return $this->getStaticExplanation($diagnosisResult);

        } catch (\Exception $e) {
            Log::error('Gemini API error in formatDiagnosisExplanation', ['message' => $e->getMessage()]);
            return $this->getStaticExplanation($diagnosisResult);
        }
    }

    /**
     * Format pertanyaan follow-up agar lebih natural
     */
    public function formatQuestion(string $question, string $category): string
    {
        if (empty($this->apiKey)) {
            return $question; // Return as-is if no API key
        }

        $prompt = <<<PROMPT
Kamu adalah asisten teknisi laptop yang ramah.

Pertanyaan sistem: "{$question}"
Kategori masalah: {$category}

Tugas: Buat pertanyaan di atas lebih natural dan ramah dalam Bahasa Indonesia.
- Gunakan "Anda" bukan "kamu"
- Tetap singkat (1-2 kalimat)
- Boleh tambahkan emoji yang sesuai

Jawab langsung dengan pertanyaan yang sudah direvisi.
PROMPT;

        try {
            $response = Http::timeout(10)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post("{$this->endpoint}?key={$this->apiKey}", [
                    'contents' => [['parts' => [['text' => $prompt]]]],
                    'generationConfig' => [
                        'temperature' => 0.6,
                        'maxOutputTokens' => 100,
                    ]
                ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['candidates'][0]['content']['parts'][0]['text'] ?? $question;
            }

            return $question;

        } catch (\Exception $e) {
            Log::error('Gemini API error in formatQuestion', ['message' => $e->getMessage()]);
            return $question;
        }
    }

    /**
     * Generate greeting message berdasarkan waktu
     */
    public function getGreeting(): string
    {
        $hour = (int) date('H');

        if ($hour >= 5 && $hour < 12) {
            $greeting = "Selamat pagi! ☀️";
        } elseif ($hour >= 12 && $hour < 15) {
            $greeting = "Selamat siang! 🌤️";
        } elseif ($hour >= 15 && $hour < 18) {
            $greeting = "Selamat sore! 🌅";
        } else {
            $greeting = "Selamat malam! 🌙";
        }

        return "{$greeting} Saya asisten diagnosis Cellcom. Ceritakan masalah laptop Anda, saya akan membantu menganalisis dan memberikan solusi terbaik.";
    }

    /**
     * Answer follow-up questions after diagnosis
     * Hanya menjawab berdasarkan konteks diagnosis yang sudah ada
     */
    public function answerFollowUp(string $question, ?array $diagnosisResult): string
    {
        if (empty($this->apiKey)) {
            return "Untuk pertanyaan lebih detail, silakan konsultasikan langsung dengan teknisi kami saat Anda datang ke service center. Kami siap membantu! 😊";
        }

        $context = '';
        if ($diagnosisResult) {
            $symptoms = implode(', ', $diagnosisResult['detected_symptoms'] ?? []);
            $diagnoses = collect($diagnosisResult['diagnoses'] ?? [])->take(2)->map(function($d) {
                return "{$d['name']}: {$d['solution']}";
            })->implode('; ');

            $context = "Gejala: {$symptoms}. Diagnosis: {$diagnoses}";
        }

        $prompt = <<<PROMPT
Kamu adalah asisten teknisi laptop dari Cellcom Service Center.

KONTEKS DIAGNOSIS: {$context}

PERTANYAAN USER: "{$question}"

ATURAN JAWABAN:
- Jawab dalam Bahasa Indonesia yang ramah
- Maksimal 80 kata
- Berdasarkan konteks diagnosis yang ada
- Jika pertanyaan di luar konteks, arahkan untuk booking servis
- JANGAN memberikan diagnosis baru yang tidak ada dalam konteks

Jawab langsung tanpa format khusus.
PROMPT;

        try {
            $response = Http::timeout(15)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post("{$this->endpoint}?key={$this->apiKey}", [
                    'contents' => [['parts' => [['text' => $prompt]]]],
                    'generationConfig' => [
                        'temperature' => 0.5,
                        'maxOutputTokens' => 200,
                    ]
                ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['candidates'][0]['content']['parts'][0]['text'] ?? "Silakan konsultasikan langsung dengan teknisi kami saat Anda datang ke service center.";
            }

            return "Silakan konsultasikan langsung dengan teknisi kami saat Anda datang ke service center.";

        } catch (\Exception $e) {
            Log::error('Gemini API error in answerFollowUp', ['message' => $e->getMessage()]);
            return "Silakan konsultasikan langsung dengan teknisi kami saat Anda datang ke service center.";
        }
    }

    /**
     * Generate static explanation when API is not available
     */
    private function getStaticExplanation(array $diagnosisResult): string
    {
        $symptoms = $diagnosisResult['detected_symptoms'] ?? [];
        $diagnoses = $diagnosisResult['diagnoses'] ?? [];

        if (empty($diagnoses)) {
            return "Berdasarkan gejala yang Anda sebutkan, diperlukan pemeriksaan lebih lanjut oleh teknisi untuk menentukan masalah secara akurat.";
        }

        $topDiagnosis = $diagnoses[0] ?? null;
        if (!$topDiagnosis) {
            return "Silakan bawa laptop Anda ke service center untuk diagnosis yang lebih akurat.";
        }

        $confidence = $topDiagnosis['confidence'] ?? 0;
        $confidenceText = $confidence >= 80 ? 'sangat mungkin' : ($confidence >= 60 ? 'kemungkinan besar' : 'kemungkinan');

        return "Berdasarkan gejala yang Anda alami (" . implode(', ', array_slice($symptoms, 0, 3)) . "), {$confidenceText} laptop Anda mengalami {$topDiagnosis['name']}. Solusi yang disarankan: {$topDiagnosis['solution']}";
    }

    /**
     * Check if Gemini API is available
     */
    public function isAvailable(): bool
    {
        return !empty($this->apiKey);
    }
}
