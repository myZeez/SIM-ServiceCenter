# 8. Thermal / Pendinginan

## Gejala (Symptoms) — 14 Data

| Kode | Nama Gejala | Keywords | Bobot |
|------|-------------|----------|-------|
| G046 | Laptop panas berlebihan (overheat) | panas, overheat, kepanasan, laptop panas, laptop gerah, panas banget, suhu tinggi | 0.8 |
| G047 | Fan/kipas tidak berputar | kipas mati, fan mati, kipas tidak jalan, fan tidak putar, kipas ga jalan, fan diam | 0.9 |
| G048 | Fan berbunyi keras/berisik | kipas berisik, fan bunyi, kipas bunyi, fan kasar, kipas keras, fan grinding, fan noise | 0.6 |
| G049 | Laptop mati karena overheat | mati panas, shutdown overheat, mati kepanasan, overheat shutdown, mati karena panas | 0.9 |
| G179 | Suhu CPU di atas 90°C saat idle | suhu tinggi idle, cpu panas idle, temp tinggi saat ga ngapa-ngapain, overheat idle | 0.8 |
| G180 | Thermal paste sudah kering/lama tidak diganti | thermal paste kering, pasta termal lama, belum ganti thermal paste, pasta lama | 0.7 |
| G181 | Ventilasi laptop tersumbat debu | ventilasi kotor, debu banyak, lubang angin tersumbat, ventilasi tertutup debu | 0.7 |
| G182 | Laptop panas di area tertentu saja | panas di satu titik, panas di kiri, panas di tengah, hot spot, area tertentu panas | 0.6 |
| G183 | Heatsink terasa longgar/tidak rapat | heatsink longgar, heatsink lepas, heatsink ga nempel, pendingin ga rapat | 0.8 |
| G184 | Performa turun drastis saat panas | performa turun panas, throttle saat panas, lag saat panas, lemot karena panas | 0.8 |
| G185 | Fan berhenti lalu berputar lagi secara acak | fan on off, kipas hidup mati, fan intermittent, kipas kadang jalan kadang mati | 0.7 |
| G186 | Bau hangus dari area ventilasi | bau hangus, bau terbakar dari kipas, bau gosong dari ventilasi, asap dari laptop | 0.9 |
| G187 | Laptop panas saat charging | panas saat cas, overheat saat charging, gerah saat dicas, panas waktu ngecas | 0.6 |
| G188 | Heatpipe terlihat penyok atau rusak | heatpipe penyok, heat pipe bengkok, heatpipe rusak, pipa panas rusak | 0.8 |

## Kerusakan (Diseases) — 7 Data

| Kode | Nama Kerusakan | Deskripsi | Solusi | Estimasi Biaya | Level |
|------|----------------|-----------|--------|----------------|-------|
| K023 | Kipas/Fan Rusak | Fan pendingin tidak berfungsi atau berputar dengan benar | Ganti kipas/fan laptop | Rp 100.000 - Rp 400.000 | Ringan |
| K024 | Thermal Paste Kering | Pasta termal antara CPU/GPU dan heatsink sudah kering | Ganti thermal paste dengan yang baru | Rp 50.000 - Rp 150.000 | Ringan |
| K025 | Heatsink Bermasalah | Heatsink tidak menempel rapat atau rusak | Pasang ulang heatsink, ganti jika rusak | Rp 100.000 - Rp 500.000 | Sedang |
| K082 | Ventilasi Tersumbat Debu | Jalur udara laptop tersumbat oleh debu yang menumpuk | Bersihkan debu pada ventilasi dan internal laptop | Rp 50.000 - Rp 150.000 | Ringan |
| K083 | Heatpipe Rusak/Penyok | Heatpipe (pipa panas) rusak sehingga transfer panas tidak efisien | Ganti heatpipe atau modul heatsink assembly | Rp 200.000 - Rp 600.000 | Sedang |
| K084 | Sensor Thermal Bermasalah | Sensor suhu CPU/GPU memberikan pembacaan yang salah | Kalibrasi sensor, update BIOS, atau ganti sensor | Rp 100.000 - Rp 400.000 | Sedang |
| K085 | VRM Overheating | Voltage Regulator Module (VRM) overheat pada motherboard | Pasang thermal pad pada VRM, cek ventilasi | Rp 100.000 - Rp 350.000 | Sedang |

## Rules (Aturan IF-THEN) — 22 Data

| Rule | Gejala | Kerusakan | CF Value |
|------|--------|-----------|----------|
| R1 | G047 | K023 (Fan Rusak) | 0.9 |
| R2 | G048 + G047 | K023 (Fan Rusak) | 0.95 |
| R3 | G185 | K023 (Fan Rusak) | 0.8 |
| R4 | G046 + G047 | K023 (Fan Rusak) | 0.9 |
| R5 | G049 + G047 | K023 (Fan Rusak) | 0.95 |
| R6 | G180 + G046 | K024 (Thermal Paste Kering) | 0.9 |
| R7 | G179 + G180 | K024 (Thermal Paste Kering) | 0.9 |
| R8 | G046 + G184 | K024 (Thermal Paste Kering) | 0.8 |
| R9 | G183 | K025 (Heatsink Bermasalah) | 0.85 |
| R10 | G183 + G046 | K025 (Heatsink Bermasalah) | 0.9 |
| R11 | G182 + G183 | K025 (Heatsink Bermasalah) | 0.9 |
| R12 | G181 | K082 (Ventilasi Tersumbat) | 0.85 |
| R13 | G181 + G046 | K082 (Ventilasi Tersumbat) | 0.9 |
| R14 | G181 + G048 | K082 (Ventilasi Tersumbat) | 0.85 |
| R15 | G049 + G181 | K082 (Ventilasi Tersumbat) | 0.85 |
| R16 | G188 | K083 (Heatpipe Rusak) | 0.9 |
| R17 | G188 + G046 | K083 (Heatpipe Rusak) | 0.95 |
| R18 | G179 + G046 | K084 (Sensor Thermal) | 0.7 |
| R19 | G185 + G179 | K084 (Sensor Thermal) | 0.75 |
| R20 | G186 | K085 (VRM Overheating) | 0.85 |
| R21 | G186 + G046 | K085 (VRM Overheating) | 0.9 |
| R22 | G182 + G186 | K085 (VRM Overheating) | 0.9 |

## Pertanyaan Kategori — 5 Data

| No | Pertanyaan | Expected Keyword | Leads To |
|----|------------|------------------|----------|
| 1 | Apakah kipas/fan laptop masih berputar? | tidak, mati, ga putar, ga jalan | G047 |
| 2 | Apakah laptop sudah pernah dibersihkan bagian dalamnya? | belum, belum pernah, tidak pernah, lama | G181 |
| 3 | Apakah laptop panas meskipun tidak menjalankan aplikasi berat? | ya, iya, panas idle, panas padahal ga ngapa-ngapain | G179 |
| 4 | Apakah sudah pernah ganti thermal paste? | belum, belum pernah, lama, tidak pernah | G180 |
| 5 | Apakah ada bau hangus dari area ventilasi laptop? | ya, iya, bau, hangus, gosong | G186 |

---

**Total data kategori Thermal: 14 + 7 + 22 + 5 = 48**
