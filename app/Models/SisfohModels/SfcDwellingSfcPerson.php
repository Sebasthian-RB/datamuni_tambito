<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SfcDwellingSfcPerson extends Model
{
    use HasFactory;

    /**
     * Campos asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'id',                // Identificador único (ID)
        'sfh_person_id',     // ID de la persona relacionada (sfh_people)
        'status',            // Estado de la visita (Activo/Inactivo)
        'update_date',       // Fecha de actualización
        'sfh_dwelling_id',   // ID de la vivienda (sfh_dwellings)
    ];

    /**
     * Casting de atributos.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',                // ID como string
        'sfh_person_id' => 'string',     // ID de la persona como string
        'status' => 'string',            // Estado como string
        'update_date' => 'date',        // Fecha de actualización como objeto Carbon
        'sfh_dwelling_id' => 'string',   // ID de la vivienda como string
        'created_at' => 'datetime',      // Fecha de creación como objeto Carbon
        'updated_at' => 'datetime',      // Fecha de actualización como objeto Carbon
    ];

    /**
     * Relación con el modelo SfhPerson (Muchos a Uno).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sfhPerson()
    {
        return $this->belongsTo(SfhPerson::class, 'sfh_person_id');
    }

    /**
     * Relación con el modelo SfhDwelling (Muchos a Uno).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sfhDwelling()
    {
        return $this->belongsTo(SfhDwelling::class, 'sfh_dwelling_id');
    }

    /**
     * Accesor: Obtener el nombre completo de la persona.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->sfhPerson->given_name} {$this->sfhPerson->paternal_last_name} {$this->sfhPerson->maternal_last_name}";
    }

    /**
     * Accesor: Formatear la fecha de actualización.
     *
     * @return string
     */
    public function getFormattedUpdateDateAttribute()
    {
        return $this->update_date->format('d-m-Y');
    }

    /**
     * Validación simple: Verificar si la persona está activa.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->status === 'Activo';
    }

    /**
     * Activar el manejo automático de timestamps.
     *
     * @var bool
     */
    public $timestamps = true;
}
