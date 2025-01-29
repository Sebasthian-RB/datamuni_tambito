<?php

namespace App\Http\Requests\CiamRequests\Locations;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para mostrar los detalles de una ubicación.
 */
class ShowLocationRequest extends FormRequest
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
            // No se requieren reglas para mostrar una ubicación
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
            // No se necesitan mensajes personalizados para este caso
        ];
    }
}
