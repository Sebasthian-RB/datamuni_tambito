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

            'document_type' => 'required|in:DNI,Pasaporte,Carnet,Cedula',

            'id' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $documentType = request('document_type');
                    if ($documentType === 'DNI' && !preg_match('/^\d{8}$/', $value)) {
                        $fail('El DNI debe tener exactamente 8 dígitos.');
                    } elseif ($documentType === 'Pasaporte' && !preg_match('/^[A-Za-z0-9]{9}$/', $value)) {
                        $fail('El Pasaporte debe tener 9 caracteres alfanuméricos.');
                    } elseif ($documentType === 'Carnet' && !preg_match('/^\d{12}$/', $value)) {
                        $fail('El Carnet debe tener 12 dígitos.');
                    } elseif ($documentType === 'Cedula' && !preg_match('/^\d{10}$/', $value)) {
                        $fail('La Cédula debe tener 10 dígitos.');
                    }
                },
            ],

            'given_name' => [
                'required',
                'string',
                'regex:/^[\pL\s]+$/u', // Solo permite letras y espacios
                'max:100'
            ],
            'paternal_last_name' => [
                'required',
                'string',
                'regex:/^[\pL\s]+$/u', // Solo permite letras y espacios
                'max:100'
            ],
            'maternal_last_name' => [
                'required',
                'string',
                'regex:/^[\pL\s]+$/u', // Solo permite letras y espacios
                'max:100'
            ],

            'sex_type' => ['required', Rule::in(['0', '1'])],

            'language' => 'nullable|array',
            'language.*' => 'in:Español,Quechua,Aimara,Otro',

            'birth_date' => [
                'required',
                'date',
                'before_or_equal:today', // No puede ser una fecha futura
                'after_or_equal:' . now()->subYears(120)->format('Y-m-d'), // No debe tener más de 120 años
            ],

            'address' => 'nullable|string|max:255',
            'reference' => 'nullable|string|max:255',

            'phone_number' => [
                'nullable',
                'regex:/^\d{9}$/',
            ],

            'household_members' => ['nullable', 'integer', 'min:1', 'max:20'],

            // **Guardian opcional**
            'guardian_id' => 'nullable|integer|exists:guardians,id',

            'type_of_disability' => ['nullable', Rule::in(['Visual', 'Motriz', 'Mental'])],

            'permanent_attention' => ['nullable', 'boolean'],

            'public_insurance' => ['nullable', 'string', Rule::in(['SIS', 'ESSALUD'])],


            'private_insurance' => 'nullable|string|max:100',

            'observation' => 'nullable|string|max:500',

            // Estado de la persona en el sistema
            'state' => 'required|boolean', // Activo o Inactivo en CIAM

            // Lista de programas sociales 
            'social_program' => 'nullable|array',
            'social_program.*' => 'in:Pensión 65,P.V.L.,Comedor Popular,Otros',
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
            'sex_type.in' => 'El valor seleccionado para el sexo no es válido.',
            'language.*.in' => 'El idioma seleccionado no es válido.',
            'phone_number.regex' => 'El número de teléfono debe contener exactamente 9 dígitos numéricos.',

            'household_members.integer' => 'El número de miembros del hogar debe ser un número entero.',
            'household_members.min' => 'Debe haber al menos 1 miembro en el hogar.',
            'household_members.max' => 'El limite de miembros del hogar es de 20',
            'type_of_disability.in' => 'El tipo de discapacidad seleccionado no es válido.',
            'permanent_attention.boolean' => 'Debe ser verdadero o falso.',
            'state.required' => 'Debe indicar si está activo o inactivo en CIAM.',

            // **Errores de seguros**
            'public_insurance.in' => 'El seguro público seleccionado no es válido.',
            'private_insurance.max' => 'Máximo 100 caracteres.',

            // **Errores de guardianes**
            'guardian_id.integer' => 'El guardián seleccionado no es válido.',
            'guardian_id.exists' => 'El guardián seleccionado no existe en el sistema.',

            // **Errores de programas sociales**
            'social_program.*.in' => 'El programa social seleccionado no es válido.',
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
            'social_program' => 'programas sociales',
        ];
    }
}
