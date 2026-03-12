<?php

/**
 * Question Filters - Mapping sub-keluhan ke pertanyaan yang relevan
 *
 * Format: '{category_key}.{problem_key}' => [order1, order2, ...]
 *
 * Setiap entry berisi daftar nomor urut pertanyaan (field 'order')
 * yang RELEVAN untuk keluhan tertentu. Pertanyaan di luar daftar ini
 * akan dilewati oleh engine, sehingga user tidak menerima pertanyaan
 * yang tidak nyambung dengan keluhannya.
 *
 * Catatan: Problem yang sudah ada di DIRECT_DIAGNOSIS_CONFIG
 * (layar.pecah, layar.bercak, baterai.kembung, baterai.charger_only,
 *  input.kb_ketik_sendiri, input.kb_sebagian) tidak perlu filter karena
 * sudah bypass pertanyaan normal.
 */

return [

    // ╔══════════════════════════════════════════════════════════════╗
    // ║  LAPTOP                                                     ║
    // ╚══════════════════════════════════════════════════════════════╝
    'laptop' => [

        // === LAYAR (Display: 10 questions) ===
        'layar.blank'    => [1, 2, 3, 7],       // power check, hitam/redup, ext monitor, setelah jatuh
        'layar.redup'    => [1, 2, 3],           // power check, hitam/redup, ext monitor
        'layar.bergaris' => [3, 4, 5, 7, 10],   // ext monitor, flicker, garis, setelah jatuh, onset
        'layar.berkedip' => [3, 4, 7, 10],      // ext monitor, flicker movement, setelah jatuh, onset

        // === KEYBOARD & TOUCHPAD (input) ===
        // Keyboard (Keyboard: 8 questions)
        'input.kb_mati_total' => [1, 2, 7],     // ext keyboard, semua/sebagian, after update
        'input.kb_dobel'      => [1, 4],         // ext keyboard, dobel
        'input.kb_lengket'    => [5, 6],         // sticky, keycap
        // Touchpad (Peripheral: 10 questions)
        'input.tp_mati'       => [1, 2, 3],     // touchpad respon, scroll, gesture
        'input.tp_loncat'     => [1],            // touchpad respon
        'input.tp_scroll_mati'=> [1, 2],         // touchpad respon, scroll
        'input.tp_gesture'    => [1, 2, 3],      // touchpad respon, scroll, gesture

        // === DAYA & BATERAI (daya) ===
        // Laptop Mati (Power: 10 questions)
        'daya.nyala_bentar'    => [1, 2, 4, 8],  // charger LED, power button, brief on, bau hangus
        'daya.mati_sendiri'    => [1, 8, 9],      // charger LED, bau hangus, mati tiba-tiba
        'daya.charger_ga_ngisi'=> [1, 3, 7],      // charger LED, charger only, % drop
        // Baterai (Power: 10 questions)
        // daya.boros & daya.drop = LIMITED di DIRECT_DIAGNOSIS_CONFIG, tapi filter tetap berguna
        'daya.boros' => [6, 7],                  // drain speed, % drop
        'daya.drop'  => [6, 7],                  // drain speed, % drop

        // === KONEKSI & PORT (koneksi) ===
        // WiFi (Network: 8 questions)
        'koneksi.wifi_mati'    => [1, 7, 8],     // WiFi visible, airplane, device manager
        'koneksi.wifi_putus'   => [1, 2, 4, 5],  // WiFi visible, other devices, sinyal lemah, disconnect
        'koneksi.no_internet'  => [1, 2, 3],     // WiFi visible, other devices, connected no net
        'koneksi.sinyal_lemah' => [2, 4, 5],     // other devices, sinyal lemah, disconnect
        'koneksi.bluetooth'    => [1, 6],         // WiFi visible (combo card check), bluetooth
        // Port (Peripheral: 10 questions)
        'koneksi.usb_mati'    => [4, 5, 6],      // USB loose, all/some USB, USB detected
        'koneksi.usb_longgar' => [4, 5],          // USB loose, all/some USB
        'koneksi.hdmi'        => [9],             // HDMI
        'koneksi.webcam'      => [8],             // webcam

        // === SOFTWARE & PERFORMA (software) ===
        // Performance (Performance: 8 questions)
        'software.hang'     => [1, 3, 8],        // multitask, disk 100%, RAM tinggi
        'software.game_lag' => [2, 5, 6, 7],     // HDD/SSD, game lag, degrade, fan kencang
        // Software (Software: 8 questions)
        'software.bsod'      => [2, 4, 5],       // BSOD, after update, safe mode
        'software.bootloop'  => [1, 3, 4],        // boot check, bootloop, after update
        'software.stuck_boot'=> [1, 3, 4, 5],    // boot check, bootloop, after update, safe mode
        'software.virus'     => [5, 6, 7],        // safe mode, file corrupt, popup
        // Storage (Storage: 8 questions)
        'software.hdd_bunyi'       => [1, 2, 3, 4],    // clicking, BIOS detect, SMART, intermittent
        'software.hdd_hilang'      => [2, 3, 4],        // BIOS detect, SMART, intermittent
        'software.transfer_lambat' => [3, 5, 8],        // SMART, copy slow, boot slow
        'software.boot_lama'       => [3, 5, 8],        // SMART, copy slow, boot slow

        // === SUARA (Audio: 8 questions) ===
        'suara.mati'    => [1, 2, 7, 8],         // no sound, headphone test, device manager, sudden mute
        'suara.pecah'   => [1, 2, 3, 4],         // no sound, headphone test, satu sisi, crackling
        'suara.sebelah' => [2, 3],               // headphone test, satu sisi
        'suara.mic'     => [2, 6, 7],            // headphone test, mic, device manager

        // === PANAS & FISIK (fisik) ===
        // Thermal (Thermal: 7 questions)
        'fisik.cepat_panas'  => [1, 2, 3, 4],    // fan spin, hot idle, cleaned, thermal paste
        'fisik.kipas_berisik'=> [1, 3, 5],        // fan spin, cleaned, grinding
        'fisik.kipas_mati'   => [1, 2, 3],        // fan spin, hot idle, cleaned
        'fisik.mati_panas'   => [1, 2, 3, 4, 6],  // fan, hot, cleaned, paste, shutdown overheat
        // Physical (Physical: 7 questions)
        'fisik.engsel' => [1, 3, 4, 7],           // hinge, screen wobble, body lifted, hinge noise
        'fisik.casing' => [2, 5, 6],              // casing crack, bezel, bottom case
        'fisik.goyang' => [1, 3, 4],              // hinge, screen wobble, body lifted
        // Water Damage (Water Damage: 8 questions)
        'fisik.air_mati'     => [1, 2, 3, 5],     // water exposure, immediate action, dead, corrosion
        'fisik.air_keyboard' => [1, 2, 4, 5],     // water, immediate, keyboard error, corrosion
        'fisik.air_sebagian' => [1, 2, 5, 6, 8],  // water, immediate, corrosion, screen fog, partial
        'fisik.air_korosi'   => [1, 5, 7],         // water, corrosion, port corrosion

        // charger_port ada di daya tapi engine Peripheral
        'daya.charger_port'  => [7],               // charger port longgar (Peripheral Q7)
    ],

    // ╔══════════════════════════════════════════════════════════════╗
    // ║  PC DESKTOP                                                 ║
    // ╚══════════════════════════════════════════════════════════════╝
    'pc' => [

        // === MATI / DAYA (PSU: 8q, Motherboard: 8q, Casing: 6q) ===
        'daya.mati_total'       => [1, 2, 5, 8],      // bau terbakar, fan PSU, kabel kencang, listrik mati
        'daya.mati_sendiri'     => [1, 3, 7],          // bau terbakar, mati saat load, mati total
        'daya.restart'          => [3, 4, 8],          // mati saat load, watt cukup, listrik mati
        'daya.bau_terbakar'     => [1, 2, 7],          // bau terbakar, fan PSU, mati total
        'daya.daya_kurang'      => [3, 4, 5, 6],       // mati saat load, watt, kabel, lepas komponen
        'daya.no_post'          => [1, 2, 6, 8],       // debug LED, beep, BIOS flash, GPU/RAM detected → Motherboard Q
        'daya.beep'             => [1, 2, 8],          // debug LED, beep, GPU/RAM detected → Motherboard Q
        'daya.komponen_terbakar'=> [4, 5, 7],          // bau terbakar, kapasitor, semua port → Motherboard Q
        'daya.power_button'     => [1, 3],             // tombol power, header cable → Casing Q

        // === PERFORMA & SOFTWARE (Software: 8q, CPU: 8q, Storage: 8q) ===
        'software.lemot'          => [3, 4, 6],        // safe mode, SFC scan, auto-start
        'software.bsod'          => [1, 3, 7],         // BSOD code, safe mode, after update
        'software.virus'         => [2, 3],            // antivirus, safe mode
        'software.boot_gagal'    => [3, 5, 7, 8],     // safe mode, RAW drive, after update, repair loop
        'software.crash'         => [1, 3, 6],         // temp, paste, OC → CPU Q
        'software.storage_lambat'=> [2, 3, 4, 8],     // CDI, HDD/SSD, NVMe, heatsink → Storage Q

        // === PANAS & KEBISINGAN (Thermal: 7q, CPU: 8q) ===
        'thermal.panas'            => [1, 2, 3, 6],   // debu, case fans, AIO cooler, fan config
        'thermal.fan_casing'       => [2, 6],          // case fans, fan config
        'thermal.thermal_shutdown' => [1, 2, 7],       // debu, fans, thermal shutdown
        'thermal.liquid_cooler'    => [3, 4],          // AIO cooler, kebocoran
        'thermal.bocor'            => [4, 5],          // kebocoran liquid, custom loop
        'thermal.overheat_cpu'     => [1, 2, 3, 4],   // temp, fan, thermal paste, cooler tight → CPU Q
        'thermal.fan_cpu'          => [2, 4, 8],       // fan spin, cooler tight, socket support → CPU Q

        // === GRAFIS & GAMING (GPU Diskrit: 8q) ===
        'grafis.gpu_hilang'   => [1, 5, 6, 8],        // device manager, power connector, DDU, test PC lain
        'grafis.artefak'      => [1, 2, 6, 7],        // device manager, artefak, DDU, thermal paste
        'grafis.crash_gaming' => [1, 4, 5, 6],        // device manager, temp, power, DDU
        'grafis.overheat_gpu' => [3, 4, 7],           // fan spin, temp, thermal paste
        'grafis.fan_gpu'      => [3, 4],              // fan spin, temp

        // === KONEKSI & PORT (Network: 6q, Peripheral: 6q, Casing: 6q) ===
        'koneksi.lan_mati'  => [1, 2, 3, 6],          // LAN/WiFi, driver, port damage, ganti kabel
        'koneksi.wifi'      => [1, 2, 4],             // LAN/WiFi, driver, antena
        'koneksi.putus'     => [1, 5, 6],             // LAN/WiFi, other devices, ganti kabel
        'koneksi.usb_mati'  => [1, 2, 3, 4],          // all/some USB, front/back, header, device test → Peripheral Q
        'koneksi.semua_usb' => [1, 2, 3],             // all/some, front/back, header → Peripheral Q
        'koneksi.keyboard'  => [4],                    // device tested di PC lain → Peripheral Q
        'koneksi.mouse'     => [4],                    // device tested di PC lain → Peripheral Q
        'koneksi.usb_depan' => [2, 3],                // USB front, header cable → Casing Q

        // === AUDIO & SUARA (Audio: 6q, Casing: 6q) ===
        'audio.no_sound'    => [1, 2, 3],             // device manager, front/back jack, after update
        'audio.distorsi'    => [2, 4, 5],             // jack, sound card, hum
        'audio.mic'         => [1, 2, 3],             // device manager, jack, after update
        'audio.audio_depan' => [3],                    // header cable → Casing Q
    ],

    // ╔══════════════════════════════════════════════════════════════╗
    // ║  AIO (ALL-IN-ONE)                                           ║
    // ╚══════════════════════════════════════════════════════════════╝
    'aio' => [

        // === MATI / DAYA (Adaptor: 8q, Motherboard: 8q) ===
        'daya.mati_total'   => [2, 3, 5, 7],      // adaptor panas, bau hangus, port longgar, power button
        'daya.adaptor_rusak'=> [1, 2, 3, 4],       // original, panas, bau hangus, kabel rusak
        'daya.mati_sendiri' => [2, 6, 8],           // panas, mati saat berat, nyala bentar
        'daya.restart'      => [1, 2, 6],           // original, panas, mati saat berat
        'daya.bau_terbakar' => [1, 2, 3, 4],       // original, panas, bau hangus, kabel rusak
        'daya.no_post'      => [1, 2, 8],           // POST, beep, BIOS flash → Motherboard Q
        'daya.beep'         => [1, 2],              // POST, beep → Motherboard Q

        // === LAYAR & TOUCHSCREEN (Display: 8q, Touchscreen: 7q) ===
        'layar.blank'       => [1, 2, 3],           // gelap total, dim/senter, muncul ditekan
        'layar.bergaris'    => [5, 6, 7],           // bergaris, artefak, after driver update
        'layar.redup'       => [1, 2],              // gelap total, dim/senter
        'layar.artefak'     => [5, 6, 7],           // bergaris, artefak, after driver update
        'layar.pecah'       => [4],                 // retak fisik
        'layar.ts_mati'     => [1, 5, 7],           // no response, device manager, after update → Touchscreen Q
        'layar.ghost_touch' => [2, 5, 6],           // ghost touch, device manager, after panel → Touchscreen Q
        'layar.ts_sebagian' => [3, 4, 5],           // sebagian area, offset, device manager → Touchscreen Q

        // === PERFORMA & SOFTWARE (Software: 7q, CPU: 6q, Storage: 7q) ===
        'software.lemot'          => [1, 3, 6],     // safe mode, antivirus, bloatware
        'software.bsod'          => [1, 4],         // safe mode, after update
        'software.virus'         => [1, 3],         // safe mode, antivirus
        'software.boot_gagal'    => [1, 2, 4, 5],  // safe mode, repair loop, after update, RAW
        'software.crash'         => [1, 3, 5],      // temp, paste, CPU detected → CPU Q
        'software.storage_lambat'=> [1, 3, 4],      // HDD/SSD, CDI, NVMe → Storage Q

        // === PANAS & KEBISINGAN (Thermal: 7q, CPU: 6q) ===
        'thermal.panas'            => [1, 2, 3, 4], // body hot, fan spin, vent dust, thermal paste
        'thermal.kipas_mati'       => [2, 3, 6],    // fan spin, vent, fan noise
        'thermal.thermal_shutdown' => [1, 2, 3, 4, 7], // hot, fan, vent, paste, shutdown
        'thermal.debu'             => [3, 4],        // vent dust, thermal paste
        'thermal.overheat_cpu'     => [1, 2, 3, 6], // temp, fan, paste, cleaned → CPU Q

        // === AUDIO & KAMERA (Audio: 6q, Webcam: 6q) ===
        'multimedia.no_sound'    => [1, 2, 4],      // device manager, after update, headphone jack
        'multimedia.distorsi'    => [1, 3, 6],      // device manager, satu speaker, hum
        'multimedia.mic'         => [1, 2, 5],      // device manager, after update, mic
        'multimedia.webcam_mati' => [1, 2, 5, 6],   // device manager, shutter, privacy, all apps → Webcam Q
        'multimedia.webcam_buram'=> [1, 6],          // device manager, all apps → Webcam Q
        'multimedia.webcam_hitam'=> [1, 2, 3, 4],   // device manager, shutter, LED, hitam → Webcam Q

        // === KONEKSI & PORT (Konektivitas: 6q, Peripheral: 6q) ===
        'koneksi.wifi'      => [1, 2, 4],           // device manager, WiFi+BT, after update
        'koneksi.wifi_putus' => [1, 3, 6],          // device manager, sinyal lemah, connected no net
        'koneksi.lan_mati'  => [4, 5],              // after update, LAN juga
        'koneksi.bluetooth' => [1, 2],              // device manager, WiFi+BT
        'koneksi.usb_mati'  => [1, 3, 5, 6],       // semua USB, charging only, all/some, reinstall → Peripheral Q
        'koneksi.semua_usb' => [1, 5, 6],           // semua USB, all/some, reinstall → Peripheral Q
        'koneksi.keyboard'  => [2],                  // wireless KB/Mouse → Peripheral Q
        'koneksi.mouse'     => [2],                  // wireless KB/Mouse → Peripheral Q
    ],

    // ╔══════════════════════════════════════════════════════════════╗
    // ║  PRINTER                                                    ║
    // ╚══════════════════════════════════════════════════════════════╝
    'printer' => [

        // === KUALITAS CETAK (Kualitas Cetak: 9 questions) ===
        'kualitas.bergaris'    => [1, 3, 4],       // garis horizontal, head cleaning, nozzle check
        'kualitas.pudar'       => [5, 6],          // tinta/toner rendah, cetakan pudar
        'kualitas.warna_hilang'=> [2, 3, 4],       // warna hilang, head cleaning, nozzle check
        'kualitas.kotor'       => [3, 4, 9],       // head cleaning, nozzle, noda berulang (laser)
        'kualitas.tidak_rata'  => [8],             // teks tidak rata

        // === TINTA (Tinta: 8 questions) ===
        'tinta.habis'         => [1, 4, 5],        // cartridge not detected, dianggap habis, infus
        'tinta.tidak_deteksi' => [1, 4, 6],        // not detected, dianggap habis, cartridge baru
        'tinta.bocor'         => [2, 5, 7],        // bocor, gelembung infus, toner bocor
        'tinta.waste_full'    => [3],              // waste ink full
        'tinta.infus'         => [2, 5],           // bocor, gelembung infus

        // === KERTAS (Kertas: 8 questions) ===
        'kertas.macet'      => [1, 3, 7, 8],       // paper jam, false jam, duplex, pickup roller
        'kertas.tidak_tarik'=> [2, 5, 8],            // tidak tertarik, multi feed, pickup roller
        'kertas.miring'     => [4, 5],              // kertas miring, multi feed
        'kertas.adf'        => [1, 5, 6, 7],        // paper jam, multi feed, ADF, duplex

        // === KONEKSI (Konektivitas: 8 questions) ===
        'koneksi.usb'     => [1, 2],               // USB not detected, USB putus-nyambung
        'koneksi.wifi'    => [3, 4, 8],            // WiFi connect, WiFi putus, mobile print
        'koneksi.offline' => [5, 7],               // status offline, print job gagal
        'koneksi.sharing' => [5, 6],               // offline status, sharing error

        // === HARDWARE PRINTER (Hardware: 7 questions) ===
        'hardware_printer.mati'         => [1, 2],  // mati total, restart/mati
        'hardware_printer.tidak_respon' => [3, 7],  // tidak respon, cover error
        'hardware_printer.panas'        => [2, 5],  // restart, overheat
        'hardware_printer.error_lcd'    => [4],     // LCD rusak

        // === DRIVER / SOFTWARE (Software: 7 questions) ===
        'driver.driver'  => [1, 2, 5],            // terdeteksi tapi gabisa, driver error, after update
        'driver.queue'   => [3, 4],               // queue stuck, default printer
        'driver.spooler' => [1, 3],               // terdeteksi, queue stuck

        // === MEKANIK (Mekanik: 8 questions) ===
        'mekanik.bunyi'      => [2, 3, 4, 7],     // belt bunyi, motor bunyi, gear klik, suara keras
        'mekanik.head_macet' => [1, 5, 6],         // head macet, posisi meleset, head tersumbat
        'mekanik.gear'       => [4, 7],            // gear klik, suara keras

        // === SCANNER (Scanner: 8 questions) ===
        'scanner.tidak_scan' => [1, 2, 4],          // scanner error, lampu scanner, gelap/terang
        'scanner.bergaris'   => [3, 4, 7, 8],      // garis scan, gelap/terang, copy buruk, kaca kotor
        'scanner.copy_buruk' => [3, 4, 7, 8],      // garis scan, gelap/terang, copy buruk, kaca kotor
    ],
];
