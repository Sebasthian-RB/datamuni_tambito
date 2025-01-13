<?php

namespace App\Http\Requests\SisfohRequests\InstrumentVisits;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para crear un instrumento/visita.
 * Aquí se definen las reglas de validación para la creación de los instrumentos/visita.
 */

class StoreInstrumentVisitRequest extends FormRequest
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
            'application_date' => [
                'required',
                'date',
                'before_or_equal:today', // La fecha debe ser hoy o anterior
            ],
            'descriptions' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'instrument_id' => [
                'required',
                'integer',
                'exists:instruments,id', // Debe existir en la tabla instruments
            ],
            'visit_id' => [
                'required',
                'integer',
                'exists:visits,id', // Debe existir en la tabla visits
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
            'application_date.required' => 'La fecha de aplicación es obligatoria.',
            'application_date.date' => 'La fecha de aplicación debe ser una fecha válida.',
            'application_date.before_or_equal' => 'La fecha de aplicación no puede ser futura.',
            'descriptions.string' => 'Las descripciones deben ser una cadena de texto.',
            'descriptions.max' => 'Las descripciones no deben exceder los 1000 caracteres.',
            'instrument_id.required' => 'El ID del instrumento es obligatorio.',
            'instrument_id.integer' => 'El ID del instrumento debe ser un número entero.',
            'instrument_id.exists' => 'El instrumento especificado no existe.',
            'visit_id.required' => 'El ID de la visita es obligatorio.',
            'visit_id.integer' => 'El ID de la visita debe ser un número entero.',
            'visit_id.exists' => 'La visita especificada no existe.',
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
            'application_date' => 'fecha de aplicación',
            'descriptions' => 'descripciones',
            'instrument_id' => 'ID del instrumento',
            'visit_id' => 'ID de la visita',
        ];
    }
}
