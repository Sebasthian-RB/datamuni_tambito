<?php

namespace App\Http\Requests\AreaDeLaMujerRequests\Interventions;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInterventionRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a realizar esta solicitud.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación para actualizar una intervención existente.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'appointment' => 'required|string',
            'derivation' => 'nullable|string',
            'appointment_date' => 'required|date',
        ];
    }
    /**
     * Mensajes personalizados para las reglas de validación.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'appointment.required' => 'El campo "Cita" es obligatorio.',
            'appointment.string' => 'El campo "Cita" debe ser una cadena de texto.',
            'derivation.string' => 'El campo "Derivación" debe ser una cadena de texto.',
            'appointment_date.required' => 'La fecha de la cita es obligatoria.',
            'appointment_date.date' => 'La fecha de la cita debe ser válida.',
        ];
    }
}
