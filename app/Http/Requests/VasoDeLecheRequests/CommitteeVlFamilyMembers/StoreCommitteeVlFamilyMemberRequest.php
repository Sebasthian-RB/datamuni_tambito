<?php

namespace App\Http\Requests\VasoDeLecheRequests\CommitteeVlFamilyMembers;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommitteeVlFamilyMemberRequest extends FormRequest
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
            'committee_id' => [
                'required',
                'string',
                'exists:committees,id',
            ],
            'vl_family_member_id' => [
                'required',
                'string',
                'exists:vl_family_members,id',
            ],
            'change_date' => [
                'required',
                'date',
            ],
            'description' => [
                'nullable',
                'string',
                'max:255',
            ],
            'status' => [
                'required',
                'boolean',
            ],
        ];
    }

    /**
     * Mensajes de validación personalizados.
     */
    public function messages(): array
    {
        return [
            // Validaciones para 'committee_id'
            'committee_id.required' => 'El ID del comité es obligatorio.',
            'committee_id.integer' => 'El ID del comité debe ser un número entero.',
            'committee_id.exists' => 'El comité seleccionado no existe.',

            // Validaciones para 'vl_family_member_id'
            'vl_family_member_id.required' => 'El ID del miembro familiar es obligatorio.',
            'vl_family_member_id.integer' => 'El ID del miembro familiar debe ser un número entero.',
            'vl_family_member_id.exists' => 'El miembro familiar seleccionado no existe.',

            // Validaciones para 'change_date'
            'change_date.required' => 'La fecha de cambio es obligatoria.',
            'change_date.date' => 'La fecha de cambio debe ser una fecha válida.',

            // Validaciones para 'description'
            'description.nullable' => 'La descripción no es obligatoria.',
            'description.string' => 'La descripción debe ser un texto válido.',
            'description.max' => 'La descripción no puede tener más de 255 caracteres.',

            // Validaciones para 'status'
            'status.required' => 'El estado es obligatorio.',
            'status.boolean' => 'El estado debe ser un valor booleano.',
        ];
    }
}
