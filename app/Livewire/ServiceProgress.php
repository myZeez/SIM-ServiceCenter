<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Service;
use App\Models\Sparepart;
use App\Models\ServiceSparepart;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

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
            $this->rmaNumber       = $this->selectedService->rma_number;
            $this->estimatedCost   = $this->selectedService->estimated_cost;
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
                ->sum(\DB::raw('qty * price'));

            $service->update([
                'total_cost' => $sparepartsCost + $this->estimatedCost,
            ]);
        }

        $this->totalCost = $service->fresh()->total_cost;
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
                'user_id' => auth()->id(),
                'status' => $newStatus,
                'description' => $this->serviceDescription ?: "Status diubah menjadi {$newStatus}",
            ]);

            session()->flash('message', 'Status berhasil diupdate!');
            $this->closeDetail();
            $this->loadServices();
            $this->loadStatusCounts();
        }
    }

    public function sendWhatsAppNotification()
    {
        if (!$this->selectedService) return;

        $customer = $this->selectedService->customer;
        $phone = $customer->phone;

        // Format phone number (remove leading 0, add 62)
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        $message = "*CELLCOM SERVICE CENTER*\n\n";
        $message .= "Halo {$customer->name},\n\n";
        $message .= "Update servis Anda:\n";
        $message .= "Tiket: {$this->selectedService->ticket_number}\n";
        $message .= "Device: {$this->selectedService->device_name}\n";
        $message .= "Status: {$this->selectedService->status}\n\n";

        if ($this->selectedService->diagnosis_result) {
            $message .= "Diagnosa:\n{$this->selectedService->diagnosis_result}\n\n";
        }

        if ($this->selectedService->total_cost > 0) {
            $message .= "Total Biaya: Rp " . number_format($this->selectedService->total_cost, 0, ',', '.') . "\n\n";
        }

        $message .= "Terima kasih telah mempercayai layanan kami.";

        $whatsappUrl = "https://wa.me/{$phone}?text=" . urlencode($message);

        $this->dispatch('openWhatsApp', url: $whatsappUrl);
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
