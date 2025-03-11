<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class SisfohSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            $identityDocument = $faker->randomElement(['DNI', 'Pasaporte', 'Carnet', 'Cedula']);
            
            // Generar ID según el tipo de documento
            switch ($identityDocument) {
                case 'DNI':
                    $id = $faker->numerify('########'); // 8 dígitos
                    break;
                case 'Pasaporte':
                    $id = $faker->bothify('#########'); // 9 caracteres (alfanumérico)
                    break;
                case 'Carnet':
                    $id = $faker->bothify('#########'); // 9 caracteres (alfanumérico)
                    break;
                case 'Cedula':
                    $id = $faker->numerify('############'); // 12 dígitos
                    break;
            }
            
            DB::table('sfh_people')->insert([
                'id' => $id,
                'identity_document' => $identityDocument,
                'given_name' => $faker->firstName,
                'paternal_last_name' => $faker->lastName,
                'maternal_last_name' => $faker->lastName,
                'marital_status' => $faker->randomElement(['Soltero(a)', 'Casado(a)', 'Divorciado(a)', 'Viudo(a)']),
                'birth_date' => $faker->date(),
                'sex_type' => $faker->boolean,
                'phone_number' => $faker->numerify('9########'),
                'nationality' => $faker->country,
                'degree' => $faker->randomElement([
                    'INICIAL', 'NINGUNO_NIVEL_LETRADO', 'PRIMARIA COMPLETA', 'PRIMARIA INCOMPLETA',
                    'SECUNDARIA COMPLETA', 'SECUNDARIA INCOMPLETA', 'SUPERIOR COMPLETA', 'SUPERIOR INCOMPLETA',
                    'ILETRADO/SIN INSTRUCCION', 'TECNICA COMPLETA', 'TECNICA INCOMPLETA', 'EDUCACION ESPECIAL'
                ]),
                'occupation' => $faker->jobTitle,
                'sfh_category' => $faker->randomElement(['No pobre', 'Pobre', 'Pobre extremo']),
                'sfh_consultation' => $faker->randomElement(['Atendido', 'Empadronado', 'No empadronado']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
