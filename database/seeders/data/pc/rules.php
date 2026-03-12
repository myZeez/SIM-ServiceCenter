<?php

// Dataset PC Desktop (Custom Build) - 283 rules
// Format: disease => code kerusakan, symptoms => [kode gejala], cf => certainty factor
return [

    // PCK001: PSU Rusak / Mati Total
    ['disease' => 'PCK001', 'symptoms' => ['PCG001'], 'cf' => 0.7],
    ['disease' => 'PCK001', 'symptoms' => ['PCG001', 'PCG004'], 'cf' => 0.85],
    ['disease' => 'PCK001', 'symptoms' => ['PCG005'], 'cf' => 0.9],

    // PCK006: PSU Terbakar / Overvoltage Spike
    ['disease' => 'PCK006', 'symptoms' => ['PCG005', 'PCG014'], 'cf' => 1.0],
    ['disease' => 'PCK006', 'symptoms' => ['PCG014'], 'cf' => 0.95],

    // PCK004: Kapasitor PSU Rusak / Kembung
    ['disease' => 'PCK004', 'symptoms' => ['PCG004', 'PCG006'], 'cf' => 0.85],
    ['disease' => 'PCK004', 'symptoms' => ['PCG006', 'PCG012'], 'cf' => 0.85],
    ['disease' => 'PCK004', 'symptoms' => ['PCG002', 'PCG012'], 'cf' => 0.85],

    // PCK002: PSU Kekurangan Watt (Undersized)
    ['disease' => 'PCK002', 'symptoms' => ['PCG008'], 'cf' => 0.85],
    ['disease' => 'PCK002', 'symptoms' => ['PCG008', 'PCG015'], 'cf' => 0.9],
    ['disease' => 'PCK002', 'symptoms' => ['PCG008', 'PCG020'], 'cf' => 0.85],
    ['disease' => 'PCK002', 'symptoms' => ['PCG002', 'PCG008'], 'cf' => 0.85],

    // PCK003: Kabel Power Internal Longgar / Tidak Terpasang
    ['disease' => 'PCK003', 'symptoms' => ['PCG009'], 'cf' => 0.85],
    ['disease' => 'PCK003', 'symptoms' => ['PCG010'], 'cf' => 0.85],
    ['disease' => 'PCK003', 'symptoms' => ['PCG011'], 'cf' => 0.85],
    ['disease' => 'PCK003', 'symptoms' => ['PCG007', 'PCG009'], 'cf' => 0.9],
    ['disease' => 'PCK003', 'symptoms' => ['PCG007', 'PCG010'], 'cf' => 0.9],

    // PCK005: Short Circuit di Motherboard / Komponen
    ['disease' => 'PCK005', 'symptoms' => ['PCG001', 'PCG018'], 'cf' => 0.8],
    ['disease' => 'PCK005', 'symptoms' => ['PCG003', 'PCG012'], 'cf' => 0.75],

    // PCK007: Fitur PSU Protection Aktif (OCP/OPP/OTP)
    ['disease' => 'PCK007', 'symptoms' => ['PCG017'], 'cf' => 0.85],
    ['disease' => 'PCK007', 'symptoms' => ['PCG008', 'PCG017'], 'cf' => 0.9],

    // PCK006: PSU Terbakar / Overvoltage Spike
    ['disease' => 'PCK006', 'symptoms' => ['PCG013'], 'cf' => 0.75],

    // PCK004: Kapasitor PSU Rusak / Kembung
    ['disease' => 'PCK004', 'symptoms' => ['PCG012', 'PCG019'], 'cf' => 0.8],

    // PCK002: PSU Kekurangan Watt (Undersized)
    ['disease' => 'PCK002', 'symptoms' => ['PCG015', 'PCG018'], 'cf' => 0.8],

    // PCK001: PSU Rusak / Mati Total
    ['disease' => 'PCK001', 'symptoms' => ['PCG004', 'PCG007'], 'cf' => 0.85],

    // PCK008: Motherboard Rusak / Perlu Diganti
    ['disease' => 'PCK008', 'symptoms' => ['PCG021'], 'cf' => 0.75],
    ['disease' => 'PCK008', 'symptoms' => ['PCG028'], 'cf' => 0.95],
    ['disease' => 'PCK008', 'symptoms' => ['PCG021', 'PCG028'], 'cf' => 0.95],
    ['disease' => 'PCK008', 'symptoms' => ['PCG021', 'PCG029'], 'cf' => 0.9],

    // PCK010: Kapasitor Motherboard Rusak
    ['disease' => 'PCK010', 'symptoms' => ['PCG029'], 'cf' => 0.85],
    ['disease' => 'PCK010', 'symptoms' => ['PCG027', 'PCG029'], 'cf' => 0.85],

    // PCK009: Baterai CMOS Habis
    ['disease' => 'PCK009', 'symptoms' => ['PCG024'], 'cf' => 0.9],
    ['disease' => 'PCK009', 'symptoms' => ['PCG024', 'PCG030'], 'cf' => 0.9],

    // PCK011: BIOS / UEFI Corrupt / Perlu Di-Flash
    ['disease' => 'PCK011', 'symptoms' => ['PCG034'], 'cf' => 0.9],
    ['disease' => 'PCK011', 'symptoms' => ['PCG021', 'PCG034'], 'cf' => 0.9],
    ['disease' => 'PCK011', 'symptoms' => ['PCG021', 'PCG023'], 'cf' => 0.8],

    // PCK008: Motherboard Rusak / Perlu Diganti
    ['disease' => 'PCK008', 'symptoms' => ['PCG021', 'PCG022'], 'cf' => 0.8],

    // PCK014: Slot PCIe / DIMM Fisik Rusak
    ['disease' => 'PCK014', 'symptoms' => ['PCG025'], 'cf' => 0.8],
    ['disease' => 'PCK014', 'symptoms' => ['PCG031'], 'cf' => 0.8],
    ['disease' => 'PCK014', 'symptoms' => ['PCG021', 'PCG031'], 'cf' => 0.85],

    // PCK012: Chipset / IC Controller Motherboard Rusak
    ['disease' => 'PCK012', 'symptoms' => ['PCG026', 'PCG032'], 'cf' => 0.8],
    ['disease' => 'PCK012', 'symptoms' => ['PCG032', 'PCG033'], 'cf' => 0.8],

    // PCK013: VRM Motherboard Bermasalah / Rusak
    ['disease' => 'PCK013', 'symptoms' => ['PCG037'], 'cf' => 0.85],
    ['disease' => 'PCK013', 'symptoms' => ['PCG027', 'PCG037'], 'cf' => 0.85],

    // PCK012: Chipset / IC Controller Motherboard Rusak
    ['disease' => 'PCK012', 'symptoms' => ['PCG039'], 'cf' => 0.75],

    // PCK014: Slot PCIe / DIMM Fisik Rusak
    ['disease' => 'PCK014', 'symptoms' => ['PCG036'], 'cf' => 0.8],

    // PCK011: BIOS / UEFI Corrupt / Perlu Di-Flash
    ['disease' => 'PCK011', 'symptoms' => ['PCG021', 'PCG040'], 'cf' => 0.8],

    // PCK010: Kapasitor Motherboard Rusak
    ['disease' => 'PCK010', 'symptoms' => ['PCG035'], 'cf' => 0.75],

    // PCK008: Motherboard Rusak / Perlu Diganti
    ['disease' => 'PCK008', 'symptoms' => ['PCG040'], 'cf' => 0.75],
    ['disease' => 'PCK008', 'symptoms' => ['PCG021', 'PCG023'], 'cf' => 0.85],

    // PCK015: Thermal Paste CPU Kering / Perlu Diganti
    ['disease' => 'PCK015', 'symptoms' => ['PCG041'], 'cf' => 0.7],
    ['disease' => 'PCK015', 'symptoms' => ['PCG048'], 'cf' => 0.85],
    ['disease' => 'PCK015', 'symptoms' => ['PCG041', 'PCG048'], 'cf' => 0.9],
    ['disease' => 'PCK015', 'symptoms' => ['PCG048', 'PCG052'], 'cf' => 0.9],

    // PCK016: Cooler CPU Bermasalah (Longgar / Fan Mati)
    ['disease' => 'PCK016', 'symptoms' => ['PCG041', 'PCG049'], 'cf' => 0.9],
    ['disease' => 'PCK016', 'symptoms' => ['PCG050'], 'cf' => 0.9],
    ['disease' => 'PCK016', 'symptoms' => ['PCG049'], 'cf' => 0.85],

    // PCK021: Cooler CPU Tidak Kompatibel dengan Socket
    ['disease' => 'PCK021', 'symptoms' => ['PCG049', 'PCG056'], 'cf' => 0.9],

    // PCK017: CPU Overheating (Thermal Throttling)
    ['disease' => 'PCK017', 'symptoms' => ['PCG041', 'PCG042'], 'cf' => 0.9],
    ['disease' => 'PCK017', 'symptoms' => ['PCG041', 'PCG043'], 'cf' => 0.9],
    ['disease' => 'PCK017', 'symptoms' => ['PCG041', 'PCG053'], 'cf' => 0.9],
    ['disease' => 'PCK017', 'symptoms' => ['PCG041', 'PCG059'], 'cf' => 0.9],
    ['disease' => 'PCK017', 'symptoms' => ['PCG041', 'PCG050'], 'cf' => 0.95],

    // PCK018: CPU Rusak / Defektif
    ['disease' => 'PCK018', 'symptoms' => ['PCG044'], 'cf' => 0.8],
    ['disease' => 'PCK018', 'symptoms' => ['PCG021', 'PCG044'], 'cf' => 0.85],
    ['disease' => 'PCK018', 'symptoms' => ['PCG043', 'PCG058'], 'cf' => 0.85],

    // PCK019: Socket CPU / Pin LGA Bengkok
    ['disease' => 'PCK019', 'symptoms' => ['PCG051'], 'cf' => 0.95],
    ['disease' => 'PCK019', 'symptoms' => ['PCG044', 'PCG051'], 'cf' => 0.95],

    // PCK020: Overclock / Voltage Setting Tidak Stabil
    ['disease' => 'PCK020', 'symptoms' => ['PCG047'], 'cf' => 0.85],
    ['disease' => 'PCK020', 'symptoms' => ['PCG043', 'PCG047'], 'cf' => 0.85],
    ['disease' => 'PCK020', 'symptoms' => ['PCG043', 'PCG054'], 'cf' => 0.8],

    // PCK017: CPU Overheating (Thermal Throttling)
    ['disease' => 'PCK017', 'symptoms' => ['PCG042', 'PCG060'], 'cf' => 0.8],

    // PCK016: Cooler CPU Bermasalah (Longgar / Fan Mati)
    ['disease' => 'PCK016', 'symptoms' => ['PCG050', 'PCG052'], 'cf' => 0.9],

    // PCK018: CPU Rusak / Defektif
    ['disease' => 'PCK018', 'symptoms' => ['PCG059'], 'cf' => 0.75],

    // PCK017: CPU Overheating (Thermal Throttling)
    ['disease' => 'PCK017', 'symptoms' => ['PCG042', 'PCG045'], 'cf' => 0.85],

    // PCK022: RAM DIMM Tidak Terpasang Benar
    ['disease' => 'PCK022', 'symptoms' => ['PCG061'], 'cf' => 0.75],
    ['disease' => 'PCK022', 'symptoms' => ['PCG061', 'PCG072'], 'cf' => 0.9],
    ['disease' => 'PCK022', 'symptoms' => ['PCG061', 'PCG073'], 'cf' => 0.85],

    // PCK023: Modul RAM DIMM Rusak
    ['disease' => 'PCK023', 'symptoms' => ['PCG065'], 'cf' => 0.9],
    ['disease' => 'PCK023', 'symptoms' => ['PCG062', 'PCG065'], 'cf' => 0.95],
    ['disease' => 'PCK023', 'symptoms' => ['PCG064', 'PCG065'], 'cf' => 0.9],
    ['disease' => 'PCK023', 'symptoms' => ['PCG065', 'PCG069'], 'cf' => 0.9],

    // PCK024: Slot DIMM Motherboard Rusak
    ['disease' => 'PCK024', 'symptoms' => ['PCG068', 'PCG078'], 'cf' => 0.85],
    ['disease' => 'PCK024', 'symptoms' => ['PCG068'], 'cf' => 0.85],

    // PCK025: Kontak DIMM Kotor / Teroksidasi
    ['disease' => 'PCK025', 'symptoms' => ['PCG071'], 'cf' => 0.85],
    ['disease' => 'PCK025', 'symptoms' => ['PCG061', 'PCG071'], 'cf' => 0.85],

    // PCK026: XMP / EXPO Profile Tidak Aktif
    ['disease' => 'PCK026', 'symptoms' => ['PCG066'], 'cf' => 0.85],
    ['disease' => 'PCK026', 'symptoms' => ['PCG070'], 'cf' => 0.8],

    // PCK027: RAM Tidak Kompatibel / Mixing Bermasalah
    ['disease' => 'PCK027', 'symptoms' => ['PCG075'], 'cf' => 0.8],
    ['disease' => 'PCK027', 'symptoms' => ['PCG074'], 'cf' => 0.85],
    ['disease' => 'PCK027', 'symptoms' => ['PCG062', 'PCG067'], 'cf' => 0.8],
    ['disease' => 'PCK027', 'symptoms' => ['PCG063', 'PCG075'], 'cf' => 0.8],

    // PCK023: Modul RAM DIMM Rusak
    ['disease' => 'PCK023', 'symptoms' => ['PCG062'], 'cf' => 0.75],
    ['disease' => 'PCK023', 'symptoms' => ['PCG064'], 'cf' => 0.7],
    ['disease' => 'PCK023', 'symptoms' => ['PCG073'], 'cf' => 0.8],

    // PCK022: RAM DIMM Tidak Terpasang Benar
    ['disease' => 'PCK022', 'symptoms' => ['PCG078'], 'cf' => 0.75],

    // PCK027: RAM Tidak Kompatibel / Mixing Bermasalah
    ['disease' => 'PCK027', 'symptoms' => ['PCG061', 'PCG075'], 'cf' => 0.8],

    // PCK023: Modul RAM DIMM Rusak
    ['disease' => 'PCK023', 'symptoms' => ['PCG076'], 'cf' => 0.7],

    // PCK027: RAM Tidak Kompatibel / Mixing Bermasalah
    ['disease' => 'PCK027', 'symptoms' => ['PCG067'], 'cf' => 0.75],

    // PCK025: Kontak DIMM Kotor / Teroksidasi
    ['disease' => 'PCK025', 'symptoms' => ['PCG063'], 'cf' => 0.65],

    // PCK028: GPU Rusak (BGA / Die Failure)
    ['disease' => 'PCK028', 'symptoms' => ['PCG079'], 'cf' => 0.75],
    ['disease' => 'PCK028', 'symptoms' => ['PCG079', 'PCG080'], 'cf' => 0.85],
    ['disease' => 'PCK028', 'symptoms' => ['PCG079', 'PCG081'], 'cf' => 0.85],

    // PCK032: vRAM GPU Rusak
    ['disease' => 'PCK032', 'symptoms' => ['PCG086'], 'cf' => 0.85],
    ['disease' => 'PCK032', 'symptoms' => ['PCG080', 'PCG086'], 'cf' => 0.9],
    ['disease' => 'PCK032', 'symptoms' => ['PCG086', 'PCG092'], 'cf' => 0.85],
    ['disease' => 'PCK032', 'symptoms' => ['PCG086', 'PCG098'], 'cf' => 0.85],

    // PCK029: Driver GPU Corrupt / Bermasalah
    ['disease' => 'PCK029', 'symptoms' => ['PCG085'], 'cf' => 0.8],
    ['disease' => 'PCK029', 'symptoms' => ['PCG084', 'PCG085'], 'cf' => 0.8],
    ['disease' => 'PCK029', 'symptoms' => ['PCG096'], 'cf' => 0.8],

    // PCK030: GPU Overheating
    ['disease' => 'PCK030', 'symptoms' => ['PCG082', 'PCG083'], 'cf' => 0.95],
    ['disease' => 'PCK030', 'symptoms' => ['PCG082'], 'cf' => 0.8],
    ['disease' => 'PCK030', 'symptoms' => ['PCG082', 'PCG088'], 'cf' => 0.9],

    // PCK031: Fan GPU Rusak
    ['disease' => 'PCK031', 'symptoms' => ['PCG083'], 'cf' => 0.9],
    ['disease' => 'PCK031', 'symptoms' => ['PCG097'], 'cf' => 0.85],
    ['disease' => 'PCK031', 'symptoms' => ['PCG081', 'PCG083'], 'cf' => 0.9],

    // PCK033: PCIe Power Connector / Slot GPU Bermasalah
    ['disease' => 'PCK033', 'symptoms' => ['PCG079', 'PCG087'], 'cf' => 0.9],
    ['disease' => 'PCK033', 'symptoms' => ['PCG087'], 'cf' => 0.85],
    ['disease' => 'PCK033', 'symptoms' => ['PCG079', 'PCG089'], 'cf' => 0.85],
    ['disease' => 'PCK033', 'symptoms' => ['PCG089', 'PCG094'], 'cf' => 0.85],

    // PCK034: GPU Tidak Dapat Daya Cukup dari PSU
    ['disease' => 'PCK034', 'symptoms' => ['PCG084', 'PCG091'], 'cf' => 0.85],
    ['disease' => 'PCK034', 'symptoms' => ['PCG081', 'PCG091'], 'cf' => 0.85],

    // PCK029: Driver GPU Corrupt / Bermasalah
    ['disease' => 'PCK029', 'symptoms' => ['PCG095'], 'cf' => 0.75],

    // PCK030: GPU Overheating
    ['disease' => 'PCK030', 'symptoms' => ['PCG082', 'PCG090'], 'cf' => 0.85],

    // PCK028: GPU Rusak (BGA / Die Failure)
    ['disease' => 'PCK028', 'symptoms' => ['PCG093'], 'cf' => 0.5],

    // PCK035: HDD 3.5" Rusak / Failing
    ['disease' => 'PCK035', 'symptoms' => ['PCG100'], 'cf' => 0.9],
    ['disease' => 'PCK035', 'symptoms' => ['PCG100', 'PCG102'], 'cf' => 0.95],
    ['disease' => 'PCK035', 'symptoms' => ['PCG100', 'PCG103'], 'cf' => 0.95],
    ['disease' => 'PCK035', 'symptoms' => ['PCG100', 'PCG114'], 'cf' => 0.9],
    ['disease' => 'PCK035', 'symptoms' => ['PCG117'], 'cf' => 0.85],

    // PCK036: SSD Degradasi / Controller Fail
    ['disease' => 'PCK036', 'symptoms' => ['PCG108'], 'cf' => 0.9],
    ['disease' => 'PCK036', 'symptoms' => ['PCG102', 'PCG108'], 'cf' => 0.9],
    ['disease' => 'PCK036', 'symptoms' => ['PCG108', 'PCG115'], 'cf' => 0.8],

    // PCK037: Bad Sector pada HDD
    ['disease' => 'PCK037', 'symptoms' => ['PCG103'], 'cf' => 0.85],
    ['disease' => 'PCK037', 'symptoms' => ['PCG103', 'PCG118'], 'cf' => 0.9],
    ['disease' => 'PCK037', 'symptoms' => ['PCG103', 'PCG104'], 'cf' => 0.85],

    // PCK038: Kabel SATA / Power SATA Rusak
    ['disease' => 'PCK038', 'symptoms' => ['PCG099', 'PCG111'], 'cf' => 0.9],
    ['disease' => 'PCK038', 'symptoms' => ['PCG109', 'PCG111'], 'cf' => 0.85],
    ['disease' => 'PCK038', 'symptoms' => ['PCG111', 'PCG113'], 'cf' => 0.85],

    // PCK039: Partisi / MBR / GPT Corrupt
    ['disease' => 'PCK039', 'symptoms' => ['PCG107'], 'cf' => 0.8],
    ['disease' => 'PCK039', 'symptoms' => ['PCG101', 'PCG107'], 'cf' => 0.85],
    ['disease' => 'PCK039', 'symptoms' => ['PCG099', 'PCG114'], 'cf' => 0.8],

    // PCK040: Slot M.2 / PCIe Storage Bermasalah
    ['disease' => 'PCK040', 'symptoms' => ['PCG105'], 'cf' => 0.8],
    ['disease' => 'PCK040', 'symptoms' => ['PCG099', 'PCG105'], 'cf' => 0.85],

    // PCK041: NVMe SSD Overheating (Perlu Heatsink)
    ['disease' => 'PCK041', 'symptoms' => ['PCG115'], 'cf' => 0.85],
    ['disease' => 'PCK041', 'symptoms' => ['PCG110', 'PCG115'], 'cf' => 0.9],

    // PCK038: Kabel SATA / Power SATA Rusak
    ['disease' => 'PCK038', 'symptoms' => ['PCG106'], 'cf' => 0.75],

    // PCK036: SSD Degradasi / Controller Fail
    ['disease' => 'PCK036', 'symptoms' => ['PCG116'], 'cf' => 0.7],

    // PCK035: HDD 3.5" Rusak / Failing
    ['disease' => 'PCK035', 'symptoms' => ['PCG112'], 'cf' => 0.8],

    // PCK038: Kabel SATA / Power SATA Rusak
    ['disease' => 'PCK038', 'symptoms' => ['PCG109'], 'cf' => 0.75],

    // PCK042: Kabel Front Panel Salah Pasang / Longgar
    ['disease' => 'PCK042', 'symptoms' => ['PCG119'], 'cf' => 0.75],
    ['disease' => 'PCK042', 'symptoms' => ['PCG119', 'PCG125'], 'cf' => 0.85],
    ['disease' => 'PCK042', 'symptoms' => ['PCG123', 'PCG125'], 'cf' => 0.8],

    // PCK043: Tombol Power / Reset Front Panel Rusak
    ['disease' => 'PCK043', 'symptoms' => ['PCG119', 'PCG123'], 'cf' => 0.75],
    ['disease' => 'PCK043', 'symptoms' => ['PCG119', 'PCG120'], 'cf' => 0.75],

    // PCK044: Kabel USB Front Panel Longgar / Rusak
    ['disease' => 'PCK044', 'symptoms' => ['PCG121'], 'cf' => 0.8],
    ['disease' => 'PCK044', 'symptoms' => ['PCG121', 'PCG131'], 'cf' => 0.8],

    // PCK045: Airflow Casing Tidak Optimal
    ['disease' => 'PCK045', 'symptoms' => ['PCG127'], 'cf' => 0.8],
    ['disease' => 'PCK045', 'symptoms' => ['PCG041', 'PCG127'], 'cf' => 0.85],
    ['disease' => 'PCK045', 'symptoms' => ['PCG127', 'PCG129'], 'cf' => 0.8],

    // PCK046: Grounding Casing Bermasalah
    ['disease' => 'PCK046', 'symptoms' => ['PCG133'], 'cf' => 0.85],

    // PCK044: Kabel USB Front Panel Longgar / Rusak
    ['disease' => 'PCK044', 'symptoms' => ['PCG121', 'PCG122'], 'cf' => 0.75],

    // PCK042: Kabel Front Panel Salah Pasang / Longgar
    ['disease' => 'PCK042', 'symptoms' => ['PCG124'], 'cf' => 0.65],
    ['disease' => 'PCK042', 'symptoms' => ['PCG130'], 'cf' => 0.75],

    // PCK045: Airflow Casing Tidak Optimal
    ['disease' => 'PCK045', 'symptoms' => ['PCG126'], 'cf' => 0.6],

    // PCK047: Debu Menumpuk di Sistem Pendinginan
    ['disease' => 'PCK047', 'symptoms' => ['PCG138'], 'cf' => 0.85],
    ['disease' => 'PCK047', 'symptoms' => ['PCG134', 'PCG138'], 'cf' => 0.9],
    ['disease' => 'PCK047', 'symptoms' => ['PCG137', 'PCG138'], 'cf' => 0.9],

    // PCK048: Fan Casing Rusak / Tidak Berfungsi
    ['disease' => 'PCK048', 'symptoms' => ['PCG135'], 'cf' => 0.85],
    ['disease' => 'PCK048', 'symptoms' => ['PCG134', 'PCG135'], 'cf' => 0.9],
    ['disease' => 'PCK048', 'symptoms' => ['PCG136', 'PCG137'], 'cf' => 0.8],

    // PCK049: AIO Liquid Cooler Rusak
    ['disease' => 'PCK049', 'symptoms' => ['PCG140'], 'cf' => 0.85],
    ['disease' => 'PCK049', 'symptoms' => ['PCG147'], 'cf' => 0.9],
    ['disease' => 'PCK049', 'symptoms' => ['PCG140', 'PCG147'], 'cf' => 0.95],

    // PCK050: AIO Liquid Cooler Bocor (Darurat)
    ['disease' => 'PCK050', 'symptoms' => ['PCG141'], 'cf' => 1.0],
    ['disease' => 'PCK050', 'symptoms' => ['PCG134', 'PCG141'], 'cf' => 1.0],

    // PCK051: Airflow Casing Tidak Optimal
    ['disease' => 'PCK051', 'symptoms' => ['PCG145'], 'cf' => 0.8],
    ['disease' => 'PCK051', 'symptoms' => ['PCG134', 'PCG145'], 'cf' => 0.85],

    // PCK052: Thermal Pad VRM / Chipset Perlu Diganti
    ['disease' => 'PCK052', 'symptoms' => ['PCG143'], 'cf' => 0.8],
    ['disease' => 'PCK052', 'symptoms' => ['PCG143', 'PCG146'], 'cf' => 0.85],

    // PCK053: Custom Water Cooling Bermasalah
    ['disease' => 'PCK053', 'symptoms' => ['PCG142'], 'cf' => 0.85],
    ['disease' => 'PCK053', 'symptoms' => ['PCG142', 'PCG147'], 'cf' => 0.9],

    // PCK048: Fan Casing Rusak / Tidak Berfungsi
    ['disease' => 'PCK048', 'symptoms' => ['PCG135', 'PCG137'], 'cf' => 0.9],
    ['disease' => 'PCK048', 'symptoms' => ['PCG144'], 'cf' => 0.75],

    // PCK047: Debu Menumpuk di Sistem Pendinginan
    ['disease' => 'PCK047', 'symptoms' => ['PCG136'], 'cf' => 0.7],

    // PCK054: Driver Audio Corrupt / Tidak Kompatibel
    ['disease' => 'PCK054', 'symptoms' => ['PCG151'], 'cf' => 0.8],
    ['disease' => 'PCK054', 'symptoms' => ['PCG156'], 'cf' => 0.85],
    ['disease' => 'PCK054', 'symptoms' => ['PCG151', 'PCG156'], 'cf' => 0.9],
    ['disease' => 'PCK054', 'symptoms' => ['PCG149', 'PCG151'], 'cf' => 0.8],

    // PCK055: IC Audio Onboard Motherboard Rusak
    ['disease' => 'PCK055', 'symptoms' => ['PCG151', 'PCG157'], 'cf' => 0.8],
    ['disease' => 'PCK055', 'symptoms' => ['PCG151', 'PCG155'], 'cf' => 0.8],

    // PCK056: Jack Audio Fisik Rusak (Rear / Front)
    ['disease' => 'PCK056', 'symptoms' => ['PCG152'], 'cf' => 0.8],

    // PCK057: Kabel Audio Front Panel Longgar
    ['disease' => 'PCK057', 'symptoms' => ['PCG153'], 'cf' => 0.8],

    // PCK056: Jack Audio Fisik Rusak (Rear / Front)
    ['disease' => 'PCK056', 'symptoms' => ['PCG153', 'PCG153'], 'cf' => 0.75],

    // PCK058: Sound Card PCIe Diskrit Bermasalah
    ['disease' => 'PCK058', 'symptoms' => ['PCG157'], 'cf' => 0.8],
    ['disease' => 'PCK058', 'symptoms' => ['PCG150', 'PCG157'], 'cf' => 0.8],

    // PCK059: Ground Loop / Interference Noise
    ['disease' => 'PCK059', 'symptoms' => ['PCG158'], 'cf' => 0.8],
    ['disease' => 'PCK059', 'symptoms' => ['PCG150', 'PCG158'], 'cf' => 0.85],

    // PCK054: Driver Audio Corrupt / Tidak Kompatibel
    ['disease' => 'PCK054', 'symptoms' => ['PCG150'], 'cf' => 0.65],
    ['disease' => 'PCK054', 'symptoms' => ['PCG154'], 'cf' => 0.7],
    ['disease' => 'PCK054', 'symptoms' => ['PCG159'], 'cf' => 0.7],

    // PCK056: Jack Audio Fisik Rusak (Rear / Front)
    ['disease' => 'PCK056', 'symptoms' => ['PCG149', 'PCG152'], 'cf' => 0.8],

    // PCK054: Driver Audio Corrupt / Tidak Kompatibel
    ['disease' => 'PCK054', 'symptoms' => ['PCG161'], 'cf' => 0.65],

    // PCK055: IC Audio Onboard Motherboard Rusak
    ['disease' => 'PCK055', 'symptoms' => ['PCG155'], 'cf' => 0.7],

    // PCK054: Driver Audio Corrupt / Tidak Kompatibel
    ['disease' => 'PCK054', 'symptoms' => ['PCG160'], 'cf' => 0.65],

    // PCK060: Driver LAN / WiFi Bermasalah
    ['disease' => 'PCK060', 'symptoms' => ['PCG164', 'PCG166'], 'cf' => 0.85],
    ['disease' => 'PCK060', 'symptoms' => ['PCG165', 'PCG166'], 'cf' => 0.85],
    ['disease' => 'PCK060', 'symptoms' => ['PCG166'], 'cf' => 0.8],
    ['disease' => 'PCK060', 'symptoms' => ['PCG173'], 'cf' => 0.8],

    // PCK062: Port LAN Fisik Rusak
    ['disease' => 'PCK062', 'symptoms' => ['PCG164', 'PCG167'], 'cf' => 0.85],
    ['disease' => 'PCK062', 'symptoms' => ['PCG167'], 'cf' => 0.8],

    // PCK061: IC LAN Onboard Motherboard Rusak
    ['disease' => 'PCK061', 'symptoms' => ['PCG164'], 'cf' => 0.7],
    ['disease' => 'PCK061', 'symptoms' => ['PCG175'], 'cf' => 0.8],
    ['disease' => 'PCK061', 'symptoms' => ['PCG164', 'PCG175'], 'cf' => 0.85],

    // PCK063: WiFi Card PCIe Bermasalah
    ['disease' => 'PCK063', 'symptoms' => ['PCG165'], 'cf' => 0.8],
    ['disease' => 'PCK063', 'symptoms' => ['PCG165', 'PCG171'], 'cf' => 0.8],
    ['disease' => 'PCK063', 'symptoms' => ['PCG171'], 'cf' => 0.8],

    // PCK064: Konfigurasi / Setting Jaringan Bermasalah
    ['disease' => 'PCK064', 'symptoms' => ['PCG170'], 'cf' => 0.8],
    ['disease' => 'PCK064', 'symptoms' => ['PCG169', 'PCG174'], 'cf' => 0.7],

    // PCK065: Kabel LAN atau Perangkat Jaringan Eksternal Bermasalah
    ['disease' => 'PCK065', 'symptoms' => ['PCG168'], 'cf' => 0.65],
    ['disease' => 'PCK065', 'symptoms' => ['PCG169'], 'cf' => 0.65],

    // PCK063: WiFi Card PCIe Bermasalah
    ['disease' => 'PCK063', 'symptoms' => ['PCG165', 'PCG176'], 'cf' => 0.8],

    // PCK060: Driver LAN / WiFi Bermasalah
    ['disease' => 'PCK060', 'symptoms' => ['PCG172'], 'cf' => 0.65],
    ['disease' => 'PCK060', 'symptoms' => ['PCG164', 'PCG173'], 'cf' => 0.8],

    // PCK061: IC LAN Onboard Motherboard Rusak
    ['disease' => 'PCK061', 'symptoms' => ['PCG164', 'PCG167'], 'cf' => 0.8],

    // PCK066: Driver USB Controller Bermasalah
    ['disease' => 'PCK066', 'symptoms' => ['PCG178'], 'cf' => 0.7],
    ['disease' => 'PCK066', 'symptoms' => ['PCG183'], 'cf' => 0.75],
    ['disease' => 'PCK066', 'symptoms' => ['PCG184'], 'cf' => 0.7],
    ['disease' => 'PCK066', 'symptoms' => ['PCG182'], 'cf' => 0.7],

    // PCK067: Kabel Header USB Front Panel Longgar / Rusak
    ['disease' => 'PCK067', 'symptoms' => ['PCG179', 'PCG191'], 'cf' => 0.85],
    ['disease' => 'PCK067', 'symptoms' => ['PCG191'], 'cf' => 0.85],
    ['disease' => 'PCK067', 'symptoms' => ['PCG179', 'PCG179'], 'cf' => 0.8],

    // PCK068: Port USB Fisik Rusak
    ['disease' => 'PCK068', 'symptoms' => ['PCG178'], 'cf' => 0.65],

    // PCK069: IC USB Controller Motherboard Rusak
    ['disease' => 'PCK069', 'symptoms' => ['PCG178', 'PCG183'], 'cf' => 0.85],
    ['disease' => 'PCK069', 'symptoms' => ['PCG178', 'PCG192'], 'cf' => 0.8],

    // PCK070: Daya Port USB Tidak Mencukupi
    ['disease' => 'PCK070', 'symptoms' => ['PCG190'], 'cf' => 0.75],
    ['disease' => 'PCK070', 'symptoms' => ['PCG182'], 'cf' => 0.65],

    // PCK071: Peripheral / Perangkat yang Terhubung Rusak
    ['disease' => 'PCK071', 'symptoms' => ['PCG180', 'PCG181'], 'cf' => 0.65],
    ['disease' => 'PCK071', 'symptoms' => ['PCG187'], 'cf' => 0.65],

    // PCK069: IC USB Controller Motherboard Rusak
    ['disease' => 'PCK069', 'symptoms' => ['PCG185'], 'cf' => 0.7],

    // PCK068: Port USB Fisik Rusak
    ['disease' => 'PCK068', 'symptoms' => ['PCG186'], 'cf' => 0.7],

    // PCK069: IC USB Controller Motherboard Rusak
    ['disease' => 'PCK069', 'symptoms' => ['PCG183'], 'cf' => 0.8],
    ['disease' => 'PCK069', 'symptoms' => ['PCG183', 'PCG184'], 'cf' => 0.75],

    // PCK072: Windows / OS Corrupt
    ['disease' => 'PCK072', 'symptoms' => ['PCG196', 'PCG203'], 'cf' => 0.9],
    ['disease' => 'PCK072', 'symptoms' => ['PCG196', 'PCG201'], 'cf' => 0.9],
    ['disease' => 'PCK072', 'symptoms' => ['PCG193', 'PCG201'], 'cf' => 0.85],
    ['disease' => 'PCK072', 'symptoms' => ['PCG196', 'PCG202'], 'cf' => 0.85],

    // PCK073: Infeksi Virus / Malware
    ['disease' => 'PCK073', 'symptoms' => ['PCG195'], 'cf' => 0.85],
    ['disease' => 'PCK073', 'symptoms' => ['PCG195', 'PCG207'], 'cf' => 0.9],
    ['disease' => 'PCK073', 'symptoms' => ['PCG194', 'PCG195'], 'cf' => 0.85],
    ['disease' => 'PCK073', 'symptoms' => ['PCG193', 'PCG195'], 'cf' => 0.85],

    // PCK074: Driver Hardware Tidak Kompatibel
    ['disease' => 'PCK074', 'symptoms' => ['PCG200'], 'cf' => 0.85],
    ['disease' => 'PCK074', 'symptoms' => ['PCG193', 'PCG200'], 'cf' => 0.85],

    // PCK075: Bloatware / Startup Berlebihan
    ['disease' => 'PCK075', 'symptoms' => ['PCG197', 'PCG198'], 'cf' => 0.8],
    ['disease' => 'PCK075', 'symptoms' => ['PCG194', 'PCG198'], 'cf' => 0.8],

    // PCK076: File System / Partisi Corrupt
    ['disease' => 'PCK076', 'symptoms' => ['PCG204'], 'cf' => 0.85],
    ['disease' => 'PCK076', 'symptoms' => ['PCG196', 'PCG204'], 'cf' => 0.9],

    // PCK077: User Profile Windows Corrupt
    ['disease' => 'PCK077', 'symptoms' => ['PCG205'], 'cf' => 0.85],
    ['disease' => 'PCK077', 'symptoms' => ['PCG196', 'PCG205'], 'cf' => 0.85],

    // PCK072: Windows / OS Corrupt
    ['disease' => 'PCK072', 'symptoms' => ['PCG193'], 'cf' => 0.7],
    ['disease' => 'PCK072', 'symptoms' => ['PCG203'], 'cf' => 0.85],
    ['disease' => 'PCK072', 'symptoms' => ['PCG196', 'PCG209'], 'cf' => 0.85],

    // PCK073: Infeksi Virus / Malware
    ['disease' => 'PCK073', 'symptoms' => ['PCG194', 'PCG207'], 'cf' => 0.85],

    // PCK078: Setting Overclock CPU Tidak Stabil
    ['disease' => 'PCK078', 'symptoms' => ['PCG211'], 'cf' => 0.9],

    // PCK083: Thermal Tidak Memadai untuk OC
    ['disease' => 'PCK083', 'symptoms' => ['PCG211', 'PCG218'], 'cf' => 0.9],

    // PCK079: XMP / EXPO Profile Tidak Kompatibel
    ['disease' => 'PCK079', 'symptoms' => ['PCG212'], 'cf' => 0.85],
    ['disease' => 'PCK079', 'symptoms' => ['PCG217'], 'cf' => 0.85],
    ['disease' => 'PCK079', 'symptoms' => ['PCG211', 'PCG212'], 'cf' => 0.85],

    // PCK080: GPU Overclock Tidak Stabil
    ['disease' => 'PCK080', 'symptoms' => ['PCG213'], 'cf' => 0.85],
    ['disease' => 'PCK080', 'symptoms' => ['PCG080', 'PCG213'], 'cf' => 0.9],

    // PCK081: CPU Overvoltage Berbahaya
    ['disease' => 'PCK081', 'symptoms' => ['PCG216'], 'cf' => 0.9],
    ['disease' => 'PCK081', 'symptoms' => ['PCG211', 'PCG216'], 'cf' => 0.9],

    // PCK082: BIOS OC Setting Menyebabkan Boot Fail
    ['disease' => 'PCK082', 'symptoms' => ['PCG219'], 'cf' => 0.9],
    ['disease' => 'PCK082', 'symptoms' => ['PCG211', 'PCG219'], 'cf' => 0.9],

    // PCK083: Thermal Tidak Memadai untuk OC
    ['disease' => 'PCK083', 'symptoms' => ['PCG218'], 'cf' => 0.85],
    ['disease' => 'PCK083', 'symptoms' => ['PCG042', 'PCG218'], 'cf' => 0.9],
    ['disease' => 'PCK083', 'symptoms' => ['PCG218', 'PCG221'], 'cf' => 0.85],

    // PCK078: Setting Overclock CPU Tidak Stabil
    ['disease' => 'PCK078', 'symptoms' => ['PCG215'], 'cf' => 0.75],

    // PCK082: BIOS OC Setting Menyebabkan Boot Fail
    ['disease' => 'PCK082', 'symptoms' => ['PCG225'], 'cf' => 0.85],

    // PCK078: Setting Overclock CPU Tidak Stabil
    ['disease' => 'PCK078', 'symptoms' => ['PCG211', 'PCG224'], 'cf' => 0.8],

    // PCK079: XMP / EXPO Profile Tidak Kompatibel
    ['disease' => 'PCK079', 'symptoms' => ['PCG223'], 'cf' => 0.8],

    // PCK078: Setting Overclock CPU Tidak Stabil
    ['disease' => 'PCK078', 'symptoms' => ['PCG220'], 'cf' => 0.7],

    // PCK081: CPU Overvoltage Berbahaya
    ['disease' => 'PCK081', 'symptoms' => ['PCG222'], 'cf' => 0.75],
];
