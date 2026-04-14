<div class="animate-fade-in">
    <!-- Header -->
    <div class="mb-5">
        <h2 class="text-lg font-bold text-gray-900 dark:text-white">
            {{ $type === 'REGULER' ? 'Progress Servis Reguler' : 'Progress Servis Garansi (Authorized)' }}
        </h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">
            {{ $type === 'REGULER' ? 'Menampilkan seluruh unit servis REGULER' : 'Monitoring khusus unit klaim garansi vendor' }}
        </p>
    </div>

    <!-- Tabs Navigation -->
    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-2 mb-5">
        <div class="flex gap-1 overflow-x-auto scrollbar-thin">
            @foreach($this->tabs as $status => $label)
                <button
                    type="button"
                    wire:click="switchTab('{{ $status }}')"
                    class="px-6 py-3 rounded-xl font-semibold text-sm transition-all duration-200 whitespace-nowrap cursor-pointer
                        {{ $activeTab === $status
                            ? 'bg-gradient-to-r from-primary-600 to-primary-700 text-white shadow-lg'
                            : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'
                        }}"
                >
                    {{ $label }}
                    <span class="ml-2 px-2 py-0.5 rounded-full text-xs font-bold
                        {{ $activeTab === $status
                            ? 'bg-white/20'
                            : 'bg-gray-200 dark:bg-gray-600'
                        }}">
                        {{ $statusCounts[$status] ?? 0 }}
                    </span>
                </button>
            @endforeach
        </div>
    </div>

        <!-- Services List -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        @forelse($services as $service)
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm hover:shadow-md transition-shadow overflow-hidden group">
                <!-- Header -->
                <div class="p-5 bg-gray-50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-800">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <h3 class="font-bold text-lg text-gray-800 dark:text-white">{{ $service->customer->name }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $service->customer->phone }}</p>
                        </div>
                        <span class="px-3 py-1 rounded-lg text-xs font-bold {{ $this->getStatusColor($service->status) }}">
                            {{ $service->status }}
                        </span>
                    </div>
                    <div class="flex items-center gap-2 text-xs font-mono text-gray-500 dark:text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        {{ $service->ticket_number }}
                    </div>
                    @if($type === 'AUTHORIZED' && $service->rma_number)
                        <div class="mt-1 flex items-center gap-2 text-xs font-mono text-blue-600 dark:text-blue-400">
                            <span class="font-bold">RMA:</span> {{ $service->rma_number }}
                        </div>
                    @endif
                </div>

                <!-- Body -->
                <div class="p-5 space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-primary-100 dark:bg-primary-900 flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Device</p>
                            <p class="font-semibold text-gray-800 dark:text-white">{{ $service->device_name }}</p>
                        </div>
                    </div>

                    <div class="pt-3 border-t border-gray-200 dark:border-gray-600">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Keluhan:</p>
                        <p class="text-sm text-gray-700 dark:text-gray-300 line-clamp-2">{{ $service->complaint }}</p>
                    </div>

                    @if($service->user)
                        <div class="flex items-center gap-2 pt-2">
                            <div class="w-6 h-6 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white text-xs font-bold">
                                {{ substr($service->user->name, 0, 1) }}
                            </div>
                            <span class="text-xs text-gray-600 dark:text-gray-400">Teknisi: {{ $service->user->name }}</span>
                        </div>
                    @endif

                    @if($service->total_cost > 0)
                        <div class="pt-3 border-t border-gray-200 dark:border-gray-600">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Total Biaya</p>
                            <p class="text-lg font-bold text-primary-600 dark:text-primary-400">
                                Rp {{ number_format($service->total_cost, 0, ',', '.') }}
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Footer -->
                <div class="px-5 pb-5">
                    <button
                        wire:click="openDetail({{ $service->id }})"
                        class="w-full bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-200 flex items-center justify-center gap-2 shadow-lg hover:shadow-xl"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        Detail & Update
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-12 text-center">
                    <svg class="w-20 h-20 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-700 dark:text-gray-300 mb-2">Tidak ada servis</h3>
                    <p class="text-gray-500 dark:text-gray-400">Belum ada servis dengan status "{{ $activeTab }}"</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Detail Modal -->
    @if($showDetailModal && $selectedService)
        <div
            x-data
            x-on:keydown.escape.window="$wire.closeDetail()"
            class="fixed inset-0 z-50 overflow-y-auto"
            aria-labelledby="modal-title"
            role="dialog"
            aria-modal="true"
        >
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                <!-- Background overlay -->
                <div
                    class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75 backdrop-blur-sm"
                    wire:click="closeDetail"
                    aria-hidden="true"
                ></div>

                <!-- Modal panel -->
                <div class="relative inline-block w-full max-w-4xl my-8 text-left align-middle transition-all transform bg-white dark:bg-gray-900 shadow-2xl rounded-2xl animate-scale-in flex flex-col max-h-[90vh]">

                    <!-- Header -->
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 rounded-t-2xl shrink-0">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-50" id="modal-title">Detail Servis</h3>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-sm font-mono text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-900 px-2 py-0.5 rounded border border-gray-200 dark:border-gray-700">{{ $selectedService->ticket_number }}</span>
                                <span class="text-xs font-semibold px-2 py-0.5 rounded-full {{ $this->getStatusColor($selectedService->status) }}">{{ $selectedService->status }}</span>
                            </div>
                        </div>
                        <button wire:click="closeDetail" class="p-2 text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors focus:outline-none">
                            <span class="sr-only">Close</span>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Content (Scrollable Body) -->
                    <div class="p-6 overflow-y-auto flex-1 bg-white dark:bg-gray-900">
                        <!-- Customer & Device Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div class="bg-gray-50 dark:bg-gray-900 p-5 rounded-xl border border-gray-200 dark:border-white/10">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg text-blue-600 dark:text-blue-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </div>
                                    <h4 class="font-semibold text-gray-900 dark:text-gray-50">Informasi Pelanggan</h4>
                                </div>
                                <div class="space-y-1">
                                    <p class="font-bold text-lg text-gray-900 dark:text-white">{{ $selectedService->customer->name }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $selectedService->customer->phone }}</p>
                                </div>
                            </div>

                            <div class="bg-gray-50 dark:bg-gray-900 p-5 rounded-xl border border-gray-200 dark:border-white/10">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg text-purple-600 dark:text-purple-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <h4 class="font-semibold text-gray-900 dark:text-gray-50">Detail Perangkat</h4>
                                </div>
                                <div class="space-y-1">
                                    <p class="font-bold text-lg text-gray-900 dark:text-white">{{ $selectedService->device_name }}</p>
                                    @if($selectedService->serial_number)
                                        <p class="text-sm font-mono text-gray-500 dark:text-gray-500">{{ $selectedService->serial_number }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Complaint -->
                         <div class="mb-8">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Keluhan / Kerusakan Awal</label>
                            <div class="bg-amber-50 dark:bg-amber-900/10 text-amber-900 dark:text-amber-100 p-4 rounded-xl border border-amber-200 dark:border-amber-800/30 text-base leading-relaxed">
                                {{ $selectedService->complaint }}
                            </div>
                        </div>

                        <div class="border-t border-gray-200 dark:border-white/10 my-6"></div>

                        {{-- ===== REGULER: Sparepart & Cost section ===== --}}
                        @if($selectedService->service_type === 'REGULER')
                        <div class="mb-8">
                            <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                <span class="bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 p-1.5 rounded-lg">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </span>
                                Sparepart & Estimasi Biaya
                            </h4>

                            <!-- Add Form -->
                            <div class="bg-gray-50 dark:bg-gray-900 p-5 rounded-xl border border-gray-200 dark:border-white/10 mb-4">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
                                    <label class="block text-sm font-semibold text-gray-900 dark:text-white">Tambah Sparepart</label>

                                    <!-- Mode Toggle -->
                                    <div class="flex bg-white dark:bg-gray-800 rounded-lg p-1 border border-gray-200 dark:border-gray-700 w-fit">
                                        <button
                                            wire:click="$set('useManualSparepart', 0)"
                                            class="px-3 py-1.5 text-xs font-medium rounded-md transition-all {{ !$useManualSparepart ? 'bg-primary-100 dark:bg-primary-900/50 text-primary-700 dark:text-primary-300 shadow-sm' : 'text-gray-500 hover:text-gray-700 dark:hover:text-gray-300' }}"
                                        >
                                            Ambil Stok
                                        </button>
                                        <button
                                            wire:click="$set('useManualSparepart', 1)"
                                            class="px-3 py-1.5 text-xs font-medium rounded-md transition-all {{ $useManualSparepart ? 'bg-primary-100 dark:bg-primary-900/50 text-primary-700 dark:text-primary-300 shadow-sm' : 'text-gray-500 hover:text-gray-700 dark:hover:text-gray-300' }}"
                                        >
                                            Input Manual
                                        </button>
                                    </div>
                                </div>

                                <div class="grid grid-cols-12 gap-4">
                                    <div class="col-span-12 md:col-span-5">
                                        @if($useManualSparepart)
                                            <input type="text" wire:model="sparepartName" placeholder="Nama sparepart baru..." class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 focus:border-transparent transition-all placeholder-gray-400">
                                            <p class="mt-1 text-xs text-gray-500 italic">*Akan ditambahkan sebagai item manual</p>
                                        @else
                                            <select wire:model.live="sparepartId" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 focus:border-transparent transition-all">
                                                <option value="">-- Pilih Sparepart --</option>
                                                @foreach($spareparts as $s)
                                                    <option value="{{ $s->id }}">{{ $s->name }} (Stok: {{ $s->stock }})</option>
                                                @endforeach
                                            </select>
                                            <p class="mt-1 text-xs text-gray-500 italic">*Harga otomatis terisi dari database</p>
                                        @endif
                                    </div>
                                    <div class="col-span-4 md:col-span-2">
                                        <input type="number" wire:model="sparepartQty" min="1" placeholder="Qty" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 focus:border-transparent transition-all">
                                    </div>
                                    <div class="col-span-8 md:col-span-5 flex gap-2">
                                        <div class="flex flex-1 rounded-lg shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 bg-white dark:bg-gray-800 focus-within:ring-2 focus-within:ring-inset focus-within:ring-primary-500 overflow-hidden">
                                            <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm bg-gray-50 dark:bg-gray-700/50 px-3 border-r border-gray-300 dark:border-gray-600">Rp</span>
                                            <input type="text" inputmode="numeric" wire:model="sparepartPrice" placeholder="Harga" class="block flex-1 border-0 bg-transparent py-2.5 pl-3 text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" {{ !$useManualSparepart ? 'readonly' : '' }}>
                                        </div>
                                        <button wire:click="addSparepart" class="bg-primary-600 hover:bg-primary-700 text-white px-4 rounded-lg font-medium transition-colors shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                                            +
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- List -->
                            <div class="space-y-2 mb-6">
                                @forelse($selectedService->serviceSpareparts as $sp)
                                    <div class="flex items-center justify-between p-3 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600 transition-colors">
                                        <div class="flex items-center gap-4">
                                            <button wire:click="removeSparepart({{ $sp->id }})" class="text-gray-400 hover:text-red-500 transition-colors">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                            <div>
                                                <p class="font-medium text-gray-900 dark:text-white">{{ $sp->sparepart->name }}</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $sp->qty }} x Rp {{ number_format($sp->price, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                        <p class="font-bold text-gray-900 dark:text-white">Rp {{ number_format($sp->qty * $sp->price, 0, ',', '.') }}</p>
                                    </div>
                                @empty
                                    <div class="text-center py-4 text-gray-500 dark:text-gray-400 text-sm italic bg-gray-50 dark:bg-gray-900/50 rounded-lg border border-dashed border-gray-300 dark:border-gray-700">
                                        Belum ada sparepart
                                    </div>
                                @endforelse
                            </div>

                            <!-- No Parts Needed Toggle -->
                            <div class="my-3 flex items-center gap-3 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-700/50 rounded-xl px-4 py-3">
                                <input type="checkbox" id="noPartsNeeded" wire:model.live="noPartsNeeded"
                                    class="w-4 h-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 cursor-pointer">
                                <label for="noPartsNeeded" class="text-sm font-semibold text-emerald-800 dark:text-emerald-300 cursor-pointer select-none flex items-center gap-2">
                                    <svg class="w-4 h-4 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Tidak perlu pergantian part &mdash; hanya biaya jasa perbaikan
                                </label>
                            </div>

                            <!-- Cost Breakdown -->
                            <div class="bg-gray-50 dark:bg-gray-900 rounded-xl p-6 border border-gray-200 dark:border-white/10">
                                <div class="flex items-center justify-between mb-3 text-sm">
                                    <span class="text-gray-600 dark:text-gray-400">Total Sparepart</span>
                                    @if($noPartsNeeded)
                                        <span class="font-medium text-gray-400 dark:text-gray-500 line-through">Rp {{ number_format(($selectedService->total_cost ?? 0) - ($estimatedCost ?? 0), 0, ',', '.') }}</span>
                                    @else
                                        <span class="font-medium text-gray-900 dark:text-white">Rp {{ number_format(($selectedService->total_cost ?? 0) - ($estimatedCost ?? 0), 0, ',', '.') }}</span>
                                    @endif
                                </div>
                                
                                {{-- Service Packages Selection --}}
                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Paket Layanan / Biaya Jasa
                                    </label>
                                    <select wire:model.live="selectedServiceCategoryId" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all mb-3">
                                        <option value="">-- Pilih Kategori Layanan --</option>
                                        @foreach($availableCategories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>

                                    @if(!empty($availableServicesData))
                                    <div class="grid grid-cols-1 gap-2 mb-3">
                                        @foreach($availableServicesData as $sKey => $svc)
                                        <label class="flex items-start gap-3 p-2 rounded-lg border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800 cursor-pointer hover:bg-gray-100 transition">
                                            <input type="checkbox" wire:model.live="selectedServiceItems" value="{{ $svc['label'] ?? '' }} ({{ $svc['price'] ?? '' }})" class="mt-1 w-4 h-4 text-primary-600 bg-white border-gray-300 rounded focus:ring-primary-500">
                                            <div class="flex-1">
                                                <div class="text-sm font-medium text-gray-900">{{ $svc['label'] ?? '' }}</div>
                                                <div class="text-xs text-primary-600 font-semibold">{{ $svc['price'] ?? '' }}</div>
                                            </div>
                                        </label>
                                        @endforeach
                                    </div>
                                    @endif

                                    {{-- Display Selected Items cleanly --}}
                                    @if(!empty($selectedServiceItems))
                                    <div class="mt-2 bg-blue-50 dark:bg-blue-900/30 rounded-lg p-3 border border-blue-100 dark:border-blue-800">
                                        <p class="text-xs font-bold text-blue-800 dark:text-blue-300 mb-1">Layanan Terpilih:</p>
                                        <ul class="list-disc list-inside text-xs text-blue-700 dark:text-blue-400 space-y-1">
                                            @foreach($selectedServiceItems as $item)
                                                <li>{{ $item }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </div>

                                <div class="flex items-center justify-between mb-4 text-sm mt-4 pt-4 border-t border-gray-200">
                                    <span class="text-gray-600 dark:text-gray-400 font-semibold">Total Biaya Jasa Servis</span>
                                    <div class="flex w-40 rounded-md shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 bg-gray-100 dark:bg-gray-800 overflow-hidden cursor-not-allowed">
                                        <span class="flex select-none items-center pl-2 text-gray-500 text-xs bg-gray-200 dark:bg-gray-700 px-2 border-r border-gray-300 dark:border-gray-600">Rp</span>
                                        <input type="text" value="{{ number_format((float)($estimatedCost ?? 0), 0, ',', '.') }}" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-right text-sm font-bold text-gray-700 dark:text-gray-300 focus:ring-0" disabled>
                                    </div>
                                </div>
                                <div class="border-t border-gray-200 dark:border-gray-700 pt-4 flex items-center justify-between">
                                    <span class="text-base font-bold text-gray-900 dark:text-white">Total Biaya</span>
                                    <span class="text-2xl font-bold text-primary-600 dark:text-primary-400">Rp {{ number_format($selectedService->total_cost, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        @endif {{-- end REGULER --}}

                        {{-- ===== AUTHORIZED: Brand + ADP section ===== --}}
                        @if($selectedService->service_type === 'AUTHORIZED')
                        <div class="mb-8">
                            <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                <span class="bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 p-1.5 rounded-lg">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                </span>
                                Garansi — Biaya & Brand
                            </h4>

                            <div class="space-y-4">
                                {{-- Brand Selector --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Brand Laptop</label>
                                    <select wire:model.live="brandId" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 transition-shadow">
                                        <option value="">-- Pilih Brand --</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Default: Gratis --}}
                                <div class="flex items-start gap-3 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800/50 px-4 py-3">
                                    <svg class="w-5 h-5 text-green-600 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <div>
                                        <p class="text-sm font-bold text-green-800 dark:text-green-300">Default: Gratis (Ditanggung Penuh Brand)</p>
                                        <p class="text-xs text-green-700 dark:text-green-400 mt-0.5">Centang di bawah jika ada biaya ADP dari brand yang dibebankan ke user.</p>
                                    </div>
                                </div>

                                {{-- ADP Checkbox --}}
                                <div class="flex items-center gap-3 rounded-xl border px-4 py-3 cursor-pointer select-none
                                    {{ $hasAdp ? 'bg-amber-50 dark:bg-amber-900/20 border-amber-300 dark:border-amber-700' : 'bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700' }}"
                                    wire:click="$toggle('hasAdp')">
                                    <input type="checkbox" wire:model.live="hasAdp" id="hasAdp"
                                        class="w-4 h-4 rounded border-gray-300 text-amber-500 focus:ring-amber-400 cursor-pointer pointer-events-none">
                                    <label for="hasAdp" class="text-sm font-semibold cursor-pointer pointer-events-none
                                        {{ $hasAdp ? 'text-amber-800 dark:text-amber-300' : 'text-gray-700 dark:text-gray-300' }}">
                                        Ada biaya ADP dari brand &mdash; user menanggung 10% dari biaya asli
                                    </label>
                                </div>

                                {{-- ADP Cost Fields (visible only when hasAdp is checked) --}}
                                @if($hasAdp)
                                <div class="bg-amber-50 dark:bg-amber-900/20 rounded-xl border border-amber-200 dark:border-amber-700 p-5 space-y-3">
                                    <div class="flex items-center justify-between text-sm">
                                        <label class="font-semibold text-gray-700 dark:text-gray-300">Biaya Asli (Total dari Brand)</label>
                                        <div class="flex w-48 rounded-md shadow-sm ring-1 ring-inset ring-amber-300 dark:ring-amber-600 bg-white dark:bg-gray-800 focus-within:ring-2 focus-within:ring-amber-500 overflow-hidden">
                                            <span class="flex select-none items-center px-3 text-gray-500 text-xs bg-amber-50 dark:bg-gray-700/50 border-r border-amber-300 dark:border-amber-600">Rp</span>
                                            <input type="number" wire:model.blur="adpOriginalCost" min="0"
                                                class="block flex-1 border-0 bg-transparent py-2 pl-2 pr-3 text-right text-sm font-semibold text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-0"
                                                placeholder="0">
                                        </div>
                                    </div>
                                    <div class="border-t border-amber-200 dark:border-amber-700 pt-3 space-y-1 text-sm">
                                        <div class="flex justify-between text-gray-600 dark:text-gray-400">
                                            <span>Brand menanggung (90%)</span>
                                            <span class="font-medium">Rp {{ number_format((float)$adpOriginalCost * 0.90, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="flex justify-between font-bold text-amber-800 dark:text-amber-300">
                                            <span>User membayar (10%)</span>
                                            <span class="text-lg">Rp {{ number_format((float)$adpOriginalCost * 0.10, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="flex justify-between items-center bg-gray-50 dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 px-5 py-4">
                                    <span class="text-base font-bold text-gray-900 dark:text-white">Total Biaya User</span>
                                    <span class="text-2xl font-bold text-green-600 dark:text-green-400">Gratis</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif {{-- end AUTHORIZED --}}

                        <div class="border-t border-gray-200 dark:border-white/10 my-6"></div>

                        <!-- Update Status Form -->
                        <div class="mb-4">
                            <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                <span class="bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 p-1.5 rounded-lg">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                </span>
                                Update Status & Diagnosa
                            </h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Status Pengerjaan</label>
                                    <select wire:model="status" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 transition-shadow">
                                        @foreach($this->statuses as $val => $label)
                                            <option value="{{ $val }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Teknisi</label>
                                    <select wire:model="userId" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 transition-shadow">
                                        <option value="">Pilih Teknisi</option>
                                        @foreach($teknisis as $tek)
                                            <option value="{{ $tek->id }}">{{ $tek->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- RMA Input for Authorized Service --}}
                                @if($selectedService->service_type === 'AUTHORIZED')
                                <div class="md:col-span-2 bg-blue-50 dark:bg-blue-900/20 p-4 rounded-xl border border-blue-100 dark:border-blue-800">
                                    <label class="block text-sm font-bold text-blue-800 dark:text-blue-300 mb-2">
                                        Nomor Tiket Vendor / RMA (Wajib Diisi)
                                    </label>
                                    <input
                                        type="text"
                                        wire:model="rmaNumber"
                                        placeholder="Masukkan nomor tiket dari vendor service center..."
                                        class="w-full px-4 py-2.5 rounded-lg border border-blue-300 dark:border-blue-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 placeholder-gray-400"
                                    >
                                    <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">*Masukkan nomor referensi saat unit dikirim ke Service Center Resmi.</p>
                                </div>
                                @endif
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Hasil Diagnosa</label>
                                    <textarea wire:model="diagnosisResult" rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 resize-none placeholder-gray-400" placeholder="Detail kerusakan yang ditemukan..."></textarea>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Rekomendasi / Solusi</label>
                                        <textarea wire:model="additionalFindings" rows="2" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 resize-none placeholder-gray-400" placeholder="Solusi perbaikan..."></textarea>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Catatan Internal</label>
                                        <textarea wire:model="serviceDescription" rows="2" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 resize-none placeholder-gray-400" placeholder="Catatan untuk tim..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Footer Details -->
                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800 border-t border-gray-200 dark:border-white/10 flex flex-col sm:flex-row gap-3 rounded-b-xl shrink-0">
                        <button wire:click="sendWhatsAppNotification" class="flex-1 inline-flex justify-center items-center gap-2 px-6 py-3 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 border border-gray-300 dark:border-gray-600 rounded-xl font-bold transition-all text-sm group">
                            <svg class="w-5 h-5 text-green-500 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            <span>Kirim Ulang WA</span>
                        </button>
                        <button wire:click="saveChanges" class="flex-[2] inline-flex justify-center items-center gap-2 px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white rounded-xl font-bold transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5 text-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Simpan Perubahan</span>
                        </button>
                    </div>
    @endif

</div>

@php
    function getStatusColor($status) {
        return match($status) {
            'Pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
            'Diagnosis' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
            'In Progress' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300',
            'Done' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
            'Taken' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
            default => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
        };
    }
@endphp
