<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Service;
use App\Models\User;
use App\Models\Setting;
use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MonthlyServiceExport;
use App\Exports\AuthorizedServiceExport;

class MonthlyReport extends Component
{
    use WithPagination;

    public $month;
    public $year;
    public $activeTab = 'REGULER'; // REGULER or AUTHORIZED
    public $search = '';
    public $filterBrandId = '';

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

    public function switchTab($tab)
    {
        $this->activeTab    = $tab;
        $this->filterBrandId = '';
        $this->resetPage();
    }

    public function updatedFilterBrandId()
    {
        $this->resetPage();
    }

    public function getAvailableBrandsProperty()
    {
        return Brand::whereHas('services', function ($q) {
            $q->where('service_type', 'AUTHORIZED')
              ->whereIn('status', ['Done', 'Taken'])
              ->whereNotNull('taken_at')
              ->whereMonth('taken_at', $this->month)
              ->whereYear('taken_at', $this->year);
        })->orderBy('name')->get();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedMonth()
    {
        $this->resetPage();
    }

    public function updatedYear()
    {
        $this->resetPage();
    }

    public function exportExcel()
    {
        $fileName = 'Laporan_Servis_' . $this->activeTab . '_' . $this->months[$this->month] . '_' . $this->year . '.xlsx';

        if ($this->activeTab === 'AUTHORIZED') {
            return Excel::download(new AuthorizedServiceExport(
                $this->month,
                $this->year,
                $this->search,
                $this->filterBrandId ?: null
            ), $fileName);
        }

        return Excel::download(new MonthlyServiceExport(
            $this->activeTab,
            $this->month,
            $this->year,
            $this->search
        ), $fileName);
    }

    private function getQuery()
    {
        return Service::with(['user', 'customer', 'serviceSpareparts.sparepart'])
            ->where('service_type', $this->activeTab)
            ->where('status', 'Taken')
            ->whereNotNull('taken_at')
            ->whereMonth('taken_at', $this->month)
            ->whereYear('taken_at', $this->year)
            ->when($this->search, function ($query) {
                $query->whereHas('customer', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('phone', 'like', '%' . $this->search . '%');
                })
                ->orWhere('ticket_number', 'like', '%' . $this->search . '%')
                ->orWhere('device_name', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterBrandId, fn($q) => $q->where('brand_id', $this->filterBrandId))
            ->orderBy('taken_at', 'desc');
    }

    public function render()
    {
        // Load settings
        $adminFeePerInvoice      = (int) (Setting::where('key', 'admin_fee_per_invoice')->value('value') ?? 20000);
        $techCommissionPercent   = (int) (Setting::where('key', 'technician_commission_percent')->value('value') ?? 50);

        // Fetch query for this block
        $query = $this->getQuery();

        // Calculate Summary (All matching data before pagination)
        $allServices = (clone $query)->with('brand')->get();

        $totalOmsetKotor = 0;
        $totalSparepart  = 0;
        $totalJasaMurni  = 0;
        $totalAdminFee   = 0;

        $technicianReports = [];
        $brandReports      = [];   // For AUTHORIZED tab

        foreach ($allServices as $service) {
            if ($this->activeTab === 'REGULER') {
                $sparepartCost = $service->serviceSpareparts->sum(fn($i) => $i->price * $i->qty);
                $laborCost     = $service->estimated_cost;
                $totalCost     = $service->total_cost;

                $totalOmsetKotor += $totalCost;
                $totalSparepart  += $sparepartCost;
                $totalJasaMurni  += $laborCost;
                $totalAdminFee   += $adminFeePerInvoice;

                if ($service->user) {
                    $techId  = $service->user->id;
                    $techFee = ($laborCost * $techCommissionPercent) / 100;

                    if (!isset($technicianReports[$techId])) {
                        $technicianReports[$techId] = [
                            'name'             => $service->user->name,
                            'service_count'    => 0,
                            'total_jasa'       => 0,
                            'total_omset'      => 0,
                            'total_commission' => 0,
                        ];
                    }
                    $technicianReports[$techId]['service_count']++;
                    $technicianReports[$techId]['total_jasa']       += $laborCost;
                    $technicianReports[$techId]['total_omset']      += $totalCost;
                    $technicianReports[$techId]['total_commission']  += $techFee;
                }
            } else {
                // AUTHORIZED — biaya bervariasi: gratis atau 10% ADP
                $userCost        = $service->total_cost; // 0 if no ADP, 10% if ADP
                $originalCost    = $service->adp_original_cost;
                $brandCoverage   = $originalCost - $userCost;

                $totalOmsetKotor += $userCost;

                // Group by brand
                $brandKey  = $service->brand_id ?? 0;
                $brandName = $service->brand->name ?? 'Tidak Diketahui';

                if (!isset($brandReports[$brandKey])) {
                    $brandReports[$brandKey] = [
                        'name'          => $brandName,
                        'count'         => 0,
                        'adp_count'     => 0,
                        'user_cost'     => 0,   // total yang dibayar user
                        'brand_cost'    => 0,   // total yang ditanggung brand
                        'original_cost' => 0,   // biaya asli sebelum ADP
                    ];
                }
                $brandReports[$brandKey]['count']++;
                if ($service->has_adp) {
                    $brandReports[$brandKey]['adp_count']++;
                    $brandReports[$brandKey]['user_cost']     += $userCost;
                    $brandReports[$brandKey]['brand_cost']    += $brandCoverage;
                    $brandReports[$brandKey]['original_cost'] += $originalCost;
                }
            }
        }

        // Fetch Paginated Data for Table
        $services = $query->with('brand')->paginate(10);

        return view('livewire.monthly-report', [
            'services'         => $services,
            'technicianReports'=> $technicianReports,
            'brandReports'     => $brandReports,
            'summary' => [
                'total_omset'   => $totalOmsetKotor,
                'total_sparepart'=> $totalSparepart,
                'total_jasa'    => $totalJasaMurni,
                'total_admin'   => $totalAdminFee,
                'admin_rate'    => $adminFeePerInvoice,
                'count'         => $allServices->count(),
            ],
        ]);
    }
}
