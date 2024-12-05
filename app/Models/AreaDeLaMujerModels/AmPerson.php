<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AmPerson extends Model
{
    use HasFactory;

    protected $fillable = [
        'identity_document',    // Documento de identidad (enum: DNI, PASAPORTE, CARNET, CEDULA)
        'given_name',           // Nombre
        'paternal_last_name',   // Apellido paterno
        'maternal_last_name',   // Apellido materno
        'address',              // Dirección
        'sex_type',             // Tipo de sexo (booleano: 0 para femenino, 1 para masculino)
        'phone_number',         // Número de teléfono
        'attendance_date',      // Fecha y hora de asistencia (datetime)
    ];

    public function events()
    {
        return $this->hasMany(AmPersonEvent::class);
    }

    public function interventions()
    {
        return $this->hasMany(AmPersonIntervention::class);
    }

    public function violences()
    {
        return $this->hasMany(AmPersonViolence::class);
    }
}
