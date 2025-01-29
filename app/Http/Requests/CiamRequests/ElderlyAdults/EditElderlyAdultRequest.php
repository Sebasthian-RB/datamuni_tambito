<?php

namespace App\Http\Requests\CiamRequests\ElderlyAdults;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para acceder al formulario de edición de un adulto mayor.
 * Solo verifica si el usuario tiene permisos para editar el registro.
 */
class EditElderlyAdultRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     */
    public function authorize(): bool
    {
        return true; // Se puede cambiar a auth()->check() si se requiere autenticación
    }

    /**
     * No se aplican reglas de validación, ya que solo se accede al formulario de edición.
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * Mensajes personalizados para validaciones específicas (vacío en este caso).
     */
    public function messages(): array
    {
        return [];
    }
}
