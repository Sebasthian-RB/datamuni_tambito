<?php

namespace App\Http\Requests\SisfohRequests\Visits;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para crear una visita.
 * Aquí se definen las reglas de validación para la creación de las visitas.
 */

class StoreVisitRequest extends FormRequest
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
                'required',
                'date',
                'before_or_equal:today', // La fecha no puede ser futura
            ],
            'status' => [
                'required',
                'in:Visitado,No visitado,No encontrado', // Valores válidos para el estado
            ],
            'observations' => [
                'nullable',
                'string',
                'max:255', // Las observaciones no deben superar los 255 caracteres
            ],
            'enumerator_id' => [
                'required',
                'string',
                'size:36', // El ID debe tener exactamente 36 caracteres
                'exists:enumerators,id', // Debe existir en la tabla enumerators
            ],
            'request_id' => [
                'required',
                'integer',
                'exists:requests,id', // Debe existir en la tabla requests
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
            'visit_date.before_or_equal' => 'La fecha de la visita no puede ser futura.',
            'status.required' => 'El estado de la visita es obligatorio.',
            'status.in' => 'El estado de la visita debe ser uno de los siguientes: Visitado, No visitado, No encontrado.',
            'observations.string' => 'Las observaciones deben ser un texto.',
            'observations.max' => 'Las observaciones no pueden tener más de 255 caracteres.',
            'enumerator_id.required' => 'El ID del enumerador es obligatorio.',
            'enumerator_id.string' => 'El ID del enumerador debe ser una cadena de texto.',
            'enumerator_id.size' => 'El ID del enumerador debe tener exactamente 36 caracteres.',
            'enumerator_id.exists' => 'El ID del enumerador no existe en la base de datos.',
            'request_id.required' => 'El ID de la solicitud es obligatorio.',
            'request_id.integer' => 'El ID de la solicitud debe ser un número entero.',
            'request_id.exists' => 'El ID de la solicitud no existe en la base de datos.',
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
            'request_id' => 'ID de la solicitud',
        ];
    }
}
