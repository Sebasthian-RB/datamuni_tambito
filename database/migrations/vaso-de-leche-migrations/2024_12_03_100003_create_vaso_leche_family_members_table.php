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
        Schema::create('vaso_leche_family_members', function (Blueprint $table) {
            $table->string('dni')->primary();  // DNI como clave primaria
            $table->string('identity_document')->unique(); // Columna para el documento de identidad, debe ser único
            $table->string('given_name'); // Columna para el nombre
            $table->string('paternal_last_name'); // Columna para el apellido paterno
            $table->string('maternal_last_name'); // Columna para el apellido materno
            $table->string('address'); // Columna para la dirección
            $table->string('education_level'); // Columna para el nivel educativo
            $table->timestamps(); // Columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaso_leche_family_members');
    }
};
