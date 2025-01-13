<?php

namespace App\Http\Requests\SisfohRequests\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para crear una solicitud.
 * Aquí se definen las reglas de validación para la creación de las solicitudes.
 */

class StoreRequestRequest extends FormRequest
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
            'request_date' => [
                'required',
                'date', // Debe ser una fecha válida
                'before_or_equal:today', // La fecha no puede ser futura
            ],
            'description' => [
                'nullable', // La descripción es opcional
                'string',   // Debe ser una cadena de texto
                'max:1000', // Límite de 1000 caracteres
            ],
            'sfh_person_id' => [
                'required',
                'string',
                'exists:sfh_people,id', // El ID de la persona debe existir en la tabla sfh_people
                'size:36', // El ID debe tener un tamaño de 36 caracteres
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
            'request_date.required' => 'La fecha de la solicitud es obligatoria.',
            'request_date.date' => 'La fecha de la solicitud debe ser una fecha válida.',
            'request_date.before_or_equal' => 'La fecha de la solicitud no puede ser futura.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.max' => 'La descripción no debe exceder los 1000 caracteres.',
            'sfh_person_id.required' => 'El ID de la persona es obligatorio.',
            'sfh_person_id.string' => 'El ID de la persona debe ser una cadena de texto.',
            'sfh_person_id.exists' => 'La persona especificada no existe.',
            'sfh_person_id.size' => 'El ID de la persona debe tener 36 caracteres.',
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
            'request_date' => 'fecha de la solicitud',
            'description' => 'descripción',
            'sfh_person_id' => 'ID de la persona',
        ];
    }
}
