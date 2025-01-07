<?php

namespace App\Models\CiamModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guardian extends Model
{
    use HasFactory;

    /**
     * Definición de la clave primaria.
     *
     * @var string
     */
    protected $primaryKey = 'id';   // Define que la clave primaria es 'id'
    public $incrementing = false;   // Deshabilita el autoincremento para el ID
    protected $keyType = 'string';  // El ID será un string

    /**
     * Campos asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'id',                  // ID único
        'document_type',       // Tipo de documento (DNI, Pasaporte, etc.)
        'given_name',          // Nombre
        'paternal_last_name',  // Apellido paterno
        'maternal_last_name',  // Apellido materno
        'phone_number',        // Número de teléfono
    ];

    /**
     * Casts: Conversión de datos a tipos nativos de PHP.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'document_type' => 'string',
        'given_name' => 'string',
        'paternal_last_name' => 'string',
        'maternal_last_name' => 'string',
        'phone_number' => 'string',
    ];

    /**
     * Accesor: Obtener el nombre completo.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->given_name} {$this->paternal_last_name} {$this->maternal_last_name}";
    }

    /**
     * Mutador: Formatear y almacenar el nombre.
     *
     * @param string $value
     */
    public function setGivenNameAttribute($value)
    {
        $this->attributes['given_name'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Mutador: Formatear y almacenar el apellido paterno.
     *
     * @param string $value
     */
    public function setPaternalLastNameAttribute($value)
    {
        $this->attributes['paternal_last_name'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Mutador: Formatear y almacenar el apellido materno.
     *
     * @param string $value
     */
    public function setMaternalLastNameAttribute($value)
    {
        $this->attributes['maternal_last_name'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Relación con ElderlyAdult.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function elderlyAdults()
    {
        return $this->hasMany(ElderlyAdult::class);
    }
}
