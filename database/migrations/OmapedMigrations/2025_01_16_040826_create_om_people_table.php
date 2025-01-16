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
            $table->string('paternal_last_name', 100);
            $table->string('maternal_last_name', 100);
            $table->string('given_name', 100);
            $table->enum('civil_status', ['Soltero', 'Casado', 'Divorciado', 'Viudo', 'Unión libre']);
            $table->string('dni', 8)->unique();
            $table->date('birth_date');
            $table->integer('age');
            $table->enum('gender', ['Masculino', 'Femenino', 'Otro']);
            $table->string('phone', 15)->nullable();
            $table->string('email', 150)->nullable();
            $table->text('observation')->nullable(); // Nuevo campo agregado
            $table->foreignId('om_dwelling_id')->constrained('om_dwellings')->cascadeOnDelete(); // Relación con viviendas
            $table->foreignId('caregiver_id')->nullable()->constrained('caregivers')->cascadeOnDelete(); // Relación con cuidadores
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
