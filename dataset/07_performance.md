# 7. Performance / Performa

## Gejala (Symptoms) — 16 Data

| Kode | Nama Gejala | Keywords | Bobot |
|------|-------------|----------|-------|
| G040 | Laptop sangat lambat | laptop lambat, lemot, slow, laptop pelan, lelet, lamban, loading lama, laptop lama, laptop berat, lag | 0.6 |
| G041 | RAM sering penuh | ram penuh, ram habis, memory full, out of memory, pemakaian ram tinggi, ram usage 100, ram tinggi | 0.7 |
| G042 | CPU usage selalu tinggi | cpu tinggi, cpu 100%, processor full, cpu usage tinggi, cpu overload, prosesor tinggi, cpu selalu 100 | 0.7 |
| G043 | Laptop lag saat multitasking | lag multitask, lemot banyak app, lambat banyak tab, hang banyak program, lag buka banyak | 0.6 |
| G044 | Startup lambat lebih dari 5 menit | startup lambat, booting lama, booting lambat, loading awal lama, nyala lama banget | 0.6 |
| G045 | Aplikasi berat tidak bisa dijalankan | app ga jalan, aplikasi berat error, ga bisa buka app berat, minimum requirement, spek kurang | 0.5 |
| G169 | Fan laptop berputar kencang terus-menerus | fan kencang, kipas berisik terus, fan full speed, kipas ngebut terus, fan ga berhenti | 0.6 |
| G170 | Game stuttering atau FPS drop | fps drop, game lag, stuttering, game patah-patah, fps rendah, game ngelag, frame drop | 0.6 |
| G171 | Laptop freeze beberapa detik secara berkala | freeze berkala, hang sebentar-sebentar, micro freeze, stutter berkala, lag periodic | 0.7 |
| G172 | Laptop throttling (performa turun saat panas) | throttling, performa turun panas, clock speed turun, cpu turun kecepatan, thermal throttle | 0.8 |
| G173 | Waktu render/export sangat lama | render lama, export lama, encoding lambat, render berjam-jam, proses lama | 0.5 |
| G174 | Laptop lama saat copy/paste file besar | copy lambat, transfer file lama, salin file lambat, copy paste lama, file transfer pelan | 0.6 |
| G175 | Browser sangat lambat atau sering crash | browser lambat, chrome lemot, browser crash, firefox lambat, edge crash, browser hang | 0.5 |
| G176 | Indexing Windows berjalan terus-menerus | indexing terus, windows search lambat, indexer disk usage, indexing service | 0.5 |
| G177 | Banyak program berjalan di background | banyak program background, startup program banyak, terlalu banyak app jalan | 0.5 |
| G178 | Laptop lemot setelah beberapa jam digunakan | lemot setelah lama, makin lama makin lambat, awalnya cepat lalu lambat, degradasi performa | 0.6 |

## Kerusakan (Diseases) — 8 Data

| Kode | Nama Kerusakan | Deskripsi | Solusi | Estimasi Biaya | Level |
|------|----------------|-----------|--------|----------------|-------|
| K020 | RAM Tidak Memadai / Rusak | Kapasitas RAM terlalu kecil atau modul RAM bermasalah | Upgrade RAM atau ganti modul RAM yang rusak | Rp 200.000 - Rp 1.000.000 | Ringan |
| K021 | Hard Drive Lambat / Degradasi | Hard drive HDD sudah tua atau mengalami degradasi performa | Upgrade ke SSD atau ganti hard drive | Rp 300.000 - Rp 1.200.000 | Sedang |
| K022 | Prosesor Overheat (Throttling) | CPU overheat menyebabkan throttling dan penurunan performa | Ganti thermal paste, bersihkan heatsink, cek kipas | Rp 100.000 - Rp 300.000 | Sedang |
| K077 | Bloatware / Background Process Berlebih | Terlalu banyak program startup dan background processes | Disable startup programs, uninstall bloatware, optimize OS | Rp 50.000 - Rp 150.000 | Ringan |
| K078 | VGA/GPU Throttling | GPU overheat atau driver bermasalah menyebabkan game lag | Update driver GPU, bersihkan thermal paste GPU, cek VRAM | Rp 100.000 - Rp 500.000 | Sedang |
| K079 | RAM Dual Channel Tidak Aktif | Hanya 1 slot RAM terisi atau konfigurasi tidak optimal | Tambah RAM di slot kedua agar dual channel aktif | Rp 200.000 - Rp 600.000 | Ringan |
| K080 | Storage Hampir Penuh | Drive penyimpanan hampir penuh sehingga performa turun | Bersihkan file, pindahkan data, atau tambah storage | Rp 0 - Rp 500.000 | Ringan |
| K081 | Memory Leak pada Software | Aplikasi tertentu memiliki memory leak yang menghabiskan RAM | Update aplikasi, tutup dan restart aplikasi secara berkala | Rp 0 - Rp 100.000 | Ringan |

## Rules (Aturan IF-THEN) — 30 Data

| Rule | Gejala | Kerusakan | CF Value |
|------|--------|-----------|----------|
| R1 | G041 + G043 | K020 (RAM Bermasalah) | 0.85 |
| R2 | G041 | K020 (RAM Bermasalah) | 0.7 |
| R3 | G040 + G041 | K020 (RAM Bermasalah) | 0.8 |
| R4 | G043 + G045 | K020 (RAM Bermasalah) | 0.75 |
| R5 | G041 + G031 | K020 (RAM Bermasalah) | 0.85 |
| R6 | G044 + G033 | K021 (HDD Lambat) | 0.85 |
| R7 | G174 | K021 (HDD Lambat) | 0.8 |
| R8 | G040 + G044 | K021 (HDD Lambat) | 0.8 |
| R9 | G162 + G044 | K021 (HDD Lambat) | 0.85 |
| R10 | G176 + G044 | K021 (HDD Lambat) | 0.75 |
| R11 | G174 + G162 | K021 (HDD Lambat) | 0.85 |
| R12 | G172 + G042 | K022 (CPU Throttling) | 0.9 |
| R13 | G172 | K022 (CPU Throttling) | 0.8 |
| R14 | G042 + G169 | K022 (CPU Throttling) | 0.85 |
| R15 | G178 + G172 | K022 (CPU Throttling) | 0.9 |
| R16 | G177 + G040 | K077 (Bloatware) | 0.75 |
| R17 | G177 + G044 | K077 (Bloatware) | 0.8 |
| R18 | G177 + G042 | K077 (Bloatware) | 0.8 |
| R19 | G177 | K077 (Bloatware) | 0.65 |
| R20 | G170 | K078 (GPU Throttling) | 0.75 |
| R21 | G170 + G172 | K078 (GPU Throttling) | 0.85 |
| R22 | G170 + G169 | K078 (GPU Throttling) | 0.8 |
| R23 | G173 + G170 | K078 (GPU Throttling) | 0.8 |
| R24 | G043 + G045 + G041 | K079 (Dual Channel Off) | 0.7 |
| R25 | G040 + G045 | K079 (Dual Channel Off) | 0.6 |
| R26 | G044 + G174 + G176 | K080 (Storage Penuh) | 0.8 |
| R27 | G040 + G176 | K080 (Storage Penuh) | 0.7 |
| R28 | G178 + G041 | K081 (Memory Leak) | 0.8 |
| R29 | G178 | K081 (Memory Leak) | 0.65 |
| R30 | G171 + G041 | K081 (Memory Leak) | 0.75 |

## Pertanyaan Kategori — 6 Data

| No | Pertanyaan | Expected Keyword | Leads To |
|----|------------|------------------|----------|
| 1 | Apakah laptop terasa sangat lambat saat membuka banyak aplikasi? | ya, iya, lambat, lemot, banyak aplikasi | G043 |
| 2 | Apakah laptop menggunakan HDD atau sudah SSD? | hdd, hard disk | G044 |
| 3 | Apakah game atau aplikasi berat sering lag/stuttering? | ya, iya, lag, stuttering, fps drop | G170 |
| 4 | Apakah performa laptop menurun setelah beberapa jam pemakaian? | ya, iya, makin lambat, turun, setelah lama | G178 |
| 5 | Apakah banyak program yang otomatis berjalan saat startup? | ya, iya, banyak program, startup banyak | G177 |
| 6 | Apakah fan/kipas laptop berputar sangat kencang saat bekerja? | ya, iya, kipas kencang, fan berisik | G169 |

---

**Total data kategori Performance: 16 + 8 + 30 + 6 = 60**
