<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AmPersonViolence extends Model
{
    use HasFactory;

    protected $fillable = [
        'am_person_id',
        'violence_id',
        'registration_date',
    ];

    public function amPerson()
    {
        return $this->belongsTo(AmPerson::class);
    }

    public function violence()
    {
        return $this->belongsTo(Violence::class);
    }
}
