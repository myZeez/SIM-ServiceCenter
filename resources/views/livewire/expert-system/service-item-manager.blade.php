<div>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('expert-system.services') }}" class="text-gray-400 hover:text-gray-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            <div>
                <p class="page-header-title">Daftar Sub-Layanan: {{ $category->name }} {!! $category->icon !!}</p>
                <p class="page-header-subtitle">Kelola item detail untuk kategori layanan ini beserta harganya.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="w-full mx-auto">
            <div class="flex justify-end mb-4">
                <button wire:click="openModal" class="bg-gradient-to-r from-primary-600 to-primary-800 text-white px-5 py-2.5 rounded-xl font-bold flex items-center gap-2 shadow hover:shadow-lg transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Sub-Layanan
                </button>
            </div>
            @if (session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('message') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700">
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($items as $key => $item)
                        <li class="p-6 flex flex-col md:flex-row md:items-center md:justify-between hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <div class="flex flex-col flex-1">
                                <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $item['label'] ?? '' }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $item['desc'] ?? '' }}</p>
                                @if(isset($item['note']) && $item['note'])
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1 italic">{{ $item['note'] }}</p>
                                @endif
                                <div class="mt-2 inline-flex">
                                    <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300 text-xs font-semibold px-2.5 py-0.5 rounded shadow-sm border border-blue-200 dark:border-blue-800">
                                        {{ $item['price'] ?? 'Gratis / Call' }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 mt-4 md:mt-0 md:ml-6">
                                <button wire:click="edit('{{ $key }}')" class="flex items-center justify-center p-2 rounded-lg bg-orange-50 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 hover:bg-orange-100 dark:hover:bg-orange-900 transition">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </button>
                                <button wire:click="delete('{{ $key }}')" onclick="confirm('Yakin ingin menghapus item ini?') || event.stopImmediatePropagation()" class="flex items-center justify-center p-2 rounded-lg bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900 transition">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </li>
                    @empty
                        <li class="p-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Belum Ada Item Layanan</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Tambahkan daftar layanan seperti Cleaning, Ganti Part, dsb di sini.</p>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit -->
    @if($showModal)
    <div class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity" aria-hidden="true" wire:click="closeModal"></div>

            <div class="relative inline-block bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full sm:p-8">
                <div class="w-full">
                    <div class="mt-3 text-center sm:text-left w-full">
                        <h3 class="text-xl leading-6 font-bold text-gray-900 dark:text-white border-b dark:border-gray-700 pb-4 mb-4" id="modal-title">
                            {{ $isEdit ? 'Edit Sub-Layanan' : 'Tambah Sub-Layanan Baru' }}
                        </h3>
                        <div class="mt-2">
                            <form wire:submit.prevent="save">
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Judul Layanan *</label>
                                    <input type="text" wire:model="label" placeholder="Misal: Cleaning All" class="focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl px-4 py-2">
                                    @error('label') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Harga / Biaya (Opsional)</label>
                                    <input type="text" wire:model="price" placeholder="Misal: Rp 155.000" class="focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl px-4 py-2">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi Utama *</label>
                                    <textarea wire:model="description" rows="2" placeholder="Misal: Pembersihan menyeluruh luar dalam..." class="focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl px-4 py-2"></textarea>
                                    @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-5">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Catatan Khusus (Opsional)</label>
                                    <textarea wire:model="note" rows="2" placeholder="Misal: Termasuk ganti pasta..." class="focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl px-4 py-2"></textarea>
                                </div>
                                <div class="mt-8 flex flex-col sm:flex-row gap-3 pt-5 pb-2 border-t border-gray-200 dark:border-gray-700">
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


