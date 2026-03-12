# 10. Storage / Penyimpanan

## Gejala (Symptoms) — 16 Data

| Kode | Nama Gejala | Keywords | Bobot |
|------|-------------|----------|-------|
| G060 | Hard drive tidak terdeteksi di BIOS | hdd ga kedeteksi, ssd ga kedeteksi, storage ga terbaca, disk ga muncul di bios, hard drive hilang dari bios | 0.9 |
| G061 | Bunyi klik-klik dari hard drive | bunyi klik, hdd bunyi, klik klik, hard disk bunyi, clicking sound, hdd click | 0.9 |
| G062 | Data corrupt/tidak bisa diakses | data rusak, file corrupt, ga bisa buka file, data hilang, file error, data ga bisa diakses | 0.7 |
| G063 | Hard drive sangat lambat | hdd lambat, ssd lambat, disk pelan, storage lambat, loading dari disk lama | 0.6 |
| G198 | Muncul pesan SMART warning | smart warning, smart error, disk failure predicted, smart caution, smart bad | 0.9 |
| G199 | Hard drive terdeteksi dengan kapasitas salah | kapasitas salah, hdd size salah, ssd kapasitas beda, disk ukuran ga sesuai | 0.8 |
| G200 | Muncul bad sector di disk check | bad sector, bad block, chkdsk error, disk check error, sector rusak | 0.8 |
| G201 | SSD tiba-tiba read-only / tidak bisa ditulis | ssd read only, ga bisa nulis, write protected, ssd ga bisa simpan, disk write error | 0.9 |
| G202 | Laptop booting lama saat load dari disk | boot dari disk lama, loading os lambat, splash screen lama, disk booting lambat | 0.6 |
| G203 | Partisi hilang atau tidak terlihat | partisi hilang, drive D hilang, partisi ga muncul, disk management kosong | 0.8 |
| G204 | File sering corrupt saat disalin | file rusak saat copy, corrupt saat transfer, file error habis copy, data korup download | 0.7 |
| G205 | Hard drive terdeteksi lalu hilang berulang kali | hdd connect disconnect, disk on off, storage intermittent, hdd kadang kebaca kadang ngga | 0.8 |
| G206 | Muncul pesan "Disk Boot Failure" | disk boot failure, insert system disk, disk error boot | 0.9 |
| G207 | Suhu hard drive/SSD sangat panas | disk panas, ssd panas, hdd temp tinggi, storage overheat | 0.6 |
| G208 | Menulis ke disk sangat lambat | write lambat, nulis data pelan, save file lama, copy ke disk lambat | 0.6 |
| G209 | Disk usage 100% di Task Manager secara konstan | disk 100 task manager, disk usage penuh, disk terus 100, disk aktif terus | 0.7 |

## Kerusakan (Diseases) — 8 Data

| Kode | Nama Kerusakan | Deskripsi | Solusi | Estimasi Biaya | Level |
|------|----------------|-----------|--------|----------------|-------|
| K029 | Hard Disk (HDD) Rusak Total | Piringan HDD rusak, head crash, atau motor mati | Ganti HDD, recovery data jika dibutuhkan | Rp 300.000 - Rp 1.500.000 | Berat |
| K030 | SSD Degradasi/Failing | Chip NAND SSD mengalami degradasi atau controller bermasalah | Ganti SSD, backup data terlebih dahulu | Rp 300.000 - Rp 1.500.000 | Sedang |
| K091 | Bad Sector pada HDD | Sektor-sektor di HDD rusak menyebabkan data corrupt | Backup data, gunakan tools HDD repair, pertimbangkan ganti | Rp 100.000 - Rp 800.000 | Sedang |
| K092 | Kabel SATA/Konektor Storage Longgar | Kabel SATA atau konektor M.2/NVMe longgar | Pasang ulang kabel/konektor, ganti jika rusak | Rp 50.000 - Rp 200.000 | Ringan |
| K093 | SSD Controller Bermasalah | Controller chip pada SSD mengalami error | Firmware update SSD, jika gagal ganti SSD | Rp 300.000 - Rp 1.200.000 | Berat |
| K094 | Partisi Tabel Corrupt (Storage) | MBR/GPT partition table pada disk corrupt | Repair partition table, gunakan recovery tools | Rp 100.000 - Rp 300.000 | Ringan |
| K095 | Hard Drive Overheating | Hard drive terlalu panas menyebabkan performa menurun | Perbaiki ventilasi, tambah thermal pad, ganti jika rusak | Rp 100.000 - Rp 400.000 | Sedang |
| K096 | SATA Port Motherboard Rusak | Port SATA di motherboard tidak berfungsi | Pindah ke port lain, repair port SATA, atau gunakan adapter USB | Rp 100.000 - Rp 500.000 | Sedang |

## Rules (Aturan IF-THEN) — 28 Data

| Rule | Gejala | Kerusakan | CF Value |
|------|--------|-----------|----------|
| R1 | G061 | K029 (HDD Rusak Total) | 0.9 |
| R2 | G060 + G061 | K029 (HDD Rusak Total) | 0.95 |
| R3 | G060 | K029 (HDD Rusak Total) | 0.7 |
| R4 | G061 + G062 | K029 (HDD Rusak Total) | 0.95 |
| R5 | G206 + G061 | K029 (HDD Rusak Total) | 0.95 |
| R6 | G201 | K030 (SSD Degradasi) | 0.9 |
| R7 | G198 + G063 | K030 (SSD Degradasi) | 0.9 |
| R8 | G199 | K030 (SSD Degradasi) | 0.85 |
| R9 | G201 + G198 | K030 (SSD Degradasi) | 0.95 |
| R10 | G200 | K091 (Bad Sector) | 0.85 |
| R11 | G200 + G062 | K091 (Bad Sector) | 0.9 |
| R12 | G204 + G200 | K091 (Bad Sector) | 0.9 |
| R13 | G200 + G063 | K091 (Bad Sector) | 0.85 |
| R14 | G205 | K092 (Kabel/Konektor Longgar) | 0.8 |
| R15 | G205 + G060 | K092 (Kabel/Konektor Longgar) | 0.85 |
| R16 | G060 + G205 | K092 (Kabel/Konektor Longgar) | 0.85 |
| R17 | G201 + G199 | K093 (SSD Controller) | 0.9 |
| R18 | G198 + G201 | K093 (SSD Controller) | 0.9 |
| R19 | G199 + G208 | K093 (SSD Controller) | 0.85 |
| R20 | G203 | K094 (Partisi Corrupt) | 0.8 |
| R21 | G203 + G062 | K094 (Partisi Corrupt) | 0.85 |
| R22 | G206 + G203 | K094 (Partisi Corrupt) | 0.9 |
| R23 | G207 + G063 | K095 (Drive Overheating) | 0.85 |
| R24 | G207 | K095 (Drive Overheating) | 0.75 |
| R25 | G207 + G208 | K095 (Drive Overheating) | 0.85 |
| R26 | G060 + G199 | K096 (SATA Port Rusak) | 0.8 |
| R27 | G205 + G199 | K096 (SATA Port Rusak) | 0.8 |
| R28 | G209 + G063 | K091 (Bad Sector) | 0.8 |

## Pertanyaan Kategori — 6 Data

| No | Pertanyaan | Expected Keyword | Leads To |
|----|------------|------------------|----------|
| 1 | Apakah terdengar bunyi klik-klik dari area hard drive laptop? | ya, iya, klik, bunyi, klik-klik | G061 |
| 2 | Apakah hard drive/SSD terdeteksi di BIOS? | tidak, ga kedeteksi, hilang | G060 |
| 3 | Apakah muncul pesan SMART warning atau bad sector? | ya, iya, smart error, bad sector | G198 |
| 4 | Apakah disk kadang terdeteksi kadang hilang? | ya, iya, kadang hilang, on off | G205 |
| 5 | Apakah SSD tiba-tiba menjadi read-only? | ya, iya, read only, ga bisa nulis | G201 |
| 6 | Apakah ada partisi yang hilang atau tidak muncul? | ya, iya, partisi hilang, drive hilang | G203 |

---

**Total data kategori Storage: 16 + 8 + 28 + 6 = 58**
