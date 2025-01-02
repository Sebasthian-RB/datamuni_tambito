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
        Schema::create('elderly_adults', function (Blueprint $table) {
            
            $table->string('id', 36)->primary(); // ID único que se puede escribir
            $table->enum('document_type', ['DNI', 'Pasaporte', 'Carnet', 'Cedula']); // Solo estas opciones
            $table->string('given_name', 50); // Máximo 50 caracteres
            $table->string('paternal_last_name', 50); // Máximo 50 caracteres
            $table->string('maternal_last_name', 50); // Máximo 50 caracteres
            $table->date('birth_date'); // Fecha de Nacimiento del adulto mayor
            $table->string('address', 255)->nullable(); // Dirección de máximo 255 caracteres
            $table->string('reference', 255)->nullable(); // Referencia de  máximo 255 caracteres
            $table->boolean('sex_type'); // 0 para femenino, 1 para masculino
            $table->string('phone_number', 50)->nullable(); // Máximo 50 caracteres, opcional
            $table->enum('type_of_disability', ['Visual', 'Motriz','Mental'])->nullable(); // Estas opciones y algunas más que pueden crear
            $table->int('household_members')->nullable(); // Cantidad de personas con las que vive el adulto mayor
            $table->boolean('permanent_attention')->nullable(); // 0 No requiere atencion permanente ,1 Si requiere atencion permanente
            $table->text('observation')->nullable(); // texto mediano para indicar algo mas sobre el adulto mayor
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elderly_adults');
    }
};
