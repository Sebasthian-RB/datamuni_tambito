<?php

namespace App\Http\Requests\VasoDeLecheRequests\Sectors;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para actualizar un sector.
 * Aquí se definen las reglas de validación para la actualización de sectores.
 */
class UpdateSectorRequest extends FormRequest
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
                'max:30',
                'regex:/^[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑüÜ]+$/', // Permite letras, números, espacios, acentos y diéresis
            ],
            'description' => [
                'nullable',
                'string',
                'max:1000',
                'regex:/^[a-zA-Z0-9\s.,;:"\'()-áéíóúÁÉÍÓÚñÑüÜ]+$/', // Permite caracteres básicos, acentos, diéresis y otros caracteres especiales
                'not_regex:/<script.*?>.*?<\/script>/i', // Protege contra inyección de scripts
            ],
            'responsible_person' => [
                'required',
                'string',
                'max:50',
                'regex:/^[a-zA-Z\sáéíóúÁÉÍÓÚñÑüÜ]+$/', // Permite letras, espacios, acentos, diéresis
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
            'name' => [
                'required' => 'El nombre es obligatorio.',
                'string' => 'El nombre debe ser una cadena de texto.',
                'max' => 'El nombre no puede tener más de 30 caracteres.',
                'regex' => 'El nombre solo puede contener letras, números, espacios y caracteres especiales como acentos (á, é, í, ó, ú), diéresis (ü) y la ñ.',
            ],
            'description' => [
                'nullable' => 'La descripción es opcional, puede dejarse vacía.',
                'string' => 'La descripción debe ser una cadena de texto.',
                'max' => 'La descripción no puede tener más de 1000 caracteres.',
                'regex' => 'La descripción solo puede contener letras, números, espacios, caracteres especiales como comas, puntos, comillas, paréntesis y acentos (á, é, í, ó, ú), diéresis (ü) y la ñ.',
                'not_regex' => 'La descripción no puede contener código o scripts (por ejemplo, <script>...</script>).',
            ],
            'responsible_person' => [
                'required' => 'El nombre de la persona responsable es obligatorio.',
                'string' => 'El nombre de la persona responsable debe ser una cadena de texto.',
                'max' => 'El nombre de la persona responsable no puede tener más de 50 caracteres.',
                'regex' => 'El nombre de la persona responsable solo puede contener letras, espacios y caracteres especiales como acentos (á, é, í, ó, ú), diéresis (ü) y la ñ.',
            ],
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
            'name' => 'nombre del sector',
            'description' => 'descripción del sector',
            'responsible_person' => 'persona responsable',
        ];
    }
}
