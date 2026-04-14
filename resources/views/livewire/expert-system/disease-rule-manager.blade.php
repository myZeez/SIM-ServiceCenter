<div>
    <x-slot name="header">
        <div class="flex items-start gap-4">
            <a href="{{ route('expert-system.diseases', $disease->device_component_id) }}" class="mt-1 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 bg-white dark:bg-gray-800 p-2 rounded-full shadow-sm border border-gray-200 dark:border-gray-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white leading-tight">Aturan Gejala: {{ $disease->name }}</h2>
                <p class="page-header-subtitle mt-1 text-gray-600 dark:text-gray-400">Tambahkan pertanyaan/gejala yang akan mengarahkan pelanggan pada penyakit ini.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-4">
                <button wire:click="openModal" class="bg-gradient-to-r from-primary-600 to-primary-800 text-white px-5 py-2.5 rounded-xl font-bold flex items-center gap-2 shadow hover:shadow-lg transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Tambah Gejala
                </button>
            </div>
            @if (session()->has('message'))
                <div class="bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 rounded relative mb-4 shadow-sm" role="alert">
                    <span class="block sm:inline">{{ session('message') }}</span>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded relative mb-4 shadow-sm" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="px-4 py-5 sm:px-6 bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg leading-6 font-semibold text-gray-900 dark:text-white">
                        Indikator Penyakit
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                        Pertanyaan dan ciri-ciri jika perangkat mengalami "{{ $disease->name }}".
                    </p>
                </div>

                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($disease->symptoms as $symptom)
                        <li class="px-4 py-4 sm:px-6 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                            <div class="flex items-start gap-4 flex-1">
                                <div class="bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 p-2 rounded-full mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $symptom->name }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 italic">Pertanyaan bot: "{{ $symptom->follow_up_question ?? 'Apakah indikator ini terlihat?' }}"</p>
                                    <div class="mt-2 text-xs font-semibold px-2 py-1 bg-{{ $symptom->pivot->cf_value >= 0.8 ? 'green' : ($symptom->pivot->cf_value >= 0.5 ? 'yellow' : 'red') }}-100 dark:bg-{{ $symptom->pivot->cf_value >= 0.8 ? 'green' : ($symptom->pivot->cf_value >= 0.5 ? 'yellow' : 'red') }}-900/30 text-{{ $symptom->pivot->cf_value >= 0.8 ? 'green' : ($symptom->pivot->cf_value >= 0.5 ? 'yellow' : 'red') }}-800 dark:text-{{ $symptom->pivot->cf_value >= 0.8 ? 'green' : ($symptom->pivot->cf_value >= 0.5 ? 'yellow' : 'red') }}-400 rounded inline-block">
                                        Kemungkinan Benar (CF) : {{ $symptom->pivot->cf_value * 100 }}%
                                    </div>
                                </div>
                            </div>
                            <div class="ml-4">
                                <button wire:click="detachSymptom({{ $symptom->id }})" onclick="confirm('Tautan gejala ini akan dilepaskan dari penyakit. Lanjutkan?') || event.stopImmediatePropagation()" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 bg-red-50 dark:bg-red-900/30 hover:bg-red-100 dark:hover:bg-red-900/50 px-3 py-1 rounded text-sm font-medium transition border border-transparent dark:border-red-800/50">
                                    Lepas
                                </button>
                            </div>
                        </li>
                    @empty
                        <li class="px-4 py-8 text-center bg-gray-50 dark:bg-gray-800">
                            <span class="text-gray-500 dark:text-gray-400 font-medium">Kosong. Tambahkan gejala/pertanyaan pertama Anda!</span>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <!-- Modal Form Tambah Gejala -->
    @if($showModal)
    <div class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity" aria-hidden="true" wire:click="closeModal"></div>

            <div class="relative inline-block bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full">
                <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                    <h3 class="text-lg leading-6 font-bold text-gray-900 dark:text-white" id="modal-title">Hubungkan Gejala Valid</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Gejala apa yang menjadi ciri kuat jika <b class="dark:text-gray-300">{{ $disease->name }}</b>?</p>
                </div>

                <div class="bg-white dark:bg-gray-800">
                    <form wire:submit.prevent="save">
                        <div class="px-6 pt-5 pb-6 space-y-6">

                            <!-- Toggle Mode -->
                            <div class="bg-blue-50/50 dark:bg-blue-900/20 p-4 rounded-lg border border-blue-100 dark:border-blue-800">
                                <label class="flex items-center space-x-3">
                                    <input type="checkbox" wire:model="isExistingSymptom" class="form-checkbox h-5 w-5 text-primary-600 dark:text-primary-500 rounded dark:bg-gray-900 dark:border-gray-700">
                                    <span class="text-sm font-medium text-gray-800 dark:text-gray-200">Gejala sudah pernah ditambahkan sebelumnya? (Gunakan yang ada)</span>
                                </label>
                            </div>

                            @if($isExistingSymptom)
                                <!-- Pilih Gejala Eksisting -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Pilih Gejala dari Database</label>
                                    <select wire:model="existingSymptomId" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md">
                                        <option value="">-- Pilih Gejala --</option>
                                        @foreach($allSymptoms as $sym)
                                            <option value="{{ $sym->id }}">{{ $sym->name }} ({{ $sym->code }})</option>
                                        @endforeach
                                    </select>
                                    @error('existingSymptomId') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            @else
                                <!-- Buat Gejala Baru -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Nama Gejala Singkat</label>
                                    <input type="text" wire:model="name" placeholder="Contoh: Layar bergaris horizontal" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md">
                                    @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Pertanyaan Konfirmasi ke User (Sistem Pakar)</label>
                                    <textarea wire:model="follow_up_question" rows="2" placeholder="Contoh: Apakah layar laptop Anda memunculkan garis warna-warni secara horizontal?" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md"></textarea>
                                    @error('follow_up_question') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            @endif

                            <div class="border-t dark:border-gray-700 pt-4">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Tingkat Keyakinan Gejala (Certainty Factor)</label>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Seberapa yakin gejala ini menandakan penyakit tersebut?</p>

                                <div class="grid grid-cols-2 gap-3">
                                    <label class="flex items-center gap-2 p-2 border dark:border-gray-600 rounded cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition {{ $cf_value == '0.4' ? 'border-primary-500 bg-primary-50 dark:border-primary-500 dark:bg-primary-900/30' : '' }}">
                                        <input type="radio" wire:model="cf_value" value="0.4" class="text-primary-600 focus:ring-primary-500 dark:bg-gray-900 dark:border-gray-700">
                                        <span class="text-sm dark:text-gray-300">Rendah (40%)</span>
                                    </label>
                                    <label class="flex items-center gap-2 p-2 border dark:border-gray-600 rounded cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition {{ $cf_value == '0.6' ? 'border-primary-500 bg-primary-50 dark:border-primary-500 dark:bg-primary-900/30' : '' }}">
                                        <input type="radio" wire:model="cf_value" value="0.6" class="text-primary-600 focus:ring-primary-500 dark:bg-gray-900 dark:border-gray-700">
                                        <span class="text-sm dark:text-gray-300">Cukup (60%)</span>
                                    </label>
                                    <label class="flex items-center gap-2 p-2 border dark:border-gray-600 rounded cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition {{ $cf_value == '0.8' ? 'border-primary-500 bg-primary-50 dark:border-primary-500 dark:bg-primary-900/30' : '' }}">
                                        <input type="radio" wire:model="cf_value" value="0.8" class="text-primary-600 focus:ring-primary-500 dark:bg-gray-900 dark:border-gray-700">
                                        <span class="text-sm dark:text-gray-300">Kuat (80%)</span>
                                    </label>
                                    <label class="flex items-center gap-2 p-2 border dark:border-gray-600 rounded cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition {{ $cf_value == '1.0' ? 'border-primary-500 bg-primary-50 dark:border-primary-500 dark:bg-primary-900/30' : '' }}">
                                        <input type="radio" wire:model="cf_value" value="1.0" class="text-primary-600 focus:ring-primary-500 dark:bg-gray-900 dark:border-gray-700">
                                        <span class="text-sm dark:text-gray-300">Pasti (100%)</span>
                                    </label>
                                </div>
                                @error('cf_value') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mt-8 flex flex-col sm:flex-row gap-3 pt-5 border-t border-gray-200 dark:border-gray-700 pb-5 px-6">
                            <button type="submit" class="w-full sm:w-1/2 flex justify-center items-center rounded-xl border border-transparent shadow-md hover:shadow-lg px-6 py-3 bg-primary-600 text-base font-bold text-white hover:bg-primary-700 transition-all sm:order-2">
                                Simpan Gejala
                            </button>
                            <button type="button" wire:click="closeModal" class="w-full sm:w-1/2 flex justify-center items-center rounded-xl border border-gray-300 dark:border-gray-600 shadow-sm px-6 py-3 bg-white dark:bg-gray-700 text-base font-bold text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 transition-all sm:order-1">
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

