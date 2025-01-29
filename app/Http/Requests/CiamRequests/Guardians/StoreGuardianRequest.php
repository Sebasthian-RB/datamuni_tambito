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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'string',
                'max:36', // UUID estándar
                'unique:guardians,id', // Garantiza unicidad
            ],
            'document_type' => [
                'required',
                'string',
                Rule::in(['DNI', 'Pasaporte', 'Carnet', 'Cedula']), // Solo valores permitidos
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
                'required',
                'string',
                'max:50',
            ],
            'phone_number' => [
                'nullable', // Opcional
                'string',
                'max:15', // Máximo de 15 caracteres para número de teléfono
                'regex:/^\+?[0-9]*$/', // Solo números y opcionalmente el prefijo "+"
            ],
        ];
    }

    /**
     * Obtener los mensajes de validación personalizados.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'id.required' => 'El ID es obligatorio.',
            'id.string' => 'El ID debe ser una cadena de texto.',
            'id.max' => 'El ID no debe exceder los 36 caracteres.',
            'id.unique' => 'El ID ya está registrado en el sistema.',

            'document_type.required' => 'El tipo de documento es obligatorio.',
            'document_type.string' => 'El tipo de documento debe ser una cadena de texto.',
            'document_type.in' => 'El tipo de documento debe ser uno de los siguientes: DNI, Pasaporte, Carnet o Cedula.',

            'given_name.required' => 'El nombre es obligatorio.',
            'given_name.string' => 'El nombre debe ser una cadena de texto.',
            'given_name.max' => 'El nombre no debe exceder los 50 caracteres.',

            'paternal_last_name.required' => 'El apellido paterno es obligatorio.',
            'paternal_last_name.string' => 'El apellido paterno debe ser una cadena de texto.',
            'paternal_last_name.max' => 'El apellido paterno no debe exceder los 50 caracteres.',

            'maternal_last_name.required' => 'El apellido materno es obligatorio.',
            'maternal_last_name.string' => 'El apellido materno debe ser una cadena de texto.',
            'maternal_last_name.max' => 'El apellido materno no debe exceder los 50 caracteres.',

            'phone_number.string' => 'El número de teléfono debe ser una cadena de texto.',
            'phone_number.max' => 'El número de teléfono no debe exceder los 15 caracteres.',
            'phone_number.regex' => 'El número de teléfono solo puede contener números y un signo "+" opcional.',
        ];
    }

    /**
     * Personaliza los nombres de los campos de la solicitud.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'id' => 'identificador único',
            'document_type' => 'tipo de documento',
            'given_name' => 'nombre',
            'paternal_last_name' => 'apellido paterno',
            'maternal_last_name' => 'apellido materno',
            'phone_number' => 'número de teléfono',
        ];
    }
}
