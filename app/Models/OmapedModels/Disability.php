<?php

namespace App\Models\OmapedModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disability extends Model
{
    use HasFactory;

    // Atributos asignables en masa
    protected $fillable = [
        'certificate_number',
        'certificate_issue_date',
        'certificate_expiry_date',
        'organization_name',
        'diagnosis',
        'disability_type',
        'severity_level',
        'required_support_devices',
        'used_support_devices',
    ];

    // Casts para convertir tipos de datos automáticamente
    protected $casts = [
        'certificate_issue_date' => 'date',
        'certificate_expiry_date' => 'date',
        'required_support_devices' => 'array', // Guarda en formato JSON en la base de datos
        'used_support_devices' => 'array',
    ];

    // Relación con OmPerson (1 a 1)
    public function person()
    {
        return $this->hasOne(OmPerson::class, 'disability_id');
    }
}
