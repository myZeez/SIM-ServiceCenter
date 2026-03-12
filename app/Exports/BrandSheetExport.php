<?php

namespace App\Exports;

use App\Models\Service;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class BrandSheetExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths, WithStyles, WithColumnFormatting, WithTitle
{
    protected $brandId;
    protected $brandName;
    protected $month;
    protected $year;
    protected $search;
    private $rowNumber = 0;

    public function __construct($brandId, $brandName, $month, $year, $search = '')
    {
        $this->brandId   = $brandId;
        $this->brandName = $brandName;
        $this->month     = $month;
        $this->year      = $year;
        $this->search    = $search;
    }

    public function title(): string
    {
        // Sheet names: max 31 chars, no invalid chars
        return substr(preg_replace('/[\/\\\?\*\[\]:)(\']/', '', $this->brandName), 0, 31);
    }

    public function collection()
    {
        return Service::with(['user', 'customer', 'brand'])
            ->where('service_type', 'AUTHORIZED')
            ->where('status', 'Taken')
            ->whereNotNull('taken_at')
            ->whereMonth('taken_at', $this->month)
            ->whereYear('taken_at', $this->year)
            ->when($this->brandId, fn($q) => $q->where('brand_id', $this->brandId))
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
            'Brand',
            'Tipe Laptop',
            'Perbaikan',
            'Status',
            'Biaya User (Rp)',
            'ADP',
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
            $service->brand->name ?? '-',
            $service->device_name,
            $service->diagnosis_result ?: '-',
            $service->status == 'Done' ? 'Selesai' : 'Diambil',
            $service->has_adp ? (float) $service->total_cost : 0,
            $service->has_adp ? 'Ya' : 'Tidak',
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
            'A' => 5,
            'B' => 25,
            'C' => 18,
            'D' => 14,
            'E' => 25,
            'F' => 35,
            'G' => 12,
            'H' => 18,
            'I' => 10,
            'J' => 20,
            'K' => 18,
            'L' => 18,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_TEXT,
            'H' => '#,##0',
        ];
    }
}
