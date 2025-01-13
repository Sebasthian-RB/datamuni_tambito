<?php

namespace App\Models\SisfohModels;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SfhDwelling extends Model
{
    use HasFactory;

    /**
     * Campos asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'street_address', // Dirección de la vivienda
        'reference',      // Referencia opcional
        'neighborhood',    // Barrio opcional
        'district',       // Distrito obligatorio
        'provincia',      // Provincia obligatoria
        'region',         // Región obligatoria
    ];

    /**
     * Casting de atributos.
     *
     * @var array
     */
    protected $casts = [
        
        'street_address' => 'string', // Dirección como string
        'reference' => 'string',      // Referencia como string
        'neighborhood' => 'string',   // Barrio como string
        'district' => 'string',       // Distrito como string
        'provincia' => 'string',      // Provincia como string
        'region' => 'string',         // Región como string
        'created_at' => 'datetime',   // Fecha de creación como objeto Carbon
        'updated_at' => 'datetime',   // Fecha de actualización como objeto Carbon
    ];

    /**
     * Relación con el modelo SfhPerson (Muchos a Uno).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sfhperson()
    {
        return $this->belongsToMany(SfhPerson::class, 'sfh_dwellings_sfh_person')
                    ->withPivot('status', 'update_date')
                    ->withTimestamps();
    }

    /**
     * Accesor: Obtener la dirección completa de la vivienda.
     *
     * @return string
     */
    public function getFullAddressAttribute()
    {
        return "{$this->street_address}, {$this->neighborhood}, {$this->district}, {$this->provincia}, {$this->region}";
    }

    /**
     * Activar el manejo automático de timestamps.
     *
     * @var bool
     */
    public $timestamps = true;
}
