# Dataset Sistem Pakar Diagnosis Laptop - INDEX

Dokumen ini berisi semua dataset yang digunakan dalam sistem pakar diagnosis kerusakan laptop berbasis metode **Forward Chaining**. Data dipisahkan berdasarkan kategori jenis part/komponen.

---

## Daftar File Dataset

| No | File | Kategori | Gejala | Kerusakan | Rules | Pertanyaan | Total |
|----|------|----------|--------|-----------|-------|------------|-------|
| 1 | [01_display.md](01_display.md) | Display / Layar | 20 | 10 | 45 | 8 | 83 |
| 2 | [02_keyboard.md](02_keyboard.md) | Keyboard | 15 | 8 | 30 | 6 | 59 |
| 3 | [03_network.md](03_network.md) | Network / Jaringan | 16 | 8 | 28 | 6 | 58 |
| 4 | [04_peripheral.md](04_peripheral.md) | Peripheral / Port | 25 | 12 | 38 | 8 | 83 |
| 5 | [05_power.md](05_power.md) | Power / Baterai | 22 | 10 | 35 | 6 | 73 |
| 6 | [06_software.md](06_software.md) | Software / Sistem Operasi | 20 | 10 | 35 | 6 | 71 |
| 7 | [07_performance.md](07_performance.md) | Performance / Performa | 16 | 8 | 30 | 6 | 60 |
| 8 | [08_thermal.md](08_thermal.md) | Thermal / Pendinginan | 14 | 7 | 22 | 5 | 48 |
| 9 | [09_audio.md](09_audio.md) | Audio / Suara | 18 | 8 | 28 | 6 | 60 |
| 10 | [10_storage.md](10_storage.md) | Storage / Penyimpanan | 16 | 8 | 28 | 6 | 58 |
| 11 | [11_physical.md](11_physical.md) | Physical / Body / Casing | 18 | 8 | 22 | 5 | 53 |
| 12 | [12_water_damage.md](12_water_damage.md) | Water Damage / Kerusakan Air | 16 | 6 | 24 | 6 | 52 |
| 13 | [13_hardware.md](13_hardware.md) | Hardware / Motherboard | 14 | 10 | 35 | 6 | 65 |
| 14 | [14_differential.md](14_differential.md) | Differential / Pembeda | 20 | - | - | 30 | 50 |

---

## Ringkasan Total Dataset

| Jenis Data | Jumlah |
|------------|--------|
| Gejala (Symptoms) | 250 |
| Kerusakan (Diseases) | 113 |
| Rules (Aturan IF-THEN) | 400 |
| Pertanyaan Kategori | 110 |
| **TOTAL DATA** | **873** |

---

## Catatan Teknis

- **CF Value (Certainty Factor)**: Nilai kepastian diagnosis (0.0 - 1.0), semakin tinggi semakin akurat
- **Bobot (Weight)**: Tingkat kepentingan gejala dalam menentukan diagnosis
- **Rules**: Aturan inferensi Forward Chaining dalam format IF [Gejala] THEN [Kerusakan]
- **Pertanyaan Kategori**: Follow-up questions untuk mempersempit diagnosis pada kasus ambigu
- Kode Gejala: `G001` - `G250`
- Kode Kerusakan: `K001` - `K113`

---

## Rentang Biaya Perbaikan

| Level | Rentang Biaya |
|-------|---------------|
| Ringan | Rp 50.000 - Rp 600.000 |
| Sedang | Rp 200.000 - Rp 1.500.000 |
| Berat | Rp 300.000 - Rp 3.000.000+ |

---

*Dokumen ini digenerate dari kode sumber sistem pakar diagnosis laptop Cellcom Service.*
