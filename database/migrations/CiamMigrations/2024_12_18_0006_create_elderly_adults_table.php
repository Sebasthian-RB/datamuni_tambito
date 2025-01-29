<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecutar la migración.
     */
    public function up(): void
    {
        Schema::create('elderly_adults', function (Blueprint $table) {
            $table->string('id', 36)->primary(); // ID único que se puede escribir manualmente
            $table->enum('document_type', ['DNI', 'Pasaporte', 'Carnet', 'Cedula']); // Tipo de documento
            $table->string('given_name', 50); // Nombre
            $table->string('paternal_last_name', 50); // Apellido paterno
            $table->string('maternal_last_name', 50); // Apellido materno
            $table->date('birth_date'); // Fecha de nacimiento
            $table->string('address', 255)->nullable(); // Dirección (opcional)
            $table->string('reference', 255)->nullable(); // Referencia (opcional)
            $table->boolean('sex_type'); // Sexo (0: femenino, 1: masculino)
            $table->string('phone_number', 50)->nullable(); // Teléfono (opcional)
            $table->enum('type_of_disability', ['Visual', 'Motriz', 'Mental'])->nullable(); // Tipo de discapacidad
            $table->integer('household_members')->nullable(); // Número de miembros en el hogar
            $table->boolean('permanent_attention')->nullable(); // Atención permanente
            $table->text('observation')->nullable(); // Observaciones generales

            // Relaciones con otras tablas
            $table->unsignedBigInteger('location_id'); // Relación con locations
            $table->unsignedBigInteger('public_insurance_id')->nullable(); // Relación con public_insurances (puede ser nula)

            // Timestamps
            $table->timestamps();

            // Definir claves foráneas
            $table->foreign('location_id')
                ->references('id')
                ->on('locations')
                ->onDelete('cascade'); // Eliminación en cascada si se borra la ubicación

            $table->foreign('public_insurance_id')
                ->references('id')
                ->on('public_insurances')
                ->onDelete('set null'); // Si se borra el seguro público, el campo queda nulo
        });
    }

    /**
     * Revertir la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('elderly_adults');
    }
};
