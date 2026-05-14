<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
echo "AIO: " . App\Models\Symptom::where('device_type', 'aio')->count() . "\n";
echo "PC: " . App\Models\Symptom::where('device_type', 'pc')->count() . "\n";
echo "PRINTER: " . App\Models\Symptom::where('device_type', 'printer')->count() . "\n";
