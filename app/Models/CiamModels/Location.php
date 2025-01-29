<?php

namespace App\Models\CiamModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;

    /**
     * La clave primaria de la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Desactivar el autoincremento de la clave primaria.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * El tipo de clave primaria.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Atributos asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'id',         // Código único de ubicación
        'department', // Nombre del departamento
        'province',   // Nombre de la provincia
        'district',   // Nombre del distrito
    ];

    /**
     * Atributos que deben ser convertidos a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'department' => 'string',
        'province' => 'string',
        'district' => 'string',
    ];

    /**
     * Mutador: Capitaliza el nombre del departamento antes de guardarlo.
     *
     * @param string $value
     */
    public function setDepartmentAttribute($value)
    {
        $this->attributes['department'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Mutador: Capitaliza el nombre de la provincia antes de guardarlo.
     *
     * @param string $value
     */
    public function setProvinceAttribute($value)
    {
        $this->attributes['province'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Mutador: Capitaliza el nombre del distrito antes de guardarlo.
     *
     * @param string $value
     */
    public function setDistrictAttribute($value)
    {
        $this->attributes['district'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Accesor: Devuelve la ubicación completa como una cadena.
     *
     * @return string
     */
    public function getFullLocationAttribute()
    {
        return "{$this->department}, {$this->province}, {$this->district}";
    }

    /**
     * Relación con ElderlyAdults.
     * Una ubicación puede estar asociada con muchos ElderlyAdults.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function elderlyAdults()
    {
        return $this->hasMany(ElderlyAdult::class);
    }
}
