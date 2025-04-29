<?php

namespace App\Http\Requests\SisfohRequests\SfhDwellings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'zone' => [
                'required',
                Rule::in(['urbano', 'rural']), // Solo acepta "urbano" o "rural"
            ],
            'creation_date' => [
                'required',
                'date',
                'before_or_equal:today', // No puede ser una fecha futura
            ],
            'expiration_date' => [
                'required',
                'date',
                'after:creation_date', // Debe ser posterior a la fecha de creación
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
            'zone.required' => 'La zona es obligatoria.',
            'zone.in' => 'La zona debe ser "urbano" o "rural".',

            'creation_date.required' => 'La fecha de registro es obligatoria.',
            'creation_date.date' => 'La fecha de registro debe ser una fecha válida.',
            'creation_date.before_or_equal' => 'La fecha de registro no puede ser en el futuro.',

            'expiration_date.required' => 'La fecha de caducidad es obligatoria.',
            'expiration_date.date' => 'La fecha de caducidad debe ser una fecha válida.',
            'expiration_date.after' => 'La fecha de caducidad debe ser posterior a la fecha de registro.',
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
            // 'zone' => 'zona',
            // 'creation_date' => 'fecha de registro',
            // 'expiration_date' => 'fecha de caducidad',
            'sfh_dwelling_id' => 'ID de la vivienda',
        ];
    }
}
