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
        Schema::create('locations', function (Blueprint $table) {

            $table->string('id',15)->primary(); // Es el codigo de ubigeo, o tambien otro codigo de los tipos de documentos
            $table->string('department', 70); // Departamento, maximo 70 caracteres
            $table->string('province', 70); // Provincia, maximo 70 caracteres
            $table->string('district', 80); // Distrito , maximo 80 caracteres
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
