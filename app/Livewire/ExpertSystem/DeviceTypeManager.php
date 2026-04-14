<?php

namespace App\Livewire\ExpertSystem;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\DeviceType;
use Illuminate\Support\Str;

#[Layout('layouts.app')]
class DeviceTypeManager extends Component
{
    public $deviceTypes;
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

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->deviceTypes = DeviceType::orderBy('order_column')->get();
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

        $type = DeviceType::findOrFail($id);
        $this->name = $type->name;
        $this->icon = $type->icon;
        $this->description = $type->description;

        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'icon' => $this->icon,
            'description' => $this->description,
        ];

        if ($this->isEdit) {
            DeviceType::findOrFail($this->editId)->update($data);
            session()->flash('message', 'Tipe Perangkat berhasil diperbarui.');
        } else {
            DeviceType::create($data);
            session()->flash('message', 'Tipe Perangkat berhasil ditambahkan.');
        }

        $this->closeModal();
        $this->loadData();
    }

    public function delete($id)
    {
        $type = DeviceType::findOrFail($id);
        $type->delete();
        session()->flash('message', 'Tipe Perangkat berhasil dihapus.');
        $this->loadData();
    }

    public function toggleStatus($id)
    {
        $type = DeviceType::findOrFail($id);
        $type->is_active = !$type->is_active;
        $type->save();
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
        return view('livewire.expert-system.device-type-manager');
    }
}
