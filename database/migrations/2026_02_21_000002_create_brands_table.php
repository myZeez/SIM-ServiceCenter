<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Seed default brands
        \DB::table('brands')->insert([
            ['name' => 'ASUS', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lenovo', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'HP', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dell', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Acer', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Apple', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'MSI', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Toshiba', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
