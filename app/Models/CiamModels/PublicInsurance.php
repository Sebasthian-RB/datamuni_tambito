<?php

namespace App\Models\CiamModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PublicInsurance extends Model
{
    use HasFactory;

    /**
     * Definición de la clave primaria.
     *
     * @var string
     */
    protected $primaryKey = 'id';   // Define que la clave primaria es 'id'
    public $incrementing = false;   // Deshabilita el autoincremento para el ID
    protected $keyType = 'string';  // El ID será un string

    /**
     * Campos asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'id',                     // ID único del seguro público
        'public_insurances_name', // Nombre del seguro público (SIS o ESSALUD)
    ];

    /**
     * Casts: Conversión de datos a tipos nativos de PHP.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'public_insurances_name' => 'string',
    ];

    /**
     * Mutador: Asegurar que el nombre del seguro público se almacene en mayúsculas.
     *
     * @param string $value
     */
    public function setPublicInsurancesNameAttribute($value)
    {
        $this->attributes['public_insurances_name'] = strtoupper(trim($value));
    }
}
