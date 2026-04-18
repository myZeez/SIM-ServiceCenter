<div class="status-root">

    {{-- ===================== ANIMATED BACKGROUND ===================== --}}
    <div class="bg-animated" aria-hidden="true">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
        <div class="grid-overlay"></div>
    </div>

    {{-- ===================== CONTENT ===================== --}}
    <div class="content-wrap">

        {{-- Top Bar --}}
        <div class="top-bar">
            <a href="{{ route('diagnosis') }}" class="brand">
                @php $appLogo = \App\Models\Setting::where('key', 'app_logo')->value('value'); @endphp
                @if ($appLogo)
                    <img src="{{ asset('storage/' . $appLogo) }}" alt="Logo" class="w-5 h-5 object-contain mr-1 rounded-sm" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <div class="brand-dot" style="display: none;"></div>
                @else
                    <div class="brand-dot"></div>
                @endif
                <span>Cellcom Expert System</span>
            </a>
            <a href="{{ route('diagnosis') }}" class="reset-btn">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali
            </a>
        </div>

        {{-- Hero --}}
        <div class="hero-block anim-up">
            <div class="hero-icon" style="background: linear-gradient(135deg, #0ea5e9, #6366f1);">
                <svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="white">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
            </div>
            <h1 class="hero-title" style="background: linear-gradient(135deg, #fff 30%, #7dd3fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Cek Status Servis</h1>
            <p class="hero-sub">Masukkan nomor tiket atau nomor HP untuk melihat progres pengerjaan</p>
        </div>

        {{-- Search Card --}}
        <div class="search-card anim-up" style="animation-delay: .08s;">
            <div class="search-tabs">
                <button class="search-tab {{ $searchType === 'ticket' ? 'active' : '' }}"
                    wire:click="$set('searchType', 'ticket')">
                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                    Nomor Tiket
                </button>
                <button class="search-tab {{ $searchType === 'phone' ? 'active' : '' }}"
                    wire:click="$set('searchType', 'phone')">
                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    Nomor HP
                </button>
            </div>

            <form wire:submit.prevent="check" class="search-form">
                <div class="search-input-wrap">
                    <div class="search-icon">
                        @if($searchType === 'ticket')
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                        @else
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        @endif
                    </div>
                    <input
                        type="text"
                        wire:model="search"
                        class="search-input"
                        placeholder="{{ $searchType === 'ticket' ? 'Tiket (SRV-...) atau Kode Booking (BK-...)' : 'Contoh: 08123456789' }}"
                        autocomplete="off"
                    >
                    @if($search)
                    <button type="button" wire:click="resetSearch" class="search-clear">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                    @endif
                </div>
                <button type="submit" class="search-btn"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="check">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Cek Sekarang
                    </span>
                    <span wire:loading wire:target="check" style="display:flex;align-items:center;gap:8px;">
                        <svg class="spin" width="18" height="18" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" style="opacity:.25"/><path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                        Mencari...
                    </span>
                </button>
            </form>
        </div>

        {{-- Error State --}}
        @if($searched && $errorMessage)
        <div class="status-empty anim-up">
            <div class="empty-icon">🔍</div>
            <h3 class="empty-title">Tidak Ditemukan</h3>
            <p class="empty-sub">{{ $errorMessage }}</p>
            <button wire:click="resetSearch" class="empty-reset-btn">Coba Lagi</button>
        </div>
        @endif

        {{-- Result Card --}}
        @if($service)
        @php
            $statusMap = [
                'Pending'          => ['label' => 'Menunggu Antrian',    'color' => '#f59e0b', 'bg' => 'rgba(245,158,11,0.12)',  'border' => 'rgba(245,158,11,0.25)', 'icon' => '⏳'],
                'Diagnosis'        => ['label' => 'Proses Diagnosis',    'color' => '#3b82f6', 'bg' => 'rgba(59,130,246,0.12)',  'border' => 'rgba(59,130,246,0.25)', 'icon' => '🔬'],
                'In Progress'      => ['label' => 'Sedang Dikerjakan',   'color' => '#8b5cf6', 'bg' => 'rgba(139,92,246,0.12)',  'border' => 'rgba(139,92,246,0.25)', 'icon' => '🔧'],
                'Waiting Part'     => ['label' => 'Menunggu Part',       'color' => '#a855f7', 'bg' => 'rgba(168,85,247,0.12)',  'border' => 'rgba(168,85,247,0.25)', 'icon' => '📦'],
                'Waiting Approval' => ['label' => 'Menunggu Persetujuan','color' => '#f97316', 'bg' => 'rgba(249,115,22,0.12)',  'border' => 'rgba(249,115,22,0.25)', 'icon' => '📋'],
                'Done'             => ['label' => 'Selesai - Siap Ambil','color' => '#22c55e', 'bg' => 'rgba(34,197,94,0.12)',   'border' => 'rgba(34,197,94,0.25)',  'icon' => '✅'],
                'Taken'            => ['label' => 'Sudah Diambil',       'color' => '#10b981', 'bg' => 'rgba(16,185,129,0.12)',  'border' => 'rgba(16,185,129,0.25)', 'icon' => '🎉'],
                'Cancelled'        => ['label' => 'Dibatalkan',          'color' => '#ef4444', 'bg' => 'rgba(239,68,68,0.12)',   'border' => 'rgba(239,68,68,0.25)',  'icon' => '❌'],
            ];
            $st = $statusMap[$service->status] ?? ['label' => $service->status, 'color' => '#94a3b8', 'bg' => 'rgba(148,163,184,0.1)', 'border' => 'rgba(148,163,184,0.2)', 'icon' => '📋'];
        @endphp

        <div class="result-wrap anim-up">

            {{-- Status Badge --}}
            <div class="result-status-pill" style="background: {{ $st['bg'] }}; border: 1px solid {{ $st['border'] }}; color: {{ $st['color'] }};">
                <span>{{ $st['icon'] }}</span>
                <span>Status: <strong>{{ $st['label'] }}</strong></span>
            </div>

            {{-- Main Card --}}
            <div class="result-card">
                {{-- Card Header --}}
                <div class="result-card-header" style="background: linear-gradient(135deg, #0ea5e9, #6366f1);">
                    <div class="result-header-icon">
                        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="white"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <div>
                        <h3 class="result-card-title">Detail Servis</h3>
                        <p class="result-card-sub">Tiket #{{ $service->ticket_number }}</p>
                    </div>
                </div>

                {{-- Info Grid --}}
                <div class="result-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Nama Pelanggan</span>
                            <span class="info-value">{{ $service->customer->name ?? '-' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Nomor HP</span>
                            <span class="info-value">{{ $service->customer->phone ?? '-' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Perangkat</span>
                            <span class="info-value">{{ $service->device_name ?? '-' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Tipe Servis</span>
                            <span class="info-value">{{ $service->service_type === 'warranty' ? 'Garansi' : 'Reguler' }}</span>
                        </div>
                        <div class="info-item full">
                            <span class="info-label">Keluhan</span>
                            <span class="info-value">{{ $service->complaint ?? '-' }}</span>
                        </div>
                        @if($service->diagnosis_result)
                        <div class="info-item full">
                            <span class="info-label">Hasil Diagnosis</span>
                            <span class="info-value diagnosis-val">{{ $service->diagnosis_result }}</span>
                        </div>
                        @endif
                        @if($service->user)
                        <div class="info-item">
                            <span class="info-label">Teknisi</span>
                            <span class="info-value">{{ $service->user->name }}</span>
                        </div>
                        @endif
                        @if($service->estimated_cost)
                        <div class="info-item">
                            <span class="info-label">Estimasi Biaya</span>
                            <span class="info-value cost-val">Rp {{ number_format($service->estimated_cost, 0, ',', '.') }}</span>
                        </div>
                        @endif
                        @if($service->status === 'completed' || $service->status === 'taken')
                        <div class="info-item">
                            <span class="info-label">Total Biaya</span>
                            <span class="info-value cost-val final">Rp {{ number_format($service->total_cost ?? 0, 0, ',', '.') }}</span>
                        </div>
                        @endif
                        <div class="info-item">
                            <span class="info-label">Masuk Sejak</span>
                            <span class="info-value">{{ $service->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        @if($service->completed_at)
                        <div class="info-item">
                            <span class="info-label">Selesai Pada</span>
                            <span class="info-value">{{ $service->completed_at->format('d M Y, H:i') }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Timeline --}}
                @if($service->serviceLogs && $service->serviceLogs->count() > 0)
                <div class="timeline-section">
                    <div class="timeline-title">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Riwayat Progres
                    </div>
                    <div class="timeline">
                        @foreach($service->serviceLogs->sortByDesc('created_at') as $log)
                        @php
                            $logSt = $statusMap[$log->status] ?? ['color' => '#94a3b8', 'icon' => '📋', 'label' => ucfirst($log->status)];
                        @endphp
                        <div class="timeline-item">
                            <div class="timeline-dot" style="background: {{ $logSt['color'] }}; box-shadow: 0 0 8px {{ $logSt['color'] }}60;"></div>
                            <div class="timeline-content">
                                <div class="timeline-top">
                                    <span class="timeline-status" style="color: {{ $logSt['color'] }}; background: {{ $logSt['bg'] ?? 'rgba(148,163,184,0.1)' }};">{{ $logSt['icon'] }} {{ $logSt['label'] }}</span>
                                    <span class="timeline-date">{{ $log->created_at->format('d M Y, H:i') }}</span>
                                </div>
                                @if($log->description)
                                <p class="timeline-desc">{{ $log->description }}</p>
                                @endif
                                @if($log->user)
                                <span class="timeline-tech">oleh {{ $log->user->name }}</span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Footer CTA --}}
                <div class="result-footer">
                    @if(in_array($service->status, ['Done', 'Taken']))
                    <div class="ready-notice">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#22c55e"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Perangkat Anda <strong>sudah selesai dikerjakan</strong> {{ $service->status === 'Done' ? 'dan siap diambil!' : '— terima kasih telah menggunakan layanan kami.' }}</span>
                    </div>
                    @elseif($service->status === 'Pending')
                    <div class="ready-notice" style="background: rgba(245,158,11,0.07); border-color: rgba(245,158,11,0.2);">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#f59e0b"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Perangkat Anda <strong>sedang menunggu antrian</strong> pengerjaan.</span>
                    </div>
                    @elseif(in_array($service->status, ['In Progress', 'Diagnosis']))
                    <div class="ready-notice" style="background: rgba(59,130,246,0.07); border-color: rgba(59,130,246,0.2);">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#3b82f6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>Saat ini perangkat Anda <strong>sedang dalam proses pengerjaan</strong> oleh teknisi.</span>
                    </div>
                    @elseif($service->status === 'Waiting Part')
                    <div class="ready-notice" style="background: rgba(168,85,247,0.07); border-color: rgba(168,85,247,0.2);">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#a855f7"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        <span>Perangkat Anda <strong>sedang menunggu ketersediaan sparepart</strong>.</span>
                    </div>
                    @endif
                    <button wire:click="resetSearch" class="search-again-btn">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Cari Tiket Lain
                    </button>
                </div>
            </div>
        </div>
        @endif

        {{-- Booking Result (when only booking code found, service not yet created) --}}
        @if($booking && !$service)
        @php
            $bkStatusMap = [
                'pending'     => ['label' => 'Menunggu Konfirmasi', 'color' => '#f59e0b', 'bg' => 'rgba(245,158,11,0.12)', 'border' => 'rgba(245,158,11,0.25)', 'icon' => '⏳'],
                'confirmed'   => ['label' => 'Booking Dikonfirmasi','color' => '#3b82f6', 'bg' => 'rgba(59,130,246,0.12)', 'border' => 'rgba(59,130,246,0.25)', 'icon' => '✔️'],
                'in_progress' => ['label' => 'Sedang Diproses',    'color' => '#8b5cf6', 'bg' => 'rgba(139,92,246,0.12)', 'border' => 'rgba(139,92,246,0.25)', 'icon' => '🔧'],
                'completed'   => ['label' => 'Selesai',             'color' => '#22c55e', 'bg' => 'rgba(34,197,94,0.12)',  'border' => 'rgba(34,197,94,0.25)',  'icon' => '✅'],
                'cancelled'   => ['label' => 'Dibatalkan',          'color' => '#ef4444', 'bg' => 'rgba(239,68,68,0.12)',  'border' => 'rgba(239,68,68,0.25)',  'icon' => '❌'],
            ];
            $bst = $bkStatusMap[$booking->status] ?? ['label' => ucfirst($booking->status), 'color' => '#94a3b8', 'bg' => 'rgba(148,163,184,0.1)', 'border' => 'rgba(148,163,184,0.2)', 'icon' => '📋'];
        @endphp
        <div class="result-wrap anim-up">
            <div class="result-status-pill" style="background: {{ $bst['bg'] }}; border: 1px solid {{ $bst['border'] }}; color: {{ $bst['color'] }};">
                <span>{{ $bst['icon'] }}</span>
                <span>Status Booking: <strong>{{ $bst['label'] }}</strong></span>
            </div>
            <div class="result-card">
                <div class="result-card-header" style="background: linear-gradient(135deg, #059669, #0d9488);">
                    <div class="result-header-icon">
                        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="white"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <div>
                        <h3 class="result-card-title">Detail Booking</h3>
                        <p class="result-card-sub">Kode Booking #{{ $booking->booking_code }}</p>
                    </div>
                </div>
                <div class="result-body">
                    <div class="info-grid">
                        <div class="info-item"><span class="info-label">Nama</span><span class="info-value">{{ $booking->name }}</span></div>
                        <div class="info-item"><span class="info-label">Nomor HP</span><span class="info-value">{{ $booking->phone }}</span></div>
                        <div class="info-item"><span class="info-label">Perangkat</span><span class="info-value">{{ $booking->device_brand }} {{ $booking->device_name }}</span></div>
                        <div class="info-item"><span class="info-label">Tanggal Booking</span><span class="info-value">{{ $booking->created_at->format('d M Y, H:i') }}</span></div>
                        @if($booking->complaint)
                        <div class="info-item full"><span class="info-label">Keluhan</span><span class="info-value">{{ $booking->complaint }}</span></div>
                        @endif
                    </div>
                    <div class="ready-notice" style="background:rgba(14,165,233,0.07);border-color:rgba(14,165,233,0.2);margin-top:8px;">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#0ea5e9"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Booking Anda sudah tercatat. <strong>Bawa perangkat Anda ke service center</strong> untuk memulai proses perbaikan. Tiket servis akan dibuat saat kedatangan.</span>
                    </div>
                </div>
                <div class="result-footer">
                    <button wire:click="resetSearch" class="search-again-btn">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Cari Lagi
                    </button>
                </div>
            </div>
        </div>
        @endif

        {{-- Initial Hint (before search) --}}
        @if(!$searched)
        <div class="hint-cards anim-up" style="animation-delay: .14s;">
            <div class="hint-card">
                <div class="hint-icon">🎫</div>
                <div class="hint-text">
                    <strong>Nomor Tiket / Kode Booking</strong>
                    <span>Tiket servis (SRV-...) dari admin atau kode booking (BK-...) dari hasil diagnosis online</span>
                </div>
            </div>
            <div class="hint-card">
                <div class="hint-icon">📱</div>
                <div class="hint-text">
                    <strong>Nomor HP</strong>
                    <span>Gunakan nomor yang terdaftar saat booking. Akan menampilkan servis terbaru</span>
                </div>
            </div>
        </div>
        @endif

        {{-- Footer --}}
        <p class="footnote" style="margin-top: 48px;">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Butuh bantuan? Hubungi kami langsung di service center.
        </p>

    </div>{{-- /content-wrap --}}

    <style>
    /* =========================================
       REUSE FROM DIAGNOSIS-CHAT
    ========================================= */
    .status-root {
        min-height: 100vh;
        background: #0f0f1a;
        color: #f1f5f9;
        font-family: 'Inter', system-ui, sans-serif;
        position: relative;
        overflow-x: hidden;
    }
    .bg-animated {
        position: fixed; inset: 0; z-index: 0;
        pointer-events: none; overflow: hidden;
    }
    .orb {
        position: absolute; border-radius: 50%;
        filter: blur(80px); opacity: 0.18;
        animation: float 12s ease-in-out infinite;
    }
    .orb-1 { width:600px;height:600px; background: radial-gradient(circle,#6366f1,#8b5cf6); top:-200px;left:-150px; animation-duration:15s; }
    .orb-2 { width:500px;height:500px; background: radial-gradient(circle,#0ea5e9,#3b82f6); bottom:-100px;right:-100px; animation-duration:18s; animation-delay:-6s; }
    .orb-3 { width:350px;height:350px; background: radial-gradient(circle,#06b6d4,#0ea5e9); top:50%;left:55%; animation-duration:20s; animation-delay:-10s; opacity:.1; }
    .grid-overlay {
        position: absolute; inset: 0;
        background-image: linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px), linear-gradient(90deg,rgba(255,255,255,.03) 1px,transparent 1px);
        background-size: 60px 60px;
    }
    @keyframes float {
        0%,100% { transform: translate(0,0) scale(1); }
        33%  { transform: translate(40px,-60px) scale(1.08); }
        66%  { transform: translate(-30px,40px) scale(0.95); }
    }

    /* =========================================
       LAYOUT
    ========================================= */
    .content-wrap {
        position: relative; z-index: 1;
        max-width: 720px; margin: 0 auto;
        padding: 32px 20px 80px;
    }

    /* =========================================
       TOP BAR
    ========================================= */
    .top-bar {
        display: flex; align-items: center;
        justify-content: space-between; margin-bottom: 40px;
    }
    .brand {
        display: flex; align-items: center; gap: 8px;
        font-size: 13px; font-weight: 600;
        color: rgba(255,255,255,0.5); letter-spacing: 0.02em;
        text-decoration: none;
    }
    .brand:hover { color: rgba(255,255,255,0.75); }
    .brand-dot {
        width:8px;height:8px;border-radius:50%;
        background:#0ea5e9;box-shadow:0 0 10px #0ea5e9;
        animation:pulse-dot 2s ease-in-out infinite;
    }
    @keyframes pulse-dot {
        0%,100%{box-shadow:0 0 6px #0ea5e9;}
        50%{box-shadow:0 0 16px #0ea5e9,0 0 30px #0ea5e980;}
    }
    .reset-btn {
        display:flex;align-items:center;gap:6px;
        font-size:12px;font-weight:500;
        color:rgba(255,255,255,0.35);
        background:rgba(255,255,255,0.06);
        border:1px solid rgba(255,255,255,0.1);
        padding:8px 14px;border-radius:100px;
        cursor:pointer;transition:all .2s;
        text-decoration:none;
    }
    .reset-btn:hover{color:#fff;background:rgba(255,255,255,0.1);}

    /* =========================================
       HERO
    ========================================= */
    .hero-block { text-align: center; margin-bottom: 36px; }
    .hero-icon {
        width:72px;height:72px;border-radius:20px;
        display:flex;align-items:center;justify-content:center;
        margin:0 auto 20px;
        box-shadow:0 20px 60px rgba(14,165,233,0.35);
    }
    .hero-title {
        font-size: clamp(22px,4vw,34px);font-weight:800;
        letter-spacing:-0.02em;margin:0 0 10px;
    }
    .hero-sub { font-size:15px;color:rgba(255,255,255,0.45);margin:0; }

    /* =========================================
       ANIMATION
    ========================================= */
    .anim-up { animation: animUp .4s cubic-bezier(.16,1,.3,1) both; }
    @keyframes animUp {
        from{opacity:0;transform:translateY(20px);}
        to{opacity:1;transform:translateY(0);}
    }
    .spin { animation: spin .8s linear infinite; }
    @keyframes spin { to { transform: rotate(360deg); } }

    /* =========================================
       SEARCH CARD
    ========================================= */
    .search-card {
        background:rgba(255,255,255,0.04);
        border:1px solid rgba(255,255,255,0.09);
        border-radius:20px;
        overflow:hidden;
        backdrop-filter:blur(16px);
        margin-bottom:32px;
        animation-delay: .06s;
    }
    .search-tabs {
        display:flex;border-bottom:1px solid rgba(255,255,255,0.07);
        padding:4px 4px 0;gap:2px;
    }
    .search-tab {
        flex:1;display:flex;align-items:center;justify-content:center;gap:7px;
        padding:12px 16px;font-size:13px;font-weight:600;
        color:rgba(255,255,255,0.35);background:none;border:none;
        cursor:pointer;border-radius:10px 10px 0 0;transition:all .2s;
    }
    .search-tab:hover{color:rgba(255,255,255,0.6);}
    .search-tab.active{color:#7dd3fc;background:rgba(14,165,233,0.1);}

    .search-form {
        padding:20px;display:flex;gap:10px;align-items:flex-start;
    }
    @media(max-width:520px){.search-form{flex-direction:column;}}
    .search-input-wrap {
        flex:1;position:relative;display:flex;align-items:center;
    }
    .search-icon {
        position:absolute;left:14px;
        color:rgba(255,255,255,0.3);pointer-events:none;
        display:flex;align-items:center;
    }
    .search-input {
        width:100%;background:rgba(255,255,255,0.06);
        border:1px solid rgba(255,255,255,0.1);
        border-radius:12px;padding:13px 42px 13px 42px;
        color:#f1f5f9;font-size:15px;font-family:inherit;
        outline:none;transition:all .2s;
    }
    .search-input::placeholder{color:rgba(255,255,255,0.25);}
    .search-input:focus{border-color:#0ea5e9;background:rgba(14,165,233,0.08);}
    .search-clear {
        position:absolute;right:12px;
        background:none;border:none;cursor:pointer;
        color:rgba(255,255,255,0.3);padding:4px;
        display:flex;align-items:center;transition:color .2s;
    }
    .search-clear:hover{color:rgba(255,255,255,0.7);}
    .search-btn {
        flex-shrink:0;padding:13px 22px;
        background:linear-gradient(135deg,#0ea5e9,#6366f1);
        color:#fff;font-size:14px;font-weight:700;
        border:none;border-radius:12px;cursor:pointer;
        display:flex;align-items:center;gap:8px;
        transition:all .2s;white-space:nowrap;
        box-shadow:0 6px 24px rgba(14,165,233,0.3);
    }
    .search-btn:hover{transform:translateY(-1px);box-shadow:0 10px 32px rgba(14,165,233,0.4);}
    .search-btn:disabled{opacity:.7;cursor:wait;}

    /* =========================================
       EMPTY / ERROR
    ========================================= */
    .status-empty {
        text-align:center;padding:48px 20px;
        background:rgba(255,255,255,0.03);
        border:1px solid rgba(255,255,255,0.07);
        border-radius:20px;
    }
    .empty-icon{font-size:48px;margin-bottom:16px;}
    .empty-title{font-size:17px;font-weight:700;color:#f1f5f9;margin:0 0 8px;}
    .empty-sub{font-size:14px;color:rgba(255,255,255,0.4);margin:0 0 24px;max-width:340px;margin-left:auto;margin-right:auto;}
    .empty-reset-btn{
        padding:11px 28px;background:rgba(255,255,255,0.08);
        border:1px solid rgba(255,255,255,0.12);border-radius:12px;
        color:rgba(255,255,255,0.65);font-size:14px;font-weight:600;
        cursor:pointer;transition:all .2s;
    }
    .empty-reset-btn:hover{background:rgba(255,255,255,0.13);color:#fff;}

    /* =========================================
       RESULT
    ========================================= */
    .result-wrap{display:flex;flex-direction:column;gap:16px;}
    .result-status-pill {
        display:inline-flex;align-items:center;gap:8px;
        padding:10px 20px;border-radius:100px;
        font-size:14px;font-weight:600;align-self:flex-start;
    }
    .result-card {
        background:rgba(255,255,255,0.04);
        border:1px solid rgba(255,255,255,0.09);
        border-radius:20px;overflow:hidden;
        backdrop-filter:blur(16px);
    }
    .result-card-header {
        padding:20px 24px;display:flex;align-items:center;gap:14px;
    }
    .result-header-icon {
        width:44px;height:44px;background:rgba(255,255,255,0.2);
        border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;
    }
    .result-card-title{font-size:17px;font-weight:700;margin:0;}
    .result-card-sub{font-size:12px;color:rgba(255,255,255,0.65);margin:2px 0 0;}

    .result-body{padding:24px;}
    .info-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
    @media(max-width:520px){.info-grid{grid-template-columns:1fr;}}
    .info-item{display:flex;flex-direction:column;gap:4px;}
    .info-item.full{grid-column:1/-1;}
    .info-label{font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:rgba(255,255,255,0.3);}
    .info-value{font-size:14px;font-weight:500;color:#e2e8f0;line-height:1.5;}
    .diagnosis-val{font-style:italic;color:rgba(255,255,255,0.6);}
    .cost-val{color:#7dd3fc;font-weight:700;}
    .cost-val.final{color:#4ade80;}

    /* Timeline */
    .timeline-section{
        border-top:1px solid rgba(255,255,255,0.06);
        padding:20px 24px;
    }
    .timeline-title{
        display:flex;align-items:center;gap:7px;
        font-size:11px;font-weight:700;text-transform:uppercase;
        letter-spacing:.07em;color:rgba(255,255,255,0.3);
        margin-bottom:20px;
    }
    .timeline{display:flex;flex-direction:column;gap:0;position:relative;}
    .timeline::before{
        content:'';position:absolute;left:9px;top:10px;bottom:10px;
        width:1.5px;background:rgba(255,255,255,0.08);
        border-radius:99px;
    }
    .timeline-item{
        display:flex;gap:16px;padding-bottom:20px;position:relative;
    }
    .timeline-item:last-child{padding-bottom:0;}
    .timeline-dot{
        width:20px;height:20px;border-radius:50%;flex-shrink:0;
        margin-top:2px;position:relative;z-index:1;
    }
    .timeline-content{flex:1;min-width:0;}
    .timeline-top{
        display:flex;align-items:center;flex-wrap:wrap;gap:8px;margin-bottom:4px;
    }
    .timeline-status{
        font-size:12px;font-weight:700;padding:3px 10px;border-radius:100px;
    }
    .timeline-date{font-size:11px;color:rgba(255,255,255,0.3);}
    .timeline-desc{font-size:13px;color:rgba(255,255,255,0.5);margin:0 0 4px;line-height:1.5;}
    .timeline-tech{font-size:11px;color:rgba(255,255,255,0.25);font-style:italic;}

    /* Footer */
    .result-footer{
        border-top:1px solid rgba(255,255,255,0.06);
        padding:20px 24px;
        display:flex;flex-direction:column;gap:12px;
    }
    .ready-notice{
        display:flex;align-items:flex-start;gap:10px;
        background:rgba(34,197,94,0.07);
        border:1px solid rgba(34,197,94,0.18);
        border-radius:12px;padding:12px 14px;
        font-size:13px;color:rgba(255,255,255,0.65);line-height:1.5;
    }
    .ready-notice svg{flex-shrink:0;margin-top:1px;}
    .search-again-btn{
        align-self:flex-start;
        display:flex;align-items:center;gap:7px;
        padding:10px 20px;
        background:rgba(255,255,255,0.06);
        border:1px solid rgba(255,255,255,0.1);
        border-radius:10px;cursor:pointer;
        font-size:13px;font-weight:600;
        color:rgba(255,255,255,0.5);transition:all .2s;
    }
    .search-again-btn:hover{color:#fff;background:rgba(255,255,255,0.1);}

    /* =========================================
       HINT CARDS
    ========================================= */
    .hint-cards{display:flex;flex-direction:column;gap:10px;}
    @media(min-width:520px){.hint-cards{flex-direction:row;}}
    .hint-card{
        flex:1;display:flex;gap:14px;align-items:flex-start;
        background:rgba(255,255,255,0.03);
        border:1px solid rgba(255,255,255,0.07);
        border-radius:14px;padding:16px;
    }
    .hint-icon{font-size:26px;flex-shrink:0;}
    .hint-text{display:flex;flex-direction:column;gap:4px;}
    .hint-text strong{font-size:13px;color:#e2e8f0;font-weight:700;}
    .hint-text span{font-size:12px;color:rgba(255,255,255,0.35);line-height:1.6;}

    /* =========================================
       FOOTNOTE
    ========================================= */
    .footnote {
        display:flex;align-items:center;justify-content:center;
        gap:6px;text-align:center;
        font-size:11px;color:rgba(255,255,255,0.2);
    }
    </style>

</div>
