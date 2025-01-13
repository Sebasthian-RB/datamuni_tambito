<?php

namespace App\Http\Requests\SisfohRequests\Instruments;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Form Request para actualizar un instrumento.
 * Aquí se definen las reglas de validación para la actualización de instrumentos.
 */

class UpdateInstrumentRequest extends FormRequest
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
            'name_instruments' => [
                'required',
                'string',
                'max:100',
                Rule::unique('instruments', 'name_instruments')->ignore($this->route('instrument')), // Ignora el nombre actual al verificar unicidad
            ],
            'type_instruments' => [
                'required',
                'string',
                'max:50',
            ],
            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ];
    }

    /**
     * Obtiene los mensajes de validación personalizados.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name_instruments.required' => 'El nombre del instrumento es obligatorio.',
            'name_instruments.string' => 'El nombre del instrumento debe ser una cadena de texto.',
            'name_instruments.max' => 'El nombre del instrumento no debe exceder los 100 caracteres.',
            'name_instruments.unique' => 'El nombre del instrumento ya está en uso.',
            'type_instruments.required' => 'El tipo de instrumento es obligatorio.',
            'type_instruments.string' => 'El tipo de instrumento debe ser una cadena de texto.',
            'type_instruments.max' => 'El tipo de instrumento no debe exceder los 50 caracteres.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.max' => 'La descripción no debe exceder los 1000 caracteres.',
        ];
    }

    /**
     * Personaliza los nombres de los campos de la solicitud.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name_instruments' => 'nombre del instrumento',
            'type_instruments' => 'tipo de instrumento',
            'description' => 'descripción',
        ];
    }
}
