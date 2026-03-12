<div class="space-y-5 animate-fade-in">
    <!-- Filters -->
    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Cari Tiket/Device</label>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search..." class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Admin/User</label>
                <select wire:model.live="userFilter" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    <option value="">Semua User</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->role }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Dari Tanggal</label>
                <input type="date" wire:model.live="startDate" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sampai Tanggal</label>
                <input type="date" wire:model.live="endDate" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th class="px-6 py-4 font-semibold text-gray-900 dark:text-white">Waktu</th>
                        <th class="px-6 py-4 font-semibold text-gray-900 dark:text-white">User</th>
                        <th class="px-6 py-4 font-semibold text-gray-900 dark:text-white">Tiket / Device</th>
                        <th class="px-6 py-4 font-semibold text-gray-900 dark:text-white">Aktivitas</th>
                        <th class="px-6 py-4 font-semibold text-gray-900 dark:text-white">Detail</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($logs as $log)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="px-6 py-4 text-gray-600 dark:text-gray-300 whitespace-nowrap">
                                {{ $log->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                @if($log->user)
                                    <div class="flex items-center gap-2">
                                        <span class="font-medium text-gray-900 dark:text-white">{{ $log->user->name }}</span>
                                        <span class="text-xs px-2 py-0.5 rounded-full {{ $log->user->role === 'super_admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                            {{ $log->user->role }}
                                        </span>
                                    </div>
                                @else
                                    <span class="text-gray-400 italic">System/Unknown</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($log->service)
                                    <div class="font-medium text-gray-900 dark:text-white">{{ $log->service->ticket_number }}</div>
                                    <div class="text-xs text-gray-500">{{ $log->service->device_name }}</div>
                                @else
                                    <span class="text-gray-400 italic">Service Deleted</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-lg text-xs font-semibold
                                    {{ $log->status === 'Done' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $log->status === 'Pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $log->status === 'Diagnosis' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $log->status === 'Waiting Part' ? 'bg-orange-100 text-orange-700' : '' }}
                                    {{ $log->status === 'Taken' ? 'bg-gray-100 text-gray-700' : '' }}
                                ">
                                    {{ $log->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                {{ $log->description }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-200 dark:border-gray-700">
            {{ $logs->links() }}
        </div>
    </div>
</div>
