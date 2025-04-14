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
        'committee_number',             // Número de comité 
        'name',                         // Nombre del comité
        'president',                    // Nombre completo de presidente(a)
        'urban_core',                   // Núcleo urbano
        'sector_id',                    // Clave foránea del sector
    ];

    /**
     * Casts: Conversión de datos a tipos nativos de PHP.
     *
     * @var array
     */
    protected $casts = [
        'committee_number' => 'string',
        'name' => 'string',
        'president' => 'string',
        'urban_core' => 'string',
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
     * Relación con el modelo CommitteeVlFamilyMember.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vlFamilyMembers()
    {
        return $this->belongsToMany(VlFamilyMember::class, 'committee_vl_family_members', 'committee_id', 'vl_family_member_id');
    }


    /**
     * Mutador: Guardar el presidente con letras mayúsculas.
     */
    public function setPresidentAttribute($value)
    {
        $this->attributes['president'] = strtoupper(trim($value));
    }

    /**
     * Accesor: Obtener el presidente con la primera letra mayúscula.
     *
     * @return string
     */
    public function getPresidentAttribute()
    {
        return ucwords(strtolower($this->attributes['president']));
    }

    /**
     * Activar el manejo automático de timestamps.
     *
     * @var bool
     */
    public $timestamps = true;
}