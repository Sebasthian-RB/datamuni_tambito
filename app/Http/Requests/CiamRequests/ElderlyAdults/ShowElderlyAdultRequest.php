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
     * Aquí se permite el acceso sin restricciones adicionales.
     */
    public function authorize(): bool
    {
        return true; // Permitir acceso a cualquier usuario autorizado.
    }

    /**
     * No se necesitan reglas de validación para mostrar detalles.
     */
    public function rules(): array
    {
        return [];
    }
}
