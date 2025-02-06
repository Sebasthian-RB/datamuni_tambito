<?php

namespace App\Http\Requests\CiamRequests\ElderlyAdults;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para mostrar detalles de un adulto mayor.
 * Permite verificar si el usuario puede visualizar el registro.
 */
class ShowElderlyAdultRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     * Permite el acceso a usuarios autenticados.
     */
    public function authorize(): bool
    {
        return true; // Permitir acceso a cualquier usuario autenticado.
    }

    /**
     * No se necesitan reglas de validación para mostrar detalles.
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * Mensajes personalizados (si se agregan validaciones en el futuro).
     */
    public function messages(): array
    {
        return [];
    }

    /**
     * Personaliza los nombres de los campos en caso de validaciones futuras.
     */
    public function attributes(): array
    {
        return [];
    }
}
