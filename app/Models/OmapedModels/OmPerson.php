<?php

namespace App\Models\OmapedModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OmPerson extends Model
{
    use HasFactory;

    // Atributos asignables en masa
    protected $fillable = [
       'registration_date',
        'paternal_last_name',
        'maternal_last_name',
        'given_name',
        'civil_status',
        'dni',
        'birth_date',
        'age',
        'gender',
        'phone',
        'education_level',
        'occupation',
        'email',
        'observation',
        'autonomy_record',
        'social_program',
        'dwelling_id',
        'disability_id',
        'caregiver_id', 
    ];

    // Casts para convertir tipos de datos automáticamente
    protected $casts = [
        'registration_date' => 'datetime', // Fecha y hora de registro
        'birth_date' => 'date', // Fecha de nacimiento
        'age' => 'integer', // Edad de la persona
        'dwelling_id' => 'integer', // Relación con vivienda
        'disability_id' => 'integer', // Relación con discapacidad
        'caregiver_id' => 'integer', // Relación con cuidador
    ];

    /**
     * Relación con la vivienda.
     * Una persona pertenece a una vivienda.
     */
    public function dwelling()
    {
        return $this->belongsTo(OmDwelling::class);
    }

    /**
     * Relación con la discapacidad.
     * Una persona tiene una sola discapacidad registrada.
     */
    public function disability()
    {
        return $this->hasOne(Disability::class);
    }

    /**
     * Relación con el cuidador.
     * Una persona tiene un único cuidador.
     */
    public function caregiver()
    {
        return $this->belongsTo(Caregiver::class);
    }
}
