<?php

namespace App\Models\CiamModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ElderlyAdult extends Model
{
    use HasFactory;

    /**
     * Definición de la clave primaria.
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
        'birth_date',
        'address',
        'reference',
        'sex_type',
        'phone_number',
        'type_of_disability',
        'household_members',
        'permanent_attention',
        'observation',
        'location_id',
        'public_insurance_id'
    ];

    /**
     * Casts: Conversión de datos a tipos nativos de PHP.
     */
    protected $casts = [
        'id' => 'string',
        'document_type' => 'string',
        'given_name' => 'string',
        'paternal_last_name' => 'string',
        'maternal_last_name' => 'string',
        'birth_date' => 'date',
        'address' => 'string',
        'reference' => 'string',
        'sex_type' => 'boolean',
        'phone_number' => 'string',
        'type_of_disability' => 'string',
        'household_members' => 'integer',
        'permanent_attention' => 'boolean',
        'observation' => 'string',
        'location_id' => 'integer',
        'public_insurance_id' => 'integer'
    ];

    /**
     * Relaciones de muchos a muchos con otras entidades.
     */
    public function socialPrograms()
    {
        return $this->belongsToMany(SocialProgram::class, 'elderly_adult_social_programs')
            ->withTimestamps();
    }

    public function guardians()
    {
        return $this->belongsToMany(Guardian::class, 'elderly_adult_guardians')
            ->withTimestamps();
    }

    public function privateInsurances()
    {
        return $this->belongsToMany(PrivateInsurance::class, 'elderly_adult_private_insurances')
            ->withTimestamps();
    }

    /**
     * Relaciones de muchos a uno con otras entidades.
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function publicInsurance()
    {
        return $this->belongsTo(PublicInsurance::class);
    }

    /**
     * Accesor: Obtener el nombre completo del adulto mayor.
     */
    public function getFullNameAttribute()
    {
        return "{$this->given_name} {$this->paternal_last_name} {$this->maternal_last_name}";
    }

    /**
     * Accesor: Obtener el sexo como texto.
     */
    public function getSexTypeTextAttribute()
    {
        return $this->sex_type ? 'Masculino' : 'Femenino';
    }

    /**
     * Mutadores para formatear los nombres correctamente.
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

    /**
     * Scope: Filtrar por tipo de documento.
     */
    public function scopeByDocumentType($query, $documentType)
    {
        return $query->where('document_type', $documentType);
    }

    /**
     * Scope: Filtrar por sexo.
     */
    public function scopeBySex($query, $sex)
    {
        return $query->where('sex_type', $sex);
    }

    /**
     * Scope: Filtrar por ubicación.
     */
    public function scopeByLocation($query, $locationId)
    {
        return $query->where('location_id', $locationId);
    }
}
