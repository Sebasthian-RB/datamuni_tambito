<?php

namespace App\Http\Requests\SisfohRequests\Enumerators;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEnumeratorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'string',
                'max:20',
                Rule::unique('enumerators', 'id')->ignore($this->route('enumerator')), // Ignorar el ID actual
            ],
            'identity_document' => 'required|string|in:DNI,Pasaporte,Carnet,Cedula',
            'given_name' => 'required|string|max:80',
            'paternal_last_name' => 'required|string|max:50',
            'maternal_last_name' => 'required|string|max:50',
            'phone_number' => 'nullable|regex:/^\d{9}$/',
        ];
    }

    /**
     * Get the custom validation messages.
     */
    public function messages()
    {
        return [
            'id.required' => 'El campo ID es obligatorio.',
            'id.unique' => 'El ID ya está en uso. Por favor, elija otro.',
            'identity_document.required' => 'Debe seleccionar un tipo de documento.',
            'identity_document.in' => 'El tipo de documento seleccionado no es válido.',
            'given_name.required' => 'El nombre es obligatorio.',
            'given_name.max' => 'El nombre no puede superar los 80 caracteres.',
            'paternal_last_name.required' => 'El apellido paterno es obligatorio.',
            'maternal_last_name.required' => 'El apellido materno es obligatorio.',
            'phone_number.regex' => 'El número de teléfono debe tener exactamente 9 dígitos.',
        ];
    }
}
