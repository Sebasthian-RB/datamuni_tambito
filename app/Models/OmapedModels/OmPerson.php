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
        'marital_status',
        'dni',
        'birth_date',
        'age',
        'gender',
        'phone',
        'email',
        'education_level',
        'occupation',
        'health_insurance',
        'sisfoh',
        'employment_status',
        'pension_status',
        'om_dwelling_id',
        'disability_id',
        'caregiver_id',
        'personal_assistance_need',
        'autonomy_notes',
        'observations',
    ];

    /**
     * Casts de algunos atributos
     */
    protected $casts = [
        'registration_date' => 'datetime', // Asegura formato de fecha
        'birth_date' => 'date', // Trata correctamente las fechas
        'age' => 'integer', // Edad como entero
        'sisfoh' => 'boolean', // Representa como verdadero/falso
        'om_dwelling_id' => 'integer',
        'disability_id' => 'integer',
        'caregiver_id' => 'integer',
    ];

    // 🚀 Mutadores (setters) para guardar nombres con formato correcto
    public function setPaternalLastNameAttribute($value)
    {
        $this->attributes['paternal_last_name'] = ucfirst(strtolower($value));
    }

    public function setMaternalLastNameAttribute($value)
    {
        $this->attributes['maternal_last_name'] = ucfirst(strtolower($value));
    }

    public function setGivenNameAttribute($value)
    {
        $this->attributes['given_name'] = ucfirst(strtolower($value));
    }

    // 🔥 Accesores (getters) para mostrar nombres con formato correcto
    public function getPaternalLastNameAttribute($value)
    {
        return ucfirst(strtolower($value));
    }

    public function getMaternalLastNameAttribute($value)
    {
        return ucfirst(strtolower($value));
    }

    public function getGivenNameAttribute($value)
    {
        return ucfirst(strtolower($value));
    }
    
     // Relación con OmDwelling (Muchas personas en una vivienda)
     public function dwelling()
     {
         return $this->belongsTo(OmDwelling::class, 'om_dwelling_id');
     }
 
     // Relación con Disability (1 a 1)
     public function disability()
     {
         return $this->belongsTo(Disability::class, 'disability_id');
     }
 
     // Relación con Caregiver (1 cuidador, muchas personas)
     public function caregiver()
     {
         return $this->belongsTo(Caregiver::class, 'caregiver_id');
     }
}
