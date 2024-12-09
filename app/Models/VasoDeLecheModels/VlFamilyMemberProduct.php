<?php

namespace App\Models\VasoDeLecheModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VlFamilyMemberProduct extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */

    // Definir la clave primaria de la tabla
    protected $primaryKey = 'id';

    // Campos que son asignables masivamente
    protected $fillable = [
        'vl_family_member_id', // Id del familiar
        'product_id', // Id del producto
        'quantity' // Cantidad
    ];

    // Definir la relación con el modelo 'VlFamilyMember' (uno a muchos inverso)
    public function vlFamilyMember()
    {
        return $this->belongsTo(VlFamilyMember::class, 'vl_family_member_id');
    }

    // Definir la relación con el modelo 'Product' (uno a muchos inverso)
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Definir los tipos de datos de las columnas para asegurarse de que Laravel maneje correctamente estos campos cuando interactúas con ellos.
    protected $casts = [
        'vl_family_member_id' => 'string',
        'product_id' => 'integer',
        'quantity' => 'integer'
    ];

    // Actualizar automáticamente con las fechas correspondientes cada vez que se cree o actualice el registro
    public $timestamps = true;
}
