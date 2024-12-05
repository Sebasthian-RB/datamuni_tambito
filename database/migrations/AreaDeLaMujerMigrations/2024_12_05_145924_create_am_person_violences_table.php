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
            $table->foreignId('am_person_id')->constrained('am_persons');
            $table->foreignId('violence_id')->constrained('violences');
            $table->date('registration_date');
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
