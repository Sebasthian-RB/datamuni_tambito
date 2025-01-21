<?php

namespace App\Models\OmapedModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OmDwelling extends Model
{
    use HasFactory;

    // Atributos asignables en masa
    protected $fillable = [
        'exact_location',
        'reference',
        'annex_sector',
        'water_electricity',
        'type',
        'ownership_status',
        'permanent_occupants',
    ];

    // Casts para convertir tipos de datos automáticamente
    protected $casts = [
        'permanent_occupants' => 'integer', // Número de ocupantes como entero
        'water_electricity' => 'string', // Enum tratado como string
    ];

    // Relación con OmPerson (1 vivienda, muchas personas)
    public function people()
    {
        return $this->hasMany(OmPerson::class, 'om_dwelling_id');
    }
}
