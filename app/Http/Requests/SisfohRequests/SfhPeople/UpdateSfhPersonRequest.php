<?php

namespace App\Http\Requests\SisfohRequests\SfhPeople;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Form Request para actualizar una persona.
 * Aquí se definen las reglas de validación para la actualización de la persona.
 */

class UpdateSfhPersonRequest extends FormRequest
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
                'size:36', // Debe tener exactamente 36 caracteres
                'exists:sfh_people,id', // Verifica que exista en la tabla sfh_people
            ],
            'identity_document' => [
                'required',
                'string',
                Rule::in(['DNI', 'Pasaporte', 'Carnet', 'Cedula']), // Solo estas opciones
            ],
            'given_name' => [
                'required',
                'string',
                'max:80', // Máximo 80 caracteres
            ],
            'paternal_last_name' => [
                'required',
                'string',
                'max:50', // Máximo 50 caracteres
            ],
            'maternal_last_name' => [
                'required',
                'string',
                'max:50', // Máximo 50 caracteres
            ],
            'marital_status' => [
                'nullable',
                'string',
                Rule::in(['Soltero(a)', 'Casado(a)', 'Divorciado(a)', 'Viudo(a)']), // Solo estas opciones
            ],
            'birth_date' => [
                'nullable',
                'date', // Verifica que sea una fecha válida
            ],
            'sex_type' => [
                'required',
                'boolean', // 0 para femenino, 1 para masculino
            ],
            'phone_number' => [
                'nullable',
                'string',
                'max:15', // Teléfono puede ser hasta 15 caracteres
            ],
            'nationality' => [
                'nullable',
                'string',
                'max:100', // Máximo 100 caracteres
            ],
            'degree' => [
                'required',
                'string',
                Rule::in([
                    'INICIAL', 'NINGUNO_NIVEL_LETRADO', 'PRIMARIA COMPLETA', 'PRIMARIA-1ER GRADO', 'PRIMARIA-2DO GRADO',
                    'PRIMARIA-3ER GRADO', 'PRIMARIA-4TO GRADO', 'PRIMARIA-5TO GRADO', 'PRIMARIA-6TO GRADO', 'PRIMARIA INCOMPLETA',
                    'SECUNDARIA COMPLETA', 'SECUNDARIA-1ER AÑO', 'SECUNDARIA-2DO AÑO', 'SECUNDARIA-3ER AÑO', 'SECUNDARIA-4TO AÑO',
                    'SECUNDARIA-5TO AÑO', 'SECUNDARIA INCOMPLETA', 'SUPERIOR COMPLETA', 'SUPERIOR-1ER AÑO', 'SUPERIOR-2DO AÑO',
                    'SUPERIOR-3ER AÑO', 'SUPERIOR-4TO AÑO', 'SUPERIOR-5TO AÑO', 'SUPERIOR-6TO AÑO', 'SUPERIOR-7MO AÑO',
                    'SUPERIOR-8VO AÑO', 'SUPERIOR INCOMPLETA', 'ILETRADO/SIN INSTRUCCION', 'TECNICA COMPLETA', 'TECNICA-1ER AÑO',
                    'TECNICA-2DO AÑO', 'TECNICA-3ER AÑO', 'TECNICA-4TO AÑO', 'TECNICA-5TO AÑO', 'TECNICA IMCOMPLETA', 'EDUCACION ESPECIAL'
                ]), // Solo estas opciones
            ],
            'occupation' => [
                'nullable',
                'string',
                'max:100', // Máximo 100 caracteres
            ],
            'sfh_category' => [
                'required',
                'string',
                Rule::in(['No pobre', 'Pobre', 'Pobre extremo']), // Solo estas opciones
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
            'id.required' => 'El ID de la persona es obligatorio.',
            'id.string' => 'El ID debe ser una cadena de texto.',
            'id.size' => 'El ID debe tener exactamente 36 caracteres.',
            'id.exists' => 'La persona especificada no existe.',

            'identity_document.required' => 'El documento de identidad es obligatorio.',
            'identity_document.string' => 'El tipo de documento de identidad debe ser una cadena de texto.',
            'identity_document.in' => 'El tipo de documento de identidad debe ser uno de los siguientes: DNI, Pasaporte, Carnet, Cedula.',

            'given_name.required' => 'El nombre es obligatorio.',
            'given_name.string' => 'El nombre debe ser una cadena de texto.',
            'given_name.max' => 'El nombre no puede tener más de 80 caracteres.',

            'paternal_last_name.required' => 'El apellido paterno es obligatorio.',
            'paternal_last_name.string' => 'El apellido paterno debe ser una cadena de texto.',
            'paternal_last_name.max' => 'El apellido paterno no puede tener más de 50 caracteres.',

            'maternal_last_name.required' => 'El apellido materno es obligatorio.',
            'maternal_last_name.string' => 'El apellido materno debe ser una cadena de texto.',
            'maternal_last_name.max' => 'El apellido materno no puede tener más de 50 caracteres.',

            'marital_status.nullable' => 'El estado civil es opcional.',
            'marital_status.string' => 'El estado civil debe ser una cadena de texto.',
            'marital_status.in' => 'El estado civil debe ser uno de los siguientes: Soltero(a), Casado(a), Divorciado(a), Viudo(a).',

            'birth_date.nullable' => 'La fecha de nacimiento es opcional.',
            'birth_date.date' => 'La fecha de nacimiento debe ser una fecha válida.',

            'sex_type.required' => 'El tipo de sexo es obligatorio.',
            'sex_type.boolean' => 'El tipo de sexo debe ser un valor booleano (0 para femenino, 1 para masculino).',

            'phone_number.nullable' => 'El número de teléfono es opcional.',
            'phone_number.string' => 'El número de teléfono debe ser una cadena de texto.',
            'phone_number.max' => 'El número de teléfono no puede tener más de 15 caracteres.',

            'nationality.nullable' => 'La nacionalidad es opcional.',
            'nationality.string' => 'La nacionalidad debe ser una cadena de texto.',
            'nationality.max' => 'La nacionalidad no puede tener más de 100 caracteres.',

            'degree.required' => 'El grado académico es obligatorio.',
            'degree.string' => 'El grado académico debe ser una cadena de texto.',
            'degree.in' => 'El grado académico debe ser uno de los siguientes: INICIAL, NINGUNO_NIVEL_LETRADO, PRIMARIA COMPLETA, etc.',

            'occupation.nullable' => 'La ocupación es opcional.',
            'occupation.string' => 'La ocupación debe ser una cadena de texto.',
            'occupation.max' => 'La ocupación no puede tener más de 100 caracteres.',

            'sfh_category.required' => 'La categoría SISFOH es obligatoria.',
            'sfh_category.string' => 'La categoría SISFOH debe ser una cadena de texto.',
            'sfh_category.in' => 'La categoría SISFOH debe ser una de las siguientes: No pobre, Pobre, Pobre extremo.',
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
            'id' => 'ID de la persona',
            'identity_document' => 'documento de identidad',
            'given_name' => 'primer nombre',
            'paternal_last_name' => 'apellido paterno',
            'maternal_last_name' => 'apellido materno',
            'marital_status' => 'estado civil',
            'birth_date' => 'fecha de nacimiento',
            'sex_type' => 'tipo de sexo',
            'phone_number' => 'número de teléfono',
            'nationality' => 'nacionalidad',
            'degree' => 'grado académico',
            'occupation' => 'ocupación',
            'sfh_category' => 'categoría SISFOH',
        ];
    }
}
