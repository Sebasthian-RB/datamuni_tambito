<?php

namespace App\Models\CiamModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ElderlyAdultGuardian extends Model
{
    use HasFactory;

    /**
     * Campos asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'elderly_adults_id', // Relación con ElderlyAdult
        'guardians_id',      // Relación con Guardian
    ];

    /**
     * Relaciones: Cada registro pertenece a un ElderlyAdult y a un Guardian.
     */

    /**
     * Relación con ElderlyAdult.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function elderlyAdult()
    {
        return $this->belongsTo(ElderlyAdult::class, 'elderly_adults_id');
    }

    /**
     * Relación con Guardian.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function guardian()
    {
        return $this->belongsTo(Guardian::class, 'guardians_id');
    }
}
