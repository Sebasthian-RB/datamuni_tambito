<?php

namespace App\Http\Requests\CiamRequests\ElderlyAdults;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Form Request para actualizar un adulto mayor.
 * Define las reglas de validación para la edición de registros existentes.
 */
class UpdateElderlyAdultRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     */
    public function authorize(): bool
    {
        return true; // Cambiar a auth()->check() si deseas verificar autenticación
    }

    /**
     * Reglas de validación que se aplican a la solicitud.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $elderlyAdultId = $this->route('elderly_adult');

        return [
            'id' => [
                'required',
                'string',
                'max:36',
                Rule::unique('elderly_adults', 'id')->ignore($elderlyAdultId),
            ],
            'document_type' => [
                'required',
                Rule::in(['DNI', 'Pasaporte', 'Carnet', 'Cedula']),
            ],
            'given_name' => 'required|string|max:50',
            'paternal_last_name' => 'required|string|max:50',
            'maternal_last_name' => 'required|string|max:50',
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

            // **Relaciones foráneas (IDs de otras entidades)**
            'location_id' => 'required|exists:locations,id',
            'public_insurance_id' => 'required|exists:public_insurances,id',
            'private_insurance_id' => 'nullable|exists:private_insurances,id',

            // **Relaciones muchos a muchos (pueden ser opcionales)**
            'guardian_ids' => 'nullable|array',
            'guardian_ids.*' => 'exists:guardians,id',

            'social_program_ids' => 'nullable|array',
            'social_program_ids.*' => 'exists:social_programs,id',
        ];
    }

    /**
     * Mensajes de error personalizados para validaciones específicas.
     */
    public function messages(): array
    {
        return [
            'id.required' => 'El ID del adulto mayor es obligatorio.',
            'id.string' => 'El ID debe ser una cadena de texto.',
            'id.max' => 'El ID no debe exceder los 36 caracteres.',
            'id.unique' => 'El ID ya está registrado.',

            'document_type.required' => 'El tipo de documento es obligatorio.',
            'document_type.in' => 'El tipo de documento debe ser DNI, Pasaporte, Carnet o Cédula.',

            'given_name.required' => 'El nombre es obligatorio.',
            'paternal_last_name.required' => 'El apellido paterno es obligatorio.',
            'maternal_last_name.required' => 'El apellido materno es obligatorio.',
            'birth_date.required' => 'La fecha de nacimiento es obligatoria.',
            'birth_date.before_or_equal' => 'La fecha de nacimiento no puede ser una fecha futura.',
            'birth_date.after_or_equal' => 'La fecha de nacimiento debe ser al menos 120 años atrás.',

            'address.max' => 'La dirección no debe exceder los 255 caracteres.',
            'reference.max' => 'La referencia no debe exceder los 255 caracteres.',
            'sex_type.required' => 'El sexo es obligatorio.',

            'phone_number.max' => 'El número de teléfono no debe exceder los 50 caracteres.',
            'type_of_disability.in' => 'El tipo de discapacidad debe ser Visual, Motriz o Mental.',

            'household_members.integer' => 'El número de miembros del hogar debe ser un número.',
            'household_members.min' => 'Debe haber al menos 1 miembro en el hogar.',

            'permanent_attention.boolean' => 'El campo de atención permanente debe ser un valor booleano.',
            'observation.max' => 'La observación no debe exceder los 500 caracteres.',

            // **Mensajes de error para relaciones foráneas**
            'location_id.required' => 'Debe seleccionar una ubicación.',
            'location_id.exists' => 'La ubicación seleccionada no existe.',
            'public_insurance_id.required' => 'Debe seleccionar un seguro público.',
            'public_insurance_id.exists' => 'El seguro público seleccionado no existe.',
            'private_insurance_id.exists' => 'El seguro privado seleccionado no existe.',

            // **Mensajes de error para relaciones muchos a muchos**
            'guardian_ids.array' => 'La selección de guardianes debe ser un conjunto de valores válidos.',
            'guardian_ids.*.exists' => 'Uno o más guardianes seleccionados no existen en la base de datos.',

            'social_program_ids.array' => 'La selección de programas sociales debe ser un conjunto de valores válidos.',
            'social_program_ids.*.exists' => 'Uno o más programas sociales seleccionados no existen en la base de datos.',
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
            'location_id' => 'ubicación',
            'public_insurance_id' => 'seguro público',
            'private_insurance_id' => 'seguro privado',
            'guardian_ids' => 'guardianes',
            'social_program_ids' => 'programas sociales',
        ];
    }
}
