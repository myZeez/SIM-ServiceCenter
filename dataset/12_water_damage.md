# 12. Water Damage / Kerusakan Air

## Gejala (Symptoms) — 16 Data

| Kode | Nama Gejala | Keywords | Bobot |
|------|-------------|----------|-------|
| G090 | Laptop terkena air/tumpahan cairan | kena air, tumpahan, kecipratan, kena kopi, ketumpahan, terkena cairan, tumpahan air, kena teh, kena minum, basah | 0.9 |
| G091 | Keyboard tidak berfungsi setelah terkena air | keyboard mati kena air, tombol mati setelah basah, keyboard error setelah tumpahan | 0.9 |
| G092 | Laptop mati setelah terkena air | mati setelah kena air, mati basah, laptop mati kena cairan, short setelah tumpahan | 1.0 |
| G093 | Layar berembun dari dalam | embun di layar, layar berembun, fog di lcd, uap di layar, embun dalam layar, layar berkabut | 0.8 |
| G094 | Muncul korosi/karat pada komponen | korosi, karat, karatan, komponen berkarat, korosi motherboard, oksidasi | 0.8 |
| G095 | Beberapa tombol lengket setelah terkena cairan | tombol lengket air, sticky setelah tumpahan, keyboard lengket basah, tombol nempel | 0.7 |
| G096 | Port USB/charging berkarat | port karat, usb berkarat, port korosi, port charging karat, port berubah warna | 0.8 |
| G097 | Laptop menyala tapi ada komponen bermasalah | nyala sebagian, beberapa fungsi mati, komponen mati sebagian, nyala tapi ada yg rusak | 0.7 |
| G220 | Ada bekas air atau noda di dalam laptop | noda air dalam, bekas air, water stain, bekas tumpahan dalam | 0.6 |
| G221 | Indikator kelembaban berubah warna | stiker kelembaban, moisture indicator, kelembaban tinggi, LCI berubah | 0.7 |
| G222 | Bau tidak sedap dari laptop (bau lembab) | bau lembab, bau apek, bau aneh, bau air, bau tidak sedap dari laptop | 0.5 |
| G223 | Touchpad tidak responsif setelah terkena air | touchpad mati air, touchpad error basah, touchpad ga jalan kena air | 0.8 |
| G224 | Laptop menyala lalu mati berulang kali setelah terkena air | on off setelah basah, restart kena air, mati nyala kena cairan | 0.9 |
| G225 | Speaker mendengung setelah terkena air | speaker dengung air, suara berdengung basah, speaker aneh kena air | 0.6 |
| G226 | Komponen internal terlihat hijau/berubah warna | komponen hijau, motherboard hijau, korosi hijau, verdigris, patina | 0.8 |
| G227 | LCD menunjukkan bercak air/water spots | lcd bercak, water spot lcd, bintik air di layar, watermark lcd | 0.7 |

## Kerusakan (Diseases) — 6 Data

| Kode | Nama Kerusakan | Deskripsi | Solusi | Estimasi Biaya | Level |
|------|----------------|-----------|--------|----------------|-------|
| K033 | Water Damage - Korosi Motherboard | Air masuk dan menyebabkan korosi pada komponen motherboard | Bersihkan korosi dengan isopropyl alcohol, repair komponen yang rusak | Rp 300.000 - Rp 2.000.000 | Berat |
| K103 | Water Damage - Short Circuit | Air menyebabkan hubungan arus pendek pada motherboard | Keringkan total laptop, diagnosa dan repair jalur yang short | Rp 300.000 - Rp 1.500.000 | Berat |
| K104 | Water Damage - Keyboard rusak | Cairan merusak membrane atau switch pada keyboard | Ganti keyboard, bersihkan area yang terdampak | Rp 200.000 - Rp 600.000 | Sedang |
| K105 | Water Damage - LCD Panel | Cairan masuk ke panel LCD menyebabkan bercak atau kerusakan | Ganti LCD panel | Rp 500.000 - Rp 2.500.000 | Berat |
| K106 | Water Damage - Konektor & Port | Port dan konektor mengalami korosi akibat air | Bersihkan atau ganti port yang terkena korosi | Rp 100.000 - Rp 500.000 | Sedang |
| K107 | Water Damage - Speaker/Audio Component | Komponen audio rusak akibat air | Ganti speaker, bersihkan komponen audio | Rp 100.000 - Rp 400.000 | Ringan |

## Rules (Aturan IF-THEN) — 24 Data

| Rule | Gejala | Kerusakan | CF Value |
|------|--------|-----------|----------|
| R1 | G090 + G094 | K033 (Korosi Motherboard) | 0.9 |
| R2 | G094 + G226 | K033 (Korosi Motherboard) | 0.9 |
| R3 | G090 + G097 + G094 | K033 (Korosi Motherboard) | 0.95 |
| R4 | G226 | K033 (Korosi Motherboard) | 0.85 |
| R5 | G090 + G226 | K033 (Korosi Motherboard) | 0.9 |
| R6 | G092 | K103 (Short Circuit) | 0.85 |
| R7 | G090 + G092 | K103 (Short Circuit) | 0.95 |
| R8 | G224 | K103 (Short Circuit) | 0.85 |
| R9 | G090 + G224 | K103 (Short Circuit) | 0.9 |
| R10 | G092 + G088 | K103 (Short Circuit) | 0.9 |
| R11 | G091 | K104 (Keyboard Rusak Air) | 0.85 |
| R12 | G090 + G091 | K104 (Keyboard Rusak Air) | 0.9 |
| R13 | G095 | K104 (Keyboard Rusak Air) | 0.8 |
| R14 | G090 + G095 | K104 (Keyboard Rusak Air) | 0.85 |
| R15 | G093 | K105 (LCD Water Damage) | 0.85 |
| R16 | G090 + G093 | K105 (LCD Water Damage) | 0.9 |
| R17 | G227 | K105 (LCD Water Damage) | 0.8 |
| R18 | G090 + G227 | K105 (LCD Water Damage) | 0.9 |
| R19 | G096 | K106 (Konektor Korosi) | 0.8 |
| R20 | G090 + G096 | K106 (Konektor Korosi) | 0.9 |
| R21 | G220 + G096 | K106 (Konektor Korosi) | 0.85 |
| R22 | G225 | K107 (Speaker Water Damage) | 0.8 |
| R23 | G090 + G225 | K107 (Speaker Water Damage) | 0.85 |
| R24 | G090 + G050 | K107 (Speaker Water Damage) | 0.8 |

## Pertanyaan Kategori — 6 Data

| No | Pertanyaan | Expected Keyword | Leads To |
|----|------------|------------------|----------|
| 1 | Apakah laptop pernah terkena air atau tumpahan cairan? | ya, iya, kena air, tumpahan, basah | G090 |
| 2 | Apakah laptop mati total setelah terkena air? | ya, iya, mati, off, shutdown | G092 |
| 3 | Apakah ada korosi atau karat yang terlihat pada komponen? | ya, iya, korosi, karat, hijau | G094 |
| 4 | Apakah keyboard masih bisa berfungsi setelah kejadian? | tidak, ga bisa, mati, error | G091 |
| 5 | Apakah layar terlihat berembun atau ada bercak air dari dalam? | ya, iya, embun, bercak, kabut | G093 |
| 6 | Apakah laptop masih bisa menyala walaupun sebagian fungsi mati? | ya, iya, nyala sebagian, bisa nyala | G097 |

---

**Total data kategori Water Damage: 16 + 6 + 24 + 6 = 52**
