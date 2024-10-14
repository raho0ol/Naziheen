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
        Schema::create('recreational_activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->enum('activity_type', ['cultural', 'sports', 'art', 'music', 'educational', 'other']);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('location');
            $table->integer('capacity');
            $table->string('organizer');
            $table->enum('status', ['planned', 'ongoing', 'completed', 'cancelled'])->default('planned');
            $table->timestamps();
        });

        Schema::create('recreational_activity_participants', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('recreational_activity_id')->constrained()->onDelete('cascade');
            $table->foreignId('refugee_id')->constrained()->onDelete('cascade');
            $table->date('registration_date');
            $table->boolean('attendance')->default(false);
            $table->text('feedback')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recreational_activity_participants');
        Schema::dropIfExists('recreational_activities');
    }
};
