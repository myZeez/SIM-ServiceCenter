<?php
$complaint = "Layanan Dipilih: - Cleaning All (Rp 155.000) - Tambah Thermal Paste (Rp 155.000)";

if (preg_match('/Layanan Dipilih:\s*(.*)/s', $complaint, $matches)) {
    $servicesString = $matches[1];
    // Split by "- " 
    $items = explode("- ", $servicesString);
    $parsedItems = [];
    foreach($items as $item) {
        $item = trim($item);
        if(!empty($item) && !str_starts_with($item, 'Catatan:') && !str_starts_with($item, 'Keluhan/Layanan Tambahan:')) {
            $parsedItems[] = $item;
        }
    }
    var_dump($parsedItems);
}
