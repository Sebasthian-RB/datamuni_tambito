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
            $table->id();
            $table->string('kind_violence');
            $table->text('description');
            $table->string('place');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('status');
            $table->foreignId('program_id')->constrained();
            $table->timestamps();
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
