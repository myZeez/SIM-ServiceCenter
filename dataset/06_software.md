# 6. Software / Sistem Operasi

## Gejala (Symptoms) — 20 Data

| Kode | Nama Gejala | Keywords | Bobot |
|------|-------------|----------|-------|
| G031 | Laptop blue screen (BSOD) | bsod, blue screen, bluescreen, layar biru, blue screen of death, bsod error, error biru, crash biru | 0.8 |
| G032 | Laptop blue screen berulang | bsod berulang, sering bsod, blue screen terus-terusan, bsod berkali-kali, sering crash biru | 0.9 |
| G033 | Proses booting sangat lambat | booting lambat, startup lambat, lama nyala, loading lama, booting lama, startup lama, nyala lama | 0.6 |
| G034 | Muncul pesan error saat booting | error booting, boot error, pesan error nyala, error saat nyala, bootmgr missing, boot device not found | 0.7 |
| G035 | Laptop sering hang/freeze | hang, freeze, not responding, macet, nge-hang, stuck, membeku, laptop macet, ga bisa diapa-apain | 0.7 |
| G036 | Windows tidak bisa booting | gagal booting, windows error, ga bisa masuk windows, stuck di logo, tidak bisa masuk, loading terus, ga masuk windows, windows ga jalan | 0.8 |
| G037 | Laptop restart sendiri | restart sendiri, reboot sendiri, auto restart, restart terus, tiba-tiba restart, sering restart | 0.8 |
| G038 | Aplikasi sering crash/not responding | app crash, aplikasi crash, not responding, program error, aplikasi error, app not responding, force close | 0.6 |
| G039 | Laptop terinfeksi virus/malware | virus, malware, kena virus, ada virus, terinfeksi, popup mencurigakan, iklan tiba-tiba, adware | 0.7 |
| G158 | Laptop stuck di logo BIOS/UEFI | stuck logo, ga lewat bios, freeze di logo, tidak lanjut dari bios, stuck di splash screen | 0.8 |
| G159 | Muncul pesan "Operating System Not Found" | os not found, operating system not found, no bootable device, boot device not found, no os | 0.9 |
| G160 | Laptop masuk Safe Mode terus | safe mode terus, selalu safe mode, stuck safe mode, hanya bisa safe mode | 0.7 |
| G161 | Driver sering bermasalah setelah update | driver error update, driver crash setelah update, BSOD setelah update, windows update error | 0.6 |
| G162 | Task Manager menunjukkan disk usage 100% | disk 100, disk usage tinggi, disk penuh di task manager, disk 100 persen, high disk usage | 0.6 |
| G163 | Muncul pesan "Preparing Automatic Repair" berulang | automatic repair, preparing repair, stuck repair, loop repair, repair terus | 0.8 |
| G164 | File dan folder tiba-tiba hilang atau terenkripsi | file hilang, file terenkripsi, ransomware, data terkunci, file tidak bisa dibuka, encrypted, file berubah ekstensi | 0.9 |
| G165 | Windows License expired / not activated | windows not activated, lisensi habis, activate windows, watermark activate, windows ga aktif | 0.4 |
| G166 | Registry error atau corrupt | registry error, registry corrupt, registry rusak, regedit error | 0.7 |
| G167 | Laptop tidak bisa install ulang OS | gagal install, install error, disk tidak terbaca saat install, install os gagal | 0.8 |
| G168 | Sistem operasi corrupt setelah power loss | corrupt setelah mati, os rusak setelah mati listrik, windows corrupt mati tiba-tiba, file system error | 0.7 |

## Kerusakan (Diseases) — 10 Data

| Kode | Nama Kerusakan | Deskripsi | Solusi | Estimasi Biaya | Level |
|------|----------------|-----------|--------|----------------|-------|
| K019 | Kerusakan Sistem Operasi (OS Corrupt) | File-file sistem operasi corrupt atau rusak | Install ulang Windows/OS atau repair menggunakan recovery tools | Rp 100.000 - Rp 300.000 | Ringan |
| K068 | Infeksi Virus/Malware | Laptop terinfeksi virus, malware, atau ransomware | Scan dan remove virus, install ulang OS jika parah | Rp 50.000 - Rp 300.000 | Ringan |
| K069 | Driver Tidak Kompatibel | Driver hardware tidak cocok atau corrupt setelah update | Rollback driver, install driver yang sesuai versi hardware | Rp 50.000 - Rp 150.000 | Ringan |
| K070 | Boot Sector/MBR Rusak | Master Boot Record (MBR) atau boot sector corrupt | Repair MBR menggunakan bootable USB, rebuild BCD | Rp 100.000 - Rp 200.000 | Ringan |
| K071 | Hard Drive Failing (Terkait Software) | Hard drive mulai bermasalah menyebabkan OS tidak stabil | Backup data, clone ke drive baru, ganti hard drive | Rp 200.000 - Rp 800.000 | Sedang |
| K072 | Registry Windows Corrupt | Registry Windows rusak atau corrupt akibat malware/uninstall paksa | Repair registry atau install ulang Windows | Rp 100.000 - Rp 250.000 | Ringan |
| K073 | Partisi Tabel Rusak (GPT/MBR Error) | Tabel partisi rusak sehingga OS tidak bisa diakses | Repair partition table, backup dan format ulang disk | Rp 100.000 - Rp 300.000 | Sedang |
| K074 | Windows Update Gagal/Corrupt | File update Windows corrupt menyebabkan masalah booting | Reset Windows Update components, repair SFC/DISM | Rp 50.000 - Rp 200.000 | Ringan |
| K075 | BIOS/UEFI Firmware Corrupt | BIOS/UEFI firmware rusak menyebabkan laptop stuck | Flash ulang BIOS/UEFI, gunakan recovery BIOS | Rp 100.000 - Rp 400.000 | Sedang |
| K076 | Ransomware Attack | File pengguna terenkripsi oleh ransomware | Decrypt jika tersedia tools, format dan install ulang, restore backup | Rp 200.000 - Rp 500.000 | Berat |

## Rules (Aturan IF-THEN) — 35 Data

| Rule | Gejala | Kerusakan | CF Value |
|------|--------|-----------|----------|
| R1 | G036 + G034 | K019 (OS Corrupt) | 0.9 |
| R2 | G036 | K019 (OS Corrupt) | 0.75 |
| R3 | G033 + G035 | K019 (OS Corrupt) | 0.7 |
| R4 | G163 | K019 (OS Corrupt) | 0.85 |
| R5 | G036 + G163 | K019 (OS Corrupt) | 0.9 |
| R6 | G168 | K019 (OS Corrupt) | 0.85 |
| R7 | G160 | K019 (OS Corrupt) | 0.7 |
| R8 | G039 | K068 (Virus/Malware) | 0.8 |
| R9 | G038 + G039 | K068 (Virus/Malware) | 0.85 |
| R10 | G035 + G039 | K068 (Virus/Malware) | 0.85 |
| R11 | G033 + G039 | K068 (Virus/Malware) | 0.8 |
| R12 | G161 | K069 (Driver Tidak Kompatibel) | 0.8 |
| R13 | G031 + G161 | K069 (Driver Tidak Kompatibel) | 0.85 |
| R14 | G032 + G161 | K069 (Driver Tidak Kompatibel) | 0.9 |
| R15 | G037 + G161 | K069 (Driver Tidak Kompatibel) | 0.85 |
| R16 | G034 + G036 | K070 (Boot Sector Rusak) | 0.85 |
| R17 | G159 | K070 (Boot Sector Rusak) | 0.9 |
| R18 | G159 + G034 | K070 (Boot Sector Rusak) | 0.95 |
| R19 | G167 | K070 (Boot Sector Rusak) | 0.7 |
| R20 | G162 + G035 | K071 (Hard Drive Failing) | 0.8 |
| R21 | G033 + G162 | K071 (Hard Drive Failing) | 0.8 |
| R22 | G031 + G162 | K071 (Hard Drive Failing) | 0.75 |
| R23 | G162 + G036 | K071 (Hard Drive Failing) | 0.85 |
| R24 | G166 | K072 (Registry Corrupt) | 0.8 |
| R25 | G038 + G166 | K072 (Registry Corrupt) | 0.85 |
| R26 | G035 + G166 | K072 (Registry Corrupt) | 0.85 |
| R27 | G167 + G159 | K073 (Partisi Rusak) | 0.85 |
| R28 | G167 | K073 (Partisi Rusak) | 0.7 |
| R29 | G031 + G037 + G161 | K074 (Windows Update Corrupt) | 0.85 |
| R30 | G163 + G161 | K074 (Windows Update Corrupt) | 0.85 |
| R31 | G158 | K075 (BIOS/UEFI Corrupt) | 0.85 |
| R32 | G158 + G089 | K075 (BIOS/UEFI Corrupt) | 0.9 |
| R33 | G158 + G167 | K075 (BIOS/UEFI Corrupt) | 0.85 |
| R34 | G164 | K076 (Ransomware) | 0.9 |
| R35 | G164 + G039 | K076 (Ransomware) | 0.95 |

## Pertanyaan Kategori — 6 Data

| No | Pertanyaan | Expected Keyword | Leads To |
|----|------------|------------------|----------|
| 1 | Apakah masalah terjadi setelah update Windows? | ya, iya, setelah update, habis update | G161 |
| 2 | Apakah muncul pesan "Operating System Not Found" atau sejenisnya? | ya, iya, os not found, boot device | G159 |
| 3 | Apakah laptop stuck di logo atau tidak bisa lanjut ke Windows? | ya, iya, stuck, ga lanjut | G158 |
| 4 | Apakah ada file yang hilang atau tidak bisa dibuka secara tiba-tiba? | ya, iya, file hilang, ga bisa buka | G164 |
| 5 | Apakah sering muncul popup atau iklan yang mencurigakan? | ya, iya, popup, iklan, mencurigakan | G039 |
| 6 | Apakah laptop pernah mati tiba-tiba (misal listrik padam) sebelum masalah ini? | ya, iya, mati listrik, padam, mati mendadak | G168 |

---

**Total data kategori Software: 20 + 10 + 35 + 6 = 71**
