<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',         // Nombre del evento
        'description',  // Descripción del evento
        'place',        // Lugar del evento
        'start_date',   // Fecha de inicio del evento
        'end_date',     // Fecha de finalización del evento
        'status',       // Estado del evento
        'program_id',   // ID del programa (foráneo)
    ];

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'place' => 'string',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'status' => 'string',
        'program_id' => 'integer',
    ];


    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function amPersons()
    {
        return $this->belongsToMany(AmPerson::class, 'am_person_events')->withPivot('status');
    }
}
