<?php

namespace App\Models\VasoDeLecheModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VlFamilyMember extends Model
{
    use HasFactory;

    /**
     * La clave primaria de la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Deshabilitar la autoincrementación de la clave primaria.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Atributos asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'id',                    // Número de documento de identidad como clave primaria
        'identity_document',     // Tipo de documento de identidad
        'given_name',            // Nombres
        'paternal_last_name',    // Apellido paterno
        'maternal_last_name',    // Apellido materno
    ];

    /**
     * Atributos que deben ser convertidos a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'identity_document' => 'string',
        'given_name' => 'string',
        'paternal_last_name' => 'string',
        'maternal_last_name' => 'string',
    ];

    /**
     * Relación M:M con el modelo 'Committee'.
     */
    public function committees()
    {
        return $this->belongsToMany(Committee::class, 'committee_vl_family_members', 'vl_family_member_id', 'committee_id');
    }

    /**
     * Relación con el modelo 'VlMinor' (tiene muchos menores de edad asociados).
     */
    public function vlMinors()
    {
        return $this->hasMany(VlMinor::class, 'vl_family_member_id');
    }

    /**
     * Activar el manejo automático de timestamps.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Mutador: Formatear y almacenar el nombre del miembro en mayúscula la primera letra de cada palabra.
     *
     * @param string $value
     */
    public function setGivenNameAttribute($value)
    {
        // Capitalizar la primera letra de cada palabra y eliminar espacios en exceso
        $this->attributes['given_name'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Accesor: Obtener el nombre del miembro con la primera letra de cada palabra en mayúscula.
     *
     * @return string
     */
    public function getGivenNameAttribute()
    {
        return ucwords($this->attributes['given_name']);
    }

    /**
     * Mutador: Formatear y almacenar el apellido paterno.
     *
     * @param string $value
     */
    public function setPaternalLastNameAttribute($value)
    {
        // Capitalizar la primera letra de cada palabra y eliminar espacios en exceso
        $this->attributes['paternal_last_name'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Accesor: Obtener el apellido paterno con la primera letra de cada palabra en mayúscula.
     *
     * @return string
     */
    public function getPaternalLastNameAttribute()
    {
        return ucwords($this->attributes['paternal_last_name']);
    }

    /**
     * Mutador: Formatear y almacenar el apellido materno.
     *
     * @param string $value
     */
    public function setMaternalLastNameAttribute($value)
    {
        // Capitalizar la primera letra de cada palabra y eliminar espacios en exceso
        $this->attributes['maternal_last_name'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Accesor: Obtener el apellido materno con la primera letra de cada palabra en mayúscula.
     *
     * @return string
     */
    public function getMaternalLastNameAttribute()
    {
        return ucwords($this->attributes['maternal_last_name']);
    }
}
