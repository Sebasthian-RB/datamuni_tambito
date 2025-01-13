<?php

namespace App\Models\CiamModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ElderlyAdult extends Model
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
        'id',                    // ID único escrito manualmente
        'document_type',         // Tipo de documento (DNI, Pasaporte, etc.)
        'given_name',            // Nombre
        'paternal_last_name',    // Apellido paterno
        'maternal_last_name',    // Apellido materno
        'birth_date',            // Fecha de nacimiento
        'address',               // Dirección
        'reference',             // Referencia de ubicación
        'sex_type',              // Sexo (0: femenino, 1: masculino)
        'phone_number',          // Número de teléfono
        'type_of_disability',    // Tipo de discapacidad
        'household_members',     // Número de integrantes del hogar
        'permanent_attention',   // Requiere atención permanente
        'observation',           // Observaciones adicionales
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
        'birth_date' => 'date',
        'address' => 'string',
        'reference' => 'string',
        'sex_type' => 'boolean',
        'phone_number' => 'string',
        'type_of_disability' => 'string',
        'household_members' => 'integer',
        'permanent_attention' => 'boolean',
        'observation' => 'string',
    ];

    /**
     * Relación de muchos a muchos con SocialProgram.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function socialPrograms()
    {
        return $this->belongsToMany(SocialProgram::class, 'elderly_adult_social_programs', 'elderly_adults_id', 'social_programs_id');
    }

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
     * Accesor: Obtener el sexo como texto.
     *
     * @return string
     */
    public function getSexTypeTextAttribute()
    {
        return $this->sex_type ? 'Masculino' : 'Femenino';
    }
}
