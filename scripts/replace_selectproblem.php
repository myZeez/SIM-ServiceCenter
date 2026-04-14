<?php
$file = 'E:/SKRIP v2/AdministrasiCellcom/app/Livewire/DiagnosisChat.php';
$content = file_get_contents($file);

$start = strpos($content, 'public function selectProblem(string $key): void');
$end = strpos($content, '    // ===========================', $start);
if ($start !== false && $end !== false) {
    $oldSelectProblem = substr($content, $start, $end - $start);

$newSelectProblem = <<<PHP
    public function selectProblem(\$key): void
    {
        \$symptom = \App\Models\Symptom::find(\$key);
        if (!\$symptom) return;

        \$this->selectedProblemKey = \$key;

        // Tentukan engine_category berdasarkan nama komponen
        \$component = \App\Models\DeviceComponent::find(\$this->selectedCategoryKey);
        \$engineCategory = \$component ? \$component->name : 'General';
        \$deviceType = \$this->getEngineDeviceType();

        \$facts = [
            [
                'id' => \$symptom->id,
                'code' => \$symptom->code,
                'name' => \$symptom->name,
                'category' => \$engineCategory,
                'weight' => \$symptom->weight,
            ]
        ];

        \$this->collectedSymptoms = [\$symptom->name];

        // Karena struktur database sudah mencakup semua relasi,
        // kita lewati config hardcoded directDiagnosis.

        // Inisialisasi engine
        \$engine = new ForwardChainingEngine(\$deviceType);
        \$engine->loadState([
            'facts' => \$facts,
            'asked_questions' => [],
            'current_category' => \$engineCategory,
            'negative_evidence' => [],
            'device_type' => \$deviceType,
            'question_filter' => null,
        ]);

        \$this->engineState = \$engine->exportState();
        \$this->currentQuestion = \$engine->getNextQuestion();
        \$this->questionCount = 1;
        \$this->answeredQuestions = [];

        \$this->skipBcVerification = false;

        if (!\$this->currentQuestion) {
            \$this->runFinalDiagnosis();
        } else {
            \$this->state = 'asking';
        }
    }

PHP;

    $content = substr_replace($content, $newSelectProblem, $start, $end - $start);
    file_put_contents($file, $content);
    echo "Replaced SelectProblem\n";
} else {
    echo "Could not find selectProblem string boundaries!";
}
