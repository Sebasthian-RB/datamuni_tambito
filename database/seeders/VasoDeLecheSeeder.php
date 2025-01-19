<?php

namespace Database\Seeders;

use App\Models\VasoDeLecheModels\Product;
use App\Models\VasoDeLecheModels\Sector;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class VasoDeLecheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usando Faker para generar datos aleatorios
        $faker = Faker::create();

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

        // COMITÉS (Se crean 20 registros para la tabla 'committees')
        for ($i = 0; $i < 20; $i++) {
            DB::table('committees')->insert([
                'id' => $faker->uuid, // Generar un UUID aleatorio para 'id'
                'name' => $faker->company, // Generar un nombre de comité como nombre de empresa
                'president_paternal_surname' => $faker->lastName, // Generar apellido paterno del presidente
                'president_maternal_surname' => $faker->lastName, // Generar apellido materno (puede ser nulo)
                'president_given_name' => $faker->firstName, // Generar nombre del presidente
                'urban_core' => $faker->word, // Generar un nombre de núcleo urbano
                'beneficiaries_count' => $faker->numberBetween(50, 5000), // Generar un número aleatorio de beneficiarios
                'sector_id' => $faker->numberBetween(1, 4), // Generar un ID de sector aleatorio (asumimos que hay sectores con ID entre 1 y 10)
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        

    }
}
