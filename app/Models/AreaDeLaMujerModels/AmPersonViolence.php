<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AmPersonViolence extends Model
{
    use HasFactory;

    protected $fillable = [
        'am_person_id',         // ID de la persona (foráneo de am_persons)
        'violence_id',          // ID de la violencia (foráneo de violences)
        'registration_date',    // Fecha de registro de la violencia
    ];

    public function amPerson()
    {
        return $this->belongsTo(AmPerson::class);
    }

    public function violence()
    {
        return $this->belongsTo(Violence::class);
    }
}
