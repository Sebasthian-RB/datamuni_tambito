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
        Schema::create('psychological_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diagnosis_id')->constrained('psychological_diagnoses')->cascadeOnDelete();
            $table->integer('session_number');
            $table->date('scheduled_date');
            $table->enum('attendance_status', ['Asistió', 'No asistió', 'Justificó'])->nullable(); // Opciones de asistencia
            $table->text('description')->nullable(); // Descripción de la sesión
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('psychological_sessions');
    }
};
