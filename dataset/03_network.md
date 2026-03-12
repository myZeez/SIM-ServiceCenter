# 3. Network / Jaringan

## Gejala (Symptoms) — 16 Data

| Kode | Nama Gejala | Keywords | Bobot |
|------|-------------|----------|-------|
| G014 | WiFi tidak terdeteksi | wifi hilang, wifi tidak ada, no wifi, wifi mati, wifi tidak konek, wifi ga konek, wifi gak konek, wifi error, wifi ga ada, wifi gak ada, sinyal wifi hilang, wifi ga muncul, wifi ilang | 0.8 |
| G015 | WiFi sering terputus | wifi putus, disconnect, wifi tidak stabil, putus nyambung, wifi putus-putus, sinyal lemah, sinyal putus, wifi sering putus, koneksi putus, wifi nyambung putus | 0.6 |
| G016 | Internet lambat padahal WiFi kuat | internet lambat, wifi lambat, koneksi lemot, wifi lemot, koneksi lambat, internet lemot, inet lemot, loading lambat | 0.5 |
| G017 | Bluetooth tidak berfungsi | bluetooth mati, bluetooth hilang, no bluetooth, bluetooth error, bluetooth ga konek, bluetooth tidak konek, bt mati, bt ga bisa, bluetooth ga bisa, bluetooth rusak, bt error | 0.7 |
| G129 | WiFi hanya terdeteksi jarak dekat | wifi lemah, sinyal pendek, wifi dekat aja, jangkauan wifi kecil, wifi ga sampai, wifi cuma deket | 0.6 |
| G130 | WiFi konek tapi no internet | connected no internet, konek tapi ga bisa browsing, wifi nyambung tapi ga ada internet, limited connection | 0.5 |
| G131 | Bluetooth sering disconnect | bluetooth putus, bt disconnect, bluetooth ga stabil, bluetooth putus-putus, perangkat bt sering lepas | 0.5 |
| G132 | WiFi adapter disabled di Device Manager | wifi disabled, adapter off, wifi dinonaktifkan, network adapter mati, wireless off | 0.7 |
| G133 | Tidak ada opsi WiFi di Settings | wifi hilang dari settings, no wireless option, wifi ga ada di pengaturan, wireless menghilang | 0.8 |
| G134 | Bluetooth tidak bisa pairing | bt ga bisa pair, bluetooth gagal konek, pairing failed, bluetooth ga bisa sambung, perangkat bt ga ketemu | 0.5 |
| G135 | Airplane mode tidak bisa dimatikan | airplane mode stuck, mode pesawat ga bisa off, airplane mode error, stuck airplane, flight mode nyangkut | 0.6 |
| G136 | WiFi lambat hanya di laptop ini | wifi lambat laptop, perangkat lain normal, cuma laptop lambat, hp wifi cepat laptop lambat | 0.5 |
| G137 | LAN/Ethernet tidak terdeteksi | lan mati, ethernet ga bisa, kabel lan ga konek, rj45 ga terdeteksi, port ethernet rusak, network cable ga jalan | 0.7 |
| G138 | WiFi mati setelah sleep/hibernate | wifi mati bangun tidur, wifi hilang setelah sleep, wifi ga konek setelah hibernate, wireless off after sleep | 0.5 |
| G139 | Antena WiFi internal putus | antena wifi putus, kabel antena lepas, antena internal rusak, wifi antenna broken | 0.8 |
| G140 | WiFi card tidak terdeteksi di BIOS | wifi card hilang, wireless card ga ada di bios, wifi module ga kebaca, pcie wifi ga terdeteksi | 0.9 |

## Kerusakan (Diseases) — 8 Data

| Kode | Nama Kerusakan | Deskripsi | Solusi | Estimasi Biaya | Level |
|------|----------------|-----------|--------|----------------|-------|
| K009 | Modul WiFi Rusak | Modul WiFi internal tidak berfungsi | Ganti modul WiFi dengan yang kompatibel | Rp 100.000 - Rp 400.000 | Ringan |
| K010 | Driver WiFi Bermasalah | Driver WiFi corrupt atau tidak kompatibel | Uninstall dan install ulang driver WiFi yang tepat | Rp 50.000 - Rp 150.000 | Ringan |
| K048 | Antena WiFi Internal Putus/Rusak | Kabel antena WiFi yang terhubung ke modul terputus atau rusak | Ganti atau repair kabel antena WiFi internal | Rp 100.000 - Rp 300.000 | Ringan |
| K049 | Modul Bluetooth Rusak | Chip Bluetooth internal rusak atau tidak berfungsi | Ganti modul Bluetooth (biasanya combo dengan WiFi) | Rp 100.000 - Rp 400.000 | Ringan |
| K050 | Driver Bluetooth Bermasalah | Driver Bluetooth corrupt atau tidak kompatibel | Install ulang driver Bluetooth | Rp 50.000 - Rp 150.000 | Ringan |
| K051 | Port Ethernet/LAN Rusak | Port RJ45 Ethernet rusak secara fisik atau IC LAN bermasalah | Perbaiki atau ganti port LAN, atau gunakan USB LAN adapter | Rp 100.000 - Rp 400.000 | Ringan |
| K052 | Pengaturan Network Error (Software) | Konfigurasi jaringan corrupt, DNS/IP salah, atau services tidak jalan | Reset network settings, flush DNS, restart services | Rp 50.000 - Rp 150.000 | Ringan |
| K053 | IC WiFi pada Motherboard Rusak | IC pengontrol wireless pada motherboard mengalami kerusakan | Perbaiki atau ganti IC WiFi di motherboard | Rp 300.000 - Rp 800.000 | Sedang |

## Rules (Aturan IF-THEN) — 28 Data

| Rule | Gejala | Kerusakan | CF Value |
|------|--------|-----------|----------|
| R1 | G014 + G140 | K009 (Modul WiFi Rusak) | 0.95 |
| R2 | G014 + G133 | K009 (Modul WiFi Rusak) | 0.9 |
| R3 | G014 | K009 (Modul WiFi Rusak) | 0.7 |
| R4 | G133 + G140 | K009 (Modul WiFi Rusak) | 0.95 |
| R5 | G015 + G136 | K010 (Driver WiFi Bermasalah) | 0.8 |
| R6 | G016 + G136 | K010 (Driver WiFi Bermasalah) | 0.75 |
| R7 | G132 | K010 (Driver WiFi Bermasalah) | 0.8 |
| R8 | G138 | K010 (Driver WiFi Bermasalah) | 0.7 |
| R9 | G135 | K010 (Driver WiFi Bermasalah) | 0.65 |
| R10 | G015 | K010 (Driver WiFi Bermasalah) | 0.6 |
| R11 | G129 + G139 | K048 (Antena Putus) | 0.95 |
| R12 | G129 | K048 (Antena Putus) | 0.75 |
| R13 | G015 + G129 | K048 (Antena Putus) | 0.85 |
| R14 | G139 | K048 (Antena Putus) | 0.9 |
| R15 | G017 | K049 (Modul Bluetooth Rusak) | 0.75 |
| R16 | G017 + G134 | K049 (Modul Bluetooth Rusak) | 0.85 |
| R17 | G017 + G140 | K049 (Modul Bluetooth Rusak) | 0.9 |
| R18 | G131 | K050 (Driver Bluetooth Error) | 0.65 |
| R19 | G134 | K050 (Driver Bluetooth Error) | 0.6 |
| R20 | G131 + G134 | K050 (Driver Bluetooth Error) | 0.8 |
| R21 | G137 | K051 (Port Ethernet Rusak) | 0.8 |
| R22 | G137 + G016 | K051 (Port Ethernet Rusak) | 0.85 |
| R23 | G130 | K052 (Network Setting Error) | 0.7 |
| R24 | G016 | K052 (Network Setting Error) | 0.6 |
| R25 | G130 + G136 | K052 (Network Setting Error) | 0.8 |
| R26 | G135 + G014 | K052 (Network Setting Error) | 0.75 |
| R27 | G014 + G140 + G133 | K053 (IC WiFi Motherboard) | 0.9 |
| R28 | G133 + G132 | K053 (IC WiFi Motherboard) | 0.85 |

## Pertanyaan Kategori — 6 Data

| No | Pertanyaan | Expected Keyword | Leads To |
|----|------------|------------------|----------|
| 1 | Apakah WiFi card terdeteksi di Device Manager atau BIOS? | tidak, ga ada, tidak terdeteksi, hilang | G140 |
| 2 | Apakah sinyal WiFi hanya bisa terdeteksi dari jarak sangat dekat? | ya, iya, dekat, lemah, pendek | G129 |
| 3 | Apakah WiFi tersambung tapi tidak bisa browsing internet? | ya, iya, no internet, ga bisa browsing | G130 |
| 4 | Apakah Bluetooth bisa mendeteksi perangkat tapi gagal pairing? | ya, iya, gagal, failed, ga bisa pair | G134 |
| 5 | Apakah laptop dalam mode Airplane Mode yang tidak bisa dimatikan? | ya, iya, stuck, nyangkut, ga bisa off | G135 |
| 6 | Apakah perangkat lain (HP) bisa WiFi normal di jaringan yang sama? | ya, iya, normal, bisa, lancar | G136 |

---

**Total data kategori Network: 16 + 8 + 28 + 6 = 58**
