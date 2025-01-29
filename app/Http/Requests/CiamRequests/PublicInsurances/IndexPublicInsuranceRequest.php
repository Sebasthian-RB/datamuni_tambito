<?php

namespace App\Http\Requests\CiamRequests\PublicInsurances;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para listar seguros públicos.
 */
class IndexPublicInsuranceRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     */
    public function authorize(): bool
    {
        return true; // Permitir acceso a cualquier usuario autorizado.
    }

    /**
     * No se necesitan reglas de validación para listar.
     */
    public function rules(): array
    {
        return [];
    }
}
