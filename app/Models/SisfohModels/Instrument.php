<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',                  // ID  
        'name_instruments',    // Nombre del instrumento
        'type_instruments',    // Tipo de instrumento
        'description',         // Descripción del instrumento
    ];

    protected $casts = [
        'id' => 'string',                 // ID                               
        'name_instruments' => 'string',    // Nombre del instrumento como string  
        'type_instruments' => 'string',    // Tipo de instrumento como string 
        'description' => 'string',         // Descripción del instrumento como string
        'created_at' => 'datetime',        // Convertir la fecha de creación a objeto Carbon
        'updated_at' => 'datetime',        // Convertir la fecha de actualización a objeto Carbon
    ];

    /**
     * Relación muchos a muchos con la entidad Visit.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function visits()
    {
        return $this->belongsToMany(Visit::class, 'instrument_visit')->withTimestamps();
    }

    /**
     * Mutador: Formatear y almacenar el nombre del instrumento.
     *
     * @param string $value
     */
    public function setNameInstrumentsAttribute($value)
    {
        $this->attributes['name_instruments'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Mutador: Formatear y almacenar el tipo de instrumento.
     *
     * @param string $value
     */
    public function setTypeInstrumentsAttribute($value)
    {
        $this->attributes['type_instruments'] = ucfirst(strtolower(trim($value)));
    }

    /**
     * Accesor: Obtener una descripción corta del instrumento.
     *
     * @return string
     */
    public function getShortDescriptionAttribute()
    {
        return $this->description ? substr($this->description, 0, 50) . '...' : 'No description available';
    }
    
}
