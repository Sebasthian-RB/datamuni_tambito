<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AreaDeLaMujerModels\Violence;

class AreaDeLaMujerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $violences = [
            [
                'kind_violence' => 'Violencia Física',
                'description' => 'Uso de fuerza física para causar daño, lesiones o sufrimiento.',
            ],
            [
                'kind_violence' => 'Violencia Psicológica',
                'description' => 'Causar daño emocional mediante insultos, humillaciones o manipulación.',
            ],
            [
                'kind_violence' => 'Violencia Sexual',
                'description' => 'Cualquier acción que atente contra la libertad sexual de una persona.',
            ],
            [
                'kind_violence' => 'Violencia Económica',
                'description' => 'Control, limitación o eliminación de recursos financieros y materiales.',
            ],
        ];

        foreach ($violences as $violence) {
            Violence::create($violence);
        }
    }
}
