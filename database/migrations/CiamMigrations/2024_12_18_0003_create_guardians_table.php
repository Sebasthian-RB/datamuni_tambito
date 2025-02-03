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
        Schema::create('guardians', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('given_name', 50);
            $table->string('paternal_last_name', 50);
            $table->string('maternal_last_name', 50)->nullable();
            $table->enum('document_type', ['DNI', 'Pasaporte', 'Carnet', 'Cédula']);
            $table->string('phone_number', 20)->nullable();
            $table->string('relationship', 50); // Relación con el adulto mayor (manejado en la vista)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {


        Schema::dropIfExists('guardians');
    }
};
