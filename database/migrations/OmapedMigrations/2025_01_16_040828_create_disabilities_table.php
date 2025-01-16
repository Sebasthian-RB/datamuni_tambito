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
        Schema::create('disabilities', function (Blueprint $table) {
            $table->id();
            $table->string('certificate_number', 100)->unique();
            $table->string('diagnosis', 255);
            $table->string('disability_type', 100);
            $table->enum('severity_level', ['Leve', 'Moderado', 'Severo']);
            $table->text('support_devices')->nullable();
            $table->enum('health_insurance', ['SIS', 'EsSalud', 'Seguro Privado', 'Ninguno']);
            $table->foreignId('om_person_id')->constrained('om_people')->cascadeOnDelete(); // Relación con personas
            $table->timestamps();;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disabilities');
    }
};
