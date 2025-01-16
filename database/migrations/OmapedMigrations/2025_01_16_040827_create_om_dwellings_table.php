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
        Schema::create('om_dwellings', function (Blueprint $table) {
            $table->id();
            $table->string('location', 255); // Localización exacta de la vivienda
            $table->text('reference')->nullable(); // Referencia de la vivienda
            $table->enum('water_electric_supply', ['Agua', 'Luz', 'Agua y Luz', 'Ninguno']); // Suministro de agua y/o luz
            $table->string('dwelling_type', 50); // Tipo de vivienda
            $table->enum('dwelling_status', ['Propia', 'Alquilada', 'Prestada']); // Situación de la vivienda
            $table->integer('number_of_residents'); // Número de personas viviendo permanentemente
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('om_dwellings');
    }
};
