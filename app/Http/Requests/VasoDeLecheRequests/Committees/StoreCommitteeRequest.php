<?php

namespace App\Http\Requests\VasoDeLecheRequests\Committees;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para crear un comité.
 * Aquí se definen las reglas de validación para la creación de comités.
 */
class StoreCommitteeRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para esta acción.
     */
    public function authorize(): bool
    {
        return true; // Permite el acceso
    }

    /**
     * Prepara los datos de entrada antes de realizar la validación.
     * En este caso, se normaliza el campo 'id' eliminando los ceros a la izquierda.
     *
     * Este método se ejecuta antes de que se realicen las reglas de validación.
     * Usamos este método para asegurar que el campo 'id' se procese adecuadamente
     * (en este caso, eliminando ceros a la izquierda) antes de la validación y almacenamiento en la base de datos.
     *
     * @return void
     */
    public function prepareForValidation()
    {
        // Normalizar el ID eliminando ceros a la izquierda
        $this->merge([
            'id' => ltrim($this->input('id'), '0') // 'ltrim' elimina los ceros a la izquierda del ID
        ]);
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'committee_number' => [
                'required',
                'string',
                'max:10',
                'regex:/^\d+$/', // El id debe ser un número entero
            ],

            'name' => [
                'required',
                'string',
                'min:3',
                'max:150',
                'regex:/^[a-zA-Z0-9\s\-\_\.\',:áéíóúÁÉÍÓÚüÜ]+$/', // Permite letras, números, espacios, guiones, subguiones, comillas simples, dobles, comas, puntos y dos puntos
            ],

            'president' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\sáéíóúÁÉÍÓÚñÑüÜ\'-]+$/', // Solo letras del alfabeto español y espacios
            ],

            'urban_core' => [
                'required',
                'string',
                'max:100',
                'regex:/^[a-zA-Z\sáéíóúÁÉÍÓÚñÑüÜ]+$/', // Solo letras del alfabeto español y espacios
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
            'committee_number' => [
                'required' => 'El número de comité es obligatorio.',
                'string' => 'El número de comité debe ser una cadena de texto.',
                'max' => 'El número de comité debe ser máximo de 10 dígitos.',
                'regex' => 'El número de comité solo puede contener números enteros.',
            ],
        
            'name' => [
                'required' => 'El nombre es obligatorio.',
                'string' => 'El nombre debe ser una cadena de texto.',
                'min' => 'El nombre debe tener al menos 3 caracteres.',
                'max' => 'El nombre no puede tener más de 150 caracteres.',
                'regex' => 'El nombre del comité solo puede contener letras, números, espacios, guiones, subguiones, comillas simples, dobles, comas, puntos y dos puntos.',            ],
        
            'president' => [
                'required' => 'El nombre del presidente es obligatorio.',
                'string' => 'El nombre del presidente debe ser una cadena de texto.',
                'max' => 'El nombre del presidente no puede tener más de 255 caracteres.',
                'regex' => 'El nombre del presidente solo puede contener letras y espacios.',
            ],
        
            'urban_core' => [
                'required' => 'El núcleo urbano es obligatorio.',
                'string' => 'El núcleo urbano debe ser una cadena de texto.',
                'max' => 'El núcleo urbano no puede tener más de 100 caracteres.',
                'regex' => 'El núcleo urbano solo puede contener letras y espacios.',
            ],
        
            'sector_id' => [
                'required' => 'El sector es obligatorio.',
                'exists' => 'El sector seleccionado no existe.',
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
            'committee_number' => 'Número de comité',
            'name' => 'nombre del comité',
            'president' => 'nombre completo del presidente(a)',
            'urban_core' => 'núcleo urbano',
            'sector_id' => 'sector',
        ];
    }
}
