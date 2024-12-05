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
        Schema::create('violences', function (Blueprint $table) {
            $table->id();                       // ID único
            $table->string('kind_violence');    // Tipo de violencia: varchar
            $table->text('description');        // Descripción: texto grande
            $table->timestamps();               // Timestamps para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('violences');
    }
};
