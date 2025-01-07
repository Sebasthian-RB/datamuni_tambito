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
        
            $table->string('id',6)->primary(); // Es el codigo de ubigeo, o tambien otro codigo de los tipos de documentos
            $table->string('department', 15); // Departamento, maximo 15 caracteres
            $table->string('province', 30); // Provincia, maximo 30 caracteres
            $table->string('district', 50); // Distrito , maximo 50 caracteres
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
