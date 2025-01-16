<?php

namespace App\Models\OmapedModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OmDwelling extends Model
{
    use HasFactory;

    // Atributos asignables en masa
    protected $fillable = [
        'location',
        'reference',
        'water_electric_supply',
        'dwelling_type',
        'dwelling_status',
        'number_of_residents',
    ];

    // Casts para convertir tipos de datos automáticamente
    protected $casts = [
        'number_of_residents' => 'integer', // Número de residentes
    ];

    /**
     * Relación con las personas.
     * Una vivienda puede tener muchas personas registradas.
     */
    public function people()
    {
        return $this->hasMany(OmPerson::class, 'dwelling_id');
    }
}
