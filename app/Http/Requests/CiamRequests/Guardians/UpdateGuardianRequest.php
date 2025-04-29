<?php

namespace App\Http\Requests\CiamRequests\Guardians;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Form Request para actualizar un guardián existente.
 * Aquí se definen las reglas de validación para actualizar los datos de un guardián.
 */
class UpdateGuardianRequest extends FormRequest
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
        $guardianId = $this->route('guardian'); // Obtener ID del guardián actual

        return [
            'document_type' => 'required|in:DNI,Pasaporte,Carnet,Cedula',
            'id' => [
                'required',
                'string',
                Rule::unique('guardians', 'id')->ignore($guardianId),
                function ($attribute, $value, $fail) {
                    $documentType = $this->input('document_type');

                    if ($documentType === 'DNI') {
                        if (!preg_match('/^\d{8}$/', $value)) {
                            $fail('El DNI debe tener exactamente 8 dígitos numéricos.');
                        }
                    } elseif ($documentType === 'Pasaporte') {
                        if (!preg_match('/^[A-Za-z0-9]{9}$/', $value)) {
                            $fail('El Pasaporte debe tener 9 caracteres alfanuméricos.');
                        }
                    } elseif ($documentType === 'Carnet') {
                        if (!preg_match('/^\d{12}$/', $value)) {
                            $fail('El Carnet debe tener 12 dígitos numéricos.');
                        }
                    } elseif ($documentType === 'Cedula') {
                        if (!preg_match('/^\d{10}$/', $value)) {
                            $fail('La Cédula debe tener 10 dígitos numéricos.');
                        }
                    }
                },
            ],
            'given_name' => [
                'required',
                'string',
                'max:50',
            ],
            'paternal_last_name' => [
                'required',
                'string',
                'max:50',
            ],
            'maternal_last_name' => [
                'nullable',
                'string',
                'max:50',
            ],
            'phone_number' => [
                'nullable',
                'string',
                'size:9', // Exactamente 9 caracteres
                'regex:/^[0-9]{9}$/', // Solo 9 dígitos numéricos
            ],
            'relationship' => [
                'required',
                'string',
                'max:50',
                function ($attribute, $value, $fail) {
                    if ($this->input('relationship') === 'Otro' && empty($value)) {
                        $fail('Debe especificar el valor para "Otro".');
                    }
                },
            ],
        ];
    }

    /**
     * Obtener los mensajes de validación personalizados.
     */
    public function messages(): array
    {
        return [
            'id.required' => 'El número de documento es obligatorio.',
            'id.unique' => 'El número de documento ya está registrado.',
            'document_type.required' => 'El tipo de documento es obligatorio.',
            'document_type.in' => 'El tipo de documento debe ser uno de estos: DNI, Pasaporte, Carnet o Cedula.',
            'given_name.required' => 'El nombre es obligatorio.',
            'given_name.max' => 'El nombre no debe exceder los 50 caracteres.',
            'paternal_last_name.required' => 'El apellido paterno es obligatorio.',
            'paternal_last_name.max' => 'El apellido paterno no debe exceder los 50 caracteres.',
            'maternal_last_name.max' => 'El apellido materno no debe exceder los 50 caracteres.',
            'phone_number.size' => 'El teléfono debe tener exactamente 9 dígitos.',
            'phone_number.regex' => 'El teléfono solo debe contener números (0-9).',
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
            'id' => 'número de documento',
            'document_type' => 'tipo de documento',
            'given_name' => 'nombre',
            'paternal_last_name' => 'apellido paterno',
            'maternal_last_name' => 'apellido materno',
            'phone_number' => 'número de teléfono',
            'relationship' => 'relación con el adulto mayor',
        ];
    }
}
