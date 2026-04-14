<?php
$complaint = "[Tanya Dulu] Paket Hardware\nLayanan Dipilih:\n- Cleaning & Ganti Pasta (Rp 255.000)\n- Cleaning All (Rp 155.000)";

$selectedItems = [];
if (preg_match('/Layanan Dipilih\:\s*\n((?:-\s[^\n]+\n?)+)/is', $complaint, $matches)) {
    echo "Matched array:\n";
    $lines = explode("\n", trim($matches[1]));
    foreach($lines as $line) {
        $cleanLine = trim(preg_replace('/^-\s*/', '', $line));
        if ($cleanLine) {
            $selectedItems[] = $cleanLine;
        }
    }
}
var_dump($selectedItems);
