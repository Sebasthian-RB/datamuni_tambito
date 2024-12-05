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
        Schema::create('am_person_violences', function (Blueprint $table) {
            $table->id();                                                   // ID único
            $table->foreignId('am_person_id')->constrained('am_people');   // ID de la persona (foráneo de am_persons)
            $table->foreignId('violence_id')->constrained('violences');     // ID de la violencia (foráneo de violences)
            $table->date('registration_date');                              // Fecha de registro de la violencia
            $table->timestamps();                                           // Timestamps para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('am_person_violences');
    }
};
