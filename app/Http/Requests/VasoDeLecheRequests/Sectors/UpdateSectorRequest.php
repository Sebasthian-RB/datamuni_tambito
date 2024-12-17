<?php

namespace App\Http\Requests\VasoDeLecheRequests\Sectors;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para actualizar un sector.
 * Aquí se definen las reglas de validación para la actualización de sectores.
 */
class UpdateSectorRequest extends FormRequest
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
                'max:30',
                'regex:/^[a-zA-Z0-9\s]+$/', // Solo letras, números y espacios
            ],
            'description' => [
                'nullable',
                'string',
                'max:1000',
                'regex:/^[a-zA-Z0-9\s.,;:"\'()-]+$/', // Caracteres básicos permitidos
            ],
            'responsible_person' => [
                'required',
                'string',
                'max:50',
                'regex:/^[a-zA-Z\s]+$/', // Solo letras y espacios
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
            'name.required' => 'El nombre del sector es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no debe exceder los 30 caracteres.',
            'name.regex' => 'El nombre solo puede contener letras, números y espacios.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.max' => 'La descripción no debe exceder los 1000 caracteres.',
            'description.regex' => 'La descripción contiene caracteres no permitidos.',
            'responsible_person.required' => 'El nombre del responsable es obligatorio.',
            'responsible_person.string' => 'El responsable debe ser una cadena de texto.',
            'responsible_person.max' => 'El nombre del responsable no debe exceder los 50 caracteres.',
            'responsible_person.regex' => 'El nombre del responsable solo puede contener letras y espacios.',
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
            'name' => 'nombre del sector',
            'description' => 'descripción del sector',
            'responsible_person' => 'persona responsable',
        ];
    }
}
