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
        Schema::create('am_people', function (Blueprint $table) {
            $table->string('id', 36)->primary(); // ID único que se puede escribir
            $table->enum('identity_document', ['DNI', 'Pasaporte', 'Carnet', 'Cedula']); // Solo estas opciones
            $table->string('given_name', 50); // Máximo 50 caracteres
            $table->string('paternal_last_name', 50); // Máximo 50 caracteres
            $table->string('maternal_last_name', 50); // Máximo 50 caracteres
            $table->string('address', 255)->nullable(); // Dirección opcional, máximo 255 caracteres
            $table->boolean('sex_type'); // 0 para femenino, 1 para masculino
            $table->string('phone_number', 50)->nullable(); // Máximo 50 caracteres, opcional
            $table->dateTime('attendance_date')->index(); // Con índice para búsquedas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('am_people');
    }
};
