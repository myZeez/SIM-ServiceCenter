<?php

namespace App\Livewire\ExpertSystem;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\DeviceType;
use App\Models\DeviceComponent;
use Illuminate\Support\Str;

#[Layout('layouts.app')]
class DeviceComponentManager extends Component
{
    public $deviceType;
    public $components;

    public $showModal = false;
    public $isEdit = false;

    // Form fields
    public $editId;
    public $name;
    public $icon;
    public $description;
    public $engine_category;

    protected $rules = [
        'name' => 'required|string|max:255',
        'icon' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'engine_category' => 'nullable|string|max:255',
    ];

    public function mount($device_type_id)
    {
        $this->deviceType = DeviceType::findOrFail($device_type_id);
        $this->loadData();
    }

    public function loadData()
    {
        $this->components = DeviceComponent::where('device_type_id', $this->deviceType->id)
            ->withCount(['diseases', 'symptoms', 'categoryQuestions'])
            ->orderBy('order_column')->get();
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

        $component = DeviceComponent::findOrFail($id);
        $this->name = $component->name;
        $this->icon = $component->icon;
        $this->description = $component->description;
        $this->engine_category = $component->engine_category;

        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'device_type_id' => $this->deviceType->id,
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'icon' => $this->icon,
            'description' => $this->description,
            'engine_category' => $this->engine_category ?: Str::headline(Str::slug($this->name, ' ')),
        ];

        if ($this->isEdit) {
            DeviceComponent::findOrFail($this->editId)->update($data);
            session()->flash('message', 'Komponen berhasil diperbarui.');
        } else {
            $data['order_column'] = DeviceComponent::where('device_type_id', $this->deviceType->id)->max('order_column') + 1;
            $data['problems_data'] = [];
            DeviceComponent::create($data);
            session()->flash('message', 'Komponen berhasil ditambahkan.');
        }

        $this->closeModal();
        $this->loadData();
    }

    public function delete($id)
    {
        $component = DeviceComponent::findOrFail($id);
        if ($component->diseases()->exists() || $component->symptoms()->exists()) {
            session()->flash('error', 'Komponen tidak bisa dihapus karena masih memiliki kerusakan atau gejala.');
            return;
        }

        $component->delete();
        session()->flash('message', 'Komponen berhasil dihapus.');
        $this->loadData();
    }

    public function toggleStatus($id)
    {
        $component = DeviceComponent::findOrFail($id);
        $component->is_active = !$component->is_active;
        $component->save();
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
        $this->icon = '';
        $this->description = '';
        $this->engine_category = '';
    }

    public function render()
    {
        return view('livewire.expert-system.device-component-manager');
    }
}
