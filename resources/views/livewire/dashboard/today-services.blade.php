<div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6 animate-fade-in">
    <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-100 dark:border-gray-800">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-base font-bold text-gray-900 dark:text-white leading-none">Servis Masuk Hari Ini</h3>
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">{{ now()->format('d F Y') }}</p>
            </div>
        </div>
        <span class="px-2.5 py-1 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-full text-sm font-bold">
            {{ count($services) }}
        </span>
    </div>

    <div class="space-y-3 max-h-[600px] overflow-y-auto pr-2">
        @forelse($services as $service)
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 hover:shadow-md transition-all duration-200 border border-gray-200 dark:border-gray-600">
                <!-- Header -->
                <div class="flex items-start justify-between mb-3">
                    <div>
                        <h4 class="font-bold text-gray-800 dark:text-white">{{ $service->customer->name }}</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $service->customer->phone }}</p>
                    </div>
                    <span class="px-3 py-1 rounded-lg text-xs font-bold {{ $this->getStatusColor($service->status) }}">
                        {{ $service->status }}
                    </span>
                </div>

                <!-- Device & Ticket -->
                <div class="space-y-2 mb-3">
                    <div class="flex items-center gap-2 text-sm">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-gray-700 dark:text-gray-300 font-medium">{{ $service->device_name }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        <span class="text-gray-700 dark:text-gray-300 font-mono text-xs">{{ $service->ticket_number }}</span>
                    </div>
                </div>

                <!-- Service Type & Time -->
                <div class="flex items-center justify-between pt-3 border-t border-gray-200 dark:border-gray-600">
                    <span class="px-2 py-1 rounded-lg text-xs font-semibold {{ $service->service_type === 'AUTHORIZED' ? 'bg-purple-100 text-purple-700 dark:bg-purple-900 dark:text-purple-300' : 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300' }}">
                        {{ $service->service_type }}
                    </span>
                    <span class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ $service->created_at->format('H:i') }}
                    </span>
                </div>

                <!-- Technician if assigned -->
                @if($service->user)
                    <div class="mt-2 flex items-center gap-2 text-xs text-gray-600 dark:text-gray-400">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span>Teknisi: {{ $service->user->name }}</span>
                    </div>
                @endif
            </div>
        @empty
            <div class="text-center py-12">
                <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada servis masuk hari ini</p>
                <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">Servis akan muncul di sini setelah dibuat</p>
            </div>
        @endforelse
    </div>
</div>
