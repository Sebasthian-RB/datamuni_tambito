<?php

namespace App\Http\Requests\SisfohRequests\SfhPeople;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para listar personas.
 * Aquí se define autorizaciones y lógica para manejar accesos.
 */

class IndexSfhPersonRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para esta acción.
     */
    public function authorize(): bool
    {
        return true; // Permite el acceso
    }

    /**
     * Obtiene las reglas de validación que se aplican a las solicitudes.
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
