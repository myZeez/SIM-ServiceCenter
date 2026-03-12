<div class="animate-fade-in">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-4">

        {{-- Omset Bulan Ini --}}
        <div class="xl:col-span-2 bg-gradient-to-br from-primary-600 to-primary-800 rounded-2xl p-5 text-white shadow-lg shadow-primary-200 dark:shadow-none">
            <div class="flex items-start justify-between gap-3">
                <div class="min-w-0">
                    <p class="text-primary-200 text-xs font-semibold uppercase tracking-wide mb-2">Omset Bulan Ini</p>
                    <h3 class="text-2xl font-bold leading-none truncate">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</h3>
                    <p class="text-primary-300 text-xs mt-2 font-medium">{{ now()->format('F Y') }}</p>
                </div>
                <div class="bg-white/15 backdrop-blur-sm p-2.5 rounded-xl flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Servis Bulan Ini --}}
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-5 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="text-gray-500 dark:text-gray-400 text-xs font-semibold uppercase tracking-wide mb-2">Servis Bulan Ini</p>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white leading-none">{{ $monthlyServices }}</h3>
                    <p class="text-gray-400 text-xs mt-2">unit masuk</p>
                </div>
                <div class="bg-blue-50 dark:bg-blue-900/30 p-2.5 rounded-xl flex-shrink-0">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Servis Hari Ini --}}
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-5 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="text-gray-500 dark:text-gray-400 text-xs font-semibold uppercase tracking-wide mb-2">Servis Hari Ini</p>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white leading-none">{{ $todayServices }}</h3>
                    <p class="text-gray-400 text-xs mt-2">unit masuk</p>
                </div>
                <div class="bg-green-50 dark:bg-green-900/30 p-2.5 rounded-xl flex-shrink-0">
                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Selesai & Proses --}}
        <div class="col-span-2 md:col-span-1 xl:col-span-1 bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-5 shadow-sm">
            <p class="text-gray-500 dark:text-gray-400 text-xs font-semibold uppercase tracking-wide mb-3">Status Hari Ini</p>
            <div class="space-y-2.5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-emerald-500 flex-shrink-0"></div>
                        <span class="text-sm text-gray-600 dark:text-gray-400">Selesai</span>
                    </div>
                    <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $todayCompleted }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-amber-400 flex-shrink-0"></div>
                        <span class="text-sm text-gray-600 dark:text-gray-400">Proses</span>
                    </div>
                    <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $inProgress }}</span>
                </div>
                @if(($todayServices) > 0)
                    <div class="pt-1">
                        <div class="flex gap-0.5 h-1.5 rounded-full overflow-hidden bg-gray-100 dark:bg-gray-800">
                            @php $donePercent = $todayServices > 0 ? round(($todayCompleted / $todayServices) * 100) : 0; @endphp
                            <div class="bg-emerald-500 rounded-full transition-all" style="width: {{ $donePercent }}%"></div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
