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
        Schema::create('enumerators', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->enum('identity_document', ['DNI', 'Pasaporte', 'Carnet', 'Cedula']); // Solo estas opciones - tipos de documentos
            $table->string('given_name', 80); // Nombres completos 
            $table->string('paternal_last_name', 50); // Apellido paterno
            $table->string('maternal_last_name', 50); // Apellido materno
            $table->string('phone_number', 15)->nullable(); // Número de teléfono (opcional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enumerators');
    }
};
