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
        'id',                   // ID personalizado de comité 
        'name',                 // Nombre del comité
        'president',            // Nombre del presidente
        'urban_core',           // Núcleo urbano
        'beneficiaries_count',  // Número de beneficiarios
        'sector_id',            // Clave foránea del sector
    ];

    /**
     * Casts: Conversión de datos a tipos nativos de PHP.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'president' => 'string',
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
     * Mutador: Formatear y almacenar el nombre del presidente(a).
     *
     * @param string $value
     */
    public function setPresidentAttribute($value)
    {
        // Capitalizar la primera letra de cada palabra y eliminar espacios en exceso
        $this->attributes['president'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Accesor: Obtener el nombre del presidente(a) en mayúsculas completas.
     *
     * @return string
     */
    public function getPresidentAttribute()
    {
        return strtoupper($this->attributes['president']);
    }

    /**
     * Activar el manejo automático de timestamps.
     *
     * @var bool
     */
    public $timestamps = true;
}
