<?php

namespace App\Livewire\Dashboard;

use App\Models\Service;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;

class TodayServices extends Component
{
    public $services = [];

    public function mount()
    {
        $this->loadServices();
    }

    #[On('serviceCreated')]
    public function loadServices()
    {
        $this->services = Service::with(['customer', 'user'])
            ->whereDate('created_at', Carbon::today())
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getStatusColor($status)
    {
        return match($status) {
            'Pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
            'Diagnosis' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
            'In Progress' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300',
            'Waiting Part' => 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-300',
            'Done' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
            'Taken' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
            default => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
        };
    }

    public function render()
    {
        return view('livewire.dashboard.today-services');
    }
}
