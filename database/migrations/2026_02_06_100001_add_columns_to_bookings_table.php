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
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('booking_code')->unique()->after('id');
            $table->string('name')->after('booking_code');
            $table->string('phone')->after('name');
            $table->string('email')->nullable()->after('phone');
            $table->text('address')->nullable()->after('email');
            $table->string('device_brand')->after('address');
            $table->string('device_name')->after('device_brand');
            $table->string('serial_number')->nullable()->after('device_name');
            $table->text('complaint')->after('serial_number');
            $table->json('symptoms')->nullable()->after('complaint');
            $table->json('diagnosis_result')->nullable()->after('symptoms');
            $table->text('ai_recommendation')->nullable()->after('diagnosis_result');
            $table->enum('status', ['pending', 'confirmed', 'in_progress', 'completed', 'cancelled'])
                ->default('pending')
                ->after('ai_recommendation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'booking_code',
                'name',
                'phone',
                'email',
                'address',
                'device_brand',
                'device_name',
                'serial_number',
                'complaint',
                'symptoms',
                'diagnosis_result',
                'ai_recommendation',
                'status',
            ]);
        });
    }
};
