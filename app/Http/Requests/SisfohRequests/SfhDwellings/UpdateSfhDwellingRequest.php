<?php

namespace App\Http\Requests\SisfohRequests\SfhDwellings;

use Illuminate\Foundation\Http\FormRequest;


/**
 * Form Request para actualizar una vivienda.
 * Aquí se definen las reglas de validación para la actualización de la vivienda.
 */

class UpdateSfhDwellingRequest extends FormRequest
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
            'street_address' => [
                'required',
                'string',
                'max:255', // Límite de 255 caracteres
            ],
            'reference' => [
                'nullable', // Opcional
                'string',
                'max:255', // Límite de 255 caracteres
            ],
            'neighborhood' => [
                'nullable', // Opcional
                'string',
                'max:100', // Límite de 100 caracteres
            ],
            'district' => [
                'required',
                'string',
                'max:50', // Límite de 100 caracteres
            ],
            'provincia' => [
                'required',
                'string',
                'max:30', // Límite de 100 caracteres
            ],
            'region' => [
                'required',
                'string',
                'max:15', // Límite de 100 caracteres
            ],

        ];
    }

        /**
     * Obtiene los mensajes de validación personalizados.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'street_address.required' => 'La dirección de la vivienda es obligatoria.',
            'street_address.string' => 'La dirección debe ser una cadena de texto.',
            'street_address.max' => 'La dirección no puede exceder los 255 caracteres.',
            'reference.string' => 'La referencia debe ser una cadena de texto.',
            'reference.max' => 'La referencia no puede exceder los 255 caracteres.',
            'neighborhood.string' => 'El barrio debe ser una cadena de texto.',
            'neighborhood.max' => 'El barrio no puede exceder los 100 caracteres.',
            'district.required' => 'El distrito es obligatorio.',
            'district.string' => 'El distrito debe ser una cadena de texto.',
            'district.max' => 'El distrito no puede exceder los 100 caracteres.',
            'provincia.required' => 'La provincia es obligatoria.',
            'provincia.string' => 'La provincia debe ser una cadena de texto.',
            'provincia.max' => 'La provincia no puede exceder los 100 caracteres.',
            'region.required' => 'La región es obligatoria.',
            'region.string' => 'La región debe ser una cadena de texto.',
            'region.max' => 'La región no puede exceder los 100 caracteres.',
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
            'street_address' => 'dirección de la vivienda',
            'reference' => 'referencia',
            'neighborhood' => 'barrio',
            'district' => 'distrito',
            'provincia' => 'provincia',
            'region' => 'región',
            'sfh_dwelling_id' => 'ID de la vivienda',
        ];
    }
}
