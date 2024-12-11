<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AmPerson extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';   // Define que la clave primaria es 'id'
    public $incrementing = false;   // Deshabilita el autoincremento para el ID
    protected $keyType = 'string';  // El ID será un string

    protected $fillable = [
        'id',                   // ID único escrito manualmente
        'identity_document',    // Documento de identidad
        'given_name',           // Nombre
        'paternal_last_name',   // Apellido paterno
        'maternal_last_name',   // Apellido materno
        'address',              // Dirección
        'sex_type',             // Tipo de sexo (0 o 1)
        'phone_number',         // Número de teléfono
        'attendance_date',      // Fecha y hora de asistencia
    ];

    protected $casts = [
        'id' => 'string',                     // ID es un string
        'identity_document' => 'string',      // Documento de identidad como string
        'given_name' => 'string',             // Nombre como string
        'paternal_last_name' => 'string',     // Apellido paterno como string
        'maternal_last_name' => 'string',     // Apellido materno como string
        'address' => 'string',                // Dirección como string
        'sex_type' => 'boolean',              // Tipo de sexo como booleano (0: femenino, 1: masculino)
        'phone_number' => 'string',           // Número de teléfono como string
        'attendance_date' => 'datetime',      // Fecha y hora de asistencia como objeto Carbon
        'created_at' => 'datetime',           // Fecha de creación como objeto Carbon
        'updated_at' => 'datetime',           // Fecha de actualización como objeto Carbon
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'am_person_events')->withPivot('status');
    }

    public function interventions()
    {
        return $this->belongsToMany(Intervention::class, 'am_person_interventions')->withPivot('status');
    }

    public function violences()
    {
        return $this->belongsToMany(Violence::class, 'am_person_violences')->withPivot('registration_date');
    }
}
