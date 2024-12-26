<?php

namespace App\Http\Requests\AreaDeLaMujerRequests\AmPersonViolences;

use Illuminate\Foundation\Http\FormRequest;

class StoreAmPersonViolenceRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'am_person_id' => 'required|exists:am_people,id', // Validar que la persona exista.
            'violence_id' => 'required|exists:violences,id', // Validar que el tipo de violencia exista.
            'registration_date' => 'required|date', // Validar que sea una fecha válida.
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
            'violence_id.required' => 'El campo "Violencia" es obligatorio.',
            'violence_id.exists' => 'El tipo de violencia seleccionado no existe.',
            'registration_date.required' => 'El campo "Fecha de registro" es obligatorio.',
            'registration_date.date' => 'El campo "Fecha de registro" debe ser una fecha válida.',
        ];
    }
}
