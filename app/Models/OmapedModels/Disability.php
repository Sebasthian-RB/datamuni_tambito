<?php

namespace App\Models\OmapedModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disability extends Model
{
    use HasFactory;

    // Atributos asignables en masa
    protected $fillable = [
        'certificate_number', 'certificate_issue_date', 'certificate_expiry_date', 
        'organization_name', 'diagnosis', 'disability_type', 'severity_level', 
        'required_support_devices', 'used_support_devices', 'om_person_id'
    ];

    // Casts para convertir tipos de datos automáticamente
    protected $casts = [
        'certificate_issue_date' => 'date', // Fecha de emisión del certificado
        'certificate_expiry_date' => 'date', // Fecha de caducidad del certificado
    ];

    /**
     * Relación con la persona.
     * Una discapacidad pertenece a una sola persona.
     */
    public function person()
    {
        return $this->belongsTo(OmPerson::class, 'om_person_id');
    }
}
