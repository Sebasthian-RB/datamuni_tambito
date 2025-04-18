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
        Schema::create('vl_minors', function (Blueprint $table) {
            $table->string('id')->primary();                        // Número de documento de identidad como clave primaria
            $table->string('identity_document', 80);                // Tipo de documento de identificación
            $table->string('given_name', 80);                       // Nombre del menor
            $table->string('paternal_last_name', 50);               // Apellido Paterno del menor
            $table->string('maternal_last_name', 50)->nullable();   // Apellido Materno del menor
            $table->date('birth_date');                             // Fecha de Nacimiento del menor
            $table->boolean('sex_type');                            // Sexo del menor | 0 para femenino, 1 para masculino
            $table->date('registration_date');                      // Fecha de Empadronamiento del menor
            $table->date('withdrawal_date')->nullable();            // Fecha de Retiro del menor
            $table->string('address')->nullable();                  // Domicilio del menor (Dirección)
            $table->string('dwelling_type', 50)->nullable();        // (Tipo) Vivienda del menor
            $table->string('education_level', 80)->nullable();      // Grado de Instrucción del menor
            $table->string('condition', 100);                       // Condición del menor
            $table->boolean('disability')->nullable();              // Discapacidad del menor
            $table->boolean('has_sisfoh');                          // Si tiene o no clasificación SISFOH
            $table->string('sisfoh_classification', 20)->nullable();    // Clasificación SISFOH
            $table->boolean('status');                              // Estado activo o inactivo
            $table->string('vl_family_member_id');                  // Clave foránea hacia el Miembro de Familia
            $table->string('kinship', 50);                          // Parentesco con familiar
            $table->timestamps();                                   // Timestamps para created_at y updated_at

            $table->foreign('vl_family_member_id')
                  ->references('id')
                  ->on('vl_family_members') 
                  ->onDelete('cascade');                                                                              // Definición de la clave foránea con acción de eliminación en cascada   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vl_minors');
    }
};
