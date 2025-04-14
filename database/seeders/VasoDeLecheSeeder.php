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
            'year' => 2025,
            'description' => null,
        ]);

        Product::create([
            'name' => 'Hojuelas Precocidas',
            'year' => 2025,
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
                'committee_number' => $faker->unique()->numberBetween(1, 1000), // Número entero único de 4 dígitos
                'name' => $faker->company, // Nombre de comité como nombre de empresa
                'president' => $faker->lastName . ' ' . $faker->firstName . ' ' . $faker->lastName, // Apellidos y nombres completos
                'urban_core' => $faker->randomElement(['Urbano', 'Rural']), // Selecciona aleatoriamente entre Urbano o Rural
                'sector_id' => $faker->numberBetween(1, 4), // ID de sector entre 1 y 4
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Crear 10 registros de ejemplo
        for ($i = 0; $i < 10; $i++) {
            $docType = $faker->randomElement(['DNI', 'Carnet de Extranjería', 'Pasaporte', 'Otro']);
            
            // Generar el ID fuera de la función
            $id = match ($docType) {
                'DNI' => $faker->unique()->numerify('########'), // 8 dígitos
                'Carnet de Extranjería' => $faker->unique()->numerify('#########'), // 9 dígitos
                'Pasaporte', 'Otro' => $faker->unique()->bothify('????????????????????'), // 20 caracteres alfanuméricos
            };

            DB::table('vl_family_members')->insert([
                'id' => $id, // Usar el ID generado fuera de la función
                'identity_document' => $docType,
                'given_name' => $faker->firstName,
                'paternal_last_name' => $faker->lastName,
                'maternal_last_name' => $faker->lastName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        
        // Obtener 10 IDs existentes de la tabla vl_family_members
        $familyMemberIds = DB::table('vl_family_members')->pluck('id')->toArray();

        // Crear 10 registros para la tabla vl_minors
        for ($i = 0; $i < 10; $i++) {
            $docType = $faker->randomElement(['DNI', 'CNV', 'Carnet de Extranjería', 'Pasaporte', 'Otro']);
            
            // Generar el ID fuera de la función
            $id = match ($docType) {
                'DNI' => $faker->unique()->numerify('########'), // 8 dígitos
                'CNV' => $faker->unique()->numerify('########'), // 8 dígitos
                'Carnet de Extranjería' => $faker->unique()->numerify('#########'), // 9 dígitos
                'Pasaporte', 'Otro' => $faker->unique()->bothify('????????????????????'), // 20 caracteres alfanuméricos
            };

            DB::table('vl_minors')->insert([
                'id' => $id, // Usar el ID generado fuera de la función
                'identity_document' => $docType,
                'given_name' => $faker->firstName,
                'paternal_last_name' => $faker->lastName,
                'maternal_last_name' => $faker->lastName,
                'birth_date' => $faker->date(),
                'sex_type' => $faker->boolean(),
                'registration_date' => $faker->date(),
                'withdrawal_date' => $faker->date(),
                'address' => $faker->address,
                'dwelling_type' => $faker->randomElement(['Propio', 'Alquilado', 'Cedido', 'Vivienda Social', 'Otros']),
                'education_level' => $faker->randomElement(['Ninguno', 'Inicial', 'Primaria', 'Secundaria', 'Técnico', 'Superior', 'Educación Especial']),
                'condition' => $faker->randomElement(['Menor de 1 año', 'Niño de 1 a 6 años', 'Niño de 7 a 13 años', 'Madre gestante', 'Madre lactante', 'Anciano', 'Discapacitado', 'Persona con TBC']),
                'disability' => $faker->boolean(),
                'has_sisfoh' => $faker->boolean(),
                'sisfoh_classification' => $faker->randomElement(['No Pobre', 'Pobre', 'Pobre Extremo']),
                'status' => $faker->boolean(),
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
