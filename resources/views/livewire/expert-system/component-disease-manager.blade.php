<div>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('expert-system.components', $component->device_type_id) }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 bg-white dark:bg-gray-800 p-2 rounded-full shadow-sm border border-gray-200 dark:border-gray-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            <div>
                <div class="flex items-center gap-2">
                    <span class="text-xl">{!! $component->icon !!}</span>
                    <p class="page-header-title">Daftar Kerusakan: {{ $component->name }} ({{ $component->deviceType->name }})</p>
                </div>
                <p class="page-header-subtitle">Tambahkan jenis kerusakan/penyakit yang mungkin terjadi beserta solusinya</p>
            </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="w-full mx-auto">
            <div class="flex justify-end mb-4">
                <button wire:click="openModal" class="bg-gradient-to-r from-primary-600 to-primary-800 text-white px-5 py-2.5 rounded-xl font-bold flex items-center gap-2 shadow hover:shadow-lg transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Kerusakan
                </button>
            </div>
            @if (session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('message') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                <!-- Loop through Diseases -->
                @forelse($diseases as $disease)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-t-{{ $disease->level_color }}-500 flex flex-col hover:shadow-md transition relative">
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-start justify-between mb-4 border-b dark:border-gray-700 pb-4">
                            <div>
                                <span class="text-xs font-bold text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded border dark:border-gray-600">{{ $disease->code }}</span>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mt-2">{{ $disease->name }}</h3>
                            </div>
                            <span class="text-xs font-semibold px-2 py-1 rounded bg-{{ $disease->level_color }}-100 dark:bg-{{ $disease->level_color }}-900/30 text-{{ $disease->level_color }}-800 dark:text-{{ $disease->level_color }}-300 border border-{{ $disease->level_color }}-200 dark:border-{{ $disease->level_color }}-800">
                                {{ $disease->level }}
                            </span>
                        </div>

                        <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Penjelasan:</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 flex-grow mb-4">{{ \Illuminate\Support\Str::limit($disease->description, 100) }}</p>

                        <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Solusi / Tindakan:</p>
                        <p class="text-sm text-green-600 dark:text-green-400 font-medium mb-4 italic">{{ \Illuminate\Support\Str::limit($disease->solution, 60) }}</p>

                        <div class="mt-auto bg-gray-50 dark:bg-gray-700/50 px-3 py-2 rounded border border-gray-100 dark:border-gray-700 mb-4 text-center">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Estimasi Biaya Perbaikan</p>
                            <p class="text-sm font-bold text-gray-800 dark:text-gray-200">{{ $disease->cost_range }}</p>
                        </div>

                        <div class="border-t border-gray-200 dark:border-gray-700 pt-4 flex justify-between items-center">
                            <a href="{{ route('expert-system.rules', $disease->id) }}" class="text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 px-3 py-1.5 rounded flex items-center gap-1 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                Atur Gejala & Diagnosa
                            </a>
                            <div class="flex gap-4">
                                <button wire:click="edit({{ $disease->id }})" class="text-gray-400 hover:text-blue-500" title="Edit">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                </button>
                                <button wire:click="delete({{ $disease->id }})" onclick="confirm('Yakin ingin menghapus kerusakan ini beserta semua aturan gejalanya?') || event.stopImmediatePropagation()" class="text-gray-400 hover:text-red-500" title="Hapus">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-12 text-center bg-white dark:bg-gray-800 rounded-lg border border-dashed border-gray-300 dark:border-gray-700 shadow-sm">
                    <div class="text-6xl mb-4">🩺</div>
                    <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-gray-100">Belum Ada Data Kerusakan</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 mb-4">Tambahkan hasil identifikasi masalah (penyakit) yang sering terjadi pada komponen ini.</p>
                    <button wire:click="openModal" class="px-5 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-800 transition shadow-sm font-medium text-sm">Tambahkan Penyakit</button>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Modal Form Tambah/Edit Kerusakan -->
    @if($showModal)
    <div class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity" aria-hidden="true" wire:click="closeModal"></div>

            <div class="relative inline-block bg-white dark:bg-gray-800 rounded-xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:max-w-2xl sm:w-full">
                <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                    <h3 class="text-lg leading-6 font-bold text-gray-900 dark:text-white" id="modal-title">
                        {{ $isEdit ? 'Edit Data Penyakit' : 'Tambah Data Penyakit Baru' }}
                    </h3>
                </div>
                <div class="bg-white dark:bg-gray-800">
                    <form wire:submit.prevent="save">
                        <div class="px-6 pt-5 pb-6 space-y-5">
                            <!-- Nama Kerusakan -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Nama Kerusakan / Penyakit <span class="text-red-500">*</span></label>
                                <input type="text" wire:model="name" placeholder="Contoh: LCD Retak Dalam, Konslet Jalur VCORE..." class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md">
                                @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <!-- Tingkat Keparahan -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Tingkat Keparahan <span class="text-red-500">*</span></label>
                                <div class="grid grid-cols-3 gap-3">
                                    <label class="flex items-center justify-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition {{ $level === 'Ringan' ? 'border-green-500 bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-400' : 'text-gray-600 dark:text-gray-400 border-gray-300 dark:border-gray-600' }}">
                                        <input type="radio" wire:model="level" value="Ringan" class="sr-only">
                                        <span class="text-sm font-medium">✅ Ringan</span>
                                    </label>
                                    <label class="flex items-center justify-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition {{ $level === 'Sedang' ? 'border-yellow-500 bg-yellow-50 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400' : 'text-gray-600 dark:text-gray-400 border-gray-300 dark:border-gray-600' }}">
                                        <input type="radio" wire:model="level" value="Sedang" class="sr-only">
                                        <span class="text-sm font-medium">⚠️ Sedang</span>
                                    </label>
                                    <label class="flex items-center justify-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition {{ $level === 'Berat' ? 'border-red-500 bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400' : 'text-gray-600 dark:text-gray-400 border-gray-300 dark:border-gray-600' }}">
                                        <input type="radio" wire:model="level" value="Berat" class="sr-only">
                                        <span class="text-sm font-medium">🚫 Berat</span>
                                    </label>
                                </div>
                                @error('level') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <!-- Deskripsi & Solusi -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Deskripsi Penyakit <span class="text-red-500">*</span></label>
                                    <textarea wire:model="description" rows="3" placeholder="Penyebab utamanya adalah..." class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md"></textarea>
                                    @error('description') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Solusi / Tindakan <span class="text-red-500">*</span></label>
                                    <textarea wire:model="solution" rows="3" placeholder="Disarankan ganti komponen atau reball..." class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md"></textarea>
                                    @error('solution') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Estimasi Biaya -->
                            <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg border border-gray-200 dark:border-gray-600">
                                <label class="block text-sm font-bold text-gray-800 dark:text-gray-200 mb-3">Estimasi Biaya Servis (Rp)</label>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400">Biaya Minimal / Mulai Dari</label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-300 sm:text-sm">Rp</span>
                                            <input type="number" wire:model="min_cost" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-primary-500 focus:border-primary-500 sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                        </div>
                                        @error('min_cost') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400">Biaya Maksimal / Sampai</label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-300 sm:text-sm">Rp</span>
                                            <input type="number" wire:model="max_cost" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-primary-500 focus:border-primary-500 sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                        </div>
                                        @error('max_cost') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-3">*Biaya 0 artinya Gratis/Hanya Pengecekan</p>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 mt-6 pt-5 pb-6 px-6 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 rounded-b-xl">
                            <button type="submit" class="w-full sm:w-1/2 flex justify-center items-center rounded-xl border border-transparent shadow-md hover:shadow-lg px-6 py-3 bg-primary-600 text-base font-bold text-white hover:bg-primary-700 transition-all sm:order-2">
                                Simpan Data
                            </button>
                            <button type="button" wire:click="closeModal" class="w-full sm:w-1/2 flex justify-center items-center rounded-xl border border-gray-300 dark:border-gray-600 shadow-sm px-6 py-3 bg-white dark:bg-gray-800 text-base font-bold text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 transition-all sm:order-1">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

