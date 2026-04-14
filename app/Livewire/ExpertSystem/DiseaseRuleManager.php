<?php

namespace App\Livewire\ExpertSystem;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Disease;
use App\Models\Symptom;

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

    // Pilih gejala yang sudah ada
    public $isExistingSymptom = false;
    public $existingSymptomId;
    public $allSymptoms = [];

    protected $rules = [
        'name' => 'required_if:isExistingSymptom,false|string|max:255',
        'follow_up_question' => 'required_if:isExistingSymptom,false|string|max:255',
        'existingSymptomId' => 'required_if:isExistingSymptom,true',
        'cf_value' => 'required|numeric|min:0.1|max:1.0',
    ];

    public function mount($disease_id)
    {
        $this->disease = Disease::with('deviceType')->findOrFail($disease_id);
        $this->loadData();
    }

    public function loadData()
    {
        // Get symptoms linked to this disease
        $this->relatedSymptoms = $this->disease->symptoms()->orderBy('rules.id', 'desc')->get();
        // Load all symptoms for this device type to allow attaching existing ones
        $this->allSymptoms = Symptom::where('device_type_id', $this->disease->device_type_id)->get();
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
            // Generate internal symptom code (e.g. S-LAP-LCD-XXX)
            $prefix = 'S-' . strtoupper(substr($this->disease->device_type ?? 'UNK', 0, 3));
            $count = Symptom::where('device_type_id', $this->disease->device_type_id)->count() + 1;

            $symptom = Symptom::create([
                'device_type_id' => $this->disease->device_type_id,
                'device_component_id' => $this->disease->device_component_id,
                'device_type' => $this->disease->device_type, // legacy support
                'category' => $this->disease->category, // legacy support
                'code' => $prefix . '-' . str_pad($count, 3, '0', STR_PAD_LEFT) . time(), // ensure unique
                'name' => $this->name,
                'follow_up_question' => $this->follow_up_question,
                'keywords' => [],
                'weight' => 1.0, // Default weight
            ]);
        }

        // Attach to disease with rule attributes (cf_value)
        // Check if already exist to prevent dupes
        if (!$this->disease->symptoms()->where('symptom_id', $symptom->id)->exists()) {
            $this->disease->symptoms()->attach($symptom->id, [
                'cf_value' => $this->cf_value,
                'priority' => 1
            ]);
            session()->flash('message', 'Gejala & Aturan berhasil dihubungkan.');
        } else {
            session()->flash('error', 'Gejala ini sudah terhubung dengan penyakit ini.');
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
    }

    public function render()
    {
        return view('livewire.expert-system.disease-rule-manager');
    }
}
