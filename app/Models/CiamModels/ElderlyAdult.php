<?php

namespace App\Models\CiamModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElderlyAdult extends Model
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
        'birth_date',
        'address',
        'reference',
        'sex_type',
        'language',
        'phone_number',
        'type_of_disability',
        'household_members',
        'permanent_attention',
        'observation',
        'guardian_id', // Relación con Guardian
        'public_insurance', // Seguro público
        'private_insurance', // Seguro privado
        'social_program', // Programa social
        'state', // Estado en el CIAM (Activo/Inactivo)
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
        'language' => 'array',
        'phone_number' => 'string',
        'type_of_disability' => 'array',
        'household_members' => 'integer',
        'permanent_attention' => 'boolean',
        'observation' => 'string',
        'guardian_id' => 'string',
        'public_insurance' => 'string',
        'private_insurance' => 'string',
        'social_program' => 'array', // Convertir automáticamente a array
        'state' => 'boolean', // Convertir automáticamente a booleano
    ];

    /**
     * Relación con Guardian.
     * Un adulto mayor puede tener un guardián, pero no es obligatorio.
     */
    public function guardian()
    {
        return $this->belongsTo(Guardian::class, 'guardian_id');
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
     * Accesor: Obtener el estado como etiqueta HTML.
     */
    public function getStateLabelAttribute()
    {
        return $this->state === 'Activo'
            ? '<span class="badge badge-success">Activo</span>'
            : '<span class="badge badge-danger">Inactivo</span>';
    }

    /**
     * Mutadores: Formatear nombres correctamente.
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
     * Scope: Filtrar por estado (activo o inactivo).
     */
    public function scopeByState($query, $state)
    {
        return $query->where('state', $state);
    }
}
