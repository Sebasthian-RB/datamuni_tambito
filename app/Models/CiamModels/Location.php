<?php

namespace App\Models\CiamModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;

    // Definir la clave primaria y su tipo
    protected $primaryKey = 'id';  // La clave primaria es 'id'
    public $incrementing = false;  // Desactivar el auto incremento, porque 'id' es un código
    protected $keyType = 'string'; // El ID será un string (no un entero)

    // Campos asignables masivamente
    protected $fillable = [
        'id',         // ID único de la ubicación (código ubigeo)
        'department', // Nombre del departamento
        'province',   // Nombre de la provincia
        'district',   // Nombre del distrito
    ];

    // Cast para convertir los atributos en tipos nativos de PHP
    protected $casts = [
        'id' => 'string',        // El id es un string
        'department' => 'string', // El departamento es un string
        'province' => 'string',   // La provincia es un string
        'district' => 'string',   // El distrito es un string
    ];

    // Mutadores: Puedes usar mutadores si quieres transformar datos antes de guardarlos
    public function setDepartmentAttribute($value)
    {
        // Puedes modificar el valor antes de guardarlo en la base de datos, por ejemplo, capitalizando el nombre
        $this->attributes['department'] = ucwords(strtolower($value));
    }

    public function setProvinceAttribute($value)
    {
        // Capitalizar el nombre de la provincia
        $this->attributes['province'] = ucwords(strtolower($value));
    }

    public function setDistrictAttribute($value)
    {
        // Capitalizar el nombre del distrito
        $this->attributes['district'] = ucwords(strtolower($value));
    }

    // Accesor: Obtener la ubicación completa como una cadena
    public function getFullLocationAttribute()
    {
        return "{$this->department}, {$this->province}, {$this->district}";
    }


    // Puedes agregar más mutadores si es necesario para otros campos
}

?>
