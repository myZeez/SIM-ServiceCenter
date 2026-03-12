<?php

namespace Database\Seeders;

use App\Models\Symptom;
use App\Models\Disease;
use App\Models\Rule;
use App\Models\CategoryQuestion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpertSystemSeeder extends Seeder
{
    /**
     * Device types dan path data masing-masing
     */
    private const DEVICE_CONFIGS = [
        'laptop' => [
            'label' => 'Laptop',
            'path' => '',
        ],
        'pc' => [
            'label' => 'PC Desktop',
            'path' => 'pc/',
        ],
        'aio' => [
            'label' => 'All-in-One (AIO)',
            'path' => 'aio/',
        ],
        'printer' => [
            'label' => 'Printer',
            'path' => 'printer/',
        ],
    ];

    /**
     * Severity to level mapping untuk data baru
     */
    private const SEVERITY_MAP = [
        'low' => 'Ringan',
        'moderate' => 'Sedang',
        'critical' => 'Berat',
    ];

    /**
     * Seed the expert system knowledge base
     * Multi-device: Laptop, PC Desktop & AIO, Printer
     */
    public function run(): void
    {
        $this->command->info('=== Seeding Expert System Data (Multi-Device) ===');

        // Clear existing data
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Rule::truncate();
        CategoryQuestion::truncate();
        Symptom::truncate();
        Disease::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach (self::DEVICE_CONFIGS as $deviceType => $config) {
            $this->command->info("--- Seeding {$config['label']} ---");

            $basePath = __DIR__ . '/data/' . $config['path'];

            $this->seedSymptoms($basePath, $deviceType);
            $this->seedDiseases($basePath, $deviceType);
            $this->seedRules($basePath, $deviceType);
            $this->seedCategoryQuestions($basePath, $deviceType);
        }

        $this->command->info('');
        $this->command->info('=== Summary ===');
        $this->command->info('Total Symptoms: ' . Symptom::count());
        $this->command->info('Total Diseases: ' . Disease::count());
        $this->command->info('Total Rules: ' . Rule::count());
        $this->command->info('Total Questions: ' . CategoryQuestion::count());
        $this->command->info('=== Expert System Seeding Completed ===');
    }

    /**
     * Seed symptoms (Gejala) untuk satu device type
     */
    private function seedSymptoms(string $basePath, string $deviceType): void
    {
        $file = $basePath . 'symptoms.php';
        if (!file_exists($file)) {
            $this->command->warn("  Symptoms file not found: {$file}");
            return;
        }
        $symptoms = require $file;

        foreach ($symptoms as $s) {
            Symptom::updateOrCreate(
                ['device_type' => $deviceType, 'code' => $s['code']],
                [
                    'name' => $s['name'],
                    'category' => $s['category'],
                    'keywords' => $s['keywords'] ?? [],
                    'weight' => $s['weight'] ?? 1.0,
                ]
            );
        }

        $this->command->info("  + " . count($symptoms) . " symptoms seeded ({$deviceType})");
    }

    /**
     * Seed diseases (Kerusakan) untuk satu device type
     * Mendukung format lama (actions, min_cost, max_cost, level)
     * dan format baru (severity, tanpa actions/cost)
     */
    private function seedDiseases(string $basePath, string $deviceType): void
    {
        $file = $basePath . 'diseases.php';
        if (!file_exists($file)) {
            $this->command->warn("  Diseases file not found: {$file}");
            return;
        }
        $diseases = require $file;

        foreach ($diseases as $d) {
            $level = $d['level']
                ?? (isset($d['severity']) ? (self::SEVERITY_MAP[$d['severity']] ?? 'Sedang') : 'Sedang');

            Disease::updateOrCreate(
                ['device_type' => $deviceType, 'code' => $d['code']],
                [
                    'name' => $d['name'],
                    'category' => $d['category'],
                    'description' => $d['description'] ?? '',
                    'solution' => $d['solution'],
                    'actions' => $d['actions'] ?? [$d['solution']],
                    'min_cost' => $d['min_cost'] ?? 0,
                    'max_cost' => $d['max_cost'] ?? 0,
                    'level' => $level,
                ]
            );
        }

        $this->command->info("  + " . count($diseases) . " diseases seeded ({$deviceType})");
    }

    /**
     * Seed rules (Aturan IF-THEN)
     * Format lama: [['disease' => 'K001', 'symptoms' => ['G001'], 'cf' => 0.9], ...]
     * Format baru: ['PCK001' => [['code' => 'PCG001', 'cf' => 0.9], ...], ...]
     */
    private function seedRules(string $basePath, string $deviceType): void
    {
        $file = $basePath . 'rules.php';
        if (!file_exists($file)) {
            $this->command->warn("  Rules file not found: {$file}");
            return;
        }
        $rules = require $file;

        $symptoms = Symptom::where('device_type', $deviceType)->get()->keyBy('code');
        $diseases = Disease::where('device_type', $deviceType)->get()->keyBy('code');

        $rulesCreated = 0;

        if (empty($rules)) {
            $this->command->info("  + 0 rules seeded ({$deviceType}) [empty]");
            return;
        }

        // Detect format
        $firstKey = array_key_first($rules);
        $firstRule = $rules[$firstKey];

        if (is_string($firstKey) && !isset($firstRule['disease']) && !isset($firstRule['disease_code'])) {
            // Format baru A: keyed by disease code, per-symptom CF
            // e.g. ['PCK001' => [['code'=>'PCG001','cf'=>0.9], ...]]
            foreach ($rules as $diseaseCode => $symptomRules) {
                $disease = $diseases->get($diseaseCode);
                if (!$disease) {
                    $this->command->warn("  Disease not found: {$diseaseCode}");
                    continue;
                }

                foreach ($symptomRules as $index => $sr) {
                    $symptom = $symptoms->get($sr['code']);
                    if (!$symptom) {
                        $this->command->warn("  Symptom not found: {$sr['code']}");
                        continue;
                    }

                    Rule::updateOrCreate(
                        ['disease_id' => $disease->id, 'symptom_id' => $symptom->id],
                        ['cf_value' => $sr['cf'], 'priority' => $index + 1]
                    );
                    $rulesCreated++;
                }
            }
        } elseif (isset($firstRule['disease_code'])) {
            // Format baru B: flat array with disease_code key
            // e.g. [['disease_code'=>'PCK001', 'symptoms'=>[['code'=>'PCG001','cf'=>0.9], ...]], ...]
            foreach ($rules as $rule) {
                $disease = $diseases->get($rule['disease_code']);
                if (!$disease) {
                    $this->command->warn("  Disease not found: {$rule['disease_code']}");
                    continue;
                }

                foreach ($rule['symptoms'] as $index => $sr) {
                    $symptom = $symptoms->get($sr['code']);
                    if (!$symptom) {
                        $this->command->warn("  Symptom not found: {$sr['code']}");
                        continue;
                    }

                    Rule::updateOrCreate(
                        ['disease_id' => $disease->id, 'symptom_id' => $symptom->id],
                        ['cf_value' => $sr['cf'], 'priority' => $index + 1]
                    );
                    $rulesCreated++;
                }
            }
        } else {
            // Format lama: flat array with 'disease' key
            foreach ($rules as $rule) {
                $disease = $diseases->get($rule['disease']);
                if (!$disease) {
                    $this->command->warn("  Disease not found: {$rule['disease']}");
                    continue;
                }

                foreach ($rule['symptoms'] as $index => $symptomCode) {
                    $symptom = $symptoms->get($symptomCode);
                    if (!$symptom) {
                        $this->command->warn("  Symptom not found: {$symptomCode}");
                        continue;
                    }

                    Rule::updateOrCreate(
                        ['disease_id' => $disease->id, 'symptom_id' => $symptom->id],
                        ['cf_value' => $rule['cf'], 'priority' => $index + 1]
                    );
                    $rulesCreated++;
                }
            }
        }

        $this->command->info("  + {$rulesCreated} rules seeded ({$deviceType})");
    }

    /**
     * Seed category follow-up questions
     * Format lama: ['category', 'question', 'expected_keyword', 'leads_to', 'order', ...]
     * Format baru: ['code', 'question', 'category', 'symptom_codes' => [...], 'order']
     */
    private function seedCategoryQuestions(string $basePath, string $deviceType): void
    {
        $file = $basePath . 'questions.php';
        if (!file_exists($file)) {
            $this->command->warn("  Questions file not found: {$file}");
            return;
        }
        $questions = require $file;

        $symptoms = Symptom::where('device_type', $deviceType)->get()->keyBy('code');

        $questionsCreated = 0;
        foreach ($questions as $q) {
            if (isset($q['symptom_codes'])) {
                // Format baru
                $firstCode = $q['symptom_codes'][0] ?? null;
                $symptom = $firstCode ? $symptoms->get($firstCode) : null;

                // Generate expected_keyword dari keywords gejala
                $keywords = [];
                foreach ($q['symptom_codes'] as $sc) {
                    $s = $symptoms->get($sc);
                    if ($s && !empty($s->keywords)) {
                        $kw = is_array($s->keywords) ? $s->keywords : json_decode($s->keywords, true);
                        if (is_array($kw)) {
                            $keywords = array_merge($keywords, array_slice($kw, 0, 3));
                        }
                    }
                }
                $expectedKeyword = !empty($keywords)
                    ? implode(',', array_unique(array_slice($keywords, 0, 8)))
                    : 'ya,iya,ada,benar';

                // Untuk pertanyaan yesno, pastikan 'ya' dan 'iya' selalu ada
                // agar tombol "Ya" di UI selalu bisa match
                $questionType = $q['type'] ?? 'yesno';
                if ($questionType === 'yesno') {
                    $expectedKeyword = 'ya,iya,' . $expectedKeyword;
                }

                CategoryQuestion::updateOrCreate(
                    ['device_type' => $deviceType, 'category' => $q['category'], 'question' => $q['question']],
                    [
                        'expected_keyword' => $expectedKeyword,
                        'leads_to_symptom_id' => $symptom?->id,
                        'order' => $q['order'],
                        'question_type' => $q['type'] ?? 'yesno',
                        'options' => $q['options'] ?? null,
                    ]
                );
            } else {
                // Format lama
                $symptom = isset($q['leads_to']) ? $symptoms->get($q['leads_to']) : null;

                CategoryQuestion::updateOrCreate(
                    ['device_type' => $deviceType, 'category' => $q['category'], 'question' => $q['question']],
                    [
                        'expected_keyword' => $q['expected_keyword'],
                        'leads_to_symptom_id' => $symptom?->id,
                        'order' => $q['order'],
                        'question_type' => $q['type'] ?? 'yesno',
                        'options' => $q['options'] ?? null,
                    ]
                );
            }
            $questionsCreated++;
        }

        $this->command->info("  + {$questionsCreated} questions seeded ({$deviceType})");
    }
}
