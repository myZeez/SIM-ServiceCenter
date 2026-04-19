<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Service;
use App\Models\Sparepart;
use App\Models\ServiceCategory;
use App\Models\ServiceSparepart;
use App\Models\User;
use App\Services\FonnteService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ServiceProgress extends Component
{
    public $activeTab = 'Pending';
    public $services = [];
    public $selectedService = null;
    public $showDetailModal = false;
    public $type = 'REGULER'; // Default type

    // Status counts for badges
    public $statusCounts = [];

    // Form fields for service update
    public $serviceId;
    public $status;
    public $userId;
    public $diagnosisResult;
    public $rmaNumber; // Added RMA Number
    public $estimatedCost = 0;
    public $totalCost = 0;

    // Service Packages fields
    public $selectedServiceCategoryId = null;
    public $selectedServiceItems = [];
    public $availableCategories = [];
    public $availableServicesData = [];

    // Sparepart fields
    public $sparepartId;
    public $sparepartName = '';
    public $sparepartQty = 1;
    public $sparepartPrice = 0;
    public $spareparts = [];
    public $selectedSpareparts = [];
    public $useManualSparepart = true; // Default to manual input
    public bool $noPartsNeeded = false; // Hanya biaya jasa, tanpa sparepart

    // Garansi / Authorized specific
    public $brands = [];
    public $brandId = null;
    public bool $hasAdp = false;       // Ada biaya ADP dari brand?
    public $adpOriginalCost = 0;       // Biaya asli (brand cover 90%, user 10%)

    // Service description
    public $serviceDescription = '';

    // Additional findings
    public $additionalFindings = '';

    public $teknisis = [];

    protected $rules = [
        'status' => 'required|string',
        'userId' => 'nullable|exists:users,id',
        'diagnosisResult' => 'nullable|string',
        'estimatedCost' => 'nullable|numeric|min:0',
        'totalCost' => 'nullable|numeric|min:0',
    ];

        public function updatedSelectedServiceCategoryId($value)
    {
        if ($value) {
            $category = $this->availableCategories->firstWhere('id', $value);
            if ($category && $category->services_data) {
                $this->availableServicesData = is_string($category->services_data) ? json_decode($category->services_data, true) : $category->services_data;
            } else {
                $this->availableServicesData = [];
            }
        } else {
            $this->availableServicesData = [];
        }
    }

    public function updatedSelectedServiceItems()
    {
        $this->calculateServiceCost();
    }

    public function calculateServiceCost()
    {
        $cost = 0;
        foreach ($this->selectedServiceItems as $itemStr) {
            if (preg_match('/^(.*?)\s*\((.*)\)$/', $itemStr, $matches)) {
                $priceStr = preg_replace('/[^0-9]/', '', $matches[2]);
                $price = $priceStr === '' ? 0 : (int)$priceStr;
                
                // --- Fallback handling untuk data lawas (Tergantung spek) ---
                if ($price === 0) {
                    $itemLabel = strtolower(trim($matches[1]));
                    if (str_contains($itemLabel, 'upgrade ram') || str_contains($itemLabel, 'upgrade ssd')) {
                        $price = 200000;
                    } elseif (str_contains($itemLabel, 'rakit pc')) {
                        $price = 300000;
                    }
                }
                
                $cost += $price;
            }
        }
        $this->estimatedCost = $cost;
        $this->calculateTotalCost();

        // Save automatically back to service cost
        if ($this->selectedService) {
            $this->selectedService->update([
                'service_items' => $this->selectedServiceItems,
                'service_cost'  => $cost
            ]);
            $this->calculateTotalCost(); // to trigger total_cost update in DB
        }
    }

    public function updatedEstimatedCost()
    {
        if (is_numeric($this->estimatedCost)) {
            $this->calculateTotalCost();
            $this->selectedService->refresh();
        }
    }

    public function mount($type = 'REGULER')
    {
        $this->type = $type;
        $this->loadServices();
        $this->loadStatusCounts();
        $this->teknisis = User::where('role', 'teknisi')->where('is_active', true)->get();
        $this->spareparts = Sparepart::where('stock', '>', 0)->get();
        $this->brands = Brand::where('is_active', true)->orderBy('name')->get();
    }

    public function loadStatusCounts()
    {
        $query = Service::where('service_type', $this->type);

        $this->statusCounts = [
            'Pending' => (clone $query)->where('status', 'Pending')->count(),
            'Diagnosis' => (clone $query)->where('status', 'Diagnosis')->count(),
            'In Progress' => (clone $query)->where('status', 'In Progress')->count(),
            'Waiting Part' => (clone $query)->where('status', 'Waiting Part')->count(),
            'Done' => (clone $query)->where('status', 'Done')->count(),
            'Taken' => (clone $query)->where('status', 'Taken')->count(),
        ];
    }

    public function loadServices()
    {
        $this->services = Service::with(['customer', 'user'])
            ->where('service_type', $this->type)
            ->where('status', $this->activeTab)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getTabsProperty()
    {
        if ($this->type === 'AUTHORIZED') {
            return [
                'Pending' => 'Baru Masuk',
                'Diagnosis' => 'Proses',
                'Waiting Part' => 'Waiting Part Vendor',
                'Done' => 'Selesai',
                'Taken' => 'Diambil User'
            ];
        }

        return [
            'Pending' => 'Baru Masuk',
            'Diagnosis' => 'Proses',
            'In Progress' => 'Perbaikan',
            'Done' => 'Selesai',
            'Taken' => 'Diambil User'
        ];
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        $this->loadServices();
        $this->loadStatusCounts();
    }

    public function openDetail($serviceId)
    {
        $this->selectedService = Service::with(['customer', 'user', 'serviceSpareparts.sparepart'])
            ->find($serviceId);

        if ($this->selectedService) {
            $this->serviceId       = $this->selectedService->id;
            $this->status          = $this->selectedService->status;
            $this->userId          = $this->selectedService->user_id;
            $this->diagnosisResult = $this->selectedService->diagnosis_result;
            $this->additionalFindings = $this->selectedService->recommendation;
            $this->rmaNumber       = $this->selectedService->rma_number;
            $this->estimatedCost   = $this->selectedService->estimated_cost;
            $this->selectedServiceItems = $this->selectedService->service_items ?? [];
            $this->availableCategories = ServiceCategory::where('is_active', true)->orderBy('order_column')->get();
            $this->totalCost       = $this->selectedService->total_cost;
            $this->selectedSpareparts = $this->selectedService->serviceSpareparts->toArray();
            $this->noPartsNeeded   = false;
            // Garansi fields
            $this->brandId         = $this->selectedService->brand_id;
            $this->hasAdp          = (bool) $this->selectedService->has_adp;
            $this->adpOriginalCost = $this->selectedService->adp_original_cost ?? 0;
            $this->showDetailModal = true;
        }
    }

    public function closeDetail()
    {
        $this->showDetailModal = false;
        $this->reset(['selectedService', 'serviceId', 'sparepartId', 'sparepartQty', 'sparepartPrice',
            'serviceDescription', 'additionalFindings', 'noPartsNeeded',
            'brandId', 'hasAdp', 'adpOriginalCost']);
    }

    public function updatedSparepartId($value)
    {
        if ($value) {
            $sparepart = Sparepart::find($value);
            if ($sparepart) {
                $this->sparepartName = $sparepart->name;
                $this->sparepartPrice = $sparepart->price;
                $this->sparepartQty = 1;
            }
        }
    }

    public function addSparepart()
    {
        // Validate based on input type
        if ($this->useManualSparepart) {
            $this->validate([
                'sparepartName' => 'required|string|max:255',
                'sparepartQty' => 'required|numeric|min:1',
                'sparepartPrice' => 'required|numeric|min:0',
            ]);

            $price = (int) $this->sparepartPrice;

            // Create manual sparepart entry
            $sparepart = Sparepart::create([
                'name' => $this->sparepartName,
                'code' => 'MAN-' . time() . '-' . rand(100, 999), // Generate unique code
                'stock' => 0, // Manual items don't affect stock
                'price' => $price,
            ]);

            ServiceSparepart::create([
                'service_id' => $this->serviceId,
                'sparepart_id' => $sparepart->id,
                'qty' => $this->sparepartQty,
                'price' => $price,
            ]);
        } else {
            $this->validate([
                'sparepartId' => 'required|exists:spareparts,id',
                'sparepartQty' => 'required|numeric|min:1',
                'sparepartPrice' => 'required|numeric|min:0',
            ]);

            $sparepart = Sparepart::find($this->sparepartId);

            if ($sparepart->stock < $this->sparepartQty) {
                session()->flash('error', 'Stok tidak mencukupi!');
                return;
            }

            // Add to service_spareparts
            ServiceSparepart::create([
                'service_id' => $this->serviceId,
                'sparepart_id' => $this->sparepartId,
                'qty' => $this->sparepartQty,
                'price' => (int) $this->sparepartPrice,
            ]);

            // Update sparepart stock
            $sparepart->decrement('stock', $this->sparepartQty);
        }

        // Recalculate total cost
        $this->noPartsNeeded = false; // Reset to false when adding part
        $this->calculateTotalCost();

        session()->flash('message', 'Sparepart berhasil ditambahkan!');
        $this->reset(['sparepartId', 'sparepartName', 'sparepartQty', 'sparepartPrice']);
        $this->openDetail($this->serviceId); // Refresh
    }

    public function removeSparepart($sparepartServiceId)
    {
        $serviceSparepart = ServiceSparepart::find($sparepartServiceId);

        if ($serviceSparepart) {
            // Return stock
            $serviceSparepart->sparepart->increment('stock', $serviceSparepart->qty);
            $serviceSparepart->delete();

            $this->calculateTotalCost();
            session()->flash('message', 'Sparepart berhasil dihapus!');
            $this->openDetail($this->serviceId); // Refresh
        }
    }

    public function calculateTotalCost()
    {
        $service = Service::find($this->serviceId);

        if ($service->service_type === 'AUTHORIZED') {
            // Garansi: free unless ADP
            if ($this->hasAdp) {
                $originalCost = (float) $this->adpOriginalCost;
                $userShare    = round($originalCost * 0.10); // user pays 10%
            } else {
                $userShare    = 0;
                $originalCost = 0;
            }

            $service->update([
                'total_cost'        => $userShare,
                'estimated_cost'    => $userShare,
                'adp_original_cost' => $originalCost,
                'has_adp'           => $this->hasAdp,
                'brand_id'          => $this->brandId,
            ]);
        } else {
            // Reguler: biaya jasa + sparepart
            $sparepartsCost = $this->noPartsNeeded ? 0 : ServiceSparepart::where('service_id', $this->serviceId)
                ->sum(DB::raw('qty * price'));

            $service->update([
                'total_cost' => $sparepartsCost + $this->estimatedCost,
            ]);
        }

        $this->totalCost = $service->fresh()->total_cost;
        if ($this->selectedService) {
            $this->selectedService->refresh();
        }
    }

    public function updatedHasAdp()
    {
        $this->calculateTotalCost();
    }

    public function updatedAdpOriginalCost()
    {
        if ($this->hasAdp) {
            $this->calculateTotalCost();
        }
    }

    public function updatedNoPartsNeeded()
    {
        if ($this->noPartsNeeded) {
            // Remove all existing spareparts if they check "no parts needed"
            if ($this->serviceId) {
                $serviceSpareparts = ServiceSparepart::where('service_id', $this->serviceId)->get();
                foreach ($serviceSpareparts as $serviceSparepart) {
                    $serviceSparepart->sparepart->increment('stock', $serviceSparepart->qty);
                    $serviceSparepart->delete();
                }
            }
        }
        $this->calculateTotalCost();
    }

    public function saveChanges(): void
    {
        $this->updateStatus($this->status);
    }

    public function updateStatus($newStatus)
    {
        $service = Service::find($this->serviceId);

        if ($service) {
            // First update the cost fields
            $this->calculateTotalCost();

            $completedAt = in_array($newStatus, ['Done', 'Taken'])
                ? ($service->completed_at ?? now())
                : null;

            $takenAt = $newStatus === 'Taken' ? now() : $service->taken_at;

            $updateData = [
                'status'           => $newStatus,
                'user_id'          => $this->userId,
                'diagnosis_result' => $this->diagnosisResult,
                'recommendation'   => $this->additionalFindings,
                'estimated_cost'   => $this->estimatedCost,
                'rma_number'       => $this->rmaNumber,
                'completed_at'     => $completedAt,
                'taken_at'         => $takenAt,
                'brand_id'         => $this->brandId,
            ];

            if ($service->service_type === 'AUTHORIZED') {
                $updateData['has_adp']           = $this->hasAdp;
                $updateData['adp_original_cost'] = $this->adpOriginalCost;
            }

            $service->update($updateData);

            // Create log
            $service->serviceLogs()->create([
                'user_id' => Auth::id(),
                'status' => $newStatus,
                'description' => $this->serviceDescription ?: "Status diubah menjadi {$newStatus}",
            ]);

            $waSent = $this->sendWhatsAppNotification($service->id, false);

            if ($waSent) {
                session()->flash('message', 'Status berhasil diupdate & notifikasi WhatsApp terkirim otomatis.');
            } else {
                session()->flash('message', 'Status berhasil diupdate. Notifikasi WhatsApp belum terkirim (cek konfigurasi Fonnte/token).');
            }

            $this->closeDetail();
            $this->loadServices();
            $this->loadStatusCounts();
        }
    }

    public function sendWhatsAppNotification(?int $serviceId = null, bool $flashResult = true): bool
    {
        $service = $serviceId
            ? Service::with(['customer', 'user'])->find($serviceId)
            : ($this->selectedService ? $this->selectedService->fresh(['customer', 'user']) : null);

        if (!$service || !$service->customer || !$service->customer->phone) {
            if ($flashResult) {
                session()->flash('error', 'Gagal kirim WhatsApp: data customer/nomor belum lengkap.');
            }

            return false;
        }

        $message = $this->buildWhatsAppMessage($service);

        try {
            $result = app(FonnteService::class)->sendMessage($service->customer->phone, $message);

            if ($flashResult) {
                if ($result['success']) {
                    session()->flash('message', 'Notifikasi WhatsApp berhasil dikirim.');
                } else {
                    session()->flash('error', 'Gagal kirim WhatsApp: ' . ($result['message'] ?? 'Unknown error'));
                }
            }

            return (bool) $result['success'];
        } catch (\Throwable $e) {
            Log::error('Fonnte send failed', [
                'service_id' => $service->id,
                'error' => $e->getMessage(),
            ]);

            if ($flashResult) {
                session()->flash('error', 'Gagal kirim WhatsApp: ' . $e->getMessage());
            }

            return false;
        }
    }

    private function buildWhatsAppMessage(Service $service): string
    {
        $customer = $service->customer;

        $statusLabels = [
            'Pending'          => 'Menunggu Antrian',
            'Diagnosis'        => 'Sedang Didiagnosa',
            'In Progress'      => 'Sedang Diperbaiki',
            'Waiting Part'     => 'Menunggu Spare Part',
            'Waiting Approval' => 'Menunggu Persetujuan',
            'Done'             => 'Selesai — Siap Diambil',
            'Taken'            => 'Sudah Diambil',
        ];
        $statusLabel = $statusLabels[$service->status] ?? $service->status;
        $teknisiName = $service->user ? $service->user->name : 'Belum ditentukan';

        $message  = "*🔧 CELLCOM SERVICE CENTER*\n";
        $message .= "━━━━━━━━━━━━━━━━━━━━\n\n";
        $message .= "Halo *{$customer->name}*,\n\n";
        $message .= "Berikut update terbaru servis perangkat Anda:\n\n";

        $message .= "📋 *Informasi Servis*\n";
        $message .= "• Nomor Tiket : *{$service->ticket_number}*\n";
        $message .= "• Perangkat   : {$service->device_name}\n";
        $message .= "• Teknisi     : {$teknisiName}\n";
        $message .= "• Status      : *{$statusLabel}*\n\n";

        if ($service->diagnosis_result) {
            $message .= "🔍 *Hasil Diagnosis*\n";
            $message .= "{$service->diagnosis_result}\n\n";
        }

        if ($service->recommendation) {
            $message .= "💡 *Rekomendasi / Solusi*\n";
            $message .= "{$service->recommendation}\n\n";
        }

        if ($service->total_cost > 0) {
            $message .= "💰 *Estimasi Biaya*\n";
            $message .= "Rp " . number_format($service->total_cost, 0, ',', '.') . "\n";
            $message .= "_*Biaya dapat berubah sesuai kondisi aktual perangkat._\n\n";
        }

        $message .= "━━━━━━━━━━━━━━━━━━━━\n";
        $message .= "Terima kasih telah mempercayai layanan *Cellcom*.\n";
        $message .= "Hubungi kami jika ada pertanyaan lebih lanjut. 🙏";

        return $message;
    }

    public function getStatusColor($status)
    {
        return match($status) {
            'Pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
            'Diagnosis' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
            'In Progress' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300',
            'Done' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
            'Taken' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
            default => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
        };
    }

    public function getStatusesProperty()
    {
        if ($this->type === 'AUTHORIZED') {
            return [
                'Pending' => 'Baru Masuk',
                'Diagnosis' => 'Proses',
                'Waiting Part' => 'Waiting Part Vendor',
                'Done' => 'Ready (Selesai)',
                'Taken' => 'Diambil User'
            ];
        }

        return [
            'Pending' => 'Baru Masuk',
            'Diagnosis' => 'Proses Diagnosis',
            'In Progress' => 'Sedang Dikerjakan',
            'Done' => 'Selesai',
            'Taken' => 'Diambil User'
        ];
    }

    public function render()
    {
        return view('livewire.service-progress');
    }
}
