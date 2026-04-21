-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 15, 2026 at 04:00 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admcellcom`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint UNSIGNED NOT NULL,
  `booking_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `device_brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complaint` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `symptoms` json DEFAULT NULL,
  `diagnosis_result` json DEFAULT NULL,
  `ai_recommendation` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','confirmed','in_progress','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `booking_code`, `name`, `phone`, `email`, `address`, `device_brand`, `device_name`, `serial_number`, `complaint`, `symptoms`, `diagnosis_result`, `ai_recommendation`, `status`, `created_at`, `updated_at`) VALUES
(1, 'BK-202602-001', 'ahmad', '190287986019283', NULL, '', 'Acer', 'asdas', '', 'Gejala: Layar blank hitam\n\nDiagnosis Sistem: Kerusakan Panel LCD (50%), Kabel Flexible LCD Rusak/Longgar (50%)', '[\"Layar blank hitam\"]', '{\"status\": \"partial\", \"message\": \"Diagnosis berdasarkan kategori masalah. Disarankan pemeriksaan lebih lanjut.\", \"category\": \"Display\", \"diagnoses\": [{\"code\": \"K001\", \"name\": \"Kerusakan Panel LCD\", \"level\": \"Sedang\", \"actions\": [\"Cek kondisi panel LCD\", \"Tes dengan monitor eksternal\", \"Ganti LCD\"], \"category\": \"Display\", \"solution\": \"Ganti panel LCD dengan yang baru sesuai tipe laptop\", \"confidence\": 50, \"cost_range\": \"Rp 500.000 - Rp 2.500.000\", \"description\": \"Panel LCD internal mengalami kerusakan fisik atau elektronik\", \"matched_symptoms\": [\"Layar blank hitam\"]}, {\"code\": \"K002\", \"name\": \"Kabel Flexible LCD Rusak/Longgar\", \"level\": \"Ringan\", \"actions\": [\"Buka casing layar\", \"Periksa konektor\", \"Ganti kabel flexible\"], \"category\": \"Display\", \"solution\": \"Periksa dan kencangkan konektor atau ganti kabel flexible LCD\", \"confidence\": 50, \"cost_range\": \"Rp 150.000 - Rp 500.000\", \"description\": \"Kabel flexible yang menghubungkan LCD ke motherboard rusak atau terlepas\", \"matched_symptoms\": [\"Layar blank hitam\"]}], \"detected_symptoms\": [\"Layar blank hitam\"]}', 'Kerusakan Panel LCD (50%), Kabel Flexible LCD Rusak/Longgar (50%)', 'confirmed', '2026-02-05 10:56:54', '2026-02-05 11:00:49'),
(2, 'BK-202602-002', 'Zeez', '90128360123', NULL, '', 'Asus', 'Asus X505', '', 'Kategori: Panas / Overheat\nMasalah: Laptop Cepat Panas\nGejala: Suhu CPU di atas 90°C saat idle, Fan/kipas tidak berputar\n\nDiagnosis Sistem: Kipas/Fan Rusak (50%), Thermal Paste Kering (50%)\n\nCatatan: Laptop saya panas', '[\"Suhu CPU di atas 90°C saat idle\", \"Fan/kipas tidak berputar\"]', '{\"status\": \"partial\", \"message\": \"Diagnosis berdasarkan kategori masalah. Disarankan pemeriksaan lebih lanjut.\", \"category\": \"Thermal\", \"diagnoses\": [{\"code\": \"K023\", \"name\": \"Kipas/Fan Rusak\", \"level\": \"Ringan\", \"actions\": [\"Ganti kipas/fan laptop\"], \"category\": \"Thermal\", \"solution\": \"Ganti kipas/fan laptop\", \"confidence\": 50, \"cost_range\": \"Rp 100.000 - Rp 400.000\", \"description\": \"Fan pendingin tidak berfungsi atau berputar dengan benar\", \"matched_symptoms\": [\"Suhu CPU di atas 90°C saat idle\", \"Fan/kipas tidak berputar\"]}, {\"code\": \"K024\", \"name\": \"Thermal Paste Kering\", \"level\": \"Ringan\", \"actions\": [\"Ganti thermal paste dengan yang baru\"], \"category\": \"Thermal\", \"solution\": \"Ganti thermal paste dengan yang baru\", \"confidence\": 50, \"cost_range\": \"Rp 50.000 - Rp 150.000\", \"description\": \"Pasta termal antara CPU/GPU dan heatsink sudah kering\", \"matched_symptoms\": [\"Suhu CPU di atas 90°C saat idle\", \"Fan/kipas tidak berputar\"]}], \"detected_symptoms\": [\"Suhu CPU di atas 90°C saat idle\", \"Fan/kipas tidak berputar\"]}', 'Kipas/Fan Rusak (50%), Thermal Paste Kering (50%)', 'confirmed', '2026-02-21 01:17:53', '2026-02-21 01:18:45'),
(3, 'BK-202603-001', 'Rahmah', '98723487293847', NULL, '', 'Acer', 'X441x', '', 'Perangkat: Laptop\nKategori: Keyboard\nMasalah: Sebagian Tombol Mati\nGejala: Beberapa tombol tidak berfungsi, Keyboard tidak berfungsi\n\nDiagnosis Sistem: Keyboard Internal Rusak (7%)\n\nCatatan: keyboad bermasalah', '[\"Beberapa tombol tidak berfungsi\", \"Keyboard tidak berfungsi\"]', '{\"method\": \"hybrid_fc_bc\", \"status\": \"success\", \"category\": \"Keyboard\", \"diagnoses\": [{\"code\": \"K006\", \"name\": \"Keyboard Internal Rusak\", \"level\": \"Ringan\", \"actions\": [\"Ganti keyboard internal dengan yang baru sesuai tipe\"], \"category\": \"Keyboard\", \"max_cost\": \"600000.00\", \"min_cost\": \"150000.00\", \"solution\": \"Ganti keyboard internal dengan yang baru sesuai tipe\", \"confidence\": 7, \"cost_range\": \"Rp 150.000 - Rp 600.000\", \"bc_verified\": true, \"description\": \"Keyboard laptop rusak dan perlu diganti\", \"level_color\": \"green\", \"total_denied\": 3, \"total_matched\": 2, \"total_required\": 5, \"denied_symptoms\": [\"Keyboard eksternal berfungsi normal\", \"Tombol Enter/Space/Shift tidak berfungsi\", \"Keyboard menekan karakter salah\"], \"match_percentage\": 40, \"matched_symptoms\": [\"Keyboard tidak berfungsi\", \"Beberapa tombol tidak berfungsi\"], \"missing_symptoms\": [], \"confidence_change\": -5, \"original_confidence\": 12, \"verification_status\": \"inconclusive\"}], \"fc_original\": {\"status\": \"success\", \"category\": \"Keyboard\", \"diagnoses\": [{\"code\": \"K006\", \"name\": \"Keyboard Internal Rusak\", \"level\": \"Ringan\", \"actions\": [\"Ganti keyboard internal dengan yang baru sesuai tipe\"], \"category\": \"Keyboard\", \"max_cost\": \"600000.00\", \"min_cost\": \"150000.00\", \"solution\": \"Ganti keyboard internal dengan yang baru sesuai tipe\", \"penalized\": true, \"confidence\": 12, \"cost_range\": \"Rp 150.000 - Rp 600.000\", \"description\": \"Keyboard laptop rusak dan perlu diganti\", \"level_color\": \"green\", \"match_percentage\": 40, \"matched_symptoms\": [\"Beberapa tombol tidak berfungsi\", \"Keyboard tidak berfungsi\"]}], \"symptom_codes\": [\"G010\", \"G009\"], \"detected_symptoms\": [\"Beberapa tombol tidak berfungsi\", \"Keyboard tidak berfungsi\"], \"total_rules_matched\": 1}, \"verification\": {\"log\": [{\"answer\": \"tidak\", \"result\": \"denied\", \"symptom_id\": 30, \"symptom_name\": \"Tombol Enter/Space/Shift tidak berfungsi\", \"affected_hypotheses\": [{\"effect\": \"confidence_down\", \"disease\": \"Keyboard Internal Rusak\"}]}, {\"answer\": \"tidak\", \"result\": \"denied\", \"symptom_id\": 25, \"symptom_name\": \"Keyboard eksternal berfungsi normal\", \"affected_hypotheses\": [{\"effect\": \"confidence_down\", \"disease\": \"Keyboard Internal Rusak\"}]}, {\"answer\": \"tidak\", \"result\": \"denied\", \"symptom_id\": 32, \"symptom_name\": \"Keyboard menekan karakter salah\", \"affected_hypotheses\": [{\"effect\": \"confidence_down\", \"disease\": \"Keyboard Internal Rusak\"}]}], \"total_denied\": 3, \"total_confirmed\": 0, \"total_verifications\": 3}, \"symptom_codes\": [\"G010\", \"G009\"], \"detected_symptoms\": [\"Beberapa tombol tidak berfungsi\", \"Keyboard tidak berfungsi\"], \"total_rules_matched\": 1}', 'Keyboard Internal Rusak (7%)', 'confirmed', '2026-03-03 05:56:09', '2026-03-03 05:58:20'),
(4, 'BK-202603-002', 'jojo', '89te579787e75568755', NULL, '', 'Asus', 'predator', '', 'Perangkat: Laptop\nKategori: Layar\nMasalah: Layar Hitam / Blank\nGejala: Layar blank hitam, Layar redup\n\nDiagnosis Sistem: Backlight/Inverter Rusak (55%), Kerusakan Panel LCD (41%), LCD Pecah Fisik (21%)\n\nCatatan: mati cik layarku', '[\"Layar blank hitam\", \"Layar redup\"]', '{\"method\": \"hybrid_fc_bc\", \"status\": \"success\", \"category\": \"Display\", \"diagnoses\": [{\"code\": \"K003\", \"name\": \"Backlight/Inverter Rusak\", \"level\": \"Sedang\", \"actions\": [\"Ganti backlight LED strip atau inverter board\"], \"category\": \"Display\", \"max_cost\": \"800000.00\", \"min_cost\": \"200000.00\", \"solution\": \"Ganti backlight LED strip atau inverter board\", \"confidence\": 55, \"cost_range\": \"Rp 200.000 - Rp 800.000\", \"bc_verified\": true, \"description\": \"Lampu backlight atau inverter tidak berfungsi sehingga layar redup\", \"level_color\": \"yellow\", \"total_denied\": 0, \"total_matched\": 3, \"total_required\": 4, \"denied_symptoms\": [], \"match_percentage\": 75, \"matched_symptoms\": [\"Layar blank hitam\", \"Layar redup\", \"Tampilan normal di monitor eksternal\"], \"missing_symptoms\": [\"Layar mati setelah beberapa menit\"], \"confidence_change\": 7, \"original_confidence\": 48, \"verification_status\": \"strongly_verified\"}, {\"code\": \"K001\", \"name\": \"Kerusakan Panel LCD\", \"level\": \"Sedang\", \"actions\": [\"Ganti panel LCD dengan yang baru sesuai tipe laptop\"], \"category\": \"Display\", \"max_cost\": \"2500000.00\", \"min_cost\": \"500000.00\", \"solution\": \"Ganti panel LCD dengan yang baru sesuai tipe laptop\", \"confidence\": 41, \"cost_range\": \"Rp 500.000 - Rp 2.500.000\", \"bc_verified\": true, \"description\": \"Panel LCD internal mengalami kerusakan fisik atau elektronik\", \"level_color\": \"yellow\", \"total_denied\": 1, \"total_matched\": 3, \"total_required\": 5, \"denied_symptoms\": [\"Layar bergaris\"], \"match_percentage\": 60, \"matched_symptoms\": [\"Layar blank hitam\", \"Layar redup\", \"Tampilan normal di monitor eksternal\"], \"missing_symptoms\": [\"Layar hanya setengah menyala\"], \"confidence_change\": 1, \"original_confidence\": 40, \"verification_status\": \"strongly_verified\"}, {\"code\": \"K005\", \"name\": \"LCD Pecah Fisik\", \"level\": \"Sedang\", \"actions\": [\"Ganti panel LCD baru\"], \"category\": \"Display\", \"max_cost\": \"3000000.00\", \"min_cost\": \"600000.00\", \"solution\": \"Ganti panel LCD baru\", \"confidence\": 21, \"cost_range\": \"Rp 600.000 - Rp 3.000.000\", \"bc_verified\": true, \"description\": \"Panel LCD mengalami kerusakan fisik (retak/pecah)\", \"level_color\": \"yellow\", \"total_denied\": 2, \"total_matched\": 1, \"total_required\": 3, \"denied_symptoms\": [\"Layar bergaris\", \"Layar pecah\"], \"match_percentage\": 33.33, \"matched_symptoms\": [\"Layar blank hitam\"], \"missing_symptoms\": [], \"confidence_change\": -12, \"original_confidence\": 33, \"verification_status\": \"inconclusive\"}], \"fc_original\": {\"status\": \"success\", \"category\": \"Display\", \"diagnoses\": [{\"code\": \"K003\", \"name\": \"Backlight/Inverter Rusak\", \"level\": \"Sedang\", \"actions\": [\"Ganti backlight LED strip atau inverter board\"], \"category\": \"Display\", \"max_cost\": \"800000.00\", \"min_cost\": \"200000.00\", \"solution\": \"Ganti backlight LED strip atau inverter board\", \"penalized\": false, \"confidence\": 48, \"cost_range\": \"Rp 200.000 - Rp 800.000\", \"description\": \"Lampu backlight atau inverter tidak berfungsi sehingga layar redup\", \"level_color\": \"yellow\", \"match_percentage\": 50, \"matched_symptoms\": [\"Layar blank hitam\", \"Layar redup\"]}, {\"code\": \"K001\", \"name\": \"Kerusakan Panel LCD\", \"level\": \"Sedang\", \"actions\": [\"Ganti panel LCD dengan yang baru sesuai tipe laptop\"], \"category\": \"Display\", \"max_cost\": \"2500000.00\", \"min_cost\": \"500000.00\", \"solution\": \"Ganti panel LCD dengan yang baru sesuai tipe laptop\", \"penalized\": false, \"confidence\": 40, \"cost_range\": \"Rp 500.000 - Rp 2.500.000\", \"description\": \"Panel LCD internal mengalami kerusakan fisik atau elektronik\", \"level_color\": \"yellow\", \"match_percentage\": 40, \"matched_symptoms\": [\"Layar blank hitam\", \"Layar redup\"]}, {\"code\": \"K005\", \"name\": \"LCD Pecah Fisik\", \"level\": \"Sedang\", \"actions\": [\"Ganti panel LCD baru\"], \"category\": \"Display\", \"max_cost\": \"3000000.00\", \"min_cost\": \"600000.00\", \"solution\": \"Ganti panel LCD baru\", \"penalized\": false, \"confidence\": 33, \"cost_range\": \"Rp 600.000 - Rp 3.000.000\", \"description\": \"Panel LCD mengalami kerusakan fisik (retak/pecah)\", \"level_color\": \"yellow\", \"match_percentage\": 33.33, \"matched_symptoms\": [\"Layar blank hitam\"]}], \"symptom_codes\": [\"G001\", \"G004\"], \"detected_symptoms\": [\"Layar blank hitam\", \"Layar redup\"], \"total_rules_matched\": 6}, \"verification\": {\"log\": [{\"answer\": \"ya\", \"result\": \"confirmed\", \"symptom_id\": 7, \"symptom_name\": \"Tampilan normal di monitor eksternal\", \"affected_hypotheses\": [{\"effect\": \"confidence_up\", \"disease\": \"Backlight/Inverter Rusak\"}, {\"effect\": \"confidence_up\", \"disease\": \"Kerusakan Panel LCD\"}]}, {\"answer\": \"tidak\", \"result\": \"denied\", \"symptom_id\": 2, \"symptom_name\": \"Layar bergaris\", \"affected_hypotheses\": [{\"effect\": \"confidence_down\", \"disease\": \"Kerusakan Panel LCD\"}, {\"effect\": \"confidence_down\", \"disease\": \"LCD Pecah Fisik\"}]}, {\"answer\": \"tidak\", \"result\": \"denied\", \"symptom_id\": 5, \"symptom_name\": \"Layar pecah\", \"affected_hypotheses\": [{\"effect\": \"confidence_down\", \"disease\": \"LCD Pecah Fisik\"}]}], \"total_denied\": 2, \"total_confirmed\": 1, \"total_verifications\": 3}, \"symptom_codes\": [\"G001\", \"G004\"], \"detected_symptoms\": [\"Layar blank hitam\", \"Layar redup\"], \"total_rules_matched\": 6}', 'Backlight/Inverter Rusak (55%), Kerusakan Panel LCD (41%), LCD Pecah Fisik (21%)', 'confirmed', '2026-03-11 22:05:28', '2026-03-11 22:05:54'),
(5, 'BK-202603-003', 'Irwan', '085821791736', NULL, '', 'Asus', 'Rog Jadul', '', 'Perangkat: Laptop\nKategori: Layar\nMasalah: Layar Hitam / Blank\nGejala: Layar blank hitam, Layar redup\n\nDiagnosis Sistem: Backlight/Inverter Rusak (39%), Kerusakan Panel LCD (28%), LCD Pecah Fisik (21%)\n\nCatatan: Yang bener kerjanya', '[\"Layar blank hitam\", \"Layar redup\"]', '{\"method\": \"hybrid_fc_bc\", \"status\": \"success\", \"category\": \"Display\", \"diagnoses\": [{\"code\": \"K003\", \"name\": \"Backlight/Inverter Rusak\", \"level\": \"Sedang\", \"actions\": [\"Ganti backlight LED strip atau inverter board\"], \"category\": \"Display\", \"max_cost\": \"800000.00\", \"min_cost\": \"200000.00\", \"solution\": \"Ganti backlight LED strip atau inverter board\", \"confidence\": 39, \"cost_range\": \"Rp 200.000 - Rp 800.000\", \"bc_verified\": true, \"description\": \"Lampu backlight atau inverter tidak berfungsi sehingga layar redup\", \"level_color\": \"yellow\", \"total_denied\": 1, \"total_matched\": 2, \"total_required\": 4, \"denied_symptoms\": [\"Tampilan normal di monitor eksternal\"], \"match_percentage\": 50, \"matched_symptoms\": [\"Layar blank hitam\", \"Layar redup\"], \"missing_symptoms\": [\"Layar mati setelah beberapa menit\"], \"confidence_change\": -9, \"original_confidence\": 48, \"verification_status\": \"partially_verified\"}, {\"code\": \"K001\", \"name\": \"Kerusakan Panel LCD\", \"level\": \"Sedang\", \"actions\": [\"Ganti panel LCD dengan yang baru sesuai tipe laptop\"], \"category\": \"Display\", \"max_cost\": \"2500000.00\", \"min_cost\": \"500000.00\", \"solution\": \"Ganti panel LCD dengan yang baru sesuai tipe laptop\", \"confidence\": 28, \"cost_range\": \"Rp 500.000 - Rp 2.500.000\", \"bc_verified\": true, \"description\": \"Panel LCD internal mengalami kerusakan fisik atau elektronik\", \"level_color\": \"yellow\", \"total_denied\": 2, \"total_matched\": 2, \"total_required\": 5, \"denied_symptoms\": [\"Layar bergaris\", \"Tampilan normal di monitor eksternal\"], \"match_percentage\": 40, \"matched_symptoms\": [\"Layar blank hitam\", \"Layar redup\"], \"missing_symptoms\": [\"Layar hanya setengah menyala\"], \"confidence_change\": -12, \"original_confidence\": 40, \"verification_status\": \"partially_verified\"}, {\"code\": \"K005\", \"name\": \"LCD Pecah Fisik\", \"level\": \"Sedang\", \"actions\": [\"Ganti panel LCD baru\"], \"category\": \"Display\", \"max_cost\": \"3000000.00\", \"min_cost\": \"600000.00\", \"solution\": \"Ganti panel LCD baru\", \"confidence\": 21, \"cost_range\": \"Rp 600.000 - Rp 3.000.000\", \"bc_verified\": true, \"description\": \"Panel LCD mengalami kerusakan fisik (retak/pecah)\", \"level_color\": \"yellow\", \"total_denied\": 2, \"total_matched\": 1, \"total_required\": 3, \"denied_symptoms\": [\"Layar bergaris\", \"Layar pecah\"], \"match_percentage\": 33.33, \"matched_symptoms\": [\"Layar blank hitam\"], \"missing_symptoms\": [], \"confidence_change\": -12, \"original_confidence\": 33, \"verification_status\": \"inconclusive\"}], \"fc_original\": {\"status\": \"success\", \"category\": \"Display\", \"diagnoses\": [{\"code\": \"K003\", \"name\": \"Backlight/Inverter Rusak\", \"level\": \"Sedang\", \"actions\": [\"Ganti backlight LED strip atau inverter board\"], \"category\": \"Display\", \"max_cost\": \"800000.00\", \"min_cost\": \"200000.00\", \"solution\": \"Ganti backlight LED strip atau inverter board\", \"penalized\": false, \"confidence\": 48, \"cost_range\": \"Rp 200.000 - Rp 800.000\", \"description\": \"Lampu backlight atau inverter tidak berfungsi sehingga layar redup\", \"level_color\": \"yellow\", \"match_percentage\": 50, \"matched_symptoms\": [\"Layar blank hitam\", \"Layar redup\"]}, {\"code\": \"K001\", \"name\": \"Kerusakan Panel LCD\", \"level\": \"Sedang\", \"actions\": [\"Ganti panel LCD dengan yang baru sesuai tipe laptop\"], \"category\": \"Display\", \"max_cost\": \"2500000.00\", \"min_cost\": \"500000.00\", \"solution\": \"Ganti panel LCD dengan yang baru sesuai tipe laptop\", \"penalized\": false, \"confidence\": 40, \"cost_range\": \"Rp 500.000 - Rp 2.500.000\", \"description\": \"Panel LCD internal mengalami kerusakan fisik atau elektronik\", \"level_color\": \"yellow\", \"match_percentage\": 40, \"matched_symptoms\": [\"Layar blank hitam\", \"Layar redup\"]}, {\"code\": \"K005\", \"name\": \"LCD Pecah Fisik\", \"level\": \"Sedang\", \"actions\": [\"Ganti panel LCD baru\"], \"category\": \"Display\", \"max_cost\": \"3000000.00\", \"min_cost\": \"600000.00\", \"solution\": \"Ganti panel LCD baru\", \"penalized\": false, \"confidence\": 33, \"cost_range\": \"Rp 600.000 - Rp 3.000.000\", \"description\": \"Panel LCD mengalami kerusakan fisik (retak/pecah)\", \"level_color\": \"yellow\", \"match_percentage\": 33.33, \"matched_symptoms\": [\"Layar blank hitam\"]}], \"symptom_codes\": [\"G001\", \"G004\"], \"detected_symptoms\": [\"Layar blank hitam\", \"Layar redup\"], \"total_rules_matched\": 6}, \"verification\": {\"log\": [{\"answer\": \"tidak\", \"result\": \"denied\", \"symptom_id\": 7, \"symptom_name\": \"Tampilan normal di monitor eksternal\", \"affected_hypotheses\": [{\"effect\": \"confidence_down\", \"disease\": \"Backlight/Inverter Rusak\"}, {\"effect\": \"confidence_down\", \"disease\": \"Kerusakan Panel LCD\"}]}, {\"answer\": \"tidak\", \"result\": \"denied\", \"symptom_id\": 2, \"symptom_name\": \"Layar bergaris\", \"affected_hypotheses\": [{\"effect\": \"confidence_down\", \"disease\": \"Kerusakan Panel LCD\"}, {\"effect\": \"confidence_down\", \"disease\": \"LCD Pecah Fisik\"}]}, {\"answer\": \"tidak\", \"result\": \"denied\", \"symptom_id\": 5, \"symptom_name\": \"Layar pecah\", \"affected_hypotheses\": [{\"effect\": \"confidence_down\", \"disease\": \"LCD Pecah Fisik\"}]}], \"total_denied\": 3, \"total_confirmed\": 0, \"total_verifications\": 3}, \"symptom_codes\": [\"G001\", \"G004\"], \"detected_symptoms\": [\"Layar blank hitam\", \"Layar redup\"], \"total_rules_matched\": 6}', 'Backlight/Inverter Rusak (39%), Kerusakan Panel LCD (28%), LCD Pecah Fisik (21%)', 'confirmed', '2026-03-11 23:41:02', '2026-03-11 23:52:46'),
(6, 'BK-202603-004', 'Budi Aulyansyah', '082377379393', NULL, '', 'Acer', 'Swift X', '', 'Perangkat: Laptop\nKategori: Daya & Baterai\nMasalah: Mati Total\nGejala: Laptop mati total, Laptop nyala sebentar lalu mati lagi\n\nDiagnosis Sistem: Kerusakan IC Power Motherboard (46%), VRM (Voltage Regulator Module) Rusak (17%)\n\nCatatan: Laptop saya rusak', '[\"Laptop mati total\", \"Laptop nyala sebentar lalu mati lagi\"]', '{\"method\": \"hybrid_fc_bc\", \"status\": \"success\", \"category\": \"Power\", \"diagnoses\": [{\"code\": \"K014\", \"name\": \"Kerusakan IC Power Motherboard\", \"level\": \"Berat\", \"actions\": [\"Kemungkinan kerusakan pada bagian Mainboard (jalur power). Diperlukan pemeriksaan lebih lanjut oleh teknisi\"], \"category\": \"Power\", \"max_cost\": \"1000000.00\", \"min_cost\": \"300000.00\", \"solution\": \"Kemungkinan kerusakan pada bagian Mainboard (jalur power). Diperlukan pemeriksaan lebih lanjut oleh teknisi\", \"confidence\": 46, \"cost_range\": \"Rp 300.000 - Rp 1.000.000\", \"bc_verified\": true, \"description\": \"IC Power pada motherboard rusak\", \"level_color\": \"red\", \"total_denied\": 1, \"total_matched\": 3, \"total_required\": 4, \"denied_symptoms\": [\"Adaptor charger normal di laptop lain\"], \"match_percentage\": 75, \"matched_symptoms\": [\"Laptop mati total\", \"Lampu indikator mati semua\", \"Laptop nyala sebentar lalu mati lagi\"], \"missing_symptoms\": [], \"confidence_change\": -4, \"original_confidence\": 50, \"verification_status\": \"partially_verified\"}, {\"code\": \"K109\", \"name\": \"VRM (Voltage Regulator Module) Rusak\", \"level\": \"Berat\", \"actions\": [\"Kemungkinan kerusakan VRM pada Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi\"], \"category\": \"Hardware\", \"max_cost\": \"800000.00\", \"min_cost\": \"300000.00\", \"solution\": \"Kemungkinan kerusakan VRM pada Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi\", \"confidence\": 17, \"cost_range\": \"Rp 300.000 - Rp 800.000\", \"bc_verified\": true, \"description\": \"VRM pada motherboard rusak menyebabkan voltase tidak stabil\", \"level_color\": \"red\", \"total_denied\": 1, \"total_matched\": 1, \"total_required\": 4, \"denied_symptoms\": [\"Chipset motherboard terasa sangat panas\"], \"match_percentage\": 25, \"matched_symptoms\": [\"Laptop nyala sebentar lalu mati lagi\"], \"missing_symptoms\": [\"Laptop mengeluarkan bau komponen terbakar\", \"Voltase motherboard tidak stabil (diukur dengan multimeter)\"], \"confidence_change\": -4, \"original_confidence\": 21, \"verification_status\": \"inconclusive\"}], \"fc_original\": {\"status\": \"success\", \"category\": \"Power\", \"diagnoses\": [{\"code\": \"K014\", \"name\": \"Kerusakan IC Power Motherboard\", \"level\": \"Berat\", \"actions\": [\"Kemungkinan kerusakan pada bagian Mainboard (jalur power). Diperlukan pemeriksaan lebih lanjut oleh teknisi\"], \"category\": \"Power\", \"max_cost\": \"1000000.00\", \"min_cost\": \"300000.00\", \"solution\": \"Kemungkinan kerusakan pada bagian Mainboard (jalur power). Diperlukan pemeriksaan lebih lanjut oleh teknisi\", \"penalized\": false, \"confidence\": 50, \"cost_range\": \"Rp 300.000 - Rp 1.000.000\", \"description\": \"IC Power pada motherboard rusak\", \"level_color\": \"red\", \"match_percentage\": 50, \"matched_symptoms\": [\"Laptop mati total\", \"Laptop nyala sebentar lalu mati lagi\"]}, {\"code\": \"K109\", \"name\": \"VRM (Voltage Regulator Module) Rusak\", \"level\": \"Berat\", \"actions\": [\"Kemungkinan kerusakan VRM pada Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi\"], \"category\": \"Hardware\", \"max_cost\": \"800000.00\", \"min_cost\": \"300000.00\", \"solution\": \"Kemungkinan kerusakan VRM pada Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi\", \"penalized\": false, \"confidence\": 21, \"cost_range\": \"Rp 300.000 - Rp 800.000\", \"description\": \"VRM pada motherboard rusak menyebabkan voltase tidak stabil\", \"level_color\": \"red\", \"match_percentage\": 25, \"matched_symptoms\": [\"Laptop nyala sebentar lalu mati lagi\"]}], \"symptom_codes\": [\"G023\", \"G149\"], \"detected_symptoms\": [\"Laptop mati total\", \"Laptop nyala sebentar lalu mati lagi\"], \"total_rules_matched\": 2, \"direct_diagnosis_note\": \"Laptop mati total bisa disebabkan oleh beberapa komponen: keyboard, mainboard, RAM, SSD/HDD, atau display.\"}, \"verification\": {\"log\": [{\"answer\": \"tidak\", \"result\": \"denied\", \"symptom_id\": 84, \"symptom_name\": \"Adaptor charger normal di laptop lain\", \"affected_hypotheses\": [{\"effect\": \"confidence_down\", \"disease\": \"Kerusakan IC Power Motherboard\"}]}, {\"answer\": \"ya\", \"result\": \"confirmed\", \"symptom_id\": 88, \"symptom_name\": \"Lampu indikator mati semua\", \"affected_hypotheses\": [{\"effect\": \"confidence_up\", \"disease\": \"Kerusakan IC Power Motherboard\"}]}, {\"answer\": \"tidak\", \"result\": \"denied\", \"symptom_id\": 227, \"symptom_name\": \"Chipset motherboard terasa sangat panas\", \"affected_hypotheses\": [{\"effect\": \"confidence_down\", \"disease\": \"VRM (Voltage Regulator Module) Rusak\"}]}], \"total_denied\": 2, \"total_confirmed\": 1, \"total_verifications\": 3}, \"symptom_codes\": [\"G023\", \"G149\"], \"detected_symptoms\": [\"Laptop mati total\", \"Laptop nyala sebentar lalu mati lagi\"], \"total_rules_matched\": 2}', 'Kerusakan IC Power Motherboard (46%), VRM (Voltage Regulator Module) Rusak (17%)', 'pending', '2026-03-12 05:32:38', '2026-03-12 05:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'ASUS', 1, '2026-02-21 02:36:03', '2026-02-21 02:36:03'),
(2, 'Lenovo', 1, '2026-02-21 02:36:03', '2026-02-21 02:36:03'),
(3, 'HP', 1, '2026-02-21 02:36:03', '2026-02-21 02:36:03'),
(5, 'Acer', 1, '2026-02-21 02:36:03', '2026-02-21 02:36:03'),
(7, 'MSI', 1, '2026-02-21 02:36:03', '2026-02-21 02:36:03'),
(9, 'Axio', 1, '2026-02-21 02:37:07', '2026-02-21 02:37:07');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-admin@celcom|127.0.0.1', 'i:1;', 1775994163),
('laravel-cache-admin@celcom|127.0.0.1:timer', 'i:1775994163;', 1775994163);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_questions`
--

CREATE TABLE `category_questions` (
  `id` bigint UNSIGNED NOT NULL,
  `device_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'laptop',
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `expected_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `leads_to_symptom_id` bigint UNSIGNED DEFAULT NULL,
  `order` int NOT NULL DEFAULT '1',
  `question_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yesno',
  `options` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `device_type_id` bigint UNSIGNED DEFAULT NULL,
  `device_component_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_questions`
--

INSERT INTO `category_questions` (`id`, `device_type`, `category`, `question`, `expected_keyword`, `leads_to_symptom_id`, `order`, `question_type`, `options`, `created_at`, `updated_at`, `device_type_id`, `device_component_id`) VALUES
(1, 'laptop', 'Display', 'Saat laptop dinyalakan, apakah ada tanda-tanda hidup seperti lampu LED menyala, kipas berputar, atau suara dari laptop?', 'ya,iya,ada,nyala,hidup,berputar,kipas', NULL, 1, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:22', 1, 9),
(2, 'laptop', 'Display', 'Apakah layar benar-benar hitam total, atau masih terlihat gambar samar/redup jika disinari senter?', 'redup,samar,senter,ada gambar,terlihat samar', 4, 2, 'choice', '[{\"label\": \"Hitam Total\", \"value\": \"hitam total gelap\"}, {\"label\": \"Ada Gambar Samar / Redup\", \"value\": \"redup samar ada gambar senter\"}]', '2026-03-12 15:25:40', '2026-04-01 06:32:22', 1, 9),
(3, 'laptop', 'Display', 'Sudahkah dicoba hubungkan ke monitor eksternal (via HDMI/VGA)? Apakah tampilan di monitor eksternal normal?', 'ya,iya,normal,bisa,tampil', 7, 3, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:22', 1, 9),
(4, 'laptop', 'Display', 'Apakah layar berkedip-kedip atau mati hidup saat posisi layar digerakkan (buka-tutup)?', 'ya,iya,berkedip,flicker,mati hidup,digerakkan', 8, 4, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:22', 1, 9),
(5, 'laptop', 'Display', 'Apakah ada garis-garis (horizontal atau vertikal) yang muncul di layar?', 'ya,iya,garis,bergaris,strip,horizontal,vertikal', 2, 5, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:22', 1, 9),
(6, 'laptop', 'Display', 'Apakah ada kerusakan fisik yang terlihat pada layar seperti retakan, pecah, atau bekas benturan?', 'ya,iya,retak,pecah,benturan,rusak', 5, 6, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:22', 1, 9),
(7, 'laptop', 'Display', 'Apakah masalah layar ini terjadi setelah laptop terjatuh atau terbentur sesuatu?', 'ya,iya,jatuh,bentur,kebentur,terjatuh', 231, 7, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:22', 1, 9),
(8, 'laptop', 'Display', 'Apakah hanya setengah bagian layar yang menyala atau menampilkan gambar?', 'ya,iya,setengah,sebagian,separuh,half', 14, 8, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:22', 1, 9),
(9, 'laptop', 'Display', 'Apakah ada bercak putih (white spot) atau titik pixel yang mati di layar?', 'ya,iya,bercak,white spot,putih,titik', 9, 9, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:22', 1, 9),
(10, 'laptop', 'Display', 'Apakah masalah layar ini muncul secara tiba-tiba atau bertahap makin parah?', 'tiba-tiba,mendadak,bertahap,makin parah,perlahan', NULL, 10, 'choice', '[{\"label\": \"Tiba-tiba Muncul\", \"value\": \"tiba-tiba mendadak\"}, {\"label\": \"Makin Lama Makin Parah\", \"value\": \"bertahap makin parah perlahan\"}]', '2026-03-12 15:25:40', '2026-04-01 06:32:22', 1, 9),
(11, 'laptop', 'Keyboard', 'Apakah sudah dicoba pakai keyboard eksternal USB? Apakah keyboard eksternal berfungsi normal di laptop ini?', 'ya,iya,normal,bisa,fungsi,lancar', 25, 1, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:22', 1, 11),
(12, 'laptop', 'Keyboard', 'Apakah semua tombol keyboard mati total, atau hanya beberapa tombol tertentu yang tidak berfungsi?', 'semua,total,mati semua,semuanya', 21, 2, 'choice', '[{\"label\": \"Semua Tombol Mati Total\", \"value\": \"semua total mati semua semuanya\"}, {\"label\": \"Hanya Beberapa Tombol\", \"value\": \"hanya beberapa tidak semua\"}]', '2026-03-12 15:25:40', '2026-04-01 06:32:22', 1, 11),
(13, 'laptop', 'Keyboard', 'Jika hanya sebagian tombol yang bermasalah, tombol mana saja yang tidak berfungsi?', 'sebagian,beberapa,tertentu,beberapa tombol', 22, 3, 'choice', '[{\"label\": \"Tombol Angka / Numpad\", \"value\": \"sebagian beberapa tertentu angka\"}, {\"label\": \"Tombol Huruf\", \"value\": \"sebagian huruf beberapa tombol\"}, {\"label\": \"Beberapa Tombol Acak\", \"value\": \"beberapa tertentu acak\"}]', '2026-03-12 15:25:40', '2026-04-01 06:32:22', 1, 11),
(14, 'laptop', 'Keyboard', 'Apakah ada tombol yang mengetik karakter ganda/dobel saat ditekan sekali?', 'ya,iya,dobel,ganda,double,dua kali', 26, 4, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:22', 1, 11),
(15, 'laptop', 'Keyboard', 'Apakah tombol-tombol keyboard terasa lengket, nyangkut, atau susah ditekan?', 'ya,iya,lengket,sticky,nyangkut,keras,susah', 29, 5, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:22', 1, 11),
(16, 'laptop', 'Keyboard', 'Apakah ada keycap (tutup tombol) yang secara fisik lepas, copot, atau patah?', 'ya,iya,lepas,copot,patah,hilang', 28, 6, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:22', 1, 11),
(17, 'laptop', 'Keyboard', 'Apakah masalah keyboard ini mulai terjadi setelah update Windows atau update driver?', 'ya,iya,setelah update,habis update,update driver', 35, 7, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:22', 1, 11),
(18, 'laptop', 'Keyboard', 'Apakah keyboard mengetik sendiri tanpa ditekan (ghost typing)?', 'ya,iya,ketik sendiri,ghost,ngetik sendiri,jalan sendiri', 23, 8, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:22', 1, 11),
(19, 'laptop', 'Network', 'Apakah ikon WiFi masih terlihat di taskbar dan WiFi bisa di-scan untuk mencari jaringan?', 'tidak,ga ada,hilang,ga muncul,mati', 36, 1, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, 13),
(20, 'laptop', 'Network', 'Apakah perangkat lain (HP, tablet) bisa konek dan internetan normal di jaringan WiFi yang sama?', 'ya,iya,bisa,normal,lancar,hp bisa', 47, 2, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, 13),
(21, 'laptop', 'Network', 'Apakah WiFi di laptop sudah tersambung (connected) tapi tidak bisa akses internet?', 'ya,iya,connected,konek tapi,no internet,ga bisa browsing', 41, 3, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, 13),
(22, 'laptop', 'Network', 'Apakah sinyal WiFi hanya bisa ditangkap dari jarak sangat dekat dengan router?', 'ya,iya,dekat,lemah,pendek,deket aja', 40, 4, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, 13),
(23, 'laptop', 'Network', 'Apakah koneksi WiFi sering putus-putus atau disconnect sendiri?', 'ya,iya,putus,disconnect,sering putus,drop', 37, 5, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, 13),
(24, 'laptop', 'Network', 'Apakah Bluetooth juga tidak berfungsi atau tidak bisa mendeteksi perangkat?', 'ya,iya,bluetooth mati,bt ga bisa,tidak bisa', 39, 6, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, 13),
(25, 'laptop', 'Network', 'Apakah laptop terjebak di Airplane Mode dan tidak bisa dimatikan?', 'ya,iya,airplane,stuck,ga bisa matiin,flight mode', 46, 7, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, 13),
(26, 'laptop', 'Network', 'Apakah WiFi card/adapter terdeteksi di Device Manager atau BIOS?', 'tidak,ga ada,ga kedeteksi,hilang,not detected', 51, 8, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, 13),
(27, 'laptop', 'Peripheral', 'Apakah masalah yang dialami terkait touchpad/mouse? Apakah touchpad sama sekali tidak merespon?', 'ya,iya,touchpad mati,ga gerak,ga respon,tidak berfungsi', 54, 1, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, NULL),
(28, 'laptop', 'Peripheral', 'Apakah touchpad masih bisa digerakkan dan klik, tapi fungsi scroll tidak berfungsi?', 'ya,iya,scroll ga bisa,scroll mati,gerak bisa tapi scroll', 71, 2, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, NULL),
(29, 'laptop', 'Peripheral', 'Apakah gesture touchpad (pinch zoom, swipe tiga jari, dll) tidak berfungsi?', 'ya,iya,gesture ga bisa,pinch ga bisa,swipe ga jalan', 75, 3, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, NULL),
(30, 'laptop', 'Peripheral', 'Apakah port USB terlihat longgar, goyang, atau rusak secara fisik?', 'ya,iya,longgar,goyang,oblak,rusak fisik', 58, 4, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, NULL),
(31, 'laptop', 'Peripheral', 'Apakah semua port USB di laptop bermasalah, atau hanya satu/sebagian saja?', 'semua,semuanya,semua port,semua USB', 61, 5, 'choice', '[{\"label\": \"Semua Port USB Bermasalah\", \"value\": \"semua semuanya semua port semua USB\"}, {\"label\": \"Hanya Satu / Sebagian Port\", \"value\": \"hanya satu sebagian port\"}]', '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, NULL),
(32, 'laptop', 'Peripheral', 'Apakah ada perangkat USB (flashdisk, mouse, dll) yang masih bisa terdeteksi di laptop?', 'tidak,ga bisa,ga kedeteksi,semua ga bisa', 52, 6, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, NULL),
(33, 'laptop', 'Peripheral', 'Apakah port charger terasa longgar atau harus digoyang-goyang agar bisa mengisi daya?', 'ya,iya,longgar,goyang,harus digoyang,oblak', 57, 7, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, NULL),
(34, 'laptop', 'Peripheral', 'Apakah lampu indikator webcam menyala tapi tampilan kamera hitam saja?', 'ya,iya,nyala tapi hitam,led on tapi gelap,lampu nyala hitam', 64, 8, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, NULL),
(35, 'laptop', 'Peripheral', 'Apakah port HDMI secara fisik terlihat rusak, patah pin, atau longgar?', 'ya,iya,rusak,patah,longgar,pin patah', 59, 9, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, NULL),
(36, 'laptop', 'Peripheral', 'Apakah sensor fingerprint/sidik jari di laptop tidak berfungsi?', 'ya,iya,fingerprint mati,sidik jari ga bisa,ga fungsi', 68, 10, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, NULL),
(37, 'laptop', 'Power', 'Saat charger dipasang, apakah lampu indikator charging di laptop atau adaptor menyala?', 'tidak,ga nyala,mati,ga ada lampu', 81, 1, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, 10),
(38, 'laptop', 'Power', 'Apakah ada respon sama sekali saat tombol power ditekan (lampu, kipas berputar, suara)?', 'tidak,ga ada,ga respon,mati total,diam aja', 97, 2, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, 10),
(39, 'laptop', 'Power', 'Apakah laptop bisa menyala jika hanya menggunakan charger saja (baterai dilepas)?', 'ya,iya,bisa,nyala', 78, 3, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, 10),
(40, 'laptop', 'Power', 'Apakah laptop menyala sebentar (beberapa detik) lalu langsung mati lagi?', 'ya,iya,nyala bentar,mati lagi,sebentar,beberapa detik', 90, 4, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, 10),
(41, 'laptop', 'Power', 'Apakah baterai terlihat bengkak, kembung, atau membuat casing laptop terangkat?', 'ya,iya,bengkak,kembung,gembung,terangkat', 85, 5, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, 10),
(42, 'laptop', 'Power', 'Seberapa cepat baterai habis saat pemakaian ringan seperti browsing atau mengetik?', 'cepat,1 jam,2 jam,kurang,sebentar,habis cepat', 80, 6, 'choice', '[{\"label\": \"Sangat Cepat (< 2 jam)\", \"value\": \"cepat 1 jam kurang sebentar habis cepat\"}, {\"label\": \"Cukup Cepat (2-4 jam)\", \"value\": \"cepat 2 jam habis cepat\"}, {\"label\": \"Normal / Biasa\", \"value\": \"normal biasa\"}]', '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, 10),
(43, 'laptop', 'Power', 'Apakah persentase baterai loncat-loncat atau langsung drop dari angka tinggi ke rendah?', 'ya,iya,loncat,drop,langsung turun,ga akurat', 87, 7, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, 10),
(44, 'laptop', 'Power', 'Apakah ada bau hangus atau gosong dari laptop, terutama dari area port charger?', 'ya,iya,bau,hangus,gosong,terbakar', 94, 8, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, 10),
(45, 'laptop', 'Power', 'Apakah laptop sering mati tiba-tiba tanpa peringatan saat sedang digunakan?', 'ya,iya,mati tiba-tiba,shutdown sendiri,mati mendadak', 83, 9, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, 10),
(46, 'laptop', 'Power', 'Apakah masalah daya ini muncul setelah laptop pernah terjatuh atau terbentur?', 'ya,iya,jatuh,bentur,terjatuh,kebentur', 231, 10, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, 10),
(47, 'laptop', 'Software', 'Apakah laptop bisa masuk ke Windows, atau stuck/berhenti di logo saat booting?', 'stuck,berhenti,ga masuk,loading terus,logo terus', 108, 1, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, NULL),
(48, 'laptop', 'Software', 'Apakah muncul layar biru (Blue Screen/BSOD) dengan pesan error?', 'ya,iya,bsod,blue screen,layar biru,error', 99, 2, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, NULL),
(49, 'laptop', 'Software', 'Apakah laptop restart berulang-ulang terus-menerus (bootloop) tanpa bisa masuk Windows?', 'ya,iya,restart terus,bootloop,ulang-ulang,berulang', 110, 3, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, NULL),
(50, 'laptop', 'Software', 'Apakah masalah ini mulai terjadi setelah update Windows atau update driver?', 'ya,iya,setelah update,habis update,update windows', 111, 4, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, NULL),
(51, 'laptop', 'Software', 'Apakah sudah dicoba boot ke Safe Mode? Apakah masalah masih muncul di Safe Mode?', 'ya,iya,masih,tetap,safe mode juga', 235, 5, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, NULL),
(52, 'laptop', 'Software', 'Apakah ada file penting yang tiba-tiba hilang atau tidak bisa dibuka (corrupt)?', 'ya,iya,hilang,corrupt,ga bisa buka,rusak', 114, 6, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, NULL),
(53, 'laptop', 'Software', 'Apakah sering muncul popup iklan atau program mencurigakan yang tidak pernah diinstall?', 'ya,iya,popup,iklan,mencurigakan,ads,malware', 107, 7, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, NULL),
(54, 'laptop', 'Software', 'Apakah muncul pesan \"Operating System Not Found\" atau \"No Bootable Device\" saat dinyalakan?', 'ya,iya,os not found,no bootable,not found,ga ketemu os', 109, 8, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, NULL),
(55, 'laptop', 'Performance', 'Apakah laptop terasa lambat terutama saat membuka banyak aplikasi bersamaan?', 'ya,iya,lambat,lemot,banyak app,multitask', 122, 1, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, 12),
(56, 'laptop', 'Performance', 'Apakah laptop masih menggunakan HDD (hard disk) atau sudah pakai SSD?', 'hdd,hard disk,masih hdd,belum ssd', 123, 2, 'choice', '[{\"label\": \"Masih Pakai HDD / Hard Disk\", \"value\": \"hdd hard disk masih hdd belum ssd\"}, {\"label\": \"Sudah Pakai SSD\", \"value\": \"sudah ssd pakai ssd\"}]', '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, 12),
(57, 'laptop', 'Performance', 'Apakah di Task Manager terlihat Disk Usage mentok 100% terus-menerus?', 'ya,iya,100%,mentok,disk usage tinggi,penuh terus', 129, 3, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, 12),
(58, 'laptop', 'Performance', 'Apakah banyak program yang otomatis berjalan saat laptop pertama kali dinyalakan (startup)?', 'ya,iya,banyak,banyak startup,banyak program,otomatis jalan', 133, 4, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, 12),
(59, 'laptop', 'Performance', 'Apakah game atau aplikasi berat (editing, rendering) sering lag, patah-patah, atau FPS drop?', 'ya,iya,lag,patah,fps drop,stuttering,lambat', 126, 5, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, 12),
(60, 'laptop', 'Performance', 'Apakah performa laptop makin menurun setelah dipakai beberapa jam (awalnya lancar lalu jadi lambat)?', 'ya,iya,makin lambat,turun,lama-lama,setelah lama', 134, 6, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, 12),
(61, 'laptop', 'Performance', 'Apakah kipas laptop berputar sangat kencang dan berisik saat laptop terasa lambat?', 'ya,iya,kipas kencang,berisik,fan keras,bunyi', 125, 7, 'yesno', NULL, '2026-03-12 15:25:40', '2026-04-01 06:32:23', 1, 12),
(62, 'laptop', 'Performance', 'Apakah di Task Manager terlihat penggunaan RAM (Memory) sangat tinggi?', 'ya,iya,ram tinggi,memory tinggi,ram penuh,hampir full', 120, 8, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, 12),
(63, 'laptop', 'Thermal', 'Apakah kipas/fan laptop masih berputar saat laptop dinyalakan?', 'tidak,ga putar,mati,ga jalan,diam,ga bunyi', 136, 1, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, 15),
(64, 'laptop', 'Thermal', 'Apakah laptop terasa panas meskipun hanya dipakai browsing ringan atau idle (tidak menjalankan apa-apa)?', 'ya,iya,panas,panas idle,panas padahal,ga ngapa-ngapain', 139, 2, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, 15),
(65, 'laptop', 'Thermal', 'Apakah laptop sudah pernah dibersihkan bagian dalamnya (debu di kipas dan ventilasi)?', 'belum,belum pernah,tidak pernah,lama sekali,ga pernah', 141, 3, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, 15),
(66, 'laptop', 'Thermal', 'Apakah thermal paste pada prosesor/GPU sudah pernah diganti?', 'belum,belum pernah,tidak pernah,ga tau,ga pernah', 140, 4, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, 15),
(67, 'laptop', 'Thermal', 'Apakah kipas mengeluarkan bunyi kasar, grinding, atau gesekan saat berputar?', 'ya,iya,kasar,grinding,gesek,bunyi aneh,berisik', 142, 5, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, 15),
(68, 'laptop', 'Thermal', 'Apakah laptop mati sendiri (shutdown otomatis) setelah dipakai cukup lama dan terasa sangat panas?', 'ya,iya,mati sendiri,shutdown,overheat,panas mati', 138, 6, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, 15),
(69, 'laptop', 'Thermal', 'Apakah ada bau hangus atau gosong yang keluar dari area ventilasi/lubang udara laptop?', 'ya,iya,bau,hangus,gosong,terbakar,bau aneh', 146, 7, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, 15),
(70, 'laptop', 'Audio', 'Apakah suara tidak keluar sama sekali dari speaker laptop (sudah cek volume tidak mute)?', 'ya,iya,ga keluar,mati,ga ada suara,silent', 149, 1, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, 14),
(71, 'laptop', 'Audio', 'Apakah sudah dicoba pakai headphone/headset di perangkat lain? Apakah headphone berfungsi normal?', 'ya,iya,normal,bisa,berfungsi', 151, 2, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, 14),
(72, 'laptop', 'Audio', 'Apakah suara hanya keluar dari satu speaker saja (kiri atau kanan)?', 'ya,iya,satu speaker,sebelah,kiri aja,kanan aja', 153, 3, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, 14),
(73, 'laptop', 'Audio', 'Apakah suara speaker pecah, kresek, atau distorsi terutama saat volume dinaikkan?', 'ya,iya,pecah,kresek,distorsi,volume tinggi', 150, 4, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, 14),
(74, 'laptop', 'Audio', 'Apakah jack audio (colokan headphone) harus digoyang atau ditekan di posisi tertentu agar suara keluar?', 'ya,iya,goyang,tekan,posisi tertentu,digoyang', 163, 5, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, 14),
(75, 'laptop', 'Audio', 'Apakah microphone laptop tidak berfungsi (tidak bisa merekam suara atau tidak terdeteksi di aplikasi)?', 'ya,iya,mic mati,mic rusak,ga bisa rekam,mic ga fungsi', 152, 6, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, 14),
(76, 'laptop', 'Audio', 'Apakah audio device (speaker/sound card) terdeteksi di Device Manager?', 'tidak,ga ada,ga terdeteksi,hilang,not detected', 161, 7, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, 14),
(77, 'laptop', 'Audio', 'Apakah suara tiba-tiba mati saat sedang digunakan (awalnya normal lalu hilang)?', 'ya,iya,tiba-tiba mati,hilang,putus,mendadak', 157, 8, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, 14),
(78, 'laptop', 'Storage', 'Apakah terdengar bunyi klik-klik atau suara aneh yang berulang dari area hard drive laptop?', 'ya,iya,klik,bunyi,klik-klik,suara aneh', 168, 1, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(79, 'laptop', 'Storage', 'Apakah hard drive atau SSD masih terdeteksi di BIOS saat laptop dinyalakan?', 'tidak,ga kedeteksi,hilang,ga muncul,not detected', 167, 2, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(80, 'laptop', 'Storage', 'Apakah pernah muncul pesan peringatan SMART error, bad sector, atau \"disk failing\"?', 'ya,iya,smart,bad sector,warning,failing,error disk', 171, 3, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(81, 'laptop', 'Storage', 'Apakah disk kadang terdeteksi kadang hilang (tidak konsisten)?', 'ya,iya,kadang hilang,kadang muncul,on off,ga konsisten', 178, 4, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(82, 'laptop', 'Storage', 'Apakah proses copy atau pindah file terasa sangat lambat dibanding biasanya?', 'ya,iya,lambat,lama,copy lambat,transfer lambat', 172, 5, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(83, 'laptop', 'Storage', 'Apakah ada partisi (drive D, E, dll) yang tiba-tiba hilang atau tidak muncul di File Explorer?', 'ya,iya,partisi hilang,drive hilang,ga muncul', 176, 6, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(84, 'laptop', 'Storage', 'Apakah SSD menjadi read-only (tidak bisa menyimpan/menulis file baru)?', 'ya,iya,read only,ga bisa nulis,ga bisa save,ga bisa simpan', 174, 7, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(85, 'laptop', 'Storage', 'Apakah proses booting laptop terasa jauh lebih lama dari biasanya?', 'ya,iya,lama,booting lama,loading lama,startup lama', 165, 8, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(86, 'laptop', 'Physical', 'Apakah engsel laptop terasa longgar, patah, atau susah saat dibuka/ditutup?', 'ya,iya,longgar,patah,susah,engsel rusak,keras', 184, 1, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(87, 'laptop', 'Physical', 'Apakah ada retakan atau pecah pada casing/body laptop?', 'ya,iya,retak,pecah,patah,crack', 183, 2, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(88, 'laptop', 'Physical', 'Apakah layar laptop goyang atau tidak stabil saat disentuh atau laptop digeser?', 'ya,iya,goyang,goyah,ga stabil,tidak stabil', 185, 3, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(89, 'laptop', 'Physical', 'Apakah ada bagian body laptop yang terangkat atau naik karena tekanan dari engsel?', 'ya,iya,terangkat,angkat,terangkat casing,naik', 197, 4, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(90, 'laptop', 'Physical', 'Apakah bezel (frame/bingkai) layar lepas, retak, atau tidak menempel dengan baik?', 'ya,iya,bezel lepas,frame lepas,retak,copot', 192, 5, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(91, 'laptop', 'Physical', 'Apakah bottom case (cover bawah) laptop rusak, retak, atau tidak tertutup rapat?', 'ya,iya,bottom rusak,cover bawah,retak,terbuka', 193, 6, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(92, 'laptop', 'Physical', 'Apakah engsel mengeluarkan bunyi gesekan atau bunyi krek saat layar dibuka/ditutup?', 'ya,iya,bunyi,krek,gesekan,berisik,krek-krek', 196, 7, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(93, 'laptop', 'Water Damage', 'Apakah laptop pernah terkena air, tumpahan minuman, atau cairan lainnya?', 'ya,iya,kena air,tumpahan,basah,kecipratan,ketumpahan', 201, 1, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(94, 'laptop', 'Water Damage', 'Setelah terkena air/cairan, apakah laptop langsung dimatikan dan dibalik untuk dikeringkan?', 'tidak,ga langsung,masih dipakai,tetap nyala,lupa', NULL, 2, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(95, 'laptop', 'Water Damage', 'Apakah laptop mati total dan tidak bisa dinyalakan sama sekali setelah terkena air?', 'ya,iya,mati total,ga bisa nyala,mati,off', 203, 3, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(96, 'laptop', 'Water Damage', 'Apakah keyboard bermasalah (error, beberapa tombol mati) setelah kejadian terkena cairan?', 'ya,iya,keyboard error,tombol mati,ga bisa ketik', 202, 4, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(97, 'laptop', 'Water Damage', 'Apakah terlihat tanda-tanda korosi atau karat (warna hijau/putih) pada komponen yang terlihat?', 'ya,iya,korosi,karat,hijau,putih,oksidasi', 205, 5, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(98, 'laptop', 'Water Damage', 'Apakah layar terlihat berembun dari dalam atau ada bercak/noda cairan di balik layar?', 'ya,iya,embun,bercak,noda,kabut,berembun', 204, 6, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(99, 'laptop', 'Water Damage', 'Apakah port-port laptop (USB, charger, HDMI) terlihat berkorosi atau berkarat?', 'ya,iya,port korosi,karat,kotor,berubah warna', 206, 7, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(100, 'laptop', 'Water Damage', 'Apakah laptop masih bisa menyala tapi hanya sebagian fungsi yang bekerja (misal layar nyala tapi keyboard mati)?', 'ya,iya,nyala sebagian,bisa tapi,sebagian fungsi', 208, 8, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(101, 'laptop', 'Hardware', 'Apakah muncul artifacts berupa kotak-kotak warna, garis acak, atau tampilan yang kacau di layar?', 'ya,iya,artifact,kotak warna,garis acak,kacau,glitch', 219, 1, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(102, 'laptop', 'Hardware', 'Apakah laptop menyala (lampu LED hidup, kipas berputar) tapi layar sama sekali tidak menampilkan apa-apa?', 'ya,iya,no display,ga ada tampilan,layar mati,hitam', 217, 2, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(103, 'laptop', 'Hardware', 'Apakah ada bau komponen terbakar atau bau gosong yang tercium dari laptop?', 'ya,iya,bau,terbakar,hangus,gosong,bau komponen', 223, 3, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(104, 'laptop', 'Hardware', 'Apakah pengaturan BIOS selalu reset sendiri setiap kali laptop dimatikan (misalnya tanggal/jam selalu salah)?', 'ya,iya,reset,bios reset,tanggal salah,jam salah', 222, 4, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(105, 'laptop', 'Hardware', 'Apakah ada slot RAM yang tidak berfungsi atau RAM hanya terbaca sebagian dari kapasitas total?', 'ya,iya,slot mati,ram sebagian,ga terbaca,kurang', 220, 5, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(106, 'laptop', 'Hardware', 'Apakah terdengar bunyi beep berulang saat laptop dinyalakan (sebelum masuk tampilan)?', 'ya,iya,beep,bunyi,bip,beep code', 221, 6, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(107, 'laptop', 'Hardware', 'Apakah semua port (USB, HDMI, WiFi, Bluetooth) mati bersamaan secara tiba-tiba?', 'ya,iya,semua mati,sekaligus,bersamaan,semua port', 230, 7, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(108, 'laptop', 'Hardware', 'Apakah laptop sering restart sendiri saat menjalankan tugas berat seperti game atau rendering?', 'ya,iya,restart,berat,game,rendering,shutdown saat berat', 225, 8, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(109, 'laptop', 'Differential', 'Apakah masalah ini terjadi setelah laptop terjatuh atau terbentur benda keras?', 'ya,iya,jatuh,bentur,terjatuh,kebentur', 231, 1, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(110, 'laptop', 'Differential', 'Apakah masalah mulai terjadi setelah menginstall software, driver, atau program baru?', 'ya,iya,install,software baru,driver baru,program', 232, 2, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(111, 'laptop', 'Differential', 'Apakah masalah ini muncul secara tiba-tiba tanpa sebab yang jelas?', 'ya,iya,tiba-tiba,mendadak,tau-tau,tanpa sebab', 234, 3, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(112, 'laptop', 'Differential', 'Apakah masalah ini muncul bertahap dan makin lama makin parah?', 'ya,iya,bertahap,makin parah,perlahan,gradual', 233, 4, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(113, 'laptop', 'Differential', 'Apakah masalah masih tetap muncul saat laptop dijalankan di Safe Mode?', 'ya,iya,masih,tetap,safe mode juga,masih error', 235, 5, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(114, 'laptop', 'Differential', 'Apakah masalah hilang (laptop normal) saat dijalankan di Safe Mode?', 'ya,iya,normal,hilang,safe mode ok,bisa', 236, 6, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(115, 'laptop', 'Differential', 'Apakah masalah ini mulai terjadi setelah update Windows terakhir?', 'ya,iya,setelah update,habis update,update windows', 237, 7, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(116, 'laptop', 'Differential', 'Apakah masalah muncul atau bertambah parah terutama saat laptop sudah panas?', 'ya,iya,panas,overheat,saat panas,panas bertambah', 238, 8, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(117, 'laptop', 'Differential', 'Apakah laptop pernah terkena air atau tumpahan cairan sebelum masalah ini muncul?', 'ya,iya,kena air,basah,tumpahan,cairan', 201, 9, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(118, 'laptop', 'Differential', 'Apakah masalah hanya terjadi saat laptop menggunakan baterai (tanpa charger terhubung)?', 'ya,iya,baterai saja,tanpa charger,lepas charger', 239, 10, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(119, 'laptop', 'Differential', 'Apakah masalah hanya terjadi saat charger terhubung ke laptop?', 'ya,iya,saat charger,pakai charger,charger colok', 240, 11, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(120, 'laptop', 'Differential', 'Jika dicoba dengan monitor eksternal, apakah tampilan di monitor eksternal normal?', 'ya,iya,normal,bisa,ext monitor ok', 243, 12, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(121, 'laptop', 'Differential', 'Apakah monitor eksternal juga menampilkan masalah yang sama dengan layar laptop?', 'ya,iya,sama,ext juga,monitor juga,bermasalah juga', 244, 13, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(122, 'laptop', 'Differential', 'Jika dicoba boot dengan OS lain (misal Linux USB), apakah masalah masih muncul?', 'ya,iya,masih,tetap error,linux juga', 241, 14, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(123, 'laptop', 'Differential', 'Jika dicoba boot dengan OS lain (misal Linux USB), apakah laptop berfungsi normal?', 'ya,iya,normal,bisa,os lain ok,linux normal', 242, 15, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(124, 'laptop', 'Differential', 'Apakah masalah ini muncul setelah mengganti atau upgrade hardware (RAM, SSD, WiFi card, dll)?', 'ya,iya,setelah upgrade,ganti ram,ganti ssd,habis ganti', 247, 16, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(125, 'laptop', 'Differential', 'Apakah masalah hanya muncul saat layar dibuka pada posisi/sudut tertentu?', 'ya,iya,posisi tertentu,sudut tertentu,posisi,angle', 248, 17, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(126, 'laptop', 'Differential', 'Apakah masalah muncul atau bertambah parah saat laptop digoyang atau digerakkan?', 'ya,iya,digoyang,digerakkan,gerakan,goyang', 249, 18, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(127, 'laptop', 'Differential', 'Apakah sudah pernah mencoba reset BIOS ke pengaturan default? Apakah masalah masih ada?', 'sudah,masih sama,ga ngaruh,tetap,masih error', 250, 19, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(128, 'laptop', 'Differential', 'Apakah laptop sudah digunakan cukup lama (lebih dari 3 tahun)?', 'ya,iya,lama,tua,lebih 3 tahun,sudah lama,bertahun', 233, 20, 'yesno', NULL, '2026-03-12 15:25:41', '2026-04-01 06:32:23', 1, NULL),
(129, 'pc', 'PSU', 'Apakah ada bau terbakar atau hangus dari area belakang PC?', 'ya, bau, hangus, gosong, terbakar', 255, 1, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 16),
(130, 'pc', 'PSU', 'Apakah kipas PSU masih berputar saat PC dinyalakan?', 'tidak, mati, diam, tidak berputar', 254, 2, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 16),
(131, 'pc', 'PSU', 'Apakah PC mati hanya saat menjalankan game atau aplikasi berat?', 'ya, gaming, render, load berat, full load', 258, 3, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 16),
(132, 'pc', 'PSU', 'Apakah watt PSU diketahui dan sudah cukup untuk semua komponen?', 'tidak cukup, tidak tahu, kecil, kurang watt', 265, 4, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 16),
(133, 'pc', 'PSU', 'Apakah semua kabel power internal sudah terpasang kencang?', 'tidak, ada yang longgar, belum cek', 259, 5, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 16),
(134, 'pc', 'PSU', 'Apakah PC nyala jika salah satu komponen dilepas?', 'ya, nyala tanpa gpu, menyala tanpa yang ini', 270, 6, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 16),
(135, 'pc', 'PSU', 'Apakah PC mati tiba-tiba lalu tidak bisa dinyalakan kembali?', 'ya, mati total, tidak bisa nyala lagi', 252, 7, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 16),
(136, 'pc', 'PSU', 'Apakah ada listrik mati mendadak sebelum PC bermasalah?', 'ya, listrik mati, power failure, ups trip', 263, 8, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 16),
(137, 'pc', 'Motherboard', 'Apakah ada debug LED atau Q-Code yang menyala di motherboard?', 'ya, led merah, led kuning, q code, post code', 273, 1, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(138, 'pc', 'Motherboard', 'Apakah ada bunyi beep dari speaker internal saat dinyalakan?', 'ya, beep, bunyi, berbunyi', 272, 2, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(139, 'pc', 'Motherboard', 'Apakah tanggal dan waktu PC selalu reset setiap kali dinyalakan?', 'ya, tanggal salah, reset terus, 2000 atau 1980', 274, 3, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(140, 'pc', 'Motherboard', 'Apakah ada bau terbakar dari motherboard atau dalam casing?', 'ya, bau, terbakar, hangus, gosong', 278, 4, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(141, 'pc', 'Motherboard', 'Apakah ada kapasitor yang kembung di motherboard?', 'ya, kembung, bengkak, bulat, menonjol', 279, 5, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(142, 'pc', 'Motherboard', 'Apakah BIOS pernah di-flash atau diupdate sebelum bermasalah?', 'ya, setelah flash, habis update bios, gagal update', 284, 6, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(143, 'pc', 'Motherboard', 'Apakah semua port USB/LAN/audio di panel belakang bermasalah?', 'ya, semuanya, semua belakang, rear panel semua', 276, 7, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(144, 'pc', 'Motherboard', 'Apakah GPU atau RAM terdeteksi di BIOS?', 'tidak, tidak terdeteksi, hilang dari bios', 271, 8, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(145, 'pc', 'CPU', 'Berapa suhu CPU saat idle menurut HWiNFO / HWMonitor?', 'lebih 60, 70an, 80, panas, tinggi', 302, 1, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(146, 'pc', 'CPU', 'Apakah fan/kipas cooler CPU masih berputar?', 'tidak, mati, diam, tidak jalan', 300, 2, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(147, 'pc', 'CPU', 'Apakah thermal paste sudah pernah diganti?', 'belum, tidak pernah, lama, tahun lalu', 298, 3, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(148, 'pc', 'CPU', 'Apakah cooler CPU terpasang kencang dan tidak goyang?', 'tidak, goyang, longgar, miring', 299, 4, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(149, 'pc', 'CPU', 'Apakah ada pin bengkok di socket LGA motherboard?', 'ya, bengkok, bent, patah, rusak', 301, 5, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(150, 'pc', 'CPU', 'Apakah PC menggunakan overclock CPU?', 'ya, oc, overclock, manual voltage', 297, 6, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(151, 'pc', 'CPU', 'Apakah CPU terdeteksi di BIOS/UEFI?', 'tidak, tidak terdeteksi, hilang, kosong', 294, 7, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(152, 'pc', 'CPU', 'Apakah cooler yang digunakan support socket yang dipakai?', 'tidak cocok, tidak support, beda socket, mounting salah', 306, 8, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(153, 'pc', 'RAM DIMM', 'Apakah sudah menjalankan Memtest86 untuk cek memori?', 'sudah, ada error, fail, memtest error', 315, 1, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(154, 'pc', 'RAM DIMM', 'Apakah RAM sudah dipasang di slot yang benar untuk dual channel?', 'tidak, satu slot, slot salah, tidak tahu', 320, 2, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(155, 'pc', 'RAM DIMM', 'Apakah XMP atau EXPO sudah diaktifkan di BIOS?', 'belum, tidak aktif, belum nyalakan xmp', 316, 3, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(156, 'pc', 'RAM DIMM', 'Apakah kontak/pin DIMM terlihat kusam atau kotor?', 'ya, kusam, kotor, kecoklatan, oksidasi', 321, 4, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(157, 'pc', 'RAM DIMM', 'Apakah PC bisa POST jika menggunakan satu modul RAM saja?', 'ya, bisa, posting, satu dimm jalan', 328, 5, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(158, 'pc', 'RAM DIMM', 'Apakah menggunakan dua kit RAM berbeda brand/speed?', 'ya, beda brand, beda speed, mixing', 324, 6, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(159, 'pc', 'RAM DIMM', 'Apakah PC BSOD dengan kode memory management?', 'ya, memory management, page fault, bsod ram', 312, 7, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(160, 'pc', 'RAM DIMM', 'Apakah kecepatan RAM sudah sesuai di CPU-Z atau Task Manager?', 'tidak, lebih pelan, tidak sesuai spec', 316, 8, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(161, 'pc', 'GPU Diskrit', 'Apakah GPU terdeteksi di Device Manager Windows?', 'tidak, tidak ada, hilang, unknown device', 329, 1, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 19),
(162, 'pc', 'GPU Diskrit', 'Apakah ada artefak atau glitch visual di layar saat gaming?', 'ya, artefak, kotak, glitch, visual aneh', 330, 2, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 19),
(163, 'pc', 'GPU Diskrit', 'Apakah semua fan GPU masih berputar?', 'tidak, ada yang mati, diam, tidak berputar', 333, 3, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 19),
(164, 'pc', 'GPU Diskrit', 'Berapa suhu GPU saat gaming (MSI Afterburner / HWiNFO)?', 'lebih 90, 90an, sangat panas, overheat', 332, 4, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 19),
(165, 'pc', 'GPU Diskrit', 'Apakah konektor power PCIe (8-pin / 12-pin) sudah terpasang?', 'tidak, lepas, belum pasang, longgar', 337, 5, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 19),
(166, 'pc', 'GPU Diskrit', 'Apakah driver GPU sudah di-clean install menggunakan DDU?', 'belum, tidak, belum pakai ddu', 335, 6, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 19),
(167, 'pc', 'GPU Diskrit', 'Apakah thermal paste GPU sudah lama tidak diganti?', 'ya, lama, belum pernah, tidak tahu kapan', 338, 7, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 19),
(168, 'pc', 'GPU Diskrit', 'Apakah GPU berfungsi normal di slot PCIe lain atau PC lain?', 'belum dicoba, tidak diuji, ya bisa di pc lain', 339, 8, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 19),
(169, 'pc', 'Storage', 'Apakah terdengar bunyi klik-klik dari area HDD?', 'ya, klik, bunyi, clicking, grinding', 350, 1, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(170, 'pc', 'Storage', 'Apakah CrystalDiskInfo menampilkan warning atau bad health?', 'ya, warning, caution, bad, merah, reallocated', 352, 2, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(171, 'pc', 'Storage', 'Apakah storage HDD (3.5\") atau SSD?', 'ssd, solid state, tidak ada bunyi', 358, 3, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(172, 'pc', 'Storage', 'Apakah menggunakan NVMe M.2?', 'ya, nvme, m.2, pcie ssd', 355, 4, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(173, 'pc', 'Storage', 'Apakah kabel SATA data sudah dicoba diganti?', 'belum, tidak, belum ganti kabel', 361, 5, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(174, 'pc', 'Storage', 'Apakah ada partisi yang tiba-tiba hilang?', 'ya, hilang, tidak ada, lenyap partisi', 357, 6, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(175, 'pc', 'Storage', 'Apakah drive terdeteksi intermittent (kadang muncul kadang tidak)?', 'ya, kadang muncul, tidak konsisten', 359, 7, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(176, 'pc', 'Storage', 'Apakah NVMe SSD memiliki heatsink terpasang?', 'tidak, tidak ada heatsink, tanpa pendingin', 365, 8, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(177, 'pc', 'Casing', 'Apakah tombol power tidak merespon sama sekali?', 'ya, tidak respon, tidak fungsi, mati', 369, 1, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(178, 'pc', 'Casing', 'Apakah port USB di panel depan casing tidak berfungsi?', 'ya, usb depan mati, front panel usb', 371, 2, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(179, 'pc', 'Casing', 'Apakah kabel front panel sudah terpasang di header yang benar?', 'tidak yakin, salah pasang, belum cek', 375, 3, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(180, 'pc', 'Casing', 'Apakah dust filter / saringan debu sangat kotor?', 'ya, kotor, tersumbat, debu banyak', 377, 4, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(181, 'pc', 'Casing', 'Apakah casing terasa nyetrum saat disentuh?', 'ya, kena setrum, kesemutan, electric', 383, 5, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(182, 'pc', 'Casing', 'Apakah PC menggunakan speaker internal untuk beep?', 'tidak, tidak ada speaker, belum pasang', 380, 6, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(183, 'pc', 'Thermal', 'Apakah debu menumpuk di heatsink CPU atau fan?', 'ya, debu, kotor, penuh debu', 388, 1, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 18),
(184, 'pc', 'Thermal', 'Apakah semua fan casing masih berputar?', 'tidak, ada yang mati, beberapa diam', 385, 2, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 18),
(185, 'pc', 'Thermal', 'Apakah PC menggunakan AIO liquid cooler?', 'ya, aio, liquid cooler, watercooling', 390, 3, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 18),
(186, 'pc', 'Thermal', 'Apakah ada tanda kebocoran cairan di dalam casing?', 'ya, bocor, ada cairan, coolant tumpah', 391, 4, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 18),
(187, 'pc', 'Thermal', 'Apakah PC menggunakan custom water cooling loop?', 'ya, custom loop, reservoir, hard tube', 392, 5, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 18),
(188, 'pc', 'Thermal', 'Apakah konfigurasi fan casing sudah optimal (positive pressure)?', 'belum, tidak tahu, asal pasang, negatif', 395, 6, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 18),
(189, 'pc', 'Thermal', 'Apakah PC mati sendiri saat suhu tinggi?', 'ya, mati panas, thermal shutdown, mati kepanasan', 387, 7, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 18),
(190, 'pc', 'Audio', 'Apakah audio device terdeteksi di Device Manager?', 'tidak, hilang, tidak terdeteksi', 401, 1, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 21),
(191, 'pc', 'Audio', 'Apakah menggunakan jack audio depan atau belakang?', 'depan, front panel, front audio', 403, 2, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 21),
(192, 'pc', 'Audio', 'Apakah masalah audio muncul setelah update Windows?', 'ya, setelah update, habis update', 406, 3, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 21),
(193, 'pc', 'Audio', 'Apakah menggunakan sound card PCIe tambahan?', 'ya, sound card, creative, asus xonar', 407, 4, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 21),
(194, 'pc', 'Audio', 'Apakah ada dengung atau hum terus-menerus dari speaker?', 'ya, dengung, hum, noise, terus-menerus', 408, 5, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 21),
(195, 'pc', 'Audio', 'Apakah audio hanya keluar dari satu sisi?', 'ya, mono, satu sisi, kiri saja, kanan saja', 405, 6, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 21),
(196, 'pc', 'Network', 'Apakah menggunakan LAN kabel atau WiFi card PCIe?', 'lan, kabel, ethernet', 414, 1, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 20),
(197, 'pc', 'Network', 'Apakah driver network terdeteksi di Device Manager?', 'tidak, hilang, tidak ada', 416, 2, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 20),
(198, 'pc', 'Network', 'Apakah port LAN terlihat rusak atau pin bengkok?', 'ya, rusak, bengkok, patah', 417, 3, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 20),
(199, 'pc', 'Network', 'Apakah WiFi card PCIe dipasang antena?', 'tidak, tanpa antena, antena tidak ada', 421, 4, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 20),
(200, 'pc', 'Network', 'Apakah perangkat lain di jaringan bisa internet normal?', 'ya, normal, bisa, hanya pc ini masalah', 414, 5, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 20),
(201, 'pc', 'Network', 'Apakah sudah coba ganti kabel LAN?', 'belum, tidak, belum coba ganti', 418, 6, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 20),
(202, 'pc', 'Peripheral', 'Apakah semua port USB mati atau hanya sebagian?', 'semua, semuanya, seluruh port', 433, 1, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(203, 'pc', 'Peripheral', 'Apakah port USB yang bermasalah di panel depan atau belakang?', 'depan, front, panel depan casing', 429, 2, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(204, 'pc', 'Peripheral', 'Apakah kabel header USB 3.0 (19-pin) sudah terpasang ke motherboard?', 'longgar, lepas, belum pasang, tidak yakin', 441, 3, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(205, 'pc', 'Peripheral', 'Apakah perangkat yang dihubungkan berfungsi di PC lain?', 'tidak, rusak juga di pc lain, perangkat rusak', 430, 4, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(206, 'pc', 'Peripheral', 'Apakah USB 3.0 berjalan dengan kecepatan USB 2.0?', 'ya, lambat, transfer pelan, kayak usb 2', 434, 5, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(207, 'pc', 'Peripheral', 'Apakah USB hub besar yang terhubung tidak mendapat daya?', 'ya, hub tidak jalan, hub power kurang', 440, 6, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(208, 'pc', 'Software', 'Apakah BSOD menampilkan kode error tertentu (stop code)?', 'ya, ada kode, stop code, apa kodenya', 443, 1, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 17),
(209, 'pc', 'Software', 'Apakah antivirus mendeteksi ancaman atau malware?', 'ya, ada virus, terdeteksi, warning, malware', 445, 2, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 17),
(210, 'pc', 'Software', 'Apakah Windows bisa masuk ke Safe Mode?', 'ya, bisa, berhasil safe mode', 446, 3, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 17),
(211, 'pc', 'Software', 'Apakah hasil SFC /scannow menunjukkan file corrupt?', 'ya, ada error, corrupt, tidak bisa diperbaiki', 451, 4, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 17),
(212, 'pc', 'Software', 'Apakah drive menunjukkan RAW di Disk Management?', 'ya, raw, tidak terbaca, unknown', 454, 5, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 17),
(213, 'pc', 'Software', 'Apakah banyak program auto-start saat Windows menyala?', 'ya, banyak, startup panjang, task manager penuh', 447, 6, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 17),
(214, 'pc', 'Software', 'Apakah masalah muncul setelah update Windows atau driver?', 'ya, setelah update, habis update', 449, 7, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 17),
(215, 'pc', 'Software', 'Apakah Windows masuk ke repair loop terus menerus?', 'ya, repair terus, loop, tidak bisa masuk windows', 453, 8, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, 17),
(216, 'pc', 'Overclocking', 'Apakah PC menggunakan overclock CPU (manual atau auto OC)?', 'ya, oc, overclock, manual voltage, multipler dinaikkan', 461, 1, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(217, 'pc', 'Overclocking', 'Apakah XMP atau EXPO sudah diaktifkan di BIOS?', 'ya, xmp aktif, expo aktif, sudah enable', 462, 2, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(218, 'pc', 'Overclocking', 'Apakah GPU menggunakan overclock (MSI Afterburner / EVGA Precision)?', 'ya, oc gpu, overclock vga, afterburner oc', 463, 3, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(219, 'pc', 'Overclocking', 'Apakah PC tidak bisa boot setelah mengubah setting BIOS OC?', 'ya, tidak bisa boot, brick, gagal setelah oc bios', 469, 4, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(220, 'pc', 'Overclocking', 'Berapa vcore CPU yang digunakan saat di-overclock?', 'lebih 1.35, 1.4, tinggi, tidak tahu', 466, 5, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(221, 'pc', 'Overclocking', 'Apakah suhu CPU sudah sangat tinggi saat di-overclock?', 'ya, panas, di atas 90, throttle', 468, 6, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL);
INSERT INTO `category_questions` (`id`, `device_type`, `category`, `question`, `expected_keyword`, `leads_to_symptom_id`, `order`, `question_type`, `options`, `created_at`, `updated_at`, `device_type_id`, `device_component_id`) VALUES
(222, 'pc', 'Overclocking', 'Apakah BIOS sudah di-clear CMOS setelah OC bermasalah?', 'belum, tidak, belum clear cmos', 469, 7, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(223, 'pc', 'Overclocking', 'Apakah memory OC menyebabkan instabilitas?', 'ya, xmp crash, memtest fail setelah oc ram', 467, 8, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(224, 'pc', 'Differential', 'Apakah masalah terjadi setelah memasang komponen baru (GPU/CPU/RAM)?', 'ya, setelah upgrade, habis pasang, komponen baru', 476, 1, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(225, 'pc', 'Differential', 'Apakah masalah tetap ada setelah reinstall Windows?', 'ya, masih ada, hardware problem, reinstall ga ngaruh', 484, 2, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(226, 'pc', 'Differential', 'Apakah masalah muncul di semua OS termasuk Linux live USB?', 'ya, linux juga, semua os, bukan windows saja', 485, 3, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(227, 'pc', 'Differential', 'Apakah masalah hanya saat beban CPU/GPU tinggi?', 'ya, gaming, rendering, encoding, full load', 481, 4, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(228, 'pc', 'Differential', 'Apakah BIOS / UEFI menampilkan error atau debug LED menyala?', 'ya, bios error, led merah, komponen tidak terdeteksi', 489, 5, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(229, 'pc', 'Differential', 'Apakah stress test (Prime95/FurMark/Memtest) menunjukkan error?', 'ya, crash, error, gagal, memtest fail', 490, 6, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(230, 'pc', 'Differential', 'Apakah listrik di lokasi PC stabil? Apakah menggunakan UPS?', 'tidak, tidak pakai ups, langsung pln, sering mati listrik', 504, 7, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(231, 'pc', 'Differential', 'Apakah PC menggunakan overclock (CPU/GPU/RAM)?', 'ya, oc, overclock, xmp agresif, manual voltage', 486, 8, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(232, 'pc', 'Differential', 'Apakah BSOD menampilkan kode WHEA_UNCORRECTABLE_ERROR?', 'ya, whea, machine check, hardware error', 501, 9, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(233, 'pc', 'Differential', 'Apakah PC ini baru pertama kali dirakit (first build)?', 'ya, baru rakit, first build, baru dirakit', 500, 10, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(234, 'pc', 'Differential', 'Apakah masalah hanya pada satu komponen / slot tertentu?', 'ya, hanya ini, satu komponen, slot tertentu', 487, 11, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(235, 'pc', 'Differential', 'Apakah masalah terjadi setelah listrik mati mendadak?', 'ya, mati listrik, power failure, ups trip', 480, 12, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(236, 'pc', 'Differential', 'Apakah PC stabil di Safe Mode tapi crash di mode normal?', 'ya, safe mode aman, normal crash, hanya safe mode ok', 494, 13, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(237, 'pc', 'Differential', 'Apakah komponen baru yang bermasalah sudah diuji di PC lain?', 'belum, tidak, baru langsung dipasang', 491, 14, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(238, 'pc', 'Differential', 'Apakah masalah terjadi setelah PC jatuh atau dipindahkan?', 'ya, jatuh, terbentur, setelah pindah, diangkut', 479, 15, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(239, 'pc', 'Differential', 'Apakah BSOD kode error selalu sama?', 'ya, kode sama, berulang, stop code tetap', 496, 16, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(240, 'pc', 'Differential', 'Apakah sudah mencoba swap komponen satu per satu?', 'belum, tidak, belum swap test', 488, 17, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(241, 'pc', 'Differential', 'Apakah masalah muncul setelah ganti thermal paste?', 'ya, setelah ganti pasta, habis servis cooler', 495, 18, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(242, 'pc', 'Differential', 'Apakah semua komponen PC adalah baru dan first build gagal POST?', 'ya, semua baru, baru dirakit, tidak mau post', 505, 19, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(243, 'pc', 'Differential', 'Apakah PC nyala sebentar lalu langsung mati tanpa POST?', 'ya, nyala sebentar, segera mati, no post', 502, 20, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(244, 'pc', 'Differential', 'Apakah masalah lebih sering di lingkungan panas atau berdebu?', 'ya, panas, berdebu, tidak ac, lingkungan buruk', 493, 21, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(245, 'pc', 'Differential', 'Apakah sudah mencoba clear CMOS untuk reset BIOS?', 'belum, tidak, belum clear cmos', 489, 22, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(246, 'pc', 'Differential', 'Apakah masalah terjadi setelah ganti PSU baru?', 'ya, setelah ganti psu, psu baru bermasalah', 492, 23, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(247, 'pc', 'Differential', 'Apakah masalah terjadi setelah update Windows atau driver?', 'ya, setelah update, habis update', 477, 24, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(248, 'pc', 'Differential', 'Apakah dua komponen tertentu (RAM kit) jika dipakai bersama crash?', 'ya, kombinasi ini crash, dua ini tidak jalan bersama', 497, 25, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(249, 'pc', 'Differential', 'Apakah masalah muncul setelah ganti motherboard baru?', 'ya, setelah ganti mobo, mobo baru bermasalah', 498, 26, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(250, 'pc', 'Differential', 'Apakah swap/tukar komponen berhasil mengisolasi penyebab masalah?', 'ya, ketemu setelah swap, terisolasi, berhasil isolasi', 499, 27, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(251, 'pc', 'Differential', 'Apakah masalah hanya terjadi secara random tanpa pola?', 'ya, acak, random, tidak ada pola, intermittent', 488, 28, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(252, 'pc', 'Differential', 'Apakah PC pernah terkena air atau cairan?', 'ya, kena air, basah, tumpahan, water damage', 479, 29, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(253, 'pc', 'Differential', 'Apakah masalah setelah ganti OS atau instalasi dual boot?', 'ya, habis install os, dual boot, ganti windows', 503, 30, 'yesno', NULL, '2026-03-12 15:25:43', '2026-04-01 06:32:23', 2, NULL),
(254, 'aio', 'Adaptor', 'Apakah adaptor AIO yang digunakan adalah adaptor original bawaan?', 'tidak, bukan original, pengganti, beda merek', 516, 1, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, 22),
(255, 'aio', 'Adaptor', 'Apakah adaptor terasa sangat panas saat digunakan?', 'ya, panas, kepanasan, overheat, sangat panas', 511, 2, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, 22),
(256, 'aio', 'Adaptor', 'Apakah ada bau hangus dari adaptor atau kabelnya?', 'ya, bau, hangus, gosong, terbakar', 512, 3, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, 22),
(257, 'aio', 'Adaptor', 'Apakah kabel adaptor terlihat rusak, terkelupas, atau tertekuk parah?', 'ya, rusak, terkelupas, putus, tertekuk', 513, 4, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, 22),
(258, 'aio', 'Adaptor', 'Apakah port colokan adaptor di body AIO terasa longgar?', 'ya, longgar, oblak, goyang, tidak pas', 514, 5, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, 22),
(259, 'aio', 'Adaptor', 'Apakah AIO mati saat digunakan untuk tugas berat (editing, banyak tab)?', 'ya, saat berat, editing, banyak program', 515, 6, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, 22),
(260, 'aio', 'Adaptor', 'Apakah tombol power tidak merespon sama sekali?', 'ya, tidak respon, diam, tidak berfungsi', 519, 7, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, 22),
(261, 'aio', 'Adaptor', 'Apakah AIO menyala sebentar lalu langsung mati?', 'ya, nyala bentar, sebentar, flash, langsung mati', 510, 8, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, 22),
(262, 'aio', 'Display', 'Apakah layar AIO sama sekali gelap total?', 'gelap total, mati, blank, tidak ada', 521, 1, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, 23),
(263, 'aio', 'Display', 'Apakah ada gambar samar jika layar diterangi senter kuat?', 'ya, ada samar, terlihat gambar, ada bayangan', 530, 2, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, 23),
(264, 'aio', 'Display', 'Apakah gambar muncul atau berubah saat body AIO ditekan-tekan?', 'ya, muncul ditekan, berubah disentuh, kabel flex', 531, 3, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, 23),
(265, 'aio', 'Display', 'Apakah ada retakan fisik pada panel layar AIO?', 'ya, retak, pecah, crack, rusak fisik', 525, 4, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, 23),
(266, 'aio', 'Display', 'Apakah layar bergaris secara konsisten?', 'ya, bergaris, garis-garis, stripe vertikal', 522, 5, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, 23),
(267, 'aio', 'Display', 'Apakah muncul artefak atau kotak warna acak di layar?', 'ya, artefak, kotak warna, glitch, visual aneh', 532, 6, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, 23),
(268, 'aio', 'Display', 'Apakah masalah layar muncul setelah update driver?', 'ya, setelah update, habis update driver', 533, 7, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, 23),
(269, 'aio', 'Display', 'Apakah layar menyala setengah saja?', 'ya, setengah, sebagian, half screen', 529, 8, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, 23),
(270, 'aio', 'Touchscreen', 'Apakah touchscreen AIO sama sekali tidak merespon sentuhan?', 'ya, tidak respon, mati total, tidak bisa disentuh', 536, 1, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, NULL),
(271, 'aio', 'Touchscreen', 'Apakah touchscreen bergerak atau klik sendiri tanpa disentuh?', 'ya, klik sendiri, gerak sendiri, ghost touch', 537, 2, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, NULL),
(272, 'aio', 'Touchscreen', 'Apakah hanya area tertentu dari touchscreen yang tidak responsif?', 'ya, sebagian, area tertentu, pojok tidak bisa', 538, 3, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, NULL),
(273, 'aio', 'Touchscreen', 'Apakah sentuhan meleset dari target yang disentuh?', 'ya, meleset, tidak tepat, offset, geser', 539, 4, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, NULL),
(274, 'aio', 'Touchscreen', 'Apakah touchscreen tidak terdeteksi di Device Manager?', 'ya, tidak ada, tidak terdeteksi, hilang', 541, 5, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, NULL),
(275, 'aio', 'Touchscreen', 'Apakah masalah muncul setelah ganti panel layar?', 'ya, setelah ganti layar, habis servis panel', 544, 6, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, NULL),
(276, 'aio', 'Touchscreen', 'Apakah masalah muncul setelah update Windows?', 'ya, setelah update, habis update windows', 542, 7, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, NULL),
(277, 'aio', 'Motherboard', 'Apakah AIO menampilkan apapun (logo BIOS) saat dinyalakan?', 'tidak, blank, tidak ada logo, tidak POST', 548, 1, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, NULL),
(278, 'aio', 'Motherboard', 'Apakah ada bunyi beep dari AIO saat dinyalakan?', 'ya, beep, bunyi beep, berbunyi', 562, 2, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, NULL),
(279, 'aio', 'Motherboard', 'Apakah tanggal dan jam AIO selalu reset setiap dinyalakan?', 'ya, tanggal salah, reset terus, 1980 atau 2000', 549, 3, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, NULL),
(280, 'aio', 'Motherboard', 'Apakah ada bau hangus dari dalam body AIO?', 'ya, bau, hangus, terbakar, gosong', 552, 4, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, NULL),
(281, 'aio', 'Motherboard', 'Apakah terlihat komponen fisik rusak di motherboard AIO?', 'ya, kembung, terbakar, rusak fisik, komponen hangus', 554, 5, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, NULL),
(282, 'aio', 'Motherboard', 'Apakah beberapa port USB di body AIO tidak berfungsi?', 'ya, usb mati, beberapa port mati', 550, 6, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, NULL),
(283, 'aio', 'Motherboard', 'Apakah WiFi dan LAN AIO sama-sama tidak berfungsi?', 'ya, wifi dan lan mati, keduanya bermasalah', 557, 7, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, NULL),
(284, 'aio', 'Motherboard', 'Apakah BIOS pernah di-flash sebelum bermasalah?', 'ya, flash bios, update bios, setelah update uefi', 558, 8, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:23', 3, NULL),
(285, 'aio', 'CPU', 'Berapa suhu CPU AIO saat idle (pakai HWiNFO)?', 'lebih 60, 70an, panas, tinggi, tidak normal', 568, 1, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:24', 3, NULL),
(286, 'aio', 'CPU', 'Apakah kipas internal AIO masih terdengar berputar?', 'tidak, diam, tidak bunyi, tidak berputar', 569, 2, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:24', 3, NULL),
(287, 'aio', 'CPU', 'Apakah thermal paste sudah pernah diganti?', 'belum, tidak pernah, lama, sudah bertahun', 570, 3, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:24', 3, NULL),
(288, 'aio', 'CPU', 'Apakah AIO menjadi sangat lambat setelah pemakaian beberapa menit?', 'ya, makin lambat, lambat setelah sebentar, throttle', 564, 4, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:24', 3, NULL),
(289, 'aio', 'CPU', 'Apakah CPU AIO terdeteksi di BIOS?', 'tidak, tidak terdeteksi, hilang, kosong di bios', 566, 5, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:24', 3, NULL),
(290, 'aio', 'CPU', 'Apakah AIO pernah dibuka dan sistem pendingin dibersihkan?', 'belum, tidak pernah, sudah lama', 570, 6, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:24', 3, NULL),
(291, 'aio', 'RAM SO-DIMM', 'Apakah AIO bisa POST normal sebelum upgrade RAM?', 'ya, sebelumnya normal, bisa post, baru upgrade', 579, 1, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:24', 3, NULL),
(292, 'aio', 'RAM SO-DIMM', 'Apakah sudah menjalankan Memtest86?', 'sudah, ada error, fail, error memtest', 578, 2, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:24', 3, NULL),
(293, 'aio', 'RAM SO-DIMM', 'Apakah kapasitas RAM yang terbaca sesuai yang terpasang?', 'tidak, kurang, setengah, salah kapasitas', 576, 3, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:24', 3, NULL),
(294, 'aio', 'RAM SO-DIMM', 'Apakah kontak SO-DIMM terlihat kusam atau kotor?', 'ya, kusam, kotor, kecoklatan', 582, 4, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:24', 3, NULL),
(295, 'aio', 'RAM SO-DIMM', 'Apakah sudah coba RAM di slot SO-DIMM yang berbeda?', 'belum, belum coba slot lain', 581, 5, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:24', 3, NULL),
(296, 'aio', 'RAM SO-DIMM', 'Apakah AIO BSOD dengan kode memory management?', 'ya, memory management, page fault, bsod ram', 575, 6, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:24', 3, NULL),
(297, 'aio', 'RAM SO-DIMM', 'Apakah RAM yang dipasang sesuai spesifikasi dari vendor AIO?', 'tidak tahu, tidak cek, mungkin tidak cocok', 579, 7, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:24', 3, NULL),
(298, 'aio', 'Storage', 'Apakah storage AIO berupa HDD 2.5\" atau SSD?', 'hdd, hard disk, ada bunyi berputar', 587, 1, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:24', 3, NULL),
(299, 'aio', 'Storage', 'Apakah terdengar bunyi klik dari area storage?', 'ya, klik, bunyi, clicking, grinding', 587, 2, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:24', 3, NULL),
(300, 'aio', 'Storage', 'Apakah CrystalDiskInfo menampilkan warning atau bad health?', 'ya, warning, caution, bad, merah, reallocated', 589, 3, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:24', 3, NULL),
(301, 'aio', 'Storage', 'Apakah menggunakan NVMe M.2?', 'ya, nvme, m.2, solid state pcie', 592, 4, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:24', 3, NULL),
(302, 'aio', 'Storage', 'Apakah ada partisi yang tiba-tiba hilang?', 'ya, hilang, tidak ada, lenyap', 593, 5, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:24', 3, NULL),
(303, 'aio', 'Storage', 'Apakah storage kadang terdeteksi kadang tidak?', 'ya, kadang muncul, intermittent, tidak konsisten', 595, 6, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:24', 3, NULL),
(304, 'aio', 'Storage', 'Apakah SSD tiba-tiba jadi read-only?', 'ya, read only, tidak bisa nulis, write protected', 594, 7, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:24', 3, NULL),
(305, 'aio', 'Thermal', 'Apakah bagian belakang body AIO terasa sangat panas?', 'ya, panas, kepanasan, sangat panas, tidak nyaman dipegang', 598, 1, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:24', 3, 25),
(306, 'aio', 'Thermal', 'Apakah kipas internal AIO masih terdengar berputar?', 'tidak, diam, tidak bunyi, tidak berputar', 600, 2, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:24', 3, 25),
(307, 'aio', 'Thermal', 'Apakah lubang ventilasi AIO terlihat kotor atau tersumbat debu?', 'ya, debu, kotor, tersumbat, debu banyak', 604, 3, 'yesno', NULL, '2026-03-12 15:25:45', '2026-04-01 06:32:24', 3, 25),
(308, 'aio', 'Thermal', 'Apakah thermal paste pernah diganti?', 'belum, tidak pernah, sudah lama, tidak tahu', 605, 4, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, 25),
(309, 'aio', 'Thermal', 'Apakah performa AIO makin lambat setelah berjalan beberapa menit?', 'ya, makin lambat, throttle, turun performa', 603, 5, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, 25),
(310, 'aio', 'Thermal', 'Apakah ada bunyi aneh dari dalam AIO saat kipas berputar?', 'ya, bunyi, grinding, berisik, suara aneh', 607, 6, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, 25),
(311, 'aio', 'Thermal', 'Apakah AIO pernah mati sendiri karena terlalu panas?', 'ya, mati panas, thermal shutdown, mati kepanasan', 601, 7, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, 25),
(312, 'aio', 'Audio', 'Apakah audio device terdeteksi di Device Manager?', 'tidak, hilang, tidak terdeteksi, no device', 616, 1, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, 26),
(313, 'aio', 'Audio', 'Apakah masalah audio muncul setelah update Windows?', 'ya, setelah update, habis update windows', 618, 2, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, 26),
(314, 'aio', 'Audio', 'Apakah suara hanya keluar dari satu speaker?', 'ya, sebelah, satu speaker, kiri saja, kanan saja', 617, 3, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, 26),
(315, 'aio', 'Audio', 'Apakah jack headphone 3.5mm juga tidak berfungsi?', 'ya, jack mati, headphone tidak bunyi', 614, 4, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, 26),
(316, 'aio', 'Audio', 'Apakah mikrofon built-in AIO tidak terdeteksi?', 'ya, mic tidak ada, mic tidak terdeteksi', 615, 5, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, 26),
(317, 'aio', 'Audio', 'Apakah ada dengung atau hum terus-menerus dari speaker?', 'ya, dengung, hum, noise terus', 619, 6, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, 26),
(318, 'aio', 'Konektivitas', 'Apakah WiFi terdeteksi di Device Manager AIO?', 'tidak, tidak ada, hilang, tidak terdeteksi', 630, 1, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, 27),
(319, 'aio', 'Konektivitas', 'Apakah WiFi dan Bluetooth sama-sama bermasalah?', 'ya, keduanya, wifi dan bt, semua wireless mati', 625, 2, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, 27),
(320, 'aio', 'Konektivitas', 'Apakah sinyal WiFi sangat lemah meski router dekat?', 'ya, lemah, bar sedikit, jangkauan pendek', 626, 3, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, 27),
(321, 'aio', 'Konektivitas', 'Apakah masalah muncul setelah update Windows?', 'ya, setelah update, habis update', 633, 4, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, 27),
(322, 'aio', 'Konektivitas', 'Apakah LAN kabel juga tidak berfungsi?', 'ya, lan juga mati, ethernet juga bermasalah', 624, 5, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, 27),
(323, 'aio', 'Konektivitas', 'Apakah WiFi terhubung tapi tidak ada akses internet?', 'ya, connected no internet, limited connection', 628, 6, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, 27),
(324, 'aio', 'Webcam', 'Apakah kamera AIO terdeteksi di Device Manager?', 'tidak, hilang, tidak ada, tidak terdeteksi', 635, 1, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(325, 'aio', 'Webcam', 'Apakah AIO memiliki privacy shutter fisik pada kamera?', 'ya, ada penutup, shutter, ada slider', 638, 2, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(326, 'aio', 'Webcam', 'Apakah LED indikator kamera menyala saat diakses aplikasi?', 'tidak, mati, tidak nyala', 639, 3, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(327, 'aio', 'Webcam', 'Apakah kamera menampilkan layar hitam saat dibuka?', 'ya, hitam, blank, tidak ada gambar', 637, 4, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(328, 'aio', 'Webcam', 'Apakah sudah cek izin kamera di Settings > Privacy?', 'belum, tidak tahu, belum cek', 640, 5, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(329, 'aio', 'Webcam', 'Apakah kamera bermasalah di semua aplikasi atau hanya satu?', 'semua aplikasi, semua app, tidak di mana-mana', 634, 6, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(330, 'aio', 'Peripheral', 'Apakah semua port USB AIO tidak berfungsi?', 'ya, semua, semuanya mati, seluruh port', 651, 1, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(331, 'aio', 'Peripheral', 'Apakah keyboard dan mouse wireless bawaan AIO tidak berfungsi?', 'ya, keyboard mati, mouse mati, tidak bisa input', 648, 2, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(332, 'aio', 'Peripheral', 'Apakah USB bisa charging tapi tidak transfer data?', 'ya, hanya cas, charging only, tidak bisa copy data', 652, 3, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(333, 'aio', 'Peripheral', 'Apakah port HDMI output untuk monitor eksternal tidak berfungsi?', 'ya, hdmi out mati, tidak bisa ke monitor lain', 646, 4, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(334, 'aio', 'Peripheral', 'Apakah hanya beberapa atau semua port USB yang bermasalah?', 'semua, seluruh port, total mati', 651, 5, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(335, 'aio', 'Peripheral', 'Apakah sudah coba reinstall USB controller di Device Manager?', 'belum, tidak, belum dicoba', 644, 6, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(336, 'aio', 'Software', 'Apakah Windows bisa masuk ke Safe Mode?', 'ya, bisa, berhasil, masuk safe mode', 658, 1, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, 24),
(337, 'aio', 'Software', 'Apakah AIO masuk ke repair loop terus-menerus?', 'ya, repair terus, loop, tidak bisa masuk windows', 663, 2, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, 24),
(338, 'aio', 'Software', 'Apakah antivirus mendeteksi ancaman atau virus?', 'ya, ada virus, malware, terdeteksi', 657, 3, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, 24),
(339, 'aio', 'Software', 'Apakah masalah muncul setelah update Windows atau driver?', 'ya, setelah update, habis update', 661, 4, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, 24),
(340, 'aio', 'Software', 'Apakah drive menampilkan RAW di Disk Management?', 'ya, raw, tidak bisa diakses, unknown', 662, 5, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, 24),
(341, 'aio', 'Software', 'Apakah banyak aplikasi OEM bawaan AIO berjalan di startup?', 'ya, banyak, vendor app, software bawaan banyak', 660, 6, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, 24),
(342, 'aio', 'Software', 'Apakah fitur Factory Reset AIO tidak berfungsi?', 'ya, tidak bisa reset, recovery error', 665, 7, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, 24),
(343, 'aio', 'Differential', 'Apakah masalah terjadi setelah upgrade RAM SO-DIMM atau storage AIO?', 'ya, setelah upgrade, habis ganti, pasang baru', 668, 1, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(344, 'aio', 'Differential', 'Apakah masalah terjadi setelah update Windows atau driver?', 'ya, setelah update, habis update', 669, 2, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(345, 'aio', 'Differential', 'Apakah masalah tetap ada setelah reinstall Windows?', 'ya, masih ada, hardware problem, reinstall tidak membantu', 678, 3, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(346, 'aio', 'Differential', 'Apakah AIO pernah terkena air atau cairan?', 'ya, kena air, basah, tumpahan, water damage', 674, 4, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(347, 'aio', 'Differential', 'Apakah AIO pernah jatuh atau terkena benturan?', 'ya, jatuh, terbentur, drop, banting', 671, 5, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(348, 'aio', 'Differential', 'Apakah masalah hanya muncul saat AIO sudah panas?', 'ya, saat panas, thermal, setelah lama dipakai', 673, 6, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(349, 'aio', 'Differential', 'Apakah masalah muncul di semua OS termasuk Linux live USB?', 'ya, linux juga, semua os, bukan windows saja', 679, 7, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(350, 'aio', 'Differential', 'Apakah BIOS/UEFI AIO menampilkan error atau komponen tidak terdeteksi?', 'ya, bios error, tidak terdeteksi, post error', 690, 8, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(351, 'aio', 'Differential', 'Apakah adaptor AIO original atau pengganti?', 'pengganti, non original, adaptor lain, tidak tahu', 692, 9, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(352, 'aio', 'Differential', 'Apakah AIO baru dibeli dan langsung bermasalah?', 'ya, baru beli, masih baru, dari toko langsung error', 681, 10, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(353, 'aio', 'Differential', 'Apakah semua fitur AIO (layar, touch, audio, USB) bermasalah?', 'ya, semuanya, total, semua tidak jalan', 682, 11, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(354, 'aio', 'Differential', 'Apakah masalah terjadi setelah AIO diservis atau dibuka?', 'ya, setelah servis, habis dibuka, habis bersih', 670, 12, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(355, 'aio', 'Differential', 'Apakah masalah terjadi secara acak tanpa pola?', 'ya, acak, random, tidak tentu, kadang-kadang', 688, 13, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(356, 'aio', 'Differential', 'Apakah masalah muncul setelah ganti panel atau layar AIO?', 'ya, setelah ganti layar, habis ganti panel', 683, 14, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(357, 'aio', 'Differential', 'Apakah stress test (CPU/GPU benchmark) menunjukkan error?', 'ya, crash, error, gagal test benchmark', 684, 15, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(358, 'aio', 'Differential', 'Apakah ruangan tempat AIO digunakan panas atau lembab?', 'ya, panas, lembab, tidak ada ac, humid', 685, 16, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(359, 'aio', 'Differential', 'Apakah masalah hanya pada fitur spesifik AIO (touch, kamera, dll)?', 'ya, hanya touch, hanya kamera, fitur tertentu', 680, 17, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(360, 'aio', 'Differential', 'Apakah masalah terjadi setelah install driver atau software dari vendor AIO?', 'ya, setelah install driver vendor, software oem', 687, 18, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(361, 'aio', 'Differential', 'Apakah AIO sudah digunakan lebih dari 5 tahun?', 'ya, sudah lama, lebih 5 tahun, sudah tua', 697, 19, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(362, 'aio', 'Differential', 'Apakah komponen baru yang dipasang sudah diuji sebelum dipasang?', 'belum, tidak, langsung pasang, baru dari toko', 686, 20, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(363, 'aio', 'Differential', 'Apakah AIO awalnya berfungsi normal tapi bermasalah setelah lama menyala?', 'ya, awal ok, muncul setelah lama, makin panas makin error', 693, 21, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(364, 'aio', 'Differential', 'Apakah AIO mengalami masalah di lebih dari satu komponen sekaligus?', 'ya, banyak masalah, multiple issue, banyak yang rusak', 695, 22, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(365, 'aio', 'Differential', 'Apakah masalah hanya saat menjalankan aplikasi berat tertentu?', 'ya, hanya saat edit, hanya saat render, aplikasi tertentu', 694, 23, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(366, 'aio', 'Differential', 'Apakah AIO sering mati mendadak tanpa pola yang jelas?', 'ya, sering mati, random shutdown, tidak ada pola', 688, 24, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(367, 'aio', 'Differential', 'Apakah AIO terasa makin lambat dari tahun ke tahun?', 'ya, makin lambat, degradasi, sudah lama lambat', 689, 25, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(368, 'aio', 'Differential', 'Apakah adaptor original AIO hilang atau tidak ada?', 'ya, hilang, tidak ada, pakai adaptor lain', 692, 26, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(369, 'aio', 'Differential', 'Apakah masalah muncul di lingkungan yang sangat berdebu?', 'ya, berdebu, kotor, banyak debu', 670, 27, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(370, 'aio', 'Differential', 'Apakah masalah terjadi setelah adaptor diganti ke non-original?', 'ya, ganti adaptor, adaptor kw, bukan original', 672, 28, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(371, 'aio', 'Differential', 'Apakah AIO mengalami masalah makin parah seiring waktu?', 'ya, makin parah, bertahap, progressive', 675, 29, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(372, 'aio', 'Differential', 'Apakah AIO pernah digunakan di lingkungan dengan kelembaban tinggi?', 'ya, lembab, humid, embun, kondisi basah', 696, 30, 'yesno', NULL, '2026-03-12 15:25:46', '2026-04-01 06:32:24', 3, NULL),
(373, 'printer', 'Kualitas Cetak', 'Apakah hasil cetakan memiliki garis-garis horizontal (bergaris)?', 'ya,iya,bergaris horizontal,garis cetak,banding,garis vertikal,strip vertikal,garis memanjang', 698, 1, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 28),
(374, 'printer', 'Kualitas Cetak', 'Apakah ada warna tertentu yang hilang atau tidak keluar pada hasil cetak?', 'ya,iya,satu warna hilang,missing color,warna ga keluar,warna salah,color shift,warna ga sesuai', 712, 2, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 28),
(375, 'printer', 'Kualitas Cetak', 'Apakah head cleaning sudah dilakukan berulang kali tapi tidak membantu?', 'ya,iya,cleaning gagal,head cleaning ga berhasil,sudah cleaning berkali-kali,head sumbat,nozzle clogged,head buntu', 807, 3, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 28),
(376, 'printer', 'Kualitas Cetak', 'Apakah nozzle check pattern menunjukkan banyak garis yang hilang?', 'ya,iya,nozzle check gagal,pattern bergaris,test page garis', 805, 4, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 28),
(377, 'printer', 'Kualitas Cetak', 'Apakah ada indikator tinta/toner rendah atau habis menyala?', 'ya,iya,tinta habis,ink low,level tinta rendah,toner habis,toner low,toner kosong', 713, 5, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 28),
(378, 'printer', 'Kualitas Cetak', 'Apakah cetakan keseluruhan tampak pudar atau memudar?', 'ya,iya,pudar,faded,tidak pekat,buram,blur,tidak tajam', 700, 6, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 28),
(379, 'printer', 'Kualitas Cetak', 'Apakah warna cetakan tidak akurat atau berbeda dari yang terlihat di layar?', 'ya,iya,warna salah,color shift,warna ga sesuai,warna campur,tinta mixing,warna tertukar', 701, 7, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 28),
(380, 'printer', 'Kualitas Cetak', 'Apakah teks cetakan tidak rata, geser, atau ada gap antar baris?', 'ya,iya,miring,skew,ga lurus,resolusi rendah,ga detail,pixelated', 710, 8, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 28),
(381, 'printer', 'Kualitas Cetak', 'Apakah ada titik atau noda yang berulang pada interval tertentu di cetakan (khusus laser)?', 'ya,iya,titik-titik berulang,dots repeating,drum mark,ghost image,bayangan,double image,background kotor,abu-abu', 831, 9, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 28),
(382, 'printer', 'Tinta', 'Apakah muncul error bahwa cartridge tinta/toner tidak terdeteksi?', 'ya,iya,cartridge ga kebaca,tinta ga detect,ink not recognized,chip error,reset cartridge,chip perlu reset', 714, 1, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 29),
(383, 'printer', 'Tinta', 'Apakah ada tinta yang menetes atau bocor dari cartridge/tank?', 'ya,iya,tinta bocor,tinta netes,tinta tumpah,tinta netes idle,dripping,tinta menetes sendiri,bercak tinta,noda', 715, 2, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 29),
(384, 'printer', 'Tinta', 'Apakah muncul error waste ink pad penuh atau lampu berkedip bergantian?', 'ya,iya,waste ink full,ink pad penuh,maintenance box full,led kedip,blinking,lampu error', 723, 3, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 29),
(385, 'printer', 'Tinta', 'Apakah tinta masih ada/terlihat tapi printer menganggapnya habis?', 'ya,iya,chip error,reset cartridge,chip perlu reset,tinta habis,ink low,level tinta rendah', 721, 4, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 29),
(386, 'printer', 'Tinta', 'Apakah ada gelembung udara terlihat di selang tinta infus (CISS)?', 'ya,iya,selang sumbat,tube infus mampet,selang bocor,infus bermasalah,tank rusak,continuous ink supply', 724, 5, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 29),
(387, 'printer', 'Tinta', 'Apakah cartridge baru ditolak oleh printer (error muncul saat dipasang)?', 'ya,iya,cartridge ga kebaca,tinta ga detect,ink not recognized,cartridge longgar,ga pas slot,cartridge ga lock', 714, 6, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 29),
(388, 'printer', 'Tinta', 'Apakah toner serbuk bocor/terlihat di dalam printer (khusus laser)?', 'ya,iya,toner bocor,toner tumpah,serbuk toner keluar,waste toner full,toner waste penuh,limbah toner penuh', 720, 7, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 29),
(389, 'printer', 'Tinta', 'Apakah kualitas cetak menurun setelah mengisi ulang tinta/toner?', 'ya,iya,non-original,refill,compatible,setelah ganti tinta,habis isi tinta,setelah refill', 722, 8, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 29),
(390, 'printer', 'Kertas', 'Apakah kertas sering macet (paper jam) di dalam printer?', 'ya,iya,paper jam,kertas macet,kertas nyangkut,jam di fuser,macet fuser,kertas stuck di pemanas,jam output,macet keluar', 728, 1, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 30),
(391, 'printer', 'Kertas', 'Apakah printer tidak bisa mengambil kertas dari tray (kertas tidak tertarik)?', 'ya,iya,ga ambil kertas,kertas ga masuk,paper feed error,roller aus,pickup roller licin,roller slip', 729, 2, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 30),
(392, 'printer', 'Kertas', 'Apakah muncul error paper jam padahal tidak ada kertas yang macet (false jam)?', 'ya,iya,sensor error,paper sensor mati,sensor kertas rusak,paper jam,kertas macet,kertas nyangkut,size mismatch,ukuran kertas salah', 736, 3, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 30),
(393, 'printer', 'Kertas', 'Apakah kertas masuk miring atau paper guide tidak bisa diatur dengan benar?', 'ya,iya,kertas miring,paper skew,masuk serong,tray rusak,tray patah,wadah kertas rusak', 731, 4, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 30),
(394, 'printer', 'Kertas', 'Apakah printer menarik lebih dari satu lembar kertas sekaligus?', 'ya,iya,multi feed,kertas dobel,narik banyak', 730, 5, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 30),
(395, 'printer', 'Kertas', 'Apakah ADF (Auto Document Feeder) bermasalah (tidak mengambil/macet)?', 'ya,iya,adf macet,adf jam,feeder macet,adf scan macet,feeder scan error,auto feeder scan macet,multi feed,kertas dobel', 739, 6, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 30),
(396, 'printer', 'Kertas', 'Apakah cetak bolak-balik (duplex) bermasalah (macet/tidak membalik)?', 'ya,iya,duplex error,bolak-balik error,auto duplex jam,kertas miring,paper skew,masuk serong,paper jam,kertas macet', 740, 7, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 30),
(397, 'printer', 'Kertas', 'Apakah roller pengambil kertas (pickup roller) terlihat licin/mengkilap?', 'ya,iya,roller aus,pickup roller licin,roller slip', 732, 8, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 30),
(398, 'printer', 'Konektivitas', 'Apakah printer tidak terdeteksi saat dihubungkan via kabel USB?', 'ya,iya,usb ga kebaca,printer ga detect usb,usb printer error,kabel usb rusak,usb longgar,kabel printer lepas,port error,printer port gagal', 743, 1, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 31),
(399, 'printer', 'Konektivitas', 'Apakah koneksi USB printer sering putus-nyambung (connect-disconnect)?', 'ya,iya,usb ga kebaca,printer ga detect usb,usb printer error,kabel usb rusak,usb longgar,kabel printer lepas', 743, 2, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 31),
(400, 'printer', 'Konektivitas', 'Apakah printer tidak bisa terhubung ke jaringan WiFi?', 'ya,iya,wifi ga kebaca,printer wifi ga detect,printer wireless error,ga bisa konek,wifi ga nyambung,gagal connect', 744, 3, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 31),
(401, 'printer', 'Konektivitas', 'Apakah koneksi WiFi printer sering putus atau tidak stabil?', 'ya,iya,wifi putus,disconnect printer,koneksi ga stabil,ip berubah,dhcp printer,ip ga tetap', 747, 4, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 31),
(402, 'printer', 'Konektivitas', 'Apakah status printer menunjukkan \"Offline\" padahal sudah menyala?', 'ya,iya,printer offline,status offline,ga bisa cetak offline,job stuck,antrian macet,print queue stuck', 745, 5, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 31),
(403, 'printer', 'Konektivitas', 'Apakah muncul error saat mencoba cetak ke shared printer di jaringan?', 'ya,iya,sharing gagal,share printer error,ga bisa share,lan ga detect,ethernet printer mati,network printer error,firewall block,blocked printer', 751, 6, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 31),
(404, 'printer', 'Konektivitas', 'Apakah print job gagal terkirim (muncul error atau tidak ada respon)?', 'ya,iya,job stuck,antrian macet,print queue stuck,spooler error,print spooler crash,spooler mati,printer offline,status offline', 749, 7, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 31),
(405, 'printer', 'Konektivitas', 'Apakah cetak dari smartphone/tablet gagal (AirPrint/Google Print/app vendor)?', 'ya,iya,print dari hp gagal,mobile print error,airprint error,wifi ga kebaca,printer wifi ga detect,printer wireless error,ga bisa konek,wifi ga nyambung', 754, 8, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 31),
(406, 'printer', 'Hardware', 'Apakah printer mati total (tidak menyala sama sekali)?', 'ya,iya,mati total,ga nyala,ga hidup,psu printer rusak,power board mati,regulator rusak', 758, 1, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 32),
(407, 'printer', 'Hardware', 'Apakah printer sering restart sendiri atau mati secara tiba-tiba?', 'ya,iya,restart sendiri,reboot printer,mati nyala sendiri,adaptor rusak,kabel power printer,adapter mati', 771, 2, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 32),
(408, 'printer', 'Hardware', 'Apakah printer menyala tapi tidak merespon perintah apapun?', 'ya,iya,nyala ga respon,standby terus,ga merespon,tombol rusak,button mati,tombol ga respon', 759, 3, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 32),
(409, 'printer', 'Hardware', 'Apakah layar LCD panel printer rusak (blank/bergaris/karakter aneh)?', 'ya,iya,lcd error,display rusak,layar printer mati,tombol rusak,button mati,tombol ga respon,error code,kode error', 760, 4, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 32),
(410, 'printer', 'Hardware', 'Apakah printer terasa sangat panas saat beroperasi?', 'ya,iya,printer panas,overheat printer,terlalu panas,restart sendiri,reboot printer,mati nyala sendiri', 768, 5, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 32),
(411, 'printer', 'Hardware', 'Apakah muncul error \"Memory Full\" atau file besar gagal dicetak?', 'ya,iya,memory full,memori printer penuh,buffer overflow,cetak lambat,print pelan,slow printing,error code,kode error', 772, 6, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 32),
(412, 'printer', 'Hardware', 'Apakah muncul error \"Cover Open\" padahal penutup sudah tertutup?', 'ya,iya,cover ga nutup,penutup rusak,hinge patah,error code,kode error,blinking error', 763, 7, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 32),
(413, 'printer', 'Software', 'Apakah printer terdeteksi di komputer tapi tidak bisa mencetak?', 'ya,iya,print gagal,ga jadi cetak,cetak ga keluar,driver ga ada,belum install driver,driver printer ga ada', 782, 1, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 33),
(414, 'printer', 'Software', 'Apakah muncul error \"Driver is unavailable\" untuk printer?', 'ya,iya,driver ga ada,belum install driver,driver printer ga ada,driver ga cocok,driver incompatible,driver ga support', 773, 2, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 33),
(415, 'printer', 'Software', 'Apakah antrian cetak (print queue) macet dan tidak bisa dihapus?', 'ya,iya,antrian stuck,queue ga bisa hapus,cancel gagal,job stuck,antrian macet,print queue stuck', 778, 3, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 33),
(416, 'printer', 'Software', 'Apakah print keluar ke printer yang salah (default printer berubah)?', 'ya,iya,default salah,printer default berubah,salah printer,print gagal,ga jadi cetak,cetak ga keluar', 776, 4, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 33),
(417, 'printer', 'Software', 'Apakah printer bermasalah setelah update Windows/OS?', 'ya,iya,setelah update ga bisa,windows update printer,os update error,driver ga cocok,driver incompatible,driver ga support', 786, 5, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 33),
(418, 'printer', 'Software', 'Apakah masalah cetak hanya terjadi pada aplikasi/program tertentu?', 'ya,iya,app tertentu error,excel ga bisa print,cetak dari pdf error', 783, 6, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 33),
(419, 'printer', 'Software', 'Apakah ada fitur printer yang sebelumnya berfungsi kini tidak tersedia?', 'ya,iya,firmware update,firmware lama,perlu update firmware,utility error,software printer crash,app printer error', 779, 7, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 33),
(420, 'printer', 'Mekanik', 'Apakah carriage/head printer tidak bergerak atau macet?', 'ya,iya,carriage macet,carriage stuck,rel macet,rail kotor,guide kotor,jalur carriage kering,sensor carriage,home sensor', 794, 1, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 34),
(421, 'printer', 'Mekanik', 'Apakah terdengar bunyi decit atau kasar dari timing belt printer?', 'ya,iya,belt putus,timing belt aus,belt rusak,grinding,bunyi kasar,noise mekanik', 788, 2, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 34),
(422, 'printer', 'Mekanik', 'Apakah motor printer mengeluarkan bunyi abnormal (grinding/kasar)?', 'ya,iya,motor bunyi,motor mati,motor error,grinding,bunyi kasar,noise mekanik', 789, 3, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 34),
(423, 'printer', 'Mekanik', 'Apakah terdengar bunyi klik-klik dari roda gigi (gear) printer?', 'ya,iya,gear patah,roda gigi aus,gear rusak,grinding,bunyi kasar,noise mekanik', 790, 4, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 34),
(424, 'printer', 'Mekanik', 'Apakah cetakan menumpuk di satu area atau posisi cetak meleset?', 'ya,iya,encoder kotor,encoder strip rusak,encoder error,sensor carriage,home sensor,position error', 791, 5, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 34),
(425, 'printer', 'Mekanik', 'Apakah head printer sering tersumbat meskipun sudah sering di-cleaning?', 'ya,iya,purge error,capping station rusak,pump unit error,wiper rusak,blade kotor,cleaning blade aus', 800, 6, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 34),
(426, 'printer', 'Mekanik', 'Apakah printer mengeluarkan suara keras atau abnormal saat beroperasi?', 'ya,iya,grinding,bunyi kasar,noise mekanik,bunyi aneh,suara kasar,noise printer', 793, 7, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 34),
(427, 'printer', 'Mekanik', 'Apakah ada bunyi abnormal dari area parking/capping station?', 'ya,iya,purge error,capping station rusak,pump unit error', 800, 8, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 34),
(428, 'printer', 'Inkjet', 'Apakah print head sudah di-rendam/flush dengan cairan pembersih tapi tetap bermasalah?', 'ya,iya,head mati,nozzle mampet permanen,head ga bisa dibersihkan,cleaning gagal,head cleaning ga berhasil,sudah cleaning berkali-kali', 804, 1, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, NULL),
(429, 'printer', 'Inkjet', 'Apakah printer inkjet sudah lama tidak digunakan (berminggu/berbulan)?', 'ya,iya,lama ga dipakai,tidak digunakan,menganggur lama', 844, 2, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, NULL),
(430, 'printer', 'Inkjet', 'Apakah tinta di tank infus tidak berkurang meski sudah mencetak banyak?', 'ya,iya,infus bermasalah,tank rusak,continuous ink supply,selang sumbat,tube infus mampet,selang bocor', 806, 3, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, NULL),
(431, 'printer', 'Inkjet', 'Apakah selang tinta infus terlihat bocor atau ada tetesan tinta?', 'ya,iya,selang sumbat,tube infus mampet,selang bocor,tinta netes idle,dripping,tinta menetes sendiri', 724, 4, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, NULL),
(432, 'printer', 'Inkjet', 'Apakah warna cetakan inkjet terlalu dominan satu warna?', 'ya,iya,warna tertentu,satu warna saja,hanya cyan,warna salah,color shift,warna ga sesuai', 849, 5, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, NULL),
(433, 'printer', 'Inkjet', 'Apakah cetakan selalu keluar hitam putih meskipun setting sudah warna?', 'ya,iya,satu warna hilang,missing color,warna ga keluar,setting salah,ukuran ga sesuai,orientasi salah', 712, 6, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, NULL),
(434, 'printer', 'Inkjet', 'Apakah tinta mudah luntur saat diusap pada hasil cetak?', 'ya,iya,luntur,smudge,mudah hilang,tinta ga kering,basah,smear saat sentuh', 707, 7, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, NULL),
(435, 'printer', 'Inkjet', 'Apakah printer inkjet sudah berusia tua atau sudah sangat banyak digunakan?', 'ya,iya,thermal head aus,cartridge head rusak,printhead kartrid rusak,semua cetakan,semua dokumen,text dan gambar', 815, 8, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, NULL),
(436, 'printer', 'Laser', 'Apakah toner pada hasil cetak mudah luntur/mengelupas saat diusap?', 'ya,iya,luntur,smudge,mudah hilang,fuser rusak,fuser overheat,heater fuser mati', 707, 1, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, NULL),
(437, 'printer', 'Laser', 'Apakah kertas berkerut atau keriting setelah keluar dari printer laser?', 'ya,iya,kertas keriting,curl,melengkung,fuser rusak,fuser overheat,heater fuser mati', 832, 2, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, NULL),
(438, 'printer', 'Laser', 'Apakah tercium bau hangus dari printer laser saat mencetak?', 'ya,iya,fuser rusak,fuser overheat,heater fuser mati,printer panas,overheat printer,terlalu panas', 818, 3, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, NULL),
(439, 'printer', 'Laser', 'Apakah muncul error suhu fuser (fuser temperature error) di display?', 'ya,iya,suhu fuser error,fuser temp low,fuser temp high,fuser film rusak,fuser sleeve sobek,film fuser gores', 829, 4, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, NULL),
(440, 'printer', 'Laser', 'Apakah kertas keluar kosong (blank) dari printer laser?', 'ya,iya,blank page,halaman kosong,putih semua,laser unit mati,scanner unit error,LSU error', 705, 5, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, NULL);
INSERT INTO `category_questions` (`id`, `device_type`, `category`, `question`, `expected_keyword`, `leads_to_symptom_id`, `order`, `question_type`, `options`, `created_at`, `updated_at`, `device_type_id`, `device_component_id`) VALUES
(441, 'printer', 'Laser', 'Apakah warna tidak ter-register/overlapping pada printer laser warna?', 'ya,iya,transfer roller rusak,transfer belt aus,ITB rusak,warna salah,color shift,warna ga sesuai', 821, 6, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, NULL),
(442, 'printer', 'Laser', 'Apakah cartridge toner baru baru saja dipasang tapi tidak bisa mencetak?', 'ya,iya,seal belum lepas,tab belum dicabut,pull tab,toner ga kebaca,toner not recognized,cartridge toner error', 824, 7, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, NULL),
(443, 'printer', 'Laser', 'Apakah background cetakan laser kotor/gelap atau ada bayangan (ghost image)?', 'ya,iya,background kotor,abu-abu,gray background,ghost image,bayangan,double image,charge roller kotor,PCR kotor', 709, 8, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, NULL),
(444, 'printer', 'Scanner', 'Apakah scanner pada printer MFP tidak merespon atau error saat scan?', 'ya,iya,scanner mati,scan ga bisa,scanner error,error code,kode error,blinking error', 833, 1, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 35),
(445, 'printer', 'Scanner', 'Apakah lampu scanner tidak menyala atau sangat redup?', 'ya,iya,lampu scan mati,light mati,scanner dark,scanner mati,scan ga bisa,scanner error', 835, 2, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 35),
(446, 'printer', 'Scanner', 'Apakah hasil scan memiliki garis atau noda yang tidak ada di dokumen asli?', 'ya,iya,scan bergaris,garis di scan,scan striping,kaca kotor,kaca gores,scanner glass dirty', 834, 3, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 35),
(447, 'printer', 'Scanner', 'Apakah hasil scan terlalu gelap atau terang tidak merata?', 'ya,iya,lampu scan mati,light mati,scanner dark,scan ga jelas,resolusi scan rendah,scan buram', 835, 4, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 35),
(448, 'printer', 'Scanner', 'Apakah fitur scan to email gagal (error SMTP/autentikasi)?', 'ya,iya,scan to email gagal,scan to folder error,scan ke komputer gagal', 838, 5, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 35),
(449, 'printer', 'Scanner', 'Apakah fitur scan to folder/network gagal?', 'ya,iya,scan to email gagal,scan to folder error,scan ke komputer gagal', 838, 6, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 35),
(450, 'printer', 'Scanner', 'Apakah kualitas hasil fotocopy/copy buruk?', 'ya,iya,fotocopy jelek,copy ga jelas,hasil copy buruk,kaca kotor,kaca gores,scanner glass dirty', 841, 7, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 35),
(451, 'printer', 'Scanner', 'Apakah kaca scanner terlihat kotor atau berdebu?', 'ya,iya,kaca kotor,kaca gores,scanner glass dirty', 836, 8, 'yesno', NULL, '2026-03-12 15:25:47', '2026-04-01 06:32:24', 4, 35),
(452, 'printer', 'Differential', 'Apakah masalah terjadi setelah mengganti tinta atau toner?', 'ya,iya,setelah ganti tinta,habis isi tinta,setelah refill,tinta compatible,toner aftermarket,non original', 843, 1, 'yesno', NULL, '2026-03-12 15:25:48', '2026-04-01 06:32:24', 4, NULL),
(453, 'printer', 'Differential', 'Apakah terdengar bunyi mekanis abnormal dari dalam printer?', 'ya,iya,bunyi aneh,suara kasar,noise printer,grinding,bunyi kasar,noise mekanik', 770, 2, 'yesno', NULL, '2026-03-12 15:25:48', '2026-04-01 06:32:24', 4, NULL),
(454, 'printer', 'Differential', 'Apakah masalah semakin memburuk seiring waktu?', 'ya,iya,semua cetakan,semua dokumen,text dan gambar,lama ga dipakai,tidak digunakan,menganggur lama', 850, 3, 'yesno', NULL, '2026-03-12 15:25:48', '2026-04-01 06:32:24', 4, NULL),
(455, 'printer', 'Differential', 'Apakah masalah hanya terjadi saat cetak dari aplikasi/program tertentu?', 'ya,iya,app tertentu error,excel ga bisa print,cetak dari pdf error,test page ok,self test normal,print langsung bisa', 783, 4, 'yesno', NULL, '2026-03-12 15:25:48', '2026-04-01 06:32:24', 4, NULL),
(456, 'printer', 'Differential', 'Apakah printer kadang bisa mencetak kadang tidak (intermittent)?', 'ya,iya,printer offline,status offline,ga bisa cetak offline,wifi putus,disconnect printer,koneksi ga stabil', 745, 5, 'yesno', NULL, '2026-03-12 15:25:48', '2026-04-01 06:32:24', 4, NULL),
(457, 'printer', 'Differential', 'Apakah printer mengalami beberapa masalah sekaligus?', 'ya,iya,semua cetakan,semua dokumen,text dan gambar,cetak lambat,print pelan,slow printing', 850, 6, 'yesno', NULL, '2026-03-12 15:25:48', '2026-04-01 06:32:24', 4, NULL),
(458, 'printer', 'Differential', 'Apakah masalah muncul setelah update Windows atau sistem operasi?', 'ya,iya,setelah update ga bisa,windows update printer,os update error', 786, 7, 'yesno', NULL, '2026-03-12 15:25:48', '2026-04-01 06:32:24', 4, NULL),
(459, 'printer', 'Differential', 'Apakah printer sudah lama tidak di-service atau maintenance?', 'ya,iya,lama ga dipakai,tidak digunakan,menganggur lama,berkarat,korosi,karat mekanik', 844, 8, 'yesno', NULL, '2026-03-12 15:25:48', '2026-04-01 06:32:24', 4, NULL),
(460, 'printer', 'Differential', 'Apakah masalah terjadi di semua komputer atau hanya di satu komputer?', 'ya,iya,test page ok,self test normal,print langsung bisa,app tertentu error,excel ga bisa print,cetak dari pdf error', 851, 9, 'yesno', NULL, '2026-03-12 15:25:48', '2026-04-01 06:32:24', 4, NULL),
(461, 'printer', 'Differential', 'Apakah test page dari printer sendiri (tanpa komputer) juga bermasalah?', 'ya,iya,test page ok,self test normal,print langsung bisa', 851, 10, 'yesno', NULL, '2026-03-12 15:25:48', '2026-04-01 06:32:24', 4, NULL),
(462, 'printer', 'Differential', 'Apakah performa printer secara umum menurun (lambat, kualitas turun)?', 'ya,iya,semua cetakan,semua dokumen,text dan gambar,cetak lambat,print pelan,slow printing', 850, 11, 'yesno', NULL, '2026-03-12 15:25:48', '2026-04-01 06:32:24', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'aasdasdasd', '123123123', 'asdasdasd', '2026-02-04 06:23:10', '2026-02-04 06:23:10'),
(2, 'budi', '082255850452', 'asdasdasdsd', '2026-02-05 07:50:06', '2026-02-05 07:50:06'),
(3, 'asdasdasdasd', '082255850452', 'asdasdasdd', '2026-02-05 07:55:08', '2026-02-05 07:55:08'),
(4, 'ahmad', '190287986019283', '', '2026-02-05 11:00:49', '2026-02-05 11:00:49'),
(5, 'Zeez', '90128360123', '', '2026-02-21 01:18:45', '2026-02-21 01:18:45'),
(6, 'Rahmat', '9120810293809', '', '2026-02-21 02:07:22', '2026-02-21 02:07:22'),
(7, 'Rahmah', '98723487293847', '', '2026-03-03 05:58:20', '2026-03-03 05:58:20'),
(8, 'jojo', '89te579787e75568755', '', '2026-03-11 22:05:54', '2026-03-11 22:05:54'),
(9, 'Irwan', '085821791736', '', '2026-03-11 23:52:46', '2026-03-11 23:52:46'),
(10, 'Budi', '082255677368', 'Jl.Rajawali', '2026-04-12 04:19:49', '2026-04-12 04:19:49');

-- --------------------------------------------------------

--
-- Table structure for table `device_components`
--

CREATE TABLE `device_components` (
  `id` bigint UNSIGNED NOT NULL,
  `device_type_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `engine_category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `problems_data` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order_column` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `device_components`
--

INSERT INTO `device_components` (`id`, `device_type_id`, `name`, `slug`, `icon`, `description`, `engine_category`, `problems_data`, `is_active`, `order_column`, `created_at`, `updated_at`) VALUES
(9, 1, 'Layar', 'laptop-layar', '🖥️', 'Blank, bergaris, pecah, berkedip', 'Display', '{\"blank\": {\"desc\": \"Layar gelap total, tidak tampil apa-apa\", \"label\": \"Layar Hitam / Blank\", \"symptoms\": [\"G001\"]}, \"pecah\": {\"desc\": \"Ada kerusakan fisik pada layar\", \"label\": \"Layar Pecah / Retak\", \"symptoms\": [\"G005\"]}, \"redup\": {\"desc\": \"Menyala tapi sangat redup\", \"label\": \"Layar Redup / Gelap\", \"symptoms\": [\"G004\"]}, \"bercak\": {\"desc\": \"Ada bercak putih atau pixel mati\", \"label\": \"Bercak / Titik di Layar\", \"symptoms\": [\"G109\"]}, \"bergaris\": {\"desc\": \"Ada garis horizontal atau vertikal\", \"label\": \"Layar Bergaris\", \"symptoms\": [\"G002\"]}, \"berkedip\": {\"desc\": \"Tampilan kedip-kedip tidak stabil\", \"label\": \"Berkedip / Flicker\", \"symptoms\": [\"G003\"]}}', 1, 1, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(10, 1, 'Daya & Baterai', 'laptop-daya', '⚡', 'Mati, baterai boros/kembung, charger', 'Power', '{\"drop\": {\"desc\": \"Persen baterai tidak akurat\", \"label\": \"Baterai Drop / Loncat\", \"symptoms\": [\"G083\"]}, \"boros\": {\"desc\": \"Baterai tidak tahan lama\", \"label\": \"Baterai Cepat Habis\", \"symptoms\": [\"G026\"]}, \"kembung\": {\"desc\": \"Bengkak, casing laptop terangkat\", \"label\": \"Baterai Kembung\", \"symptoms\": [\"G081\"]}, \"mati_total\": {\"desc\": \"Laptop sama sekali tidak mau nyala\", \"label\": \"Mati Total\", \"symptoms\": [\"G156\"]}, \"charger_only\": {\"desc\": \"Mati kalau charger dicabut\", \"label\": \"Hanya Nyala Pakai Charger\", \"symptoms\": [\"G024\"]}, \"charger_port\": {\"desc\": \"Harus digoyang supaya bisa ngecas\", \"label\": \"Port Charger Longgar\", \"symptoms\": [\"G064\"], \"engine_category\": \"Peripheral\"}, \"mati_sendiri\": {\"desc\": \"Tiba-tiba shutdown saat dipakai\", \"label\": \"Sering Mati Sendiri\", \"symptoms\": [\"G029\"]}, \"nyala_bentar\": {\"desc\": \"Menyala beberapa detik lalu mati\", \"label\": \"Nyala Sebentar Lalu Mati\", \"symptoms\": [\"G149\"]}, \"charger_ga_ngisi\": {\"desc\": \"Charger dipasang tapi tidak ngecas\", \"label\": \"Charger Tidak Mengisi\", \"symptoms\": [\"G027\"]}}', 1, 2, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(11, 1, 'Keyboard & Touchpad', 'laptop-input', '⌨️', 'Tombol mati, dobel, touchpad error', 'Keyboard', '{\"tp_mati\": {\"desc\": \"Touchpad sama sekali tidak merespon\", \"label\": \"Touchpad Mati Total\", \"symptoms\": [\"G020\"], \"engine_category\": \"Peripheral\"}, \"kb_dobel\": {\"desc\": \"Tekan sekali muncul dua kali\", \"label\": \"Dobel / Ketik Ganda\", \"symptoms\": [\"G059\"]}, \"tp_loncat\": {\"desc\": \"Cursor bergerak tidak beraturan\", \"label\": \"Cursor Loncat-loncat\", \"symptoms\": [\"G021\"], \"engine_category\": \"Peripheral\"}, \"kb_lengket\": {\"desc\": \"Tombol susah ditekan atau nyangkut\", \"label\": \"Tombol Lengket / Keras\", \"symptoms\": [\"G122\"]}, \"tp_gesture\": {\"desc\": \"Pinch zoom, swipe, dll tidak berfungsi\", \"label\": \"Gesture Tidak Jalan\", \"symptoms\": [\"G147\"], \"engine_category\": \"Peripheral\"}, \"kb_sebagian\": {\"desc\": \"Beberapa tombol tertentu bermasalah\", \"label\": \"Sebagian Tombol Mati\", \"symptoms\": [\"G010\"]}, \"kb_mati_total\": {\"desc\": \"Semua tombol tidak berfungsi\", \"label\": \"Keyboard Mati Total\", \"symptoms\": [\"G009\"]}, \"tp_scroll_mati\": {\"desc\": \"Bisa gerak tapi scroll mati\", \"label\": \"Scroll Tidak Berfungsi\", \"symptoms\": [\"G143\"], \"engine_category\": \"Peripheral\"}, \"kb_ketik_sendiri\": {\"desc\": \"Keyboard mengetik tanpa ditekan\", \"label\": \"Mengetik Sendiri\", \"symptoms\": [\"G011\"]}}', 1, 3, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(12, 1, 'Lemot & Error', 'laptop-software', '🐌', 'Lambat, hang, blue screen, hardisk', 'Performance', '{\"bsod\": {\"desc\": \"Muncul layar biru lalu restart\", \"label\": \"Blue Screen (BSOD)\", \"symptoms\": [\"G031\"], \"engine_category\": \"Software\"}, \"hang\": {\"desc\": \"Laptop macet tidak merespon\", \"label\": \"Sering Hang / Freeze\", \"symptoms\": [\"G041\"]}, \"lemot\": {\"desc\": \"Terasa sangat lambat saat dipakai\", \"label\": \"Laptop Lemot / Lambat\", \"symptoms\": [\"G043\"]}, \"virus\": {\"desc\": \"Muncul popup mencurigakan terus\", \"label\": \"Banyak Iklan / Popup\", \"symptoms\": [\"G039\"], \"engine_category\": \"Software\"}, \"bootloop\": {\"desc\": \"Laptop restart ulang terus-menerus\", \"label\": \"Restart Terus (Bootloop)\", \"symptoms\": [\"G160\"], \"engine_category\": \"Software\"}, \"game_lag\": {\"desc\": \"Patah-patah saat main game\", \"label\": \"Game / Aplikasi Berat Lag\", \"symptoms\": [\"G170\"]}, \"boot_lama\": {\"desc\": \"Loading startup sangat lambat\", \"label\": \"Booting Sangat Lama\", \"symptoms\": [\"G196\"], \"engine_category\": \"Storage\"}, \"hdd_bunyi\": {\"desc\": \"Terdengar suara berulang dari hardisk\", \"label\": \"HDD Bunyi Klik-klik\", \"symptoms\": [\"G061\"], \"engine_category\": \"Storage\"}, \"hdd_hilang\": {\"desc\": \"HDD/SSD hilang dari BIOS\", \"label\": \"HDD/SSD Tidak Terdeteksi\", \"symptoms\": [\"G060\"], \"engine_category\": \"Storage\"}, \"stuck_boot\": {\"desc\": \"Stuck di logo, loading terus\", \"label\": \"Tidak Bisa Masuk Windows\", \"symptoms\": [\"G158\"], \"engine_category\": \"Software\"}, \"transfer_lambat\": {\"desc\": \"Proses copy file sangat lelet\", \"label\": \"Transfer File Lambat\", \"symptoms\": [\"G199\"], \"engine_category\": \"Storage\"}}', 1, 4, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(13, 1, 'Koneksi & Port', 'laptop-koneksi', '📶', 'WiFi, USB, HDMI, Bluetooth', 'Network', '{\"hdmi\": {\"desc\": \"HDMI tidak menampilkan ke monitor\", \"label\": \"Port HDMI Rusak\", \"symptoms\": [\"G066\"], \"engine_category\": \"Peripheral\"}, \"webcam\": {\"desc\": \"Kamera laptop tidak berfungsi\", \"label\": \"Webcam Mati\", \"symptoms\": [\"G079\"], \"engine_category\": \"Peripheral\"}, \"usb_mati\": {\"desc\": \"USB tidak mendeteksi perangkat\", \"label\": \"Port USB Mati\", \"symptoms\": [\"G018\"], \"engine_category\": \"Peripheral\"}, \"bluetooth\": {\"desc\": \"Bluetooth tidak bisa diaktifkan\", \"label\": \"Bluetooth Mati\", \"symptoms\": [\"G017\"]}, \"wifi_mati\": {\"desc\": \"WiFi mati atau ikon hilang\", \"label\": \"WiFi Tidak Bisa Nyala\", \"symptoms\": [\"G014\"]}, \"wifi_putus\": {\"desc\": \"Koneksi sering disconnect sendiri\", \"label\": \"WiFi Sering Putus\", \"symptoms\": [\"G015\"]}, \"no_internet\": {\"desc\": \"Connected tapi tidak bisa browsing\", \"label\": \"Konek Tapi No Internet\", \"symptoms\": [\"G130\"]}, \"usb_longgar\": {\"desc\": \"USB goyang atau oblak\", \"label\": \"Port USB Longgar\", \"symptoms\": [\"G065\"], \"engine_category\": \"Peripheral\"}, \"sinyal_lemah\": {\"desc\": \"Hanya konek dari jarak dekat router\", \"label\": \"Sinyal Lemah\", \"symptoms\": [\"G129\"]}}', 1, 5, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(14, 1, 'Suara / Audio', 'laptop-suara', '🔊', 'Tidak ada suara, speaker pecah', 'Audio', '{\"mic\": {\"desc\": \"Mic tidak berfungsi saat call\", \"label\": \"Microphone Mati\", \"symptoms\": [\"G053\"]}, \"mati\": {\"desc\": \"Speaker laptop mati total\", \"label\": \"Tidak Ada Suara\", \"symptoms\": [\"G050\", \"G189\"]}, \"pecah\": {\"desc\": \"Suara pecah saat volume dinaikkan\", \"label\": \"Speaker Pecah / Kresek\", \"symptoms\": [\"G051\", \"G197\"]}, \"sebelah\": {\"desc\": \"Hanya keluar dari kiri atau kanan\", \"label\": \"Suara Satu Sisi Saja\", \"symptoms\": [\"G054\"]}}', 1, 6, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(15, 1, 'Panas & Fisik', 'laptop-fisik', '🌡️', 'Overheat, engsel, kena air, body', 'Thermal', '{\"casing\": {\"desc\": \"Body laptop ada retakan\", \"label\": \"Casing Retak / Pecah\", \"symptoms\": [\"G070\"], \"engine_category\": \"Physical\"}, \"engsel\": {\"desc\": \"Engsel longgar, patah, atau keras\", \"label\": \"Engsel Rusak / Patah\", \"symptoms\": [\"G071\"], \"engine_category\": \"Physical\"}, \"goyang\": {\"desc\": \"Layar tidak stabil saat disentuh\", \"label\": \"Layar Goyang / Oblak\", \"symptoms\": [\"G072\"], \"engine_category\": \"Physical\"}, \"air_mati\": {\"desc\": \"Laptop mati total setelah terkena cairan\", \"label\": \"Mati Setelah Kena Air\", \"symptoms\": [\"G090\", \"G092\"], \"engine_category\": \"Water Damage\"}, \"air_korosi\": {\"desc\": \"Terlihat korosi di komponen\", \"label\": \"Korosi / Karat\", \"symptoms\": [\"G094\"], \"engine_category\": \"Water Damage\"}, \"kipas_mati\": {\"desc\": \"Kipas mati sama sekali\", \"label\": \"Kipas Tidak Berputar\", \"symptoms\": [\"G047\"]}, \"mati_panas\": {\"desc\": \"Shutdown otomatis saat panas\", \"label\": \"Mati Karena Kepanasan\", \"symptoms\": [\"G049\"]}, \"cepat_panas\": {\"desc\": \"Panas meski hanya browsing ringan\", \"label\": \"Laptop Cepat Panas\", \"symptoms\": [\"G179\"]}, \"air_keyboard\": {\"desc\": \"Tombol error setelah ketumpahan\", \"label\": \"Keyboard Error Kena Air\", \"symptoms\": [\"G090\", \"G091\"], \"engine_category\": \"Water Damage\"}, \"air_sebagian\": {\"desc\": \"Nyala tapi beberapa fitur mati setelah kena air\", \"label\": \"Sebagian Fungsi Mati\", \"symptoms\": [\"G090\", \"G097\"], \"engine_category\": \"Water Damage\"}, \"kipas_berisik\": {\"desc\": \"Kipas bunyi kencang atau aneh\", \"label\": \"Kipas Berisik / Bunyi Kasar\", \"symptoms\": [\"G182\"]}}', 1, 7, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(16, 2, 'Mati / Daya', 'pc-daya', '🔌', 'Mati total, restart, bau terbakar, tidak POST', 'PSU', '{\"beep\": {\"desc\": \"Beep code atau LED error menyala\", \"label\": \"Bunyi Beep / Debug LED\", \"symptoms\": [\"PCG022\"], \"engine_category\": \"Motherboard\"}, \"no_post\": {\"desc\": \"PC nyala tapi layar blank\", \"label\": \"Tidak POST / Blank\", \"symptoms\": [\"PCG021\"], \"engine_category\": \"Motherboard\"}, \"restart\": {\"desc\": \"PC restart berulang tanpa sebab\", \"label\": \"Restart Sendiri\", \"symptoms\": [\"PCG003\"]}, \"mati_total\": {\"desc\": \"PC tidak mau menyala sama sekali\", \"label\": \"PC Mati Total\", \"symptoms\": [\"PCG001\"]}, \"daya_kurang\": {\"desc\": \"Komponen tidak mendapat daya cukup\", \"label\": \"Daya Kurang\", \"symptoms\": [\"PCG015\"]}, \"bau_terbakar\": {\"desc\": \"Ada bau hangus dari area PSU\", \"label\": \"Bau Terbakar PSU\", \"symptoms\": [\"PCG005\"]}, \"mati_sendiri\": {\"desc\": \"PC mati mendadak saat digunakan\", \"label\": \"Mati Tiba-tiba\", \"symptoms\": [\"PCG002\"]}, \"power_button\": {\"desc\": \"Tombol power casing tidak merespon\", \"label\": \"Tombol Power Mati\", \"symptoms\": [\"PCG119\"], \"engine_category\": \"Casing\"}, \"komponen_terbakar\": {\"desc\": \"Bau hangus dari dalam PC\", \"label\": \"Bau Terbakar Komponen\", \"symptoms\": [\"PCG028\"], \"engine_category\": \"Motherboard\"}}', 1, 1, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(17, 2, 'Performa & Software', 'pc-software', '🐌', 'Lemot, BSOD, virus, boot gagal, crash', 'Software', '{\"bsod\": {\"desc\": \"Sering muncul layar biru\", \"label\": \"Blue Screen (BSOD)\", \"symptoms\": [\"PCG193\"]}, \"crash\": {\"desc\": \"Freeze atau crash saat beban berat\", \"label\": \"Crash / Hang\", \"symptoms\": [\"PCG043\"], \"engine_category\": \"CPU\"}, \"lemot\": {\"desc\": \"Performa sangat lambat\", \"label\": \"PC Lemot\", \"symptoms\": [\"PCG194\"]}, \"virus\": {\"desc\": \"Banyak popup atau file hilang\", \"label\": \"Virus / Malware\", \"symptoms\": [\"PCG195\"]}, \"boot_gagal\": {\"desc\": \"Stuck di logo atau loading\", \"label\": \"Windows Gagal Boot\", \"symptoms\": [\"PCG196\"]}, \"storage_lambat\": {\"desc\": \"Buka file atau transfer data lambat\", \"label\": \"Storage Lambat\", \"symptoms\": [\"PCG104\"], \"engine_category\": \"Storage\"}}', 1, 2, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(18, 2, 'Panas & Kebisingan', 'pc-thermal', '🌡️', 'Overheat, kipas mati/berisik, liquid cooler', 'Thermal', '{\"bocor\": {\"desc\": \"Selang AIO/custom loop bocor\", \"label\": \"Liquid Cooler Bocor\", \"symptoms\": [\"PCG141\"]}, \"panas\": {\"desc\": \"Suhu keseluruhan tinggi\", \"label\": \"PC Overheat\", \"symptoms\": [\"PCG134\"]}, \"fan_cpu\": {\"desc\": \"Kipas CPU tidak berputar\", \"label\": \"Kipas CPU Mati\", \"symptoms\": [\"PCG050\"], \"engine_category\": \"CPU\"}, \"fan_casing\": {\"desc\": \"Kipas casing tidak berputar\", \"label\": \"Fan Casing Mati\", \"symptoms\": [\"PCG135\"]}, \"overheat_cpu\": {\"desc\": \"Suhu CPU sangat tinggi\", \"label\": \"CPU Overheat >90°C\", \"symptoms\": [\"PCG041\"], \"engine_category\": \"CPU\"}, \"liquid_cooler\": {\"desc\": \"AIO/liquid cooler tidak berfungsi\", \"label\": \"Liquid Cooler Error\", \"symptoms\": [\"PCG140\"]}, \"thermal_shutdown\": {\"desc\": \"PC mati otomatis saat overheat\", \"label\": \"Mati Karena Panas\", \"symptoms\": [\"PCG137\"]}}', 1, 3, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(19, 2, 'Grafis & Gaming', 'pc-grafis', '🎮', 'Artefak, crash gaming, GPU mati', 'GPU Diskrit', '{\"artefak\": {\"desc\": \"Glitch atau kotak warna di layar\", \"label\": \"Artefak Visual\", \"symptoms\": [\"PCG080\"]}, \"fan_gpu\": {\"desc\": \"Semua fan GPU tidak berputar\", \"label\": \"Fan GPU Mati\", \"symptoms\": [\"PCG083\"]}, \"gpu_hilang\": {\"desc\": \"GPU hilang dari Device Manager\", \"label\": \"GPU Tidak Terdeteksi\", \"symptoms\": [\"PCG079\"]}, \"crash_gaming\": {\"desc\": \"PC crash saat GPU load tinggi\", \"label\": \"Crash Saat Gaming\", \"symptoms\": [\"PCG081\"]}, \"overheat_gpu\": {\"desc\": \"Suhu GPU >90°C saat gaming\", \"label\": \"GPU Overheat\", \"symptoms\": [\"PCG082\"]}}', 1, 4, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(20, 2, 'Koneksi & Port', 'pc-koneksi', '🔗', 'LAN, WiFi, USB, keyboard, mouse', 'Network', '{\"wifi\": {\"desc\": \"WiFi card PCIe tidak berfungsi\", \"label\": \"WiFi Bermasalah\", \"symptoms\": [\"PCG165\"]}, \"mouse\": {\"desc\": \"Mouse tidak terbaca\", \"label\": \"Mouse Tidak Terdeteksi\", \"symptoms\": [\"PCG180\"], \"engine_category\": \"Peripheral\"}, \"putus\": {\"desc\": \"Koneksi tidak stabil\", \"label\": \"Internet Sering Putus\", \"symptoms\": [\"PCG169\"]}, \"keyboard\": {\"desc\": \"Keyboard tidak terbaca\", \"label\": \"Keyboard Tidak Terdeteksi\", \"symptoms\": [\"PCG181\"], \"engine_category\": \"Peripheral\"}, \"lan_mati\": {\"desc\": \"Port ethernet tidak berfungsi\", \"label\": \"LAN / Ethernet Mati\", \"symptoms\": [\"PCG164\"]}, \"usb_mati\": {\"desc\": \"Port USB tidak berfungsi\", \"label\": \"Port USB Mati\", \"symptoms\": [\"PCG178\"], \"engine_category\": \"Peripheral\"}, \"semua_usb\": {\"desc\": \"Seluruh port USB tidak jalan\", \"label\": \"Semua USB Mati\", \"symptoms\": [\"PCG183\"], \"engine_category\": \"Peripheral\"}, \"usb_depan\": {\"desc\": \"USB panel depan tidak berfungsi\", \"label\": \"USB Front Panel Mati\", \"symptoms\": [\"PCG121\"], \"engine_category\": \"Casing\"}}', 1, 5, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(21, 2, 'Audio & Suara', 'pc-audio', '🔊', 'Tidak ada suara, distorsi, mic mati', 'Audio', '{\"mic\": {\"desc\": \"Microphone tidak terdeteksi\", \"label\": \"Mic Tidak Berfungsi\", \"symptoms\": [\"PCG154\"]}, \"distorsi\": {\"desc\": \"Suara crackling atau pecah\", \"label\": \"Suara Distorsi\", \"symptoms\": [\"PCG150\"]}, \"no_sound\": {\"desc\": \"Speaker/headphone tidak bunyi\", \"label\": \"Tidak Ada Suara\", \"symptoms\": [\"PCG149\"]}, \"audio_depan\": {\"desc\": \"Jack audio front panel rusak\", \"label\": \"Audio Jack Depan Mati\", \"symptoms\": [\"PCG122\"], \"engine_category\": \"Casing\"}}', 1, 6, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(22, 3, 'Mati / Daya', 'aio-daya', '🔌', 'Mati total, tidak POST, restart, adaptor', 'Adaptor', '{\"beep\": {\"desc\": \"AIO beep saat dinyalakan\", \"label\": \"Bunyi Beep\", \"symptoms\": [\"AIOG057\"], \"engine_category\": \"Motherboard\"}, \"no_post\": {\"desc\": \"AIO nyala tapi layar blank\", \"label\": \"Tidak POST / Blank\", \"symptoms\": [\"AIOG043\"], \"engine_category\": \"Motherboard\"}, \"restart\": {\"desc\": \"AIO restart berulang kali\", \"label\": \"Restart Sendiri\", \"symptoms\": [\"AIOG015\"]}, \"mati_total\": {\"desc\": \"Tidak mau menyala sama sekali\", \"label\": \"AIO Mati Total\", \"symptoms\": [\"AIOG001\"]}, \"bau_terbakar\": {\"desc\": \"Ada bau hangus dari adaptor/AIO\", \"label\": \"Bau Terbakar\", \"symptoms\": [\"AIOG007\"]}, \"mati_sendiri\": {\"desc\": \"AIO mati mendadak saat digunakan\", \"label\": \"Mati Tiba-tiba\", \"symptoms\": [\"AIOG004\"]}, \"adaptor_rusak\": {\"desc\": \"Adaptor tidak berfungsi / mati\", \"label\": \"Adaptor Bermasalah\", \"symptoms\": [\"AIOG002\"]}}', 1, 1, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(23, 3, 'Layar & Touchscreen', 'aio-layar', '🖥️', 'Layar mati, bergaris, redup, touchscreen', 'Display', '{\"blank\": {\"desc\": \"Layar tidak menampilkan gambar\", \"label\": \"Layar Blank / Mati\", \"symptoms\": [\"AIOG016\"]}, \"pecah\": {\"desc\": \"Layar retak atau pecah fisik\", \"label\": \"Layar Pecah\", \"symptoms\": [\"AIOG020\"]}, \"redup\": {\"desc\": \"Backlight sangat lemah\", \"label\": \"Layar Redup\", \"symptoms\": [\"AIOG018\"]}, \"artefak\": {\"desc\": \"Glitch atau kotak warna di layar\", \"label\": \"Artefak Visual\", \"symptoms\": [\"AIOG027\"]}, \"ts_mati\": {\"desc\": \"Sentuhan tidak merespon\", \"label\": \"Touchscreen Tidak Respon\", \"symptoms\": [\"AIOG031\"], \"engine_category\": \"Touchscreen\"}, \"bergaris\": {\"desc\": \"Ada garis vertikal/horizontal\", \"label\": \"Layar Bergaris\", \"symptoms\": [\"AIOG017\"]}, \"ghost_touch\": {\"desc\": \"Layar sentuh klik sendiri\", \"label\": \"Ghost Touch\", \"symptoms\": [\"AIOG032\"], \"engine_category\": \"Touchscreen\"}, \"ts_sebagian\": {\"desc\": \"Hanya area tertentu responsif\", \"label\": \"Touchscreen Sebagian Mati\", \"symptoms\": [\"AIOG033\"], \"engine_category\": \"Touchscreen\"}}', 1, 2, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(24, 3, 'Performa & Software', 'aio-software', '🐌', 'Lemot, BSOD, virus, boot gagal, crash', 'Software', '{\"bsod\": {\"desc\": \"Sering muncul layar biru\", \"label\": \"Blue Screen (BSOD)\", \"symptoms\": [\"AIOG150\"]}, \"crash\": {\"desc\": \"Freeze atau crash saat beban berat\", \"label\": \"Crash / Hang\", \"symptoms\": [\"AIOG060\"], \"engine_category\": \"CPU\"}, \"lemot\": {\"desc\": \"Performa sangat lambat\", \"label\": \"AIO Lemot\", \"symptoms\": [\"AIOG151\"]}, \"virus\": {\"desc\": \"Banyak popup atau file hilang\", \"label\": \"Virus / Malware\", \"symptoms\": [\"AIOG152\"]}, \"boot_gagal\": {\"desc\": \"Stuck di logo atau loading\", \"label\": \"Windows Gagal Boot\", \"symptoms\": [\"AIOG153\"]}, \"storage_lambat\": {\"desc\": \"Buka file atau transfer data lambat\", \"label\": \"Storage Lambat\", \"symptoms\": [\"AIOG086\"], \"engine_category\": \"Storage\"}}', 1, 3, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(25, 3, 'Panas & Kebisingan', 'aio-thermal', '🌡️', 'Overheat, kipas mati/berisik, debu', 'Thermal', '{\"debu\": {\"desc\": \"Ventilasi tersumbat debu\", \"label\": \"Ventilasi Tersumbat\", \"symptoms\": [\"AIOG099\"]}, \"panas\": {\"desc\": \"Belakang AIO sangat panas\", \"label\": \"Body AIO Panas\", \"symptoms\": [\"AIOG093\"]}, \"kipas_mati\": {\"desc\": \"Kipas internal tidak berfungsi\", \"label\": \"Kipas Tidak Berputar\", \"symptoms\": [\"AIOG095\"]}, \"overheat_cpu\": {\"desc\": \"Suhu CPU sangat tinggi\", \"label\": \"CPU Overheat >90°C\", \"symptoms\": [\"AIOG058\"], \"engine_category\": \"CPU\"}, \"thermal_shutdown\": {\"desc\": \"AIO mati otomatis saat overheat\", \"label\": \"Mati Karena Panas\", \"symptoms\": [\"AIOG096\"]}}', 1, 4, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(26, 3, 'Audio & Kamera', 'aio-multimedia', '🔊', 'Speaker mati, mic, webcam bermasalah', 'Audio', '{\"mic\": {\"desc\": \"Microphone internal mati\", \"label\": \"Mic Tidak Berfungsi\", \"symptoms\": [\"AIOG110\"]}, \"distorsi\": {\"desc\": \"Suara pecah atau crackling\", \"label\": \"Suara Distorsi\", \"symptoms\": [\"AIOG107\"]}, \"no_sound\": {\"desc\": \"Speaker built-in mati total\", \"label\": \"Tidak Ada Suara\", \"symptoms\": [\"AIOG106\"]}, \"webcam_mati\": {\"desc\": \"Kamera built-in tidak berfungsi\", \"label\": \"Webcam Mati\", \"symptoms\": [\"AIOG129\"], \"engine_category\": \"Webcam\"}, \"webcam_buram\": {\"desc\": \"Kamera buram atau tidak fokus\", \"label\": \"Webcam Buram\", \"symptoms\": [\"AIOG131\"], \"engine_category\": \"Webcam\"}, \"webcam_hitam\": {\"desc\": \"Kamera menampilkan layar hitam\", \"label\": \"Webcam Layar Hitam\", \"symptoms\": [\"AIOG132\"], \"engine_category\": \"Webcam\"}}', 1, 5, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(27, 3, 'Koneksi & Port', 'aio-koneksi', '🔗', 'WiFi, LAN, Bluetooth, USB, keyboard', 'Konektivitas', '{\"wifi\": {\"desc\": \"WiFi hilang atau mati\", \"label\": \"WiFi Tidak Terdeteksi\", \"symptoms\": [\"AIOG117\"]}, \"mouse\": {\"desc\": \"Mouse bawaan tidak respon\", \"label\": \"Mouse Tidak Berfungsi\", \"symptoms\": [\"AIOG144\"], \"engine_category\": \"Peripheral\"}, \"keyboard\": {\"desc\": \"Keyboard bawaan tidak respon\", \"label\": \"Keyboard Tidak Berfungsi\", \"symptoms\": [\"AIOG143\"], \"engine_category\": \"Peripheral\"}, \"lan_mati\": {\"desc\": \"Port ethernet tidak berfungsi\", \"label\": \"LAN Mati\", \"symptoms\": [\"AIOG119\"]}, \"usb_mati\": {\"desc\": \"Port USB tidak berfungsi\", \"label\": \"Port USB Mati\", \"symptoms\": [\"AIOG139\"], \"engine_category\": \"Peripheral\"}, \"bluetooth\": {\"desc\": \"Bluetooth tidak berfungsi\", \"label\": \"Bluetooth Mati\", \"symptoms\": [\"AIOG120\"]}, \"semua_usb\": {\"desc\": \"Seluruh port USB AIO mati\", \"label\": \"Semua USB Mati\", \"symptoms\": [\"AIOG146\"], \"engine_category\": \"Peripheral\"}, \"wifi_putus\": {\"desc\": \"Koneksi WiFi tidak stabil\", \"label\": \"WiFi Sering Putus\", \"symptoms\": [\"AIOG118\"]}}', 1, 6, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(28, 4, 'Kualitas Cetak', 'printer-kualitas', '📄', 'Bergaris, pudar, kotor', 'Kualitas Cetak', '{\"kotor\": {\"desc\": \"Ada noda atau bercak di cetakan\", \"label\": \"Cetakan Kotor/Noda\", \"symptoms\": [\"PRG005\"]}, \"pudar\": {\"desc\": \"Hasil cetak terlalu pudar/memudar\", \"label\": \"Cetakan Pudar\", \"symptoms\": [\"PRG003\"]}, \"bergaris\": {\"desc\": \"Ada garis horizontal pada cetakan\", \"label\": \"Cetakan Bergaris\", \"symptoms\": [\"PRG001\"]}, \"tidak_rata\": {\"desc\": \"Teks geser atau ada gap\", \"label\": \"Teks Tidak Rata\", \"symptoms\": [\"PRG013\"]}, \"warna_hilang\": {\"desc\": \"Satu atau lebih warna tidak keluar\", \"label\": \"Warna Hilang\", \"symptoms\": [\"PRG015\"]}}', 1, 1, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(29, 4, 'Tinta / Toner', 'printer-tinta', '🫗', 'Habis, bocor, error cartridge', 'Tinta', '{\"bocor\": {\"desc\": \"Tinta menetes dari cartridge\", \"label\": \"Tinta Bocor\", \"symptoms\": [\"PRG018\"]}, \"habis\": {\"desc\": \"Indikator tinta rendah menyala\", \"label\": \"Tinta/Toner Habis\", \"symptoms\": [\"PRG016\"]}, \"infus\": {\"desc\": \"Selang infus tersumbat/bocor\", \"label\": \"Infus Bermasalah\", \"symptoms\": [\"PRG027\"]}, \"waste_full\": {\"desc\": \"Error waste ink absorber penuh\", \"label\": \"Waste Ink Penuh\", \"symptoms\": [\"PRG026\"]}, \"tidak_deteksi\": {\"desc\": \"Cartridge tidak terdeteksi\", \"label\": \"Cartridge Error\", \"symptoms\": [\"PRG017\"]}}', 1, 2, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(30, 4, 'Kertas / Paper Feed', 'printer-kertas', '📋', 'Macet, tidak tertarik, miring', 'Kertas', '{\"adf\": {\"desc\": \"Auto document feeder error\", \"label\": \"ADF Bermasalah\", \"symptoms\": [\"PRG042\"]}, \"macet\": {\"desc\": \"Kertas nyangkut di dalam printer\", \"label\": \"Kertas Macet (Jam)\", \"symptoms\": [\"PRG031\"]}, \"miring\": {\"desc\": \"Kertas masuk miring ke printer\", \"label\": \"Kertas Miring\", \"symptoms\": [\"PRG034\"]}, \"tidak_tarik\": {\"desc\": \"Printer tidak mengambil kertas\", \"label\": \"Tidak Menarik Kertas\", \"symptoms\": [\"PRG032\"]}}', 1, 3, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(31, 4, 'Koneksi Printer', 'printer-koneksi', '🔌', 'USB, WiFi, offline', 'Konektivitas', '{\"usb\": {\"desc\": \"Printer tidak muncul via USB\", \"label\": \"USB Tidak Terdeteksi\", \"symptoms\": [\"PRG046\"]}, \"wifi\": {\"desc\": \"Tidak bisa konek ke WiFi\", \"label\": \"WiFi Printer Error\", \"symptoms\": [\"PRG047\"]}, \"offline\": {\"desc\": \"Status offline padahal nyala\", \"label\": \"Printer Offline\", \"symptoms\": [\"PRG048\"]}, \"sharing\": {\"desc\": \"Tidak bisa print dari PC lain\", \"label\": \"Sharing Error\", \"symptoms\": [\"PRG054\"]}}', 1, 4, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(32, 4, 'Hardware Printer', 'printer-hardware_printer', '🔧', 'Mati, error, LCD rusak', 'Hardware', '{\"mati\": {\"desc\": \"Tidak mau menyala\", \"label\": \"Printer Mati Total\", \"symptoms\": [\"PRG061\"]}, \"panas\": {\"desc\": \"Printer sangat panas\", \"label\": \"Printer Overheat\", \"symptoms\": [\"PRG071\"]}, \"error_lcd\": {\"desc\": \"Layar panel printer bermasalah\", \"label\": \"LCD Panel Rusak\", \"symptoms\": [\"PRG063\"]}, \"tidak_respon\": {\"desc\": \"Nyala tapi tidak merespon\", \"label\": \"Tidak Merespon\", \"symptoms\": [\"PRG062\"]}}', 1, 5, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(33, 4, 'Software & Driver', 'printer-driver', '💿', 'Driver error, queue stuck', 'Software', '{\"queue\": {\"desc\": \"Print queue stuck\", \"label\": \"Antrian Cetak Macet\", \"symptoms\": [\"PRG081\"]}, \"driver\": {\"desc\": \"Driver unavailable atau corrupt\", \"label\": \"Driver Error\", \"symptoms\": [\"PRG076\"]}, \"spooler\": {\"desc\": \"Print spooler crash\", \"label\": \"Spooler Error\", \"symptoms\": [\"PRG058\"]}}', 1, 6, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(34, 4, 'Mekanik Printer', 'printer-mekanik', '⚙️', 'Bunyi kasar, macet, belt', 'Mekanik', '{\"gear\": {\"desc\": \"Bunyi klik dari gear\", \"label\": \"Gear Rusak\", \"symptoms\": [\"PRG093\"]}, \"bunyi\": {\"desc\": \"Printer berbunyi kasar/grinding\", \"label\": \"Bunyi Abnormal\", \"symptoms\": [\"PRG096\"]}, \"head_macet\": {\"desc\": \"Head printer tidak bergerak\", \"label\": \"Head/Carriage Macet\", \"symptoms\": [\"PRG097\"]}}', 1, 7, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(35, 4, 'Scanner / Copy', 'printer-scanner', '📷', 'Scan gagal, bergaris, ADF', 'Scanner', '{\"bergaris\": {\"desc\": \"Garis pada hasil scan\", \"label\": \"Hasil Scan Bergaris\", \"symptoms\": [\"PRG137\"]}, \"copy_buruk\": {\"desc\": \"Hasil fotocopy jelek\", \"label\": \"Kualitas Copy Buruk\", \"symptoms\": [\"PRG144\"]}, \"tidak_scan\": {\"desc\": \"Scanner tidak merespon\", \"label\": \"Scanner Tidak Berfungsi\", \"symptoms\": [\"PRG136\"]}}', 1, 8, '2026-04-01 05:49:18', '2026-04-01 05:59:41');

-- --------------------------------------------------------

--
-- Table structure for table `device_types`
--

CREATE TABLE `device_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order_column` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `device_types`
--

INSERT INTO `device_types` (`id`, `name`, `slug`, `icon`, `description`, `is_active`, `order_column`, `created_at`, `updated_at`) VALUES
(1, 'Laptop', 'laptop', '💻', 'Laptop, Notebook, Ultrabook', 1, 1, '2026-04-01 05:48:58', '2026-04-01 05:59:41'),
(2, 'PC Desktop', 'pc', '🖥️', 'PC Rakitan, Tower, Desktop', 1, 2, '2026-04-01 05:48:58', '2026-04-01 05:59:41'),
(3, 'All-in-One', 'aio', '🖥️', 'AIO PC, Layar bawaan terintegrasi', 1, 3, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(4, 'Printer', 'printer', '🖨️', 'Inkjet, Laser, MFP/Scanner', 1, 4, '2026-04-01 05:49:18', '2026-04-01 05:59:41');

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis_history`
--

CREATE TABLE `diagnosis_history` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `result_disease_id` bigint UNSIGNED NOT NULL,
  `confidence_score` decimal(5,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diseases`
--

CREATE TABLE `diseases` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'laptop',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `solution` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `actions` text COLLATE utf8mb4_unicode_ci,
  `min_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `max_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `level` enum('Ringan','Sedang','Berat') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Ringan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `device_type_id` bigint UNSIGNED DEFAULT NULL,
  `device_component_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diseases`
--

INSERT INTO `diseases` (`id`, `code`, `device_type`, `name`, `description`, `category`, `solution`, `actions`, `min_cost`, `max_cost`, `level`, `created_at`, `updated_at`, `device_type_id`, `device_component_id`) VALUES
(1, 'K001', 'laptop', 'Kerusakan Panel LCD', 'Panel LCD internal mengalami kerusakan fisik atau elektronik', 'Display', 'Ganti panel LCD dengan yang baru sesuai tipe laptop', '[\"Ganti panel LCD dengan yang baru sesuai tipe laptop\"]', '500000.00', '2500000.00', 'Sedang', '2026-03-12 15:25:38', '2026-04-01 06:24:58', 1, 9),
(2, 'K002', 'laptop', 'Kabel Flexible LCD Rusak/Longgar', 'Kabel flexible yang menghubungkan LCD ke motherboard rusak atau terlepas', 'laptop-layar', 'Periksa dan kencangkan konektor atau ganti kabel flexible LCD', '[\"Periksa dan kencangkan konektor atau ganti kabel flexible LCD\"]', '50000.00', '500000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 08:08:36', 1, 9),
(3, 'K003', 'laptop', 'Backlight/Inverter Rusak', 'Lampu backlight atau inverter tidak berfungsi sehingga layar redup', 'Display', 'Ganti backlight LED strip atau inverter board', '[\"Ganti backlight LED strip atau inverter board\"]', '200000.00', '800000.00', 'Sedang', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 9),
(4, 'K004', 'laptop', 'GPU/VGA Bermasalah (Artifak Display)', 'Chip grafis (GPU) mengalami kerusakan sehingga muncul artifak pada layar', 'Display', 'Kemungkinan masalah pada chip grafis (GPU). Diperlukan pemeriksaan lebih lanjut pada Mainboard oleh teknisi', '[\"Kemungkinan masalah pada chip grafis (GPU). Diperlukan pemeriksaan lebih lanjut pada Mainboard oleh teknisi\"]', '500000.00', '2000000.00', 'Berat', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 9),
(5, 'K005', 'laptop', 'LCD Pecah Fisik', 'Panel LCD mengalami kerusakan fisik (retak/pecah)', 'Display', 'Ganti panel LCD baru', '[\"Ganti panel LCD baru\"]', '600000.00', '3000000.00', 'Sedang', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 9),
(6, 'K038', 'laptop', 'Dead Pixel pada Panel LCD', 'Panel LCD memiliki titik pixel yang mati/stuck', 'Display', 'Ganti panel LCD jika dead pixel banyak, atau gunakan software pixel fix', '[\"Ganti panel LCD jika dead pixel banyak, atau gunakan software pixel fix\"]', '500000.00', '2500000.00', 'Sedang', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 9),
(7, 'K039', 'laptop', 'Digitizer/Touchscreen Rusak', 'Digitizer touchscreen tidak merespon sentuhan atau ghost touch', 'Display', 'Ganti digitizer/touchscreen assembly', '[\"Ganti digitizer\\/touchscreen assembly\"]', '600000.00', '3500000.00', 'Sedang', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 9),
(8, 'K040', 'laptop', 'Panel LCD White Spot/Pressure Mark', 'Panel LCD memiliki bercak putih akibat tekanan pada panel', 'Display', 'Ganti panel LCD', '[\"Ganti panel LCD\"]', '500000.00', '2500000.00', 'Sedang', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 9),
(9, 'K041', 'laptop', 'IC Display/T-CON Bermasalah', 'IC pengontrol display (T-CON board) bermasalah menyebabkan separuh layar mati', 'Display', 'Kemungkinan kerusakan pada IC Display. Diperlukan pemeriksaan lebih lanjut pada Mainboard oleh teknisi', '[\"Kemungkinan kerusakan pada IC Display. Diperlukan pemeriksaan lebih lanjut pada Mainboard oleh teknisi\"]', '300000.00', '1000000.00', 'Sedang', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 9),
(10, 'K042', 'laptop', 'LCD Aging/Degradasi Panel', 'Panel LCD mengalami degradasi karena usia pemakaian, warna menguning atau pudar', 'Display', 'Ganti panel LCD baru', '[\"Ganti panel LCD baru\"]', '500000.00', '2500000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 9),
(11, 'K006', 'laptop', 'Keyboard Internal Rusak', 'Keyboard laptop rusak dan perlu diganti', 'Keyboard', 'Ganti keyboard internal dengan yang baru sesuai tipe', '[\"Ganti keyboard internal dengan yang baru sesuai tipe\"]', '150000.00', '600000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 11),
(12, 'K007', 'laptop', 'Konektor Keyboard Bermasalah', 'Konektor atau jalur keyboard pada motherboard bermasalah', 'Keyboard', 'Periksa dan perbaiki konektor keyboard', '[\"Periksa dan perbaiki konektor keyboard\"]', '100000.00', '300000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 11),
(13, 'K008', 'laptop', 'Keyboard Short/Korslet', 'Terjadi short circuit pada keyboard akibat cairan atau debu', 'Keyboard', 'Bersihkan atau ganti keyboard', '[\"Bersihkan atau ganti keyboard\"]', '100000.00', '500000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 11),
(14, 'K043', 'laptop', 'Keycap/Tombol Mekanis Rusak', 'Keycap atau mekanisme pengunci tombol patah', 'Keyboard', 'Ganti keycap individual atau ganti keyboard jika banyak', '[\"Ganti keycap individual atau ganti keyboard jika banyak\"]', '50000.00', '300000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 11),
(15, 'K044', 'laptop', 'Keyboard Membrane Aus', 'Lapisan membrane keyboard sudah aus/tipis', 'Keyboard', 'Ganti keyboard internal', '[\"Ganti keyboard internal\"]', '150000.00', '500000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 11),
(16, 'K045', 'laptop', 'Backlight Keyboard Rusak', 'LED backlight keyboard tidak menyala', 'Keyboard', 'Perbaiki kabel backlight atau ganti keyboard', '[\"Perbaiki kabel backlight atau ganti keyboard\"]', '150000.00', '500000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 11),
(17, 'K046', 'laptop', 'Driver/Firmware Keyboard Error', 'Driver keyboard corrupt atau firmware bermasalah', 'Keyboard', 'Install ulang driver keyboard, update BIOS jika perlu', '[\"Install ulang driver keyboard, update BIOS jika perlu\"]', '50000.00', '150000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 11),
(18, 'K047', 'laptop', 'Jalur PCB Keyboard Putus', 'Jalur konduktif pada PCB keyboard terputus atau korosi', 'Keyboard', 'Ganti keyboard internal', '[\"Ganti keyboard internal\"]', '150000.00', '600000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 11),
(19, 'K009', 'laptop', 'Modul WiFi Rusak', 'Modul WiFi internal tidak berfungsi', 'Network', 'Ganti modul WiFi dengan yang kompatibel', '[\"Ganti modul WiFi dengan yang kompatibel\"]', '100000.00', '400000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 13),
(20, 'K010', 'laptop', 'Driver WiFi Bermasalah', 'Driver WiFi corrupt atau tidak kompatibel', 'Network', 'Uninstall dan install ulang driver WiFi yang tepat', '[\"Uninstall dan install ulang driver WiFi yang tepat\"]', '50000.00', '150000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 13),
(21, 'K048', 'laptop', 'Antena WiFi Internal Putus/Rusak', 'Kabel antena WiFi yang terhubung ke modul terputus atau rusak', 'Network', 'Ganti atau repair kabel antena WiFi internal', '[\"Ganti atau repair kabel antena WiFi internal\"]', '100000.00', '300000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 13),
(22, 'K049', 'laptop', 'Modul Bluetooth Rusak', 'Chip Bluetooth internal rusak atau tidak berfungsi', 'Network', 'Ganti modul Bluetooth (biasanya combo dengan WiFi)', '[\"Ganti modul Bluetooth (biasanya combo dengan WiFi)\"]', '100000.00', '400000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 13),
(23, 'K050', 'laptop', 'Driver Bluetooth Bermasalah', 'Driver Bluetooth corrupt atau tidak kompatibel', 'Network', 'Install ulang driver Bluetooth', '[\"Install ulang driver Bluetooth\"]', '50000.00', '150000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 13),
(24, 'K051', 'laptop', 'Port Ethernet/LAN Rusak', 'Port RJ45 Ethernet rusak secara fisik atau IC LAN bermasalah', 'Network', 'Perbaiki atau ganti port LAN, atau gunakan USB LAN adapter', '[\"Perbaiki atau ganti port LAN, atau gunakan USB LAN adapter\"]', '100000.00', '400000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 13),
(25, 'K052', 'laptop', 'Pengaturan Network Error (Software)', 'Konfigurasi jaringan corrupt, DNS/IP salah, atau services tidak jalan', 'Network', 'Reset network settings, flush DNS, restart services', '[\"Reset network settings, flush DNS, restart services\"]', '50000.00', '150000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 13),
(26, 'K053', 'laptop', 'IC WiFi pada Motherboard Rusak', 'IC pengontrol wireless pada motherboard mengalami kerusakan', 'Network', 'Kemungkinan kerusakan IC WiFi pada Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi', '[\"Kemungkinan kerusakan IC WiFi pada Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi\"]', '300000.00', '800000.00', 'Sedang', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 13),
(27, 'K011', 'laptop', 'Port USB Rusak', 'Port USB fisik rusak atau bermasalah pada jalur motherboard', 'Peripheral', 'Perbaiki atau ganti port USB', '[\"Perbaiki atau ganti port USB\"]', '100000.00', '400000.00', 'Ringan', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(28, 'K012', 'laptop', 'Touchpad Bermasalah', 'Touchpad rusak atau driver bermasalah', 'Peripheral', 'Install ulang driver atau ganti touchpad', '[\"Install ulang driver atau ganti touchpad\"]', '100000.00', '500000.00', 'Ringan', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(29, 'K013', 'laptop', 'Webcam/Kamera Rusak', 'Modul webcam atau driver bermasalah', 'Peripheral', 'Install ulang driver atau ganti modul kamera', '[\"Install ulang driver atau ganti modul kamera\"]', '100000.00', '400000.00', 'Ringan', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(30, 'K054', 'laptop', 'Port HDMI Rusak', 'Port HDMI fisik rusak atau IC HDMI bermasalah', 'Peripheral', 'Perbaiki atau ganti port HDMI', '[\"Perbaiki atau ganti port HDMI\"]', '150000.00', '500000.00', 'Ringan', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(31, 'K055', 'laptop', 'Port USB Type-C Rusak', 'Port USB-C/Thunderbolt rusak atau konektor bermasalah', 'Peripheral', 'Perbaiki atau ganti port USB-C', '[\"Perbaiki atau ganti port USB-C\"]', '200000.00', '600000.00', 'Sedang', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(32, 'K056', 'laptop', 'Optical Drive Rusak', 'DVD/CD drive tidak bisa membaca disk atau mekanik macet', 'Peripheral', 'Ganti optical drive atau gunakan external drive', '[\"Ganti optical drive atau gunakan external drive\"]', '150000.00', '400000.00', 'Ringan', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(33, 'K057', 'laptop', 'Card Reader Rusak', 'Slot card reader rusak atau IC controller bermasalah', 'Peripheral', 'Perbaiki atau ganti card reader module', '[\"Perbaiki atau ganti card reader module\"]', '100000.00', '300000.00', 'Ringan', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(34, 'K058', 'laptop', 'Sensor Fingerprint Rusak', 'Sensor sidik jari rusak atau kabel konektor bermasalah', 'Peripheral', 'Ganti modul fingerprint sensor', '[\"Ganti modul fingerprint sensor\"]', '150000.00', '500000.00', 'Ringan', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(35, 'K059', 'laptop', 'Driver Touchpad Bermasalah', 'Driver touchpad corrupt, tidak terinstall, atau conflict', 'Peripheral', 'Install ulang driver touchpad (Synaptics/ELAN/Precision)', '[\"Install ulang driver touchpad (Synaptics\\/ELAN\\/Precision)\"]', '50000.00', '150000.00', 'Ringan', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(36, 'K060', 'laptop', 'Driver Webcam Bermasalah', 'Driver kamera corrupt atau privacy setting memblokir akses', 'Peripheral', 'Install ulang driver webcam, periksa privacy settings', '[\"Install ulang driver webcam, periksa privacy settings\"]', '50000.00', '150000.00', 'Ringan', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(37, 'K061', 'laptop', 'Port Charging/DC Jack Rusak', 'Port charger rusak secara fisik, pin patah atau longgar', 'Peripheral', 'Ganti DC jack / port charging', '[\"Ganti DC jack \\/ port charging\"]', '100000.00', '400000.00', 'Ringan', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(38, 'K062', 'laptop', 'IC USB Controller Motherboard Rusak', 'IC pengontrol USB pada motherboard rusak menyebabkan semua port USB bermasalah', 'Peripheral', 'Kemungkinan kerusakan IC USB Controller pada Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi', '[\"Kemungkinan kerusakan IC USB Controller pada Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi\"]', '300000.00', '1000000.00', 'Berat', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(39, 'K014', 'laptop', 'Kerusakan IC Power Motherboard', 'IC Power pada motherboard rusak', 'Power', 'Kemungkinan kerusakan pada bagian Mainboard (jalur power). Diperlukan pemeriksaan lebih lanjut oleh teknisi', '[\"Kemungkinan kerusakan pada bagian Mainboard (jalur power). Diperlukan pemeriksaan lebih lanjut oleh teknisi\"]', '300000.00', '1000000.00', 'Berat', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 10),
(40, 'K015', 'laptop', 'Baterai Drop/Rusak', 'Baterai sudah tidak bisa menyimpan daya dengan baik', 'Power', 'Ganti baterai dengan yang baru', '[\"Ganti baterai dengan yang baru\"]', '300000.00', '1200000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 10),
(41, 'K016', 'laptop', 'Port DC Jack/Charging Rusak', 'Port charger rusak atau longgar', 'Power', 'Ganti atau perbaiki port DC Jack', '[\"Ganti atau perbaiki port DC Jack\"]', '100000.00', '400000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 10),
(42, 'K017', 'laptop', 'IC Charging Bermasalah', 'IC yang mengatur pengisian baterai rusak', 'Power', 'Kemungkinan kerusakan pada IC Charging di Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi', '[\"Kemungkinan kerusakan pada IC Charging di Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi\"]', '200000.00', '600000.00', 'Sedang', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 10),
(43, 'K018', 'laptop', 'Adaptor Charger Rusak', 'Adaptor charger tidak berfungsi dengan baik', 'Power', 'Ganti adaptor charger original atau kompatibel', '[\"Ganti adaptor charger original atau kompatibel\"]', '150000.00', '600000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 10),
(44, 'K063', 'laptop', 'Baterai Kembung (Swollen Battery)', 'Baterai mengembang karena degradasi kimia, berbahaya', 'Power', 'Segera lepas dan ganti baterai, jangan gunakan baterai kembung', '[\"Segera lepas dan ganti baterai, jangan gunakan baterai kembung\"]', '300000.00', '1200000.00', 'Berat', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 10),
(45, 'K064', 'laptop', 'Tombol Power Rusak', 'Tombol power atau kabel flex tombol power rusak', 'Power', 'Ganti tombol power atau kabel flex-nya', '[\"Ganti tombol power atau kabel flex-nya\"]', '100000.00', '350000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 10),
(46, 'K065', 'laptop', 'Motherboard Short Circuit', 'Motherboard mengalami short circuit pada jalur power', 'Power', 'Kemungkinan short circuit pada Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi', '[\"Kemungkinan short circuit pada Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi\"]', '300000.00', '1500000.00', 'Berat', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 10),
(47, 'K066', 'laptop', 'Konektor Baterai Bermasalah', 'Konektor yang menghubungkan baterai ke motherboard rusak atau korosi', 'Power', 'Bersihkan atau ganti konektor baterai', '[\"Bersihkan atau ganti konektor baterai\"]', '100000.00', '300000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 10),
(48, 'K067', 'laptop', 'Adaptor Tidak Sesuai Spesifikasi', 'Adaptor yang digunakan wattage-nya kurang atau tidak original', 'Power', 'Ganti dengan adaptor original atau yang sesuai spesifikasi', '[\"Ganti dengan adaptor original atau yang sesuai spesifikasi\"]', '150000.00', '600000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 10),
(49, 'K019', 'laptop', 'Kerusakan Sistem Operasi (OS Corrupt)', 'File-file sistem operasi corrupt atau rusak', 'Software', 'Install ulang Windows/OS atau repair menggunakan recovery tools', '[\"Install ulang Windows\\/OS atau repair menggunakan recovery tools\"]', '100000.00', '300000.00', 'Ringan', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(50, 'K068', 'laptop', 'Infeksi Virus/Malware', 'Laptop terinfeksi virus, malware, atau ransomware', 'Software', 'Scan dan remove virus, install ulang OS jika parah', '[\"Scan dan remove virus, install ulang OS jika parah\"]', '50000.00', '300000.00', 'Ringan', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(51, 'K069', 'laptop', 'Driver Tidak Kompatibel', 'Driver hardware tidak cocok atau corrupt setelah update', 'Software', 'Rollback driver, install driver yang sesuai versi hardware', '[\"Rollback driver, install driver yang sesuai versi hardware\"]', '50000.00', '150000.00', 'Ringan', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(52, 'K070', 'laptop', 'Boot Sector/MBR Rusak', 'Master Boot Record (MBR) atau boot sector corrupt', 'Software', 'Repair MBR menggunakan bootable USB, rebuild BCD', '[\"Repair MBR menggunakan bootable USB, rebuild BCD\"]', '100000.00', '200000.00', 'Ringan', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(53, 'K071', 'laptop', 'Hard Drive Failing (Terkait Software)', 'Hard drive mulai bermasalah menyebabkan OS tidak stabil', 'Software', 'Backup data, clone ke drive baru, ganti hard drive', '[\"Backup data, clone ke drive baru, ganti hard drive\"]', '200000.00', '800000.00', 'Sedang', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(54, 'K072', 'laptop', 'Registry Windows Corrupt', 'Registry Windows rusak atau corrupt akibat malware/uninstall paksa', 'Software', 'Repair registry atau install ulang Windows', '[\"Repair registry atau install ulang Windows\"]', '100000.00', '250000.00', 'Ringan', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(55, 'K073', 'laptop', 'Partisi Tabel Rusak (GPT/MBR Error)', 'Tabel partisi rusak sehingga OS tidak bisa diakses', 'Software', 'Repair partition table, backup dan format ulang disk', '[\"Repair partition table, backup dan format ulang disk\"]', '100000.00', '300000.00', 'Sedang', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(56, 'K074', 'laptop', 'Windows Update Gagal/Corrupt', 'File update Windows corrupt menyebabkan masalah booting', 'Software', 'Reset Windows Update components, repair SFC/DISM', '[\"Reset Windows Update components, repair SFC\\/DISM\"]', '50000.00', '200000.00', 'Ringan', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(57, 'K075', 'laptop', 'BIOS/UEFI Firmware Corrupt', 'BIOS/UEFI firmware rusak menyebabkan laptop stuck', 'Software', 'Flash ulang BIOS/UEFI, gunakan recovery BIOS', '[\"Flash ulang BIOS\\/UEFI, gunakan recovery BIOS\"]', '100000.00', '400000.00', 'Sedang', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(58, 'K076', 'laptop', 'Ransomware Attack', 'File pengguna terenkripsi oleh ransomware', 'Software', 'Decrypt jika tersedia tools, format dan install ulang, restore backup', '[\"Decrypt jika tersedia tools, format dan install ulang, restore backup\"]', '200000.00', '500000.00', 'Berat', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(59, 'K020', 'laptop', 'RAM Tidak Memadai / Rusak', 'Kapasitas RAM terlalu kecil atau modul RAM bermasalah', 'Performance', 'Upgrade RAM atau ganti modul RAM yang rusak', '[\"Upgrade RAM atau ganti modul RAM yang rusak\"]', '200000.00', '1000000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 12),
(60, 'K021', 'laptop', 'Hard Drive Lambat / Degradasi', 'Hard drive HDD sudah tua atau mengalami degradasi performa', 'Performance', 'Upgrade ke SSD atau ganti hard drive', '[\"Upgrade ke SSD atau ganti hard drive\"]', '300000.00', '1200000.00', 'Sedang', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 12),
(61, 'K022', 'laptop', 'Prosesor Overheat (Throttling)', 'CPU overheat menyebabkan throttling dan penurunan performa', 'Performance', 'Ganti thermal paste, bersihkan heatsink, cek kipas', '[\"Ganti thermal paste, bersihkan heatsink, cek kipas\"]', '100000.00', '300000.00', 'Sedang', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 12),
(62, 'K077', 'laptop', 'Bloatware / Background Process Berlebih', 'Terlalu banyak program startup dan background processes', 'Performance', 'Disable startup programs, uninstall bloatware, optimize OS', '[\"Disable startup programs, uninstall bloatware, optimize OS\"]', '50000.00', '150000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 12),
(63, 'K078', 'laptop', 'VGA/GPU Throttling', 'GPU overheat atau driver bermasalah menyebabkan game lag', 'Performance', 'Update driver GPU, bersihkan thermal paste GPU, cek VRAM', '[\"Update driver GPU, bersihkan thermal paste GPU, cek VRAM\"]', '100000.00', '500000.00', 'Sedang', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 12),
(64, 'K079', 'laptop', 'RAM Dual Channel Tidak Aktif', 'Hanya 1 slot RAM terisi atau konfigurasi tidak optimal', 'Performance', 'Tambah RAM di slot kedua agar dual channel aktif', '[\"Tambah RAM di slot kedua agar dual channel aktif\"]', '200000.00', '600000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 12),
(65, 'K080', 'laptop', 'Storage Hampir Penuh', 'Drive penyimpanan hampir penuh sehingga performa turun', 'Performance', 'Bersihkan file, pindahkan data, atau tambah storage', '[\"Bersihkan file, pindahkan data, atau tambah storage\"]', '0.00', '500000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 12),
(66, 'K081', 'laptop', 'Memory Leak pada Software', 'Aplikasi tertentu memiliki memory leak yang menghabiskan RAM', 'Performance', 'Update aplikasi, tutup dan restart aplikasi secara berkala', '[\"Update aplikasi, tutup dan restart aplikasi secara berkala\"]', '0.00', '100000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 12),
(67, 'K023', 'laptop', 'Kipas/Fan Rusak', 'Fan pendingin tidak berfungsi atau berputar dengan benar', 'Thermal', 'Ganti kipas/fan laptop', '[\"Ganti kipas\\/fan laptop\"]', '100000.00', '400000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 15),
(68, 'K024', 'laptop', 'Thermal Paste Kering', 'Pasta termal antara CPU/GPU dan heatsink sudah kering', 'Thermal', 'Ganti thermal paste dengan yang baru', '[\"Ganti thermal paste dengan yang baru\"]', '50000.00', '150000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 15),
(69, 'K025', 'laptop', 'Heatsink Bermasalah', 'Heatsink tidak menempel rapat atau rusak', 'Thermal', 'Pasang ulang heatsink, ganti jika rusak', '[\"Pasang ulang heatsink, ganti jika rusak\"]', '100000.00', '500000.00', 'Sedang', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 15),
(70, 'K082', 'laptop', 'Ventilasi Tersumbat Debu', 'Jalur udara laptop tersumbat oleh debu yang menumpuk', 'Thermal', 'Bersihkan debu pada ventilasi dan internal laptop', '[\"Bersihkan debu pada ventilasi dan internal laptop\"]', '50000.00', '150000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 15),
(71, 'K083', 'laptop', 'Heatpipe Rusak/Penyok', 'Heatpipe (pipa panas) rusak sehingga transfer panas tidak efisien', 'Thermal', 'Ganti heatpipe atau modul heatsink assembly', '[\"Ganti heatpipe atau modul heatsink assembly\"]', '200000.00', '600000.00', 'Sedang', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 15),
(72, 'K084', 'laptop', 'Sensor Thermal Bermasalah', 'Sensor suhu CPU/GPU memberikan pembacaan yang salah', 'Thermal', 'Kalibrasi sensor, update BIOS, atau ganti sensor', '[\"Kalibrasi sensor, update BIOS, atau ganti sensor\"]', '100000.00', '400000.00', 'Sedang', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 15),
(73, 'K085', 'laptop', 'VRM Overheating', 'Voltage Regulator Module (VRM) overheat pada motherboard', 'Thermal', 'Pasang thermal pad pada VRM, cek ventilasi', '[\"Pasang thermal pad pada VRM, cek ventilasi\"]', '100000.00', '350000.00', 'Sedang', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 15),
(74, 'K026', 'laptop', 'Speaker Internal Rusak', 'Speaker laptop rusak atau kabelnya putus', 'Audio', 'Ganti speaker internal laptop', '[\"Ganti speaker internal laptop\"]', '100000.00', '400000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 14),
(75, 'K027', 'laptop', 'IC Audio/Sound Card Bermasalah', 'Chip audio pada motherboard bermasalah', 'Audio', 'Kemungkinan kerusakan IC Audio pada Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi', '[\"Kemungkinan kerusakan IC Audio pada Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi\"]', '200000.00', '600000.00', 'Sedang', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 14),
(76, 'K028', 'laptop', 'Jack Audio Port Rusak', 'Port jack audio 3.5mm rusak atau longgar', 'Audio', 'Ganti port jack audio', '[\"Ganti port jack audio\"]', '100000.00', '300000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 14),
(77, 'K086', 'laptop', 'Kabel Speaker Internal Putus/Longgar', 'Kabel ribbon yang menghubungkan speaker ke motherboard rusak', 'Audio', 'Pasang ulang atau ganti kabel speaker', '[\"Pasang ulang atau ganti kabel speaker\"]', '50000.00', '200000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 14),
(78, 'K087', 'laptop', 'Driver Audio Corrupt/Tidak Kompatibel', 'Driver audio Windows corrupt atau tidak sesuai hardware', 'Audio', 'Install ulang driver audio yang sesuai', '[\"Install ulang driver audio yang sesuai\"]', '0.00', '100000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 14),
(79, 'K088', 'laptop', 'Microphone Internal Rusak', 'Microphone built-in laptop rusak', 'Audio', 'Ganti microphone internal atau gunakan mic external', '[\"Ganti microphone internal atau gunakan mic external\"]', '100000.00', '300000.00', 'Ringan', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 14),
(80, 'K089', 'laptop', 'DAC (Digital-to-Analog Converter) Bermasalah', 'DAC pada audio codec chip bermasalah', 'Audio', 'Kemungkinan kerusakan chip audio pada Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi', '[\"Kemungkinan kerusakan chip audio pada Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi\"]', '200000.00', '500000.00', 'Sedang', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 14),
(81, 'K090', 'laptop', 'Amplifier Speaker Rusak', 'Amplifier internal untuk speaker rusak', 'Audio', 'Kemungkinan kerusakan amplifier pada Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi', '[\"Kemungkinan kerusakan amplifier pada Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi\"]', '200000.00', '500000.00', 'Sedang', '2026-03-12 15:25:38', '2026-04-01 06:24:59', 1, 14),
(82, 'K029', 'laptop', 'Hard Disk (HDD) Rusak Total', 'Piringan HDD rusak, head crash, atau motor mati', 'Storage', 'Ganti HDD, recovery data jika dibutuhkan', '[\"Ganti HDD, recovery data jika dibutuhkan\"]', '300000.00', '1500000.00', 'Berat', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(83, 'K030', 'laptop', 'SSD Degradasi/Failing', 'Chip NAND SSD mengalami degradasi atau controller bermasalah', 'Storage', 'Ganti SSD, backup data terlebih dahulu', '[\"Ganti SSD, backup data terlebih dahulu\"]', '300000.00', '1500000.00', 'Sedang', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(84, 'K091', 'laptop', 'Bad Sector pada HDD', 'Sektor-sektor di HDD rusak menyebabkan data corrupt', 'Storage', 'Backup data, gunakan tools HDD repair, pertimbangkan ganti', '[\"Backup data, gunakan tools HDD repair, pertimbangkan ganti\"]', '100000.00', '800000.00', 'Sedang', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(85, 'K092', 'laptop', 'Kabel SATA/Konektor Storage Longgar', 'Kabel SATA atau konektor M.2/NVMe longgar', 'Storage', 'Pasang ulang kabel/konektor, ganti jika rusak', '[\"Pasang ulang kabel\\/konektor, ganti jika rusak\"]', '50000.00', '200000.00', 'Ringan', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(86, 'K093', 'laptop', 'SSD Controller Bermasalah', 'Controller chip pada SSD mengalami error', 'Storage', 'Firmware update SSD, jika gagal ganti SSD', '[\"Firmware update SSD, jika gagal ganti SSD\"]', '300000.00', '1200000.00', 'Berat', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(87, 'K094', 'laptop', 'Partisi Tabel Corrupt (Storage)', 'MBR/GPT partition table pada disk corrupt', 'Storage', 'Repair partition table, gunakan recovery tools', '[\"Repair partition table, gunakan recovery tools\"]', '100000.00', '300000.00', 'Ringan', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(88, 'K095', 'laptop', 'Hard Drive Overheating', 'Hard drive terlalu panas menyebabkan performa menurun', 'Storage', 'Perbaiki ventilasi, tambah thermal pad, ganti jika rusak', '[\"Perbaiki ventilasi, tambah thermal pad, ganti jika rusak\"]', '100000.00', '400000.00', 'Sedang', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(89, 'K096', 'laptop', 'SATA Port Motherboard Rusak', 'Port SATA di motherboard tidak berfungsi', 'Storage', 'Pindah ke port lain, repair port SATA, atau gunakan adapter USB', '[\"Pindah ke port lain, repair port SATA, atau gunakan adapter USB\"]', '100000.00', '500000.00', 'Sedang', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(90, 'K031', 'laptop', 'Engsel/Hinge Rusak', 'Engsel laptop patah atau longgar', 'Physical', 'Ganti engsel/hinge dengan yang baru', '[\"Ganti engsel\\/hinge dengan yang baru\"]', '150000.00', '500000.00', 'Sedang', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(91, 'K032', 'laptop', 'Casing/Body Rusak', 'Casing laptop retak, pecah, atau penyok', 'Physical', 'Ganti casing laptop atau perbaiki retakan', '[\"Ganti casing laptop atau perbaiki retakan\"]', '200000.00', '800000.00', 'Sedang', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(92, 'K097', 'laptop', 'Bezel Layar Rusak', 'Frame/bezel di sekitar layar retak atau lepas', 'Physical', 'Ganti bezel layar', '[\"Ganti bezel layar\"]', '100000.00', '400000.00', 'Ringan', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(93, 'K098', 'laptop', 'Palmrest Assembly Rusak', 'Palmrest retak, bengkok, atau konektor di palmrest bermasalah', 'Physical', 'Ganti palmrest assembly', '[\"Ganti palmrest assembly\"]', '200000.00', '600000.00', 'Sedang', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(94, 'K099', 'laptop', 'Bottom Case Rusak', 'Cover bawah laptop rusak, retak, atau klip penahan patah', 'Physical', 'Ganti bottom case/cover bawah', '[\"Ganti bottom case\\/cover bawah\"]', '150000.00', '500000.00', 'Ringan', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(95, 'K100', 'laptop', 'Hinge Bracket Patah pada Casing', 'Bracket pengait engsel di casing patah', 'Physical', 'Repair bracket atau ganti casing yang berkaitan', '[\"Repair bracket atau ganti casing yang berkaitan\"]', '200000.00', '700000.00', 'Sedang', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(96, 'K101', 'laptop', 'Kabel LCD Terjepit/Tertekuk', 'Kabel flex LCD terjepit di area engsel sehingga terlihat atau rusak', 'Physical', 'Rapikan kabel, ganti jika sudah rusak', '[\"Rapikan kabel, ganti jika sudah rusak\"]', '100000.00', '400000.00', 'Ringan', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(97, 'K102', 'laptop', 'Kerusakan Kosmetik (Non-Fungsional)', 'Kerusakan estetika: cat mengelupas, stiker lepas, goresan', 'Physical', 'Repaint, ganti panel, atau biarkan (tidak pengaruh fungsi)', '[\"Repaint, ganti panel, atau biarkan (tidak pengaruh fungsi)\"]', '0.00', '300000.00', 'Ringan', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(98, 'K033', 'laptop', 'Water Damage - Korosi Motherboard', 'Air masuk dan menyebabkan korosi pada komponen motherboard', 'Water', 'Bersihkan korosi dengan isopropyl alcohol, repair komponen yang rusak', '[\"Bersihkan korosi dengan isopropyl alcohol, repair komponen yang rusak\"]', '300000.00', '2000000.00', 'Berat', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(99, 'K103', 'laptop', 'Water Damage - Short Circuit', 'Air menyebabkan hubungan arus pendek pada motherboard', 'Water', 'Keringkan total laptop, diagnosa dan repair jalur yang short', '[\"Keringkan total laptop, diagnosa dan repair jalur yang short\"]', '300000.00', '1500000.00', 'Berat', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(100, 'K104', 'laptop', 'Water Damage - Keyboard rusak', 'Cairan merusak membrane atau switch pada keyboard', 'Water', 'Ganti keyboard, bersihkan area yang terdampak', '[\"Ganti keyboard, bersihkan area yang terdampak\"]', '200000.00', '600000.00', 'Sedang', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(101, 'K105', 'laptop', 'Water Damage - LCD Panel', 'Cairan masuk ke panel LCD menyebabkan bercak atau kerusakan', 'Water', 'Ganti LCD panel', '[\"Ganti LCD panel\"]', '500000.00', '2500000.00', 'Berat', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(102, 'K106', 'laptop', 'Water Damage - Konektor & Port', 'Port dan konektor mengalami korosi akibat air', 'Water', 'Bersihkan atau ganti port yang terkena korosi', '[\"Bersihkan atau ganti port yang terkena korosi\"]', '100000.00', '500000.00', 'Sedang', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(103, 'K107', 'laptop', 'Water Damage - Speaker/Audio Component', 'Komponen audio rusak akibat air', 'Water', 'Ganti speaker, bersihkan komponen audio', '[\"Ganti speaker, bersihkan komponen audio\"]', '100000.00', '400000.00', 'Ringan', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(104, 'K034', 'laptop', 'GPU/VGA Chip Rusak (BGA Failure)', 'Chip GPU mengalami reflow/BGA failure', 'Hardware', 'Kemungkinan kerusakan chip GPU (BGA failure). Diperlukan pemeriksaan lebih lanjut pada Mainboard oleh teknisi', '[\"Kemungkinan kerusakan chip GPU (BGA failure). Diperlukan pemeriksaan lebih lanjut pada Mainboard oleh teknisi\"]', '500000.00', '2000000.00', 'Berat', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(105, 'K035', 'laptop', 'Motherboard Mati Total', 'Motherboard tidak berfungsi sama sekali', 'Hardware', 'Kemungkinan kerusakan pada Mainboard. Diperlukan pemeriksaan dan diagnosa lebih lanjut oleh teknisi', '[\"Kemungkinan kerusakan pada Mainboard. Diperlukan pemeriksaan dan diagnosa lebih lanjut oleh teknisi\"]', '500000.00', '3000000.00', 'Berat', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(106, 'K036', 'laptop', 'PCH/Chipset Rusak', 'Platform Controller Hub (PCH/Southbridge) rusak', 'Hardware', 'Kemungkinan kerusakan pada chipset Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi', '[\"Kemungkinan kerusakan pada chipset Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi\"]', '400000.00', '1500000.00', 'Berat', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(107, 'K037', 'laptop', 'RAM Slot Motherboard Rusak', 'Slot RAM di motherboard bermasalah', 'Hardware', 'Repair slot RAM atau ganti motherboard', '[\"Repair slot RAM atau ganti motherboard\"]', '200000.00', '800000.00', 'Sedang', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(108, 'K108', 'laptop', 'BIOS Chip Rusak / CMOS Battery Habis', 'Chip BIOS rusak atau baterai CMOS habis', 'Hardware', 'Ganti baterai CMOS, flash ulang BIOS chip', '[\"Ganti baterai CMOS, flash ulang BIOS chip\"]', '50000.00', '300000.00', 'Ringan', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(109, 'K109', 'laptop', 'VRM (Voltage Regulator Module) Rusak', 'VRM pada motherboard rusak menyebabkan voltase tidak stabil', 'Hardware', 'Kemungkinan kerusakan VRM pada Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi', '[\"Kemungkinan kerusakan VRM pada Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi\"]', '300000.00', '800000.00', 'Berat', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(110, 'K110', 'laptop', 'I/O Controller Chip Rusak', 'Chip pengendali I/O (USB, LAN, dll) pada motherboard rusak', 'Hardware', 'Kemungkinan kerusakan IC I/O Controller pada Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi', '[\"Kemungkinan kerusakan IC I\\/O Controller pada Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi\"]', '300000.00', '700000.00', 'Berat', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(111, 'K111', 'laptop', 'VRAM GPU Rusak', 'Video RAM pada GPU chip bermasalah', 'Hardware', 'Kemungkinan kerusakan VRAM pada GPU. Diperlukan pemeriksaan lebih lanjut pada Mainboard oleh teknisi', '[\"Kemungkinan kerusakan VRAM pada GPU. Diperlukan pemeriksaan lebih lanjut pada Mainboard oleh teknisi\"]', '400000.00', '1500000.00', 'Berat', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(112, 'K112', 'laptop', 'Kapasitor/Komponen SMD Rusak', 'Kapasitor, resistor, atau komponen SMD di motherboard rusak', 'Hardware', 'Kemungkinan kerusakan komponen di Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi', '[\"Kemungkinan kerusakan komponen di Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi\"]', '100000.00', '500000.00', 'Sedang', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(113, 'K113', 'laptop', 'Trace/Jalur PCB Putus', 'Jalur tembaga di PCB motherboard putus', 'Hardware', 'Kemungkinan kerusakan jalur PCB pada Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi', '[\"Kemungkinan kerusakan jalur PCB pada Mainboard. Diperlukan pemeriksaan lebih lanjut oleh teknisi\"]', '200000.00', '600000.00', 'Sedang', '2026-03-12 15:25:38', '2026-03-12 15:25:38', NULL, NULL),
(114, 'PCK001', 'pc', 'PSU Rusak / Mati Total', 'Unit PSU tidak berfungsi atau sudah tidak bisa mengeluarkan daya', 'PSU', 'Ganti PSU dengan watt dan sertifikasi yang sesuai', '[\"Ganti PSU dengan watt dan sertifikasi yang sesuai\"]', '250000.00', '2500000.00', 'Sedang', '2026-03-12 15:25:41', '2026-04-01 06:24:59', 2, 16),
(115, 'PCK002', 'pc', 'PSU Kekurangan Watt (Undersized)', 'Watt PSU terlalu kecil untuk total TDP komponen PC', 'PSU', 'Upgrade PSU ke wattage yang mencukupi (hitung TDP + 30% headroom)', '[\"Upgrade PSU ke wattage yang mencukupi (hitung TDP + 30% headroom)\"]', '300000.00', '2500000.00', 'Sedang', '2026-03-12 15:25:41', '2026-04-01 06:24:59', 2, 16),
(116, 'PCK003', 'pc', 'Kabel Power Internal Longgar / Tidak Terpasang', 'Kabel 24-pin ATX, 8-pin EPS, atau PCIe power tidak terpasang sempurna', 'PSU', 'Periksa dan pasang ulang semua konektor power internal', '[\"Periksa dan pasang ulang semua konektor power internal\"]', '0.00', '100000.00', 'Ringan', '2026-03-12 15:25:41', '2026-04-01 06:24:59', 2, 16),
(117, 'PCK004', 'pc', 'Kapasitor PSU Rusak / Kembung', 'Kapasitor elektrolit di dalam PSU sudah rusak atau kembung', 'PSU', 'Ganti kapasitor atau ganti seluruh PSU', '[\"Ganti kapasitor atau ganti seluruh PSU\"]', '100000.00', '1000000.00', 'Sedang', '2026-03-12 15:25:41', '2026-04-01 06:24:59', 2, 16),
(118, 'PCK005', 'pc', 'Short Circuit di Motherboard / Komponen', 'Hubungan arus pendek pada board atau komponen menyebabkan PSU trip', 'PSU', 'Isolasi komponen penyebab short, repair atau ganti', '[\"Isolasi komponen penyebab short, repair atau ganti\"]', '200000.00', '3000000.00', 'Berat', '2026-03-12 15:25:41', '2026-04-01 06:24:59', 2, 16),
(119, 'PCK006', 'pc', 'PSU Terbakar / Overvoltage Spike', 'PSU mengalami overvoltage atau arus listrik tidak stabil sehingga terbakar', 'PSU', 'Ganti PSU, pasang UPS dan stabilizer', '[\"Ganti PSU, pasang UPS dan stabilizer\"]', '300000.00', '3000000.00', 'Berat', '2026-03-12 15:25:41', '2026-04-01 06:24:59', 2, 16),
(120, 'PCK007', 'pc', 'Fitur PSU Protection Aktif (OCP/OPP/OTP)', 'Fitur proteksi PSU aktif karena over current, over power, atau overheat', 'PSU', 'Identifikasi penyebab trigger, kurangi beban, perbaiki pendinginan', '[\"Identifikasi penyebab trigger, kurangi beban, perbaiki pendinginan\"]', '0.00', '2500000.00', 'Sedang', '2026-03-12 15:25:41', '2026-04-01 06:24:59', 2, 16),
(121, 'PCK008', 'pc', 'Motherboard Rusak / Perlu Diganti', 'Motherboard mengalami kerusakan irreversible pada komponen penting', 'Motherboard', 'Ganti motherboard yang kompatibel dengan CPU dan RAM', '[\"Ganti motherboard yang kompatibel dengan CPU dan RAM\"]', '600000.00', '5000000.00', 'Berat', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(122, 'PCK009', 'pc', 'Baterai CMOS Habis', 'Baterai CR2032 CMOS pada motherboard sudah habis', 'Motherboard', 'Ganti baterai CMOS CR2032', '[\"Ganti baterai CMOS CR2032\"]', '15000.00', '50000.00', 'Ringan', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(123, 'PCK010', 'pc', 'Kapasitor Motherboard Rusak', 'Kapasitor elektrolit pada motherboard kembung atau pecah', 'Motherboard', 'Ganti kapasitor yang rusak atau ganti motherboard', '[\"Ganti kapasitor yang rusak atau ganti motherboard\"]', '100000.00', '1500000.00', 'Sedang', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(124, 'PCK011', 'pc', 'BIOS / UEFI Corrupt / Perlu Di-Flash', 'Firmware BIOS/UEFI rusak atau update gagal di tengah jalan', 'Motherboard', 'Flash ulang BIOS menggunakan USB recovery atau programmer', '[\"Flash ulang BIOS menggunakan USB recovery atau programmer\"]', '50000.00', '400000.00', 'Ringan', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(125, 'PCK012', 'pc', 'Chipset / IC Controller Motherboard Rusak', 'Chipset (PCH) atau IC pengontrol I/O pada motherboard rusak', 'Motherboard', 'Reball chipset atau ganti motherboard', '[\"Reball chipset atau ganti motherboard\"]', '400000.00', '3000000.00', 'Berat', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(126, 'PCK013', 'pc', 'VRM Motherboard Bermasalah / Rusak', 'Voltage Regulator Module pada motherboard tidak berfungsi optimal', 'Motherboard', 'Ganti MOSFET/kapasitor VRM atau ganti motherboard', '[\"Ganti MOSFET\\/kapasitor VRM atau ganti motherboard\"]', '200000.00', '2000000.00', 'Sedang', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(127, 'PCK014', 'pc', 'Slot PCIe / DIMM Fisik Rusak', 'Slot PCIe atau DIMM pada motherboard mengalami kerusakan fisik', 'Motherboard', 'Gunakan slot lain atau ganti motherboard', '[\"Gunakan slot lain atau ganti motherboard\"]', '300000.00', '4000000.00', 'Berat', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(128, 'PCK015', 'pc', 'Thermal Paste CPU Kering / Perlu Diganti', 'Pasta termal antara CPU dan heatsink sudah mengering', 'CPU', 'Bersihkan CPU dan heatsink, oleskan thermal paste baru', '[\"Bersihkan CPU dan heatsink, oleskan thermal paste baru\"]', '30000.00', '200000.00', 'Ringan', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(129, 'PCK016', 'pc', 'Cooler CPU Bermasalah (Longgar / Fan Mati)', 'Cooler tidak terpasang rapat atau kipas tidak berfungsi', 'CPU', 'Pasang ulang cooler dengan mounting yang benar, ganti fan jika rusak', '[\"Pasang ulang cooler dengan mounting yang benar, ganti fan jika rusak\"]', '50000.00', '600000.00', 'Ringan', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(130, 'PCK017', 'pc', 'CPU Overheating (Thermal Throttling)', 'CPU mencapai suhu kritis sehingga menurunkan clock speed secara otomatis', 'CPU', 'Ganti thermal paste, upgrade cooler, perbaiki airflow casing', '[\"Ganti thermal paste, upgrade cooler, perbaiki airflow casing\"]', '50000.00', '1500000.00', 'Sedang', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(131, 'PCK018', 'pc', 'CPU Rusak / Defektif', 'CPU mengalami kerusakan pada die atau sirkuit internal', 'CPU', 'Ganti CPU yang kompatibel dengan socket motherboard', '[\"Ganti CPU yang kompatibel dengan socket motherboard\"]', '500000.00', '7000000.00', 'Berat', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(132, 'PCK019', 'pc', 'Socket CPU / Pin LGA Bengkok', 'Pin pada socket LGA (di motherboard) bengkok atau patah', 'CPU', 'Luruskan pin dengan hati-hati atau ganti socket/motherboard', '[\"Luruskan pin dengan hati-hati atau ganti socket\\/motherboard\"]', '200000.00', '4000000.00', 'Berat', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(133, 'PCK020', 'pc', 'Overclock / Voltage Setting Tidak Stabil', 'Setting OC terlalu agresif atau voltage tidak tepat menyebabkan instabilitas', 'CPU', 'Turunkan OC setting, sesuaikan LLC, atau kembalikan ke default', '[\"Turunkan OC setting, sesuaikan LLC, atau kembalikan ke default\"]', '0.00', '100000.00', 'Ringan', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(134, 'PCK021', 'pc', 'Cooler CPU Tidak Kompatibel dengan Socket', 'Cooler tidak mendukung socket yang digunakan sehingga tidak terpasang benar', 'CPU', 'Ganti cooler yang kompatibel atau gunakan bracket adapter', '[\"Ganti cooler yang kompatibel atau gunakan bracket adapter\"]', '100000.00', '1500000.00', 'Ringan', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(135, 'PCK022', 'pc', 'RAM DIMM Tidak Terpasang Benar', 'RAM DIMM longgar atau tidak masuk sempurna ke slot', 'RAM DIMM', 'Cabut dan pasang ulang RAM DIMM, pastikan terdengar klik di kedua sisi', '[\"Cabut dan pasang ulang RAM DIMM, pastikan terdengar klik di kedua sisi\"]', '0.00', '50000.00', 'Ringan', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(136, 'PCK023', 'pc', 'Modul RAM DIMM Rusak', 'Chip memori pada modul DIMM mengalami kerusakan', 'RAM DIMM', 'Ganti modul RAM DIMM yang rusak', '[\"Ganti modul RAM DIMM yang rusak\"]', '150000.00', '2000000.00', 'Sedang', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(137, 'PCK024', 'pc', 'Slot DIMM Motherboard Rusak', 'Slot RAM pada motherboard mengalami kerusakan fisik atau elektronik', 'RAM DIMM', 'Gunakan slot lain atau ganti motherboard', '[\"Gunakan slot lain atau ganti motherboard\"]', '400000.00', '5000000.00', 'Berat', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(138, 'PCK025', 'pc', 'Kontak DIMM Kotor / Teroksidasi', 'Kontak emas pada modul RAM kotor atau teroksidasi', 'RAM DIMM', 'Bersihkan kontak DIMM dengan penghapus pensil lembut', '[\"Bersihkan kontak DIMM dengan penghapus pensil lembut\"]', '0.00', '50000.00', 'Ringan', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(139, 'PCK026', 'pc', 'XMP / EXPO Profile Tidak Aktif', 'Profil kecepatan XMP/EXPO belum diaktifkan di BIOS', 'RAM DIMM', 'Aktifkan XMP/EXPO profile di BIOS/UEFI', '[\"Aktifkan XMP\\/EXPO profile di BIOS\\/UEFI\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(140, 'PCK027', 'pc', 'RAM Tidak Kompatibel / Mixing Bermasalah', 'RAM tidak masuk QVL motherboard atau mixing spec berbeda menyebabkan instabilitas', 'RAM DIMM', 'Ganti RAM yang sesuai QVL atau gunakan kit yang sama', '[\"Ganti RAM yang sesuai QVL atau gunakan kit yang sama\"]', '0.00', '2000000.00', 'Ringan', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(141, 'PCK028', 'pc', 'GPU Rusak (BGA / Die Failure)', 'GPU mengalami kerusakan pada chip die atau BGA solder ball', 'GPU Diskrit', 'Reballing GPU atau ganti kartu grafis', '[\"Reballing GPU atau ganti kartu grafis\"]', '500000.00', '8000000.00', 'Berat', '2026-03-12 15:25:41', '2026-04-01 06:24:59', 2, 19),
(142, 'PCK029', 'pc', 'Driver GPU Corrupt / Bermasalah', 'Driver GPU corrupt, versi tidak cocok, atau konflik driver', 'GPU Diskrit', 'Gunakan DDU (Display Driver Uninstaller) untuk clean install driver', '[\"Gunakan DDU (Display Driver Uninstaller) untuk clean install driver\"]', '0.00', '100000.00', 'Ringan', '2026-03-12 15:25:41', '2026-04-01 06:24:59', 2, 19),
(143, 'PCK030', 'pc', 'GPU Overheating', 'GPU mencapai suhu kritis sehingga throttling atau crash', 'GPU Diskrit', 'Ganti thermal paste GPU, bersihkan heatsink, perbaiki airflow', '[\"Ganti thermal paste GPU, bersihkan heatsink, perbaiki airflow\"]', '50000.00', '800000.00', 'Sedang', '2026-03-12 15:25:41', '2026-04-01 06:24:59', 2, 19),
(144, 'PCK031', 'pc', 'Fan GPU Rusak', 'Satu atau semua fan GPU tidak berputar', 'GPU Diskrit', 'Ganti fan GPU sesuai model', '[\"Ganti fan GPU sesuai model\"]', '100000.00', '500000.00', 'Ringan', '2026-03-12 15:25:41', '2026-04-01 06:24:59', 2, 19),
(145, 'PCK032', 'pc', 'vRAM GPU Rusak', 'Chip GDDR vRAM pada PCB GPU mengalami kerusakan', 'GPU Diskrit', 'Reball atau ganti vRAM, atau ganti GPU', '[\"Reball atau ganti vRAM, atau ganti GPU\"]', '500000.00', '5000000.00', 'Berat', '2026-03-12 15:25:41', '2026-04-01 06:24:59', 2, 19),
(146, 'PCK033', 'pc', 'PCIe Power Connector / Slot GPU Bermasalah', 'Konektor power PCIe atau slot PCIe x16 bermasalah', 'GPU Diskrit', 'Periksa konektor, coba slot PCIe lain, ganti kabel jika perlu', '[\"Periksa konektor, coba slot PCIe lain, ganti kabel jika perlu\"]', '0.00', '2000000.00', 'Ringan', '2026-03-12 15:25:41', '2026-04-01 06:24:59', 2, 19),
(147, 'PCK034', 'pc', 'GPU Tidak Dapat Daya Cukup dari PSU', 'PSU tidak cukup memasok daya GPU sesuai TDP', 'GPU Diskrit', 'Upgrade PSU, pastikan kabel PCIe power benar', '[\"Upgrade PSU, pastikan kabel PCIe power benar\"]', '300000.00', '2500000.00', 'Sedang', '2026-03-12 15:25:41', '2026-04-01 06:24:59', 2, 19),
(148, 'PCK035', 'pc', 'HDD 3.5\" Rusak / Failing', 'Hard disk 3.5\" mengalami kegagalan mekanis atau elektronik', 'Storage', 'Backup data segera, ganti dengan HDD baru atau SSD', '[\"Backup data segera, ganti dengan HDD baru atau SSD\"]', '300000.00', '1500000.00', 'Berat', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(149, 'PCK036', 'pc', 'SSD Degradasi / Controller Fail', 'SSD mengalami degradasi NAND atau controller error', 'Storage', 'Backup data segera, ganti SSD', '[\"Backup data segera, ganti SSD\"]', '300000.00', '2500000.00', 'Sedang', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(150, 'PCK037', 'pc', 'Bad Sector pada HDD', 'Sektor fisik HDD mengalami kerusakan magnetis', 'Storage', 'Backup data, jalankan repair, ganti jika bad sector banyak', '[\"Backup data, jalankan repair, ganti jika bad sector banyak\"]', '100000.00', '1000000.00', 'Sedang', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(151, 'PCK038', 'pc', 'Kabel SATA / Power SATA Rusak', 'Kabel data atau power SATA longgar atau rusak', 'Storage', 'Ganti kabel SATA data dan pastikan power SATA terhubung', '[\"Ganti kabel SATA data dan pastikan power SATA terhubung\"]', '20000.00', '100000.00', 'Ringan', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL);
INSERT INTO `diseases` (`id`, `code`, `device_type`, `name`, `description`, `category`, `solution`, `actions`, `min_cost`, `max_cost`, `level`, `created_at`, `updated_at`, `device_type_id`, `device_component_id`) VALUES
(152, 'PCK039', 'pc', 'Partisi / MBR / GPT Corrupt', 'Tabel partisi atau master boot record corrupt', 'Storage', 'Gunakan repair tools (CHKDSK, TestDisk) untuk perbaikan', '[\"Gunakan repair tools (CHKDSK, TestDisk) untuk perbaikan\"]', '0.00', '300000.00', 'Ringan', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(153, 'PCK040', 'pc', 'Slot M.2 / PCIe Storage Bermasalah', 'Slot M.2 pada motherboard rusak atau tidak kompatibel', 'Storage', 'Coba slot M.2 lain (jika ada) atau gunakan adapter PCIe', '[\"Coba slot M.2 lain (jika ada) atau gunakan adapter PCIe\"]', '0.00', '2000000.00', 'Sedang', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(154, 'PCK041', 'pc', 'NVMe SSD Overheating (Perlu Heatsink)', 'NVMe SSD tidak memiliki pendingin sehingga throttling', 'Storage', 'Pasang heatsink M.2 atau heatsink bawaan motherboard', '[\"Pasang heatsink M.2 atau heatsink bawaan motherboard\"]', '30000.00', '200000.00', 'Ringan', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(155, 'PCK042', 'pc', 'Kabel Front Panel Salah Pasang / Longgar', 'Kabel tombol power, reset, LED tidak terpasang di header yang benar', 'Casing', 'Periksa manual motherboard, pasang kabel front panel dengan benar', '[\"Periksa manual motherboard, pasang kabel front panel dengan benar\"]', '0.00', '50000.00', 'Ringan', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(156, 'PCK043', 'pc', 'Tombol Power / Reset Front Panel Rusak', 'Tombol power atau reset pada casing rusak secara fisik', 'Casing', 'Ganti tombol front panel atau short pin power langsung', '[\"Ganti tombol front panel atau short pin power langsung\"]', '50000.00', '200000.00', 'Ringan', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(157, 'PCK044', 'pc', 'Kabel USB Front Panel Longgar / Rusak', 'Kabel USB header dari casing ke motherboard longgar atau rusak', 'Casing', 'Pasang ulang kabel USB header atau ganti kabel front panel', '[\"Pasang ulang kabel USB header atau ganti kabel front panel\"]', '0.00', '150000.00', 'Ringan', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(158, 'PCK045', 'pc', 'Airflow Casing Tidak Optimal', 'Konfigurasi fan atau dust filter tersumbat menyebabkan suhu tinggi', 'Casing', 'Bersihkan filter, atur ulang konfigurasi fan (positive pressure)', '[\"Bersihkan filter, atur ulang konfigurasi fan (positive pressure)\"]', '0.00', '500000.00', 'Ringan', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(159, 'PCK046', 'pc', 'Grounding Casing Bermasalah', 'Casing tidak ter-ground dengan baik menyebabkan induksi listrik', 'Casing', 'Pastikan kabel ground PSU terhubung, cek grounding instalasi listrik', '[\"Pastikan kabel ground PSU terhubung, cek grounding instalasi listrik\"]', '0.00', '200000.00', 'Ringan', '2026-03-12 15:25:41', '2026-03-12 15:25:41', NULL, NULL),
(160, 'PCK047', 'pc', 'Debu Menumpuk di Sistem Pendinginan', 'Debu menyumbat heatsink, fan, dan jalur udara menyebabkan overheating', 'Thermal', 'Bersihkan seluruh sistem dari debu menggunakan compressed air', '[\"Bersihkan seluruh sistem dari debu menggunakan compressed air\"]', '50000.00', '250000.00', 'Ringan', '2026-03-12 15:25:41', '2026-04-01 06:24:59', 2, 18),
(161, 'PCK048', 'pc', 'Fan Casing Rusak / Tidak Berfungsi', 'Fan intake atau exhaust casing tidak berputar', 'Thermal', 'Ganti fan casing yang rusak', '[\"Ganti fan casing yang rusak\"]', '50000.00', '400000.00', 'Ringan', '2026-03-12 15:25:41', '2026-04-01 06:24:59', 2, 18),
(162, 'PCK049', 'pc', 'AIO Liquid Cooler Rusak', 'Unit AIO cooler mengalami kegagalan pada pump, radiator, atau head', 'Thermal', 'Ganti AIO liquid cooler', '[\"Ganti AIO liquid cooler\"]', '300000.00', '3000000.00', 'Sedang', '2026-03-12 15:25:42', '2026-04-01 06:24:59', 2, 18),
(163, 'PCK050', 'pc', 'AIO Liquid Cooler Bocor (Darurat)', 'Cairan coolant bocor mengancam komponen PC', 'Thermal', 'Matikan PC segera, keringkan, ganti AIO', '[\"Matikan PC segera, keringkan, ganti AIO\"]', '300000.00', '10000000.00', 'Berat', '2026-03-12 15:25:42', '2026-04-01 06:24:59', 2, 18),
(164, 'PCK051', 'pc', 'Airflow Casing Tidak Optimal', 'Konfigurasi fan atau penempatan komponen menyebabkan sirkulasi udara buruk', 'Thermal', 'Atur ulang fan (positive pressure), tambah fan exhaust', '[\"Atur ulang fan (positive pressure), tambah fan exhaust\"]', '50000.00', '600000.00', 'Ringan', '2026-03-12 15:25:42', '2026-04-01 06:24:59', 2, 18),
(165, 'PCK052', 'pc', 'Thermal Pad VRM / Chipset Perlu Diganti', 'Thermal pad komponen non-CPU sudah kering', 'Thermal', 'Ganti thermal pad VRM, chipset, dan komponen lain', '[\"Ganti thermal pad VRM, chipset, dan komponen lain\"]', '50000.00', '300000.00', 'Ringan', '2026-03-12 15:25:42', '2026-04-01 06:24:59', 2, 18),
(166, 'PCK053', 'pc', 'Custom Water Cooling Bermasalah', 'Komponen custom loop (pump, reservoir, fitting) rusak', 'Thermal', 'Periksa dan ganti komponen custom WC yang rusak', '[\"Periksa dan ganti komponen custom WC yang rusak\"]', '200000.00', '5000000.00', 'Sedang', '2026-03-12 15:25:42', '2026-04-01 06:24:59', 2, 18),
(167, 'PCK054', 'pc', 'Driver Audio Corrupt / Tidak Kompatibel', 'Driver Realtek atau audio lain corrupt atau konflik dengan OS', 'Audio', 'Uninstall total dan install ulang driver audio terbaru', '[\"Uninstall total dan install ulang driver audio terbaru\"]', '0.00', '100000.00', 'Ringan', '2026-03-12 15:25:42', '2026-04-01 06:24:59', 2, 21),
(168, 'PCK055', 'pc', 'IC Audio Onboard Motherboard Rusak', 'Chip audio Realtek atau ALC pada motherboard rusak', 'Audio', 'Gunakan sound card PCIe atau USB DAC eksternal', '[\"Gunakan sound card PCIe atau USB DAC eksternal\"]', '100000.00', '3000000.00', 'Sedang', '2026-03-12 15:25:42', '2026-04-01 06:24:59', 2, 21),
(169, 'PCK056', 'pc', 'Jack Audio Fisik Rusak (Rear / Front)', 'Konektor jack 3.5mm di panel belakang atau depan rusak', 'Audio', 'Ganti jack audio atau gunakan port lain', '[\"Ganti jack audio atau gunakan port lain\"]', '50000.00', '300000.00', 'Ringan', '2026-03-12 15:25:42', '2026-04-01 06:24:59', 2, 21),
(170, 'PCK057', 'pc', 'Kabel Audio Front Panel Longgar', 'Kabel HD Audio dari casing ke header motherboard longgar', 'Audio', 'Pasang ulang kabel HD Audio ke header AC97/HD Audio', '[\"Pasang ulang kabel HD Audio ke header AC97\\/HD Audio\"]', '0.00', '50000.00', 'Ringan', '2026-03-12 15:25:42', '2026-04-01 06:24:59', 2, 21),
(171, 'PCK058', 'pc', 'Sound Card PCIe Diskrit Bermasalah', 'Kartu suara PCIe mengalami kerusakan atau konflik slot', 'Audio', 'Ganti sound card PCIe atau pindah slot', '[\"Ganti sound card PCIe atau pindah slot\"]', '150000.00', '2000000.00', 'Sedang', '2026-03-12 15:25:42', '2026-04-01 06:24:59', 2, 21),
(172, 'PCK059', 'pc', 'Ground Loop / Interference Noise', 'Masalah grounding menyebabkan noise pada output audio', 'Audio', 'Gunakan ground loop isolator, perbaiki grounding sistem', '[\"Gunakan ground loop isolator, perbaiki grounding sistem\"]', '50000.00', '300000.00', 'Ringan', '2026-03-12 15:25:42', '2026-04-01 06:24:59', 2, 21),
(173, 'PCK060', 'pc', 'Driver LAN / WiFi Bermasalah', 'Driver kartu jaringan corrupt atau tidak kompatibel dengan OS', 'Network', 'Uninstall dan install ulang driver network terbaru dari website resmi', '[\"Uninstall dan install ulang driver network terbaru dari website resmi\"]', '0.00', '100000.00', 'Ringan', '2026-03-12 15:25:42', '2026-04-01 06:24:59', 2, 20),
(174, 'PCK061', 'pc', 'IC LAN Onboard Motherboard Rusak', 'Chip LAN Realtek/Intel onboard pada motherboard rusak', 'Network', 'Gunakan LAN card PCIe atau USB LAN adapter eksternal', '[\"Gunakan LAN card PCIe atau USB LAN adapter eksternal\"]', '50000.00', '600000.00', 'Sedang', '2026-03-12 15:25:42', '2026-04-01 06:24:59', 2, 20),
(175, 'PCK062', 'pc', 'Port LAN Fisik Rusak', 'Konektor RJ45 pada panel belakang motherboard rusak fisik', 'Network', 'Perbaiki atau ganti port, gunakan USB LAN adapter', '[\"Perbaiki atau ganti port, gunakan USB LAN adapter\"]', '100000.00', '500000.00', 'Sedang', '2026-03-12 15:25:42', '2026-04-01 06:24:59', 2, 20),
(176, 'PCK063', 'pc', 'WiFi Card PCIe Bermasalah', 'Kartu WiFi PCIe rusak atau tidak kompatibel', 'Network', 'Ganti WiFi card PCIe atau gunakan USB WiFi adapter', '[\"Ganti WiFi card PCIe atau gunakan USB WiFi adapter\"]', '100000.00', '600000.00', 'Ringan', '2026-03-12 15:25:42', '2026-04-01 06:24:59', 2, 20),
(177, 'PCK064', 'pc', 'Konfigurasi / Setting Jaringan Bermasalah', 'IP, DNS, atau konfigurasi jaringan salah', 'Network', 'Reset konfigurasi jaringan, flush DNS, netsh reset', '[\"Reset konfigurasi jaringan, flush DNS, netsh reset\"]', '0.00', '100000.00', 'Ringan', '2026-03-12 15:25:42', '2026-04-01 06:24:59', 2, 20),
(178, 'PCK065', 'pc', 'Kabel LAN atau Perangkat Jaringan Eksternal Bermasalah', 'Kabel ethernet atau switch/router bermasalah', 'Network', 'Ganti kabel LAN, test dengan router/switch berbeda', '[\"Ganti kabel LAN, test dengan router\\/switch berbeda\"]', '20000.00', '300000.00', 'Ringan', '2026-03-12 15:25:42', '2026-04-01 06:24:59', 2, 20),
(179, 'PCK066', 'pc', 'Driver USB Controller Bermasalah', 'Driver USB host controller corrupt atau tidak kompatibel', 'Peripheral', 'Reinstall USB controller di Device Manager, restart PC', '[\"Reinstall USB controller di Device Manager, restart PC\"]', '0.00', '100000.00', 'Ringan', '2026-03-12 15:25:42', '2026-03-12 15:25:42', NULL, NULL),
(180, 'PCK067', 'pc', 'Kabel Header USB Front Panel Longgar / Rusak', 'Kabel USB 2.0 (9-pin) atau USB 3.0 (19-pin) dari casing longgar', 'Peripheral', 'Pasang ulang kabel header USB ke motherboard', '[\"Pasang ulang kabel header USB ke motherboard\"]', '0.00', '100000.00', 'Ringan', '2026-03-12 15:25:42', '2026-03-12 15:25:42', NULL, NULL),
(181, 'PCK068', 'pc', 'Port USB Fisik Rusak', 'Port USB secara fisik rusak (pin bengkok, housing pecah)', 'Peripheral', 'Ganti port USB atau gunakan port lain', '[\"Ganti port USB atau gunakan port lain\"]', '100000.00', '400000.00', 'Ringan', '2026-03-12 15:25:42', '2026-03-12 15:25:42', NULL, NULL),
(182, 'PCK069', 'pc', 'IC USB Controller Motherboard Rusak', 'Chip USB host controller pada motherboard rusak', 'Peripheral', 'Ganti IC controller atau motherboard', '[\"Ganti IC controller atau motherboard\"]', '400000.00', '5000000.00', 'Berat', '2026-03-12 15:25:42', '2026-03-12 15:25:42', NULL, NULL),
(183, 'PCK070', 'pc', 'Daya Port USB Tidak Mencukupi', 'Port USB tidak mendapat daya yang cukup untuk perangkat', 'Peripheral', 'Cek power management USB, gunakan powered USB hub', '[\"Cek power management USB, gunakan powered USB hub\"]', '0.00', '200000.00', 'Ringan', '2026-03-12 15:25:42', '2026-03-12 15:25:42', NULL, NULL),
(184, 'PCK071', 'pc', 'Peripheral / Perangkat yang Terhubung Rusak', 'Perangkat yang dihubungkan rusak bukan port-nya', 'Peripheral', 'Uji perangkat di PC lain untuk isolasi masalah', '[\"Uji perangkat di PC lain untuk isolasi masalah\"]', '0.00', '1000000.00', 'Ringan', '2026-03-12 15:25:42', '2026-03-12 15:25:42', NULL, NULL),
(185, 'PCK072', 'pc', 'Windows / OS Corrupt', 'File sistem operasi Windows rusak atau missing', 'Software', 'Jalankan SFC /scannow, DISM, atau install ulang Windows', '[\"Jalankan SFC \\/scannow, DISM, atau install ulang Windows\"]', '100000.00', '300000.00', 'Ringan', '2026-03-12 15:25:42', '2026-04-01 06:24:59', 2, 17),
(186, 'PCK073', 'pc', 'Infeksi Virus / Malware', 'PC terinfeksi virus, ransomware, spyware, atau adware', 'Software', 'Scan mendalam dengan antivirus, pertimbangkan reinstall OS', '[\"Scan mendalam dengan antivirus, pertimbangkan reinstall OS\"]', '50000.00', '300000.00', 'Ringan', '2026-03-12 15:25:42', '2026-04-01 06:24:59', 2, 17),
(187, 'PCK074', 'pc', 'Driver Hardware Tidak Kompatibel', 'Driver tidak cocok dengan versi Windows atau konflik antar driver', 'Software', 'Rollback, update, atau reinstall driver yang bermasalah', '[\"Rollback, update, atau reinstall driver yang bermasalah\"]', '0.00', '100000.00', 'Ringan', '2026-03-12 15:25:42', '2026-04-01 06:24:59', 2, 17),
(188, 'PCK075', 'pc', 'Bloatware / Startup Berlebihan', 'Terlalu banyak program startup memperlambat PC', 'Software', 'Disable startup program, clean boot, uninstall yang tidak perlu', '[\"Disable startup program, clean boot, uninstall yang tidak perlu\"]', '0.00', '50000.00', 'Ringan', '2026-03-12 15:25:42', '2026-04-01 06:24:59', 2, 17),
(189, 'PCK076', 'pc', 'File System / Partisi Corrupt', 'Partisi atau file system Windows mengalami kerusakan', 'Software', 'Jalankan CHKDSK /f /r, gunakan repair tools', '[\"Jalankan CHKDSK \\/f \\/r, gunakan repair tools\"]', '0.00', '200000.00', 'Ringan', '2026-03-12 15:25:42', '2026-04-01 06:24:59', 2, 17),
(190, 'PCK077', 'pc', 'User Profile Windows Corrupt', 'Profil pengguna Windows mengalami korupsi', 'Software', 'Buat profil user baru, migrasikan data, hapus profil lama', '[\"Buat profil user baru, migrasikan data, hapus profil lama\"]', '0.00', '100000.00', 'Ringan', '2026-03-12 15:25:42', '2026-04-01 06:24:59', 2, 17),
(191, 'PCK078', 'pc', 'Setting Overclock CPU Tidak Stabil', 'Setting frekuensi atau voltage OC CPU terlalu agresif', 'Overclocking', 'Turunkan multiplier, sesuaikan vcore, naikkan LLC', '[\"Turunkan multiplier, sesuaikan vcore, naikkan LLC\"]', '0.00', '100000.00', 'Ringan', '2026-03-12 15:25:42', '2026-03-12 15:25:42', NULL, NULL),
(192, 'PCK079', 'pc', 'XMP / EXPO Profile Tidak Kompatibel', 'Profil XMP/EXPO tidak didukung penuh oleh CPU atau motherboard', 'Overclocking', 'Coba XMP profile lebih rendah atau manual tuning timing', '[\"Coba XMP profile lebih rendah atau manual tuning timing\"]', '0.00', '100000.00', 'Ringan', '2026-03-12 15:25:42', '2026-03-12 15:25:42', NULL, NULL),
(193, 'PCK080', 'pc', 'GPU Overclock Tidak Stabil', 'Setting OC GPU terlalu tinggi menyebabkan crash atau artefak', 'Overclocking', 'Kurangi core clock offset, sesuaikan power limit, naikkan memori voltage tipis', '[\"Kurangi core clock offset, sesuaikan power limit, naikkan memori voltage tipis\"]', '0.00', '100000.00', 'Ringan', '2026-03-12 15:25:42', '2026-03-12 15:25:42', NULL, NULL),
(194, 'PCK081', 'pc', 'CPU Overvoltage Berbahaya', 'Vcore CPU terlalu tinggi berisiko merusak CPU dalam jangka panjang', 'Overclocking', 'Turunkan vcore ke rentang aman, gunakan LLC untuk stabilitas', '[\"Turunkan vcore ke rentang aman, gunakan LLC untuk stabilitas\"]', '0.00', '100000.00', 'Ringan', '2026-03-12 15:25:42', '2026-03-12 15:25:42', NULL, NULL),
(195, 'PCK082', 'pc', 'BIOS OC Setting Menyebabkan Boot Fail', 'Setting OC BIOS terlalu ekstrem sehingga PC tidak bisa booting', 'Overclocking', 'Clear CMOS untuk reset BIOS ke default, mulai OC ulang perlahan', '[\"Clear CMOS untuk reset BIOS ke default, mulai OC ulang perlahan\"]', '0.00', '50000.00', 'Ringan', '2026-03-12 15:25:42', '2026-03-12 15:25:42', NULL, NULL),
(196, 'PCK083', 'pc', 'Thermal Tidak Memadai untuk OC', 'Sistem pendinginan tidak cukup untuk mempertahankan OC yang stabil', 'Overclocking', 'Upgrade cooler CPU, optimalkan airflow casing', '[\"Upgrade cooler CPU, optimalkan airflow casing\"]', '100000.00', '2000000.00', 'Sedang', '2026-03-12 15:25:42', '2026-03-12 15:25:42', NULL, NULL),
(197, 'AIOK001', 'aio', 'Adaptor Eksternal AIO Rusak', 'Power brick / adaptor eksternal AIO tidak berfungsi atau output tidak stabil', 'Adaptor', 'Ganti adaptor original AIO sesuai voltase dan wattage (cek label adaptor lama)', '[\"Ganti adaptor original AIO sesuai voltase dan wattage (cek label adaptor lama)\"]', '150000.00', '700000.00', 'Ringan', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 22),
(198, 'AIOK002', 'aio', 'Kabel Adaptor Rusak / Terputus', 'Kabel DC dari adaptor ke port AIO rusak, terkelupas, atau putus di dalam', 'Adaptor', 'Ganti kabel adaptor atau ganti unit adaptor lengkap', '[\"Ganti kabel adaptor atau ganti unit adaptor lengkap\"]', '50000.00', '300000.00', 'Ringan', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 22),
(199, 'AIOK003', 'aio', 'Port DC Jack AIO Rusak', 'Konektor input daya (DC jack) pada body AIO rusak atau longgar', 'Adaptor', 'Perbaiki solder DC jack atau ganti DC jack AIO', '[\"Perbaiki solder DC jack atau ganti DC jack AIO\"]', '150000.00', '500000.00', 'Sedang', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 22),
(200, 'AIOK004', 'aio', 'Adaptor Tidak Sesuai Spesifikasi', 'Adaptor pengganti tidak sesuai voltase atau wattage yang dibutuhkan AIO', 'Adaptor', 'Ganti dengan adaptor original atau yang sesuai spec (voltase & watt sama)', '[\"Ganti dengan adaptor original atau yang sesuai spec (voltase & watt sama)\"]', '150000.00', '700000.00', 'Ringan', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 22),
(201, 'AIOK005', 'aio', 'IC Power Management AIO Bermasalah', 'Chip pengontrol daya pada motherboard AIO rusak sehingga distribusi daya tidak normal', 'Adaptor', 'Diagnosa IC power, ganti IC atau motherboard AIO', '[\"Diagnosa IC power, ganti IC atau motherboard AIO\"]', '300000.00', '3000000.00', 'Berat', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 22),
(202, 'AIOK006', 'aio', 'Tombol Power AIO Rusak', 'Tombol daya fisik atau kabel flex tombol power AIO rusak', 'Adaptor', 'Ganti tombol power atau kabel flex power AIO', '[\"Ganti tombol power atau kabel flex power AIO\"]', '100000.00', '400000.00', 'Ringan', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 22),
(203, 'AIOK007', 'aio', 'Panel LCD/LED AIO Rusak', 'Panel layar internal AIO mengalami kerusakan fisik atau elektronik', 'Display', 'Ganti panel LCD/LED sesuai ukuran dan model AIO', '[\"Ganti panel LCD\\/LED sesuai ukuran dan model AIO\"]', '800000.00', '5000000.00', 'Berat', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 23),
(204, 'AIOK008', 'aio', 'Kabel Flex Layar AIO Rusak / Longgar', 'Kabel flex penghubung panel layar ke motherboard longgar atau putus', 'Display', 'Buka body AIO, pasang ulang atau ganti kabel flex layar', '[\"Buka body AIO, pasang ulang atau ganti kabel flex layar\"]', '150000.00', '600000.00', 'Sedang', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 23),
(205, 'AIOK009', 'aio', 'Backlight LED Strip AIO Rusak', 'Strip LED backlight di belakang panel tidak berfungsi sehingga layar gelap', 'Display', 'Ganti LED backlight strip atau ganti panel AIO', '[\"Ganti LED backlight strip atau ganti panel AIO\"]', '200000.00', '1000000.00', 'Sedang', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 23),
(206, 'AIOK010', 'aio', 'T-CON Board / IC Driver Display Bermasalah', 'Board pengontrol panel atau IC driver display bermasalah', 'Display', 'Ganti T-CON board atau IC driver display AIO', '[\"Ganti T-CON board atau IC driver display AIO\"]', '300000.00', '1200000.00', 'Sedang', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 23),
(207, 'AIOK011', 'aio', 'Panel AIO Rusak Fisik (Pecah)', 'Panel layar AIO retak atau pecah akibat benturan atau tekanan', 'Display', 'Ganti panel layar baru sesuai model AIO — tidak bisa diperbaiki', '[\"Ganti panel layar baru sesuai model AIO \\u2014 tidak bisa diperbaiki\"]', '800000.00', '5000000.00', 'Berat', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 23),
(208, 'AIOK012', 'aio', 'iGPU / Driver Display AIO Bermasalah', 'GPU integrated (Intel UHD / AMD Radeon iGPU) atau driver display bermasalah', 'Display', 'Update atau reinstall driver GPU, jika hardware ganti motherboard AIO', '[\"Update atau reinstall driver GPU, jika hardware ganti motherboard AIO\"]', '0.00', '5000000.00', 'Sedang', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 23),
(209, 'AIOK013', 'aio', 'Digitizer / Touchscreen Panel AIO Rusak', 'Panel digitizer AIO mengalami kerusakan fisik atau elektronik', 'Touchscreen', 'Ganti digitizer assembly AIO sesuai model', '[\"Ganti digitizer assembly AIO sesuai model\"]', '600000.00', '3500000.00', 'Berat', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(210, 'AIOK014', 'aio', 'Driver Touchscreen Corrupt / Tidak Terinstall', 'Driver HID touchscreen tidak ada atau corrupt', 'Touchscreen', 'Install atau reinstall driver digitizer AIO dari website vendor', '[\"Install atau reinstall driver digitizer AIO dari website vendor\"]', '0.00', '100000.00', 'Ringan', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(211, 'AIOK015', 'aio', 'Konektor Digitizer AIO Longgar', 'Kabel konektor digitizer ke motherboard AIO longgar atau tidak terpasang', 'Touchscreen', 'Buka body AIO, pasang ulang konektor digitizer', '[\"Buka body AIO, pasang ulang konektor digitizer\"]', '50000.00', '200000.00', 'Ringan', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(212, 'AIOK016', 'aio', 'Kalibrasi Touchscreen Perlu Dilakukan', 'Kalibrasi panel touch tidak tepat sehingga input meleset dari target', 'Touchscreen', 'Jalankan kalibrasi touchscreen dari Settings Windows', '[\"Jalankan kalibrasi touchscreen dari Settings Windows\"]', '0.00', '50000.00', 'Ringan', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(213, 'AIOK017', 'aio', 'Digitizer Rusak Akibat Benturan / Tekanan', 'Digitizer rusak karena benturan fisik atau tekanan berlebihan pada panel', 'Touchscreen', 'Ganti digitizer assembly — tidak bisa diperbaiki jika rusak fisik', '[\"Ganti digitizer assembly \\u2014 tidak bisa diperbaiki jika rusak fisik\"]', '600000.00', '3500000.00', 'Berat', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(214, 'AIOK018', 'aio', 'Motherboard AIO Rusak / Perlu Diganti', 'Motherboard AIO mengalami kerusakan yang tidak bisa diperbaiki', 'Motherboard', 'Ganti motherboard AIO sesuai model — kompak seperti laptop', '[\"Ganti motherboard AIO sesuai model \\u2014 kompak seperti laptop\"]', '800000.00', '6000000.00', 'Berat', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(215, 'AIOK019', 'aio', 'Baterai CMOS AIO Habis', 'Baterai CMOS pada motherboard AIO sudah habis', 'Motherboard', 'Ganti baterai CMOS (biasanya CR2032 atau tipe built-in solder)', '[\"Ganti baterai CMOS (biasanya CR2032 atau tipe built-in solder)\"]', '15000.00', '100000.00', 'Ringan', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(216, 'AIOK020', 'aio', 'Kapasitor / Komponen SMD AIO Rusak', 'Kapasitor atau komponen SMD pada motherboard AIO kembung atau rusak', 'Motherboard', 'Ganti komponen yang rusak atau ganti motherboard AIO', '[\"Ganti komponen yang rusak atau ganti motherboard AIO\"]', '150000.00', '2000000.00', 'Sedang', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(217, 'AIOK021', 'aio', 'BIOS / UEFI AIO Corrupt', 'Firmware BIOS/UEFI AIO rusak sehingga tidak bisa booting normal', 'Motherboard', 'Flash ulang BIOS AIO menggunakan recovery USB atau programmer', '[\"Flash ulang BIOS AIO menggunakan recovery USB atau programmer\"]', '100000.00', '400000.00', 'Sedang', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(218, 'AIOK022', 'aio', 'Chipset / IC Controller Onboard AIO Rusak', 'IC pengontrol USB, audio, LAN, atau WiFi pada motherboard AIO rusak', 'Motherboard', 'Ganti IC yang rusak atau ganti motherboard AIO', '[\"Ganti IC yang rusak atau ganti motherboard AIO\"]', '300000.00', '4000000.00', 'Berat', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(219, 'AIOK023', 'aio', 'Thermal Paste CPU AIO Kering', 'Pasta termal antara CPU dan heatsink AIO sudah mengering', 'CPU', 'Buka body AIO, bersihkan dan ganti thermal paste CPU', '[\"Buka body AIO, bersihkan dan ganti thermal paste CPU\"]', '50000.00', '200000.00', 'Ringan', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(220, 'AIOK024', 'aio', 'Kipas / Sistem Pendinginan AIO Bermasalah', 'Kipas pendingin internal AIO tidak berputar atau tidak efektif', 'CPU', 'Bersihkan kipas dari debu, ganti kipas jika rusak', '[\"Bersihkan kipas dari debu, ganti kipas jika rusak\"]', '75000.00', '500000.00', 'Ringan', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(221, 'AIOK025', 'aio', 'CPU AIO Overheating', 'CPU mencapai suhu kritis sehingga throttling atau crash', 'CPU', 'Ganti thermal paste, bersihkan heatsink, pastikan kipas berfungsi', '[\"Ganti thermal paste, bersihkan heatsink, pastikan kipas berfungsi\"]', '50000.00', '400000.00', 'Sedang', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(222, 'AIOK026', 'aio', 'CPU AIO Rusak / Defektif', 'CPU pada motherboard AIO mengalami kerusakan internal', 'CPU', 'Ganti CPU (jika tidak solder) atau ganti motherboard AIO', '[\"Ganti CPU (jika tidak solder) atau ganti motherboard AIO\"]', '500000.00', '6000000.00', 'Berat', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(223, 'AIOK027', 'aio', 'Heatsink CPU AIO Tidak Terpasang Rapat', 'Heatsink tidak menempel sempurna pada CPU AIO', 'CPU', 'Buka body AIO, pasang ulang heatsink dengan tekanan yang benar', '[\"Buka body AIO, pasang ulang heatsink dengan tekanan yang benar\"]', '50000.00', '200000.00', 'Ringan', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(224, 'AIOK028', 'aio', 'RAM SO-DIMM AIO Tidak Terpasang Benar', 'RAM SO-DIMM longgar, miring, atau tidak terklik sempurna di slot', 'RAM SO-DIMM', 'Cabut dan pasang ulang RAM SO-DIMM dengan benar', '[\"Cabut dan pasang ulang RAM SO-DIMM dengan benar\"]', '0.00', '50000.00', 'Ringan', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(225, 'AIOK029', 'aio', 'Modul RAM SO-DIMM AIO Rusak', 'Chip memori pada modul SO-DIMM AIO mengalami kerusakan', 'RAM SO-DIMM', 'Ganti modul RAM SO-DIMM yang sesuai spesifikasi AIO', '[\"Ganti modul RAM SO-DIMM yang sesuai spesifikasi AIO\"]', '150000.00', '1500000.00', 'Sedang', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(226, 'AIOK030', 'aio', 'Slot SO-DIMM Motherboard AIO Rusak', 'Slot RAM pada motherboard AIO rusak secara fisik atau elektronik', 'RAM SO-DIMM', 'Gunakan slot SO-DIMM lain jika tersedia, atau ganti motherboard AIO', '[\"Gunakan slot SO-DIMM lain jika tersedia, atau ganti motherboard AIO\"]', '500000.00', '5000000.00', 'Berat', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(227, 'AIOK031', 'aio', 'Kontak SO-DIMM Kotor', 'Kontak emas pada modul SO-DIMM kotor atau teroksidasi', 'RAM SO-DIMM', 'Bersihkan kontak SO-DIMM dengan penghapus pensil lembut', '[\"Bersihkan kontak SO-DIMM dengan penghapus pensil lembut\"]', '0.00', '50000.00', 'Ringan', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(228, 'AIOK032', 'aio', 'RAM SO-DIMM Tidak Kompatibel', 'RAM SO-DIMM terlalu cepat atau tipe tidak didukung motherboard AIO', 'RAM SO-DIMM', 'Ganti RAM SO-DIMM yang kompatibel, cek QVL dari vendor AIO', '[\"Ganti RAM SO-DIMM yang kompatibel, cek QVL dari vendor AIO\"]', '0.00', '1500000.00', 'Ringan', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(229, 'AIOK033', 'aio', 'HDD 2.5\" AIO Rusak / Failing', 'Hard disk 2.5\" pada AIO mengalami kerusakan mekanis atau elektronik', 'Storage', 'Backup data segera, ganti HDD 2.5\" atau upgrade ke SSD 2.5\"', '[\"Backup data segera, ganti HDD 2.5\\\" atau upgrade ke SSD 2.5\\\"\"]', '250000.00', '1000000.00', 'Berat', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(230, 'AIOK034', 'aio', 'SSD AIO Degradasi / Failing', 'SSD (M.2 atau 2.5\" SATA) AIO mengalami degradasi atau controller error', 'Storage', 'Backup data segera, ganti SSD yang kompatibel', '[\"Backup data segera, ganti SSD yang kompatibel\"]', '200000.00', '1500000.00', 'Sedang', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(231, 'AIOK035', 'aio', 'Bad Sector pada HDD 2.5\" AIO', 'Sektor fisik HDD 2.5\" pada AIO rusak', 'Storage', 'Backup data, repair dengan tools, ganti jika bad sector banyak', '[\"Backup data, repair dengan tools, ganti jika bad sector banyak\"]', '100000.00', '800000.00', 'Sedang', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(232, 'AIOK036', 'aio', 'Konektor SATA / Slot M.2 AIO Rusak', 'Konektor SATA atau slot M.2 pada motherboard AIO longgar atau rusak', 'Storage', 'Pasang ulang konektor atau ganti motherboard jika slot M.2 rusak', '[\"Pasang ulang konektor atau ganti motherboard jika slot M.2 rusak\"]', '50000.00', '400000.00', 'Ringan', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(233, 'AIOK037', 'aio', 'Partisi / MBR / GPT AIO Corrupt', 'Tabel partisi atau boot record storage AIO corrupt', 'Storage', 'Gunakan CHKDSK, TestDisk, atau repair Windows untuk perbaikan', '[\"Gunakan CHKDSK, TestDisk, atau repair Windows untuk perbaikan\"]', '0.00', '200000.00', 'Ringan', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(234, 'AIOK038', 'aio', 'Debu Menumpuk di Sistem Pendinginan AIO', 'Debu menyumbat jalur udara dan heatsink AIO sehingga panas berlebihan', 'Thermal', 'Bersihkan debu di seluruh sistem pendinginan AIO dengan compressed air', '[\"Bersihkan debu di seluruh sistem pendinginan AIO dengan compressed air\"]', '75000.00', '250000.00', 'Ringan', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 25),
(235, 'AIOK039', 'aio', 'Thermal Paste CPU/GPU AIO Kering', 'Pasta termal antara chip dan heatsink AIO sudah mengering', 'Thermal', 'Ganti thermal paste CPU dan GPU AIO', '[\"Ganti thermal paste CPU dan GPU AIO\"]', '50000.00', '200000.00', 'Ringan', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 25),
(236, 'AIOK040', 'aio', 'Kipas Internal AIO Rusak / Mati', 'Kipas pendingin dalam AIO tidak berputar atau berputar tidak normal', 'Thermal', 'Ganti kipas internal AIO sesuai model', '[\"Ganti kipas internal AIO sesuai model\"]', '100000.00', '500000.00', 'Ringan', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 25),
(237, 'AIOK041', 'aio', 'Heatsink AIO Tidak Terpasang Rapat', 'Heatsink tidak menempel sempurna pada chip CPU atau GPU AIO', 'Thermal', 'Buka body AIO, pasang ulang heatsink dengan tekanan benar', '[\"Buka body AIO, pasang ulang heatsink dengan tekanan benar\"]', '50000.00', '200000.00', 'Ringan', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 25),
(238, 'AIOK042', 'aio', 'Ventilasi AIO Tersumbat', 'Jalur udara pada body AIO tersumbat debu atau benda asing', 'Thermal', 'Bersihkan ventilasi dari luar dan dalam, pastikan sirkulasi lancar', '[\"Bersihkan ventilasi dari luar dan dalam, pastikan sirkulasi lancar\"]', '50000.00', '150000.00', 'Ringan', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 25),
(239, 'AIOK043', 'aio', 'Driver Audio AIO Corrupt / Bermasalah', 'Driver Realtek atau audio lain pada AIO corrupt atau tidak kompatibel', 'Audio', 'Uninstall dan install ulang driver audio AIO dari website vendor', '[\"Uninstall dan install ulang driver audio AIO dari website vendor\"]', '0.00', '100000.00', 'Ringan', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 26),
(240, 'AIOK044', 'aio', 'Speaker Internal AIO Rusak', 'Unit speaker built-in AIO mengalami kerusakan fisik', 'Audio', 'Ganti speaker internal AIO sesuai model', '[\"Ganti speaker internal AIO sesuai model\"]', '100000.00', '500000.00', 'Ringan', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 26),
(241, 'AIOK045', 'aio', 'IC Audio Onboard AIO Rusak', 'Chip audio pada motherboard AIO rusak', 'Audio', 'Gunakan USB audio adapter eksternal atau ganti motherboard AIO', '[\"Gunakan USB audio adapter eksternal atau ganti motherboard AIO\"]', '50000.00', '3000000.00', 'Sedang', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 26),
(242, 'AIOK046', 'aio', 'Jack Audio AIO Rusak Fisik', 'Port jack 3.5mm pada body AIO rusak secara fisik', 'Audio', 'Ganti jack audio atau gunakan USB audio adapter', '[\"Ganti jack audio atau gunakan USB audio adapter\"]', '100000.00', '400000.00', 'Ringan', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 26),
(243, 'AIOK047', 'aio', 'Kabel Speaker Internal AIO Longgar', 'Kabel yang menghubungkan speaker ke motherboard AIO longgar atau lepas', 'Audio', 'Buka body AIO, pasang ulang kabel speaker internal', '[\"Buka body AIO, pasang ulang kabel speaker internal\"]', '50000.00', '200000.00', 'Ringan', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 26),
(244, 'AIOK048', 'aio', 'Mikrofon Internal AIO Rusak', 'Mikrofon built-in pada AIO rusak', 'Audio', 'Ganti modul mikrofon internal atau gunakan mikrofon eksternal USB', '[\"Ganti modul mikrofon internal atau gunakan mikrofon eksternal USB\"]', '100000.00', '400000.00', 'Ringan', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 26),
(245, 'AIOK049', 'aio', 'Driver WiFi / Bluetooth AIO Bermasalah', 'Driver wireless atau bluetooth corrupt atau tidak kompatibel', 'Konektivitas', 'Reinstall driver WiFi dan Bluetooth AIO dari website vendor', '[\"Reinstall driver WiFi dan Bluetooth AIO dari website vendor\"]', '0.00', '100000.00', 'Ringan', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 27),
(246, 'AIOK050', 'aio', 'Modul WiFi / Bluetooth AIO Rusak', 'Modul wireless combo (biasanya M.2 A-key/E-key) pada AIO rusak', 'Konektivitas', 'Ganti modul WiFi/Bluetooth AIO sesuai slot yang tersedia', '[\"Ganti modul WiFi\\/Bluetooth AIO sesuai slot yang tersedia\"]', '150000.00', '600000.00', 'Sedang', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 27),
(247, 'AIOK051', 'aio', 'Antena WiFi Internal AIO Rusak / Tidak Terpasang', 'Kabel antena WiFi di dalam body AIO putus atau tidak terpasang ke modul', 'Konektivitas', 'Buka body AIO, pasang ulang atau ganti kabel antena WiFi', '[\"Buka body AIO, pasang ulang atau ganti kabel antena WiFi\"]', '100000.00', '400000.00', 'Ringan', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 27),
(248, 'AIOK052', 'aio', 'IC LAN Onboard AIO Rusak', 'Chip LAN Ethernet onboard pada motherboard AIO rusak', 'Konektivitas', 'Gunakan USB LAN adapter eksternal atau ganti motherboard AIO', '[\"Gunakan USB LAN adapter eksternal atau ganti motherboard AIO\"]', '50000.00', '3000000.00', 'Sedang', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 27),
(249, 'AIOK053', 'aio', 'Konfigurasi Jaringan AIO Bermasalah', 'Setting IP, DNS, atau konfigurasi jaringan AIO salah atau corrupt', 'Konektivitas', 'Reset konfigurasi jaringan, flush DNS, netsh winsock reset', '[\"Reset konfigurasi jaringan, flush DNS, netsh winsock reset\"]', '0.00', '100000.00', 'Ringan', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 27),
(250, 'AIOK054', 'aio', 'Driver Kamera AIO Corrupt / Bermasalah', 'Driver webcam corrupt atau tidak kompatibel', 'Webcam', 'Reinstall driver kamera AIO dari website vendor', '[\"Reinstall driver kamera AIO dari website vendor\"]', '0.00', '100000.00', 'Ringan', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(251, 'AIOK055', 'aio', 'Modul Kamera Internal AIO Rusak', 'Modul kamera built-in AIO rusak fisik atau elektronik', 'Webcam', 'Ganti modul kamera internal AIO sesuai model', '[\"Ganti modul kamera internal AIO sesuai model\"]', '150000.00', '600000.00', 'Sedang', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(252, 'AIOK056', 'aio', 'Konektor Kabel Kamera AIO Longgar', 'Kabel yang menghubungkan modul kamera ke motherboard longgar', 'Webcam', 'Buka body AIO, pasang ulang konektor kabel kamera', '[\"Buka body AIO, pasang ulang konektor kabel kamera\"]', '50000.00', '200000.00', 'Ringan', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(253, 'AIOK057', 'aio', 'Privacy Settings / App Permission Bermasalah', 'Pengaturan privasi Windows atau izin aplikasi memblokir kamera', 'Webcam', 'Izinkan akses kamera di Settings > Privacy & Security > Camera', '[\"Izinkan akses kamera di Settings > Privacy & Security > Camera\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(254, 'AIOK058', 'aio', 'Driver USB Controller AIO Bermasalah', 'Driver USB host controller corrupt atau tidak kompatibel', 'Peripheral', 'Reinstall USB controller driver di Device Manager, restart AIO', '[\"Reinstall USB controller driver di Device Manager, restart AIO\"]', '0.00', '100000.00', 'Ringan', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(255, 'AIOK059', 'aio', 'Port USB / USB-C AIO Rusak Fisik', 'Port USB atau USB-C pada body AIO rusak secara fisik', 'Peripheral', 'Ganti port USB atau perbaiki solder point di motherboard AIO', '[\"Ganti port USB atau perbaiki solder point di motherboard AIO\"]', '150000.00', '600000.00', 'Sedang', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(256, 'AIOK060', 'aio', 'IC USB Controller Onboard AIO Rusak', 'Chip USB host controller pada motherboard AIO rusak', 'Peripheral', 'Ganti IC atau motherboard AIO', '[\"Ganti IC atau motherboard AIO\"]', '300000.00', '4000000.00', 'Berat', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(257, 'AIOK061', 'aio', 'Keyboard / Mouse Wireless AIO Bermasalah', 'Perangkat input wireless bawaan tidak tersinkronisasi atau rusak', 'Peripheral', 'Sinkronisasi ulang, ganti baterai, atau ganti perangkat input', '[\"Sinkronisasi ulang, ganti baterai, atau ganti perangkat input\"]', '50000.00', '500000.00', 'Ringan', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(258, 'AIOK062', 'aio', 'Daya Port USB AIO Tidak Mencukupi', 'Port USB tidak mendapat daya yang cukup untuk perangkat tertentu', 'Peripheral', 'Cek power management USB di Device Manager, gunakan powered hub', '[\"Cek power management USB di Device Manager, gunakan powered hub\"]', '0.00', '200000.00', 'Ringan', '2026-03-12 15:25:44', '2026-03-12 15:25:44', NULL, NULL),
(259, 'AIOK063', 'aio', 'Windows / OS AIO Corrupt', 'File sistem operasi Windows pada AIO rusak atau hilang', 'Software', 'Jalankan SFC /scannow, DISM, atau install ulang Windows', '[\"Jalankan SFC \\/scannow, DISM, atau install ulang Windows\"]', '100000.00', '300000.00', 'Ringan', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 24),
(260, 'AIOK064', 'aio', 'Infeksi Virus / Malware AIO', 'AIO terinfeksi virus, malware, ransomware, atau spyware', 'Software', 'Scan mendalam dengan antivirus, reinstall OS jika parah', '[\"Scan mendalam dengan antivirus, reinstall OS jika parah\"]', '50000.00', '300000.00', 'Ringan', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 24),
(261, 'AIOK065', 'aio', 'Driver Hardware Tidak Kompatibel di AIO', 'Driver tidak cocok dengan versi Windows atau konflik antar driver', 'Software', 'Rollback, update, atau reinstall driver yang bermasalah', '[\"Rollback, update, atau reinstall driver yang bermasalah\"]', '0.00', '100000.00', 'Ringan', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 24),
(262, 'AIOK066', 'aio', 'Bloatware / Startup Berlebihan di AIO', 'Banyak aplikasi OEM vendor berjalan di startup memperlambat AIO', 'Software', 'Disable startup apps, uninstall bloatware vendor', '[\"Disable startup apps, uninstall bloatware vendor\"]', '0.00', '50000.00', 'Ringan', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 24),
(263, 'AIOK067', 'aio', 'File System / Partisi AIO Corrupt', 'Partisi atau file system Windows AIO mengalami kerusakan', 'Software', 'Jalankan CHKDSK /f /r, gunakan repair tools', '[\"Jalankan CHKDSK \\/f \\/r, gunakan repair tools\"]', '0.00', '200000.00', 'Ringan', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 24),
(264, 'AIOK068', 'aio', 'Recovery System AIO Bermasalah', 'Partisi recovery atau fitur reset AIO rusak', 'Software', 'Buat bootable USB recovery, repair atau install ulang Windows', '[\"Buat bootable USB recovery, repair atau install ulang Windows\"]', '0.00', '300000.00', 'Ringan', '2026-03-12 15:25:44', '2026-04-01 06:24:59', 3, 24),
(265, 'PRK001', 'printer', 'Print Head Tersumbat', 'Print head mengalami penyumbatan pada nozzle sehingga hasil cetak bergaris, tidak lengkap, atau warna hilang.', 'Kualitas Cetak', 'Jalankan head cleaning dari utility printer (3-5 kali). Jika tidak berhasil, rendam head di cairan pembersih khusus. Terakhir, ganti print head.', '[\"Jalankan head cleaning dari utility printer (3-5 kali). Jika tidak berhasil, rendam head di cairan pembersih khusus. Terakhir, ganti print head.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 28),
(266, 'PRK002', 'printer', 'Tinta/Toner Habis atau Rendah', 'Level tinta atau toner sudah rendah sehingga hasil cetak pudar atau tidak merata.', 'Kualitas Cetak', 'Isi ulang tinta (ink tank) atau ganti cartridge tinta/toner. Pastikan menggunakan tinta/toner yang sesuai spesifikasi printer.', '[\"Isi ulang tinta (ink tank) atau ganti cartridge tinta\\/toner. Pastikan menggunakan tinta\\/toner yang sesuai spesifikasi printer.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 28),
(267, 'PRK003', 'printer', 'Tinta/Toner Tidak Kompatibel', 'Penggunaan tinta/toner non-original atau tidak sesuai menyebabkan kualitas cetak buruk.', 'Kualitas Cetak', 'Gunakan tinta/toner original atau compatible yang teruji. Bersihkan head setelah ganti tinta. Jika sudah terlanjur, flush sistem tinta dan ganti.', '[\"Gunakan tinta\\/toner original atau compatible yang teruji. Bersihkan head setelah ganti tinta. Jika sudah terlanjur, flush sistem tinta dan ganti.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 28),
(268, 'PRK004', 'printer', 'Print Head Misalignment', 'Print head tidak sejajar (misalign) sehingga cetakan tidak rata atau ada gap antar baris.', 'Kualitas Cetak', 'Jalankan Head Alignment dari utility printer. Cetak alignment test page dan ikuti instruksi. Jika gagal, cek encoder strip dan bersihkan.', '[\"Jalankan Head Alignment dari utility printer. Cetak alignment test page dan ikuti instruksi. Jika gagal, cek encoder strip dan bersihkan.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 28),
(269, 'PRK005', 'printer', 'Drum Unit Aus (Laser)', 'Drum OPC pada printer laser sudah aus menyebabkan titik-titik berulang, background kotor, atau ghost image.', 'Kualitas Cetak', 'Ganti drum unit/cartridge drum. Periksa counter drum di service menu. Hindari menyentuh permukaan drum dan paparan cahaya langsung.', '[\"Ganti drum unit\\/cartridge drum. Periksa counter drum di service menu. Hindari menyentuh permukaan drum dan paparan cahaya langsung.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 28),
(270, 'PRK006', 'printer', 'Fuser Unit Rusak (Laser)', 'Fuser unit pada printer laser rusak sehingga toner tidak menempel pada kertas (mudah luntur) atau kertas berkerut.', 'Kualitas Cetak', 'Ganti fuser assembly. Periksa fuser film/sleeve. Pastikan fuser temperature normal. Ganti juga pressure roller jika aus.', '[\"Ganti fuser assembly. Periksa fuser film\\/sleeve. Pastikan fuser temperature normal. Ganti juga pressure roller jika aus.\"]', '0.00', '0.00', 'Berat', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 28),
(271, 'PRK007', 'printer', 'Setting Cetak Salah', 'Pengaturan kualitas cetak, jenis media, atau resolusi yang salah menghasilkan output tidak optimal.', 'Kualitas Cetak', 'Sesuaikan setting cetak: pilih media type yang benar, atur kualitas ke \"Best\" atau \"High\", pilih color profile yang tepat. Cek print preview sebelum cetak.', '[\"Sesuaikan setting cetak: pilih media type yang benar, atur kualitas ke \\\"Best\\\" atau \\\"High\\\", pilih color profile yang tepat. Cek print preview sebelum cetak.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 28),
(272, 'PRK008', 'printer', 'Cartridge Tinta Tidak Terdeteksi', 'Cartridge tinta tidak dikenali oleh printer karena chip error, tidak terpasang sempurna, atau cartridge rusak.', 'Tinta', 'Lepas dan pasang ulang cartridge. Bersihkan chip contact dengan tisu kering. Cek cartridge di printer lain (jika memungkinkan). Ganti cartridge jika tetap error.', '[\"Lepas dan pasang ulang cartridge. Bersihkan chip contact dengan tisu kering. Cek cartridge di printer lain (jika memungkinkan). Ganti cartridge jika tetap error.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 29),
(273, 'PRK009', 'printer', 'Tinta Bocor dari Cartridge/Tank', 'Tinta bocor dari cartridge, selang infus, atau ink tank menyebabkan tinta tumpah ke internal printer.', 'Tinta', 'Bersihkan tinta yang tumpah. Periksa seal cartridge. Cek selang infus untuk kebocoran. Ganti cartridge/selang yang bocor. Pasang ulang dengan benar.', '[\"Bersihkan tinta yang tumpah. Periksa seal cartridge. Cek selang infus untuk kebocoran. Ganti cartridge\\/selang yang bocor. Pasang ulang dengan benar.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 29),
(274, 'PRK010', 'printer', 'Waste Ink Pad Penuh', 'Waste ink absorber/pad sudah penuh sehingga printer menolak untuk mencetak (error blinking).', 'Tinta', 'Reset waste ink counter menggunakan software reset (WIC Reset, SSC Service Utility). Ganti atau bersihkan waste ink pad. Jika printer ini external waste ink, kosongkan wadah.', '[\"Reset waste ink counter menggunakan software reset (WIC Reset, SSC Service Utility). Ganti atau bersihkan waste ink pad. Jika printer ini external waste ink, kosongkan wadah.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 29),
(275, 'PRK011', 'printer', 'Chip Cartridge Perlu Reset', 'Counter chip cartridge sudah penuh meskipun tinta masih ada (khususnya cartridge refill).', 'Tinta', 'Reset chip cartridge menggunakan chip resetter khusus. Atau ganti chip cartridge baru. Beberapa printer bisa bypass via firmware setting.', '[\"Reset chip cartridge menggunakan chip resetter khusus. Atau ganti chip cartridge baru. Beberapa printer bisa bypass via firmware setting.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 29),
(276, 'PRK012', 'printer', 'Selang Infus Tinta Bermasalah', 'Sistem tinta infus (CISS) mengalami masalah: selang tersumbat, bocor, atau ada gelembung udara.', 'Tinta', 'Periksa selang untuk sumbatan atau gelembung udara. Flush selang dengan syringe. Kencangkan konektor. Ganti selang jika bocor.', '[\"Periksa selang untuk sumbatan atau gelembung udara. Flush selang dengan syringe. Kencangkan konektor. Ganti selang jika bocor.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 29),
(277, 'PRK013', 'printer', 'Cartridge Toner Rusak/Defektif', 'Cartridge toner rusak secara fisik (seal tidak tepat, gear patah) menyebabkan toner bocor atau cetak tidak merata.', 'Tinta', 'Ganti cartridge toner baru. Pastikan seal protection sudah dilepas sebelum install. Kocok cartridge sebelum pasang (sesuai instruksi).', '[\"Ganti cartridge toner baru. Pastikan seal protection sudah dilepas sebelum install. Kocok cartridge sebelum pasang (sesuai instruksi).\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 29),
(278, 'PRK014', 'printer', 'Head Printer Rusak Permanen', 'Print head mengalami kerusakan permanen (burnt nozzle, korosi) yang tidak bisa diperbaiki dengan cleaning.', 'Tinta', 'Ganti print head baru sesuai model printer. Untuk printer di mana head menyatu dengan cartridge, cukup ganti cartridge baru.', '[\"Ganti print head baru sesuai model printer. Untuk printer di mana head menyatu dengan cartridge, cukup ganti cartridge baru.\"]', '0.00', '0.00', 'Berat', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 29),
(279, 'PRK015', 'printer', 'Paper Jam (Kertas Macet)', 'Kertas macet/nyangkut di dalam mekanisme printer karena roller aus, kertas rusak, atau benda asing.', 'Kertas', 'Matikan printer. Tarik kertas yang macet secara perlahan searah jalur kertas. Periksa sisa sobekan kertas. Bersihkan roller. Gunakan kertas berkualitas baik.', '[\"Matikan printer. Tarik kertas yang macet secara perlahan searah jalur kertas. Periksa sisa sobekan kertas. Bersihkan roller. Gunakan kertas berkualitas baik.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 30),
(280, 'PRK016', 'printer', 'Pickup Roller Aus', 'Roller pengambil kertas sudah aus/licin sehingga tidak bisa mengambil kertas dari tray.', 'Kertas', 'Bersihkan roller dengan kain lembab dan sedikit isopropyl alcohol. Jika sudah sangat aus (halus/licin), ganti pickup roller baru.', '[\"Bersihkan roller dengan kain lembab dan sedikit isopropyl alcohol. Jika sudah sangat aus (halus\\/licin), ganti pickup roller baru.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 30),
(281, 'PRK017', 'printer', 'Sensor Kertas Rusak', 'Sensor pendeteksi kertas rusak atau kotor menyebabkan false paper jam atau printer tidak mendeteksi kertas.', 'Kertas', 'Bersihkan sensor kertas dari debu/kertas. Cek koneksi kabel sensor ke mainboard. Ganti sensor jika rusak.', '[\"Bersihkan sensor kertas dari debu\\/kertas. Cek koneksi kabel sensor ke mainboard. Ganti sensor jika rusak.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 30),
(282, 'PRK018', 'printer', 'Tray Kertas Rusak/Tidak Pas', 'Tray/wadah kertas rusak, guide kertas tidak pas, atau mekanisme pengunci tidak berfungsi.', 'Kertas', 'Atur paper guide agar pas dengan ukuran kertas. Perbaiki atau ganti tray yang rusak. Pastikan tidak terlalu banyak kertas di tray.', '[\"Atur paper guide agar pas dengan ukuran kertas. Perbaiki atau ganti tray yang rusak. Pastikan tidak terlalu banyak kertas di tray.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 30),
(283, 'PRK019', 'printer', 'ADF (Auto Document Feeder) Error', 'ADF tidak berfungsi: macet, tidak mengambil kertas, atau menarik lebih dari satu lembar.', 'Kertas', 'Bersihkan roller ADF. Periksa separation pad. Gunakan kertas yang tidak bergaris atau berlipat. Ganti roller ADF jika aus.', '[\"Bersihkan roller ADF. Periksa separation pad. Gunakan kertas yang tidak bergaris atau berlipat. Ganti roller ADF jika aus.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 30),
(284, 'PRK020', 'printer', 'Duplex Unit Error', 'Unit cetak bolak-balik (duplex) bermasalah: kertas macet, tidak membalik, atau hasil tidak rata.', 'Kertas', 'Bersihkan jalur duplex. Periksa roller duplex. Pastikan kertas sesuai spesifikasi (tidak terlalu tebal). Cek setting duplex di driver printer.', '[\"Bersihkan jalur duplex. Periksa roller duplex. Pastikan kertas sesuai spesifikasi (tidak terlalu tebal). Cek setting duplex di driver printer.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 30);
INSERT INTO `diseases` (`id`, `code`, `device_type`, `name`, `description`, `category`, `solution`, `actions`, `min_cost`, `max_cost`, `level`, `created_at`, `updated_at`, `device_type_id`, `device_component_id`) VALUES
(285, 'PRK021', 'printer', 'Koneksi USB Printer Bermasalah', 'Printer tidak terdeteksi melalui koneksi USB karena kabel rusak, port error, atau driver tidak terinstall.', 'Konektivitas', 'Coba kabel USB lain. Coba port USB yang berbeda. Reinstall driver printer. Cek Device Manager apakah ada error.', '[\"Coba kabel USB lain. Coba port USB yang berbeda. Reinstall driver printer. Cek Device Manager apakah ada error.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 31),
(286, 'PRK022', 'printer', 'WiFi Printer Bermasalah', 'Printer tidak bisa terhubung ke jaringan WiFi atau sering putus.', 'Konektivitas', 'Reset network setting printer. Hubungkan ulang ke WiFi. Pastikan printer dan PC di jaringan yang sama. Gunakan IP statis untuk printer. Pindahkan ke dekat router.', '[\"Reset network setting printer. Hubungkan ulang ke WiFi. Pastikan printer dan PC di jaringan yang sama. Gunakan IP statis untuk printer. Pindahkan ke dekat router.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 31),
(287, 'PRK023', 'printer', 'Print Spooler Error', 'Layanan Print Spooler di Windows crash atau bermasalah menyebabkan print job tidak terkirim.', 'Konektivitas', 'Restart Print Spooler: services.msc → Print Spooler → Restart. Hapus file di C:\\Windows\\System32\\spool\\PRINTERS\\. Jika berulang, reinstall driver printer.', '[\"Restart Print Spooler: services.msc \\u2192 Print Spooler \\u2192 Restart. Hapus file di C:\\\\Windows\\\\System32\\\\spool\\\\PRINTERS\\\\. Jika berulang, reinstall driver printer.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 31),
(288, 'PRK024', 'printer', 'Printer Network/Sharing Error', 'Printer yang di-share melalui jaringan tidak bisa diakses oleh komputer lain.', 'Konektivitas', 'Pastikan Network Discovery aktif. Cek firewall setting. Pastikan driver printer tersedia untuk OS klien. Gunakan IP address printer langsung jika memungkinkan.', '[\"Pastikan Network Discovery aktif. Cek firewall setting. Pastikan driver printer tersedia untuk OS klien. Gunakan IP address printer langsung jika memungkinkan.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 31),
(289, 'PRK025', 'printer', 'Port Printer USB Rusak Fisik', 'Port USB pada printer rusak secara fisik sehingga kabel tidak terkoneksi dengan baik.', 'Konektivitas', 'Jika printer memiliki WiFi/LAN, gunakan koneksi wireless/network sebagai alternatif. Untuk perbaikan port USB, bawa ke service center.', '[\"Jika printer memiliki WiFi\\/LAN, gunakan koneksi wireless\\/network sebagai alternatif. Untuk perbaikan port USB, bawa ke service center.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 31),
(290, 'PRK026', 'printer', 'IP Address Printer Conflict/Berubah', 'IP address printer berubah-ubah (DHCP) sehingga komputer kehilangan koneksi ke printer.', 'Konektivitas', 'Set IP statis pada printer melalui panel kontrol atau web interface printer. Atau buat DHCP reservation di router untuk MAC address printer.', '[\"Set IP statis pada printer melalui panel kontrol atau web interface printer. Atau buat DHCP reservation di router untuk MAC address printer.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 31),
(291, 'PRK027', 'printer', 'Power Supply Printer Rusak', 'Power supply internal atau adaptor printer rusak sehingga printer mati total atau restart sendiri.', 'Hardware', 'Tes dengan adaptor/kabel power lain (jika tersedia). Cek tegangan dengan multimeter. Ganti adaptor atau power board yang rusak.', '[\"Tes dengan adaptor\\/kabel power lain (jika tersedia). Cek tegangan dengan multimeter. Ganti adaptor atau power board yang rusak.\"]', '0.00', '0.00', 'Berat', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 32),
(292, 'PRK028', 'printer', 'Mainboard/Logic Board Printer Rusak', 'Board utama printer mengalami kerusakan menyebabkan printer mati, error, atau tidak merespon.', 'Hardware', 'Diagnosa dengan cek tegangan di mainboard. Ganti mainboard jika rusak. Pertimbangkan biaya: jika mahal, mungkin lebih hemat beli printer baru.', '[\"Diagnosa dengan cek tegangan di mainboard. Ganti mainboard jika rusak. Pertimbangkan biaya: jika mahal, mungkin lebih hemat beli printer baru.\"]', '0.00', '0.00', 'Berat', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 32),
(293, 'PRK029', 'printer', 'Panel LCD/Display Printer Rusak', 'Layar LCD panel kontrol printer rusak atau tidak menampilkan informasi.', 'Hardware', 'Cek kabel flex panel LCD. Ganti panel LCD jika rusak. Printer masih bisa digunakan via komputer meski panel mati.', '[\"Cek kabel flex panel LCD. Ganti panel LCD jika rusak. Printer masih bisa digunakan via komputer meski panel mati.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 32),
(294, 'PRK030', 'printer', 'Printer Overheat', 'Printer mengalami overheat karena penggunaan berlebihan, ventilasi buruk, atau komponen rusak.', 'Hardware', 'Beri jeda antar sesi cetak panjang. Pastikan ventilasi printer tidak terhalang. Bersihkan internal printer dari debu. Cek fuser jika printer laser.', '[\"Beri jeda antar sesi cetak panjang. Pastikan ventilasi printer tidak terhalang. Bersihkan internal printer dari debu. Cek fuser jika printer laser.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 32),
(295, 'PRK031', 'printer', 'Memori Printer Penuh', 'RAM printer tidak cukup untuk memproses print job yang besar (file kompleks atau resolusi tinggi).', 'Hardware', 'Kurangi resolusi cetak. Cetak per halaman. Upgrade RAM printer (jika bisa). Konversi file ke format lebih kecil. Hapus job lama di queue.', '[\"Kurangi resolusi cetak. Cetak per halaman. Upgrade RAM printer (jika bisa). Konversi file ke format lebih kecil. Hapus job lama di queue.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 32),
(296, 'PRK032', 'printer', 'Cover/Penutup Printer Tidak Menutup', 'Penutup/cover printer tidak menutup sempurna sehingga printer menolak beroperasi (safety interlock).', 'Hardware', 'Periksa apakah ada kertas atau benda yang menghalangi cover. Cek hinge/engsel cover. Pastikan cartridge terpasang dengan benar.', '[\"Periksa apakah ada kertas atau benda yang menghalangi cover. Cek hinge\\/engsel cover. Pastikan cartridge terpasang dengan benar.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 32),
(297, 'PRK033', 'printer', 'Driver Printer Tidak Terinstall/Corrupt', 'Driver printer belum terinstall, rusak, atau tidak kompatibel dengan OS.', 'Software', 'Download driver terbaru dari website resmi manufacturer. Uninstall driver lama terlebih dahulu. Install ulang driver. Gunakan compatibility mode jika perlu.', '[\"Download driver terbaru dari website resmi manufacturer. Uninstall driver lama terlebih dahulu. Install ulang driver. Gunakan compatibility mode jika perlu.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 33),
(298, 'PRK034', 'printer', 'Firmware Printer Outdated/Error', 'Firmware printer perlu update untuk memperbaiki bug atau mendukung fitur baru.', 'Software', 'Download firmware update dari website manufacturer. Update via USB atau WiFi sesuai instruksi. JANGAN matikan printer saat proses update.', '[\"Download firmware update dari website manufacturer. Update via USB atau WiFi sesuai instruksi. JANGAN matikan printer saat proses update.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 33),
(299, 'PRK035', 'printer', 'Print Queue/Antrian Stuck', 'Antrian cetak macet dan tidak bisa dihapus secara normal.', 'Software', 'Stop Print Spooler service → hapus file di PRINTERS folder → restart Spooler. Atau restart printer dan komputer. Cancel all documents di print queue.', '[\"Stop Print Spooler service \\u2192 hapus file di PRINTERS folder \\u2192 restart Spooler. Atau restart printer dan komputer. Cancel all documents di print queue.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 33),
(300, 'PRK036', 'printer', 'Printer Default Berubah', 'Windows mengubah default printer secara otomatis atau default printer salah.', 'Software', 'Windows Settings → Devices → Printers → matikan \"Let Windows manage my default printer\". Set printer yang benar sebagai default.', '[\"Windows Settings \\u2192 Devices \\u2192 Printers \\u2192 matikan \\\"Let Windows manage my default printer\\\". Set printer yang benar sebagai default.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 33),
(301, 'PRK037', 'printer', 'Kompatibilitas Driver Setelah Update OS', 'Driver printer tidak kompatibel setelah update Windows/OS baru.', 'Software', 'Download driver terbaru yang mendukung OS baru. Gunakan Windows Update untuk mencari driver. Jika tidak ada driver baru, gunakan compatibility mode.', '[\"Download driver terbaru yang mendukung OS baru. Gunakan Windows Update untuk mencari driver. Jika tidak ada driver baru, gunakan compatibility mode.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 33),
(302, 'PRK038', 'printer', 'Belt/Timing Belt Rusak', 'Timing belt yang menggerakkan carriage/head rusak atau kendor sehingga head tidak bergerak dengan benar.', 'Mekanik', 'Ganti timing belt sesuai model printer. Pastikan belt terpasang dengan tegangan yang benar. Kalibrasi setelah penggantian.', '[\"Ganti timing belt sesuai model printer. Pastikan belt terpasang dengan tegangan yang benar. Kalibrasi setelah penggantian.\"]', '0.00', '0.00', 'Berat', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 34),
(303, 'PRK039', 'printer', 'Motor Printer Rusak', 'Motor stepper (carriage motor atau paper feed motor) rusak menyebabkan printer tidak bergerak atau bunyi abnormal.', 'Mekanik', 'Identifikasi motor yang rusak. Ganti motor sesuai part number. Cek kabel koneksi motor ke mainboard.', '[\"Identifikasi motor yang rusak. Ganti motor sesuai part number. Cek kabel koneksi motor ke mainboard.\"]', '0.00', '0.00', 'Berat', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 34),
(304, 'PRK040', 'printer', 'Gear/Roda Gigi Aus/Patah', 'Roda gigi plastik di mekanisme printer aus atau patah menyebabkan bunyi kasar atau kertas tidak tertarik.', 'Mekanik', 'Identifikasi gear yang rusak. Ganti dengan spare part yang sesuai. Lumasi gear plastic dengan grease yang tepat.', '[\"Identifikasi gear yang rusak. Ganti dengan spare part yang sesuai. Lumasi gear plastic dengan grease yang tepat.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 34),
(305, 'PRK041', 'printer', 'Encoder Strip Kotor/Rusak', 'Encoder strip (pita transparan bergaris) kotor atau rusak sehingga printer salah menghitung posisi head.', 'Mekanik', 'Bersihkan encoder strip dengan kain lembut dan sedikit isopropyl alcohol. Jangan menekuk strip. Ganti jika rusak/tergores parah.', '[\"Bersihkan encoder strip dengan kain lembut dan sedikit isopropyl alcohol. Jangan menekuk strip. Ganti jika rusak\\/tergores parah.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 34),
(306, 'PRK042', 'printer', 'Carriage/Head Unit Macet', 'Carriage (dudukan head) macet karena rel kotor, kering, atau ada hambatan.', 'Mekanik', 'Bersihkan guide rail/rel carriage. Lumasi dengan grease ringan. Periksa apakah ada kertas/benda asing yang menghalangi. Pastikan belt tidak kendor.', '[\"Bersihkan guide rail\\/rel carriage. Lumasi dengan grease ringan. Periksa apakah ada kertas\\/benda asing yang menghalangi. Pastikan belt tidak kendor.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 34),
(307, 'PRK043', 'printer', 'Purge/Capping Station Rusak', 'Purge unit atau capping station rusak sehingga proses cleaning head tidak berfungsi dan head cepat kering.', 'Mekanik', 'Bersihkan capping station dari tinta kering. Periksa pump unit. Ganti capping station assembly jika rusak. Pastikan wiper blade bersih.', '[\"Bersihkan capping station dari tinta kering. Periksa pump unit. Ganti capping station assembly jika rusak. Pastikan wiper blade bersih.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 34),
(308, 'PRK044', 'printer', 'Print Head Inkjet Rusak Permanen', 'Print head inkjet rusak secara permanen karena korosi, burnt nozzle, atau kerusakan elektrik.', 'Inkjet', 'Ganti print head sesuai model printer. Untuk printer yang head menyatu dengan cartridge, ganti cartridge. Untuk printer head terpisah, beli print head unit.', '[\"Ganti print head sesuai model printer. Untuk printer yang head menyatu dengan cartridge, ganti cartridge. Untuk printer head terpisah, beli print head unit.\"]', '0.00', '0.00', 'Berat', '2026-03-12 15:25:46', '2026-03-12 15:25:46', NULL, NULL),
(309, 'PRK045', 'printer', 'Sistem Infus Tinta (CISS) Error', 'Sistem continuous ink supply mengalami masalah: tinta tidak mengalir, ada gelembung, atau selang bocor.', 'Inkjet', 'Cek selang untuk gelembung/sumbatan. Prime selang dengan syringe. Pastikan ketinggian tank sesuai. Ganti selang jika bocor. Periksa air vent.', '[\"Cek selang untuk gelembung\\/sumbatan. Prime selang dengan syringe. Pastikan ketinggian tank sesuai. Ganti selang jika bocor. Periksa air vent.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-03-12 15:25:46', NULL, NULL),
(310, 'PRK046', 'printer', 'Cartridge Inkjet Tidak Kompatibel', 'Cartridge yang dipasang tidak kompatibel dengan model printer (salah tipe, region lock, dsb).', 'Inkjet', 'Cek compatibility list cartridge dengan model printer. Pastikan region cartridge sesuai. Coba firmware downgrade jika printer memblokir cartridge compatible.', '[\"Cek compatibility list cartridge dengan model printer. Pastikan region cartridge sesuai. Coba firmware downgrade jika printer memblokir cartridge compatible.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-03-12 15:25:46', NULL, NULL),
(311, 'PRK047', 'printer', 'Tinta Kering di Nozzle (Lama Tidak Pakai)', 'Nozzle print head tersumbat tinta kering karena printer terlalu lama tidak digunakan.', 'Inkjet', 'Jalankan head cleaning berulang (3-5 kali). Rendam head di cairan pembersih semalam. Power flush jika tersedia. Cetak minimal seminggu sekali untuk mencegah.', '[\"Jalankan head cleaning berulang (3-5 kali). Rendam head di cairan pembersih semalam. Power flush jika tersedia. Cetak minimal seminggu sekali untuk mencegah.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-03-12 15:25:46', NULL, NULL),
(312, 'PRK048', 'printer', 'Warna Cetakan Inkjet Tidak Akurat', 'Warna hasil cetak tidak sesuai dengan yang terlihat di layar karena profil warna salah atau tinta tercampur.', 'Inkjet', 'Kalibrasi warna via utility printer. Gunakan ICC profile yang sesuai. Pastikan tidak ada tinta yang tercampur di head. Lakukan nozzle check.', '[\"Kalibrasi warna via utility printer. Gunakan ICC profile yang sesuai. Pastikan tidak ada tinta yang tercampur di head. Lakukan nozzle check.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-03-12 15:25:46', NULL, NULL),
(313, 'PRK049', 'printer', 'Drum OPC Aus/Rusak (Laser)', 'Drum OPC sudah mencapai akhir masa pakai atau rusak, menyebabkan cetakan bergaris, ada titik berulang, atau background kotor.', 'Laser', 'Ganti drum unit. Jangan biarkan drum terpapar cahaya langsung. Ikuti counter reset prosedur setelah penggantian. Gunakan drum original untuk hasil terbaik.', '[\"Ganti drum unit. Jangan biarkan drum terpapar cahaya langsung. Ikuti counter reset prosedur setelah penggantian. Gunakan drum original untuk hasil terbaik.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-03-12 15:25:46', NULL, NULL),
(314, 'PRK050', 'printer', 'Fuser Assembly Rusak (Laser)', 'Fuser assembly tidak memanaskan toner dengan benar sehingga toner tidak menempel atau kertas kerut.', 'Laser', 'Ganti fuser assembly. Cek thermistor dan heater element. Ganti fuser film/sleeve jika robek. Periksa tegangan ke fuser dari power board.', '[\"Ganti fuser assembly. Cek thermistor dan heater element. Ganti fuser film\\/sleeve jika robek. Periksa tegangan ke fuser dari power board.\"]', '0.00', '0.00', 'Berat', '2026-03-12 15:25:46', '2026-03-12 15:25:46', NULL, NULL),
(315, 'PRK051', 'printer', 'Toner Bocor di Dalam Printer', 'Toner serbuk bocor dari cartridge ke dalam printer menyebabkan cetak kotor dan kontaminasi.', 'Laser', 'Keluarkan cartridge toner. Bersihkan toner yang bocor dengan vacuum cleaner khusus toner (JANGAN gunakan vacuum biasa). Ganti cartridge yang bocor.', '[\"Keluarkan cartridge toner. Bersihkan toner yang bocor dengan vacuum cleaner khusus toner (JANGAN gunakan vacuum biasa). Ganti cartridge yang bocor.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-03-12 15:25:46', NULL, NULL),
(316, 'PRK052', 'printer', 'Laser Scanner Unit (LSU) Error', 'Unit laser scanner (polygon mirror, laser diode) rusak sehingga cetakan hilang atau blank.', 'Laser', 'Bersihkan mirror dan lensa LSU. Ganti LSU assembly jika laser diode mati. Ini komponen mahal, pertimbangkan cost vs printer baru.', '[\"Bersihkan mirror dan lensa LSU. Ganti LSU assembly jika laser diode mati. Ini komponen mahal, pertimbangkan cost vs printer baru.\"]', '0.00', '0.00', 'Berat', '2026-03-12 15:25:46', '2026-03-12 15:25:46', NULL, NULL),
(317, 'PRK053', 'printer', 'Transfer Belt/Roller Rusak', 'Transfer belt atau roller yang memindahkan toner dari drum ke kertas rusak atau aus.', 'Laser', 'Ganti transfer belt atau transfer roller. Bersihkan area transfer dari kontaminasi toner. Reset counter setelah penggantian.', '[\"Ganti transfer belt atau transfer roller. Bersihkan area transfer dari kontaminasi toner. Reset counter setelah penggantian.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-03-12 15:25:46', NULL, NULL),
(318, 'PRK054', 'printer', 'Cartridge Toner Seal Belum Dilepas', 'Protective seal/tab pada cartridge toner baru belum dilepas sehingga toner tidak bisa keluar.', 'Laser', 'Keluarkan cartridge. Lepas pull tab/protective seal sesuai petunjuk. Kocok cartridge perlahan agar toner merata. Pasang kembali.', '[\"Keluarkan cartridge. Lepas pull tab\\/protective seal sesuai petunjuk. Kocok cartridge perlahan agar toner merata. Pasang kembali.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-03-12 15:25:46', NULL, NULL),
(319, 'PRK055', 'printer', 'Scanner Unit Tidak Berfungsi', 'Unit scanner pada printer MFP tidak bisa melakukan scan karena motor, lampu, atau sensor rusak.', 'Scanner', 'Update driver scanner. Cek apakah scanner lamp menyala. Periksa kabel flex scanner ke mainboard. Reinstall scanner driver/utility.', '[\"Update driver scanner. Cek apakah scanner lamp menyala. Periksa kabel flex scanner ke mainboard. Reinstall scanner driver\\/utility.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 35),
(320, 'PRK056', 'printer', 'Hasil Scan Bergaris/Kotor', 'Hasil scan memiliki garis atau noda karena kaca scanner kotor atau sensor CIS/CCD bermasalah.', 'Scanner', 'Bersihkan kaca scanner (platen glass) dengan glass cleaner. Bersihkan juga kaca kecil di jalur ADF. Jika masih bergaris, sensor scanner mungkin rusak.', '[\"Bersihkan kaca scanner (platen glass) dengan glass cleaner. Bersihkan juga kaca kecil di jalur ADF. Jika masih bergaris, sensor scanner mungkin rusak.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 35),
(321, 'PRK057', 'printer', 'ADF Scanner Macet', 'Auto Document Feeder pada scanner macet atau tidak mengambil kertas.', 'Scanner', 'Bersihkan roller ADF. Periksa separation pad penyekat kertas. Gunakan kertas yang tidak berlipat. Ganti roller ADF jika aus.', '[\"Bersihkan roller ADF. Periksa separation pad penyekat kertas. Gunakan kertas yang tidak berlipat. Ganti roller ADF jika aus.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 35),
(322, 'PRK058', 'printer', 'Scan to Email/Folder Gagal', 'Fitur scan ke email, folder jaringan, atau cloud gagal karena konfigurasi jaringan/server salah.', 'Scanner', 'Cek setting SMTP untuk scan to email. Pastikan path folder share benar dan ada permission. Update credential jika password berubah. Cek firewall.', '[\"Cek setting SMTP untuk scan to email. Pastikan path folder share benar dan ada permission. Update credential jika password berubah. Cek firewall.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 35),
(323, 'PRK059', 'printer', 'Lampu Scanner Redup/Mati', 'Lampu illuminasi scanner (LED/Cold Cathode) redup atau mati sehingga hasil scan gelap.', 'Scanner', 'Jika LED, mungkin perlu ganti scanner unit. Jika cold cathode lamp, bisa diganti. Ini biasanya tanda usia scanner sudah tua.', '[\"Jika LED, mungkin perlu ganti scanner unit. Jika cold cathode lamp, bisa diganti. Ini biasanya tanda usia scanner sudah tua.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 35),
(324, 'PRK060', 'printer', 'Penyebab Tinta/Toner (Consumable)', 'Masalah disebabkan oleh consumable (tinta/toner) yang perlu diganti atau salah jenis.', 'Differential', 'Ganti tinta/toner sesuai spesifikasi. Gunakan produk original untuk hasil terbaik. Periksa tanggal kadaluarsa consumable.', '[\"Ganti tinta\\/toner sesuai spesifikasi. Gunakan produk original untuk hasil terbaik. Periksa tanggal kadaluarsa consumable.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-03-12 15:25:46', NULL, NULL),
(325, 'PRK061', 'printer', 'Penyebab Mekanik (Part Aus)', 'Masalah disebabkan oleh komponen mekanik yang aus karena pemakaian normal.', 'Differential', 'Identifikasi part yang aus (roller, belt, gear, drum). Ganti dengan spare part yang sesuai. Lakukan maintenance preventif secara berkala.', '[\"Identifikasi part yang aus (roller, belt, gear, drum). Ganti dengan spare part yang sesuai. Lakukan maintenance preventif secara berkala.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-03-12 15:25:46', NULL, NULL),
(326, 'PRK062', 'printer', 'Penyebab Software/Driver', 'Masalah disebabkan oleh software, driver, atau konfigurasi yang salah.', 'Differential', 'Reinstall driver printer. Reset printer ke factory default. Update firmware. Perbaiki konfigurasi cetak.', '[\"Reinstall driver printer. Reset printer ke factory default. Update firmware. Perbaiki konfigurasi cetak.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-03-12 15:25:46', NULL, NULL),
(327, 'PRK063', 'printer', 'Penyebab Konektivitas', 'Masalah disebabkan oleh koneksi antara printer dan komputer/jaringan.', 'Differential', 'Coba koneksi alternatif (USB jika WiFi bermasalah, atau sebaliknya). Periksa kabel dan jaringan. Reset network setting printer.', '[\"Coba koneksi alternatif (USB jika WiFi bermasalah, atau sebaliknya). Periksa kabel dan jaringan. Reset network setting printer.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-03-12 15:25:46', NULL, NULL),
(328, 'PRK064', 'printer', 'Printer Perlu Service/Maintenance', 'Printer sudah waktunya untuk servis/maintenance berkala untuk menjaga performa optimal.', 'Differential', 'Bawa ke service center resmi. Bersihkan internal printer. Ganti part yang aus (roller, pad). Reset counter maintenance.', '[\"Bawa ke service center resmi. Bersihkan internal printer. Ganti part yang aus (roller, pad). Reset counter maintenance.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-03-12 15:25:46', NULL, NULL),
(329, 'PRK065', 'printer', 'Warna Tidak Seimbang (Color Balance)', 'Keseimbangan warna cetak tidak tepat, satu warna terlalu dominan atau kurang.', 'Kualitas Cetak', 'Lakukan color calibration dari utility printer. Cetak color test page. Periksa level tinta semua warna. Bersihkan nozzle/head warna yang bermasalah.', '[\"Lakukan color calibration dari utility printer. Cetak color test page. Periksa level tinta semua warna. Bersihkan nozzle\\/head warna yang bermasalah.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 28),
(330, 'PRK066', 'printer', 'Cetakan Hanya Hitam (Color Not Printing)', 'Printer hanya mencetak hitam putih meski setting sudah warna.', 'Kualitas Cetak', 'Cek setting printer: pastikan \"Color\" dipilih, bukan \"Grayscale\". Periksa cartridge warna. Jalankan head cleaning untuk warna. Cek apakah cartridge warna terdeteksi.', '[\"Cek setting printer: pastikan \\\"Color\\\" dipilih, bukan \\\"Grayscale\\\". Periksa cartridge warna. Jalankan head cleaning untuk warna. Cek apakah cartridge warna terdeteksi.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-04-01 06:24:59', 4, 28),
(331, 'PRK067', 'printer', 'Transfer Roller Kotor (Laser)', 'Transfer roller pada printer laser kotor menyebabkan cetak tidak merata atau ada bekas di belakang kertas.', 'Laser', 'Bersihkan transfer roller dengan kain lint-free. Ganti transfer roller jika sudah aus. Bersihkan area sekitar transfer dari kontaminasi toner.', '[\"Bersihkan transfer roller dengan kain lint-free. Ganti transfer roller jika sudah aus. Bersihkan area sekitar transfer dari kontaminasi toner.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-03-12 15:25:46', NULL, NULL),
(332, 'PRK068', 'printer', 'Charge Roller Kotor (Laser)', 'Primary Charge Roller (PCR) kotor atau aus menyebabkan background gelap atau banding di cetakan.', 'Laser', 'Bersihkan charge roller dengan kain lembut. Ganti charge roller jika sudah aus/rusak. Beberapa cartridge all-in-one sudah termasuk charge roller.', '[\"Bersihkan charge roller dengan kain lembut. Ganti charge roller jika sudah aus\\/rusak. Beberapa cartridge all-in-one sudah termasuk charge roller.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-03-12 15:25:46', NULL, NULL),
(333, 'PRK069', 'printer', 'Waste Toner Container Penuh', 'Wadah penampung waste toner sudah penuh dan printer menolak mencetak.', 'Laser', 'Kosongkan atau ganti waste toner container. Reset counter waste toner melalui service menu jika diperlukan.', '[\"Kosongkan atau ganti waste toner container. Reset counter waste toner melalui service menu jika diperlukan.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-03-12 15:25:46', NULL, NULL),
(334, 'PRK070', 'printer', 'Kualitas Fotocopy Buruk', 'Hasil fotocopy/copy buruk karena kombinasi masalah scanner dan printer.', 'Scanner', 'Bersihkan kaca scanner. Periksa kualitas cetak terpisah (test page). Jika test page ok, masalah di scanner. Jika test page juga buruk, periksa tinta/toner dan head.', '[\"Bersihkan kaca scanner. Periksa kualitas cetak terpisah (test page). Jika test page ok, masalah di scanner. Jika test page juga buruk, periksa tinta\\/toner dan head.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-04-01 06:25:00', 4, 35),
(335, 'PRK071', 'printer', 'Cetak Dari Mobile Device Gagal', 'Print dari smartphone/tablet gagal melalui AirPrint, Google Cloud Print, atau app vendor.', 'Konektivitas', 'Pastikan printer dan mobile device di WiFi yang sama. Install app printing vendor (HP Smart, Epson iPrint, dll). Restart printer dan device. Update firmware printer.', '[\"Pastikan printer dan mobile device di WiFi yang sama. Install app printing vendor (HP Smart, Epson iPrint, dll). Restart printer dan device. Update firmware printer.\"]', '0.00', '0.00', 'Ringan', '2026-03-12 15:25:46', '2026-04-01 06:25:00', 4, 31),
(336, 'PRK072', 'printer', 'Printer Bunyi Abnormal Keras', 'Printer mengeluarkan suara keras, grinding, atau abnormal saat operasi.', 'Mekanik', 'Identifikasi sumber suara (motor, gear, carriage, roller). Lumasi mekanisme yang kering. Ganti gear yang aus/patah. Periksa benda asing di dalam printer.', '[\"Identifikasi sumber suara (motor, gear, carriage, roller). Lumasi mekanisme yang kering. Ganti gear yang aus\\/patah. Periksa benda asing di dalam printer.\"]', '0.00', '0.00', 'Sedang', '2026-03-12 15:25:46', '2026-04-01 06:25:00', 4, 34);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_04_120402_create_permission_tables', 1),
(5, '2026_02_04_121712_add_additional_fields_to_users_table', 2),
(6, '2026_02_04_121715_create_customers_table', 2),
(7, '2026_02_04_121717_create_symptoms_table', 2),
(8, '2026_02_04_121719_create_diseases_table', 2),
(9, '2026_02_04_121721_create_rules_table', 2),
(10, '2026_02_04_121735_create_diagnosis_history_table', 2),
(11, '2026_02_04_121737_create_services_table', 2),
(12, '2026_02_04_121739_create_service_logs_table', 2),
(13, '2026_02_04_121741_create_spareparts_table', 2),
(14, '2026_02_04_121746_create_service_spareparts_table', 2),
(15, '2026_02_04_151107_change_price_column_in_spareparts_table', 3),
(16, '2026_02_04_151208_change_price_column_in_service_spareparts_table', 3),
(17, '2026_02_04_151357_change_cost_columns_in_services_table', 4),
(18, '2026_02_05_000001_create_settings_table', 5),
(19, '2026_02_05_154725_add_user_id_to_service_logs_table', 6),
(20, '2026_02_05_165031_create_bookings_table', 7),
(21, '2026_02_06_000001_update_expert_system_tables', 8),
(22, '2026_02_05_175423_add_columns_to_bookings_table', 9),
(23, '2026_02_06_100001_add_columns_to_bookings_table', 9),
(24, '2026_02_10_000001_add_question_type_options_to_category_questions', 10),
(25, '2026_02_21_000001_add_completed_at_to_services_table', 11),
(26, '2026_02_21_000002_create_brands_table', 12),
(27, '2026_02_21_000003_add_adp_fields_to_services_table', 12),
(28, '2026_03_02_000001_add_device_type_to_expert_system_tables', 13),
(29, '2026_03_12_225949_add_recommendation_to_services_table', 14),
(30, '2026_04_01_111514_create_device_types_table', 15),
(31, '2026_04_01_111516_create_device_components_table', 16),
(32, '2026_04_01_111516_create_service_categories_table', 16),
(33, '2026_04_01_111516_update_expert_system_tables_for_dynamic_data', 16),
(34, '2026_04_01_125535_add_json_data_to_device_components_table', 17),
(35, '2026_04_01_125557_add_json_data_to_service_categories_table', 17),
(36, '2026_04_14_124405_add_service_cost_to_services_table', 18),
(37, '2026_04_14_131337_add_service_items_to_services_table', 19);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE `rules` (
  `id` bigint UNSIGNED NOT NULL,
  `disease_id` bigint UNSIGNED NOT NULL,
  `symptom_id` bigint UNSIGNED NOT NULL,
  `cf_value` decimal(3,2) NOT NULL DEFAULT '1.00',
  `priority` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`id`, `disease_id`, `symptom_id`, `cf_value`, `priority`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '0.95', 1, '2026-03-12 15:25:38', '2026-03-12 15:25:38'),
(2, 1, 7, '0.90', 2, '2026-03-12 15:25:38', '2026-03-12 15:25:38'),
(3, 1, 2, '0.70', 1, '2026-03-12 15:25:38', '2026-03-12 15:25:38'),
(4, 1, 4, '0.85', 1, '2026-03-12 15:25:38', '2026-03-12 15:25:38'),
(5, 1, 14, '0.90', 1, '2026-03-12 15:25:38', '2026-03-12 15:25:38'),
(6, 2, 3, '0.95', 1, '2026-03-12 15:25:38', '2026-03-12 15:25:38'),
(7, 2, 8, '0.80', 2, '2026-03-12 15:25:38', '2026-03-12 15:25:38'),
(8, 2, 7, '0.95', 3, '2026-03-12 15:25:38', '2026-03-12 15:25:38'),
(9, 2, 1, '0.85', 1, '2026-03-12 15:25:38', '2026-03-12 15:25:38'),
(10, 2, 20, '0.80', 1, '2026-03-12 15:25:38', '2026-03-12 15:25:38'),
(11, 3, 4, '0.80', 1, '2026-03-12 15:25:38', '2026-03-12 15:25:38'),
(12, 3, 7, '0.90', 2, '2026-03-12 15:25:38', '2026-03-12 15:25:38'),
(13, 3, 20, '0.85', 2, '2026-03-12 15:25:38', '2026-03-12 15:25:38'),
(14, 3, 1, '0.80', 2, '2026-03-12 15:25:38', '2026-03-12 15:25:38'),
(15, 4, 2, '0.90', 2, '2026-03-12 15:25:38', '2026-03-12 15:25:38'),
(16, 4, 6, '0.90', 3, '2026-03-12 15:25:38', '2026-03-12 15:25:38'),
(17, 4, 1, '0.85', 1, '2026-03-12 15:25:38', '2026-03-12 15:25:38'),
(18, 4, 101, '0.85', 2, '2026-03-12 15:25:38', '2026-03-12 15:25:38'),
(19, 4, 11, '0.90', 1, '2026-03-12 15:25:38', '2026-03-12 15:25:38'),
(20, 4, 19, '0.75', 2, '2026-03-12 15:25:38', '2026-03-12 15:25:38'),
(21, 5, 5, '1.00', 1, '2026-03-12 15:25:38', '2026-03-12 15:25:38'),
(22, 5, 2, '1.00', 2, '2026-03-12 15:25:38', '2026-03-12 15:25:38'),
(23, 5, 1, '1.00', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(24, 6, 10, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(25, 6, 18, '0.80', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(26, 6, 6, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(27, 7, 15, '0.90', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(28, 7, 16, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(29, 7, 5, '0.90', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(30, 7, 3, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(31, 8, 9, '0.80', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(32, 8, 4, '0.90', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(33, 8, 10, '0.80', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(34, 9, 14, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(35, 9, 2, '0.80', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(36, 9, 13, '0.80', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(37, 9, 6, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(38, 10, 12, '0.80', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(39, 10, 6, '0.70', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(40, 10, 4, '0.80', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(41, 10, 17, '0.75', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(42, 10, 19, '0.70', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(43, 11, 21, '0.95', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(44, 11, 25, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(45, 11, 22, '0.70', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(46, 11, 30, '0.90', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(47, 11, 32, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(48, 12, 21, '0.80', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(49, 12, 24, '0.80', 3, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(50, 12, 25, '0.80', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(51, 13, 23, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(52, 13, 29, '0.90', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(53, 13, 21, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(54, 13, 32, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(55, 14, 28, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(56, 14, 22, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(57, 14, 34, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(58, 15, 26, '0.80', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(59, 15, 24, '0.75', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(60, 15, 29, '0.75', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(61, 15, 22, '0.80', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(62, 16, 27, '0.70', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(63, 16, 33, '0.80', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(64, 16, 21, '0.70', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(65, 17, 35, '0.75', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(66, 17, 25, '0.90', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(67, 17, 33, '0.70', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(68, 17, 31, '0.75', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(69, 18, 22, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(70, 18, 29, '0.75', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(71, 18, 30, '0.80', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(72, 18, 24, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(73, 18, 25, '0.85', 3, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(74, 19, 36, '0.70', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(75, 19, 51, '0.95', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(76, 19, 44, '0.95', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(77, 20, 37, '0.60', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(78, 20, 47, '0.75', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(79, 20, 38, '0.75', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(80, 20, 43, '0.80', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(81, 20, 49, '0.70', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(82, 20, 46, '0.65', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(83, 21, 40, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(84, 21, 50, '0.90', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(85, 21, 37, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(86, 22, 39, '0.90', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(87, 22, 45, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(88, 22, 51, '0.90', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(89, 23, 42, '0.80', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(90, 23, 45, '0.80', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(91, 24, 48, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(92, 24, 38, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(93, 25, 41, '0.80', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(94, 25, 38, '0.60', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(95, 25, 47, '0.80', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(96, 25, 46, '0.75', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(97, 25, 36, '0.75', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(98, 26, 36, '0.90', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(99, 26, 51, '0.90', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(100, 26, 44, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(101, 26, 43, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(102, 27, 52, '0.90', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(103, 27, 58, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(104, 27, 74, '0.80', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(105, 27, 70, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(106, 28, 54, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(107, 28, 72, '0.80', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(108, 28, 55, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(109, 29, 56, '0.90', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(110, 29, 64, '0.90', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(111, 30, 53, '0.90', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(112, 30, 59, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(113, 30, 76, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(114, 31, 69, '0.90', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(115, 31, 70, '0.90', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(116, 32, 66, '0.95', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(117, 32, 67, '0.95', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(118, 33, 62, '0.80', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(119, 34, 68, '0.80', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(120, 35, 55, '0.80', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(121, 35, 71, '0.80', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(122, 35, 75, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(123, 36, 65, '0.80', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(124, 36, 73, '0.80', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(125, 36, 63, '0.60', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(126, 37, 57, '0.90', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(127, 37, 81, '0.90', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(128, 38, 61, '0.90', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(129, 38, 52, '0.90', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(130, 38, 69, '0.90', 3, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(131, 38, 70, '0.90', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(132, 39, 77, '0.95', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(133, 39, 84, '0.95', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(134, 39, 88, '0.95', 3, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(135, 39, 90, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(136, 40, 78, '0.95', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(137, 40, 80, '0.90', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(138, 40, 79, '0.95', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(139, 40, 93, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(140, 40, 95, '0.80', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(141, 40, 87, '0.90', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(142, 40, 86, '0.75', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(143, 41, 81, '0.90', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(144, 41, 84, '0.90', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(145, 41, 57, '0.80', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(146, 41, 94, '0.90', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(147, 42, 79, '0.70', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(148, 42, 82, '0.80', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(149, 42, 84, '0.80', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(150, 42, 98, '0.80', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(151, 43, 81, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(152, 43, 91, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(153, 43, 96, '0.70', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(154, 44, 85, '0.95', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(155, 44, 92, '1.00', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(156, 44, 80, '0.95', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(157, 45, 97, '0.80', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(158, 45, 88, '0.80', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(159, 46, 90, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(160, 46, 88, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(161, 46, 83, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(162, 47, 86, '0.80', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(163, 47, 78, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(164, 47, 79, '0.80', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(165, 48, 98, '0.80', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(166, 48, 91, '0.80', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(167, 49, 104, '0.90', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(168, 49, 102, '0.90', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(169, 49, 101, '0.70', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(170, 49, 103, '0.70', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(171, 49, 113, '0.90', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(172, 49, 118, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(173, 49, 110, '0.70', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(174, 50, 107, '0.80', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(175, 50, 106, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(176, 50, 103, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(177, 50, 101, '0.80', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(178, 51, 111, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(179, 51, 99, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(180, 51, 100, '0.90', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(181, 51, 105, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(182, 52, 102, '0.95', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(183, 52, 104, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(184, 52, 109, '0.95', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(185, 52, 117, '0.70', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(186, 53, 112, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(187, 53, 103, '0.80', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(188, 53, 101, '0.80', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(189, 53, 99, '0.75', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(190, 53, 104, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(191, 54, 116, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(192, 54, 106, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(193, 54, 103, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(194, 55, 117, '0.70', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(195, 55, 109, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(196, 56, 99, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(197, 56, 105, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(198, 56, 111, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(199, 56, 113, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(200, 57, 108, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(201, 57, 89, '0.90', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(202, 57, 117, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(203, 58, 114, '0.95', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(204, 58, 107, '0.95', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(205, 59, 120, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(206, 59, 122, '0.75', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(207, 59, 119, '0.80', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(208, 59, 124, '0.75', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(209, 59, 99, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(210, 60, 123, '0.75', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(211, 60, 101, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(212, 60, 130, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(213, 60, 119, '0.80', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(214, 60, 112, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(215, 60, 132, '0.75', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(216, 61, 128, '0.90', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(217, 61, 121, '0.85', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(218, 61, 125, '0.85', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(219, 61, 134, '0.90', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(220, 62, 133, '0.65', 1, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(221, 62, 119, '0.75', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(222, 62, 123, '0.80', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(223, 62, 121, '0.80', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:39'),
(224, 63, 126, '0.80', 2, '2026-03-12 15:25:39', '2026-03-12 15:25:40'),
(225, 63, 128, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(226, 63, 125, '0.80', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(227, 63, 129, '0.80', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(228, 64, 122, '0.70', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(229, 64, 124, '0.60', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(230, 64, 120, '0.70', 3, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(231, 64, 119, '0.60', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(232, 65, 123, '0.80', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(233, 65, 130, '0.80', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(234, 65, 132, '0.70', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(235, 65, 119, '0.70', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(236, 66, 134, '0.65', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(237, 66, 120, '0.75', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(238, 66, 127, '0.75', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(239, 67, 136, '0.95', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(240, 67, 137, '0.95', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(241, 67, 145, '0.80', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(242, 67, 135, '0.90', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(243, 67, 138, '0.95', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(244, 68, 140, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(245, 68, 135, '0.80', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(246, 68, 139, '0.90', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(247, 68, 144, '0.80', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(248, 69, 143, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(249, 69, 135, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(250, 69, 142, '0.90', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(251, 70, 141, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(252, 70, 135, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(253, 70, 137, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(254, 70, 138, '0.85', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(255, 71, 148, '0.95', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(256, 71, 135, '0.95', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(257, 72, 139, '0.75', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(258, 72, 135, '0.70', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(259, 72, 145, '0.75', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(260, 73, 146, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(261, 73, 135, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(262, 73, 142, '0.90', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(263, 74, 149, '0.90', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(264, 74, 150, '0.80', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(265, 74, 153, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(266, 74, 166, '0.75', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(267, 75, 161, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(268, 75, 149, '0.90', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(269, 75, 158, '0.90', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(270, 75, 156, '0.85', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(271, 76, 151, '0.95', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(272, 76, 163, '0.95', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(273, 77, 157, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(274, 77, 153, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(275, 77, 149, '0.85', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(276, 78, 158, '0.80', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(277, 78, 155, '0.70', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(278, 78, 149, '0.80', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(279, 78, 159, '0.70', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(280, 79, 152, '0.80', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(281, 79, 164, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(282, 79, 160, '0.80', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(283, 80, 165, '0.80', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(284, 80, 154, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(285, 80, 156, '0.65', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(286, 81, 154, '0.85', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(287, 81, 166, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(288, 81, 150, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(289, 82, 168, '0.95', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(290, 82, 167, '0.70', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(291, 82, 169, '0.95', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(292, 82, 179, '0.95', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(293, 83, 174, '0.95', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(294, 83, 171, '0.95', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(295, 83, 170, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(296, 83, 172, '0.85', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(297, 84, 173, '0.85', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(298, 84, 169, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(299, 84, 177, '0.90', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(300, 84, 170, '0.80', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(301, 85, 178, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(302, 85, 167, '0.85', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(303, 86, 174, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(304, 86, 172, '0.85', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(305, 86, 171, '0.90', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(306, 86, 181, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(307, 87, 176, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(308, 87, 169, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(309, 87, 179, '0.90', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(310, 88, 180, '0.85', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(311, 88, 170, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(312, 88, 181, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(313, 89, 167, '0.80', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(314, 89, 172, '0.80', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(315, 89, 178, '0.80', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(316, 84, 182, '0.80', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(317, 90, 184, '0.95', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(318, 90, 186, '0.90', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(319, 90, 185, '0.95', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(320, 90, 197, '0.95', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(321, 91, 183, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(322, 91, 187, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(323, 91, 199, '0.85', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(324, 91, 193, '0.70', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(325, 92, 192, '0.85', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(326, 92, 185, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(327, 93, 189, '0.90', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(328, 93, 194, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(329, 94, 190, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(330, 94, 187, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(331, 94, 198, '0.85', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(332, 95, 197, '0.90', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(333, 95, 183, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(334, 95, 184, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(335, 96, 191, '0.90', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(336, 96, 184, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(337, 97, 195, '0.70', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(338, 97, 200, '0.60', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(339, 98, 201, '0.90', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(340, 98, 205, '0.95', 3, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(341, 98, 215, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(342, 98, 208, '0.95', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(343, 99, 203, '0.90', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(344, 99, 201, '0.90', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(345, 99, 213, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(346, 99, 88, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(347, 100, 202, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(348, 100, 201, '0.85', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(349, 100, 206, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(350, 101, 204, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(351, 101, 201, '0.90', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(352, 101, 216, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(353, 102, 207, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(354, 102, 201, '0.90', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(355, 102, 209, '0.85', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(356, 103, 214, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(357, 103, 201, '0.80', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(358, 103, 149, '0.80', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(359, 104, 219, '0.90', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(360, 104, 217, '0.90', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(361, 104, 224, '0.90', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(362, 104, 228, '0.75', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(363, 104, 227, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(364, 105, 77, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(365, 105, 88, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(366, 105, 97, '0.90', 3, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(367, 105, 218, '0.90', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(368, 105, 223, '0.95', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(369, 105, 226, '0.90', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(370, 106, 230, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(371, 106, 221, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(372, 106, 227, '0.80', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(373, 106, 99, '0.80', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(374, 107, 220, '0.85', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(375, 107, 225, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(376, 107, 120, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(377, 108, 222, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(378, 108, 226, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(379, 108, 108, '0.85', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(380, 109, 229, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(381, 109, 227, '0.90', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(382, 109, 90, '0.85', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(383, 109, 223, '0.90', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(384, 110, 221, '0.65', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(385, 110, 230, '0.80', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(386, 110, 217, '0.80', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(387, 111, 219, '0.85', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(388, 111, 126, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(389, 111, 224, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(390, 111, 228, '0.85', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(391, 112, 223, '0.80', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(392, 112, 83, '0.80', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(393, 113, 229, '0.80', 1, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(394, 113, 83, '0.80', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(395, 113, 221, '0.80', 2, '2026-03-12 15:25:40', '2026-03-12 15:25:40'),
(396, 114, 251, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(397, 114, 254, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(398, 114, 255, '0.90', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(399, 119, 255, '1.00', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(400, 119, 264, '0.95', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(401, 117, 254, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(402, 117, 256, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(403, 117, 262, '0.80', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(404, 117, 252, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(405, 115, 258, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(406, 115, 265, '0.80', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(407, 115, 270, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(408, 115, 252, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(409, 116, 259, '0.90', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(410, 116, 260, '0.90', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(411, 116, 261, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(412, 116, 257, '0.90', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(413, 118, 251, '0.80', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(414, 118, 268, '0.80', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(415, 118, 253, '0.75', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(416, 118, 262, '0.75', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(417, 120, 267, '0.90', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(418, 120, 258, '0.90', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(419, 119, 263, '0.75', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(420, 117, 269, '0.80', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(421, 115, 268, '0.80', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(422, 114, 257, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(423, 121, 271, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(424, 121, 278, '0.95', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(425, 121, 279, '0.90', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(426, 123, 279, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(427, 123, 277, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(428, 122, 274, '0.90', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(429, 122, 280, '0.90', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(430, 124, 284, '0.90', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(431, 124, 271, '0.80', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(432, 124, 273, '0.80', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(433, 121, 272, '0.80', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(434, 127, 275, '0.80', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(435, 127, 281, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(436, 127, 271, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(437, 125, 276, '0.80', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(438, 125, 282, '0.80', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(439, 125, 283, '0.80', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(440, 126, 287, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(441, 126, 277, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(442, 125, 289, '0.75', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(443, 127, 286, '0.80', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(444, 124, 290, '0.80', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(445, 123, 285, '0.75', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(446, 121, 290, '0.75', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(447, 121, 273, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(448, 128, 291, '0.90', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(449, 128, 298, '0.90', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(450, 128, 302, '0.90', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(451, 129, 291, '0.90', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(452, 129, 299, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(453, 129, 300, '0.90', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(454, 134, 299, '0.90', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(455, 134, 306, '0.90', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(456, 130, 291, '0.95', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(457, 130, 292, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(458, 130, 293, '0.90', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(459, 130, 303, '0.90', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(460, 130, 309, '0.90', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(461, 130, 300, '0.95', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(462, 131, 294, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(463, 131, 271, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(464, 131, 293, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(465, 131, 308, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(466, 132, 301, '0.95', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(467, 132, 294, '0.95', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(468, 133, 297, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(469, 133, 293, '0.80', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(470, 133, 304, '0.80', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(471, 130, 310, '0.80', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(472, 129, 302, '0.90', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(473, 131, 309, '0.75', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(474, 130, 295, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(475, 135, 311, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(476, 135, 322, '0.90', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(477, 135, 323, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(478, 136, 315, '0.90', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(479, 136, 312, '0.75', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(480, 136, 314, '0.70', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(481, 136, 319, '0.90', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(482, 137, 318, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(483, 137, 328, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(484, 138, 321, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(485, 138, 311, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(486, 139, 316, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(487, 139, 320, '0.80', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(488, 140, 325, '0.80', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(489, 140, 324, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(490, 140, 312, '0.80', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(491, 140, 317, '0.75', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(492, 140, 313, '0.80', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(493, 136, 323, '0.80', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(494, 135, 328, '0.75', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(495, 140, 311, '0.80', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(496, 136, 326, '0.70', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(497, 138, 313, '0.65', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(498, 141, 329, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(499, 141, 330, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(500, 141, 331, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(501, 145, 336, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(502, 145, 330, '0.90', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(503, 145, 342, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(504, 145, 348, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(505, 142, 335, '0.80', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(506, 142, 334, '0.80', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(507, 142, 346, '0.80', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(508, 143, 332, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(509, 143, 333, '0.95', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(510, 143, 338, '0.90', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(511, 144, 333, '0.90', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(512, 144, 347, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(513, 144, 331, '0.90', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(514, 146, 329, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(515, 146, 337, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(516, 146, 339, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(517, 146, 344, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(518, 147, 334, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(519, 147, 341, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(520, 147, 331, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(521, 142, 345, '0.75', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(522, 143, 340, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(523, 141, 343, '0.50', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(524, 148, 350, '0.90', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(525, 148, 352, '0.95', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(526, 148, 353, '0.95', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(527, 148, 364, '0.90', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(528, 148, 367, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(529, 149, 358, '0.80', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(530, 149, 352, '0.90', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(531, 149, 365, '0.80', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(532, 150, 353, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(533, 150, 368, '0.90', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(534, 150, 354, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(535, 151, 349, '0.90', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(536, 151, 361, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(537, 151, 359, '0.75', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(538, 151, 363, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(539, 152, 357, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(540, 152, 351, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(541, 152, 349, '0.80', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(542, 152, 364, '0.80', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(543, 153, 355, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(544, 153, 349, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(545, 154, 365, '0.90', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(546, 154, 360, '0.90', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(547, 151, 356, '0.75', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(548, 149, 366, '0.70', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(549, 148, 362, '0.80', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(550, 155, 369, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(551, 155, 375, '0.80', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(552, 155, 373, '0.80', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(553, 156, 369, '0.75', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(554, 156, 373, '0.75', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(555, 156, 370, '0.75', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(556, 157, 371, '0.75', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(557, 157, 381, '0.80', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(558, 158, 377, '0.80', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(559, 158, 291, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(560, 158, 379, '0.80', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(561, 159, 383, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(562, 157, 372, '0.75', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(563, 155, 374, '0.65', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(564, 155, 380, '0.75', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(565, 158, 376, '0.60', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(566, 160, 388, '0.90', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(567, 160, 384, '0.90', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(568, 160, 387, '0.90', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(569, 161, 385, '0.90', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(570, 161, 384, '0.90', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(571, 161, 386, '0.80', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(572, 161, 387, '0.90', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(573, 162, 390, '0.95', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(574, 162, 397, '0.95', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(575, 163, 391, '1.00', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(576, 163, 384, '1.00', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(577, 164, 395, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(578, 164, 384, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(579, 165, 393, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(580, 165, 396, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(581, 166, 392, '0.90', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(582, 166, 397, '0.90', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(583, 161, 394, '0.75', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(584, 160, 386, '0.70', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(585, 167, 401, '0.80', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(586, 167, 406, '0.90', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(587, 167, 399, '0.80', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(588, 168, 401, '0.80', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(589, 168, 407, '0.80', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(590, 168, 405, '0.70', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:43'),
(591, 169, 402, '0.80', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(592, 170, 403, '0.80', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(593, 169, 403, '0.75', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(594, 171, 407, '0.80', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(595, 171, 400, '0.80', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(596, 172, 408, '0.85', 2, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(597, 172, 400, '0.85', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(598, 167, 400, '0.65', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(599, 167, 404, '0.70', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(600, 167, 409, '0.70', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(601, 169, 399, '0.80', 1, '2026-03-12 15:25:42', '2026-03-12 15:25:42'),
(602, 167, 411, '0.65', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(603, 167, 410, '0.65', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(604, 173, 414, '0.80', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(605, 173, 416, '0.80', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(606, 173, 415, '0.85', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(607, 173, 423, '0.80', 2, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(608, 175, 414, '0.85', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(609, 175, 417, '0.80', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(610, 174, 414, '0.80', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(611, 174, 425, '0.85', 2, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(612, 176, 415, '0.80', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(613, 176, 421, '0.80', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(614, 177, 420, '0.80', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(615, 177, 419, '0.70', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(616, 177, 424, '0.70', 2, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(617, 178, 418, '0.65', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(618, 178, 419, '0.65', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(619, 176, 426, '0.80', 2, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(620, 173, 422, '0.65', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(621, 174, 417, '0.80', 2, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(622, 179, 428, '0.70', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(623, 179, 433, '0.75', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(624, 179, 434, '0.70', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(625, 179, 432, '0.70', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(626, 180, 429, '0.80', 2, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(627, 180, 441, '0.85', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(628, 181, 428, '0.65', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(629, 182, 428, '0.80', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(630, 182, 433, '0.75', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(631, 182, 442, '0.80', 2, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(632, 183, 440, '0.75', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(633, 183, 432, '0.65', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(634, 184, 430, '0.65', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(635, 184, 431, '0.65', 2, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(636, 184, 437, '0.65', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(637, 182, 435, '0.70', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(638, 181, 436, '0.70', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(639, 182, 434, '0.75', 2, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(640, 185, 446, '0.85', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(641, 185, 453, '0.85', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(642, 185, 451, '0.85', 2, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(643, 185, 443, '0.70', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(644, 185, 452, '0.85', 2, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(645, 186, 445, '0.85', 2, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(646, 186, 457, '0.85', 2, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(647, 186, 444, '0.85', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(648, 186, 443, '0.85', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(649, 187, 450, '0.85', 2, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(650, 187, 443, '0.85', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(651, 188, 447, '0.80', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(652, 188, 448, '0.80', 2, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(653, 188, 444, '0.80', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(654, 189, 454, '0.90', 2, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(655, 189, 446, '0.90', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(656, 190, 455, '0.85', 2, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(657, 190, 446, '0.85', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(658, 185, 459, '0.85', 2, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(659, 191, 461, '0.80', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(660, 196, 461, '0.90', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(661, 196, 468, '0.85', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(662, 192, 462, '0.85', 2, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(663, 192, 467, '0.85', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(664, 192, 461, '0.85', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(665, 193, 463, '0.90', 2, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(666, 193, 330, '0.90', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(667, 194, 466, '0.90', 2, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(668, 194, 461, '0.90', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(669, 195, 469, '0.90', 2, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(670, 195, 461, '0.90', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(671, 196, 292, '0.90', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(672, 196, 471, '0.85', 2, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(673, 191, 465, '0.75', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(674, 195, 475, '0.85', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(675, 191, 474, '0.80', 2, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(676, 192, 473, '0.80', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(677, 191, 470, '0.70', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(678, 194, 472, '0.75', 1, '2026-03-12 15:25:43', '2026-03-12 15:25:43'),
(679, 197, 506, '0.65', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(680, 197, 507, '0.85', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(681, 197, 511, '0.90', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(682, 197, 512, '0.90', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(683, 198, 513, '0.90', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(684, 198, 510, '0.85', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(685, 198, 507, '0.90', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(686, 199, 514, '0.80', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(687, 199, 510, '0.90', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(688, 199, 507, '0.85', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(689, 199, 517, '0.80', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(690, 200, 516, '0.85', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(691, 200, 515, '0.70', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(692, 200, 507, '0.85', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(693, 201, 506, '0.75', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(694, 201, 508, '0.75', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(695, 201, 509, '0.65', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(696, 201, 520, '0.80', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(697, 201, 510, '0.80', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(698, 202, 519, '0.85', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(699, 202, 508, '0.85', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(700, 197, 517, '0.65', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(701, 205, 521, '0.90', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(702, 205, 530, '0.85', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44');
INSERT INTO `rules` (`id`, `disease_id`, `symptom_id`, `cf_value`, `priority`, `created_at`, `updated_at`) VALUES
(703, 205, 523, '0.80', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(704, 204, 521, '0.65', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(705, 204, 531, '0.85', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(706, 204, 524, '0.70', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(707, 203, 522, '0.90', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(708, 203, 529, '0.90', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(709, 203, 527, '0.70', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(710, 203, 528, '0.75', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(711, 207, 525, '1.00', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(712, 208, 532, '0.80', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(713, 208, 522, '0.80', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(714, 208, 533, '0.75', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(715, 208, 526, '0.75', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(716, 206, 535, '0.80', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(717, 206, 529, '0.80', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(718, 203, 534, '0.75', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(719, 205, 527, '0.80', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(720, 208, 521, '0.75', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(721, 203, 535, '0.70', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(722, 209, 536, '0.85', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(723, 209, 541, '0.85', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(724, 209, 538, '0.85', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(725, 209, 543, '0.80', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(726, 211, 544, '0.85', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(727, 209, 544, '0.85', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(728, 210, 541, '0.90', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(729, 210, 542, '0.90', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(730, 210, 540, '0.70', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(731, 210, 546, '0.70', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(732, 212, 539, '0.90', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(733, 212, 545, '0.90', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(734, 209, 537, '0.85', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(735, 211, 543, '0.80', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(736, 213, 525, '0.90', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(737, 213, 536, '0.90', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(738, 210, 547, '0.60', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(739, 211, 536, '0.80', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(740, 214, 548, '0.85', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(741, 214, 552, '0.90', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(742, 214, 554, '0.90', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(743, 215, 549, '0.80', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(744, 215, 553, '0.90', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(745, 215, 562, '0.80', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(746, 216, 554, '0.85', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(747, 216, 560, '0.70', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(748, 216, 551, '0.70', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(749, 217, 558, '0.80', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(750, 217, 548, '0.80', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(751, 217, 562, '0.80', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(752, 218, 555, '0.80', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(753, 218, 556, '0.80', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(754, 218, 557, '0.80', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(755, 218, 550, '0.80', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(756, 214, 559, '0.85', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(757, 214, 561, '0.75', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(758, 218, 553, '0.80', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(759, 219, 570, '0.90', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(760, 219, 563, '0.65', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:45'),
(761, 219, 568, '0.90', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(762, 220, 569, '0.90', 2, '2026-03-12 15:25:44', '2026-03-12 15:25:45'),
(763, 220, 563, '0.95', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(764, 223, 563, '0.90', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(765, 223, 571, '0.85', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:44'),
(766, 221, 563, '0.85', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:45'),
(767, 221, 564, '0.75', 1, '2026-03-12 15:25:44', '2026-03-12 15:25:45'),
(768, 221, 565, '0.90', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(769, 221, 572, '0.90', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(770, 221, 569, '0.90', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(771, 222, 566, '0.85', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(772, 222, 548, '0.85', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(773, 221, 567, '0.65', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(774, 220, 568, '0.90', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(775, 219, 572, '0.70', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(776, 221, 573, '0.75', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(777, 221, 571, '0.85', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(778, 224, 574, '0.85', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(779, 224, 583, '0.85', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(780, 224, 585, '0.85', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(781, 225, 578, '0.90', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(782, 225, 575, '0.75', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(783, 225, 577, '0.70', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(784, 225, 584, '0.90', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(785, 226, 581, '0.90', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(786, 226, 574, '0.90', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(787, 227, 582, '0.75', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(788, 227, 574, '0.85', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(789, 228, 580, '0.80', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(790, 228, 579, '0.80', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(791, 228, 574, '0.85', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(792, 228, 576, '0.80', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(793, 225, 585, '0.80', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(794, 227, 576, '0.75', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(795, 229, 587, '0.90', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(796, 229, 589, '0.95', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(797, 229, 590, '0.95', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(798, 229, 597, '0.90', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(799, 229, 586, '0.90', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(800, 230, 594, '0.90', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(801, 230, 589, '0.90', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(802, 230, 592, '0.80', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(803, 231, 590, '0.80', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(804, 231, 597, '0.90', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(805, 231, 591, '0.80', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(806, 232, 586, '0.65', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(807, 232, 596, '0.90', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(808, 232, 595, '0.75', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(809, 232, 592, '0.85', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(810, 233, 593, '0.85', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(811, 233, 588, '0.70', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(812, 233, 597, '0.70', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(813, 234, 604, '0.80', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(814, 234, 598, '0.90', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(815, 234, 601, '0.90', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(816, 234, 602, '0.85', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(817, 238, 609, '0.85', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(818, 238, 598, '0.85', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(819, 235, 605, '0.85', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(820, 235, 602, '0.80', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(821, 235, 603, '0.90', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(822, 235, 610, '0.85', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(823, 236, 600, '0.90', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(824, 236, 598, '0.95', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(825, 236, 601, '0.95', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(826, 236, 607, '0.85', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(827, 237, 606, '0.85', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(828, 237, 602, '0.90', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(829, 237, 608, '0.85', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(830, 234, 599, '0.80', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(831, 235, 601, '0.80', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(832, 236, 603, '0.90', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(833, 239, 616, '0.75', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(834, 239, 618, '0.90', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(835, 239, 611, '0.80', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(836, 239, 620, '0.75', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(837, 240, 611, '0.80', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(838, 240, 617, '0.80', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(839, 240, 612, '0.75', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(840, 243, 613, '0.70', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(841, 243, 621, '0.80', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(842, 241, 616, '0.75', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(843, 241, 617, '0.85', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(844, 241, 620, '0.85', 3, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(845, 242, 614, '0.85', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(846, 242, 611, '0.85', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(847, 244, 615, '0.80', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(848, 239, 619, '0.65', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(849, 240, 613, '0.75', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(850, 241, 615, '0.75', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(851, 246, 622, '0.90', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(852, 246, 630, '0.90', 3, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(853, 247, 626, '0.80', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(854, 247, 630, '0.85', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(855, 246, 625, '0.90', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(856, 245, 627, '0.80', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(857, 245, 633, '0.80', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(858, 245, 622, '0.80', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(859, 245, 625, '0.80', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(860, 248, 624, '0.80', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(861, 248, 632, '0.80', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(862, 249, 628, '0.70', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(863, 247, 623, '0.80', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(864, 248, 627, '0.80', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(865, 247, 631, '0.85', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(866, 245, 629, '0.65', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(867, 245, 624, '0.80', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(868, 251, 634, '0.80', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(869, 251, 635, '0.85', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(870, 250, 635, '0.80', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(871, 251, 639, '0.80', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(872, 251, 637, '0.85', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(873, 253, 634, '0.80', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(874, 253, 638, '0.80', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(875, 253, 640, '0.85', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(876, 253, 641, '0.80', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(877, 251, 636, '0.70', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(878, 250, 643, '0.65', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(879, 252, 634, '0.80', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(880, 252, 642, '0.80', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(881, 252, 637, '0.75', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(882, 252, 639, '0.75', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(883, 250, 639, '0.80', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(884, 254, 644, '0.70', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(885, 254, 651, '0.75', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(886, 254, 652, '0.70', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(887, 255, 644, '0.80', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(888, 255, 645, '0.75', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(889, 256, 644, '0.85', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(890, 256, 651, '0.85', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(891, 256, 652, '0.75', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(892, 257, 648, '0.80', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(893, 257, 649, '0.80', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(894, 257, 650, '0.80', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(895, 258, 654, '0.70', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(896, 258, 652, '0.70', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(897, 255, 646, '0.75', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(898, 255, 647, '0.65', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(899, 254, 653, '0.65', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(900, 259, 658, '0.80', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(901, 259, 663, '0.85', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(902, 259, 655, '0.85', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(903, 259, 662, '0.85', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(904, 260, 657, '0.85', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(905, 260, 667, '0.85', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(906, 260, 656, '0.85', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(907, 260, 655, '0.85', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(908, 261, 661, '0.80', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(909, 261, 655, '0.85', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(910, 262, 659, '0.70', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(911, 262, 660, '0.80', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(912, 262, 656, '0.65', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(913, 263, 662, '0.90', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(914, 263, 658, '0.90', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(915, 259, 664, '0.75', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(916, 264, 665, '0.85', 1, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(917, 261, 666, '0.80', 2, '2026-03-12 15:25:45', '2026-03-12 15:25:45'),
(918, 265, 698, '0.90', 1, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(919, 265, 699, '0.80', 2, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(920, 265, 704, '0.70', 3, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(921, 265, 712, '0.60', 4, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(922, 265, 716, '0.50', 5, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(923, 266, 713, '0.90', 1, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(924, 266, 700, '0.80', 2, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(925, 266, 704, '0.70', 3, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(926, 266, 718, '0.90', 4, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(927, 267, 722, '0.90', 1, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(928, 267, 701, '0.70', 2, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(929, 267, 707, '0.60', 3, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(930, 267, 700, '0.50', 4, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(931, 268, 710, '0.90', 1, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(932, 268, 803, '0.80', 2, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(933, 268, 711, '0.60', 3, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(934, 268, 698, '0.50', 4, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(935, 269, 819, '0.90', 1, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(936, 269, 831, '0.80', 2, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(937, 269, 708, '0.70', 3, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(938, 269, 709, '0.60', 4, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(939, 270, 818, '0.90', 1, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(940, 270, 707, '0.80', 2, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(941, 270, 822, '0.70', 3, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(942, 270, 832, '0.60', 4, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(943, 271, 781, '0.90', 1, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(944, 271, 784, '0.80', 2, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(945, 271, 711, '0.70', 3, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(946, 271, 700, '0.50', 4, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(947, 272, 714, '0.90', 1, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(948, 272, 809, '0.80', 2, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(949, 272, 721, '0.60', 3, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(950, 272, 769, '0.50', 4, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(951, 273, 715, '0.90', 1, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(952, 273, 702, '0.80', 2, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(953, 273, 808, '0.70', 3, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(954, 273, 726, '0.50', 4, '2026-03-12 15:25:46', '2026-03-12 15:25:46'),
(955, 274, 723, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(956, 274, 769, '0.70', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(957, 274, 762, '0.60', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(958, 274, 759, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(959, 275, 721, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(960, 275, 713, '0.70', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(961, 275, 714, '0.60', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(962, 275, 762, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(963, 276, 724, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(964, 276, 806, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(965, 276, 725, '0.70', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(966, 276, 712, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(967, 277, 720, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(968, 277, 719, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(969, 277, 709, '0.60', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(970, 277, 702, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(971, 278, 804, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(972, 278, 807, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(973, 278, 805, '0.70', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(974, 278, 698, '0.60', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(975, 278, 716, '0.50', 5, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(976, 279, 728, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(977, 279, 737, '0.70', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(978, 279, 738, '0.70', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(979, 279, 735, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(980, 280, 729, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(981, 280, 732, '0.90', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(982, 280, 730, '0.70', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(983, 280, 728, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(984, 281, 736, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(985, 281, 728, '0.70', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(986, 281, 741, '0.70', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(987, 281, 729, '0.60', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(988, 282, 733, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(989, 282, 731, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(990, 282, 730, '0.60', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(991, 282, 728, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(992, 283, 739, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(993, 283, 839, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(994, 283, 730, '0.70', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(995, 283, 728, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(996, 284, 740, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(997, 284, 731, '0.70', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(998, 284, 728, '0.60', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(999, 284, 735, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1000, 285, 743, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1001, 285, 746, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1002, 285, 757, '0.70', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1003, 285, 745, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1004, 286, 744, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1005, 286, 747, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1006, 286, 748, '0.80', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1007, 286, 745, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1008, 287, 755, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1009, 287, 749, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1010, 287, 777, '0.80', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1011, 287, 745, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1012, 288, 751, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1013, 288, 750, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1014, 288, 756, '0.70', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1015, 288, 745, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1016, 289, 764, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1017, 289, 743, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1018, 289, 746, '0.70', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1019, 289, 757, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1020, 290, 752, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1021, 290, 745, '0.70', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1022, 290, 744, '0.60', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1023, 290, 750, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1024, 291, 758, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1025, 291, 765, '0.90', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1026, 291, 766, '0.80', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1027, 291, 771, '0.60', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1028, 292, 767, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1029, 292, 759, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1030, 292, 762, '0.70', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1031, 292, 758, '0.60', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1032, 293, 760, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1033, 293, 761, '0.70', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1034, 293, 762, '0.50', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1035, 294, 768, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1036, 294, 771, '0.70', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1037, 294, 770, '0.60', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1038, 294, 759, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1039, 295, 772, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1040, 295, 787, '0.70', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1041, 295, 762, '0.60', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1042, 295, 759, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1043, 296, 763, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1044, 296, 762, '0.70', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1045, 296, 759, '0.50', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1046, 297, 773, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1047, 297, 775, '0.70', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1048, 297, 745, '0.60', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1049, 297, 782, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1050, 298, 779, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1051, 298, 780, '0.70', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1052, 298, 762, '0.50', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1053, 299, 778, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1054, 299, 749, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1055, 299, 777, '0.70', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1056, 299, 745, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1057, 300, 776, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1058, 300, 782, '0.70', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1059, 300, 745, '0.40', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1060, 301, 786, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1061, 301, 774, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1062, 301, 775, '0.70', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1063, 301, 745, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1064, 302, 788, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1065, 302, 794, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1066, 302, 793, '0.70', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1067, 302, 710, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1068, 303, 789, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1069, 303, 793, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1070, 303, 794, '0.70', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1071, 303, 729, '0.60', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1072, 304, 790, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1073, 304, 793, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1074, 304, 770, '0.70', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1075, 304, 729, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1076, 305, 791, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1077, 305, 797, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1078, 305, 710, '0.70', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1079, 305, 698, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1080, 306, 794, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1081, 306, 798, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1082, 306, 793, '0.70', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1083, 306, 770, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1084, 307, 800, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1085, 307, 801, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1086, 307, 716, '0.60', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1087, 307, 807, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1088, 308, 804, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1089, 308, 807, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1090, 308, 805, '0.70', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1091, 308, 815, '0.60', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1092, 308, 698, '0.50', 5, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1093, 309, 806, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1094, 309, 724, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1095, 309, 725, '0.70', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1096, 309, 808, '0.60', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1097, 309, 712, '0.40', 5, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1098, 310, 809, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1099, 310, 714, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1100, 310, 722, '0.60', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1101, 310, 769, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1102, 311, 844, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1103, 311, 804, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1104, 311, 805, '0.70', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1105, 311, 807, '0.60', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1106, 312, 701, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1107, 312, 812, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1108, 312, 700, '0.60', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1109, 312, 726, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1110, 313, 819, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1111, 313, 820, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1112, 313, 831, '0.80', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1113, 313, 709, '0.60', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1114, 313, 708, '0.50', 5, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1115, 314, 818, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1116, 314, 822, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1117, 314, 829, '0.80', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1118, 314, 832, '0.70', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1119, 314, 707, '0.60', 5, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1120, 315, 720, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1121, 315, 827, '0.70', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1122, 315, 709, '0.60', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1123, 315, 702, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1124, 316, 828, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1125, 316, 705, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1126, 316, 762, '0.70', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1127, 316, 770, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1128, 317, 821, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1129, 317, 701, '0.70', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1130, 317, 710, '0.60', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1131, 317, 709, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1132, 318, 824, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1133, 318, 705, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1134, 318, 700, '0.70', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1135, 318, 845, '0.60', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1136, 331, 821, '0.80', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1137, 331, 706, '0.70', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1138, 331, 702, '0.60', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1139, 331, 709, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1140, 332, 826, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1141, 332, 709, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1142, 332, 699, '0.60', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1143, 332, 831, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1144, 333, 827, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1145, 333, 762, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1146, 333, 759, '0.60', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1147, 319, 833, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1148, 319, 835, '0.70', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1149, 319, 762, '0.50', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1150, 320, 834, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1151, 320, 836, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1152, 320, 837, '0.60', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1153, 320, 840, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1154, 321, 839, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1155, 321, 739, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1156, 321, 730, '0.60', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1157, 321, 728, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1158, 322, 838, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1159, 322, 833, '0.60', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1160, 322, 756, '0.50', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1161, 323, 835, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1162, 323, 833, '0.70', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1163, 323, 840, '0.50', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1164, 334, 841, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1165, 334, 836, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1166, 334, 834, '0.70', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1167, 334, 700, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1168, 324, 843, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1169, 324, 713, '0.70', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1170, 324, 722, '0.60', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1171, 324, 700, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1172, 325, 770, '0.80', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1173, 325, 793, '0.70', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1174, 325, 844, '0.60', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1175, 325, 850, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1176, 326, 851, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1177, 326, 786, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1178, 326, 775, '0.70', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1179, 326, 773, '0.60', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1180, 327, 745, '0.80', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1181, 327, 747, '0.70', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1182, 327, 743, '0.60', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1183, 327, 852, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1184, 328, 850, '0.70', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1185, 328, 770, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1186, 328, 802, '0.60', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1187, 328, 844, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1188, 329, 849, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1189, 329, 701, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1190, 329, 712, '0.70', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1191, 329, 700, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1192, 330, 781, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1193, 330, 712, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1194, 330, 714, '0.70', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1195, 330, 701, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1196, 335, 754, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1197, 335, 744, '0.70', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1198, 335, 748, '0.60', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1199, 335, 745, '0.50', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1200, 336, 793, '0.90', 1, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1201, 336, 770, '0.80', 2, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1202, 336, 789, '0.70', 3, '2026-03-12 15:25:47', '2026-03-12 15:25:47'),
(1203, 336, 790, '0.60', 4, '2026-03-12 15:25:47', '2026-03-12 15:25:47');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint UNSIGNED NOT NULL,
  `ticket_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `service_type` enum('REGULER','AUTHORIZED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'REGULER',
  `rma_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complaint` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `diagnosis_result` text COLLATE utf8mb4_unicode_ci,
  `service_items` json DEFAULT NULL,
  `recommendation` text COLLATE utf8mb4_unicode_ci,
  `estimated_cost` decimal(15,2) NOT NULL,
  `total_cost` decimal(15,2) NOT NULL,
  `service_cost` decimal(15,2) NOT NULL DEFAULT '0.00',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `status` enum('Pending','Diagnosis','Waiting Approval','In Progress','Waiting Part','Done','Taken','Cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `taken_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `brand_id` bigint UNSIGNED DEFAULT NULL,
  `has_adp` tinyint(1) NOT NULL DEFAULT '0',
  `adp_original_cost` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `ticket_number`, `customer_id`, `user_id`, `service_type`, `rma_number`, `device_name`, `serial_number`, `complaint`, `diagnosis_result`, `service_items`, `recommendation`, `estimated_cost`, `total_cost`, `service_cost`, `approved`, `status`, `taken_at`, `created_at`, `updated_at`, `completed_at`, `brand_id`, `has_adp`, `adp_original_cost`) VALUES
(1, 'SRV-20260204-QWD3', 1, NULL, 'REGULER', NULL, 'asdasdas', '1235123123', 'asdasd', 'asdasdas', NULL, NULL, '200000.00', '323123.00', '0.00', 0, 'Taken', '2026-02-21 02:00:07', '2026-02-04 06:23:10', '2026-03-12 00:14:00', '2026-02-21 02:00:07', NULL, 0, '0.00'),
(2, 'SRV-20260205-S7EL', 3, NULL, 'AUTHORIZED', '', 'asqdasda', '1235123', 'asfddasda', '123123adsfa', NULL, NULL, '0.00', '0.00', '0.00', 0, 'Taken', '2026-02-21 02:37:54', '2026-02-05 07:55:08', '2026-03-12 00:14:00', '2026-02-21 02:37:54', 5, 0, '0.00'),
(3, 'SRV-20260205-V2GJ', 4, NULL, 'REGULER', NULL, 'Acer asdas', '', 'Gejala: Layar blank hitam\n\nDiagnosis Sistem: Kerusakan Panel LCD (50%), Kabel Flexible LCD Rusak/Longgar (50%)', NULL, NULL, NULL, '50000.00', '50000.00', '0.00', 0, 'Taken', '2026-03-12 00:03:04', '2026-02-05 11:00:49', '2026-03-12 00:14:00', '2026-03-12 00:03:04', NULL, 0, '0.00'),
(4, 'SRV-20260221-DMYP', 5, NULL, 'REGULER', NULL, 'Asus Asus X505', '', 'Kategori: Panas / Overheat\nMasalah: Laptop Cepat Panas\nGejala: Suhu CPU di atas 90°C saat idle, Fan/kipas tidak berputar\n\nDiagnosis Sistem: Kipas/Fan Rusak (50%), Thermal Paste Kering (50%)\n\nCatatan: Laptop saya panas', 'Pasta Kering', NULL, NULL, '200000.00', '200000.00', '0.00', 0, 'Taken', '2026-02-21 02:00:00', '2026-02-21 01:18:45', '2026-03-12 00:14:00', '2026-02-21 02:00:00', NULL, 0, '0.00'),
(5, 'SRV-20260221-AL09', 6, NULL, 'AUTHORIZED', '3423423423qd2341341', 'Asus x2341', '', 'Lcd Flicker', NULL, NULL, NULL, '0.00', '0.00', '0.00', 0, 'Taken', '2026-02-21 02:38:01', '2026-02-21 02:07:22', '2026-03-12 00:14:00', '2026-02-21 02:38:01', 1, 0, '0.00'),
(6, 'SRV-20260303-CWS2', 7, NULL, 'REGULER', NULL, 'Acer X441x', '', 'Perangkat: Laptop\nKategori: Keyboard\nMasalah: Sebagian Tombol Mati\nGejala: Beberapa tombol tidak berfungsi, Keyboard tidak berfungsi\n\nDiagnosis Sistem: Keyboard Internal Rusak (7%)\n\nCatatan: keyboad bermasalah', NULL, NULL, NULL, '0.00', '0.00', '0.00', 0, 'Pending', NULL, '2026-03-03 05:58:20', '2026-03-03 05:58:20', NULL, NULL, 0, '0.00'),
(7, 'SRV-20260312-09JZ', 8, NULL, 'REGULER', NULL, 'Asus predator', '', 'Perangkat: Laptop\nKategori: Layar\nMasalah: Layar Hitam / Blank\nGejala: Layar blank hitam, Layar redup\n\nDiagnosis Sistem: Backlight/Inverter Rusak (55%), Kerusakan Panel LCD (41%), LCD Pecah Fisik (21%)\n\nCatatan: mati cik layarku', NULL, NULL, NULL, '0.00', '0.00', '0.00', 0, 'In Progress', NULL, '2026-03-11 22:05:54', '2026-03-11 22:06:14', NULL, NULL, 0, '0.00'),
(8, 'SRV-20260312-LLNH', 9, NULL, 'REGULER', NULL, 'Asus Rog Jadul', '', 'Perangkat: Laptop\nKategori: Layar\nMasalah: Layar Hitam / Blank\nGejala: Layar blank hitam, Layar redup\n\nDiagnosis Sistem: Backlight/Inverter Rusak (39%), Kerusakan Panel LCD (28%), LCD Pecah Fisik (21%)\n\nCatatan: Yang bener kerjanya', 'Harus ganti lcd', NULL, NULL, '200000.00', '1600000.00', '0.00', 0, 'Taken', '2026-03-12 00:11:12', '2026-03-11 23:52:46', '2026-03-12 00:14:00', '2026-03-12 00:11:12', NULL, 0, '0.00'),
(9, 'SRV-20260412-KTAH', 10, NULL, 'AUTHORIZED', '', 'Asus Vivobook s14', 'NOS028H282N28HDJ', 'Tidak Bisa Menyala', NULL, NULL, NULL, '0.00', '0.00', '0.00', 0, 'Pending', NULL, '2026-04-12 04:19:49', '2026-04-12 04:19:49', NULL, NULL, 0, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `service_categories`
--

CREATE TABLE `service_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `services_data` json DEFAULT NULL,
  `estimated_cost_range` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order_column` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_categories`
--

INSERT INTO `service_categories` (`id`, `name`, `slug`, `icon`, `description`, `services_data`, `estimated_cost_range`, `is_active`, `order_column`, `created_at`, `updated_at`) VALUES
(1, 'Paket Hardware', 'hardware', '🔧', 'Perbaikan, cleaning, ganti pasta, dll', '{\"cleaning_all\": {\"desc\": \"Pembersihan menyeluruh luar dan dalam\", \"note\": \"Bersihkan debu, keyboard, body, dan ventilasi udara.\", \"label\": \"Cleaning All\", \"price\": \"Rp 225.000\"}, \"tambah_pasta\": {\"desc\": \"Penambahan thermal paste tanpa cleaning\", \"note\": \"Ganti pasta termal untuk mengatasi laptop/PC panas.\", \"label\": \"Tambah Thermal Paste\", \"price\": \"Rp 155.000\"}, \"fleksibel_lcd\": {\"desc\": \"Perbaikan kabel fleksibel layar laptop\", \"note\": \"Untuk masalah layar blank/bergaris akibat kabel fleksibel.\", \"label\": \"Rekoreksi Fleksibel LCD\", \"price\": \"Rp 100.000\"}, \"reset_battery\": {\"desc\": \"Reset dan kalibrasi baterai laptop\", \"note\": \"Kalibrasi ulang indikator baterai yang tidak akurat.\", \"label\": \"Reset Battery\", \"price\": \"Rp 100.000\"}, \"cleaning_pasta\": {\"desc\": \"Bersihkan kipas, heatsink, dan ganti thermal paste\", \"note\": \"Termasuk pembersihan debu internal dan penggantian thermal paste baru.\", \"label\": \"Cleaning & Ganti Pasta\", \"price\": \"Rp 255.000\"}, \"fleksibel_keyboard\": {\"desc\": \"Perbaikan kabel fleksibel keyboard laptop\", \"note\": \"Untuk masalah keyboard mati/sebagian akibat kabel fleksibel.\", \"label\": \"Rekoreksi Fleksibel Keyboard\", \"price\": \"Rp 155.000\"}, \"fleksibel_touchpad\": {\"desc\": \"Perbaikan kabel fleksibel touchpad laptop\", \"note\": \"Untuk masalah touchpad tidak berfungsi akibat kabel fleksibel.\", \"label\": \"Rekoreksi Fleksibel Touchpad\", \"price\": \"Rp 100.000\"}, \"perbaikan_mainboard\": {\"desc\": \"Perbaikan komponen mainboard laptop/PC/AIO\", \"note\": \"Harga tergantung tingkat kerusakan. Diagnosis awal gratis.\", \"label\": \"Perbaikan Mainboard\", \"price\": \"Rp 900.000\"}}', NULL, 1, 1, '2026-04-01 05:49:18', '2026-04-01 08:03:51'),
(2, 'Paket Software', 'software', '💿', 'Install ulang, install aplikasi, dll', '{\"isi_lagu\": {\"desc\": \"Isi koleksi lagu ke flashdisk\", \"note\": \"Transfer koleksi lagu pilihan ke flashdisk pelanggan.\", \"label\": \"Isi Lagu ke Flashdisk\", \"price\": \"Rp 50.000\"}, \"instal_spss\": {\"desc\": \"Install aplikasi SPSS untuk statistik\", \"note\": \"Aplikasi statistik untuk penelitian dan analisis data.\", \"label\": \"Instal Apps SPSS\", \"price\": \"Rp 50.000\"}, \"instal_ulang\": {\"desc\": \"Install ulang Windows beserta driver\", \"note\": \"Termasuk install driver dan aktivasi Windows.\", \"label\": \"Instal Ulang OS\", \"price\": \"Rp 100.000\"}, \"instal_office\": {\"desc\": \"Install Microsoft Office (Word, Excel, PPT)\", \"note\": \"Microsoft Office lengkap (Word, Excel, PowerPoint, dll).\", \"label\": \"Instal Aplikasi Office\", \"price\": \"Rp 50.000\"}, \"instal_archgis\": {\"desc\": \"Install aplikasi ArcGIS untuk pemetaan\", \"note\": \"Aplikasi GIS profesional untuk analisis pemetaan.\", \"label\": \"Instal Apps ArcGIS\", \"price\": \"Rp 250.000\"}, \"instal_sap2000\": {\"desc\": \"Install SAP2000 untuk analisis struktur\", \"note\": \"Aplikasi analisis dan desain struktur teknik sipil.\", \"label\": \"Instal Apps SAP2000\", \"price\": \"Rp 150.000\"}, \"instal_standar\": {\"desc\": \"Paket aplikasi standar (browser, WinRAR, dll)\", \"note\": \"Termasuk browser, antivirus, media player, dan utilitas dasar.\", \"label\": \"Instal Aplikasi Standar\", \"price\": \"Rp 100.000\"}, \"instal_sketchup\": {\"desc\": \"Install SketchUp untuk desain 3D\", \"note\": \"Aplikasi desain 3D dan arsitektur.\", \"label\": \"Instal Apps SketchUp\", \"price\": \"Rp 50.000\"}}', NULL, 1, 2, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(3, 'Upgrade Part', 'upgrade', '⬆️', 'Upgrade RAM, SSD/HDD, dsb', '{\"upgrade_ram\": {\"desc\": \"Tambah atau ganti RAM laptop/PC/AIO\", \"note\": \"Harga tergantung jenis dan kapasitas RAM. Konsultasi gratis untuk cek kompatibilitas.\", \"label\": \"Upgrade RAM\", \"price\": \"Tergantung spek\"}, \"upgrade_ssd\": {\"desc\": \"Ganti HDD ke SSD atau upgrade kapasitas\", \"note\": \"Include cloning data dari drive lama. Harga tergantung kapasitas SSD.\", \"label\": \"Upgrade SSD / HDD\", \"price\": \"Tergantung spek\"}}', NULL, 1, 3, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(4, 'Paket Printer', 'printer', '🖨️', 'Maintenance head, isi tinta, dll', '{\"isi_tinta\": {\"desc\": \"Refill tinta printer inkjet\", \"note\": \"Harga tergantung jenis tinta (hitam/warna) dan merek printer.\", \"label\": \"Isi Ulang Tinta\", \"price\": \"Rp 50.000 - 100.000\"}, \"sedot_tinta\": {\"desc\": \"Penyedotan tinta yang tersumbat\", \"note\": \"Menyedot tinta buntu dari head printer inkjet.\", \"label\": \"Sedot Tinta / Ink Suction\", \"price\": \"Rp 70.000\"}, \"kertas_macet\": {\"desc\": \"Perbaikan masalah kertas macet/nyangkut\", \"note\": \"Termasuk pengecekan roller dan jalur kertas.\", \"label\": \"Kertas Nyangkut / Paper Stuck\", \"price\": \"Rp 155.000\"}, \"cleaning_printer\": {\"desc\": \"Cleaning system printer for PC\", \"note\": \"Pembersihan menyeluruh sistem print dan roller.\", \"label\": \"Cleaning System Print\", \"price\": \"Rp 155.000\"}, \"maintenance_head\": {\"desc\": \"Pembersihan dan perawatan print head\", \"note\": \"Deep cleaning print head untuk mengatasi hasil cetak bergaris/pudar.\", \"label\": \"Maintenance Print Head\", \"price\": \"Rp 150.000\"}, \"maintenance_catridge\": {\"desc\": \"Pembersihan dan perawatan catridge\", \"note\": \"Bersihkan catridge dari tinta kering dan sumbatan.\", \"label\": \"Maintenance Catridge\", \"price\": \"Rp 55.000\"}}', NULL, 1, 4, '2026-04-01 05:49:18', '2026-04-01 05:59:41'),
(5, 'Biaya Lainnya', 'lainnya', '💰', 'Biaya pasang, pengecekan, dll', '{\"pengecekan\": {\"desc\": \"Diagnosis dan pengecekan kerusakan\", \"note\": \"Biaya pengecekan menyeluruh oleh teknisi. Hangus jika tidak jadi servis.\", \"label\": \"Biaya Pengecekan\", \"price\": \"Rp 100.000\"}, \"pasang_laptop\": {\"desc\": \"Biaya jasa pemasangan part laptop\", \"note\": \"Biaya jasa pemasangan komponen di laptop.\", \"label\": \"Biaya Pasang (Laptop)\", \"price\": \"Rp 200.000\"}, \"pasang_pc_aio\": {\"desc\": \"Biaya jasa pemasangan part AIO/PC Desktop\", \"note\": \"Biaya jasa pemasangan komponen di PC Desktop atau AIO.\", \"label\": \"Biaya Pasang (AIO/PC)\", \"price\": \"Rp 300.000\"}}', NULL, 1, 5, '2026-04-01 05:49:18', '2026-04-01 05:59:41');

-- --------------------------------------------------------

--
-- Table structure for table `service_logs`
--

CREATE TABLE `service_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `service_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_logs`
--

INSERT INTO `service_logs` (`id`, `service_id`, `user_id`, `status`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'In Progress', 'Status diubah menjadi In Progress', '2026-02-04 08:18:02', '2026-02-04 08:18:02'),
(2, 1, NULL, 'Done', 'Status diubah menjadi Done', '2026-02-05 07:38:45', '2026-02-05 07:38:45'),
(3, 3, 2, 'Pending', 'Servis baru diterima / dibuat', '2026-02-05 11:00:49', '2026-02-05 11:00:49'),
(4, 4, 2, 'Pending', 'Servis baru diterima / dibuat', '2026-02-21 01:18:45', '2026-02-21 01:18:45'),
(5, 4, 2, 'Diagnosis', 'Status diubah menjadi Diagnosis', '2026-02-21 01:33:14', '2026-02-21 01:33:14'),
(6, 3, 2, 'Diagnosis', 'Status diubah menjadi Diagnosis', '2026-02-21 01:33:20', '2026-02-21 01:33:20'),
(7, 4, 2, 'In Progress', 'Status diubah menjadi In Progress', '2026-02-21 01:59:17', '2026-02-21 01:59:17'),
(8, 4, 2, 'Taken', 'Status diubah menjadi Taken', '2026-02-21 02:00:00', '2026-02-21 02:00:00'),
(9, 1, 2, 'Taken', 'Status diubah menjadi Taken', '2026-02-21 02:00:07', '2026-02-21 02:00:07'),
(10, 5, 2, 'Pending', 'Servis baru diterima / dibuat', '2026-02-21 02:07:22', '2026-02-21 02:07:22'),
(11, 5, 2, 'Waiting Part', 'Status diubah menjadi Waiting Part', '2026-02-21 02:37:37', '2026-02-21 02:37:37'),
(12, 2, 2, 'Done', 'Status diubah menjadi Done', '2026-02-21 02:37:54', '2026-02-21 02:37:54'),
(13, 5, 2, 'Taken', 'Status diubah menjadi Taken', '2026-02-21 02:38:01', '2026-02-21 02:38:01'),
(14, 2, 2, 'Taken', 'Status diubah menjadi Taken', '2026-02-21 02:38:07', '2026-02-21 02:38:07'),
(15, 6, 2, 'Pending', 'Servis baru diterima / dibuat', '2026-03-03 05:58:20', '2026-03-03 05:58:20'),
(16, 7, 2, 'Pending', 'Servis baru diterima / dibuat', '2026-03-11 22:05:54', '2026-03-11 22:05:54'),
(17, 7, 2, 'In Progress', 'Status diubah menjadi In Progress', '2026-03-11 22:06:14', '2026-03-11 22:06:14'),
(18, 8, 2, 'Pending', 'Servis baru diterima / dibuat', '2026-03-11 23:52:46', '2026-03-11 23:52:46'),
(19, 8, 2, 'Diagnosis', 'Status diubah menjadi Diagnosis', '2026-03-12 00:02:14', '2026-03-12 00:02:14'),
(20, 3, 2, 'Done', 'Status diubah menjadi Done', '2026-03-12 00:03:04', '2026-03-12 00:03:04'),
(21, 3, 2, 'Taken', 'Status diubah menjadi Taken', '2026-03-12 00:03:25', '2026-03-12 00:03:25'),
(22, 8, 2, 'Taken', 'Status diubah menjadi Taken', '2026-03-12 00:11:12', '2026-03-12 00:11:12'),
(23, 9, 2, 'Pending', 'Servis baru diterima / dibuat', '2026-04-12 04:19:49', '2026-04-12 04:19:49');

-- --------------------------------------------------------

--
-- Table structure for table `service_spareparts`
--

CREATE TABLE `service_spareparts` (
  `id` bigint UNSIGNED NOT NULL,
  `service_id` bigint UNSIGNED NOT NULL,
  `sparepart_id` bigint UNSIGNED NOT NULL,
  `qty` int NOT NULL DEFAULT '1',
  `price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_spareparts`
--

INSERT INTO `service_spareparts` (`id`, `service_id`, `sparepart_id`, `qty`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '123123.00', '2026-02-04 08:15:48', '2026-02-04 08:15:48'),
(3, 8, 3, 1, '1400000.00', '2026-03-12 00:01:00', '2026-03-12 00:01:00');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('QbkVLCmN0r9iB0AR51dSY9G2jDpLTGBZVfEE1R94', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicWljc1h3RTVIb1M4OHNCMFdtUks5WEMyV2U3bWN1ckhlOTB5STVHeCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdXBlci1hZG1pbi9zZXR0aW5ncyI7czo1OiJyb3V0ZSI7czoyMDoic3VwZXItYWRtaW4uc2V0dGluZ3MiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1776082920);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES
('admin_fee_per_invoice', '20000', '2026-02-05 08:09:27', '2026-02-05 08:09:27'),
('technician_commission_percent', '100', '2026-02-05 08:09:27', '2026-02-21 01:52:12'),
('technician_monthly_target', '4000000', '2026-02-05 08:09:27', '2026-02-21 01:50:03');

-- --------------------------------------------------------

--
-- Table structure for table `spareparts`
--

CREATE TABLE `spareparts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `price` decimal(15,2) NOT NULL,
  `supplier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spareparts`
--

INSERT INTO `spareparts` (`id`, `name`, `code`, `category`, `stock`, `price`, `supplier`, `created_at`, `updated_at`) VALUES
(1, 'asdasda', 'MAN-1770218148-216', NULL, 0, '123123.00', NULL, '2026-02-04 08:15:48', '2026-02-04 08:15:48'),
(2, 'LCD', 'MAN-1773298401-947', NULL, 1, '1399996.00', NULL, '2026-03-11 23:53:21', '2026-03-12 00:00:44'),
(3, 'LCD', 'MAN-1773298860-109', NULL, 0, '1400000.00', NULL, '2026-03-12 00:01:00', '2026-03-12 00:01:00');

-- --------------------------------------------------------

--
-- Table structure for table `symptoms`
--

CREATE TABLE `symptoms` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'laptop',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` text COLLATE utf8mb4_unicode_ci,
  `follow_up_question` text COLLATE utf8mb4_unicode_ci,
  `weight` decimal(3,2) NOT NULL DEFAULT '1.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `device_type_id` bigint UNSIGNED DEFAULT NULL,
  `device_component_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `symptoms`
--

INSERT INTO `symptoms` (`id`, `code`, `device_type`, `name`, `category`, `keywords`, `follow_up_question`, `weight`, `created_at`, `updated_at`, `device_type_id`, `device_component_id`) VALUES
(1, 'G001', 'laptop', 'Layar blank hitam', 'Display', '[\"blank\",\"hitam\",\"gelap\",\"tidak tampil\",\"mati layar\",\"black screen\",\"layar mati\",\"no display\",\"layar kosong\",\"layar gelap\",\"layarnya mati\",\"lcd mati\",\"ga ada tampilan\",\"gak ada tampilan\",\"layar ga nyala\",\"layar gak nyala\"]', NULL, '0.80', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 9),
(2, 'G002', 'laptop', 'Layar bergaris', 'Display', '[\"garis\",\"bergaris\",\"garis vertikal\",\"garis horizontal\",\"strip\",\"ada garis\",\"belang\",\"layar ada garis\",\"garis-garis\",\"striping\"]', NULL, '0.90', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 9),
(3, 'G003', 'laptop', 'Layar berkedip/flicker', 'Display', '[\"kedip\",\"flicker\",\"berkedip\",\"kelap kelip\",\"blinking\",\"goyang\",\"kedap kedip\",\"bergetar\",\"kedip-kedip\",\"layar kedip\",\"layar goyang\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 9),
(4, 'G004', 'laptop', 'Layar redup', 'Display', '[\"redup\",\"gelap\",\"dim\",\"tidak terang\",\"backlight redup\",\"kurang terang\",\"layar gelap\",\"layar remang\",\"cahaya kurang\"]', NULL, '0.80', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 9),
(5, 'G005', 'laptop', 'Layar pecah', 'Display', '[\"pecah\",\"retak\",\"crack\",\"broken screen\",\"lcd pecah\",\"lcd retak\",\"layar rusak\",\"screen pecah\",\"kaca pecah\"]', NULL, '1.00', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 9),
(6, 'G006', 'laptop', 'Warna layar aneh/pudar', 'Display', '[\"warna aneh\",\"pudar\",\"warna pucat\",\"discolor\",\"warna berubah\",\"warna salah\",\"warna ga normal\",\"warna beda\",\"warna pudar\"]', NULL, '0.60', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 9),
(7, 'G007', 'laptop', 'Tampilan normal di monitor eksternal', 'Display', '[\"monitor eksternal normal\",\"external monitor ok\",\"hdmi normal\",\"monitor luar bisa\",\"eksternal bisa\"]', NULL, '0.90', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 9),
(8, 'G008', 'laptop', 'Layar berkedip saat digerakkan', 'Display', '[\"kedip saat gerak\",\"berkedip gerak\",\"flicker gerak\",\"layar kedip kalo digerakin\",\"gerak kedip\"]', NULL, '0.90', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 9),
(9, 'G109', 'laptop', 'Layar ada bercak putih/white spot', 'Display', '[\"bercak putih\",\"white spot\",\"titik putih\",\"noda putih di layar\",\"ada titik terang\",\"white dot\",\"bright spot\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 9),
(10, 'G110', 'laptop', 'Layar ada dead pixel', 'Display', '[\"dead pixel\",\"titik mati\",\"pixel mati\",\"ada titik hitam permanen\",\"pixel stuck\",\"pixel rusak\"]', NULL, '0.60', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 9),
(11, 'G111', 'laptop', 'Layar ada bayangan/ghosting', 'Display', '[\"bayangan\",\"ghosting\",\"shadow\",\"afterimage\",\"bekas gambar\",\"layar ngelag\",\"jejak gambar\"]', NULL, '0.60', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 9),
(12, 'G112', 'laptop', 'Layar kuning/yellowish', 'Display', '[\"layar kuning\",\"yellowish\",\"warna kekuningan\",\"layar menguning\",\"tint kuning\",\"layar warm\",\"layar panas warna\"]', NULL, '0.50', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 9),
(13, 'G113', 'laptop', 'Layar ada garis tipis di pinggir', 'Display', '[\"garis pinggir\",\"border garis\",\"garis tepi\",\"garis samping layar\",\"pinggiran ada garis\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 9),
(14, 'G114', 'laptop', 'Layar hanya setengah menyala', 'Display', '[\"setengah layar\",\"half screen\",\"separuh mati\",\"layar mati sebagian\",\"display setengah\"]', NULL, '0.80', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 9),
(15, 'G115', 'laptop', 'Layar touchscreen tidak responsif', 'Display', '[\"touchscreen mati\",\"layar sentuh error\",\"touch ga respon\",\"digitizer rusak\",\"layar sentuh ga bisa\",\"touchscreen ga jalan\"]', NULL, '0.80', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 9),
(16, 'G116', 'laptop', 'Layar touchscreen ghost touch', 'Display', '[\"ghost touch\",\"sentuh sendiri\",\"touch phantom\",\"layar pencet sendiri\",\"touchscreen klik sendiri\"]', NULL, '0.80', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 9),
(17, 'G117', 'laptop', 'Layar resolusi berubah sendiri', 'Display', '[\"resolusi berubah\",\"display scaling error\",\"layar membesar\",\"tampilan membesar\",\"resolusi rendah sendiri\"]', NULL, '0.50', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 9),
(18, 'G118', 'laptop', 'Layar ada bintik hitam menyebar', 'Display', '[\"bintik hitam\",\"lcd bleeding\",\"spot hitam\",\"noda hitam menyebar\",\"titik hitam bertambah\"]', NULL, '0.80', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 9),
(19, 'G119', 'laptop', 'Layar ada efek pelangi/rainbow', 'Display', '[\"efek pelangi\",\"rainbow effect\",\"warna pelangi\",\"layar warna warni\",\"iridescent screen\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 9),
(20, 'G120', 'laptop', 'Layar mati setelah beberapa menit', 'Display', '[\"layar mati sendiri\",\"display off\",\"layar padam\",\"layar timeout\",\"layar tiba-tiba mati\",\"monitor sleep\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 9),
(21, 'G009', 'laptop', 'Keyboard tidak berfungsi', 'Keyboard', '[\"keyboard mati\",\"tidak bisa ketik\",\"keyboard error\",\"keyboard rusak\",\"keyboard ga bisa\",\"keyboard gak bisa\",\"keyboard tidak berfungsi\",\"gabisa ngetik\",\"ga bisa ngetik\",\"gak bisa ngetik\",\"keyboard hang\",\"keyboard eror\"]', NULL, '0.80', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 11),
(22, 'G010', 'laptop', 'Beberapa tombol tidak berfungsi', 'Keyboard', '[\"tombol mati\",\"sebagian tombol\",\"beberapa tombol rusak\",\"tombol tidak berfungsi\",\"tombol macet\",\"tombol ga bisa\",\"tombol gak bisa\",\"tombol rusak\",\"tombol keras\",\"tombol susah ditekan\",\"tombol susah dipencet\",\"tombol ga fungsi\",\"tombol error\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 11),
(23, 'G011', 'laptop', 'Keyboard mengetik sendiri', 'Keyboard', '[\"ketik sendiri\",\"ghost typing\",\"mengetik otomatis\",\"keyboard short\",\"ngetik sendiri\",\"keyboard ngetik sendiri\",\"tombol kepencet sendiri\",\"huruf keluar sendiri\"]', NULL, '0.80', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 11),
(24, 'G012', 'laptop', 'Respon keyboard lambat', 'Keyboard', '[\"keyboard lambat\",\"delay ketik\",\"respon lambat\",\"ketik delay\",\"keyboard lemot\",\"input delay\",\"ketik telat\",\"keyboard lag\"]', NULL, '0.50', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 11),
(25, 'G013', 'laptop', 'Keyboard eksternal berfungsi normal', 'Keyboard', '[\"keyboard external ok\",\"usb keyboard normal\",\"keyboard luar bisa\",\"external keyboard jalan\"]', NULL, '0.90', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 11),
(26, 'G059', 'laptop', 'Ketikan dobel', 'Keyboard', '[\"ketik dobel\",\"ketikan dobel\",\"ketikan ganda\",\"keyboard double\",\"double typing\",\"ngetik dobel\",\"huruf dobel\",\"karakter ganda\",\"ketik 2 kali\",\"ketikan double\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 11),
(27, 'G087', 'laptop', 'Lampu keyboard mati', 'Keyboard', '[\"backlight keyboard mati\",\"lampu keyboard mati\",\"keyboard ga nyala\",\"led keyboard mati\",\"backlit mati\",\"keyboard ga ada lampu\",\"lampu tombol mati\"]', NULL, '0.50', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 11),
(28, 'G121', 'laptop', 'Tombol keyboard lepas/copot', 'Keyboard', '[\"tombol lepas\",\"keycap copot\",\"tombol copot\",\"tombol patah\",\"keycap hilang\",\"penutup tombol lepas\",\"tuts lepas\"]', NULL, '0.60', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 11),
(29, 'G122', 'laptop', 'Keyboard terasa lengket', 'Keyboard', '[\"keyboard lengket\",\"tombol lengket\",\"tombol nyangkut\",\"sticky key\",\"tombol nempel\",\"susah balik tombol\"]', NULL, '0.60', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 11),
(30, 'G123', 'laptop', 'Tombol Enter/Space/Shift tidak berfungsi', 'Keyboard', '[\"enter ga bisa\",\"space ga bisa\",\"shift ga bisa\",\"tombol besar mati\",\"tombol utama rusak\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 11),
(31, 'G124', 'laptop', 'NumLock/CapsLock menyala terus', 'Keyboard', '[\"numlock nyala terus\",\"capslock nyala\",\"indikator lock nyala\",\"huruf kapital terus\",\"angka terus\"]', NULL, '0.40', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 11),
(32, 'G125', 'laptop', 'Keyboard menekan karakter salah', 'Keyboard', '[\"huruf salah\",\"karakter beda\",\"tombol tukar\",\"keyboard acak\",\"ketikan tidak sesuai\",\"output salah\"]', NULL, '0.60', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 11),
(33, 'G126', 'laptop', 'Fn key tidak berfungsi', 'Keyboard', '[\"fn ga bisa\",\"function key mati\",\"fn key rusak\",\"shortcut fn ga jalan\",\"brightness fn ga bisa\",\"volume fn ga bisa\"]', NULL, '0.50', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 11),
(34, 'G127', 'laptop', 'Keyboard bunyi klik abnormal', 'Keyboard', '[\"keyboard bunyi\",\"tombol bunyi aneh\",\"keyboard berisik\",\"tombol klik keras\",\"bunyi patah saat tekan\"]', NULL, '0.40', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 11),
(35, 'G128', 'laptop', 'Semua keyboard mati setelah update', 'Keyboard', '[\"keyboard mati update\",\"keyboard hilang setelah update\",\"driver keyboard hilang\",\"keyboard ga terdeteksi setelah update\"]', NULL, '0.60', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 11),
(36, 'G014', 'laptop', 'WiFi tidak terdeteksi', 'Network', '[\"wifi hilang\",\"wifi tidak ada\",\"no wifi\",\"wifi mati\",\"wifi tidak konek\",\"wifi ga konek\",\"wifi gak konek\",\"wifi error\",\"wifi ga ada\",\"wifi gak ada\",\"sinyal wifi hilang\",\"wifi ga muncul\",\"wifi ilang\"]', NULL, '0.80', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 13),
(37, 'G015', 'laptop', 'WiFi sering terputus', 'Network', '[\"wifi putus\",\"disconnect\",\"wifi tidak stabil\",\"putus nyambung\",\"wifi putus-putus\",\"sinyal lemah\",\"sinyal putus\",\"wifi sering putus\",\"koneksi putus\",\"wifi nyambung putus\"]', NULL, '0.60', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 13),
(38, 'G016', 'laptop', 'Internet lambat padahal WiFi kuat', 'Network', '[\"internet lambat\",\"wifi lambat\",\"koneksi lemot\",\"wifi lemot\",\"koneksi lambat\",\"internet lemot\",\"inet lemot\",\"loading lambat\"]', NULL, '0.50', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 13),
(39, 'G017', 'laptop', 'Bluetooth tidak berfungsi', 'Network', '[\"bluetooth mati\",\"bluetooth hilang\",\"no bluetooth\",\"bluetooth error\",\"bluetooth ga konek\",\"bluetooth tidak konek\",\"bt mati\",\"bt ga bisa\",\"bluetooth ga bisa\",\"bluetooth rusak\",\"bt error\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 13),
(40, 'G129', 'laptop', 'WiFi hanya terdeteksi jarak dekat', 'Network', '[\"wifi lemah\",\"sinyal pendek\",\"wifi dekat aja\",\"jangkauan wifi kecil\",\"wifi ga sampai\",\"wifi cuma deket\"]', NULL, '0.60', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 13),
(41, 'G130', 'laptop', 'WiFi konek tapi no internet', 'Network', '[\"connected no internet\",\"konek tapi ga bisa browsing\",\"wifi nyambung tapi ga ada internet\",\"limited connection\"]', NULL, '0.50', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 13),
(42, 'G131', 'laptop', 'Bluetooth sering disconnect', 'Network', '[\"bluetooth putus\",\"bt disconnect\",\"bluetooth ga stabil\",\"bluetooth putus-putus\",\"perangkat bt sering lepas\"]', NULL, '0.50', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 13),
(43, 'G132', 'laptop', 'WiFi adapter disabled di Device Manager', 'Network', '[\"wifi disabled\",\"adapter off\",\"wifi dinonaktifkan\",\"network adapter mati\",\"wireless off\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 13),
(44, 'G133', 'laptop', 'Tidak ada opsi WiFi di Settings', 'Network', '[\"wifi hilang dari settings\",\"no wireless option\",\"wifi ga ada di pengaturan\",\"wireless menghilang\"]', NULL, '0.80', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 13),
(45, 'G134', 'laptop', 'Bluetooth tidak bisa pairing', 'Network', '[\"bt ga bisa pair\",\"bluetooth gagal konek\",\"pairing failed\",\"bluetooth ga bisa sambung\",\"perangkat bt ga ketemu\"]', NULL, '0.50', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 13),
(46, 'G135', 'laptop', 'Airplane mode tidak bisa dimatikan', 'Network', '[\"airplane mode stuck\",\"mode pesawat ga bisa off\",\"airplane mode error\",\"stuck airplane\",\"flight mode nyangkut\"]', NULL, '0.60', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 13),
(47, 'G136', 'laptop', 'WiFi lambat hanya di laptop ini', 'Network', '[\"wifi lambat laptop\",\"perangkat lain normal\",\"cuma laptop lambat\",\"hp wifi cepat laptop lambat\"]', NULL, '0.50', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 13),
(48, 'G137', 'laptop', 'LAN/Ethernet tidak terdeteksi', 'Network', '[\"lan mati\",\"ethernet ga bisa\",\"kabel lan ga konek\",\"rj45 ga terdeteksi\",\"port ethernet rusak\",\"network cable ga jalan\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 13),
(49, 'G138', 'laptop', 'WiFi mati setelah sleep/hibernate', 'Network', '[\"wifi mati bangun tidur\",\"wifi hilang setelah sleep\",\"wifi ga konek setelah hibernate\",\"wireless off after sleep\"]', NULL, '0.50', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 13),
(50, 'G139', 'laptop', 'Antena WiFi internal putus', 'Network', '[\"antena wifi putus\",\"kabel antena lepas\",\"antena internal rusak\",\"wifi antenna broken\"]', NULL, '0.80', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 13),
(51, 'G140', 'laptop', 'WiFi card tidak terdeteksi di BIOS', 'Network', '[\"wifi card hilang\",\"wireless card ga ada di bios\",\"wifi module ga kebaca\",\"pcie wifi ga terdeteksi\"]', NULL, '0.90', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 13),
(52, 'G018', 'laptop', 'Port USB tidak terbaca', 'Peripheral', '[\"usb mati\",\"usb tidak terbaca\",\"port usb rusak\",\"usb error\",\"port usb mati\",\"flashdisk tidak terbaca\",\"usb tidak terdeteksi\",\"usb ga terbaca\",\"usb ga kebaca\",\"fd ga terbaca\",\"flashdisk ga kebaca\",\"colokan usb rusak\",\"port usb ga bisa\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, NULL),
(53, 'G019', 'laptop', 'HDMI tidak menampilkan gambar', 'Peripheral', '[\"hdmi mati\",\"hdmi tidak keluar\",\"external display error\",\"hdmi ga keluar\",\"hdmi rusak\",\"hdmi ga bisa\",\"proyektor ga konek\",\"monitor external ga bisa\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, NULL),
(54, 'G020', 'laptop', 'Touchpad tidak berfungsi', 'Peripheral', '[\"touchpad mati\",\"touchpad rusak\",\"cursor tidak gerak\",\"touchpad ga bisa\",\"touchpad error\",\"trackpad mati\",\"trackpad rusak\",\"mousepad mati\",\"cursor ga gerak\",\"kursor ga gerak\",\"touchpad ga jalan\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, NULL),
(55, 'G021', 'laptop', 'Touchpad over sensitif', 'Peripheral', '[\"touchpad sensitif\",\"cursor loncat\",\"touchpad terlalu sensitif\",\"touchpad kemana-mana\",\"cursor lompat\",\"kursor loncat-loncat\"]', NULL, '0.50', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, NULL),
(56, 'G022', 'laptop', 'Webcam tidak berfungsi', 'Peripheral', '[\"webcam mati\",\"kamera tidak berfungsi\",\"camera error\",\"kamera mati\",\"webcam rusak\",\"webcam ga bisa\",\"kamera ga bisa\",\"cam mati\",\"cam rusak\",\"kamera laptop mati\",\"webcam ga berfungsi\"]', NULL, '0.60', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, NULL),
(57, 'G064', 'laptop', 'Port charger rusak/longgar', 'Peripheral', '[\"port charger rusak\",\"charger tidak masuk\",\"charger ga masuk\",\"colokan charger rusak\",\"lobang charger rusak\",\"port cas rusak\",\"port cas longgar\",\"charger longgar\",\"cas ga masuk\",\"dc jack rusak\",\"jack charger rusak\",\"charger harus digoyang\"]', NULL, '0.80', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, NULL),
(58, 'G065', 'laptop', 'Port USB longgar/rusak fisik', 'Peripheral', '[\"usb longgar\",\"usb oblak\",\"port usb goyang\",\"usb susah masuk\",\"usb ga masuk\",\"colokan usb rusak\",\"port usb copot\",\"usb harus digoyang\",\"port usb patah\",\"lubang usb rusak\",\"usb lepas sendiri\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, NULL),
(59, 'G066', 'laptop', 'Port HDMI rusak', 'Peripheral', '[\"hdmi rusak\",\"port hdmi rusak\",\"hdmi longgar\",\"hdmi ga masuk\",\"colokan hdmi rusak\",\"hdmi copot\",\"hdmi oblak\",\"hdmi patah\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, NULL),
(60, 'G067', 'laptop', 'Port audio jack rusak fisik', 'Peripheral', '[\"jack audio longgar\",\"audio jack oblak\",\"colokan headset longgar\",\"headphone jack rusak fisik\",\"audio port patah\",\"jack 3.5mm rusak\",\"earphone ga kenceng\"]', NULL, '0.60', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, NULL),
(61, 'G068', 'laptop', 'Semua port bermasalah', 'Peripheral', '[\"semua port rusak\",\"port-port rusak\",\"semua colokan rusak\",\"ga ada port yang bisa\",\"port mati semua\",\"colokan mati semua\"]', NULL, '0.90', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, NULL),
(62, 'G069', 'laptop', 'Card reader tidak berfungsi', 'Peripheral', '[\"card reader mati\",\"sd card ga terbaca\",\"memory card ga kebaca\",\"slot sd rusak\",\"card reader rusak\",\"micro sd ga kedeteksi\",\"slot kartu rusak\"]', NULL, '0.60', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, NULL),
(63, 'G078', 'laptop', 'Kamera blur/tidak fokus', 'Peripheral', '[\"kamera blur\",\"webcam blur\",\"kamera ga fokus\",\"cam buram\",\"webcam buram\",\"kamera kotor\",\"gambar webcam jelek\",\"video call buram\"]', NULL, '0.50', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, NULL),
(64, 'G079', 'laptop', 'Lampu kamera menyala tapi tidak ada gambar', 'Peripheral', '[\"cam nyala tapi hitam\",\"webcam nyala ga ada gambar\",\"led cam nyala tapi gelap\",\"kamera on tapi black\",\"webcam hitam\",\"kamera hitam\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, NULL),
(65, 'G080', 'laptop', 'Kamera terdeteksi tapi error', 'Peripheral', '[\"kamera error\",\"webcam error\",\"kamera ada tapi ga bisa\",\"cam terdeteksi tapi error\",\"kamera code error\",\"webcam not working\"]', NULL, '0.60', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, NULL),
(66, 'G084', 'laptop', 'DVD drive tidak terbaca', 'Peripheral', '[\"dvd ga terbaca\",\"cd ga terbaca\",\"optical drive mati\",\"dvd rom rusak\",\"cd rom rusak\",\"dvd drive error\",\"ga bisa baca cd\",\"ga bisa baca dvd\"]', NULL, '0.60', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, NULL),
(67, 'G085', 'laptop', 'DVD drive tidak bisa eject', 'Peripheral', '[\"dvd ga bisa keluar\",\"cd stuck\",\"eject ga bisa\",\"dvd macet\",\"cd nyangkut\",\"tray dvd rusak\",\"tombol eject ga fungsi\"]', NULL, '0.50', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, NULL),
(68, 'G086', 'laptop', 'Fingerprint tidak berfungsi', 'Peripheral', '[\"fingerprint mati\",\"sidik jari ga bisa\",\"fingerprint rusak\",\"finger print error\",\"sensor sidik jari rusak\",\"fingerprint ga terdeteksi\",\"sidik jari ga kebaca\"]', NULL, '0.60', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, NULL),
(69, 'G141', 'laptop', 'USB Type-C tidak berfungsi', 'Peripheral', '[\"usb c rusak\",\"type c mati\",\"usb-c ga bisa\",\"port type c error\",\"thunderbolt mati\",\"usb c ga terdeteksi\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, NULL),
(70, 'G142', 'laptop', 'USB hanya bisa charging tapi tidak transfer data', 'Peripheral', '[\"usb cuma cas\",\"usb ga bisa transfer\",\"usb charging only\",\"data transfer gagal\",\"usb ga bisa copy file\"]', NULL, '0.60', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, NULL),
(71, 'G143', 'laptop', 'Touchpad scroll tidak berfungsi', 'Peripheral', '[\"scroll touchpad mati\",\"two finger scroll ga bisa\",\"gesture ga jalan\",\"scroll ga bisa\",\"pinch zoom ga bisa\"]', NULL, '0.50', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, NULL),
(72, 'G144', 'laptop', 'Touchpad klik fisik tidak berfungsi', 'Peripheral', '[\"klik touchpad mati\",\"tombol touchpad rusak\",\"klik bawah touchpad ga bisa\",\"tombol mouse mati\",\"physical click ga jalan\"]', NULL, '0.60', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, NULL),
(73, 'G145', 'laptop', 'Webcam gambar terbalik/mirror', 'Peripheral', '[\"kamera terbalik\",\"webcam mirror\",\"gambar kebalik\",\"tampilan kamera terbalik\",\"video call terbalik\"]', NULL, '0.40', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, NULL),
(74, 'G146', 'laptop', 'Port USB 3.0 lambat seperti USB 2.0', 'Peripheral', '[\"usb 3 lambat\",\"usb 3.0 lemot\",\"transfer usb pelan\",\"usb biru lambat\",\"usb 3 ga kenceng\"]', NULL, '0.50', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, NULL),
(75, 'G147', 'laptop', 'Touchpad multi-gesture tidak berfungsi', 'Peripheral', '[\"gesture ga bisa\",\"multi touch ga jalan\",\"three finger ga bisa\",\"swipe ga bisa\",\"gesture touchpad error\"]', NULL, '0.40', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, NULL),
(76, 'G148', 'laptop', 'External monitor terdeteksi tapi blank', 'Peripheral', '[\"monitor luar blank\",\"hdmi detect tapi hitam\",\"extended display black\",\"monitor kedua gelap\",\"second screen blank\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, NULL),
(77, 'G023', 'laptop', 'Laptop mati total', 'Power', '[\"mati total\",\"tidak mau nyala\",\"laptop mati\",\"dead\",\"tidak hidup\",\"tidak menyala\",\"ga bisa nyala\",\"gak bisa nyala\",\"gabisa nyala\",\"tidak bisa menyala\",\"tidak bisa nyala\",\"ga mau nyala\",\"gak mau nyala\",\"ga idup\",\"gak idup\",\"laptop ga nyala\",\"leptop mati\",\"lepi mati\"]', NULL, '1.00', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 10),
(78, 'G024', 'laptop', 'Laptop hanya hidup dengan charger', 'Power', '[\"hanya charger\",\"tanpa baterai\",\"baterai tidak fungsi\",\"hidup pake charger\",\"nyala kalo dicas\",\"baterai ga fungsi\",\"harus colok charger\"]', NULL, '0.80', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 10),
(79, 'G025', 'laptop', 'Baterai tidak mengisi', 'Power', '[\"tidak charging\",\"baterai tidak isi\",\"plugged in not charging\",\"tidak ngecas\",\"ga mau ngecas\",\"cas tidak masuk\",\"tidak bisa dicas\",\"charger tidak berfungsi\",\"ga ngecas\",\"gak ngecas\",\"batre ga ngisi\",\"baterai ga isi\",\"ga bisa dicas\"]', NULL, '0.80', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 10),
(80, 'G026', 'laptop', 'Baterai cepat habis', 'Power', '[\"baterai boros\",\"cepat habis\",\"battery drain\",\"baterai drop\",\"baterai cepat habis\",\"batre boros\",\"batre cepat habis\",\"baterai ngedrop\",\"batre ngedrop\",\"baterai awet sebentar\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 10),
(81, 'G027', 'laptop', 'Charger tidak terdeteksi', 'Power', '[\"charger tidak terbaca\",\"adaptor mati\",\"charger error\",\"charger rusak\",\"charger mati\",\"cas ga masuk\",\"adaptor rusak\"]', NULL, '0.80', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 10),
(82, 'G028', 'laptop', 'Indikator charging berkedip tidak normal', 'Power', '[\"led charging kedip\",\"indikator aneh\",\"lampu cas kedip\",\"led cas kedip-kedip\"]', NULL, '0.60', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 10),
(83, 'G029', 'laptop', 'Laptop mati tiba-tiba saat digunakan', 'Power', '[\"mati tiba-tiba\",\"shutdown sendiri\",\"mati mendadak\",\"tiba-tiba mati\",\"langsung mati\",\"sering mati sendiri\",\"mati sendiri\",\"shutdown tiba-tiba\"]', NULL, '0.80', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 10),
(84, 'G030', 'laptop', 'Adaptor charger normal di laptop lain', 'Power', '[\"adaptor normal\",\"charger ok di laptop lain\",\"charger bisa di laptop lain\",\"adaptor bisa\"]', NULL, '0.90', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 10),
(85, 'G081', 'laptop', 'Baterai kembung/bengkak', 'Power', '[\"baterai kembung\",\"battery kembung\",\"batre bengkak\",\"baterai bengkak\",\"baterai menggelembung\",\"baterai gembung\",\"touchpad naik karena baterai\",\"keyboard naik baterai\"]', NULL, '1.00', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 10),
(86, 'G082', 'laptop', 'Baterai tidak terdeteksi', 'Power', '[\"baterai ga terdeteksi\",\"baterai tidak terdeteksi\",\"no battery detected\",\"baterai hilang\",\"battery ga kebaca\",\"batre ga kedeteksi\"]', NULL, '0.80', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 10),
(87, 'G083', 'laptop', 'Persentase baterai tidak akurat', 'Power', '[\"persentase baterai salah\",\"baterai loncat\",\"baterai ga akurat\",\"battery ga akurat\",\"persen baterai ngaco\",\"baterai tiba-tiba 0\",\"baterai drop langsung\"]', NULL, '0.60', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 10),
(88, 'G088', 'laptop', 'Lampu indikator mati semua', 'Power', '[\"led mati\",\"lampu mati\",\"indikator mati\",\"led ga nyala\",\"lampu power mati\",\"lampu cas mati\",\"tidak ada lampu\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 10),
(89, 'G089', 'laptop', 'Laptop berbunyi beep saat dinyalakan', 'Power', '[\"beep\",\"bunyi beep\",\"beep saat nyala\",\"beep terus\",\"bunyi tit tit\",\"laptop bunyi\",\"beeping\",\"beep code\"]', NULL, '0.80', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 10),
(90, 'G149', 'laptop', 'Laptop nyala sebentar lalu mati lagi', 'Power', '[\"nyala sebentar mati\",\"on off terus\",\"hidup bentar mati\",\"nyala lalu mati\",\"power on terus mati\",\"nyala 3 detik mati\"]', NULL, '0.90', '2026-03-12 15:25:37', '2026-04-01 06:32:19', 1, 10),
(91, 'G150', 'laptop', 'Charger panas berlebihan', 'Power', '[\"charger panas\",\"adaptor panas\",\"charger overheat\",\"adaptor kepanasan\",\"charger panas banget\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, 10),
(92, 'G151', 'laptop', 'Baterai panas saat di-charge', 'Power', '[\"baterai panas\",\"batre panas saat cas\",\"battery hot\",\"baterai gerah\",\"batre overheat saat charging\"]', NULL, '0.80', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, 10),
(93, 'G152', 'laptop', 'Laptop mati saat charger dicabut', 'Power', '[\"mati cabut charger\",\"off saat lepas charger\",\"mati tanpa charger\",\"ga bisa tanpa listrik\"]', NULL, '0.80', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, 10),
(94, 'G153', 'laptop', 'Port charger berbau hangus', 'Power', '[\"port charger bau\",\"dc jack bau\",\"colokan bau hangus\",\"bau terbakar dari port cas\",\"bau gosong port\"]', NULL, '0.90', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, 10),
(95, 'G154', 'laptop', 'Laptop mati saat baterai di bawah 50%', 'Power', '[\"mati 50 persen\",\"mati persen tinggi\",\"baterai mati sebelum habis\",\"mati padahal sisa 40\",\"shutdown di 30 persen\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, 10),
(96, 'G155', 'laptop', 'Charger berdengung', 'Power', '[\"charger bunyi\",\"adaptor berdengung\",\"charger ngik\",\"adaptor buzzing\",\"charger berisik\",\"coil whine charger\"]', NULL, '0.50', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, 10),
(97, 'G156', 'laptop', 'Laptop tidak merespon tombol power', 'Power', '[\"tombol power ga respon\",\"power button mati\",\"tombol nyala rusak\",\"tekan power ga ada reaksi\",\"tombol on off rusak\"]', NULL, '0.90', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, 10),
(98, 'G157', 'laptop', 'Baterai mengisi sangat lambat', 'Power', '[\"cas lambat\",\"charging lama\",\"baterai lama penuh\",\"charge pelan\",\"ngecas lama banget\",\"slow charging\"]', NULL, '0.60', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, 10),
(99, 'G031', 'laptop', 'Laptop blue screen (BSOD)', 'Software', '[\"bsod\",\"blue screen\",\"bluescreen\",\"layar biru\",\"blue screen of death\",\"bsod error\",\"error biru\",\"crash biru\"]', NULL, '0.80', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, NULL),
(100, 'G032', 'laptop', 'Laptop blue screen berulang', 'Software', '[\"bsod berulang\",\"sering bsod\",\"blue screen terus-terusan\",\"bsod berkali-kali\",\"sering crash biru\"]', NULL, '0.90', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, NULL),
(101, 'G033', 'laptop', 'Proses booting sangat lambat', 'Software', '[\"booting lambat\",\"startup lambat\",\"lama nyala\",\"loading lama\",\"booting lama\",\"startup lama\",\"nyala lama\"]', NULL, '0.60', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, NULL),
(102, 'G034', 'laptop', 'Muncul pesan error saat booting', 'Software', '[\"error booting\",\"boot error\",\"pesan error nyala\",\"error saat nyala\",\"bootmgr missing\",\"boot device not found\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, NULL),
(103, 'G035', 'laptop', 'Laptop sering hang/freeze', 'Software', '[\"hang\",\"freeze\",\"not responding\",\"macet\",\"nge-hang\",\"stuck\",\"membeku\",\"laptop macet\",\"ga bisa diapa-apain\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, NULL),
(104, 'G036', 'laptop', 'Windows tidak bisa booting', 'Software', '[\"gagal booting\",\"windows error\",\"ga bisa masuk windows\",\"stuck di logo\",\"tidak bisa masuk\",\"loading terus\",\"ga masuk windows\",\"windows ga jalan\"]', NULL, '0.80', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, NULL),
(105, 'G037', 'laptop', 'Laptop restart sendiri', 'Software', '[\"restart sendiri\",\"reboot sendiri\",\"auto restart\",\"restart terus\",\"tiba-tiba restart\",\"sering restart\"]', NULL, '0.80', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, NULL),
(106, 'G038', 'laptop', 'Aplikasi sering crash/not responding', 'Software', '[\"app crash\",\"aplikasi crash\",\"not responding\",\"program error\",\"aplikasi error\",\"app not responding\",\"force close\"]', NULL, '0.60', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, NULL),
(107, 'G039', 'laptop', 'Laptop terinfeksi virus/malware', 'Software', '[\"virus\",\"malware\",\"kena virus\",\"ada virus\",\"terinfeksi\",\"popup mencurigakan\",\"iklan tiba-tiba\",\"adware\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, NULL),
(108, 'G158', 'laptop', 'Laptop stuck di logo BIOS/UEFI', 'Software', '[\"stuck logo\",\"ga lewat bios\",\"freeze di logo\",\"tidak lanjut dari bios\",\"stuck di splash screen\"]', NULL, '0.80', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, NULL),
(109, 'G159', 'laptop', 'Muncul pesan \"Operating System Not Found\"', 'Software', '[\"os not found\",\"operating system not found\",\"no bootable device\",\"boot device not found\",\"no os\"]', NULL, '0.90', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, NULL),
(110, 'G160', 'laptop', 'Laptop masuk Safe Mode terus', 'Software', '[\"safe mode terus\",\"selalu safe mode\",\"stuck safe mode\",\"hanya bisa safe mode\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, NULL),
(111, 'G161', 'laptop', 'Driver sering bermasalah setelah update', 'Software', '[\"driver error update\",\"driver crash setelah update\",\"BSOD setelah update\",\"windows update error\"]', NULL, '0.60', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, NULL),
(112, 'G162', 'laptop', 'Task Manager menunjukkan disk usage 100%', 'Software', '[\"disk 100\",\"disk usage tinggi\",\"disk penuh di task manager\",\"disk 100 persen\",\"high disk usage\"]', NULL, '0.60', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, NULL),
(113, 'G163', 'laptop', 'Muncul pesan \"Preparing Automatic Repair\" berulang', 'Software', '[\"automatic repair\",\"preparing repair\",\"stuck repair\",\"loop repair\",\"repair terus\"]', NULL, '0.80', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, NULL),
(114, 'G164', 'laptop', 'File dan folder tiba-tiba hilang atau terenkripsi', 'Software', '[\"file hilang\",\"file terenkripsi\",\"ransomware\",\"data terkunci\",\"file tidak bisa dibuka\",\"encrypted\",\"file berubah ekstensi\"]', NULL, '0.90', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, NULL),
(115, 'G165', 'laptop', 'Windows License expired / not activated', 'Software', '[\"windows not activated\",\"lisensi habis\",\"activate windows\",\"watermark activate\",\"windows ga aktif\"]', NULL, '0.40', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, NULL),
(116, 'G166', 'laptop', 'Registry error atau corrupt', 'Software', '[\"registry error\",\"registry corrupt\",\"registry rusak\",\"regedit error\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, NULL),
(117, 'G167', 'laptop', 'Laptop tidak bisa install ulang OS', 'Software', '[\"gagal install\",\"install error\",\"disk tidak terbaca saat install\",\"install os gagal\"]', NULL, '0.80', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, NULL),
(118, 'G168', 'laptop', 'Sistem operasi corrupt setelah power loss', 'Software', '[\"corrupt setelah mati\",\"os rusak setelah mati listrik\",\"windows corrupt mati tiba-tiba\",\"file system error\"]', NULL, '0.70', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, NULL),
(119, 'G040', 'laptop', 'Laptop sangat lambat', 'Performance', '[\"laptop lambat\",\"lemot\",\"slow\",\"laptop pelan\",\"lelet\",\"lamban\",\"loading lama\",\"laptop lama\",\"laptop berat\",\"lag\"]', NULL, '0.60', '2026-03-12 15:25:37', '2026-04-01 06:32:20', 1, 12),
(120, 'G041', 'laptop', 'RAM sering penuh', 'Performance', '[\"ram penuh\",\"ram habis\",\"memory full\",\"out of memory\",\"pemakaian ram tinggi\",\"ram usage 100\",\"ram tinggi\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 12),
(121, 'G042', 'laptop', 'CPU usage selalu tinggi', 'Performance', '[\"cpu tinggi\",\"cpu 100%\",\"processor full\",\"cpu usage tinggi\",\"cpu overload\",\"prosesor tinggi\",\"cpu selalu 100\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 12),
(122, 'G043', 'laptop', 'Laptop lag saat multitasking', 'Performance', '[\"lag multitask\",\"lemot banyak app\",\"lambat banyak tab\",\"hang banyak program\",\"lag buka banyak\"]', NULL, '0.60', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 12),
(123, 'G044', 'laptop', 'Startup lambat lebih dari 5 menit', 'Performance', '[\"startup lambat\",\"booting lama\",\"booting lambat\",\"loading awal lama\",\"nyala lama banget\"]', NULL, '0.60', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 12),
(124, 'G045', 'laptop', 'Aplikasi berat tidak bisa dijalankan', 'Performance', '[\"app ga jalan\",\"aplikasi berat error\",\"ga bisa buka app berat\",\"minimum requirement\",\"spek kurang\"]', NULL, '0.50', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 12),
(125, 'G169', 'laptop', 'Fan laptop berputar kencang terus-menerus', 'Performance', '[\"fan kencang\",\"kipas berisik terus\",\"fan full speed\",\"kipas ngebut terus\",\"fan ga berhenti\"]', NULL, '0.60', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 12),
(126, 'G170', 'laptop', 'Game stuttering atau FPS drop', 'Performance', '[\"fps drop\",\"game lag\",\"stuttering\",\"game patah-patah\",\"fps rendah\",\"game ngelag\",\"frame drop\"]', NULL, '0.60', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 12),
(127, 'G171', 'laptop', 'Laptop freeze beberapa detik secara berkala', 'Performance', '[\"freeze berkala\",\"hang sebentar-sebentar\",\"micro freeze\",\"stutter berkala\",\"lag periodic\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 12),
(128, 'G172', 'laptop', 'Laptop throttling (performa turun saat panas)', 'Performance', '[\"throttling\",\"performa turun panas\",\"clock speed turun\",\"cpu turun kecepatan\",\"thermal throttle\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 12),
(129, 'G173', 'laptop', 'Waktu render/export sangat lama', 'Performance', '[\"render lama\",\"export lama\",\"encoding lambat\",\"render berjam-jam\",\"proses lama\"]', NULL, '0.50', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 12),
(130, 'G174', 'laptop', 'Laptop lama saat copy/paste file besar', 'Performance', '[\"copy lambat\",\"transfer file lama\",\"salin file lambat\",\"copy paste lama\",\"file transfer pelan\"]', NULL, '0.60', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 12),
(131, 'G175', 'laptop', 'Browser sangat lambat atau sering crash', 'Performance', '[\"browser lambat\",\"chrome lemot\",\"browser crash\",\"firefox lambat\",\"edge crash\",\"browser hang\"]', NULL, '0.50', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 12),
(132, 'G176', 'laptop', 'Indexing Windows berjalan terus-menerus', 'Performance', '[\"indexing terus\",\"windows search lambat\",\"indexer disk usage\",\"indexing service\"]', NULL, '0.50', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 12),
(133, 'G177', 'laptop', 'Banyak program berjalan di background', 'Performance', '[\"banyak program background\",\"startup program banyak\",\"terlalu banyak app jalan\"]', NULL, '0.50', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 12),
(134, 'G178', 'laptop', 'Laptop lemot setelah beberapa jam digunakan', 'Performance', '[\"lemot setelah lama\",\"makin lama makin lambat\",\"awalnya cepat lalu lambat\",\"degradasi performa\"]', NULL, '0.60', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 12),
(135, 'G046', 'laptop', 'Laptop panas berlebihan (overheat)', 'Thermal', '[\"panas\",\"overheat\",\"kepanasan\",\"laptop panas\",\"laptop gerah\",\"panas banget\",\"suhu tinggi\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 15),
(136, 'G047', 'laptop', 'Fan/kipas tidak berputar', 'Thermal', '[\"kipas mati\",\"fan mati\",\"kipas tidak jalan\",\"fan tidak putar\",\"kipas ga jalan\",\"fan diam\"]', NULL, '0.90', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 15),
(137, 'G048', 'laptop', 'Fan berbunyi keras/berisik', 'Thermal', '[\"kipas berisik\",\"fan bunyi\",\"kipas bunyi\",\"fan kasar\",\"kipas keras\",\"fan grinding\",\"fan noise\"]', NULL, '0.60', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 15),
(138, 'G049', 'laptop', 'Laptop mati karena overheat', 'Thermal', '[\"mati panas\",\"shutdown overheat\",\"mati kepanasan\",\"overheat shutdown\",\"mati karena panas\"]', NULL, '0.90', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 15),
(139, 'G179', 'laptop', 'Suhu CPU di atas 90°C saat idle', 'Thermal', '[\"suhu tinggi idle\",\"cpu panas idle\",\"temp tinggi saat ga ngapa-ngapain\",\"overheat idle\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 15),
(140, 'G180', 'laptop', 'Thermal paste sudah kering/lama tidak diganti', 'Thermal', '[\"thermal paste kering\",\"pasta termal lama\",\"belum ganti thermal paste\",\"pasta lama\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 15),
(141, 'G181', 'laptop', 'Ventilasi laptop tersumbat debu', 'Thermal', '[\"ventilasi kotor\",\"debu banyak\",\"lubang angin tersumbat\",\"ventilasi tertutup debu\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 15),
(142, 'G182', 'laptop', 'Laptop panas di area tertentu saja', 'Thermal', '[\"panas di satu titik\",\"panas di kiri\",\"panas di tengah\",\"hot spot\",\"area tertentu panas\"]', NULL, '0.60', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 15),
(143, 'G183', 'laptop', 'Heatsink terasa longgar/tidak rapat', 'Thermal', '[\"heatsink longgar\",\"heatsink lepas\",\"heatsink ga nempel\",\"pendingin ga rapat\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 15),
(144, 'G184', 'laptop', 'Performa turun drastis saat panas', 'Thermal', '[\"performa turun panas\",\"throttle saat panas\",\"lag saat panas\",\"lemot karena panas\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 15),
(145, 'G185', 'laptop', 'Fan berhenti lalu berputar lagi secara acak', 'Thermal', '[\"fan on off\",\"kipas hidup mati\",\"fan intermittent\",\"kipas kadang jalan kadang mati\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 15),
(146, 'G186', 'laptop', 'Bau hangus dari area ventilasi', 'Thermal', '[\"bau hangus\",\"bau terbakar dari kipas\",\"bau gosong dari ventilasi\",\"asap dari laptop\"]', NULL, '0.90', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 15),
(147, 'G187', 'laptop', 'Laptop panas saat charging', 'Thermal', '[\"panas saat cas\",\"overheat saat charging\",\"gerah saat dicas\",\"panas waktu ngecas\"]', NULL, '0.60', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 15),
(148, 'G188', 'laptop', 'Heatpipe terlihat penyok atau rusak', 'Thermal', '[\"heatpipe penyok\",\"heat pipe bengkok\",\"heatpipe rusak\",\"pipa panas rusak\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 15),
(149, 'G050', 'laptop', 'Speaker laptop tidak ada suara', 'Audio', '[\"speaker mati\",\"ga ada suara\",\"tidak ada suara\",\"suara mati\",\"speaker ga bunyi\",\"audio mati\",\"sound mati\",\"laptop bisu\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 14),
(150, 'G051', 'laptop', 'Speaker laptop pecah/distorsi', 'Audio', '[\"suara pecah\",\"speaker pecah\",\"distorsi\",\"suara jelek\",\"speaker distorsi\",\"suara burik\",\"suara pecah-pecah\",\"kresek\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 14),
(151, 'G052', 'laptop', 'Jack audio/headphone tidak berfungsi', 'Audio', '[\"jack mati\",\"jack ga fungsi\",\"headphone ga bunyi\",\"headset ga kebaca\",\"colokan audio rusak\",\"jack audio rusak\",\"headphone jack\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 14),
(152, 'G053', 'laptop', 'Microphone tidak berfungsi', 'Audio', '[\"mic mati\",\"microphone ga fungsi\",\"mic ga kebaca\",\"mic rusak\",\"microphone tidak berfungsi\",\"mic ga bisa\",\"mic error\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 14),
(153, 'G054', 'laptop', 'Suara keluar dari satu speaker saja', 'Audio', '[\"suara sebelah\",\"speaker satu mati\",\"hanya kiri\",\"hanya kanan\",\"audio mono\",\"speaker kiri mati\",\"speaker kanan mati\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 14),
(154, 'G055', 'laptop', 'Volume sangat kecil meski sudah maksimal', 'Audio', '[\"volume kecil\",\"suara kecil\",\"volume max tapi kecil\",\"speaker pelan\",\"suara kurang keras\"]', NULL, '0.60', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 14),
(155, 'G056', 'laptop', 'Audio delay/lag', 'Audio', '[\"suara delay\",\"audio telat\",\"lag suara\",\"delay audio\",\"audio ga sinkron\",\"suara lambat\"]', NULL, '0.50', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 14),
(156, 'G057', 'laptop', 'Suara noise/static dari speaker', 'Audio', '[\"suara noise\",\"suara mendesis\",\"static\",\"suara berdesis\",\"white noise\",\"suara sssss\",\"noise dari speaker\"]', NULL, '0.60', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 14),
(157, 'G058', 'laptop', 'Speaker tiba-tiba mati lalu hidup lagi', 'Audio', '[\"speaker intermittent\",\"suara putus-putus\",\"audio on off\",\"speaker kadang bunyi kadang mati\",\"suara hilang timbul\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 14),
(158, 'G189', 'laptop', 'Audio terdeteksi tapi tidak keluar suara', 'Audio', '[\"detected no sound\",\"driver ok tapi mati\",\"di setting ada tapi ga bunyi\",\"audio device ok no sound\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 14),
(159, 'G190', 'laptop', 'Bluetooth audio tidak bisa connect', 'Audio', '[\"bluetooth audio gagal\",\"headset bt ga konek\",\"wireless audio error\",\"speaker bt ga connect\"]', NULL, '0.60', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 14),
(160, 'G191', 'laptop', 'Suara echo/gema saat panggilan', 'Audio', '[\"echo saat call\",\"gema saat telepon\",\"suara dobel\",\"suara mengulang\",\"feedback audio\"]', NULL, '0.50', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 14),
(161, 'G192', 'laptop', 'Audio device not recognized', 'Audio', '[\"audio not recognized\",\"perangkat audio tidak dikenali\",\"sound card not found\",\"audio ga kebaca\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 14),
(162, 'G193', 'laptop', 'Suara terdengar robotik/terdistorsi saat voice call', 'Audio', '[\"suara robotik\",\"suara robotic\",\"suara patah-patah call\",\"audio pecah saat call\"]', NULL, '0.50', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 14),
(163, 'G194', 'laptop', 'Suara hanya keluar jika jack audio digoyang', 'Audio', '[\"jack goyang baru bunyi\",\"goyang jack baru ada suara\",\"jack harus ditekan\",\"posisi tertentu baru bunyi\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 14),
(164, 'G195', 'laptop', 'Microphone menangkap suara terlalu sensitif', 'Audio', '[\"mic terlalu sensitif\",\"mic brisik\",\"background noise mic\",\"mic tangkap semua suara\"]', NULL, '0.40', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 14),
(165, 'G196', 'laptop', 'Bass atau treble tidak terdengar', 'Audio', '[\"bass hilang\",\"treble hilang\",\"suara ga ada bass\",\"suara tipis\",\"suara flat\"]', NULL, '0.50', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 14),
(166, 'G197', 'laptop', 'Audio crackling saat volume tinggi', 'Audio', '[\"crackling\",\"suara retak volume tinggi\",\"pecah di volume tinggi\",\"audio crack\"]', NULL, '0.60', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, 14),
(167, 'G060', 'laptop', 'Hard drive tidak terdeteksi di BIOS', 'Storage', '[\"hdd ga kedeteksi\",\"ssd ga kedeteksi\",\"storage ga terbaca\",\"disk ga muncul di bios\",\"hard drive hilang dari bios\"]', NULL, '0.90', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(168, 'G061', 'laptop', 'Bunyi klik-klik dari hard drive', 'Storage', '[\"bunyi klik\",\"hdd bunyi\",\"klik klik\",\"hard disk bunyi\",\"clicking sound\",\"hdd click\"]', NULL, '0.90', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(169, 'G062', 'laptop', 'Data corrupt/tidak bisa diakses', 'Storage', '[\"data rusak\",\"file corrupt\",\"ga bisa buka file\",\"data hilang\",\"file error\",\"data ga bisa diakses\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(170, 'G063', 'laptop', 'Hard drive sangat lambat', 'Storage', '[\"hdd lambat\",\"ssd lambat\",\"disk pelan\",\"storage lambat\",\"loading dari disk lama\"]', NULL, '0.60', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(171, 'G198', 'laptop', 'Muncul pesan SMART warning', 'Storage', '[\"smart warning\",\"smart error\",\"disk failure predicted\",\"smart caution\",\"smart bad\"]', NULL, '0.90', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(172, 'G199', 'laptop', 'Hard drive terdeteksi dengan kapasitas salah', 'Storage', '[\"kapasitas salah\",\"hdd size salah\",\"ssd kapasitas beda\",\"disk ukuran ga sesuai\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(173, 'G200', 'laptop', 'Muncul bad sector di disk check', 'Storage', '[\"bad sector\",\"bad block\",\"chkdsk error\",\"disk check error\",\"sector rusak\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(174, 'G201', 'laptop', 'SSD tiba-tiba read-only / tidak bisa ditulis', 'Storage', '[\"ssd read only\",\"ga bisa nulis\",\"write protected\",\"ssd ga bisa simpan\",\"disk write error\"]', NULL, '0.90', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(175, 'G202', 'laptop', 'Laptop booting lama saat load dari disk', 'Storage', '[\"boot dari disk lama\",\"loading os lambat\",\"splash screen lama\",\"disk booting lambat\"]', NULL, '0.60', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(176, 'G203', 'laptop', 'Partisi hilang atau tidak terlihat', 'Storage', '[\"partisi hilang\",\"drive D hilang\",\"partisi ga muncul\",\"disk management kosong\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(177, 'G204', 'laptop', 'File sering corrupt saat disalin', 'Storage', '[\"file rusak saat copy\",\"corrupt saat transfer\",\"file error habis copy\",\"data korup download\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(178, 'G205', 'laptop', 'Hard drive terdeteksi lalu hilang berulang kali', 'Storage', '[\"hdd connect disconnect\",\"disk on off\",\"storage intermittent\",\"hdd kadang kebaca kadang ngga\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(179, 'G206', 'laptop', 'Muncul pesan \"Disk Boot Failure\"', 'Storage', '[\"disk boot failure\",\"insert system disk\",\"disk error boot\"]', NULL, '0.90', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(180, 'G207', 'laptop', 'Suhu hard drive/SSD sangat panas', 'Storage', '[\"disk panas\",\"ssd panas\",\"hdd temp tinggi\",\"storage overheat\"]', NULL, '0.60', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(181, 'G208', 'laptop', 'Menulis ke disk sangat lambat', 'Storage', '[\"write lambat\",\"nulis data pelan\",\"save file lama\",\"copy ke disk lambat\"]', NULL, '0.60', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(182, 'G209', 'laptop', 'Disk usage 100% di Task Manager secara konstan', 'Storage', '[\"disk 100 task manager\",\"disk usage penuh\",\"disk terus 100\",\"disk aktif terus\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(183, 'G070', 'laptop', 'Casing laptop retak/pecah', 'Physical', '[\"casing retak\",\"body pecah\",\"casing pecah\",\"cover retak\",\"laptop pecah\",\"casing patah\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(184, 'G071', 'laptop', 'Engsel/hinge laptop rusak', 'Physical', '[\"engsel rusak\",\"hinge rusak\",\"engsel patah\",\"engsel lepas\",\"hinge patah\",\"engsel longgar\",\"hinge longgar\",\"engsel ga bisa\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(185, 'G072', 'laptop', 'Layar laptop goyang/tidak stabil', 'Physical', '[\"layar goyang\",\"layar goyah\",\"layar ga stabil\",\"layar lepas\",\"layar gerak sendiri\",\"layar bolak balik\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(186, 'G073', 'laptop', 'Laptop berbunyi saat dibuka/ditutup', 'Physical', '[\"bunyi engsel\",\"engsel bunyi\",\"krek krek engsel\",\"bunyi saat buka tutup\",\"engsel berisik\"]', NULL, '0.50', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(187, 'G074', 'laptop', 'Screw/baut hilang atau rusak', 'Physical', '[\"baut hilang\",\"screw lepas\",\"sekrup hilang\",\"baut rusak\",\"mur hilang\"]', NULL, '0.40', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(188, 'G075', 'laptop', 'Karet kaki laptop hilang/lepas', 'Physical', '[\"karet hilang\",\"kaki lepas\",\"rubber feet hilang\",\"karet bawah lepas\"]', NULL, '0.30', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL);
INSERT INTO `symptoms` (`id`, `code`, `device_type`, `name`, `category`, `keywords`, `follow_up_question`, `weight`, `created_at`, `updated_at`, `device_type_id`, `device_component_id`) VALUES
(189, 'G076', 'laptop', 'Palmrest/bagian tangan retak', 'Physical', '[\"palmrest retak\",\"tempat tangan retak\",\"palm rest pecah\",\"palmrest patah\"]', NULL, '0.60', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(190, 'G077', 'laptop', 'Cover bawah laptop lepas/tidak rapat', 'Physical', '[\"cover lepas\",\"tutup bawah lepas\",\"bottom case longgar\",\"cover bawah ga rapat\"]', NULL, '0.50', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(191, 'G210', 'laptop', 'Kabel LCD terlihat saat membuka layar', 'Physical', '[\"kabel lcd terlihat\",\"kabel layar keluar\",\"kawat layar terlihat\",\"kabel terekspos\"]', NULL, '0.60', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(192, 'G211', 'laptop', 'Bezel layar lepas atau retak', 'Physical', '[\"bezel lepas\",\"frame layar lepas\",\"bezel retak\",\"pinggiran layar lepas\",\"bezel patah\"]', NULL, '0.60', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(193, 'G212', 'laptop', 'Lubang ventilasi pecah atau patah', 'Physical', '[\"ventilasi pecah\",\"grill rusak\",\"lubang angin patah\",\"ventilasi patah\"]', NULL, '0.50', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(194, 'G213', 'laptop', 'Keyboard deck melengkung/berubah bentuk', 'Physical', '[\"keyboard deck bengkok\",\"palmrest bengkok\",\"deck melengkung\",\"body bengkok\",\"casing deformasi\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(195, 'G214', 'laptop', 'Logo atau stiker mengelupas', 'Physical', '[\"logo lepas\",\"stiker hilang\",\"emblem copot\",\"branding mengelupas\"]', NULL, '0.20', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(196, 'G215', 'laptop', 'Port cover/penutup port rusak', 'Physical', '[\"port cover lepas\",\"penutup port hilang\",\"cover port rusak\",\"dust cover lepas\"]', NULL, '0.30', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(197, 'G216', 'laptop', 'Engsel patah sampai casing terangkat', 'Physical', '[\"engsel angkat casing\",\"casing ikut terangkat\",\"hinge patah angkat body\",\"engsel sampai pecah\"]', NULL, '0.90', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(198, 'G217', 'laptop', 'Slot RAM/HDD cover rusak', 'Physical', '[\"cover ram rusak\",\"slot hdd cover lepas\",\"tutup ram patah\",\"penutup ram rusak\"]', NULL, '0.50', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(199, 'G218', 'laptop', 'Laptop berderit saat ditekan di area tertentu', 'Physical', '[\"laptop berderit\",\"body bunyi\",\"casing bunyi ditekan\",\"laptop krek saat dipegang\"]', NULL, '0.40', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(200, 'G219', 'laptop', 'Cat atau coating laptop mengelupas', 'Physical', '[\"cat mengelupas\",\"coating lepas\",\"warna laptop luntur\",\"soft touch lepas\",\"peeling\"]', NULL, '0.30', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(201, 'G090', 'laptop', 'Laptop terkena air/tumpahan cairan', 'Water', '[\"kena air\",\"tumpahan\",\"kecipratan\",\"kena kopi\",\"ketumpahan\",\"terkena cairan\",\"tumpahan air\",\"kena teh\",\"kena minum\",\"basah\"]', NULL, '0.90', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(202, 'G091', 'laptop', 'Keyboard tidak berfungsi setelah terkena air', 'Water', '[\"keyboard mati kena air\",\"tombol mati setelah basah\",\"keyboard error setelah tumpahan\"]', NULL, '0.90', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(203, 'G092', 'laptop', 'Laptop mati setelah terkena air', 'Water', '[\"mati setelah kena air\",\"mati basah\",\"laptop mati kena cairan\",\"short setelah tumpahan\"]', NULL, '1.00', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(204, 'G093', 'laptop', 'Layar berembun dari dalam', 'Water', '[\"embun di layar\",\"layar berembun\",\"fog di lcd\",\"uap di layar\",\"embun dalam layar\",\"layar berkabut\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(205, 'G094', 'laptop', 'Muncul korosi/karat pada komponen', 'Water', '[\"korosi\",\"karat\",\"karatan\",\"komponen berkarat\",\"korosi motherboard\",\"oksidasi\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(206, 'G095', 'laptop', 'Beberapa tombol lengket setelah terkena cairan', 'Water', '[\"tombol lengket air\",\"sticky setelah tumpahan\",\"keyboard lengket basah\",\"tombol nempel\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(207, 'G096', 'laptop', 'Port USB/charging berkarat', 'Water', '[\"port karat\",\"usb berkarat\",\"port korosi\",\"port charging karat\",\"port berubah warna\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(208, 'G097', 'laptop', 'Laptop menyala tapi ada komponen bermasalah', 'Water', '[\"nyala sebagian\",\"beberapa fungsi mati\",\"komponen mati sebagian\",\"nyala tapi ada yg rusak\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(209, 'G220', 'laptop', 'Ada bekas air atau noda di dalam laptop', 'Water', '[\"noda air dalam\",\"bekas air\",\"water stain\",\"bekas tumpahan dalam\"]', NULL, '0.60', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(210, 'G221', 'laptop', 'Indikator kelembaban berubah warna', 'Water', '[\"stiker kelembaban\",\"moisture indicator\",\"kelembaban tinggi\",\"LCI berubah\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(211, 'G222', 'laptop', 'Bau tidak sedap dari laptop (bau lembab)', 'Water', '[\"bau lembab\",\"bau apek\",\"bau aneh\",\"bau air\",\"bau tidak sedap dari laptop\"]', NULL, '0.50', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(212, 'G223', 'laptop', 'Touchpad tidak responsif setelah terkena air', 'Water', '[\"touchpad mati air\",\"touchpad error basah\",\"touchpad ga jalan kena air\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(213, 'G224', 'laptop', 'Laptop menyala lalu mati berulang kali setelah terkena air', 'Water', '[\"on off setelah basah\",\"restart kena air\",\"mati nyala kena cairan\"]', NULL, '0.90', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(214, 'G225', 'laptop', 'Speaker mendengung setelah terkena air', 'Water', '[\"speaker dengung air\",\"suara berdengung basah\",\"speaker aneh kena air\"]', NULL, '0.60', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(215, 'G226', 'laptop', 'Komponen internal terlihat hijau/berubah warna', 'Water', '[\"komponen hijau\",\"motherboard hijau\",\"korosi hijau\",\"verdigris\",\"patina\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(216, 'G227', 'laptop', 'LCD menunjukkan bercak air/water spots', 'Water', '[\"lcd bercak\",\"water spot lcd\",\"bintik air di layar\",\"watermark lcd\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(217, 'G098', 'laptop', 'Laptop hidup tapi layar gelap total (no display)', 'Hardware', '[\"layar gelap hidup\",\"no display\",\"layar hitam tapi hidup\",\"nyala tapi ga ada tampilan\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(218, 'G228', 'laptop', 'Laptop tidak merespon apapun saat dinyalakan', 'Hardware', '[\"ga respon\",\"no response\",\"mati suri\",\"nyala tapi ga bisa apa-apa\",\"dead board\"]', NULL, '0.90', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(219, 'G229', 'laptop', 'VGA/GPU artifacts muncul di layar', 'Hardware', '[\"artifacts\",\"kotak-kotak warna\",\"garis acak warna\",\"gpu error\",\"vga error\",\"pixel warna-warni\"]', NULL, '0.90', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(220, 'G230', 'laptop', 'Slot RAM tidak terdeteksi', 'Hardware', '[\"slot ram mati\",\"ram slot 2 ga kebaca\",\"satu slot ram ga fungsi\",\"dimm ga kedeteksi\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(221, 'G231', 'laptop', 'USB/port tertentu tidak berfungsi padahal lainnya normal', 'Hardware', '[\"satu port mati\",\"port tertentu error\",\"sebagian port ga jalan\",\"port lain normal\"]', NULL, '0.60', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(222, 'G232', 'laptop', 'BIOS tidak menyimpan pengaturan (reset terus)', 'Hardware', '[\"bios reset\",\"cmos reset\",\"tanggal selalu reset\",\"setting bios hilang\",\"bios ga nyimpan\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(223, 'G233', 'laptop', 'Laptop mengeluarkan bau komponen terbakar', 'Hardware', '[\"bau terbakar\",\"bau gosong\",\"komponen terbakar\",\"bau hangus dari dalam\"]', NULL, '0.90', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(224, 'G234', 'laptop', 'Tampilan tiba-tiba freeze lalu layar mati', 'Hardware', '[\"freeze lalu mati\",\"display crash\",\"tampilan beku lalu gelap\",\"layar freeze mati\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(225, 'G235', 'laptop', 'Laptop tidak bisa detect RAM baru yang dipasang', 'Hardware', '[\"ram baru ga kebaca\",\"upgrade ram ga detect\",\"ram ga terbaca\",\"ram baru tidak kompatibel\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(226, 'G236', 'laptop', 'POST (Power-On Self-Test) gagal', 'Hardware', '[\"post fail\",\"post error\",\"gagal post\",\"bios ga lanjut\",\"beep code error\"]', NULL, '0.90', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(227, 'G237', 'laptop', 'Chipset motherboard terasa sangat panas', 'Hardware', '[\"chipset panas\",\"ic panas\",\"komponen motherboard panas\",\"mosfet panas\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(228, 'G238', 'laptop', 'Laptop hanya menampilkan layar putih total saat nyala', 'Hardware', '[\"layar putih total\",\"white screen boot\",\"layar putih saat nyala\",\"monitor putih\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(229, 'G239', 'laptop', 'Voltase motherboard tidak stabil (diukur dengan multimeter)', 'Hardware', '[\"voltase ga stabil\",\"voltase drop\",\"power rail error\",\"tegangan ga stabil\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(230, 'G240', 'laptop', 'WiFi + Bluetooth + USB mati semua bersamaan', 'Hardware', '[\"semua port mati\",\"wifi bt usb mati\",\"peripheral semua mati\",\"io mati semua\"]', NULL, '0.90', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(231, 'G099', 'laptop', 'Masalah terjadi setelah jatuh/benturan', 'Differential', '[\"jatuh\",\"kebentur\",\"terbentur\",\"terjatuh\",\"drop\",\"benturan\",\"kena pukul\",\"laptop jatuh\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(232, 'G100', 'laptop', 'Masalah terjadi setelah install software', 'Differential', '[\"setelah install\",\"habis install\",\"install baru\",\"update software\",\"install program\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(233, 'G101', 'laptop', 'Masalah terjadi secara bertahap (makin parah)', 'Differential', '[\"makin parah\",\"bertahap\",\"pelan-pelan\",\"progressive\",\"makin buruk\",\"lama-lama\"]', NULL, '0.60', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(234, 'G102', 'laptop', 'Masalah terjadi tiba-tiba tanpa tanda', 'Differential', '[\"tiba-tiba\",\"mendadak\",\"tanpa tanda\",\"tau-tau\",\"langsung\",\"tanpa peringatan\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(235, 'G103', 'laptop', 'Masalah muncul di mode Safe Mode juga', 'Differential', '[\"safe mode juga\",\"tetep di safe mode\",\"masih error di safe mode\",\"safe mode ga ngaruh\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(236, 'G104', 'laptop', 'Masalah hilang di Safe Mode', 'Differential', '[\"hilang di safe mode\",\"normal di safe mode\",\"di safe mode bagus\",\"safe mode ok\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(237, 'G105', 'laptop', 'Masalah terjadi setelah update Windows', 'Differential', '[\"setelah update windows\",\"habis update\",\"windows update\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(238, 'G106', 'laptop', 'Masalah muncul saat laptop panas', 'Differential', '[\"muncul saat panas\",\"error kalau panas\",\"masalah saat overheat\",\"kalo panas\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(239, 'G241', 'laptop', 'Masalah hanya muncul saat menggunakan baterai', 'Differential', '[\"hanya baterai\",\"masalah tanpa charger\",\"error saat baterai\",\"baterai aja error\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(240, 'G242', 'laptop', 'Masalah hanya muncul saat menggunakan charger', 'Differential', '[\"hanya charger\",\"error pakai charger\",\"masalah saat dicas\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(241, 'G243', 'laptop', 'Masalah terjadi di semua OS termasuk bootable USB', 'Differential', '[\"error semua os\",\"di linux juga error\",\"di usb boot juga\",\"bios juga error\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(242, 'G244', 'laptop', 'Masalah hanya di satu OS tertentu', 'Differential', '[\"hanya di windows\",\"cuma di os ini\",\"di linux normal\",\"di os lain bagus\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(243, 'G245', 'laptop', 'External monitor berfungsi normal', 'Differential', '[\"monitor external ok\",\"tampil di external\",\"hdmi normal\",\"external bagus\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(244, 'G246', 'laptop', 'External monitor juga bermasalah', 'Differential', '[\"external juga error\",\"monitor luar juga\",\"hdmi juga error\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(245, 'G247', 'laptop', 'RAM lolos tes memtest', 'Differential', '[\"memtest ok\",\"ram test pass\",\"ram tes normal\",\"memtest86 ok\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(246, 'G248', 'laptop', 'RAM gagal tes memtest', 'Differential', '[\"memtest fail\",\"ram test gagal\",\"memtest error\",\"ram error memtest\"]', NULL, '0.90', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(247, 'G249', 'laptop', 'Masalah terjadi setelah upgrade komponen', 'Differential', '[\"setelah upgrade\",\"habis ganti\",\"setelah tambah ram\",\"setelah ganti ssd\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(248, 'G250', 'laptop', 'Masalah terjadi pada posisi layar tertentu', 'Differential', '[\"posisi layar tertentu\",\"kalau layar dibuka ya\",\"sudut tertentu error\",\"posisi engsel\"]', NULL, '0.80', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(249, 'G251', 'laptop', 'Masalah terjadi saat laptop digerakkan/digoyang', 'Differential', '[\"digoyang error\",\"gerakan bikin error\",\"saat dipindah bermasalah\",\"kena getaran\"]', NULL, '0.70', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(250, 'G252', 'laptop', 'BIOS sudah di-reset tapi masalah tetap', 'Differential', '[\"reset bios ga ngaruh\",\"bios default sama aja\",\"load default ga mempan\"]', NULL, '0.60', '2026-03-12 15:25:38', '2026-04-01 06:32:20', 1, NULL),
(251, 'PCG001', 'pc', 'PC tidak mau menyala sama sekali', 'PSU', '[\"pc mati total\",\"tidak nyala\",\"no power\",\"dead pc\",\"power button tidak respon\",\"tombol power mati\"]', NULL, '1.00', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 16),
(252, 'PCG002', 'pc', 'PC mati tiba-tiba saat digunakan', 'PSU', '[\"mati mendadak\",\"shutdown tiba-tiba\",\"mati sendiri\",\"auto off\",\"padam\",\"pc tiba-tiba mati\"]', NULL, '0.90', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 16),
(253, 'PCG003', 'pc', 'PC restart sendiri berulang kali', 'PSU', '[\"restart sendiri\",\"reboot terus\",\"auto restart\",\"pc restart random\",\"reboot loop\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 16),
(254, 'PCG004', 'pc', 'Kipas PSU tidak berputar saat PC dinyalakan', 'PSU', '[\"fan psu mati\",\"kipas psu diam\",\"psu fan tidak jalan\",\"exhaust psu mati\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 16),
(255, 'PCG005', 'pc', 'Ada bau terbakar dari area PSU', 'PSU', '[\"bau psu\",\"bau hangus power supply\",\"bau gosong belakang pc\",\"burnt smell psu\"]', NULL, '1.00', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 16),
(256, 'PCG006', 'pc', 'PSU berbunyi aneh (dengung/berdecit)', 'PSU', '[\"psu bunyi\",\"power supply berisik\",\"psu noise\",\"dengung psu\",\"psu berdecit\",\"suara psu\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 16),
(257, 'PCG007', 'pc', 'PC menyala sebentar lalu langsung mati', 'PSU', '[\"nyala sebentar mati\",\"hidup bentar off\",\"flash power\",\"on sebentar off\"]', NULL, '0.90', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 16),
(258, 'PCG008', 'pc', 'PC mati hanya saat beban CPU/GPU tinggi', 'PSU', '[\"mati saat gaming\",\"shutdown rendering\",\"mati saat load berat\",\"off saat full load\"]', NULL, '0.90', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 16),
(259, 'PCG009', 'pc', 'Kabel 24-pin ATX tidak terpasang sempurna', 'PSU', '[\"24 pin longgar\",\"kabel motherboard longgar\",\"atx connector lepas\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 16),
(260, 'PCG010', 'pc', 'Kabel 8-pin EPS CPU power longgar', 'PSU', '[\"8 pin cpu longgar\",\"eps power lepas\",\"cpu power tidak terpasang\",\"kabel cpu longgar\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 16),
(261, 'PCG011', 'pc', 'Kabel PCIe power GPU tidak terpasang', 'PSU', '[\"pcie power lepas\",\"kabel gpu power longgar\",\"8 pin gpu tidak terpasang\",\"6+2 pin gpu\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 16),
(262, 'PCG012', 'pc', 'Voltase PSU tidak stabil (terdeteksi software)', 'PSU', '[\"voltase tidak stabil\",\"voltage fluctuation\",\"vcore naik turun\",\"voltase drop\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 16),
(263, 'PCG013', 'pc', 'PC tidak menyala setelah listrik mati mendadak', 'PSU', '[\"setelah mati listrik\",\"power failure\",\"setelah ups trip\",\"tidak nyala habis listrik mati\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 16),
(264, 'PCG014', 'pc', 'PSU mengeluarkan percikan api / terbakar', 'PSU', '[\"psu terbakar\",\"percikan api\",\"sparks psu\",\"psu meledak\",\"psu hangus\"]', NULL, '1.00', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 16),
(265, 'PCG015', 'pc', 'Komponen PC tidak mendapat daya cukup', 'PSU', '[\"daya kurang\",\"undervoltage komponen\",\"komponen ga dapat power\",\"voltage drop komponen\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 16),
(266, 'PCG016', 'pc', 'LED atau RGB PC tidak menyala', 'PSU', '[\"rgb mati\",\"led pc mati\",\"argb tidak nyala\",\"led casing mati\"]', NULL, '0.40', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 16),
(267, 'PCG017', 'pc', 'PSU sering trip / proteksi aktif', 'PSU', '[\"psu trip\",\"ocp opp proteksi\",\"protection aktif\",\"psu cutoff terus\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 16),
(268, 'PCG018', 'pc', 'PC tidak POST dengan semua komponen terpasang', 'PSU', '[\"tidak post semua komponen\",\"no post\",\"post gagal semua terpasang\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 16),
(269, 'PCG019', 'pc', 'BIOS mendeteksi voltase di luar range normal', 'PSU', '[\"bios voltase error\",\"vcore warning\",\"psu voltage bios\",\"voltase diluar range\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 16),
(270, 'PCG020', 'pc', 'PC nyala normal setelah lepas beberapa komponen', 'PSU', '[\"nyala tanpa komponen tertentu\",\"POST setelah lepas gpu\",\"menyala tanpa extra komponen\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 16),
(271, 'PCG021', 'pc', 'PC tidak POST sama sekali', 'Motherboard', '[\"tidak post\",\"no post\",\"blank saat nyala\",\"post gagal\",\"tidak ada tampilan booting\"]', NULL, '0.90', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(272, 'PCG022', 'pc', 'Bunyi beep dari speaker internal / POST card error', 'Motherboard', '[\"beep\",\"bunyi beep\",\"beep code\",\"bios beep\",\"post speaker\",\"q code error\"]', NULL, '0.90', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(273, 'PCG023', 'pc', 'Debug LED menyala (merah/kuning) di motherboard', 'Motherboard', '[\"debug led\",\"q led\",\"led merah\",\"led kuning\",\"diagnostic led\",\"post code led\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(274, 'PCG024', 'pc', 'BIOS tidak menyimpan setting / tanggal selalu reset', 'Motherboard', '[\"bios reset\",\"setting hilang\",\"tanggal salah terus\",\"cmos clear terus\",\"jam reset\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(275, 'PCG025', 'pc', 'Slot PCIe x16 tidak mendeteksi GPU', 'Motherboard', '[\"pcie slot kosong\",\"gpu tidak di detect di slot ini\",\"pcie x16 error\",\"slot gpu mati\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(276, 'PCG026', 'pc', 'Beberapa slot USB di panel belakang mati', 'Motherboard', '[\"usb belakang mati\",\"rear usb\",\"port usb tertentu mati\",\"beberapa usb error\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(277, 'PCG027', 'pc', 'PC BSOD random dengan berbagai kode error', 'Motherboard', '[\"bsod random\",\"blue screen berbeda-beda\",\"bsod tidak tentu\",\"bsod acak\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(278, 'PCG028', 'pc', 'Ada bau terbakar dari motherboard', 'Motherboard', '[\"bau motherboard\",\"bau gosong dari dalam\",\"hangus mobo\",\"bau komponen mobo\"]', NULL, '1.00', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(279, 'PCG029', 'pc', 'Kapasitor di motherboard terlihat kembung / pecah', 'Motherboard', '[\"kapasitor kembung\",\"kapasitor bengkak\",\"komponen mobo rusak fisik\",\"cap blown\"]', NULL, '0.90', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(280, 'PCG030', 'pc', 'BIOS tidak mendeteksi storage (HDD/SSD) yang terpasang', 'Motherboard', '[\"storage tidak terdeteksi bios\",\"hdd tidak kebaca bios\",\"ssd hilang bios\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(281, 'PCG031', 'pc', 'Slot RAM tertentu tidak berfungsi (DIMM slot mati)', 'Motherboard', '[\"slot ram mati\",\"dimm slot error\",\"ram di slot A2 tidak kebaca\",\"slot tertentu mati\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(282, 'PCG032', 'pc', 'Port LAN onboard tidak berfungsi', 'Motherboard', '[\"lan onboard mati\",\"ethernet port mobo rusak\",\"realtek lan error\",\"nic onboard mati\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(283, 'PCG033', 'pc', 'Port audio onboard tidak berfungsi', 'Motherboard', '[\"audio onboard mati\",\"realtek audio rusak\",\"jack belakang mati\",\"sound card onboard\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(284, 'PCG034', 'pc', 'BIOS tidak update / brick setelah flash gagal', 'Motherboard', '[\"bios brick\",\"flash bios gagal\",\"bios update error\",\"mobo tidak post setelah flash\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(285, 'PCG035', 'pc', 'Komponen tertentu hanya terdeteksi kadang-kadang', 'Motherboard', '[\"intermittent detection\",\"komponen kadang ada kadang tidak\",\"intermittent hardware\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(286, 'PCG036', 'pc', 'M.2 slot tertentu tidak bisa digunakan', 'Motherboard', '[\"m2 slot mati\",\"nvme tidak di satu slot\",\"slot m.2 tertentu error\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(287, 'PCG037', 'pc', 'VRM mosfet / area VRM terlalu panas', 'Motherboard', '[\"vrm panas\",\"mosfet overheat\",\"area sekitar cpu panas\",\"vrm throttle\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(288, 'PCG038', 'pc', 'Fitur tertentu motherboard tidak berfungsi (ARGB, fan header)', 'Motherboard', '[\"fan header mati\",\"argb header tidak jalan\",\"header tertentu rusak\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(289, 'PCG039', 'pc', 'PC tidak bisa booting dari port SATA tertentu', 'Motherboard', '[\"sata port mati\",\"tidak bisa boot dari sata ini\",\"sata tertentu tidak jalan\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(290, 'PCG040', 'pc', 'Motherboard menampilkan Q-Code tertentu dan berhenti', 'Motherboard', '[\"q code stuck\",\"post code berhenti\",\"error code freeze\",\"specific post code\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(291, 'PCG041', 'pc', 'Suhu CPU sangat tinggi di atas 90°C', 'CPU', '[\"cpu panas\",\"suhu cpu tinggi\",\"overheat cpu\",\"cpu 90 derajat\",\"cpu temperature tinggi\"]', NULL, '0.90', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(292, 'PCG042', 'pc', 'CPU thermal throttling (clock speed turun otomatis)', 'CPU', '[\"cpu throttle\",\"cpu melambat panas\",\"clock turun\",\"boost tidak jalan\",\"throttling\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(293, 'PCG043', 'pc', 'PC crash / BSOD saat CPU load tinggi', 'CPU', '[\"bsod saat render\",\"crash cpu full\",\"bsod encoding\",\"crash cpu tinggi\",\"whea cpu\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(294, 'PCG044', 'pc', 'CPU tidak terdeteksi di BIOS', 'CPU', '[\"cpu tidak terbaca\",\"prosesor tidak terdeteksi bios\",\"cpu error bios\",\"no cpu detected\"]', NULL, '0.90', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(295, 'PCG045', 'pc', 'Performa CPU jauh di bawah benchmark normal', 'CPU', '[\"cpu lambat\",\"performa cpu buruk\",\"benchmark jelek\",\"cpu tidak sesuai spec\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(296, 'PCG046', 'pc', 'CPU usage 100% terus tanpa beban nyata', 'CPU', '[\"cpu 100 persen terus\",\"cpu full tanpa alasan\",\"cpu selalu penuh\",\"cpu 100 idle\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(297, 'PCG047', 'pc', 'PC tidak stabil setelah overclock CPU', 'CPU', '[\"oc tidak stabil\",\"overclock crash\",\"xmp crash\",\"bios oc error\",\"oc freeze\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(298, 'PCG048', 'pc', 'Thermal paste CPU sudah lama tidak diganti', 'CPU', '[\"pasta lama\",\"thermal compound kering\",\"belum pernah ganti thermal paste cpu\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(299, 'PCG049', 'pc', 'Cooler CPU tidak terpasang rapat / longgar', 'CPU', '[\"cooler longgar\",\"heatsink tidak rapat\",\"cooler goyang\",\"pendingin cpu miring\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(300, 'PCG050', 'pc', 'Kipas CPU tidak berputar', 'CPU', '[\"fan cpu mati\",\"kipas cpu diam\",\"cpu cooler fan mati\",\"cpu fan tidak jalan\"]', NULL, '0.90', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(301, 'PCG051', 'pc', 'Pin di socket CPU (LGA) bengkok', 'CPU', '[\"pin socket bengkok\",\"bent pin\",\"lga pin rusak\",\"socket cpu pin patah\"]', NULL, '0.90', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(302, 'PCG052', 'pc', 'Suhu CPU idle di atas 60°C', 'CPU', '[\"cpu panas idle\",\"60 derajat idle\",\"suhu cpu tinggi tanpa beban\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(303, 'PCG053', 'pc', 'PC restart saat CPU peak load', 'CPU', '[\"restart saat cpu penuh\",\"reboot render\",\"restart encoding\",\"restart cpu full\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(304, 'PCG054', 'pc', 'CPU undervolt / LLC setting bermasalah', 'CPU', '[\"undervolt error\",\"llc setting salah\",\"vcore terlalu rendah\",\"cpu voltage error\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(305, 'PCG055', 'pc', 'Temperature sensor CPU tidak terbaca', 'CPU', '[\"suhu cpu tidak terbaca\",\"temperature unknown\",\"sensor cpu error\",\"hwinfo cpu temp\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(306, 'PCG056', 'pc', 'Cooler CPU tidak kompatibel dengan socket', 'CPU', '[\"cooler tidak cocok\",\"bracket salah\",\"mounting cooler salah\",\"cooler tidak support socket\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(307, 'PCG057', 'pc', 'CPU IHS (Integrated Heat Spreader) perlu dilap / delid', 'CPU', '[\"ihs kotor\",\"delid cpu\",\"thermal paste ihs bermasalah\",\"under ihs bermasalah\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(308, 'PCG058', 'pc', 'Thread tertentu CPU sering error', 'CPU', '[\"cpu core error\",\"specific core fail\",\"core tertentu crash\",\"hwinfo core error\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(309, 'PCG059', 'pc', 'PC freeze total (hard freeze) saat CPU stress test', 'CPU', '[\"freeze stress test\",\"hard freeze prime95\",\"cpu freeze stress\",\"pc macet total\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(310, 'PCG060', 'pc', 'Boost clock CPU tidak mencapai spec maksimal', 'CPU', '[\"boost tidak tercapai\",\"max boost gagal\",\"all core boost rendah\",\"cpu tidak boost\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(311, 'PCG061', 'pc', 'PC tidak POST karena RAM', 'RAM DIMM', '[\"ram tidak post\",\"no post ram\",\"dram error\",\"ram tidak kebaca\",\"pc tidak nyala ram\"]', NULL, '0.90', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(312, 'PCG062', 'pc', 'PC BSOD dengan error memory', 'RAM DIMM', '[\"bsod memory management\",\"page fault nonpaged area\",\"bsod ram\",\"memory error bsod\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(313, 'PCG063', 'pc', 'Kapasitas RAM terbaca lebih kecil dari yang dipasang', 'RAM DIMM', '[\"ram terbaca setengah\",\"kapasitas ram salah\",\"32gb terbaca 16gb\",\"usable ram berkurang\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(314, 'PCG064', 'pc', 'PC freeze / hang secara random', 'RAM DIMM', '[\"freeze acak\",\"hang tiba-tiba\",\"pc macet random\",\"pc diam mendadak\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(315, 'PCG065', 'pc', 'Memtest86 / kartu diagnostik menunjukkan error RAM', 'RAM DIMM', '[\"memtest error\",\"ram test gagal\",\"memory test fail\",\"memtest86 error\",\"kartu diagnostik\"]', NULL, '0.90', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(316, 'PCG066', 'pc', 'RAM tidak berjalan di kecepatan XMP/EXPO', 'RAM DIMM', '[\"xmp tidak aktif\",\"ram 3200 jalan 2133\",\"expo tidak aktif\",\"ram lambat\",\"speed ram salah\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(317, 'PCG067', 'pc', 'PC tidak stabil saat menggunakan XMP/EXPO agresif', 'RAM DIMM', '[\"xmp crash\",\"expo crash\",\"ram oc tidak stabil\",\"xmp bsod\",\"profile ram crash\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(318, 'PCG068', 'pc', 'Slot DIMM tertentu tidak berfungsi', 'RAM DIMM', '[\"slot ram mati\",\"dimm slot error\",\"slot a1 tidak kebaca\",\"slot tertentu mati\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(319, 'PCG069', 'pc', 'PC crash saat aplikasi memori intensif', 'RAM DIMM', '[\"crash edit video\",\"bsod photoshop\",\"crash banyak tab\",\"crash ram habis\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(320, 'PCG070', 'pc', 'Dual channel tidak aktif', 'RAM DIMM', '[\"dual channel mati\",\"single channel\",\"tidak di dual channel\",\"bandwidth ram rendah\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(321, 'PCG071', 'pc', 'Kontak DIMM kotor / teroksidasi', 'RAM DIMM', '[\"ram kotor\",\"kontak dimm kuning\",\"pin ram oksidasi\",\"ram perlu dibersihkan\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(322, 'PCG072', 'pc', 'RAM longgar / tidak terklik sempurna di slot', 'RAM DIMM', '[\"ram tidak klik\",\"ram goyang\",\"dimm tidak sempurna\",\"ram miring di slot\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(323, 'PCG073', 'pc', 'Beep code pola memori saat POST', 'RAM DIMM', '[\"beep ram\",\"pola beep memori\",\"kode beep ram\",\"post beep ram error\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(324, 'PCG074', 'pc', 'Mixing RAM berbeda spec / brand tidak stabil', 'RAM DIMM', '[\"ram campuran tidak stabil\",\"mix ram error\",\"different spec crash\",\"mixing ram bermasalah\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(325, 'PCG075', 'pc', 'RAM baru dipasang tidak terdeteksi', 'RAM DIMM', '[\"ram baru tidak terbaca\",\"upgrade ram gagal\",\"dimm baru tidak terdeteksi\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(326, 'PCG076', 'pc', 'Suhu RAM sangat tinggi', 'RAM DIMM', '[\"ram panas\",\"dimm overheat\",\"memory temperature tinggi\",\"ram kepanasan\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(327, 'PCG077', 'pc', 'Pendingin RAM (DIMM heatspreader) terlepas', 'RAM DIMM', '[\"heatspreader ram lepas\",\"pendingin dimm copot\",\"heatsink ram jatuh\"]', NULL, '0.40', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(328, 'PCG078', 'pc', 'PC hanya POST dengan satu modul RAM', 'RAM DIMM', '[\"post satu dimm\",\"ram satu yang jalan\",\"dua dimm tidak post\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(329, 'PCG079', 'pc', 'GPU tidak terdeteksi di Device Manager', 'GPU Diskrit', '[\"gpu tidak terdeteksi\",\"vga hilang device manager\",\"gpu error\",\"gpu tidak kebaca\"]', NULL, '0.90', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 19),
(330, 'PCG080', 'pc', 'Artefak / glitch visual di layar saat GPU load', 'GPU Diskrit', '[\"artefak gpu\",\"kotak warna\",\"glitch layar\",\"visual artifact\",\"corrupted display gpu\"]', NULL, '0.90', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 19),
(331, 'PCG081', 'pc', 'PC crash / BSOD saat gaming atau GPU load tinggi', 'GPU Diskrit', '[\"crash gaming\",\"bsod game\",\"pc mati saat main game\",\"gpu crash bsod\",\"game crash\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 19),
(332, 'PCG082', 'pc', 'Suhu GPU di atas 90°C saat gaming', 'GPU Diskrit', '[\"gpu panas\",\"suhu gpu tinggi\",\"gpu overheat\",\"temperature gpu tinggi gaming\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 19),
(333, 'PCG083', 'pc', 'Fan GPU tidak berputar (semua fan diam)', 'GPU Diskrit', '[\"fan gpu mati\",\"kipas gpu diam\",\"gpu fan tidak jalan\",\"all gpu fan mati\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 19),
(334, 'PCG084', 'pc', 'FPS / performa GPU sangat di bawah normal', 'GPU Diskrit', '[\"fps drop\",\"frame rate rendah\",\"game lag\",\"performa gpu jelek\",\"fps abnormal rendah\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 19),
(335, 'PCG085', 'pc', 'Driver GPU crash / TDR error', 'GPU Diskrit', '[\"driver crash gpu\",\"tdr error\",\"display driver stopped\",\"nvlddmkm error\",\"gpu driver crash\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 19),
(336, 'PCG086', 'pc', 'GPU vRAM menunjukkan error', 'GPU Diskrit', '[\"vram error\",\"gpu memory error\",\"video memory problem\",\"vram corrupt\",\"vram test fail\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 19),
(337, 'PCG087', 'pc', 'Konektor PCIe power GPU tidak terpasang', 'GPU Diskrit', '[\"pcie power tidak terpasang\",\"konektor gpu power lepas\",\"8 pin gpu tidak plug\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 19),
(338, 'PCG088', 'pc', 'GPU thermal paste kering / perlu diganti', 'GPU Diskrit', '[\"gpu pasta kering\",\"thermal paste gpu lama\",\"thermal compound gpu perlu ganti\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 19),
(339, 'PCG089', 'pc', 'Slot PCIe x16 GPU bermasalah', 'GPU Diskrit', '[\"pcie slot gpu error\",\"slot vga tidak jalan\",\"pcie x16 rusak\",\"gpu di slot ini tidak kebaca\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 19),
(340, 'PCG090', 'pc', 'GPU clock speed tidak mencapai boost clock spec', 'GPU Diskrit', '[\"gpu tidak boost\",\"clock gpu rendah\",\"power limit gpu\",\"gpu ga turbo\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 19),
(341, 'PCG091', 'pc', 'GPU tidak mendapat daya cukup dari PSU', 'GPU Diskrit', '[\"gpu daya kurang\",\"psu tidak cukup untuk gpu\",\"gpu undervoltage\",\"power delivery gpu\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 19),
(342, 'PCG092', 'pc', 'GPU artefak hanya pada resolusi atau setting tertentu', 'GPU Diskrit', '[\"artefak 4k\",\"glitch resolusi tinggi\",\"artifak saat msaa\",\"specific setting artefak\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 19),
(343, 'PCG093', 'pc', 'GPU mengeluarkan coil whine', 'GPU Diskrit', '[\"coil whine gpu\",\"gpu bunyi\",\"suara elektrik gpu\",\"gpu nyaring\",\"high pitched gpu\"]', NULL, '0.40', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 19),
(344, 'PCG094', 'pc', 'GPU tidak muncul tampilan setelah dipindah slot', 'GPU Diskrit', '[\"gpu no display setelah pindah\",\"slot baru tidak output\",\"setelah pindah gpu mati\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 19),
(345, 'PCG095', 'pc', 'GPU baru dipasang tidak terdeteksi', 'GPU Diskrit', '[\"gpu baru tidak kebaca\",\"install gpu baru error\",\"gpu baru tidak detected\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 19),
(346, 'PCG096', 'pc', 'Driver GPU tidak bisa terinstall', 'GPU Diskrit', '[\"driver gpu gagal install\",\"install driver error\",\"driver rejected\",\"driver gpu tidak bisa\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 19),
(347, 'PCG097', 'pc', 'GPU satu fan tidak berputar (multi-fan GPU)', 'GPU Diskrit', '[\"satu fan gpu mati\",\"fan tengah gpu mati\",\"beberapa fan gpu diam\",\"partial fan fail\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 19),
(348, 'PCG098', 'pc', 'GPU menampilkan error code di display', 'GPU Diskrit', '[\"gpu error code\",\"vbios error\",\"gpu post code\",\"gpu diagnostic error\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, 19),
(349, 'PCG099', 'pc', 'HDD / SSD tidak terdeteksi di BIOS', 'Storage', '[\"storage tidak terdeteksi\",\"hdd ssd hilang bios\",\"drive tidak kebaca bios\"]', NULL, '0.90', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(350, 'PCG100', 'pc', 'Bunyi klik atau grinding dari HDD 3.5\"', 'Storage', '[\"hdd klik\",\"klik klik\",\"clicking hdd\",\"grinding hdd\",\"hdd noise\",\"suara dari hdd\"]', NULL, '0.90', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(351, 'PCG101', 'pc', 'Windows tidak bisa booting dari drive', 'Storage', '[\"windows tidak boot\",\"gagal booting\",\"no bootable device\",\"os tidak jalan\",\"boot fail\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(352, 'PCG102', 'pc', 'Muncul peringatan SMART di CrystalDiskInfo', 'Storage', '[\"smart warning\",\"smart caution\",\"disk health bad\",\"reallocated sectors\",\"smart error\"]', NULL, '0.90', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(353, 'PCG103', 'pc', 'Bad sector terdeteksi pada HDD', 'Storage', '[\"bad sector\",\"chkdsk error\",\"sektor rusak\",\"bad block\",\"bad sector terdeteksi\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(354, 'PCG104', 'pc', 'Transfer data sangat lambat / disk usage 100%', 'Storage', '[\"transfer lambat\",\"copy pelan\",\"disk 100\",\"disk usage penuh\",\"hdd bottleneck\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(355, 'PCG105', 'pc', 'SSD NVMe M.2 tidak terdeteksi', 'Storage', '[\"nvme tidak terdeteksi\",\"m.2 hilang\",\"m.2 tidak kebaca\",\"nvme ssd error bios\"]', NULL, '0.90', '2026-03-12 15:25:41', '2026-04-01 06:32:20', 2, NULL),
(356, 'PCG106', 'pc', 'SSD SATA tidak terdeteksi', 'Storage', '[\"ssd sata tidak kebaca\",\"ssd 2.5 hilang\",\"sata ssd tidak terdeteksi\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(357, 'PCG107', 'pc', 'Partisi drive hilang tiba-tiba', 'Storage', '[\"partisi hilang\",\"drive d hilang\",\"disk management tidak ada partisi\",\"partition gone\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(358, 'PCG108', 'pc', 'SSD tiba-tiba menjadi read-only', 'Storage', '[\"ssd read only\",\"tidak bisa write\",\"write protected ssd\",\"ssd tidak bisa nulis\"]', NULL, '0.90', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(359, 'PCG109', 'pc', 'Drive HDD sering disconnect dan reconnect', 'Storage', '[\"hdd disconnect\",\"drive hilang tiba-tiba\",\"storage intermittent\",\"drive on off\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(360, 'PCG110', 'pc', 'Suhu drive sangat tinggi', 'Storage', '[\"hdd ssd panas\",\"storage overheat\",\"suhu nvme tinggi\",\"nvme throttle panas\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(361, 'PCG111', 'pc', 'Kabel SATA longgar atau rusak', 'Storage', '[\"kabel sata goyang\",\"sata cable rusak\",\"sata longgar\",\"kabel data hdd longgar\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(362, 'PCG112', 'pc', 'RAID array bermasalah / degraded', 'Storage', '[\"raid rusak\",\"raid degraded\",\"raid array error\",\"volume raid tidak jalan\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(363, 'PCG113', 'pc', 'Drive hanya terdeteksi kadang-kadang', 'Storage', '[\"intermittent drive\",\"storage kadang muncul\",\"hdd intermittent detection\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(364, 'PCG114', 'pc', 'Kapasitas HDD terbaca lebih kecil dari aslinya', 'Storage', '[\"kapasitas salah\",\"hdd size berubah\",\"1tb terbaca 500gb\",\"disk size error\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(365, 'PCG115', 'pc', 'NVMe SSD throttling karena panas', 'Storage', '[\"nvme throttle\",\"m.2 throttle panas\",\"nvme lambat panas\",\"nvme heatsink diperlukan\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(366, 'PCG116', 'pc', 'Firmware SSD bermasalah / perlu update', 'Storage', '[\"firmware ssd\",\"ssd firmware update\",\"firmware bug ssd\",\"ssd firmware error\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(367, 'PCG117', 'pc', 'HDD 3.5\" berbunyi berputar tapi tidak terdeteksi', 'Storage', '[\"hdd berputar tidak terdeteksi\",\"hdd spin up not detected\",\"hdd mutar tapi hilang\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(368, 'PCG118', 'pc', 'Data di drive tidak bisa diakses tanpa alasan jelas', 'Storage', '[\"data tidak bisa diakses\",\"file tidak bisa dibuka\",\"access denied drive\",\"drive tidak respon\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(369, 'PCG119', 'pc', 'Tombol power casing tidak merespon', 'Casing', '[\"tombol power mati\",\"power button tidak respon\",\"front panel power rusak\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(370, 'PCG120', 'pc', 'Tombol reset casing tidak berfungsi', 'Casing', '[\"reset button mati\",\"tombol restart tidak respon\",\"reset front panel rusak\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(371, 'PCG121', 'pc', 'USB front panel casing tidak berfungsi', 'Casing', '[\"usb depan mati\",\"front panel usb\",\"usb front tidak jalan\",\"panel usb depan error\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(372, 'PCG122', 'pc', 'Audio jack front panel casing tidak berfungsi', 'Casing', '[\"jack depan mati\",\"audio front panel\",\"headset jack depan tidak bunyi\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(373, 'PCG123', 'pc', 'LED power / activity casing tidak menyala', 'Casing', '[\"led casing mati\",\"lampu power tidak nyala\",\"hdd led mati\",\"activity light off\"]', NULL, '0.40', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(374, 'PCG124', 'pc', 'ARGB / RGB casing tidak menyala', 'Casing', '[\"rgb casing mati\",\"argb tidak nyala\",\"led strip casing mati\",\"lighting casing off\"]', NULL, '0.30', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(375, 'PCG125', 'pc', 'Kabel front panel salah pasang ke motherboard', 'Casing', '[\"front panel salah\",\"power sw salah\",\"hdd led salah pasang\",\"front header error\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(376, 'PCG126', 'pc', 'PC berbunyi aneh dari dalam casing (vibrasi)', 'Casing', '[\"bunyi vibrasi\",\"casing getar\",\"pc berisik vibrasi\",\"resonansi casing\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(377, 'PCG127', 'pc', 'Dust filter casing sangat kotor / tersumbat', 'Casing', '[\"dust filter kotor\",\"filter debu tersumbat\",\"saringan debu penuh\",\"casing airflow buruk\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(378, 'PCG128', 'pc', 'Casing terlalu kecil untuk komponen (mATX/ATX mismatch)', 'Casing', '[\"casing kecil\",\"motherboard tidak muat\",\"gpu terlalu panjang\",\"casing form factor salah\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(379, 'PCG129', 'pc', 'Fan header casing (ke motherboard) tidak berfungsi', 'Casing', '[\"fan header mati\",\"kipas casing tidak terkontrol\",\"fan curve tidak jalan\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(380, 'PCG130', 'pc', 'Speaker internal casing untuk beep tidak terpasang', 'Casing', '[\"speaker internal tidak ada\",\"tidak ada suara beep\",\"post speaker belum pasang\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(381, 'PCG131', 'pc', 'USB Type-C front panel tidak berfungsi', 'Casing', '[\"usb c depan mati\",\"type-c front panel\",\"usb c casing tidak jalan\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(382, 'PCG132', 'pc', 'Casing retak / penyok mempengaruhi komponen', 'Casing', '[\"casing retak\",\"casing penyok\",\"chassis rusak fisik\",\"panel casing bengkok\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(383, 'PCG133', 'pc', 'Grounding casing bermasalah (shock saat disentuh)', 'Casing', '[\"kena setrum casing\",\"grounding buruk\",\"electric shock casing\",\"casing nyetrum\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(384, 'PCG134', 'pc', 'Suhu keseluruhan sistem sangat tinggi', 'Thermal', '[\"semua komponen panas\",\"suhu sistem tinggi\",\"pc overheat\",\"temperature semua tinggi\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 18),
(385, 'PCG135', 'pc', 'Fan casing tidak berputar', 'Thermal', '[\"fan casing mati\",\"case fan diam\",\"exhaust fan mati\",\"intake fan mati\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 18),
(386, 'PCG136', 'pc', 'Fan casing berputar kencang terus menerus', 'Thermal', '[\"fan casing full speed\",\"kipas kencang terus\",\"noise fan\",\"fan noise tinggi terus\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 18),
(387, 'PCG137', 'pc', 'PC mati karena thermal shutdown', 'Thermal', '[\"mati karena panas\",\"thermal shutdown\",\"overheat protection\",\"mati kepanasan\"]', NULL, '0.90', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 18),
(388, 'PCG138', 'pc', 'Debu sangat menumpuk di heatsink / fan', 'Thermal', '[\"debu heatsink\",\"heatsink penuh debu\",\"fan debu\",\"komponen kotor debu\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 18),
(389, 'PCG139', 'pc', 'Thermal paste CPU sudah lama (lihat CPU section)', 'Thermal', '[\"pasta kering\",\"thermal compound lama\",\"paste cpu perlu ganti\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 18),
(390, 'PCG140', 'pc', 'AIO liquid cooler tidak berfungsi', 'Thermal', '[\"aio liquid cooler mati\",\"watercooling error\",\"aio pump tidak jalan\",\"cooler liquid\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 18),
(391, 'PCG141', 'pc', 'Selang / head AIO liquid cooler bocor', 'Thermal', '[\"selang bocor\",\"coolant bocor\",\"aio leak\",\"liquid tumpah dalam pc\"]', NULL, '1.00', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 18),
(392, 'PCG142', 'pc', 'Custom water cooling bermasalah', 'Thermal', '[\"custom loop error\",\"watercooling custom\",\"reservoir pump mati\",\"custom wc\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 18),
(393, 'PCG143', 'pc', 'Thermal pad VRM / chipset perlu diganti', 'Thermal', '[\"thermal pad vrm\",\"pad chipset kering\",\"vrm thermal pad\",\"komponen pad panas\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 18),
(394, 'PCG144', 'pc', 'Fan controller / header mati', 'Thermal', '[\"fan controller mati\",\"pwm header rusak\",\"fan header tidak detect\",\"fan control error\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 18),
(395, 'PCG145', 'pc', 'Konfigurasi airflow casing tidak optimal', 'Thermal', '[\"airflow buruk\",\"negative pressure\",\"tekanan negatif\",\"inlet outlet fan salah\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 18),
(396, 'PCG146', 'pc', 'Suhu di satu area spesifik sangat tinggi (hotspot)', 'Thermal', '[\"hotspot\",\"satu area panas\",\"VRM panas saja\",\"area tertentu overheat\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 18),
(397, 'PCG147', 'pc', 'AIO pump tidak berputar', 'Thermal', '[\"pump aio mati\",\"pompa liquid cooler berhenti\",\"aio tidak mengalir\",\"pump error\"]', NULL, '0.90', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 18),
(398, 'PCG148', 'pc', 'Fan GPU satu tidak berputar (lihat GPU section)', 'Thermal', '[\"gpu fan mati\",\"kipas gpu partial\",\"satu fan vga diam\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 18);
INSERT INTO `symptoms` (`id`, `code`, `device_type`, `name`, `category`, `keywords`, `follow_up_question`, `weight`, `created_at`, `updated_at`, `device_type_id`, `device_component_id`) VALUES
(399, 'PCG149', 'pc', 'Tidak ada suara dari speaker / headphone', 'Audio', '[\"tidak ada suara\",\"pc bisu\",\"speaker mati\",\"audio mati\",\"no sound output\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 21),
(400, 'PCG150', 'pc', 'Suara crackling / distorsi / pecah', 'Audio', '[\"suara pecah\",\"crackling\",\"distorsi\",\"crackle\",\"audio noise\",\"suara berdesis\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 21),
(401, 'PCG151', 'pc', 'Audio device tidak terdeteksi di Windows', 'Audio', '[\"audio device not found\",\"no audio device\",\"sound hilang windows\",\"playback device kosong\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 21),
(402, 'PCG152', 'pc', 'Jack audio panel belakang tidak berfungsi', 'Audio', '[\"jack belakang mati\",\"audio rear panel\",\"rear audio jack rusak\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 21),
(403, 'PCG153', 'pc', 'Jack audio front panel casing tidak berfungsi', 'Audio', '[\"jack depan mati\",\"audio front panel\",\"headphone jack depan error\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 21),
(404, 'PCG154', 'pc', 'Microphone tidak berfungsi', 'Audio', '[\"mic mati\",\"microphone tidak jalan\",\"input audio mati\",\"mic tidak terdeteksi\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 21),
(405, 'PCG155', 'pc', 'Suara hanya dari satu channel (mono)', 'Audio', '[\"suara satu sisi\",\"mono audio\",\"left channel mati\",\"right mati\",\"stereo tidak jalan\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 21),
(406, 'PCG156', 'pc', 'Driver audio hilang setelah update Windows', 'Audio', '[\"driver audio hilang update\",\"audio mati setelah update\",\"realtek hilang\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 21),
(407, 'PCG157', 'pc', 'Sound card PCIe diskrit tidak terdeteksi', 'Audio', '[\"sound card tidak kebaca\",\"pcie audio card error\",\"add-in sound card hilang\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 21),
(408, 'PCG158', 'pc', 'Noise / ground loop hum dari speaker', 'Audio', '[\"hum speaker\",\"dengung audio\",\"ground loop\",\"noise floor tinggi\",\"50hz hum\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 21),
(409, 'PCG159', 'pc', 'Audio via HDMI / DisplayPort tidak berfungsi', 'Audio', '[\"hdmi audio mati\",\"dp audio tidak keluar\",\"audio monitor tidak ada\",\"display audio\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 21),
(410, 'PCG160', 'pc', 'DAC / Amplifier eksternal tidak terdeteksi', 'Audio', '[\"dac tidak terdeteksi\",\"amp eksternal error\",\"usb dac tidak jalan\",\"audiophile setup\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 21),
(411, 'PCG161', 'pc', 'Realtek Audio Manager tidak bisa dibuka', 'Audio', '[\"realtek crash\",\"audio manager error\",\"software audio bermasalah\"]', NULL, '0.40', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 21),
(412, 'PCG162', 'pc', 'Virtual audio / DTS / Dolby bermasalah', 'Audio', '[\"virtual surround mati\",\"dts tidak jalan\",\"dolby error\",\"spatial audio bermasalah\"]', NULL, '0.40', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 21),
(413, 'PCG163', 'pc', 'Audio Bluetooth bermasalah (jika ada BT)', 'Audio', '[\"bluetooth audio error\",\"bt speaker pc\",\"wireless audio bermasalah\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 21),
(414, 'PCG164', 'pc', 'LAN / Ethernet tidak berfungsi', 'Network', '[\"lan mati\",\"ethernet error\",\"internet kabel tidak jalan\",\"rj45 tidak berfungsi\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 20),
(415, 'PCG165', 'pc', 'WiFi card PCIe tidak berfungsi', 'Network', '[\"wifi pcie tidak jalan\",\"wifi card tidak terdeteksi\",\"wireless adapter error\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 20),
(416, 'PCG166', 'pc', 'Driver LAN / WiFi tidak terinstall', 'Network', '[\"driver lan hilang\",\"driver wifi tidak ada\",\"network driver missing\",\"no driver\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 20),
(417, 'PCG167', 'pc', 'Port LAN fisik rusak (pin bengkok / housing patah)', 'Network', '[\"port lan rusak\",\"rj45 bengkok\",\"port ethernet rusak fisik\",\"lan jack patah\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 20),
(418, 'PCG168', 'pc', 'Kecepatan LAN di bawah kapasitas (Gigabit terbaca 100Mbps)', 'Network', '[\"lan lambat\",\"1gbps terbaca 100mbps\",\"ethernet speed rendah\",\"gigabit tidak jalan\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 20),
(419, 'PCG169', 'pc', 'Koneksi internet sering putus', 'Network', '[\"internet putus\",\"sering disconnect\",\"koneksi tidak stabil\",\"intermittent internet\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 20),
(420, 'PCG170', 'pc', 'IP address conflict di jaringan', 'Network', '[\"ip conflict\",\"ip sama\",\"duplicate ip\",\"ip address bentrok\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 20),
(421, 'PCG171', 'pc', 'Antena WiFi PCIe tidak terpasang / hilang', 'Network', '[\"antena wifi tidak ada\",\"wifi signal lemah tanpa antena\",\"antena wifi card lepas\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 20),
(422, 'PCG172', 'pc', 'USB WiFi adapter tidak berfungsi', 'Network', '[\"usb wifi mati\",\"wifi dongle error\",\"usb wireless adapter tidak jalan\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 20),
(423, 'PCG173', 'pc', 'LAN onboard mati setelah update / driver issue', 'Network', '[\"lan mati update\",\"onboard lan driver error\",\"lan bermasalah setelah update\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 20),
(424, 'PCG174', 'pc', 'Ping sangat tinggi / packet loss', 'Network', '[\"ping tinggi\",\"latency besar\",\"packet loss\",\"lag online game\",\"jitter tinggi\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 20),
(425, 'PCG175', 'pc', 'NIC (Network Interface Card) PCIe tidak terdeteksi', 'Network', '[\"nic tidak terdeteksi\",\"network card hilang\",\"lan card pcie error\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 20),
(426, 'PCG176', 'pc', 'WiFi card koneksi terbatas atau sering putus', 'Network', '[\"wifi terbatas\",\"limited wifi\",\"wifi putus terus\",\"wireless tidak stabil\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 20),
(427, 'PCG177', 'pc', 'Thunderbolt / USB-C network tidak berfungsi', 'Network', '[\"thunderbolt network\",\"usb-c lan\",\"type-c ethernet tidak jalan\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 20),
(428, 'PCG178', 'pc', 'Port USB di panel belakang tidak berfungsi', 'Peripheral', '[\"usb belakang mati\",\"rear usb error\",\"usb panel belakang rusak\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(429, 'PCG179', 'pc', 'Port USB di panel depan casing tidak berfungsi', 'Peripheral', '[\"usb depan mati\",\"front panel usb\",\"usb casing depan tidak jalan\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(430, 'PCG180', 'pc', 'Mouse tidak terdeteksi', 'Peripheral', '[\"mouse tidak kebaca\",\"mouse mati\",\"pointer tidak gerak\",\"mouse error\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(431, 'PCG181', 'pc', 'Keyboard tidak terdeteksi', 'Peripheral', '[\"keyboard tidak kebaca\",\"keyboard mati\",\"input keyboard tidak jalan\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(432, 'PCG182', 'pc', 'USB device terdeteksi tapi tidak berfungsi', 'Peripheral', '[\"usb ada tapi tidak jalan\",\"detected but not working\",\"usb detected error\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(433, 'PCG183', 'pc', 'Semua USB mati sekaligus', 'Peripheral', '[\"semua usb mati\",\"total usb fail\",\"seluruh port usb tidak jalan\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(434, 'PCG184', 'pc', 'USB 3.0 berjalan hanya di kecepatan USB 2.0', 'Peripheral', '[\"usb 3 lambat\",\"usb3 2.0 speed\",\"transfer usb pelan\",\"usb 3 tidak full speed\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(435, 'PCG185', 'pc', 'Port PS/2 tidak berfungsi', 'Peripheral', '[\"ps2 mati\",\"keyboard mouse ps2 rusak\",\"ps2 port error\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(436, 'PCG186', 'pc', 'Port Thunderbolt / USB-C tidak berfungsi', 'Peripheral', '[\"thunderbolt mati\",\"usb-c tidak jalan\",\"tb4 error\",\"type-c pc mati\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(437, 'PCG187', 'pc', 'Gamepad / joystick tidak terdeteksi', 'Peripheral', '[\"joystick tidak terdeteksi\",\"gamepad error\",\"controller tidak kebaca\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(438, 'PCG188', 'pc', 'Printer via USB tidak terdeteksi', 'Peripheral', '[\"printer usb mati\",\"printer tidak terdeteksi usb\",\"printer usb error\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(439, 'PCG189', 'pc', 'Card reader eksternal tidak berfungsi', 'Peripheral', '[\"card reader usb tidak jalan\",\"sd card reader mati\",\"memcard reader error\"]', NULL, '0.40', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(440, 'PCG190', 'pc', 'USB hub besar tidak mendapat daya cukup', 'Peripheral', '[\"usb hub tidak daya\",\"hub power insufficient\",\"hub besar tidak jalan\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(441, 'PCG191', 'pc', 'Kabel header USB 3.0 (19-pin) ke motherboard longgar', 'Peripheral', '[\"usb 3.0 header longgar\",\"19 pin usb longgar\",\"kabel usb 3 depan longgar\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(442, 'PCG192', 'pc', 'Port USB di I/O shield belakang sebagian tidak jalan', 'Peripheral', '[\"beberapa usb belakang mati\",\"partial rear usb\",\"usb tertentu belakang error\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(443, 'PCG193', 'pc', 'Windows sering BSOD', 'Software', '[\"bsod\",\"blue screen\",\"bluescreen\",\"layar biru\",\"crash windows\",\"stop error\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 17),
(444, 'PCG194', 'pc', 'PC sangat lambat / lag', 'Software', '[\"pc lambat\",\"komputer lemot\",\"lag parah\",\"pc pelan\",\"slow performance\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 17),
(445, 'PCG195', 'pc', 'Virus / malware terdeteksi', 'Software', '[\"virus\",\"malware\",\"kena virus\",\"trojan\",\"ransomware\",\"spyware\",\"terinfeksi\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 17),
(446, 'PCG196', 'pc', 'Windows tidak bisa booting', 'Software', '[\"windows tidak boot\",\"gagal booting\",\"no bootable device\",\"os tidak jalan\"]', NULL, '0.90', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 17),
(447, 'PCG197', 'pc', 'Startup PC sangat lambat', 'Software', '[\"startup lambat\",\"booting lama\",\"windows lama muncul\",\"loading lama\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 17),
(448, 'PCG198', 'pc', 'Banyak program berjalan di background', 'Software', '[\"banyak proses\",\"resource hog\",\"background app banyak\",\"cpu ram terpakai banyak\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 17),
(449, 'PCG199', 'pc', 'Windows Update bermasalah / gagal', 'Software', '[\"update error\",\"windows update gagal\",\"update stuck\",\"update tidak bisa diinstall\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 17),
(450, 'PCG200', 'pc', 'Driver hardware tidak kompatibel setelah update OS', 'Software', '[\"driver rusak update\",\"incompatible driver\",\"driver error setelah update windows\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 17),
(451, 'PCG201', 'pc', 'File system corrupt (SFC / DISM error)', 'Software', '[\"sfc error\",\"dism error\",\"system file corrupt\",\"file windows rusak\",\"sfc scannow error\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 17),
(452, 'PCG202', 'pc', 'Registry Windows corrupt', 'Software', '[\"registry corrupt\",\"registry error\",\"reg bermasalah\",\"registry key rusak\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 17),
(453, 'PCG203', 'pc', 'Windows masuk repair loop', 'Software', '[\"repair loop\",\"automatic repair terus\",\"preparing automatic repair\",\"boot loop repair\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 17),
(454, 'PCG204', 'pc', 'Partisi / drive menampilkan RAW', 'Software', '[\"drive raw\",\"partisi raw\",\"file system raw\",\"disk raw\",\"cannot access\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 17),
(455, 'PCG205', 'pc', 'User profile Windows corrupt', 'Software', '[\"user profile error\",\"tidak bisa login\",\"profile corrupt\",\"akun windows rusak\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 17),
(456, 'PCG206', 'pc', 'Aktivasi Windows bermasalah', 'Software', '[\"windows tidak aktif\",\"lisensi kadaluarsa\",\"activation error\",\"windows bajakan\"]', NULL, '0.30', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 17),
(457, 'PCG207', 'pc', 'Task Manager menampilkan proses tidak dikenal', 'Software', '[\"proses aneh\",\"task manager mencurigakan\",\"unknown process\",\"suspicious task\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 17),
(458, 'PCG208', 'pc', 'System Restore tidak berfungsi / gagal', 'Software', '[\"system restore gagal\",\"restore point error\",\"tidak bisa restore\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 17),
(459, 'PCG209', 'pc', 'PC tidak bisa masuk Safe Mode', 'Software', '[\"safe mode tidak bisa\",\"gagal masuk safe mode\",\"safe boot error\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 17),
(460, 'PCG210', 'pc', 'Event Viewer menampilkan error kritis', 'Software', '[\"event viewer error\",\"critical event\",\"system event error\",\"log error kritis\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, 17),
(461, 'PCG211', 'pc', 'PC tidak stabil setelah overclock CPU', 'Overclocking', '[\"oc cpu tidak stabil\",\"overclock cpu crash\",\"cpu oc bsod\",\"oc cpu freeze\"]', NULL, '0.90', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(462, 'PCG212', 'pc', 'PC tidak stabil setelah XMP / EXPO diaktifkan', 'Overclocking', '[\"xmp crash\",\"expo tidak stabil\",\"xmp bsod\",\"xmp freeze\",\"expo error\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(463, 'PCG213', 'pc', 'GPU overclock menyebabkan crash / artefak', 'Overclocking', '[\"gpu oc crash\",\"overclock gpu artefak\",\"afterburner oc mati\",\"gpu oc bsod\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(464, 'PCG214', 'pc', 'BIOS tidak menyimpan OC setting setelah restart', 'Overclocking', '[\"oc tidak tersimpan\",\"setting bios hilang oc\",\"oc reset\",\"overclock ilang restart\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(465, 'PCG215', 'pc', 'CPU tidak mencapai frekuensi yang ditargetkan', 'Overclocking', '[\"cpu tidak hit frekuensi\",\"max clock tidak tercapai\",\"cpu stuck clock\",\"freq rendah\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(466, 'PCG216', 'pc', 'Voltase CPU terlalu tinggi saat OC (degradasi CPU)', 'Overclocking', '[\"vcore terlalu tinggi\",\"voltase berbahaya\",\"cpu voltage risk\",\"over voltage cpu\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(467, 'PCG217', 'pc', 'Memory OC menyebabkan sistem tidak stabil', 'Overclocking', '[\"ram oc tidak stabil\",\"memory overclock crash\",\"timing salah\",\"frekuensi ram error\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(468, 'PCG218', 'pc', 'Suhu CPU sangat tinggi saat di-overclock', 'Overclocking', '[\"cpu panas oc\",\"suhu tinggi overclock\",\"throttle oc\",\"overclocking overheat\"]', NULL, '0.90', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(469, 'PCG219', 'pc', 'PC tidak bisa boot setelah ubah setting BIOS OC', 'Overclocking', '[\"tidak bisa boot setelah oc bios\",\"brick oc\",\"bios oc boot fail\",\"overclock brick\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(470, 'PCG220', 'pc', 'Benchmark tidak konsisten saat di-overclock', 'Overclocking', '[\"benchmark berubah-ubah\",\"oc benchmark tidak stabil\",\"score turun naik oc\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(471, 'PCG221', 'pc', 'Power limit / TDP wall menyebabkan CPU throttle', 'Overclocking', '[\"power limit throttle\",\"tjmax throttle\",\"tdp wall\",\"cpu tdp tercapai\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(472, 'PCG222', 'pc', 'OC menyebabkan degradasi komponen jangka panjang', 'Overclocking', '[\"komponen terdegradasi oc\",\"cpu aus oc\",\"usia komponen pendek oc\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(473, 'PCG223', 'pc', 'Precision Boost Overdrive (PBO) bermasalah', 'Overclocking', '[\"pbo error\",\"pbo tidak stabil\",\"amd pbo crash\",\"precision boost overdrive\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(474, 'PCG224', 'pc', 'LLC (Load Line Calibration) setting tidak tepat', 'Overclocking', '[\"llc salah\",\"load line calibration\",\"vdroop masalah\",\"cpu voltage swing\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(475, 'PCG225', 'pc', 'BCLK overclock menyebabkan instabilitas luas', 'Overclocking', '[\"bclk tidak stabil\",\"base clock oc\",\"bclk crash\",\"seluruh sistem tidak stabil bclk\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(476, 'PCG226', 'pc', 'Masalah terjadi setelah upgrade komponen (GPU/RAM/CPU)', 'Differential', '[\"setelah upgrade\",\"habis ganti komponen\",\"pasang komponen baru\",\"upgrade pc\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(477, 'PCG227', 'pc', 'Masalah terjadi setelah update Windows atau driver', 'Differential', '[\"setelah update\",\"habis update driver\",\"windows update menyebabkan masalah\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(478, 'PCG228', 'pc', 'Masalah terjadi setelah bersihkan atau rakit ulang PC', 'Differential', '[\"setelah dibersihkan\",\"habis dirakit ulang\",\"setelah servis\",\"habis dibuka\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(479, 'PCG229', 'pc', 'Masalah terjadi setelah PC jatuh / terbentur / pindah lokasi', 'Differential', '[\"jatuh\",\"terbentur\",\"kena banting\",\"pindah tempat\",\"diangkut\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(480, 'PCG230', 'pc', 'Masalah terjadi setelah listrik mati mendadak', 'Differential', '[\"mati listrik\",\"power failure\",\"ups trip\",\"listrik padam\",\"korsleting listrik\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(481, 'PCG231', 'pc', 'Masalah hanya muncul saat beban CPU / GPU tinggi', 'Differential', '[\"hanya saat gaming\",\"render\",\"encoding\",\"full load\",\"beban berat\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(482, 'PCG232', 'pc', 'Masalah hanya muncul saat suhu tinggi', 'Differential', '[\"saat panas\",\"thermal dependent\",\"setelah lama pakai\",\"suhu naik error\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(483, 'PCG233', 'pc', 'Masalah hilang setelah PC di-restart', 'Differential', '[\"sembuh restart\",\"hilang reboot\",\"restart memperbaiki sementara\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(484, 'PCG234', 'pc', 'Masalah tetap ada setelah reinstall Windows', 'Differential', '[\"masih ada reinstall\",\"hardware problem\",\"bukan software\",\"install ulang tidak membantu\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(485, 'PCG235', 'pc', 'Masalah muncul di semua OS termasuk Linux', 'Differential', '[\"linux juga error\",\"semua os\",\"bukan windows\",\"os independent\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(486, 'PCG236', 'pc', 'Masalah terjadi setelah overclock diaktifkan', 'Differential', '[\"setelah oc\",\"habis overclock\",\"xmp crash\",\"bios oc error\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(487, 'PCG237', 'pc', 'Masalah hanya pada satu komponen tertentu saja', 'Differential', '[\"hanya gpu\",\"hanya ram slot ini\",\"hanya port ini\",\"satu komponen\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(488, 'PCG238', 'pc', 'Masalah intermittent / tidak konsisten', 'Differential', '[\"kadang-kadang\",\"tidak konsisten\",\"sesekali\",\"random\",\"tidak selalu\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(489, 'PCG239', 'pc', 'BIOS mendeteksi error atau komponen tidak terbaca', 'Differential', '[\"bios error\",\"post fail\",\"komponen tidak terdeteksi bios\",\"debug led\"]', NULL, '0.90', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(490, 'PCG240', 'pc', 'Stress test menunjukkan error atau crash', 'Differential', '[\"stress test gagal\",\"prime95 error\",\"furmark crash\",\"cinebench crash\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(491, 'PCG241', 'pc', 'Komponen baru langsung bermasalah (DOA)', 'Differential', '[\"komponen baru rusak\",\"doa\",\"baru beli langsung error\",\"new part bermasalah\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(492, 'PCG242', 'pc', 'Masalah terjadi setelah PSU diganti', 'Differential', '[\"setelah ganti psu\",\"psu baru bermasalah\",\"post ganti psu error\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(493, 'PCG243', 'pc', 'Masalah terjadi di lingkungan berdebu / lembab', 'Differential', '[\"berdebu\",\"lembab\",\"humid\",\"tidak ada ac\",\"lingkungan kotor\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(494, 'PCG244', 'pc', 'PC stabil di safe mode tapi crash di normal mode', 'Differential', '[\"aman safe mode\",\"hanya crash normal\",\"safe mode ok\",\"normal mode error\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(495, 'PCG245', 'pc', 'Masalah terjadi setelah ganti thermal paste', 'Differential', '[\"setelah ganti thermal\",\"habis ganti pasta\",\"setelah servis cooler\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(496, 'PCG246', 'pc', 'Pesan error spesifik di BSOD berulang', 'Differential', '[\"kode bsod sama\",\"stop code berulang\",\"error code tetap\",\"bsod kode tetap\"]', NULL, '0.70', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(497, 'PCG247', 'pc', 'Masalah hanya dengan konfigurasi komponen tertentu', 'Differential', '[\"kombinasi tertentu crash\",\"dua ram ini tidak jalan\",\"gpu ini di slot ini error\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(498, 'PCG248', 'pc', 'Masalah setelah ganti motherboard baru', 'Differential', '[\"habis ganti mobo\",\"setelah install mobo baru\",\"mobo baru bermasalah\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(499, 'PCG249', 'pc', 'Isolasi masalah dengan swap komponen berhasil ditemukan', 'Differential', '[\"swap berhasil isolasi\",\"tukar komponen ketemu masalahnya\",\"swap test ok\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(500, 'PCG250', 'pc', 'Masalah PC baru dirakit (first boot issue)', 'Differential', '[\"first boot\",\"rakitan baru\",\"PC baru dirakit tidak mau nyala\",\"build baru error\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(501, 'PCG251', 'pc', 'BSOD kode WHEA_UNCORRECTABLE_ERROR', 'Differential', '[\"whea uncorrectable\",\"whea error\",\"hardware error bsod\",\"machine check exception\"]', NULL, '0.90', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(502, 'PCG252', 'pc', 'PC menyala tapi segera mati (no POST, no beep)', 'Differential', '[\"nyala sebentar\",\"segera mati\",\"on sebentar off\",\"no post no beep\"]', NULL, '0.90', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(503, 'PCG253', 'pc', 'Masalah setelah ganti OS / dual boot', 'Differential', '[\"habis install os baru\",\"dual boot masalah\",\"ganti windows\",\"setelah install linux\"]', NULL, '0.50', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(504, 'PCG254', 'pc', 'Masalah hanya tanpa UPS / stabilizer', 'Differential', '[\"tanpa ups\",\"listrik langsung\",\"fluktuasi pln\",\"tidak pakai stabilizer\"]', NULL, '0.60', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(505, 'PCG255', 'pc', 'Semua komponen baru tapi PC tetap tidak mau POST', 'Differential', '[\"komponen semua baru tidak post\",\"full new build no post\",\"build baru gagal\"]', NULL, '0.80', '2026-03-12 15:25:41', '2026-04-01 06:32:21', 2, NULL),
(506, 'AIOG001', 'aio', 'AIO tidak mau menyala sama sekali', 'Adaptor', '[\"aio mati total\",\"tidak mau nyala\",\"tidak hidup\",\"no power aio\",\"ga bisa dinyalakan\"]', NULL, '1.00', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 22),
(507, 'AIOG002', 'aio', 'Adaptor AIO tidak mengisi / indikator daya mati', 'Adaptor', '[\"adaptor tidak charge\",\"power brick tidak kerja\",\"charger aio mati\",\"ga ada daya masuk\"]', NULL, '0.90', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 22),
(508, 'AIOG003', 'aio', 'Lampu indikator power AIO tidak menyala', 'Adaptor', '[\"led power mati\",\"lampu power tidak nyala\",\"indicator off\",\"status light mati\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 22),
(509, 'AIOG004', 'aio', 'AIO mati tiba-tiba saat digunakan', 'Adaptor', '[\"mati mendadak\",\"shutdown tiba-tiba\",\"mati sendiri\",\"auto off aio\"]', NULL, '0.90', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 22),
(510, 'AIOG005', 'aio', 'AIO menyala sebentar lalu langsung mati', 'Adaptor', '[\"nyala sebentar mati\",\"hidup bentar off\",\"flash power aio\",\"on sebentar mati\"]', NULL, '0.90', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 22),
(511, 'AIOG006', 'aio', 'Adaptor AIO terasa sangat panas', 'Adaptor', '[\"adaptor panas\",\"power brick kepanasan\",\"charger aio overheat\",\"brick terlalu panas\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 22),
(512, 'AIOG007', 'aio', 'Ada bau terbakar dari adaptor', 'Adaptor', '[\"bau adaptor\",\"hangus dari power brick\",\"bau gosong charger\",\"burnt smell adaptor\"]', NULL, '1.00', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 22),
(513, 'AIOG008', 'aio', 'Kabel adaptor rusak / terkelupas', 'Adaptor', '[\"kabel adaptor putus\",\"kabel charger rusak\",\"wire adaptor terkelupas\",\"kabel brick\"]', NULL, '0.80', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 22),
(514, 'AIOG009', 'aio', 'Port DC jack AIO longgar / rusak', 'Adaptor', '[\"port power longgar\",\"colokan adaptor oblak\",\"dc in jack rusak\",\"soket power goyang\"]', NULL, '0.80', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 22),
(515, 'AIOG010', 'aio', 'AIO mati saat menjalankan aplikasi berat', 'Adaptor', '[\"mati saat edit\",\"shutdown berat\",\"mati banyak aplikasi\",\"adaptor tidak cukup daya\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 22),
(516, 'AIOG011', 'aio', 'Adaptor bukan original / beda spesifikasi', 'Adaptor', '[\"adaptor kw\",\"bukan original\",\"beda voltase\",\"watt tidak sesuai\",\"adaptor pengganti\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 22),
(517, 'AIOG012', 'aio', 'Indikator charging AIO berkedip tidak normal', 'Adaptor', '[\"led charging kedip aneh\",\"indikator cas tidak stabil\",\"lampu power flicker\"]', NULL, '0.60', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 22),
(518, 'AIOG013', 'aio', 'AIO tidak bisa menyala tanpa adaptor terhubung', 'Adaptor', '[\"hanya bisa pakai adaptor\",\"langsung mati tanpa adaptor\",\"tidak ada baterai cadangan\"]', NULL, '0.50', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 22),
(519, 'AIOG014', 'aio', 'Tombol power AIO tidak merespon', 'Adaptor', '[\"tombol power mati\",\"power button tidak respon\",\"tombol nyala tidak fungsi aio\"]', NULL, '0.80', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 22),
(520, 'AIOG015', 'aio', 'AIO restart sendiri berulang kali', 'Adaptor', '[\"restart sendiri\",\"reboot loop\",\"auto restart aio\",\"restart terus aio\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 22),
(521, 'AIOG016', 'aio', 'Layar AIO tidak menampilkan gambar sama sekali', 'Display', '[\"layar mati\",\"blank\",\"no display\",\"layar hitam\",\"tidak ada tampilan\",\"screen gelap\"]', NULL, '1.00', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 23),
(522, 'AIOG017', 'aio', 'Layar AIO bergaris vertikal atau horizontal', 'Display', '[\"layar bergaris\",\"garis di layar\",\"stripe layar\",\"garis vertikal horizontal display\"]', NULL, '0.90', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 23),
(523, 'AIOG018', 'aio', 'Layar AIO redup atau backlight sangat lemah', 'Display', '[\"layar redup\",\"layar gelap\",\"backlight redup\",\"display kurang terang\",\"dim screen\"]', NULL, '0.80', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 23),
(524, 'AIOG019', 'aio', 'Layar AIO berkedip / flicker', 'Display', '[\"layar kedip\",\"flicker\",\"kelap kelip\",\"layar tidak stabil\",\"display berkedip aio\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 23),
(525, 'AIOG020', 'aio', 'Layar AIO pecah atau retak', 'Display', '[\"layar pecah\",\"layar retak\",\"crack display\",\"screen broken\",\"panel retak\",\"pecah fisik\"]', NULL, '1.00', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 23),
(526, 'AIOG021', 'aio', 'Warna layar AIO tidak akurat atau pudar', 'Display', '[\"warna salah\",\"warna pudar\",\"color cast\",\"warna layar berubah\",\"color tidak tepat\"]', NULL, '0.60', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 23),
(527, 'AIOG022', 'aio', 'Bercak putih atau noda terang di layar', 'Display', '[\"bercak putih\",\"white spot\",\"pressure mark\",\"noda terang di layar\",\"backlight bleed\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 23),
(528, 'AIOG023', 'aio', 'Dead pixel atau stuck pixel di layar', 'Display', '[\"dead pixel\",\"pixel mati\",\"titik hitam\",\"pixel stuck\",\"bintik tidak berubah\"]', NULL, '0.60', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 23),
(529, 'AIOG024', 'aio', 'Layar AIO hanya menyala setengah atau sebagian', 'Display', '[\"setengah layar\",\"sebagian mati\",\"half screen\",\"bagian bawah mati\",\"atas mati\"]', NULL, '0.80', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 23),
(530, 'AIOG025', 'aio', 'Layar AIO mati total tapi AIO masih hidup', 'Display', '[\"backlight mati\",\"layar gelap tapi ada suara\",\"ada gambar samar dengan senter\"]', NULL, '0.90', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 23),
(531, 'AIOG026', 'aio', 'Layar bermasalah saat body AIO ditekan atau digerakkan', 'Display', '[\"muncul saat ditekan\",\"berubah saat digeser\",\"flex cable layar\",\"gambar saat ditekan\"]', NULL, '0.80', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 23),
(532, 'AIOG027', 'aio', 'Layar AIO menampilkan artefak atau glitch visual', 'Display', '[\"artefak grafis\",\"kotak warna acak\",\"glitch display\",\"visual artifact\",\"noise display\"]', NULL, '0.80', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 23),
(533, 'AIOG028', 'aio', 'Resolusi layar tidak bisa diubah atau stuck rendah', 'Display', '[\"resolusi salah\",\"stuck resolusi\",\"resolusi rendah terus\",\"display resolution error\"]', NULL, '0.50', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 23),
(534, 'AIOG029', 'aio', 'Layar AIO menguning atau warna berubah karena usia', 'Display', '[\"layar kuning\",\"yellowish\",\"warna menguning\",\"panel aging\",\"layar tua berubah warna\"]', NULL, '0.50', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 23),
(535, 'AIOG030', 'aio', 'Bayangan atau ghosting di layar AIO', 'Display', '[\"bayangan layar\",\"ghost image\",\"shadow display\",\"afterimage\",\"residual image aio\"]', NULL, '0.60', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, 23),
(536, 'AIOG031', 'aio', 'Touchscreen tidak merespon sentuhan sama sekali', 'Touchscreen', '[\"touchscreen mati\",\"layar sentuh tidak respon\",\"touch tidak jalan\",\"sentuhan tidak terbaca\"]', NULL, '0.90', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(537, 'AIOG032', 'aio', 'Touchscreen ghost touch (klik atau gerak sendiri)', 'Touchscreen', '[\"ghost touch\",\"sentuh sendiri\",\"klik sendiri\",\"pointer gerak sendiri\",\"phantom touch\"]', NULL, '0.80', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(538, 'AIOG033', 'aio', 'Touchscreen hanya sebagian area yang responsif', 'Touchscreen', '[\"sebagian touch\",\"area tertentu tidak respon\",\"dead zone touch\",\"touch tidak merata\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(539, 'AIOG034', 'aio', 'Sentuhan tidak akurat / meleset dari target', 'Touchscreen', '[\"touch tidak tepat\",\"offset\",\"klik meleset\",\"touch tidak akurat\",\"kalibrasi touch\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(540, 'AIOG035', 'aio', 'Multi-touch atau gesture tidak berfungsi', 'Touchscreen', '[\"pinch zoom tidak bisa\",\"multi touch error\",\"gesture mati\",\"dua jari tidak fungsi\"]', NULL, '0.60', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(541, 'AIOG036', 'aio', 'Touchscreen tidak terdeteksi di Device Manager', 'Touchscreen', '[\"touch device hilang\",\"digitizer tidak terdeteksi\",\"HID touch tidak ada di device manager\"]', NULL, '0.80', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(542, 'AIOG037', 'aio', 'Touchscreen bermasalah setelah update Windows', 'Touchscreen', '[\"touch error update\",\"digitizer driver hilang\",\"update bikin touch mati aio\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(543, 'AIOG038', 'aio', 'Digitizer AIO longgar atau berbunyi saat disentuh', 'Touchscreen', '[\"digitizer goyang\",\"bunyi saat disentuh\",\"panel touch oblak\",\"digitizer tidak rapat\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(544, 'AIOG039', 'aio', 'Touchscreen tidak berfungsi setelah ganti panel', 'Touchscreen', '[\"touch mati setelah ganti layar\",\"digitizer tidak nyambung\",\"ganti panel touch mati\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(545, 'AIOG040', 'aio', 'Kalibrasi touchscreen tidak bisa dilakukan', 'Touchscreen', '[\"kalibrasi gagal\",\"calibration error\",\"tidak bisa kalibrasi layar sentuh aio\"]', NULL, '0.50', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(546, 'AIOG041', 'aio', 'Stylus pen tidak terdeteksi di AIO', 'Touchscreen', '[\"stylus tidak terbaca\",\"pen tidak berfungsi\",\"active pen error\",\"stylus aio mati\"]', NULL, '0.60', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(547, 'AIOG042', 'aio', 'Touchscreen lambat merespon sentuhan', 'Touchscreen', '[\"touch delay\",\"sentuhan lambat\",\"respons touch pelan\",\"lag touch aio\"]', NULL, '0.50', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(548, 'AIOG043', 'aio', 'AIO tidak POST sama sekali saat dinyalakan', 'Motherboard', '[\"tidak post\",\"no post\",\"blank saat nyala\",\"tidak ada tampilan booting\",\"post gagal aio\"]', NULL, '0.90', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(549, 'AIOG044', 'aio', 'BIOS AIO tidak menyimpan setting, tanggal selalu reset', 'Motherboard', '[\"bios reset\",\"tanggal selalu salah\",\"waktu reset\",\"cmos reset aio\",\"jam aio reset\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(550, 'AIOG045', 'aio', 'Beberapa port USB di body AIO tidak berfungsi', 'Motherboard', '[\"usb body mati\",\"port usb tertentu aio tidak jalan\",\"beberapa usb aio error\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(551, 'AIOG046', 'aio', 'AIO BSOD berulang dengan berbagai kode error', 'Motherboard', '[\"bsod aio\",\"blue screen aio\",\"bsod random\",\"banyak kode bsod\",\"bsod terus\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(552, 'AIOG047', 'aio', 'Ada bau terbakar dari dalam body AIO', 'Motherboard', '[\"bau terbakar dalam aio\",\"bau gosong dari dalam\",\"hangus komponen aio\"]', NULL, '1.00', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(553, 'AIOG048', 'aio', 'Komponen tidak terdeteksi di BIOS AIO', 'Motherboard', '[\"komponen hilang bios\",\"device tidak terdeteksi\",\"hardware tidak terbaca bios\"]', NULL, '0.80', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(554, 'AIOG049', 'aio', 'Kapasitor atau komponen di motherboard AIO rusak fisik', 'Motherboard', '[\"kapasitor kembung\",\"komponen terbakar\",\"fisik motherboard rusak aio\"]', NULL, '0.90', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(555, 'AIOG050', 'aio', 'LAN onboard AIO tidak berfungsi', 'Motherboard', '[\"lan onboard mati\",\"ethernet aio rusak\",\"port lan aio tidak jalan\",\"nic onboard aio\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(556, 'AIOG051', 'aio', 'Audio onboard AIO tidak berfungsi', 'Motherboard', '[\"audio onboard mati\",\"sound aio\",\"realtek aio error\",\"audio chip rusak aio\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(557, 'AIOG052', 'aio', 'WiFi onboard AIO tidak berfungsi', 'Motherboard', '[\"wifi aio mati\",\"wireless aio tidak jalan\",\"wifi onboard rusak\",\"wlan aio mati\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(558, 'AIOG053', 'aio', 'BIOS AIO corrupt atau perlu di-flash', 'Motherboard', '[\"bios aio corrupt\",\"bios rusak\",\"perlu flash bios\",\"uefi aio error\",\"bios brick aio\"]', NULL, '0.80', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(559, 'AIOG054', 'aio', 'Slot RAM SO-DIMM AIO tidak berfungsi', 'Motherboard', '[\"slot ram aio mati\",\"sodimm slot error\",\"ram di slot tertentu tidak kebaca aio\"]', NULL, '0.80', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(560, 'AIOG055', 'aio', 'AIO sering crash atau freeze secara acak', 'Motherboard', '[\"crash acak\",\"tidak stabil\",\"hang random\",\"freeze random aio\",\"labil aio\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(561, 'AIOG056', 'aio', 'AIO tidak bisa boot dari storage manapun', 'Motherboard', '[\"tidak bisa boot\",\"no bootable\",\"semua storage tidak bisa boot aio\"]', NULL, '0.80', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(562, 'AIOG057', 'aio', 'AIO bunyi beep saat dinyalakan', 'Motherboard', '[\"beep aio\",\"bunyi beep\",\"beep code aio\",\"suara beep saat nyala aio\"]', NULL, '0.80', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(563, 'AIOG058', 'aio', 'Suhu CPU AIO sangat tinggi di atas 90°C', 'CPU', '[\"cpu aio panas\",\"suhu cpu tinggi aio\",\"overheat cpu aio\",\"cpu 90 derajat aio\"]', NULL, '0.90', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(564, 'AIOG059', 'aio', 'CPU AIO throttling (performa turun drastis saat panas)', 'CPU', '[\"cpu throttle aio\",\"cpu melambat panas\",\"clock turun aio\",\"performa turun saat panas\"]', NULL, '0.80', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(565, 'AIOG060', 'aio', 'AIO crash atau BSOD saat CPU load tinggi', 'CPU', '[\"bsod cpu full aio\",\"crash render aio\",\"bsod encoding aio\",\"crash cpu tinggi\"]', NULL, '0.80', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(566, 'AIOG061', 'aio', 'CPU AIO tidak terdeteksi di BIOS', 'CPU', '[\"cpu tidak terbaca aio\",\"prosesor tidak terdeteksi\",\"cpu error bios aio\"]', NULL, '0.90', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(567, 'AIOG062', 'aio', 'Performa AIO jauh di bawah normal', 'CPU', '[\"aio lambat\",\"performa buruk\",\"benchmark jelek aio\",\"cpu lemot aio\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(568, 'AIOG063', 'aio', 'Suhu CPU AIO tinggi bahkan saat idle', 'CPU', '[\"cpu panas idle aio\",\"60 derajat idle aio\",\"panas tanpa beban aio\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(569, 'AIOG064', 'aio', 'Kipas pendingin CPU AIO tidak berputar', 'CPU', '[\"fan cpu aio mati\",\"kipas aio diam\",\"internal fan tidak jalan\",\"fan dalam aio mati\"]', NULL, '0.90', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(570, 'AIOG065', 'aio', 'Thermal paste CPU AIO sudah kering atau lama', 'CPU', '[\"pasta kering aio\",\"thermal compound lama aio\",\"belum ganti thermal paste aio\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(571, 'AIOG066', 'aio', 'Heatsink CPU AIO tidak terpasang rapat', 'CPU', '[\"heatsink longgar aio\",\"pendingin cpu aio tidak rapat\",\"cooler aio goyang\"]', NULL, '0.80', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(572, 'AIOG067', 'aio', 'AIO restart saat CPU beban penuh', 'CPU', '[\"restart saat cpu penuh aio\",\"reboot render aio\",\"restart encoding aio\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(573, 'AIOG068', 'aio', 'CPU usage AIO selalu 100% tanpa alasan', 'CPU', '[\"cpu 100 persen aio\",\"cpu full terus\",\"cpu selalu penuh tanpa beban aio\"]', NULL, '0.60', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(574, 'AIOG069', 'aio', 'AIO tidak POST karena RAM', 'RAM SO-DIMM', '[\"ram tidak post aio\",\"no post ram\",\"dram error aio\",\"ram tidak kebaca aio\"]', NULL, '0.90', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(575, 'AIOG070', 'aio', 'AIO BSOD dengan kode error memori', 'RAM SO-DIMM', '[\"bsod memory aio\",\"memory management error aio\",\"page fault aio\",\"bsod ram\"]', NULL, '0.80', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(576, 'AIOG071', 'aio', 'Kapasitas RAM terbaca lebih kecil', 'RAM SO-DIMM', '[\"ram terbaca setengah\",\"kapasitas salah\",\"16gb terbaca 8gb\",\"usable ram berkurang aio\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(577, 'AIOG072', 'aio', 'AIO freeze atau hang secara acak', 'RAM SO-DIMM', '[\"freeze acak aio\",\"hang tiba-tiba aio\",\"aio macet random\",\"pc macet aio\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(578, 'AIOG073', 'aio', 'Memtest86 menunjukkan error pada RAM', 'RAM SO-DIMM', '[\"memtest error aio\",\"ram test gagal\",\"memory test fail\",\"memtest86 error aio\"]', NULL, '0.90', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(579, 'AIOG074', 'aio', 'RAM SO-DIMM baru tidak terdeteksi setelah upgrade', 'RAM SO-DIMM', '[\"ram upgrade tidak terbaca\",\"sodimm baru tidak terdeteksi\",\"upgrade ram aio gagal\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(580, 'AIOG075', 'aio', 'Kecepatan RAM AIO di bawah spesifikasi', 'RAM SO-DIMM', '[\"ram lambat aio\",\"xmp tidak aktif\",\"ram speed rendah\",\"frequency ram salah aio\"]', NULL, '0.60', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(581, 'AIOG076', 'aio', 'Slot SO-DIMM tertentu tidak berfungsi', 'RAM SO-DIMM', '[\"slot ram mati aio\",\"sodimm slot error\",\"ram di slot tertentu tidak kebaca\"]', NULL, '0.80', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(582, 'AIOG077', 'aio', 'Kontak SO-DIMM kotor atau teroksidasi', 'RAM SO-DIMM', '[\"ram kotor aio\",\"pin sodimm oksidasi\",\"kontak ram kusam aio\",\"pin ram kuning\"]', NULL, '0.60', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(583, 'AIOG078', 'aio', 'RAM SO-DIMM longgar di slot', 'RAM SO-DIMM', '[\"ram tidak klik aio\",\"sodimm miring\",\"ram tidak sempurna aio\",\"ram goyang slot\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(584, 'AIOG079', 'aio', 'AIO crash saat membuka banyak aplikasi', 'RAM SO-DIMM', '[\"crash banyak app aio\",\"bsod ram penuh\",\"out of memory aio\",\"crash memory habis\"]', NULL, '0.70', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(585, 'AIOG080', 'aio', 'Bunyi beep pola RAM saat AIO dinyalakan', 'RAM SO-DIMM', '[\"beep code ram aio\",\"pola beep memori\",\"kode beep ram post aio\"]', NULL, '0.80', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(586, 'AIOG081', 'aio', 'Storage AIO tidak terdeteksi di BIOS', 'Storage', '[\"drive tidak terdeteksi aio\",\"hdd ssd tidak kebaca bios aio\",\"storage hilang\"]', NULL, '0.90', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(587, 'AIOG082', 'aio', 'Bunyi klik dari HDD 2.5\" AIO', 'Storage', '[\"hdd klik aio\",\"klik klik\",\"clicking hdd 2.5\",\"hdd noise aio\",\"suara klik aio\"]', NULL, '0.90', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(588, 'AIOG083', 'aio', 'Windows tidak bisa booting di AIO', 'Storage', '[\"windows tidak boot aio\",\"gagal booting aio\",\"no bootable device aio\"]', NULL, '0.80', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(589, 'AIOG084', 'aio', 'Muncul peringatan SMART di CrystalDiskInfo', 'Storage', '[\"smart warning aio\",\"smart caution\",\"disk health bad aio\",\"reallocated sectors\"]', NULL, '0.90', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(590, 'AIOG085', 'aio', 'Bad sector terdeteksi di storage AIO', 'Storage', '[\"bad sector aio\",\"chkdsk error\",\"sektor rusak\",\"bad block aio\"]', NULL, '0.80', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(591, 'AIOG086', 'aio', 'Transfer data sangat lambat di AIO', 'Storage', '[\"transfer lambat aio\",\"copy pelan\",\"read write lambat\",\"disk speed rendah aio\"]', NULL, '0.60', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(592, 'AIOG087', 'aio', 'NVMe M.2 AIO tidak terdeteksi', 'Storage', '[\"nvme tidak terdeteksi aio\",\"m.2 hilang aio\",\"m.2 tidak kebaca\",\"nvme aio error\"]', NULL, '0.90', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(593, 'AIOG088', 'aio', 'Partisi storage AIO hilang', 'Storage', '[\"partisi hilang aio\",\"drive d hilang\",\"disk management kosong aio\"]', NULL, '0.80', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(594, 'AIOG089', 'aio', 'SSD AIO menjadi read-only', 'Storage', '[\"ssd read only aio\",\"tidak bisa nulis\",\"write protected ssd aio\"]', NULL, '0.90', '2026-03-12 15:25:43', '2026-04-01 06:32:21', 3, NULL),
(595, 'AIOG090', 'aio', 'Storage AIO sering disconnect', 'Storage', '[\"drive hilang aio\",\"storage intermittent\",\"disk on off aio\",\"drive reconnect\"]', NULL, '0.80', '2026-03-12 15:25:44', '2026-04-01 06:32:21', 3, NULL),
(596, 'AIOG091', 'aio', 'Konektor SATA atau slot M.2 AIO longgar', 'Storage', '[\"kabel sata longgar aio\",\"m.2 slot tidak kencang\",\"konektor storage goyang aio\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:21', 3, NULL),
(597, 'AIOG092', 'aio', 'Data di AIO corrupt atau tidak bisa diakses', 'Storage', '[\"data rusak aio\",\"file corrupt\",\"file tidak bisa dibuka aio\",\"data error\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:21', 3, NULL),
(598, 'AIOG093', 'aio', 'Body belakang AIO sangat panas saat disentuh', 'Thermal', '[\"body panas\",\"belakang aio panas\",\"housing panas\",\"casing belakang kepanasan\"]', NULL, '0.80', '2026-03-12 15:25:44', '2026-04-01 06:32:21', 3, 25),
(599, 'AIOG094', 'aio', 'Kipas internal AIO berputar kencang terus menerus', 'Thermal', '[\"fan kencang terus\",\"kipas berisik\",\"fan full speed aio\",\"suara fan terus\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:21', 3, 25),
(600, 'AIOG095', 'aio', 'Kipas internal AIO tidak berputar sama sekali', 'Thermal', '[\"fan aio mati\",\"kipas diam\",\"fan tidak jalan\",\"kipas dalam aio tidak berputar\"]', NULL, '0.90', '2026-03-12 15:25:44', '2026-04-01 06:32:21', 3, 25),
(601, 'AIOG096', 'aio', 'AIO mati karena overheat (thermal shutdown)', 'Thermal', '[\"mati karena panas\",\"thermal shutdown aio\",\"overheat protection\",\"mati kepanasan\"]', NULL, '0.90', '2026-03-12 15:25:44', '2026-04-01 06:32:21', 3, 25),
(602, 'AIOG097', 'aio', 'Suhu CPU atau GPU AIO tinggi saat idle', 'Thermal', '[\"suhu tinggi idle aio\",\"panas padahal santai\",\"idle overheat aio\"]', NULL, '0.80', '2026-03-12 15:25:44', '2026-04-01 06:32:21', 3, 25),
(603, 'AIOG098', 'aio', 'Performa AIO turun drastis setelah beberapa menit', 'Thermal', '[\"makin lambat panas\",\"throttle saat panas\",\"performa turun setelah lama\",\"thermal throttle\"]', NULL, '0.80', '2026-03-12 15:25:44', '2026-04-01 06:32:21', 3, 25),
(604, 'AIOG099', 'aio', 'Debu menumpuk di lubang ventilasi AIO', 'Thermal', '[\"debu aio\",\"ventilasi kotor\",\"lubang angin tersumbat\",\"kisi-kisi debu aio\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:21', 3, 25),
(605, 'AIOG100', 'aio', 'Thermal paste CPU atau GPU AIO sudah kering', 'Thermal', '[\"thermal paste kering aio\",\"pasta termal lama\",\"belum ganti thermal paste aio\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:21', 3, 25),
(606, 'AIOG101', 'aio', 'Heatsink AIO tidak menempel rapat ke chip', 'Thermal', '[\"heatsink longgar aio\",\"pendingin tidak rapat aio\",\"heatsink goyang aio\"]', NULL, '0.80', '2026-03-12 15:25:44', '2026-04-01 06:32:21', 3, 25),
(607, 'AIOG102', 'aio', 'Bunyi aneh dari area kipas dalam AIO', 'Thermal', '[\"bunyi kipas aio\",\"fan noise\",\"grinding fan aio\",\"kipas berbunyi aneh\"]', NULL, '0.60', '2026-03-12 15:25:44', '2026-04-01 06:32:21', 3, 25),
(608, 'AIOG103', 'aio', 'AIO panas hanya di satu titik tertentu (hotspot)', 'Thermal', '[\"hotspot aio\",\"area tertentu panas\",\"satu titik panas aio\",\"localized heat\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 25),
(609, 'AIOG104', 'aio', 'Ventilasi AIO tersumbat benda asing atau debu padat', 'Thermal', '[\"ventilasi tersumbat\",\"benda asing di ventilasi\",\"debu padat aio\",\"fan block\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 25);
INSERT INTO `symptoms` (`id`, `code`, `device_type`, `name`, `category`, `keywords`, `follow_up_question`, `weight`, `created_at`, `updated_at`, `device_type_id`, `device_component_id`) VALUES
(610, 'AIOG105', 'aio', 'AIO panas ekstrem saat video editing atau multitasking', 'Thermal', '[\"panas editing aio\",\"overheat multitasking\",\"thermal berat aio\",\"panas kerja berat\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 25),
(611, 'AIOG106', 'aio', 'Speaker internal AIO tidak ada suara', 'Audio', '[\"speaker mati aio\",\"tidak ada suara aio\",\"bisu aio\",\"audio mati\"]', NULL, '0.80', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 26),
(612, 'AIOG107', 'aio', 'Suara AIO pecah atau distorsi', 'Audio', '[\"suara pecah aio\",\"distorsi\",\"crackling aio\",\"suara kasar\",\"audio distorsi\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 26),
(613, 'AIOG108', 'aio', 'Volume AIO sangat kecil meski sudah maksimal', 'Audio', '[\"volume kecil aio\",\"suara tipis\",\"meski max tetap pelan aio\"]', NULL, '0.60', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 26),
(614, 'AIOG109', 'aio', 'Jack headphone AIO tidak berfungsi', 'Audio', '[\"jack mati aio\",\"headphone tidak bunyi aio\",\"jack audio rusak aio\",\"colokan headset aio\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 26),
(615, 'AIOG110', 'aio', 'Mikrofon internal AIO tidak berfungsi', 'Audio', '[\"mic mati aio\",\"microphone tidak jalan\",\"mic tidak terdeteksi aio\",\"mic builtin mati\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 26),
(616, 'AIOG111', 'aio', 'Audio device tidak terdeteksi di Windows', 'Audio', '[\"audio not detected aio\",\"no audio device\",\"sound hilang aio\",\"playback device kosong\"]', NULL, '0.80', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 26),
(617, 'AIOG112', 'aio', 'Suara AIO hanya dari satu speaker', 'Audio', '[\"speaker sebelah aio\",\"satu speaker mati\",\"mono aio\",\"speaker kiri atau kanan mati\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 26),
(618, 'AIOG113', 'aio', 'Audio AIO hilang setelah update Windows', 'Audio', '[\"audio hilang update aio\",\"driver audio update rusak\",\"audio mati setelah update\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 26),
(619, 'AIOG114', 'aio', 'Suara dengung atau hum dari speaker AIO', 'Audio', '[\"speaker dengung aio\",\"noise aio\",\"hum dari speaker\",\"speaker berdengung aio\"]', NULL, '0.60', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 26),
(620, 'AIOG115', 'aio', 'Audio HDMI dari AIO tidak berfungsi', 'Audio', '[\"hdmi audio aio\",\"audio via hdmi mati aio\",\"tidak ada suara hdmi aio\"]', NULL, '0.60', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 26),
(621, 'AIOG116', 'aio', 'Kabel speaker internal AIO longgar', 'Audio', '[\"kabel speaker aio\",\"koneksi speaker longgar\",\"kabel audio internal lepas\"]', NULL, '0.60', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 26),
(622, 'AIOG117', 'aio', 'WiFi AIO tidak terdeteksi atau hilang', 'Konektivitas', '[\"wifi hilang aio\",\"tidak ada wifi\",\"wifi tidak terdeteksi aio\",\"no wireless network\"]', NULL, '0.80', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 27),
(623, 'AIOG118', 'aio', 'WiFi AIO sering putus atau tidak stabil', 'Konektivitas', '[\"wifi putus aio\",\"disconnect wifi aio\",\"wifi tidak stabil\",\"intermittent wifi aio\"]', NULL, '0.60', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 27),
(624, 'AIOG119', 'aio', 'LAN / Ethernet AIO tidak berfungsi', 'Konektivitas', '[\"lan mati aio\",\"ethernet aio error\",\"kabel lan tidak jalan aio\",\"rj45 aio\"]', NULL, '0.80', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 27),
(625, 'AIOG120', 'aio', 'Bluetooth AIO tidak berfungsi', 'Konektivitas', '[\"bluetooth mati aio\",\"bt tidak jalan\",\"bluetooth hilang aio\",\"bt device tidak konek\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 27),
(626, 'AIOG121', 'aio', 'Sinyal WiFi AIO sangat lemah', 'Konektivitas', '[\"sinyal wifi lemah aio\",\"jangkauan pendek\",\"wifi bar sedikit\",\"wifi kecil aio\"]', NULL, '0.60', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 27),
(627, 'AIOG122', 'aio', 'Driver WiFi atau LAN AIO bermasalah', 'Konektivitas', '[\"driver wifi hilang aio\",\"driver lan tidak ada\",\"network driver error aio\"]', NULL, '0.80', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 27),
(628, 'AIOG123', 'aio', 'WiFi AIO terhubung tapi tidak ada internet', 'Konektivitas', '[\"connected no internet aio\",\"limited aio\",\"konek tapi tidak bisa browsing\"]', NULL, '0.50', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 27),
(629, 'AIOG124', 'aio', 'Bluetooth bisa scan tapi tidak bisa pairing', 'Konektivitas', '[\"bt tidak bisa pair\",\"pairing failed aio\",\"bluetooth gagal connect aio\"]', NULL, '0.50', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 27),
(630, 'AIOG125', 'aio', 'Modul WiFi / Bluetooth AIO tidak terdeteksi', 'Konektivitas', '[\"wifi card hilang aio\",\"wireless adapter tidak ada\",\"wlan device not found aio\"]', NULL, '0.90', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 27),
(631, 'AIOG126', 'aio', 'Antena WiFi internal AIO bermasalah', 'Konektivitas', '[\"antena wifi internal aio\",\"kabel antena putus\",\"sinyal lemah antena aio\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 27),
(632, 'AIOG127', 'aio', 'LAN AIO tidak stabil atau sering disconnect', 'Konektivitas', '[\"lan putus aio\",\"ethernet intermittent aio\",\"koneksi kabel tidak stabil aio\"]', NULL, '0.60', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 27),
(633, 'AIOG128', 'aio', 'Koneksi AIO bermasalah setelah update Windows', 'Konektivitas', '[\"network error setelah update aio\",\"koneksi mati update\",\"driver network update\"]', NULL, '0.60', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 27),
(634, 'AIOG129', 'aio', 'Kamera AIO tidak berfungsi sama sekali', 'Webcam', '[\"kamera mati aio\",\"webcam tidak jalan\",\"camera aio error\",\"kamera tidak berfungsi\"]', NULL, '0.80', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(635, 'AIOG130', 'aio', 'Kamera AIO tidak terdeteksi di Device Manager', 'Webcam', '[\"kamera tidak terdeteksi aio\",\"webcam hilang\",\"no camera device aio\"]', NULL, '0.80', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(636, 'AIOG131', 'aio', 'Gambar kamera AIO buram atau tidak fokus', 'Webcam', '[\"kamera buram aio\",\"webcam blur\",\"kamera tidak fokus aio\",\"kamera kabur\"]', NULL, '0.60', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(637, 'AIOG132', 'aio', 'Kamera AIO menampilkan layar hitam', 'Webcam', '[\"kamera nyala tapi hitam\",\"black screen camera aio\",\"detected tapi hitam\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(638, 'AIOG133', 'aio', 'Privacy shutter fisik menutup kamera AIO', 'Webcam', '[\"shutter tertutup\",\"penutup kamera aio\",\"privacy cover aio\",\"shutter fisik\"]', NULL, '0.50', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(639, 'AIOG134', 'aio', 'LED indikator kamera tidak menyala', 'Webcam', '[\"led kamera mati aio\",\"lampu kamera tidak nyala\",\"indicator cam off aio\"]', NULL, '0.50', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(640, 'AIOG135', 'aio', 'Kamera diblokir privacy settings Windows', 'Webcam', '[\"kamera diblokir windows\",\"camera blocked\",\"privacy settings kamera\",\"app tidak izin\"]', NULL, '0.50', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(641, 'AIOG136', 'aio', 'Kamera bermasalah hanya di aplikasi tertentu', 'Webcam', '[\"error di zoom\",\"error di meet\",\"kamera hanya error satu app aio\"]', NULL, '0.40', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(642, 'AIOG137', 'aio', 'Konektor kabel kamera AIO longgar', 'Webcam', '[\"konektor kamera longgar aio\",\"kabel kamera aio tidak terpasang\",\"ribbon kamera\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(643, 'AIOG138', 'aio', 'Kamera AIO sering freeze saat digunakan', 'Webcam', '[\"kamera freeze aio\",\"webcam macet\",\"camera hang aio\",\"video call macet\"]', NULL, '0.50', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(644, 'AIOG139', 'aio', 'Port USB di body AIO tidak berfungsi', 'Peripheral', '[\"usb mati aio\",\"port usb rusak aio\",\"usb tidak terbaca aio\",\"flashdisk aio mati\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(645, 'AIOG140', 'aio', 'Port USB-C di AIO tidak berfungsi', 'Peripheral', '[\"usb c aio mati\",\"type-c aio error\",\"usb-c tidak jalan aio\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(646, 'AIOG141', 'aio', 'Port HDMI output AIO tidak berfungsi', 'Peripheral', '[\"hdmi out aio\",\"hdmi output mati aio\",\"tidak bisa ke monitor eksternal aio\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(647, 'AIOG142', 'aio', 'Card reader AIO tidak berfungsi', 'Peripheral', '[\"card reader mati aio\",\"sd card tidak terbaca aio\",\"memori card aio error\"]', NULL, '0.50', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(648, 'AIOG143', 'aio', 'Keyboard wireless bawaan AIO tidak berfungsi', 'Peripheral', '[\"keyboard wireless aio\",\"keyboard bundle aio mati\",\"keyboard tidak jalan aio\"]', NULL, '0.60', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(649, 'AIOG144', 'aio', 'Mouse wireless bawaan AIO tidak berfungsi', 'Peripheral', '[\"mouse wireless aio\",\"mouse bundle aio mati\",\"mouse tidak jalan aio\"]', NULL, '0.60', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(650, 'AIOG145', 'aio', 'Receiver USB keyboard atau mouse AIO tidak konek', 'Peripheral', '[\"receiver tidak jalan\",\"dongle keyboard mouse aio\",\"unifying receiver error aio\"]', NULL, '0.50', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(651, 'AIOG146', 'aio', 'Semua port USB AIO mati sekaligus', 'Peripheral', '[\"semua usb mati aio\",\"all usb dead aio\",\"seluruh port usb aio mati\"]', NULL, '0.80', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(652, 'AIOG147', 'aio', 'USB AIO hanya bisa charging tidak transfer data', 'Peripheral', '[\"usb cas saja aio\",\"charging only usb aio\",\"data transfer usb tidak bisa aio\"]', NULL, '0.60', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(653, 'AIOG148', 'aio', 'Fingerprint reader AIO tidak berfungsi', 'Peripheral', '[\"fingerprint mati aio\",\"sidik jari aio error\",\"biometric aio tidak jalan\"]', NULL, '0.50', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(654, 'AIOG149', 'aio', 'Docking station tidak berfungsi di AIO', 'Peripheral', '[\"docking aio tidak jalan\",\"dock usb-c aio error\",\"usb-c dock tidak terdeteksi\"]', NULL, '0.50', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(655, 'AIOG150', 'aio', 'Windows AIO sering BSOD', 'Software', '[\"bsod aio\",\"blue screen aio\",\"bluescreen aio\",\"crash windows aio\",\"layar biru\"]', NULL, '0.80', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 24),
(656, 'AIOG151', 'aio', 'AIO sangat lambat atau lag', 'Software', '[\"aio lambat\",\"aio lemot\",\"lag aio\",\"slow aio\",\"performa buruk aio\"]', NULL, '0.60', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 24),
(657, 'AIOG152', 'aio', 'Virus atau malware terdeteksi di AIO', 'Software', '[\"virus aio\",\"malware aio\",\"kena virus\",\"trojan aio\",\"ransomware aio\"]', NULL, '0.80', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 24),
(658, 'AIOG153', 'aio', 'Windows AIO tidak bisa booting', 'Software', '[\"windows tidak boot aio\",\"gagal booting aio\",\"no bootable aio\",\"os tidak jalan\"]', NULL, '0.90', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 24),
(659, 'AIOG154', 'aio', 'Startup AIO sangat lambat', 'Software', '[\"startup lambat aio\",\"booting lama aio\",\"windows lama muncul aio\"]', NULL, '0.60', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 24),
(660, 'AIOG155', 'aio', 'Bloatware vendor AIO memperlambat sistem', 'Software', '[\"bloatware aio\",\"software bawaan berat\",\"aplikasi vendor memperlambat aio\"]', NULL, '0.50', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 24),
(661, 'AIOG156', 'aio', 'Driver tidak kompatibel setelah update OS', 'Software', '[\"driver rusak update aio\",\"incompatible driver\",\"driver error setelah update\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 24),
(662, 'AIOG157', 'aio', 'File system AIO corrupt atau RAW', 'Software', '[\"file system raw aio\",\"partisi raw\",\"disk management error aio\",\"fs corrupt\"]', NULL, '0.80', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 24),
(663, 'AIOG158', 'aio', 'AIO masuk repair loop terus-menerus', 'Software', '[\"repair loop aio\",\"preparing automatic repair terus\",\"boot repair loop aio\"]', NULL, '0.80', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 24),
(664, 'AIOG159', 'aio', 'Profile user Windows AIO corrupt', 'Software', '[\"user profile corrupt aio\",\"tidak bisa login\",\"akun windows error aio\"]', NULL, '0.60', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 24),
(665, 'AIOG160', 'aio', 'Recovery atau factory reset AIO tidak berfungsi', 'Software', '[\"recovery aio error\",\"factory reset aio tidak bisa\",\"reset aio gagal\"]', NULL, '0.60', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 24),
(666, 'AIOG161', 'aio', 'Windows Update AIO gagal atau stuck', 'Software', '[\"update error aio\",\"windows update gagal aio\",\"update stuck aio\"]', NULL, '0.50', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 24),
(667, 'AIOG162', 'aio', 'Task Manager AIO menampilkan proses tidak dikenal', 'Software', '[\"proses aneh aio\",\"task manager mencurigakan\",\"unknown process aio\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, 24),
(668, 'AIOG163', 'aio', 'Masalah terjadi setelah upgrade RAM SO-DIMM atau storage', 'Differential', '[\"setelah upgrade ram\",\"habis ganti ssd\",\"pasang ram baru aio\"]', NULL, '0.80', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(669, 'AIOG164', 'aio', 'Masalah terjadi setelah update Windows atau driver', 'Differential', '[\"setelah update\",\"habis update driver\",\"windows update bermasalah aio\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(670, 'AIOG165', 'aio', 'Masalah terjadi setelah AIO dibersihkan atau diservis', 'Differential', '[\"setelah servis\",\"habis dibersihkan\",\"setelah dibuka teknisi aio\"]', NULL, '0.60', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(671, 'AIOG166', 'aio', 'Masalah terjadi setelah AIO jatuh atau terbentur', 'Differential', '[\"jatuh aio\",\"terbentur\",\"kena banting\",\"drop aio\",\"terjatuh aio\"]', NULL, '0.90', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(672, 'AIOG167', 'aio', 'Masalah terjadi setelah adaptor diganti ke non-original', 'Differential', '[\"setelah ganti adaptor\",\"adaptor baru bermasalah\",\"charger pengganti aio\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(673, 'AIOG168', 'aio', 'Masalah hanya muncul saat AIO sudah panas', 'Differential', '[\"saat panas\",\"thermal dependent aio\",\"setelah lama pakai aio\"]', NULL, '0.80', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(674, 'AIOG169', 'aio', 'Masalah terjadi setelah terkena air atau cairan', 'Differential', '[\"kena air aio\",\"tumpahan aio\",\"basah aio\",\"water damage aio\"]', NULL, '0.90', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(675, 'AIOG170', 'aio', 'Masalah terjadi secara bertahap makin parah', 'Differential', '[\"makin parah aio\",\"bertahap\",\"progressive\",\"lama kelamaan rusak\"]', NULL, '0.60', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(676, 'AIOG171', 'aio', 'Masalah terjadi tiba-tiba tanpa gejala sebelumnya', 'Differential', '[\"tiba-tiba aio\",\"mendadak\",\"tanpa gejala\",\"langsung rusak\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(677, 'AIOG172', 'aio', 'Masalah hilang setelah AIO di-restart', 'Differential', '[\"sembuh restart aio\",\"hilang setelah reboot\",\"restart memperbaiki sementara\"]', NULL, '0.50', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(678, 'AIOG173', 'aio', 'Masalah tetap ada setelah reinstall Windows', 'Differential', '[\"masih ada reinstall aio\",\"hardware problem aio\",\"bukan software\"]', NULL, '0.80', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(679, 'AIOG174', 'aio', 'Masalah muncul di semua OS termasuk Linux', 'Differential', '[\"linux juga aio\",\"semua os aio\",\"os independent\",\"bukan software murni\"]', NULL, '0.80', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(680, 'AIOG175', 'aio', 'Masalah hanya pada fitur spesifik AIO (touch / kamera / audio)', 'Differential', '[\"hanya touch\",\"hanya kamera\",\"hanya audio\",\"fitur tertentu aio\"]', NULL, '0.60', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(681, 'AIOG176', 'aio', 'AIO baru dibeli tapi langsung bermasalah', 'Differential', '[\"baru beli aio\",\"masih baru\",\"DOA aio\",\"out of box defect\"]', NULL, '0.80', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(682, 'AIOG177', 'aio', 'Semua fitur AIO bermasalah bersamaan', 'Differential', '[\"semua fitur mati aio\",\"total failure\",\"semua tidak jalan aio\"]', NULL, '0.90', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(683, 'AIOG178', 'aio', 'Masalah setelah ganti panel atau layar AIO', 'Differential', '[\"setelah ganti layar aio\",\"habis ganti panel\",\"service layar aio\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(684, 'AIOG179', 'aio', 'Stress test menunjukkan error di AIO', 'Differential', '[\"stress test gagal aio\",\"cinebench crash aio\",\"benchmark error aio\"]', NULL, '0.80', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(685, 'AIOG180', 'aio', 'Masalah lebih parah di ruangan panas tanpa AC', 'Differential', '[\"tanpa ac aio\",\"ruangan panas aio\",\"suhu ruang tinggi aio\"]', NULL, '0.60', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(686, 'AIOG181', 'aio', 'Komponen baru yang dipasang langsung bermasalah', 'Differential', '[\"komponen baru error aio\",\"DOA part aio\",\"sodimm baru rusak\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(687, 'AIOG182', 'aio', 'Masalah setelah instalasi driver OEM dari vendor AIO', 'Differential', '[\"driver vendor error aio\",\"driver oem aio\",\"habis install software bawaan\"]', NULL, '0.60', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(688, 'AIOG183', 'aio', 'AIO sering mati mendadak tanpa pola jelas', 'Differential', '[\"mati tiba-tiba aio\",\"random shutdown\",\"tidak ada pola\",\"sering mati\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(689, 'AIOG184', 'aio', 'AIO menjadi lebih lambat setelah beberapa tahun', 'Differential', '[\"makin lambat aio\",\"degradasi\",\"sudah lama lambat\",\"aging hardware aio\"]', NULL, '0.50', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(690, 'AIOG185', 'aio', 'BIOS/UEFI AIO menampilkan error saat POST', 'Differential', '[\"post error aio\",\"bios error aio\",\"uefi error\",\"komponen tidak terdeteksi bios aio\"]', NULL, '0.80', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(691, 'AIOG186', 'aio', 'Masalah terjadi hanya pada mode display tertentu', 'Differential', '[\"resolusi tertentu aio\",\"mode display tertentu\",\"hanya di resolusi ini\"]', NULL, '0.50', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(692, 'AIOG187', 'aio', 'Adaptor original hilang dan menggunakan adaptor sembarang', 'Differential', '[\"adaptor hilang aio\",\"tidak ada adaptor original\",\"pakai adaptor lain\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(693, 'AIOG188', 'aio', 'AIO berfungsi normal saat baru dinyalakan tapi bermasalah setelah lama', 'Differential', '[\"awal ok lama rusak\",\"muncul setelah panas\",\"awal normal bermasalah\"]', NULL, '0.70', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(694, 'AIOG189', 'aio', 'Masalah hanya saat menggunakan aplikasi berat tertentu', 'Differential', '[\"hanya saat edit video\",\"hanya saat render\",\"aplikasi berat tertentu aio\"]', NULL, '0.60', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(695, 'AIOG190', 'aio', 'AIO mengalami masalah lebih dari satu komponen sekaligus', 'Differential', '[\"banyak komponen bermasalah aio\",\"multiple issue\",\"banyak yang rusak aio\"]', NULL, '0.80', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(696, 'AIOG191', 'aio', 'Masalah terjadi di lingkungan dengan kelembaban tinggi', 'Differential', '[\"lembab aio\",\"humid\",\"embun\",\"kelembaban tinggi\",\"ac sangat dingin\"]', NULL, '0.50', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(697, 'AIOG192', 'aio', 'AIO sudah lebih dari 5 tahun digunakan', 'Differential', '[\"sudah tua aio\",\"lebih 5 tahun\",\"sudah lama dipakai\",\"aging aio\"]', NULL, '0.60', '2026-03-12 15:25:44', '2026-04-01 06:32:22', 3, NULL),
(698, 'PRG001', 'printer', 'Hasil cetak bergaris horizontal', 'Kualitas Cetak', '[\"bergaris horizontal\",\"garis cetak\",\"banding\",\"garis putus-putus\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 28),
(699, 'PRG002', 'printer', 'Hasil cetak bergaris vertikal', 'Kualitas Cetak', '[\"garis vertikal\",\"strip vertikal\",\"garis memanjang\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 28),
(700, 'PRG003', 'printer', 'Warna cetak pudar/tidak pekat', 'Kualitas Cetak', '[\"pudar\",\"faded\",\"tidak pekat\",\"terlalu terang\",\"warna tipis\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 28),
(701, 'PRG004', 'printer', 'Warna cetak tidak sesuai/salah warna', 'Kualitas Cetak', '[\"warna salah\",\"color shift\",\"warna ga sesuai\",\"warna meleset\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 28),
(702, 'PRG005', 'printer', 'Ada bercak/noda tinta pada hasil cetak', 'Kualitas Cetak', '[\"bercak tinta\",\"noda\",\"tinta netes\",\"blot\",\"smear\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 28),
(703, 'PRG006', 'printer', 'Hasil cetak buram/tidak tajam', 'Kualitas Cetak', '[\"buram\",\"blur\",\"tidak tajam\",\"fuzzy\",\"ga jelas\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 28),
(704, 'PRG007', 'printer', 'Hasil cetak ada area kosong/blank', 'Kualitas Cetak', '[\"area kosong\",\"blank spot\",\"ga kecetak sebagian\",\"bagian putih\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 28),
(705, 'PRG008', 'printer', 'Halaman cetak kosong seluruhnya (blank page)', 'Kualitas Cetak', '[\"blank page\",\"halaman kosong\",\"putih semua\",\"ga ada cetakan\"]', NULL, '0.90', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 28),
(706, 'PRG009', 'printer', 'Bekas goresan/scratch pada hasil cetak', 'Kualitas Cetak', '[\"goresan\",\"scratch\",\"bekas gesek\",\"kertas tergores\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 28),
(707, 'PRG010', 'printer', 'Tinta/toner mudah luntur saat disentuh', 'Kualitas Cetak', '[\"luntur\",\"smudge\",\"mudah hilang\",\"tinta ga kering\",\"toner lepas\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 28),
(708, 'PRG011', 'printer', 'Ghost image / bayangan cetakan berulang', 'Kualitas Cetak', '[\"ghost image\",\"bayangan\",\"double image\",\"repeating image\",\"cetakan hantu\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 28),
(709, 'PRG012', 'printer', 'Background cetak kotor/abu-abu', 'Kualitas Cetak', '[\"background kotor\",\"abu-abu\",\"gray background\",\"dirty print\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 28),
(710, 'PRG013', 'printer', 'Cetakan miring/tidak rata', 'Kualitas Cetak', '[\"miring\",\"skew\",\"ga lurus\",\"tidak rata\",\"serong\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 28),
(711, 'PRG014', 'printer', 'Resolusi cetak rendah/tidak detail', 'Kualitas Cetak', '[\"resolusi rendah\",\"ga detail\",\"pixelated\",\"jagged\"]', NULL, '0.50', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 28),
(712, 'PRG015', 'printer', 'Hanya satu warna yang tidak keluar', 'Kualitas Cetak', '[\"satu warna hilang\",\"missing color\",\"warna ga keluar\",\"nozzle satu warna\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 28),
(713, 'PRG016', 'printer', 'Tinta habis / level tinta rendah', 'Tinta', '[\"tinta habis\",\"ink low\",\"level tinta rendah\",\"cartridge kosong\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 29),
(714, 'PRG017', 'printer', 'Cartridge tinta tidak terdeteksi', 'Tinta', '[\"cartridge ga kebaca\",\"tinta ga detect\",\"ink not recognized\",\"cartridge error\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 29),
(715, 'PRG018', 'printer', 'Tinta bocor dari cartridge', 'Tinta', '[\"tinta bocor\",\"tinta netes\",\"tinta tumpah\",\"leak\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 29),
(716, 'PRG019', 'printer', 'Head printer tersumbat', 'Tinta', '[\"head sumbat\",\"nozzle clogged\",\"head buntu\",\"print head mampet\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 29),
(717, 'PRG020', 'printer', 'Tinta cepat habis / boros', 'Tinta', '[\"tinta boros\",\"ink cepat habis\",\"tinta cepat berkurang\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 29),
(718, 'PRG021', 'printer', 'Toner habis / level toner rendah', 'Tinta', '[\"toner habis\",\"toner low\",\"toner kosong\",\"cartridge toner habis\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 29),
(719, 'PRG022', 'printer', 'Cartridge toner tidak dikenali', 'Tinta', '[\"toner ga kebaca\",\"toner not recognized\",\"cartridge toner error\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 29),
(720, 'PRG023', 'printer', 'Toner bocor/tumpah di dalam printer', 'Tinta', '[\"toner bocor\",\"toner tumpah\",\"serbuk toner keluar\",\"toner leak\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 29),
(721, 'PRG024', 'printer', 'Chip cartridge error/perlu reset', 'Tinta', '[\"chip error\",\"reset cartridge\",\"chip perlu reset\",\"counter full\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 29),
(722, 'PRG025', 'printer', 'Menggunakan tinta/toner non-original', 'Tinta', '[\"non-original\",\"refill\",\"compatible\",\"aftermarket\",\"isi ulang\"]', NULL, '0.50', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 29),
(723, 'PRG026', 'printer', 'Waste ink tank/pad penuh', 'Tinta', '[\"waste ink full\",\"ink pad penuh\",\"maintenance box full\",\"absorber penuh\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 29),
(724, 'PRG027', 'printer', 'Selang tinta infus tersumbat/bocor', 'Tinta', '[\"selang sumbat\",\"tube infus mampet\",\"selang bocor\",\"infus macet\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 29),
(725, 'PRG028', 'printer', 'Tinta di tank infus habis', 'Tinta', '[\"tank kosong\",\"botol tinta habis\",\"infus habis\",\"tanki kosong\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 29),
(726, 'PRG029', 'printer', 'Warna tinta tercampur', 'Tinta', '[\"warna campur\",\"tinta mixing\",\"warna tertukar\",\"crossover color\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 29),
(727, 'PRG030', 'printer', 'Head print tidak bergerak/stuck', 'Tinta', '[\"head stuck\",\"carriage macet\",\"head ga gerak\",\"carriage jam\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 29),
(728, 'PRG031', 'printer', 'Kertas macet (paper jam)', 'Kertas', '[\"paper jam\",\"kertas macet\",\"kertas nyangkut\",\"jam\"]', NULL, '0.90', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 30),
(729, 'PRG032', 'printer', 'Printer tidak mengambil kertas', 'Kertas', '[\"ga ambil kertas\",\"kertas ga masuk\",\"paper feed error\",\"ga narik kertas\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 30),
(730, 'PRG033', 'printer', 'Kertas tertarik lebih dari satu lembar', 'Kertas', '[\"multi feed\",\"kertas dobel\",\"narik banyak\",\"double feed\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 30),
(731, 'PRG034', 'printer', 'Kertas miring saat masuk ke printer', 'Kertas', '[\"kertas miring\",\"paper skew\",\"masuk serong\",\"kertas ga lurus\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 30),
(732, 'PRG035', 'printer', 'Roller pengambil kertas aus/licin', 'Kertas', '[\"roller aus\",\"pickup roller licin\",\"roller slip\",\"roller halus\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 30),
(733, 'PRG036', 'printer', 'Tray kertas rusak/patah', 'Kertas', '[\"tray rusak\",\"tray patah\",\"wadah kertas rusak\",\"paper tray error\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 30),
(734, 'PRG037', 'printer', 'Jenis kertas tidak sesuai', 'Kertas', '[\"kertas ga sesuai\",\"paper type salah\",\"kertas terlalu tebal\",\"kertas tipis\"]', NULL, '0.50', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 30),
(735, 'PRG038', 'printer', 'Kertas mengerut/kusut setelah cetak', 'Kertas', '[\"kertas kusut\",\"wrinkle\",\"kertas bergelombang\",\"crumpled\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 30),
(736, 'PRG039', 'printer', 'Sensor kertas error/mati', 'Kertas', '[\"sensor error\",\"paper sensor mati\",\"sensor kertas rusak\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 30),
(737, 'PRG040', 'printer', 'Kertas macet di area fuser (laser)', 'Kertas', '[\"jam di fuser\",\"macet fuser\",\"kertas stuck di pemanas\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 30),
(738, 'PRG041', 'printer', 'Kertas macet di area output/keluaran', 'Kertas', '[\"jam output\",\"macet keluar\",\"kertas nyangkut keluar\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 30),
(739, 'PRG042', 'printer', 'ADF (Auto Document Feeder) macet', 'Kertas', '[\"adf macet\",\"adf jam\",\"feeder macet\",\"scanner feeder error\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 30),
(740, 'PRG043', 'printer', 'Duplex (cetak bolak-balik) error', 'Kertas', '[\"duplex error\",\"bolak-balik error\",\"auto duplex jam\",\"duplex macet\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 30),
(741, 'PRG044', 'printer', 'Pesan \"Paper Size Mismatch\"', 'Kertas', '[\"size mismatch\",\"ukuran kertas salah\",\"paper size error\"]', NULL, '0.50', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 30),
(742, 'PRG045', 'printer', 'Kertas basah/lembab menyebabkan masalah', 'Kertas', '[\"kertas basah\",\"kertas lembab\",\"kertas embun\",\"humidity paper\"]', NULL, '0.50', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 30),
(743, 'PRG046', 'printer', 'Printer tidak terdeteksi via USB', 'Konektivitas', '[\"usb ga kebaca\",\"printer ga detect usb\",\"usb printer error\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 31),
(744, 'PRG047', 'printer', 'Printer tidak terdeteksi via WiFi', 'Konektivitas', '[\"wifi ga kebaca\",\"printer wifi ga detect\",\"printer wireless error\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 31),
(745, 'PRG048', 'printer', 'Printer offline/tidak online', 'Konektivitas', '[\"printer offline\",\"status offline\",\"ga bisa cetak offline\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 31),
(746, 'PRG049', 'printer', 'Kabel USB printer rusak/longgar', 'Konektivitas', '[\"kabel usb rusak\",\"usb longgar\",\"kabel printer lepas\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 31),
(747, 'PRG050', 'printer', 'WiFi printer sering putus/disconnect', 'Konektivitas', '[\"wifi putus\",\"disconnect printer\",\"koneksi ga stabil\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 31),
(748, 'PRG051', 'printer', 'Printer tidak bisa connect ke jaringan WiFi', 'Konektivitas', '[\"ga bisa konek\",\"wifi ga nyambung\",\"gagal connect\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 31),
(749, 'PRG052', 'printer', 'Print job stuck di queue/antrian', 'Konektivitas', '[\"job stuck\",\"antrian macet\",\"print queue stuck\",\"queue error\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 31),
(750, 'PRG053', 'printer', 'Printer via LAN/Ethernet tidak terdeteksi', 'Konektivitas', '[\"lan ga detect\",\"ethernet printer mati\",\"network printer error\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 31),
(751, 'PRG054', 'printer', 'Sharing printer di jaringan gagal', 'Konektivitas', '[\"sharing gagal\",\"share printer error\",\"ga bisa share\",\"printer sharing\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 31),
(752, 'PRG055', 'printer', 'IP address printer berubah-ubah', 'Konektivitas', '[\"ip berubah\",\"dhcp printer\",\"ip ga tetap\",\"ip dinamis\"]', NULL, '0.50', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 31),
(753, 'PRG056', 'printer', 'Bluetooth printer tidak pairing', 'Konektivitas', '[\"bluetooth ga konek\",\"pairing gagal\",\"bt printer error\"]', NULL, '0.50', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 31),
(754, 'PRG057', 'printer', 'Mobile printing tidak berfungsi', 'Konektivitas', '[\"print dari hp gagal\",\"mobile print error\",\"airprint error\",\"cloud print\"]', NULL, '0.50', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 31),
(755, 'PRG058', 'printer', 'Spooler service error', 'Konektivitas', '[\"spooler error\",\"print spooler crash\",\"spooler mati\",\"spooler service\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 31),
(756, 'PRG059', 'printer', 'Firewall memblokir koneksi printer', 'Konektivitas', '[\"firewall block\",\"blocked printer\",\"port diblokir\"]', NULL, '0.50', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 31),
(757, 'PRG060', 'printer', 'Port printer di komputer mengalami error', 'Konektivitas', '[\"port error\",\"printer port gagal\",\"port tidak tersedia\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 31),
(758, 'PRG061', 'printer', 'Printer mati total/tidak menyala', 'Hardware', '[\"mati total\",\"ga nyala\",\"ga hidup\",\"printer mati\",\"dead\"]', NULL, '0.90', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 32),
(759, 'PRG062', 'printer', 'Printer menyala tapi tidak merespon', 'Hardware', '[\"nyala ga respon\",\"standby terus\",\"ga merespon\",\"stuck idle\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 32),
(760, 'PRG063', 'printer', 'Panel LCD/display printer error', 'Hardware', '[\"lcd error\",\"display rusak\",\"layar printer mati\",\"panel mati\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 32),
(761, 'PRG064', 'printer', 'Tombol/button printer tidak berfungsi', 'Hardware', '[\"tombol rusak\",\"button mati\",\"tombol ga respon\",\"kontrol error\"]', NULL, '0.50', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 32),
(762, 'PRG065', 'printer', 'Printer error code muncul di display', 'Hardware', '[\"error code\",\"kode error\",\"blinking error\",\"led error\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 32),
(763, 'PRG066', 'printer', 'Cover/penutup printer tidak menutup rapat', 'Hardware', '[\"cover ga nutup\",\"penutup rusak\",\"hinge patah\",\"cover error\"]', NULL, '0.50', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 32),
(764, 'PRG067', 'printer', 'Port USB printer rusak fisik', 'Hardware', '[\"usb port rusak\",\"port printer patah\",\"konektor rusak\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 32),
(765, 'PRG068', 'printer', 'Power supply internal printer rusak', 'Hardware', '[\"psu printer rusak\",\"power board mati\",\"regulator rusak\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 32),
(766, 'PRG069', 'printer', 'Adaptor/kabel power printer rusak', 'Hardware', '[\"adaptor rusak\",\"kabel power printer\",\"adapter mati\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 32),
(767, 'PRG070', 'printer', 'Mainboard/logic board printer rusak', 'Hardware', '[\"mainboard rusak\",\"logic board mati\",\"pcb printer rusak\"]', NULL, '0.90', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 32),
(768, 'PRG071', 'printer', 'Printer panas berlebih/overheat', 'Hardware', '[\"printer panas\",\"overheat printer\",\"terlalu panas\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 32),
(769, 'PRG072', 'printer', 'LED indikator berkedip error', 'Hardware', '[\"led kedip\",\"blinking\",\"lampu error\",\"indikator berkedip\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 32),
(770, 'PRG073', 'printer', 'Noise/suara abnormal dari printer', 'Hardware', '[\"bunyi aneh\",\"suara kasar\",\"noise printer\",\"grinding sound\",\"berisik\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 32),
(771, 'PRG074', 'printer', 'Printer restart/reboot sendiri', 'Hardware', '[\"restart sendiri\",\"reboot printer\",\"mati nyala sendiri\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 32),
(772, 'PRG075', 'printer', 'Memori printer penuh', 'Hardware', '[\"memory full\",\"memori printer penuh\",\"buffer overflow\",\"ram printer penuh\"]', NULL, '0.50', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 32),
(773, 'PRG076', 'printer', 'Driver printer tidak terinstall', 'Software', '[\"driver ga ada\",\"belum install driver\",\"driver printer ga ada\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 33),
(774, 'PRG077', 'printer', 'Driver printer tidak kompatibel', 'Software', '[\"driver ga cocok\",\"driver incompatible\",\"driver ga support\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 33),
(775, 'PRG078', 'printer', 'Driver printer crash/error', 'Software', '[\"driver crash\",\"driver error\",\"printer driver gagal\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 33),
(776, 'PRG079', 'printer', 'Printer default salah/berubah', 'Software', '[\"default salah\",\"printer default berubah\",\"salah printer\"]', NULL, '0.40', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 33),
(777, 'PRG080', 'printer', 'Print spooler service mati', 'Software', '[\"spooler mati\",\"print service off\",\"spooler service stop\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 33),
(778, 'PRG081', 'printer', 'Antrian cetak tidak bisa dihapus', 'Software', '[\"antrian stuck\",\"queue ga bisa hapus\",\"cancel gagal\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 33),
(779, 'PRG082', 'printer', 'Firmware printer perlu update', 'Software', '[\"firmware update\",\"firmware lama\",\"perlu update firmware\"]', NULL, '0.40', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 33),
(780, 'PRG083', 'printer', 'Software utility printer error', 'Software', '[\"utility error\",\"software printer crash\",\"app printer error\"]', NULL, '0.50', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 33),
(781, 'PRG084', 'printer', 'Setting cetak salah (ukuran/orientasi)', 'Software', '[\"setting salah\",\"ukuran ga sesuai\",\"orientasi salah\",\"landscape portrait\"]', NULL, '0.40', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 33),
(782, 'PRG085', 'printer', 'Print job gagal tanpa error message', 'Software', '[\"print gagal\",\"ga jadi cetak\",\"cetak ga keluar\",\"silent fail\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 33),
(783, 'PRG086', 'printer', 'Cetak dari aplikasi tertentu error', 'Software', '[\"app tertentu error\",\"excel ga bisa print\",\"cetak dari pdf error\"]', NULL, '0.50', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 33),
(784, 'PRG087', 'printer', 'Hasil cetak tidak sesuai preview', 'Software', '[\"ga sesuai preview\",\"beda dengan layar\",\"mismatch print\"]', NULL, '0.40', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 33),
(785, 'PRG088', 'printer', 'Halaman cetak terpotong', 'Software', '[\"terpotong\",\"margin salah\",\"cropped\",\"ga muat\"]', NULL, '0.50', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 33),
(786, 'PRG089', 'printer', 'Printer tidak mau cetak setelah update OS', 'Software', '[\"setelah update ga bisa\",\"windows update printer\",\"os update error\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 33),
(787, 'PRG090', 'printer', 'Proses cetak sangat lambat', 'Software', '[\"cetak lambat\",\"print pelan\",\"slow printing\",\"lama banget\"]', NULL, '0.50', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 33),
(788, 'PRG091', 'printer', 'Belt/timing belt aus atau putus', 'Mekanik', '[\"belt putus\",\"timing belt aus\",\"belt rusak\",\"belt kendor\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 34),
(789, 'PRG092', 'printer', 'Motor printer bunyi/tidak berfungsi', 'Mekanik', '[\"motor bunyi\",\"motor mati\",\"motor error\",\"stepper motor\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 34),
(790, 'PRG093', 'printer', 'Gear/roda gigi aus atau patah', 'Mekanik', '[\"gear patah\",\"roda gigi aus\",\"gear rusak\",\"tooth broken\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 34),
(791, 'PRG094', 'printer', 'Encoder strip kotor/rusak', 'Mekanik', '[\"encoder kotor\",\"encoder strip rusak\",\"encoder error\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 34),
(792, 'PRG095', 'printer', 'Solenoid rusak', 'Mekanik', '[\"solenoid rusak\",\"solenoid mati\",\"pickup solenoid\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 34),
(793, 'PRG096', 'printer', 'Printer bunyi grinding/kasar', 'Mekanik', '[\"grinding\",\"bunyi kasar\",\"noise mekanik\",\"suara keras\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 34),
(794, 'PRG097', 'printer', 'Carriage tidak bergerak bebas', 'Mekanik', '[\"carriage macet\",\"carriage stuck\",\"rel macet\",\"carriage ga gerak\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 34),
(795, 'PRG098', 'printer', 'Roller cetak kotor/aus', 'Mekanik', '[\"roller kotor\",\"roller aus\",\"transfer roller rusak\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 34),
(796, 'PRG099', 'printer', 'Spring/pegas mekanik lemah/rusak', 'Mekanik', '[\"pegas lemah\",\"spring rusak\",\"pegas kendor\"]', NULL, '0.50', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 34),
(797, 'PRG100', 'printer', 'Sensor posisi carriage error', 'Mekanik', '[\"sensor carriage\",\"home sensor\",\"position error\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 34),
(798, 'PRG101', 'printer', 'Guide rail/jalur carriage kotor', 'Mekanik', '[\"rail kotor\",\"guide kotor\",\"jalur carriage kering\"]', NULL, '0.50', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 34),
(799, 'PRG102', 'printer', 'Flex cable printer putus/longgar', 'Mekanik', '[\"flex cable putus\",\"kabel fleksibel rusak\",\"ribbon cable\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 34),
(800, 'PRG103', 'printer', 'Purge unit/capping station bermasalah', 'Mekanik', '[\"purge error\",\"capping station rusak\",\"pump unit error\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 34),
(801, 'PRG104', 'printer', 'Wiper blade kotor/rusak', 'Mekanik', '[\"wiper rusak\",\"blade kotor\",\"cleaning blade aus\"]', NULL, '0.50', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 34),
(802, 'PRG105', 'printer', 'Mekanik printer berkarat', 'Mekanik', '[\"berkarat\",\"korosi\",\"karat mekanik\",\"rusty\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 34),
(803, 'PRG106', 'printer', 'Print head perlu alignment', 'Inkjet', '[\"alignment\",\"head perlu align\",\"cetakan ga rata\",\"print head alignment\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(804, 'PRG107', 'printer', 'Print head tersumbat permanen', 'Inkjet', '[\"head mati\",\"nozzle mampet permanen\",\"head ga bisa dibersihkan\"]', NULL, '0.90', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(805, 'PRG108', 'printer', 'Nozzle check pattern masih bergaris', 'Inkjet', '[\"nozzle check gagal\",\"pattern bergaris\",\"test page garis\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(806, 'PRG109', 'printer', 'Infus tank tinta bermasalah', 'Inkjet', '[\"infus bermasalah\",\"tank rusak\",\"continuous ink supply\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(807, 'PRG110', 'printer', 'Head cleaning berulang tidak berhasil', 'Inkjet', '[\"cleaning gagal\",\"head cleaning ga berhasil\",\"sudah cleaning berkali-kali\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(808, 'PRG111', 'printer', 'Tinta menetes saat idle', 'Inkjet', '[\"tinta netes idle\",\"dripping\",\"tinta menetes sendiri\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(809, 'PRG112', 'printer', 'Cartridge tidak pas/longgar di slot', 'Inkjet', '[\"cartridge longgar\",\"ga pas slot\",\"cartridge ga lock\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(810, 'PRG113', 'printer', 'Print head overheat', 'Inkjet', '[\"head panas\",\"print head overheat\",\"head terlalu panas\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(811, 'PRG114', 'printer', 'Borderless printing tidak berfungsi', 'Inkjet', '[\"borderless gagal\",\"cetak tanpa margin error\",\"borderless error\"]', NULL, '0.40', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(812, 'PRG115', 'printer', 'Photo printing quality rendah', 'Inkjet', '[\"photo ga bagus\",\"kualitas foto rendah\",\"cetak foto jelek\"]', NULL, '0.50', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(813, 'PRG116', 'printer', 'CD/DVD printing tray tidak berfungsi', 'Inkjet', '[\"cd tray error\",\"dvd print error\",\"disc tray macet\"]', NULL, '0.40', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(814, 'PRG117', 'printer', 'Tinta tidak mengering dengan baik', 'Inkjet', '[\"tinta ga kering\",\"basah\",\"smear saat sentuh\",\"butuh lama kering\"]', NULL, '0.50', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(815, 'PRG118', 'printer', 'Cartridge tipe thermal head aus', 'Inkjet', '[\"thermal head aus\",\"cartridge head rusak\",\"printhead kartrid rusak\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(816, 'PRG119', 'printer', 'Spray pattern test gagal', 'Inkjet', '[\"spray test gagal\",\"pattern test error\",\"test cetak gagal\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(817, 'PRG120', 'printer', 'Tinta merembes di belakang kertas', 'Inkjet', '[\"tinta tembus\",\"tembus belakang\",\"bleeding ink\",\"show through\"]', NULL, '0.50', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(818, 'PRG121', 'printer', 'Fuser unit rusak/panas berlebih', 'Laser', '[\"fuser rusak\",\"fuser overheat\",\"heater fuser mati\",\"fuser error\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(819, 'PRG122', 'printer', 'Drum unit aus/perlu ganti', 'Laser', '[\"drum aus\",\"drum unit rusak\",\"opc drum aus\",\"drum perlu ganti\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(820, 'PRG123', 'printer', 'Drum unit tergores', 'Laser', '[\"drum gores\",\"drum tergores\",\"scratch drum\",\"drum defect\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(821, 'PRG124', 'printer', 'Transfer roller/belt rusak', 'Laser', '[\"transfer roller rusak\",\"transfer belt aus\",\"ITB rusak\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(822, 'PRG125', 'printer', 'Fuser film/sleeve rusak', 'Laser', '[\"fuser film rusak\",\"fuser sleeve sobek\",\"film fuser gores\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(823, 'PRG126', 'printer', 'Pressure roller fuser aus', 'Laser', '[\"pressure roller aus\",\"lower roller rusak\",\"roller fuser aus\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(824, 'PRG127', 'printer', 'Toner cartridge seal belum dilepas', 'Laser', '[\"seal belum lepas\",\"tab belum dicabut\",\"pull tab\",\"protective seal\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(825, 'PRG128', 'printer', 'Developer unit rusak', 'Laser', '[\"developer rusak\",\"developing unit error\",\"magnetic roller aus\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(826, 'PRG129', 'printer', 'Charge roller kotor/aus', 'Laser', '[\"charge roller kotor\",\"PCR kotor\",\"primary charge roller\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(827, 'PRG130', 'printer', 'Waste toner container penuh', 'Laser', '[\"waste toner full\",\"toner waste penuh\",\"limbah toner penuh\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(828, 'PRG131', 'printer', 'Laser unit/scanner unit error', 'Laser', '[\"laser unit mati\",\"scanner unit error\",\"LSU error\",\"polygon mirror\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(829, 'PRG132', 'printer', 'Fuser temperature error', 'Laser', '[\"suhu fuser error\",\"fuser temp low\",\"fuser temp high\",\"thermistor\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(830, 'PRG133', 'printer', 'Corona wire kotor/putus', 'Laser', '[\"corona wire kotor\",\"transfer corona putus\",\"charge corona\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(831, 'PRG134', 'printer', 'Cetakan muncul titik-titik berulang (drum defect)', 'Laser', '[\"titik-titik berulang\",\"dots repeating\",\"drum mark\",\"periodic defect\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(832, 'PRG135', 'printer', 'Kertas keriting/melengkung setelah cetak (curl)', 'Laser', '[\"kertas keriting\",\"curl\",\"melengkung\",\"paper curl\"]', NULL, '0.50', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(833, 'PRG136', 'printer', 'Scanner tidak berfungsi', 'Scanner', '[\"scanner mati\",\"scan ga bisa\",\"scanner error\",\"ga bisa scan\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 35),
(834, 'PRG137', 'printer', 'Hasil scan bergaris', 'Scanner', '[\"scan bergaris\",\"garis di scan\",\"scan striping\",\"garis horizontal scan\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 35);
INSERT INTO `symptoms` (`id`, `code`, `device_type`, `name`, `category`, `keywords`, `follow_up_question`, `weight`, `created_at`, `updated_at`, `device_type_id`, `device_component_id`) VALUES
(835, 'PRG138', 'printer', 'Scanner lampu mati/redup', 'Scanner', '[\"lampu scan mati\",\"light mati\",\"scanner dark\",\"illumination error\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 35),
(836, 'PRG139', 'printer', 'Kaca scanner kotor/tergores', 'Scanner', '[\"kaca kotor\",\"kaca gores\",\"scanner glass dirty\",\"platen kotor\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 35),
(837, 'PRG140', 'printer', 'Hasil scan warna salah', 'Scanner', '[\"scan warna salah\",\"color cast scan\",\"warna scan aneh\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 35),
(838, 'PRG141', 'printer', 'Scan ke email/folder gagal', 'Scanner', '[\"scan to email gagal\",\"scan to folder error\",\"scan ke komputer gagal\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 35),
(839, 'PRG142', 'printer', 'ADF scanner macet/error', 'Scanner', '[\"adf scan macet\",\"feeder scan error\",\"auto feeder scan macet\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 35),
(840, 'PRG143', 'printer', 'Resolusi scan rendah', 'Scanner', '[\"scan ga jelas\",\"resolusi scan rendah\",\"scan buram\"]', NULL, '0.50', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 35),
(841, 'PRG144', 'printer', 'Fotocopy hasil buruk', 'Scanner', '[\"fotocopy jelek\",\"copy ga jelas\",\"hasil copy buruk\",\"copy pudar\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 35),
(842, 'PRG145', 'printer', 'Fax tidak berfungsi', 'Scanner', '[\"fax error\",\"fax ga bisa\",\"fax tidak terkirim\",\"fax mati\"]', NULL, '0.50', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, 35),
(843, 'PRG146', 'printer', 'Masalah terjadi setelah ganti tinta/toner', 'Differential', '[\"setelah ganti tinta\",\"habis isi tinta\",\"setelah refill\",\"pasang cartridge baru\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(844, 'PRG147', 'printer', 'Masalah terjadi setelah printer lama tidak dipakai', 'Differential', '[\"lama ga dipakai\",\"tidak digunakan\",\"menganggur lama\",\"idle lama\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(845, 'PRG148', 'printer', 'Printer baru dibeli/pertama install', 'Differential', '[\"printer baru\",\"pertama install\",\"baru beli\",\"first setup\"]', NULL, '0.60', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(846, 'PRG149', 'printer', 'Menggunakan tinta/toner compatible (bukan original)', 'Differential', '[\"tinta compatible\",\"toner aftermarket\",\"non original\",\"bukan asli\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(847, 'PRG150', 'printer', 'Printer jenis inkjet', 'Differential', '[\"inkjet\",\"printer tinta\",\"ink tank\",\"cartridge ink\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(848, 'PRG151', 'printer', 'Printer jenis laser', 'Differential', '[\"laser\",\"printer laser\",\"toner printer\",\"laserjet\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(849, 'PRG152', 'printer', 'Masalah hanya terjadi pada warna tertentu', 'Differential', '[\"warna tertentu\",\"satu warna saja\",\"hanya cyan\",\"hanya magenta\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(850, 'PRG153', 'printer', 'Masalah terjadi pada semua jenis cetakan', 'Differential', '[\"semua cetakan\",\"semua dokumen\",\"text dan gambar\",\"apapun dicetak\"]', NULL, '0.70', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(851, 'PRG154', 'printer', 'Printing test page dari printer langsung berhasil', 'Differential', '[\"test page ok\",\"self test normal\",\"print langsung bisa\"]', NULL, '0.80', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL),
(852, 'PRG155', 'printer', 'Sudah coba restart printer dan komputer', 'Differential', '[\"sudah restart\",\"sudah off on\",\"restart dua-duanya\"]', NULL, '0.50', '2026-03-12 15:25:46', '2026-04-01 06:32:22', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','teknisi','super_admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'teknisi',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `phone`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@cellcom.com', NULL, '$2y$12$r3syloGgxS.S6TBRY15Ko.HigchTRSgyLaHUzPYscRUhNg7dLRSUy', 'super_admin', '081234567890', 1, 'qyPFJtbroE6V3xdz42vjZDSJ1A3rodXiHGMDbDk0tqIkVkvOl0sA0ackFUhe', '2026-02-04 05:51:38', '2026-03-12 15:25:48'),
(2, 'Admin Cellcom', 'admin2@cellcom.com', NULL, '$2y$12$7cDukQKxX8yMhMpeNy2xWe2zKlGTPz2wtYsgTzB/pELzVufKyxJ06', 'admin', '081234567891', 1, NULL, '2026-02-04 05:51:39', '2026-03-12 15:25:48'),
(5, 'Budi', 'budi.1776082900@teknisi.local', NULL, '$2y$12$WEXjTsDpr5Akn/FWzjozbeZE0osA1M3qqeL2LMabQd9vmqjF9P6s6', 'teknisi', NULL, 1, NULL, '2026-04-13 05:21:40', '2026-04-13 05:21:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bookings_booking_code_unique` (`booking_code`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_name_unique` (`name`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `category_questions`
--
ALTER TABLE `category_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_questions_leads_to_symptom_id_foreign` (`leads_to_symptom_id`),
  ADD KEY `category_questions_device_type_id_foreign` (`device_type_id`),
  ADD KEY `category_questions_device_component_id_foreign` (`device_component_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device_components`
--
ALTER TABLE `device_components`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `device_components_slug_unique` (`slug`),
  ADD KEY `device_components_device_type_id_foreign` (`device_type_id`);

--
-- Indexes for table `device_types`
--
ALTER TABLE `device_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `device_types_slug_unique` (`slug`);

--
-- Indexes for table `diagnosis_history`
--
ALTER TABLE `diagnosis_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `diagnosis_history_customer_id_foreign` (`customer_id`),
  ADD KEY `diagnosis_history_result_disease_id_foreign` (`result_disease_id`);

--
-- Indexes for table `diseases`
--
ALTER TABLE `diseases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `diseases_device_type_code_unique` (`device_type`,`code`),
  ADD KEY `diseases_device_type_index` (`device_type`),
  ADD KEY `diseases_device_type_id_foreign` (`device_type_id`),
  ADD KEY `diseases_device_component_id_foreign` (`device_component_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rules_disease_id_foreign` (`disease_id`),
  ADD KEY `rules_symptom_id_foreign` (`symptom_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_ticket_number_unique` (`ticket_number`),
  ADD KEY `services_customer_id_foreign` (`customer_id`),
  ADD KEY `services_user_id_foreign` (`user_id`),
  ADD KEY `services_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_categories_slug_unique` (`slug`);

--
-- Indexes for table `service_logs`
--
ALTER TABLE `service_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_logs_service_id_foreign` (`service_id`),
  ADD KEY `service_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `service_spareparts`
--
ALTER TABLE `service_spareparts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_spareparts_service_id_foreign` (`service_id`),
  ADD KEY `service_spareparts_sparepart_id_foreign` (`sparepart_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `spareparts`
--
ALTER TABLE `spareparts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `spareparts_code_unique` (`code`);

--
-- Indexes for table `symptoms`
--
ALTER TABLE `symptoms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `symptoms_device_type_code_unique` (`device_type`,`code`),
  ADD KEY `symptoms_device_type_index` (`device_type`),
  ADD KEY `symptoms_device_type_id_foreign` (`device_type_id`),
  ADD KEY `symptoms_device_component_id_foreign` (`device_component_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category_questions`
--
ALTER TABLE `category_questions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=463;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `device_components`
--
ALTER TABLE `device_components`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `device_types`
--
ALTER TABLE `device_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `diagnosis_history`
--
ALTER TABLE `diagnosis_history`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diseases`
--
ALTER TABLE `diseases`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=337;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1204;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `service_logs`
--
ALTER TABLE `service_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `service_spareparts`
--
ALTER TABLE `service_spareparts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `spareparts`
--
ALTER TABLE `spareparts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `symptoms`
--
ALTER TABLE `symptoms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=853;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_questions`
--
ALTER TABLE `category_questions`
  ADD CONSTRAINT `category_questions_device_component_id_foreign` FOREIGN KEY (`device_component_id`) REFERENCES `device_components` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `category_questions_device_type_id_foreign` FOREIGN KEY (`device_type_id`) REFERENCES `device_types` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `category_questions_leads_to_symptom_id_foreign` FOREIGN KEY (`leads_to_symptom_id`) REFERENCES `symptoms` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `device_components`
--
ALTER TABLE `device_components`
  ADD CONSTRAINT `device_components_device_type_id_foreign` FOREIGN KEY (`device_type_id`) REFERENCES `device_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `diagnosis_history`
--
ALTER TABLE `diagnosis_history`
  ADD CONSTRAINT `diagnosis_history_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `diagnosis_history_result_disease_id_foreign` FOREIGN KEY (`result_disease_id`) REFERENCES `diseases` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `diseases`
--
ALTER TABLE `diseases`
  ADD CONSTRAINT `diseases_device_component_id_foreign` FOREIGN KEY (`device_component_id`) REFERENCES `device_components` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `diseases_device_type_id_foreign` FOREIGN KEY (`device_type_id`) REFERENCES `device_types` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rules`
--
ALTER TABLE `rules`
  ADD CONSTRAINT `rules_disease_id_foreign` FOREIGN KEY (`disease_id`) REFERENCES `diseases` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rules_symptom_id_foreign` FOREIGN KEY (`symptom_id`) REFERENCES `symptoms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `services_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `services_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `service_logs`
--
ALTER TABLE `service_logs`
  ADD CONSTRAINT `service_logs_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `service_spareparts`
--
ALTER TABLE `service_spareparts`
  ADD CONSTRAINT `service_spareparts_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_spareparts_sparepart_id_foreign` FOREIGN KEY (`sparepart_id`) REFERENCES `spareparts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `symptoms`
--
ALTER TABLE `symptoms`
  ADD CONSTRAINT `symptoms_device_component_id_foreign` FOREIGN KEY (`device_component_id`) REFERENCES `device_components` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `symptoms_device_type_id_foreign` FOREIGN KEY (`device_type_id`) REFERENCES `device_types` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
