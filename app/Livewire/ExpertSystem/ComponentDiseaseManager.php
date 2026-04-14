<?php

namespace App\Livewire\ExpertSystem;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\DeviceComponent;
use App\Models\Disease;

#[Layout('layouts.app')]
class ComponentDiseaseManager extends Component
{
    public $component;
    public $diseases;

    public $showModal = false;
    public $isEdit = false;
    public $editId;

    public $name;
    public $description;
    public $solution;
    public $min_cost = 0;
    public $max_cost = 0;
    public $level = 'Ringan';

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'solution' => 'required|string',
        'min_cost' => 'required|numeric|min:0',
        'max_cost' => 'required|numeric|min:0|gte:min_cost',
        'level' => 'required|in:Ringan,Sedang,Berat',
    ];

    public function mount($component_id)
    {
        $this->component = DeviceComponent::with('deviceType')->findOrFail($component_id);
        $this->loadData();
    }

    public function loadData()
    {
        $this->diseases = Disease::where('device_component_id', $this->component->id)->get();
    }

    public function openModal()
    {
        $this->resetInput();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $this->resetInput();
        $this->isEdit = true;
        $this->editId = $id;

        $disease = Disease::findOrFail($id);
        $this->name = $disease->name;
        $this->description = $disease->description;
        $this->solution = $disease->solution;
        $this->min_cost = $disease->min_cost;
        $this->max_cost = $disease->max_cost;
        $this->level = $disease->level;

        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'solution' => $this->solution,
            'min_cost' => $this->min_cost,
            'max_cost' => $this->max_cost,
            'level' => $this->level,
            'device_type_id' => $this->component->device_type_id,
            'device_component_id' => $this->component->id,
            'category' => $this->component->slug, // Sinkronisasi field lama
        ];

        if ($this->isEdit) {
            Disease::findOrFail($this->editId)->update($data);
            session()->flash('message', 'Data kerusakan berhasil diperbarui.');
        } else {
            // Generate Code Otomatis (Contoh: D-LAP-LCD-XXX)
            $prefix = 'D-' . strtoupper(substr($this->component->deviceType->slug, 0, 3)) . '-' . strtoupper(substr($this->component->slug, 0, 3));
            $count = Disease::where('device_component_id', $this->component->id)->count() + 1;
            $data['code'] = $prefix . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);
            $data['device_type'] = $this->component->deviceType->slug; // Sinkronisasi dengan field type lama

            Disease::create($data);
            session()->flash('message', 'Data kerusakan berhasil ditambahkan.');
        }

        $this->closeModal();
        $this->loadData();
    }

    public function delete($id)
    {
        Disease::findOrFail($id)->delete();
        session()->flash('message', 'Kerusakan berhasil dihapus.');
        $this->loadData();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetInput();
    }

    private function resetInput()
    {
        $this->editId = null;
        $this->name = '';
        $this->description = '';
        $this->solution = '';
        $this->min_cost = 0;
        $this->max_cost = 0;
        $this->level = 'Ringan';
    }

    public function render()
    {
        return view('livewire.expert-system.component-disease-manager');
    }
}
