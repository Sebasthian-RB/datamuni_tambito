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
            $table->unsignedBigInteger('request_id');
            $table->unsignedBigInteger('enumerator_id');

            // Relaciones de claves foráneas
            $table->foreignId('request_id')->constrained('requests')->onDelete('cascade'); // Elimina las visitas si se elimina la solicitud
            $table->foreignId('enumerator_id')->constrained('enumerators')->onDelete('cascade'); // Elimina las visitas si se elimina el enumerador
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
