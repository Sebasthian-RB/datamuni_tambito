<?php

namespace App\Http\Requests\VasoDeLecheRequests\Committees;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para listar comités.
 * Aquí se define autorizaciones y lógica para manejar accesos.
 */
class IndexCommitteeRequest extends FormRequest
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
            'search_name' => 'nullable|string|max:100'
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
            'search_name.max' => 'La búsqueda no debe exceder los 100 caracteres'
        ];
    }
}
