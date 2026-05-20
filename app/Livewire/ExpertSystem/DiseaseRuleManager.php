<?php

namespace App\Livewire\ExpertSystem;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Disease;
use App\Models\Rule;
use App\Models\Symptom;
use App\Models\CategoryQuestion;
use Illuminate\Support\Str;

#[Layout('layouts.app')]
class DiseaseRuleManager extends Component
{
    public $disease;
    public $relatedSymptoms;

    public $showModal = false;

    // Field form penambahan Gejala -> Rule
    public $name; // Nama / Pertanyaan Utama (Forward Chaining context)
    public $follow_up_question; // Pertanyaan Verifikasi (Backward Chaining context)
    public $cf_value = 0.8; // Kepastian / Certainty Factor Value
    public $keywords;
    public $problem_label;
    public $problem_description;
    public $question_text;
    public $expected_keyword = 'ya,iya,ada,benar';
    public $sync_problem_entry = true;
    public $sync_category_question = true;

    // Pilih gejala yang sudah ada
    public $isExistingSymptom = false;
    public $existingSymptomId;
    public $allSymptoms = [];

    protected $rules = [
        'name' => 'required_if:isExistingSymptom,false|string|max:255',
        'follow_up_question' => 'required_if:isExistingSymptom,false|string|max:255',
        'existingSymptomId' => 'required_if:isExistingSymptom,true',
        'cf_value' => 'required|numeric|min:0.1|max:1.0',
        'keywords' => 'nullable|string|max:500',
        'problem_label' => 'nullable|string|max:255',
        'problem_description' => 'nullable|string|max:255',
        'question_text' => 'nullable|string|max:255',
        'expected_keyword' => 'nullable|string|max:255',
        'sync_problem_entry' => 'boolean',
        'sync_category_question' => 'boolean',
    ];

    public function mount($disease_id)
    {
        $this->disease = Disease::with('deviceType')->findOrFail($disease_id);
        $this->loadData();
    }

    public function loadData()
    {
        // Get symptoms linked to this disease
        $this->disease->load(['component', 'deviceType', 'symptoms']);
        $this->relatedSymptoms = $this->disease->symptoms()->orderBy('rules.id', 'desc')->get();
        // Load all symptoms for this device type to allow attaching existing ones
        $this->allSymptoms = Symptom::where('device_type_id', $this->disease->device_type_id)
            ->where(function ($query) {
                $query->whereNull('device_component_id')
                    ->orWhere('device_component_id', $this->disease->device_component_id);
            })
            ->orderBy('name')
            ->get();
    }

    public function openModal()
    {
        $this->resetInput();
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $symptom = null;

        if ($this->isExistingSymptom) {
            $symptom = Symptom::findOrFail($this->existingSymptomId);
        } else {
            $component = $this->disease->component;
            $deviceTypeSlug = $this->disease->deviceType?->slug ?: $this->disease->device_type ?: 'custom';
            $category = $component?->engine_category ?: $this->disease->category ?: $component?->slug;

            $symptom = Symptom::create([
                'device_type_id' => $this->disease->device_type_id,
                'device_component_id' => $this->disease->device_component_id,
                'device_type' => $deviceTypeSlug,
                'category' => $category,
                'code' => $this->generateSymptomCode($deviceTypeSlug),
                'name' => $this->name,
                'follow_up_question' => $this->follow_up_question,
                'keywords' => $this->parseKeywords($this->keywords, $this->name),
                'weight' => 1.0, // Default weight
            ]);
        }

        $rule = Rule::firstOrNew([
            'disease_id' => $this->disease->id,
            'symptom_id' => $symptom->id,
        ]);

        if (!$rule->exists) {
            $rule->priority = (int) Rule::where('disease_id', $this->disease->id)->max('priority') + 1;
        }

        $rule->cf_value = $this->cf_value;
        $rule->save();

        if ($this->sync_category_question) {
            $this->syncCategoryQuestion($symptom);
        }

        if ($this->sync_problem_entry) {
            $this->syncProblemEntry($symptom);
        }

        if ($rule->wasRecentlyCreated) {
            session()->flash('message', 'Gejala, aturan CF, pertanyaan, dan pilihan masalah berhasil disinkronkan.');
        } else {
            session()->flash('message', 'Aturan gejala sudah ada. Nilai CF dan data pendukung berhasil diperbarui.');
        }

        $this->closeModal();
        $this->loadData();
    }

    public function detachSymptom($symptomId)
    {
        $this->disease->symptoms()->detach($symptomId);
        session()->flash('message', 'Gejala berhasil dilepas dari penyakit ini.');
        $this->loadData();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetInput();
    }

    private function resetInput()
    {
        $this->isExistingSymptom = false;
        $this->existingSymptomId = null;
        $this->name = '';
        $this->follow_up_question = '';
        $this->cf_value = 0.8;
        $this->keywords = '';
        $this->problem_label = '';
        $this->problem_description = '';
        $this->question_text = '';
        $this->expected_keyword = 'ya,iya,ada,benar';
        $this->sync_problem_entry = true;
        $this->sync_category_question = true;
    }

    private function generateSymptomCode(string $deviceTypeSlug): string
    {
        $prefix = match ($deviceTypeSlug) {
            'pc' => 'PCG',
            'aio' => 'AIOG',
            'printer' => 'PRG',
            default => 'G',
        };

        $lastCode = Symptom::where('device_type', $deviceTypeSlug)
            ->where('code', 'like', $prefix . '%')
            ->pluck('code')
            ->map(fn ($code) => (int) preg_replace('/\D/', '', $code))
            ->max();

        do {
            $lastCode = ((int) $lastCode) + 1;
            $code = $prefix . str_pad($lastCode, 3, '0', STR_PAD_LEFT);
        } while (Symptom::where('device_type', $deviceTypeSlug)->where('code', $code)->exists());

        return $code;
    }

    private function parseKeywords(?string $keywords, string $fallback): array
    {
        $rawKeywords = collect(explode(',', $keywords ?: $fallback))
            ->map(fn ($keyword) => trim(Str::lower($keyword)))
            ->filter()
            ->unique()
            ->values()
            ->all();

        return $rawKeywords ?: [Str::lower($fallback)];
    }

    private function syncCategoryQuestion(Symptom $symptom): void
    {
        $question = trim($this->question_text ?: $symptom->follow_up_question ?: "Apakah perangkat mengalami {$symptom->name}?");
        $expectedKeyword = trim($this->expected_keyword ?: 'ya,iya,ada,benar');
        $nextOrder = (int) CategoryQuestion::where('device_type', $symptom->device_type)
            ->where('category', $symptom->category)
            ->max('order') + 1;

        $categoryQuestion = CategoryQuestion::firstOrNew([
            'device_type' => $symptom->device_type,
            'category' => $symptom->category,
            'question' => $question,
        ]);

        if (!$categoryQuestion->exists) {
            $categoryQuestion->order = $nextOrder;
        }

        $categoryQuestion->fill([
            'expected_keyword' => $expectedKeyword,
            'leads_to_symptom_id' => $symptom->id,
            'question_type' => 'yesno',
            'options' => null,
            'device_type_id' => $symptom->device_type_id,
            'device_component_id' => $symptom->device_component_id,
        ])->save();
    }

    private function syncProblemEntry(Symptom $symptom): void
    {
        $component = $this->disease->component;
        if (!$component) {
            return;
        }

        $problems = $component->problems_data ?: [];
        $keyBase = Str::slug($this->problem_label ?: $symptom->name, '_');
        $key = $keyBase;
        $counter = 2;

        while (isset($problems[$key]) && !in_array($symptom->code, $problems[$key]['symptoms'] ?? [], true)) {
            $key = $keyBase . '_' . $counter;
            $counter++;
        }

        $problems[$key] = [
            'label' => $this->problem_label ?: $symptom->name,
            'desc' => $this->problem_description ?: ($symptom->follow_up_question ?: $symptom->name),
            'symptoms' => array_values(array_unique(array_merge($problems[$key]['symptoms'] ?? [], [$symptom->code]))),
        ];

        if ($symptom->category !== $component->engine_category) {
            $problems[$key]['engine_category'] = $symptom->category;
        }

        $component->update([
            'engine_category' => $component->engine_category ?: $symptom->category,
            'problems_data' => $problems,
        ]);
    }

    public function render()
    {
        return view('livewire.expert-system.disease-rule-manager');
    }
}
