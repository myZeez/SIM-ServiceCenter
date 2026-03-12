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
            $this->service = Service::with(['customer', 'user', 'serviceLogs.user'])
                ->where('ticket_number', $query)
                ->first();

            // Fall back to booking code (BK-...)
            if (!$this->service) {
                $this->booking = Booking::where('booking_code', $query)->first();
            }
        } else {
            // Phone search: check service customer
            $customer = Customer::where('phone', $query)->first();
            if ($customer) {
                $this->service = Service::with(['customer', 'user', 'serviceLogs.user'])
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
