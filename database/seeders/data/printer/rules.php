<?php

// Printer - Rules mapping diseases to symptoms with CF values
// CORRECTED: All symptom codes properly matched to actual symptoms in database
//
// Symptom category ranges:
//   Kualitas Cetak: PRG001-PRG015
//   Tinta:          PRG016-PRG030
//   Kertas:         PRG031-PRG045
//   Konektivitas:   PRG046-PRG060
//   Hardware:       PRG061-PRG075
//   Software:       PRG076-PRG090
//   Mekanik:        PRG091-PRG105
//   Inkjet:         PRG106-PRG120
//   Laser:          PRG121-PRG135
//   Scanner:        PRG136-PRG145
//   Differential:   PRG146-PRG155

return [
    // ============================================================
    // === KUALITAS CETAK (PRK001-PRK007, PRK065-PRK066) =========
    // ============================================================

    // PRK001 - Print Head Tersumbat
    'PRK001' => [
        ['code' => 'PRG001', 'cf' => 0.9],  // Hasil cetak bergaris horizontal
        ['code' => 'PRG002', 'cf' => 0.8],  // Hasil cetak bergaris vertikal
        ['code' => 'PRG007', 'cf' => 0.7],  // Hasil cetak ada area kosong/blank
        ['code' => 'PRG015', 'cf' => 0.6],  // Hanya satu warna yang tidak keluar
        ['code' => 'PRG019', 'cf' => 0.5],  // Head printer tersumbat
    ],
    // PRK002 - Tinta/Toner Habis atau Rendah
    'PRK002' => [
        ['code' => 'PRG016', 'cf' => 0.9],  // Tinta habis / level tinta rendah
        ['code' => 'PRG003', 'cf' => 0.8],  // Warna cetak pudar/tidak pekat
        ['code' => 'PRG007', 'cf' => 0.7],  // Hasil cetak ada area kosong/blank
        ['code' => 'PRG021', 'cf' => 0.9],  // Toner habis / level toner rendah
    ],
    // PRK003 - Tinta/Toner Tidak Kompatibel
    'PRK003' => [
        ['code' => 'PRG025', 'cf' => 0.9],  // Menggunakan tinta/toner non-original
        ['code' => 'PRG004', 'cf' => 0.7],  // Warna cetak tidak sesuai/salah warna
        ['code' => 'PRG010', 'cf' => 0.6],  // Tinta/toner mudah luntur saat disentuh
        ['code' => 'PRG003', 'cf' => 0.5],  // Warna cetak pudar/tidak pekat
    ],
    // PRK004 - Print Head Misalignment
    'PRK004' => [
        ['code' => 'PRG013', 'cf' => 0.9],  // Cetakan miring/tidak rata
        ['code' => 'PRG106', 'cf' => 0.8],  // Print head perlu alignment
        ['code' => 'PRG014', 'cf' => 0.6],  // Resolusi cetak rendah/tidak detail
        ['code' => 'PRG001', 'cf' => 0.5],  // Hasil cetak bergaris horizontal
    ],
    // PRK005 - Drum Unit Aus (Laser)
    'PRK005' => [
        ['code' => 'PRG122', 'cf' => 0.9],  // Drum unit aus/perlu ganti
        ['code' => 'PRG134', 'cf' => 0.8],  // Cetakan muncul titik-titik berulang (drum defect)
        ['code' => 'PRG011', 'cf' => 0.7],  // Ghost image / bayangan cetakan berulang
        ['code' => 'PRG012', 'cf' => 0.6],  // Background cetak kotor/abu-abu
    ],
    // PRK006 - Fuser Unit Rusak (Laser)
    'PRK006' => [
        ['code' => 'PRG121', 'cf' => 0.9],  // Fuser unit rusak/panas berlebih
        ['code' => 'PRG010', 'cf' => 0.8],  // Tinta/toner mudah luntur saat disentuh
        ['code' => 'PRG125', 'cf' => 0.7],  // Fuser film/sleeve rusak
        ['code' => 'PRG135', 'cf' => 0.6],  // Kertas keriting/melengkung setelah cetak
    ],
    // PRK007 - Setting Cetak Salah
    'PRK007' => [
        ['code' => 'PRG084', 'cf' => 0.9],  // Setting cetak salah (ukuran/orientasi)
        ['code' => 'PRG087', 'cf' => 0.8],  // Hasil cetak tidak sesuai preview
        ['code' => 'PRG014', 'cf' => 0.7],  // Resolusi cetak rendah/tidak detail
        ['code' => 'PRG003', 'cf' => 0.5],  // Warna cetak pudar/tidak pekat
    ],

    // ============================================================
    // === TINTA / TONER (PRK008-PRK014) =========================
    // ============================================================

    // PRK008 - Cartridge Tinta Tidak Terdeteksi
    'PRK008' => [
        ['code' => 'PRG017', 'cf' => 0.9],  // Cartridge tinta tidak terdeteksi
        ['code' => 'PRG112', 'cf' => 0.8],  // Cartridge tidak pas/longgar di slot
        ['code' => 'PRG024', 'cf' => 0.6],  // Chip cartridge error/perlu reset
        ['code' => 'PRG072', 'cf' => 0.5],  // LED indikator berkedip error
    ],
    // PRK009 - Tinta Bocor dari Cartridge/Tank
    'PRK009' => [
        ['code' => 'PRG018', 'cf' => 0.9],  // Tinta bocor dari cartridge
        ['code' => 'PRG005', 'cf' => 0.8],  // Ada bercak/noda tinta pada hasil cetak
        ['code' => 'PRG111', 'cf' => 0.7],  // Tinta menetes saat idle
        ['code' => 'PRG029', 'cf' => 0.5],  // Warna tinta tercampur
    ],
    // PRK010 - Waste Ink Pad Penuh
    'PRK010' => [
        ['code' => 'PRG026', 'cf' => 0.9],  // Waste ink tank/pad penuh
        ['code' => 'PRG072', 'cf' => 0.7],  // LED indikator berkedip error
        ['code' => 'PRG065', 'cf' => 0.6],  // Printer error code muncul di display
        ['code' => 'PRG062', 'cf' => 0.5],  // Printer menyala tapi tidak merespon
    ],
    // PRK011 - Chip Cartridge Perlu Reset
    'PRK011' => [
        ['code' => 'PRG024', 'cf' => 0.9],  // Chip cartridge error/perlu reset
        ['code' => 'PRG016', 'cf' => 0.7],  // Tinta habis (meski tinta masih ada)
        ['code' => 'PRG017', 'cf' => 0.6],  // Cartridge tinta tidak terdeteksi
        ['code' => 'PRG065', 'cf' => 0.5],  // Printer error code muncul di display
    ],
    // PRK012 - Selang Infus Tinta Bermasalah
    'PRK012' => [
        ['code' => 'PRG027', 'cf' => 0.9],  // Selang tinta infus tersumbat/bocor
        ['code' => 'PRG109', 'cf' => 0.8],  // Infus tank tinta bermasalah
        ['code' => 'PRG028', 'cf' => 0.7],  // Tinta di tank infus habis
        ['code' => 'PRG015', 'cf' => 0.5],  // Hanya satu warna yang tidak keluar
    ],
    // PRK013 - Cartridge Toner Rusak/Defektif
    'PRK013' => [
        ['code' => 'PRG023', 'cf' => 0.9],  // Toner bocor/tumpah di dalam printer
        ['code' => 'PRG022', 'cf' => 0.8],  // Cartridge toner tidak dikenali
        ['code' => 'PRG012', 'cf' => 0.6],  // Background cetak kotor/abu-abu
        ['code' => 'PRG005', 'cf' => 0.5],  // Ada bercak/noda tinta pada hasil cetak
    ],
    // PRK014 - Head Printer Rusak Permanen
    'PRK014' => [
        ['code' => 'PRG107', 'cf' => 0.9],  // Print head tersumbat permanen
        ['code' => 'PRG110', 'cf' => 0.8],  // Head cleaning berulang tidak berhasil
        ['code' => 'PRG108', 'cf' => 0.7],  // Nozzle check pattern masih bergaris
        ['code' => 'PRG001', 'cf' => 0.6],  // Hasil cetak bergaris horizontal
        ['code' => 'PRG019', 'cf' => 0.5],  // Head printer tersumbat
    ],

    // ============================================================
    // === KERTAS / PAPER FEED (PRK015-PRK020) ===================
    // ============================================================

    // PRK015 - Paper Jam (Kertas Macet)
    'PRK015' => [
        ['code' => 'PRG031', 'cf' => 0.9],  // Kertas macet (paper jam)
        ['code' => 'PRG040', 'cf' => 0.7],  // Kertas macet di area fuser (laser)
        ['code' => 'PRG041', 'cf' => 0.7],  // Kertas macet di area output/keluaran
        ['code' => 'PRG038', 'cf' => 0.5],  // Kertas mengerut/kusut setelah cetak
    ],
    // PRK016 - Pickup Roller Aus
    'PRK016' => [
        ['code' => 'PRG032', 'cf' => 0.9],  // Printer tidak mengambil kertas
        ['code' => 'PRG035', 'cf' => 0.9],  // Roller pengambil kertas aus/licin
        ['code' => 'PRG033', 'cf' => 0.7],  // Kertas tertarik lebih dari satu lembar
        ['code' => 'PRG031', 'cf' => 0.5],  // Kertas macet (paper jam)
    ],
    // PRK017 - Sensor Kertas Rusak
    'PRK017' => [
        ['code' => 'PRG039', 'cf' => 0.9],  // Sensor kertas error/mati
        ['code' => 'PRG031', 'cf' => 0.7],  // Kertas macet (false paper jam)
        ['code' => 'PRG044', 'cf' => 0.7],  // Pesan "Paper Size Mismatch"
        ['code' => 'PRG032', 'cf' => 0.6],  // Printer tidak mengambil kertas
    ],
    // PRK018 - Tray Kertas Rusak/Tidak Pas
    'PRK018' => [
        ['code' => 'PRG036', 'cf' => 0.9],  // Tray kertas rusak/patah
        ['code' => 'PRG034', 'cf' => 0.8],  // Kertas miring saat masuk ke printer
        ['code' => 'PRG033', 'cf' => 0.6],  // Kertas tertarik lebih dari satu lembar
        ['code' => 'PRG031', 'cf' => 0.5],  // Kertas macet (paper jam)
    ],
    // PRK019 - ADF (Auto Document Feeder) Error
    'PRK019' => [
        ['code' => 'PRG042', 'cf' => 0.9],  // ADF (Auto Document Feeder) macet
        ['code' => 'PRG142', 'cf' => 0.8],  // ADF scanner macet/error
        ['code' => 'PRG033', 'cf' => 0.7],  // Kertas tertarik lebih dari satu lembar
        ['code' => 'PRG031', 'cf' => 0.5],  // Kertas macet (paper jam)
    ],
    // PRK020 - Duplex Unit Error
    'PRK020' => [
        ['code' => 'PRG043', 'cf' => 0.9],  // Duplex (cetak bolak-balik) error
        ['code' => 'PRG034', 'cf' => 0.7],  // Kertas miring saat masuk ke printer
        ['code' => 'PRG031', 'cf' => 0.6],  // Kertas macet (paper jam)
        ['code' => 'PRG038', 'cf' => 0.5],  // Kertas mengerut/kusut setelah cetak
    ],

    // ============================================================
    // === KONEKTIVITAS (PRK021-PRK026) ==========================
    // ============================================================

    // PRK021 - Koneksi USB Printer Bermasalah
    'PRK021' => [
        ['code' => 'PRG046', 'cf' => 0.9],  // Printer tidak terdeteksi via USB
        ['code' => 'PRG049', 'cf' => 0.8],  // Kabel USB printer rusak/longgar
        ['code' => 'PRG060', 'cf' => 0.7],  // Port printer di komputer mengalami error
        ['code' => 'PRG048', 'cf' => 0.5],  // Printer offline/tidak online
    ],
    // PRK022 - WiFi Printer Bermasalah
    'PRK022' => [
        ['code' => 'PRG047', 'cf' => 0.9],  // Printer tidak terdeteksi via WiFi
        ['code' => 'PRG050', 'cf' => 0.8],  // WiFi printer sering putus/disconnect
        ['code' => 'PRG051', 'cf' => 0.8],  // Printer tidak bisa connect ke jaringan WiFi
        ['code' => 'PRG048', 'cf' => 0.5],  // Printer offline/tidak online
    ],
    // PRK023 - Print Spooler Error
    'PRK023' => [
        ['code' => 'PRG058', 'cf' => 0.9],  // Spooler service error
        ['code' => 'PRG052', 'cf' => 0.8],  // Print job stuck di queue/antrian
        ['code' => 'PRG080', 'cf' => 0.8],  // Print spooler service mati
        ['code' => 'PRG048', 'cf' => 0.5],  // Printer offline/tidak online
    ],
    // PRK024 - Printer Network/Sharing Error
    'PRK024' => [
        ['code' => 'PRG054', 'cf' => 0.9],  // Sharing printer di jaringan gagal
        ['code' => 'PRG053', 'cf' => 0.8],  // Printer via LAN/Ethernet tidak terdeteksi
        ['code' => 'PRG059', 'cf' => 0.7],  // Firewall memblokir koneksi printer
        ['code' => 'PRG048', 'cf' => 0.5],  // Printer offline/tidak online
    ],
    // PRK025 - Port Printer USB Rusak Fisik
    'PRK025' => [
        ['code' => 'PRG067', 'cf' => 0.9],  // Port USB printer rusak fisik
        ['code' => 'PRG046', 'cf' => 0.8],  // Printer tidak terdeteksi via USB
        ['code' => 'PRG049', 'cf' => 0.7],  // Kabel USB printer rusak/longgar
        ['code' => 'PRG060', 'cf' => 0.5],  // Port printer di komputer mengalami error
    ],
    // PRK026 - IP Address Printer Conflict/Berubah
    'PRK026' => [
        ['code' => 'PRG055', 'cf' => 0.9],  // IP address printer berubah-ubah
        ['code' => 'PRG048', 'cf' => 0.7],  // Printer offline/tidak online
        ['code' => 'PRG047', 'cf' => 0.6],  // Printer tidak terdeteksi via WiFi
        ['code' => 'PRG053', 'cf' => 0.5],  // Printer via LAN/Ethernet tidak terdeteksi
    ],

    // ============================================================
    // === HARDWARE PRINTER (PRK027-PRK032) ======================
    // ============================================================

    // PRK027 - Power Supply Printer Rusak
    'PRK027' => [
        ['code' => 'PRG061', 'cf' => 0.9],  // Printer mati total/tidak menyala
        ['code' => 'PRG068', 'cf' => 0.9],  // Power supply internal printer rusak
        ['code' => 'PRG069', 'cf' => 0.8],  // Adaptor/kabel power printer rusak
        ['code' => 'PRG074', 'cf' => 0.6],  // Printer restart/reboot sendiri
    ],
    // PRK028 - Mainboard/Logic Board Printer Rusak
    'PRK028' => [
        ['code' => 'PRG070', 'cf' => 0.9],  // Mainboard/logic board printer rusak
        ['code' => 'PRG062', 'cf' => 0.8],  // Printer menyala tapi tidak merespon
        ['code' => 'PRG065', 'cf' => 0.7],  // Printer error code muncul di display
        ['code' => 'PRG061', 'cf' => 0.6],  // Printer mati total/tidak menyala
    ],
    // PRK029 - Panel LCD/Display Printer Rusak
    'PRK029' => [
        ['code' => 'PRG063', 'cf' => 0.9],  // Panel LCD/display printer error
        ['code' => 'PRG064', 'cf' => 0.7],  // Tombol/button printer tidak berfungsi
        ['code' => 'PRG065', 'cf' => 0.5],  // Printer error code muncul di display
    ],
    // PRK030 - Printer Overheat
    'PRK030' => [
        ['code' => 'PRG071', 'cf' => 0.9],  // Printer panas berlebih/overheat
        ['code' => 'PRG074', 'cf' => 0.7],  // Printer restart/reboot sendiri
        ['code' => 'PRG073', 'cf' => 0.6],  // Noise/suara abnormal dari printer
        ['code' => 'PRG062', 'cf' => 0.5],  // Printer menyala tapi tidak merespon
    ],
    // PRK031 - Memori Printer Penuh
    'PRK031' => [
        ['code' => 'PRG075', 'cf' => 0.9],  // Memori printer penuh
        ['code' => 'PRG090', 'cf' => 0.7],  // Proses cetak sangat lambat
        ['code' => 'PRG065', 'cf' => 0.6],  // Printer error code muncul di display
        ['code' => 'PRG062', 'cf' => 0.5],  // Printer menyala tapi tidak merespon
    ],
    // PRK032 - Cover/Penutup Printer Tidak Menutup
    'PRK032' => [
        ['code' => 'PRG066', 'cf' => 0.9],  // Cover/penutup printer tidak menutup rapat
        ['code' => 'PRG065', 'cf' => 0.7],  // Printer error code muncul di display
        ['code' => 'PRG062', 'cf' => 0.5],  // Printer menyala tapi tidak merespon
    ],

    // ============================================================
    // === SOFTWARE / DRIVER (PRK033-PRK037) ======================
    // ============================================================

    // PRK033 - Driver Printer Tidak Terinstall/Corrupt
    'PRK033' => [
        ['code' => 'PRG076', 'cf' => 0.9],  // Driver printer tidak terinstall
        ['code' => 'PRG078', 'cf' => 0.7],  // Driver printer crash/error
        ['code' => 'PRG048', 'cf' => 0.6],  // Printer offline/tidak online
        ['code' => 'PRG085', 'cf' => 0.5],  // Print job gagal tanpa error message
    ],
    // PRK034 - Firmware Printer Outdated/Error
    'PRK034' => [
        ['code' => 'PRG082', 'cf' => 0.9],  // Firmware printer perlu update
        ['code' => 'PRG083', 'cf' => 0.7],  // Software utility printer error
        ['code' => 'PRG065', 'cf' => 0.5],  // Printer error code muncul di display
    ],
    // PRK035 - Print Queue/Antrian Stuck
    'PRK035' => [
        ['code' => 'PRG081', 'cf' => 0.9],  // Antrian cetak tidak bisa dihapus
        ['code' => 'PRG052', 'cf' => 0.8],  // Print job stuck di queue/antrian
        ['code' => 'PRG080', 'cf' => 0.7],  // Print spooler service mati
        ['code' => 'PRG048', 'cf' => 0.5],  // Printer offline/tidak online
    ],
    // PRK036 - Printer Default Berubah
    'PRK036' => [
        ['code' => 'PRG079', 'cf' => 0.9],  // Printer default salah/berubah
        ['code' => 'PRG085', 'cf' => 0.7],  // Print job gagal tanpa error message
        ['code' => 'PRG048', 'cf' => 0.4],  // Printer offline/tidak online
    ],
    // PRK037 - Kompatibilitas Driver Setelah Update OS
    'PRK037' => [
        ['code' => 'PRG089', 'cf' => 0.9],  // Printer tidak mau cetak setelah update OS
        ['code' => 'PRG077', 'cf' => 0.8],  // Driver printer tidak kompatibel
        ['code' => 'PRG078', 'cf' => 0.7],  // Driver printer crash/error
        ['code' => 'PRG048', 'cf' => 0.5],  // Printer offline/tidak online
    ],

    // ============================================================
    // === MEKANIK PRINTER (PRK038-PRK043, PRK072) ===============
    // ============================================================

    // PRK038 - Belt/Timing Belt Rusak
    'PRK038' => [
        ['code' => 'PRG091', 'cf' => 0.9],  // Belt/timing belt aus atau putus
        ['code' => 'PRG097', 'cf' => 0.8],  // Carriage tidak bergerak bebas
        ['code' => 'PRG096', 'cf' => 0.7],  // Printer bunyi grinding/kasar
        ['code' => 'PRG013', 'cf' => 0.5],  // Cetakan miring/tidak rata
    ],
    // PRK039 - Motor Printer Rusak
    'PRK039' => [
        ['code' => 'PRG092', 'cf' => 0.9],  // Motor printer bunyi/tidak berfungsi
        ['code' => 'PRG096', 'cf' => 0.8],  // Printer bunyi grinding/kasar
        ['code' => 'PRG097', 'cf' => 0.7],  // Carriage tidak bergerak bebas
        ['code' => 'PRG032', 'cf' => 0.6],  // Printer tidak mengambil kertas
    ],
    // PRK040 - Gear/Roda Gigi Aus/Patah
    'PRK040' => [
        ['code' => 'PRG093', 'cf' => 0.9],  // Gear/roda gigi aus atau patah
        ['code' => 'PRG096', 'cf' => 0.8],  // Printer bunyi grinding/kasar
        ['code' => 'PRG073', 'cf' => 0.7],  // Noise/suara abnormal dari printer
        ['code' => 'PRG032', 'cf' => 0.5],  // Printer tidak mengambil kertas
    ],
    // PRK041 - Encoder Strip Kotor/Rusak
    'PRK041' => [
        ['code' => 'PRG094', 'cf' => 0.9],  // Encoder strip kotor/rusak
        ['code' => 'PRG100', 'cf' => 0.8],  // Sensor posisi carriage error
        ['code' => 'PRG013', 'cf' => 0.7],  // Cetakan miring/tidak rata
        ['code' => 'PRG001', 'cf' => 0.5],  // Hasil cetak bergaris horizontal
    ],
    // PRK042 - Carriage/Head Unit Macet
    'PRK042' => [
        ['code' => 'PRG097', 'cf' => 0.9],  // Carriage tidak bergerak bebas
        ['code' => 'PRG101', 'cf' => 0.8],  // Guide rail/jalur carriage kotor
        ['code' => 'PRG096', 'cf' => 0.7],  // Printer bunyi grinding/kasar
        ['code' => 'PRG073', 'cf' => 0.5],  // Noise/suara abnormal dari printer
    ],
    // PRK043 - Purge/Capping Station Rusak
    'PRK043' => [
        ['code' => 'PRG103', 'cf' => 0.9],  // Purge unit/capping station bermasalah
        ['code' => 'PRG104', 'cf' => 0.8],  // Wiper blade kotor/rusak
        ['code' => 'PRG019', 'cf' => 0.6],  // Head printer tersumbat
        ['code' => 'PRG110', 'cf' => 0.5],  // Head cleaning berulang tidak berhasil
    ],

    // ============================================================
    // === INKJET SPESIFIK (PRK044-PRK048) =======================
    // ============================================================

    // PRK044 - Print Head Inkjet Rusak Permanen
    'PRK044' => [
        ['code' => 'PRG107', 'cf' => 0.9],  // Print head tersumbat permanen
        ['code' => 'PRG110', 'cf' => 0.8],  // Head cleaning berulang tidak berhasil
        ['code' => 'PRG108', 'cf' => 0.7],  // Nozzle check pattern masih bergaris
        ['code' => 'PRG118', 'cf' => 0.6],  // Cartridge tipe thermal head aus
        ['code' => 'PRG001', 'cf' => 0.5],  // Hasil cetak bergaris horizontal
    ],
    // PRK045 - Sistem Infus Tinta (CISS) Error
    'PRK045' => [
        ['code' => 'PRG109', 'cf' => 0.9],  // Infus tank tinta bermasalah
        ['code' => 'PRG027', 'cf' => 0.8],  // Selang tinta infus tersumbat/bocor
        ['code' => 'PRG028', 'cf' => 0.7],  // Tinta di tank infus habis
        ['code' => 'PRG111', 'cf' => 0.6],  // Tinta menetes saat idle
        ['code' => 'PRG015', 'cf' => 0.4],  // Hanya satu warna yang tidak keluar
    ],
    // PRK046 - Cartridge Inkjet Tidak Kompatibel
    'PRK046' => [
        ['code' => 'PRG112', 'cf' => 0.9],  // Cartridge tidak pas/longgar di slot
        ['code' => 'PRG017', 'cf' => 0.8],  // Cartridge tinta tidak terdeteksi
        ['code' => 'PRG025', 'cf' => 0.6],  // Menggunakan tinta/toner non-original
        ['code' => 'PRG072', 'cf' => 0.5],  // LED indikator berkedip error
    ],
    // PRK047 - Tinta Kering di Nozzle (Lama Tidak Pakai)
    'PRK047' => [
        ['code' => 'PRG147', 'cf' => 0.9],  // Masalah setelah printer lama tidak dipakai
        ['code' => 'PRG107', 'cf' => 0.8],  // Print head tersumbat permanen
        ['code' => 'PRG108', 'cf' => 0.7],  // Nozzle check pattern masih bergaris
        ['code' => 'PRG110', 'cf' => 0.6],  // Head cleaning berulang tidak berhasil
    ],
    // PRK048 - Warna Cetakan Inkjet Tidak Akurat
    'PRK048' => [
        ['code' => 'PRG004', 'cf' => 0.9],  // Warna cetak tidak sesuai/salah warna
        ['code' => 'PRG115', 'cf' => 0.8],  // Photo printing quality rendah
        ['code' => 'PRG003', 'cf' => 0.6],  // Warna cetak pudar/tidak pekat
        ['code' => 'PRG029', 'cf' => 0.5],  // Warna tinta tercampur
    ],

    // ============================================================
    // === LASER / TONER SPESIFIK (PRK049-PRK054, PRK067-069) ====
    // ============================================================

    // PRK049 - Drum OPC Aus/Rusak (Laser)
    'PRK049' => [
        ['code' => 'PRG122', 'cf' => 0.9],  // Drum unit aus/perlu ganti
        ['code' => 'PRG123', 'cf' => 0.8],  // Drum unit tergores
        ['code' => 'PRG134', 'cf' => 0.8],  // Cetakan muncul titik-titik berulang (drum defect)
        ['code' => 'PRG012', 'cf' => 0.6],  // Background cetak kotor/abu-abu
        ['code' => 'PRG011', 'cf' => 0.5],  // Ghost image / bayangan cetakan berulang
    ],
    // PRK050 - Fuser Assembly Rusak (Laser)
    'PRK050' => [
        ['code' => 'PRG121', 'cf' => 0.9],  // Fuser unit rusak/panas berlebih
        ['code' => 'PRG125', 'cf' => 0.8],  // Fuser film/sleeve rusak
        ['code' => 'PRG132', 'cf' => 0.8],  // Fuser temperature error
        ['code' => 'PRG135', 'cf' => 0.7],  // Kertas keriting/melengkung setelah cetak
        ['code' => 'PRG010', 'cf' => 0.6],  // Tinta/toner mudah luntur saat disentuh
    ],
    // PRK051 - Toner Bocor di Dalam Printer
    'PRK051' => [
        ['code' => 'PRG023', 'cf' => 0.9],  // Toner bocor/tumpah di dalam printer
        ['code' => 'PRG130', 'cf' => 0.7],  // Waste toner container penuh
        ['code' => 'PRG012', 'cf' => 0.6],  // Background cetak kotor/abu-abu
        ['code' => 'PRG005', 'cf' => 0.5],  // Ada bercak/noda tinta pada hasil cetak
    ],
    // PRK052 - Laser Scanner Unit (LSU) Error
    'PRK052' => [
        ['code' => 'PRG131', 'cf' => 0.9],  // Laser unit/scanner unit error
        ['code' => 'PRG008', 'cf' => 0.8],  // Halaman cetak kosong seluruhnya
        ['code' => 'PRG065', 'cf' => 0.7],  // Printer error code muncul di display
        ['code' => 'PRG073', 'cf' => 0.5],  // Noise/suara abnormal dari printer
    ],
    // PRK053 - Transfer Belt/Roller Rusak
    'PRK053' => [
        ['code' => 'PRG124', 'cf' => 0.9],  // Transfer roller/belt rusak
        ['code' => 'PRG004', 'cf' => 0.7],  // Warna cetak tidak sesuai/salah warna
        ['code' => 'PRG013', 'cf' => 0.6],  // Cetakan miring/tidak rata
        ['code' => 'PRG012', 'cf' => 0.5],  // Background cetak kotor/abu-abu
    ],
    // PRK054 - Cartridge Toner Seal Belum Dilepas
    'PRK054' => [
        ['code' => 'PRG127', 'cf' => 0.9],  // Toner cartridge seal belum dilepas
        ['code' => 'PRG008', 'cf' => 0.8],  // Halaman cetak kosong seluruhnya
        ['code' => 'PRG003', 'cf' => 0.7],  // Warna cetak pudar/tidak pekat
        ['code' => 'PRG148', 'cf' => 0.6],  // Printer baru dibeli/pertama install
    ],
    // PRK067 - Transfer Roller Kotor (Laser)
    'PRK067' => [
        ['code' => 'PRG124', 'cf' => 0.8],  // Transfer roller/belt rusak
        ['code' => 'PRG009', 'cf' => 0.7],  // Bekas goresan/scratch pada hasil cetak
        ['code' => 'PRG005', 'cf' => 0.6],  // Ada bercak/noda tinta pada hasil cetak
        ['code' => 'PRG012', 'cf' => 0.5],  // Background cetak kotor/abu-abu
    ],
    // PRK068 - Charge Roller Kotor (Laser)
    'PRK068' => [
        ['code' => 'PRG129', 'cf' => 0.9],  // Charge roller kotor/aus
        ['code' => 'PRG012', 'cf' => 0.8],  // Background cetak kotor/abu-abu
        ['code' => 'PRG002', 'cf' => 0.6],  // Hasil cetak bergaris vertikal
        ['code' => 'PRG134', 'cf' => 0.5],  // Cetakan muncul titik-titik berulang
    ],
    // PRK069 - Waste Toner Container Penuh
    'PRK069' => [
        ['code' => 'PRG130', 'cf' => 0.9],  // Waste toner container penuh
        ['code' => 'PRG065', 'cf' => 0.8],  // Printer error code muncul di display
        ['code' => 'PRG062', 'cf' => 0.6],  // Printer menyala tapi tidak merespon
    ],

    // ============================================================
    // === SCANNER / MFP (PRK055-PRK059, PRK070) =================
    // ============================================================

    // PRK055 - Scanner Unit Tidak Berfungsi
    'PRK055' => [
        ['code' => 'PRG136', 'cf' => 0.9],  // Scanner tidak berfungsi
        ['code' => 'PRG138', 'cf' => 0.7],  // Scanner lampu mati/redup
        ['code' => 'PRG065', 'cf' => 0.5],  // Printer error code muncul di display
    ],
    // PRK056 - Hasil Scan Bergaris/Kotor
    'PRK056' => [
        ['code' => 'PRG137', 'cf' => 0.9],  // Hasil scan bergaris
        ['code' => 'PRG139', 'cf' => 0.8],  // Kaca scanner kotor/tergores
        ['code' => 'PRG140', 'cf' => 0.6],  // Hasil scan warna salah
        ['code' => 'PRG143', 'cf' => 0.5],  // Resolusi scan rendah
    ],
    // PRK057 - ADF Scanner Macet
    'PRK057' => [
        ['code' => 'PRG142', 'cf' => 0.9],  // ADF scanner macet/error
        ['code' => 'PRG042', 'cf' => 0.8],  // ADF (Auto Document Feeder) macet
        ['code' => 'PRG033', 'cf' => 0.6],  // Kertas tertarik lebih dari satu lembar
        ['code' => 'PRG031', 'cf' => 0.5],  // Kertas macet (paper jam)
    ],
    // PRK058 - Scan to Email/Folder Gagal
    'PRK058' => [
        ['code' => 'PRG141', 'cf' => 0.9],  // Scan ke email/folder gagal
        ['code' => 'PRG136', 'cf' => 0.6],  // Scanner tidak berfungsi
        ['code' => 'PRG059', 'cf' => 0.5],  // Firewall memblokir koneksi printer
    ],
    // PRK059 - Lampu Scanner Redup/Mati
    'PRK059' => [
        ['code' => 'PRG138', 'cf' => 0.9],  // Scanner lampu mati/redup
        ['code' => 'PRG136', 'cf' => 0.7],  // Scanner tidak berfungsi
        ['code' => 'PRG143', 'cf' => 0.5],  // Resolusi scan rendah
    ],
    // PRK070 - Kualitas Fotocopy Buruk
    'PRK070' => [
        ['code' => 'PRG144', 'cf' => 0.9],  // Fotocopy hasil buruk
        ['code' => 'PRG139', 'cf' => 0.8],  // Kaca scanner kotor/tergores
        ['code' => 'PRG137', 'cf' => 0.7],  // Hasil scan bergaris
        ['code' => 'PRG003', 'cf' => 0.5],  // Warna cetak pudar/tidak pekat
    ],

    // ============================================================
    // === DIFFERENTIAL (PRK060-PRK064) ==========================
    // ============================================================

    // PRK060 - Penyebab Tinta/Toner (Consumable)
    'PRK060' => [
        ['code' => 'PRG146', 'cf' => 0.9],  // Masalah setelah ganti tinta/toner
        ['code' => 'PRG016', 'cf' => 0.7],  // Tinta habis / level tinta rendah
        ['code' => 'PRG025', 'cf' => 0.6],  // Menggunakan tinta/toner non-original
        ['code' => 'PRG003', 'cf' => 0.5],  // Warna cetak pudar/tidak pekat
    ],
    // PRK061 - Penyebab Mekanik (Part Aus)
    'PRK061' => [
        ['code' => 'PRG073', 'cf' => 0.8],  // Noise/suara abnormal dari printer
        ['code' => 'PRG096', 'cf' => 0.7],  // Printer bunyi grinding/kasar
        ['code' => 'PRG147', 'cf' => 0.6],  // Masalah setelah printer lama tidak dipakai
        ['code' => 'PRG153', 'cf' => 0.5],  // Masalah terjadi pada semua jenis cetakan
    ],
    // PRK062 - Penyebab Software/Driver
    'PRK062' => [
        ['code' => 'PRG154', 'cf' => 0.9],  // Printing test page dari printer berhasil
        ['code' => 'PRG089', 'cf' => 0.8],  // Printer tidak mau cetak setelah update OS
        ['code' => 'PRG078', 'cf' => 0.7],  // Driver printer crash/error
        ['code' => 'PRG076', 'cf' => 0.6],  // Driver printer tidak terinstall
    ],
    // PRK063 - Penyebab Konektivitas
    'PRK063' => [
        ['code' => 'PRG048', 'cf' => 0.8],  // Printer offline/tidak online
        ['code' => 'PRG050', 'cf' => 0.7],  // WiFi printer sering putus/disconnect
        ['code' => 'PRG046', 'cf' => 0.6],  // Printer tidak terdeteksi via USB
        ['code' => 'PRG155', 'cf' => 0.5],  // Sudah coba restart printer dan komputer
    ],
    // PRK064 - Printer Perlu Service/Maintenance
    'PRK064' => [
        ['code' => 'PRG153', 'cf' => 0.7],  // Masalah terjadi pada semua jenis cetakan
        ['code' => 'PRG073', 'cf' => 0.8],  // Noise/suara abnormal dari printer
        ['code' => 'PRG105', 'cf' => 0.6],  // Mekanik printer berkarat
        ['code' => 'PRG147', 'cf' => 0.5],  // Masalah setelah printer lama tidak dipakai
    ],

    // ============================================================
    // === TAMBAHAN (PRK065-PRK066, PRK071-PRK072) ===============
    // ============================================================

    // PRK065 - Warna Tidak Seimbang (Color Balance)
    'PRK065' => [
        ['code' => 'PRG152', 'cf' => 0.9],  // Masalah hanya terjadi pada warna tertentu
        ['code' => 'PRG004', 'cf' => 0.8],  // Warna cetak tidak sesuai/salah warna
        ['code' => 'PRG015', 'cf' => 0.7],  // Hanya satu warna yang tidak keluar
        ['code' => 'PRG003', 'cf' => 0.5],  // Warna cetak pudar/tidak pekat
    ],
    // PRK066 - Cetakan Hanya Hitam (Color Not Printing)
    'PRK066' => [
        ['code' => 'PRG084', 'cf' => 0.9],  // Setting cetak salah (ukuran/orientasi)
        ['code' => 'PRG015', 'cf' => 0.8],  // Hanya satu warna yang tidak keluar
        ['code' => 'PRG017', 'cf' => 0.7],  // Cartridge tinta tidak terdeteksi
        ['code' => 'PRG004', 'cf' => 0.5],  // Warna cetak tidak sesuai/salah warna
    ],
    // PRK071 - Cetak Dari Mobile Device Gagal
    'PRK071' => [
        ['code' => 'PRG057', 'cf' => 0.9],  // Mobile printing tidak berfungsi
        ['code' => 'PRG047', 'cf' => 0.7],  // Printer tidak terdeteksi via WiFi
        ['code' => 'PRG051', 'cf' => 0.6],  // Printer tidak bisa connect ke jaringan WiFi
        ['code' => 'PRG048', 'cf' => 0.5],  // Printer offline/tidak online
    ],
    // PRK072 - Printer Bunyi Abnormal Keras
    'PRK072' => [
        ['code' => 'PRG096', 'cf' => 0.9],  // Printer bunyi grinding/kasar
        ['code' => 'PRG073', 'cf' => 0.8],  // Noise/suara abnormal dari printer
        ['code' => 'PRG092', 'cf' => 0.7],  // Motor printer bunyi/tidak berfungsi
        ['code' => 'PRG093', 'cf' => 0.6],  // Gear/roda gigi aus atau patah
    ],
];
