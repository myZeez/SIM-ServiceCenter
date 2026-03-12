<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Tambah kolom device_type ke tabel expert system
     * Mendukung 4 jenis perangkat: laptop, pc, aio, printer
     */
    public function up(): void
    {
        // Tambah device_type ke symptoms
        Schema::table('symptoms', function (Blueprint $table) {
            if (!Schema::hasColumn('symptoms', 'device_type')) {
                $table->string('device_type', 20)->default('laptop')->after('code');
            }
        });

        // Tambah device_type ke diseases
        Schema::table('diseases', function (Blueprint $table) {
            if (!Schema::hasColumn('diseases', 'device_type')) {
                $table->string('device_type', 20)->default('laptop')->after('code');
            }
        });

        // Tambah device_type ke category_questions
        if (Schema::hasTable('category_questions')) {
            Schema::table('category_questions', function (Blueprint $table) {
                if (!Schema::hasColumn('category_questions', 'device_type')) {
                    $table->string('device_type', 20)->default('laptop')->after('id');
                }
            });
        }

        // Update unique constraint pada symptoms agar per device_type
        // Code harus unique per device_type, bukan global
        Schema::table('symptoms', function (Blueprint $table) {
            // Drop existing unique index on code
            $table->dropUnique(['code']);
            // Add composite unique index
            $table->unique(['device_type', 'code']);
        });

        // Update unique constraint pada diseases
        Schema::table('diseases', function (Blueprint $table) {
            $table->dropUnique(['code']);
            $table->unique(['device_type', 'code']);
        });

        // Set existing data as 'laptop'
        DB::table('symptoms')->whereNull('device_type')->orWhere('device_type', '')->update(['device_type' => 'laptop']);
        DB::table('diseases')->whereNull('device_type')->orWhere('device_type', '')->update(['device_type' => 'laptop']);
        if (Schema::hasTable('category_questions')) {
            DB::table('category_questions')->whereNull('device_type')->orWhere('device_type', '')->update(['device_type' => 'laptop']);
        }

        // Add index for performance
        Schema::table('symptoms', function (Blueprint $table) {
            $table->index('device_type', 'symptoms_device_type_index');
        });
        Schema::table('diseases', function (Blueprint $table) {
            $table->index('device_type', 'diseases_device_type_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('symptoms', function (Blueprint $table) {
            $table->dropIndex('symptoms_device_type_index');
            $table->dropUnique(['device_type', 'code']);
            $table->unique('code');
            $table->dropColumn('device_type');
        });

        Schema::table('diseases', function (Blueprint $table) {
            $table->dropIndex('diseases_device_type_index');
            $table->dropUnique(['device_type', 'code']);
            $table->unique('code');
            $table->dropColumn('device_type');
        });

        if (Schema::hasTable('category_questions')) {
            Schema::table('category_questions', function (Blueprint $table) {
                $table->dropColumn('device_type');
            });
        }
    }
};
