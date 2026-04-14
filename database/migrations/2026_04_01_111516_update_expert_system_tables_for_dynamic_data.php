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
        // Modify symptoms
        Schema::table('symptoms', function (Blueprint $table) {
            $table->foreignId('device_type_id')->nullable()->constrained('device_types')->nullOnDelete();
            $table->foreignId('device_component_id')->nullable()->constrained('device_components')->nullOnDelete();
        });

        // Modify diseases
        Schema::table('diseases', function (Blueprint $table) {
            $table->foreignId('device_type_id')->nullable()->constrained('device_types')->nullOnDelete();
            $table->foreignId('device_component_id')->nullable()->constrained('device_components')->nullOnDelete();
        });

        // Modify category_questions
        Schema::table('category_questions', function (Blueprint $table) {
            $table->foreignId('device_type_id')->nullable()->constrained('device_types')->nullOnDelete();
            $table->foreignId('device_component_id')->nullable()->constrained('device_components')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('symptoms', function (Blueprint $table) {
            $table->dropForeign(['device_type_id']);
            $table->dropForeign(['device_component_id']);
            $table->dropColumn(['device_type_id', 'device_component_id']);
        });

        Schema::table('diseases', function (Blueprint $table) {
            $table->dropForeign(['device_type_id']);
            $table->dropForeign(['device_component_id']);
            $table->dropColumn(['device_type_id', 'device_component_id']);
        });

        Schema::table('category_questions', function (Blueprint $table) {
            $table->dropForeign(['device_type_id']);
            $table->dropForeign(['device_component_id']);
            $table->dropColumn(['device_type_id', 'device_component_id']);
        });
    }
};
