<?php
require 'vendor/autoload.php';
\ = require_once 'bootstrap/app.php';
\ = \->make(Illuminate\Contracts\Console\Kernel::class);
\->bootstrap();
\ = ['users', 'customers', 'brands', 'device_types', 'services', 'service_categories', 'spareparts', 'service_spareparts', 'symptoms', 'diseases', 'rules', 'diagnosis_history', 'service_logs', 'settings', 'bookings'];
\ = [];
foreach (\ as \) {
    if (Illuminate\Support\Facades\Schema::hasTable(\)) {
        foreach (Illuminate\Support\Facades\Schema::getColumnListing(\) as \) {
            \[\][\] = Illuminate\Support\Facades\Schema::getColumnType(\, \);
        }
    }
}
file_put_contents('my_schema.json', json_encode(\, JSON_PRETTY_PRINT));