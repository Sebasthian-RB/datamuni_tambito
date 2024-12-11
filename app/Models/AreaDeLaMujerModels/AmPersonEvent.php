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
    ];

    protected $casts = [
        'am_person_id' => 'string',
        'event_id' => 'integer',
        'status' => 'string',
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
