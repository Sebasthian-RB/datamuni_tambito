<?php

namespace App\Models\OmapedModels;

use App\Models\OmapedModels\OmPerson;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PsychologicalDiagnosis extends Model
{
    use HasFactory;

    protected $fillable = [
        'om_person_id',
        'diagnosis',
        'recommended_sessions',
        'diagnosis_date'
    ];

    // Relación: Cada diagnóstico pertenece a una persona (om_people)
    public function person()
    {
        return $this->belongsTo(OmPerson::class, 'om_person_id');
    }

    // Relación: Un diagnóstico tiene muchas sesiones
    public function sessions()
    {
        return $this->hasMany(PsychologicalSession::class, 'diagnosis_id');
    }
}
