<?php

namespace App\Models\CiamModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SocialProgram extends Model
{
    use HasFactory;

    // Campos asignables masivamente
    protected $fillable = [
        'social_programs_name', // Nombre del programa social
    ];

    // Cast de los atributos a tipos nativos de PHP
    protected $casts = [
        'social_programs_name' => 'string', // El nombre del programa es un string
    ];

    /**
     * Relación de muchos a muchos con ElderlyAdult a través de la tabla pivote elderly_adult_social_programs
     */
    public function elderlyAdults()
    {
        return $this->belongsToMany(ElderlyAdult::class, 'elderly_adult_social_programs', 'social_programs_id', 'elderly_adults_id');
    }
}
