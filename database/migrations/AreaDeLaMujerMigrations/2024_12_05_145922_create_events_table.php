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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50); // Nombre del evento
            $table->text('description'); // Descripción del evento
            $table->string('place', 150); // Lugar del evento
            $table->dateTime('start_date'); // Fecha de inicio del evento
            $table->dateTime('end_date'); // Fecha de finalización del evento
            $table->enum('status', ['Pendiente', 'Finalizado', 'En proceso', 'Cancelado']); // Estado del evento
            $table->foreignId('program_id')->constrained('programs')->cascadeOnDelete(); // Relación con programas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
