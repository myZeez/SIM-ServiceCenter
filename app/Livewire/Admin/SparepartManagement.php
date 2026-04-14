<?php

namespace App\Livewire\Admin;

use App\Models\Sparepart;
use Livewire\Component;
use Livewire\WithPagination;

class SparepartManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $sparepartId, $name, $code, $stock, $price;
    public $isModalOpen = false;
    public $isConfirmDeleteOpen = false;
    public $sparepartToDelete = null;

    protected $rules = [
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:255|unique:spareparts,code',
        'stock' => 'required|integer|min:0',
        'price' => 'required|numeric|min:0',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isModalOpen = true;
    }

    public function edit($id)
    {
        $sparepart = Sparepart::findOrFail($id);
        $this->sparepartId = $id;
        $this->name = $sparepart->name;
        $this->code = $sparepart->code;
        $this->stock = $sparepart->stock;
        $this->price = $sparepart->price;
        $this->isModalOpen = true;
    }

    public function store()
    {
        $rules = $this->rules;
        if ($this->sparepartId) {
            $rules['code'] = 'required|string|max:255|unique:spareparts,code,' . $this->sparepartId;
        }

        $this->validate($rules);

        Sparepart::updateOrCreate(
            ['id' => $this->sparepartId],
            [
                'name' => $this->name,
                'code' => $this->code,
                'stock' => $this->stock,
                'price' => $this->price,
            ]
        );

        $this->isModalOpen = false;
        session()->flash('message', $this->sparepartId ? 'Sparepart diperbarui.' : 'Sparepart ditambahkan.');
        $this->resetInputFields();
    }

    public function confirmDelete($id)
    {
        $this->sparepartToDelete = $id;
        $this->isConfirmDeleteOpen = true;
    }

    public function delete()
    {
        if ($this->sparepartToDelete) {
            Sparepart::findOrFail($this->sparepartToDelete)->delete();
            session()->flash('message', 'Sparepart dihapus.');
            $this->isConfirmDeleteOpen = false;
            $this->sparepartToDelete = null;
        }
    }

    public function closeLocationModal()
    {
        $this->isModalOpen = false;
        $this->resetInputFields();
    }

    public function closeConfirmModal()
    {
        $this->isConfirmDeleteOpen = false;
        $this->sparepartToDelete = null;
    }

    private function resetInputFields()
    {
        $this->sparepartId = null;
        $this->name = '';
        $this->code = '';
        $this->stock = '';
        $this->price = '';
    }

    public function render()
    {
        $spareparts = Sparepart::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('code', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.admin.sparepart-management', [
            'spareparts' => $spareparts,
        ])->layout('layouts.app');
    }
}
