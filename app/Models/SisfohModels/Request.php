<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Request extends Model
{
    use HasFactory;

    /**
     * Campos asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'request_date',    // Fecha de la solicitud
        'description',     // Descripción de la solicitud
        'sfh_person_id',   // ID de la persona relacionada (sfh_people)
    ];

    /**
     * Casting de atributos.
     *
     * @var array
     */
    protected $casts = [
        
        'request_date' => 'date',          // Fecha de la solicitud como objeto Carbon
        'description' => 'string',         // Descripción como string
        'sfh_person_id' => 'string',       // ID de la persona como string (36 caracteres)
        'created_at' => 'datetime',        // Fecha de creación como objeto Carbon
        'updated_at' => 'datetime',        // Fecha de actualización como objeto Carbon
    ];

    /**
     * Relación con el modelo SfhPerson (Uno a Muchos).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sfhPerson()
    {
        return $this->belongsTo(SfhPerson::class, 'sfh_person_id');
    }

    /**
     * Relación con el modelo Visit (Uno a Muchos).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Visit()
    {
        return $this->hasMany(Visit::class, 'request_id');
    }

    /**
     * Accesor: Formatear la fecha de solicitud.
     *
     * @return string
     */
    public function getFormattedRequestDateAttribute()
    {
        return $this->request_date->format('d-m-Y');
    }

    /**
     * Validación simple: Verificar si la descripción no está vacía.
     *
     * @return bool
     */
    public function hasDescription()
    {
        return !empty($this->description);
    }

    /**
     * Activar el manejo automático de timestamps.
     *
     * @var bool
     */
    public $timestamps = true;
}
