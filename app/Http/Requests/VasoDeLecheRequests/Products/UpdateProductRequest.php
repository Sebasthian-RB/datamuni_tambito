<?php

namespace App\Http\Requests\VasoDeLecheRequests\Products;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para actualizar un producto.
 * Aquí se definen las reglas de validación para la actualización.
 */
class UpdateProductRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:50',
                'regex:/^[a-zA-Z0-9\s]+$/', // Solo letras, números y espacios
            ],
            'description' => [
                'nullable',
                'string',
                'max:1000',
                'regex:/^[a-zA-Z0-9\s.,;:"\'()-]+$/', // Caracteres básicos permitidos
            ],
        ];
    }

    /**
     * Obtener los mensajes de validación personalizados.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'El nombre del producto es obligatorio.',
            'name.max' => 'El nombre no debe exceder los 50 caracteres.',
            'name.regex' => 'El nombre solo puede contener letras, números y espacios.',
            'description.max' => 'La descripción no debe exceder los 1000 caracteres.',
            'description.regex' => 'La descripción contiene caracteres no permitidos.',
        ];
    }

     /**
     * Personaliza los nombres de los campos de la solicitud.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'nombre del producto',
            'description' => 'descripción del producto',
        ];
    }
}
