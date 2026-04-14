<div>
    <div class="mb-6 mb-8 flex items-center bg-gray-100 dark:bg-gray-800 p-1.5 rounded-lg w-max overflow-x-auto ring-1 ring-gray-900/5 shadow-sm">
        <button wire:click="setTab('REGULER')"
                class="px-6 py-2.5 rounded-md text-sm font-medium transition-all duration-200 whitespace-nowrap {{ $activeTab === 'REGULER' ? 'bg-primary-600 text-white shadow shadow-primary-500/30' : 'text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white hover:bg-gray-200/50 dark:hover:bg-gray-700/50' }}">
            Reguler
        </button>
        <button wire:click="setTab('AUTHORIZED')"
                class="px-6 py-2.5 rounded-md text-sm font-medium transition-all duration-200 whitespace-nowrap {{ $activeTab === 'AUTHORIZED' ? 'bg-primary-600 text-white shadow shadow-primary-500/30' : 'text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white hover:bg-gray-200/50 dark:hover:bg-gray-700/50' }}">
            Garansi
        </button>
    </div>

    <!-- Tabel Data Service -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700/50 overflow-hidden relative z-10">
        <div class="overflow-x-auto relative">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-700">
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tanggal Masuk</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nama Pelanggan</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Unit</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Keluhan</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700" wire:loading.class="opacity-50 pointer-events-none" wire:target="setTab, gotoPage">
                    @forelse($services as $service)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors group">
                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ $service->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 font-medium">
                                {{ $service->customer ? $service->customer->name : '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ $service->device_name }}<br>
                                <span class="text-xs text-gray-500 block">{{ $service->ticket_number }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ Str::limit($service->complaint, 50) }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $this->getStatusColor($service->status) }}">
                                        {{ $this->getStatusLabel($service->status, $activeTab) }}
                                    </span>
                                    
                                    @if($this->isWarning($service))
                                        <div title="Unit belum ada perubahan status selama lebih dari 6 hari.">
                                            <span class="flex h-5 w-5 items-center justify-center rounded-full bg-red-100 text-red-500 dark:bg-red-900/40 font-bold dark:text-red-400">
                                                !
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                Tidak ada data servis {{ $activeTab === 'REGULER' ? 'Reguler' : 'Garansi' }} yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($services->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700">
                 {{ $services->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
</div>
