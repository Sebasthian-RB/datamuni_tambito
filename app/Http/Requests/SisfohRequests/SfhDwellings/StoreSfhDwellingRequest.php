<?php

namespace App\Http\Requests\SisfohRequests\SfhDwellings;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para crear una vivienda.
 * Aquí se definen las reglas de validación para la creación de las viviendas.
 */

class StoreSfhDwellingRequest extends FormRequest
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
                'max:255',
            ],
            'reference' => [
                'nullable',
                'string',
                'max:255',
            ],
            'neighborhood' => [
                'nullable',
                'string',
                'max:100',
            ],
            'district' => [
                'required',
                'string',
                'max:100',
            ],
            'provincia' => [
                'required',
                'string',
                'max:100',
            ],
            'region' => [
                'required',
                'string',
                'max:100',
            ],
        ];
    }

/**
     * Obtiene los mensajes de validación personalizados.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'street_address.required' => 'La dirección de la vivienda es obligatoria.',
            'street_address.string' => 'La dirección de la vivienda debe ser una cadena de texto.',
            'street_address.max' => 'La dirección de la vivienda no puede exceder los 255 caracteres.',

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
     * @return array<string, string>
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
        ];
    }

}
