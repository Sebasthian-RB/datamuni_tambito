<?php

namespace App\Http\Requests\VasoDeLecheRequests\VlMinors;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para listar menores de edad.
 * Aquí se define autorizaciones y lógica para manejar accesos.
 */
class IndexVlMinorRequest extends FormRequest
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
            'search_id' => 'nullable|regex:/^\d+$/'
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
            'search_id.regex' => 'Solo se permiten números enteros en la búsqueda'
        ];
    }
}
