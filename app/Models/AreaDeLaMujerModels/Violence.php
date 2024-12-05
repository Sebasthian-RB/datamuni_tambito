<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Violence extends Model
{
    use HasFactory;

    protected $fillable = [
        'kind_violence',    //Tipo de violencia que añaden los gerente
        'description',      //Descripción de la violencia
    ];

    public function amPersons()
    {
        return $this->hasMany(AmPersonViolence::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
