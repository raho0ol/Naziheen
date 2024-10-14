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
        Schema::create('psychological_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('refugee_id')->constrained()->onDelete('cascade');
            $table->date('assessment_date');
            $table->string('assessor_name');
            $table->enum('mental_state', ['stable', 'moderate', 'severe']);
            $table->integer('stress_level')->nullable();
            $table->integer('anxiety_level')->nullable();
            $table->integer('depression_level')->nullable();
            $table->boolean('ptsd_symptoms')->default(false);
            $table->boolean('suicidal_thoughts')->default(false);
            $table->enum('sleep_quality', ['good', 'fair', 'poor'])->nullable();
            $table->enum('appetite', ['normal', 'increased', 'decreased'])->nullable();
            $table->enum('social_interactions', ['normal', 'withdrawn', 'aggressive'])->nullable();
            $table->text('coping_mechanisms')->nullable();
            $table->text('recommendations');
            $table->date('follow_up_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('psychological_assessments');
    }
};
