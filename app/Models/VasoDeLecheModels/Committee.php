<?php

namespace App\Models\VasoDeLecheModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    use HasFactory;

    /**
     * La clave primaria de la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Deshabilitar la autoincrementación, ya que se usa una cadena como clave primaria.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Campos asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'id',                           // ID personalizado de comité 
        'name',                         // Nombre del comité
        'president_paternal_surname',   // Apellido paterno del presidente
        'president_maternal_surname',   // Apellido materno del presidente
        'president_given_name',         // Nombres del presidente
        'urban_core',                   // Núcleo urbano
        'beneficiaries_count',          // Número de beneficiarios
        'sector_id',                    // Clave foránea del sector
    ];

    /**
     * Casts: Conversión de datos a tipos nativos de PHP.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'president_paternal_surname' => 'string',
        'president_maternal_surname' => 'string',
        'president_given_name' => 'string',
        'urban_core' => 'string',
        'beneficiaries_count' => 'integer',
        'sector_id' => 'integer',
    ];

    /**
     * Relación con el modelo Sector.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    /**
     * Mutador para el apellido paterno del presidente.
     */
    public function setPresidentPaternalSurnameAttribute($value)
    {
        $this->attributes['president_paternal_surname'] = strtoupper(trim($value));
    }

    /**
     * Mutador para el apellido materno del presidente.
     */
    public function setPresidentMaternalSurnameAttribute($value)
    {
        $this->attributes['president_maternal_surname'] = strtoupper(trim($value));
    }

    /**
     * Mutador para el nombre del presidente.
     */
    public function setPresidentGivenNameAttribute($value)
    {
        $this->attributes['president_given_name'] = strtoupper(trim($value));
    }

    /**
     * Accesor: Obtener el apellido paterno del presidente con la primera letra mayúscula.
     *
     * @return string
     */
    public function getPresidentPaternalSurnameAttribute()
    {
        return ucwords(strtolower($this->attributes['president_paternal_surname']));
    }

    /**
     * Accesor: Obtener el apellido materno del presidente con la primera letra mayúscula.
     *
     * @return string
     */
    public function getPresidentMaternalSurnameAttribute()
    {
        return ucwords(strtolower($this->attributes['president_maternal_surname']));
    }

    /**
     * Accesor: Obtener el nombre del presidente con la primera letra mayúscula.
     *
     * @return string
     */
    public function getPresidentGivenNameAttribute()
    {
        return ucwords(strtolower($this->attributes['president_given_name']));
    }

    /**
     * Accesor: Obtener el nombre completo del presidente con la primera letra en mayúscula para cada parte.
     *
     * @return string
     */
    public function getPresidentAttribute()
    {
        // Concatenamos y formateamos los tres atributos
        return $this->president_paternal_surname . ' ' . $this->president_maternal_surname . ' ' . $this->president_given_name;
    }

    /**
     * Activar el manejo automático de timestamps.
     *
     * @var bool
     */
    public $timestamps = true;
}