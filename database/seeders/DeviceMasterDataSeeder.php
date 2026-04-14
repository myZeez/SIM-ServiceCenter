<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\DeviceType;
use App\Models\DeviceComponent;
use App\Models\ServiceCategory;

class DeviceMasterDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Tipe Perangkat (Device Types)
        $deviceTypes = [
            ['name' => 'Laptop', 'slug' => 'laptop', 'icon' => '💻', 'description' => 'Laptop, Notebook, Ultrabook', 'is_active' => 1, 'order_column' => 1],
            ['name' => 'PC Desktop', 'slug' => 'pc', 'icon' => '🖥️', 'description' => 'PC Rakitan, Tower, Desktop', 'is_active' => 1, 'order_column' => 2],
            ['name' => 'All-in-One', 'slug' => 'aio', 'icon' => '🖥️', 'description' => 'AIO PC, Layar bawaan terintegrasi', 'is_active' => 1, 'order_column' => 3],
            ['name' => 'Printer', 'slug' => 'printer', 'icon' => '🖨️', 'description' => 'Inkjet, Laser, MFP/Scanner', 'is_active' => 1, 'order_column' => 4],
        ];

        foreach ($deviceTypes as $dt) {
            DeviceType::updateOrCreate(['slug' => $dt['slug']], $dt);
        }

        // 2. Komponen Perangkat (Device Components)
        $components = [
            // Laptop
            ['device_slug' => 'laptop', 'name' => 'Layar & Tampilan', 'slug' => 'laptop_layar', 'icon' => '🖥️', 'order_column' => 1],
            ['device_slug' => 'laptop', 'name' => 'Keyboard & Touchpad', 'slug' => 'laptop_keyboard', 'icon' => '⌨️', 'order_column' => 2],
            ['device_slug' => 'laptop', 'name' => 'Konektivitas & Jaringan', 'slug' => 'laptop_jaringan', 'icon' => '🌐', 'order_column' => 3],
            ['device_slug' => 'laptop', 'name' => 'Baterai & Daya', 'slug' => 'laptop_daya', 'icon' => '🔋', 'order_column' => 4],
            ['device_slug' => 'laptop', 'name' => 'Sistem & Software', 'slug' => 'laptop_software', 'icon' => '⚙️', 'order_column' => 5],
            ['device_slug' => 'laptop', 'name' => 'Performa & Kinerja', 'slug' => 'laptop_performa', 'icon' => '⚡', 'order_column' => 6],
            ['device_slug' => 'laptop', 'name' => 'Suhu & Kipas', 'slug' => 'laptop_suhu', 'icon' => '🌡️', 'order_column' => 7],
            ['device_slug' => 'laptop', 'name' => 'Suara & Audio', 'slug' => 'laptop_audio', 'icon' => '🔊', 'order_column' => 8],
            ['device_slug' => 'laptop', 'name' => 'Penyimpanan & Memori', 'slug' => 'laptop_penyimpanan', 'icon' => '💾', 'order_column' => 9],
            ['device_slug' => 'laptop', 'name' => 'Fisik & Body', 'slug' => 'laptop_fisik', 'icon' => '🔨', 'order_column' => 10],
            ['device_slug' => 'laptop', 'name' => 'Kerusakan Air', 'slug' => 'laptop_air', 'icon' => '💧', 'order_column' => 11],
            ['device_slug' => 'laptop', 'name' => 'Gejala Spesifik Hardware', 'slug' => 'laptop_spesifik_hardware', 'icon' => '🔌', 'order_column' => 12],
            ['device_slug' => 'laptop', 'name' => 'Port & Peripheral', 'slug' => 'laptop_peripheral', 'icon' => '🔌', 'order_column' => 13],

            // PC Desktop
            ['device_slug' => 'pc', 'name' => 'Layar & Tampilan', 'slug' => 'pc_layar', 'icon' => '🖥️', 'order_column' => 1],
            ['device_slug' => 'pc', 'name' => 'Keyboard & Mouse', 'slug' => 'pc_keyboard', 'icon' => '⌨️', 'order_column' => 2],
            ['device_slug' => 'pc', 'name' => 'Konektivitas & Jaringan', 'slug' => 'pc_jaringan', 'icon' => '🌐', 'order_column' => 3],
            ['device_slug' => 'pc', 'name' => 'Daya & Power Supply (PSU)', 'slug' => 'pc_daya', 'icon' => '🔌', 'order_column' => 4],
            ['device_slug' => 'pc', 'name' => 'Sistem & Software', 'slug' => 'pc_software', 'icon' => '⚙️', 'order_column' => 5],
            ['device_slug' => 'pc', 'name' => 'Performa & Kinerja', 'slug' => 'pc_performa', 'icon' => '⚡', 'order_column' => 6],
            ['device_slug' => 'pc', 'name' => 'Suhu & Pendingin', 'slug' => 'pc_suhu', 'icon' => '🌡️', 'order_column' => 7],
            ['device_slug' => 'pc', 'name' => 'Suara & Audio', 'slug' => 'pc_audio', 'icon' => '🔊', 'order_column' => 8],
            ['device_slug' => 'pc', 'name' => 'Penyimpanan & Memori', 'slug' => 'pc_penyimpanan', 'icon' => '💾', 'order_column' => 9],
            ['device_slug' => 'pc', 'name' => 'Motherboard & Komponen Internal', 'slug' => 'pc_internal', 'icon' => '🎛️', 'order_column' => 10],

            // AIO (All in One)
            ['device_slug' => 'aio', 'name' => 'Layar & Tampilan', 'slug' => 'aio_layar', 'icon' => '🖥️', 'order_column' => 1],
            ['device_slug' => 'aio', 'name' => 'Keyboard & Mouse', 'slug' => 'aio_keyboard', 'icon' => '⌨️', 'order_column' => 2],
            ['device_slug' => 'aio', 'name' => 'Konektivitas & Jaringan', 'slug' => 'aio_jaringan', 'icon' => '🌐', 'order_column' => 3],
            ['device_slug' => 'aio', 'name' => 'Daya & Adaptor', 'slug' => 'aio_daya', 'icon' => '🔌', 'order_column' => 4],
            ['device_slug' => 'aio', 'name' => 'Sistem & Software', 'slug' => 'aio_software', 'icon' => '⚙️', 'order_column' => 5],
            ['device_slug' => 'aio', 'name' => 'Performa & Kinerja', 'slug' => 'aio_performa', 'icon' => '⚡', 'order_column' => 6],
            ['device_slug' => 'aio', 'name' => 'Suhu & Kipas', 'slug' => 'aio_suhu', 'icon' => '🌡️', 'order_column' => 7],
            ['device_slug' => 'aio', 'name' => 'Suara & Audio', 'slug' => 'aio_audio', 'icon' => '🔊', 'order_column' => 8],
            ['device_slug' => 'aio', 'name' => 'Penyimpanan & Memori', 'slug' => 'aio_penyimpanan', 'icon' => '💾', 'order_column' => 9],
            ['device_slug' => 'aio', 'name' => 'Fisik & Stand', 'slug' => 'aio_fisik', 'icon' => '📺', 'order_column' => 10],

            // Printer
            ['device_slug' => 'printer', 'name' => 'Kualitas Cetak & Tinta', 'slug' => 'printer_cetak', 'icon' => '🖨️', 'order_column' => 1],
            ['device_slug' => 'printer', 'name' => 'Konektivitas & Jaringan', 'slug' => 'printer_jaringan', 'icon' => '🌐', 'order_column' => 2],
            ['device_slug' => 'printer', 'name' => 'Daya & Adaptor', 'slug' => 'printer_daya', 'icon' => '🔌', 'order_column' => 3],
            ['device_slug' => 'printer', 'name' => 'Sistem & Error', 'slug' => 'printer_sistem', 'icon' => '⚙️', 'order_column' => 4],
            ['device_slug' => 'printer', 'name' => 'Penarik Kertas & Sensor', 'slug' => 'printer_kertas', 'icon' => '📄', 'order_column' => 5],
            ['device_slug' => 'printer', 'name' => 'Suhu', 'slug' => 'printer_suhu', 'icon' => '🌡️', 'order_column' => 6],
            ['device_slug' => 'printer', 'name' => 'Kualitas Scan & Fotocopy', 'slug' => 'printer_scan', 'icon' => '📄', 'order_column' => 7],
            ['device_slug' => 'printer', 'name' => 'Mekanik & Roller', 'slug' => 'printer_mekanik', 'icon' => '⚙️', 'order_column' => 8],
            ['device_slug' => 'printer', 'name' => 'Fisik & Body', 'slug' => 'printer_fisik', 'icon' => '🖨️', 'order_column' => 9],
        ];

        foreach ($components as $comp) {
            $deviceType = DeviceType::where('slug', $comp['device_slug'])->first();
            if ($deviceType) {
                DeviceComponent::updateOrCreate(
                    ['slug' => $comp['slug']],
                    [
                        'device_type_id' => $deviceType->id,
                        'name' => $comp['name'],
                        'icon' => $comp['icon'],
                        'order_column' => $comp['order_column']
                    ]
                );
            }
        }

        // 3. Detail Kategori Servis (Service Categories)
        $serviceCategoriesMap = [
            'laptop_layar' => [
                ['name' => 'Kerusakan Hardware Layar', 'slug' => 'layar_hardware'],
                ['name' => 'Kerusakan Software/Driver', 'slug' => 'layar_software']
            ],
            'laptop_keyboard' => [
                ['name' => 'Masalah Fisik Keyboard/Touchpad', 'slug' => 'keyboard_hardware'],
                ['name' => 'Masalah Sensor/Konektor', 'slug' => 'keyboard_sensor']
            ],
            'laptop_jaringan' => [
                ['name' => 'Masalah Koneksi WiFi/Bluetooth', 'slug' => 'jaringan_koneksi']
            ],
            'laptop_daya' => [
                ['name' => 'Masalah Baterai/Pengisian Daya', 'slug' => 'daya_baterai'],
                ['name' => 'Mati Total/Gagal Boot', 'slug' => 'daya_mati']
            ],
            'laptop_software' => [
                ['name' => 'Sistem Operasi (OS) & Booting', 'slug' => 'software_os'],
                ['name' => 'Masalah Aplikasi & Virus', 'slug' => 'software_virus']
            ],
            'laptop_performa' => [
                ['name' => 'Lag & Freeze', 'slug' => 'performa_lag']
            ],
            'laptop_suhu' => [
                ['name' => 'Overheating & Kipas', 'slug' => 'suhu_panas']
            ],
            'laptop_audio' => [
                ['name' => 'Masalah Speaker/Mic', 'slug' => 'audio_speaker']
            ],
            'laptop_penyimpanan' => [
                ['name' => 'Masalah Harddisk/SSD/RAM', 'slug' => 'penyimpanan_storage']
            ],
            'laptop_fisik' => [
                ['name' => 'Kerusakan Body/Engsel', 'slug' => 'fisik_body']
            ],
            'laptop_air' => [
                ['name' => 'Tersiram Cairan (Water Damage)', 'slug' => 'air_cairan']
            ],
            'laptop_spesifik_hardware' => [
                ['name' => 'Masalah Motherboard', 'slug' => 'hardware_motherboard']
            ],
            'laptop_peripheral' => [
                ['name' => 'Masalah Port/Colokan', 'slug' => 'peripheral_port']
            ],
        ];

        foreach ($serviceCategoriesMap as $compSlug => $categories) {
            $component = DeviceComponent::where('slug', $compSlug)->first();
            if ($component) {
                foreach ($categories as $cat) {
                    ServiceCategory::updateOrCreate(
                        ['slug' => $cat['slug']],
                        [
                            'device_component_id' => $component->id,
                            'name' => $cat['name']
                        ]
                    );
                }
            }
        }
    }
}
