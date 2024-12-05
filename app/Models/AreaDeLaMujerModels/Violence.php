<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Violence extends Model
{
    use HasFactory;

    protected $fillable = [
        'kind_violence',
        'description',
        'place',
        'start_date',
        'end_date',
        'status',
        'program_id',
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
