<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AmPersonEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'am_person_id',
        'event_id',
        'attendance',
    ];

    public function amPerson()
    {
        return $this->belongsTo(AmPerson::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
