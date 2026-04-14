<?php
$file = 'app/Livewire/DiagnosisChat.php';
$content = file_get_contents($file);

// 1. Replace selectDevice logic
$newSelectDevice = <<<PHP
    public function selectDevice(\$type): void
    {
        \$device = \App\Models\DeviceType::find(\$type);
        if (!\$device) return;

        \$this->selectedDeviceType = \$type;
        \$this->state = 'select_category';
    }
PHP;
$content = preg_replace('/public function selectDevice\(string \$type\): void.*?\{.*?\}/s', $newSelectDevice, $content);

// 2. Replace selectCategory logic
$newSelectCategory = <<<PHP
    public function selectCategory(\$key): void
    {
        \$component = \App\Models\DeviceComponent::find(\$key);
        if (!\$component) return;

        \$this->selectedCategoryKey = \$key;
        \$this->state = 'select_problem';
    }
PHP;
$content = preg_replace('/public function selectCategory\(string \$key\): void.*?\{.*?\}/s', $newSelectCategory, $content);

// 3. Replace selectProblem logic
$newSelectProblem = <<<PHP
    public function selectProblem(\$key): void
    {
        \$symptom = \App\Models\Symptom::find(\$key);
        if (!\$symptom) return;

        \$this->selectedProblemKey = \$key;

        // Determine engine category (we will loosely map it or fall back to General)
        \$engineCategory = 'General';

        // Initialize engine with device type, category and initial symptoms
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

        // Initialize engine
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
            // Langsung result jika tidak ada pertanyaan
            \$this->runFinalDiagnosis();
        } else {
            \$this->state = 'asking';
        }
    }
PHP;

// Find and replace selectProblem
$content = preg_replace('/public function selectProblem\(string \$key\): void.*?public function selectServiceInquiry/s', $newSelectProblem . "\n\n    /**\n     * Enter service inquiry mode\n     */\n    public function selectServiceInquiry", $content);

// 4. Replace selectedServiceCategory and saveServiceBooking
$newServiceLogic = <<<PHP
    public function selectServiceCategory(\$id): void
    {
        \$category = \App\Models\ServiceCategory::find(\$id);
        if (!\$category) return;
        \$this->selectedServiceCategory = \$id;
        \$this->selectedServiceData = [
            'label' => \$category->name,
            'desc'  => \$category->description,
            'price' => \$category->estimated_cost_range,
        ];
        \$this->state = 'service_booking';
    }

    public function selectService(\$key): void
    {
        // Deprecated, flat list is used natively via selectServiceCategory
    }

    public function saveServiceBooking(): void
    {
        \$this->validate([
            'bookingForm.name' => 'required|string|max:100',
            'bookingForm.phone' => 'required|string|max:20',
            'bookingForm.notes' => 'nullable|string|max:500',
        ]);

        \$serviceLabel = \$this->selectedServiceData['label'] ?? '';
        \$servicePrice = \$this->selectedServiceData['price'] ?? '';

        \$complaint = "[Tanya Dulu] {\$serviceLabel} ({\$servicePrice})";
        if (!empty(\$this->bookingForm['notes'])) {
            \$complaint .= "\\nCatatan: " . \$this->bookingForm['notes'];
        }
PHP;

$content = preg_replace('/public function selectServiceCategory\(string \$cat\): void.*?if \(\!empty\(\$this->bookingForm\[\'notes\'\]\)\) \{.*?\}$/sm', $newServiceLogic, $content);
file_put_contents($file, $content);
echo "Done";
