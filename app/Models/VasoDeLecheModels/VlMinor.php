<?php

namespace App\Models\VasoDeLecheModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VlMinor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */

    // Definir la clave primaria de la tabla
    protected $primaryKey = 'id';

    // Deshabilitar la autoincrementación, ya que estamos usando una cadena como clave primaria
    public $incrementing = false;

    // Definir los campos que pueden ser asignados de forma masiva (mass assignable)
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

    // Definir las relaciones con otros modelos

    // Relación con el modelo 'VlFamilyMember' (pertenece a un miembro de familia)
    public function vlFamilyMember()
    {
        return $this->belongsTo(VlFamilyMember::class, 'vl_family_member_id');
    }

    // Definir los tipos de datos de las columnas (opcional)
    protected $casts = [
        'id' => 'string',
        'identity_document' => 'string',
        'given_name' => 'string',
        'paternal_last_name' => 'string',
        'maternal_last_name' => 'string',
        'birth_date' => 'date',
        'sex_type' => 'string',
        'registration_date' => 'date',
        'withdrawal_date' => 'date',
        'address' => 'string',
        'dwelling_type' => 'string',
        'education_level' => 'string',
        'condition' => 'string',
        'disability' => 'boolean',
        'vl_family_member_id' => 'string',
    ];

    // Actualizar automáticamente con las fechas correspondientes cada vez que se cree o actualice el registro 
    public $timestamps = true;
}