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
            $table->uuid('id')->primary(); // ID único manual
            $table->enum('document_type', ['DNI', 'Pasaporte', 'Carnet', 'Cedula']); // Tipo de documento
            $table->string('given_name', 50); // Nombre
            $table->string('paternal_last_name', 50); // Apellido paterno
            $table->string('maternal_last_name', 50)->nullable(); // Apellido materno
            $table->date('birth_date'); // Fecha de nacimiento
            $table->string('address', 255)->nullable(); // Dirección
            $table->string('reference', 255)->nullable(); // Referencia
            $table->boolean('sex_type'); // Sexo (0: femenino, 1: masculino)
            $table->json('language'); // Lengua (Español, Quechua, Aimara, Otro)
            $table->string('phone_number', 50)->nullable(); // Teléfono
            $table->enum('type_of_disability', ['Visual', 'Motriz', 'Mental'])->nullable(); // Tipo de discapacidad
            $table->integer('household_members')->nullable(); // Miembros del hogar
            $table->boolean('permanent_attention')->nullable(); // Atención permanente
            $table->text('observation')->nullable(); // Observaciones generales 

            // Relación opcional con Guardian 
            $table->uuid('guardian_id')->nullable();
            $table->foreign('guardian_id')->references('id')->on('guardians')->onDelete('set null');

            // Seguro público
            $table->enum('public_insurance', ['SIS', 'ESSALUD'])->nullable(); // Seguro público (opcional)

            // Seguro privado
            $table->string('private_insurance', 255)->nullable(); // Seguro privado (opcional)

            // Programas sociales
            $table->string('social_program', 255)->nullable(); // Programa social al que pertenece (opcional)

            // Estado del adulto mayor en el CIAM
            $table->boolean('state')->default(true);

            // Timestamps
            $table->timestamps();
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
