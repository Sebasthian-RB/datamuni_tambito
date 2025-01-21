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
            $table->date('certificate_issue_date');
            $table->date('certificate_expiry_date')->nullable();
            $table->string('organization_name', 255);
            $table->string('diagnosis', 255);
            $table->string('disability_type', 100);
            $table->enum('severity_level', ['Leve', 'Moderado', 'Severo']);
            $table->text('required_support_devices')->nullable();
            $table->text('used_support_devices')->nullable();
            $table->timestamps();
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
