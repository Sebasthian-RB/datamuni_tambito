<?php

namespace App\Http\Requests\AreaDeLaMujerRequests\Violences;

use Illuminate\Foundation\Http\FormRequest;

class StoreViolenceRequest extends FormRequest
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
     * Reglas de validación para almacenar un nuevo registro de violencia.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'kind_violence' => 'required|string|max:70',
            'description' => 'required|string',
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
            'kind_violence.required' => 'El tipo de violencia es obligatorio.',
            'kind_violence.string' => 'El tipo de violencia debe ser una cadena de texto.',
            'kind_violence.max' => 'El tipo de violencia no puede exceder los 70 caracteres.',
            'description.required' => 'La descripción es obligatoria.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
        ];
    }
}
