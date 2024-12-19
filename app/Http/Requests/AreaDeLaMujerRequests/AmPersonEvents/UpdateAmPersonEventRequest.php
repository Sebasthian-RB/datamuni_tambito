<?php

namespace App\Http\Requests\AreaDeLaMujerRequests\AmPersonEvents;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request para validar la actualización de un AmPersonEvent.
 */

class UpdateAmPersonEventRequest extends FormRequest
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
     * Reglas de validación para actualizar un registro de AmPersonEvent.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'am_person_id' => 'required|exists:am_people,id', // Validar que la persona exista en la tabla am_people.
            'event_id' => 'required|exists:events,id',       // Validar que el evento exista en la tabla events.
            'status' => 'required|in:Asistió,No Asistió,Justificado', // Validar que el estado sea uno de los permitidos.
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
            'event_id.required' => 'El campo "Evento" es obligatorio.',
            'event_id.exists' => 'El evento seleccionado no existe.',
            'status.required' => 'El campo "Estado" es obligatorio.',
            'status.in' => 'El estado debe ser uno de los siguientes: Asistió, No Asistió o Justificado.',
        ];
    }
}
