<?php

namespace App\Models\AreaDeLaMujerModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AmPersonEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'am_person_id', // ID de la persona (foráneo de am_persons)
        'event_id',     // ID del evento (foráneo de events)
        'status',   // Asistencia (status enum)
        'attendance_datetime', // Fecha y hora de asistencia
    ];

    protected $casts = [
        'am_person_id' => 'string',
        'event_id' => 'integer',
        'status' => 'string',
        'attendance_datetime' => 'datetime', // Cast a un objeto Carbon
    ];

    public function amPerson()
    {
        return $this->belongsTo(AmPerson::class, 'am_person_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
