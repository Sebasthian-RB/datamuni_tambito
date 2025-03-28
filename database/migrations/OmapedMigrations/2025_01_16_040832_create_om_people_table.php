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
        Schema::create('om_people', function (Blueprint $table) {
            $table->id();
            $table->datetime('registration_date'); // Fecha de inscripción
            $table->string('paternal_last_name', 100); // Apellido paterno
            $table->string('maternal_last_name', 100); // Apellido materno
            $table->string('given_name', 100); // Nombres
            $table->enum('marital_status', ['Soltero', 'Casado', 'Divorciado', 'Viudo', 'Unión libre']); // Estado civil
            $table->string('dni', 8)->unique(); // DNI
            $table->date('birth_date'); // Fecha de nacimiento
            $table->enum('gender', ['Masculino', 'Femenino', 'Otro']); // Sexo
            $table->string('phone', 15)->nullable(); // Teléfono
            $table->string('email', 150)->nullable(); // Correo electrónico
            $table->string('education_level', 150)->nullable(); // Grado de instrucción
            $table->string('occupation', 150)->nullable(); // Ocupación
            $table->enum('health_insurance', ['SIS', 'EsSalud', 'Seguro Privado', 'Ninguno'])->nullable(); // Seguro de salud
            $table->boolean('sisfoh')->nullable(); // SISFOH (SISFOH o no)
            $table->enum('employment_status', ['Activo', 'Inactivo', 'Pensionista'])->nullable(); // Inserción laboral
            $table->enum('pension_status', ['Pensionado', 'No Pensionado'])->nullable(); // Pensión del estado o privado
            $table->foreignId('om_dwelling_id')->nullable()->constrained('om_dwellings')->nullOnDelete(); // Vivienda seleccionada
            $table->foreignId('disability_id')->nullable()->constrained('disabilities')->nullOnDelete(); // Discapacidad opcional
            $table->text('personal_assistance_need')->nullable(); // Necesidad de asistencia personal
            $table->text('autonomy_notes')->nullable(); // Notas sobre autonomía
            $table->foreignId('caregiver_id')->nullable()->constrained('caregivers')->nullOnDelete(); // Cuidador opcional
            $table->text('observations')->nullable(); // Observaciones
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('om_people');
    }
};
