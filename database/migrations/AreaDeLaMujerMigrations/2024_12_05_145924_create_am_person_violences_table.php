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
            $table->id();
            $table->string('am_person_id', 36); // Relación con am_people
            $table->foreign('am_person_id')->references('id')->on('am_people')->cascadeOnDelete(); // Relación con am_people
            $table->foreignId('violence_id')->constrained('violences')->cascadeOnDelete(); // Relación con violences
            $table->dateTime('registration_date'); // Fecha de registro
            $table->timestamps();
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
