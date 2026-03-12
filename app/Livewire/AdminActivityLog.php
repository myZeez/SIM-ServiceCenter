<?php

namespace App\Livewire;

use Livewire\Component;

class AdminActivityLog extends Component
{
    use \Livewire\WithPagination;

    public $search = '';
    public $userFilter = '';
    public $startDate = '';
    public $endDate = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = \App\Models\ServiceLog::with(['user', 'service.customer'])
            ->latest();

        if ($this->search) {
            $query->whereHas('service', function ($q) {
                $q->where('ticket_number', 'like', '%' . $this->search . '%')
                  ->orWhere('device_name', 'like', '%' . $this->search . '%')
                  ->orWhereHas('customer', function ($c) {
                      $c->where('name', 'like', '%' . $this->search . '%');
                  });
            });
        }

        if ($this->userFilter) {
            $query->where('user_id', $this->userFilter);
        }

        if ($this->startDate) {
            $query->whereDate('created_at', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->whereDate('created_at', '<=', $this->endDate);
        }

        return view('livewire.admin-activity-log', [
            'logs' => $query->paginate(20),
            'users' => \App\Models\User::whereIn('role', ['admin', 'super_admin'])->get(),
        ]);
    }
}
