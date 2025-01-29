<?php

namespace App\Http\Requests\CiamRequests\ElderlyAdults;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para la creación de un adulto mayor.
 * Define las reglas de validación para crear un nuevo registro.
 */
class CreateElderlyAdultRequest extends FormRequest
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
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * Mensajes de error personalizados para validaciones específicas.
     */
    public function messages(): array
    {
        return [];
    }

    /**
     * Nombres personalizados para los atributos validados.
     */
    public function attributes(): array
    {
        return [];
    }
}
