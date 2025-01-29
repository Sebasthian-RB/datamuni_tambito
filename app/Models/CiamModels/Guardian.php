<?php

namespace App\Models\CiamModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;

    /**
     * Clave primaria y configuración del modelo.
     */
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Campos asignables masivamente.
     */
    protected $fillable = [
        'id',
        'document_type',
        'given_name',
        'paternal_last_name',
        'maternal_last_name',
        'phone_number',
    ];

    /**
     * Casts para conversión de datos.
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
     * Relación muchos a muchos con Elderly Adults (a través de la tabla pivote).
     */
    public function elderlyAdults()
    {
        return $this->belongsToMany(
            ElderlyAdult::class,
            'elderly_adults_guardians', // Nombre de la tabla pivote
            'guardian_id',              // Clave foránea hacia Guardian
            'elderly_adult_id'          // Clave foránea hacia ElderlyAdult
        );
    }

    /**
     * Accesor para obtener el nombre completo del guardián.
     */
    public function getFullNameAttribute()
    {
        return "{$this->given_name} {$this->paternal_last_name} {$this->maternal_last_name}";
    }

    /**
     * Mutadores para normalizar datos antes de guardarlos.
     */
    public function setGivenNameAttribute($value)
    {
        $this->attributes['given_name'] = ucwords(strtolower(trim($value)));
    }

    public function setPaternalLastNameAttribute($value)
    {
        $this->attributes['paternal_last_name'] = ucwords(strtolower(trim($value)));
    }

    public function setMaternalLastNameAttribute($value)
    {
        $this->attributes['maternal_last_name'] = ucwords(strtolower(trim($value)));
    }

    public function setDocumentTypeAttribute($value)
    {
        $this->attributes['document_type'] = strtoupper(trim($value));
    }

    /**
     * Scopes para consultas comunes.
     */
    public function scopeWithPhone($query)
    {
        return $query->whereNotNull('phone_number');
    }

    public function scopeByDocumentType($query, $documentType)
    {
        return $query->where('document_type', $documentType);
    }
}
