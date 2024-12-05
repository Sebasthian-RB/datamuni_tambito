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
        Schema::create('vl_family_member_products', function (Blueprint $table) {
            $table->id();                               // Id autogenerado
            $table->string('vl_family_member_id');      // Clave foránea hacia 'vaso_leche_family_members'
            $table->unsignedBigInteger('product_id');   // Clave foránea hacia 'products'
            $table->unsignedInteger('quantity');        //Cantidad de producto recibido por familiar
            $table->timestamps();                       //Timestamps (created_at, updated_at)
            
            // Relaciones de claves foráneas            
            $table->foreign('vl_family_member_id')
                    ->references('id')
                    ->on('vl_family_members')
                    ->onDelete('cascade');
            $table->foreign('product_id')
                    ->references('id')
                    ->on('products')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vl_family_member_products');
    }
};
