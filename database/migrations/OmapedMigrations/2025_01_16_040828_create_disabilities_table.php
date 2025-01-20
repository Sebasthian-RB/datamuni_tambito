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
        Schema::create('disabilities', function (Blueprint $table) {
            $table->id();
            $table->string('certificate_number', 100)->unique(); // Número de certificado de discapacidad
            $table->date('certificate_issue_date'); // Fecha de emisión del certificado
            $table->date('certificate_expiry_date')->nullable(); // Fecha de caducidad del certificado (opcional)
            $table->string('organization_name', 255); // Organización a la que pertenece
            $table->string('diagnosis', 255); // Diagnóstico de la discapacidad
            $table->string('disability_type', 100); // Tipo de discapacidad
            $table->enum('severity_level', ['Leve', 'Moderado', 'Severo']); // Nivel de gravedad
            $table->text('required_support_devices')->nullable(); // Dispositivos de apoyo que requiere (opcional)
            $table->text('used_support_devices')->nullable(); // Dispositivos o productos de apoyo que utiliza (opcional)
            $table->foreignId('om_person_id')->constrained('om_people')->cascadeOnDelete(); // Relación con persona (om_people)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disabilities');
    }
};
