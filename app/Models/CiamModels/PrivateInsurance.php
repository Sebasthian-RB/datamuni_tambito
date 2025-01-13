<?php

namespace App\Models\CiamModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PrivateInsurance extends Model
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
        'id',                        // ID único del seguro privado
        'private_insurances_name',   // Nombre del seguro privado
    ];

    /**
     * Casts: Conversión de datos a tipos nativos de PHP.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'private_insurances_name' => 'string',
    ];

    /**
     * Mutador: Formatear y almacenar el nombre del seguro privado.
     *
     * @param string $value
     */
    public function setPrivateInsurancesNameAttribute($value)
    {
        $this->attributes['private_insurances_name'] = ucwords(strtolower(trim($value)));
    }
}
