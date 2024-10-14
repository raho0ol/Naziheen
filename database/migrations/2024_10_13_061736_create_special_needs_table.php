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
        Schema::create('special_needs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('refugee_id')->constrained()->onDelete('cascade');
            $table->string('need_type');
            $table->text('description');
            $table->enum('severity', ['mild', 'moderate', 'severe']);
            $table->date('diagnosis_date')->nullable();
            $table->text('treatment_plan')->nullable();
            $table->string('assistive_devices')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_needs');
    }
};
