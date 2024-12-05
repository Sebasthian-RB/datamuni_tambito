<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AmPerson extends Model
{
    use HasFactory;

    protected $fillable = [
        'identity_document',
        'given_name',
        'paternal_last_name',
        'maternal_last_name',
        'address',
        'sex_type',
        'phone_number',
        'attendance_date',
    ];

    public function events()
    {
        return $this->hasMany(AmPersonEvent::class);
    }

    public function interventions()
    {
        return $this->hasMany(AmPersonIntervention::class);
    }

    public function violences()
    {
        return $this->hasMany(AmPersonViolence::class);
    }
}
