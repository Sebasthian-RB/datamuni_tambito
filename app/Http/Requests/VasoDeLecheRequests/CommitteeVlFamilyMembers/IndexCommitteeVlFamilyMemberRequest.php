<?php

namespace App\Http\Requests\VasoDeLecheRequests\CommitteeVlFamilyMembers;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para listar comités/familiares.
 * Aquí se define autorizaciones y lógica para manejar accesos.
 */
class IndexCommitteeVlFamilyMemberRequest extends FormRequest
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
            //
        ];
    }

    /**
     * Obtener los mensajes de validación personalizados.
     *
     * @return array
     */
    public function messages()
    {
        return [
            // Mensajes para eliminar un comité/familiar
        ];
    }
}
