<?php

namespace App\Http\Requests\CiamRequests\ElderlyAdults;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Form Request para actualizar un adulto mayor existente.
 */
class UpdateElderlyAdultRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     */
    public function authorize(): bool
    {
        return true; // Permitir acceso a cualquier usuario autorizado.
    }

    protected function prepareForValidation()
    {
        // Convierte el campo type_of_disability a un array si es un JSON
        if ($this->has('type_of_disability') && is_string($this->type_of_disability)) {
            $this->merge([
                'type_of_disability' => json_decode($this->type_of_disability, true),
            ]);
        }

        // Si el campo social_program no está presente en la solicitud, asignar un array vacío
        if (!$this->has('social_program')) {
            $this->merge(['social_program' => []]);
        }
    }

    /**
     * Reglas de validación que se aplican a la solicitud.
     */
    public function rules(): array
    {
        $elderlyAdultId = $this->route('elderly_adult'); // ID del adulto mayor

        return [

            'document_type' => 'required|in:DNI,Pasaporte,Carnet,Cedula',

            'id' => [
                'required',
                'string',
                'max:36',
                Rule::unique('elderly_adults', 'id')->ignore($elderlyAdultId),
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

            'language' => 'required|array|min:1',
            'language.*' => 'in:Español,Quechua,Aimara,Otro',

            'birth_date' => [
                'required',
                'date',
                'before_or_equal:' . now()->subYears(60)->format('Y-m-d'), // No puede ser menor de 60 años
                'after_or_equal:' . now()->subYears(125)->format('Y-m-d'), // No puede ser mayor de 125 años
            ],

            'address' => 'nullable|string|max:255',
            'reference' => 'nullable|string|max:255',

            'phone_number' => [
                'nullable',
                'string',
                'size:9',
                'regex:/^\d{9}$/',
            ],

            'household_members' => ['nullable', 'integer', 'min:1', 'max:20'],

            'guardian_id' => [
                'nullable',
                'exists:guardians,id', // Asegura que el ID exista en la tabla de guardians
            ],

            // Lista de tipos de discapacidades
            'type_of_disability' => 'nullable|array',
            'type_of_disability.*' => 'in:Visual,Auditiva,Motriz,Mental,Del Habla,Otra',

            'permanent_attention' => ['nullable', 'boolean'],

            'public_insurance' => ['nullable', 'string', Rule::in(['SIS', 'ESSALUD'])],

            'private_insurance' => 'nullable|string|max:100',

            // Lista de programas sociales
            'social_program' => 'nullable|array',
            'social_program.*' => 'in:Pensión 65,P.V.L.,Comedor Popular,Otros',

            // Estado de la persona
            'state' => 'required|boolean',

            'observation' => ['sometimes', 'nullable', 'string'],
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
            'language.required' => 'Debe seleccionar al menos un idioma.',
            'language.min' => 'Debe seleccionar al menos un idioma.',
            'language.*.in' => 'El idioma seleccionado no es válido.',
            'phone_number.size' => 'El teléfono debe tener exactamente 9 dígitos.',
            'phone_number.regex' => 'El teléfono solo debe contener números (0-9).',

            'household_members.integer' => 'El número de miembros del hogar debe ser un número entero.',
            'household_members.min' => 'Debe haber al menos 1 miembro en el hogar.',
            'household_members.max' => 'El limite de miembros del hogar es de 20',

            'type_of_disability.in' => 'El tipo de discapacidad seleccionado no es válido.',

            'permanent_attention.boolean' => 'Debe ser verdadero o falso.',
            'state.required' => 'Debe indicar si está activo en CIAM.',

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
            'public_insurance' => 'seguro público',
            'private_insurance' => 'seguro privado',
            'guardian_id' => 'guardia',
            'social_program' => 'programas sociales',
        ];
    }
}
