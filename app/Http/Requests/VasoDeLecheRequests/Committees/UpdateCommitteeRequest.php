<?php

namespace App\Http\Requests\VasoDeLecheRequests\Committees;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para actualizar un comité.
 * Aquí se definen las reglas de validación para la actualización de comités.
 */
class UpdateCommitteeRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:100',
                'regex:/^[a-zA-Z0-9\s]+$/', // Solo letras, números y espacios
            ],
            'president' => [
                'required',
                'string',
                'max:100',
                'regex:/^[a-zA-Z\s]+$/', // Solo letras y espacios
            ],
            'urban_core' => [
                'required',
                'string',
                'max:100',
                'regex:/^[a-zA-Z0-9\s]+$/', // Solo letras, números y espacios
            ],
            'beneficiaries_count' => [
                'required',
                'integer',
                'min:1', // Al menos 1 beneficiario
            ],
            'sector_id' => [
                'required',
                'exists:sectors,id', // Debe existir en la tabla sectors
            ],
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
            'name.required' => 'El nombre del comité es obligatorio.',
            'name.max' => 'El nombre no debe exceder los 100 caracteres.',
            'name.regex' => 'El nombre solo puede contener letras, números y espacios.',
            'president.required' => 'El nombre del presidente(a) es obligatorio.',
            'president.max' => 'El nombre del presidente(a) no debe exceder los 100 caracteres.',
            'president.regex' => 'El nombre del presidente(a) solo puede contener letras y espacios.',
            'urban_core.required' => 'El núcleo urbano es obligatorio.',
            'urban_core.max' => 'El núcleo urbano no debe exceder los 100 caracteres.',
            'urban_core.regex' => 'El núcleo urbano solo puede contener letras, números y espacios.',
            'beneficiaries_count.required' => 'El número de beneficiarios es obligatorio.',
            'beneficiaries_count.integer' => 'El número de beneficiarios debe ser un número entero.',
            'beneficiaries_count.min' => 'El número de beneficiarios debe ser al menos 1.',
            'sector_id.required' => 'El sector es obligatorio.',
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
            'president' => 'presidente(a)',
            'urban_core' => 'núcleo urbano',
            'beneficiaries_count' => 'número de beneficiarios',
            'sector_id' => 'sector',
        ];
    }
}
