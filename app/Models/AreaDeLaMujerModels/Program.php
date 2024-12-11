<?php

namespace App\Models\AreaDeLaMujerModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',         // Nombre del programa
        'description',  // Descripción del programa: texto grande
        'program_type', // Tipo de programa: varchar
        'start_date',   // Fecha de inicio del programa
        'end_date',     // Fecha de finalización del programa (puede ser nula)
        'status',       // Estado del programa (enum: Pendiente, Finalizado, En proceso, Cancelado)
    ];

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'program_type' => 'string',
        'start_date' => 'date',
        'end_date' => 'date',
        'status' => 'string',
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
