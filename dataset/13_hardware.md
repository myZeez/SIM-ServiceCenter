# 13. Hardware / Motherboard

## Gejala (Symptoms) — 14 Data

| Kode | Nama Gejala | Keywords | Bobot |
|------|-------------|----------|-------|
| G098 | Laptop hidup tapi layar gelap total (no display) | layar gelap hidup, no display, layar hitam tapi hidup, nyala tapi ga ada tampilan | 0.8 |
| G228 | Laptop tidak merespon apapun saat dinyalakan | ga respon, no response, mati suri, nyala tapi ga bisa apa-apa, dead board | 0.9 |
| G229 | VGA/GPU artifacts muncul di layar | artifacts, kotak-kotak warna, garis acak warna, gpu error, vga error, pixel warna-warni | 0.9 |
| G230 | Slot RAM tidak terdeteksi | slot ram mati, ram slot 2 ga kebaca, satu slot ram ga fungsi, dimm ga kedeteksi | 0.8 |
| G231 | USB/port tertentu tidak berfungsi padahal lainnya normal | satu port mati, port tertentu error, sebagian port ga jalan, port lain normal | 0.6 |
| G232 | BIOS tidak menyimpan pengaturan (reset terus) | bios reset, cmos reset, tanggal selalu reset, setting bios hilang, bios ga nyimpan | 0.7 |
| G233 | Laptop mengeluarkan bau komponen terbakar | bau terbakar, bau gosong, komponen terbakar, bau hangus dari dalam | 0.9 |
| G234 | Tampilan tiba-tiba freeze lalu layar mati | freeze lalu mati, display crash, tampilan beku lalu gelap, layar freeze mati | 0.8 |
| G235 | Laptop tidak bisa detect RAM baru yang dipasang | ram baru ga kebaca, upgrade ram ga detect, ram ga terbaca, ram baru tidak kompatibel | 0.7 |
| G236 | POST (Power-On Self-Test) gagal | post fail, post error, gagal post, bios ga lanjut, beep code error | 0.9 |
| G237 | Chipset motherboard terasa sangat panas | chipset panas, ic panas, komponen motherboard panas, mosfet panas | 0.7 |
| G238 | Laptop hanya menampilkan layar putih total saat nyala | layar putih total, white screen boot, layar putih saat nyala, monitor putih | 0.8 |
| G239 | Voltase motherboard tidak stabil (diukur dengan multimeter) | voltase ga stabil, voltase drop, power rail error, tegangan ga stabil | 0.8 |
| G240 | WiFi + Bluetooth + USB mati semua bersamaan | semua port mati, wifi bt usb mati, peripheral semua mati, io mati semua | 0.9 |

## Kerusakan (Diseases) — 10 Data

| Kode | Nama Kerusakan | Deskripsi | Solusi | Estimasi Biaya | Level |
|------|----------------|-----------|--------|----------------|-------|
| K034 | GPU/VGA Chip Rusak (BGA Failure) | Chip GPU mengalami reflow/BGA failure | Reballing atau ganti GPU chip | Rp 500.000 - Rp 2.000.000 | Berat |
| K035 | Motherboard Mati Total | Motherboard tidak berfungsi sama sekali | Ganti motherboard atau repair komponen yang rusak | Rp 500.000 - Rp 3.000.000 | Berat |
| K036 | PCH/Chipset Rusak | Platform Controller Hub (PCH/Southbridge) rusak | Ganti chipset atau motherboard | Rp 400.000 - Rp 1.500.000 | Berat |
| K037 | RAM Slot Motherboard Rusak | Slot RAM di motherboard bermasalah | Repair slot RAM atau ganti motherboard | Rp 200.000 - Rp 800.000 | Sedang |
| K108 | BIOS Chip Rusak / CMOS Battery Habis | Chip BIOS rusak atau baterai CMOS habis | Ganti baterai CMOS, flash ulang BIOS chip | Rp 50.000 - Rp 300.000 | Ringan |
| K109 | VRM (Voltage Regulator Module) Rusak | VRM pada motherboard rusak menyebabkan voltase tidak stabil | Ganti komponen VRM (MOSFET, kapasitor, induktor) | Rp 300.000 - Rp 800.000 | Berat |
| K110 | I/O Controller Chip Rusak | Chip pengendali I/O (USB, LAN, dll) pada motherboard rusak | Ganti IC I/O controller | Rp 300.000 - Rp 700.000 | Berat |
| K111 | VRAM GPU Rusak | Video RAM pada GPU chip bermasalah | Ganti VRAM chip atau reball GPU module | Rp 400.000 - Rp 1.500.000 | Berat |
| K112 | Kapasitor/Komponen SMD Rusak | Kapasitor, resistor, atau komponen SMD di motherboard rusak | Diagnosa dan ganti komponen SMD yang rusak | Rp 100.000 - Rp 500.000 | Sedang |
| K113 | Trace/Jalur PCB Putus | Jalur tembaga di PCB motherboard putus | Jumper wire atau repair trace yang putus | Rp 200.000 - Rp 600.000 | Sedang |

## Rules (Aturan IF-THEN) — 35 Data

| Rule | Gejala | Kerusakan | CF Value |
|------|--------|-----------|----------|
| R1 | G229 | K034 (GPU Rusak) | 0.85 |
| R2 | G098 + G229 | K034 (GPU Rusak) | 0.9 |
| R3 | G234 + G229 | K034 (GPU Rusak) | 0.9 |
| R4 | G238 | K034 (GPU Rusak) | 0.75 |
| R5 | G229 + G237 | K034 (GPU Rusak) | 0.9 |
| R6 | G023 + G088 + G156 | K035 (Motherboard Mati) | 0.9 |
| R7 | G228 | K035 (Motherboard Mati) | 0.85 |
| R8 | G233 + G023 | K035 (Motherboard Mati) | 0.95 |
| R9 | G236 + G023 | K035 (Motherboard Mati) | 0.9 |
| R10 | G228 + G088 | K035 (Motherboard Mati) | 0.9 |
| R11 | G240 | K036 (PCH Rusak) | 0.8 |
| R12 | G240 + G231 | K036 (PCH Rusak) | 0.85 |
| R13 | G237 + G240 | K036 (PCH Rusak) | 0.9 |
| R14 | G237 + G031 | K036 (PCH Rusak) | 0.8 |
| R15 | G230 | K037 (RAM Slot Rusak) | 0.85 |
| R16 | G235 | K037 (RAM Slot Rusak) | 0.75 |
| R17 | G230 + G235 | K037 (RAM Slot Rusak) | 0.9 |
| R18 | G230 + G041 | K037 (RAM Slot Rusak) | 0.85 |
| R19 | G232 | K108 (BIOS/CMOS) | 0.85 |
| R20 | G232 + G236 | K108 (BIOS/CMOS) | 0.9 |
| R21 | G158 + G232 | K108 (BIOS/CMOS) | 0.85 |
| R22 | G239 | K109 (VRM Rusak) | 0.85 |
| R23 | G239 + G237 | K109 (VRM Rusak) | 0.9 |
| R24 | G149 + G239 | K109 (VRM Rusak) | 0.85 |
| R25 | G233 + G237 | K109 (VRM Rusak) | 0.9 |
| R26 | G231 + G240 | K110 (I/O Controller Rusak) | 0.85 |
| R27 | G240 + G098 | K110 (I/O Controller Rusak) | 0.8 |
| R28 | G231 | K110 (I/O Controller Rusak) | 0.65 |
| R29 | G229 + G170 | K111 (VRAM Rusak) | 0.85 |
| R30 | G229 + G234 | K111 (VRAM Rusak) | 0.85 |
| R31 | G229 + G238 | K111 (VRAM Rusak) | 0.85 |
| R32 | G233 | K112 (Komponen SMD Rusak) | 0.7 |
| R33 | G233 + G029 | K112 (Komponen SMD Rusak) | 0.8 |
| R34 | G239 + G029 | K113 (Trace PCB Putus) | 0.8 |
| R35 | G239 + G231 | K113 (Trace PCB Putus) | 0.8 |

## Pertanyaan Kategori — 6 Data

| No | Pertanyaan | Expected Keyword | Leads To |
|----|------------|------------------|----------|
| 1 | Apakah muncul artifacts (kotak-kotak warna atau garis acak) di layar? | ya, iya, artifact, kotak warna, garis acak | G229 |
| 2 | Apakah laptop nyala (lampu menyala, fan berputar) tapi tidak ada tampilan? | ya, iya, no display, ga ada tampilan | G098 |
| 3 | Apakah ada bau komponen terbakar dari laptop? | ya, iya, bau, terbakar, hangus, gosong | G233 |
| 4 | Apakah pengaturan BIOS selalu reset setiap kali laptop dimatikan? | ya, iya, reset, tanggal salah, bios reset | G232 |
| 5 | Apakah ada slot RAM atau port yang tidak berfungsi? | ya, iya, slot mati, port mati | G230 |
| 6 | Apakah semua port (USB, WiFi, Bluetooth) mati bersamaan? | ya, iya, semua mati, sekaligus | G240 |

---

**Total data kategori Hardware: 14 + 10 + 35 + 6 = 65**
