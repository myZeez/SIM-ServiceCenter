<?php

namespace App\Exports;

use App\Models\Brand;
use App\Models\Service;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AuthorizedServiceExport implements WithMultipleSheets
{
    protected $month;
    protected $year;
    protected $search;
    protected $filterBrandId;

    public function __construct($month, $year, $search = '', $filterBrandId = null)
    {
        $this->month         = $month;
        $this->year          = $year;
        $this->search        = $search;
        $this->filterBrandId = $filterBrandId;
    }

    public function sheets(): array
    {
        $sheets = [];

        if ($this->filterBrandId) {
            // Export only the selected brand
            $brand    = Brand::find($this->filterBrandId);
            $sheets[] = new BrandSheetExport(
                $this->filterBrandId,
                $brand ? $brand->name : 'Brand',
                $this->month,
                $this->year,
                $this->search
            );
        } else {
            // "Semua Brand" summary sheet first
            $sheets[] = new BrandSheetExport(
                null,
                'Semua Brand',
                $this->month,
                $this->year,
                $this->search
            );

            // One sheet per brand that actually has data this month
            $brandIds = Service::where('service_type', 'AUTHORIZED')
                ->where('status', 'Taken')
                ->whereNotNull('taken_at')
                ->whereMonth('taken_at', $this->month)
                ->whereYear('taken_at', $this->year)
                ->whereNotNull('brand_id')
                ->when($this->search, function ($query) {
                    $query->whereHas('customer', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                          ->orWhere('phone', 'like', '%' . $this->search . '%');
                    })
                    ->orWhere('ticket_number', 'like', '%' . $this->search . '%')
                    ->orWhere('device_name', 'like', '%' . $this->search . '%');
                })
                ->distinct()
                ->pluck('brand_id');

            foreach ($brandIds as $brandId) {
                $brand = Brand::find($brandId);
                if ($brand) {
                    $sheets[] = new BrandSheetExport(
                        $brandId,
                        $brand->name,
                        $this->month,
                        $this->year,
                        $this->search
                    );
                }
            }
        }

        return $sheets;
    }
}
