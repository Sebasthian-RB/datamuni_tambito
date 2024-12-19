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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->date('visit_date'); // Fecha de la visita
            $table->enum('status', ['Visitado', 'No visitado', 'No encontrado']); // Estado de la visita
            $table->text('observations')->nullable(); // Observaciones, puede ser nulo

            $table->string('enumerator_id', 36);

            // Relaciones de claves foráneas
            $table->foreignId('request_id')->constrained('requests')->onDelete('cascade'); // Elimina las visitas si se elimina la solicitud
            $table->foreign('enumerator_id')->references('id')->on('enumerators')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
