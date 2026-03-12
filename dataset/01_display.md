# 1. Display / Layar

## Gejala (Symptoms) — 20 Data

| Kode | Nama Gejala | Keywords | Bobot |
|------|-------------|----------|-------|
| G001 | Layar blank hitam | blank, hitam, gelap, tidak tampil, mati layar, black screen, layar mati, no display, layar kosong, layar gelap, layarnya mati, lcd mati, ga ada tampilan, gak ada tampilan, layar ga nyala, layar gak nyala | 0.8 |
| G002 | Layar bergaris | garis, bergaris, garis vertikal, garis horizontal, strip, ada garis, belang, layar ada garis, garis-garis, striping | 0.9 |
| G003 | Layar berkedip/flicker | kedip, flicker, berkedip, kelap kelip, blinking, goyang, kedap kedip, bergetar, kedip-kedip, layar kedip, layar goyang | 0.7 |
| G004 | Layar redup | redup, gelap, dim, tidak terang, backlight redup, kurang terang, layar gelap, layar remang, cahaya kurang | 0.8 |
| G005 | Layar pecah | pecah, retak, crack, broken screen, lcd pecah, lcd retak, layar rusak, screen pecah, kaca pecah | 1.0 |
| G006 | Warna layar aneh/pudar | warna aneh, pudar, warna pucat, discolor, warna berubah, warna salah, warna ga normal, warna beda, warna pudar | 0.6 |
| G007 | Tampilan normal di monitor eksternal | monitor eksternal normal, external monitor ok, hdmi normal, monitor luar bisa, eksternal bisa | 0.9 |
| G008 | Layar berkedip saat digerakkan | kedip saat gerak, berkedip gerak, flicker gerak, layar kedip kalo digerakin, gerak kedip | 0.9 |
| G109 | Layar ada bercak putih/white spot | bercak putih, white spot, titik putih, noda putih di layar, ada titik terang, white dot, bright spot | 0.7 |
| G110 | Layar ada dead pixel | dead pixel, titik mati, pixel mati, ada titik hitam permanen, pixel stuck, pixel rusak | 0.6 |
| G111 | Layar ada bayangan/ghosting | bayangan, ghosting, shadow, afterimage, bekas gambar, layar ngelag, jejak gambar | 0.6 |
| G112 | Layar kuning/yellowish | layar kuning, yellowish, warna kekuningan, layar menguning, tint kuning, layar warm, layar panas warna | 0.5 |
| G113 | Layar ada garis tipis di pinggir | garis pinggir, border garis, garis tepi, garis samping layar, pinggiran ada garis | 0.7 |
| G114 | Layar hanya setengah menyala | setengah layar, half screen, separuh mati, layar mati sebagian, display setengah | 0.8 |
| G115 | Layar touchscreen tidak responsif | touchscreen mati, layar sentuh error, touch ga respon, digitizer rusak, layar sentuh ga bisa, touchscreen ga jalan | 0.8 |
| G116 | Layar touchscreen ghost touch | ghost touch, sentuh sendiri, touch phantom, layar pencet sendiri, touchscreen klik sendiri | 0.8 |
| G117 | Layar resolusi berubah sendiri | resolusi berubah, display scaling error, layar membesar, tampilan membesar, resolusi rendah sendiri | 0.5 |
| G118 | Layar ada bintik hitam menyebar | bintik hitam, lcd bleeding, spot hitam, noda hitam menyebar, titik hitam bertambah | 0.8 |
| G119 | Layar ada efek pelangi/rainbow | efek pelangi, rainbow effect, warna pelangi, layar warna warni, iridescent screen | 0.7 |
| G120 | Layar mati setelah beberapa menit | layar mati sendiri, display off, layar padam, layar timeout, layar tiba-tiba mati, monitor sleep | 0.7 |

## Kerusakan (Diseases) — 10 Data

| Kode | Nama Kerusakan | Deskripsi | Solusi | Estimasi Biaya | Level |
|------|----------------|-----------|--------|----------------|-------|
| K001 | Kerusakan Panel LCD | Panel LCD internal mengalami kerusakan fisik atau elektronik | Ganti panel LCD dengan yang baru sesuai tipe laptop | Rp 500.000 - Rp 2.500.000 | Sedang |
| K002 | Kabel Flexible LCD Rusak/Longgar | Kabel flexible yang menghubungkan LCD ke motherboard rusak atau terlepas | Periksa dan kencangkan konektor atau ganti kabel flexible LCD | Rp 150.000 - Rp 500.000 | Ringan |
| K003 | Backlight/Inverter Rusak | Lampu backlight atau inverter tidak berfungsi sehingga layar redup | Ganti backlight LED strip atau inverter board | Rp 200.000 - Rp 800.000 | Sedang |
| K004 | GPU/VGA Bermasalah (Artifak Display) | Chip grafis (GPU) mengalami kerusakan sehingga muncul artifak pada layar | Reballing atau ganti chip GPU | Rp 500.000 - Rp 2.000.000 | Berat |
| K005 | LCD Pecah Fisik | Panel LCD mengalami kerusakan fisik (retak/pecah) | Ganti panel LCD baru | Rp 600.000 - Rp 3.000.000 | Sedang |
| K038 | Dead Pixel pada Panel LCD | Panel LCD memiliki titik pixel yang mati/stuck | Ganti panel LCD jika dead pixel banyak, atau gunakan software pixel fix | Rp 500.000 - Rp 2.500.000 | Sedang |
| K039 | Digitizer/Touchscreen Rusak | Digitizer touchscreen tidak merespon sentuhan atau ghost touch | Ganti digitizer/touchscreen assembly | Rp 600.000 - Rp 3.500.000 | Sedang |
| K040 | Panel LCD White Spot/Pressure Mark | Panel LCD memiliki bercak putih akibat tekanan pada panel | Ganti panel LCD | Rp 500.000 - Rp 2.500.000 | Sedang |
| K041 | IC Display/T-CON Bermasalah | IC pengontrol display (T-CON board) bermasalah menyebabkan separuh layar mati | Perbaiki atau ganti T-CON board/IC display | Rp 300.000 - Rp 1.000.000 | Sedang |
| K042 | LCD Aging/Degradasi Panel | Panel LCD mengalami degradasi karena usia pemakaian, warna menguning atau pudar | Ganti panel LCD baru | Rp 500.000 - Rp 2.500.000 | Ringan |

## Rules (Aturan IF-THEN) — 45 Data

| Rule | Gejala | Kerusakan | CF Value |
|------|--------|-----------|----------|
| R1 | G001 + G007 | K001 (Panel LCD Rusak) | 0.95 |
| R2 | G002 + G007 | K001 (Panel LCD Rusak) | 0.9 |
| R3 | G004 + G007 | K001 (Panel LCD Rusak) | 0.85 |
| R4 | G114 + G007 | K001 (Panel LCD Rusak) | 0.9 |
| R5 | G002 | K001 (Panel LCD Rusak) | 0.7 |
| R6 | G003 + G008 | K002 (Kabel Flexible) | 0.9 |
| R7 | G008 | K002 (Kabel Flexible) | 0.85 |
| R8 | G003 + G008 + G007 | K002 (Kabel Flexible) | 0.95 |
| R9 | G001 + G008 | K002 (Kabel Flexible) | 0.85 |
| R10 | G120 + G008 | K002 (Kabel Flexible) | 0.8 |
| R11 | G004 + G007 | K003 (Backlight Rusak) | 0.9 |
| R12 | G004 | K003 (Backlight Rusak) | 0.7 |
| R13 | G004 + G120 | K003 (Backlight Rusak) | 0.85 |
| R14 | G004 + G001 | K003 (Backlight Rusak) | 0.8 |
| R15 | G002 + G006 | K004 (GPU Bermasalah) | 0.8 |
| R16 | G001 + G033 | K004 (GPU Bermasalah) | 0.85 |
| R17 | G111 + G006 | K004 (GPU Bermasalah) | 0.8 |
| R18 | G002 + G111 | K004 (GPU Bermasalah) | 0.85 |
| R19 | G006 + G119 | K004 (GPU Bermasalah) | 0.75 |
| R20 | G111 + G002 + G006 | K004 (GPU Bermasalah) | 0.9 |
| R21 | G005 | K005 (LCD Pecah) | 1.0 |
| R22 | G005 + G002 | K005 (LCD Pecah) | 1.0 |
| R23 | G005 + G001 | K005 (LCD Pecah) | 1.0 |
| R24 | G110 | K038 (Dead Pixel) | 0.9 |
| R25 | G110 + G118 | K038 (Dead Pixel) | 0.95 |
| R26 | G110 + G006 | K038 (Dead Pixel) | 0.85 |
| R27 | G118 | K038 (Dead Pixel) | 0.8 |
| R28 | G115 | K039 (Touchscreen Rusak) | 0.85 |
| R29 | G116 | K039 (Touchscreen Rusak) | 0.9 |
| R30 | G115 + G116 | K039 (Touchscreen Rusak) | 0.95 |
| R31 | G115 + G005 | K039 (Touchscreen Rusak) | 0.9 |
| R32 | G116 + G003 | K039 (Touchscreen Rusak) | 0.85 |
| R33 | G109 | K040 (White Spot) | 0.85 |
| R34 | G109 + G004 | K040 (White Spot) | 0.9 |
| R35 | G109 + G110 | K040 (White Spot) | 0.8 |
| R36 | G114 | K041 (IC Display Rusak) | 0.8 |
| R37 | G114 + G002 | K041 (IC Display Rusak) | 0.9 |
| R38 | G114 + G113 | K041 (IC Display Rusak) | 0.85 |
| R39 | G114 + G006 | K041 (IC Display Rusak) | 0.85 |
| R40 | G113 + G002 | K041 (IC Display Rusak) | 0.8 |
| R41 | G112 | K042 (LCD Aging) | 0.7 |
| R42 | G112 + G006 | K042 (LCD Aging) | 0.85 |
| R43 | G112 + G004 | K042 (LCD Aging) | 0.8 |
| R44 | G006 + G117 | K042 (LCD Aging) | 0.75 |
| R45 | G119 + G006 | K042 (LCD Aging) | 0.7 |

## Pertanyaan Kategori — 8 Data

| No | Pertanyaan | Expected Keyword | Leads To |
|----|------------|------------------|----------|
| 1 | Apakah tampilan normal jika dihubungkan ke monitor eksternal (via HDMI/VGA)? | ya, normal, bisa | G007 |
| 2 | Apakah layar berkedip atau bergaris saat posisi layar digerakkan? | ya, iya, berkedip, flicker | G008 |
| 3 | Apakah ada bercak putih atau titik terang di layar? | ya, iya, ada, bercak, titik | G109 |
| 4 | Apakah ada titik pixel yang mati (hitam permanen) di layar? | ya, iya, ada, pixel, titik | G110 |
| 5 | Apakah layar laptop Anda touchscreen? | ya, iya, touchscreen, layar sentuh | G115 |
| 6 | Apakah layar hanya menyala sebagian (setengah layar saja)? | ya, iya, setengah, sebagian, separuh | G114 |
| 7 | Apakah warna layar terlihat menguning atau kekuningan? | ya, iya, kuning, yellowish, menguning | G112 |
| 8 | Apakah layar mati sendiri setelah beberapa menit digunakan? | ya, iya, mati sendiri, padam, off | G120 |

---

**Total data kategori Display: 20 + 10 + 45 + 8 = 83**
