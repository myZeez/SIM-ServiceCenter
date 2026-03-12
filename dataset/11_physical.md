# 11. Physical / Body / Casing

## Gejala (Symptoms) — 18 Data

| Kode | Nama Gejala | Keywords | Bobot |
|------|-------------|----------|-------|
| G070 | Casing laptop retak/pecah | casing retak, body pecah, casing pecah, cover retak, laptop pecah, casing patah | 0.8 |
| G071 | Engsel/hinge laptop rusak | engsel rusak, hinge rusak, engsel patah, engsel lepas, hinge patah, engsel longgar, hinge longgar, engsel ga bisa | 0.8 |
| G072 | Layar laptop goyang/tidak stabil | layar goyang, layar goyah, layar ga stabil, layar lepas, layar gerak sendiri, layar bolak balik | 0.7 |
| G073 | Laptop berbunyi saat dibuka/ditutup | bunyi engsel, engsel bunyi, krek krek engsel, bunyi saat buka tutup, engsel berisik | 0.5 |
| G074 | Screw/baut hilang atau rusak | baut hilang, screw lepas, sekrup hilang, baut rusak, mur hilang | 0.4 |
| G075 | Karet kaki laptop hilang/lepas | karet hilang, kaki lepas, rubber feet hilang, karet bawah lepas | 0.3 |
| G076 | Palmrest/bagian tangan retak | palmrest retak, tempat tangan retak, palm rest pecah, palmrest patah | 0.6 |
| G077 | Cover bawah laptop lepas/tidak rapat | cover lepas, tutup bawah lepas, bottom case longgar, cover bawah ga rapat | 0.5 |
| G210 | Kabel LCD terlihat saat membuka layar | kabel lcd terlihat, kabel layar keluar, kawat layar terlihat, kabel terekspos | 0.6 |
| G211 | Bezel layar lepas atau retak | bezel lepas, frame layar lepas, bezel retak, pinggiran layar lepas, bezel patah | 0.6 |
| G212 | Lubang ventilasi pecah atau patah | ventilasi pecah, grill rusak, lubang angin patah, ventilasi patah | 0.5 |
| G213 | Keyboard deck melengkung/berubah bentuk | keyboard deck bengkok, palmrest bengkok, deck melengkung, body bengkok, casing deformasi | 0.7 |
| G214 | Logo atau stiker mengelupas | logo lepas, stiker hilang, emblem copot, branding mengelupas | 0.2 |
| G215 | Port cover/penutup port rusak | port cover lepas, penutup port hilang, cover port rusak, dust cover lepas | 0.3 |
| G216 | Engsel patah sampai casing terangkat | engsel angkat casing, casing ikut terangkat, hinge patah angkat body, engsel sampai pecah | 0.9 |
| G217 | Slot RAM/HDD cover rusak | cover ram rusak, slot hdd cover lepas, tutup ram patah, penutup ram rusak | 0.5 |
| G218 | Laptop berderit saat ditekan di area tertentu | laptop berderit, body bunyi, casing bunyi ditekan, laptop krek saat dipegang | 0.4 |
| G219 | Cat atau coating laptop mengelupas | cat mengelupas, coating lepas, warna laptop luntur, soft touch lepas, peeling | 0.3 |

## Kerusakan (Diseases) — 8 Data

| Kode | Nama Kerusakan | Deskripsi | Solusi | Estimasi Biaya | Level |
|------|----------------|-----------|--------|----------------|-------|
| K031 | Engsel/Hinge Rusak | Engsel laptop patah atau longgar | Ganti engsel/hinge dengan yang baru | Rp 150.000 - Rp 500.000 | Sedang |
| K032 | Casing/Body Rusak | Casing laptop retak, pecah, atau penyok | Ganti casing laptop atau perbaiki retakan | Rp 200.000 - Rp 800.000 | Sedang |
| K097 | Bezel Layar Rusak | Frame/bezel di sekitar layar retak atau lepas | Ganti bezel layar | Rp 100.000 - Rp 400.000 | Ringan |
| K098 | Palmrest Assembly Rusak | Palmrest retak, bengkok, atau konektor di palmrest bermasalah | Ganti palmrest assembly | Rp 200.000 - Rp 600.000 | Sedang |
| K099 | Bottom Case Rusak | Cover bawah laptop rusak, retak, atau klip penahan patah | Ganti bottom case/cover bawah | Rp 150.000 - Rp 500.000 | Ringan |
| K100 | Hinge Bracket Patah pada Casing | Bracket pengait engsel di casing patah | Repair bracket atau ganti casing yang berkaitan | Rp 200.000 - Rp 700.000 | Sedang |
| K101 | Kabel LCD Terjepit/Tertekuk | Kabel flex LCD terjepit di area engsel sehingga terlihat atau rusak | Rapikan kabel, ganti jika sudah rusak | Rp 100.000 - Rp 400.000 | Ringan |
| K102 | Kerusakan Kosmetik (Non-Fungsional) | Kerusakan estetika: cat mengelupas, stiker lepas, goresan | Repaint, ganti panel, atau biarkan (tidak pengaruh fungsi) | Rp 0 - Rp 300.000 | Ringan |

## Rules (Aturan IF-THEN) — 22 Data

| Rule | Gejala | Kerusakan | CF Value |
|------|--------|-----------|----------|
| R1 | G071 | K031 (Engsel Rusak) | 0.9 |
| R2 | G073 + G071 | K031 (Engsel Rusak) | 0.9 |
| R3 | G072 + G071 | K031 (Engsel Rusak) | 0.95 |
| R4 | G216 | K031 (Engsel Rusak) | 0.95 |
| R5 | G070 | K032 (Casing Rusak) | 0.85 |
| R6 | G070 + G074 | K032 (Casing Rusak) | 0.9 |
| R7 | G218 + G070 | K032 (Casing Rusak) | 0.85 |
| R8 | G212 | K032 (Casing Rusak) | 0.7 |
| R9 | G211 | K097 (Bezel Rusak) | 0.85 |
| R10 | G211 + G072 | K097 (Bezel Rusak) | 0.85 |
| R11 | G076 | K098 (Palmrest Rusak) | 0.85 |
| R12 | G213 | K098 (Palmrest Rusak) | 0.8 |
| R13 | G076 + G213 | K098 (Palmrest Rusak) | 0.9 |
| R14 | G077 | K099 (Bottom Case Rusak) | 0.8 |
| R15 | G077 + G074 | K099 (Bottom Case Rusak) | 0.85 |
| R16 | G217 + G077 | K099 (Bottom Case Rusak) | 0.85 |
| R17 | G216 + G070 | K100 (Hinge Bracket Patah) | 0.9 |
| R18 | G216 + G071 | K100 (Hinge Bracket Patah) | 0.9 |
| R19 | G210 | K101 (Kabel LCD Terjepit) | 0.85 |
| R20 | G210 + G071 | K101 (Kabel LCD Terjepit) | 0.9 |
| R21 | G214 + G219 | K102 (Kerusakan Kosmetik) | 0.7 |
| R22 | G219 | K102 (Kerusakan Kosmetik) | 0.6 |

## Pertanyaan Kategori — 5 Data

| No | Pertanyaan | Expected Keyword | Leads To |
|----|------------|------------------|----------|
| 1 | Apakah engsel laptop terasa longgar atau sulit dibuka/ditutup? | ya, iya, longgar, susah, engsel rusak, patah | G071 |
| 2 | Apakah ada retakan pada casing atau body laptop? | ya, iya, retak, pecah, patah | G070 |
| 3 | Apakah layar laptop goyang atau tidak stabil saat dibuka? | ya, iya, goyang, goyah, ga stabil | G072 |
| 4 | Apakah ada bagian laptop yang terangkat karena engsel? | ya, iya, terangkat, angkat casing | G216 |
| 5 | Apakah bezel/frame layar lepas atau retak? | ya, iya, bezel lepas, frame retak | G211 |

---

**Total data kategori Physical: 18 + 8 + 22 + 5 = 53**
