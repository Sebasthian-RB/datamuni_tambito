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
        Schema::create('sfh_dwellings', function (Blueprint $table) {
            $table->id(); 
            $table->string('street_address'); // Dirección de la vivienda
            $table->string('reference', 255)->nullable(); // Referencia opcional
            $table->string('neighborhood', 100)->nullable(); // Barrio opcional
            $table->string('district', 100); // Distrito obligatorio
            $table->string('provincia', 100); // Provincia obligatoria
            $table->string('region', 100); // Región obligatoria
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sfh_dwellings');
    }
};
