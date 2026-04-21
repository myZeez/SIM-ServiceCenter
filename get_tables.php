<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$tables = Illuminate\Support\Facades\DB::select("SELECT table_name FROM information_schema.tables WHERE table_schema='public'");
if (empty($tables)) {
    // try sqlite/mysql logic
    $tables = Illuminate\Support\Facades\DB::select("SHOW TABLES");
}
echo count($tables) . " Tabel Ditemukan:\n";
foreach($tables as $t) {
    $t = (array)$t;
    echo "- " . array_values($t)[0] . "\n";
}
