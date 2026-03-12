<?php

// Dataset AIO (All-in-One PC) - 266 rules
// Format: disease => code kerusakan, symptoms => [kode gejala], cf => certainty factor
return [

    // AIOK001: Adaptor Eksternal AIO Rusak
    ['disease' => 'AIOK001', 'symptoms' => ['AIOG001', 'AIOG002'], 'cf' => 0.85],
    ['disease' => 'AIOK001', 'symptoms' => ['AIOG002', 'AIOG006'], 'cf' => 0.85],
    ['disease' => 'AIOK001', 'symptoms' => ['AIOG007'], 'cf' => 0.95],
    ['disease' => 'AIOK001', 'symptoms' => ['AIOG001', 'AIOG007'], 'cf' => 0.95],
    ['disease' => 'AIOK001', 'symptoms' => ['AIOG006', 'AIOG007'], 'cf' => 0.9],

    // AIOK002: Kabel Adaptor Rusak / Terputus
    ['disease' => 'AIOK002', 'symptoms' => ['AIOG008'], 'cf' => 0.85],
    ['disease' => 'AIOK002', 'symptoms' => ['AIOG005', 'AIOG008'], 'cf' => 0.85],
    ['disease' => 'AIOK002', 'symptoms' => ['AIOG002', 'AIOG008'], 'cf' => 0.9],

    // AIOK003: Port DC Jack AIO Rusak
    ['disease' => 'AIOK003', 'symptoms' => ['AIOG009'], 'cf' => 0.85],
    ['disease' => 'AIOK003', 'symptoms' => ['AIOG005', 'AIOG009'], 'cf' => 0.9],
    ['disease' => 'AIOK003', 'symptoms' => ['AIOG002', 'AIOG009'], 'cf' => 0.85],
    ['disease' => 'AIOK003', 'symptoms' => ['AIOG009', 'AIOG012'], 'cf' => 0.8],

    // AIOK004: Adaptor Tidak Sesuai Spesifikasi
    ['disease' => 'AIOK004', 'symptoms' => ['AIOG011'], 'cf' => 0.85],
    ['disease' => 'AIOK004', 'symptoms' => ['AIOG010', 'AIOG011'], 'cf' => 0.9],
    ['disease' => 'AIOK004', 'symptoms' => ['AIOG002', 'AIOG011'], 'cf' => 0.85],

    // AIOK005: IC Power Management AIO Bermasalah
    ['disease' => 'AIOK005', 'symptoms' => ['AIOG001', 'AIOG003'], 'cf' => 0.75],
    ['disease' => 'AIOK005', 'symptoms' => ['AIOG004', 'AIOG015'], 'cf' => 0.8],
    ['disease' => 'AIOK005', 'symptoms' => ['AIOG003', 'AIOG005'], 'cf' => 0.75],

    // AIOK006: Tombol Power AIO Rusak
    ['disease' => 'AIOK006', 'symptoms' => ['AIOG014'], 'cf' => 0.85],
    ['disease' => 'AIOK006', 'symptoms' => ['AIOG003', 'AIOG014'], 'cf' => 0.85],

    // AIOK001: Adaptor Eksternal AIO Rusak
    ['disease' => 'AIOK001', 'symptoms' => ['AIOG001'], 'cf' => 0.65],

    // AIOK004: Adaptor Tidak Sesuai Spesifikasi
    ['disease' => 'AIOK004', 'symptoms' => ['AIOG010'], 'cf' => 0.7],

    // AIOK001: Adaptor Eksternal AIO Rusak
    ['disease' => 'AIOK001', 'symptoms' => ['AIOG012'], 'cf' => 0.65],

    // AIOK005: IC Power Management AIO Bermasalah
    ['disease' => 'AIOK005', 'symptoms' => ['AIOG005', 'AIOG015'], 'cf' => 0.8],
    ['disease' => 'AIOK005', 'symptoms' => ['AIOG004'], 'cf' => 0.65],

    // AIOK009: Backlight LED Strip AIO Rusak
    ['disease' => 'AIOK009', 'symptoms' => ['AIOG016', 'AIOG025'], 'cf' => 0.9],
    ['disease' => 'AIOK009', 'symptoms' => ['AIOG018', 'AIOG025'], 'cf' => 0.85],

    // AIOK008: Kabel Flex Layar AIO Rusak / Longgar
    ['disease' => 'AIOK008', 'symptoms' => ['AIOG016', 'AIOG026'], 'cf' => 0.9],
    ['disease' => 'AIOK008', 'symptoms' => ['AIOG019', 'AIOG026'], 'cf' => 0.85],
    ['disease' => 'AIOK008', 'symptoms' => ['AIOG016'], 'cf' => 0.65],

    // AIOK007: Panel LCD/LED AIO Rusak
    ['disease' => 'AIOK007', 'symptoms' => ['AIOG017'], 'cf' => 0.8],
    ['disease' => 'AIOK007', 'symptoms' => ['AIOG024'], 'cf' => 0.85],
    ['disease' => 'AIOK007', 'symptoms' => ['AIOG022'], 'cf' => 0.8],
    ['disease' => 'AIOK007', 'symptoms' => ['AIOG017', 'AIOG024'], 'cf' => 0.9],
    ['disease' => 'AIOK007', 'symptoms' => ['AIOG023'], 'cf' => 0.75],

    // AIOK011: Panel AIO Rusak Fisik (Pecah)
    ['disease' => 'AIOK011', 'symptoms' => ['AIOG020'], 'cf' => 1.0],

    // AIOK012: iGPU / Driver Display AIO Bermasalah
    ['disease' => 'AIOK012', 'symptoms' => ['AIOG027'], 'cf' => 0.8],
    ['disease' => 'AIOK012', 'symptoms' => ['AIOG017', 'AIOG027'], 'cf' => 0.8],
    ['disease' => 'AIOK012', 'symptoms' => ['AIOG028'], 'cf' => 0.75],
    ['disease' => 'AIOK012', 'symptoms' => ['AIOG021', 'AIOG028'], 'cf' => 0.75],

    // AIOK010: T-CON Board / IC Driver Display Bermasalah
    ['disease' => 'AIOK010', 'symptoms' => ['AIOG030'], 'cf' => 0.75],
    ['disease' => 'AIOK010', 'symptoms' => ['AIOG024', 'AIOG030'], 'cf' => 0.8],

    // AIOK008: Kabel Flex Layar AIO Rusak / Longgar
    ['disease' => 'AIOK008', 'symptoms' => ['AIOG019', 'AIOG026'], 'cf' => 0.85],

    // AIOK007: Panel LCD/LED AIO Rusak
    ['disease' => 'AIOK007', 'symptoms' => ['AIOG029'], 'cf' => 0.75],

    // AIOK009: Backlight LED Strip AIO Rusak
    ['disease' => 'AIOK009', 'symptoms' => ['AIOG025'], 'cf' => 0.85],

    // AIOK008: Kabel Flex Layar AIO Rusak / Longgar
    ['disease' => 'AIOK008', 'symptoms' => ['AIOG019'], 'cf' => 0.7],

    // AIOK009: Backlight LED Strip AIO Rusak
    ['disease' => 'AIOK009', 'symptoms' => ['AIOG018', 'AIOG022'], 'cf' => 0.8],

    // AIOK012: iGPU / Driver Display AIO Bermasalah
    ['disease' => 'AIOK012', 'symptoms' => ['AIOG016', 'AIOG027'], 'cf' => 0.75],
    ['disease' => 'AIOK012', 'symptoms' => ['AIOG017', 'AIOG027'], 'cf' => 0.8],

    // AIOK007: Panel LCD/LED AIO Rusak
    ['disease' => 'AIOK007', 'symptoms' => ['AIOG022', 'AIOG030'], 'cf' => 0.7],

    // AIOK013: Digitizer / Touchscreen Panel AIO Rusak
    ['disease' => 'AIOK013', 'symptoms' => ['AIOG031', 'AIOG036'], 'cf' => 0.85],
    ['disease' => 'AIOK013', 'symptoms' => ['AIOG031'], 'cf' => 0.75],
    ['disease' => 'AIOK013', 'symptoms' => ['AIOG031', 'AIOG033'], 'cf' => 0.85],
    ['disease' => 'AIOK013', 'symptoms' => ['AIOG031', 'AIOG038'], 'cf' => 0.8],

    // AIOK015: Konektor Digitizer AIO Longgar
    ['disease' => 'AIOK015', 'symptoms' => ['AIOG039'], 'cf' => 0.85],

    // AIOK013: Digitizer / Touchscreen Panel AIO Rusak
    ['disease' => 'AIOK013', 'symptoms' => ['AIOG031', 'AIOG039'], 'cf' => 0.85],

    // AIOK014: Driver Touchscreen Corrupt / Tidak Terinstall
    ['disease' => 'AIOK014', 'symptoms' => ['AIOG036'], 'cf' => 0.85],
    ['disease' => 'AIOK014', 'symptoms' => ['AIOG037'], 'cf' => 0.85],
    ['disease' => 'AIOK014', 'symptoms' => ['AIOG036', 'AIOG037'], 'cf' => 0.9],
    ['disease' => 'AIOK014', 'symptoms' => ['AIOG035'], 'cf' => 0.7],
    ['disease' => 'AIOK014', 'symptoms' => ['AIOG041'], 'cf' => 0.7],

    // AIOK016: Kalibrasi Touchscreen Perlu Dilakukan
    ['disease' => 'AIOK016', 'symptoms' => ['AIOG034'], 'cf' => 0.8],
    ['disease' => 'AIOK016', 'symptoms' => ['AIOG040'], 'cf' => 0.8],
    ['disease' => 'AIOK016', 'symptoms' => ['AIOG034', 'AIOG040'], 'cf' => 0.9],

    // AIOK013: Digitizer / Touchscreen Panel AIO Rusak
    ['disease' => 'AIOK013', 'symptoms' => ['AIOG032'], 'cf' => 0.8],
    ['disease' => 'AIOK013', 'symptoms' => ['AIOG032', 'AIOG033'], 'cf' => 0.85],

    // AIOK015: Konektor Digitizer AIO Longgar
    ['disease' => 'AIOK015', 'symptoms' => ['AIOG038'], 'cf' => 0.8],

    // AIOK017: Digitizer Rusak Akibat Benturan / Tekanan
    ['disease' => 'AIOK017', 'symptoms' => ['AIOG020', 'AIOG031'], 'cf' => 0.9],

    // AIOK014: Driver Touchscreen Corrupt / Tidak Terinstall
    ['disease' => 'AIOK014', 'symptoms' => ['AIOG042'], 'cf' => 0.6],

    // AIOK015: Konektor Digitizer AIO Longgar
    ['disease' => 'AIOK015', 'symptoms' => ['AIOG031', 'AIOG038'], 'cf' => 0.8],

    // AIOK018: Motherboard AIO Rusak / Perlu Diganti
    ['disease' => 'AIOK018', 'symptoms' => ['AIOG043'], 'cf' => 0.75],
    ['disease' => 'AIOK018', 'symptoms' => ['AIOG047'], 'cf' => 0.95],
    ['disease' => 'AIOK018', 'symptoms' => ['AIOG043', 'AIOG047'], 'cf' => 0.95],
    ['disease' => 'AIOK018', 'symptoms' => ['AIOG043', 'AIOG049'], 'cf' => 0.9],

    // AIOK019: Baterai CMOS AIO Habis
    ['disease' => 'AIOK019', 'symptoms' => ['AIOG044'], 'cf' => 0.9],
    ['disease' => 'AIOK019', 'symptoms' => ['AIOG044', 'AIOG048'], 'cf' => 0.9],
    ['disease' => 'AIOK019', 'symptoms' => ['AIOG044', 'AIOG057'], 'cf' => 0.8],

    // AIOK020: Kapasitor / Komponen SMD AIO Rusak
    ['disease' => 'AIOK020', 'symptoms' => ['AIOG049'], 'cf' => 0.85],
    ['disease' => 'AIOK020', 'symptoms' => ['AIOG049', 'AIOG055'], 'cf' => 0.85],
    ['disease' => 'AIOK020', 'symptoms' => ['AIOG046', 'AIOG049'], 'cf' => 0.85],

    // AIOK021: BIOS / UEFI AIO Corrupt
    ['disease' => 'AIOK021', 'symptoms' => ['AIOG053'], 'cf' => 0.85],
    ['disease' => 'AIOK021', 'symptoms' => ['AIOG043', 'AIOG053'], 'cf' => 0.9],
    ['disease' => 'AIOK021', 'symptoms' => ['AIOG053', 'AIOG057'], 'cf' => 0.8],

    // AIOK022: Chipset / IC Controller Onboard AIO Rusak
    ['disease' => 'AIOK022', 'symptoms' => ['AIOG050', 'AIOG051'], 'cf' => 0.8],
    ['disease' => 'AIOK022', 'symptoms' => ['AIOG050', 'AIOG052'], 'cf' => 0.8],
    ['disease' => 'AIOK022', 'symptoms' => ['AIOG045', 'AIOG050'], 'cf' => 0.8],

    // AIOK018: Motherboard AIO Rusak / Perlu Diganti
    ['disease' => 'AIOK018', 'symptoms' => ['AIOG054'], 'cf' => 0.8],
    ['disease' => 'AIOK018', 'symptoms' => ['AIOG043', 'AIOG054'], 'cf' => 0.85],
    ['disease' => 'AIOK018', 'symptoms' => ['AIOG056'], 'cf' => 0.75],

    // AIOK020: Kapasitor / Komponen SMD AIO Rusak
    ['disease' => 'AIOK020', 'symptoms' => ['AIOG055'], 'cf' => 0.7],
    ['disease' => 'AIOK020', 'symptoms' => ['AIOG046'], 'cf' => 0.7],

    // AIOK022: Chipset / IC Controller Onboard AIO Rusak
    ['disease' => 'AIOK022', 'symptoms' => ['AIOG045', 'AIOG048'], 'cf' => 0.8],
    ['disease' => 'AIOK022', 'symptoms' => ['AIOG051', 'AIOG052'], 'cf' => 0.8],

    // AIOK021: BIOS / UEFI AIO Corrupt
    ['disease' => 'AIOK021', 'symptoms' => ['AIOG043', 'AIOG057'], 'cf' => 0.8],

    // AIOK018: Motherboard AIO Rusak / Perlu Diganti
    ['disease' => 'AIOK018', 'symptoms' => ['AIOG047', 'AIOG049'], 'cf' => 0.9],

    // AIOK023: Thermal Paste CPU AIO Kering
    ['disease' => 'AIOK023', 'symptoms' => ['AIOG065'], 'cf' => 0.85],
    ['disease' => 'AIOK023', 'symptoms' => ['AIOG058', 'AIOG065'], 'cf' => 0.9],
    ['disease' => 'AIOK023', 'symptoms' => ['AIOG063', 'AIOG065'], 'cf' => 0.9],

    // AIOK024: Kipas / Sistem Pendinginan AIO Bermasalah
    ['disease' => 'AIOK024', 'symptoms' => ['AIOG064'], 'cf' => 0.9],
    ['disease' => 'AIOK024', 'symptoms' => ['AIOG058', 'AIOG064'], 'cf' => 0.95],

    // AIOK027: Heatsink CPU AIO Tidak Terpasang Rapat
    ['disease' => 'AIOK027', 'symptoms' => ['AIOG058', 'AIOG066'], 'cf' => 0.9],
    ['disease' => 'AIOK027', 'symptoms' => ['AIOG066'], 'cf' => 0.85],

    // AIOK025: CPU AIO Overheating
    ['disease' => 'AIOK025', 'symptoms' => ['AIOG058', 'AIOG059'], 'cf' => 0.9],
    ['disease' => 'AIOK025', 'symptoms' => ['AIOG058', 'AIOG060'], 'cf' => 0.9],
    ['disease' => 'AIOK025', 'symptoms' => ['AIOG058', 'AIOG067'], 'cf' => 0.9],
    ['disease' => 'AIOK025', 'symptoms' => ['AIOG059', 'AIOG064'], 'cf' => 0.9],

    // AIOK026: CPU AIO Rusak / Defektif
    ['disease' => 'AIOK026', 'symptoms' => ['AIOG061'], 'cf' => 0.8],
    ['disease' => 'AIOK026', 'symptoms' => ['AIOG043', 'AIOG061'], 'cf' => 0.85],

    // AIOK025: CPU AIO Overheating
    ['disease' => 'AIOK025', 'symptoms' => ['AIOG059', 'AIOG062'], 'cf' => 0.85],

    // AIOK024: Kipas / Sistem Pendinginan AIO Bermasalah
    ['disease' => 'AIOK024', 'symptoms' => ['AIOG063', 'AIOG064'], 'cf' => 0.9],

    // AIOK023: Thermal Paste CPU AIO Kering
    ['disease' => 'AIOK023', 'symptoms' => ['AIOG058'], 'cf' => 0.65],
    ['disease' => 'AIOK023', 'symptoms' => ['AIOG067'], 'cf' => 0.7],

    // AIOK025: CPU AIO Overheating
    ['disease' => 'AIOK025', 'symptoms' => ['AIOG062'], 'cf' => 0.65],
    ['disease' => 'AIOK025', 'symptoms' => ['AIOG059', 'AIOG068'], 'cf' => 0.75],
    ['disease' => 'AIOK025', 'symptoms' => ['AIOG058', 'AIOG066'], 'cf' => 0.85],

    // AIOK028: RAM SO-DIMM AIO Tidak Terpasang Benar
    ['disease' => 'AIOK028', 'symptoms' => ['AIOG069'], 'cf' => 0.75],
    ['disease' => 'AIOK028', 'symptoms' => ['AIOG069', 'AIOG078'], 'cf' => 0.9],
    ['disease' => 'AIOK028', 'symptoms' => ['AIOG069', 'AIOG080'], 'cf' => 0.85],

    // AIOK029: Modul RAM SO-DIMM AIO Rusak
    ['disease' => 'AIOK029', 'symptoms' => ['AIOG073'], 'cf' => 0.9],
    ['disease' => 'AIOK029', 'symptoms' => ['AIOG070', 'AIOG073'], 'cf' => 0.95],
    ['disease' => 'AIOK029', 'symptoms' => ['AIOG072', 'AIOG073'], 'cf' => 0.9],
    ['disease' => 'AIOK029', 'symptoms' => ['AIOG073', 'AIOG079'], 'cf' => 0.9],

    // AIOK030: Slot SO-DIMM Motherboard AIO Rusak
    ['disease' => 'AIOK030', 'symptoms' => ['AIOG076'], 'cf' => 0.85],
    ['disease' => 'AIOK030', 'symptoms' => ['AIOG069', 'AIOG076'], 'cf' => 0.9],

    // AIOK031: Kontak SO-DIMM Kotor
    ['disease' => 'AIOK031', 'symptoms' => ['AIOG077'], 'cf' => 0.85],
    ['disease' => 'AIOK031', 'symptoms' => ['AIOG069', 'AIOG077'], 'cf' => 0.85],

    // AIOK032: RAM SO-DIMM Tidak Kompatibel
    ['disease' => 'AIOK032', 'symptoms' => ['AIOG075'], 'cf' => 0.8],
    ['disease' => 'AIOK032', 'symptoms' => ['AIOG074'], 'cf' => 0.8],
    ['disease' => 'AIOK032', 'symptoms' => ['AIOG069', 'AIOG074'], 'cf' => 0.85],
    ['disease' => 'AIOK032', 'symptoms' => ['AIOG071', 'AIOG074'], 'cf' => 0.8],

    // AIOK029: Modul RAM SO-DIMM AIO Rusak
    ['disease' => 'AIOK029', 'symptoms' => ['AIOG070'], 'cf' => 0.75],
    ['disease' => 'AIOK029', 'symptoms' => ['AIOG072'], 'cf' => 0.7],
    ['disease' => 'AIOK029', 'symptoms' => ['AIOG080'], 'cf' => 0.8],

    // AIOK031: Kontak SO-DIMM Kotor
    ['disease' => 'AIOK031', 'symptoms' => ['AIOG071', 'AIOG077'], 'cf' => 0.75],

    // AIOK028: RAM SO-DIMM AIO Tidak Terpasang Benar
    ['disease' => 'AIOK028', 'symptoms' => ['AIOG078'], 'cf' => 0.85],

    // AIOK033: HDD 2.5" AIO Rusak / Failing
    ['disease' => 'AIOK033', 'symptoms' => ['AIOG082'], 'cf' => 0.9],
    ['disease' => 'AIOK033', 'symptoms' => ['AIOG082', 'AIOG084'], 'cf' => 0.95],
    ['disease' => 'AIOK033', 'symptoms' => ['AIOG082', 'AIOG085'], 'cf' => 0.95],
    ['disease' => 'AIOK033', 'symptoms' => ['AIOG082', 'AIOG092'], 'cf' => 0.9],
    ['disease' => 'AIOK033', 'symptoms' => ['AIOG081', 'AIOG082'], 'cf' => 0.9],

    // AIOK034: SSD AIO Degradasi / Failing
    ['disease' => 'AIOK034', 'symptoms' => ['AIOG089'], 'cf' => 0.9],
    ['disease' => 'AIOK034', 'symptoms' => ['AIOG084', 'AIOG089'], 'cf' => 0.9],
    ['disease' => 'AIOK034', 'symptoms' => ['AIOG087'], 'cf' => 0.8],

    // AIOK035: Bad Sector pada HDD 2.5" AIO
    ['disease' => 'AIOK035', 'symptoms' => ['AIOG085'], 'cf' => 0.85],
    ['disease' => 'AIOK035', 'symptoms' => ['AIOG085', 'AIOG092'], 'cf' => 0.9],
    ['disease' => 'AIOK035', 'symptoms' => ['AIOG085', 'AIOG086'], 'cf' => 0.8],

    // AIOK036: Konektor SATA / Slot M.2 AIO Rusak
    ['disease' => 'AIOK036', 'symptoms' => ['AIOG081', 'AIOG091'], 'cf' => 0.85],
    ['disease' => 'AIOK036', 'symptoms' => ['AIOG090', 'AIOG091'], 'cf' => 0.9],
    ['disease' => 'AIOK036', 'symptoms' => ['AIOG087', 'AIOG090'], 'cf' => 0.85],

    // AIOK037: Partisi / MBR / GPT AIO Corrupt
    ['disease' => 'AIOK037', 'symptoms' => ['AIOG088'], 'cf' => 0.8],
    ['disease' => 'AIOK037', 'symptoms' => ['AIOG083', 'AIOG088'], 'cf' => 0.85],
    ['disease' => 'AIOK037', 'symptoms' => ['AIOG092'], 'cf' => 0.7],

    // AIOK036: Konektor SATA / Slot M.2 AIO Rusak
    ['disease' => 'AIOK036', 'symptoms' => ['AIOG081'], 'cf' => 0.65],

    // AIOK037: Partisi / MBR / GPT AIO Corrupt
    ['disease' => 'AIOK037', 'symptoms' => ['AIOG083'], 'cf' => 0.7],

    // AIOK036: Konektor SATA / Slot M.2 AIO Rusak
    ['disease' => 'AIOK036', 'symptoms' => ['AIOG090'], 'cf' => 0.75],

    // AIOK038: Debu Menumpuk di Sistem Pendinginan AIO
    ['disease' => 'AIOK038', 'symptoms' => ['AIOG099'], 'cf' => 0.85],
    ['disease' => 'AIOK038', 'symptoms' => ['AIOG093', 'AIOG099'], 'cf' => 0.9],
    ['disease' => 'AIOK038', 'symptoms' => ['AIOG096', 'AIOG099'], 'cf' => 0.9],
    ['disease' => 'AIOK038', 'symptoms' => ['AIOG097', 'AIOG099'], 'cf' => 0.85],

    // AIOK042: Ventilasi AIO Tersumbat
    ['disease' => 'AIOK042', 'symptoms' => ['AIOG104'], 'cf' => 0.85],
    ['disease' => 'AIOK042', 'symptoms' => ['AIOG093', 'AIOG104'], 'cf' => 0.85],

    // AIOK039: Thermal Paste CPU/GPU AIO Kering
    ['disease' => 'AIOK039', 'symptoms' => ['AIOG100'], 'cf' => 0.85],
    ['disease' => 'AIOK039', 'symptoms' => ['AIOG097', 'AIOG100'], 'cf' => 0.9],
    ['disease' => 'AIOK039', 'symptoms' => ['AIOG098', 'AIOG100'], 'cf' => 0.9],
    ['disease' => 'AIOK039', 'symptoms' => ['AIOG100', 'AIOG105'], 'cf' => 0.85],

    // AIOK040: Kipas Internal AIO Rusak / Mati
    ['disease' => 'AIOK040', 'symptoms' => ['AIOG095'], 'cf' => 0.9],
    ['disease' => 'AIOK040', 'symptoms' => ['AIOG093', 'AIOG095'], 'cf' => 0.95],
    ['disease' => 'AIOK040', 'symptoms' => ['AIOG095', 'AIOG096'], 'cf' => 0.95],
    ['disease' => 'AIOK040', 'symptoms' => ['AIOG095', 'AIOG102'], 'cf' => 0.85],

    // AIOK041: Heatsink AIO Tidak Terpasang Rapat
    ['disease' => 'AIOK041', 'symptoms' => ['AIOG101'], 'cf' => 0.85],
    ['disease' => 'AIOK041', 'symptoms' => ['AIOG097', 'AIOG101'], 'cf' => 0.9],
    ['disease' => 'AIOK041', 'symptoms' => ['AIOG101', 'AIOG103'], 'cf' => 0.85],

    // AIOK038: Debu Menumpuk di Sistem Pendinginan AIO
    ['disease' => 'AIOK038', 'symptoms' => ['AIOG094', 'AIOG099'], 'cf' => 0.8],

    // AIOK039: Thermal Paste CPU/GPU AIO Kering
    ['disease' => 'AIOK039', 'symptoms' => ['AIOG096', 'AIOG097'], 'cf' => 0.8],

    // AIOK040: Kipas Internal AIO Rusak / Mati
    ['disease' => 'AIOK040', 'symptoms' => ['AIOG095', 'AIOG098'], 'cf' => 0.9],

    // AIOK043: Driver Audio AIO Corrupt / Bermasalah
    ['disease' => 'AIOK043', 'symptoms' => ['AIOG111'], 'cf' => 0.8],
    ['disease' => 'AIOK043', 'symptoms' => ['AIOG113'], 'cf' => 0.85],
    ['disease' => 'AIOK043', 'symptoms' => ['AIOG111', 'AIOG113'], 'cf' => 0.9],
    ['disease' => 'AIOK043', 'symptoms' => ['AIOG106', 'AIOG111'], 'cf' => 0.8],
    ['disease' => 'AIOK043', 'symptoms' => ['AIOG111', 'AIOG115'], 'cf' => 0.75],

    // AIOK044: Speaker Internal AIO Rusak
    ['disease' => 'AIOK044', 'symptoms' => ['AIOG106', 'AIOG112'], 'cf' => 0.8],
    ['disease' => 'AIOK044', 'symptoms' => ['AIOG107'], 'cf' => 0.75],
    ['disease' => 'AIOK044', 'symptoms' => ['AIOG112'], 'cf' => 0.8],

    // AIOK047: Kabel Speaker Internal AIO Longgar
    ['disease' => 'AIOK047', 'symptoms' => ['AIOG108'], 'cf' => 0.7],
    ['disease' => 'AIOK047', 'symptoms' => ['AIOG116'], 'cf' => 0.8],

    // AIOK045: IC Audio Onboard AIO Rusak
    ['disease' => 'AIOK045', 'symptoms' => ['AIOG111', 'AIOG112'], 'cf' => 0.8],
    ['disease' => 'AIOK045', 'symptoms' => ['AIOG111', 'AIOG112', 'AIOG115'], 'cf' => 0.85],

    // AIOK046: Jack Audio AIO Rusak Fisik
    ['disease' => 'AIOK046', 'symptoms' => ['AIOG109'], 'cf' => 0.8],
    ['disease' => 'AIOK046', 'symptoms' => ['AIOG106', 'AIOG109'], 'cf' => 0.85],

    // AIOK048: Mikrofon Internal AIO Rusak
    ['disease' => 'AIOK048', 'symptoms' => ['AIOG110'], 'cf' => 0.8],

    // AIOK043: Driver Audio AIO Corrupt / Bermasalah
    ['disease' => 'AIOK043', 'symptoms' => ['AIOG114'], 'cf' => 0.65],

    // AIOK044: Speaker Internal AIO Rusak
    ['disease' => 'AIOK044', 'symptoms' => ['AIOG107', 'AIOG112'], 'cf' => 0.8],
    ['disease' => 'AIOK044', 'symptoms' => ['AIOG107', 'AIOG108'], 'cf' => 0.75],

    // AIOK045: IC Audio Onboard AIO Rusak
    ['disease' => 'AIOK045', 'symptoms' => ['AIOG110', 'AIOG111'], 'cf' => 0.75],

    // AIOK050: Modul WiFi / Bluetooth AIO Rusak
    ['disease' => 'AIOK050', 'symptoms' => ['AIOG117', 'AIOG125'], 'cf' => 0.9],
    ['disease' => 'AIOK050', 'symptoms' => ['AIOG125'], 'cf' => 0.85],

    // AIOK051: Antena WiFi Internal AIO Rusak / Tidak Terpasang
    ['disease' => 'AIOK051', 'symptoms' => ['AIOG121', 'AIOG125'], 'cf' => 0.85],
    ['disease' => 'AIOK051', 'symptoms' => ['AIOG121'], 'cf' => 0.75],

    // AIOK050: Modul WiFi / Bluetooth AIO Rusak
    ['disease' => 'AIOK050', 'symptoms' => ['AIOG117', 'AIOG120', 'AIOG125'], 'cf' => 0.9],

    // AIOK049: Driver WiFi / Bluetooth AIO Bermasalah
    ['disease' => 'AIOK049', 'symptoms' => ['AIOG122'], 'cf' => 0.85],
    ['disease' => 'AIOK049', 'symptoms' => ['AIOG128'], 'cf' => 0.8],
    ['disease' => 'AIOK049', 'symptoms' => ['AIOG117', 'AIOG122'], 'cf' => 0.85],
    ['disease' => 'AIOK049', 'symptoms' => ['AIOG120', 'AIOG122'], 'cf' => 0.8],

    // AIOK052: IC LAN Onboard AIO Rusak
    ['disease' => 'AIOK052', 'symptoms' => ['AIOG119'], 'cf' => 0.75],
    ['disease' => 'AIOK052', 'symptoms' => ['AIOG119', 'AIOG127'], 'cf' => 0.8],

    // AIOK053: Konfigurasi Jaringan AIO Bermasalah
    ['disease' => 'AIOK053', 'symptoms' => ['AIOG123'], 'cf' => 0.7],

    // AIOK051: Antena WiFi Internal AIO Rusak / Tidak Terpasang
    ['disease' => 'AIOK051', 'symptoms' => ['AIOG118'], 'cf' => 0.65],

    // AIOK052: IC LAN Onboard AIO Rusak
    ['disease' => 'AIOK052', 'symptoms' => ['AIOG119', 'AIOG122'], 'cf' => 0.8],

    // AIOK051: Antena WiFi Internal AIO Rusak / Tidak Terpasang
    ['disease' => 'AIOK051', 'symptoms' => ['AIOG126'], 'cf' => 0.85],

    // AIOK049: Driver WiFi / Bluetooth AIO Bermasalah
    ['disease' => 'AIOK049', 'symptoms' => ['AIOG124'], 'cf' => 0.65],
    ['disease' => 'AIOK049', 'symptoms' => ['AIOG117'], 'cf' => 0.65],

    // AIOK051: Antena WiFi Internal AIO Rusak / Tidak Terpasang
    ['disease' => 'AIOK051', 'symptoms' => ['AIOG118', 'AIOG121'], 'cf' => 0.8],

    // AIOK049: Driver WiFi / Bluetooth AIO Bermasalah
    ['disease' => 'AIOK049', 'symptoms' => ['AIOG117', 'AIOG128'], 'cf' => 0.8],
    ['disease' => 'AIOK049', 'symptoms' => ['AIOG119', 'AIOG122'], 'cf' => 0.8],

    // AIOK055: Modul Kamera Internal AIO Rusak
    ['disease' => 'AIOK055', 'symptoms' => ['AIOG129', 'AIOG130'], 'cf' => 0.85],

    // AIOK054: Driver Kamera AIO Corrupt / Bermasalah
    ['disease' => 'AIOK054', 'symptoms' => ['AIOG130'], 'cf' => 0.8],

    // AIOK055: Modul Kamera Internal AIO Rusak
    ['disease' => 'AIOK055', 'symptoms' => ['AIOG129', 'AIOG134'], 'cf' => 0.8],
    ['disease' => 'AIOK055', 'symptoms' => ['AIOG132'], 'cf' => 0.75],
    ['disease' => 'AIOK055', 'symptoms' => ['AIOG130', 'AIOG132'], 'cf' => 0.85],

    // AIOK057: Privacy Settings / App Permission Bermasalah
    ['disease' => 'AIOK057', 'symptoms' => ['AIOG129', 'AIOG133'], 'cf' => 0.8],
    ['disease' => 'AIOK057', 'symptoms' => ['AIOG135'], 'cf' => 0.85],
    ['disease' => 'AIOK057', 'symptoms' => ['AIOG136'], 'cf' => 0.8],

    // AIOK055: Modul Kamera Internal AIO Rusak
    ['disease' => 'AIOK055', 'symptoms' => ['AIOG131'], 'cf' => 0.7],

    // AIOK054: Driver Kamera AIO Corrupt / Bermasalah
    ['disease' => 'AIOK054', 'symptoms' => ['AIOG138'], 'cf' => 0.65],

    // AIOK056: Konektor Kabel Kamera AIO Longgar
    ['disease' => 'AIOK056', 'symptoms' => ['AIOG129', 'AIOG137'], 'cf' => 0.8],
    ['disease' => 'AIOK056', 'symptoms' => ['AIOG132', 'AIOG134'], 'cf' => 0.75],

    // AIOK054: Driver Kamera AIO Corrupt / Bermasalah
    ['disease' => 'AIOK054', 'symptoms' => ['AIOG130', 'AIOG134'], 'cf' => 0.8],

    // AIOK056: Konektor Kabel Kamera AIO Longgar
    ['disease' => 'AIOK056', 'symptoms' => ['AIOG137'], 'cf' => 0.8],

    // AIOK058: Driver USB Controller AIO Bermasalah
    ['disease' => 'AIOK058', 'symptoms' => ['AIOG139'], 'cf' => 0.7],
    ['disease' => 'AIOK058', 'symptoms' => ['AIOG146'], 'cf' => 0.75],
    ['disease' => 'AIOK058', 'symptoms' => ['AIOG147'], 'cf' => 0.7],

    // AIOK059: Port USB / USB-C AIO Rusak Fisik
    ['disease' => 'AIOK059', 'symptoms' => ['AIOG139', 'AIOG140'], 'cf' => 0.8],
    ['disease' => 'AIOK059', 'symptoms' => ['AIOG140'], 'cf' => 0.75],

    // AIOK060: IC USB Controller Onboard AIO Rusak
    ['disease' => 'AIOK060', 'symptoms' => ['AIOG139', 'AIOG146'], 'cf' => 0.85],
    ['disease' => 'AIOK060', 'symptoms' => ['AIOG146'], 'cf' => 0.8],
    ['disease' => 'AIOK060', 'symptoms' => ['AIOG146', 'AIOG147'], 'cf' => 0.75],

    // AIOK061: Keyboard / Mouse Wireless AIO Bermasalah
    ['disease' => 'AIOK061', 'symptoms' => ['AIOG143'], 'cf' => 0.75],
    ['disease' => 'AIOK061', 'symptoms' => ['AIOG144'], 'cf' => 0.75],
    ['disease' => 'AIOK061', 'symptoms' => ['AIOG143', 'AIOG144'], 'cf' => 0.8],
    ['disease' => 'AIOK061', 'symptoms' => ['AIOG143', 'AIOG145'], 'cf' => 0.8],

    // AIOK062: Daya Port USB AIO Tidak Mencukupi
    ['disease' => 'AIOK062', 'symptoms' => ['AIOG149'], 'cf' => 0.7],
    ['disease' => 'AIOK062', 'symptoms' => ['AIOG147'], 'cf' => 0.7],

    // AIOK059: Port USB / USB-C AIO Rusak Fisik
    ['disease' => 'AIOK059', 'symptoms' => ['AIOG141'], 'cf' => 0.75],
    ['disease' => 'AIOK059', 'symptoms' => ['AIOG142'], 'cf' => 0.65],

    // AIOK060: IC USB Controller Onboard AIO Rusak
    ['disease' => 'AIOK060', 'symptoms' => ['AIOG139', 'AIOG146'], 'cf' => 0.85],

    // AIOK058: Driver USB Controller AIO Bermasalah
    ['disease' => 'AIOK058', 'symptoms' => ['AIOG148'], 'cf' => 0.65],

    // AIOK063: Windows / OS AIO Corrupt
    ['disease' => 'AIOK063', 'symptoms' => ['AIOG153', 'AIOG158'], 'cf' => 0.9],
    ['disease' => 'AIOK063', 'symptoms' => ['AIOG153'], 'cf' => 0.8],
    ['disease' => 'AIOK063', 'symptoms' => ['AIOG150', 'AIOG157'], 'cf' => 0.85],
    ['disease' => 'AIOK063', 'symptoms' => ['AIOG158'], 'cf' => 0.85],

    // AIOK064: Infeksi Virus / Malware AIO
    ['disease' => 'AIOK064', 'symptoms' => ['AIOG152'], 'cf' => 0.85],
    ['disease' => 'AIOK064', 'symptoms' => ['AIOG152', 'AIOG162'], 'cf' => 0.9],
    ['disease' => 'AIOK064', 'symptoms' => ['AIOG151', 'AIOG152'], 'cf' => 0.85],
    ['disease' => 'AIOK064', 'symptoms' => ['AIOG150', 'AIOG152'], 'cf' => 0.85],

    // AIOK065: Driver Hardware Tidak Kompatibel di AIO
    ['disease' => 'AIOK065', 'symptoms' => ['AIOG156'], 'cf' => 0.85],
    ['disease' => 'AIOK065', 'symptoms' => ['AIOG150', 'AIOG156'], 'cf' => 0.85],

    // AIOK066: Bloatware / Startup Berlebihan di AIO
    ['disease' => 'AIOK066', 'symptoms' => ['AIOG154', 'AIOG155'], 'cf' => 0.8],
    ['disease' => 'AIOK066', 'symptoms' => ['AIOG151', 'AIOG155'], 'cf' => 0.8],

    // AIOK067: File System / Partisi AIO Corrupt
    ['disease' => 'AIOK067', 'symptoms' => ['AIOG157'], 'cf' => 0.85],
    ['disease' => 'AIOK067', 'symptoms' => ['AIOG153', 'AIOG157'], 'cf' => 0.9],

    // AIOK063: Windows / OS AIO Corrupt
    ['disease' => 'AIOK063', 'symptoms' => ['AIOG159'], 'cf' => 0.75],

    // AIOK068: Recovery System AIO Bermasalah
    ['disease' => 'AIOK068', 'symptoms' => ['AIOG160'], 'cf' => 0.85],

    // AIOK065: Driver Hardware Tidak Kompatibel di AIO
    ['disease' => 'AIOK065', 'symptoms' => ['AIOG156', 'AIOG161'], 'cf' => 0.8],

    // AIOK066: Bloatware / Startup Berlebihan di AIO
    ['disease' => 'AIOK066', 'symptoms' => ['AIOG151'], 'cf' => 0.65],

    // AIOK064: Infeksi Virus / Malware AIO
    ['disease' => 'AIOK064', 'symptoms' => ['AIOG151', 'AIOG162'], 'cf' => 0.85],

    // AIOK066: Bloatware / Startup Berlebihan di AIO
    ['disease' => 'AIOK066', 'symptoms' => ['AIOG154'], 'cf' => 0.7],
];
