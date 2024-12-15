<?php

namespace App\Models\VasoDeLecheModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Atributos asignables masivamente.
     *
     * @var array
    */
    // Campos que son asignables masivamente
    protected $fillable = [
        'name',           // Nombre del producto
        'description',    // Descripción del producto (puede ser nula)
    ];

    /**
     * Atributos que deben ser convertidos a tipos nativos.
     *
     * @var array
     */
    // Definir los tipos de datos de las columnas para asegurarse de que Laravel maneje correctamente estos campos cuando interactúas con ellos.
    protected $casts = [
        'name' => 'string',           // El nombre se almacena como string
        'description' => 'string',    // La descripción se almacena como string (aunque puede ser nula)
        'created_at' => 'datetime',   // Convertir la fecha de creación a un objeto DateTime
        'updated_at' => 'datetime',   // Convertir la fecha de actualización a un objeto DateTime
    ];

    /**
     * Activar el manejo automático de timestamps.
     *
     * @var bool
     */    
    public $timestamps = true;
}
