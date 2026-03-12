<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Update tabel untuk Sistem Pakar Forward Chaining
     */
    public function up(): void
    {
        // Update symptoms table - tambah keywords dan follow_up_question
        Schema::table('symptoms', function (Blueprint $table) {
            if (!Schema::hasColumn('symptoms', 'keywords')) {
                $table->text('keywords')->nullable()->after('category'); // Kata kunci untuk matching
            }
            if (!Schema::hasColumn('symptoms', 'follow_up_question')) {
                $table->text('follow_up_question')->nullable()->after('keywords'); // Pertanyaan lanjutan
            }
            if (!Schema::hasColumn('symptoms', 'weight')) {
                $table->decimal('weight', 3, 2)->default(1.00)->after('follow_up_question'); // Bobot gejala (CF)
            }
        });

        // Update diseases table - tambah description
        Schema::table('diseases', function (Blueprint $table) {
            if (!Schema::hasColumn('diseases', 'description')) {
                $table->text('description')->nullable()->after('name');
            }
            if (!Schema::hasColumn('diseases', 'actions')) {
                $table->text('actions')->nullable()->after('solution'); // Tindakan yang perlu dilakukan
            }
        });

        // Update rules table - tambah priority dan CF
        Schema::table('rules', function (Blueprint $table) {
            if (!Schema::hasColumn('rules', 'cf_value')) {
                $table->decimal('cf_value', 3, 2)->default(1.00)->after('symptom_id'); // Certainty Factor
            }
            if (!Schema::hasColumn('rules', 'priority')) {
                $table->integer('priority')->default(1)->after('cf_value'); // Urutan prioritas rule
            }
        });

        // Create new table untuk menyimpan follow-up questions per kategori
        if (!Schema::hasTable('category_questions')) {
            Schema::create('category_questions', function (Blueprint $table) {
                $table->id();
                $table->string('category');
                $table->text('question');
                $table->string('expected_keyword')->nullable(); // Keyword dari jawaban yang diharapkan
                $table->foreignId('leads_to_symptom_id')->nullable()->constrained('symptoms')->onDelete('set null');
                $table->integer('order')->default(1);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('symptoms', function (Blueprint $table) {
            $table->dropColumn(['keywords', 'follow_up_question', 'weight']);
        });

        Schema::table('diseases', function (Blueprint $table) {
            $table->dropColumn(['description', 'actions']);
        });

        Schema::table('rules', function (Blueprint $table) {
            $table->dropColumn(['cf_value', 'priority']);
        });

        Schema::dropIfExists('category_questions');
    }
};
