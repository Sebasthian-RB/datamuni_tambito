<?php

namespace App\Http\Requests\VasoDeLecheRequests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para mostrar la página principal de Vaso de Leche.
 */
class IndexVasoDeLecheRequest extends FormRequest
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
            // Filtro de Nombre del Comité
            'name' => 'nullable|string|min:3|max:150|regex:/^[a-zA-Z0-9\s\-\.,!?\(\)áéíóúÁÉÍÓÚüÜ]+$/',

            // Filtro de Presidente
            'president' => 'nullable|string|max:255|regex:/^[a-zA-Z\s]+$/',

            // Filtro de Núcleo Urbano
            'urban_core' => 'nullable|in:Urbano,Rural',

            // Filtro de Número de Beneficiarios
            'beneficiaries_count' => 'nullable|integer|min:1',

            // Filtro de Sector
            'sector_id' => 'nullable|exists:sectors,id',
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
            'name.string' => 'El nombre del comité debe ser una cadena de texto válida.',
            'name.regex' => 'El nombre contiene caracteres no permitidos.',
            'president.string' => 'El nombre del presidente debe ser una cadena de texto válida.',
            'president.regex' => 'El nombre del presidente solo puede contener letras y espacios.',
            'urban_core.in' => 'El núcleo urbano debe ser "Urbano" o "Rural".',
            'beneficiaries_count.integer' => 'El número de beneficiarios debe ser un número entero.',
            'beneficiaries_count.min' => 'El número de beneficiarios debe ser al menos 1.',
            'sector_id.exists' => 'El sector seleccionado no es válido.',
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
            'name' => 'nombre del comité',
            'president' => 'nombre del presidente',
            'urban_core' => 'núcleo urbano',
            'beneficiaries_count' => 'número de beneficiarios',
            'sector_id' => 'sector',
        ];
    }
}
