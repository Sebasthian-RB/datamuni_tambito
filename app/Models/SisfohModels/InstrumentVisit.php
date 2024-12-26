<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstrumentVisit extends Model
{
    use HasFactory;

    /**
     * Campos asignables masivamente.
     *
     * @var string
     */

    protected $fillable = [
        'id',
        'application_date',
        'descriptions',
        'instrument_id',
        'visit_id',
    ];

    /**
     * Casting de atributos.
     *
     * @var array
     */
    protected $casts = [
        
        'application_date' => 'date',    // Fecha de aplicación como objeto Carbon
        'descriptions' => 'string',      // Descripciones como string
        'instrument_id' => 'integer',    // ID del instrumento como entero
        'visit_id' => 'integer',         // ID de la visita como entero
        'created_at' => 'datetime',      // Fecha de creación como objeto Carbon
        'updated_at' => 'datetime',      // Fecha de actualización como objeto Carbon
    ];

    /**
     * Relación con el modelo Instrument (Muchos a Uno).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function instrument()
    {
        return $this->belongsTo(Instrument::class, 'instrument_id');
    }

    /**
     * Relación con el modelo Visit (Muchos a Uno).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function visit()
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    /**
     * Mutador: Formatear y almacenar las descripciones.
     *
     * @param string $value
     */
    public function setDescriptionsAttribute($value)
    {
        $this->attributes['descriptions'] = ucfirst(strtolower(trim($value)));
    }

    /**
     * Accesor: Formatear la fecha de aplicación para mostrarla.
     *
     * @return string
     */
    public function getFormattedApplicationDateAttribute()
    {
        return $this->application_date->format('d-m-Y');
    }

    /**
     * Validación simple: Verificar que la fecha de aplicación no sea futura.
     *
     * @return bool
     */
    public function isValidApplicationDate()
    {
        return $this->application_date <= now();
    }

    /**
     * Activar el manejo automático de timestamps.
     *
     * @var bool
     */
    public $timestamps = true;
}
