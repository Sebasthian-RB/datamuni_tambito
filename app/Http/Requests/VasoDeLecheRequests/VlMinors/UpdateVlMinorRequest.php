<?php

namespace App\Http\Requests\VasoDeLecheRequests\Minors;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para actualizar un menor.
 * Aquí se definen las reglas de validación para la actualización de menores.
 */
class UpdateVlMinorRequest extends FormRequest
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
            'identity_document' => [
                'sometimes',
                'string',
                'max:80',
            ],
            'given_name' => [
                'sometimes',
                'string',
                'max:80',
            ],
            'paternal_last_name' => [
                'sometimes',
                'string',
                'max:50',
            ],
            'maternal_last_name' => [
                'sometimes',
                'string',
                'max:50',
            ],
            'birth_date' => [
                'sometimes',
                'date',
            ],
            'sex_type' => [
                'sometimes',
                'boolean',
            ],
            'registration_date' => [
                'sometimes',
                'date',
            ],
            'withdrawal_date' => [
                'nullable',
                'date',
            ],
            'address' => [
                'sometimes',
                'string',
                'max:255',
            ],
            'dwelling_type' => [
                'sometimes',
                'in:Propio,Alquilado',
            ],
            'education_level' => [
                'sometimes',
                'in:Ninguno,Inicial,Primaria,Secundaria,Técnico,Superior',
            ],
            'condition' => [
                'sometimes',
                'in:Gest.,Lact.,Anc.',
            ],
            'disability' => [
                'sometimes',
                'boolean',
            ],
            'vl_family_member_id' => [
                'sometimes',
                'string',
                'exists:vl_family_members,id',
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
            'identity_document.required' => 'El documento de identidad es obligatorio.',
            'vl_family_member_id.exists' => 'El miembro de familia seleccionado no existe.',
            // Otros mensajes personalizados según sea necesario...
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
            'identity_document' => 'documento de identidad',
            'given_name' => 'nombre del menor',
            'paternal_last_name' => 'apellido paterno',
            'maternal_last_name' => 'apellido materno',
            'birth_date' => 'fecha de nacimiento',
            'sex_type' => 'sexo',
            'registration_date' => 'fecha de registro',
            'withdrawal_date' => 'fecha de retiro',
            'address' => 'dirección',
            'dwelling_type' => 'tipo de vivienda',
            'education_level' => 'nivel educativo',
            'condition' => 'condición',
            'disability' => 'discapacidad',
            'vl_family_member_id' => 'miembro de familia relacionado',
        ];
    }
}
