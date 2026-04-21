<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Service;
use Livewire\Component;

class ServiceStatus extends Component
{
    public string $search = '';

    public string $searchType = 'ticket'; // 'ticket' | 'phone'

    public ?Service $service = null;

    public ?Booking $booking = null;

    public bool $searched = false;

    public string $errorMessage = '';

    public function check(): void
    {
        // Rate limiting: 10 checks per minute per IP
        if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts('check-status:'.request()->ip(), 10)) {
            $seconds = \Illuminate\Support\Facades\RateLimiter::availableIn('check-status:'.request()->ip());
            $this->errorMessage = 'Terlalu banyak permintaan untuk cek status. Silakan coba lagi dalam ' . ceil($seconds) . ' detik.';
            $this->searched = true;
            return;
        }

        \Illuminate\Support\Facades\RateLimiter::hit('check-status:'.request()->ip(), 60);

        $this->errorMessage = '';
        $this->service = null;
        $this->booking = null;
        $this->searched = true;

        $query = trim($this->search);

        if (!$query) {
            $this->errorMessage = 'Masukkan nomor tiket atau nomor HP terlebih dahulu.';
            return;
        }

        if ($this->searchType === 'ticket') {
            // Try service ticket first
            $this->service = Service::with(['customer', 'user', 'serviceLogs.user', 'serviceSpareparts.sparepart'])
                ->where('ticket_number', $query)
                ->first();

            // Fall back to booking code (BK-...)
            if (!$this->service) {
                $this->booking = Booking::where('booking_code', $query)->first();

                // If booking is found, check if a Service was created for this same phone number recently
                if ($this->booking && in_array($this->booking->status, ['confirmed', 'in_progress', 'completed'])) {
                    $customer = Customer::where('phone', $this->booking->phone)->first();
                    if ($customer) {
                        // Find a service created after the booking
                        $relatedService = Service::with(['customer', 'user', 'serviceLogs.user', 'serviceSpareparts.sparepart'])
                            ->latest()
                            ->first();

                        if ($relatedService) {
                            $this->service = $relatedService;
                            $this->booking = null; // Prioritize showing the service
                        }
                    }
                }
            }
        } else {
            // Phone search: check service customer
            $customer = Customer::where('phone', $query)->first();
            if ($customer) {
                $this->service = Service::with(['customer', 'user', 'serviceLogs.user', 'serviceSpareparts.sparepart'])
                    ->where('customer_id', $customer->id)
                    ->latest()
                    ->first();
            }

            // Also check booking by phone
            if (!$this->service) {
                $this->booking = Booking::where('phone', $query)->latest()->first();
            }
        }

        if (!$this->service && !$this->booking) {
            $this->errorMessage = 'Data tidak ditemukan. Periksa kembali nomor yang Anda masukkan.';
        }
    }

    public function resetSearch(): void
    {
        $this->search = '';
        $this->service = null;
        $this->booking = null;
        $this->searched = false;
        $this->errorMessage = '';
        $this->searchType = 'ticket';
    }

    public function render()
    {
        return view('livewire.service-status')
            ->layout('layouts.diagnosis');
    }
}
