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
        Schema::create('vocational_trainings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('refugee_id')->constrained()->onDelete('cascade');
            $table->string('program_name');
            $table->enum('program_type', ['vocational', 'educational', 'language', 'other']);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('institution');
            $table->json('skills_acquired')->nullable();
            $table->string('certification')->nullable();
            $table->enum('status', ['ongoing', 'completed', 'dropped', 'planned'])->default('planned');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vocational_trainings');
    }
};
