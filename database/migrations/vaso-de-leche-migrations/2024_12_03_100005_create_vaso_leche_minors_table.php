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
        Schema::create('vaso_leche_minors', function (Blueprint $table) {
            $table->string('dni')->primary();  // DNI como clave primaria
            $table->string('identity_document'); // Tipo de documento de identificación
            $table->string('given_name'); // Nombre del menor
            $table->string('paternal_last_name'); // Nombre del menor
            $table->string('maternal_last_name'); // Nombre del menor
            $table->date('birth_date'); // Nombre del menor
            $table->string('sex_type'); // Nombre del menor
            $table->date('registration_date'); // Nombre del menor
            $table->date('withdrawal_date'); // Nombre del menor
            $table->string('vaso_leche_family_member_id'); // Clave foránea hacia 'vaso_leche_family_members'
            $table->timestamps(); // Timestamps para created_at y updated_at

            $table->foreign('vaso_leche_family_member_id')->references('dni')->on('vaso_leche_family_members')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaso_leche_minors');
    }
};
