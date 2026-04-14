<?php
$itemStr = 'Cleaning & Ganti Pasta (Rp 255.000)';
if (preg_match('/^(.*?)\s*\((.*)\)$/', $itemStr, $matches)) {
    var_dump($matches);
    $priceString = preg_replace('/[Rp\s\.]/i', '', $matches[2]);
    var_dump($priceString);
    if (is_numeric($priceString)) {
        echo 'Price: ' . (int) $priceString;
    }
}
