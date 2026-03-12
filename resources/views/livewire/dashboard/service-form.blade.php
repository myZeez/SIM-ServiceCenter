<div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6 animate-fade-in">
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('openPrintPage', (event) => {
                window.open('/service/' + event.serviceId + '/print', '_blank');
            });
        });
    </script>

    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100 dark:border-gray-800">
        <div class="w-9 h-9 rounded-xl bg-primary-50 dark:bg-primary-900/30 flex items-center justify-center flex-shrink-0">
            <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
        </div>
        <div>
            <h3 class="text-base font-bold text-gray-900 dark:text-white leading-none">Input Servis Baru</h3>
            <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">Catat unit servis yang masuk</p>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-xl animate-scale-in">
            <div class="flex items-center gap-2 text-green-800 dark:text-green-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">{{ session('message') }}</span>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-xl animate-scale-in">
            <div class="flex items-center gap-2 text-red-800 dark:text-red-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-xl animate-scale-in">
            <div class="flex items-start gap-2 text-red-800 dark:text-red-200">
                <svg class="w-5 h-5 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="font-semibold mb-1">Ada kesalahan dalam form:</p>
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form wire:submit.prevent="openConfirmation" class="space-y-5">
        <!-- Customer Search/Select -->
        <div class="relative">
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                Cari Pelanggan
            </label>
            <div class="relative">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Ketik nama atau nomor HP..."
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200"
                >
                <svg class="absolute right-3 top-3.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>

            @if($showCustomerResults && (count($bookingResults) > 0 || count($customerResults) > 0))
                <div class="absolute z-10 w-full mt-2 bg-white dark:bg-gray-700 rounded-xl shadow-xl border border-gray-200 dark:border-gray-600 max-h-80 overflow-y-auto animate-scale-in">
                    {{-- Booking Results (Priority) --}}
                    @if(count($bookingResults) > 0)
                        <div class="px-3 py-2 bg-blue-50 dark:bg-blue-900/30 border-b border-gray-200 dark:border-gray-600">
                            <span class="text-xs font-bold text-blue-600 dark:text-blue-400 uppercase tracking-wide">📋 Dari Booking Diagnosis</span>
                        </div>
                        @foreach($bookingResults as $booking)
                            <button
                                type="button"
                                wire:click="selectBooking({{ $booking->id }})"
                                class="w-full text-left px-4 py-3 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors border-b border-gray-100 dark:border-gray-600"
                            >
                                <div class="flex items-center justify-between mb-1">
                                    <span class="font-semibold text-gray-800 dark:text-white">{{ $booking->name }}</span>
                                    <span class="text-xs px-2 py-0.5 bg-blue-100 dark:bg-blue-800 text-blue-700 dark:text-blue-200 rounded-full font-mono">{{ $booking->booking_code }}</span>
                                </div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">{{ $booking->phone }} • {{ $booking->device_brand }} {{ $booking->device_name }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-500 mt-1 truncate">{{ Str::limit($booking->complaint, 50) }}</div>
                            </button>
                        @endforeach
                    @endif

                    {{-- Customer Results --}}
                    @if(count($customerResults) > 0)
                        <div class="px-3 py-2 bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-600">
                            <span class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide">👤 Pelanggan Terdaftar</span>
                        </div>
                        @foreach($customerResults as $customer)
                            <button
                                type="button"
                                wire:click="selectCustomer({{ $customer->id }})"
                                class="w-full text-left px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors border-b border-gray-100 dark:border-gray-600 last:border-0"
                            >
                                <div class="font-semibold text-gray-800 dark:text-white">{{ $customer->name }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">{{ $customer->phone }}</div>
                            </button>
                        @endforeach
                    @endif
                </div>
            @endif
        </div>

        @if($selectedBookingId)
            <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-xl flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <span class="text-sm font-medium text-blue-800 dark:text-blue-200">Data dari Booking Diagnosis: {{ $customerName }}</span>
                </div>
                <button type="button" wire:click="clearCustomer" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        @elseif($customerId)
            <div class="p-3 bg-green-50 dark:bg-green-900/20 rounded-xl flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-sm font-medium text-green-800 dark:text-green-200">Pelanggan dipilih: {{ $customerName }}</span>
                </div>
                <button type="button" wire:click="clearCustomer" class="text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        @endif

        <!-- Customer Details -->
        <div class="grid grid-cols-1 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Nama Pelanggan <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    wire:model="customerName"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200"
                    required
                >
                @error('customerName') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Nomor HP <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    wire:model="customerPhone"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200"
                    required
                >
                @error('customerPhone') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Alamat
                </label>
                <textarea
                    wire:model="customerAddress"
                    rows="2"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200"
                ></textarea>
            </div>
        </div>

        <div class="border-t border-gray-200 dark:border-gray-600 pt-4"></div>

        <!-- Service Details -->
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Nama Perangkat <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    wire:model="deviceName"
                    placeholder="Contoh: iPhone 13 Pro"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200"
                    required
                >
                @error('deviceName') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Serial Number
                </label>
                <input
                    type="text"
                    wire:model="serialNumber"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200"
                >
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Keluhan <span class="text-red-500">*</span>
                </label>
                <textarea
                    wire:model="complaint"
                    rows="3"
                    placeholder="Jelaskan keluhan atau masalah perangkat..."
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200"
                    required
                ></textarea>
                @error('complaint') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                    Tipe Servis <span class="text-red-500">*</span>
                </label>
                <div class="grid grid-cols-2 gap-3">
                    <label class="relative cursor-pointer">
                        <input
                            type="radio"
                            wire:model.live="serviceType"
                            value="REGULER"
                            name="serviceType"
                            class="peer sr-only"
                        >
                        <div class="px-4 py-3 rounded-xl border-2 border-gray-300 dark:border-gray-600 peer-checked:border-primary-500 peer-checked:bg-primary-50 dark:peer-checked:bg-primary-900/20 transition-all duration-200 text-center font-semibold text-gray-700 dark:text-gray-300 peer-checked:text-primary-700 dark:peer-checked:text-primary-400">
                            REGULER
                        </div>
                    </label>
                    <label class="relative cursor-pointer">
                        <input
                            type="radio"
                            wire:model.live="serviceType"
                            value="AUTHORIZED"
                            name="serviceType"
                            class="peer sr-only"
                        >
                        <div class="px-4 py-3 rounded-xl border-2 border-gray-300 dark:border-gray-600 peer-checked:border-primary-500 peer-checked:bg-primary-50 dark:peer-checked:bg-primary-900/20 transition-all duration-200 text-center font-semibold text-gray-700 dark:text-gray-300 peer-checked:text-primary-700 dark:peer-checked:text-primary-400">
                            AUTHORIZED
                        </div>
                    </label>
                </div>
            </div>

            @if($serviceType === 'AUTHORIZED')
                <!-- RMA Number to be input during process -->
                <div class="animate-scale-in p-4 bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 rounded-xl border border-blue-200 dark:border-blue-800 text-sm">
                    <p class="font-semibold">Info:</p>
                    <p>Nomor Tiket Vendor / RMA akan diinput saat status servis diubah menjadi "Proses" atau "Diagnosis".</p>
                </div>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <button
                type="submit"
                class="w-full bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-bold py-4 px-6 rounded-xl transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl flex items-center justify-center gap-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Simpan & Buat Tiket
            </button>
        </div>
    </form>

    <!-- Confirmation Modal -->
    @if($showConfirmModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data="{ show: @entangle('showConfirmModal') }">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity"></div>

            <!-- Modal -->
            <div class="flex min-h-screen items-center justify-center p-4">
                <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-md w-full p-6 animate-scale-in border border-gray-200 dark:border-gray-700">
                    <!-- Icon -->
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-primary-100 dark:bg-primary-900/30 mb-4">
                        <svg class="h-8 w-8 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>

                    <!-- Content -->
                    <div class="text-center mb-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                            Yakin Menyimpan Data?
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Data servis akan disimpan dan tiket akan dibuat.
                        </p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col gap-3">
                        <!-- Simpan dan Cetak -->
                        <button
                            type="button"
                            wire:click="saveAndPrint"
                            wire:loading.attr="disabled"
                            class="w-full bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-bold py-3 px-6 rounded-xl transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <svg wire:loading.remove class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                            </svg>
                            <svg wire:loading class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span wire:loading.remove>Ya!! Simpan dan Cetak</span>
                            <span wire:loading>Menyimpan...</span>
                        </button>

                        <!-- Batalkan -->
                        <button
                            type="button"
                            wire:click="cancelSave"
                            class="w-full bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-semibold py-3 px-6 rounded-xl transition-all duration-200"
                        >
                            Batalkan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
