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
        Schema::create('job_opportunities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('company');
            $table->text('description');
            $table->text('requirements');
            $table->string('location');
            $table->string('salary')->nullable();
            $table->date('application_deadline');
            $table->enum('status', ['open', 'closed', 'filled'])->default('open');
            $table->timestamps();
        });

        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('refugee_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_opportunity_id')->constrained()->onDelete('cascade');
            $table->date('application_date');
            $table->enum('status', ['applied', 'under_review', 'interviewed', 'offered', 'hired', 'rejected'])->default('applied');
            $table->date('interview_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_opportunities');
    }
};
