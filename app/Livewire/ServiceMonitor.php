<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class ServiceMonitor extends Component
{
    use WithPagination;

    public $activeTab = 'REGULER'; // Atur default ke REGULER

    public function setTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage(); // Reset pagination saat ganti tab
    }

    public function getServicesProperty()
    {
        return Service::with(['customer'])
            ->where('service_type', $this->activeTab)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
    }

    public function isWarning($service)
    {
        // Status yang diabaikan (Perbaikan, Selesai, Diambil User)
        $excludedStatuses = ['In Progress', 'Done', 'Taken', 'Waiting Part'];

        if (!in_array($service->status, $excludedStatuses)) {
            // Cek apakah belum ada perubahan selama > 6 hari
            if ($service->updated_at->diffInDays(Carbon::now()) > 6) {
                return true;
            }
        }

        return false;
    }

    public function getStatusLabel($status, $type)
    {
        if ($type === 'AUTHORIZED') {
            $map = [
                'Pending' => 'Baru Masuk',
                'Diagnosis' => 'Proses',
                'Waiting Part' => 'Waiting Part Vendor',
                'Done' => 'Selesai',
                'Taken' => 'Diambil User'
            ];
            return $map[$status] ?? $status;
        }

        $map = [
            'Pending' => 'Baru Masuk',
            'Diagnosis' => 'Proses',
            'In Progress' => 'Perbaikan',
            'Done' => 'Selesai',
            'Taken' => 'Diambil User'
        ];
        return $map[$status] ?? $status;
    }

    public function getStatusColor($status)
    {
        return match ($status) {
            'Pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
            'Diagnosis' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
            'In Progress', 'Waiting Part' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300',
            'Done' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-300',
            'Taken' => 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300',
            default => 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300',
        };
    }

    public function render()
    {
        return view('livewire.service-monitor', [
            'services' => $this->services
        ]);
    }
}
