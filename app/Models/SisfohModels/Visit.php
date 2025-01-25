<?php

namespace App\Models\SisfohModels;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    /**
     * Campos asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'visit_date',
        'status',
        'observations',
        'enumerator_id',
        'sfh_requests_id',
    ];

    /**
     * Casting de atributos.
     *
     * @var array
     */
    protected $casts = [
        
        'visit_date' => 'date',        // Convierte la fecha a un objeto Carbon
        'status' => 'string',          // Convierte el estado de la visita a string (enum)
        'observations' => 'string',    // Convierte las observaciones a string
        'enumerator_id' => 'string',   // Asegura que enumerator_id sea tratado como string (UUID)
        'sfh_requests_id' => 'integer',     // Convierte el request_id a entero
    ];

    /**
     * Relación con la entidad Request (Uno a Muchos).
     * Una visita pertenece a una solicitud.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function request()
    {
        return $this->belongsTo(SfhRequest::class, 'sfh_requests_id'); // Si la clave foránea no es 'request_id', cámbiala
    }

    /**
     * Relación con la entidad Enumerator (Uno a Muchos).
     * Una visita pertenece a un enumerador.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function enumerator()
    {
        return $this->belongsTo(Enumerator::class, 'enumerator_id');
    }

    /**
     * Relación Muchos a Muchos con la entidad Instrument.
     * Una visita puede estar asociada a muchos instrumentos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function instruments()
    {
        return $this->belongsToMany(Instrument::class, 'instrument_visit', 'visit_id', 'instrument_id');
    }

    public function getFormattedVisitDateAttribute()
    {
        return \Carbon\Carbon::parse($this->visit_date)->format('Y-m-d');
    }
}
