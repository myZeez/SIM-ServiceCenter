<?php

namespace App\Livewire\ExpertSystem;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\ServiceCategory;
use Illuminate\Support\Str;

#[Layout('layouts.app')]
class ServiceCategoryManager extends Component
{
    public $services;

    public $showModal = false;
    public $isEdit = false;

    // Form fields
    public $editId;
    public $name;
    public $icon;
    public $description;
    public $estimated_cost_range;

    protected $rules = [
        'name' => 'required|string|max:255',
        'icon' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'estimated_cost_range' => 'nullable|string|max:255',
    ];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->services = ServiceCategory::orderBy('order_column')->get();
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

        $service = ServiceCategory::findOrFail($id);
        $this->name = $service->name;
        $this->icon = $service->icon;
        $this->description = $service->description;
        $this->estimated_cost_range = $service->estimated_cost_range;

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
            'estimated_cost_range' => $this->estimated_cost_range,
        ];

        if ($this->isEdit) {
            ServiceCategory::findOrFail($this->editId)->update($data);
            session()->flash('message', 'Layanan berhasil diperbarui.');
        } else {
            ServiceCategory::create($data);
            session()->flash('message', 'Layanan berhasil ditambahkan.');
        }

        $this->closeModal();
        $this->loadData();
    }

    public function delete($id)
    {
        $service = ServiceCategory::findOrFail($id);
        $service->delete();
        session()->flash('message', 'Layanan berhasil dihapus.');
        $this->loadData();
    }

    public function toggleStatus($id)
    {
        $service = ServiceCategory::findOrFail($id);
        $service->is_active = !$service->is_active;
        $service->save();
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
        $this->estimated_cost_range = '';
    }

    public function render()
    {
        return view('livewire.expert-system.service-category-manager');
    }
}
