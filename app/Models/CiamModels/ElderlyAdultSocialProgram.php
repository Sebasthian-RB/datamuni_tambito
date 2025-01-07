<?php

namespace App\Models\CiamModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ElderlyAdultSocialProgram extends Model
{
    use HasFactory;

    /**
     * Campos asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'elderly_adults_id',    // Relación con ElderlyAdult
        'social_programs_id'    // Relación con SocialProgram
    ];

    /**
     * Relaciones: Cada registro pertenece a un ElderlyAdult y a un SocialProgram.
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
     * Relación con SocialProgram.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function socialProgram()
    {
        return $this->belongsTo(SocialProgram::class, 'social_programs_id');
    }
}
