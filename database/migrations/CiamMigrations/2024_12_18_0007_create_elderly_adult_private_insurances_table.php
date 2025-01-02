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
        Schema::create('elderly_adult_private_insurances', function (Blueprint $table) {
            
            $table->id();
            $table->string('elderly_adults_id', 36); // Relacion con elderly_adults
            $table->foreign('elderly_adults_id')->references('id')->on('elderly_adults')->cascadeOnDelete(); // Relación con elderly_adults
            $table->string('private_insurances_id', 12); // Relacion con private_insurances
            $table->foreign('private_insurances_id')->references('id')->on('private_insurances')->cascadeOnDelete(); // Relación con private_insurances
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elderly_adult_private_insurances');
    }
};
