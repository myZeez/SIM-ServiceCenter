<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\Symptom;
use App\Services\BackwardChainingEngine;
use App\Services\ForwardChainingEngine;
use Livewire\Component;

/**
 * DiagnosisChat Component - Sistem Pakar Diagnosis Multi-Device
 *
 * UI berbasis wizard step-by-step:
 * 1. User pilih jenis perangkat (Laptop, PC/AIO, Printer)
 * 2. User pilih kategori masalah
 * 3. User pilih sub-masalah spesifik
 * 4. Sistem ajukan pertanyaan lanjutan (Ya/Tidak)
 * 5. Jalankan inferensi Forward Chaining
 * 6. Tampilkan hasil diagnosis
 * 7. Booking servis (opsional)
 */
class DiagnosisChat extends Component
{
    // ===========================
    // STATE
    // ===========================
    public string $state = 'select_device';
    // States: select_device → select_category → select_problem → asking → verifying → diagnosed → booking → completed
    // Service inquiry: select_device → service_inquiry → service_detail → service_booking → completed

    public ?string $selectedDeviceType = null;
    public ?string $selectedCategoryKey = null;
    public ?string $selectedProblemKey = null;

    // Diagnosis data
    public array $collectedSymptoms = [];
    public ?array $diagnosisResult = null;
    public ?array $currentQuestion = null;
    public int $questionCount = 0;
    public int $maxQuestions = 3;
    public array $answeredQuestions = [];

    // Engine state (serialized for Livewire lifecycle)
    public array $engineState = [];

    // Backward Chaining state (one-shot checklist mode)
    public array $bcEngineState = [];
    public array $bcQuestions = [];             // All verification questions (displayed as checklist)
    public array $bcChecklist = [];             // User's checklist answers: symptom_id => bool
    public array $bcAnsweredQuestions = [];     // Log of answered BC questions
    public ?array $fcDiagnosisResult = null;    // FC result sebelum verifikasi BC
    public bool $bcVerified = false;            // Flag apakah sudah melalui BC

    // Direct diagnosis config (for exception cases)
    public array $directDiagnosisConfig = [];   // Active direct diagnosis config
    public bool $skipBcVerification = false;    // Skip backward chaining flag

    // Service inquiry (Tanya Dulu)
    public ?string $selectedServiceCategory = null;
    public ?string $selectedServiceKey = null;
    public ?array $selectedServiceData = null;
    public array $selectedServiceItems = [];

    // Booking form
    public array $bookingForm = [
        'name' => '',
        'phone' => '',
        'email' => '',
        'laptop_brand' => '',
        'laptop_type' => '',
        'notes' => '',
    ];
    public string $bookingCode = '';
    public bool $bookingSuccess = false;

    // ===========================
    // CATEGORY DEFINITIONS PER DEVICE TYPE
    // ===========================
    private const DEVICE_TYPES = [
        'laptop' => ['label' => 'Laptop', 'icon' => '💻', 'desc' => 'Laptop, Notebook, Ultrabook'],
        'pc' => ['label' => 'PC Desktop', 'icon' => '🖥️', 'desc' => 'PC Rakitan, Tower, Desktop'],
        'aio' => ['label' => 'All-in-One', 'icon' => '🖥️', 'desc' => 'AIO PC, Layar bawaan terintegrasi'],
        'printer' => ['label' => 'Printer', 'icon' => '🖨️', 'desc' => 'Inkjet, Laser, MFP/Scanner'],
    ];

    // Kategori untuk Laptop (keluhan-based)
    private const LAPTOP_CATEGORIES = [
        'layar' => [
            'label' => 'Layar',
            'icon' => '🖥️',
            'desc' => 'Blank, bergaris, pecah, berkedip',
            'engine_category' => 'Display',
            'problems' => [
                'blank' => ['label' => 'Layar Hitam / Blank', 'desc' => 'Layar gelap total, tidak tampil apa-apa', 'symptoms' => ['G001']],
                'redup' => ['label' => 'Layar Redup / Gelap', 'desc' => 'Menyala tapi sangat redup', 'symptoms' => ['G004']],
                'bergaris' => ['label' => 'Layar Bergaris', 'desc' => 'Ada garis horizontal atau vertikal', 'symptoms' => ['G002']],
                'berkedip' => ['label' => 'Berkedip / Flicker', 'desc' => 'Tampilan kedip-kedip tidak stabil', 'symptoms' => ['G003']],
                'pecah' => ['label' => 'Layar Pecah / Retak', 'desc' => 'Ada kerusakan fisik pada layar', 'symptoms' => ['G005']],
                'bercak' => ['label' => 'Bercak / Titik di Layar', 'desc' => 'Ada bercak putih atau pixel mati', 'symptoms' => ['G109']],
            ],
        ],
        'daya' => [
            'label' => 'Daya & Baterai',
            'icon' => '⚡',
            'desc' => 'Mati, baterai boros/kembung, charger',
            'engine_category' => 'Power',
            'problems' => [
                // Laptop Mati
                'mati_total' => ['label' => 'Mati Total', 'desc' => 'Laptop sama sekali tidak mau nyala', 'symptoms' => ['G156']],
                'nyala_bentar' => ['label' => 'Nyala Sebentar Lalu Mati', 'desc' => 'Menyala beberapa detik lalu mati', 'symptoms' => ['G149']],
                'mati_sendiri' => ['label' => 'Sering Mati Sendiri', 'desc' => 'Tiba-tiba shutdown saat dipakai', 'symptoms' => ['G029']],
                'charger_ga_ngisi' => ['label' => 'Charger Tidak Mengisi', 'desc' => 'Charger dipasang tapi tidak ngecas', 'symptoms' => ['G027']],
                // Baterai
                'boros' => ['label' => 'Baterai Cepat Habis', 'desc' => 'Baterai tidak tahan lama', 'symptoms' => ['G026']],
                'kembung' => ['label' => 'Baterai Kembung', 'desc' => 'Bengkak, casing laptop terangkat', 'symptoms' => ['G081']],
                'drop' => ['label' => 'Baterai Drop / Loncat', 'desc' => 'Persen baterai tidak akurat', 'symptoms' => ['G083']],
                'charger_only' => ['label' => 'Hanya Nyala Pakai Charger', 'desc' => 'Mati kalau charger dicabut', 'symptoms' => ['G024']],
                // Port charger
                'charger_port' => ['label' => 'Port Charger Longgar', 'desc' => 'Harus digoyang supaya bisa ngecas', 'symptoms' => ['G064'], 'engine_category' => 'Peripheral'],
            ],
        ],
        'input' => [
            'label' => 'Keyboard & Touchpad',
            'icon' => '⌨️',
            'desc' => 'Tombol mati, dobel, touchpad error',
            'engine_category' => 'Keyboard',
            'problems' => [
                // Keyboard
                'kb_mati_total' => ['label' => 'Keyboard Mati Total', 'desc' => 'Semua tombol tidak berfungsi', 'symptoms' => ['G009']],
                'kb_sebagian' => ['label' => 'Sebagian Tombol Mati', 'desc' => 'Beberapa tombol tertentu bermasalah', 'symptoms' => ['G010']],
                'kb_dobel' => ['label' => 'Dobel / Ketik Ganda', 'desc' => 'Tekan sekali muncul dua kali', 'symptoms' => ['G059']],
                'kb_lengket' => ['label' => 'Tombol Lengket / Keras', 'desc' => 'Tombol susah ditekan atau nyangkut', 'symptoms' => ['G122']],
                'kb_ketik_sendiri' => ['label' => 'Mengetik Sendiri', 'desc' => 'Keyboard mengetik tanpa ditekan', 'symptoms' => ['G011']],
                // Touchpad
                'tp_mati' => ['label' => 'Touchpad Mati Total', 'desc' => 'Touchpad sama sekali tidak merespon', 'symptoms' => ['G020'], 'engine_category' => 'Peripheral'],
                'tp_loncat' => ['label' => 'Cursor Loncat-loncat', 'desc' => 'Cursor bergerak tidak beraturan', 'symptoms' => ['G021'], 'engine_category' => 'Peripheral'],
                'tp_scroll_mati' => ['label' => 'Scroll Tidak Berfungsi', 'desc' => 'Bisa gerak tapi scroll mati', 'symptoms' => ['G143'], 'engine_category' => 'Peripheral'],
                'tp_gesture' => ['label' => 'Gesture Tidak Jalan', 'desc' => 'Pinch zoom, swipe, dll tidak berfungsi', 'symptoms' => ['G147'], 'engine_category' => 'Peripheral'],
            ],
        ],
        'software' => [
            'label' => 'Lemot & Error',
            'icon' => '🐌',
            'desc' => 'Lambat, hang, blue screen, hardisk',
            'engine_category' => 'Performance',
            'problems' => [
                // Performa
                'lemot' => ['label' => 'Laptop Lemot / Lambat', 'desc' => 'Terasa sangat lambat saat dipakai', 'symptoms' => ['G043']],
                'hang' => ['label' => 'Sering Hang / Freeze', 'desc' => 'Laptop macet tidak merespon', 'symptoms' => ['G041']],
                'game_lag' => ['label' => 'Game / Aplikasi Berat Lag', 'desc' => 'Patah-patah saat main game', 'symptoms' => ['G170']],
                // Software
                'bsod' => ['label' => 'Blue Screen (BSOD)', 'desc' => 'Muncul layar biru lalu restart', 'symptoms' => ['G031'], 'engine_category' => 'Software'],
                'bootloop' => ['label' => 'Restart Terus (Bootloop)', 'desc' => 'Laptop restart ulang terus-menerus', 'symptoms' => ['G160'], 'engine_category' => 'Software'],
                'stuck_boot' => ['label' => 'Tidak Bisa Masuk Windows', 'desc' => 'Stuck di logo, loading terus', 'symptoms' => ['G158'], 'engine_category' => 'Software'],
                'virus' => ['label' => 'Banyak Iklan / Popup', 'desc' => 'Muncul popup mencurigakan terus', 'symptoms' => ['G039'], 'engine_category' => 'Software'],
                // Storage
                'hdd_bunyi' => ['label' => 'HDD Bunyi Klik-klik', 'desc' => 'Terdengar suara berulang dari hardisk', 'symptoms' => ['G061'], 'engine_category' => 'Storage'],
                'hdd_hilang' => ['label' => 'HDD/SSD Tidak Terdeteksi', 'desc' => 'HDD/SSD hilang dari BIOS', 'symptoms' => ['G060'], 'engine_category' => 'Storage'],
                'transfer_lambat' => ['label' => 'Transfer File Lambat', 'desc' => 'Proses copy file sangat lelet', 'symptoms' => ['G199'], 'engine_category' => 'Storage'],
                'boot_lama' => ['label' => 'Booting Sangat Lama', 'desc' => 'Loading startup sangat lambat', 'symptoms' => ['G196'], 'engine_category' => 'Storage'],
            ],
        ],
        'koneksi' => [
            'label' => 'Koneksi & Port',
            'icon' => '📶',
            'desc' => 'WiFi, USB, HDMI, Bluetooth',
            'engine_category' => 'Network',
            'problems' => [
                // WiFi
                'wifi_mati' => ['label' => 'WiFi Tidak Bisa Nyala', 'desc' => 'WiFi mati atau ikon hilang', 'symptoms' => ['G014']],
                'wifi_putus' => ['label' => 'WiFi Sering Putus', 'desc' => 'Koneksi sering disconnect sendiri', 'symptoms' => ['G015']],
                'no_internet' => ['label' => 'Konek Tapi No Internet', 'desc' => 'Connected tapi tidak bisa browsing', 'symptoms' => ['G130']],
                'sinyal_lemah' => ['label' => 'Sinyal Lemah', 'desc' => 'Hanya konek dari jarak dekat router', 'symptoms' => ['G129']],
                'bluetooth' => ['label' => 'Bluetooth Mati', 'desc' => 'Bluetooth tidak bisa diaktifkan', 'symptoms' => ['G017']],
                // Port
                'usb_mati' => ['label' => 'Port USB Mati', 'desc' => 'USB tidak mendeteksi perangkat', 'symptoms' => ['G018'], 'engine_category' => 'Peripheral'],
                'usb_longgar' => ['label' => 'Port USB Longgar', 'desc' => 'USB goyang atau oblak', 'symptoms' => ['G065'], 'engine_category' => 'Peripheral'],
                'hdmi' => ['label' => 'Port HDMI Rusak', 'desc' => 'HDMI tidak menampilkan ke monitor', 'symptoms' => ['G066'], 'engine_category' => 'Peripheral'],
                'webcam' => ['label' => 'Webcam Mati', 'desc' => 'Kamera laptop tidak berfungsi', 'symptoms' => ['G079'], 'engine_category' => 'Peripheral'],
            ],
        ],
        'suara' => [
            'label' => 'Suara / Audio',
            'icon' => '🔊',
            'desc' => 'Tidak ada suara, speaker pecah',
            'engine_category' => 'Audio',
            'problems' => [
                'mati' => ['label' => 'Tidak Ada Suara', 'desc' => 'Speaker laptop mati total', 'symptoms' => ['G050', 'G189']],
                'pecah' => ['label' => 'Speaker Pecah / Kresek', 'desc' => 'Suara pecah saat volume dinaikkan', 'symptoms' => ['G051', 'G197']],
                'sebelah' => ['label' => 'Suara Satu Sisi Saja', 'desc' => 'Hanya keluar dari kiri atau kanan', 'symptoms' => ['G054']],
                'mic' => ['label' => 'Microphone Mati', 'desc' => 'Mic tidak berfungsi saat call', 'symptoms' => ['G053']],
            ],
        ],
        'fisik' => [
            'label' => 'Panas & Fisik',
            'icon' => '🌡️',
            'desc' => 'Overheat, engsel, kena air, body',
            'engine_category' => 'Thermal',
            'problems' => [
                // Panas / Thermal
                'cepat_panas' => ['label' => 'Laptop Cepat Panas', 'desc' => 'Panas meski hanya browsing ringan', 'symptoms' => ['G179']],
                'kipas_berisik' => ['label' => 'Kipas Berisik / Bunyi Kasar', 'desc' => 'Kipas bunyi kencang atau aneh', 'symptoms' => ['G182']],
                'kipas_mati' => ['label' => 'Kipas Tidak Berputar', 'desc' => 'Kipas mati sama sekali', 'symptoms' => ['G047']],
                'mati_panas' => ['label' => 'Mati Karena Kepanasan', 'desc' => 'Shutdown otomatis saat panas', 'symptoms' => ['G049']],
                // Engsel & Body
                'engsel' => ['label' => 'Engsel Rusak / Patah', 'desc' => 'Engsel longgar, patah, atau keras', 'symptoms' => ['G071'], 'engine_category' => 'Physical'],
                'casing' => ['label' => 'Casing Retak / Pecah', 'desc' => 'Body laptop ada retakan', 'symptoms' => ['G070'], 'engine_category' => 'Physical'],
                'goyang' => ['label' => 'Layar Goyang / Oblak', 'desc' => 'Layar tidak stabil saat disentuh', 'symptoms' => ['G072'], 'engine_category' => 'Physical'],
                // Kena Air
                'air_mati' => ['label' => 'Mati Setelah Kena Air', 'desc' => 'Laptop mati total setelah terkena cairan', 'symptoms' => ['G090', 'G092'], 'engine_category' => 'Water Damage'],
                'air_keyboard' => ['label' => 'Keyboard Error Kena Air', 'desc' => 'Tombol error setelah ketumpahan', 'symptoms' => ['G090', 'G091'], 'engine_category' => 'Water Damage'],
                'air_sebagian' => ['label' => 'Sebagian Fungsi Mati', 'desc' => 'Nyala tapi beberapa fitur mati setelah kena air', 'symptoms' => ['G090', 'G097'], 'engine_category' => 'Water Damage'],
                'air_korosi' => ['label' => 'Korosi / Karat', 'desc' => 'Terlihat korosi di komponen', 'symptoms' => ['G094'], 'engine_category' => 'Water Damage'],
            ],
        ],
    ];

    // Kategori untuk PC Desktop
    // Kategori untuk PC Desktop (Custom Build)
    // PC Desktop: tower, komponen ATX, PSU box, TIDAK punya monitor bawaan
    // Kode symptom: PCG, Kode penyakit: PCK, Kode pertanyaan: PCQ
    private const PC_CATEGORIES = [
        'daya' => [
            'label' => 'Mati / Daya',
            'icon' => '🔌',
            'desc' => 'Mati total, restart, bau terbakar, tidak POST',
            'engine_category' => 'PSU',
            'problems' => [
                'mati_total' => ['label' => 'PC Mati Total', 'desc' => 'PC tidak mau menyala sama sekali', 'symptoms' => ['PCG001']],
                'mati_sendiri' => ['label' => 'Mati Tiba-tiba', 'desc' => 'PC mati mendadak saat digunakan', 'symptoms' => ['PCG002']],
                'restart' => ['label' => 'Restart Sendiri', 'desc' => 'PC restart berulang tanpa sebab', 'symptoms' => ['PCG003']],
                'bau_terbakar' => ['label' => 'Bau Terbakar PSU', 'desc' => 'Ada bau hangus dari area PSU', 'symptoms' => ['PCG005']],
                'daya_kurang' => ['label' => 'Daya Kurang', 'desc' => 'Komponen tidak mendapat daya cukup', 'symptoms' => ['PCG015']],
                'no_post' => ['label' => 'Tidak POST / Blank', 'desc' => 'PC nyala tapi layar blank', 'symptoms' => ['PCG021'], 'engine_category' => 'Motherboard'],
                'beep' => ['label' => 'Bunyi Beep / Debug LED', 'desc' => 'Beep code atau LED error menyala', 'symptoms' => ['PCG022'], 'engine_category' => 'Motherboard'],
                'komponen_terbakar' => ['label' => 'Bau Terbakar Komponen', 'desc' => 'Bau hangus dari dalam PC', 'symptoms' => ['PCG028'], 'engine_category' => 'Motherboard'],
                'power_button' => ['label' => 'Tombol Power Mati', 'desc' => 'Tombol power casing tidak merespon', 'symptoms' => ['PCG119'], 'engine_category' => 'Casing'],
            ],
        ],
        'software' => [
            'label' => 'Performa & Software',
            'icon' => '🐌',
            'desc' => 'Lemot, BSOD, virus, boot gagal, crash',
            'engine_category' => 'Software',
            'problems' => [
                'lemot' => ['label' => 'PC Lemot', 'desc' => 'Performa sangat lambat', 'symptoms' => ['PCG194']],
                'bsod' => ['label' => 'Blue Screen (BSOD)', 'desc' => 'Sering muncul layar biru', 'symptoms' => ['PCG193']],
                'virus' => ['label' => 'Virus / Malware', 'desc' => 'Banyak popup atau file hilang', 'symptoms' => ['PCG195']],
                'boot_gagal' => ['label' => 'Windows Gagal Boot', 'desc' => 'Stuck di logo atau loading', 'symptoms' => ['PCG196']],
                'crash' => ['label' => 'Crash / Hang', 'desc' => 'Freeze atau crash saat beban berat', 'symptoms' => ['PCG043'], 'engine_category' => 'CPU'],
                'storage_lambat' => ['label' => 'Storage Lambat', 'desc' => 'Buka file atau transfer data lambat', 'symptoms' => ['PCG104'], 'engine_category' => 'Storage'],
            ],
        ],
        'thermal' => [
            'label' => 'Panas & Kebisingan',
            'icon' => '🌡️',
            'desc' => 'Overheat, kipas mati/berisik, liquid cooler',
            'engine_category' => 'Thermal',
            'problems' => [
                'panas' => ['label' => 'PC Overheat', 'desc' => 'Suhu keseluruhan tinggi', 'symptoms' => ['PCG134']],
                'fan_casing' => ['label' => 'Fan Casing Mati', 'desc' => 'Kipas casing tidak berputar', 'symptoms' => ['PCG135']],
                'thermal_shutdown' => ['label' => 'Mati Karena Panas', 'desc' => 'PC mati otomatis saat overheat', 'symptoms' => ['PCG137']],
                'liquid_cooler' => ['label' => 'Liquid Cooler Error', 'desc' => 'AIO/liquid cooler tidak berfungsi', 'symptoms' => ['PCG140']],
                'bocor' => ['label' => 'Liquid Cooler Bocor', 'desc' => 'Selang AIO/custom loop bocor', 'symptoms' => ['PCG141']],
                'overheat_cpu' => ['label' => 'CPU Overheat >90°C', 'desc' => 'Suhu CPU sangat tinggi', 'symptoms' => ['PCG041'], 'engine_category' => 'CPU'],
                'fan_cpu' => ['label' => 'Kipas CPU Mati', 'desc' => 'Kipas CPU tidak berputar', 'symptoms' => ['PCG050'], 'engine_category' => 'CPU'],
            ],
        ],
        'grafis' => [
            'label' => 'Grafis & Gaming',
            'icon' => '🎮',
            'desc' => 'Artefak, crash gaming, GPU mati',
            'engine_category' => 'GPU Diskrit',
            'problems' => [
                'gpu_hilang' => ['label' => 'GPU Tidak Terdeteksi', 'desc' => 'GPU hilang dari Device Manager', 'symptoms' => ['PCG079']],
                'artefak' => ['label' => 'Artefak Visual', 'desc' => 'Glitch atau kotak warna di layar', 'symptoms' => ['PCG080']],
                'crash_gaming' => ['label' => 'Crash Saat Gaming', 'desc' => 'PC crash saat GPU load tinggi', 'symptoms' => ['PCG081']],
                'overheat_gpu' => ['label' => 'GPU Overheat', 'desc' => 'Suhu GPU >90°C saat gaming', 'symptoms' => ['PCG082']],
                'fan_gpu' => ['label' => 'Fan GPU Mati', 'desc' => 'Semua fan GPU tidak berputar', 'symptoms' => ['PCG083']],
            ],
        ],
        'koneksi' => [
            'label' => 'Koneksi & Port',
            'icon' => '🔗',
            'desc' => 'LAN, WiFi, USB, keyboard, mouse',
            'engine_category' => 'Network',
            'problems' => [
                'lan_mati' => ['label' => 'LAN / Ethernet Mati', 'desc' => 'Port ethernet tidak berfungsi', 'symptoms' => ['PCG164']],
                'wifi' => ['label' => 'WiFi Bermasalah', 'desc' => 'WiFi card PCIe tidak berfungsi', 'symptoms' => ['PCG165']],
                'putus' => ['label' => 'Internet Sering Putus', 'desc' => 'Koneksi tidak stabil', 'symptoms' => ['PCG169']],
                'usb_mati' => ['label' => 'Port USB Mati', 'desc' => 'Port USB tidak berfungsi', 'symptoms' => ['PCG178'], 'engine_category' => 'Peripheral'],
                'semua_usb' => ['label' => 'Semua USB Mati', 'desc' => 'Seluruh port USB tidak jalan', 'symptoms' => ['PCG183'], 'engine_category' => 'Peripheral'],
                'keyboard' => ['label' => 'Keyboard Tidak Terdeteksi', 'desc' => 'Keyboard tidak terbaca', 'symptoms' => ['PCG181'], 'engine_category' => 'Peripheral'],
                'mouse' => ['label' => 'Mouse Tidak Terdeteksi', 'desc' => 'Mouse tidak terbaca', 'symptoms' => ['PCG180'], 'engine_category' => 'Peripheral'],
                'usb_depan' => ['label' => 'USB Front Panel Mati', 'desc' => 'USB panel depan tidak berfungsi', 'symptoms' => ['PCG121'], 'engine_category' => 'Casing'],
            ],
        ],
        'audio' => [
            'label' => 'Audio & Suara',
            'icon' => '🔊',
            'desc' => 'Tidak ada suara, distorsi, mic mati',
            'engine_category' => 'Audio',
            'problems' => [
                'no_sound' => ['label' => 'Tidak Ada Suara', 'desc' => 'Speaker/headphone tidak bunyi', 'symptoms' => ['PCG149']],
                'distorsi' => ['label' => 'Suara Distorsi', 'desc' => 'Suara crackling atau pecah', 'symptoms' => ['PCG150']],
                'mic' => ['label' => 'Mic Tidak Berfungsi', 'desc' => 'Microphone tidak terdeteksi', 'symptoms' => ['PCG154']],
                'audio_depan' => ['label' => 'Audio Jack Depan Mati', 'desc' => 'Jack audio front panel rusak', 'symptoms' => ['PCG122'], 'engine_category' => 'Casing'],
            ],
        ],
    ];

    // Kategori untuk AIO (All-in-One)
    // AIO: monitor & PC jadi satu, punya LCD bawaan, komponen compact (SO-DIMM, 2.5"), pakai ADAPTOR EKSTERNAL
    private const AIO_CATEGORIES = [
        'daya' => [
            'label' => 'Mati / Daya',
            'icon' => '🔌',
            'desc' => 'Mati total, tidak POST, restart, adaptor',
            'engine_category' => 'Adaptor',
            'problems' => [
                'mati_total' => ['label' => 'AIO Mati Total', 'desc' => 'Tidak mau menyala sama sekali', 'symptoms' => ['AIOG001']],
                'adaptor_rusak' => ['label' => 'Adaptor Bermasalah', 'desc' => 'Adaptor tidak berfungsi / mati', 'symptoms' => ['AIOG002']],
                'mati_sendiri' => ['label' => 'Mati Tiba-tiba', 'desc' => 'AIO mati mendadak saat digunakan', 'symptoms' => ['AIOG004']],
                'restart' => ['label' => 'Restart Sendiri', 'desc' => 'AIO restart berulang kali', 'symptoms' => ['AIOG015']],
                'bau_terbakar' => ['label' => 'Bau Terbakar', 'desc' => 'Ada bau hangus dari adaptor/AIO', 'symptoms' => ['AIOG007']],
                'no_post' => ['label' => 'Tidak POST / Blank', 'desc' => 'AIO nyala tapi layar blank', 'symptoms' => ['AIOG043'], 'engine_category' => 'Motherboard'],
                'beep' => ['label' => 'Bunyi Beep', 'desc' => 'AIO beep saat dinyalakan', 'symptoms' => ['AIOG057'], 'engine_category' => 'Motherboard'],
            ],
        ],
        'layar' => [
            'label' => 'Layar & Touchscreen',
            'icon' => '🖥️',
            'desc' => 'Layar mati, bergaris, redup, touchscreen',
            'engine_category' => 'Display',
            'problems' => [
                'blank' => ['label' => 'Layar Blank / Mati', 'desc' => 'Layar tidak menampilkan gambar', 'symptoms' => ['AIOG016']],
                'bergaris' => ['label' => 'Layar Bergaris', 'desc' => 'Ada garis vertikal/horizontal', 'symptoms' => ['AIOG017']],
                'redup' => ['label' => 'Layar Redup', 'desc' => 'Backlight sangat lemah', 'symptoms' => ['AIOG018']],
                'artefak' => ['label' => 'Artefak Visual', 'desc' => 'Glitch atau kotak warna di layar', 'symptoms' => ['AIOG027']],
                'pecah' => ['label' => 'Layar Pecah', 'desc' => 'Layar retak atau pecah fisik', 'symptoms' => ['AIOG020']],
                'ts_mati' => ['label' => 'Touchscreen Tidak Respon', 'desc' => 'Sentuhan tidak merespon', 'symptoms' => ['AIOG031'], 'engine_category' => 'Touchscreen'],
                'ghost_touch' => ['label' => 'Ghost Touch', 'desc' => 'Layar sentuh klik sendiri', 'symptoms' => ['AIOG032'], 'engine_category' => 'Touchscreen'],
                'ts_sebagian' => ['label' => 'Touchscreen Sebagian Mati', 'desc' => 'Hanya area tertentu responsif', 'symptoms' => ['AIOG033'], 'engine_category' => 'Touchscreen'],
            ],
        ],
        'software' => [
            'label' => 'Performa & Software',
            'icon' => '🐌',
            'desc' => 'Lemot, BSOD, virus, boot gagal, crash',
            'engine_category' => 'Software',
            'problems' => [
                'lemot' => ['label' => 'AIO Lemot', 'desc' => 'Performa sangat lambat', 'symptoms' => ['AIOG151']],
                'bsod' => ['label' => 'Blue Screen (BSOD)', 'desc' => 'Sering muncul layar biru', 'symptoms' => ['AIOG150']],
                'virus' => ['label' => 'Virus / Malware', 'desc' => 'Banyak popup atau file hilang', 'symptoms' => ['AIOG152']],
                'boot_gagal' => ['label' => 'Windows Gagal Boot', 'desc' => 'Stuck di logo atau loading', 'symptoms' => ['AIOG153']],
                'crash' => ['label' => 'Crash / Hang', 'desc' => 'Freeze atau crash saat beban berat', 'symptoms' => ['AIOG060'], 'engine_category' => 'CPU'],
                'storage_lambat' => ['label' => 'Storage Lambat', 'desc' => 'Buka file atau transfer data lambat', 'symptoms' => ['AIOG086'], 'engine_category' => 'Storage'],
            ],
        ],
        'thermal' => [
            'label' => 'Panas & Kebisingan',
            'icon' => '🌡️',
            'desc' => 'Overheat, kipas mati/berisik, debu',
            'engine_category' => 'Thermal',
            'problems' => [
                'panas' => ['label' => 'Body AIO Panas', 'desc' => 'Belakang AIO sangat panas', 'symptoms' => ['AIOG093']],
                'kipas_mati' => ['label' => 'Kipas Tidak Berputar', 'desc' => 'Kipas internal tidak berfungsi', 'symptoms' => ['AIOG095']],
                'thermal_shutdown' => ['label' => 'Mati Karena Panas', 'desc' => 'AIO mati otomatis saat overheat', 'symptoms' => ['AIOG096']],
                'debu' => ['label' => 'Ventilasi Tersumbat', 'desc' => 'Ventilasi tersumbat debu', 'symptoms' => ['AIOG099']],
                'overheat_cpu' => ['label' => 'CPU Overheat >90°C', 'desc' => 'Suhu CPU sangat tinggi', 'symptoms' => ['AIOG058'], 'engine_category' => 'CPU'],
            ],
        ],
        'multimedia' => [
            'label' => 'Audio & Kamera',
            'icon' => '🔊',
            'desc' => 'Speaker mati, mic, webcam bermasalah',
            'engine_category' => 'Audio',
            'problems' => [
                'no_sound' => ['label' => 'Tidak Ada Suara', 'desc' => 'Speaker built-in mati total', 'symptoms' => ['AIOG106']],
                'distorsi' => ['label' => 'Suara Distorsi', 'desc' => 'Suara pecah atau crackling', 'symptoms' => ['AIOG107']],
                'mic' => ['label' => 'Mic Tidak Berfungsi', 'desc' => 'Microphone internal mati', 'symptoms' => ['AIOG110']],
                'webcam_mati' => ['label' => 'Webcam Mati', 'desc' => 'Kamera built-in tidak berfungsi', 'symptoms' => ['AIOG129'], 'engine_category' => 'Webcam'],
                'webcam_buram' => ['label' => 'Webcam Buram', 'desc' => 'Kamera buram atau tidak fokus', 'symptoms' => ['AIOG131'], 'engine_category' => 'Webcam'],
                'webcam_hitam' => ['label' => 'Webcam Layar Hitam', 'desc' => 'Kamera menampilkan layar hitam', 'symptoms' => ['AIOG132'], 'engine_category' => 'Webcam'],
            ],
        ],
        'koneksi' => [
            'label' => 'Koneksi & Port',
            'icon' => '🔗',
            'desc' => 'WiFi, LAN, Bluetooth, USB, keyboard',
            'engine_category' => 'Konektivitas',
            'problems' => [
                'wifi' => ['label' => 'WiFi Tidak Terdeteksi', 'desc' => 'WiFi hilang atau mati', 'symptoms' => ['AIOG117']],
                'wifi_putus' => ['label' => 'WiFi Sering Putus', 'desc' => 'Koneksi WiFi tidak stabil', 'symptoms' => ['AIOG118']],
                'lan_mati' => ['label' => 'LAN Mati', 'desc' => 'Port ethernet tidak berfungsi', 'symptoms' => ['AIOG119']],
                'bluetooth' => ['label' => 'Bluetooth Mati', 'desc' => 'Bluetooth tidak berfungsi', 'symptoms' => ['AIOG120']],
                'usb_mati' => ['label' => 'Port USB Mati', 'desc' => 'Port USB tidak berfungsi', 'symptoms' => ['AIOG139'], 'engine_category' => 'Peripheral'],
                'semua_usb' => ['label' => 'Semua USB Mati', 'desc' => 'Seluruh port USB AIO mati', 'symptoms' => ['AIOG146'], 'engine_category' => 'Peripheral'],
                'keyboard' => ['label' => 'Keyboard Tidak Berfungsi', 'desc' => 'Keyboard bawaan tidak respon', 'symptoms' => ['AIOG143'], 'engine_category' => 'Peripheral'],
                'mouse' => ['label' => 'Mouse Tidak Berfungsi', 'desc' => 'Mouse bawaan tidak respon', 'symptoms' => ['AIOG144'], 'engine_category' => 'Peripheral'],
            ],
        ],
    ];

    // Kategori untuk Printer
    private const PRINTER_CATEGORIES = [
        'kualitas' => [
            'label' => 'Kualitas Cetak',
            'icon' => '📄',
            'desc' => 'Bergaris, pudar, kotor',
            'engine_category' => 'Kualitas Cetak',
            'problems' => [
                'bergaris' => ['label' => 'Cetakan Bergaris', 'desc' => 'Ada garis horizontal pada cetakan', 'symptoms' => ['PRG001']],
                'pudar' => ['label' => 'Cetakan Pudar', 'desc' => 'Hasil cetak terlalu pudar/memudar', 'symptoms' => ['PRG003']],
                'warna_hilang' => ['label' => 'Warna Hilang', 'desc' => 'Satu atau lebih warna tidak keluar', 'symptoms' => ['PRG015']],
                'kotor' => ['label' => 'Cetakan Kotor/Noda', 'desc' => 'Ada noda atau bercak di cetakan', 'symptoms' => ['PRG005']],
                'tidak_rata' => ['label' => 'Teks Tidak Rata', 'desc' => 'Teks geser atau ada gap', 'symptoms' => ['PRG013']],
            ],
        ],
        'tinta' => [
            'label' => 'Tinta / Toner',
            'icon' => '🫗',
            'desc' => 'Habis, bocor, error cartridge',
            'engine_category' => 'Tinta',
            'problems' => [
                'habis' => ['label' => 'Tinta/Toner Habis', 'desc' => 'Indikator tinta rendah menyala', 'symptoms' => ['PRG016']],
                'tidak_deteksi' => ['label' => 'Cartridge Error', 'desc' => 'Cartridge tidak terdeteksi', 'symptoms' => ['PRG017']],
                'bocor' => ['label' => 'Tinta Bocor', 'desc' => 'Tinta menetes dari cartridge', 'symptoms' => ['PRG018']],
                'waste_full' => ['label' => 'Waste Ink Penuh', 'desc' => 'Error waste ink absorber penuh', 'symptoms' => ['PRG026']],
                'infus' => ['label' => 'Infus Bermasalah', 'desc' => 'Selang infus tersumbat/bocor', 'symptoms' => ['PRG027']],
            ],
        ],
        'kertas' => [
            'label' => 'Kertas / Paper Feed',
            'icon' => '📋',
            'desc' => 'Macet, tidak tertarik, miring',
            'engine_category' => 'Kertas',
            'problems' => [
                'macet' => ['label' => 'Kertas Macet (Jam)', 'desc' => 'Kertas nyangkut di dalam printer', 'symptoms' => ['PRG031']],
                'tidak_tarik' => ['label' => 'Tidak Menarik Kertas', 'desc' => 'Printer tidak mengambil kertas', 'symptoms' => ['PRG032']],
                'miring' => ['label' => 'Kertas Miring', 'desc' => 'Kertas masuk miring ke printer', 'symptoms' => ['PRG034']],
                'adf' => ['label' => 'ADF Bermasalah', 'desc' => 'Auto document feeder error', 'symptoms' => ['PRG042']],
            ],
        ],
        'koneksi' => [
            'label' => 'Koneksi Printer',
            'icon' => '🔌',
            'desc' => 'USB, WiFi, offline',
            'engine_category' => 'Konektivitas',
            'problems' => [
                'usb' => ['label' => 'USB Tidak Terdeteksi', 'desc' => 'Printer tidak muncul via USB', 'symptoms' => ['PRG046']],
                'wifi' => ['label' => 'WiFi Printer Error', 'desc' => 'Tidak bisa konek ke WiFi', 'symptoms' => ['PRG047']],
                'offline' => ['label' => 'Printer Offline', 'desc' => 'Status offline padahal nyala', 'symptoms' => ['PRG048']],
                'sharing' => ['label' => 'Sharing Error', 'desc' => 'Tidak bisa print dari PC lain', 'symptoms' => ['PRG054']],
            ],
        ],
        'hardware_printer' => [
            'label' => 'Hardware Printer',
            'icon' => '🔧',
            'desc' => 'Mati, error, LCD rusak',
            'engine_category' => 'Hardware',
            'problems' => [
                'mati' => ['label' => 'Printer Mati Total', 'desc' => 'Tidak mau menyala', 'symptoms' => ['PRG061']],
                'tidak_respon' => ['label' => 'Tidak Merespon', 'desc' => 'Nyala tapi tidak merespon', 'symptoms' => ['PRG062']],
                'panas' => ['label' => 'Printer Overheat', 'desc' => 'Printer sangat panas', 'symptoms' => ['PRG071']],
                'error_lcd' => ['label' => 'LCD Panel Rusak', 'desc' => 'Layar panel printer bermasalah', 'symptoms' => ['PRG063']],
            ],
        ],
        'driver' => [
            'label' => 'Software & Driver',
            'icon' => '💿',
            'desc' => 'Driver error, queue stuck',
            'engine_category' => 'Software',
            'problems' => [
                'driver' => ['label' => 'Driver Error', 'desc' => 'Driver unavailable atau corrupt', 'symptoms' => ['PRG076']],
                'queue' => ['label' => 'Antrian Cetak Macet', 'desc' => 'Print queue stuck', 'symptoms' => ['PRG081']],
                'spooler' => ['label' => 'Spooler Error', 'desc' => 'Print spooler crash', 'symptoms' => ['PRG058']],
            ],
        ],
        'mekanik' => [
            'label' => 'Mekanik Printer',
            'icon' => '⚙️',
            'desc' => 'Bunyi kasar, macet, belt',
            'engine_category' => 'Mekanik',
            'problems' => [
                'bunyi' => ['label' => 'Bunyi Abnormal', 'desc' => 'Printer berbunyi kasar/grinding', 'symptoms' => ['PRG096']],
                'head_macet' => ['label' => 'Head/Carriage Macet', 'desc' => 'Head printer tidak bergerak', 'symptoms' => ['PRG097']],
                'gear' => ['label' => 'Gear Rusak', 'desc' => 'Bunyi klik dari gear', 'symptoms' => ['PRG093']],
            ],
        ],
        'scanner' => [
            'label' => 'Scanner / Copy',
            'icon' => '📷',
            'desc' => 'Scan gagal, bergaris, ADF',
            'engine_category' => 'Scanner',
            'problems' => [
                'tidak_scan' => ['label' => 'Scanner Tidak Berfungsi', 'desc' => 'Scanner tidak merespon', 'symptoms' => ['PRG136']],
                'bergaris' => ['label' => 'Hasil Scan Bergaris', 'desc' => 'Garis pada hasil scan', 'symptoms' => ['PRG137']],
                'copy_buruk' => ['label' => 'Kualitas Copy Buruk', 'desc' => 'Hasil fotocopy jelek', 'symptoms' => ['PRG144']],
            ],
        ],
    ];

    /**
     * Konfigurasi diagnosis langsung / pengecualian pertanyaan
     *
     * Beberapa gejala sudah cukup jelas sehingga tidak perlu pertanyaan lanjutan
     * atau hanya perlu pertanyaan terbatas yang logis sesuai kategori kerusakan.
     *
     * Types:
     * - 'direct': Langsung ke diagnosis tanpa pertanyaan (gejala sudah pasti)
     * - 'limited': Hanya tanya pertanyaan tertentu yang relevan
     * - 'verify_only': Hanya verifikasi singkat lalu diagnosa
     */
    private const DIRECT_DIAGNOSIS_CONFIG = [
        // ========== LAYAR ==========
        // Layar pecah/retak → pasti kerusakan fisik LCD, langsung ganti
        'layar.pecah' => [
            'type' => 'direct',
            'override_symptoms' => ['G005'],
            'skip_bc' => true,
            'direct_note' => 'Layar pecah/retak sudah pasti kerusakan fisik pada panel LCD dan harus diganti baru.',
        ],
        // Bercak putih/hitam → indikasi white spot atau dead pixel
        'layar.bercak' => [
            'type' => 'direct',
            'override_symptoms' => ['G109', 'G110'],
            'skip_bc' => true,
            'direct_note' => 'Bercak putih atau titik hitam di layar sudah mengindikasikan white spot atau dead pixel pada panel LCD.',
        ],

        // ========== KEYBOARD ==========
        // Keyboard mengetik sendiri → short circuit pada keyboard fisik
        'input.kb_ketik_sendiri' => [
            'type' => 'verify_only',
            'override_symptoms' => ['G011'],
            'skip_bc' => true,
            'max_questions' => 1,
            'direct_note' => 'Keyboard mengetik sendiri sudah dipastikan terjadi short circuit pada jalur keyboard fisik.',
        ],
        // Tombol mati sebagian → jalur putus pada PCB keyboard
        'input.kb_sebagian' => [
            'type' => 'verify_only',
            'override_symptoms' => ['G010'],
            'skip_bc' => true,
            'max_questions' => 1,
            'direct_note' => 'Beberapa tombol tidak berfungsi mengindikasikan ada jalur yang putus pada PCB keyboard.',
        ],

        // ========== LAPTOP MATI ==========
        // Mati total → tanya 3 pertanyaan kunci: tombol power, indikator charger, bau terbakar
        // Kemungkinan kerusakan: keyboard, mainboard, RAM, SSD/HDD, display
        'daya.mati_total' => [
            'type' => 'limited',
            'override_symptoms' => ['G023'],
            'skip_bc' => false,
            'max_questions' => 3,
            'direct_note' => 'Laptop mati total bisa disebabkan oleh beberapa komponen: keyboard, mainboard, RAM, SSD/HDD, atau display.',
        ],

        // ========== BATERAI ==========
        // Baterai kembung → pasti rusak, harus segera diganti
        'daya.kembung' => [
            'type' => 'direct',
            'override_symptoms' => ['G081'],
            'skip_bc' => true,
            'direct_note' => 'Baterai kembung sudah PASTI RUSAK dan HARUS SEGERA DIGANTI. Penggunaan baterai kembung sangat berbahaya karena risiko kebakaran.',
        ],
        // Baterai cepat habis → kesehatan menurun, tanya pertanyaan logis
        'daya.boros' => [
            'type' => 'limited',
            'override_symptoms' => ['G026'],
            'skip_bc' => false,
            'max_questions' => 2,
            'direct_note' => 'Baterai cepat habis biasanya karena kesehatan baterai sudah menurun secara signifikan.',
        ],
        // Baterai drop/loncat → kesehatan menurun
        'daya.drop' => [
            'type' => 'limited',
            'override_symptoms' => ['G083', 'G026'],
            'skip_bc' => false,
            'max_questions' => 2,
            'direct_note' => 'Persentase baterai tidak akurat dan cepat habis menunjukkan kesehatan baterai sudah menurun.',
        ],
        // Hanya nyala pakai charger → pasti baterai rusak
        'daya.charger_only' => [
            'type' => 'direct',
            'override_symptoms' => ['G024', 'G152'],
            'skip_bc' => true,
            'direct_note' => 'Laptop hanya bisa nyala menggunakan charger, sudah dipastikan baterai rusak dan perlu diganti.',
        ],

        // ========== PERFORMA / LEMOT ==========
        // Lemot → biasanya HDD, kalau SSD cek prosesor & RAM, pertimbangkan downgrade Windows
        'software.lemot' => [
            'type' => 'limited',
            'override_symptoms' => ['G040'],
            'skip_bc' => false,
            'max_questions' => 3,
            'direct_note' => 'Laptop lemot biasanya disebabkan oleh penggunaan HDD (belum SSD), RAM kurang, atau prosesor entry-level (Celeron/Pentium) dengan Windows 11 yang terlalu berat. Jika memungkinkan, pertimbangkan upgrade ke SSD dan/atau downgrade Windows untuk spek rendah.',
        ],
    ];

    // ===========================
    // SERVICE MENU (Tanya Dulu)
    // ===========================
    private const SERVICE_MENU = [
        'hardware' => [
            'label' => 'Paket Hardware',
            'icon' => '🔧',
            'desc' => 'Perbaikan, cleaning, ganti pasta, dll',
            'services' => [
                'perbaikan_mainboard' => [
                    'label' => 'Perbaikan Mainboard',
                    'desc' => 'Perbaikan komponen mainboard laptop/PC/AIO',
                    'price' => 'Rp 900.000',
                    'note' => 'Harga tergantung tingkat kerusakan. Diagnosis awal gratis.',
                ],
                'cleaning_pasta' => [
                    'label' => 'Cleaning & Ganti Pasta',
                    'desc' => 'Bersihkan kipas, heatsink, dan ganti thermal paste',
                    'price' => 'Rp 255.000',
                    'note' => 'Termasuk pembersihan debu internal dan penggantian thermal paste baru.',
                ],
                'cleaning_all' => [
                    'label' => 'Cleaning All',
                    'desc' => 'Pembersihan menyeluruh luar dan dalam',
                    'price' => 'Rp 155.000',
                    'note' => 'Bersihkan debu, keyboard, body, dan ventilasi udara.',
                ],
                'tambah_pasta' => [
                    'label' => 'Tambah Thermal Paste',
                    'desc' => 'Penambahan thermal paste tanpa cleaning',
                    'price' => 'Rp 155.000',
                    'note' => 'Ganti pasta termal untuk mengatasi laptop/PC panas.',
                ],
                'fleksibel_lcd' => [
                    'label' => 'Rekoreksi Fleksibel LCD',
                    'desc' => 'Perbaikan kabel fleksibel layar laptop',
                    'price' => 'Rp 100.000',
                    'note' => 'Untuk masalah layar blank/bergaris akibat kabel fleksibel.',
                ],
                'fleksibel_touchpad' => [
                    'label' => 'Rekoreksi Fleksibel Touchpad',
                    'desc' => 'Perbaikan kabel fleksibel touchpad laptop',
                    'price' => 'Rp 100.000',
                    'note' => 'Untuk masalah touchpad tidak berfungsi akibat kabel fleksibel.',
                ],
                'fleksibel_keyboard' => [
                    'label' => 'Rekoreksi Fleksibel Keyboard',
                    'desc' => 'Perbaikan kabel fleksibel keyboard laptop',
                    'price' => 'Rp 155.000',
                    'note' => 'Untuk masalah keyboard mati/sebagian akibat kabel fleksibel.',
                ],
                'reset_battery' => [
                    'label' => 'Reset Battery',
                    'desc' => 'Reset dan kalibrasi baterai laptop',
                    'price' => 'Rp 100.000',
                    'note' => 'Kalibrasi ulang indikator baterai yang tidak akurat.',
                ],
            ],
        ],
        'software' => [
            'label' => 'Paket Software',
            'icon' => '💿',
            'desc' => 'Install ulang, install aplikasi, dll',
            'services' => [
                'instal_ulang' => [
                    'label' => 'Instal Ulang OS',
                    'desc' => 'Install ulang Windows beserta driver',
                    'price' => 'Rp 100.000',
                    'note' => 'Termasuk install driver dan aktivasi Windows.',
                ],
                'instal_office' => [
                    'label' => 'Instal Aplikasi Office',
                    'desc' => 'Install Microsoft Office (Word, Excel, PPT)',
                    'price' => 'Rp 50.000',
                    'note' => 'Microsoft Office lengkap (Word, Excel, PowerPoint, dll).',
                ],
                'instal_standar' => [
                    'label' => 'Instal Aplikasi Standar',
                    'desc' => 'Paket aplikasi standar (browser, WinRAR, dll)',
                    'price' => 'Rp 100.000',
                    'note' => 'Termasuk browser, antivirus, media player, dan utilitas dasar.',
                ],
                'instal_archgis' => [
                    'label' => 'Instal Apps ArcGIS',
                    'desc' => 'Install aplikasi ArcGIS untuk pemetaan',
                    'price' => 'Rp 250.000',
                    'note' => 'Aplikasi GIS profesional untuk analisis pemetaan.',
                ],
                'instal_spss' => [
                    'label' => 'Instal Apps SPSS',
                    'desc' => 'Install aplikasi SPSS untuk statistik',
                    'price' => 'Rp 50.000',
                    'note' => 'Aplikasi statistik untuk penelitian dan analisis data.',
                ],
                'instal_sketchup' => [
                    'label' => 'Instal Apps SketchUp',
                    'desc' => 'Install SketchUp untuk desain 3D',
                    'price' => 'Rp 50.000',
                    'note' => 'Aplikasi desain 3D dan arsitektur.',
                ],
                'instal_sap2000' => [
                    'label' => 'Instal Apps SAP2000',
                    'desc' => 'Install SAP2000 untuk analisis struktur',
                    'price' => 'Rp 150.000',
                    'note' => 'Aplikasi analisis dan desain struktur teknik sipil.',
                ],
                'isi_lagu' => [
                    'label' => 'Isi Lagu ke Flashdisk',
                    'desc' => 'Isi koleksi lagu ke flashdisk',
                    'price' => 'Rp 50.000',
                    'note' => 'Transfer koleksi lagu pilihan ke flashdisk pelanggan.',
                ],
            ],
        ],
        'upgrade' => [
            'label' => 'Upgrade Part',
            'icon' => '⬆️',
            'desc' => 'Upgrade RAM, SSD/HDD, dsb',
            'services' => [
                'upgrade_ram' => [
                    'label' => 'Upgrade RAM',
                    'desc' => 'Tambah atau ganti RAM laptop/PC/AIO',
                    'price' => 'Tergantung spek',
                    'note' => 'Harga tergantung jenis dan kapasitas RAM. Konsultasi gratis untuk cek kompatibilitas.',
                ],
                'upgrade_ssd' => [
                    'label' => 'Upgrade SSD / HDD',
                    'desc' => 'Ganti HDD ke SSD atau upgrade kapasitas',
                    'price' => 'Tergantung spek',
                    'note' => 'Include cloning data dari drive lama. Harga tergantung kapasitas SSD.',
                ],
            ],
        ],
        'printer' => [
            'label' => 'Paket Printer',
            'icon' => '🖨️',
            'desc' => 'Maintenance head, isi tinta, dll',
            'services' => [
                'maintenance_head' => [
                    'label' => 'Maintenance Print Head',
                    'desc' => 'Pembersihan dan perawatan print head',
                    'price' => 'Rp 150.000',
                    'note' => 'Deep cleaning print head untuk mengatasi hasil cetak bergaris/pudar.',
                ],
                'maintenance_catridge' => [
                    'label' => 'Maintenance Catridge',
                    'desc' => 'Pembersihan dan perawatan catridge',
                    'price' => 'Rp 55.000',
                    'note' => 'Bersihkan catridge dari tinta kering dan sumbatan.',
                ],
                'cleaning_printer' => [
                    'label' => 'Cleaning System Print',
                    'desc' => 'Cleaning system printer for PC',
                    'price' => 'Rp 155.000',
                    'note' => 'Pembersihan menyeluruh sistem print dan roller.',
                ],
                'sedot_tinta' => [
                    'label' => 'Sedot Tinta / Ink Suction',
                    'desc' => 'Penyedotan tinta yang tersumbat',
                    'price' => 'Rp 70.000',
                    'note' => 'Menyedot tinta buntu dari head printer inkjet.',
                ],
                'kertas_macet' => [
                    'label' => 'Kertas Nyangkut / Paper Stuck',
                    'desc' => 'Perbaikan masalah kertas macet/nyangkut',
                    'price' => 'Rp 155.000',
                    'note' => 'Termasuk pengecekan roller dan jalur kertas.',
                ],
                'isi_tinta' => [
                    'label' => 'Isi Ulang Tinta',
                    'desc' => 'Refill tinta printer inkjet',
                    'price' => 'Rp 50.000 - 100.000',
                    'note' => 'Harga tergantung jenis tinta (hitam/warna) dan merek printer.',
                ],
            ],
        ],
        'lainnya' => [
            'label' => 'Biaya Lainnya',
            'icon' => '💰',
            'desc' => 'Biaya pasang, pengecekan, dll',
            'services' => [
                'pasang_laptop' => [
                    'label' => 'Biaya Pasang (Laptop)',
                    'desc' => 'Biaya jasa pemasangan part laptop',
                    'price' => 'Rp 200.000',
                    'note' => 'Biaya jasa pemasangan komponen di laptop.',
                ],
                'pasang_pc_aio' => [
                    'label' => 'Biaya Pasang (AIO/PC)',
                    'desc' => 'Biaya jasa pemasangan part AIO/PC Desktop',
                    'price' => 'Rp 300.000',
                    'note' => 'Biaya jasa pemasangan komponen di PC Desktop atau AIO.',
                ],
                'pengecekan' => [
                    'label' => 'Biaya Pengecekan',
                    'desc' => 'Diagnosis dan pengecekan kerusakan',
                    'price' => 'Rp 100.000',
                    'note' => 'Biaya pengecekan menyeluruh oleh teknisi. Hangus jika tidak jadi servis.',
                ],
            ],
        ],
    ];

    /**
     * Map UI device type → database device_type
     * Setiap device type punya data terpisah di database
     */
    private function getEngineDeviceType(): string
    {
        return $this->selectedDeviceType ?? 'laptop';
    }

    /**
     * Load question filter untuk sub-keluhan tertentu
     *
     * @param string $configKey Format: "category_key.problem_key"
     * @param string $deviceType Device type (laptop, pc, aio, printer)
     * @return array|null Array of allowed question order numbers, or null if no filter
     */
    private function loadQuestionFilter(string $configKey, string $deviceType): ?array
    {
        static $filters = null;

        if ($filters === null) {
            $filtersPath = database_path('seeders/data/question_filters.php');
            $filters = file_exists($filtersPath) ? require $filtersPath : [];
        }

        return $filters[$deviceType][$configKey] ?? null;
    }

    /**
     * Get categories for the selected device type
     */
    private function getCategories(): array
    {
        if (!$this->selectedDeviceType) {
            return [];
        }

        $deviceType = \App\Models\DeviceType::where('slug', $this->selectedDeviceType)->first();

        if (!$deviceType) {
            return match ($this->selectedDeviceType) {
                'pc' => self::PC_CATEGORIES,
                'aio' => self::AIO_CATEGORIES,
                'printer' => self::PRINTER_CATEGORIES,
                default => self::LAPTOP_CATEGORIES,
            };
        }

        $dbCategories = \App\Models\DeviceComponent::where('device_type_id', $deviceType->id)
            ->where('is_active', true)
            ->orderBy('order_column')
            ->get();

        if ($dbCategories->isEmpty()) {
            return match ($this->selectedDeviceType) {
                'pc' => self::PC_CATEGORIES,
                'aio' => self::AIO_CATEGORIES,
                'printer' => self::PRINTER_CATEGORIES,
                default => self::LAPTOP_CATEGORIES,
            };
        }

        $categoriesArray = [];
        foreach ($dbCategories as $cat) {
            // Remove the device type slug prefix (e.g., 'laptop_' or 'laptop-') from the category slug
            $cleanKey = str_replace([$this->selectedDeviceType . '_', $this->selectedDeviceType . '-'], '', $cat->slug);

            $categoriesArray[$cleanKey] = [
                'label' => $cat->name,
                'icon' => $cat->icon,
                'desc' => $cat->description,
                'engine_category' => $cat->engine_category,
                'problems' => is_string($cat->problems_data) ? json_decode($cat->problems_data, true) : (is_array($cat->problems_data) ? $cat->problems_data : [])
            ];
        }

        return $categoriesArray;
    }

    // ===========================
    // LIFECYCLE
    // ===========================

    public function mount()
    {
        // Wizard starts with device type selection
    }

    // ===========================
    // NAVIGATION ACTIONS
    // ===========================

    /**
     * Select a device type
     */
        public function selectDevice($type): void
    {
        $device = \App\Models\DeviceType::where('slug', $type)->first();
        if (!$device) {
            $device = \App\Models\DeviceType::where('id', is_numeric($type) ? $type : 0)->first();
        }
        if (!$device) return;

        $this->selectedDeviceType = $device->slug;
        $this->state = 'select_category';
    }

    // ===========================
    // SERVICE INQUIRY (Tanya Dulu)
    // ===========================

    /**
     * Enter service inquiry mode
     */
    public function selectServiceInquiry(): void
    {
        $this->state = 'service_inquiry';
    }

    /**
     * Select a service category (hardware/software/upgrade/printer/lainnya)
     */
        public function selectServiceCategory($id): void
    {
        $category = \App\Models\ServiceCategory::where('slug', $id)->first();
        if (!$category) {
            $category = \App\Models\ServiceCategory::where('id', is_numeric($id) ? $id : 0)->first();
        }
        if (!$category) return;

        $this->selectedServiceCategory = $category->slug;
        $this->selectedServiceData = [
            'label' => $category->name,
            'desc'  => $category->description,
            'price' => $category->estimated_cost_range,
        ];
        $this->state = 'service_booking';
    }

    public function selectService($key): void
    {
        // Deprecated, flat list is used natively via selectServiceCategory
    }

    public function saveServiceBooking(): void
    {
        $this->validate([
            'bookingForm.name' => 'required|string|max:100',
            'bookingForm.phone' => 'required|string|max:20',
            'bookingForm.notes' => 'nullable|string|max:500',
        ]);

        $serviceLabel = $this->selectedServiceData['label'] ?? '';
        $servicePrice = $this->selectedServiceData['price'] ?? '';

                $complaint = "[Tanya Dulu] {$serviceLabel}";
        
        if (!empty($this->selectedServiceItems)) {
            $complaint .= "\nLayanan Dipilih:\n- " . implode("\n- ", $this->selectedServiceItems);
        } else {
            $complaint .= " ({$servicePrice})";
        }
        
        if (!empty($this->bookingForm['notes'])) {
            $complaint .= "\n\nKeluhan/Layanan Tambahan: " . $this->bookingForm['notes'];
        }

        $booking = Booking::create([
            'booking_code' => Booking::generateBookingCode(),
            'name' => $this->bookingForm['name'],
            'phone' => $this->bookingForm['phone'],
            'address' => '',
            'device_brand' => $this->bookingForm['laptop_brand'] ?? '',
            'device_name' => $this->bookingForm['laptop_type'] ?? '',
            'serial_number' => '',
            'complaint' => $complaint,
            'symptoms' => [],
            'diagnosis_result' => [
                'type' => 'service_inquiry',
                'category' => $this->selectedServiceCategory,
                'service' => $this->selectedServiceKey,
                'service_items' => $this->selectedServiceItems,
                'service_label' => $serviceLabel,
                'price' => $servicePrice,
            ],
            'ai_recommendation' => "Layanan: {$serviceLabel} - {$servicePrice}",
            'status' => 'pending',
        ]);

        $this->bookingCode = $booking->booking_code;
        $this->bookingSuccess = true;
        $this->state = 'completed';
    }

    /**
     * Select a category
     */
    public function selectCategory($key): void
    {
        $componentSlug = $this->selectedDeviceType . '_' . $key;
        $component = \App\Models\DeviceComponent::where('slug', $componentSlug)->first();

        if (!$component) {
            $componentSlug = $this->selectedDeviceType . '-' . $key;
            $component = \App\Models\DeviceComponent::where('slug', $componentSlug)->first();
        }

        if (!$component) {
            $component = \App\Models\DeviceComponent::where('slug', $key)->first();
        }

        if (!$component) {
            // Backup for legacy fallback if reading from config arrays
            $component = ['slug' => $key];
            $this->selectedCategoryKey = $key;
            $this->state = 'select_problem';
            return;
        }

        $this->selectedCategoryKey = str_replace([$this->selectedDeviceType . '_', $this->selectedDeviceType . '-'], '', $component->slug);
        $this->state = 'select_problem';
    }

    /**
     * Select a specific problem within category
     */
    public function selectProblem(string $key): void
    {
        $categories = $this->getCategories();
        $category = $categories[$this->selectedCategoryKey] ?? null;
        if (!$category || !isset($category['problems'][$key])) return;

        $this->selectedProblemKey = $key;
        $problem = $category['problems'][$key];

        // Cek apakah ada konfigurasi diagnosis langsung untuk problem ini
        $configKey = "{$this->selectedCategoryKey}.{$key}";
        $directConfig = self::DIRECT_DIAGNOSIS_CONFIG[$configKey] ?? null;

        if ($directConfig) {
            $this->handleDirectDiagnosis($problem, $category, $directConfig);
            return;
        }

        // === Normal flow (tanpa pengecualian) ===

        // Determine engine category (problem-level override or category default)
        $engineCategory = $problem['engine_category'] ?? $category['engine_category'];

        // Load symptoms from database by code, filtered by device type
        $deviceType = $this->getEngineDeviceType();
        $symptoms = Symptom::where('device_type', $deviceType)
            ->whereIn('code', $problem['symptoms'])->get();

        $facts = $symptoms->map(fn($s) => [
            'id' => $s->id,
            'code' => $s->code,
            'name' => $s->name,
            'category' => $s->category,
            'weight' => $s->weight,
        ])->toArray();

        $this->collectedSymptoms = $symptoms->pluck('name')->toArray();

        // Load question filter untuk sub-keluhan ini
        $questionFilter = $this->loadQuestionFilter($configKey, $deviceType);

        // Initialize engine with device type, category and initial symptoms
        $engine = new ForwardChainingEngine($deviceType);
        $engine->loadState([
            'facts' => $facts,
            'asked_questions' => [],
            'current_category' => $engineCategory,
            'negative_evidence' => [],
            'device_type' => $deviceType,
            'question_filter' => $questionFilter,
        ]);

        // Get first follow-up question
        $question = $engine->getNextQuestion();

        if ($question) {
            $this->currentQuestion = $question;
            $this->state = 'asking';
        } else {
            // No follow-up questions, go straight to diagnosis
            $this->runDiagnosis($engine);
        }

        // Save engine state
        $this->engineState = $engine->exportState();
    }

    /**
     * Handle diagnosis langsung / pertanyaan terbatas
     *
     * Untuk kasus-kasus yang sudah jelas diagnosisnya:
     * - 'direct': Langsung ke diagnosis tanpa pertanyaan
     * - 'limited': Hanya tanya beberapa pertanyaan relevan
     * - 'verify_only': Verifikasi singkat lalu diagnosa
     */
    protected function handleDirectDiagnosis(array $problem, array $category, array $config): void
    {
        $deviceType = $this->getEngineDeviceType();
        $engineCategory = $problem['engine_category'] ?? $category['engine_category'];

        // Gunakan override_symptoms jika ada, kalau tidak pakai symptoms dari problem
        $symptomCodes = $config['override_symptoms'] ?? $problem['symptoms'];

        // Load symptoms dari database
        $symptoms = Symptom::where('device_type', $deviceType)
            ->whereIn('code', $symptomCodes)->get();

        $facts = $symptoms->map(fn($s) => [
            'id' => $s->id,
            'code' => $s->code,
            'name' => $s->name,
            'category' => $s->category,
            'weight' => $s->weight,
        ])->toArray();

        $this->collectedSymptoms = $symptoms->pluck('name')->toArray();

        // Simpan config dan set skip BC flag
        $this->directDiagnosisConfig = $config;
        $this->skipBcVerification = $config['skip_bc'] ?? false;

        if ($config['type'] === 'direct') {
            // ===== DIRECT: Skip semua pertanyaan, langsung diagnosa =====
            $engine = new ForwardChainingEngine($deviceType);
            $engine->loadState([
                'facts' => $facts,
                'asked_questions' => [],
                'current_category' => $engineCategory,
                'negative_evidence' => [],
                'device_type' => $deviceType,
            ]);

            $result = $engine->runInference();
            $this->engineState = $engine->exportState();

            // Tambahkan catatan diagnosis langsung
            $result['direct_diagnosis_note'] = $config['direct_note'] ?? null;
            $result['is_direct_diagnosis'] = true;
            $result['method'] = 'direct_diagnosis';
            $result['verification'] = null;

            // Tandai semua diagnosis sebagai confirmed langsung
            if (isset($result['diagnoses'])) {
                foreach ($result['diagnoses'] as &$diag) {
                    $diag['bc_verified'] = false;
                    $diag['verification_status'] = 'direct_confirmed';
                }
                unset($diag);
            }

            $this->diagnosisResult = $result;
            $this->bcVerified = false;
            $this->state = 'diagnosed';
            return;
        }

        // ===== LIMITED / VERIFY_ONLY: Pertanyaan terbatas =====
        $this->maxQuestions = $config['max_questions'] ?? 3;

        // Load question filter untuk sub-keluhan ini
        $configKey = "{$this->selectedCategoryKey}.{$this->selectedProblemKey}";
        $questionFilter = $this->loadQuestionFilter($configKey, $deviceType);

        $engine = new ForwardChainingEngine($deviceType);
        $engine->loadState([
            'facts' => $facts,
            'asked_questions' => [],
            'current_category' => $engineCategory,
            'negative_evidence' => [],
            'device_type' => $deviceType,
            'question_filter' => $questionFilter,
        ]);

        // Get first follow-up question
        $question = $engine->getNextQuestion();

        if ($question) {
            $this->currentQuestion = $question;
            $this->state = 'asking';
        } else {
            // Tidak ada pertanyaan lagi, langsung diagnosa
            $this->runDiagnosis($engine);
        }

        // Save engine state
        $this->engineState = $engine->exportState();
    }

    /**
     * Go back one step
     */
    public function goBack(): void
    {
        switch ($this->state) {
            case 'select_category':
                $this->selectedDeviceType = null;
                $this->state = 'select_device';
                break;

            case 'select_problem':
                $this->selectedCategoryKey = null;
                $this->state = 'select_category';
                break;

            case 'asking':
                // Reset diagnosis progress
                $this->selectedProblemKey = null;
                $this->currentQuestion = null;
                $this->questionCount = 0;
                $this->maxQuestions = 3;
                $this->answeredQuestions = [];
                $this->engineState = [];
                $this->collectedSymptoms = [];
                $this->bcEngineState = [];
                $this->bcQuestions = [];
                $this->bcChecklist = [];
                $this->bcAnsweredQuestions = [];
                $this->fcDiagnosisResult = null;
                $this->bcVerified = false;
                $this->directDiagnosisConfig = [];
                $this->skipBcVerification = false;
                $this->state = 'select_problem';
                break;

            case 'verifying':
                // Go back from BC verification to re-do problem selection
                $this->bcEngineState = [];
                $this->bcQuestions = [];
                $this->bcChecklist = [];
                $this->bcAnsweredQuestions = [];
                $this->fcDiagnosisResult = null;
                $this->bcVerified = false;
                $this->selectedProblemKey = null;
                $this->currentQuestion = null;
                $this->questionCount = 0;
                $this->maxQuestions = 3;
                $this->answeredQuestions = [];
                $this->engineState = [];
                $this->collectedSymptoms = [];
                $this->directDiagnosisConfig = [];
                $this->skipBcVerification = false;
                $this->state = 'select_problem';
                break;

            // Service inquiry states
            case 'service_inquiry':
                $this->state = 'select_device';
                break;

            case 'service_detail':
                $this->selectedServiceCategory = null;
                $this->state = 'service_inquiry';
                break;

            case 'service_booking':
                $this->selectedServiceKey = null;
                $this->selectedServiceData = null;
                $this->state = 'service_detail';
                break;
        }
    }

    // ===========================
    // QUESTION HANDLING (Ya/Tidak buttons)
    // ===========================

    /**
     * Answer "Ya" to current question
     */
    public function answerYes(): void
    {
        $this->processQuestionAnswer('ya');
    }

    /**
     * Answer "Tidak" to current question
     */
    public function answerNo(): void
    {
        $this->processQuestionAnswer('tidak');
    }

    /**
     * Answer "Tidak Tahu" - treated same as Tidak
     */
    public function answerSkip(): void
    {
        $this->processQuestionAnswer('tidak tahu', 'Tidak Tahu');
    }

    /**
     * Answer a choice question by value (e.g. 'hdd hard disk', 'sudah ssd')
     * $label is the human-readable label to show in the answered-questions summary
     */
    public function answerChoice(string $value, string $label): void
    {
        $this->processQuestionAnswer($value, $label);
    }

    /**
     * Process answer (ya/tidak/choice) through the engine
     */
    protected function processQuestionAnswer(string $answer, ?string $displayLabel = null): void
    {
        if (!$this->currentQuestion) return;

        $deviceType = $this->getEngineDeviceType();
        $engine = new ForwardChainingEngine($deviceType);
        $engine->loadState($this->engineState);

        // Determine display label
        if ($displayLabel === null) {
            $displayLabel = match($answer) {
                'ya' => 'Ya',
                'tidak' => 'Tidak',
                default => 'Tidak Tahu',
            };
        }
        $this->answeredQuestions[] = [
            'question' => $this->currentQuestion['question'],
            'answer' => $displayLabel,
        ];

        // Process answer through engine
        $engine->processAnswer($this->currentQuestion['id'], $answer);
        $this->questionCount++;

        // Update collected symptoms
        $this->collectedSymptoms = $engine->getSymptomNames();

        // Decide: ask more or diagnose
        if ($engine->isReadyForDiagnosis() || $this->questionCount >= $this->maxQuestions) {
            $this->runDiagnosis($engine);
        } else {
            $question = $engine->getNextQuestion();
            if ($question) {
                $this->currentQuestion = $question;
                $this->state = 'asking';
            } else {
                $this->runDiagnosis($engine);
            }
        }

        // Save engine state
        $this->engineState = $engine->exportState();
    }

    // ===========================
    // DIAGNOSIS
    // ===========================

    /**
     * Run Forward Chaining inference, then start Backward Chaining verification
     */
    protected function runDiagnosis(ForwardChainingEngine $engine): void
    {
        $result = $engine->runInference();
        $this->engineState = $engine->exportState();
        $this->collectedSymptoms = $result['detected_symptoms'] ?? $this->collectedSymptoms;

        // Tambahkan catatan direct diagnosis jika ada
        if (!empty($this->directDiagnosisConfig['direct_note'])) {
            $result['direct_diagnosis_note'] = $this->directDiagnosisConfig['direct_note'];
        }

        // Simpan hasil FC
        $this->fcDiagnosisResult = $result;

        // Cek apakah FC menghasilkan diagnosis
        $diagnoses = $result['diagnoses'] ?? [];

        if (!empty($diagnoses)) {
            // Cek apakah BC harus di-skip (kasus diagnosis langsung)
            if ($this->skipBcVerification) {
                $this->finalizeDiagnosisWithoutBC($result);
            } else {
                // Mulai Backward Chaining untuk verifikasi
                $this->startBackwardChaining($result, $engine);
            }
        } else {
            // Tidak ada diagnosis → langsung ke hasil
            $this->diagnosisResult = $result;
            $this->state = 'diagnosed';
        }
    }

    /**
     * Mulai proses Backward Chaining
     * Mengambil hipotesis dari FC dan menyiapkan pertanyaan verifikasi
     */
    protected function startBackwardChaining(array $fcResult, ForwardChainingEngine $fcEngine): void
    {
        $deviceType = $this->getEngineDeviceType();
        $bcEngine = new BackwardChainingEngine($deviceType);

        // Ambil symptom IDs yang sudah dikonfirmasi di FC
        $confirmedSymptomIds = $fcEngine->getFacts()->pluck('id')->toArray();

        // Inisialisasi BC dari hasil FC
        $bcEngine->initFromForwardChaining($fcResult, $confirmedSymptomIds);

        // Smart skip: jika FC sudah cukup yakin, skip BC
        if ($bcEngine->shouldSkipVerification()) {
            $this->finalizeDiagnosisWithoutBC($fcResult);
            return;
        }

        // Get ALL verification questions at once (checklist mode)
        $questions = $bcEngine->getAllVerificationQuestions();

        if (!empty($questions)) {
            $this->bcQuestions = $questions;
            // Pre-initialize checklist: semua unchecked
            $this->bcChecklist = [];
            foreach ($questions as $q) {
                $this->bcChecklist[$q['symptom_id']] = false;
            }
            $this->bcEngineState = $bcEngine->exportState();
            $this->state = 'verifying';
        } else {
            $this->finalizeDiagnosisWithoutBC($fcResult);
        }
    }

    // ===========================
    // BACKWARD CHAINING VERIFICATION (One-shot Checklist)
    // ===========================

    /**
     * Toggle checklist item (called from blade checkbox)
     */
    public function toggleBcCheck(int $symptomId): void
    {
        if (isset($this->bcChecklist[$symptomId])) {
            $this->bcChecklist[$symptomId] = !$this->bcChecklist[$symptomId];
        }
    }

    /**
     * Submit semua jawaban checklist BC sekaligus
     * Checked = Ya (gejala ada), Unchecked = Tidak (gejala tidak ada)
     */
    public function submitBcChecklist(): void
    {
        $deviceType = $this->getEngineDeviceType();
        $bcEngine = new BackwardChainingEngine($deviceType);
        $bcEngine->loadState($this->bcEngineState);

        // Build answers from checklist
        $answers = [];
        foreach ($this->bcQuestions as $q) {
            $symptomId = $q['symptom_id'];
            $isChecked = $this->bcChecklist[$symptomId] ?? false;
            $answer = $isChecked ? 'ya' : 'tidak';

            $answers[] = [
                'symptom_id' => $symptomId,
                'answer' => $answer,
            ];

            // Log for display
            $this->bcAnsweredQuestions[] = [
                'question' => $q['question'],
                'symptom' => $q['symptom_name'],
                'answer' => $isChecked ? 'Ya' : 'Tidak',
                'related_hypotheses' => $q['related_hypotheses'] ?? [],
            ];
        }

        // Process all answers at once
        $bcEngine->processAllVerificationAnswers($answers);

        // Finalize with BC
        $this->finalizeDiagnosisWithBC($bcEngine);
        $this->bcEngineState = $bcEngine->exportState();
    }

    /**
     * Submit checklist BC menggunakan daftar symptom_id tercentang dari client.
     * Mengurangi request berulang saat user menekan checkbox satu per satu.
     */
    public function submitBcChecklistWithIds(array $checkedSymptomIds): void
    {
        $checkedSet = array_fill_keys(array_map('intval', $checkedSymptomIds), true);

        foreach ($this->bcQuestions as $q) {
            $symptomId = (int) ($q['symptom_id'] ?? 0);
            if ($symptomId > 0) {
                $this->bcChecklist[$symptomId] = isset($checkedSet[$symptomId]);
            }
        }

        $this->submitBcChecklist();
    }

    /**
     * Skip semua verifikasi BC dan langsung ke hasil
     */
    public function bcSkipAll(): void
    {
        $this->finalizeDiagnosisWithoutBC($this->fcDiagnosisResult);
    }
    /**
     * Finalize diagnosis DENGAN Backward Chaining verification
     */
    protected function finalizeDiagnosisWithBC(BackwardChainingEngine $bcEngine): void
    {
        $bcResult = $bcEngine->calculateFinalDiagnosis();

        // Gabungkan info dari FC dan BC
        $this->diagnosisResult = [
            'status' => $bcResult['status'],
            'method' => 'hybrid_fc_bc',
            'detected_symptoms' => $this->fcDiagnosisResult['detected_symptoms'] ?? $this->collectedSymptoms,
            'symptom_codes' => $this->fcDiagnosisResult['symptom_codes'] ?? [],
            'category' => $this->fcDiagnosisResult['category'] ?? null,
            'diagnoses' => $bcResult['diagnoses'],
            'total_rules_matched' => $this->fcDiagnosisResult['total_rules_matched'] ?? 0,
            'verification' => [
                'total_verifications' => $bcResult['total_verifications'],
                'total_confirmed' => $bcResult['total_confirmed'],
                'total_denied' => $bcResult['total_denied'],
                'log' => $bcResult['verification_log'],
            ],
            'fc_original' => $this->fcDiagnosisResult,
        ];

        $this->bcVerified = true;
        $this->state = 'diagnosed';
    }

    /**
     * Finalize diagnosis TANPA Backward Chaining (fallback)
     */
    protected function finalizeDiagnosisWithoutBC(array $fcResult): void
    {
        // Tambahkan marker bahwa ini hanya FC
        $fcResult['method'] = 'forward_chaining_only';
        $fcResult['verification'] = null;

        // Mark diagnoses as not BC verified
        if (isset($fcResult['diagnoses'])) {
            foreach ($fcResult['diagnoses'] as &$diag) {
                $diag['bc_verified'] = false;
                $diag['verification_status'] = 'unverified';
            }
            unset($diag);
        }

        $this->diagnosisResult = $fcResult;
        $this->bcVerified = false;
        $this->state = 'diagnosed';
    }

    // ===========================
    // BOOKING
    // ===========================

    /**
     * Show booking form
     */
    public function showBookingForm(): void
    {
        $this->state = 'booking';
    }

    /**
     * Cancel booking
     */
    public function cancelBooking(): void
    {
        $this->state = 'diagnosed';
    }

    /**
     * Save booking to database
     */
    public function saveBooking(): void
    {
        $device = \App\Models\DeviceType::where('slug', $this->selectedDeviceType)->first();
        $deviceLabel = $device ? $device->name : (self::DEVICE_TYPES[$this->selectedDeviceType]['label'] ?? 'Perangkat');

        $this->validate([
            'bookingForm.name' => 'required|min:3',
            'bookingForm.phone' => 'required|min:10',
            'bookingForm.laptop_brand' => 'required',
            'bookingForm.laptop_type' => 'required',
        ], [
            'bookingForm.name.required' => 'Nama lengkap wajib diisi',
            'bookingForm.name.min' => 'Nama minimal 3 karakter',
            'bookingForm.phone.required' => 'Nomor WhatsApp wajib diisi',
            'bookingForm.phone.min' => 'Nomor WhatsApp minimal 10 digit',
            'bookingForm.laptop_brand.required' => "Merek {$deviceLabel} wajib dipilih",
            'bookingForm.laptop_type.required' => "Tipe {$deviceLabel} wajib diisi",
        ]);

        $diagnosisSummary = '';
        if ($this->diagnosisResult && !empty($this->diagnosisResult['diagnoses'])) {
            $diagnosisSummary = collect($this->diagnosisResult['diagnoses'])
                ->map(fn($d) => "{$d['name']} ({$d['confidence']}%)")
                ->implode(', ');
        }

        $categories = $this->getCategories();
        $categoryLabel = $categories[$this->selectedCategoryKey]['label'] ?? '';
        $problemLabel = '';
        if ($this->selectedCategoryKey && $this->selectedProblemKey) {
            $problemLabel = $categories[$this->selectedCategoryKey]['problems'][$this->selectedProblemKey]['label'] ?? '';
        }

        $device = \App\Models\DeviceType::where('slug', $this->selectedDeviceType)->first();
        $deviceLabel = $device ? $device->name : (self::DEVICE_TYPES[$this->selectedDeviceType]['label'] ?? 'Perangkat');

        $booking = Booking::create([
            'booking_code' => Booking::generateBookingCode(),
            'name' => $this->bookingForm['name'],
            'phone' => $this->bookingForm['phone'],
            'address' => '',
            'device_brand' => $this->bookingForm['laptop_brand'],
            'device_name' => $this->bookingForm['laptop_type'],
            'serial_number' => '',
            'complaint' => "Perangkat: {$deviceLabel}\nKategori: {$categoryLabel}\nMasalah: {$problemLabel}\n" .
                          "Gejala: " . implode(', ', $this->collectedSymptoms) .
                          "\n\nDiagnosis Sistem: " . $diagnosisSummary .
                          ($this->bookingForm['notes'] ? "\n\nCatatan: " . $this->bookingForm['notes'] : ''),
            'symptoms' => $this->collectedSymptoms,
            'diagnosis_result' => $this->diagnosisResult,
            'ai_recommendation' => $diagnosisSummary,
            'status' => 'pending',
        ]);

        $this->bookingCode = $booking->booking_code;
        $this->bookingSuccess = true;
        $this->state = 'completed';
    }

    // ===========================
    // RESET
    // ===========================

    /**
     * Reset everything and start over
     */
    public function resetAll(): void
    {
        $this->state = 'select_device';
        $this->selectedDeviceType = null;
        $this->selectedCategoryKey = null;
        $this->selectedProblemKey = null;
        $this->collectedSymptoms = [];
        $this->diagnosisResult = null;
        $this->currentQuestion = null;
        $this->questionCount = 0;
        $this->answeredQuestions = [];
        $this->engineState = [];
        $this->bookingForm = [
            'name' => '',
            'phone' => '',
            'email' => '',
            'laptop_brand' => '',
            'laptop_type' => '',
            'notes' => '',
        ];
        $this->bookingCode = '';
        $this->bookingSuccess = false;
        $this->bcEngineState = [];
        $this->bcQuestions = [];
        $this->bcChecklist = [];
        $this->bcAnsweredQuestions = [];
        $this->fcDiagnosisResult = null;
        $this->bcVerified = false;
        $this->directDiagnosisConfig = [];
        $this->skipBcVerification = false;
        $this->maxQuestions = 3;
        $this->selectedServiceCategory = null;
        $this->selectedServiceKey = null;
        $this->selectedServiceData = null;
    }

    // ===========================
    // RENDER
    // ===========================

    public function render()
    {
        $dbDeviceTypes = \App\Models\DeviceType::where('is_active', true)->orderBy('order_column')->get()->keyBy('slug')->map(function ($device) {
            return [
                'label' => $device->name,
                'icon' => $device->icon,
                'desc' => $device->description
            ];
        })->toArray();

        $categories = $this->getCategories();

        $dbServiceMenu = \App\Models\ServiceCategory::where('is_active', true)->orderBy('order_column')->get()->keyBy('slug')->map(function ($cat) {
            return [
                'label' => $cat->name,
                'icon' => $cat->icon,
                'desc' => $cat->description,
                'services' => is_string($cat->services_data) ? json_decode($cat->services_data, true) : (is_array($cat->services_data) ? $cat->services_data : [])
            ];
        })->toArray();

        return view('livewire.diagnosis-chat', [
            'deviceTypes' => !empty($dbDeviceTypes) ? $dbDeviceTypes : self::DEVICE_TYPES,
            'selectedDeviceType' => $this->selectedDeviceType,
            'categories' => $categories,
            'selectedCategoryData' => $this->selectedCategoryKey
                ? ($categories[$this->selectedCategoryKey] ?? null)
                : null,
            'serviceMenu' => !empty($dbServiceMenu) ? $dbServiceMenu : self::SERVICE_MENU,
        ])->layout('layouts.diagnosis', ['title' => 'Sistem Pakar Diagnosis - Cellcom']);
    }
}

