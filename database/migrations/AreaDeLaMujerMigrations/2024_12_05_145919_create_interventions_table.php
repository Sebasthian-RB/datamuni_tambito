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
            $table->id();                                // ID único autoincremental
            $table->text('appointment');                 // Detalle de la cita
            $table->text('derivation')->nullable();      // Derivación opcional
            $table->dateTime('appointment_date')->index(); // Fecha y hora de la cita con índice para búsquedas
            $table->timestamps();                        // created_at y updated_at
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
