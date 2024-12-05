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

    public function amPersons()
    {
        return $this->hasMany(AmPersonIntervention::class);
    }
}
