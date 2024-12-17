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
        Schema::create('sfc_dwelling_sfc_people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('sfh_dwelling_id')->constrained('sfh_dwellings')->cascadeOnDelete(); // Elimina el registro si se elimina la vivienda
            $table->string('sfh_person_id', 36); // Relación con sfh_people
            $table->foreign('sfh_person_id')->references('id')->on('sfh_people')->cascadeOnDelete(); // Relación con sfh_people
            $table->string('status', 50); // Estado de la relación
            $table->date('update_date'); // Fecha de actualización
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sfc_dwelling_sfc_people');
    }
};
