<?php

namespace App\Exports;

use App\Models\Service;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class MonthlyServiceExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths, WithStyles, WithColumnFormatting
{
    protected $month;
    protected $year;
    protected $activeTab;
    protected $search;
    private $rowNumber = 0;

    public function __construct($activeTab, $month, $year, $search = '')
    {
        $this->activeTab = $activeTab;
        $this->month = $month;
        $this->year = $year;
        $this->search = $search;
    }

    public function collection()
    {
        return Service::with(['user', 'customer'])
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
            ->orderBy('taken_at', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama User',
            'No Telp',
            'Tipe Laptop',
            'Perbaikan',
            'Status',
            'Total Biaya',
            'Teknisi',
            'Tanggal Masuk',
            'Tanggal Selesai',
        ];
    }

    public function map($service): array
    {
        $this->rowNumber++;

        return [
            $this->rowNumber,
            $service->customer->name ?? '-',
            $service->customer->phone ?? '-',
            $service->device_name,
            $service->diagnosis_result,
            $service->status == 'Done' ? 'Selesai' : 'Diambil',
            $service->total_cost,
            $service->user->name ?? 'Belum Ditentukan',
            $service->created_at->format('Y-m-d H:i'),
            $service->completed_at ? $service->completed_at->format('Y-m-d H:i') : '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,  // No
            'B' => 25, // Nama
            'C' => 18, // Telp
            'D' => 25, // Device
            'E' => 35, // Diagnosis
            'F' => 12, // Status
            'G' => 18, // Total
            'H' => 20, // Teknisi
            'I' => 18, // Masuk
            'J' => 18, // Selesai
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_TEXT, // Phone number as text
            'G' => '#,##0', // Total Cost formatted
        ];
    }
}
