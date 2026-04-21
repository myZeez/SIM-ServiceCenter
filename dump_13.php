<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$tables = ['users', 'customers', 'brands', 'services', 'service_logs', 'bookings', 'spareparts', 'service_spareparts', 'symptoms', 'diseases', 'rules', 'category_questions', 'diagnosis_history'];
$res = [];
foreach ($tables as $t) {
    if (Illuminate\Support\Facades\Schema::hasTable($t)) {
        foreach (Illuminate\Support\Facades\Schema::getColumnListing($t) as $c) {
            $res[$t][$c] = Illuminate\Support\Facades\Schema::getColumnType($t, $c);
        }
    }
}
file_put_contents('my_schema_13.json', json_encode($res, JSON_PRETTY_PRINT));
