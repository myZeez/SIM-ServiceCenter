<?php

// Dataset PC Desktop (Custom Build) - 125 pertanyaan klarifikasi
// Pertanyaan untuk menggali gejala lebih dalam saat diagnosis
return [

    // === PSU (8) ===
    ['category' => 'PSU', 'question' => 'Apakah ada bau terbakar atau hangus dari area belakang PC?', 'expected_keyword' => 'ya, bau, hangus, gosong, terbakar', 'leads_to' => 'PCG005', 'order' => 1],
    ['category' => 'PSU', 'question' => 'Apakah kipas PSU masih berputar saat PC dinyalakan?', 'expected_keyword' => 'tidak, mati, diam, tidak berputar', 'leads_to' => 'PCG004', 'order' => 2],
    ['category' => 'PSU', 'question' => 'Apakah PC mati hanya saat menjalankan game atau aplikasi berat?', 'expected_keyword' => 'ya, gaming, render, load berat, full load', 'leads_to' => 'PCG008', 'order' => 3],
    ['category' => 'PSU', 'question' => 'Apakah watt PSU diketahui dan sudah cukup untuk semua komponen?', 'expected_keyword' => 'tidak cukup, tidak tahu, kecil, kurang watt', 'leads_to' => 'PCG015', 'order' => 4],
    ['category' => 'PSU', 'question' => 'Apakah semua kabel power internal sudah terpasang kencang?', 'expected_keyword' => 'tidak, ada yang longgar, belum cek', 'leads_to' => 'PCG009', 'order' => 5],
    ['category' => 'PSU', 'question' => 'Apakah PC nyala jika salah satu komponen dilepas?', 'expected_keyword' => 'ya, nyala tanpa gpu, menyala tanpa yang ini', 'leads_to' => 'PCG020', 'order' => 6],
    ['category' => 'PSU', 'question' => 'Apakah PC mati tiba-tiba lalu tidak bisa dinyalakan kembali?', 'expected_keyword' => 'ya, mati total, tidak bisa nyala lagi', 'leads_to' => 'PCG002', 'order' => 7],
    ['category' => 'PSU', 'question' => 'Apakah ada listrik mati mendadak sebelum PC bermasalah?', 'expected_keyword' => 'ya, listrik mati, power failure, ups trip', 'leads_to' => 'PCG013', 'order' => 8],

    // === MOTHERBOARD (8) ===
    ['category' => 'Motherboard', 'question' => 'Apakah ada debug LED atau Q-Code yang menyala di motherboard?', 'expected_keyword' => 'ya, led merah, led kuning, q code, post code', 'leads_to' => 'PCG023', 'order' => 1],
    ['category' => 'Motherboard', 'question' => 'Apakah ada bunyi beep dari speaker internal saat dinyalakan?', 'expected_keyword' => 'ya, beep, bunyi, berbunyi', 'leads_to' => 'PCG022', 'order' => 2],
    ['category' => 'Motherboard', 'question' => 'Apakah tanggal dan waktu PC selalu reset setiap kali dinyalakan?', 'expected_keyword' => 'ya, tanggal salah, reset terus, 2000 atau 1980', 'leads_to' => 'PCG024', 'order' => 3],
    ['category' => 'Motherboard', 'question' => 'Apakah ada bau terbakar dari motherboard atau dalam casing?', 'expected_keyword' => 'ya, bau, terbakar, hangus, gosong', 'leads_to' => 'PCG028', 'order' => 4],
    ['category' => 'Motherboard', 'question' => 'Apakah ada kapasitor yang kembung di motherboard?', 'expected_keyword' => 'ya, kembung, bengkak, bulat, menonjol', 'leads_to' => 'PCG029', 'order' => 5],
    ['category' => 'Motherboard', 'question' => 'Apakah BIOS pernah di-flash atau diupdate sebelum bermasalah?', 'expected_keyword' => 'ya, setelah flash, habis update bios, gagal update', 'leads_to' => 'PCG034', 'order' => 6],
    ['category' => 'Motherboard', 'question' => 'Apakah semua port USB/LAN/audio di panel belakang bermasalah?', 'expected_keyword' => 'ya, semuanya, semua belakang, rear panel semua', 'leads_to' => 'PCG026', 'order' => 7],
    ['category' => 'Motherboard', 'question' => 'Apakah GPU atau RAM terdeteksi di BIOS?', 'expected_keyword' => 'tidak, tidak terdeteksi, hilang dari bios', 'leads_to' => 'PCG021', 'order' => 8],

    // === CPU (8) ===
    ['category' => 'CPU', 'question' => 'Berapa suhu CPU saat idle menurut HWiNFO / HWMonitor?', 'expected_keyword' => 'lebih 60, 70an, 80, panas, tinggi', 'leads_to' => 'PCG052', 'order' => 1],
    ['category' => 'CPU', 'question' => 'Apakah fan/kipas cooler CPU masih berputar?', 'expected_keyword' => 'tidak, mati, diam, tidak jalan', 'leads_to' => 'PCG050', 'order' => 2],
    ['category' => 'CPU', 'question' => 'Apakah thermal paste sudah pernah diganti?', 'expected_keyword' => 'belum, tidak pernah, lama, tahun lalu', 'leads_to' => 'PCG048', 'order' => 3],
    ['category' => 'CPU', 'question' => 'Apakah cooler CPU terpasang kencang dan tidak goyang?', 'expected_keyword' => 'tidak, goyang, longgar, miring', 'leads_to' => 'PCG049', 'order' => 4],
    ['category' => 'CPU', 'question' => 'Apakah ada pin bengkok di socket LGA motherboard?', 'expected_keyword' => 'ya, bengkok, bent, patah, rusak', 'leads_to' => 'PCG051', 'order' => 5],
    ['category' => 'CPU', 'question' => 'Apakah PC menggunakan overclock CPU?', 'expected_keyword' => 'ya, oc, overclock, manual voltage', 'leads_to' => 'PCG047', 'order' => 6],
    ['category' => 'CPU', 'question' => 'Apakah CPU terdeteksi di BIOS/UEFI?', 'expected_keyword' => 'tidak, tidak terdeteksi, hilang, kosong', 'leads_to' => 'PCG044', 'order' => 7],
    ['category' => 'CPU', 'question' => 'Apakah cooler yang digunakan support socket yang dipakai?', 'expected_keyword' => 'tidak cocok, tidak support, beda socket, mounting salah', 'leads_to' => 'PCG056', 'order' => 8],

    // === RAM DIMM (8) ===
    ['category' => 'RAM DIMM', 'question' => 'Apakah sudah menjalankan Memtest86 untuk cek memori?', 'expected_keyword' => 'sudah, ada error, fail, memtest error', 'leads_to' => 'PCG065', 'order' => 1],
    ['category' => 'RAM DIMM', 'question' => 'Apakah RAM sudah dipasang di slot yang benar untuk dual channel?', 'expected_keyword' => 'tidak, satu slot, slot salah, tidak tahu', 'leads_to' => 'PCG070', 'order' => 2],
    ['category' => 'RAM DIMM', 'question' => 'Apakah XMP atau EXPO sudah diaktifkan di BIOS?', 'expected_keyword' => 'belum, tidak aktif, belum nyalakan xmp', 'leads_to' => 'PCG066', 'order' => 3],
    ['category' => 'RAM DIMM', 'question' => 'Apakah kontak/pin DIMM terlihat kusam atau kotor?', 'expected_keyword' => 'ya, kusam, kotor, kecoklatan, oksidasi', 'leads_to' => 'PCG071', 'order' => 4],
    ['category' => 'RAM DIMM', 'question' => 'Apakah PC bisa POST jika menggunakan satu modul RAM saja?', 'expected_keyword' => 'ya, bisa, posting, satu dimm jalan', 'leads_to' => 'PCG078', 'order' => 5],
    ['category' => 'RAM DIMM', 'question' => 'Apakah menggunakan dua kit RAM berbeda brand/speed?', 'expected_keyword' => 'ya, beda brand, beda speed, mixing', 'leads_to' => 'PCG074', 'order' => 6],
    ['category' => 'RAM DIMM', 'question' => 'Apakah PC BSOD dengan kode memory management?', 'expected_keyword' => 'ya, memory management, page fault, bsod ram', 'leads_to' => 'PCG062', 'order' => 7],
    ['category' => 'RAM DIMM', 'question' => 'Apakah kecepatan RAM sudah sesuai di CPU-Z atau Task Manager?', 'expected_keyword' => 'tidak, lebih pelan, tidak sesuai spec', 'leads_to' => 'PCG066', 'order' => 8],

    // === GPU DISKRIT (8) ===
    ['category' => 'GPU Diskrit', 'question' => 'Apakah GPU terdeteksi di Device Manager Windows?', 'expected_keyword' => 'tidak, tidak ada, hilang, unknown device', 'leads_to' => 'PCG079', 'order' => 1],
    ['category' => 'GPU Diskrit', 'question' => 'Apakah ada artefak atau glitch visual di layar saat gaming?', 'expected_keyword' => 'ya, artefak, kotak, glitch, visual aneh', 'leads_to' => 'PCG080', 'order' => 2],
    ['category' => 'GPU Diskrit', 'question' => 'Apakah semua fan GPU masih berputar?', 'expected_keyword' => 'tidak, ada yang mati, diam, tidak berputar', 'leads_to' => 'PCG083', 'order' => 3],
    ['category' => 'GPU Diskrit', 'question' => 'Berapa suhu GPU saat gaming (MSI Afterburner / HWiNFO)?', 'expected_keyword' => 'lebih 90, 90an, sangat panas, overheat', 'leads_to' => 'PCG082', 'order' => 4],
    ['category' => 'GPU Diskrit', 'question' => 'Apakah konektor power PCIe (8-pin / 12-pin) sudah terpasang?', 'expected_keyword' => 'tidak, lepas, belum pasang, longgar', 'leads_to' => 'PCG087', 'order' => 5],
    ['category' => 'GPU Diskrit', 'question' => 'Apakah driver GPU sudah di-clean install menggunakan DDU?', 'expected_keyword' => 'belum, tidak, belum pakai ddu', 'leads_to' => 'PCG085', 'order' => 6],
    ['category' => 'GPU Diskrit', 'question' => 'Apakah thermal paste GPU sudah lama tidak diganti?', 'expected_keyword' => 'ya, lama, belum pernah, tidak tahu kapan', 'leads_to' => 'PCG088', 'order' => 7],
    ['category' => 'GPU Diskrit', 'question' => 'Apakah GPU berfungsi normal di slot PCIe lain atau PC lain?', 'expected_keyword' => 'belum dicoba, tidak diuji, ya bisa di pc lain', 'leads_to' => 'PCG089', 'order' => 8],

    // === STORAGE (8) ===
    ['category' => 'Storage', 'question' => 'Apakah terdengar bunyi klik-klik dari area HDD?', 'expected_keyword' => 'ya, klik, bunyi, clicking, grinding', 'leads_to' => 'PCG100', 'order' => 1],
    ['category' => 'Storage', 'question' => 'Apakah CrystalDiskInfo menampilkan warning atau bad health?', 'expected_keyword' => 'ya, warning, caution, bad, merah, reallocated', 'leads_to' => 'PCG102', 'order' => 2],
    ['category' => 'Storage', 'question' => 'Apakah storage HDD (3.5") atau SSD?', 'expected_keyword' => 'ssd, solid state, tidak ada bunyi', 'leads_to' => 'PCG108', 'order' => 3],
    ['category' => 'Storage', 'question' => 'Apakah menggunakan NVMe M.2?', 'expected_keyword' => 'ya, nvme, m.2, pcie ssd', 'leads_to' => 'PCG105', 'order' => 4],
    ['category' => 'Storage', 'question' => 'Apakah kabel SATA data sudah dicoba diganti?', 'expected_keyword' => 'belum, tidak, belum ganti kabel', 'leads_to' => 'PCG111', 'order' => 5],
    ['category' => 'Storage', 'question' => 'Apakah ada partisi yang tiba-tiba hilang?', 'expected_keyword' => 'ya, hilang, tidak ada, lenyap partisi', 'leads_to' => 'PCG107', 'order' => 6],
    ['category' => 'Storage', 'question' => 'Apakah drive terdeteksi intermittent (kadang muncul kadang tidak)?', 'expected_keyword' => 'ya, kadang muncul, tidak konsisten', 'leads_to' => 'PCG109', 'order' => 7],
    ['category' => 'Storage', 'question' => 'Apakah NVMe SSD memiliki heatsink terpasang?', 'expected_keyword' => 'tidak, tidak ada heatsink, tanpa pendingin', 'leads_to' => 'PCG115', 'order' => 8],

    // === CASING (6) ===
    ['category' => 'Casing', 'question' => 'Apakah tombol power tidak merespon sama sekali?', 'expected_keyword' => 'ya, tidak respon, tidak fungsi, mati', 'leads_to' => 'PCG119', 'order' => 1],
    ['category' => 'Casing', 'question' => 'Apakah port USB di panel depan casing tidak berfungsi?', 'expected_keyword' => 'ya, usb depan mati, front panel usb', 'leads_to' => 'PCG121', 'order' => 2],
    ['category' => 'Casing', 'question' => 'Apakah kabel front panel sudah terpasang di header yang benar?', 'expected_keyword' => 'tidak yakin, salah pasang, belum cek', 'leads_to' => 'PCG125', 'order' => 3],
    ['category' => 'Casing', 'question' => 'Apakah dust filter / saringan debu sangat kotor?', 'expected_keyword' => 'ya, kotor, tersumbat, debu banyak', 'leads_to' => 'PCG127', 'order' => 4],
    ['category' => 'Casing', 'question' => 'Apakah casing terasa nyetrum saat disentuh?', 'expected_keyword' => 'ya, kena setrum, kesemutan, electric', 'leads_to' => 'PCG133', 'order' => 5],
    ['category' => 'Casing', 'question' => 'Apakah PC menggunakan speaker internal untuk beep?', 'expected_keyword' => 'tidak, tidak ada speaker, belum pasang', 'leads_to' => 'PCG130', 'order' => 6],

    // === THERMAL (7) ===
    ['category' => 'Thermal', 'question' => 'Apakah debu menumpuk di heatsink CPU atau fan?', 'expected_keyword' => 'ya, debu, kotor, penuh debu', 'leads_to' => 'PCG138', 'order' => 1],
    ['category' => 'Thermal', 'question' => 'Apakah semua fan casing masih berputar?', 'expected_keyword' => 'tidak, ada yang mati, beberapa diam', 'leads_to' => 'PCG135', 'order' => 2],
    ['category' => 'Thermal', 'question' => 'Apakah PC menggunakan AIO liquid cooler?', 'expected_keyword' => 'ya, aio, liquid cooler, watercooling', 'leads_to' => 'PCG140', 'order' => 3],
    ['category' => 'Thermal', 'question' => 'Apakah ada tanda kebocoran cairan di dalam casing?', 'expected_keyword' => 'ya, bocor, ada cairan, coolant tumpah', 'leads_to' => 'PCG141', 'order' => 4],
    ['category' => 'Thermal', 'question' => 'Apakah PC menggunakan custom water cooling loop?', 'expected_keyword' => 'ya, custom loop, reservoir, hard tube', 'leads_to' => 'PCG142', 'order' => 5],
    ['category' => 'Thermal', 'question' => 'Apakah konfigurasi fan casing sudah optimal (positive pressure)?', 'expected_keyword' => 'belum, tidak tahu, asal pasang, negatif', 'leads_to' => 'PCG145', 'order' => 6],
    ['category' => 'Thermal', 'question' => 'Apakah PC mati sendiri saat suhu tinggi?', 'expected_keyword' => 'ya, mati panas, thermal shutdown, mati kepanasan', 'leads_to' => 'PCG137', 'order' => 7],

    // === AUDIO (6) ===
    ['category' => 'Audio', 'question' => 'Apakah audio device terdeteksi di Device Manager?', 'expected_keyword' => 'tidak, hilang, tidak terdeteksi', 'leads_to' => 'PCG151', 'order' => 1],
    ['category' => 'Audio', 'question' => 'Apakah menggunakan jack audio depan atau belakang?', 'expected_keyword' => 'depan, front panel, front audio', 'leads_to' => 'PCG153', 'order' => 2],
    ['category' => 'Audio', 'question' => 'Apakah masalah audio muncul setelah update Windows?', 'expected_keyword' => 'ya, setelah update, habis update', 'leads_to' => 'PCG156', 'order' => 3],
    ['category' => 'Audio', 'question' => 'Apakah menggunakan sound card PCIe tambahan?', 'expected_keyword' => 'ya, sound card, creative, asus xonar', 'leads_to' => 'PCG157', 'order' => 4],
    ['category' => 'Audio', 'question' => 'Apakah ada dengung atau hum terus-menerus dari speaker?', 'expected_keyword' => 'ya, dengung, hum, noise, terus-menerus', 'leads_to' => 'PCG158', 'order' => 5],
    ['category' => 'Audio', 'question' => 'Apakah audio hanya keluar dari satu sisi?', 'expected_keyword' => 'ya, mono, satu sisi, kiri saja, kanan saja', 'leads_to' => 'PCG155', 'order' => 6],

    // === NETWORK (6) ===
    ['category' => 'Network', 'question' => 'Apakah menggunakan LAN kabel atau WiFi card PCIe?', 'expected_keyword' => 'lan, kabel, ethernet', 'leads_to' => 'PCG164', 'order' => 1],
    ['category' => 'Network', 'question' => 'Apakah driver network terdeteksi di Device Manager?', 'expected_keyword' => 'tidak, hilang, tidak ada', 'leads_to' => 'PCG166', 'order' => 2],
    ['category' => 'Network', 'question' => 'Apakah port LAN terlihat rusak atau pin bengkok?', 'expected_keyword' => 'ya, rusak, bengkok, patah', 'leads_to' => 'PCG167', 'order' => 3],
    ['category' => 'Network', 'question' => 'Apakah WiFi card PCIe dipasang antena?', 'expected_keyword' => 'tidak, tanpa antena, antena tidak ada', 'leads_to' => 'PCG171', 'order' => 4],
    ['category' => 'Network', 'question' => 'Apakah perangkat lain di jaringan bisa internet normal?', 'expected_keyword' => 'ya, normal, bisa, hanya pc ini masalah', 'leads_to' => 'PCG164', 'order' => 5],
    ['category' => 'Network', 'question' => 'Apakah sudah coba ganti kabel LAN?', 'expected_keyword' => 'belum, tidak, belum coba ganti', 'leads_to' => 'PCG168', 'order' => 6],

    // === PERIPHERAL (6) ===
    ['category' => 'Peripheral', 'question' => 'Apakah semua port USB mati atau hanya sebagian?', 'expected_keyword' => 'semua, semuanya, seluruh port', 'leads_to' => 'PCG183', 'order' => 1],
    ['category' => 'Peripheral', 'question' => 'Apakah port USB yang bermasalah di panel depan atau belakang?', 'expected_keyword' => 'depan, front, panel depan casing', 'leads_to' => 'PCG179', 'order' => 2],
    ['category' => 'Peripheral', 'question' => 'Apakah kabel header USB 3.0 (19-pin) sudah terpasang ke motherboard?', 'expected_keyword' => 'longgar, lepas, belum pasang, tidak yakin', 'leads_to' => 'PCG191', 'order' => 3],
    ['category' => 'Peripheral', 'question' => 'Apakah perangkat yang dihubungkan berfungsi di PC lain?', 'expected_keyword' => 'tidak, rusak juga di pc lain, perangkat rusak', 'leads_to' => 'PCG180', 'order' => 4],
    ['category' => 'Peripheral', 'question' => 'Apakah USB 3.0 berjalan dengan kecepatan USB 2.0?', 'expected_keyword' => 'ya, lambat, transfer pelan, kayak usb 2', 'leads_to' => 'PCG184', 'order' => 5],
    ['category' => 'Peripheral', 'question' => 'Apakah USB hub besar yang terhubung tidak mendapat daya?', 'expected_keyword' => 'ya, hub tidak jalan, hub power kurang', 'leads_to' => 'PCG190', 'order' => 6],

    // === SOFTWARE (8) ===
    ['category' => 'Software', 'question' => 'Apakah BSOD menampilkan kode error tertentu (stop code)?', 'expected_keyword' => 'ya, ada kode, stop code, apa kodenya', 'leads_to' => 'PCG193', 'order' => 1],
    ['category' => 'Software', 'question' => 'Apakah antivirus mendeteksi ancaman atau malware?', 'expected_keyword' => 'ya, ada virus, terdeteksi, warning, malware', 'leads_to' => 'PCG195', 'order' => 2],
    ['category' => 'Software', 'question' => 'Apakah Windows bisa masuk ke Safe Mode?', 'expected_keyword' => 'ya, bisa, berhasil safe mode', 'leads_to' => 'PCG196', 'order' => 3],
    ['category' => 'Software', 'question' => 'Apakah hasil SFC /scannow menunjukkan file corrupt?', 'expected_keyword' => 'ya, ada error, corrupt, tidak bisa diperbaiki', 'leads_to' => 'PCG201', 'order' => 4],
    ['category' => 'Software', 'question' => 'Apakah drive menunjukkan RAW di Disk Management?', 'expected_keyword' => 'ya, raw, tidak terbaca, unknown', 'leads_to' => 'PCG204', 'order' => 5],
    ['category' => 'Software', 'question' => 'Apakah banyak program auto-start saat Windows menyala?', 'expected_keyword' => 'ya, banyak, startup panjang, task manager penuh', 'leads_to' => 'PCG197', 'order' => 6],
    ['category' => 'Software', 'question' => 'Apakah masalah muncul setelah update Windows atau driver?', 'expected_keyword' => 'ya, setelah update, habis update', 'leads_to' => 'PCG199', 'order' => 7],
    ['category' => 'Software', 'question' => 'Apakah Windows masuk ke repair loop terus menerus?', 'expected_keyword' => 'ya, repair terus, loop, tidak bisa masuk windows', 'leads_to' => 'PCG203', 'order' => 8],

    // === OVERCLOCKING (8) ===
    ['category' => 'Overclocking', 'question' => 'Apakah PC menggunakan overclock CPU (manual atau auto OC)?', 'expected_keyword' => 'ya, oc, overclock, manual voltage, multipler dinaikkan', 'leads_to' => 'PCG211', 'order' => 1],
    ['category' => 'Overclocking', 'question' => 'Apakah XMP atau EXPO sudah diaktifkan di BIOS?', 'expected_keyword' => 'ya, xmp aktif, expo aktif, sudah enable', 'leads_to' => 'PCG212', 'order' => 2],
    ['category' => 'Overclocking', 'question' => 'Apakah GPU menggunakan overclock (MSI Afterburner / EVGA Precision)?', 'expected_keyword' => 'ya, oc gpu, overclock vga, afterburner oc', 'leads_to' => 'PCG213', 'order' => 3],
    ['category' => 'Overclocking', 'question' => 'Apakah PC tidak bisa boot setelah mengubah setting BIOS OC?', 'expected_keyword' => 'ya, tidak bisa boot, brick, gagal setelah oc bios', 'leads_to' => 'PCG219', 'order' => 4],
    ['category' => 'Overclocking', 'question' => 'Berapa vcore CPU yang digunakan saat di-overclock?', 'expected_keyword' => 'lebih 1.35, 1.4, tinggi, tidak tahu', 'leads_to' => 'PCG216', 'order' => 5],
    ['category' => 'Overclocking', 'question' => 'Apakah suhu CPU sudah sangat tinggi saat di-overclock?', 'expected_keyword' => 'ya, panas, di atas 90, throttle', 'leads_to' => 'PCG218', 'order' => 6],
    ['category' => 'Overclocking', 'question' => 'Apakah BIOS sudah di-clear CMOS setelah OC bermasalah?', 'expected_keyword' => 'belum, tidak, belum clear cmos', 'leads_to' => 'PCG219', 'order' => 7],
    ['category' => 'Overclocking', 'question' => 'Apakah memory OC menyebabkan instabilitas?', 'expected_keyword' => 'ya, xmp crash, memtest fail setelah oc ram', 'leads_to' => 'PCG217', 'order' => 8],

    // === DIFFERENTIAL (30) ===
    ['category' => 'Differential', 'question' => 'Apakah masalah terjadi setelah memasang komponen baru (GPU/CPU/RAM)?', 'expected_keyword' => 'ya, setelah upgrade, habis pasang, komponen baru', 'leads_to' => 'PCG226', 'order' => 1],
    ['category' => 'Differential', 'question' => 'Apakah masalah tetap ada setelah reinstall Windows?', 'expected_keyword' => 'ya, masih ada, hardware problem, reinstall ga ngaruh', 'leads_to' => 'PCG234', 'order' => 2],
    ['category' => 'Differential', 'question' => 'Apakah masalah muncul di semua OS termasuk Linux live USB?', 'expected_keyword' => 'ya, linux juga, semua os, bukan windows saja', 'leads_to' => 'PCG235', 'order' => 3],
    ['category' => 'Differential', 'question' => 'Apakah masalah hanya saat beban CPU/GPU tinggi?', 'expected_keyword' => 'ya, gaming, rendering, encoding, full load', 'leads_to' => 'PCG231', 'order' => 4],
    ['category' => 'Differential', 'question' => 'Apakah BIOS / UEFI menampilkan error atau debug LED menyala?', 'expected_keyword' => 'ya, bios error, led merah, komponen tidak terdeteksi', 'leads_to' => 'PCG239', 'order' => 5],
    ['category' => 'Differential', 'question' => 'Apakah stress test (Prime95/FurMark/Memtest) menunjukkan error?', 'expected_keyword' => 'ya, crash, error, gagal, memtest fail', 'leads_to' => 'PCG240', 'order' => 6],
    ['category' => 'Differential', 'question' => 'Apakah listrik di lokasi PC stabil? Apakah menggunakan UPS?', 'expected_keyword' => 'tidak, tidak pakai ups, langsung pln, sering mati listrik', 'leads_to' => 'PCG254', 'order' => 7],
    ['category' => 'Differential', 'question' => 'Apakah PC menggunakan overclock (CPU/GPU/RAM)?', 'expected_keyword' => 'ya, oc, overclock, xmp agresif, manual voltage', 'leads_to' => 'PCG236', 'order' => 8],
    ['category' => 'Differential', 'question' => 'Apakah BSOD menampilkan kode WHEA_UNCORRECTABLE_ERROR?', 'expected_keyword' => 'ya, whea, machine check, hardware error', 'leads_to' => 'PCG251', 'order' => 9],
    ['category' => 'Differential', 'question' => 'Apakah PC ini baru pertama kali dirakit (first build)?', 'expected_keyword' => 'ya, baru rakit, first build, baru dirakit', 'leads_to' => 'PCG250', 'order' => 10],
    ['category' => 'Differential', 'question' => 'Apakah masalah hanya pada satu komponen / slot tertentu?', 'expected_keyword' => 'ya, hanya ini, satu komponen, slot tertentu', 'leads_to' => 'PCG237', 'order' => 11],
    ['category' => 'Differential', 'question' => 'Apakah masalah terjadi setelah listrik mati mendadak?', 'expected_keyword' => 'ya, mati listrik, power failure, ups trip', 'leads_to' => 'PCG230', 'order' => 12],
    ['category' => 'Differential', 'question' => 'Apakah PC stabil di Safe Mode tapi crash di mode normal?', 'expected_keyword' => 'ya, safe mode aman, normal crash, hanya safe mode ok', 'leads_to' => 'PCG244', 'order' => 13],
    ['category' => 'Differential', 'question' => 'Apakah komponen baru yang bermasalah sudah diuji di PC lain?', 'expected_keyword' => 'belum, tidak, baru langsung dipasang', 'leads_to' => 'PCG241', 'order' => 14],
    ['category' => 'Differential', 'question' => 'Apakah masalah terjadi setelah PC jatuh atau dipindahkan?', 'expected_keyword' => 'ya, jatuh, terbentur, setelah pindah, diangkut', 'leads_to' => 'PCG229', 'order' => 15],
    ['category' => 'Differential', 'question' => 'Apakah BSOD kode error selalu sama?', 'expected_keyword' => 'ya, kode sama, berulang, stop code tetap', 'leads_to' => 'PCG246', 'order' => 16],
    ['category' => 'Differential', 'question' => 'Apakah sudah mencoba swap komponen satu per satu?', 'expected_keyword' => 'belum, tidak, belum swap test', 'leads_to' => 'PCG238', 'order' => 17],
    ['category' => 'Differential', 'question' => 'Apakah masalah muncul setelah ganti thermal paste?', 'expected_keyword' => 'ya, setelah ganti pasta, habis servis cooler', 'leads_to' => 'PCG245', 'order' => 18],
    ['category' => 'Differential', 'question' => 'Apakah semua komponen PC adalah baru dan first build gagal POST?', 'expected_keyword' => 'ya, semua baru, baru dirakit, tidak mau post', 'leads_to' => 'PCG255', 'order' => 19],
    ['category' => 'Differential', 'question' => 'Apakah PC nyala sebentar lalu langsung mati tanpa POST?', 'expected_keyword' => 'ya, nyala sebentar, segera mati, no post', 'leads_to' => 'PCG252', 'order' => 20],
    ['category' => 'Differential', 'question' => 'Apakah masalah lebih sering di lingkungan panas atau berdebu?', 'expected_keyword' => 'ya, panas, berdebu, tidak ac, lingkungan buruk', 'leads_to' => 'PCG243', 'order' => 21],
    ['category' => 'Differential', 'question' => 'Apakah sudah mencoba clear CMOS untuk reset BIOS?', 'expected_keyword' => 'belum, tidak, belum clear cmos', 'leads_to' => 'PCG239', 'order' => 22],
    ['category' => 'Differential', 'question' => 'Apakah masalah terjadi setelah ganti PSU baru?', 'expected_keyword' => 'ya, setelah ganti psu, psu baru bermasalah', 'leads_to' => 'PCG242', 'order' => 23],
    ['category' => 'Differential', 'question' => 'Apakah masalah terjadi setelah update Windows atau driver?', 'expected_keyword' => 'ya, setelah update, habis update', 'leads_to' => 'PCG227', 'order' => 24],
    ['category' => 'Differential', 'question' => 'Apakah dua komponen tertentu (RAM kit) jika dipakai bersama crash?', 'expected_keyword' => 'ya, kombinasi ini crash, dua ini tidak jalan bersama', 'leads_to' => 'PCG247', 'order' => 25],
    ['category' => 'Differential', 'question' => 'Apakah masalah muncul setelah ganti motherboard baru?', 'expected_keyword' => 'ya, setelah ganti mobo, mobo baru bermasalah', 'leads_to' => 'PCG248', 'order' => 26],
    ['category' => 'Differential', 'question' => 'Apakah swap/tukar komponen berhasil mengisolasi penyebab masalah?', 'expected_keyword' => 'ya, ketemu setelah swap, terisolasi, berhasil isolasi', 'leads_to' => 'PCG249', 'order' => 27],
    ['category' => 'Differential', 'question' => 'Apakah masalah hanya terjadi secara random tanpa pola?', 'expected_keyword' => 'ya, acak, random, tidak ada pola, intermittent', 'leads_to' => 'PCG238', 'order' => 28],
    ['category' => 'Differential', 'question' => 'Apakah PC pernah terkena air atau cairan?', 'expected_keyword' => 'ya, kena air, basah, tumpahan, water damage', 'leads_to' => 'PCG229', 'order' => 29],
    ['category' => 'Differential', 'question' => 'Apakah masalah setelah ganti OS atau instalasi dual boot?', 'expected_keyword' => 'ya, habis install os, dual boot, ganti windows', 'leads_to' => 'PCG253', 'order' => 30],
];
