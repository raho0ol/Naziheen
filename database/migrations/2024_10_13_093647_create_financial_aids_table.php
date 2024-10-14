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
        Schema::create('financial_aids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('refugee_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->string('currency');
            $table->string('aid_type');
            $table->date('date_provided');
            $table->string('provider');
            $table->string('purpose');
            $table->enum('status', ['pending', 'approved', 'disbursed', 'completed', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_aids');
    }
};
