<?php

namespace App\Livewire\Dashboard;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Service;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;

class ServiceForm extends Component
{
    // Customer fields
    public $search = '';
    public $selectedCustomer = null;
    public $customerId = null;
    public $customerName = '';
    public $customerPhone = '';
    public $customerAddress = '';
    public $showCustomerResults = false;
    public $customerResults = [];
    public $bookingResults = [];

    // Service fields
    public $deviceName = '';
    public $serialNumber = '';
    public $complaint = '';
    public $serviceType = 'REGULER';
    public $rmaNumber = '';

    // Selected booking data
    public $selectedBookingId = null;

    // Service Selection fields
    public $selectedServiceCategoryId = null;
    public $selectedServiceItems = [];
    public $availableCategories = [];
    public $availableServicesData = [];

    // Confirmation modal
    public $showConfirmModal = false;
    public $savedTicketNumber = '';

    protected $rules = [
        'customerName' => 'required|string|max:255',
        'customerPhone' => 'required|string|max:20',
        'customerAddress' => 'nullable|string',
        'deviceName' => 'required|string|max:255',
        'complaint' => 'nullable|string',
        'serviceType' => 'required|in:REGULER,AUTHORIZED',
    ];

    public function mount()
    {
        $this->availableCategories = \App\Models\ServiceCategory::where('is_active', true)->orderBy('order_column')->get();
    }

    public function updatedSelectedServiceCategoryId($value)
    {
        $this->selectedServiceItems = [];
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

    public function updatedSearch($value)
    {
        if (strlen($value) >= 2) {
            // Search from Booking table (priority - from Expert System diagnosis)
            $this->bookingResults = Booking::where('status', 'pending')
                ->where(function ($query) use ($value) {
                    $query->where('name', 'like', '%' . $value . '%')
                        ->orWhere('phone', 'like', '%' . $value . '%')
                        ->orWhere('booking_code', 'like', '%' . $value . '%');
                })
                ->whereDate('created_at', '>=', now()->subWeek()) // Only bookings within 1 week
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            // Also search from Customer table
            $this->customerResults = Customer::where('name', 'like', '%' . $value . '%')
                ->orWhere('phone', 'like', '%' . $value . '%')
                ->limit(5)
                ->get();

            $this->showCustomerResults = true;
        } else {
            $this->showCustomerResults = false;
            $this->customerResults = [];
            $this->bookingResults = [];
        }
    }

    public function selectBooking($bookingId)
    {
        $booking = Booking::find($bookingId);
        if ($booking) {
            $this->selectedBookingId = $booking->id;
            $this->customerName = $booking->name;
            $this->customerPhone = $booking->phone;
            $this->customerAddress = $booking->address;
            $this->deviceName = trim($booking->device_brand . ' ' . $booking->device_name);
            $this->serialNumber = $booking->serial_number ?? '';
            $this->complaint = $booking->complaint;
            $this->search = $booking->name . ' (' . $booking->booking_code . ')';
            $this->showCustomerResults = false;

            // Handle service category and items, and clean up the complaint
            $this->selectedServiceCategoryId = null;
            $this->selectedServiceItems = [];

            $dr = is_string($booking->diagnosis_result) ? json_decode($booking->diagnosis_result, true) : $booking->diagnosis_result;

            if ($dr && is_array($dr) && isset($dr['type']) && $dr['type'] === 'service_inquiry') {
                if (!empty($dr['category'])) {
                    $cat = collect($this->availableCategories)->firstWhere('slug', $dr['category']);
                    if ($cat) {
                        $this->selectedServiceCategoryId = $cat->id;
                        $this->updatedSelectedServiceCategoryId($cat->id);
                    }
                }

                if (!empty($dr['service_items']) && is_array($dr['service_items'])) {
                    $this->selectedServiceItems = collect($dr['service_items'])->map(function($item) {
                        // Some may be strictly "Label (Price)" format
                        return $item;
                    })->toArray();
                } else {
                    // Fallback to parse the complaint text for "Layanan Dipilih:" lines
                    if (preg_match('/Layanan Dipilih:\s*\n*((?:-\s.*?\n*)+)/s', $this->complaint, $linesMatch)) {
                        $lines = explode("\n", trim($linesMatch[1]));
                        $parsedItems = [];
                        foreach($lines as $line) {
                            $cleanLine = trim(preg_replace('/^-\s*/', '', $line));
                            if ($cleanLine && !str_starts_with($cleanLine, 'Catatan:') && !str_starts_with($cleanLine, 'Keluhan/Layanan Tambahan:')) {
                                $parsedItems[] = $cleanLine;
                            }
                        }
                        if (!empty($parsedItems)) {
                            $this->selectedServiceItems = $parsedItems;
                        }
                    }
                }

                // Clean the complaint string for the admin view
                if (preg_match('/(Keluhan\/Layanan Tambahan:|Catatan:)\s*(.*)/is', $this->complaint, $matches)) {
                    $this->complaint = trim($matches[2]);
                } elseif (strpos($this->complaint, '[Tanya Dulu]') !== false) {
                    $this->complaint = '';
                }
            }

            // Check if customer already exists by phone
            $existingCustomer = Customer::where('phone', $booking->phone)->first();
            if ($existingCustomer) {
                $this->customerId = $existingCustomer->id;
            }
        }
    }

    public function selectCustomer($customerId)
    {
        $customer = Customer::find($customerId);
        if ($customer) {
            $this->customerId = $customer->id;
            $this->customerName = $customer->name;
            $this->customerPhone = $customer->phone;
            $this->customerAddress = $customer->address;
            $this->search = $customer->name;
            $this->showCustomerResults = false;
        }
    }

    public function clearCustomer()
    {
        $this->reset(['customerId', 'customerName', 'customerPhone', 'customerAddress', 'search', 'selectedBookingId', 'deviceName', 'serialNumber', 'complaint']);
    }

    public function openConfirmation()
    {
        try {
            $this->validate();
            $this->showConfirmModal = true;
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation failed - errors will be shown in blade
            throw $e;
        }
    }

    public function cancelSave()
    {
        $this->showConfirmModal = false;
    }

    public function saveAndPrint()
    {
        \Log::info('saveAndPrint called');
        $serviceId = $this->performSave();
        \Log::info('Service ID after save: ' . $serviceId);
        if ($serviceId) {
            $this->dispatch('openPrintPage', serviceId: $serviceId);
        }
    }

    public function save()
    {
        \Log::info('save called');
        $this->performSave();
    }

    private function performSave()
    {
        try {
            $this->validate();

            if (empty($this->complaint) && empty($this->selectedServiceItems)) {
                $this->addError('complaint', 'Keluhan atau Pilihan Layanan harus diisi');
                $this->showConfirmModal = false;
                return null;
            }

            // Create or update customer
        if ($this->customerId) {
            $customer = Customer::find($this->customerId);
            $customer->update([
                'name' => $this->customerName,
                'phone' => $this->customerPhone,
                'address' => $this->customerAddress,
            ]);
        } else {
            $customer = Customer::create([
                'name' => $this->customerName,
                'phone' => $this->customerPhone,
                'address' => $this->customerAddress,
            ]);
        }

        // Generate ticket number
        $ticketNumber = 'SRV-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));

        $finalComplaint = $this->complaint;
        if (!empty($this->selectedServiceItems)) {
            $prefix = "Layanan Dipilih:\n- " . implode("\n- ", $this->selectedServiceItems);
            $finalComplaint = $prefix . ($finalComplaint ? "\n\nKeluhan Tambahan: " . $finalComplaint : "");
        }

        // Create service
        $service = Service::create([
            'ticket_number' => $ticketNumber,
            'customer_id' => $customer->id,
            'user_id' => null, // Will be assigned later by admin
            'service_type' => $this->serviceType,
            'rma_number' => $this->serviceType === 'AUTHORIZED' ? $this->rmaNumber : null,
            'device_name' => $this->deviceName,
            'serial_number' => $this->serialNumber,
            'complaint' => $finalComplaint ?: '-',
            'status' => 'Pending',
            'estimated_cost' => 0,
            'total_cost' => 0,
        ]);

                // Create log
        $service->serviceLogs()->create([
            'user_id' => auth()->id(),
            'status' => 'Pending',
            'description' => 'Servis baru diterima / dibuat',
        ]);

        // Auto-add selected services as service cost for REGULER type
        if ($this->serviceType === 'REGULER' && !empty($this->selectedServiceItems)) {
            $totalServiceCosts = 0;

            foreach ($this->selectedServiceItems as $itemStr) {
                $price = 0;

                if (preg_match('/^(.*?)\s*\((.*)\)$/', $itemStr, $matches)) {
                    // Clean price string, matching Rp or just numbers
                    $priceString = preg_replace('/[Rp\s\.]/i', '', $matches[2]);
                    if (is_numeric($priceString)) {
                        $price = (int) $priceString;
                    }
                }

                $totalServiceCosts += $price;
            }

            if ($totalServiceCosts > 0) {
                $service->service_cost = $totalServiceCosts;
                $service->estimated_cost += $totalServiceCosts;
                $service->total_cost += $totalServiceCosts;
                $service->save();
            }
        }

        // Mark booking as confirmed if selected from booking
        if ($this->selectedBookingId) {
            Booking::where('id', $this->selectedBookingId)->update([
                'status' => 'confirmed',
            ]);
        }

        $this->savedTicketNumber = $ticketNumber;
        $this->showConfirmModal = false;

        session()->flash('message', 'Service created successfully! Ticket: ' . $ticketNumber);

        // Reset form
        $this->reset(['deviceName', 'serialNumber', 'complaint', 'serviceType', 'rmaNumber', 'selectedBookingId', 'selectedServiceCategoryId', 'selectedServiceItems', 'availableServicesData']);

        // Emit event to refresh today's services
        $this->dispatch('serviceCreated');

            return $service->id;
        } catch (\Exception $e) {
            $this->showConfirmModal = false;
            session()->flash('error', 'Error: ' . $e->getMessage());
            \Log::error('Service creation error: ' . $e->getMessage());
            return null;
        }
    }

    public function render()
    {
        return view('livewire.dashboard.service-form');
    }
}
