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
        Schema::create('interventions', function (Blueprint $table) {
            $table->id();                           // ID único
            $table->text('appointment');            // Cita: texto grande
            $table->text('derivation');             // Derivación: texto grande
            $table->dateTime('appointment_date');   // Fecha y hora de la cita
            $table->timestamps();                   // Timestamps para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interventions');
    }
};
