# 2. Keyboard

## Gejala (Symptoms) — 15 Data

| Kode | Nama Gejala | Keywords | Bobot |
|------|-------------|----------|-------|
| G009 | Keyboard tidak berfungsi | keyboard mati, tidak bisa ketik, keyboard error, keyboard rusak, keyboard ga bisa, keyboard gak bisa, keyboard tidak berfungsi, gabisa ngetik, ga bisa ngetik, gak bisa ngetik, keyboard hang, keyboard eror | 0.8 |
| G010 | Beberapa tombol tidak berfungsi | tombol mati, sebagian tombol, beberapa tombol rusak, tombol tidak berfungsi, tombol macet, tombol ga bisa, tombol gak bisa, tombol rusak, tombol keras, tombol susah ditekan, tombol susah dipencet, tombol ga fungsi, tombol error | 0.7 |
| G011 | Keyboard mengetik sendiri | ketik sendiri, ghost typing, mengetik otomatis, keyboard short, ngetik sendiri, keyboard ngetik sendiri, tombol kepencet sendiri, huruf keluar sendiri | 0.8 |
| G012 | Respon keyboard lambat | keyboard lambat, delay ketik, respon lambat, ketik delay, keyboard lemot, input delay, ketik telat, keyboard lag | 0.5 |
| G013 | Keyboard eksternal berfungsi normal | keyboard external ok, usb keyboard normal, keyboard luar bisa, external keyboard jalan | 0.9 |
| G059 | Ketikan dobel | ketik dobel, ketikan dobel, ketikan ganda, keyboard double, double typing, ngetik dobel, huruf dobel, karakter ganda, ketik 2 kali, ketikan double | 0.7 |
| G087 | Lampu keyboard mati | backlight keyboard mati, lampu keyboard mati, keyboard ga nyala, led keyboard mati, backlit mati, keyboard ga ada lampu, lampu tombol mati | 0.5 |
| G121 | Tombol keyboard lepas/copot | tombol lepas, keycap copot, tombol copot, tombol patah, keycap hilang, penutup tombol lepas, tuts lepas | 0.6 |
| G122 | Keyboard terasa lengket | keyboard lengket, tombol lengket, tombol nyangkut, sticky key, tombol nempel, susah balik tombol | 0.6 |
| G123 | Tombol Enter/Space/Shift tidak berfungsi | enter ga bisa, space ga bisa, shift ga bisa, tombol besar mati, tombol utama rusak | 0.7 |
| G124 | NumLock/CapsLock menyala terus | numlock nyala terus, capslock nyala, indikator lock nyala, huruf kapital terus, angka terus | 0.4 |
| G125 | Keyboard menekan karakter salah | huruf salah, karakter beda, tombol tukar, keyboard acak, ketikan tidak sesuai, output salah | 0.6 |
| G126 | Fn key tidak berfungsi | fn ga bisa, function key mati, fn key rusak, shortcut fn ga jalan, brightness fn ga bisa, volume fn ga bisa | 0.5 |
| G127 | Keyboard bunyi klik abnormal | keyboard bunyi, tombol bunyi aneh, keyboard berisik, tombol klik keras, bunyi patah saat tekan | 0.4 |
| G128 | Semua keyboard mati setelah update | keyboard mati update, keyboard hilang setelah update, driver keyboard hilang, keyboard ga terdeteksi setelah update | 0.6 |

## Kerusakan (Diseases) — 8 Data

| Kode | Nama Kerusakan | Deskripsi | Solusi | Estimasi Biaya | Level |
|------|----------------|-----------|--------|----------------|-------|
| K006 | Keyboard Internal Rusak | Keyboard laptop rusak dan perlu diganti | Ganti keyboard internal dengan yang baru sesuai tipe | Rp 150.000 - Rp 600.000 | Ringan |
| K007 | Konektor Keyboard Bermasalah | Konektor atau jalur keyboard pada motherboard bermasalah | Periksa dan perbaiki konektor keyboard | Rp 100.000 - Rp 300.000 | Ringan |
| K008 | Keyboard Short/Korslet | Terjadi short circuit pada keyboard akibat cairan atau debu | Bersihkan atau ganti keyboard | Rp 100.000 - Rp 500.000 | Ringan |
| K043 | Keycap/Tombol Mekanis Rusak | Keycap atau mekanisme pengunci tombol patah | Ganti keycap individual atau ganti keyboard jika banyak | Rp 50.000 - Rp 300.000 | Ringan |
| K044 | Keyboard Membrane Aus | Lapisan membrane keyboard sudah aus/tipis | Ganti keyboard internal | Rp 150.000 - Rp 500.000 | Ringan |
| K045 | Backlight Keyboard Rusak | LED backlight keyboard tidak menyala | Perbaiki kabel backlight atau ganti keyboard | Rp 150.000 - Rp 500.000 | Ringan |
| K046 | Driver/Firmware Keyboard Error | Driver keyboard corrupt atau firmware bermasalah | Install ulang driver keyboard, update BIOS jika perlu | Rp 50.000 - Rp 150.000 | Ringan |
| K047 | Jalur PCB Keyboard Putus | Jalur konduktif pada PCB keyboard terputus atau korosi | Ganti keyboard internal | Rp 150.000 - Rp 600.000 | Ringan |

## Rules (Aturan IF-THEN) — 30 Data

| Rule | Gejala | Kerusakan | CF Value |
|------|--------|-----------|----------|
| R1 | G009 + G013 | K006 (Keyboard Rusak) | 0.95 |
| R2 | G010 + G013 | K006 (Keyboard Rusak) | 0.9 |
| R3 | G010 | K006 (Keyboard Rusak) | 0.7 |
| R4 | G123 + G013 | K006 (Keyboard Rusak) | 0.9 |
| R5 | G125 + G013 | K006 (Keyboard Rusak) | 0.85 |
| R6 | G009 | K007 (Konektor Bermasalah) | 0.6 |
| R7 | G009 + G012 | K007 (Konektor Bermasalah) | 0.75 |
| R8 | G009 + G013 + G012 | K007 (Konektor Bermasalah) | 0.8 |
| R9 | G011 | K008 (Keyboard Short) | 0.85 |
| R10 | G011 + G122 | K008 (Keyboard Short) | 0.9 |
| R11 | G011 + G009 | K008 (Keyboard Short) | 0.85 |
| R12 | G125 + G011 | K008 (Keyboard Short) | 0.85 |
| R13 | G121 | K043 (Keycap Rusak) | 0.9 |
| R14 | G121 + G010 | K043 (Keycap Rusak) | 0.85 |
| R15 | G127 + G121 | K043 (Keycap Rusak) | 0.85 |
| R16 | G059 | K044 (Membrane Aus) | 0.8 |
| R17 | G059 + G012 | K044 (Membrane Aus) | 0.85 |
| R18 | G122 + G059 | K044 (Membrane Aus) | 0.8 |
| R19 | G010 + G059 | K044 (Membrane Aus) | 0.8 |
| R20 | G122 + G012 | K044 (Membrane Aus) | 0.75 |
| R21 | G087 | K045 (Backlight Rusak) | 0.85 |
| R22 | G087 + G126 | K045 (Backlight Rusak) | 0.8 |
| R23 | G087 + G009 | K045 (Backlight Rusak) | 0.7 |
| R24 | G128 | K046 (Driver Error) | 0.8 |
| R25 | G128 + G013 | K046 (Driver Error) | 0.9 |
| R26 | G126 | K046 (Driver Error) | 0.7 |
| R27 | G124 + G128 | K046 (Driver Error) | 0.75 |
| R28 | G010 + G122 | K047 (Jalur PCB Putus) | 0.75 |
| R29 | G123 + G010 | K047 (Jalur PCB Putus) | 0.8 |
| R30 | G010 + G012 + G013 | K047 (Jalur PCB Putus) | 0.85 |

## Pertanyaan Kategori — 6 Data

| No | Pertanyaan | Expected Keyword | Leads To |
|----|------------|------------------|----------|
| 1 | Apakah keyboard eksternal USB berfungsi normal di laptop ini? | ya, normal, bisa, fungsi | G013 |
| 2 | Apakah ada tombol yang mengetik karakter ganda (dobel)? | ya, iya, dobel, ganda, double | G059 |
| 3 | Apakah ada tombol yang secara fisik lepas atau copot? | ya, iya, lepas, copot, patah | G121 |
| 4 | Apakah keyboard terasa lengket saat ditekan? | ya, iya, lengket, sticky, nyangkut | G122 |
| 5 | Apakah masalah keyboard muncul setelah update Windows/driver? | ya, iya, setelah update, habis update | G128 |
| 6 | Apakah lampu backlight keyboard masih menyala? | tidak, mati, ga nyala, gak nyala | G087 |

---

**Total data kategori Keyboard: 15 + 8 + 30 + 6 = 59**
