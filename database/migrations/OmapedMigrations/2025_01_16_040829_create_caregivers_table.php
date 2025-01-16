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
        Schema::create('caregivers', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 200); // Nombres y apellidos
            $table->string('relationship', 100); // Parentesco con la persona
            $table->string('dni', 8)->unique(); // DNI del cuidador
            $table->string('phone', 15)->nullable(); // Teléfono del cuidador
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caregivers');
    }
};
