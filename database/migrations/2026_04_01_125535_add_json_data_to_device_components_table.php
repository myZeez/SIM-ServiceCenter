<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('device_components', function (Blueprint $table) {
            $table->string('engine_category')->nullable()->after('description');
            $table->json('problems_data')->nullable()->after('engine_category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('device_components', function (Blueprint $table) {
            $table->dropColumn(['engine_category', 'problems_data']);
        });
    }
};
