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
        Schema::create('sfh_people', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->enum('identity_document', ['DNI','Pasaporte', 'Carnet de extranjeria', 'CPP', 'Cedula']); // Solo estas opciones - tipos de documentos
            $table->string('given_name', 80); // Máximo 80 caracteres
            $table->string('paternal_last_name', 50); // Máximo 50 caracteres
            $table->string('maternal_last_name', 50); // Máximo 50 caracteres
            $table->enum('marital_status', ['Soltero(a)', 'Casado(a)', 'Divorciado(a)', 'Viudo(a)'])->nullable();
            $table->date('birth_date')->nullable(); // Fecha de nacimiento
            $table->boolean('sex_type'); // 0 para femenino, 1 para masculino
            $table->string('phone_number', 15)->nullable(); // Teléfono en proceso de cambio solo para nueve caracteres
            $table->string('nationality', 100)->nullable(); // Nacionalidad
            $table->enum('degree', [
                'INICIAL',
                'NINGUNO_NIVEL_LETRADO',
                'PRIMARIA COMPLETA',
                'PRIMARIA-1ER GRADO',
                'PRIMARIA-2DO GRADO',
                'PRIMARIA-3ER GRADO',
                'PRIMARIA-4TO GRADO',
                'PRIMARIA-5TO GRADO',
                'PRIMARIA-6TO GRADO',
                'PRIMARIA INCOMPLETA',
                'SECUNDARIA COMPLETA',
                'SECUNDARIA-1ER AÑO',
                'SECUNDARIA-2DO AÑO',
                'SECUNDARIA-3ER AÑO',
                'SECUNDARIA-4TO AÑO',
                'SECUNDARIA-5TO AÑO',
                'SECUNDARIA INCOMPLETA',
                'SUPERIOR COMPLETA',
                'SUPERIOR-1ER AÑO',
                'SUPERIOR-2DO AÑO',
                'SUPERIOR-3ER AÑO',
                'SUPERIOR-4TO AÑO',
                'SUPERIOR-5TO AÑO',
                'SUPERIOR-6TO AÑO',
                'SUPERIOR-7MO AÑO',
                'SUPERIOR-8VO AÑO',
                'SUPERIOR INCOMPLETA',
                'ILETRADO/SIN INSTRUCCION',
                'TECNICA COMPLETA',
                'TECNICA-1ER AÑO',
                'TECNICA-2DO AÑO',
                'TECNICA-3ER AÑO',
                'TECNICA-4TO AÑO',
                'TECNICA-5TO AÑO',
                'TECNICA IMCOMPLETA',
                'EDUCACION ESPECIAL']); // Grado academico
            $table->string('occupation', 100)->nullable(); // Ocupación
            $table->enum('sfh_category', [
                'No pobre',
                'Pobre',
                'Pobre extremo'
            ]); // Relacion de categoria sisfoh
            $table->enum('sfh_consultation', [
                'Atendido',
                'Empadronado',
                'No empadronado'
            ]); // Relacion de consulta sisfoh
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sfh_people');
    }
};
