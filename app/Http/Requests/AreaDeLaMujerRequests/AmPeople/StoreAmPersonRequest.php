<?php

namespace App\Http\Requests\AreaDeLaMujerRequests\AmPeople;

use Illuminate\Foundation\Http\FormRequest;

class StoreAmPersonRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'identity_document' => 'required|string|in:DNI,Pasaporte,Carnet,Cedula',
            'given_name' => 'required|string|max:50',
            'paternal_last_name' => 'required|string|max:50',
            'maternal_last_name' => 'required|string|max:50',
            'address' => 'nullable|string|max:255',
            'sex_type' => 'required|boolean',
            'phone_number' => 'nullable|regex:/^\d{9}$/',
            'attendance_date' => 'required|date',
        ];

        // Reglas específicas según el tipo de documento de identidad
        switch ($this->input('identity_document')) {
            case 'DNI':
                $rules['id'] = 'required|string|size:8|unique:am_people,id';
                break;
            case 'Pasaporte':
                $rules['id'] = 'required|string|max:20|unique:am_people,id';
                break;
            case 'Cedula':
                $rules['id'] = 'required|string|max:20|unique:am_people,id';
                break;
            default:
                $rules['id'] = 'required|string|max:50|unique:am_people,id';
                break;
        }

        return $rules;
    }

    /**
     * Obtiene los mensajes de error personalizados para la validación.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'id.required' => 'El campo ID es obligatorio.',
            'id.unique' => 'El ID ya está en uso. Por favor, elija otro.',
            'identity_document.required' => 'Debe seleccionar un tipo de documento.',
            'identity_document.in' => 'El tipo de documento seleccionado no es válido.',
            'phone_number.regex' => 'El número de teléfono debe tener exactamente 9 dígitos.',
        ];
    }
}