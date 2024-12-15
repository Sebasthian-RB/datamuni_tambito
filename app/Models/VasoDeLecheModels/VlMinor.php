<?php

namespace App\Models\VasoDeLecheModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VlMinor extends Model
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
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'id', // Id del menor 
        'identity_document', // Tipo de documento
        'given_name', // Nombres
        'paternal_last_name', // Apellido Paterno
        'maternal_last_name', // Apellido Materno
        'birth_date', // Fecha de nacimiento
        'sex_type', // Sexo
        'registration_date', // Fecha de Empadronamiento
        'withdrawal_date', // Fecha de Retiro
        'address', // Domicilio del menor
        'dwelling_type',  // (Tipo) Vivienda del menor
        'education_level',  // Grado de Instrucción del menor
        'condition', // Condición del menor (GEST. | LACT. | ANC.)
        'disability',// Discapacidad del menor
        'vl_family_member_id', // Id del familiar
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'identity_document' => 'string',
        'given_name' => 'string',
        'paternal_last_name' => 'string',
        'maternal_last_name' => 'string',
        'birth_date' => 'date',
        'sex_type' => 'boolean',
        'registration_date' => 'date',
        'withdrawal_date' => 'date',
        'address' => 'string',
        'dwelling_type' => 'string',
        'education_level' => 'string',
        'condition' => 'string',
        'disability' => 'boolean',
        'vl_family_member_id' => 'string',
    ];

    /**
     * Relación con el modelo 'VlFamilyMember' (pertenece a un miembro de familia).
     */
    public function vlFamilyMember()
    {
        return $this->belongsTo(VlFamilyMember::class, 'vl_family_member_id');
    }

    /**
     * Mutador para asegurar que el nombre siempre se almacene con la primera letra en mayúscula.
     *
     * @param string $value
     */
    public function setGivenNameAttribute($value)
    {
        $this->attributes['given_name'] = ucfirst(strtolower($value));
    }

    /**
     * Accesor para obtener el nombre con la primera letra de cada palabra en mayúscula.
     *
     * @return string
     */
    public function getGivenNameAttribute()
    {
        return ucwords($this->attributes['given_name']);
    }

    /**
     * Mutador para asegurar que el apellido paterno siempre se almacene en mayúsculas.
     *
     * @param string $value
     */
    public function setPaternalLastNameAttribute($value)
    {
        $this->attributes['paternal_last_name'] = strtoupper($value);
    }

    /**
     * Accesor para obtener el apellido paterno en mayúsculas.
     *
     * @return string
     */
    public function getPaternalLastNameAttribute()
    {
        return strtoupper($this->attributes['paternal_last_name']);
    }

    /**
     * Mutador para asegurar que el apellido materno siempre se almacene en mayúsculas.
     *
     * @param string $value
     */
    public function setMaternalLastNameAttribute($value)
    {
        $this->attributes['maternal_last_name'] = strtoupper($value);
    }

    /**
     * Accesor para obtener el apellido materno en mayúsculas.
     *
     * @return string
     */
    public function getMaternalLastNameAttribute()
    {
        return strtoupper($this->attributes['maternal_last_name']);
    }

    /**
     * Indica si el modelo debe manejar las marcas de tiempo.
     *
     * @var bool
     */
    public $timestamps = true;
}
