# 9. Audio / Suara

## Gejala (Symptoms) — 18 Data

| Kode | Nama Gejala | Keywords | Bobot |
|------|-------------|----------|-------|
| G050 | Speaker laptop tidak ada suara | speaker mati, ga ada suara, tidak ada suara, suara mati, speaker ga bunyi, audio mati, sound mati, laptop bisu | 0.8 |
| G051 | Speaker laptop pecah/distorsi | suara pecah, speaker pecah, distorsi, suara jelek, speaker distorsi, suara burik, suara pecah-pecah, kresek | 0.7 |
| G052 | Jack audio/headphone tidak berfungsi | jack mati, jack ga fungsi, headphone ga bunyi, headset ga kebaca, colokan audio rusak, jack audio rusak, headphone jack | 0.7 |
| G053 | Microphone tidak berfungsi | mic mati, microphone ga fungsi, mic ga kebaca, mic rusak, microphone tidak berfungsi, mic ga bisa, mic error | 0.7 |
| G054 | Suara keluar dari satu speaker saja | suara sebelah, speaker satu mati, hanya kiri, hanya kanan, audio mono, speaker kiri mati, speaker kanan mati | 0.7 |
| G055 | Volume sangat kecil meski sudah maksimal | volume kecil, suara kecil, volume max tapi kecil, speaker pelan, suara kurang keras | 0.6 |
| G056 | Audio delay/lag | suara delay, audio telat, lag suara, delay audio, audio ga sinkron, suara lambat | 0.5 |
| G057 | Suara noise/static dari speaker | suara noise, suara mendesis, static, suara berdesis, white noise, suara sssss, noise dari speaker | 0.6 |
| G058 | Speaker tiba-tiba mati lalu hidup lagi | speaker intermittent, suara putus-putus, audio on off, speaker kadang bunyi kadang mati, suara hilang timbul | 0.7 |
| G189 | Audio terdeteksi tapi tidak keluar suara | detected no sound, driver ok tapi mati, di setting ada tapi ga bunyi, audio device ok no sound | 0.7 |
| G190 | Bluetooth audio tidak bisa connect | bluetooth audio gagal, headset bt ga konek, wireless audio error, speaker bt ga connect | 0.6 |
| G191 | Suara echo/gema saat panggilan | echo saat call, gema saat telepon, suara dobel, suara mengulang, feedback audio | 0.5 |
| G192 | Audio device not recognized | audio not recognized, perangkat audio tidak dikenali, sound card not found, audio ga kebaca | 0.8 |
| G193 | Suara terdengar robotik/terdistorsi saat voice call | suara robotik, suara robotic, suara patah-patah call, audio pecah saat call | 0.5 |
| G194 | Suara hanya keluar jika jack audio digoyang | jack goyang baru bunyi, goyang jack baru ada suara, jack harus ditekan, posisi tertentu baru bunyi | 0.8 |
| G195 | Microphone menangkap suara terlalu sensitif | mic terlalu sensitif, mic brisik, background noise mic, mic tangkap semua suara | 0.4 |
| G196 | Bass atau treble tidak terdengar | bass hilang, treble hilang, suara ga ada bass, suara tipis, suara flat | 0.5 |
| G197 | Audio crackling saat volume tinggi | crackling, suara retak volume tinggi, pecah di volume tinggi, audio crack | 0.6 |

## Kerusakan (Diseases) — 8 Data

| Kode | Nama Kerusakan | Deskripsi | Solusi | Estimasi Biaya | Level |
|------|----------------|-----------|--------|----------------|-------|
| K026 | Speaker Internal Rusak | Speaker laptop rusak atau kabelnya putus | Ganti speaker internal laptop | Rp 100.000 - Rp 400.000 | Ringan |
| K027 | IC Audio/Sound Card Bermasalah | Chip audio pada motherboard bermasalah | Perbaiki atau ganti IC Audio di motherboard | Rp 200.000 - Rp 600.000 | Sedang |
| K028 | Jack Audio Port Rusak | Port jack audio 3.5mm rusak atau longgar | Ganti port jack audio | Rp 100.000 - Rp 300.000 | Ringan |
| K086 | Kabel Speaker Internal Putus/Longgar | Kabel ribbon yang menghubungkan speaker ke motherboard rusak | Pasang ulang atau ganti kabel speaker | Rp 50.000 - Rp 200.000 | Ringan |
| K087 | Driver Audio Corrupt/Tidak Kompatibel | Driver audio Windows corrupt atau tidak sesuai hardware | Install ulang driver audio yang sesuai | Rp 0 - Rp 100.000 | Ringan |
| K088 | Microphone Internal Rusak | Microphone built-in laptop rusak | Ganti microphone internal atau gunakan mic external | Rp 100.000 - Rp 300.000 | Ringan |
| K089 | DAC (Digital-to-Analog Converter) Bermasalah | DAC pada audio codec chip bermasalah | Perbaiki atau ganti chip audio codec | Rp 200.000 - Rp 500.000 | Sedang |
| K090 | Amplifier Speaker Rusak | Amplifier internal untuk speaker rusak | Ganti komponen amplifier pada motherboard | Rp 200.000 - Rp 500.000 | Sedang |

## Rules (Aturan IF-THEN) — 28 Data

| Rule | Gejala | Kerusakan | CF Value |
|------|--------|-----------|----------|
| R1 | G050 | K026 (Speaker Rusak) | 0.7 |
| R2 | G051 | K026 (Speaker Rusak) | 0.8 |
| R3 | G054 | K026 (Speaker Rusak) | 0.85 |
| R4 | G050 + G054 | K026 (Speaker Rusak) | 0.9 |
| R5 | G197 | K026 (Speaker Rusak) | 0.75 |
| R6 | G192 | K027 (IC Audio Rusak) | 0.85 |
| R7 | G050 + G192 | K027 (IC Audio Rusak) | 0.9 |
| R8 | G189 + G192 | K027 (IC Audio Rusak) | 0.9 |
| R9 | G057 + G192 | K027 (IC Audio Rusak) | 0.85 |
| R10 | G052 | K028 (Jack Audio Rusak) | 0.8 |
| R11 | G194 | K028 (Jack Audio Rusak) | 0.9 |
| R12 | G052 + G194 | K028 (Jack Audio Rusak) | 0.95 |
| R13 | G058 | K086 (Kabel Speaker Putus) | 0.8 |
| R14 | G058 + G054 | K086 (Kabel Speaker Putus) | 0.85 |
| R15 | G050 + G058 | K086 (Kabel Speaker Putus) | 0.85 |
| R16 | G189 | K087 (Driver Audio Corrupt) | 0.75 |
| R17 | G056 | K087 (Driver Audio Corrupt) | 0.7 |
| R18 | G189 + G050 | K087 (Driver Audio Corrupt) | 0.8 |
| R19 | G190 | K087 (Driver Audio Corrupt) | 0.7 |
| R20 | G053 | K088 (Mic Rusak) | 0.8 |
| R21 | G053 + G195 | K088 (Mic Rusak) | 0.85 |
| R22 | G053 + G191 | K088 (Mic Rusak) | 0.8 |
| R23 | G196 + G055 | K089 (DAC Bermasalah) | 0.85 |
| R24 | G057 + G196 | K089 (DAC Bermasalah) | 0.8 |
| R25 | G057 | K089 (DAC Bermasalah) | 0.65 |
| R26 | G055 | K090 (Amplifier Rusak) | 0.75 |
| R27 | G055 + G197 | K090 (Amplifier Rusak) | 0.85 |
| R28 | G055 + G051 | K090 (Amplifier Rusak) | 0.85 |

## Pertanyaan Kategori — 6 Data

| No | Pertanyaan | Expected Keyword | Leads To |
|----|------------|------------------|----------|
| 1 | Apakah suara keluar dari salah satu speaker saja (kiri/kanan)? | ya, iya, satu speaker, sebelah | G054 |
| 2 | Apakah headphone/headset berfungsi normal di perangkat lain? | ya, iya, normal, bisa | G052 |
| 3 | Apakah jack audio harus digoyang-goyang agar suara keluar? | ya, iya, goyang, tekan, posisi tertentu | G194 |
| 4 | Apakah microphone tidak berfungsi? | ya, iya, mic mati, mic rusak | G053 |
| 5 | Apakah audio device terdeteksi di Device Manager? | tidak, ga terdeteksi, not recognized | G192 |
| 6 | Apakah driver audio sudah di-update ke versi terbaru? | belum, tidak, ga tau | G189 |
