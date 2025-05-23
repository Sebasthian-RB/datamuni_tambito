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
        Schema::create('committees', function (Blueprint $table) {
            $table->id();            // Columna de clave primaria auto-incremental
            $table->string('committee_number',10);      // Columna de número de comité
            $table->string('name', 150);                // Columna para el nombre del comité
            $table->string('president');                // Columna para el presidente del comité
            $table->string('urban_core');               // Columna para el núcleo urbano
            $table->unsignedBigInteger('sector_id');    // Columna para el FK del Sector
            $table->timestamps();                       // Columnas created_at y updated_at

            $table->foreign('sector_id')
                    ->references('id')->on('sectors')
                    ->onDelete('cascade');                      // Definición de la clave foránea con acción de eliminación en cascada            
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('committees');
    }
};
