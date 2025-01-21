<?php

namespace App\Http\Requests\SisfohRequests\Visits;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
/**
 * Form Request para actualizar una visita.
 * Aquí se definen las reglas de validación para la actualización de la visita.
 */

class UpdateVisitRequest extends FormRequest
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
            'visit_date' => [
                'required',  // La fecha es obligatoria
                'date',      // Asegura que la fecha sea válida
                'after_or_equal:today', // La fecha no puede ser anterior a la fecha actual
            ],
            'status' => [
                'required',  // El estado es obligatorio
                Rule::in(['Visitado', 'No visitado', 'No encontrado']), // Solo se permiten estos valores
            ],
            'observations' => [
                'nullable',  // Las observaciones pueden ser nulas
                'string',    // Asegura que sea una cadena de texto
                'max:1000',  // Limita las observaciones a 1000 caracteres
            ],
            'enumerator_id' => [
                'required',   // El ID del enumerador es obligatorio
                'uuid',       // Asegura que el ID del enumerador sea un UUID válido
                'exists:enumerators,id', // Asegura que el ID del enumerador exista en la tabla enumerators
            ],
            'sfh_requests_id' => [
                'required',   // El ID de la solicitud es obligatorio
                'exists:sfh_requests,id', // Asegura que el ID de la solicitud exista en la tabla requests
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
            'visit_date.required' => 'La fecha de la visita es obligatoria.',
            'visit_date.date' => 'La fecha de la visita debe ser una fecha válida.',
            'visit_date.after_or_equal' => 'La fecha de la visita no puede ser anterior a hoy.',

            'status.required' => 'El estado de la visita es obligatorio.',
            'status.in' => 'El estado debe ser uno de los siguientes: Visitado, No visitado, No encontrado.',

            'observations.string' => 'Las observaciones deben ser una cadena de texto.',
            'observations.max' => 'Las observaciones no pueden exceder los 1000 caracteres.',

            'enumerator_id.required' => 'El ID del enumerador es obligatorio.',
            'enumerator_id.uuid' => 'El ID del enumerador debe ser un UUID válido.',
            'enumerator_id.exists' => 'El enumerador especificado no existe.',

            'sfh_requests_id.required' => 'El ID de la solicitud es obligatorio.',
            'sfh_requests_id.exists' => 'La solicitud especificada no existe.',
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
            'visit_date' => 'fecha de la visita',
            'status' => 'estado de la visita',
            'observations' => 'observaciones',
            'enumerator_id' => 'ID del enumerador',
            'sfh_requests_id' => 'ID de la solicitud',
        ];
    }
}
