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
            $table->id();                                                                   // ID único
            $table->enum('identity_document', ['DNI', 'Pasaporte', 'Carnet', 'Cedula']);    // Documento de identidad: puede ser DNI, PASAPORTE, CARNET o CEDULA
            $table->string('given_name', 100);                                              // Nombre
            $table->string('paternal_last_name');                                           // Apellido paterno
            $table->string('maternal_last_name');                                           // Apellido materno
            $table->string('address');                                                      // Dirección
            $table->boolean('sex_type');                                                    // Tipo de sexo: 0 para femenino, 1 para masculino
            $table->string('phone_number');                                                 // Número de teléfono
            $table->dateTime('attendance_date');                                            // Fecha y hora de asistencia
            $table->timestamps();                                                           // Timestamps para created_at y updated_at
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
