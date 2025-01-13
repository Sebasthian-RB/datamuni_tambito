<?php

namespace App\Http\Requests\SisfohRequests\InstrumentVisits;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para listar instrumentos/visitas.
 * Aquí se define autorizaciones y lógica para manejar accesos.
 */

class IndexInstrumentVisitRequest extends FormRequest
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
            // Mensajes
        ];
    }
}
