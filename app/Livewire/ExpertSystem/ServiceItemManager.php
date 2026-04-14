<?php

namespace App\Livewire\ExpertSystem;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\ServiceCategory;
use Illuminate\Support\Str;

#[Layout('layouts.app')]
class ServiceItemManager extends Component
{
    public ServiceCategory $category;
    public $items = [];

    public $showModal = false;
    public $isEdit = false;

    // Form fields
    public $editKey;
    public $label;
    public $price;
    public $description;
    public $note;

    protected $rules = [
        'label' => 'required|string|max:255',
        'price' => 'nullable|string|max:255',
        'description' => 'required|string',
        'note' => 'nullable|string',
    ];

    public function mount(ServiceCategory $category)
    {
        $this->category = $category;
        $this->loadData();
    }

    public function loadData()
    {
        // Decode JSON from services_data
        $data = json_decode($this->category->services_data, true);
        $this->items = is_array($data) ? $data : [];
    }

    public function openModal()
    {
        $this->resetInput();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function edit($key)
    {
        $this->resetInput();
        $this->isEdit = true;
        $this->editKey = $key;

        $item = $this->items[$key] ?? null;
        if ($item) {
            $this->label = $item['label'] ?? '';
            $this->price = $item['price'] ?? '';
            $this->description = $item['desc'] ?? '';
            $this->note = $item['note'] ?? '';
            $this->showModal = true;
        }
    }

    public function save()
    {
        $this->validate();

        $key = $this->isEdit ? $this->editKey : Str::slug($this->label, '_');

        // Prevent overwriting if creating new and key exists
        if (!$this->isEdit && isset($this->items[$key])) {
            $key = $key . '_' . time();
        }

        $this->items[$key] = [
            'label' => $this->label,
            'price' => $this->price,
            'desc' => $this->description,
            'note' => $this->note,
        ];

        $this->saveToDatabase();

        session()->flash('message', $this->isEdit ? 'Layanan berhasil diupdate.' : 'Layanan berhasil ditambahkan.');
        $this->closeModal();
    }

    public function delete($key)
    {
        if (isset($this->items[$key])) {
            unset($this->items[$key]);
            $this->saveToDatabase();
            session()->flash('message', 'Layanan berhasil dihapus.');
        }
    }

    private function saveToDatabase()
    {
        // Save back to json
        $this->category->services_data = empty($this->items) ? null : json_encode($this->items);
        $this->category->save();
        $this->loadData();
    }

    public function resetInput()
    {
        $this->label = '';
        $this->price = '';
        $this->description = '';
        $this->note = '';
        $this->editKey = null;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetInput();
    }

    public function render()
    {
        return view('livewire.expert-system.service-item-manager');
    }
}
