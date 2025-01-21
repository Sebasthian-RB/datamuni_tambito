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

        // Crear 10 registros de ejemplo
        for ($i = 0; $i < 10; $i++) {
            DB::table('vl_family_members')->insert([
                'id' => $faker->unique()->numerify('#######'),  // Genera un número único como ID
                'identity_document' => $faker->randomElement(['DNI', 'Cédula', 'Pasaporte']),  // Tipo de documento
                'given_name' => $faker->firstName,  // Nombre
                'paternal_last_name' => $faker->lastName,  // Apellido paterno
                'maternal_last_name' => $faker->lastName,  // Apellido materno
                'created_at' => now(),  // Fecha de creación
                'updated_at' => now(),  // Fecha de actualización
            ]);
        }
        
        // Obtener 10 IDs existentes de la tabla vl_family_members
        $familyMemberIds = DB::table('vl_family_members')->pluck('id')->toArray();

        // Crear 10 registros para la tabla vl_minors
        for ($i = 0; $i < 10; $i++) {
            DB::table('vl_minors')->insert([
                'id' => $faker->unique()->numerify('#######'),  // Generar un ID único para el menor
                'identity_document' => $faker->randomElement(['DNI', 'Cédula', 'Pasaporte']),
                'given_name' => $faker->firstName,
                'paternal_last_name' => $faker->lastName,
                'maternal_last_name' => $faker->lastName,
                'birth_date' => $faker->date(),
                'sex_type' => $faker->boolean(),
                'registration_date' => $faker->date(),
                'withdrawal_date' => $faker->date(),
                'address' => $faker->address,
                'dwelling_type' => $faker->randomElement(['Propio', 'Alquilado']),
                'education_level' => $faker->randomElement(['Ninguno', 'Inicial', 'Primaria', 'Secundaria', 'Técnico', 'Superior']),
                'condition' => $faker->randomElement(['Gest.', 'Lact.', 'Anc.']),
                'disability' => $faker->boolean(),
                'vl_family_member_id' => $faker->randomElement($familyMemberIds),  // Asociar un ID de familiar existente
                'kinship' => $faker->randomElement(['Hijo(a)', 'Socio(a)']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Obtener 10 IDs existentes de la tabla committees y 10 IDs de la tabla vl_family_members
        $committeeIds = DB::table('committees')->pluck('id')->toArray();
        $familyMemberIds = DB::table('vl_family_members')->pluck('id')->toArray();

        // Crear 10 registros para la tabla committee_vl_family_members
        for ($i = 0; $i < 10; $i++) {
            DB::table('committee_vl_family_members')->insert([
                'committee_id' => $faker->randomElement($committeeIds), // Seleccionar un ID de committee existente
                'vl_family_member_id' => $faker->randomElement($familyMemberIds), // Seleccionar un ID de miembro de familia existente
                'change_date' => $faker->date(),
                'description' => $faker->sentence(), // Descripción aleatoria
                'status' => $faker->boolean(), // Estado aleatorio (activo o inactivo)
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
