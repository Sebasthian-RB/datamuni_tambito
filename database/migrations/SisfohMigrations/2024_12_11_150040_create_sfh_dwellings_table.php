<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sfh_dwellings', function (Blueprint $table) {
            $table->id(); 
            $table->string('street_address'); // Dirección de la vivienda
            $table->string('reference', 255)->nullable(); // Referencia opcional
            $table->string('neighborhood', 100)->nullable(); // Barrio opcional
            $table->string('district', 50); // Distrito obligatorio
            $table->string('provincia', 30); // Provincia obligatoria
            $table->string('region', 15); // Región obligatoria
            // $table->enum('zone', ['urbano', 'rural']); // Zona (urbano o rural)
            // $table->date('creation_date')->default(Carbon::now()); // Fecha de registro actual
            // $table->date('expiration_date')->nullable(); // Fecha de caducidad
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sfh_dwellings');
    }
};
