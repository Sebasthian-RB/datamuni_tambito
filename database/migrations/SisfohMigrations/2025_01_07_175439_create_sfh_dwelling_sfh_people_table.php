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
        Schema::create('sfh_dwelling_sfh_people', function (Blueprint $table) {
            $table->id();            
            $table->string('sfh_person_id', 36); // Relación con sfh_people
            $table->enum('status', ['Activo', 'Inactivo']); // Estado de la visita
            $table->date('update_date'); // Fecha de actualización

            // Relaciones de claves foráneas
            $table->foreign('sfh_person_id')->references('id')->on('sfh_people')->cascadeOnDelete(); // Relación con sfh_people
            $table->foreignId('sfh_dwelling_id')->constrained('sfh_dwellings')->cascadeOnDelete(); // Elimina el registro si se elimina la vivienda

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sfh_dwelling_sfh_people');
    }
};
