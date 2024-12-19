<?php

namespace App\Http\Requests\AreaDeLaMujerRequests\AmPersonInterventions;

use Illuminate\Foundation\Http\FormRequest;

class StoreAmPersonInterventionsRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a realizar esta solicitud.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Modificar si se aplican políticas de autorización específicas.
    }

    /**
     * Reglas de validación para almacenar una nueva relación.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'am_person_id' => 'required|exists:am_people,id', // Validar que la persona exista.
            'intervention_id' => 'required|exists:interventions,id', // Validar que la intervención exista.
            'status' => 'required|in:Completado,En progreso,Cancelado', // Validar estado permitido.
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
            'am_person_id.required' => 'El campo "Persona" es obligatorio.',
            'am_person_id.exists' => 'La persona seleccionada no existe.',
            'intervention_id.required' => 'El campo "Intervención" es obligatorio.',
            'intervention_id.exists' => 'La intervención seleccionada no existe.',
            'status.required' => 'El campo "Estado" es obligatorio.',
            'status.in' => 'El estado debe ser uno de los siguientes: Completado, En progreso o Cancelado.',
        ];
    }
}
