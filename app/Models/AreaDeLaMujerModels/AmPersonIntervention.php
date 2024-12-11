<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AmPersonIntervention extends Model
{
    use HasFactory;
    protected $fillable = [
        'am_person_id',     // ID de la persona (foráneo de am_persons)
        'intervention_id',  // ID de la intervención (foráneo de interventions)
        'status',           // Estado de la intervención (varchar)
    ];

    protected $casts = [
        'am_person_id' => 'string',
        'intervention_id' => 'integer',
        'status' => 'string',
    ];

    public function amPerson()
    {
        return $this->belongsTo(AmPerson::class, 'am_person_id');
    }

    public function intervention()
    {
        return $this->belongsTo(Intervention::class, 'intervention_id');
    }
}
