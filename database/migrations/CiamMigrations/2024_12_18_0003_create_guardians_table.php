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
            $table->string('id', 36)->primary(); // ID único para identificar al guardián
            $table->enum('document_type', ['DNI', 'Pasaporte', 'Carnet', 'Cedula']); // Tipo de documento permitido
            $table->string('given_name', 50); // Nombres (máximo 50 caracteres)
            $table->string('paternal_last_name', 50); // Apellido paterno (máximo 50 caracteres)
            $table->string('maternal_last_name', 50); // Apellido materno (máximo 50 caracteres)
            $table->string('phone_number', 50)->nullable(); // Número de teléfono (opcional, máximo 50 caracteres)
            $table->timestamps(); // Columnas created_at y updated_at
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
