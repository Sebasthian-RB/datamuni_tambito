<?php

namespace App\Models\VasoDeLecheModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitteeVLFamiliesMember extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */

    // Campos que son asignables masivamente
    protected $fillable = [
        'committee_id', // ID del comité
        'vl_family_member_id',// ID del familiar
        'change_date', // Fecha de cambio del sector
        'description', // Descripción del cambio de sector
        'status', // Estado del cambio de sector (0 - Inactivo | 1 - Activo)
    ];

    // Definir las relaciones

    /**
     * Relación con el modelo Committee (comités)
     */
    public function committee()
    {
        return $this->belongsTo(Committee::class, 'committee_id');
    }

    /**
     * Relación con el modelo VLFamiliesMember (miembros de familia de vaso de leche)
     */
    public function vlFamilyMember()
    {
        return $this->belongsTo(VlFamilyMember::class, 'vl_family_member_id');
    }

    // Actualizar automáticamente con las fechas correspondientes cada vez que se cree o actualice el registro 
    public $timestamps = true;
}
