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
        Schema::create('psychological_diagnoses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('om_person_id')->constrained('om_people')->cascadeOnDelete(); // Relaciona con om_people
            $table->text('diagnosis')->nullable(); // Diagnóstico inicial
            $table->integer('recommended_sessions')->default(1); // Cantidad de sesiones recomendadas
            $table->date('diagnosis_date'); // Fecha del diagnóstico
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('psychological_diagnoses');
    }
};
