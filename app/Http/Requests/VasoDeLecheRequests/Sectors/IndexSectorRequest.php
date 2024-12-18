<?php

namespace App\Http\Requests\VasoDeLecheRequests\Sectors;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para listar productos.
 * Aquí se define autorizaciones y lógica para manejar accesos.
 */
class IndexSectorRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para esta acción.
     */
    public function authorize(): bool
    {
        return true;
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
            // Mensajes
        ];
    }
}
