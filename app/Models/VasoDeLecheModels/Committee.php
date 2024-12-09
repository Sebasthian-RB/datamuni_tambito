<?php

namespace App\Models\VasoDeLecheModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */

    // Campos que son asignables masivamente
    protected $fillable = [
        'name', // Nombre del comité
        'president', // Nombre del presidente
        'urban_core', // Núcleo urbano
        'beneficiaries_count', // Número de beneficiarios
        'sector_id', // Clave foránea del sector
    ];

    // Definir las relaciones

    /**
     * Relación con el modelo Sector (sectores)
     */
    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    // Actualizar automáticamente con las fechas correspondientes cada vez que se cree o actualice el registro 
    public $timestamps = true;
}
