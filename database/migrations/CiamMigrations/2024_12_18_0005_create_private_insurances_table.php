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
        Schema::create('private_insurances', function (Blueprint $table) {

            $table->string('id', 12)->primary(); // Identificador de los seguros privados, como hay muchas posibilidades es de 12
            $table->string('private_insurances_name'); // String porque pueden ser una variedad de nombres
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('private_insurances');
    }
};
