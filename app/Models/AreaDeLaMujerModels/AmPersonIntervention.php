<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AmPersonIntervention extends Model
{
    use HasFactory;
    protected $fillable = [
        'am_person_id',
        'intervention_id',
        'status',
    ];

    public function amPerson()
    {
        return $this->belongsTo(AmPerson::class);
    }

    public function intervention()
    {
        return $this->belongsTo(Intervention::class);
    }
}
