<?php

namespace App\Models\OmapedModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caregiver extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'relationship',
        'dni',
        'phone',
    ];
    // Atributos asignables en masa
    protected $casts = [
        'dni' => 'string', // Asegura que el DNI siempre sea tratado como texto
        'phone' => 'string',
    ];

    // Relación con OmPerson (1 cuidador, muchas personas)
    public function people()
    {
        return $this->hasMany(OmPerson::class, 'caregiver_id');
    }
    
}
