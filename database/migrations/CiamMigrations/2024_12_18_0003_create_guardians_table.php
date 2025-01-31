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

        // Agregar la clave foránea en ElderlyAdults
        Schema::table('elderly_adults', function (Blueprint $table) {
            $table->uuid('guardian_id')->nullable()->after('id');
            $table->foreign('guardian_id')->references('id')->on('guardians')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('elderly_adults', function (Blueprint $table) {
            $table->dropForeign(['guardian_id']);
            $table->dropColumn('guardian_id');
        });

        Schema::dropIfExists('guardians');
    }
};
