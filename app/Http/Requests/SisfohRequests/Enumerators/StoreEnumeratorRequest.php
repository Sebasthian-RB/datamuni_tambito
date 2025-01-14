<?php

namespace App\Http\Requests\SisfohRequests\Enumerators;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnumeratorRequest extends FormRequest
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
            'given_name' => 'required|string|max:80',
            'paternal_last_name' => 'required|string|max:50',
            'maternal_last_name' => 'required|string|max:50',
            'phone_number' => 'nullable|regex:/^\d{9}$/',
        ];

        // Reglas específicas según el tipo de documento de identidad
        switch ($this->input('identity_document')) {
            case 'DNI':
                $rules['id'] = 'required|string|size:8|unique:enumerators,id';
                break;
            case 'Pasaporte':
                $rules['id'] = 'required|string|max:20|unique:enumerators,id';
                break;
            case 'Cedula':
                $rules['id'] = 'required|string|max:20|unique:enumerators,id';
                break;
            default:
                $rules['id'] = 'required|string|max:50|unique:enumerators,id';
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
            'identity_document.required' => 'El tipo de documento es obligatorio.',
            'identity_document.in' => 'El tipo de documento seleccionado no es válido. Debe ser uno de los siguientes: DNI, Pasaporte, Carnet o Cédula.',
            'given_name.required' => 'El nombre es obligatorio.',
            'given_name.max' => 'El nombre no puede superar los 80 caracteres.',
            'paternal_last_name.required' => 'El apellido paterno es obligatorio.',
            'maternal_last_name.required' => 'El apellido materno es obligatorio.',
            'phone_number.regex' => 'El número de teléfono debe contener exactamente 9 dígitos.',
            'id.required' => 'El campo ID es obligatorio.',
            'id.unique' => 'El ID ya está en uso. Por favor, elija otro.',
            'id.size' => 'El ID debe tener 8 caracteres cuando el tipo de documento es DNI.',
            'id.max' => 'El ID no puede tener más de 20 caracteres.',
        ];
    }
}
