<?php

namespace App\Models\VasoDeLecheModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VlFamilyMemberProduct extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'vl_family_member_id', // Id del miembro de la familia
        'product_id',          // Id del producto
        'quantity',            // Cantidad del producto
    ];

    /**
     * Casts: Conversión de datos a tipos nativos de PHP.
     *
     * @var array
     */
    protected $casts = [
        'vl_family_member_id' => 'string',  // Convierte 'vl_family_member_id' a tipo string
        'product_id' => 'integer',          // Convierte 'product_id' a tipo entero
        'quantity' => 'integer',            // Convierte 'quantity' a tipo entero
    ];

    /**
     * Relación con el modelo 'VlFamilyMember'.
     * Un producto pertenece a un miembro de la familia.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vlFamilyMember()
    {
        return $this->belongsTo(VlFamilyMember::class, 'vl_family_member_id');
    }

    /**
     * Relación con el modelo 'Product'.
     * Un producto pertenece a un registro de producto.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Activar el manejo automático de timestamps.
     *
     * @var bool
     */
    public $timestamps = true;
}
