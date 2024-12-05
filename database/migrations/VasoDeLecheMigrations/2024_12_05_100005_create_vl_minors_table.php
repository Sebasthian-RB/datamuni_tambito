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
            $table->string('id')->primary();                                                                            // Número de documento de identidad como clave primaria
            $table->string('identity_document');                                                                        // Tipo de documento de identificación
            $table->string('given_name');                                                                               // Nombre del menor
            $table->string('paternal_last_name');                                                                       // Apellido Paterno del menor
            $table->string('maternal_last_name');                                                                       // Apellido Materno del menor
            $table->date('birth_date');                                                                                 // Fecha de Nacimiento del menor
            $table->string('sex_type');                                                                                 // Sexo del menor
            $table->date('registration_date');                                                                          // Fecha de Empadronamiento del menor
            $table->date('withdrawal_date');                                                                            // Fecha de Retiro del menor
            $table->string('address');                                                                                  // Domicilio del menor (Dirección)
            $table->enum('dwelling_type', ['Propio', 'Alquilado']);                                                     // (Tipo) Vivienda del menor
            $table->enum('education_level', ['Ninguno', 'Inicial', 'Primaria', 'Secundaria', 'Técnico', 'Superior']);   // Grado de Instrucción del menor
            $table->enum('condition',  ['Gest.', 'Lact.', 'Anc.']);                                                     // Condición del menor (GEST. | LACT. | ANC.)
            $table->boolean('disability');                                                                              // Apellido Materno del menor
            $table->string('vl_family_member_id');                                                                      // Clave foránea hacia el Miembro de Familia
            $table->timestamps();                                                                                       // Timestamps para created_at y updated_at

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
