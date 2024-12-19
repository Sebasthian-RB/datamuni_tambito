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
        Schema::create('committee_vl_family_members', function (Blueprint $table) {
            $table->id();                                   // Clave primaria
            $table->string('committee_id');     // Clave foránea hacia 'committees'
            $table->string('vl_family_member_id');          // Clave foránea hacia 'vaso_leche_family_members'
            $table->date('change_date');                    // Fecha de cambio
            $table->string('description')->nullable(); // Descripción, puede ser nula
            $table->boolean('status')->default(1);          // Estado, por defecto activo (1)
            $table->timestamps();                           // Timestamps (created_at, updated_at)
            
            // Relaciones de claves foráneas
            $table->foreign('committee_id')
                  ->references('id')
                  ->on('committees')
                  ->onDelete('cascade');
            $table->foreign('vl_family_member_id')
                  ->references('id')
                  ->on('vl_family_members')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('committee_vl_family_members');
    }
};
