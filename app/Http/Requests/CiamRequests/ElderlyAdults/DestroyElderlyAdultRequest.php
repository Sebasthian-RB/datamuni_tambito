<?php

namespace App\Http\Requests\CiamRequests\ElderlyAdults;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para la eliminación de un adulto mayor.
 * Verifica si el usuario está autorizado para eliminar el registro.
 */
class DestroyElderlyAdultRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     */
    public function authorize(): bool
    {
        return true; // Permitir acceso a cualquier usuario autorizado.
    }

    /**
     * Reglas de validación que se aplican a la solicitud.
     * En este caso, no se necesitan reglas adicionales.
     */
    public function rules(): array
    {
        return [];
    }
}
