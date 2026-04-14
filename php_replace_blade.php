<?php
$file = 'resources/views/livewire/diagnosis-chat.blade.php';
$content = file_get_contents($file);

$search = <<<'EOD'
        {{-- ==================== INFORMASI LAYANAN: DAFTAR LAYANAN + HARGA ==================== --}}
        @if($state === 'service_detail' && $selectedServiceCategory)
        <div class="anim-up">
            <button wire:click="goBack" class="back-btn">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali
            </button>

            @php $catData = $serviceMenu[$selectedServiceCategory]; @endphp
            <div class="section-head">
                <span class="section-emoji">{{ $catData['icon'] }}</span>
                <h2 class="section-title">{{ $catData['label'] }}</h2>
                <p class="section-sub">Pilih layanan untuk info harga & booking</p>
            </div>

            <div class="problem-list">
                @foreach($catData['services'] as $sKey => $svc)
                <button wire:click="selectService('{{ $sKey }}')" class="problem-card">
                    <div class="problem-info" style="flex: 1;">
                        <span class="problem-label">{{ $svc['label'] }}</span>
                        <span class="problem-desc">{{ $svc['desc'] }}</span>
                    </div>
                    <span style="font-size:13px;font-weight:700;color:var(--accent-light);white-space:nowrap;margin-left:auto;">{{ $svc['price'] }}</span>
                </button>
                @endforeach
            </div>
        </div>
        @endif

        {{-- ==================== INFORMASI LAYANAN: BOOKING FORM ==================== --}}
        @if($state === 'service_booking' && $selectedServiceData)
        <div class="anim-up">
            <button wire:click="goBack" class="back-btn">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali
            </button>

            {{-- Service summary --}}
            <div class="glass-card" style="margin-bottom:20px;">
                <div class="glass-card-header" style="background:linear-gradient(135deg,rgba(168,85,247,0.15),rgba(99,102,241,0.10));">
                    <div class="glass-card-icon" style="background:rgba(168,85,247,0.18);color:#d8b4fe;">
                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h3>{{ $selectedServiceData['label'] }}</h3>
                        <p>{{ $selectedServiceData['desc'] }}</p>
                    </div>
                </div>
                <div style="padding:16px 20px;display:flex;flex-direction:column;gap:10px;">
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <span style="color:var(--text-muted);font-size:13px;">Estimasi Biaya</span>
                        <span style="font-size:18px;font-weight:700;color:var(--accent-light);">{{ $selectedServiceData['price'] }}</span>
                    </div>
                    @if(!empty($selectedServiceData['note']))
                    <div style="background:var(--accent-bg);border:1px solid var(--accent-border);border-radius:10px;padding:10px 14px;font-size:12.5px;color:var(--text-secondary);line-height:1.5;">
                        💡 {{ $selectedServiceData['note'] }}
                    </div>
                    @endif
                </div>
            </div>
EOD;

$replace = <<<'EOD'
        {{-- ==================== INFORMASI LAYANAN: BOOKING FORM ==================== --}}
        @if($state === 'service_booking' && $selectedServiceCategory)
        <div class="anim-up">
            <button wire:click="goBack" class="back-btn">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali
            </button>

            @php $catData = $serviceMenu[$selectedServiceCategory] ?? null; @endphp
            @if($catData)
            <div class="glass-card" style="margin-bottom:20px;">
                <div class="glass-card-header" style="background:linear-gradient(135deg,rgba(168,85,247,0.15),rgba(99,102,241,0.10)); border-radius:15px; border-bottom-left-radius:0; border-bottom-right-radius:0;">
                    <div class="glass-card-icon" style="background:rgba(168,85,247,0.18);color:#d8b4fe;">
                        <span style="font-size:24px; align-self:center;">{{ $catData['icon'] ?? '🔧' }}</span>
                    </div>
                    <div>
                        <h3>{{ $catData['label'] ?? 'Pilih Layanan' }}</h3>
                        <p>Pilih paket layanan yang ingin diambil</p>
                    </div>
                </div>
                <div style="background: rgba(255,255,255,0.03); padding: 15px; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
                    <div style="display:flex;flex-direction:column;gap:8px;">
                        @foreach($catData['services'] ?? [] as $sKey => $svc)
                        <label class="problem-card" style="cursor:pointer; display:flex; align-items:center; text-align:left; border: 1px solid rgba(255,255,255,0.1); background: rgba(0,0,0,0.2); padding:12px; border-radius:10px; margin:0;">
                            <div style="margin-right: 15px; display:flex; align-items:center;">
                                <input type="checkbox" wire:model="selectedServiceItems" value="{{ $svc['label'] }} ({{ $svc['price'] }})" style="width:18px;height:18px;accent-color:var(--accent-light);">
                            </div>
                            <div class="problem-info" style="flex: 1;">
                                <span class="problem-label" style="display:block;">{{ $svc['label'] }}</span>
                                <span class="problem-desc" style="display:block;">{{ $svc['desc'] }}</span>
                            </div>
                            <span style="font-size:13px;font-weight:700;color:var(--accent-light);white-space:nowrap;margin-left:auto;">{{ $svc['price'] }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
EOD;

if (strpos($content, trim(explode("\n", $search)[0])) !== false) {
    // try exact match first
    $new_content = str_replace($search, $replace, $content);
    
    if ($new_content === $content) {
        // try regex
        $pattern = '/\s*\{\{-- ==================== INFORMASI LAYANAN: DAFTAR LAYANAN \+ HARGA ==================== --\}\}.*?💡 \{\{ \\[\'note\'\] \}\}\s+<\/div>\s+@endif\s+<\/div>\s+<\/div>/s';
        $new_content = preg_replace($pattern, "\n" . $replace, $content);
        if ($new_content === $content) {
            echo "Regex replacement failed";
        } else {
             echo "Replaced with regex";
             file_put_contents($file, $new_content);
        }
    } else {
        echo "Replaced exact match";
        file_put_contents($file, $new_content);
    }
} else {
    echo "Could not find start marker";
}
?>
