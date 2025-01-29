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
            $table->string('id', 8)->primary(); // ID fijo de SIS o ESSALUD (manteniéndolo como string)
            $table->enum('name', ['SIS', 'ESSALUD']); // Nombre más claro para la columna
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
