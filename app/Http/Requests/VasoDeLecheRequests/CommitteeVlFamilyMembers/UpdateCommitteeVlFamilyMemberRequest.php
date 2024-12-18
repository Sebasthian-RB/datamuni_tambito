<?php

namespace App\Http\Requests\VasoDeLecheRequests\CommitteeVlFamilyMembers;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para actualizar un registro de miembro familiar en un comité.
 */
class UpdateCommitteeVlFamilyMemberRequest extends FormRequest
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
            'committee_id' => [
                'sometimes',
                'integer',
                'exists:committees,id',
            ],
            'vl_family_member_id' => [
                'sometimes',
                'string',
                'exists:vl_family_members,id',
            ],
            'change_date' => [
                'sometimes',
                'date',
            ],
            'description' => [
                'nullable',
                'string',
                'max:255',
            ],
            'status' => [
                'sometimes',
                'boolean',
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
            'committee_id.exists' => 'El comité seleccionado no existe.',
            'vl_family_member_id.exists' => 'El miembro familiar seleccionado no existe.',
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
            'committee_id' => 'ID del comité',
            'vl_family_member_id' => 'ID del miembro familiar',
            'change_date' => 'fecha de cambio',
            'description' => 'descripción',
            'status' => 'estado',
        ];
    }
}
