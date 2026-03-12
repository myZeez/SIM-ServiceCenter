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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('service_type', ['REGULER', 'AUTHORIZED'])->default('REGULER');
            $table->string('rma_number')->nullable();
            $table->string('device_name');
            $table->string('serial_number')->nullable();
            $table->text('complaint');
            $table->text('diagnosis_result')->nullable();
            $table->decimal('estimated_cost', 10, 2)->default(0);
            $table->decimal('total_cost', 10, 2)->default(0);
            $table->boolean('approved')->default(false);
            $table->enum('status', ['Pending', 'Diagnosis', 'Waiting Approval', 'In Progress', 'Waiting Part', 'Done', 'Taken', 'Cancelled'])->default('Pending');
            $table->timestamp('taken_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
