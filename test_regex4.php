<?php
$text = "Layanan Dipilih: - Cleaning All (Rp 155.000) - Tambah Thermal Paste (Rp 155.000)\r\nCatatan: laptop sering panas\nKeluhan/Layanan Tambahan: mati";
if (preg_match('/Layanan Dipilih:\s*(.*?)(?=\r?\n?Catatan:|\r?\n?Keluhan\/Layanan Tambahan:|$)/is', $text, $matches)) {
    $servicesString = trim($matches[1]);
    $parts = explode('-', $servicesString);
    $parsedItems = [];
    foreach($parts as $part) {
        $clean = trim($part);
        if(!empty($clean)){
            $parsedItems[] = $clean;
        }
    }
    var_dump($parsedItems);
}
