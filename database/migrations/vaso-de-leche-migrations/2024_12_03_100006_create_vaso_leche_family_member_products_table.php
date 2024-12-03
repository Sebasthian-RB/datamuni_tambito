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
        Schema::create('vaso_leche_family_member_products', function (Blueprint $table) {
            $table->id();
            $table->string('vaso_leche_family_member_id'); // Clave foránea hacia 'vaso_leche_family_members'
            $table->unsignedBigInteger('product_id'); // Clave foránea hacia 'products'
            $table->unsignedInteger('quantity'); //Cantidad de producto recibido por familiar
            $table->timestamps(); //Timestamps (created_at, updated_at)

            // Relaciones de claves foráneas            
            $table->foreign('vaso_leche_family_member_id', 'vl_family_member_id_fk')
                ->references('dni')
                ->on('vaso_leche_family_members')
                ->onDelete('cascade');

            $table->foreign('product_id', 'product_id_fk')
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
        Schema::dropIfExists('vaso_leche_family_member_products');
    }
};
