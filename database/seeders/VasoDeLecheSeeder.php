<?php

namespace Database\Seeders;

use App\Models\VasoDeLecheModels\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VasoDeLecheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usando Eloquent (Modelo Product)
        Product::create([
            'name' => 'Leche Evaporada Entera',
            'description' => null,
        ]);

        Product::create([
            'name' => 'Hojuelas Precocidas',
            'description' => 'Hojuelas precocidas de kiwicha, cañihua, avena y quinua, fortificada con vitaminas y minerales',
        ]);

    }
}
