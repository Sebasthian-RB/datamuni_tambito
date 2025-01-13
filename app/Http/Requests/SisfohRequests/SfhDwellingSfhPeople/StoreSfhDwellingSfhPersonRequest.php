<?php

namespace App\Http\Requests\SisfohRequests\SfhDwellingSfhPeople;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para crear una vivienda/persona.
 * Aquí se definen las reglas de validación para la creación de las viviendas/personas.
 */

class StoreSfhDwellingSfhPersonRequest extends FormRequest
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
                'size:36', // El ID debe tener exactamente 36 caracteres
                'exists:sfh_people,id', // Debe existir en la tabla sfh_people
            ],
            'sfh_dwelling_id' => [
                'required',
                'integer',
                'exists:sfh_dwellings,id', // Debe existir en la tabla sfh_dwellings
            ],
            'status' => [
                'required',
                'in:Activo,Inactivo', // Solo se permiten estos valores
            ],
            'update_date' => [
                'required',
                'date', // Debe ser una fecha válida
                'before_or_equal:today', // No puede ser una fecha futura
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
            'sfh_person_id.exists' => 'El ID de la persona no existe en la base de datos.',
            'sfh_dwelling_id.required' => 'El ID de la vivienda es obligatorio.',
            'sfh_dwelling_id.integer' => 'El ID de la vivienda debe ser un número entero.',
            'sfh_dwelling_id.exists' => 'El ID de la vivienda no existe en la base de datos.',
            'status.required' => 'El estado es obligatorio.',
            'status.in' => 'El estado debe ser "Activo" o "Inactivo".',
            'update_date.required' => 'La fecha de actualización es obligatoria.',
            'update_date.date' => 'La fecha de actualización debe ser una fecha válida.',
            'update_date.before_or_equal' => 'La fecha de actualización no puede ser futura.',
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
