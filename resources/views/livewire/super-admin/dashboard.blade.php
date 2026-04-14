<div class="space-y-6">
    {{-- FILTER SECTION --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-4 border border-gray-200 dark:border-gray-700">
        <div class="flex flex-wrap items-center gap-4">
            <div class="flex items-center gap-2">
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Bulan:</label>
                <select wire:model.live="month" class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm">
                    @foreach($this->months as $key => $name)
                        <option value="{{ $key }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center gap-2">
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Tahun:</label>
                <select wire:model.live="year" class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm">
                    @foreach($this->years as $y)
                        <option value="{{ $y }}">{{ $y }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    {{-- 1. STATISTIK GLOBAL --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
                <div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">Total Servis</div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($globalStats['total_servis_bulan']) }}</div>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">Omset Reguler</div>
                    <div class="text-lg font-bold text-green-600 dark:text-green-400">Rp {{ number_format($globalStats['total_omset_reguler'], 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-lg bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">Servis Reguler</div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($globalStats['jumlah_reguler']) }}</div>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">Servis Garansi</div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($globalStats['jumlah_garansi']) }}</div>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">Selesai Hari Ini</div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($globalStats['selesai_hari_ini']) }}</div>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-lg bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">Masih Proses</div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($globalStats['masih_proses']) }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- 2. MONITORING KINERJA ADMIN --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Aktivitas Admin
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-700/30">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">No</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Nama Admin</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700 dark:text-gray-300">Input Servis</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700 dark:text-gray-300">Update Status</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700 dark:text-gray-300">Total Transaksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($adminPerformance as $index => $admin)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $admin['name'] }}</td>
                                <td class="px-4 py-3 text-center text-gray-600 dark:text-gray-400">{{ $admin['input_servis'] }}</td>
                                <td class="px-4 py-3 text-center text-gray-600 dark:text-gray-400">{{ $admin['update_status'] }}</td>
                                <td class="px-4 py-3 text-center font-semibold text-green-600">{{ $admin['total_transaksi'] }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">Tidak ada data admin</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- 3. MONITORING OMSET TEKNISI --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Omset Teknisi (Reguler Only)
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-700/30">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">No</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Nama Teknisi</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700 dark:text-gray-300">Jml Servis</th>
                            <th class="px-4 py-3 text-right font-semibold text-gray-700 dark:text-gray-300">Total Jasa</th>
                            <th class="px-4 py-3 text-right font-semibold text-gray-700 dark:text-gray-300">Rata-rata/Servis</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($technicianPerformance as $index => $tech)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $tech['name'] }}</td>
                                <td class="px-4 py-3 text-center">
                                    <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-full text-xs font-semibold">{{ $tech['jumlah_servis'] }}</span>
                                </td>
                                <td class="px-4 py-3 text-right font-semibold text-green-600 dark:text-green-400">Rp {{ number_format($tech['total_jasa'], 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-right text-gray-600 dark:text-gray-400">Rp {{ number_format($tech['rata_rata'], 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">Tidak ada data teknisi</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- 4. MONITORING SERVIS REGULER --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-blue-50 dark:bg-blue-900/20">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                Monitoring Servis REGULER
            </h3>
        </div>
        <div class="overflow-x-auto max-h-96">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-700/30 sticky top-0">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">No</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Nama User</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Tipe Laptop</th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-700 dark:text-gray-300">Status</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Teknisi</th>
                        <th class="px-4 py-3 text-right font-semibold text-gray-700 dark:text-gray-300">Total</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Tanggal Masuk</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($servisReguler as $index => $service)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900 dark:text-white">{{ $service->customer->name ?? '-' }}</div>
                                <div class="text-xs text-gray-500">{{ $service->ticket_number }}</div>
                            </td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $service->device_name }}</td>
                            <td class="px-4 py-3 text-center">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    {{ $service->status === 'Done' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $service->status === 'Pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $service->status === 'Diagnosis' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $service->status === 'In Progress' ? 'bg-indigo-100 text-indigo-700' : '' }}
                                    {{ $service->status === 'Taken' ? 'bg-gray-100 text-gray-700' : '' }}
                                ">{{ $service->status }}</span>
                            </td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $service->user->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-right font-semibold text-gray-900 dark:text-white">Rp {{ number_format($service->total_cost, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $service->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="px-4 py-8 text-center text-gray-500">Tidak ada data servis reguler</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- 5. MONITORING SERVIS GARANSI --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-purple-50 dark:bg-purple-900/20">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                Monitoring Servis GARANSI (Authorized)
            </h3>
        </div>
        <div class="overflow-x-auto max-h-96">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-700/30 sticky top-0">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">No</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Nama User</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Tipe Laptop</th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-700 dark:text-gray-300">Status</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">RMA Number</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Tanggal Masuk</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($servisGaransi as $index => $service)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900 dark:text-white">{{ $service->customer->name ?? '-' }}</div>
                                <div class="text-xs text-gray-500">{{ $service->ticket_number }}</div>
                            </td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $service->device_name }}</td>
                            <td class="px-4 py-3 text-center">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    {{ $service->status === 'Done' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $service->status === 'Pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $service->status === 'Diagnosis' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $service->status === 'Waiting Part' ? 'bg-orange-100 text-orange-700' : '' }}
                                    {{ $service->status === 'Taken' ? 'bg-gray-100 text-gray-700' : '' }}
                                ">{{ $service->status }}</span>
                            </td>
                            <td class="px-4 py-3 font-mono text-sm text-purple-600 dark:text-purple-400">{{ $service->rma_number ?? '-' }}</td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $service->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-4 py-8 text-center text-gray-500">Tidak ada data servis garansi</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- 6. LOG AKTIVITAS SISTEM --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Log Aktivitas Sistem
            </h3>
        </div>
        <div class="overflow-x-auto max-h-96">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-700/30 sticky top-0">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">No</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">User</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Aksi</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Modul / Tiket</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Waktu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($activityLogs as $index => $log)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">
                                @if($log->user)
                                    <span class="font-medium text-gray-900 dark:text-white">{{ $log->user->name }}</span>
                                    <span class="ml-1 px-1.5 py-0.5 text-xs rounded {{ $log->user->role === 'admin' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700' }}">{{ $log->user->role }}</span>
                                @else
                                    <span class="text-gray-400 italic">System</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded text-xs font-semibold
                                    {{ $log->status === 'Pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $log->status === 'Done' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $log->status === 'Taken' ? 'bg-gray-100 text-gray-700' : '' }}
                                    {{ !in_array($log->status, ['Pending', 'Done', 'Taken']) ? 'bg-blue-100 text-blue-700' : '' }}
                                ">{{ $log->status }}</span>
                            </td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">
                                @if($log->service)
                                    <span class="font-mono text-xs">{{ $log->service->ticket_number }}</span>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-4 py-3 text-gray-500 dark:text-gray-400 text-xs">{{ $log->created_at->format('d M Y H:i:s') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">Tidak ada log aktivitas</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
