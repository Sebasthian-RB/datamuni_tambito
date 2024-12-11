<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Intervention extends Model
{
   use HasFactory;

   protected $fillable = [
        'appointment',      // Cita: texto grande
        'derivation',       // Derivación: texto grande
        'appointment_date', // Fecha y hora de la cita (datetime)
    ];

    protected $casts = [
        'appointment' => 'string',         // Texto de la cita
        'derivation' => 'string',          // Texto de la derivación (si aplica)
        'appointment_date' => 'datetime',  // Fecha y hora como objeto datetime
        'created_at' => 'datetime',        // Fecha de creación
        'updated_at' => 'datetime',        // Fecha de actualización
    ];

    public function amPersons()
    {
        return $this->belongsToMany(AmPerson::class, 'am_person_interventions')->withPivot('status');
    }
}
