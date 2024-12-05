<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AmPersonEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'am_person_id', // ID de la persona (foráneo de am_persons)
        'event_id',     // ID del evento (foráneo de events)
        'status',   // Asistencia (status enum)
    ];

    public function amPerson()
    {
        return $this->belongsTo(AmPerson::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
