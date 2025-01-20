<?php

namespace App\Models\OmapedModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OmPerson extends Model
{
    use HasFactory;

    // Atributos asignables en masa
    protected $fillable = [
        'registration_date', 'paternal_last_name', 'maternal_last_name', 'given_name', 
        'marital_status', 'dni', 'birth_date', 'age', 'gender', 'phone', 'email', 
        'education_level', 'occupation', 'health_insurance', 'sisfoh', 'employment_status', 
        'pension_status', 'om_dwelling_id', 'disability_id', 'personal_assistance_need', 
        'autonomy_notes', 'caregiver_id', 'observations'
    ];

    /**
     * Casts de algunos atributos
     */
    protected $casts = [
        'registration_date' => 'date', // Convertir a tipo fecha
        'birth_date' => 'date', // Convertir a tipo fecha
        'age' => 'integer', // Convertir a entero
        'sisfoh' => 'boolean', // Convertir a booleano
    ];

    /**
     * Relación de muchos a uno con OmDwelling
     */
    public function dwelling()
    {
        return $this->belongsTo(OmDwelling::class, 'om_dwelling_id');
    }

    /**
     * Relación de uno a uno con Disability
     */
    public function disability()
    {
        return $this->hasOne(Disability::class, 'id', 'disability_id');
    }

    /**
     * Relación de muchos a uno con Caregiver
     */
    public function caregiver()
    {
        return $this->belongsTo(Caregiver::class, 'caregiver_id');
    }
}
