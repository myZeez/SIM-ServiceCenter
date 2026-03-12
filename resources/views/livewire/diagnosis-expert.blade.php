<div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
    {{-- Background Decorations --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-500/10 dark:bg-blue-500/5 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-indigo-600/10 dark:bg-indigo-600/5 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-4xl mx-auto px-4 py-8">
        {{-- Header --}}
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <span class="text-2xl font-bold text-gray-800 dark:text-white">Cellcom</span>
            </a>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-2">
                Sistem Pakar Diagnosis {{ $selectedDeviceType ? ($deviceTypes[$selectedDeviceType] ?? 'Perangkat') : 'Perangkat' }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400">
                Diagnosa masalah perangkat Anda dengan cepat dan akurat
            </p>
        </div>

        {{-- Main Content --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">

            {{-- STEP: SELECT DEVICE --}}
            @if($step === 'select_device')
                <div class="p-8 md:p-12 text-center">
                    <div class="w-24 h-24 bg-gradient-to-br from-blue-100 to-indigo-100 dark:from-blue-900/30 dark:to-indigo-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>

                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                        Pilih Jenis Perangkat
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-8 max-w-lg mx-auto">
                        Tentukan perangkat mana yang ingin Anda diagnosis.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 max-w-2xl mx-auto">
                        @foreach($deviceTypes as $key => $label)
                        <button wire:click="selectDevice('{{ $key }}')" class="p-6 bg-gray-50 dark:bg-gray-700/50 rounded-xl border-2 border-transparent hover:border-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all duration-200 text-center">
                            <div class="text-3xl mb-3">
                                @if($key === 'laptop') 💻 @elseif($key === 'pc') 🖥️ @elseif($key === 'aio') 🖥️ @elseif($key === 'printer') 🖨️ @endif
                            </div>
                            <h3 class="font-semibold text-gray-900 dark:text-white">{{ $label }}</h3>
                        </button>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- STEP: WELCOME --}}
            @if($step === 'welcome')
                <div class="p-8 md:p-12 text-center">
                    <div class="w-24 h-24 bg-gradient-to-br from-blue-100 to-indigo-100 dark:from-blue-900/30 dark:to-indigo-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>

                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                        Selamat Datang di Sistem Diagnosis
                    </h2>

                    <p class="text-gray-600 dark:text-gray-400 mb-8 max-w-lg mx-auto">
                        Sistem ini akan membantu Anda mendiagnosis masalah {{ $selectedDeviceType ? ($deviceTypes[$selectedDeviceType] ?? 'perangkat') : 'perangkat' }} dengan menjawab beberapa pertanyaan sederhana.
                        Hasil diagnosis akan memberikan kemungkinan kerusakan dan solusi yang disarankan.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8 text-left max-w-2xl mx-auto">
                        <div class="flex items-start gap-3 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                            <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center flex-shrink-0">
                                <span class="text-blue-600 dark:text-blue-400 font-bold text-sm">1</span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 dark:text-white text-sm">Jawab Pertanyaan</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Pilih Ya/Tidak sesuai kondisi perangkat</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                            <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center flex-shrink-0">
                                <span class="text-green-600 dark:text-green-400 font-bold text-sm">2</span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 dark:text-white text-sm">Lihat Hasil</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Dapatkan diagnosis & rekomendasi AI</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                            <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center flex-shrink-0">
                                <span class="text-purple-600 dark:text-purple-400 font-bold text-sm">3</span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 dark:text-white text-sm">Booking Servis</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Langsung booking jika perlu</p>
                            </div>
                        </div>
                    </div>

                    <button wire:click="startDiagnosis" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Mulai Diagnosis
                    </button>
                </div>
            @endif

            {{-- STEP: QUESTIONS --}}
            @if($step === 'questions')
                <div class="p-6 md:p-8">
                    {{-- Progress Bar --}}
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Progress Diagnosis</span>
                            <span class="text-sm font-bold text-blue-600 dark:text-blue-400">{{ $progress }}%</span>
                        </div>
                        <div class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full transition-all duration-500" style="width: {{ $progress }}%"></div>
                        </div>
                    </div>

                    @if($currentQuestion)
                        {{-- Category Badge --}}
                        <div class="mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                Kategori: {{ $currentQuestion['category'] }}
                            </span>
                        </div>

                        {{-- Question Card --}}
                        <div class="bg-gradient-to-br from-gray-50 to-blue-50 dark:from-gray-700/50 dark:to-gray-700/30 rounded-xl p-6 mb-6">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $currentQuestion['question'] }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                        Kode Gejala: {{ $currentQuestion['code'] }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Answer Buttons --}}
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <button wire:click="answerQuestion('{{ $currentQuestion['code'] }}', true)"
                                class="flex items-center justify-center gap-3 p-4 bg-green-50 dark:bg-green-900/20 hover:bg-green-100 dark:hover:bg-green-900/30 border-2 border-green-200 dark:border-green-800 rounded-xl transition-all duration-200 group">
                                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-lg font-semibold text-green-700 dark:text-green-300">Ya</span>
                            </button>

                            <button wire:click="answerQuestion('{{ $currentQuestion['code'] }}', false)"
                                class="flex items-center justify-center gap-3 p-4 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30 border-2 border-red-200 dark:border-red-800 rounded-xl transition-all duration-200 group">
                                <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </div>
                                <span class="text-lg font-semibold text-red-700 dark:text-red-300">Tidak</span>
                            </button>
                        </div>

                        {{-- Skip & Navigation --}}
                        <div class="flex justify-between items-center">
                            <button wire:click="skipCategory" class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition-colors">
                                Skip kategori ini →
                            </button>
                            <button wire:click="processDiagnosis" class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-200 font-medium transition-colors">
                                Selesaikan & Lihat Hasil
                            </button>
                        </div>
                    @endif
                </div>
            @endif

            {{-- STEP: RESULT --}}
            @if($step === 'result')
                <div class="p-6 md:p-8">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Hasil Diagnosis</h2>
                        <p class="text-gray-600 dark:text-gray-400">Berdasarkan {{ count($selectedSymptoms) }} gejala yang Anda pilih</p>
                    </div>

                    @if(count($diagnosisResults) > 0)
                        {{-- Diagnosis Results --}}
                        <div class="space-y-4 mb-8">
                            @foreach($diagnosisResults as $index => $result)
                                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-5 border {{ $index === 0 ? 'border-blue-300 dark:border-blue-700' : 'border-gray-200 dark:border-gray-600' }}">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex items-center gap-3">
                                            @if($index === 0)
                                                <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-xs font-semibold rounded-full">
                                                    Paling Mungkin
                                                </span>
                                            @endif
                                            <span class="px-2 py-1 text-xs font-medium rounded-full
                                                {{ $result['severity'] === 'high' ? 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300' : '' }}
                                                {{ $result['severity'] === 'medium' ? 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300' : '' }}
                                                {{ $result['severity'] === 'low' ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300' : '' }}
                                            ">
                                                {{ $result['severity'] === 'high' ? 'Serius' : ($result['severity'] === 'medium' ? 'Sedang' : 'Ringan') }}
                                            </span>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $result['confidence'] }}%</span>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Keyakinan</p>
                                        </div>
                                    </div>

                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3">{{ $result['name'] }}</h3>

                                    <div class="space-y-2">
                                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Tindakan yang Disarankan:</p>
                                        <ul class="space-y-1">
                                            @foreach($result['actions'] as $action)
                                                <li class="flex items-start gap-2 text-sm text-gray-600 dark:text-gray-400">
                                                    <svg class="w-4 h-4 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    {{ $action }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    @else
                        {{-- No Results --}}
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-yellow-100 dark:bg-yellow-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Tidak Ada Diagnosis yang Cocok</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">Tidak ada gejala yang dipilih atau gejala tidak sesuai dengan database kami.</p>
                        </div>
                    @endif

                    {{-- Action Buttons --}}
                    <div class="flex flex-col sm:flex-row gap-4">
                        @if(count($diagnosisResults) > 0)
                            <button wire:click="showBookingForm" class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Booking Servis Sekarang
                            </button>
                        @endif
                        <button wire:click="resetDiagnosis" class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 font-semibold rounded-xl transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Mulai Ulang Diagnosis
                        </button>
                    </div>
                </div>
            @endif

            {{-- STEP: BOOKING --}}
            @if($step === 'booking')
                <div class="p-6 md:p-8">
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Form Booking Servis</h2>
                        <p class="text-gray-600 dark:text-gray-400">Isi data berikut untuk melakukan booking</p>
                    </div>

                    <form wire:submit="saveBooking" class="space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            {{-- Nama --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" wire:model="bookingForm.name" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan nama lengkap">
                                @error('bookingForm.name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            {{-- Phone --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nomor WhatsApp <span class="text-red-500">*</span></label>
                                <input type="text" wire:model="bookingForm.phone" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="08xxxxxxxxxx">
                                @error('bookingForm.phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            {{-- Device Brand --}}
                            <div>
                                @php
                                    $devLabel = $selectedDeviceType ? ($deviceTypes[$selectedDeviceType] ?? 'Perangkat') : 'Perangkat';
                                    $brandList = match($selectedDeviceType) {
                                        'pc' => ['ASUS','Acer','Lenovo','HP','Dell','MSI','Gigabyte','ASRock','Samsung','Lainnya'],
                                        'aio' => ['ASUS','Acer','Lenovo','HP','Dell','Apple','MSI','Samsung','Lainnya'],
                                        'printer' => ['HP','Canon','Epson','Brother','Samsung','Xerox','Fuji Xerox','Kyocera','Ricoh','Lainnya'],
                                        default => ['ASUS','Acer','Lenovo','HP','Dell','Apple (MacBook)','MSI','Toshiba','Samsung','Lainnya'],
                                    };
                                @endphp
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Merek {{ $devLabel }} <span class="text-red-500">*</span></label>
                                <select wire:model="bookingForm.device_brand" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Merek</option>
                                    @foreach($brandList as $brand)
                                    <option value="{{ $brand }}">{{ $brand }}</option>
                                    @endforeach
                                </select>
                                @error('bookingForm.device_brand') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            {{-- Device Name --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipe {{ $devLabel }} <span class="text-red-500">*</span></label>
                                <input type="text" wire:model="bookingForm.device_name" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: {{ match($selectedDeviceType) { 'printer' => 'L3210, LaserJet Pro', 'pc' => 'ROG G21, Inspiron 3020', 'aio' => 'Vivo AiO V241, iMac 24', default => 'ROG Strix G15, ThinkPad X1' } }}">
                                @error('bookingForm.device_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            {{-- Serial Number --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Serial Number <span class="text-gray-400">(Opsional)</span></label>
                                <input type="text" wire:model="bookingForm.serial_number" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Lihat di bagian bawah perangkat">
                            </div>

                            {{-- Address --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Alamat <span class="text-gray-400">(Opsional)</span></label>
                                <input type="text" wire:model="bookingForm.address" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Alamat Anda">
                            </div>
                        </div>

                        {{-- Complaint --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Keluhan / Masalah <span class="text-red-500">*</span></label>
                            <textarea wire:model="bookingForm.complaint" rows="4" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Jelaskan keluhan perangkat Anda"></textarea>
                            @error('bookingForm.complaint') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Keluhan sudah terisi otomatis dari hasil diagnosis</p>
                        </div>

                        {{-- Buttons --}}
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Simpan Booking
                            </button>
                            <button type="button" wire:click="$set('step', 'result')" class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 font-semibold rounded-xl transition-all duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali
                            </button>
                        </div>
                    </form>
                </div>
            @endif

            {{-- STEP: SUCCESS --}}
            @if($step === 'success')
                <div class="p-8 md:p-12 text-center">
                    <div class="w-24 h-24 bg-gradient-to-br from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>

                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                        Booking Berhasil! 🎉
                    </h2>

                    <p class="text-gray-600 dark:text-gray-400 mb-6 max-w-md mx-auto">
                        Booking servis Anda telah tersimpan. Silakan datang ke Cellcom dengan menunjukkan kode booking berikut.
                    </p>

                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-xl p-6 mb-8 max-w-sm mx-auto border-2 border-dashed border-blue-300 dark:border-blue-700">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Kode Booking Anda:</p>
                        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400 tracking-wider">{{ $bookingCode }}</p>
                    </div>

                    <div class="bg-yellow-50 dark:bg-yellow-900/20 rounded-xl p-4 mb-8 max-w-md mx-auto border border-yellow-200 dark:border-yellow-800">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="text-left text-sm">
                                <p class="font-medium text-yellow-800 dark:text-yellow-200">Penting!</p>
                                <p class="text-yellow-700 dark:text-yellow-300">Simpan kode booking ini. Screenshot atau catat untuk ditunjukkan saat datang ke service center.</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <button wire:click="resetDiagnosis" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Kembali ke Awal
                        </button>
                    </div>
                </div>
            @endif
        </div>

        {{-- Footer Info --}}
        <div class="text-center mt-8 text-sm text-gray-500 dark:text-gray-400">
            <p>📍 Lokasi: Cellcom Service Center</p>
            <p>📞 Hubungi: 0812-xxxx-xxxx</p>
        </div>
    </div>
</div>
