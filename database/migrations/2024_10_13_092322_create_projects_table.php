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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->enum('status', ['planned', 'in_progress', 'completed', 'on_hold', 'cancelled'])->default('planned');
            $table->decimal('budget', 10, 2)->nullable();
            $table->string('manager');
            $table->string('location');
            $table->timestamps();
        });

        Schema::create('project_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('refugee_id')->constrained()->onDelete('cascade');
            $table->string('role')->nullable();
            $table->date('join_date');
            $table->date('leave_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_participants');
        Schema::dropIfExists('projects');
    }
};
