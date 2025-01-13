<?php

namespace App\Http\Requests\SisfohRequests\Enumerators;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para crear un encuestador.
 * Aquí se definen las reglas de validación para la creación de los encuestadores.
 */

class StoreEnumeratorRequest extends FormRequest
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
                'size:36', // ID debe tener exactamente 36 caracteres (UUID)
                'unique:enumerators,id', // Debe ser único en la tabla enumerators
            ],
            'identity_document' => [
                'required',
                'string',
                'in:DNI,Pasaporte,Carnet,Cedula', // Solo permite los valores especificados
            ],
            'given_name' => [
                'required',
                'string',
                'max:80',
                'regex:/^[a-zA-ZÁÉÍÓÚÑáéíóúñ\s]+$/', // Solo letras y espacios (soporta acentos y ñ)
            ],
            'paternal_last_name' => [
                'required',
                'string',
                'max:50',
                'regex:/^[a-zA-ZÁÉÍÓÚÑáéíóúñ\s]+$/', // Solo letras y espacios
            ],
            'maternal_last_name' => [
                'required',
                'string',
                'max:50',
                'regex:/^[a-zA-ZÁÉÍÓÚÑáéíóúñ\s]+$/', // Solo letras y espacios
            ],
            'phone_number' => [
                'nullable',
                'string',
                'regex:/^\+?[0-9]{7,15}$/', // Número de teléfono opcional con formato internacional
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
            'id.required' => 'El ID es obligatorio.',
            'id.size' => 'El ID debe tener exactamente 36 caracteres.',
            'id.unique' => 'El ID ya está en uso.',
            'identity_document.required' => 'El tipo de documento de identidad es obligatorio.',
            'identity_document.in' => 'El tipo de documento debe ser DNI, Pasaporte, Carnet o Cedula.',
            'given_name.required' => 'El nombre es obligatorio.',
            'given_name.max' => 'El nombre no debe exceder los 80 caracteres.',
            'given_name.regex' => 'El nombre solo puede contener letras y espacios.',
            'paternal_last_name.required' => 'El apellido paterno es obligatorio.',
            'paternal_last_name.max' => 'El apellido paterno no debe exceder los 50 caracteres.',
            'paternal_last_name.regex' => 'El apellido paterno solo puede contener letras y espacios.',
            'maternal_last_name.required' => 'El apellido materno es obligatorio.',
            'maternal_last_name.max' => 'El apellido materno no debe exceder los 50 caracteres.',
            'maternal_last_name.regex' => 'El apellido materno solo puede contener letras y espacios.',
            'phone_number.regex' => 'El número de teléfono debe tener entre 7 y 15 dígitos y puede incluir un prefijo internacional.',
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
            'id' => 'identificador único',
            'identity_document' => 'documento de identidad',
            'given_name' => 'nombre',
            'paternal_last_name' => 'apellido paterno',
            'maternal_last_name' => 'apellido materno',
            'phone_number' => 'número de teléfono',
        ];
    }
}
