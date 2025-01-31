<?php

namespace App\Http\Requests\CiamRequests\Guardians;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Form Request para almacenar un nuevo guardián.
 */
class StoreGuardianRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para esta acción.
     */
    public function authorize(): bool
    {
        return true; // Permite el acceso
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     */
    public function rules(): array
    {
        return [
            'document_type' => [
                'required',
                'string',
                Rule::in(['DNI', 'Pasaporte', 'Carnet', 'Cedula']), // Solo valores permitidos
            ],
            'id' => [
                'required',
                'string',
                Rule::unique('guardians', 'id'), // Garantiza unicidad
                function ($attribute, $value, $fail) {
                    $documentType = $this->input('document_type');

                    if ($documentType === 'DNI' && !preg_match('/^\d{8}$/', $value)) {
                        return $fail('El DNI debe tener exactamente 8 dígitos numéricos.');
                    }

                    if ($documentType === 'Pasaporte' && !preg_match('/^[a-zA-Z0-9]{1,20}$/', $value)) {
                        return $fail('El Pasaporte debe tener máximo 20 caracteres alfanuméricos.');
                    }

                    if ($documentType === 'Carnet' && !preg_match('/^[a-zA-Z0-9]{1,20}$/', $value)) {
                        return $fail('El Carnet debe tener máximo 20 caracteres alfanuméricos.');
                    }

                    if ($documentType === 'Cedula' && !preg_match('/^\d{10}$/', $value)) {
                        return $fail('La Cédula debe tener exactamente 10 dígitos numéricos.');
                    }
                },
            ],
            'given_name' => 'required|string|max:50',
            'paternal_last_name' => 'required|string|max:50',
            'maternal_last_name' => 'nullable|string|max:50',
            'phone_number' => [
                'nullable',
                'string',
                'max:15',
                'regex:/^\+?[0-9]*$/', // Solo números y opcionalmente el prefijo "+"
            ],
            'relationship' => 'required|string|max:50',
        ];
    }

    /**
     * Obtener los mensajes de validación personalizados.
     */
    public function messages(): array
    {
        return [
            'document_type.required' => 'El tipo de documento es obligatorio.',
            'document_type.in' => 'El tipo de documento debe ser DNI, Pasaporte, Carnet o Cédula.',

            'id.required' => 'El número de documento es obligatorio.',
            'id.string' => 'El número de documento debe ser una cadena de texto.',
            'id.unique' => 'El número de documento ya está registrado en el sistema.',

            'given_name.required' => 'El nombre es obligatorio.',
            'paternal_last_name.required' => 'El apellido paterno es obligatorio.',
            'maternal_last_name.max' => 'El apellido materno no debe exceder los 50 caracteres.',

            'phone_number.max' => 'El número de teléfono no debe exceder los 15 caracteres.',
            'phone_number.regex' => 'El número de teléfono solo puede contener números y un signo "+" opcional.',

            'relationship.required' => 'La relación con el adulto mayor es obligatoria.',
            'relationship.max' => 'La relación no debe exceder los 50 caracteres.',
        ];
    }

    /**
     * Personaliza los nombres de los campos de la solicitud.
     */
    public function attributes(): array
    {
        return [
            'document_type' => 'tipo de documento',
            'id' => 'número de documento',
            'given_name' => 'nombre',
            'paternal_last_name' => 'apellido paterno',
            'maternal_last_name' => 'apellido materno',
            'phone_number' => 'número de teléfono',
            'relationship' => 'relación con el adulto mayor',
        ];
    }
}
