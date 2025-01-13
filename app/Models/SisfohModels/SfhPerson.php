<?php

namespace App\Models\SisfohModels;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SfhPerson extends Model
{
    use HasFactory;

    /**
     * Campos asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'id',               // Identificador único (ID)
        'identity_document', // Tipo de documento de identidad
        'given_name',        // Primer nombre
        'paternal_last_name', // Apellido paterno
        'maternal_last_name', // Apellido materno
        'marital_status',    // Estado civil
        'birth_date',        // Fecha de nacimiento
        'sex_type',          // Tipo de sexo (0 para femenino, 1 para masculino)
        'phone_number',      // Número de teléfono
        'nationality',       // Nacionalidad
        'degree',            // Nivel de grado académico
        'occupation',        // Ocupación
        'sfh_category',      // Categoría sisfoh
    ];

    /**
     * Casting de atributos.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',              // ID como string
        'identity_document' => 'string', // Tipo de documento de identidad como string
        'given_name' => 'string',       // Primer nombre como string
        'paternal_last_name' => 'string', // Apellido paterno como string
        'maternal_last_name' => 'string', // Apellido materno como string
        'marital_status' => 'string',    // Estado civil como string
        'birth_date' => 'date',         // Fecha de nacimiento como objeto Carbon
        'sex_type' => 'boolean',        // Tipo de sexo como booleano
        'phone_number' => 'string',     // Teléfono como string
        'nationality' => 'string',      // Nacionalidad como string
        'degree' => 'string',           // Grado académico como string
        'occupation' => 'string',       // Ocupación como string
        'sfh_category' => 'string',     // Categoría sisfoh como string
        'created_at' => 'datetime',     // Fecha de creación como objeto Carbon
        'updated_at' => 'datetime',     // Fecha de actualización como objeto Carbon
    ];

    /**
     * Relación con la entidad DwellingPerson (Muchos a Muchos).
     * Una persona puede estar asociada a muchas viviendas.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function dwellings()
    {
        return $this->belongsToMany(SfhDwelling::class, 'sfh_dwellings_sfh_person')
                    ->withPivot('status', 'update_date')
                    ->withTimestamps();
    }

    /**
     * Relación con la entidad Request (Uno a Muchos).
     * Una persona puede tener muchas solicitudes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requests()
    {
        return $this->hasMany(SfhRequest::class, 'sfh_person_id');
    }

    /**
     * Activar el manejo automático de timestamps.
     *
     * @var bool
     */
    public $timestamps = true;
}
