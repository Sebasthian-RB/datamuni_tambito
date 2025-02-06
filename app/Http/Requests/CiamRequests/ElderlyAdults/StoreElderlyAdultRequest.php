<?php

namespace App\Http\Requests\CiamRequests\ElderlyAdults;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Form Request para almacenar un nuevo adulto mayor.
 */
class StoreElderlyAdultRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     */
    public function authorize(): bool
    {
        return true; // Permitir acceso a cualquier usuario autorizado.
    }

    /**
     * Reglas de validación que se aplican a la solicitud.
     */
    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'string',
                'max:36',
                Rule::unique('elderly_adults', 'id'),
            ],
            'document_type' => [
                'required',
                Rule::in(['DNI', 'Pasaporte', 'Carnet', 'Cedula']),
            ],
            'given_name' => 'required|string|max:50',
            'paternal_last_name' => 'required|string|max:50',
            'maternal_last_name' => 'nullable|string|max:50',
            'birth_date' => [
                'required',
                'date',
                'before_or_equal:today',
                'after_or_equal:' . now()->subYears(120)->toDateString(),
            ],
            'address' => 'nullable|string|max:255',
            'reference' => 'nullable|string|max:255',
            'sex_type' => 'required|boolean',
            'phone_number' => 'nullable|string|max:50',
            'type_of_disability' => [
                'nullable',
                Rule::in(['Visual', 'Motriz', 'Mental']),
            ],
            'household_members' => 'nullable|integer|min:1',
            'permanent_attention' => 'nullable|boolean',
            'observation' => 'nullable|string|max:500',
            'state' => 'required|boolean', // Activo o no en CIAM

            // **Ubicación (departamento, provincia, distrito)**
            'department' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'district' => 'required|string|max:100',

            // **Seguro público y privado**
            'public_insurance' => 'nullable|string|max:100',
            'private_insurance' => 'nullable|string|max:100',

            // **Guardian opcional**
            'guardian_id' => 'nullable|string|exists:guardians,id',

            // **Lista de programas sociales (array de strings)**
            'social_programs' => 'nullable|array',
            'social_programs.*' => 'string|max:100',
        ];
    }

    /**
     * Mensajes de error personalizados.
     */
    public function messages(): array
    {
        return [
            'id.required' => 'El ID del adulto mayor es obligatorio.',
            'id.unique' => 'El ID ya está registrado.',

            'document_type.required' => 'El tipo de documento es obligatorio.',
            'document_type.in' => 'Debe ser DNI, Pasaporte, Carnet o Cédula.',

            'given_name.required' => 'El nombre es obligatorio.',
            'paternal_last_name.required' => 'El apellido paterno es obligatorio.',
            'birth_date.required' => 'La fecha de nacimiento es obligatoria.',
            'birth_date.before_or_equal' => 'No puede ser una fecha futura.',
            'birth_date.after_or_equal' => 'Debe ser menor de 120 años.',

            'address.max' => 'Máximo 255 caracteres.',
            'reference.max' => 'Máximo 255 caracteres.',
            'sex_type.required' => 'El sexo es obligatorio.',
            'phone_number.max' => 'Máximo 50 caracteres.',

            'type_of_disability.in' => 'Debe ser Visual, Motriz o Mental.',
            'household_members.min' => 'Debe haber al menos 1 miembro en el hogar.',

            'permanent_attention.boolean' => 'Debe ser verdadero o falso.',
            'state.required' => 'Debe indicar si está activo en CIAM.',

            // **Errores de ubicación**
            'department.required' => 'El departamento es obligatorio.',
            'province.required' => 'La provincia es obligatoria.',
            'district.required' => 'El distrito es obligatorio.',

            // **Errores de seguros**
            'public_insurance.max' => 'Máximo 100 caracteres.',
            'private_insurance.max' => 'Máximo 100 caracteres.',

            // **Errores de guardianes**
            'guardian_id.exists' => 'El guardián seleccionado no existe.',

            // **Errores de programas sociales**
            'social_programs.array' => 'Debe ser una lista de valores válidos.',
            'social_programs.*.string' => 'Cada programa social debe ser un texto.',
            'social_programs.*.max' => 'El nombre del programa social no debe exceder los 100 caracteres.',
        ];
    }

    /**
     * Personaliza los nombres de los campos.
     */
    public function attributes(): array
    {
        return [
            'id' => 'ID del adulto mayor',
            'document_type' => 'tipo de documento',
            'given_name' => 'nombre',
            'paternal_last_name' => 'apellido paterno',
            'maternal_last_name' => 'apellido materno',
            'birth_date' => 'fecha de nacimiento',
            'address' => 'dirección',
            'reference' => 'referencia',
            'sex_type' => 'sexo',
            'phone_number' => 'número de teléfono',
            'type_of_disability' => 'tipo de discapacidad',
            'household_members' => 'miembros del hogar',
            'permanent_attention' => 'atención permanente',
            'observation' => 'observación',
            'state' => 'estado en CIAM',
            'department' => 'departamento',
            'province' => 'provincia',
            'district' => 'distrito',
            'public_insurance' => 'seguro público',
            'private_insurance' => 'seguro privado',
            'guardian_id' => 'guardia',
            'social_programs' => 'programas sociales',
        ];
    }
}
