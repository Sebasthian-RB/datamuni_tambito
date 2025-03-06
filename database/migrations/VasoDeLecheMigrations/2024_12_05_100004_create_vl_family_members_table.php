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
        Schema::create('vl_family_members', function (Blueprint $table) {
            $table->string('id')->primary()->unique();              // Número de documento de identidad como clave primaria
            $table->string('identity_document', 80);                // Columna para el tipo documento de identidad, debe ser único
            $table->string('given_name', 80);                       // Columna para los nombres
            $table->string('paternal_last_name', 50);               // Columna para el apellido paterno
            $table->string('maternal_last_name', 50)->nullable();   // Columna para el apellido materno
            $table->timestamps();                                   // Columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vl_family_members');
    }
};
