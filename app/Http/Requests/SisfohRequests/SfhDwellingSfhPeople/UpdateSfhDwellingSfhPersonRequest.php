<?php

namespace App\Http\Requests\SisfohRequests\SfhDwellingSfhPeople;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Form Request para actualizar una vivienda/persona.
 * Aquí se definen las reglas de validación para la actualización de la vivienda/persona.
 */

class UpdateSfhDwellingSfhPersonRequest extends FormRequest
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
            'sfh_person_id' => [
                'required',
                'string',
                'size:36', // Debe tener exactamente 36 caracteres
                'exists:sfh_people,id', // Verifica que exista en la tabla sfh_people
            ],
            'sfh_dwelling_id' => [
                'required',
                'string',
                'exists:sfh_dwellings,id', // Verifica que exista en la tabla sfh_dwellings
            ],
            'status' => [
                'required',
                Rule::in(['Activo', 'Inactivo']), // Solo permite estos valores
            ],
            'update_date' => [
                'required',
                'date', // Verifica que sea una fecha válida
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
            'sfh_person_id.required' => 'El ID de la persona es obligatorio.',
            'sfh_person_id.string' => 'El ID de la persona debe ser una cadena de texto.',
            'sfh_person_id.size' => 'El ID de la persona debe tener exactamente 36 caracteres.',
            'sfh_person_id.exists' => 'La persona especificada no existe.',

            'sfh_dwelling_id.required' => 'El ID de la vivienda es obligatorio.',
            'sfh_dwelling_id.string' => 'El ID de la vivienda debe ser una cadena de texto.',
            'sfh_dwelling_id.exists' => 'La vivienda especificada no existe.',

            'status.required' => 'El estado es obligatorio.',
            'status.in' => 'El estado debe ser "Activo" o "Inactivo".',

            'update_date.required' => 'La fecha de actualización es obligatoria.',
            'update_date.date' => 'La fecha de actualización debe ser una fecha válida.',
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
            'sfh_person_id' => 'ID de la persona',
            'sfh_dwelling_id' => 'ID de la vivienda',
            'status' => 'estado',
            'update_date' => 'fecha de actualización',
        ];
    }
}
