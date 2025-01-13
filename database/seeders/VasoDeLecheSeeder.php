<?php

namespace Database\Seeders;

use App\Models\VasoDeLecheModels\Product;
use App\Models\VasoDeLecheModels\Sector;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VasoDeLecheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // PRODUCTO
        Product::create([
            'name' => 'Leche Evaporada Entera',
            'description' => null,
        ]);

        Product::create([
            'name' => 'Hojuelas Precocidas',
            'description' => 'Hojuelas precocidas de kiwicha, cañihua, avena y quinua, fortificada con vitaminas y minerales',
        ]);



        //SECTORES
        Sector::create([
            'name' => 'Sector I',
            'description' => 'Descripción del Sector I',
            'responsible_person' => 'Juan Pérez',
        ]);

        Sector::create([
            'name' => 'Sector II',
            'description' => 'Descripción del Sector II',
            'responsible_person' => 'María González',
        ]);

        Sector::create([
            'name' => 'Sector III',
            'description' => 'Descripción del Sector III',
            'responsible_person' => 'Carlos Rodríguez',
        ]);

        Sector::create([
            'name' => 'Sector IV',
            'description' => 'Descripción del Sector IV',
            'responsible_person' => 'Ana López',
        ]);
        

    }
}
