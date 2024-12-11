<?php

namespace App\Models\AreaDeLaMujerModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Violence extends Model
{
    use HasFactory;

    protected $fillable = [
        'kind_violence',    //Tipo de violencia que añaden los gerente
        'description',      //Descripción de la violencia
    ];

    protected $casts = [
        'kind_violence' => 'string',
        'description' => 'string',
    ];

    public function amPersons()
    {
        return $this->belongsToMany(AmPerson::class, 'am_person_violences')->withPivot('registration_date');
    }
}
