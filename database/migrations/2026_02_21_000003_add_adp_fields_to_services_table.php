<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('set null')->after('service_type');
            $table->boolean('has_adp')->default(false)->after('brand_id');          // ADP klaim berlaku?
            $table->decimal('adp_original_cost', 10, 2)->default(0)->after('has_adp'); // Biaya asli sebelum diskon brand
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
            $table->dropColumn(['brand_id', 'has_adp', 'adp_original_cost']);
        });
    }
};
