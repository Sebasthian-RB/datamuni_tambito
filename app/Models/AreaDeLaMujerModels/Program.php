<?php

namespace App\Models;

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

    public function violences()
    {
        return $this->hasMany(Violence::class);
    }
}
