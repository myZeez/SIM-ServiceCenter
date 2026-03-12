<?php

namespace App\Livewire\Dashboard;

use App\Models\Service;
use Carbon\Carbon;
use Livewire\Component;

class Statistics extends Component
{
    public $monthlyRevenue = 0;
    public $monthlyServices = 0;
    public $todayServices = 0;
    public $todayCompleted = 0;
    public $inProgress = 0;

    public function mount()
    {
        $this->loadStatistics();
    }

    public function loadStatistics()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $today = Carbon::today();

        // Omset Bulan Ini
        $this->monthlyRevenue = Service::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->where('approved', true)
            ->sum('total_cost');

        // Jumlah Servis Bulan Ini
        $this->monthlyServices = Service::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // Jumlah Servis Hari Ini
        $this->todayServices = Service::whereDate('created_at', $today)->count();

        // Jumlah Servis Selesai Hari Ini
        $this->todayCompleted = Service::whereDate('updated_at', $today)
            ->where('status', 'Done')
            ->count();

        // Jumlah Servis Masih Proses
        $this->inProgress = Service::whereIn('status', ['Pending', 'Diagnosis', 'In Progress', 'Waiting Part'])
            ->count();
    }

    public function render()
    {
        return view('livewire.dashboard.statistics');
    }
}
