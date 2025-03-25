<?php

namespace App\Models\VasoDeLecheModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    /**
     * Atributos asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'name',             // Nombre del sector
        'description',      // Descripción del lugar
        'responsible_person', // Persona responsable del sector
    ];

    /**
     * Activar el manejo automático de timestamps.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Relación con el modelo Committee.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function committees()
    {
        return $this->hasMany(Committee::class); // Ajusta según tu estructura
    }
    /**
     * Accesor: Obtener el nombre completo de la persona responsable en mayúsculas.
     *
     * @return string
     */
    public function getResponsiblePersonFullNameAttribute()
    {
        return strtoupper($this->responsible_person);
    }

    /**
     * Mutador: Establecer el nombre completo de la persona responsable de manera formateada.
     *
     * @param string $value
     */
    public function setResponsiblePersonAttribute($value)
    {
        // Removes extra spaces and capitalizes each word
        $this->attributes['responsible_person'] = ucwords(strtolower(trim($value)));
    }
}
