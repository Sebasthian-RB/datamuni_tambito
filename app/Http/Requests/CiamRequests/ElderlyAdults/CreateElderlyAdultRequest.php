<?php

namespace App\Http\Requests\CiamRequests\ElderlyAdults;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para mostrar el formulario de creación de un adulto mayor.
 * No aplica validaciones actualmente.
 */
class CreateElderlyAdultRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     * Permitir el acceso a cualquier usuario autenticado.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación que se aplican a la solicitud.
     * No se necesitan reglas para mostrar el formulario.
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * Mensajes de error personalizados para validaciones (si se agregan en el futuro).
     */
    public function messages(): array
    {
        return [];
    }

    /**
     * Personaliza los nombres de los atributos (si se agregan reglas en el futuro).
     */
    public function attributes(): array
    {
        return [];
    }
}
