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
            $table->id();
            $table->string('name', 50); // Nombre del programa
            $table->text('description'); // Descripción del programa
            $table->string('program_type', 50); // Tipo de programa
            $table->date('start_date'); // Fecha de inicio del programa
            $table->date('end_date')->nullable(); // Fecha de finalización del programa
            $table->enum('status', ['Pendiente', 'Finalizado', 'En proceso', 'Cancelado']); // Estado del programa
            $table->timestamps();
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
