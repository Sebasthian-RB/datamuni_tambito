<?php

namespace App\Models\OmapedModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caregiver extends Model
{
    use HasFactory;

    // Atributos asignables en masa
    protected $fillable = [
        'full_name', 'relationship', 'dni', 'phone'
    ];

    /**
     * Relación con las personas.
     * Un cuidador puede estar asignado a varias personas.
     */
    public function people()
    {
        return $this->hasMany(OmPerson::class, 'caregiver_id');
    }
}
