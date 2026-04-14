<div>
    <x-slot name="header">
        <div>
            <p class="page-header-title">Manajemen Unit (Halaman Admin)</p>
            <p class="page-header-subtitle">Kelola daftar unit/perangkat yang bisa diperbaiki (seperti Laptop, PC, Printer)</p>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="w-full mx-auto">
            <div class="flex justify-end mb-4">
                <button wire:click="openModal" class="bg-gradient-to-r from-primary-600 to-primary-800 text-white px-5 py-2.5 rounded-xl font-bold flex items-center gap-2 shadow hover:shadow-lg transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Unit
                </button>
            </div>
            @if (session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('message') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Loop through Device Types -->
                @forelse($deviceTypes as $type)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700 flex flex-col hover:shadow-md transition">
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-start justify-between mb-4">
                            <div class="text-4xl px-2 py-1 bg-gray-50 dark:bg-gray-700/50 rounded shadow-inner">
                                {!! $type->icon ?: '💻' !!}
                            </div>
                            <div>
                                <button wire:click="toggleStatus({{ $type->id }})" class="text-xs font-bold px-2 py-1 rounded {{ $type->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                    {{ $type->is_active ? 'Aktif' : 'Non-Aktif' }}
                                </button>
                            </div>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 truncate">{{ $type->name }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 flex-grow mb-4">{{ \Illuminate\Support\Str::limit($type->description, 100) }}</p>

                        <div class="border-t border-gray-200 dark:border-gray-700 mt-auto pt-4 flex justify-between">
                            <a href="{{ route('expert-system.components', $type->id) }}" class="text-sm font-semibold text-primary-600 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300">
                                Kelola Komponen &rarr;
                            </a>
                            <div class="flex gap-4">
                                <button wire:click="edit({{ $type->id }})" class="text-gray-400 hover:text-blue-500 dark:hover:text-blue-400">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </button>
                                <button wire:click="delete({{ $type->id }})" onclick="confirm('Yakin ingin menghapus? Data komponen didalamnya juga akan terhapus.') || event.stopImmediatePropagation()" class="text-gray-400 hover:text-red-500 dark:hover:text-red-400">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-12 text-center bg-white dark:bg-gray-800 rounded-lg border border-dashed border-gray-300 dark:border-gray-700">
                    <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Belum Ada Unit</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Tambahkan jenis perangkat (Unit) pertama Anda.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit -->
    @if($showModal)
    <div class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity" aria-hidden="true" wire:click="closeModal"></div>

            <div class="relative inline-block bg-white dark:bg-gray-800 rounded-2xl p-6 text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:max-w-lg w-full">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-title">
                            {{ $isEdit ? 'Edit Tipe Perangkat' : 'Tambah Tipe Perangkat' }}
                        </h3>
                        <div class="mt-2">
                            <form wire:submit.prevent="save">
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama (Misal: Laptop / PC)</label>
                                    <input type="text" wire:model="name" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md">
                                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ikon (Emoji 💻 atau kode SVG)</label>
                                    <input type="text" wire:model="icon" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                                    <textarea wire:model="description" rows="3" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md"></textarea>
                                </div>
                                <div class="mt-8 flex flex-col sm:flex-row gap-3 pt-5 border-t border-gray-200 dark:border-gray-700">
                                    <button type="submit" class="w-full sm:w-1/2 flex justify-center items-center rounded-xl border border-transparent shadow-md hover:shadow-lg px-6 py-3 bg-primary-600 text-base font-bold text-white hover:bg-primary-700 transition-all sm:order-2">
                                        Simpan
                                    </button>
                                    <button type="button" wire:click="closeModal" class="w-full sm:w-1/2 flex justify-center items-center rounded-xl border border-gray-300 dark:border-gray-600 shadow-sm px-6 py-3 bg-white dark:bg-gray-800 text-base font-bold text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all sm:order-1">
                                        Batal
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

