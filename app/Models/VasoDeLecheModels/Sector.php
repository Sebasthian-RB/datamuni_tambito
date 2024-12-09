<?php

namespace App\Models\VasoDeLecheModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */

    // Campos que son asignables masivamente
    protected $fillable = [
        'name', // Nombre del sector
        'description', // Descripción del lugar
        'responsible_person', // Persona responsable del sector
    ];

    // Actualizar automáticamente con las fechas correspondientes cada vez que se cree o actualice el registro 
    public $timestamps = true;
}
