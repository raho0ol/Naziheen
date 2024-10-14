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
        Schema::create('refugees', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('id_number')->unique();
            $table->string('phone_number');
            $table->integer('family_members');
            $table->string('spouse_full_name')->nullable();
            $table->string('spouse_id_number')->unique()->nullable();
            $table->string('original_residence')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refugees');
    }
};
