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
        Schema::create('public_insurances', function (Blueprint $table) {

            $table->string('id', 8)->primary(); // Identificador de SIS o ESSALUD, suficiente con espacio de 8
            $table->enum('public_insurances_name', ['SIS', 'ESSALUD']); // Solo estas opciones
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_insurances');
    }
};
