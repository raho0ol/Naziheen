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
        Schema::create('medical_needs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('refugee_id')->constrained()->onDelete('cascade');
            $table->string('medical_condition');
            $table->string('medication_name');
            $table->string('dosage');
            $table->string('frequency');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('prescribing_doctor');
            $table->text('notes')->nullable();
            $table->enum('status', ['active', 'completed', 'discontinued'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_needs');
    }
};
