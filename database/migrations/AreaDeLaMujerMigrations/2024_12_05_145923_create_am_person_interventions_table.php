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
        Schema::create('am_person_interventions', function (Blueprint $table) {
            $table->id();                                                       // ID único
            $table->foreignId('am_person_id')->constrained('am_persons');       // ID de la persona (foráneo de am_persons)
            $table->foreignId('intervention_id')->constrained('interventions'); // ID de la intervención (foráneo de interventions)
            $table->string('status');                                           // Estado de la intervención (varchar)
            $table->timestamps();                                               // Timestamps para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('am_person_interventions');
    }
};
