<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Intervention extends Model
{
   use HasFactory;
   
   protected $fillable = [
        'appointment',
        'derivation',
        'appointment_date',
    ];

    public function amPersons()
    {
        return $this->hasMany(AmPersonIntervention::class);
    }
}
