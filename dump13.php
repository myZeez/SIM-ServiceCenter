<?php
require 'vendor/autoload.php';
\ = require_once 'bootstrap/app.php';
\ = \->make(Illuminate\Contracts\Console\Kernel::class);
\->bootstrap();
\ = ['users', 'customers', 'brands', 'services', 'service_logs', 'bookings', 'spareparts', 'service_spareparts', 'symptoms', 'diseases', 'rules', 'category_questions', 'diagnosis_history'];
\ = [];
foreach (\ as \) {
    if (Illuminate\Support\Facades\Schema::hasTable(\)) {
        foreach (Illuminate\Support\Facades\Schema::getColumnListing(\) as \) {
            \[\][\] = Illuminate\Support\Facades\Schema::getColumnType(\, \);
        }
    }
}
file_put_contents('my_schema_13.json', json_encode(\, JSON_PRETTY_PRINT));