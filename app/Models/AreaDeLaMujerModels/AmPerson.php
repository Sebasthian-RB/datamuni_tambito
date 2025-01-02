<?php

namespace App\Models\AreaDeLaMujerModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AmPerson extends Model
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
        'id',                   // ID único escrito manualmente
        'identity_document',    // Documento de identidad
        'given_name',           // Nombre
        'paternal_last_name',   // Apellido paterno
        'maternal_last_name',   // Apellido materno
        'address',              // Dirección
        'sex_type',             // Tipo de sexo (0 o 1)
        'phone_number',         // Número de teléfono
        'attendance_date',      // Fecha y hora de asistencia
    ];

    /**
     * Casts: Conversión de datos a tipos nativos de PHP.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',                     // ID es un string
        'identity_document' => 'string',      // Documento de identidad como string
        'given_name' => 'string',             // Nombre como string
        'paternal_last_name' => 'string',     // Apellido paterno como string
        'maternal_last_name' => 'string',     // Apellido materno como string
        'address' => 'string',                // Dirección como string
        'sex_type' => 'boolean',              // Tipo de sexo como booleano (0: femenino, 1: masculino)
        'phone_number' => 'string',           // Número de teléfono como string
        'attendance_date' => 'datetime',      // Fecha y hora de asistencia como objeto Carbon
    ];

    /**
     * Relación con los eventos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function events()
    {
        return $this->belongsToMany(Event::class, 'am_person_events')->withPivot('status');
    }

    /**
     * Relación con las intervenciones.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function interventions()
    {
        return $this->belongsToMany(Intervention::class, 'am_person_interventions')->withPivot('status');
    }

    /**
     * Relación con los tipos de violencia.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function violences()
    {
        return $this->belongsToMany(Violence::class, 'am_person_violences')->withPivot('registration_date');
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
     * Accesor: Obtener el nombre completo.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->given_name} {$this->paternal_last_name} {$this->maternal_last_name}";
    }

    /**
     * Mutador: Formatear el número de teléfono.
     *
     * @param string $value
     */
    public function setPhoneNumberAttribute($value)
    {
        $this->attributes['phone_number'] = preg_replace('/\D/', '', $value); // Solo guardar números
    }

    /**
     * Validación simple: Asegurarse de que el número de teléfono tenga 9 dígitos.
     */
    public function isValidPhoneNumber()
    {
        return strlen($this->phone_number) === 9;
    }

    /**
     * Accesor: Obtener el sexo como texto.
     *
     * @return string
     */
    public function getSexTypeAttribute($value)
    {
        return $value ? 'Masculino' : 'Femenino';
    }

    /**
     * Activar el manejo automático de timestamps.
     *
     * @var bool
     */
    public $timestamps = true;
}
