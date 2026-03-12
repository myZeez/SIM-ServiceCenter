<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add question_type and options columns to category_questions.
     * question_type: 'yesno' (default Ya/Tidak buttons) or 'choice' (custom option buttons)
     * options: JSON array of {label, value} for choice-type questions
     */
    public function up(): void
    {
        Schema::table('category_questions', function (Blueprint $table) {
            $table->string('question_type', 20)->default('yesno')->after('order');
            $table->json('options')->nullable()->after('question_type');
        });
    }

    public function down(): void
    {
        Schema::table('category_questions', function (Blueprint $table) {
            $table->dropColumn(['question_type', 'options']);
        });
    }
};
