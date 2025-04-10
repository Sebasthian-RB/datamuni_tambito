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
        Schema::create('sfh_requests', function (Blueprint $table) {
            $table->id();
            $table->date('request_date'); // Fecha de la solicitud
            $table->text('description')->nullable(); // Descripción de la solicitud
            $table->string('sfh_person_id'); // Relación con sfh_people
            //$table->unsignedBigInteger('sfh_person_id');

            // Relacion de las tablas foraneas
            $table->foreign('sfh_person_id')->references('id')->on('sfh_people')->cascadeOnDelete(); // Relación con sfh_people
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sfh_requests');
    }
};
