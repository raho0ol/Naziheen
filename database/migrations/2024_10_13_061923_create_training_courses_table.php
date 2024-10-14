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
        Schema::create('training_courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_name');
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('instructor');
            $table->string('location');
            $table->integer('capacity');
            $table->enum('status', ['upcoming', 'ongoing', 'completed', 'cancelled'])->default('upcoming');
            $table->timestamps();
        });

        Schema::create('refugee_training_course', function (Blueprint $table) {
            $table->id();
            $table->foreignId('refugee_id')->constrained()->onDelete('cascade');
            $table->foreignId('training_course_id')->constrained()->onDelete('cascade');
            $table->date('enrollment_date');
            $table->enum('completion_status', ['enrolled', 'in_progress', 'completed', 'dropped'])->default('enrolled');
            $table->boolean('certificate_issued')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('refugee_training_course');
        Schema::dropIfExists('training_courses');
    }

};
