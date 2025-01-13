<?php

namespace App\Http\Requests\SisfohRequests\SfhDwellings;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para mostrar el formulario de edición de viviendas.
 */

class EditSfhDwellingRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para esta acción.
     */
    public function authorize(): bool
    {
        return true; // Permite el acceso
    }

    /**
     * Obtener los mensajes de validación personalizados.
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
            // Mensajes
        ];
    }
}
