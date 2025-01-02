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
        Schema::create('guardians', function (Blueprint $table) {

            $table->string('id', 36)->primary(); // ID único que se puede escribir
            $table->enum('document_type', ['DNI', 'Pasaporte', 'Carnet', 'Cedula']); // Solo estas opciones
            $table->string('given_name', 50); // Máximo 50 caracteres
            $table->string('paternal_last_name', 50); // Máximo 50 caracteres
            $table->string('maternal_last_name', 50); // Máximo 50 caracteres
            $table->string('phone_number', 50); // Máximo 50 caracteres, opcional
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardians');
    }
};
