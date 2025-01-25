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
        'registration_date' => 'date', // Asegura formato de fecha
        'birth_date' => 'date', // Trata correctamente las fechas
        'age' => 'integer', // Edad como entero
        'sisfoh' => 'boolean', // Representa como verdadero/falso
        'om_dwelling_id' => 'integer',
        'disability_id' => 'integer',
        'caregiver_id' => 'integer',
    ];

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
