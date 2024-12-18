<?php

namespace App\Http\Requests\VasoDeLecheRequests\VlFamilyMemberProducts;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para crear un producto asignado a un miembro familiar.
 */
class StoreVlFamilyMemberProductRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para esta acción.
     */
    public function authorize(): bool
    {
        return true; // Permite el acceso
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'vl_family_member_id' => [
                'required',
                'string',
                'exists:vl_family_members,id',
            ],
            'product_id' => [
                'required',
                'integer',
                'exists:products,id',
            ],
            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],
        ];
    }

    /**
     * Obtener los mensajes de validación personalizados.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'vl_family_member_id.required' => 'El ID del miembro familiar es obligatorio.',
            'vl_family_member_id.exists' => 'El miembro familiar seleccionado no existe.',
            'product_id.required' => 'El ID del producto es obligatorio.',
            'product_id.exists' => 'El producto seleccionado no existe.',
            'quantity.min' => 'La cantidad debe ser al menos 1.',
        ];
    }

    /**
     * Personaliza los nombres de los campos de la solicitud.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'vl_family_member_id' => 'ID del miembro familiar',
            'product_id' => 'ID del producto',
            'quantity' => 'cantidad',
        ];
    }
}
