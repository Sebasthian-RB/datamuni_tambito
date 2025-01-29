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
        Schema::create('locations', function (Blueprint $table) {
            $table->string('id', 6)->primary(); // ID único para la localidad
            $table->string('department', 15); // Departamento
            $table->string('province', 30); // Provincia
            $table->string('district', 50); // Distrito
            $table->timestamps();

            // Índice único compuesto para evitar duplicados en department, province, y district
            $table->unique(['department', 'province', 'district'], 'unique_location_combination');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
