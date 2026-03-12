<?php

// Printer - 90 diagnostic questions across 11 categories
// CORRECTED: All symptom_codes properly matched to actual symptoms in database
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
    // === KUALITAS CETAK (9) ===
    ['code' => 'PRQ001', 'question' => 'Apakah hasil cetakan memiliki garis-garis horizontal (bergaris)?', 'category' => 'Kualitas Cetak', 'symptom_codes' => ['PRG001', 'PRG002'], 'order' => 1],
    ['code' => 'PRQ002', 'question' => 'Apakah ada warna tertentu yang hilang atau tidak keluar pada hasil cetak?', 'category' => 'Kualitas Cetak', 'symptom_codes' => ['PRG015', 'PRG004'], 'order' => 2],
    ['code' => 'PRQ003', 'question' => 'Apakah head cleaning sudah dilakukan berulang kali tapi tidak membantu?', 'category' => 'Kualitas Cetak', 'symptom_codes' => ['PRG110', 'PRG019'], 'order' => 3],
    ['code' => 'PRQ004', 'question' => 'Apakah nozzle check pattern menunjukkan banyak garis yang hilang?', 'category' => 'Kualitas Cetak', 'symptom_codes' => ['PRG108'], 'order' => 4],
    ['code' => 'PRQ005', 'question' => 'Apakah ada indikator tinta/toner rendah atau habis menyala?', 'category' => 'Kualitas Cetak', 'symptom_codes' => ['PRG016', 'PRG021'], 'order' => 5],
    ['code' => 'PRQ006', 'question' => 'Apakah cetakan keseluruhan tampak pudar atau memudar?', 'category' => 'Kualitas Cetak', 'symptom_codes' => ['PRG003', 'PRG006'], 'order' => 6],
    ['code' => 'PRQ007', 'question' => 'Apakah warna cetakan tidak akurat atau berbeda dari yang terlihat di layar?', 'category' => 'Kualitas Cetak', 'symptom_codes' => ['PRG004', 'PRG029'], 'order' => 7],
    ['code' => 'PRQ008', 'question' => 'Apakah teks cetakan tidak rata, geser, atau ada gap antar baris?', 'category' => 'Kualitas Cetak', 'symptom_codes' => ['PRG013', 'PRG014'], 'order' => 8],
    ['code' => 'PRQ009', 'question' => 'Apakah ada titik atau noda yang berulang pada interval tertentu di cetakan (khusus laser)?', 'category' => 'Kualitas Cetak', 'symptom_codes' => ['PRG134', 'PRG011', 'PRG012'], 'order' => 9],

    // === TINTA / TONER (8) ===
    ['code' => 'PRQ010', 'question' => 'Apakah muncul error bahwa cartridge tinta/toner tidak terdeteksi?', 'category' => 'Tinta', 'symptom_codes' => ['PRG017', 'PRG024'], 'order' => 1],
    ['code' => 'PRQ011', 'question' => 'Apakah ada tinta yang menetes atau bocor dari cartridge/tank?', 'category' => 'Tinta', 'symptom_codes' => ['PRG018', 'PRG111', 'PRG005'], 'order' => 2],
    ['code' => 'PRQ012', 'question' => 'Apakah muncul error waste ink pad penuh atau lampu berkedip bergantian?', 'category' => 'Tinta', 'symptom_codes' => ['PRG026', 'PRG072'], 'order' => 3],
    ['code' => 'PRQ013', 'question' => 'Apakah tinta masih ada/terlihat tapi printer menganggapnya habis?', 'category' => 'Tinta', 'symptom_codes' => ['PRG024', 'PRG016'], 'order' => 4],
    ['code' => 'PRQ014', 'question' => 'Apakah ada gelembung udara terlihat di selang tinta infus (CISS)?', 'category' => 'Tinta', 'symptom_codes' => ['PRG027', 'PRG109'], 'order' => 5],
    ['code' => 'PRQ015', 'question' => 'Apakah cartridge baru ditolak oleh printer (error muncul saat dipasang)?', 'category' => 'Tinta', 'symptom_codes' => ['PRG017', 'PRG112'], 'order' => 6],
    ['code' => 'PRQ016', 'question' => 'Apakah toner serbuk bocor/terlihat di dalam printer (khusus laser)?', 'category' => 'Tinta', 'symptom_codes' => ['PRG023', 'PRG130'], 'order' => 7],
    ['code' => 'PRQ017', 'question' => 'Apakah kualitas cetak menurun setelah mengisi ulang tinta/toner?', 'category' => 'Tinta', 'symptom_codes' => ['PRG025', 'PRG146'], 'order' => 8],

    // === KERTAS / PAPER FEED (8) ===
    ['code' => 'PRQ018', 'question' => 'Apakah kertas sering macet (paper jam) di dalam printer?', 'category' => 'Kertas', 'symptom_codes' => ['PRG031', 'PRG040', 'PRG041'], 'order' => 1],
    ['code' => 'PRQ019', 'question' => 'Apakah printer tidak bisa mengambil kertas dari tray (kertas tidak tertarik)?', 'category' => 'Kertas', 'symptom_codes' => ['PRG032', 'PRG035'], 'order' => 2],
    ['code' => 'PRQ020', 'question' => 'Apakah muncul error paper jam padahal tidak ada kertas yang macet (false jam)?', 'category' => 'Kertas', 'symptom_codes' => ['PRG039', 'PRG031', 'PRG044'], 'order' => 3],
    ['code' => 'PRQ021', 'question' => 'Apakah kertas masuk miring atau paper guide tidak bisa diatur dengan benar?', 'category' => 'Kertas', 'symptom_codes' => ['PRG034', 'PRG036'], 'order' => 4],
    ['code' => 'PRQ022', 'question' => 'Apakah printer menarik lebih dari satu lembar kertas sekaligus?', 'category' => 'Kertas', 'symptom_codes' => ['PRG033'], 'order' => 5],
    ['code' => 'PRQ023', 'question' => 'Apakah ADF (Auto Document Feeder) bermasalah (tidak mengambil/macet)?', 'category' => 'Kertas', 'symptom_codes' => ['PRG042', 'PRG142', 'PRG033'], 'order' => 6],
    ['code' => 'PRQ024', 'question' => 'Apakah cetak bolak-balik (duplex) bermasalah (macet/tidak membalik)?', 'category' => 'Kertas', 'symptom_codes' => ['PRG043', 'PRG034', 'PRG031'], 'order' => 7],
    ['code' => 'PRQ025', 'question' => 'Apakah roller pengambil kertas (pickup roller) terlihat licin/mengkilap?', 'category' => 'Kertas', 'symptom_codes' => ['PRG035'], 'order' => 8],

    // === KONEKTIVITAS (8) ===
    ['code' => 'PRQ026', 'question' => 'Apakah printer tidak terdeteksi saat dihubungkan via kabel USB?', 'category' => 'Konektivitas', 'symptom_codes' => ['PRG046', 'PRG049', 'PRG060'], 'order' => 1],
    ['code' => 'PRQ027', 'question' => 'Apakah koneksi USB printer sering putus-nyambung (connect-disconnect)?', 'category' => 'Konektivitas', 'symptom_codes' => ['PRG046', 'PRG049'], 'order' => 2],
    ['code' => 'PRQ028', 'question' => 'Apakah printer tidak bisa terhubung ke jaringan WiFi?', 'category' => 'Konektivitas', 'symptom_codes' => ['PRG047', 'PRG051'], 'order' => 3],
    ['code' => 'PRQ029', 'question' => 'Apakah koneksi WiFi printer sering putus atau tidak stabil?', 'category' => 'Konektivitas', 'symptom_codes' => ['PRG050', 'PRG055'], 'order' => 4],
    ['code' => 'PRQ030', 'question' => 'Apakah status printer menunjukkan "Offline" padahal sudah menyala?', 'category' => 'Konektivitas', 'symptom_codes' => ['PRG048', 'PRG052'], 'order' => 5],
    ['code' => 'PRQ031', 'question' => 'Apakah muncul error saat mencoba cetak ke shared printer di jaringan?', 'category' => 'Konektivitas', 'symptom_codes' => ['PRG054', 'PRG053', 'PRG059'], 'order' => 6],
    ['code' => 'PRQ032', 'question' => 'Apakah print job gagal terkirim (muncul error atau tidak ada respon)?', 'category' => 'Konektivitas', 'symptom_codes' => ['PRG052', 'PRG058', 'PRG048'], 'order' => 7],
    ['code' => 'PRQ033', 'question' => 'Apakah cetak dari smartphone/tablet gagal (AirPrint/Google Print/app vendor)?', 'category' => 'Konektivitas', 'symptom_codes' => ['PRG057', 'PRG047', 'PRG051'], 'order' => 8],

    // === HARDWARE (7) ===
    ['code' => 'PRQ034', 'question' => 'Apakah printer mati total (tidak menyala sama sekali)?', 'category' => 'Hardware', 'symptom_codes' => ['PRG061', 'PRG068'], 'order' => 1],
    ['code' => 'PRQ035', 'question' => 'Apakah printer sering restart sendiri atau mati secara tiba-tiba?', 'category' => 'Hardware', 'symptom_codes' => ['PRG074', 'PRG069'], 'order' => 2],
    ['code' => 'PRQ036', 'question' => 'Apakah printer menyala tapi tidak merespon perintah apapun?', 'category' => 'Hardware', 'symptom_codes' => ['PRG062', 'PRG064'], 'order' => 3],
    ['code' => 'PRQ037', 'question' => 'Apakah layar LCD panel printer rusak (blank/bergaris/karakter aneh)?', 'category' => 'Hardware', 'symptom_codes' => ['PRG063', 'PRG064', 'PRG065'], 'order' => 4],
    ['code' => 'PRQ038', 'question' => 'Apakah printer terasa sangat panas saat beroperasi?', 'category' => 'Hardware', 'symptom_codes' => ['PRG071', 'PRG074'], 'order' => 5],
    ['code' => 'PRQ039', 'question' => 'Apakah muncul error "Memory Full" atau file besar gagal dicetak?', 'category' => 'Hardware', 'symptom_codes' => ['PRG075', 'PRG090', 'PRG065'], 'order' => 6],
    ['code' => 'PRQ040', 'question' => 'Apakah muncul error "Cover Open" padahal penutup sudah tertutup?', 'category' => 'Hardware', 'symptom_codes' => ['PRG066', 'PRG065'], 'order' => 7],

    // === SOFTWARE / DRIVER (7) ===
    ['code' => 'PRQ041', 'question' => 'Apakah printer terdeteksi di komputer tapi tidak bisa mencetak?', 'category' => 'Software', 'symptom_codes' => ['PRG085', 'PRG076'], 'order' => 1],
    ['code' => 'PRQ042', 'question' => 'Apakah muncul error "Driver is unavailable" untuk printer?', 'category' => 'Software', 'symptom_codes' => ['PRG076', 'PRG077'], 'order' => 2],
    ['code' => 'PRQ043', 'question' => 'Apakah antrian cetak (print queue) macet dan tidak bisa dihapus?', 'category' => 'Software', 'symptom_codes' => ['PRG081', 'PRG052'], 'order' => 3],
    ['code' => 'PRQ044', 'question' => 'Apakah print keluar ke printer yang salah (default printer berubah)?', 'category' => 'Software', 'symptom_codes' => ['PRG079', 'PRG085'], 'order' => 4],
    ['code' => 'PRQ045', 'question' => 'Apakah printer bermasalah setelah update Windows/OS?', 'category' => 'Software', 'symptom_codes' => ['PRG089', 'PRG077'], 'order' => 5],
    ['code' => 'PRQ046', 'question' => 'Apakah masalah cetak hanya terjadi pada aplikasi/program tertentu?', 'category' => 'Software', 'symptom_codes' => ['PRG086'], 'order' => 6],
    ['code' => 'PRQ047', 'question' => 'Apakah ada fitur printer yang sebelumnya berfungsi kini tidak tersedia?', 'category' => 'Software', 'symptom_codes' => ['PRG082', 'PRG083'], 'order' => 7],

    // === MEKANIK PRINTER (8) ===
    ['code' => 'PRQ048', 'question' => 'Apakah carriage/head printer tidak bergerak atau macet?', 'category' => 'Mekanik', 'symptom_codes' => ['PRG097', 'PRG101', 'PRG100'], 'order' => 1],
    ['code' => 'PRQ049', 'question' => 'Apakah terdengar bunyi decit atau kasar dari timing belt printer?', 'category' => 'Mekanik', 'symptom_codes' => ['PRG091', 'PRG096'], 'order' => 2],
    ['code' => 'PRQ050', 'question' => 'Apakah motor printer mengeluarkan bunyi abnormal (grinding/kasar)?', 'category' => 'Mekanik', 'symptom_codes' => ['PRG092', 'PRG096'], 'order' => 3],
    ['code' => 'PRQ051', 'question' => 'Apakah terdengar bunyi klik-klik dari roda gigi (gear) printer?', 'category' => 'Mekanik', 'symptom_codes' => ['PRG093', 'PRG096'], 'order' => 4],
    ['code' => 'PRQ052', 'question' => 'Apakah cetakan menumpuk di satu area atau posisi cetak meleset?', 'category' => 'Mekanik', 'symptom_codes' => ['PRG094', 'PRG100'], 'order' => 5],
    ['code' => 'PRQ053', 'question' => 'Apakah head printer sering tersumbat meskipun sudah sering di-cleaning?', 'category' => 'Mekanik', 'symptom_codes' => ['PRG103', 'PRG104'], 'order' => 6],
    ['code' => 'PRQ054', 'question' => 'Apakah printer mengeluarkan suara keras atau abnormal saat beroperasi?', 'category' => 'Mekanik', 'symptom_codes' => ['PRG096', 'PRG073'], 'order' => 7],
    ['code' => 'PRQ055', 'question' => 'Apakah ada bunyi abnormal dari area parking/capping station?', 'category' => 'Mekanik', 'symptom_codes' => ['PRG103'], 'order' => 8],

    // === INKJET SPESIFIK (8) ===
    ['code' => 'PRQ056', 'question' => 'Apakah print head sudah di-rendam/flush dengan cairan pembersih tapi tetap bermasalah?', 'category' => 'Inkjet', 'symptom_codes' => ['PRG107', 'PRG110'], 'order' => 1],
    ['code' => 'PRQ057', 'question' => 'Apakah printer inkjet sudah lama tidak digunakan (berminggu/berbulan)?', 'category' => 'Inkjet', 'symptom_codes' => ['PRG147'], 'order' => 2],
    ['code' => 'PRQ058', 'question' => 'Apakah tinta di tank infus tidak berkurang meski sudah mencetak banyak?', 'category' => 'Inkjet', 'symptom_codes' => ['PRG109', 'PRG027'], 'order' => 3],
    ['code' => 'PRQ059', 'question' => 'Apakah selang tinta infus terlihat bocor atau ada tetesan tinta?', 'category' => 'Inkjet', 'symptom_codes' => ['PRG027', 'PRG111'], 'order' => 4],
    ['code' => 'PRQ060', 'question' => 'Apakah warna cetakan inkjet terlalu dominan satu warna?', 'category' => 'Inkjet', 'symptom_codes' => ['PRG152', 'PRG004'], 'order' => 5],
    ['code' => 'PRQ061', 'question' => 'Apakah cetakan selalu keluar hitam putih meskipun setting sudah warna?', 'category' => 'Inkjet', 'symptom_codes' => ['PRG015', 'PRG084'], 'order' => 6],
    ['code' => 'PRQ062', 'question' => 'Apakah tinta mudah luntur saat diusap pada hasil cetak?', 'category' => 'Inkjet', 'symptom_codes' => ['PRG010', 'PRG117'], 'order' => 7],
    ['code' => 'PRQ063', 'question' => 'Apakah printer inkjet sudah berusia tua atau sudah sangat banyak digunakan?', 'category' => 'Inkjet', 'symptom_codes' => ['PRG118', 'PRG153'], 'order' => 8],

    // === LASER SPESIFIK (8) ===
    ['code' => 'PRQ064', 'question' => 'Apakah toner pada hasil cetak mudah luntur/mengelupas saat diusap?', 'category' => 'Laser', 'symptom_codes' => ['PRG010', 'PRG121'], 'order' => 1],
    ['code' => 'PRQ065', 'question' => 'Apakah kertas berkerut atau keriting setelah keluar dari printer laser?', 'category' => 'Laser', 'symptom_codes' => ['PRG135', 'PRG121'], 'order' => 2],
    ['code' => 'PRQ066', 'question' => 'Apakah tercium bau hangus dari printer laser saat mencetak?', 'category' => 'Laser', 'symptom_codes' => ['PRG121', 'PRG071'], 'order' => 3],
    ['code' => 'PRQ067', 'question' => 'Apakah muncul error suhu fuser (fuser temperature error) di display?', 'category' => 'Laser', 'symptom_codes' => ['PRG132', 'PRG125'], 'order' => 4],
    ['code' => 'PRQ068', 'question' => 'Apakah kertas keluar kosong (blank) dari printer laser?', 'category' => 'Laser', 'symptom_codes' => ['PRG008', 'PRG131'], 'order' => 5],
    ['code' => 'PRQ069', 'question' => 'Apakah warna tidak ter-register/overlapping pada printer laser warna?', 'category' => 'Laser', 'symptom_codes' => ['PRG124', 'PRG004'], 'order' => 6],
    ['code' => 'PRQ070', 'question' => 'Apakah cartridge toner baru baru saja dipasang tapi tidak bisa mencetak?', 'category' => 'Laser', 'symptom_codes' => ['PRG127', 'PRG022'], 'order' => 7],
    ['code' => 'PRQ071', 'question' => 'Apakah background cetakan laser kotor/gelap atau ada bayangan (ghost image)?', 'category' => 'Laser', 'symptom_codes' => ['PRG012', 'PRG011', 'PRG129'], 'order' => 8],

    // === SCANNER / MFP (8) ===
    ['code' => 'PRQ072', 'question' => 'Apakah scanner pada printer MFP tidak merespon atau error saat scan?', 'category' => 'Scanner', 'symptom_codes' => ['PRG136', 'PRG065'], 'order' => 1],
    ['code' => 'PRQ073', 'question' => 'Apakah lampu scanner tidak menyala atau sangat redup?', 'category' => 'Scanner', 'symptom_codes' => ['PRG138', 'PRG136'], 'order' => 2],
    ['code' => 'PRQ074', 'question' => 'Apakah hasil scan memiliki garis atau noda yang tidak ada di dokumen asli?', 'category' => 'Scanner', 'symptom_codes' => ['PRG137', 'PRG139'], 'order' => 3],
    ['code' => 'PRQ075', 'question' => 'Apakah hasil scan terlalu gelap atau terang tidak merata?', 'category' => 'Scanner', 'symptom_codes' => ['PRG138', 'PRG143'], 'order' => 4],
    ['code' => 'PRQ076', 'question' => 'Apakah fitur scan to email gagal (error SMTP/autentikasi)?', 'category' => 'Scanner', 'symptom_codes' => ['PRG141'], 'order' => 5],
    ['code' => 'PRQ077', 'question' => 'Apakah fitur scan to folder/network gagal?', 'category' => 'Scanner', 'symptom_codes' => ['PRG141'], 'order' => 6],
    ['code' => 'PRQ078', 'question' => 'Apakah kualitas hasil fotocopy/copy buruk?', 'category' => 'Scanner', 'symptom_codes' => ['PRG144', 'PRG139'], 'order' => 7],
    ['code' => 'PRQ079', 'question' => 'Apakah kaca scanner terlihat kotor atau berdebu?', 'category' => 'Scanner', 'symptom_codes' => ['PRG139'], 'order' => 8],

    // === DIFFERENTIAL (12) ===
    ['code' => 'PRQ080', 'question' => 'Apakah masalah terjadi setelah mengganti tinta atau toner?', 'category' => 'Differential', 'symptom_codes' => ['PRG146', 'PRG149'], 'order' => 1],
    ['code' => 'PRQ081', 'question' => 'Apakah terdengar bunyi mekanis abnormal dari dalam printer?', 'category' => 'Differential', 'symptom_codes' => ['PRG073', 'PRG096'], 'order' => 2],
    ['code' => 'PRQ082', 'question' => 'Apakah masalah semakin memburuk seiring waktu?', 'category' => 'Differential', 'symptom_codes' => ['PRG153', 'PRG147'], 'order' => 3],
    ['code' => 'PRQ083', 'question' => 'Apakah masalah hanya terjadi saat cetak dari aplikasi/program tertentu?', 'category' => 'Differential', 'symptom_codes' => ['PRG086', 'PRG154'], 'order' => 4],
    ['code' => 'PRQ084', 'question' => 'Apakah printer kadang bisa mencetak kadang tidak (intermittent)?', 'category' => 'Differential', 'symptom_codes' => ['PRG048', 'PRG050'], 'order' => 5],
    ['code' => 'PRQ085', 'question' => 'Apakah printer mengalami beberapa masalah sekaligus?', 'category' => 'Differential', 'symptom_codes' => ['PRG153', 'PRG090'], 'order' => 6],
    ['code' => 'PRQ086', 'question' => 'Apakah masalah muncul setelah update Windows atau sistem operasi?', 'category' => 'Differential', 'symptom_codes' => ['PRG089'], 'order' => 7],
    ['code' => 'PRQ087', 'question' => 'Apakah printer sudah lama tidak di-service atau maintenance?', 'category' => 'Differential', 'symptom_codes' => ['PRG147', 'PRG105'], 'order' => 8],
    ['code' => 'PRQ088', 'question' => 'Apakah masalah terjadi di semua komputer atau hanya di satu komputer?', 'category' => 'Differential', 'symptom_codes' => ['PRG154', 'PRG086'], 'order' => 9],
    ['code' => 'PRQ089', 'question' => 'Apakah test page dari printer sendiri (tanpa komputer) juga bermasalah?', 'category' => 'Differential', 'symptom_codes' => ['PRG154'], 'order' => 10],
    ['code' => 'PRQ090', 'question' => 'Apakah performa printer secara umum menurun (lambat, kualitas turun)?', 'category' => 'Differential', 'symptom_codes' => ['PRG153', 'PRG090'], 'order' => 11],
];
