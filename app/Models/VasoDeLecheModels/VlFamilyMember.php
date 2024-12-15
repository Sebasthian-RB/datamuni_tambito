<?php

namespace App\Models\VasoDeLecheModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VlFamilyMember extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */

    // Definir la clave primaria de la tabla
    protected $primaryKey = 'id';

    // Deshabilitar la autoincrementación, ya que estamos usando una cadena como clave primaria
    public $incrementing = false;

    // Campos que son asignables masivamente
    protected $fillable = [
        'id', // Número de documento de identidad como clave primaria
        'identity_document', // Tipo documento de identidad
        'given_name', // Nombres
        'paternal_last_name', //Apellido Paterno
        'maternal_last_name' //Apellido Materno
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    // Definir los tipos de datos de las columnas para asegurarse de que Laravel maneje correctamente estos campos cuando interactúas con ellos.
    protected $casts = [
        'id' => 'string',
        'identity_document' => 'string',
        'given_name' => 'string',
        'paternal_last_name' => 'string',
        'maternal_last_name' => 'string',
    ];

    // Actualizar automáticamente con las fechas correspondientes cada vez que se cree o actualice el registro 
    public $timestamps = true;
}