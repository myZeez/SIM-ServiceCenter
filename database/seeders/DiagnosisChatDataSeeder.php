<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DeviceType;
use App\Models\DeviceComponent;
use App\Models\ServiceCategory;
use Illuminate\Support\Str;

class DiagnosisChatDataSeeder extends Seeder
{
    private const DEVICE_TYPES = [
        'laptop' => ['label' => 'Laptop', 'icon' => '💻', 'desc' => 'Laptop, Notebook, Ultrabook'],
        'pc' => ['label' => 'PC Desktop', 'icon' => '🖥️', 'desc' => 'PC Rakitan, Tower, Desktop'],
        'aio' => ['label' => 'All-in-One', 'icon' => '🖥️', 'desc' => 'AIO PC, Layar bawaan terintegrasi'],
        'printer' => ['label' => 'Printer', 'icon' => '🖨️', 'desc' => 'Inkjet, Laser, MFP/Scanner'],
    ];

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
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Device Types
        $order = 1;
        foreach (self::DEVICE_TYPES as $key => $data) {
            $deviceType = DeviceType::updateOrCreate(
                ['slug' => $key],
                [
                    'name' => $data['label'],
                    'icon' => $data['icon'],
                    'description' => $data['desc'],
                    'is_active' => true,
                    'order_column' => $order++
                ]
            );

            // 2. Seed Device Components based on device type
            $categories = [];
            switch ($key) {
                case 'laptop': $categories = self::LAPTOP_CATEGORIES; break;
                case 'pc': $categories = self::PC_CATEGORIES; break;
                case 'aio': $categories = self::AIO_CATEGORIES; break;
                case 'printer': $categories = self::PRINTER_CATEGORIES; break;
            }

            $catOrder = 1;
            foreach ($categories as $catKey => $catData) {
                DeviceComponent::updateOrCreate(
                    [
                        'device_type_id' => $deviceType->id,
                        'slug' => $key . '-' . $catKey
                    ],
                    [
                        'name' => $catData['label'],
                        'icon' => $catData['icon'],
                        'description' => $catData['desc'],
                        'engine_category' => $catData['engine_category'] ?? null,
                        'problems_data' => isset($catData['problems']) ? json_encode($catData['problems']) : null,
                        'is_active' => true,
                        'order_column' => $catOrder++
                    ]
                );
            }
        }

        // 3. Seed Service Categories
        $smOrder = 1;
        foreach (self::SERVICE_MENU as $key => $data) {
            ServiceCategory::updateOrCreate(
                ['slug' => $key],
                [
                    'name' => $data['label'],
                    'icon' => $data['icon'],
                    'description' => $data['desc'],
                    'services_data' => isset($data['services']) ? json_encode($data['services']) : null,
                    'is_active' => true,
                    'order_column' => $smOrder++
                ]
            );
        }
    }
}

