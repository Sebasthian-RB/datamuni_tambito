<?php

namespace App\Models\OmapedModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caregiver extends Model
{
    use HasFactory;

    // Atributos asignables en masa
    protected $fillable = [
        'full_name',
        'relationship',
        'dni',
        'phone',
    ];

    // Relación con OmPerson (1 cuidador, muchas personas)
    public function people()
    {
        return $this->hasMany(OmPerson::class, 'caregiver_id');
    }
    
}
