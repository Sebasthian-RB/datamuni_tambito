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
        Schema::create('elderly_adult_social_programs', function (Blueprint $table) {
            
            $table->id();
            $table->string('elderly_adults_id', 36); // Relacion con elderly_adults
            $table->foreign('elderly_adults_id')->references('id')->on('elderly_adults')->cascadeOnDelete(); // Relación con elderly_adults
            $table->foreignId('social_programs_id')->constrained('social_programs')->cascadeOnDelete(); // Relación con social_programs
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elderly_adult_social_programs');
    }
};
