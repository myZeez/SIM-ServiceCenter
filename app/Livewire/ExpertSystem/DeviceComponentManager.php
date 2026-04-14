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

    protected $rules = [
        'name' => 'required|string|max:255',
        'icon' => 'nullable|string|max:255',
        'description' => 'nullable|string',
    ];

    public function mount($device_type_id)
    {
        $this->deviceType = DeviceType::findOrFail($device_type_id);
        $this->loadData();
    }

    public function loadData()
    {
        $this->components = DeviceComponent::where('device_type_id', $this->deviceType->id)
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
        ];

        if ($this->isEdit) {
            DeviceComponent::findOrFail($this->editId)->update($data);
            session()->flash('message', 'Komponen berhasil diperbarui.');
        } else {
            DeviceComponent::create($data);
            session()->flash('message', 'Komponen berhasil ditambahkan.');
        }

        $this->closeModal();
        $this->loadData();
    }

    public function delete($id)
    {
        $component = DeviceComponent::findOrFail($id);
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
    }

    public function render()
    {
        return view('livewire.expert-system.device-component-manager');
    }
}
