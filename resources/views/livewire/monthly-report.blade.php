<div class="animate-fade-in space-y-6">

    <!-- Filter Controls -->
    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-4 flex flex-col md:flex-row justify-between items-center gap-4">

        <!-- Tabs -->
        <div class="flex bg-gray-100 dark:bg-gray-700/50 p-1 rounded-lg">
            <button wire:click="switchTab('REGULER')"
                class="px-6 py-2 rounded-md text-sm font-bold transition-all {{ $activeTab === 'REGULER' ? 'bg-white dark:bg-gray-800 shadow text-blue-600 dark:text-blue-400' : 'text-gray-500 hover:text-gray-700 dark:hover:text-gray-300' }}">
                Reguler
            </button>
            <button wire:click="switchTab('AUTHORIZED')"
                class="px-6 py-2 rounded-md text-sm font-bold transition-all {{ $activeTab === 'AUTHORIZED' ? 'bg-white dark:bg-gray-800 shadow text-purple-600 dark:text-purple-400' : 'text-gray-500 hover:text-gray-700 dark:hover:text-gray-300' }}">
                Garansi (Authorized)
            </button>
        </div>

        <div class="flex gap-2 items-center">
             <!-- Search -->
            <div class="relative">
                <input type="text" wire:model.live.debounce.500ms="search" placeholder="Cari Nota / Nama..."
                    class="rounded-lg border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-primary-500 text-sm w-48">
            </div>

            <!-- Brand Filter (AUTHORIZED only) -->
            @if($activeTab === 'AUTHORIZED')
            <select wire:model.live="filterBrandId" class="rounded-lg border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-primary-500 text-sm">
                <option value="">Semua Brand</option>
                @foreach($this->availableBrands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
            @endif

            <!-- Date Filter -->
            <select wire:model.live="month" class="rounded-lg border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-primary-500 text-sm">
                @foreach($this->months as $key => $name)
                    <option value="{{ $key }}">{{ $name }}</option>
                @endforeach
            </select>
            <select wire:model.live="year" class="rounded-lg border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-primary-500 text-sm">
                @foreach($this->years as $y)
                    <option value="{{ $y }}">{{ $y }}</option>
                @endforeach
            </select>

            <!-- Export -->
            <button wire:click="exportExcel" class="flex items-center gap-2 px-4 py-2 bg-green-600 text-white text-sm font-bold rounded-lg hover:bg-green-700 transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Export
            </button>
        </div>
    </div>

    {{-- ===================== REGULER SUMMARY CARDS ===================== --}}
    @if($activeTab === 'REGULER')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-5">
            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium mb-1">Total Omset</p>
            <h3 class="text-2xl font-bold text-blue-600 dark:text-blue-400">Rp {{ number_format($summary['total_omset'], 0, ',', '.') }}</h3>
            <p class="text-xs text-gray-400 mt-2">{{ $summary['count'] }} Servis Selesai</p>
        </div>
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-5">
            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium mb-1">Pendapatan Jasa</p>
            <h3 class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">Rp {{ number_format($summary['total_jasa'], 0, ',', '.') }}</h3>
            <p class="text-xs text-gray-400 mt-2">Murni (Non-part)</p>
        </div>
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-5">
            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium mb-1">Pendapatan Admin</p>
            <h3 class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($summary['total_admin'], 0, ',', '.') }}</h3>
            <p class="text-xs text-gray-400 mt-2">Fee Nota</p>
        </div>
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-5">
            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium mb-1">Total Sparepart</p>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white">Rp {{ number_format($summary['total_sparepart'], 0, ',', '.') }}</h3>
        </div>
    </div>

    {{-- Technician Summary Cards --}}
    @if(count($technicianReports) > 0)
    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6 mt-4">
        <h4 class="font-bold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            Omset per Teknisi
        </h4>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($technicianReports as $tech)
            <div class="rounded-xl border border-gray-200 dark:border-gray-700 p-4 bg-gray-50 dark:bg-gray-800">
                <p class="font-bold text-gray-900 dark:text-white text-base mb-3">{{ $tech['name'] }}</p>
                <div class="space-y-1 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Total Servis</span>
                        <span class="font-semibold">{{ $tech['service_count'] }} unit</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Omset (Total Jasa)</span>
                        <span class="font-semibold text-indigo-600">Rp {{ number_format($tech['total_jasa'], 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Komisi Teknisi</span>
                        <span class="font-semibold text-green-600">Rp {{ number_format($tech['total_commission'], 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    @else
    {{-- ===================== AUTHORIZED SUMMARY CARDS ===================== --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-5">
            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium mb-1">Total Unit Garansi</p>
            <h3 class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $summary['count'] }} Unit</h3>
            <p class="text-xs text-gray-400 mt-2">Selesai bulan ini</p>
        </div>
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-5">
            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium mb-1">Biaya ADP (Dibayar User)</p>
            <h3 class="text-2xl font-bold text-amber-600 dark:text-amber-400">Rp {{ number_format($summary['total_omset'], 0, ',', '.') }}</h3>
            <p class="text-xs text-gray-400 mt-2">10% dari nilai ADP</p>
        </div>
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-5">
            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium mb-1">Gratis (Ditanggung Brand)</p>
            @php $freeCount = collect($brandReports)->sum('count') - collect($brandReports)->sum('adp_count'); @endphp
            <h3 class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $freeCount }} Unit</h3>
            <p class="text-xs text-gray-400 mt-2">Tanpa biaya ADP</p>
        </div>
    </div>

    {{-- Brand Summary Cards --}}
    @if(count($brandReports) > 0)
    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">
        <h4 class="font-bold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            Rekap per Brand
        </h4>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($brandReports as $brand)
            <div class="rounded-xl border border-gray-200 dark:border-gray-700 p-4 bg-gray-50 dark:bg-gray-800">
                <p class="font-bold text-gray-900 dark:text-white text-base mb-3">{{ $brand['name'] }}</p>
                <div class="space-y-1 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Total Unit</span>
                        <span class="font-semibold">{{ $brand['count'] }} unit</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Ada ADP</span>
                        <span class="font-semibold text-amber-600">{{ $brand['adp_count'] }} unit</span>
                    </div>
                    @if($brand['adp_count'] > 0)
                    <div class="border-t border-gray-200 dark:border-gray-600 pt-2 mt-2 space-y-1">
                        <div class="flex justify-between text-xs">
                            <span class="text-gray-400">Biaya Asli ADP</span>
                            <span>Rp {{ number_format($brand['original_cost'], 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-xs">
                            <span class="text-green-600">Brand Tanggung (90%)</span>
                            <span class="text-green-700 font-medium">Rp {{ number_format($brand['brand_cost'], 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-xs font-bold">
                            <span class="text-amber-600">User Bayar (10%)</span>
                            <span class="text-amber-700">Rp {{ number_format($brand['user_cost'], 0, ',', '.') }}</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    @endif

    {{-- ===================== MAIN TABLE ===================== --}}
    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm flex flex-col">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 flex justify-between items-center">
            <h3 class="font-bold text-lg text-gray-800 dark:text-white">
                Detail Laporan Servis {{ $activeTab === 'REGULER' ? 'Reguler' : 'Garansi (Authorized)' }}
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600 dark:text-gray-400">
                <thead class="text-xs text-gray-600 dark:text-gray-400 uppercase bg-gray-50 dark:bg-gray-800/60 border-b border-gray-200 dark:border-gray-800">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Nama User</th>
                        <th scope="col" class="px-6 py-3">No Telp</th>
                        <th scope="col" class="px-6 py-3">Tipe Laptop</th>
                        <th scope="col" class="px-6 py-3">Perbaikan</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        @if($activeTab === 'AUTHORIZED')
                            <th scope="col" class="px-6 py-3">Brand</th>
                            <th scope="col" class="px-6 py-3 text-right">Biaya User</th>
                            <th scope="col" class="px-6 py-3">ADP</th>
                        @else
                            <th scope="col" class="px-6 py-3">Sparepart</th>
                            <th scope="col" class="px-6 py-3 text-right">Hrg Part</th>
                            <th scope="col" class="px-6 py-3 text-right">Hrg Jasa</th>
                            <th scope="col" class="px-6 py-3 text-right">Total</th>
                        @endif
                        <th scope="col" class="px-6 py-3">Teknisi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($services as $index => $service)
                        <tr class="border-b dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/60 transition-colors">
                            <td class="px-6 py-4 font-medium">{{ $services->firstItem() + $index }}</td>
                            <td class="px-6 py-4 font-bold text-gray-900 dark:text-white">
                                {{ $service->customer->name ?? 'Guest' }}
                                <div class="text-xs font-mono font-normal text-gray-500">{{ $service->ticket_number }}</div>
                            </td>
                            <td class="px-6 py-4 font-mono">{{ $service->customer->phone ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $service->device_name }}</td>
                            <td class="px-6 py-4 max-w-xs truncate">
                                @if(is_array($service->service_items) && count($service->service_items) > 0)
                                    @php
                                        // Collect all unique service names
                                        $itemNames = collect($service->service_items)
                                            ->map(fn($item) => is_array($item) && isset($item['name']) ? $item['name'] : (is_string($item) ? $item : ''))
                                            ->filter()
                                            ->unique()
                                            ->join(', ');
                                    @endphp
                                    <span title="{{ $itemNames }}">{{ $itemNames ?: ($service->diagnosis_result ?: '-') }}</span>
                                @else
                                    <span title="{{ $service->diagnosis_result }}">{{ $service->diagnosis_result ?: '-' }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-bold rounded-full {{ $service->status === 'Done' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                    {{ $service->status == 'Done' ? 'Selesai' : 'Diambil' }}
                                </span>
                            </td>
                            @if($activeTab === 'AUTHORIZED')
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-bold rounded-full bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300">
                                        {{ $service->brand->name ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right font-bold">
                                    @if($service->has_adp)
                                        <span class="text-amber-600">Rp {{ number_format($service->total_cost, 0, ',', '.') }}</span>
                                    @else
                                        <span class="text-green-600">Gratis</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($service->has_adp)
                                        <span class="px-2 py-1 text-xs font-bold rounded-full bg-amber-100 text-amber-700">ADP</span>
                                    @else
                                        <span class="text-xs text-gray-400">—</span>
                                    @endif
                                </td>
                            @else
                                <td class="px-6 py-4">
                                    @if($service->serviceSpareparts->count())
                                        @foreach($service->serviceSpareparts as $sp)
                                            <div class="text-xs {{ !$loop->first ? 'mt-1 pt-1 border-t border-gray-100 dark:border-gray-700' : '' }}">
                                                <span class="font-medium text-gray-800 dark:text-gray-200">{{ $sp->sparepart->name ?? '-' }}</span>
                                                <span class="text-gray-500">{{ $sp->qty }}x (Rp {{ number_format($sp->price, 0, ',', '.') }})</span>
                                            </div>
                                        @endforeach
                                    @else
                                        <span class="text-xs text-gray-400">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    @php
                                        $partCost = $service->serviceSpareparts->sum(fn($sp) => $sp->price * $sp->qty);
                                    @endphp
                                    @if($partCost > 0)
                                        Rp {{ number_format($partCost, 0, ',', '.') }}
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    @if($service->estimated_cost > 0)
                                        Rp {{ number_format($service->estimated_cost, 0, ',', '.') }}
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right font-bold text-gray-900 dark:text-white">
                                    Rp {{ number_format($service->total_cost, 0, ',', '.') }}
                                </td>
                            @endif
                            <td class="px-6 py-4">
                                @if($service->user)
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center text-xs font-bold">
                                            {{ substr($service->user->name, 0, 1) }}
                                        </div>
                                        <span>{{ $service->user->name }}</span>
                                    </div>
                                @else
                                    <span class="text-red-500 text-xs italic">Belum assign</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                <div class="flex flex-col items-center gap-2">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    <span>Tidak ada data servis selesai pada periode ini.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $services->links() }}
        </div>

        <!-- Bottom Summary -->
        <div class="bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700 p-6">
            <h4 class="font-bold text-gray-800 dark:text-white mb-4">Ringkasan Bulan Ini</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <span class="block text-xs text-gray-500 uppercase tracking-wider">Total Servis Selesai</span>
                    <span class="text-xl font-bold text-gray-900 dark:text-white">{{ $summary['count'] }} Unit</span>
                </div>
                <div>
                    <span class="block text-xs text-gray-500 uppercase tracking-wider">{{ $activeTab === 'REGULER' ? 'Total Omset Bulan Ini' : 'Total Biaya ADP User' }}</span>
                    <span class="text-xl font-bold text-blue-600 dark:text-blue-400">Rp {{ number_format($summary['total_omset'], 0, ',', '.') }}</span>
                </div>
                @if($activeTab === 'REGULER')
                <div>
                    <span class="block text-xs text-gray-500 uppercase tracking-wider mb-2">Omset Biaya Jasa per Teknisi</span>
                    <p class="text-xs text-gray-400 dark:text-gray-500 mb-2 italic">Hanya biaya jasa, tidak termasuk sparepart</p>
                    <div class="space-y-1">
                        @foreach($technicianReports as $tech)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">{{ $tech['name'] }}:</span>
                                <span class="font-medium text-gray-900 dark:text-white">Rp {{ number_format($tech['total_jasa'], 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
