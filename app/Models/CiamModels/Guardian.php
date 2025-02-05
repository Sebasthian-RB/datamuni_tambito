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
        'relationship', // Agregado porque antes faltaba
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
        'relationship' => 'string',
    ];

    /**
     * Relación uno a muchos con ElderlyAdults.
     * Un guardián puede estar a cargo de varios adultos mayores.
     */
    public function elderlyAdults()
    {
        return $this->hasMany(ElderlyAdult::class, 'guardian_id');
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

    public function getDisplayRelationshipAttribute()
    {
        // Si la relación es "Otro", devuelve el valor específico ingresado; de lo contrario, devuelve la relación normal.
        return $this->relationship === 'Otro' && $this->custom_relationship
            ? $this->custom_relationship
            : $this->relationship;
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
