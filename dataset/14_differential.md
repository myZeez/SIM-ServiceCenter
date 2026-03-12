# 14. Differential / Pembeda (Pertanyaan Klarifikasi)

Kategori ini berisi gejala dan pertanyaan untuk membedakan diagnosis yang mirip.

## Gejala Pembeda (Symptoms) — 20 Data

| Kode | Nama Gejala | Keywords | Bobot | Fungsi |
|------|-------------|----------|-------|--------|
| G099 | Masalah terjadi setelah jatuh/benturan | jatuh, kebentur, terbentur, terjatuh, drop, benturan, kena pukul, laptop jatuh | 0.8 | Membedakan kerusakan fisik vs software |
| G100 | Masalah terjadi setelah install software | setelah install, habis install, install baru, update software, install program | 0.7 | Membedakan software vs hardware |
| G101 | Masalah terjadi secara bertahap (makin parah) | makin parah, bertahap, pelan-pelan, progressive, makin buruk, lama-lama | 0.6 | Membedakan degradasi vs kerusakan mendadak |
| G102 | Masalah terjadi tiba-tiba tanpa tanda | tiba-tiba, mendadak, tanpa tanda, tau-tau, langsung, tanpa peringatan | 0.7 | Membedakan kerusakan mendadak vs degradasi |
| G103 | Masalah muncul di mode Safe Mode juga | safe mode juga, tetep di safe mode, masih error di safe mode, safe mode ga ngaruh | 0.8 | Membedakan hardware vs software |
| G104 | Masalah hilang di Safe Mode | hilang di safe mode, normal di safe mode, di safe mode bagus, safe mode ok | 0.8 | Indikasi masalah software/driver |
| G105 | Masalah terjadi setelah update Windows | setelah update windows, habis update, windows update | 0.7 | Indikasi driver/software |
| G106 | Masalah muncul saat laptop panas | muncul saat panas, error kalau panas, masalah saat overheat, kalo panas | 0.7 | Indikasi thermal/solder joint |
| G241 | Masalah hanya muncul saat menggunakan baterai | hanya baterai, masalah tanpa charger, error saat baterai, baterai aja error | 0.7 | Membedakan baterai vs power supply |
| G242 | Masalah hanya muncul saat menggunakan charger | hanya charger, error pakai charger, masalah saat dicas | 0.7 | Membedakan charger vs komponen lain |
| G243 | Masalah terjadi di semua OS termasuk bootable USB | error semua os, di linux juga error, di usb boot juga, bios juga error | 0.8 | Konfirmasi masalah hardware |
| G244 | Masalah hanya di satu OS tertentu | hanya di windows, cuma di os ini, di linux normal, di os lain bagus | 0.7 | Konfirmasi masalah software |
| G245 | External monitor berfungsi normal | monitor external ok, tampil di external, hdmi normal, external bagus | 0.8 | Membedakan GPU vs LCD |
| G246 | External monitor juga bermasalah | external juga error, monitor luar juga, hdmi juga error | 0.8 | Konfirmasi masalah GPU |
| G247 | RAM lolos tes memtest | memtest ok, ram test pass, ram tes normal, memtest86 ok | 0.8 | Eliminasi RAM sebagai penyebab |
| G248 | RAM gagal tes memtest | memtest fail, ram test gagal, memtest error, ram error memtest | 0.9 | Konfirmasi RAM rusak |
| G249 | Masalah terjadi setelah upgrade komponen | setelah upgrade, habis ganti, setelah tambah ram, setelah ganti ssd | 0.7 | Indikasi kompatibilitas |
| G250 | Masalah terjadi pada posisi layar tertentu | posisi layar tertentu, kalau layar dibuka ya, sudut tertentu error, posisi engsel | 0.8 | Indikasi kabel flex/LCD |
| G251 | Masalah terjadi saat laptop digerakkan/digoyang | digoyang error, gerakan bikin error, saat dipindah bermasalah, kena getaran | 0.7 | Indikasi loose connection |
| G252 | BIOS sudah di-reset tapi masalah tetap | reset bios ga ngaruh, bios default sama aja, load default ga mempan | 0.6 | Eliminasi konfigurasi BIOS |

## Pertanyaan Klarifikasi — 30 Data

| No | Pertanyaan | Expected Keyword | Diagnosis Direction |
|----|------------|------------------|---------------------|
| 1 | Apakah masalah terjadi setelah laptop terjatuh atau terbentur? | ya, iya, jatuh, bentur | → Physical/Hardware damage |
| 2 | Apakah masalah terjadi setelah menginstall software atau driver baru? | ya, iya, install, software baru | → Software/Driver issue |
| 3 | Apakah masalah terjadi secara tiba-tiba atau bertahap? | tiba-tiba, mendadak | → Hardware failure (sudden) |
| 4 | Apakah masalah terjadi secara tiba-tiba atau bertahap? | bertahap, makin parah | → Degradation (gradual) |
| 5 | Apakah masalah masih muncul saat di Safe Mode? | ya, iya, masih, tetap | → Hardware problem |
| 6 | Apakah masalah masih muncul saat di Safe Mode? | tidak, hilang, normal | → Software/Driver problem |
| 7 | Apakah masalah terjadi setelah update Windows? | ya, iya, setelah update | → Windows Update/Driver issue |
| 8 | Apakah masalah muncul terutama saat laptop sudah panas? | ya, iya, panas, overheat | → Thermal/solder joint issue |
| 9 | Apakah laptop pernah terkena air atau cairan? | ya, iya, kena air, basah, tumpahan | → Water damage |
| 10 | Apakah masalah hanya muncul saat menggunakan baterai (tanpa charger)? | ya, iya, baterai saja | → Battery issue |
| 11 | Apakah masalah hanya muncul saat charger terhubung? | ya, iya, pakai charger | → Charger/power issue |
| 12 | Apakah jika menggunakan external monitor, tampilannya normal? | ya, iya, external ok, normal | → LCD/Cable flex issue |
| 13 | Apakah external monitor juga menunjukkan masalah yang sama? | ya, iya, external juga | → GPU/VGA issue |
| 14 | Apakah sudah mencoba di OS lain (Linux bootable USB misalnya)? | ya, iya, masih error | → Hardware problem |
| 15 | Apakah sudah mencoba di OS lain (Linux bootable USB misalnya)? | di os lain normal | → Software/OS problem |
| 16 | Apakah masalah terjadi setelah upgrade hardware (RAM, SSD, dll)? | ya, iya, setelah upgrade, ganti | → Compatibility issue |
| 17 | Sudah berapa lama laptop digunakan? | lama, tua, lebih 3 tahun | → Component aging/wear |
| 18 | Sudah berapa lama laptop digunakan? | baru, beberapa bulan | → Manufacturing defect |
| 19 | Apakah masalah terjadi saat layar pada posisi/sudut tertentu? | ya, iya, posisi tertentu, sudut | → Cable flex/LCD connection |
| 20 | Apakah masalah muncul saat laptop digerakkan atau digoyang? | ya, iya, digoyang, gerakan | → Loose connection |
| 21 | Apakah sudah mencoba reset BIOS ke default? | sudah, masih sama, ga ngaruh | → Not BIOS config issue |
| 22 | Apakah laptop menggunakan SSD atau masih HDD? | hdd, hard disk | → HDD issue candidate |
| 23 | Apakah laptop menggunakan SSD atau masih HDD? | ssd, solid state | → SSD issue candidate |
| 24 | Apakah masalah terjadi terus-menerus atau kadang-kadang saja? | terus-menerus, selalu | → Consistent failure |
| 25 | Apakah masalah terjadi terus-menerus atau kadang-kadang saja? | kadang-kadang, sesekali | → Intermittent (thermal/contact) |
| 26 | Apakah laptop baru saja dibersihkan atau diservis? | ya, iya, habis servis, habis bersih | → Reassembly issue |
| 27 | Apakah menggunakan charger original atau pengganti? | pengganti, bukan original, copy, kw | → Wrong adapter issue |
| 28 | Apakah menggunakan charger original atau pengganti? | original, asli, bawaan | → Eliminate adapter issue |
| 29 | Apakah ada perangkat USB yang terhubung saat masalah terjadi? | ya, iya, ada usb, ada device | → USB device conflict |
| 30 | Apakah laptop pernah di-overclock atau setting performa tinggi? | ya, iya, overclock, oc | → Overclock instability |

---

**Total data kategori Differential: 20 + 30 = 50**
