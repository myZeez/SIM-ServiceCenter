<?php

namespace App\Livewire\SuperAdmin;

use App\Models\Service;
use App\Models\ServiceLog;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public $month;
    public $year;
    public $serviceTypeFilter = 'all'; // all, REGULER, AUTHORIZED

    public function mount()
    {
        $this->month = Carbon::now()->month;
        $this->year = Carbon::now()->year;
    }

    public function getMonthsProperty()
    {
        return [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
    }

    public function getYearsProperty()
    {
        return range(Carbon::now()->year, Carbon::now()->year - 5);
    }

    // STATISTIK GLOBAL
    public function getGlobalStatsProperty()
    {
        $baseQuery = Service::whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year);

        return [
            'total_servis_bulan' => (clone $baseQuery)->count(),
            'total_omset_reguler' => (clone $baseQuery)->where('service_type', 'REGULER')
                ->whereIn('status', ['Done', 'Taken'])->sum('total_cost'),
            'jumlah_reguler' => (clone $baseQuery)->where('service_type', 'REGULER')->count(),
            'jumlah_garansi' => (clone $baseQuery)->where('service_type', 'AUTHORIZED')->count(),
            'selesai_hari_ini' => Service::whereDate('updated_at', Carbon::today())
                ->whereIn('status', ['Done', 'Taken'])->count(),
            'masih_proses' => Service::whereNotIn('status', ['Done', 'Taken'])->count(),
        ];
    }

    // MONITORING KINERJA ADMIN
    public function getAdminPerformanceProperty()
    {
        $admins = User::whereIn('role', ['admin'])->get();

        return $admins->map(function ($admin) {
            $inputServis = ServiceLog::where('user_id', $admin->id)
                ->where('status', 'Pending')
                ->whereMonth('created_at', $this->month)
                ->whereYear('created_at', $this->year)
                ->count();

            $updateStatus = ServiceLog::where('user_id', $admin->id)
                ->whereMonth('created_at', $this->month)
                ->whereYear('created_at', $this->year)
                ->count();

            $totalTransaksi = ServiceLog::where('user_id', $admin->id)
                ->whereHas('service', function ($q) {
                    $q->whereIn('status', ['Done', 'Taken']);
                })
                ->whereMonth('created_at', $this->month)
                ->whereYear('created_at', $this->year)
                ->distinct('service_id')
                ->count('service_id');

            return [
                'id' => $admin->id,
                'name' => $admin->name,
                'input_servis' => $inputServis,
                'update_status' => $updateStatus,
                'total_transaksi' => $totalTransaksi,
                'last_login' => $admin->updated_at?->format('d M Y H:i') ?? '-',
            ];
        });
    }

    // MONITORING OMSET TEKNISI (Hanya Biaya Jasa, bukan part)
    public function getTechnicianPerformanceProperty()
    {
        $teknisis = User::where('role', 'teknisi')->get();

        return $teknisis->map(function ($teknisi) {
            $services = Service::where('user_id', $teknisi->id)
                ->where('service_type', 'REGULER')
                ->whereIn('status', ['Done', 'Taken'])
                ->whereMonth('created_at', $this->month)
                ->whereYear('created_at', $this->year);

            $jumlahServis = (clone $services)->count();
            // Gunakan estimated_cost untuk biaya jasa saja (bukan termasuk part)
            $totalJasa = (clone $services)->sum('estimated_cost');

            return [
                'id' => $teknisi->id,
                'name' => $teknisi->name,
                'jumlah_servis' => $jumlahServis,
                'total_jasa' => $totalJasa,
                'rata_rata' => $jumlahServis > 0 ? round($totalJasa / $jumlahServis) : 0,
            ];
        });
    }

    // MONITORING SERVIS REGULER (READ ONLY)
    public function getServisRegulerProperty()
    {
        return Service::with(['customer', 'user'])
            ->where('service_type', 'REGULER')
            ->whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();
    }

    // MONITORING SERVIS GARANSI (READ ONLY)
    public function getServisGaransiProperty()
    {
        return Service::with(['customer', 'user'])
            ->where('service_type', 'AUTHORIZED')
            ->whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();
    }

    // LOG AKTIVITAS SISTEM
    public function getActivityLogsProperty()
    {
        return ServiceLog::with(['user', 'service.customer'])
            ->whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->orderBy('created_at', 'desc')
            ->limit(100)
            ->get();
    }

    public function render()
    {
        return view('livewire.super-admin.dashboard', [
            'globalStats' => $this->globalStats,
            'adminPerformance' => $this->adminPerformance,
            'technicianPerformance' => $this->technicianPerformance,
            'servisReguler' => $this->servisReguler,
            'servisGaransi' => $this->servisGaransi,
            'activityLogs' => $this->activityLogs,
        ]);
    }
}
