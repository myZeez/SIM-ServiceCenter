<?php

// Dataset AIO (All-in-One PC) - 119 pertanyaan klarifikasi
// Pertanyaan untuk menggali gejala lebih dalam saat diagnosis
return [

    // === ADAPTOR (8) ===
    ['category' => 'Adaptor', 'question' => 'Apakah adaptor AIO yang digunakan adalah adaptor original bawaan?', 'expected_keyword' => 'tidak, bukan original, pengganti, beda merek', 'leads_to' => 'AIOG011', 'order' => 1],
    ['category' => 'Adaptor', 'question' => 'Apakah adaptor terasa sangat panas saat digunakan?', 'expected_keyword' => 'ya, panas, kepanasan, overheat, sangat panas', 'leads_to' => 'AIOG006', 'order' => 2],
    ['category' => 'Adaptor', 'question' => 'Apakah ada bau hangus dari adaptor atau kabelnya?', 'expected_keyword' => 'ya, bau, hangus, gosong, terbakar', 'leads_to' => 'AIOG007', 'order' => 3],
    ['category' => 'Adaptor', 'question' => 'Apakah kabel adaptor terlihat rusak, terkelupas, atau tertekuk parah?', 'expected_keyword' => 'ya, rusak, terkelupas, putus, tertekuk', 'leads_to' => 'AIOG008', 'order' => 4],
    ['category' => 'Adaptor', 'question' => 'Apakah port colokan adaptor di body AIO terasa longgar?', 'expected_keyword' => 'ya, longgar, oblak, goyang, tidak pas', 'leads_to' => 'AIOG009', 'order' => 5],
    ['category' => 'Adaptor', 'question' => 'Apakah AIO mati saat digunakan untuk tugas berat (editing, banyak tab)?', 'expected_keyword' => 'ya, saat berat, editing, banyak program', 'leads_to' => 'AIOG010', 'order' => 6],
    ['category' => 'Adaptor', 'question' => 'Apakah tombol power tidak merespon sama sekali?', 'expected_keyword' => 'ya, tidak respon, diam, tidak berfungsi', 'leads_to' => 'AIOG014', 'order' => 7],
    ['category' => 'Adaptor', 'question' => 'Apakah AIO menyala sebentar lalu langsung mati?', 'expected_keyword' => 'ya, nyala bentar, sebentar, flash, langsung mati', 'leads_to' => 'AIOG005', 'order' => 8],

    // === DISPLAY (8) ===
    ['category' => 'Display', 'question' => 'Apakah layar AIO sama sekali gelap total?', 'expected_keyword' => 'gelap total, mati, blank, tidak ada', 'leads_to' => 'AIOG016', 'order' => 1],
    ['category' => 'Display', 'question' => 'Apakah ada gambar samar jika layar diterangi senter kuat?', 'expected_keyword' => 'ya, ada samar, terlihat gambar, ada bayangan', 'leads_to' => 'AIOG025', 'order' => 2],
    ['category' => 'Display', 'question' => 'Apakah gambar muncul atau berubah saat body AIO ditekan-tekan?', 'expected_keyword' => 'ya, muncul ditekan, berubah disentuh, kabel flex', 'leads_to' => 'AIOG026', 'order' => 3],
    ['category' => 'Display', 'question' => 'Apakah ada retakan fisik pada panel layar AIO?', 'expected_keyword' => 'ya, retak, pecah, crack, rusak fisik', 'leads_to' => 'AIOG020', 'order' => 4],
    ['category' => 'Display', 'question' => 'Apakah layar bergaris secara konsisten?', 'expected_keyword' => 'ya, bergaris, garis-garis, stripe vertikal', 'leads_to' => 'AIOG017', 'order' => 5],
    ['category' => 'Display', 'question' => 'Apakah muncul artefak atau kotak warna acak di layar?', 'expected_keyword' => 'ya, artefak, kotak warna, glitch, visual aneh', 'leads_to' => 'AIOG027', 'order' => 6],
    ['category' => 'Display', 'question' => 'Apakah masalah layar muncul setelah update driver?', 'expected_keyword' => 'ya, setelah update, habis update driver', 'leads_to' => 'AIOG028', 'order' => 7],
    ['category' => 'Display', 'question' => 'Apakah layar menyala setengah saja?', 'expected_keyword' => 'ya, setengah, sebagian, half screen', 'leads_to' => 'AIOG024', 'order' => 8],

    // === TOUCHSCREEN (7) ===
    ['category' => 'Touchscreen', 'question' => 'Apakah touchscreen AIO sama sekali tidak merespon sentuhan?', 'expected_keyword' => 'ya, tidak respon, mati total, tidak bisa disentuh', 'leads_to' => 'AIOG031', 'order' => 1],
    ['category' => 'Touchscreen', 'question' => 'Apakah touchscreen bergerak atau klik sendiri tanpa disentuh?', 'expected_keyword' => 'ya, klik sendiri, gerak sendiri, ghost touch', 'leads_to' => 'AIOG032', 'order' => 2],
    ['category' => 'Touchscreen', 'question' => 'Apakah hanya area tertentu dari touchscreen yang tidak responsif?', 'expected_keyword' => 'ya, sebagian, area tertentu, pojok tidak bisa', 'leads_to' => 'AIOG033', 'order' => 3],
    ['category' => 'Touchscreen', 'question' => 'Apakah sentuhan meleset dari target yang disentuh?', 'expected_keyword' => 'ya, meleset, tidak tepat, offset, geser', 'leads_to' => 'AIOG034', 'order' => 4],
    ['category' => 'Touchscreen', 'question' => 'Apakah touchscreen tidak terdeteksi di Device Manager?', 'expected_keyword' => 'ya, tidak ada, tidak terdeteksi, hilang', 'leads_to' => 'AIOG036', 'order' => 5],
    ['category' => 'Touchscreen', 'question' => 'Apakah masalah muncul setelah ganti panel layar?', 'expected_keyword' => 'ya, setelah ganti layar, habis servis panel', 'leads_to' => 'AIOG039', 'order' => 6],
    ['category' => 'Touchscreen', 'question' => 'Apakah masalah muncul setelah update Windows?', 'expected_keyword' => 'ya, setelah update, habis update windows', 'leads_to' => 'AIOG037', 'order' => 7],

    // === MOTHERBOARD (8) ===
    ['category' => 'Motherboard', 'question' => 'Apakah AIO menampilkan apapun (logo BIOS) saat dinyalakan?', 'expected_keyword' => 'tidak, blank, tidak ada logo, tidak POST', 'leads_to' => 'AIOG043', 'order' => 1],
    ['category' => 'Motherboard', 'question' => 'Apakah ada bunyi beep dari AIO saat dinyalakan?', 'expected_keyword' => 'ya, beep, bunyi beep, berbunyi', 'leads_to' => 'AIOG057', 'order' => 2],
    ['category' => 'Motherboard', 'question' => 'Apakah tanggal dan jam AIO selalu reset setiap dinyalakan?', 'expected_keyword' => 'ya, tanggal salah, reset terus, 1980 atau 2000', 'leads_to' => 'AIOG044', 'order' => 3],
    ['category' => 'Motherboard', 'question' => 'Apakah ada bau hangus dari dalam body AIO?', 'expected_keyword' => 'ya, bau, hangus, terbakar, gosong', 'leads_to' => 'AIOG047', 'order' => 4],
    ['category' => 'Motherboard', 'question' => 'Apakah terlihat komponen fisik rusak di motherboard AIO?', 'expected_keyword' => 'ya, kembung, terbakar, rusak fisik, komponen hangus', 'leads_to' => 'AIOG049', 'order' => 5],
    ['category' => 'Motherboard', 'question' => 'Apakah beberapa port USB di body AIO tidak berfungsi?', 'expected_keyword' => 'ya, usb mati, beberapa port mati', 'leads_to' => 'AIOG045', 'order' => 6],
    ['category' => 'Motherboard', 'question' => 'Apakah WiFi dan LAN AIO sama-sama tidak berfungsi?', 'expected_keyword' => 'ya, wifi dan lan mati, keduanya bermasalah', 'leads_to' => 'AIOG052', 'order' => 7],
    ['category' => 'Motherboard', 'question' => 'Apakah BIOS pernah di-flash sebelum bermasalah?', 'expected_keyword' => 'ya, flash bios, update bios, setelah update uefi', 'leads_to' => 'AIOG053', 'order' => 8],

    // === CPU (6) ===
    ['category' => 'CPU', 'question' => 'Berapa suhu CPU AIO saat idle (pakai HWiNFO)?', 'expected_keyword' => 'lebih 60, 70an, panas, tinggi, tidak normal', 'leads_to' => 'AIOG063', 'order' => 1],
    ['category' => 'CPU', 'question' => 'Apakah kipas internal AIO masih terdengar berputar?', 'expected_keyword' => 'tidak, diam, tidak bunyi, tidak berputar', 'leads_to' => 'AIOG064', 'order' => 2],
    ['category' => 'CPU', 'question' => 'Apakah thermal paste sudah pernah diganti?', 'expected_keyword' => 'belum, tidak pernah, lama, sudah bertahun', 'leads_to' => 'AIOG065', 'order' => 3],
    ['category' => 'CPU', 'question' => 'Apakah AIO menjadi sangat lambat setelah pemakaian beberapa menit?', 'expected_keyword' => 'ya, makin lambat, lambat setelah sebentar, throttle', 'leads_to' => 'AIOG059', 'order' => 4],
    ['category' => 'CPU', 'question' => 'Apakah CPU AIO terdeteksi di BIOS?', 'expected_keyword' => 'tidak, tidak terdeteksi, hilang, kosong di bios', 'leads_to' => 'AIOG061', 'order' => 5],
    ['category' => 'CPU', 'question' => 'Apakah AIO pernah dibuka dan sistem pendingin dibersihkan?', 'expected_keyword' => 'belum, tidak pernah, sudah lama', 'leads_to' => 'AIOG065', 'order' => 6],

    // === RAM SO-DIMM (7) ===
    ['category' => 'RAM SO-DIMM', 'question' => 'Apakah AIO bisa POST normal sebelum upgrade RAM?', 'expected_keyword' => 'ya, sebelumnya normal, bisa post, baru upgrade', 'leads_to' => 'AIOG074', 'order' => 1],
    ['category' => 'RAM SO-DIMM', 'question' => 'Apakah sudah menjalankan Memtest86?', 'expected_keyword' => 'sudah, ada error, fail, error memtest', 'leads_to' => 'AIOG073', 'order' => 2],
    ['category' => 'RAM SO-DIMM', 'question' => 'Apakah kapasitas RAM yang terbaca sesuai yang terpasang?', 'expected_keyword' => 'tidak, kurang, setengah, salah kapasitas', 'leads_to' => 'AIOG071', 'order' => 3],
    ['category' => 'RAM SO-DIMM', 'question' => 'Apakah kontak SO-DIMM terlihat kusam atau kotor?', 'expected_keyword' => 'ya, kusam, kotor, kecoklatan', 'leads_to' => 'AIOG077', 'order' => 4],
    ['category' => 'RAM SO-DIMM', 'question' => 'Apakah sudah coba RAM di slot SO-DIMM yang berbeda?', 'expected_keyword' => 'belum, belum coba slot lain', 'leads_to' => 'AIOG076', 'order' => 5],
    ['category' => 'RAM SO-DIMM', 'question' => 'Apakah AIO BSOD dengan kode memory management?', 'expected_keyword' => 'ya, memory management, page fault, bsod ram', 'leads_to' => 'AIOG070', 'order' => 6],
    ['category' => 'RAM SO-DIMM', 'question' => 'Apakah RAM yang dipasang sesuai spesifikasi dari vendor AIO?', 'expected_keyword' => 'tidak tahu, tidak cek, mungkin tidak cocok', 'leads_to' => 'AIOG074', 'order' => 7],

    // === STORAGE (7) ===
    ['category' => 'Storage', 'question' => 'Apakah storage AIO berupa HDD 2.5" atau SSD?', 'expected_keyword' => 'hdd, hard disk, ada bunyi berputar', 'leads_to' => 'AIOG082', 'order' => 1],
    ['category' => 'Storage', 'question' => 'Apakah terdengar bunyi klik dari area storage?', 'expected_keyword' => 'ya, klik, bunyi, clicking, grinding', 'leads_to' => 'AIOG082', 'order' => 2],
    ['category' => 'Storage', 'question' => 'Apakah CrystalDiskInfo menampilkan warning atau bad health?', 'expected_keyword' => 'ya, warning, caution, bad, merah, reallocated', 'leads_to' => 'AIOG084', 'order' => 3],
    ['category' => 'Storage', 'question' => 'Apakah menggunakan NVMe M.2?', 'expected_keyword' => 'ya, nvme, m.2, solid state pcie', 'leads_to' => 'AIOG087', 'order' => 4],
    ['category' => 'Storage', 'question' => 'Apakah ada partisi yang tiba-tiba hilang?', 'expected_keyword' => 'ya, hilang, tidak ada, lenyap', 'leads_to' => 'AIOG088', 'order' => 5],
    ['category' => 'Storage', 'question' => 'Apakah storage kadang terdeteksi kadang tidak?', 'expected_keyword' => 'ya, kadang muncul, intermittent, tidak konsisten', 'leads_to' => 'AIOG090', 'order' => 6],
    ['category' => 'Storage', 'question' => 'Apakah SSD tiba-tiba jadi read-only?', 'expected_keyword' => 'ya, read only, tidak bisa nulis, write protected', 'leads_to' => 'AIOG089', 'order' => 7],

    // === THERMAL (7) ===
    ['category' => 'Thermal', 'question' => 'Apakah bagian belakang body AIO terasa sangat panas?', 'expected_keyword' => 'ya, panas, kepanasan, sangat panas, tidak nyaman dipegang', 'leads_to' => 'AIOG093', 'order' => 1],
    ['category' => 'Thermal', 'question' => 'Apakah kipas internal AIO masih terdengar berputar?', 'expected_keyword' => 'tidak, diam, tidak bunyi, tidak berputar', 'leads_to' => 'AIOG095', 'order' => 2],
    ['category' => 'Thermal', 'question' => 'Apakah lubang ventilasi AIO terlihat kotor atau tersumbat debu?', 'expected_keyword' => 'ya, debu, kotor, tersumbat, debu banyak', 'leads_to' => 'AIOG099', 'order' => 3],
    ['category' => 'Thermal', 'question' => 'Apakah thermal paste pernah diganti?', 'expected_keyword' => 'belum, tidak pernah, sudah lama, tidak tahu', 'leads_to' => 'AIOG100', 'order' => 4],
    ['category' => 'Thermal', 'question' => 'Apakah performa AIO makin lambat setelah berjalan beberapa menit?', 'expected_keyword' => 'ya, makin lambat, throttle, turun performa', 'leads_to' => 'AIOG098', 'order' => 5],
    ['category' => 'Thermal', 'question' => 'Apakah ada bunyi aneh dari dalam AIO saat kipas berputar?', 'expected_keyword' => 'ya, bunyi, grinding, berisik, suara aneh', 'leads_to' => 'AIOG102', 'order' => 6],
    ['category' => 'Thermal', 'question' => 'Apakah AIO pernah mati sendiri karena terlalu panas?', 'expected_keyword' => 'ya, mati panas, thermal shutdown, mati kepanasan', 'leads_to' => 'AIOG096', 'order' => 7],

    // === AUDIO (6) ===
    ['category' => 'Audio', 'question' => 'Apakah audio device terdeteksi di Device Manager?', 'expected_keyword' => 'tidak, hilang, tidak terdeteksi, no device', 'leads_to' => 'AIOG111', 'order' => 1],
    ['category' => 'Audio', 'question' => 'Apakah masalah audio muncul setelah update Windows?', 'expected_keyword' => 'ya, setelah update, habis update windows', 'leads_to' => 'AIOG113', 'order' => 2],
    ['category' => 'Audio', 'question' => 'Apakah suara hanya keluar dari satu speaker?', 'expected_keyword' => 'ya, sebelah, satu speaker, kiri saja, kanan saja', 'leads_to' => 'AIOG112', 'order' => 3],
    ['category' => 'Audio', 'question' => 'Apakah jack headphone 3.5mm juga tidak berfungsi?', 'expected_keyword' => 'ya, jack mati, headphone tidak bunyi', 'leads_to' => 'AIOG109', 'order' => 4],
    ['category' => 'Audio', 'question' => 'Apakah mikrofon built-in AIO tidak terdeteksi?', 'expected_keyword' => 'ya, mic tidak ada, mic tidak terdeteksi', 'leads_to' => 'AIOG110', 'order' => 5],
    ['category' => 'Audio', 'question' => 'Apakah ada dengung atau hum terus-menerus dari speaker?', 'expected_keyword' => 'ya, dengung, hum, noise terus', 'leads_to' => 'AIOG114', 'order' => 6],

    // === KONEKTIVITAS (6) ===
    ['category' => 'Konektivitas', 'question' => 'Apakah WiFi terdeteksi di Device Manager AIO?', 'expected_keyword' => 'tidak, tidak ada, hilang, tidak terdeteksi', 'leads_to' => 'AIOG125', 'order' => 1],
    ['category' => 'Konektivitas', 'question' => 'Apakah WiFi dan Bluetooth sama-sama bermasalah?', 'expected_keyword' => 'ya, keduanya, wifi dan bt, semua wireless mati', 'leads_to' => 'AIOG120', 'order' => 2],
    ['category' => 'Konektivitas', 'question' => 'Apakah sinyal WiFi sangat lemah meski router dekat?', 'expected_keyword' => 'ya, lemah, bar sedikit, jangkauan pendek', 'leads_to' => 'AIOG121', 'order' => 3],
    ['category' => 'Konektivitas', 'question' => 'Apakah masalah muncul setelah update Windows?', 'expected_keyword' => 'ya, setelah update, habis update', 'leads_to' => 'AIOG128', 'order' => 4],
    ['category' => 'Konektivitas', 'question' => 'Apakah LAN kabel juga tidak berfungsi?', 'expected_keyword' => 'ya, lan juga mati, ethernet juga bermasalah', 'leads_to' => 'AIOG119', 'order' => 5],
    ['category' => 'Konektivitas', 'question' => 'Apakah WiFi terhubung tapi tidak ada akses internet?', 'expected_keyword' => 'ya, connected no internet, limited connection', 'leads_to' => 'AIOG123', 'order' => 6],

    // === WEBCAM (6) ===
    ['category' => 'Webcam', 'question' => 'Apakah kamera AIO terdeteksi di Device Manager?', 'expected_keyword' => 'tidak, hilang, tidak ada, tidak terdeteksi', 'leads_to' => 'AIOG130', 'order' => 1],
    ['category' => 'Webcam', 'question' => 'Apakah AIO memiliki privacy shutter fisik pada kamera?', 'expected_keyword' => 'ya, ada penutup, shutter, ada slider', 'leads_to' => 'AIOG133', 'order' => 2],
    ['category' => 'Webcam', 'question' => 'Apakah LED indikator kamera menyala saat diakses aplikasi?', 'expected_keyword' => 'tidak, mati, tidak nyala', 'leads_to' => 'AIOG134', 'order' => 3],
    ['category' => 'Webcam', 'question' => 'Apakah kamera menampilkan layar hitam saat dibuka?', 'expected_keyword' => 'ya, hitam, blank, tidak ada gambar', 'leads_to' => 'AIOG132', 'order' => 4],
    ['category' => 'Webcam', 'question' => 'Apakah sudah cek izin kamera di Settings > Privacy?', 'expected_keyword' => 'belum, tidak tahu, belum cek', 'leads_to' => 'AIOG135', 'order' => 5],
    ['category' => 'Webcam', 'question' => 'Apakah kamera bermasalah di semua aplikasi atau hanya satu?', 'expected_keyword' => 'semua aplikasi, semua app, tidak di mana-mana', 'leads_to' => 'AIOG129', 'order' => 6],

    // === PERIPHERAL (6) ===
    ['category' => 'Peripheral', 'question' => 'Apakah semua port USB AIO tidak berfungsi?', 'expected_keyword' => 'ya, semua, semuanya mati, seluruh port', 'leads_to' => 'AIOG146', 'order' => 1],
    ['category' => 'Peripheral', 'question' => 'Apakah keyboard dan mouse wireless bawaan AIO tidak berfungsi?', 'expected_keyword' => 'ya, keyboard mati, mouse mati, tidak bisa input', 'leads_to' => 'AIOG143', 'order' => 2],
    ['category' => 'Peripheral', 'question' => 'Apakah USB bisa charging tapi tidak transfer data?', 'expected_keyword' => 'ya, hanya cas, charging only, tidak bisa copy data', 'leads_to' => 'AIOG147', 'order' => 3],
    ['category' => 'Peripheral', 'question' => 'Apakah port HDMI output untuk monitor eksternal tidak berfungsi?', 'expected_keyword' => 'ya, hdmi out mati, tidak bisa ke monitor lain', 'leads_to' => 'AIOG141', 'order' => 4],
    ['category' => 'Peripheral', 'question' => 'Apakah hanya beberapa atau semua port USB yang bermasalah?', 'expected_keyword' => 'semua, seluruh port, total mati', 'leads_to' => 'AIOG146', 'order' => 5],
    ['category' => 'Peripheral', 'question' => 'Apakah sudah coba reinstall USB controller di Device Manager?', 'expected_keyword' => 'belum, tidak, belum dicoba', 'leads_to' => 'AIOG139', 'order' => 6],

    // === SOFTWARE (7) ===
    ['category' => 'Software', 'question' => 'Apakah Windows bisa masuk ke Safe Mode?', 'expected_keyword' => 'ya, bisa, berhasil, masuk safe mode', 'leads_to' => 'AIOG153', 'order' => 1],
    ['category' => 'Software', 'question' => 'Apakah AIO masuk ke repair loop terus-menerus?', 'expected_keyword' => 'ya, repair terus, loop, tidak bisa masuk windows', 'leads_to' => 'AIOG158', 'order' => 2],
    ['category' => 'Software', 'question' => 'Apakah antivirus mendeteksi ancaman atau virus?', 'expected_keyword' => 'ya, ada virus, malware, terdeteksi', 'leads_to' => 'AIOG152', 'order' => 3],
    ['category' => 'Software', 'question' => 'Apakah masalah muncul setelah update Windows atau driver?', 'expected_keyword' => 'ya, setelah update, habis update', 'leads_to' => 'AIOG156', 'order' => 4],
    ['category' => 'Software', 'question' => 'Apakah drive menampilkan RAW di Disk Management?', 'expected_keyword' => 'ya, raw, tidak bisa diakses, unknown', 'leads_to' => 'AIOG157', 'order' => 5],
    ['category' => 'Software', 'question' => 'Apakah banyak aplikasi OEM bawaan AIO berjalan di startup?', 'expected_keyword' => 'ya, banyak, vendor app, software bawaan banyak', 'leads_to' => 'AIOG155', 'order' => 6],
    ['category' => 'Software', 'question' => 'Apakah fitur Factory Reset AIO tidak berfungsi?', 'expected_keyword' => 'ya, tidak bisa reset, recovery error', 'leads_to' => 'AIOG160', 'order' => 7],

    // === DIFFERENTIAL (30) ===
    ['category' => 'Differential', 'question' => 'Apakah masalah terjadi setelah upgrade RAM SO-DIMM atau storage AIO?', 'expected_keyword' => 'ya, setelah upgrade, habis ganti, pasang baru', 'leads_to' => 'AIOG163', 'order' => 1],
    ['category' => 'Differential', 'question' => 'Apakah masalah terjadi setelah update Windows atau driver?', 'expected_keyword' => 'ya, setelah update, habis update', 'leads_to' => 'AIOG164', 'order' => 2],
    ['category' => 'Differential', 'question' => 'Apakah masalah tetap ada setelah reinstall Windows?', 'expected_keyword' => 'ya, masih ada, hardware problem, reinstall tidak membantu', 'leads_to' => 'AIOG173', 'order' => 3],
    ['category' => 'Differential', 'question' => 'Apakah AIO pernah terkena air atau cairan?', 'expected_keyword' => 'ya, kena air, basah, tumpahan, water damage', 'leads_to' => 'AIOG169', 'order' => 4],
    ['category' => 'Differential', 'question' => 'Apakah AIO pernah jatuh atau terkena benturan?', 'expected_keyword' => 'ya, jatuh, terbentur, drop, banting', 'leads_to' => 'AIOG166', 'order' => 5],
    ['category' => 'Differential', 'question' => 'Apakah masalah hanya muncul saat AIO sudah panas?', 'expected_keyword' => 'ya, saat panas, thermal, setelah lama dipakai', 'leads_to' => 'AIOG168', 'order' => 6],
    ['category' => 'Differential', 'question' => 'Apakah masalah muncul di semua OS termasuk Linux live USB?', 'expected_keyword' => 'ya, linux juga, semua os, bukan windows saja', 'leads_to' => 'AIOG174', 'order' => 7],
    ['category' => 'Differential', 'question' => 'Apakah BIOS/UEFI AIO menampilkan error atau komponen tidak terdeteksi?', 'expected_keyword' => 'ya, bios error, tidak terdeteksi, post error', 'leads_to' => 'AIOG185', 'order' => 8],
    ['category' => 'Differential', 'question' => 'Apakah adaptor AIO original atau pengganti?', 'expected_keyword' => 'pengganti, non original, adaptor lain, tidak tahu', 'leads_to' => 'AIOG187', 'order' => 9],
    ['category' => 'Differential', 'question' => 'Apakah AIO baru dibeli dan langsung bermasalah?', 'expected_keyword' => 'ya, baru beli, masih baru, dari toko langsung error', 'leads_to' => 'AIOG176', 'order' => 10],
    ['category' => 'Differential', 'question' => 'Apakah semua fitur AIO (layar, touch, audio, USB) bermasalah?', 'expected_keyword' => 'ya, semuanya, total, semua tidak jalan', 'leads_to' => 'AIOG177', 'order' => 11],
    ['category' => 'Differential', 'question' => 'Apakah masalah terjadi setelah AIO diservis atau dibuka?', 'expected_keyword' => 'ya, setelah servis, habis dibuka, habis bersih', 'leads_to' => 'AIOG165', 'order' => 12],
    ['category' => 'Differential', 'question' => 'Apakah masalah terjadi secara acak tanpa pola?', 'expected_keyword' => 'ya, acak, random, tidak tentu, kadang-kadang', 'leads_to' => 'AIOG183', 'order' => 13],
    ['category' => 'Differential', 'question' => 'Apakah masalah muncul setelah ganti panel atau layar AIO?', 'expected_keyword' => 'ya, setelah ganti layar, habis ganti panel', 'leads_to' => 'AIOG178', 'order' => 14],
    ['category' => 'Differential', 'question' => 'Apakah stress test (CPU/GPU benchmark) menunjukkan error?', 'expected_keyword' => 'ya, crash, error, gagal test benchmark', 'leads_to' => 'AIOG179', 'order' => 15],
    ['category' => 'Differential', 'question' => 'Apakah ruangan tempat AIO digunakan panas atau lembab?', 'expected_keyword' => 'ya, panas, lembab, tidak ada ac, humid', 'leads_to' => 'AIOG180', 'order' => 16],
    ['category' => 'Differential', 'question' => 'Apakah masalah hanya pada fitur spesifik AIO (touch, kamera, dll)?', 'expected_keyword' => 'ya, hanya touch, hanya kamera, fitur tertentu', 'leads_to' => 'AIOG175', 'order' => 17],
    ['category' => 'Differential', 'question' => 'Apakah masalah terjadi setelah install driver atau software dari vendor AIO?', 'expected_keyword' => 'ya, setelah install driver vendor, software oem', 'leads_to' => 'AIOG182', 'order' => 18],
    ['category' => 'Differential', 'question' => 'Apakah AIO sudah digunakan lebih dari 5 tahun?', 'expected_keyword' => 'ya, sudah lama, lebih 5 tahun, sudah tua', 'leads_to' => 'AIOG192', 'order' => 19],
    ['category' => 'Differential', 'question' => 'Apakah komponen baru yang dipasang sudah diuji sebelum dipasang?', 'expected_keyword' => 'belum, tidak, langsung pasang, baru dari toko', 'leads_to' => 'AIOG181', 'order' => 20],
    ['category' => 'Differential', 'question' => 'Apakah AIO awalnya berfungsi normal tapi bermasalah setelah lama menyala?', 'expected_keyword' => 'ya, awal ok, muncul setelah lama, makin panas makin error', 'leads_to' => 'AIOG188', 'order' => 21],
    ['category' => 'Differential', 'question' => 'Apakah AIO mengalami masalah di lebih dari satu komponen sekaligus?', 'expected_keyword' => 'ya, banyak masalah, multiple issue, banyak yang rusak', 'leads_to' => 'AIOG190', 'order' => 22],
    ['category' => 'Differential', 'question' => 'Apakah masalah hanya saat menjalankan aplikasi berat tertentu?', 'expected_keyword' => 'ya, hanya saat edit, hanya saat render, aplikasi tertentu', 'leads_to' => 'AIOG189', 'order' => 23],
    ['category' => 'Differential', 'question' => 'Apakah AIO sering mati mendadak tanpa pola yang jelas?', 'expected_keyword' => 'ya, sering mati, random shutdown, tidak ada pola', 'leads_to' => 'AIOG183', 'order' => 24],
    ['category' => 'Differential', 'question' => 'Apakah AIO terasa makin lambat dari tahun ke tahun?', 'expected_keyword' => 'ya, makin lambat, degradasi, sudah lama lambat', 'leads_to' => 'AIOG184', 'order' => 25],
    ['category' => 'Differential', 'question' => 'Apakah adaptor original AIO hilang atau tidak ada?', 'expected_keyword' => 'ya, hilang, tidak ada, pakai adaptor lain', 'leads_to' => 'AIOG187', 'order' => 26],
    ['category' => 'Differential', 'question' => 'Apakah masalah muncul di lingkungan yang sangat berdebu?', 'expected_keyword' => 'ya, berdebu, kotor, banyak debu', 'leads_to' => 'AIOG165', 'order' => 27],
    ['category' => 'Differential', 'question' => 'Apakah masalah terjadi setelah adaptor diganti ke non-original?', 'expected_keyword' => 'ya, ganti adaptor, adaptor kw, bukan original', 'leads_to' => 'AIOG167', 'order' => 28],
    ['category' => 'Differential', 'question' => 'Apakah AIO mengalami masalah makin parah seiring waktu?', 'expected_keyword' => 'ya, makin parah, bertahap, progressive', 'leads_to' => 'AIOG170', 'order' => 29],
    ['category' => 'Differential', 'question' => 'Apakah AIO pernah digunakan di lingkungan dengan kelembaban tinggi?', 'expected_keyword' => 'ya, lembab, humid, embun, kondisi basah', 'leads_to' => 'AIOG191', 'order' => 30],
];
