<?php

namespace App\Models\SisfohModels;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
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
        'zone',                       // Zona (urbano o rural)
        'creation_date',              // Fecha de registro
        'expiration_date',            // Fecha de caducidad
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
        // 'zone' => 'string',           // Zona (urbano o rural)
        // 'creation_date' => 'date',   // Fecha de registro
        // 'expiration_date' => 'date',  // Fecha de caducidad
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

    // /**
    //  * Establece automáticamente la fecha de caducidad según la zona.
    //  */
    // public static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($dwelling) {
    //         // Si la fecha de registro no está definida, se usa la actual
    //         $dwelling->creation_date = $dwelling->creation_date ?? Carbon::now();

    //         // Determinar la fecha de caducidad según la zona
    //         $anios = ($dwelling->zone === 'urbano') ? 4 : 6;
    //         $dwelling->expiration_date = Carbon::parse($dwelling->creation_date)->addYears($anios);
    //     });
    // }

    // /**
    //  * Obtener los años restantes antes de la caducidad.
    //  *
    //  * @return int
    //  */
    // public function getYearsUntilExpirationAttribute()
    // {
    //     return Carbon::now()->diffInYears(Carbon::parse($this->expiration_date));
    // }

    /**
     * Activar el manejo automático de timestamps.
     *
     * @var bool
     */
    public $timestamps = true;
}
