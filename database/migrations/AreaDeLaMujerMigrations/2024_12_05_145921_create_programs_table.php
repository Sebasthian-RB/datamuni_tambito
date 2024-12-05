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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();                                                                   // ID único
            $table->string('name');                                                         // Nombre del programa
            $table->text('description');                                                    // Descripción del programa: texto grande
            $table->string('program_type');                                                 // Tipo de programa: varchar
            $table->date('start_date');                                                     // Fecha de inicio
            $table->date('end_date')->nullable();                                           // Fecha de finalización (puede ser nula)
            $table->enum('status', ['Pendiente', 'Finalizado', 'En proceso', 'Cancelado']); // Estado del programa: enum
            $table->timestamps();                                                           // Timestamps para created_at y updated_at
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
