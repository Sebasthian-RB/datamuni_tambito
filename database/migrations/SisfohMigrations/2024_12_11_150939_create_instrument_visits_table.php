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
        Schema::create('instrument_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instrument_id')->constrained('instruments')->cascadeOnDelete(); // Elimina el registro si se elimina el instrumento
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete(); // Elimina el registro si se elimina la visita
            $table->date('application_date'); // Fecha de aplicación
            $table->text('descriptions')->nullable(); // Descripciones adicionales
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instrument_visits');
    }
};
