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
            $table->string('exact_location', 255); // Localización exacta de la vivienda
            $table->text('reference')->nullable(); // Referencia de la vivienda
            $table->string('annex_sector', 255)->nullable(); // Anexo/Sector de la vivienda
            $table->enum('water_electricity', ['Agua', 'Luz', 'Agua y Luz', 'Ninguno']); // Suministro de agua y/o luz
            $table->string('type', 50); // Tipo de vivienda
            $table->enum('ownership_status', ['Propia', 'Alquilada', 'Prestada']); // Situación de la vivienda (propia, alquilada, prestada)
            $table->integer('permanent_occupants'); // Número de personas viviendo permanentemente
            $table->timestamps(); // Tiempos de creación y actualización
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
