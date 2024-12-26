<?php

namespace App\Http\Requests\AreaDeLaMujerRequests\Events;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a realizar esta solicitud.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Cambiar según las políticas de autorización.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'description' => 'required|string',
            'place' => 'required|string|max:150',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:Pendiente,Finalizado,En proceso,Cancelado',
            'program_id' => 'required|exists:programs,id',
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
            'name.required' => 'El nombre del evento es obligatorio.',
            'name.max' => 'El nombre no puede tener más de 50 caracteres.',
            'description.required' => 'La descripción del evento es obligatoria.',
            'place.required' => 'El lugar del evento es obligatorio.',
            'place.max' => 'El lugar no puede tener más de 150 caracteres.',
            'start_date.required' => 'La fecha de inicio es obligatoria.',
            'start_date.date' => 'La fecha de inicio debe ser una fecha válida.',
            'end_date.required' => 'La fecha de finalización es obligatoria.',
            'end_date.date' => 'La fecha de finalización debe ser una fecha válida.',
            'end_date.after_or_equal' => 'La fecha de finalización debe ser igual o posterior a la fecha de inicio.',
            'status.required' => 'El estado del evento es obligatorio.',
            'status.in' => 'El estado debe ser uno de los siguientes: Pendiente, Finalizado, En proceso, Cancelado.',
            'program_id.required' => 'El programa asociado es obligatorio.',
            'program_id.exists' => 'El programa seleccionado no existe.',
        ];
    }
}
