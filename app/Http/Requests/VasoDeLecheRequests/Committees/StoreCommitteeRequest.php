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
     * Obtiene las reglas de validación que se aplican a la solicitud.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'string',
                'unique:committees,id', //El id debe ser unico 
                'regex:/^\d+$/', // El id debe ser un número entero
            ],

            'name' => [
                'required',
                'string',
                'min:3',
                'max:150',
                'regex:/^[a-zA-Z0-9\s\-\.,!?\(\)áéíóúÁÉÍÓÚüÜ]+$/', // Permite letras, números, espacios, guiones, comas, puntos, signos de exclamación, preguntas y paréntesis
            ],

            'president_paternal_surname' => [
                'required',
                'string',
                'max:50',
                'regex:/^[a-zA-Z\s]+$/', // Solo letras y espacios
            ],

            'president_maternal_surname' => [
                'nullable',
                'string',
                'max:50',
                'regex:/^[a-zA-Z\s]+$/', // Solo letras y espacios
            ],

            'president_given_name' => [
                'required',
                'string',
                'max:80',
                'regex:/^[a-zA-Z\s]+$/', // Solo letras y espacios
            ],

            'urban_core' => [
                'required',
                'string',
                'max:100',
                'regex:/^[a-zA-Z0-9\s]+$/', // Solo letras, números y espacios
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
            'id.required' => 'El número de comité es obligatorio.',
            'id.unique' => 'El número de comité ya está en uso.',
            'id.regex' => 'El número de comité debe ser un número entero.',
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto válida.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'name.max' => 'El nombre no puede tener más de 150 caracteres.',
            'name.regex' => 'El nombre contiene caracteres no permitidos. Solo se permiten letras, números, espacios, guiones, comas, puntos, signos de exclamación, signos de interrogación y paréntesis.',
            'president_paternal_surname.required' => 'El apellido paterno del presidente(a) es obligatorio.',
            'president_paternal_surname.string' => 'El apellido paterno debe ser una cadena de texto válida.',
            'president_paternal_surname.max' => 'El apellido paterno no debe exceder los 50 caracteres.',
            'president_paternal_surname.regex' => 'El apellido paterno solo puede contener letras y espacios.',
            'president_maternal_surname.nullable' => 'El apellido materno es opcional.',
            'president_maternal_surname.string' => 'El apellido materno debe ser una cadena de texto válida.',
            'president_maternal_surname.max' => 'El apellido materno no debe exceder los 50 caracteres.',
            'president_maternal_surname.regex' => 'El apellido materno solo puede contener letras y espacios.',
            'president_given_name.required' => 'El nombre del presidente(a) es obligatorio.',
            'president_given_name.string' => 'El nombre del presidente(a) debe ser una cadena de texto válida.',
            'president_given_name.max' => 'El nombre del presidente(a) no debe exceder los 80 caracteres.',
            'president_given_name.regex' => 'El nombre del presidente(a) solo puede contener letras y espacios.',
            'urban_core.required' => 'El núcleo urbano es obligatorio.',
            'urban_core.max' => 'El núcleo urbano no debe exceder los 100 caracteres.',
            'urban_core.regex' => 'El núcleo urbano solo puede contener letras, números y espacios.',
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
            'id' => 'Número de comité',
            'name' => 'nombre del comité',
            'president_paternal_surname' => 'apellido paterno del presidente(a)',
            'president_maternal_surname' => 'apellido materno del presidente(a)',
            'president_given_name' => 'nombres del presidente(a)',
            'urban_core' => 'núcleo urbano',
            'sector_id' => 'sector',
        ];
    }
}
