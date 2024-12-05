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
        Schema::create('am_people', function (Blueprint $table) {
            $table->id();
            $table->string('identity_document');
            $table->string('given_name');
            $table->string('paternal_last_name');
            $table->string('maternal_last_name');
            $table->string('address');
            $table->string('sex_type');
            $table->string('phone_number');
            $table->date('attendance_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('am_people');
    }
};
