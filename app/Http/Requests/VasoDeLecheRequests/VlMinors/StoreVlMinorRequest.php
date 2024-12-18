<?php

namespace App\Http\Requests\VasoDeLecheRequests\Minors;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para crear un menor.
 * Aquí se definen las reglas de validación para la creación de menores.
 */
class StoreVlMinorRequest extends FormRequest
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
                'max:255',
                'unique:vl_minors,id',
            ],
            'identity_document' => [
                'required',
                'string',
                'max:80',
            ],
            'given_name' => [
                'required',
                'string',
                'max:80',
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
            'birth_date' => [
                'required',
                'date',
            ],
            'sex_type' => [
                'required',
                'boolean',
            ],
            'registration_date' => [
                'required',
                'date',
            ],
            'withdrawal_date' => [
                'nullable',
                'date',
            ],
            'address' => [
                'required',
                'string',
                'max:255',
            ],
            'dwelling_type' => [
                'required',
                'in:Propio,Alquilado',
            ],
            'education_level' => [
                'required',
                'in:Ninguno,Inicial,Primaria,Secundaria,Técnico,Superior',
            ],
            'condition' => [
                'required',
                'in:Gest.,Lact.,Anc.',
            ],
            'disability' => [
                'required',
                'boolean',
            ],
            'vl_family_member_id' => [
                'required',
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
            'id.required' => 'El campo ID es obligatorio.',
            'id.unique' => 'El ID ya está registrado en el sistema.',
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
            'id' => 'ID del menor',
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
