<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Insert Default Values
        DB::table('settings')->insert([
            ['key' => 'admin_fee_per_invoice', 'value' => '20000', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'technician_commission_percent', 'value' => '50', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'technician_monthly_target', 'value' => '3000000', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
