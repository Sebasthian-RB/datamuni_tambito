<?php

namespace App\Http\Requests\CiamRequests\Guardians;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Form Request para actualizar un guardián existente.
 * Aquí se definen las reglas de validación para actualizar los datos de un guardián.
 */
class UpdateGuardianRequest extends FormRequest
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
                'max:36', // ID debe tener 36 caracteres
                Rule::unique('guardians', 'id')->ignore($this->route('guardian')), // Excluye el ID actual de la validación de unicidad
            ],
            'document_type' => [
                'required',
                'string',
                'in:DNI,Pasaporte,Carnet,Cedula', // Solo estos tipos de documento
            ],
            'given_name' => [
                'required',
                'string',
                'max:50', // Longitud máxima de 50 caracteres
            ],
            'paternal_last_name' => [
                'required',
                'string',
                'max:50', // Longitud máxima de 50 caracteres
            ],
            'maternal_last_name' => [
                'required',
                'string',
                'max:50', // Longitud máxima de 50 caracteres
            ],
            'phone_number' => [
                'nullable',
                'string',
                'max:50', // Longitud máxima de 50 caracteres, opcional
            ],
        ];
    }

    /**
     * Obtener los mensajes de validación personalizados.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'id.required' => 'El ID es obligatorio.',
            'id.unique' => 'El ID debe ser único.',
            'document_type.required' => 'El tipo de documento es obligatorio.',
            'document_type.in' => 'El tipo de documento debe ser uno de estos: DNI, Pasaporte, Carnet, Cedula.',
            'given_name.required' => 'El nombre es obligatorio.',
            'given_name.max' => 'El nombre no debe exceder los 50 caracteres.',
            'paternal_last_name.required' => 'El apellido paterno es obligatorio.',
            'paternal_last_name.max' => 'El apellido paterno no debe exceder los 50 caracteres.',
            'maternal_last_name.required' => 'El apellido materno es obligatorio.',
            'maternal_last_name.max' => 'El apellido materno no debe exceder los 50 caracteres.',
            'phone_number.max' => 'El número de teléfono no debe exceder los 50 caracteres.',
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
            'id' => 'ID',
            'document_type' => 'tipo de documento',
            'given_name' => 'nombre',
            'paternal_last_name' => 'apellido paterno',
            'maternal_last_name' => 'apellido materno',
            'phone_number' => 'número de teléfono',
        ];
    }
}
