<?php

namespace App\Models\OmapedModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PsychologicalSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnosis_id',
        'session_number',
        'scheduled_date',
        'attendance_status',
        'description'
    ];

    // Relación: Cada sesión pertenece a un diagnóstico
    public function diagnosis()
    {
        return $this->belongsTo(PsychologicalDiagnosis::class, 'diagnosis_id');
    }

}
