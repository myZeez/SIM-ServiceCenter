<?php

// Generated diagnostic questions following real-world laptop technician workflow
// Questions progress: basic observable checks → isolation tests → specific component details
// Total: 130 questions (110 category + 20 differential)

return [
    // ╔══════════════════════════════════════════════════════════════╗
    // ║  DISPLAY QUESTIONS (10) - Technician diagnostic workflow    ║
    // ║  Flow: power check → brightness → ext monitor → cable →    ║
    // ║        lines → physical → impact → partial → spots → onset ║
    // ╚══════════════════════════════════════════════════════════════╝
    ['category' => 'Display', 'question' => 'Saat laptop dinyalakan, apakah ada tanda-tanda hidup seperti lampu LED menyala, kipas berputar, atau suara dari laptop?', 'expected_keyword' => 'ya,iya,ada,nyala,hidup,berputar,kipas', 'leads_to' => null, 'order' => 1],
    ['category' => 'Display', 'question' => 'Apakah layar benar-benar hitam total, atau masih terlihat gambar samar/redup jika disinari senter?', 'expected_keyword' => 'redup,samar,senter,ada gambar,terlihat samar', 'leads_to' => 'G004', 'order' => 2, 'type' => 'choice', 'options' => [['label' => 'Hitam Total', 'value' => 'hitam total gelap'], ['label' => 'Ada Gambar Samar / Redup', 'value' => 'redup samar ada gambar senter']]],
    ['category' => 'Display', 'question' => 'Sudahkah dicoba hubungkan ke monitor eksternal (via HDMI/VGA)? Apakah tampilan di monitor eksternal normal?', 'expected_keyword' => 'ya,iya,normal,bisa,tampil', 'leads_to' => 'G007', 'order' => 3],
    ['category' => 'Display', 'question' => 'Apakah layar berkedip-kedip atau mati hidup saat posisi layar digerakkan (buka-tutup)?', 'expected_keyword' => 'ya,iya,berkedip,flicker,mati hidup,digerakkan', 'leads_to' => 'G008', 'order' => 4],
    ['category' => 'Display', 'question' => 'Apakah ada garis-garis (horizontal atau vertikal) yang muncul di layar?', 'expected_keyword' => 'ya,iya,garis,bergaris,strip,horizontal,vertikal', 'leads_to' => 'G002', 'order' => 5],
    ['category' => 'Display', 'question' => 'Apakah ada kerusakan fisik yang terlihat pada layar seperti retakan, pecah, atau bekas benturan?', 'expected_keyword' => 'ya,iya,retak,pecah,benturan,rusak', 'leads_to' => 'G005', 'order' => 6],
    ['category' => 'Display', 'question' => 'Apakah masalah layar ini terjadi setelah laptop terjatuh atau terbentur sesuatu?', 'expected_keyword' => 'ya,iya,jatuh,bentur,kebentur,terjatuh', 'leads_to' => 'G099', 'order' => 7],
    ['category' => 'Display', 'question' => 'Apakah hanya setengah bagian layar yang menyala atau menampilkan gambar?', 'expected_keyword' => 'ya,iya,setengah,sebagian,separuh,half', 'leads_to' => 'G114', 'order' => 8],
    ['category' => 'Display', 'question' => 'Apakah ada bercak putih (white spot) atau titik pixel yang mati di layar?', 'expected_keyword' => 'ya,iya,bercak,white spot,putih,titik', 'leads_to' => 'G109', 'order' => 9],
    ['category' => 'Display', 'question' => 'Apakah masalah layar ini muncul secara tiba-tiba atau bertahap makin parah?', 'expected_keyword' => 'tiba-tiba,mendadak,bertahap,makin parah,perlahan', 'leads_to' => null, 'order' => 10, 'type' => 'choice', 'options' => [['label' => 'Tiba-tiba Muncul', 'value' => 'tiba-tiba mendadak'], ['label' => 'Makin Lama Makin Parah', 'value' => 'bertahap makin parah perlahan']]],

    // ╔══════════════════════════════════════════════════════════════╗
    // ║  KEYBOARD QUESTIONS (8) - Technician diagnostic workflow    ║
    // ║  Flow: ext keyboard test → all/some → double → sticky →    ║
    // ║        keycap → driver → ghost → backlight                 ║
    // ╚══════════════════════════════════════════════════════════════╝
    ['category' => 'Keyboard', 'question' => 'Apakah sudah dicoba pakai keyboard eksternal USB? Apakah keyboard eksternal berfungsi normal di laptop ini?', 'expected_keyword' => 'ya,iya,normal,bisa,fungsi,lancar', 'leads_to' => 'G013', 'order' => 1],
    ['category' => 'Keyboard', 'question' => 'Apakah semua tombol keyboard mati total, atau hanya beberapa tombol tertentu yang tidak berfungsi?', 'expected_keyword' => 'semua,total,mati semua,semuanya', 'leads_to' => 'G009', 'order' => 2, 'type' => 'choice', 'options' => [['label' => 'Semua Tombol Mati Total', 'value' => 'semua total mati semua semuanya'], ['label' => 'Hanya Beberapa Tombol', 'value' => 'hanya beberapa tidak semua']]],
    ['category' => 'Keyboard', 'question' => 'Jika hanya sebagian tombol yang bermasalah, tombol mana saja yang tidak berfungsi?', 'expected_keyword' => 'sebagian,beberapa,tertentu,beberapa tombol', 'leads_to' => 'G010', 'order' => 3, 'type' => 'choice', 'options' => [['label' => 'Tombol Angka / Numpad', 'value' => 'sebagian beberapa tertentu angka'], ['label' => 'Tombol Huruf', 'value' => 'sebagian huruf beberapa tombol'], ['label' => 'Beberapa Tombol Acak', 'value' => 'beberapa tertentu acak']]],
    ['category' => 'Keyboard', 'question' => 'Apakah ada tombol yang mengetik karakter ganda/dobel saat ditekan sekali?', 'expected_keyword' => 'ya,iya,dobel,ganda,double,dua kali', 'leads_to' => 'G059', 'order' => 4],
    ['category' => 'Keyboard', 'question' => 'Apakah tombol-tombol keyboard terasa lengket, nyangkut, atau susah ditekan?', 'expected_keyword' => 'ya,iya,lengket,sticky,nyangkut,keras,susah', 'leads_to' => 'G122', 'order' => 5],
    ['category' => 'Keyboard', 'question' => 'Apakah ada keycap (tutup tombol) yang secara fisik lepas, copot, atau patah?', 'expected_keyword' => 'ya,iya,lepas,copot,patah,hilang', 'leads_to' => 'G121', 'order' => 6],
    ['category' => 'Keyboard', 'question' => 'Apakah masalah keyboard ini mulai terjadi setelah update Windows atau update driver?', 'expected_keyword' => 'ya,iya,setelah update,habis update,update driver', 'leads_to' => 'G128', 'order' => 7],
    ['category' => 'Keyboard', 'question' => 'Apakah keyboard mengetik sendiri tanpa ditekan (ghost typing)?', 'expected_keyword' => 'ya,iya,ketik sendiri,ghost,ngetik sendiri,jalan sendiri', 'leads_to' => 'G011', 'order' => 8],

    // ╔══════════════════════════════════════════════════════════════╗
    // ║  NETWORK QUESTIONS (8) - Technician diagnostic workflow     ║
    // ║  Flow: wifi visible → other devices → connected no net →   ║
    // ║        signal weak → drop → bluetooth → airplane → devmgr  ║
    // ╚══════════════════════════════════════════════════════════════╝
    ['category' => 'Network', 'question' => 'Apakah ikon WiFi masih terlihat di taskbar dan WiFi bisa di-scan untuk mencari jaringan?', 'expected_keyword' => 'tidak,ga ada,hilang,ga muncul,mati', 'leads_to' => 'G014', 'order' => 1],
    ['category' => 'Network', 'question' => 'Apakah perangkat lain (HP, tablet) bisa konek dan internetan normal di jaringan WiFi yang sama?', 'expected_keyword' => 'ya,iya,bisa,normal,lancar,hp bisa', 'leads_to' => 'G136', 'order' => 2],
    ['category' => 'Network', 'question' => 'Apakah WiFi di laptop sudah tersambung (connected) tapi tidak bisa akses internet?', 'expected_keyword' => 'ya,iya,connected,konek tapi,no internet,ga bisa browsing', 'leads_to' => 'G130', 'order' => 3],
    ['category' => 'Network', 'question' => 'Apakah sinyal WiFi hanya bisa ditangkap dari jarak sangat dekat dengan router?', 'expected_keyword' => 'ya,iya,dekat,lemah,pendek,deket aja', 'leads_to' => 'G129', 'order' => 4],
    ['category' => 'Network', 'question' => 'Apakah koneksi WiFi sering putus-putus atau disconnect sendiri?', 'expected_keyword' => 'ya,iya,putus,disconnect,sering putus,drop', 'leads_to' => 'G015', 'order' => 5],
    ['category' => 'Network', 'question' => 'Apakah Bluetooth juga tidak berfungsi atau tidak bisa mendeteksi perangkat?', 'expected_keyword' => 'ya,iya,bluetooth mati,bt ga bisa,tidak bisa', 'leads_to' => 'G017', 'order' => 6],
    ['category' => 'Network', 'question' => 'Apakah laptop terjebak di Airplane Mode dan tidak bisa dimatikan?', 'expected_keyword' => 'ya,iya,airplane,stuck,ga bisa matiin,flight mode', 'leads_to' => 'G135', 'order' => 7],
    ['category' => 'Network', 'question' => 'Apakah WiFi card/adapter terdeteksi di Device Manager atau BIOS?', 'expected_keyword' => 'tidak,ga ada,ga kedeteksi,hilang,not detected', 'leads_to' => 'G140', 'order' => 8],

    // ╔══════════════════════════════════════════════════════════════╗
    // ║  PERIPHERAL QUESTIONS (10) - Organized by sub-topic        ║
    // ║  Flow: touchpad (3) → USB (3) → charger port → webcam →   ║
    // ║        HDMI → fingerprint                                  ║
    // ╚══════════════════════════════════════════════════════════════╝
    ['category' => 'Peripheral', 'question' => 'Apakah masalah yang dialami terkait touchpad/mouse? Apakah touchpad sama sekali tidak merespon?', 'expected_keyword' => 'ya,iya,touchpad mati,ga gerak,ga respon,tidak berfungsi', 'leads_to' => 'G020', 'order' => 1],
    ['category' => 'Peripheral', 'question' => 'Apakah touchpad masih bisa digerakkan dan klik, tapi fungsi scroll tidak berfungsi?', 'expected_keyword' => 'ya,iya,scroll ga bisa,scroll mati,gerak bisa tapi scroll', 'leads_to' => 'G143', 'order' => 2],
    ['category' => 'Peripheral', 'question' => 'Apakah gesture touchpad (pinch zoom, swipe tiga jari, dll) tidak berfungsi?', 'expected_keyword' => 'ya,iya,gesture ga bisa,pinch ga bisa,swipe ga jalan', 'leads_to' => 'G147', 'order' => 3],
    ['category' => 'Peripheral', 'question' => 'Apakah port USB terlihat longgar, goyang, atau rusak secara fisik?', 'expected_keyword' => 'ya,iya,longgar,goyang,oblak,rusak fisik', 'leads_to' => 'G065', 'order' => 4],
    ['category' => 'Peripheral', 'question' => 'Apakah semua port USB di laptop bermasalah, atau hanya satu/sebagian saja?', 'expected_keyword' => 'semua,semuanya,semua port,semua USB', 'leads_to' => 'G068', 'order' => 5, 'type' => 'choice', 'options' => [['label' => 'Semua Port USB Bermasalah', 'value' => 'semua semuanya semua port semua USB'], ['label' => 'Hanya Satu / Sebagian Port', 'value' => 'hanya satu sebagian port']]],
    ['category' => 'Peripheral', 'question' => 'Apakah ada perangkat USB (flashdisk, mouse, dll) yang masih bisa terdeteksi di laptop?', 'expected_keyword' => 'tidak,ga bisa,ga kedeteksi,semua ga bisa', 'leads_to' => 'G018', 'order' => 6],
    ['category' => 'Peripheral', 'question' => 'Apakah port charger terasa longgar atau harus digoyang-goyang agar bisa mengisi daya?', 'expected_keyword' => 'ya,iya,longgar,goyang,harus digoyang,oblak', 'leads_to' => 'G064', 'order' => 7],
    ['category' => 'Peripheral', 'question' => 'Apakah lampu indikator webcam menyala tapi tampilan kamera hitam saja?', 'expected_keyword' => 'ya,iya,nyala tapi hitam,led on tapi gelap,lampu nyala hitam', 'leads_to' => 'G079', 'order' => 8],
    ['category' => 'Peripheral', 'question' => 'Apakah port HDMI secara fisik terlihat rusak, patah pin, atau longgar?', 'expected_keyword' => 'ya,iya,rusak,patah,longgar,pin patah', 'leads_to' => 'G066', 'order' => 9],
    ['category' => 'Peripheral', 'question' => 'Apakah sensor fingerprint/sidik jari di laptop tidak berfungsi?', 'expected_keyword' => 'ya,iya,fingerprint mati,sidik jari ga bisa,ga fungsi', 'leads_to' => 'G086', 'order' => 10],

    // ╔══════════════════════════════════════════════════════════════╗
    // ║  POWER QUESTIONS (10) - Technician workflow                ║
    // ║  Flow: charger LED → power button → charger only → brief   ║
    // ║        on → battery swell → drain → % drop → burn smell →  ║
    // ║        sudden off → drop impact                            ║
    // ╚══════════════════════════════════════════════════════════════╝
    ['category' => 'Power', 'question' => 'Saat charger dipasang, apakah lampu indikator charging di laptop atau adaptor menyala?', 'expected_keyword' => 'tidak,ga nyala,mati,ga ada lampu', 'leads_to' => 'G027', 'order' => 1],
    ['category' => 'Power', 'question' => 'Apakah ada respon sama sekali saat tombol power ditekan (lampu, kipas berputar, suara)?', 'expected_keyword' => 'tidak,ga ada,ga respon,mati total,diam aja', 'leads_to' => 'G156', 'order' => 2],
    ['category' => 'Power', 'question' => 'Apakah laptop bisa menyala jika hanya menggunakan charger saja (baterai dilepas)?', 'expected_keyword' => 'ya,iya,bisa,nyala', 'leads_to' => 'G024', 'order' => 3],
    ['category' => 'Power', 'question' => 'Apakah laptop menyala sebentar (beberapa detik) lalu langsung mati lagi?', 'expected_keyword' => 'ya,iya,nyala bentar,mati lagi,sebentar,beberapa detik', 'leads_to' => 'G149', 'order' => 4],
    ['category' => 'Power', 'question' => 'Apakah baterai terlihat bengkak, kembung, atau membuat casing laptop terangkat?', 'expected_keyword' => 'ya,iya,bengkak,kembung,gembung,terangkat', 'leads_to' => 'G081', 'order' => 5],
    ['category' => 'Power', 'question' => 'Seberapa cepat baterai habis saat pemakaian ringan seperti browsing atau mengetik?', 'expected_keyword' => 'cepat,1 jam,2 jam,kurang,sebentar,habis cepat', 'leads_to' => 'G026', 'order' => 6, 'type' => 'choice', 'options' => [['label' => 'Sangat Cepat (< 2 jam)', 'value' => 'cepat 1 jam kurang sebentar habis cepat'], ['label' => 'Cukup Cepat (2-4 jam)', 'value' => 'cepat 2 jam habis cepat'], ['label' => 'Normal / Biasa', 'value' => 'normal biasa']]],
    ['category' => 'Power', 'question' => 'Apakah persentase baterai loncat-loncat atau langsung drop dari angka tinggi ke rendah?', 'expected_keyword' => 'ya,iya,loncat,drop,langsung turun,ga akurat', 'leads_to' => 'G083', 'order' => 7],
    ['category' => 'Power', 'question' => 'Apakah ada bau hangus atau gosong dari laptop, terutama dari area port charger?', 'expected_keyword' => 'ya,iya,bau,hangus,gosong,terbakar', 'leads_to' => 'G153', 'order' => 8],
    ['category' => 'Power', 'question' => 'Apakah laptop sering mati tiba-tiba tanpa peringatan saat sedang digunakan?', 'expected_keyword' => 'ya,iya,mati tiba-tiba,shutdown sendiri,mati mendadak', 'leads_to' => 'G029', 'order' => 9],
    ['category' => 'Power', 'question' => 'Apakah masalah daya ini muncul setelah laptop pernah terjatuh atau terbentur?', 'expected_keyword' => 'ya,iya,jatuh,bentur,terjatuh,kebentur', 'leads_to' => 'G099', 'order' => 10],

    // ╔══════════════════════════════════════════════════════════════╗
    // ║  SOFTWARE QUESTIONS (8) - Technician diagnostic workflow    ║
    // ║  Flow: boot check → BSOD → bootloop → after update →      ║
    // ║        safe mode → file corrupt → popup → OS not found     ║
    // ╚══════════════════════════════════════════════════════════════╝
    ['category' => 'Software', 'question' => 'Apakah laptop bisa masuk ke Windows, atau stuck/berhenti di logo saat booting?', 'expected_keyword' => 'stuck,berhenti,ga masuk,loading terus,logo terus', 'leads_to' => 'G158', 'order' => 1],
    ['category' => 'Software', 'question' => 'Apakah muncul layar biru (Blue Screen/BSOD) dengan pesan error?', 'expected_keyword' => 'ya,iya,bsod,blue screen,layar biru,error', 'leads_to' => 'G031', 'order' => 2],
    ['category' => 'Software', 'question' => 'Apakah laptop restart berulang-ulang terus-menerus (bootloop) tanpa bisa masuk Windows?', 'expected_keyword' => 'ya,iya,restart terus,bootloop,ulang-ulang,berulang', 'leads_to' => 'G160', 'order' => 3],
    ['category' => 'Software', 'question' => 'Apakah masalah ini mulai terjadi setelah update Windows atau update driver?', 'expected_keyword' => 'ya,iya,setelah update,habis update,update windows', 'leads_to' => 'G161', 'order' => 4],
    ['category' => 'Software', 'question' => 'Apakah sudah dicoba boot ke Safe Mode? Apakah masalah masih muncul di Safe Mode?', 'expected_keyword' => 'ya,iya,masih,tetap,safe mode juga', 'leads_to' => 'G103', 'order' => 5],
    ['category' => 'Software', 'question' => 'Apakah ada file penting yang tiba-tiba hilang atau tidak bisa dibuka (corrupt)?', 'expected_keyword' => 'ya,iya,hilang,corrupt,ga bisa buka,rusak', 'leads_to' => 'G164', 'order' => 6],
    ['category' => 'Software', 'question' => 'Apakah sering muncul popup iklan atau program mencurigakan yang tidak pernah diinstall?', 'expected_keyword' => 'ya,iya,popup,iklan,mencurigakan,ads,malware', 'leads_to' => 'G039', 'order' => 7],
    ['category' => 'Software', 'question' => 'Apakah muncul pesan "Operating System Not Found" atau "No Bootable Device" saat dinyalakan?', 'expected_keyword' => 'ya,iya,os not found,no bootable,not found,ga ketemu os', 'leads_to' => 'G159', 'order' => 8],

    // ╔══════════════════════════════════════════════════════════════╗
    // ║  PERFORMANCE QUESTIONS (8) - Technician diagnostic workflow ║
    // ║  Flow: multitask → HDD/SSD → disk 100% → startup prog →   ║
    // ║        game lag → degrade over time → fan loud → RAM high  ║
    // ╚══════════════════════════════════════════════════════════════╝
    ['category' => 'Performance', 'question' => 'Apakah laptop terasa lambat terutama saat membuka banyak aplikasi bersamaan?', 'expected_keyword' => 'ya,iya,lambat,lemot,banyak app,multitask', 'leads_to' => 'G043', 'order' => 1],
    ['category' => 'Performance', 'question' => 'Apakah laptop masih menggunakan HDD (hard disk) atau sudah pakai SSD?', 'expected_keyword' => 'hdd,hard disk,masih hdd,belum ssd', 'leads_to' => 'G044', 'order' => 2, 'type' => 'choice', 'options' => [['label' => 'Masih Pakai HDD / Hard Disk', 'value' => 'hdd hard disk masih hdd belum ssd'], ['label' => 'Sudah Pakai SSD', 'value' => 'sudah ssd pakai ssd']]],
    ['category' => 'Performance', 'question' => 'Apakah di Task Manager terlihat Disk Usage mentok 100% terus-menerus?', 'expected_keyword' => 'ya,iya,100%,mentok,disk usage tinggi,penuh terus', 'leads_to' => 'G173', 'order' => 3],
    ['category' => 'Performance', 'question' => 'Apakah banyak program yang otomatis berjalan saat laptop pertama kali dinyalakan (startup)?', 'expected_keyword' => 'ya,iya,banyak,banyak startup,banyak program,otomatis jalan', 'leads_to' => 'G177', 'order' => 4],
    ['category' => 'Performance', 'question' => 'Apakah game atau aplikasi berat (editing, rendering) sering lag, patah-patah, atau FPS drop?', 'expected_keyword' => 'ya,iya,lag,patah,fps drop,stuttering,lambat', 'leads_to' => 'G170', 'order' => 5],
    ['category' => 'Performance', 'question' => 'Apakah performa laptop makin menurun setelah dipakai beberapa jam (awalnya lancar lalu jadi lambat)?', 'expected_keyword' => 'ya,iya,makin lambat,turun,lama-lama,setelah lama', 'leads_to' => 'G178', 'order' => 6],
    ['category' => 'Performance', 'question' => 'Apakah kipas laptop berputar sangat kencang dan berisik saat laptop terasa lambat?', 'expected_keyword' => 'ya,iya,kipas kencang,berisik,fan keras,bunyi', 'leads_to' => 'G169', 'order' => 7],
    ['category' => 'Performance', 'question' => 'Apakah di Task Manager terlihat penggunaan RAM (Memory) sangat tinggi?', 'expected_keyword' => 'ya,iya,ram tinggi,memory tinggi,ram penuh,hampir full', 'leads_to' => 'G041', 'order' => 8],

    // ╔══════════════════════════════════════════════════════════════╗
    // ║  THERMAL QUESTIONS (7) - Technician diagnostic workflow     ║
    // ║  Flow: fan spin → hot idle → cleaned → thermal paste →     ║
    // ║        grinding → shutdown overheat → burn smell            ║
    // ╚══════════════════════════════════════════════════════════════╝
    ['category' => 'Thermal', 'question' => 'Apakah kipas/fan laptop masih berputar saat laptop dinyalakan?', 'expected_keyword' => 'tidak,ga putar,mati,ga jalan,diam,ga bunyi', 'leads_to' => 'G047', 'order' => 1],
    ['category' => 'Thermal', 'question' => 'Apakah laptop terasa panas meskipun hanya dipakai browsing ringan atau idle (tidak menjalankan apa-apa)?', 'expected_keyword' => 'ya,iya,panas,panas idle,panas padahal,ga ngapa-ngapain', 'leads_to' => 'G179', 'order' => 2],
    ['category' => 'Thermal', 'question' => 'Apakah laptop sudah pernah dibersihkan bagian dalamnya (debu di kipas dan ventilasi)?', 'expected_keyword' => 'belum,belum pernah,tidak pernah,lama sekali,ga pernah', 'leads_to' => 'G181', 'order' => 3],
    ['category' => 'Thermal', 'question' => 'Apakah thermal paste pada prosesor/GPU sudah pernah diganti?', 'expected_keyword' => 'belum,belum pernah,tidak pernah,ga tau,ga pernah', 'leads_to' => 'G180', 'order' => 4],
    ['category' => 'Thermal', 'question' => 'Apakah kipas mengeluarkan bunyi kasar, grinding, atau gesekan saat berputar?', 'expected_keyword' => 'ya,iya,kasar,grinding,gesek,bunyi aneh,berisik', 'leads_to' => 'G182', 'order' => 5],
    ['category' => 'Thermal', 'question' => 'Apakah laptop mati sendiri (shutdown otomatis) setelah dipakai cukup lama dan terasa sangat panas?', 'expected_keyword' => 'ya,iya,mati sendiri,shutdown,overheat,panas mati', 'leads_to' => 'G049', 'order' => 6],
    ['category' => 'Thermal', 'question' => 'Apakah ada bau hangus atau gosong yang keluar dari area ventilasi/lubang udara laptop?', 'expected_keyword' => 'ya,iya,bau,hangus,gosong,terbakar,bau aneh', 'leads_to' => 'G186', 'order' => 7],

    // ╔══════════════════════════════════════════════════════════════╗
    // ║  AUDIO QUESTIONS (8) - Technician diagnostic workflow       ║
    // ║  Flow: no sound → headphone test → one speaker → crackling ║
    // ║        → jack wiggle → mic → device manager → sudden mute  ║
    // ╚══════════════════════════════════════════════════════════════╝
    ['category' => 'Audio', 'question' => 'Apakah suara tidak keluar sama sekali dari speaker laptop (sudah cek volume tidak mute)?', 'expected_keyword' => 'ya,iya,ga keluar,mati,ga ada suara,silent', 'leads_to' => 'G050', 'order' => 1],
    ['category' => 'Audio', 'question' => 'Apakah sudah dicoba pakai headphone/headset di perangkat lain? Apakah headphone berfungsi normal?', 'expected_keyword' => 'ya,iya,normal,bisa,berfungsi', 'leads_to' => 'G052', 'order' => 2],
    ['category' => 'Audio', 'question' => 'Apakah suara hanya keluar dari satu speaker saja (kiri atau kanan)?', 'expected_keyword' => 'ya,iya,satu speaker,sebelah,kiri aja,kanan aja', 'leads_to' => 'G054', 'order' => 3],
    ['category' => 'Audio', 'question' => 'Apakah suara speaker pecah, kresek, atau distorsi terutama saat volume dinaikkan?', 'expected_keyword' => 'ya,iya,pecah,kresek,distorsi,volume tinggi', 'leads_to' => 'G051', 'order' => 4],
    ['category' => 'Audio', 'question' => 'Apakah jack audio (colokan headphone) harus digoyang atau ditekan di posisi tertentu agar suara keluar?', 'expected_keyword' => 'ya,iya,goyang,tekan,posisi tertentu,digoyang', 'leads_to' => 'G194', 'order' => 5],
    ['category' => 'Audio', 'question' => 'Apakah microphone laptop tidak berfungsi (tidak bisa merekam suara atau tidak terdeteksi di aplikasi)?', 'expected_keyword' => 'ya,iya,mic mati,mic rusak,ga bisa rekam,mic ga fungsi', 'leads_to' => 'G053', 'order' => 6],
    ['category' => 'Audio', 'question' => 'Apakah audio device (speaker/sound card) terdeteksi di Device Manager?', 'expected_keyword' => 'tidak,ga ada,ga terdeteksi,hilang,not detected', 'leads_to' => 'G192', 'order' => 7],
    ['category' => 'Audio', 'question' => 'Apakah suara tiba-tiba mati saat sedang digunakan (awalnya normal lalu hilang)?', 'expected_keyword' => 'ya,iya,tiba-tiba mati,hilang,putus,mendadak', 'leads_to' => 'G058', 'order' => 8],

    // ╔══════════════════════════════════════════════════════════════╗
    // ║  STORAGE QUESTIONS (8) - Technician diagnostic workflow     ║
    // ║  Flow: clicking → BIOS detect → SMART → intermittent →    ║
    // ║        copy slow → partition lost → read-only → boot slow  ║
    // ╚══════════════════════════════════════════════════════════════╝
    ['category' => 'Storage', 'question' => 'Apakah terdengar bunyi klik-klik atau suara aneh yang berulang dari area hard drive laptop?', 'expected_keyword' => 'ya,iya,klik,bunyi,klik-klik,suara aneh', 'leads_to' => 'G061', 'order' => 1],
    ['category' => 'Storage', 'question' => 'Apakah hard drive atau SSD masih terdeteksi di BIOS saat laptop dinyalakan?', 'expected_keyword' => 'tidak,ga kedeteksi,hilang,ga muncul,not detected', 'leads_to' => 'G060', 'order' => 2],
    ['category' => 'Storage', 'question' => 'Apakah pernah muncul pesan peringatan SMART error, bad sector, atau "disk failing"?', 'expected_keyword' => 'ya,iya,smart,bad sector,warning,failing,error disk', 'leads_to' => 'G198', 'order' => 3],
    ['category' => 'Storage', 'question' => 'Apakah disk kadang terdeteksi kadang hilang (tidak konsisten)?', 'expected_keyword' => 'ya,iya,kadang hilang,kadang muncul,on off,ga konsisten', 'leads_to' => 'G205', 'order' => 4],
    ['category' => 'Storage', 'question' => 'Apakah proses copy atau pindah file terasa sangat lambat dibanding biasanya?', 'expected_keyword' => 'ya,iya,lambat,lama,copy lambat,transfer lambat', 'leads_to' => 'G199', 'order' => 5],
    ['category' => 'Storage', 'question' => 'Apakah ada partisi (drive D, E, dll) yang tiba-tiba hilang atau tidak muncul di File Explorer?', 'expected_keyword' => 'ya,iya,partisi hilang,drive hilang,ga muncul', 'leads_to' => 'G203', 'order' => 6],
    ['category' => 'Storage', 'question' => 'Apakah SSD menjadi read-only (tidak bisa menyimpan/menulis file baru)?', 'expected_keyword' => 'ya,iya,read only,ga bisa nulis,ga bisa save,ga bisa simpan', 'leads_to' => 'G201', 'order' => 7],
    ['category' => 'Storage', 'question' => 'Apakah proses booting laptop terasa jauh lebih lama dari biasanya?', 'expected_keyword' => 'ya,iya,lama,booting lama,loading lama,startup lama', 'leads_to' => 'G196', 'order' => 8],

    // ╔══════════════════════════════════════════════════════════════╗
    // ║  PHYSICAL QUESTIONS (7) - Technician diagnostic workflow    ║
    // ║  Flow: hinge loose → casing crack → screen wobble →        ║
    // ║        body lifted → bezel off → bottom case → hinge noise ║
    // ╚══════════════════════════════════════════════════════════════╝
    ['category' => 'Physical', 'question' => 'Apakah engsel laptop terasa longgar, patah, atau susah saat dibuka/ditutup?', 'expected_keyword' => 'ya,iya,longgar,patah,susah,engsel rusak,keras', 'leads_to' => 'G071', 'order' => 1],
    ['category' => 'Physical', 'question' => 'Apakah ada retakan atau pecah pada casing/body laptop?', 'expected_keyword' => 'ya,iya,retak,pecah,patah,crack', 'leads_to' => 'G070', 'order' => 2],
    ['category' => 'Physical', 'question' => 'Apakah layar laptop goyang atau tidak stabil saat disentuh atau laptop digeser?', 'expected_keyword' => 'ya,iya,goyang,goyah,ga stabil,tidak stabil', 'leads_to' => 'G072', 'order' => 3],
    ['category' => 'Physical', 'question' => 'Apakah ada bagian body laptop yang terangkat atau naik karena tekanan dari engsel?', 'expected_keyword' => 'ya,iya,terangkat,angkat,terangkat casing,naik', 'leads_to' => 'G216', 'order' => 4],
    ['category' => 'Physical', 'question' => 'Apakah bezel (frame/bingkai) layar lepas, retak, atau tidak menempel dengan baik?', 'expected_keyword' => 'ya,iya,bezel lepas,frame lepas,retak,copot', 'leads_to' => 'G211', 'order' => 5],
    ['category' => 'Physical', 'question' => 'Apakah bottom case (cover bawah) laptop rusak, retak, atau tidak tertutup rapat?', 'expected_keyword' => 'ya,iya,bottom rusak,cover bawah,retak,terbuka', 'leads_to' => 'G212', 'order' => 6],
    ['category' => 'Physical', 'question' => 'Apakah engsel mengeluarkan bunyi gesekan atau bunyi krek saat layar dibuka/ditutup?', 'expected_keyword' => 'ya,iya,bunyi,krek,gesekan,berisik,krek-krek', 'leads_to' => 'G215', 'order' => 7],

    // ╔══════════════════════════════════════════════════════════════╗
    // ║  WATER DAMAGE QUESTIONS (8) - Technician diagnostic flow   ║
    // ║  Flow: water exposure → immediate action → dead → keyboard ║
    // ║        → corrosion → screen fog → port corrosion → partial ║
    // ╚══════════════════════════════════════════════════════════════╝
    ['category' => 'Water Damage', 'question' => 'Apakah laptop pernah terkena air, tumpahan minuman, atau cairan lainnya?', 'expected_keyword' => 'ya,iya,kena air,tumpahan,basah,kecipratan,ketumpahan', 'leads_to' => 'G090', 'order' => 1],
    ['category' => 'Water Damage', 'question' => 'Setelah terkena air/cairan, apakah laptop langsung dimatikan dan dibalik untuk dikeringkan?', 'expected_keyword' => 'tidak,ga langsung,masih dipakai,tetap nyala,lupa', 'leads_to' => null, 'order' => 2],
    ['category' => 'Water Damage', 'question' => 'Apakah laptop mati total dan tidak bisa dinyalakan sama sekali setelah terkena air?', 'expected_keyword' => 'ya,iya,mati total,ga bisa nyala,mati,off', 'leads_to' => 'G092', 'order' => 3],
    ['category' => 'Water Damage', 'question' => 'Apakah keyboard bermasalah (error, beberapa tombol mati) setelah kejadian terkena cairan?', 'expected_keyword' => 'ya,iya,keyboard error,tombol mati,ga bisa ketik', 'leads_to' => 'G091', 'order' => 4],
    ['category' => 'Water Damage', 'question' => 'Apakah terlihat tanda-tanda korosi atau karat (warna hijau/putih) pada komponen yang terlihat?', 'expected_keyword' => 'ya,iya,korosi,karat,hijau,putih,oksidasi', 'leads_to' => 'G094', 'order' => 5],
    ['category' => 'Water Damage', 'question' => 'Apakah layar terlihat berembun dari dalam atau ada bercak/noda cairan di balik layar?', 'expected_keyword' => 'ya,iya,embun,bercak,noda,kabut,berembun', 'leads_to' => 'G093', 'order' => 6],
    ['category' => 'Water Damage', 'question' => 'Apakah port-port laptop (USB, charger, HDMI) terlihat berkorosi atau berkarat?', 'expected_keyword' => 'ya,iya,port korosi,karat,kotor,berubah warna', 'leads_to' => 'G095', 'order' => 7],
    ['category' => 'Water Damage', 'question' => 'Apakah laptop masih bisa menyala tapi hanya sebagian fungsi yang bekerja (misal layar nyala tapi keyboard mati)?', 'expected_keyword' => 'ya,iya,nyala sebagian,bisa tapi,sebagian fungsi', 'leads_to' => 'G097', 'order' => 8],

    // ╔══════════════════════════════════════════════════════════════╗
    // ║  HARDWARE QUESTIONS (8) - Technician diagnostic workflow    ║
    // ║  Flow: artifacts → no display → burn smell → BIOS reset →  ║
    // ║        RAM slot → beep code → all ports → restart on load  ║
    // ╚══════════════════════════════════════════════════════════════╝
    ['category' => 'Hardware', 'question' => 'Apakah muncul artifacts berupa kotak-kotak warna, garis acak, atau tampilan yang kacau di layar?', 'expected_keyword' => 'ya,iya,artifact,kotak warna,garis acak,kacau,glitch', 'leads_to' => 'G229', 'order' => 1],
    ['category' => 'Hardware', 'question' => 'Apakah laptop menyala (lampu LED hidup, kipas berputar) tapi layar sama sekali tidak menampilkan apa-apa?', 'expected_keyword' => 'ya,iya,no display,ga ada tampilan,layar mati,hitam', 'leads_to' => 'G098', 'order' => 2],
    ['category' => 'Hardware', 'question' => 'Apakah ada bau komponen terbakar atau bau gosong yang tercium dari laptop?', 'expected_keyword' => 'ya,iya,bau,terbakar,hangus,gosong,bau komponen', 'leads_to' => 'G233', 'order' => 3],
    ['category' => 'Hardware', 'question' => 'Apakah pengaturan BIOS selalu reset sendiri setiap kali laptop dimatikan (misalnya tanggal/jam selalu salah)?', 'expected_keyword' => 'ya,iya,reset,bios reset,tanggal salah,jam salah', 'leads_to' => 'G232', 'order' => 4],
    ['category' => 'Hardware', 'question' => 'Apakah ada slot RAM yang tidak berfungsi atau RAM hanya terbaca sebagian dari kapasitas total?', 'expected_keyword' => 'ya,iya,slot mati,ram sebagian,ga terbaca,kurang', 'leads_to' => 'G230', 'order' => 5],
    ['category' => 'Hardware', 'question' => 'Apakah terdengar bunyi beep berulang saat laptop dinyalakan (sebelum masuk tampilan)?', 'expected_keyword' => 'ya,iya,beep,bunyi,bip,beep code', 'leads_to' => 'G231', 'order' => 6],
    ['category' => 'Hardware', 'question' => 'Apakah semua port (USB, HDMI, WiFi, Bluetooth) mati bersamaan secara tiba-tiba?', 'expected_keyword' => 'ya,iya,semua mati,sekaligus,bersamaan,semua port', 'leads_to' => 'G240', 'order' => 7],
    ['category' => 'Hardware', 'question' => 'Apakah laptop sering restart sendiri saat menjalankan tugas berat seperti game atau rendering?', 'expected_keyword' => 'ya,iya,restart,berat,game,rendering,shutdown saat berat', 'leads_to' => 'G235', 'order' => 8],

    // ╔══════════════════════════════════════════════════════════════╗
    // ║  DIFFERENTIAL QUESTIONS (20) - Cross-category narrowing    ║
    // ║  Used to isolate root cause across categories               ║
    // ╚══════════════════════════════════════════════════════════════╝
    ['category' => 'Differential', 'question' => 'Apakah masalah ini terjadi setelah laptop terjatuh atau terbentur benda keras?', 'expected_keyword' => 'ya,iya,jatuh,bentur,terjatuh,kebentur', 'leads_to' => 'G099', 'order' => 1],
    ['category' => 'Differential', 'question' => 'Apakah masalah mulai terjadi setelah menginstall software, driver, atau program baru?', 'expected_keyword' => 'ya,iya,install,software baru,driver baru,program', 'leads_to' => 'G100', 'order' => 2],
    ['category' => 'Differential', 'question' => 'Apakah masalah ini muncul secara tiba-tiba tanpa sebab yang jelas?', 'expected_keyword' => 'ya,iya,tiba-tiba,mendadak,tau-tau,tanpa sebab', 'leads_to' => 'G102', 'order' => 3],
    ['category' => 'Differential', 'question' => 'Apakah masalah ini muncul bertahap dan makin lama makin parah?', 'expected_keyword' => 'ya,iya,bertahap,makin parah,perlahan,gradual', 'leads_to' => 'G101', 'order' => 4],
    ['category' => 'Differential', 'question' => 'Apakah masalah masih tetap muncul saat laptop dijalankan di Safe Mode?', 'expected_keyword' => 'ya,iya,masih,tetap,safe mode juga,masih error', 'leads_to' => 'G103', 'order' => 5],
    ['category' => 'Differential', 'question' => 'Apakah masalah hilang (laptop normal) saat dijalankan di Safe Mode?', 'expected_keyword' => 'ya,iya,normal,hilang,safe mode ok,bisa', 'leads_to' => 'G104', 'order' => 6],
    ['category' => 'Differential', 'question' => 'Apakah masalah ini mulai terjadi setelah update Windows terakhir?', 'expected_keyword' => 'ya,iya,setelah update,habis update,update windows', 'leads_to' => 'G105', 'order' => 7],
    ['category' => 'Differential', 'question' => 'Apakah masalah muncul atau bertambah parah terutama saat laptop sudah panas?', 'expected_keyword' => 'ya,iya,panas,overheat,saat panas,panas bertambah', 'leads_to' => 'G106', 'order' => 8],
    ['category' => 'Differential', 'question' => 'Apakah laptop pernah terkena air atau tumpahan cairan sebelum masalah ini muncul?', 'expected_keyword' => 'ya,iya,kena air,basah,tumpahan,cairan', 'leads_to' => 'G090', 'order' => 9],
    ['category' => 'Differential', 'question' => 'Apakah masalah hanya terjadi saat laptop menggunakan baterai (tanpa charger terhubung)?', 'expected_keyword' => 'ya,iya,baterai saja,tanpa charger,lepas charger', 'leads_to' => 'G241', 'order' => 10],
    ['category' => 'Differential', 'question' => 'Apakah masalah hanya terjadi saat charger terhubung ke laptop?', 'expected_keyword' => 'ya,iya,saat charger,pakai charger,charger colok', 'leads_to' => 'G242', 'order' => 11],
    ['category' => 'Differential', 'question' => 'Jika dicoba dengan monitor eksternal, apakah tampilan di monitor eksternal normal?', 'expected_keyword' => 'ya,iya,normal,bisa,ext monitor ok', 'leads_to' => 'G245', 'order' => 12],
    ['category' => 'Differential', 'question' => 'Apakah monitor eksternal juga menampilkan masalah yang sama dengan layar laptop?', 'expected_keyword' => 'ya,iya,sama,ext juga,monitor juga,bermasalah juga', 'leads_to' => 'G246', 'order' => 13],
    ['category' => 'Differential', 'question' => 'Jika dicoba boot dengan OS lain (misal Linux USB), apakah masalah masih muncul?', 'expected_keyword' => 'ya,iya,masih,tetap error,linux juga', 'leads_to' => 'G243', 'order' => 14],
    ['category' => 'Differential', 'question' => 'Jika dicoba boot dengan OS lain (misal Linux USB), apakah laptop berfungsi normal?', 'expected_keyword' => 'ya,iya,normal,bisa,os lain ok,linux normal', 'leads_to' => 'G244', 'order' => 15],
    ['category' => 'Differential', 'question' => 'Apakah masalah ini muncul setelah mengganti atau upgrade hardware (RAM, SSD, WiFi card, dll)?', 'expected_keyword' => 'ya,iya,setelah upgrade,ganti ram,ganti ssd,habis ganti', 'leads_to' => 'G249', 'order' => 16],
    ['category' => 'Differential', 'question' => 'Apakah masalah hanya muncul saat layar dibuka pada posisi/sudut tertentu?', 'expected_keyword' => 'ya,iya,posisi tertentu,sudut tertentu,posisi,angle', 'leads_to' => 'G250', 'order' => 17],
    ['category' => 'Differential', 'question' => 'Apakah masalah muncul atau bertambah parah saat laptop digoyang atau digerakkan?', 'expected_keyword' => 'ya,iya,digoyang,digerakkan,gerakan,goyang', 'leads_to' => 'G251', 'order' => 18],
    ['category' => 'Differential', 'question' => 'Apakah sudah pernah mencoba reset BIOS ke pengaturan default? Apakah masalah masih ada?', 'expected_keyword' => 'sudah,masih sama,ga ngaruh,tetap,masih error', 'leads_to' => 'G252', 'order' => 19],
    ['category' => 'Differential', 'question' => 'Apakah laptop sudah digunakan cukup lama (lebih dari 3 tahun)?', 'expected_keyword' => 'ya,iya,lama,tua,lebih 3 tahun,sudah lama,bertahun', 'leads_to' => 'G101', 'order' => 20],
];
