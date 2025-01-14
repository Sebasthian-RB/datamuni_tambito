<?php

namespace App\Models\SisfohModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enumerator extends Model
{
    use HasFactory;

    public $incrementing = false; // Desactivar auto-incremento
    protected $keyType = 'string'; // Especificar clave primaria como string

    protected $fillable = [
        'id',
        'identity_document',       // Tipo de documento (DNI, Pasaporte, etc.)
        'given_name',              // Nombre completo del encuestador
        'paternal_last_name',      // Apellido paterno del encuestador
        'maternal_last_name',      // Apellido materno del encuestador
        'phone_number',            // Número de teléfono del encuestador
    ];

    protected $casts = [
        'id' => 'string',               // ID como entero
        'identity_document' => 'string',      // Tipo de documento como string
        'given_name' => 'string',             // Nombre completo como string
        'paternal_last_name' => 'string',     // Apellido paterno como string
        'maternal_last_name' => 'string',     // Apellido materno como string
        'phone_number' => 'string',           // Número de teléfono como string
        'created_at' => 'datetime',           // Fecha de creación como objeto Carbon
        'updated_at' => 'datetime',           // Fecha de actualización como objeto Carbon
    ];

    /**
     * Relación uno a muchos: Un enumerador puede tener muchas visitas.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function visits()
    {
        return $this->hasMany(Visit::class);
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
     * Mutador: Formatear el número de teléfono.
     *
     * @param string $value
     */
    public function setPhoneNumberAttribute($value)
    {
        $this->attributes['phone_number'] = preg_replace('/\D/', '', $value); // Solo guardar números
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
     * Validación simple: Asegurarse de que el número de teléfono tenga 9 dígitos.
     */
    /*public function isValidPhoneNumber()
    {
        return strlen($this->phone_number) === 9;
    } */

    public function isValidPhoneNumber(): bool
    {
        return $this->phone_number && preg_match('/^\d{9}$/', $this->phone_number);
    }

    /**
     * Activar el manejo automático de timestamps.
     *
     * @var bool
     */
    public $timestamps = true;

}
