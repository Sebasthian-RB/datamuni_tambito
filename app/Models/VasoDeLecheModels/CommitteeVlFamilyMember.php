<?php

namespace App\Models\VasoDeLecheModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitteeVlFamilyMember extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla en la base de datos.
     * Si el nombre de la tabla no sigue la convención, puedes especificarlo explícitamente.
     *
     * @var string
     */
    protected $table = 'committee_vl_family_members'; // Asegúrate de que coincida con el nombre correcto de la tabla en la base de datos

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'committee_id',        // ID del comité al que está asignado el miembro de la familia
        'vl_family_member_id', // ID del familiar de vaso de leche
        'change_date',         // Fecha en la que se realiza el cambio de sector
        'description',         // Descripción del cambio de sector (opcional)
        'status',              // Estado del cambio de sector (0 - Inactivo | 1 - Activo)
    ];

    /**
     * Casts: Conversión de datos a tipos nativos de PHP.
     *
     * @var array
     */
    protected $casts = [
        'committee_id' => 'integer',           // Convierte 'committee_id' a tipo entero
        'vl_family_member_id' => 'string',     // Convierte 'vl_family_member_id' a tipo string
        'change_date' => 'date',               // Convierte 'change_date' a tipo date
        'description' => 'string', 
        'status' => 'boolean',                 // Convierte 'status' a tipo booleano (0 o 1)
    ];

    /**
     * Relación con el modelo Committee.
     * Un miembro de la familia de vaso de leche está asignado a un comité.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function committee()
    {
        return $this->belongsTo(Committee::class, 'committee_id');
    }

    /**
     * Relación con el modelo VlFamilyMember.
     * Un registro en CommitteeVLFamilyMember pertenece a un miembro de familia de vaso de leche.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vlFamilyMember()
    {
        return $this->belongsTo(VlFamilyMember::class, 'vl_family_member_id');
    }

    /**
     * Activar el manejo automático de timestamps.
     *
     * @var bool
     */
    public $timestamps = true;    
}
