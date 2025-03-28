<?php

namespace App\Http\Requests\VasoDeLecheRequests\Products;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para crear un producto.
 * Aquí se definen las reglas de validación para la creación de productos.
 */
class StoreProductRequest extends FormRequest
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
                'regex:/^[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑüÜ]+$/', // Solo letras, números y espacios
            ],
            'description' => [
                'nullable',
                'string',
                'max:1000',
                'regex:/^[a-zA-Z0-9\s.,;:"\'()-áéíóúÁÉÍÓÚñÑüÜ]+$/', // Caracteres básicos permitidos
                'not_regex:/<script.*?>.*?<\/script>/i', // Protege contra inyección de scripts
            ],
            'year' => [
                'required', // El campo es obligatorio
                'integer', // Valida que el campo tenga el formato de un año (por ejemplo, 2025)
                'min:1900', // El año no puede ser menor que 1900
                'max:' . date('Y'), // El año no puede ser mayor que el año actual
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
            'name' => [
                'required' => 'El nombre es obligatorio.',
                'string' => 'El nombre debe ser una cadena de texto.',
                'max' => 'El nombre no puede tener más de 50 caracteres.',
                'regex' => 'El nombre solo puede contener letras, números, espacios y caracteres especiales del alfabeto español (como ñ, á, é, í, ó, ú, ü).',
            ],
            'description' => [
                'nullable' => 'La descripción puede estar vacía.',
                'string' => 'La descripción debe ser una cadena de texto.',
                'max' => 'La descripción no puede tener más de 1000 caracteres.',
                'regex' => 'La descripción solo puede contener letras, números, espacios, comas, puntos, puntos y coma, comillas, paréntesis y caracteres del alfabeto español (como ñ, á, é, í, ó, ú, ü).',
                'not_regex' => 'La descripción no puede contener scripts.',
            ],
            'year' => [
                'required' => 'El año es obligatorio.',
                'date_format' => 'El año debe tener el formato correcto (YYYY).',
                'min' => 'El año no puede ser menor que 1900.',
                'max' => 'El año no puede ser mayor que el año actual.',
            ],
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
            'year' => 'año del producto',
        ];
    }
}
