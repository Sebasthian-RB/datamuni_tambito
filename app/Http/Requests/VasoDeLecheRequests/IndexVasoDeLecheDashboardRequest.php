<?php

namespace App\Http\Requests\VasoDeLecheRequests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para mostrar la página principal de Vaso de Leche.
 */
class IndexVasoDeLecheDashboardRequest extends FormRequest
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
            
        ];
    }

    /**
     * Obtén los mensajes de validación personalizados.
     *
     * @return array
     */
    public function messages()
    {
        return [
            
        ];
    }

    /**
     * Personaliza los nombres de los campos de la solicitud.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            
        ];
    }
}
