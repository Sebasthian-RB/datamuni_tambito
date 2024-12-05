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
            $table->id();                                                                   // ID único
            $table->string('name');                                                         // Nombre del evento
            $table->text('description');                                                    // Descripción del evento: texto grande
            $table->string('place');                                                        // Lugar del evento
            $table->date('start_date');                                                     // Fecha de inicio del evento
            $table->date('end_date')->nullable();                                           // Fecha de finalización del evento (puede ser nula)
            $table->enum('status', ['En proceso', 'Pendiente', 'Finalizado', 'Cancelado']); // Estado del evento: enum
            $table->foreignId('program_id')->constrained();                                 // ID del programa (foráneo de programs)
            $table->timestamps();                                                           // Timestamps para created_at y updated_at
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
