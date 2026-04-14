<div class="diagnosis-root" x-data="{ theme: localStorage.getItem('diagnosis-theme') || 'dark' }" :data-theme="theme">

    {{-- ===================== ANIMATED BACKGROUND ===================== --}}
    <div class="bg-animated" aria-hidden="true">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
        <div class="grid-overlay"></div>
    </div>

    {{-- ===================== CONTENT ===================== --}}
    <div class="content-wrap">

        {{-- Brand + Actions --}}
        <div class="top-bar">
            <div class="brand">
                <div class="brand-dot"></div>
                <span>Cellcom Expert System</span>
            </div>
            <div style="display:flex;align-items:center;gap:8px;">
                {{-- Theme toggle --}}
                <button @click="theme = theme === 'dark' ? 'light' : 'dark'; localStorage.setItem('diagnosis-theme', theme)" class="theme-toggle" title="Ganti tema">
                    <svg class="theme-icon-sun" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="12" r="5" stroke-width="2"/><path stroke-linecap="round" stroke-width="2" d="M12 1v2m0 18v2M4.22 4.22l1.42 1.42m12.72 12.72l1.42 1.42M1 12h2m18 0h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
                    <svg class="theme-icon-moon" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                </button>
                <a href="{{ route('service-status') }}" class="reset-btn link-btn">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    Cek Status
                </a>
                @if(!in_array($state, ['select_device', 'completed']))
                <button wire:click="resetAll" class="reset-btn">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    Mulai Ulang
                </button>
                @endif
            </div>
        </div>

        {{-- Step indicator --}}
        @if(!in_array($state, ['select_device', 'select_category', 'completed', 'service_inquiry', 'service_detail', 'service_booking']))
        @php
            $stateStep = ['select_problem' => 1, 'asking' => 2, 'verifying' => 3, 'diagnosed' => 4, 'booking' => 4];
            $currentStep = $stateStep[$state] ?? 1;
            $stepLabels = ['Masalah', 'Pertanyaan', 'Verifikasi', 'Hasil'];
        @endphp
        <div class="steps-bar">
            @foreach(range(1, 4) as $i)
            <div class="step-item {{ $i < $currentStep ? 'done' : ($i === $currentStep ? 'active' : '') }}">
                <div class="step-circle">
                    @if($i < $currentStep)
                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    @else
                        {{ $i }}
                    @endif
                </div>
                <span class="step-label">{{ $stepLabels[$i-1] }}</span>
            </div>
            @if($i < 4)
            <div class="step-line {{ $i < $currentStep ? 'done' : '' }}"></div>
            @endif
            @endforeach
        </div>
        @endif

        {{-- ==================== STEP 0: PILIH PERANGKAT ==================== --}}
        @if($state === 'select_device')
        <div class="anim-up">
            <div class="hero-block">
                <div class="hero-icon">
                    <svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <h1 class="hero-title">Halo! Mau servis apa? <span class="hero-emoji">👋</span></h1>
                <p class="hero-sub">Pilih jenis perangkat yang bermasalah</p>
            </div>

            <div class="cat-grid" style="max-width:600px;margin:0 auto;">
                @foreach($deviceTypes as $key => $device)
                <button wire:click="selectDevice('{{ $key }}')" class="cat-card">
                    <span class="cat-icon">{{ $device['icon'] }}</span>
                    <span class="cat-label">{{ $device['label'] }}</span>
                    <span class="cat-desc">{{ $device['desc'] }}</span>
                </button>
                @endforeach
            </div>

            <p class="footnote">
                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Diagnosis berbasis Hybrid Forward &amp; Backward Chaining. Konsultasikan dengan teknisi untuk hasil akurat.
            </p>

            <div style="display:flex;flex-direction:column;align-items:center;gap:12px;margin-top:20px;">
                <button wire:click="selectServiceInquiry" class="service-pill service-pill-ask">
                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Ingin tahu harga dan detail layanan? <strong style="margin-left:4px;">Informasi Layanan →</strong>
                </button>
                <a href="{{ route('service-status') }}" class="service-pill service-pill-status">
                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    Sudah punya tiket servis? <strong style="margin-left:4px;">Cek Status Pengerjaan →</strong>
                </a>
            </div>
        </div>
        @endif

        {{-- ==================== STEP 1: KATEGORI ==================== --}}
        @if($state === 'select_category')
        <div class="anim-up">
            <button wire:click="goBack" class="back-btn">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali
            </button>

            <div class="hero-block">
                <div class="hero-icon">
                    @if($selectedDeviceType === 'printer')
                    <svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H7v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    @elseif(in_array($selectedDeviceType, ['pc', 'aio']))
                    <svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    @else
                    <svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    @endif
                </div>
                @php
                    $deviceLabel = $deviceTypes[$selectedDeviceType]['label'] ?? 'Perangkat';
                @endphp
                <h1 class="hero-title">{{ $deviceLabel }}mu kenapa? <span class="hero-emoji">🤔</span></h1>
                <p class="hero-sub">Ketuk kategori masalah yang paling sesuai</p>
            </div>

            <div class="cat-grid">
                @foreach($categories as $key => $cat)
                <button wire:click="selectCategory('{{ $key }}')" class="cat-card">
                    <span class="cat-icon">{{ $cat['icon'] }}</span>
                    <span class="cat-label">{{ $cat['label'] }}</span>
                    <span class="cat-desc">{{ $cat['desc'] }}</span>
                </button>
                @endforeach
            </div>

        </div>
        @endif

        {{-- ==================== STEP 2: MASALAH ==================== --}}
        @if($state === 'select_problem' && $selectedCategoryData)
        <div class="anim-up">
            <button wire:click="goBack" class="back-btn">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali
            </button>

            <div class="section-head">
                <span class="section-emoji">{{ $selectedCategoryData['icon'] }}</span>
                <h2 class="section-title">{{ $selectedCategoryData['label'] }}mu kenapa?</h2>
                <p class="section-sub">Pilih yang paling sesuai</p>
            </div>

            <div class="problem-list">
                @foreach($selectedCategoryData['problems'] as $key => $problem)
                <button wire:click="selectProblem('{{ $key }}')" class="problem-card">
                    <div class="problem-arrow">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </div>
                    <div class="problem-text">
                        <span class="problem-label">{{ $problem['label'] }}</span>
                        <span class="problem-desc">{{ $problem['desc'] }}</span>
                    </div>
                </button>
                @endforeach
            </div>
        </div>
        @endif

        {{-- ==================== STEP 3: PERTANYAAN ==================== --}}
        @if($state === 'asking' && $currentQuestion)
        <div class="anim-up">
            <button wire:click="goBack" class="back-btn">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali
            </button>

            <div class="q-wrap">
                {{-- Progress --}}
                <div class="q-progress-row">
                    <span class="q-progress-label">Pertanyaan {{ $questionCount + 1 }} dari {{ $maxQuestions }}</span>
                    <span class="q-progress-pct">{{ round(($questionCount / $maxQuestions) * 100) }}%</span>
                </div>
                <div class="q-progress-bar">
                    <div class="q-progress-fill" style="width: {{ ($questionCount / $maxQuestions) * 100 }}%"></div>
                </div>

                {{-- Card --}}
                <div class="q-card">
                    <div class="q-card-header">
                        <div class="q-badge">?</div>
                        <span>Jawab untuk hasil yang lebih akurat</span>
                    </div>
                    <div class="q-card-body">
                        <p class="q-text">{{ $currentQuestion['question'] }}</p>

                        @if(isset($currentQuestion['question_type']) && $currentQuestion['question_type'] === 'choice' && !empty($currentQuestion['options']))
                        {{-- CHOICE BUTTONS: question has multiple specific options --}}
                        <div class="q-buttons-choice">
                            @foreach($currentQuestion['options'] as $opt)
                            <button wire:click="answerChoice('{{ $opt['value'] }}', '{{ addslashes($opt['label']) }}')" class="q-btn q-btn-choice">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="12" r="9" stroke-width="2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"/></svg>
                                {{ $opt['label'] }}
                            </button>
                            @endforeach
                        </div>
                        @else
                        {{-- YA / TIDAK BUTTONS: standard yes/no question --}}
                        <div class="q-buttons-main">
                            <button wire:click="answerYes" class="q-btn q-btn-yes">
                                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                Ya
                            </button>
                            <button wire:click="answerNo" class="q-btn q-btn-no">
                                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
                                Tidak
                            </button>
                        </div>
                        @endif
                        <button wire:click="answerSkip" class="q-btn-skip">
                            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Tidak Tahu / Lewati
                        </button>
                    </div>
                </div>

                @if(count($answeredQuestions) > 0)
                <div class="q-answered" x-data="{ open: false }">
                    <button @click="open = !open" class="q-answered-toggle">
                        <svg class="q-chevron" :class="{ 'rotated': open }" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        {{ count($answeredQuestions) }} jawaban tersimpan
                    </button>
                    <div x-show="open" x-transition class="q-answered-list">
                        @foreach($answeredQuestions as $qa)
                        <div class="q-answered-item">
                            <span class="q-answer-badge {{ $qa['answer'] === 'Ya' ? 'yes' : (in_array($qa['answer'], ['Tidak','Tidak Tahu']) ? 'no' : 'choice') }}">{{ $qa['answer'] }}</span>
                            <span class="q-answer-text">{{ Str::limit($qa['question'], 80) }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif

        {{-- ==================== STEP 3.5: VERIFIKASI BACKWARD CHAINING (CHECKLIST) ==================== --}}
        @if($state === 'verifying' && !empty($bcQuestions))
        <div class="anim-up">
            <button wire:click="goBack" class="back-btn">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali
            </button>

            <div class="q-wrap">
                {{-- BC Badge --}}
                <div class="bc-badge-wrap">
                    <div class="bc-badge">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        <span>Verifikasi Singkat</span>
                    </div>
                    <p class="bc-badge-desc">Centang gejala yang Anda alami untuk memastikan diagnosis lebih akurat</p>
                </div>

                {{-- Checklist Card --}}
                <div class="q-card bc-card">
                    <div class="q-card-header bc-header">
                        <div class="q-badge bc-q-badge">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        </div>
                        <span>Apakah Anda juga mengalami gejala di bawah ini?</span>
                    </div>
                    <div class="q-card-body"
                         x-data="{ selected: @js(array_fill_keys(array_map(fn($q) => (string) $q['symptom_id'], $bcQuestions), false)) }">
                        <div class="bc-checklist">
                            @foreach($bcQuestions as $idx => $q)
                            <label class="bc-check-item" @click="selected['{{ $q['symptom_id'] }}'] = !selected['{{ $q['symptom_id'] }}']">
                                <div class="bc-checkbox" :class="selected['{{ $q['symptom_id'] }}'] ? 'bc-checked' : ''">
                                    <template x-if="selected['{{ $q['symptom_id'] }}']">
                                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                    </template>
                                </div>
                                <div class="bc-check-content">
                                    <span class="bc-check-text">{{ $q['symptom_name'] }}</span>
                                    @if(!empty($q['question']) && $q['question'] !== "Apakah perangkat Anda mengalami: {$q['symptom_name']}?")
                                    <span class="bc-check-hint">{{ $q['question'] }}</span>
                                    @endif
                                </div>
                            </label>
                            @endforeach
                        </div>

                            <div class="bc-checklist-actions">
                            <button
                                @click="$wire.submitBcChecklistWithIds(Object.keys(selected).filter((id) => selected[id]).map((id) => Number(id)))"
                                wire:loading.attr="disabled"
                                wire:target="submitBcChecklistWithIds,submitBcChecklist"
                                class="cta-primary bc-submit-btn">
                                <span wire:loading.remove wire:target="submitBcChecklistWithIds,submitBcChecklist" style="display:inline-flex;align-items:center;gap:.5rem;">
                                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                    Konfirmasi & Lihat Hasil
                                </span>
                                <span wire:loading wire:target="submitBcChecklistWithIds,submitBcChecklist">Memproses verifikasi...</span>
                            </button>
                            <button wire:click="bcSkipAll" class="q-btn-skip bc-skip-all">
                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/></svg>
                                Lewati Verifikasi
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- ==================== STEP 4: HASIL DIAGNOSIS ==================== --}}
        @if($state === 'diagnosed' && $diagnosisResult)
        <div class="anim-up">

            {{-- Complaint summary pill --}}
            @if($selectedCategoryData)
            <div class="result-complaint">
                <span class="result-complaint-icon">{{ $selectedCategoryData['icon'] }}</span>
                <div>
                    <span class="result-complaint-cat">{{ $selectedCategoryData['label'] }}</span>
                    @if($selectedProblemKey && isset($selectedCategoryData['problems'][$selectedProblemKey]))
                    <span class="result-complaint-prob"> — {{ $selectedCategoryData['problems'][$selectedProblemKey]['label'] }}</span>
                    @endif
                </div>
            </div>
            @endif

            <div class="result-card">
                <div class="result-card-header">
                    <div class="result-header-icon">
                        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="result-title">Hasil Diagnosis</h3>
                        @if(($diagnosisResult['method'] ?? '') === 'hybrid_fc_bc')
                        <p class="result-subtitle">Hybrid: Forward Chaining + Backward Chaining · Certainty Factor</p>
                        @elseif(($diagnosisResult['method'] ?? '') === 'direct_diagnosis')
                        <p class="result-subtitle">Diagnosis Langsung · Gejala Sudah Pasti</p>
                        @else
                        <p class="result-subtitle">Forward Chaining · Certainty Factor</p>
                        @endif
                    </div>
                </div>

                <div class="result-body">
                    {{-- Symptoms --}}
                    @php $symptoms = $diagnosisResult['detected_symptoms'] ?? $collectedSymptoms ?? []; @endphp
                    @if(!empty($symptoms))
                    <div class="result-section">
                        <div class="result-section-label">
                            <span class="dot dot-amber"></span>
                            Gejala Terdeteksi ({{ count($symptoms) }})
                        </div>
                        <div class="symptom-tags">
                            @foreach($symptoms as $s)
                            <span class="symptom-tag">{{ $s }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Verification Summary (if BC was used) --}}
                    @if(!empty($diagnosisResult['verification']))
                    <div class="result-section">
                        <div class="result-section-label">
                            <span class="dot dot-blue"></span>
                            Verifikasi Backward Chaining
                        </div>
                        <div class="bc-summary">
                            <div class="bc-summary-stats">
                                <div class="bc-stat">
                                    <span class="bc-stat-num bc-confirmed">{{ $diagnosisResult['verification']['total_confirmed'] }}</span>
                                    <span class="bc-stat-label">Dikonfirmasi</span>
                                </div>
                                <div class="bc-stat">
                                    <span class="bc-stat-num bc-denied">{{ $diagnosisResult['verification']['total_denied'] }}</span>
                                    <span class="bc-stat-label">Ditolak</span>
                                </div>
                                <div class="bc-stat">
                                    <span class="bc-stat-num bc-total">{{ $diagnosisResult['verification']['total_verifications'] }}</span>
                                    <span class="bc-stat-label">Total Verifikasi</span>
                                </div>
                            </div>
                            <div class="bc-method-badge">
                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                Terverifikasi dengan Backward Chaining
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Direct Diagnosis Note (jika gejala sudah pasti tanpa perlu pertanyaan) --}}
                    @if(!empty($diagnosisResult['direct_diagnosis_note']))
                    <div class="result-section">
                        <div class="result-section-label">
                            <span class="dot dot-green"></span>
                            Catatan Diagnosis
                        </div>
                        <div class="direct-diagnosis-note">
                            <div class="direct-note-icon">⚡</div>
                            <p class="direct-note-text">{{ $diagnosisResult['direct_diagnosis_note'] }}</p>
                        </div>
                    </div>
                    @endif

                    {{-- Diagnoses --}}
                    @if(!empty($diagnosisResult['diagnoses']))
                    <div class="result-section">
                        <div class="result-section-label">
                            <span class="dot dot-red"></span>
                            Kemungkinan Diagnosis ({{ count($diagnosisResult['diagnoses']) }})
                        </div>

                        @foreach($diagnosisResult['diagnoses'] as $i => $diag)
                        @php
                            $cf = $diag['confidence'] ?? 0;
                            $cfColor = $cf >= 80 ? '#22c55e' : ($cf >= 50 ? '#f59e0b' : '#ef4444');
                            $lvl = $diag['level'] ?? 'Sedang';
                            $lvlClass = match($lvl) { 'Ringan' => 'lvl-ringan', 'Berat' => 'lvl-berat', default => 'lvl-sedang' };
                            $vStatus = $diag['verification_status'] ?? 'unverified';
                            $vColor = \App\Services\BackwardChainingEngine::getVerificationColor($vStatus);
                            $vLabel = \App\Services\BackwardChainingEngine::getVerificationLabel($vStatus);
                            $cfChange = $diag['confidence_change'] ?? null;
                        @endphp
                        <div class="diag-card {{ ($vStatus === 'rejected') ? 'diag-rejected' : '' }}">
                            <div class="diag-top">
                                <div class="diag-rank" style="background: {{ $cfColor }}">{{ $i + 1 }}</div>
                                <div class="diag-info">
                                    <div class="diag-name-row">
                                        <span class="diag-name">{{ $diag['name'] }}</span>
                                        @if(!empty($diag['code']))<span class="diag-code">{{ $diag['code'] }}</span>@endif
                                        <span class="diag-level {{ $lvlClass }}">{{ $lvl }}</span>
                                        @if($vStatus !== 'unverified')
                                        <span class="diag-verify-badge verify-{{ $vColor }}">
                                            @if($vStatus === 'strongly_verified')
                                            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                            @endif
                                            {{ $vLabel }}
                                        </span>
                                        @endif
                                    </div>
                                    @if(!empty($diag['description']))<p class="diag-desc">{{ $diag['description'] }}</p>@endif
                                </div>
                            </div>

                            <div class="diag-details">
                                @if(!empty($diag['matched_symptoms']))
                                <div class="diag-detail-row">
                                    <span class="diag-detail-label">Gejala cocok:</span>
                                    <div class="diag-match-tags">
                                        @foreach($diag['matched_symptoms'] as $ms)
                                        <span class="diag-match-tag">{{ $ms }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                @if(!empty($diag['denied_symptoms']))
                                <div class="diag-detail-row">
                                    <span class="diag-detail-label diag-denied-label">Gejala ditolak:</span>
                                    <div class="diag-match-tags">
                                        @foreach($diag['denied_symptoms'] as $ds)
                                        <span class="diag-denied-tag">{{ $ds }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                @if(!empty($diag['solution']))
                                <div class="diag-solution">
                                    <span class="diag-solution-icon">💡</span>
                                    <p>{{ $diag['solution'] }}</p>
                                </div>
                                @endif
                                @if(!empty($diag['actions']))
                                <ul class="diag-actions">
                                    @foreach($diag['actions'] as $act)
                                    <li>
                                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                        {{ $act }}
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                                @if(!empty($diag['cost_range']))
                                <div class="diag-cost">
                                    <span class="diag-cost-label">Estimasi Biaya</span>
                                    <span class="diag-cost-val">{{ $diag['cost_range'] }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="no-diag">
                        <div class="no-diag-icon">🤷</div>
                        <p class="no-diag-title">Diagnosis Belum Ditemukan</p>
                        <p class="no-diag-sub">Gejala belum cukup untuk diagnosis spesifik. Silakan konsultasikan langsung dengan teknisi.</p>
                    </div>
                    @endif

                    {{-- Answered questions summary --}}
                    @if(count($answeredQuestions) > 0)
                    <div x-data="{ open: false }" class="result-qa-summary">
                        <button @click="open = !open" class="result-qa-toggle">
                            <svg class="q-chevron" :class="{ 'rotated': open }" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            Lihat {{ count($answeredQuestions) }} pertanyaan analisis (Forward Chaining)
                        </button>
                        <div x-show="open" x-transition class="result-qa-list">
                            @foreach($answeredQuestions as $qa)
                            <div class="result-qa-item">
                                <span class="q-answer-badge {{ $qa['answer'] === 'Ya' ? 'yes' : (in_array($qa['answer'], ['Tidak','Tidak Tahu']) ? 'no' : 'choice') }}">{{ $qa['answer'] }}</span>
                                <span>{{ $qa['question'] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- BC Verification questions summary --}}
                    @if(count($bcAnsweredQuestions) > 0)
                    <div x-data="{ open: false }" class="result-qa-summary">
                        <button @click="open = !open" class="result-qa-toggle bc-toggle">
                            <svg class="q-chevron" :class="{ 'rotated': open }" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            Lihat {{ count($bcAnsweredQuestions) }} pertanyaan verifikasi (Backward Chaining)
                        </button>
                        <div x-show="open" x-transition class="result-qa-list">
                            @foreach($bcAnsweredQuestions as $qa)
                            <div class="result-qa-item">
                                <span class="q-answer-badge {{ $qa['answer'] === 'Ya' ? 'yes' : ($qa['answer'] === 'Tidak' ? 'no' : 'choice') }}">{{ $qa['answer'] }}</span>
                                <span>{{ $qa['question'] }}</span>
                                @if(!empty($qa['related_hypotheses']))
                                <div class="bc-qa-related">
                                    @foreach($qa['related_hypotheses'] as $rh)
                                    <span class="bc-related-tag">{{ $rh }}</span>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Warranty Note --}}
                <div class="warranty-note">
                    <div class="warranty-note-icon">
                        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div class="warranty-note-content">
                        <strong>🛡️ Catatan Garansi</strong>
                        <p>Jika perangkat Anda masih dalam masa garansi resmi, segera bawa ke <strong>Cellcom</strong> untuk proses eskalasi garansi resmi. Cellcom merupakan <em>Authorized Service Provider</em> (ASP) untuk berbagai brand ternama — perbaikan melalui jalur garansi resmi dapat menghemat biaya Anda.</p>
                    </div>
                </div>

                {{-- Cellcom CTA Note --}}
                <div class="warranty-note" style="border-color:var(--accent-border);background:var(--accent-bg);">
                    <div class="warranty-note-icon" style="color:var(--accent-light);">
                        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="warranty-note-content">
                        <strong>📋 Langkah Selanjutnya</strong>
                        <p>Silahkan bawa ke toko <strong>Cellcom</strong> untuk di cek lebih lanjut untuk memastikan kerusakan pada {{ strtolower($deviceTypes[$selectedDeviceType]['label'] ?? 'perangkat') }} Anda. Teknisi kami akan melakukan pengecekan langsung agar diagnosis lebih akurat.</p>
                    </div>
                </div>

                {{-- CTA --}}
                <div class="result-cta">
                    <button wire:click="showBookingForm" class="cta-primary">
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Booking Servis Sekarang
                    </button>
                    <button wire:click="resetAll" class="cta-secondary">Diagnosis Ulang</button>
                    <div class="cta-badges">
                        <span>✓ Gratis Konsultasi</span>
                        <span>✓ Teknisi Berpengalaman</span>
                        <span>✓ Garansi Servis</span>
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- ==================== INFORMASI LAYANAN: PILIH KATEGORI LAYANAN ==================== --}}
        @if($state === 'service_inquiry')
        <div class="anim-up">
            <button wire:click="goBack" class="back-btn">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali
            </button>

            <div class="hero-block">
                <div class="hero-icon">
                    <svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h1 class="hero-title">Informasi Layanan <span class="hero-emoji">💬</span></h1>
                <p class="hero-sub">Pilih kategori layanan yang ingin kamu tanyakan</p>
            </div>

            <div class="cat-grid" style="max-width:600px;margin:0 auto;">
                @foreach($serviceMenu as $key => $cat)
                <button wire:click="selectServiceCategory('{{ $key }}')" class="cat-card">
                    <span class="cat-icon">{{ $cat['icon'] }}</span>
                    <span class="cat-label">{{ $cat['label'] }}</span>
                    <span class="cat-desc">{{ $cat['desc'] }}</span>
                </button>
                @endforeach
            </div>
        </div>
        @endif

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
                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
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

            {{-- Booking form --}}
            <div class="glass-card">
                <div class="glass-card-header green">
                    <div class="glass-card-icon">
                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <div>
                        <h3>Booking Layanan</h3>
                        <p>Isi data untuk antrian servis</p>
                    </div>
                </div>

                <form wire:submit.prevent="saveServiceBooking" class="booking-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" wire:model="bookingForm.name" placeholder="Masukkan nama anda">
                            @error('bookingForm.name')<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label>Nomor WhatsApp</label>
                            <input type="text" wire:model="bookingForm.phone" placeholder="08xxxxxxxxxx">
                            @error('bookingForm.phone')<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Merek Perangkat <span class="form-opt">(opsional)</span></label>
                            <input type="text" wire:model="bookingForm.laptop_brand" placeholder="Contoh: Asus, HP, Epson">
                        </div>
                        <div class="form-group">
                            <label>Tipe / Seri <span class="form-opt">(opsional)</span></label>
                            <input type="text" wire:model="bookingForm.laptop_type" placeholder="Contoh: ROG Strix G15">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Catatan <span class="form-opt">(opsional)</span></label>
                        <textarea wire:model="bookingForm.notes" rows="3" placeholder="Jelaskan kebutuhan Anda, misal: upgrade RAM 8GB ke 16GB"></textarea>
                    </div>
                    <div class="form-actions">
                        <button type="button" wire:click="goBack" class="form-btn-cancel">Batal</button>
                        <button type="submit" class="form-btn-submit"
                            wire:loading.attr="disabled" wire:loading.class="loading">
                            <span wire:loading.remove wire:target="saveServiceBooking">Konfirmasi Booking</span>
                            <span wire:loading wire:target="saveServiceBooking" class="loading-text">
                                <svg class="spin" width="18" height="18" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" class="op25"/><path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" class="op75"/></svg>
                                Memproses...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif

        {{-- ==================== BOOKING FORM ==================== --}}
        @if($state === 'booking')
        <div class="anim-up">
            <div class="glass-card">
                <div class="glass-card-header green">
                    <div class="glass-card-icon">
                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <div>
                        <h3>Form Booking Servis</h3>
                        <p>Lengkapi data untuk antrian servis</p>
                    </div>
                </div>

                <form wire:submit.prevent="saveBooking" class="booking-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" wire:model="bookingForm.name" placeholder="Masukkan nama anda">
                            @error('bookingForm.name')<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label>Nomor WhatsApp</label>
                            <input type="text" wire:model="bookingForm.phone" placeholder="08xxxxxxxxxx">
                            @error('bookingForm.phone')<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email <span class="form-opt">(opsional)</span></label>
                        <input type="email" wire:model="bookingForm.email" placeholder="email@example.com">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            @php
                                $devLabel = $deviceTypes[$selectedDeviceType]['label'] ?? 'Perangkat';
                                $brandOptions = match($selectedDeviceType) {
                                    'pc' => ['Asus','Acer','Lenovo','HP','Dell','MSI','Gigabyte','ASRock','Lainnya'],
                                    'aio' => ['Asus','Acer','Lenovo','HP','Dell','MSI','Apple (iMac)','Samsung','Lainnya'],
                                    'printer' => ['HP','Canon','Epson','Brother','Samsung','Xerox','Fuji Xerox','Kyocera','Ricoh','Lainnya'],
                                    default => ['Asus','Acer','Lenovo','HP','Dell','MSI','Apple (MacBook)','Toshiba','Samsung','Axioo','Zyrex','Lainnya'],
                                };
                                $typePlaceholder = match($selectedDeviceType) {
                                    'pc' => 'Contoh: ROG G21 / OptiPlex',
                                    'aio' => 'Contoh: Vivo AiO / IdeaCentre AIO',
                                    'printer' => 'Contoh: L3210 / LaserJet Pro',
                                    default => 'Contoh: ROG Strix G15',
                                };
                            @endphp
                            <label>Merek {{ $devLabel }}</label>
                            <select wire:model="bookingForm.laptop_brand">
                                <option value="">Pilih merek...</option>
                                @foreach($brandOptions as $b)
                                <option value="{{ $b }}">{{ $b }}</option>
                                @endforeach
                            </select>
                            @error('bookingForm.laptop_brand')<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label>Tipe / Seri {{ $devLabel }}</label>
                            <input type="text" wire:model="bookingForm.laptop_type" placeholder="{{ $typePlaceholder }}">
                            @error('bookingForm.laptop_type')<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Catatan <span class="form-opt">(opsional)</span></label>
                        <textarea wire:model="bookingForm.notes" rows="3" placeholder="Detail tambahan untuk teknisi..."></textarea>
                    </div>
                    <div class="form-actions">
                        <button type="button" wire:click="cancelBooking" class="form-btn-cancel">Batal</button>
                        <button type="submit" class="form-btn-submit"
                            wire:loading.attr="disabled" wire:loading.class="loading">
                            <span wire:loading.remove wire:target="saveBooking">Konfirmasi Booking</span>
                            <span wire:loading wire:target="saveBooking" class="loading-text">
                                <svg class="spin" width="18" height="18" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" class="op25"/><path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" class="op75"/></svg>
                                Memproses...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif

        {{-- ==================== BOOKING SUCCESS ==================== --}}
        @if($bookingSuccess && $bookingCode)
        <div class="anim-up">
            <div class="success-card">
                <div class="success-icon-wrap">
                    <div class="success-rings"></div>
                    <div class="success-icon">
                        <svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="white"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                </div>
                <h2 class="success-title">Booking Berhasil! 🎉</h2>
                <p class="success-sub">Data Anda tersimpan. Datang ke service center dengan kode berikut:</p>

                <div class="booking-code-box">
                    <span class="booking-code-label">Kode Booking</span>
                    <span class="booking-code">{{ $bookingCode }}</span>
                </div>

                <div class="success-info">
                    <div class="success-info-item">
                        <span>📍</span>
                        <div>
                            <strong>Cellcom Service Center</strong>
                            <span>Jl. Contoh No. 123 (Seberang Indomaret)</span>
                        </div>
                    </div>
                    <div class="success-info-item">
                        <span>⏰</span>
                        <div>
                            <strong>Jam Operasional</strong>
                            <span>Senin – Sabtu: 09:00 – 18:00 WIB</span>
                        </div>
                    </div>
                </div>

                <button wire:click="resetAll" class="success-back-btn">Kembali ke Awal</button>
            </div>
        </div>
        @endif

    </div>{{-- /content-wrap --}}

    {{-- Loading overlay --}}
    <div wire:loading wire:target="selectProblem,answerYes,answerNo,answerSkip" class="loading-overlay">
        <div class="loading-box">
            <svg class="spin" width="22" height="22" viewBox="0 0 24 24" fill="none">
                <circle cx="12" cy="12" r="10" stroke="#6366f1" stroke-width="4" opacity=".25"/>
                <path fill="#6366f1" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
            </svg>
            <span>Menganalisis...</span>
        </div>
    </div>

    <style>
    /* =========================================
       CSS CUSTOM PROPERTIES (THEMING)
    ========================================= */
    .diagnosis-root, .diagnosis-root[data-theme="dark"] {
        --bg-primary: #0f0f1a;
        --bg-secondary: rgba(18, 18, 32, 0.72);
        --bg-card: rgba(255,255,255,0.05);
        --bg-card-hover: rgba(24, 24, 44, 0.82);
        --bg-input: rgba(255,255,255,0.06);
        --bg-input-focus: rgba(99,102,241,0.08);
        --bg-overlay: rgba(15,15,26,0.7);
        --bg-loading: rgba(255,255,255,0.08);
        --text-primary: #f1f5f9;
        --text-secondary: #e2e8f0;
        --text-muted: rgba(255,255,255,0.45);
        --text-faint: rgba(255,255,255,0.3);
        --text-faintest: rgba(255,255,255,0.2);
        --border-default: rgba(255,255,255,0.10);
        --border-subtle: rgba(255,255,255,0.07);
        --border-hover: rgba(99,102,241,0.5);
        --accent: #6366f1;
        --accent-light: #a5b4fc;
        --accent-lighter: #c7d2fe;
        --accent-glow: rgba(99,102,241,0.4);
        --accent-bg: rgba(99,102,241,0.12);
        --accent-border: rgba(99,102,241,0.28);
        --success: #22c55e;
        --success-text: #4ade80;
        --success-bg: rgba(34,197,94,0.08);
        --success-border: rgba(34,197,94,0.2);
        --warn: #f59e0b;
        --warn-text: #fcd34d;
        --error: #ef4444;
        --error-text: #f87171;
        --glass-shadow: 0 8px 32px rgba(0,0,0,0.45);
        --glass-inset: 0 2px 0 rgba(255,255,255,0.07) inset;
        --glass-bg: rgba(18,18,32,0.72);
        --grid-lines: rgba(255,255,255,.03);
        --orb-opacity: 0.18;
        --opt-bg: #1e1b4b;
    }

    .diagnosis-root[data-theme="light"] {
        --bg-primary: #f8fbff;
        --bg-secondary: rgba(255, 255, 255, 0.92);
        --bg-card: rgba(255,255,255,0.9);
        --bg-card-hover: rgba(255,255,255,0.98);
        --bg-input: rgba(0,0,0,0.04);
        --bg-input-focus: rgba(14,165,233,0.09);
        --bg-overlay: rgba(248,251,255,0.84);
        --bg-loading: rgba(255,255,255,0.9);
        --text-primary: #0f172a;
        --text-secondary: #1e293b;
        --text-muted: rgba(30,41,59,0.72);
        --text-faint: rgba(30,41,59,0.56);
        --text-faintest: rgba(30,41,59,0.42);
        --border-default: rgba(59,130,246,0.16);
        --border-subtle: rgba(59,130,246,0.1);
        --border-hover: rgba(14,165,233,0.45);
        --accent: #0ea5e9;
        --accent-light: #0284c7;
        --accent-lighter: #38bdf8;
        --accent-glow: rgba(14,165,233,0.26);
        --accent-bg: rgba(14,165,233,0.12);
        --accent-border: rgba(14,165,233,0.3);
        --success: #16a34a;
        --success-text: #16a34a;
        --success-bg: rgba(22,163,74,0.08);
        --success-border: rgba(22,163,74,0.2);
        --warn: #d97706;
        --warn-text: #b45309;
        --error: #dc2626;
        --error-text: #dc2626;
        --glass-shadow: 0 14px 34px rgba(14,54,111,0.08);
        --glass-inset: 0 1px 0 rgba(255,255,255,0.8) inset;
        --glass-bg: rgba(255,255,255,0.84);
        --grid-lines: rgba(56,84,126,.07);
        --orb-opacity: 0.12;
        --opt-bg: #fff;
    }

    /* =========================================
       ROOT & LAYOUT
    ========================================= */
    .diagnosis-root {
        min-height: 100vh;
        background: var(--bg-primary);
        color: var(--text-primary);
        font-family: 'Inter', system-ui, sans-serif;
        position: relative;
        overflow-x: hidden;
        transition: background .35s ease, color .35s ease;
    }

    /* =========================================
       ANIMATED BACKGROUND
    ========================================= */
    .bg-animated {
        position: fixed;
        inset: 0;
        z-index: 0;
        pointer-events: none;
        overflow: hidden;
    }
    .orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: var(--orb-opacity);
        animation: float 12s ease-in-out infinite;
        transition: opacity .35s;
    }
    .orb-1 {
        width: 600px; height: 600px;
        background: radial-gradient(circle, #6366f1, #8b5cf6);
        top: -200px; left: -150px;
        animation-duration: 15s;
    }
    .orb-2 {
        width: 500px; height: 500px;
        background: radial-gradient(circle, #06b6d4, #3b82f6);
        bottom: -100px; right: -100px;
        animation-duration: 18s;
        animation-delay: -6s;
    }
    .orb-3 {
        width: 350px; height: 350px;
        background: radial-gradient(circle, #f472b6, #ec4899);
        top: 50%; left: 55%;
        animation-duration: 20s;
        animation-delay: -10s;
        opacity: calc(var(--orb-opacity) * 0.55);
    }
    [data-theme="light"] .orb-1 {
        background: radial-gradient(circle, #38bdf8, #0ea5e9);
    }
    [data-theme="light"] .orb-2 {
        background: radial-gradient(circle, #22d3ee, #3b82f6);
    }
    [data-theme="light"] .orb-3 {
        background: radial-gradient(circle, #f59e0b, #fb7185);
        opacity: calc(var(--orb-opacity) * 0.45);
    }
    .grid-overlay {
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(var(--grid-lines) 1px, transparent 1px),
            linear-gradient(90deg, var(--grid-lines) 1px, transparent 1px);
        background-size: 60px 60px;
    }
    @keyframes float {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(40px, -60px) scale(1.08); }
        66% { transform: translate(-30px, 40px) scale(0.95); }
    }

    /* =========================================
       CONTENT WRAP
    ========================================= */
    .content-wrap {
        position: relative;
        z-index: 1;
        max-width: 860px;
        margin: 0 auto;
        padding: 32px 20px 80px;
    }

    /* =========================================
       THEME TOGGLE
    ========================================= */
    .theme-toggle {
        width: 38px; height: 38px;
        border-radius: 50%;
        background: var(--bg-card);
        border: 1px solid var(--border-default);
        color: var(--text-faint);
        cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        transition: all .25s;
        position: relative;
    }
    .theme-toggle:hover { background: var(--accent-bg); border-color: var(--accent-border); color: var(--accent); }
    .theme-icon-sun, .theme-icon-moon { position: absolute; transition: opacity .25s, transform .3s; }
    [data-theme="dark"] .theme-icon-sun { opacity: 1; transform: rotate(0deg); }
    [data-theme="dark"] .theme-icon-moon { opacity: 0; transform: rotate(-90deg); }
    [data-theme="light"] .theme-icon-sun { opacity: 0; transform: rotate(90deg); }
    [data-theme="light"] .theme-icon-moon { opacity: 1; transform: rotate(0deg); }

    /* =========================================
       TOP BAR
    ========================================= */
    .top-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 40px;
    }
    .brand {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 600;
        color: var(--text-muted);
        letter-spacing: 0.02em;
    }
    .brand-dot {
        width: 8px; height: 8px;
        border-radius: 50%;
        background: var(--accent);
        box-shadow: 0 0 10px var(--accent);
        animation: pulse-dot 2s ease-in-out infinite;
    }
    @keyframes pulse-dot {
        0%, 100% { box-shadow: 0 0 6px var(--accent); }
        50% { box-shadow: 0 0 16px var(--accent), 0 0 30px var(--accent-glow); }
    }
    .reset-btn {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        font-weight: 500;
        color: var(--text-faint);
        background: var(--bg-card);
        border: 1px solid var(--border-default);
        padding: 8px 14px;
        border-radius: 100px;
        cursor: pointer;
        transition: all .2s;
        text-decoration: none;
    }
    .reset-btn:hover { color: var(--text-primary); background: var(--bg-card-hover); }
    .link-btn { color: var(--accent-light) !important; border-color: var(--accent-border) !important; background: var(--accent-bg) !important; }
    .link-btn:hover { color: var(--accent) !important; }

    /* =========================================
       STEP INDICATOR
    ========================================= */
    .steps-bar {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0;
        margin-bottom: 48px;
    }
    .step-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .step-circle {
        width: 28px; height: 28px;
        border-radius: 50%;
        background: var(--bg-card);
        border: 1.5px solid var(--border-default);
        color: var(--text-faint);
        font-size: 11px;
        font-weight: 700;
        display: flex; align-items: center; justify-content: center;
        transition: all .3s;
    }
    .step-item.active .step-circle {
        background: var(--accent);
        border-color: var(--accent);
        color: #fff;
        box-shadow: 0 0 16px var(--accent-glow);
    }
    .step-item.done .step-circle {
        background: var(--success);
        border-color: var(--success);
        color: #fff;
    }
    .step-label {
        font-size: 11px;
        color: var(--text-faintest);
        font-weight: 500;
        display: none;
    }
    @media(min-width: 480px) { .step-label { display: inline; } }
    .step-item.active .step-label { color: var(--accent-light); }
    .step-item.done .step-label { color: var(--text-muted); }
    .step-line {
        width: 40px; height: 1.5px;
        background: var(--border-default);
        margin: 0 6px;
        transition: background .3s;
    }
    .step-line.done { background: rgba(34,197,94,0.38); }

    /* =========================================
       ANIMATION CLASSES
    ========================================= */
    .anim-up {
        animation: animUp .4s cubic-bezier(.16,1,.3,1) forwards;
    }
    @keyframes animUp {
        from { opacity:0; transform: translateY(24px); }
        to   { opacity:1; transform: translateY(0); }
    }

    /* =========================================
       HERO (STEP 1)
    ========================================= */
    .hero-block {
        text-align: center;
        margin-bottom: 48px;
    }
    .hero-icon {
        width: 72px; height: 72px;
        background: linear-gradient(135deg, var(--accent), var(--accent-lighter));
        border-radius: 20px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 20px;
        box-shadow: 0 20px 60px var(--accent-glow);
        color: #fff;
    }
    .hero-title {
        font-size: clamp(22px, 4vw, 36px);
        font-weight: 800;
        letter-spacing: -0.02em;
        margin: 0 0 10px;
        background: linear-gradient(135deg, var(--text-primary) 30%, var(--accent-light));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .hero-title .hero-emoji {
        background: none;
        -webkit-background-clip: initial;
        background-clip: initial;
        -webkit-text-fill-color: initial;
        color: var(--accent-light);
    }
    .hero-sub {
        font-size: 15px;
        color: var(--text-muted);
        margin: 0;
    }

    .service-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 24px;
        border-radius: 100px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all .2s;
        text-decoration: none;
        border: 1px solid;
    }
    .service-pill-ask {
        background: rgba(16,185,129,0.1);
        border-color: rgba(16,185,129,0.3);
        color: #10b981;
    }
    .service-pill-ask:hover {
        background: rgba(16,185,129,0.17);
        color: #059669;
    }
    .service-pill-status {
        background: var(--accent-bg);
        border-color: var(--accent-border);
        color: var(--accent-light);
    }
    .service-pill-status:hover {
        background: rgba(14,165,233,0.2);
        color: var(--accent);
    }
    [data-theme="dark"] .service-pill-ask {
        background: rgba(168,85,247,0.12);
        border-color: rgba(168,85,247,0.3);
        color: rgba(216,180,254,0.92);
    }
    [data-theme="dark"] .service-pill-ask:hover {
        background: rgba(168,85,247,0.22);
        color: #d8b4fe;
    }
    [data-theme="dark"] .service-pill-status {
        background: rgba(14,165,233,0.1);
        border-color: rgba(14,165,233,0.25);
        color: rgba(125,211,252,0.88);
    }
    [data-theme="dark"] .service-pill-status:hover {
        background: rgba(14,165,233,0.18);
        color: #7dd3fc;
    }

    /* =========================================
       CATEGORY GRID
    ========================================= */
    .cat-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 14px;
    }
    @media(min-width:560px){ .cat-grid { grid-template-columns: repeat(3, 1fr); } }
    @media(min-width:760px){ .cat-grid { grid-template-columns: repeat(4, 1fr); } }

    /* ---------- GLASS + LIQUID CARD ---------- */
    .cat-card {
        position: relative;
        overflow: hidden;
        background: var(--glass-bg);
        border: 1px solid var(--border-default);
        border-radius: 20px;
        padding: 24px 14px 20px;
        text-align: center;
        cursor: pointer;
        display: flex; flex-direction: column; align-items: center;
        backdrop-filter: blur(40px) saturate(160%);
        -webkit-backdrop-filter: blur(40px) saturate(160%);
        box-shadow:
            0 0 0 1px rgba(255,255,255,0.04) inset,
            var(--glass-inset),
            var(--glass-shadow),
            0 1px 0 rgba(255,255,255,0.04) inset;
        transition: transform .35s cubic-bezier(.16,1,.3,1),
                    box-shadow .35s ease,
                    border-color .35s ease,
                    background .35s ease;
    }

    /* Liquid blob — follows cursor via CSS vars --cx / --cy */
    .cat-card::before {
        content: '';
        position: absolute;
        width: 180%;
        height: 180%;
        top: calc(var(--cy, 50%) - 90%);
        left: calc(var(--cx, 50%) - 90%);
        background: radial-gradient(ellipse 55% 45% at 50% 50%,
            rgba(99,102,241,0.45) 0%,
            rgba(139,92,246,0.25) 35%,
            transparent 70%);
        filter: blur(32px);
        border-radius: 50%;
        opacity: 0;
        transform: scale(0.6);
        transition: opacity .45s ease, transform .55s cubic-bezier(.16,1,.3,1), top .12s ease, left .12s ease;
        pointer-events: none;
        z-index: 0;
    }
    .cat-card:hover::before {
        opacity: 1;
        transform: scale(1);
    }

    /* Shimmer sweep on hover */
    .cat-card::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(
            108deg,
            transparent 25%,
            rgba(255,255,255,0.07) 50%,
            transparent 75%
        );
        transform: translateX(-110%) skewX(-10deg);
        pointer-events: none;
        z-index: 1;
        transition: none;
    }
    .cat-card:hover::after {
        transform: translateX(110%) skewX(-10deg);
        transition: transform .55s ease;
    }

    /* Idle liquid pulse — each card offset */
    .cat-card:nth-child(1)  { animation: card-idle 7s  2.0s ease-in-out infinite; }
    .cat-card:nth-child(2)  { animation: card-idle 8s  0.5s ease-in-out infinite; }
    .cat-card:nth-child(3)  { animation: card-idle 9s  1.2s ease-in-out infinite; }
    .cat-card:nth-child(4)  { animation: card-idle 7s  3.1s ease-in-out infinite; }
    .cat-card:nth-child(5)  { animation: card-idle 8s  0.8s ease-in-out infinite; }
    .cat-card:nth-child(6)  { animation: card-idle 10s 1.8s ease-in-out infinite; }
    .cat-card:nth-child(7)  { animation: card-idle 7s  2.6s ease-in-out infinite; }
    .cat-card:nth-child(8)  { animation: card-idle 9s  0.3s ease-in-out infinite; }
    .cat-card:nth-child(9)  { animation: card-idle 8s  1.5s ease-in-out infinite; }
    .cat-card:nth-child(10) { animation: card-idle 7s  3.8s ease-in-out infinite; }
    .cat-card:nth-child(11) { animation: card-idle 9s  2.2s ease-in-out infinite; }
    .cat-card:nth-child(12) { animation: card-idle 8s  0.9s ease-in-out infinite; }
    .cat-card:nth-child(13) { animation: card-idle 10s 1.1s ease-in-out infinite; }

    @keyframes card-idle {
        0%, 100% { box-shadow: var(--glass-inset), var(--glass-shadow); }
        50%       { box-shadow: var(--glass-inset), var(--glass-shadow), 0 0 28px rgba(99,102,241,0.12); }
    }

    /* Hover state */
    .cat-card:hover {
        background: var(--bg-card-hover);
        border-color: var(--border-hover);
        transform: translateY(-5px) scale(1.02);
        box-shadow:
            0 0 0 1px rgba(255,255,255,0.06) inset,
            0 2px 0 rgba(255,255,255,0.10) inset,
            0 24px 64px var(--accent-glow),
            0 8px 32px rgba(0,0,0,0.25);
        animation: none;
    }

    /* Content above effects */
    .cat-icon, .cat-label, .cat-desc { position: relative; z-index: 2; }

    .cat-icon { font-size: 32px; margin-bottom: 10px; display: block; filter: drop-shadow(0 4px 12px rgba(0,0,0,0.4)); }
    .cat-label {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: var(--text-secondary);
        margin-bottom: 4px;
    }
    .cat-desc {
        display: block;
        font-size: 11px;
        color: var(--text-faint);
        line-height: 1.5;
    }
    .asp-tag { color: var(--success-text) !important; font-weight: 600; }
    .footnote {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-align: center;
        font-size: 11px;
        color: var(--text-faintest);
        margin-top: 32px;
    }

    /* =========================================
       ASP BADGE
    ========================================= */
    .asp-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: var(--success-bg);
        border: 1px solid var(--success-border);
        color: var(--success-text);
        font-size: 12px;
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 100px;
    }
    .non-asp-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: rgba(245,158,11,0.1);
        border: 1px solid rgba(245,158,11,0.25);
        color: var(--warn-text);
        font-size: 12px;
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 100px;
    }

    /* =========================================
       TIER SELECTION (Brand Premium/Standard)
    ========================================= */
    .tier-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 16px;
        max-width: 600px;
        margin: 0 auto;
    }
    @media(min-width:600px){ .tier-grid { grid-template-columns: 1fr 1fr; } }

    .tier-card {
        background: var(--bg-card);
        border: 1px solid var(--border-default);
        border-radius: 18px;
        padding: 20px;
        text-align: left;
        cursor: pointer;
        transition: all .25s;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }
    .tier-card:hover {
        transform: translateY(-3px);
        border-color: var(--border-hover);
        box-shadow: 0 16px 48px var(--accent-glow);
    }
    .tier-premium:hover { border-color: rgba(245,158,11,0.5); box-shadow: 0 16px 48px rgba(245,158,11,0.15); }
    .tier-header { display: flex; align-items: center; gap: 8px; }
    .tier-badge {
        font-size: 13px;
        font-weight: 700;
        padding: 5px 12px;
        border-radius: 100px;
    }
    .tier-badge.premium { background: rgba(245,158,11,0.15); color: var(--warn-text); border: 1px solid rgba(245,158,11,0.3); }
    .tier-badge.standard { background: var(--accent-bg); color: var(--accent-light); border: 1px solid var(--accent-border); }
    .tier-series { display: flex; flex-wrap: wrap; gap: 6px; }
    .tier-series-tag {
        font-size: 11px;
        background: var(--bg-input);
        border: 1px solid var(--border-subtle);
        color: var(--text-muted);
        padding: 3px 10px;
        border-radius: 100px;
    }
    .tier-warranty {
        font-size: 13px;
        color: var(--text-muted);
        line-height: 1.8;
    }
    .tier-warranty strong { color: var(--text-secondary); }
    .tier-adp {
        margin-top: 6px;
        padding: 10px 12px;
        background: var(--success-bg);
        border: 1px solid var(--success-border);
        border-radius: 10px;
        font-size: 12px;
        line-height: 1.6;
    }
    .tier-adp strong { color: var(--success-text); display: block; margin-bottom: 3px; }
    .tier-adp span { color: var(--text-muted); }
    .tier-no-adp {
        margin-top: 6px;
        font-size: 12px;
        color: var(--text-faint);
        padding: 8px 12px;
        background: var(--bg-input);
        border-radius: 10px;
    }

    /* =========================================
       MANUAL BRAND FORM
    ========================================= */
    .manual-brand-form {
        max-width: 480px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 18px;
    }
    .manual-brand-note {
        font-size: 12px;
        color: var(--warn-text);
        background: rgba(245,158,11,0.08);
        border: 1px solid rgba(245,158,11,0.2);
        border-radius: 12px;
        padding: 12px 16px;
        line-height: 1.6;
    }

    /* =========================================
       BACK BUTTON
    ========================================= */
    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        font-weight: 500;
        color: var(--text-faint);
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
        margin-bottom: 32px;
        transition: color .2s;
    }
    .back-btn:hover { color: var(--accent-light); }

    /* =========================================
       SECTION HEAD (STEP 2)
    ========================================= */
    .section-head {
        text-align: center;
        margin-bottom: 32px;
    }
    .section-emoji { font-size: 44px; display: block; margin-bottom: 12px; }
    .section-title { font-size: 24px; font-weight: 800; margin: 0 0 8px; letter-spacing: -0.02em; }
    .section-sub { font-size: 14px; color: var(--text-muted); margin: 0; }

    /* =========================================
       PROBLEM LIST
    ========================================= */
    .problem-list {
        max-width: 600px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .problem-card {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 16px;
        background: var(--bg-card);
        border: 1px solid var(--border-subtle);
        border-radius: 14px;
        padding: 16px 20px;
        text-align: left;
        cursor: pointer;
        transition: all .2s;
        backdrop-filter: blur(8px);
    }
    .problem-card:hover {
        background: var(--accent-bg);
        border-color: rgba(99,102,241,0.35);
        transform: translateX(4px);
    }
    .problem-arrow {
        width: 34px; height: 34px;
        background: rgba(99,102,241,0.15);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        color: #818cf8;
        flex-shrink: 0;
        transition: background .2s;
    }
    .problem-card:hover .problem-arrow { background: rgba(99,102,241,0.3); }
    .problem-text { flex: 1; }
    .problem-label { display: block; font-size: 14px; font-weight: 600; color: var(--text-secondary); margin-bottom: 3px; }
    .problem-desc { display: block; font-size: 12px; color: var(--text-faint); }

    /* =========================================
       QUESTION PAGE (STEP 3)
    ========================================= */
    .q-wrap { max-width: 600px; margin: 0 auto; }
    .q-progress-row { display: flex; justify-content: space-between; margin-bottom: 8px; }
    .q-progress-label { font-size: 13px; color: var(--text-muted); font-weight: 500; }
    .q-progress-pct { font-size: 12px; color: var(--text-faint); }
    .q-progress-bar {
        height: 4px;
        background: var(--bg-card);
        border-radius: 99px;
        overflow: hidden;
        margin-bottom: 28px;
    }
    .q-progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #6366f1, #8b5cf6);
        border-radius: 99px;
        transition: width .5s ease;
    }
    .q-card {
        background: var(--bg-card);
        border: 1px solid var(--border-default);
        border-radius: 20px;
        overflow: hidden;
        backdrop-filter: blur(16px);
    }
    .q-card-header {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        padding: 16px 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 13px;
        color: rgba(255,255,255,0.8);
        font-weight: 500;
    }
    .q-badge {
        width: 32px; height: 32px;
        background: rgba(255,255,255,0.2);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-weight: 800;
        font-size: 16px;
        flex-shrink: 0;
        color: #fff;
    }
    .q-card-body { padding: 28px 24px; }
    .q-text {
        font-size: 18px;
        font-weight: 600;
        color: var(--text-primary);
        line-height: 1.6;
        margin: 0 0 28px;
    }
    .q-buttons-main {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 10px;
    }
    .q-btn {
        padding: 16px;
        border-radius: 14px;
        font-size: 17px;
        font-weight: 700;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all .2s;
    }
    .q-btn-yes {
        background: #22c55e;
        color: #fff;
    }
    .q-btn-yes:hover { background: #16a34a; transform: translateY(-2px); box-shadow: 0 8px 24px #22c55e40; }
    .q-btn-no {
        background: var(--bg-input);
        color: var(--text-muted);
        border: 1px solid var(--border-default);
    }
    .q-btn-no:hover { background: var(--bg-card-hover); transform: translateY(-2px); }
    .q-btn-skip {
        width: 100%;
        padding: 12px;
        background: transparent;
        border: 1px solid var(--border-subtle);
        border-radius: 12px;
        color: var(--text-faint);
        font-size: 13px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: all .2s;
    }
    .q-btn-skip:hover { background: var(--bg-card); color: var(--text-muted); }
    /* Choice buttons for non-binary questions */
    .q-buttons-choice {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 10px;
    }
    .q-btn-choice {
        width: 100%;
        padding: 14px 18px;
        background: var(--accent-bg);
        color: var(--accent-lighter);
        border: 1px solid var(--accent-border);
        border-radius: 14px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all .2s;
        text-align: left;
    }
    .q-btn-choice:hover { background: rgba(99,102,241,0.25); border-color: rgba(99,102,241,0.5); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(99,102,241,0.25); }

    /* answered summary */
    .q-answered { margin-top: 16px; }
    .q-answered-toggle {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        color: var(--text-faint);
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
        transition: color .2s;
    }
    .q-answered-toggle:hover { color: var(--accent-light); }
    .q-chevron { transition: transform .2s; }
    .q-chevron.rotated { transform: rotate(90deg); }
    .q-answered-list {
        margin-top: 10px;
        background: var(--bg-input);
        border: 1px solid var(--border-subtle);
        border-radius: 12px;
        padding: 12px 16px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .q-answered-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 13px;
        color: var(--text-muted);
    }
    .q-answer-badge {
        font-size: 11px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 100px;
        flex-shrink: 0;
    }
    .q-answer-badge.yes    { background: #22c55e20; color: var(--success-text); }
    .q-answer-badge.no     { background: var(--bg-card); color: var(--text-faint); }
    .q-answer-badge.choice { background: rgba(99,102,241,0.2); color: var(--accent-light); }

    /* =========================================
       RESULT PAGE (STEP 4)
    ========================================= */
    .result-complaint {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: var(--bg-card);
        border: 1px solid var(--border-default);
        border-radius: 100px;
        padding: 8px 16px;
        margin-bottom: 24px;
        font-size: 13px;
    }
    .result-complaint-icon { font-size: 20px; }
    .result-complaint-cat { font-weight: 600; color: var(--text-secondary); }
    .result-complaint-prob { color: var(--text-muted); }

    .result-card {
        background: var(--bg-card);
        border: 1px solid var(--border-subtle);
        border-radius: 20px;
        overflow: hidden;
        backdrop-filter: blur(16px);
    }
    .result-card-header {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        padding: 20px 24px;
        display: flex;
        align-items: center;
        gap: 14px;
        color: #fff;
    }
    .result-header-icon {
        width: 44px; height: 44px;
        background: rgba(255,255,255,0.2);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .result-title { font-size: 18px; font-weight: 700; margin: 0; color: #fff; }
    .result-subtitle { font-size: 12px; color: rgba(255,255,255,0.65); margin: 2px 0 0; }

    .result-body { padding: 24px; display: flex; flex-direction: column; gap: 24px; }
    .result-section-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--text-faint);
        margin-bottom: 12px;
    }
    .dot { width: 6px; height: 6px; border-radius: 50%; display: inline-block; }
    .dot-amber { background: var(--warn); }
    .dot-red   { background: var(--error); }

    /* Symptom tags */
    .symptom-tags { display: flex; flex-wrap: wrap; gap: 8px; }
    .symptom-tag {
        background: rgba(245,158,11,0.12);
        border: 1px solid rgba(245,158,11,0.2);
        color: var(--warn-text);
        font-size: 12px;
        font-weight: 500;
        padding: 5px 12px;
        border-radius: 100px;
    }

    /* Diag cards */
    .diag-card {
        background: var(--bg-input);
        border: 1px solid var(--border-subtle);
        border-radius: 14px;
        overflow: hidden;
        margin-bottom: 12px;
        transition: border-color .2s;
    }
    .diag-card:hover { border-color: rgba(99,102,241,0.3); }
    .diag-top {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 16px;
        border-bottom: 1px solid var(--border-subtle);
    }
    .diag-rank {
        width: 28px; height: 28px;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 12px; font-weight: 800;
        color: #fff;
        flex-shrink: 0;
    }
    .diag-info { flex: 1; min-width: 0; }
    .diag-name-row { display: flex; flex-wrap: wrap; align-items: center; gap: 6px; margin-bottom: 4px; }
    .diag-name { font-size: 14px; font-weight: 700; color: var(--text-secondary); }
    .diag-code {
        font-size: 10px;
        font-family: monospace;
        background: var(--bg-card);
        color: var(--text-faint);
        padding: 2px 6px;
        border-radius: 4px;
    }
    .diag-level {
        font-size: 10px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 100px;
    }
    .lvl-ringan { background: #22c55e18; color: var(--success-text); border: 1px solid #22c55e25; }
    .lvl-sedang { background: #f59e0b18; color: var(--warn-text); border: 1px solid #f59e0b25; }
    .lvl-berat  { background: #ef444418; color: var(--error-text); border: 1px solid #ef444425; }
    .diag-desc { font-size: 12px; color: var(--text-muted); margin: 0; }
    .diag-cf { text-align: right; flex-shrink: 0; }
    .diag-cf-num { display: block; font-size: 22px; font-weight: 900; line-height: 1; }
    .diag-cf-label { font-size: 10px; color: var(--text-faint); font-weight: 600; }
    .diag-bar-wrap { height: 3px; background: var(--bg-card); }
    .diag-bar-fill { height: 100%; transition: width .6s ease; border-radius: 99px; }
    .diag-details { padding: 14px 16px; display: flex; flex-direction: column; gap: 10px; }
    .diag-detail-row { display: flex; flex-direction: column; gap: 6px; }
    .diag-detail-label { font-size: 11px; color: var(--text-faint); font-weight: 600; }
    .diag-match-tags { display: flex; flex-wrap: wrap; gap: 5px; }
    .diag-match-tag {
        font-size: 11px;
        background: var(--accent-bg);
        color: var(--accent-light);
        border: 1px solid rgba(99,102,241,0.2);
        padding: 3px 9px;
        border-radius: 100px;
    }
    .diag-solution {
        display: flex;
        gap: 10px;
        background: var(--success-bg);
        border: 1px solid var(--success-border);
        border-radius: 10px;
        padding: 12px 14px;
        font-size: 13px;
        color: var(--success-text);
        line-height: 1.5;
    }
    .diag-solution-icon { flex-shrink: 0; margin-top: 1px; }
    .diag-actions { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 6px; }
    .diag-actions li {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        font-size: 13px;
        color: var(--text-muted);
    }
    .diag-actions li svg { flex-shrink: 0; margin-top: 2px; color: #818cf8; }
    .diag-cost {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: var(--accent-bg);
        border: 1px solid rgba(99,102,241,0.2);
        border-radius: 10px;
        padding: 10px 14px;
    }
    .diag-cost-label { font-size: 11px; color: var(--text-faint); font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; }
    .diag-cost-val { font-size: 16px; font-weight: 800; color: var(--accent-light); }

    /* no diagnosis */
    .no-diag { text-align: center; padding: 40px 20px; }
    .no-diag-icon { font-size: 48px; margin-bottom: 16px; }
    .no-diag-title { font-size: 16px; font-weight: 700; color: var(--text-secondary); margin: 0 0 8px; }
    .no-diag-sub { font-size: 13px; color: var(--text-muted); margin: 0; max-width: 340px; margin: 0 auto; }

    /* result qa */
    .result-qa-summary { border-top: 1px solid var(--border-subtle); padding-top: 16px; }
    .result-qa-toggle {
        display: flex; align-items: center; gap: 6px;
        font-size: 12px; color: var(--text-faint);
        background: none; border: none; cursor: pointer; padding: 0;
        transition: color .2s;
    }
    .result-qa-toggle:hover { color: var(--accent-light); }
    .result-qa-list { margin-top: 12px; display: flex; flex-direction: column; gap: 8px; }
    .result-qa-item { display: flex; align-items: flex-start; gap: 10px; font-size: 12px; color: var(--text-muted); }

    /* CTA */
    .result-cta {
        border-top: 1px solid var(--border-subtle);
        padding: 24px 24px 20px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .cta-primary {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff;
        font-size: 16px;
        font-weight: 700;
        border: none;
        border-radius: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all .2s;
        box-shadow: 0 8px 32px rgba(99,102,241,0.35);
    }
    .cta-primary:hover { transform: translateY(-2px); box-shadow: 0 14px 40px rgba(99,102,241,0.45); }
    .cta-secondary {
        width: 100%;
        padding: 13px;
        background: var(--bg-card);
        border: 1px solid var(--border-default);
        border-radius: 14px;
        color: var(--text-muted);
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all .2s;
    }
    .cta-secondary:hover { background: var(--bg-card-hover); color: var(--text-primary); }
    .cta-badges {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 16px;
        font-size: 12px;
        color: var(--text-faint);
        padding-top: 4px;
    }

    /* =========================================
       GLASS CARD (BOOKING)
    ========================================= */
    .glass-card {
        background: var(--bg-card);
        border: 1px solid var(--border-subtle);
        border-radius: 20px;
        overflow: hidden;
        backdrop-filter: blur(16px);
        max-width: 680px;
        margin: 0 auto;
    }
    .glass-card-header {
        padding: 20px 24px;
        display: flex;
        align-items: center;
        gap: 14px;
        background: linear-gradient(135deg, #059669, #0d9488);
        color: #fff;
    }
    .glass-card-header.green { background: linear-gradient(135deg, #059669, #0d9488); }
    .glass-card-icon {
        width: 44px; height: 44px;
        background: rgba(255,255,255,0.2);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .glass-card-header h3 { font-size: 17px; font-weight: 700; margin: 0; }
    .glass-card-header p { font-size: 12px; color: rgba(255,255,255,0.65); margin: 2px 0 0; }

    .booking-form { padding: 28px 24px; display: flex; flex-direction: column; gap: 20px; }
    .form-row { display: grid; gap: 20px; }
    @media(min-width:600px){ .form-row { grid-template-columns: 1fr 1fr; } }
    .form-group { display: flex; flex-direction: column; gap: 6px; }
    .form-group label { font-size: 13px; font-weight: 600; color: var(--text-muted); }
    .form-opt { font-weight: 400; color: var(--text-faint); }
    .form-group input,
    .form-group select,
    .form-group textarea {
        background: var(--bg-input);
        border: 1px solid var(--border-default);
        border-radius: 12px;
        padding: 12px 16px;
        color: var(--text-primary);
        font-size: 14px;
        font-family: inherit;
        outline: none;
        transition: border-color .2s, background .2s;
    }
    .form-group input::placeholder,
    .form-group textarea::placeholder { color: var(--text-faintest); }
    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus { border-color: var(--accent); background: var(--bg-input-focus); }
    .form-group select option { background: var(--opt-bg); color: var(--text-primary); }
    .form-group textarea { resize: none; }
    .form-error { font-size: 12px; color: var(--error-text); }
    .form-actions { display: flex; gap: 12px; padding-top: 4px; }
    .form-btn-cancel {
        flex: 0 0 auto;
        padding: 13px 24px;
        background: var(--bg-card);
        border: 1px solid var(--border-default);
        border-radius: 12px;
        color: var(--text-muted);
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all .2s;
    }
    .form-btn-cancel:hover { background: var(--bg-card-hover); color: var(--text-primary); }
    .form-btn-submit {
        flex: 1;
        padding: 13px;
        background: linear-gradient(135deg, #059669, #0d9488);
        color: #fff;
        font-size: 15px;
        font-weight: 700;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        transition: all .2s;
        display: flex; align-items: center; justify-content: center; gap: 8px;
        box-shadow: 0 8px 24px rgba(5,150,105,0.3);
    }
    .form-btn-submit:hover { opacity: .9; transform: translateY(-1px); }
    .form-btn-submit.loading { opacity: .7; cursor: wait; }
    .loading-text { display: flex; align-items: center; gap: 8px; }
    .op25 { opacity: .25; }
    .op75 { opacity: .75; }

    /* =========================================
       SUCCESS PAGE
    ========================================= */
    .success-card {
        text-align: center;
        max-width: 480px;
        margin: 40px auto 0;
        padding: 48px 32px;
        background: var(--bg-card);
        border: 1px solid var(--border-subtle);
        border-radius: 24px;
        backdrop-filter: blur(16px);
    }
    .success-icon-wrap {
        position: relative;
        width: 96px; height: 96px;
        margin: 0 auto 28px;
    }
    .success-icon {
        width: 96px; height: 96px;
        background: linear-gradient(135deg, #22c55e, #16a34a);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 0 0 0 rgba(34,197,94,0.4);
        animation: success-pulse 2s ease-out infinite;
    }
    .success-rings {
        position: absolute;
        inset: -12px;
        border-radius: 50%;
        border: 2px solid rgba(34,197,94,0.2);
        animation: ring-expand 2s ease-out infinite;
    }
    @keyframes success-pulse {
        0% { box-shadow: 0 0 0 0 rgba(34,197,94,0.4); }
        70% { box-shadow: 0 0 0 20px rgba(34,197,94,0); }
        100% { box-shadow: 0 0 0 0 rgba(34,197,94,0); }
    }
    @keyframes ring-expand {
        0% { transform: scale(1); opacity: 1; }
        100% { transform: scale(1.5); opacity: 0; }
    }
    .success-title { font-size: 26px; font-weight: 800; margin: 0 0 10px; letter-spacing: -0.02em; }
    .success-sub { font-size: 14px; color: var(--text-muted); max-width: 320px; margin: 0 auto 28px; line-height: 1.7; }
    .booking-code-box {
        background: var(--success-bg);
        border: 1px solid var(--success-border);
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 24px;
    }
    .booking-code-label { display: block; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-faint); margin-bottom: 6px; }
    .booking-code { font-size: 38px; font-family: 'Courier New', monospace; font-weight: 900; color: var(--success-text); letter-spacing: 4px; }
    .success-info {
        text-align: left;
        background: var(--bg-input);
        border: 1px solid var(--border-subtle);
        border-radius: 14px;
        padding: 16px;
        margin-bottom: 28px;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .success-info-item { display: flex; gap: 12px; font-size: 13px; align-items: flex-start; }
    .success-info-item strong { display: block; color: var(--text-secondary); font-weight: 600; margin-bottom: 2px; }
    .success-info-item span { color: var(--text-muted); display: block; }
    .success-back-btn {
        padding: 13px 36px;
        background: var(--bg-card);
        border: 1px solid var(--border-default);
        color: var(--text-primary);
        font-size: 14px;
        font-weight: 600;
        border-radius: 100px;
        cursor: pointer;
        transition: all .2s;
    }
    .success-back-btn:hover { background: var(--bg-card-hover); transform: translateY(-1px); }

    /* =========================================
       LOADING OVERLAY
    ========================================= */
    .loading-overlay {
        position: fixed;
        inset: 0;
        background: var(--bg-overlay);
        backdrop-filter: blur(6px);
        z-index: 100;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .loading-box {
        background: var(--bg-loading);
        border: 1px solid var(--border-default);
        border-radius: 16px;
        padding: 20px 28px;
        display: flex;
        align-items: center;
        gap: 14px;
        font-size: 14px;
        font-weight: 500;
        color: var(--text-muted);
        backdrop-filter: blur(16px);
    }

    /* =========================================
       SPINNER
    ========================================= */
    .spin {
        animation: spin .8s linear infinite;
    }
    @keyframes spin {
        from { transform: rotate(0deg); }
        to   { transform: rotate(360deg); }
    }

    /* ============================
       BACKWARD CHAINING STYLES
       ============================ */

    /* BC Badge */
    .bc-badge-wrap { text-align: center; margin-bottom: 1rem; }
    .bc-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: linear-gradient(135deg, #3b82f6, #6366f1);
        color: #fff; font-size: .85rem; font-weight: 600;
        padding: 6px 16px; border-radius: 20px;
    }
    .bc-badge svg { flex-shrink: 0; }
    .bc-badge-desc {
        font-size: .78rem; color: var(--text-muted); margin-top: 6px;
    }

    /* BC progress bar */
    .q-progress-fill.bc-fill {
        background: linear-gradient(90deg, #3b82f6, #6366f1) !important;
    }

    /* BC question card */
    .bc-card { border-color: rgba(99, 102, 241, 0.3) !important; }
    .bc-header { background: rgba(99, 102, 241, 0.08) !important; }
    .bc-q-badge {
        background: linear-gradient(135deg, #3b82f6, #6366f1) !important;
        color: #fff !important;
    }

    /* BC related hypotheses */
    .bc-related {
        display: flex; flex-wrap: wrap; align-items: center; gap: 6px;
        margin-top: 10px; padding-top: 10px;
        border-top: 1px dashed var(--border);
    }
    .bc-related-label {
        font-size: .75rem; color: var(--text-muted); font-weight: 500;
    }
    .bc-related-tag {
        font-size: .72rem; background: rgba(99, 102, 241, 0.12);
        color: #818cf8; padding: 2px 8px; border-radius: 10px;
        font-weight: 500;
    }

    /* BC skip row */
    .bc-skip-row {
        display: flex; justify-content: center; gap: 8px; flex-wrap: wrap;
        margin-top: 4px;
    }
    .bc-skip-all {
        color: var(--text-muted) !important;
        opacity: 0.7;
    }
    .bc-skip-all:hover {
        opacity: 1;
        background: var(--bg-card) !important;
    }

    /* BC Checklist Styles */
    .bc-checklist {
        display: flex; flex-direction: column; gap: 8px;
        margin-bottom: 20px;
    }
    .bc-check-item {
        display: flex; align-items: flex-start; gap: 12px;
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 14px 16px;
        cursor: pointer;
        transition: all 0.2s;
        user-select: none;
    }
    .bc-check-item:hover {
        border-color: rgba(99, 102, 241, 0.4);
        background: rgba(99, 102, 241, 0.04);
    }
    .bc-checkbox {
        flex-shrink: 0;
        width: 22px; height: 22px;
        border: 2px solid rgba(148, 163, 184, 0.4);
        border-radius: 6px;
        display: flex; align-items: center; justify-content: center;
        transition: all 0.2s;
        margin-top: 1px;
    }
    .bc-checkbox.bc-checked {
        background: linear-gradient(135deg, #3b82f6, #6366f1);
        border-color: #6366f1;
        color: #fff;
    }
    .bc-check-content { flex: 1; }
    .bc-check-text {
        display: block; font-size: 14px; color: #e2e8f0;
        font-weight: 500; line-height: 1.4;
    }
    .bc-check-hint {
        display: block; font-size: 12px; color: #94a3b8;
        margin-top: 4px; line-height: 1.4;
    }
    .bc-checklist-actions {
        display: flex; flex-direction: column; align-items: center; gap: 10px;
    }
    .bc-submit-btn {
        max-width: 400px; width: 100%;
    }

    /* Verification Summary */
    .bc-summary { margin-top: 8px; }
    .bc-summary-stats {
        display: flex; gap: 12px; margin-bottom: 10px;
    }
    .bc-stat {
        flex: 1; text-align: center; padding: 10px;
        background: var(--bg-card); border-radius: 10px;
        border: 1px solid var(--border);
    }
    .bc-stat-num {
        display: block; font-size: 1.4rem; font-weight: 700;
    }
    .bc-stat-num.bc-confirmed { color: #22c55e; }
    .bc-stat-num.bc-denied { color: #ef4444; }
    .bc-stat-num.bc-total { color: #3b82f6; }
    .bc-stat-label {
        font-size: .7rem; color: var(--text-muted); text-transform: uppercase;
        letter-spacing: 0.5px; font-weight: 500;
    }
    .bc-method-badge {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: .75rem; color: #818cf8; background: rgba(99, 102, 241, 0.1);
        padding: 4px 12px; border-radius: 12px; font-weight: 500;
    }

    /* Verification status badge on diagnosis card */
    .diag-verify-badge {
        display: inline-flex; align-items: center; gap: 3px;
        font-size: .65rem; font-weight: 600; padding: 2px 8px;
        border-radius: 8px; text-transform: uppercase; letter-spacing: 0.3px;
    }
    .verify-green { background: rgba(34, 197, 94, 0.15); color: #22c55e; }
    .verify-blue  { background: rgba(59, 130, 246, 0.15); color: #3b82f6; }
    .verify-yellow { background: rgba(245, 158, 11, 0.15); color: #f59e0b; }
    .verify-red   { background: rgba(239, 68, 68, 0.15); color: #ef4444; }
    .verify-gray  { background: rgba(156, 163, 175, 0.15); color: #9ca3af; }
    .verify-emerald { background: rgba(16, 185, 129, 0.15); color: #10b981; }

    /* Direct diagnosis note */
    .direct-diagnosis-note {
        display: flex; align-items: flex-start; gap: 12px;
        background: rgba(16, 185, 129, 0.08); border: 1px solid rgba(16, 185, 129, 0.2);
        border-radius: 12px; padding: 14px 16px;
    }
    .direct-note-icon { font-size: 1.3rem; flex-shrink: 0; margin-top: 1px; }
    .direct-note-text { font-size: .85rem; color: #a7f3d0; line-height: 1.5; margin: 0; }
    .dot-green { background: #10b981; }

    /* CF change indicator */
    .diag-cf-change {
        display: block; font-size: .65rem; font-weight: 600;
        margin-top: 2px; text-align: center;
    }
    .cf-up { color: #22c55e; }
    .cf-down { color: #ef4444; }

    /* Denied diagnosis card */
    .diag-rejected {
        opacity: 0.6; border-color: rgba(239, 68, 68, 0.3) !important;
    }

    /* Denied symptoms tag */
    .diag-denied-label { color: #ef4444 !important; }
    .diag-denied-tag {
        font-size: .72rem; background: rgba(239, 68, 68, 0.12);
        color: #f87171; padding: 2px 8px; border-radius: 8px;
        text-decoration: line-through;
    }

    /* Dot colors */
    .dot-blue {
        width: 8px; height: 8px; border-radius: 50%;
        background: #3b82f6; display: inline-block;
    }

    /* BC toggle in results */
    .bc-toggle { color: #818cf8 !important; }
    .bc-qa-related {
        display: flex; flex-wrap: wrap; gap: 4px; margin-top: 4px;
    }

    /* Warranty note */
    .warranty-note {
        display: flex; gap: 14px; align-items: flex-start;
        background: linear-gradient(135deg, rgba(6,182,212,0.08), rgba(59,130,246,0.06));
        border: 1px solid rgba(6,182,212,0.25);
        border-left: 4px solid #06b6d4;
        border-radius: 12px;
        padding: 16px 18px;
        margin: 16px 0 8px;
    }
    .warranty-note-icon {
        flex-shrink: 0;
        width: 38px; height: 38px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 10px;
        background: rgba(6,182,212,0.15);
        color: #06b6d4;
    }
    .warranty-note-content strong {
        display: block; font-size: 14px; color: #e2e8f0; margin-bottom: 6px;
    }
    .warranty-note-content p {
        font-size: 13px; color: #94a3b8; line-height: 1.6; margin: 0;
    }
    .warranty-note-content em { font-style: italic; color: #67e8f9; }
    </style>

    {{-- Liquid tracking script --}}
    <script>
    (function() {
        function initLiquid() {
            var cards = document.querySelectorAll('.cat-card');
            cards.forEach(function(card) {
                card.addEventListener('mousemove', function(e) {
                    var rect = card.getBoundingClientRect();
                    var x = ((e.clientX - rect.left) / rect.width)  * 100;
                    var y = ((e.clientY - rect.top)  / rect.height) * 100;
                    card.style.setProperty('--cx', x + '%');
                    card.style.setProperty('--cy', y + '%');
                });
                card.addEventListener('mouseleave', function() {
                    card.style.setProperty('--cx', '50%');
                    card.style.setProperty('--cy', '50%');
                });
            });
        }
        // Run once DOM is ready, and re-run after each Livewire re-render
        document.addEventListener('DOMContentLoaded', initLiquid);
        document.addEventListener('livewire:navigated', initLiquid);
        document.addEventListener('livewire:update', function() { setTimeout(initLiquid, 50); });
    })();
    </script>

</div>
