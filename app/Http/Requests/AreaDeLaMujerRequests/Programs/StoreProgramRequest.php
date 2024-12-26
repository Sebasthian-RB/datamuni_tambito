<?php

namespace App\Http\Requests\AreaDeLaMujerRequests\Programs;

use Illuminate\Foundation\Http\FormRequest;

class StoreProgramRequest extends FormRequest
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
     * Reglas de validación para almacenar un nuevo programa.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'description' => 'required|string',
            'program_type' => 'required|string|max:50',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:Pendiente,Finalizado,En proceso,Cancelado',
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
            'name.required' => 'El campo "Nombre" es obligatorio.',
            'name.max' => 'El campo "Nombre" no puede exceder 50 caracteres.',
            'description.required' => 'El campo "Descripción" es obligatorio.',
            'program_type.required' => 'El campo "Tipo de programa" es obligatorio.',
            'program_type.max' => 'El campo "Tipo de programa" no puede exceder 50 caracteres.',
            'start_date.required' => 'La fecha de inicio es obligatoria.',
            'start_date.date' => 'La fecha de inicio debe ser válida.',
            'end_date.date' => 'La fecha de finalización debe ser válida.',
            'end_date.after_or_equal' => 'La fecha de finalización debe ser posterior o igual a la fecha de inicio.',
            'status.required' => 'El campo "Estado" es obligatorio.',
            'status.in' => 'El campo "Estado" no es válido.',
        ];
    }
}
