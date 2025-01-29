<?php

namespace App\Http\Requests\CiamRequests\Locations;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para mostrar el formulario de creación de una ubicación.
 */
class CreateLocationRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para esta acción.
     */
    public function authorize(): bool
    {
        return true; // Permite el acceso a esta acción
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // No hay reglas de validación necesarias para mostrar el formulario
        ];
    }

    /**
     * Mensajes personalizados para errores de validación.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            // No hay mensajes personalizados necesarios en este caso
        ];
    }
}
