<?php

namespace App\Models\CiamModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ElderlyAdultPrivateInsurance extends Model
{
    use HasFactory;

    /**
     * Campos asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'elderly_adults_id',    // Relación con ElderlyAdult
        'private_insurances_id' // Relación con PrivateInsurance
    ];

    /**
     * Relaciones: Cada registro pertenece a un ElderlyAdult y a un PrivateInsurance.
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
     * Relación con PrivateInsurance.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function privateInsurance()
    {
        return $this->belongsTo(PrivateInsurance::class, 'private_insurances_id');
    }
}
