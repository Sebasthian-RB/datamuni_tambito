<?php

namespace App\Models;

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
    protected $fillable = [
        'name', // Nombre del comité
        'president', // Nombre del presidente
        'urban_core', // Núcleo urbano
        'beneficiaries_count', // Número de beneficiarios
        'sector_id', // Clave foránea del sector
    ];

    /**
     * Get the sector that owns the committee.
     */
    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
}
