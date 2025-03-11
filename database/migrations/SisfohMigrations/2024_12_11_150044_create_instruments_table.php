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
        Schema::create('instruments', function (Blueprint $table) {
            $table->id();
            $table->string('name_instruments', 100); // Nombre del instrumento
            $table->string('type_instruments', 50); // Tipo de instrumento
            $table->string('number_instruments', 50)->nullable(); // Numero de instrumento
            $table->text('description')->nullable(); // Descripción del instrumento
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instruments');
    }
};
