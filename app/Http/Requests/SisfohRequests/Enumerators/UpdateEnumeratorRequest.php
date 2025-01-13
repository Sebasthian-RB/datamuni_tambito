<?php

namespace App\Http\Requests\SisfohRequests\Enumerators;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Form Request para actualizar un encuestador.
 * Aquí se definen las reglas de validación para la actualización de encuestadores.
 */
class UpdateEnumeratorRequest extends FormRequest
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
                'size:36', // El ID debe tener exactamente 36 caracteres
                Rule::unique('enumerators', 'id')->ignore($this->route('enumerator')), // Ignorar el ID actual
            ],
            'identity_document' => [
                'required',
                'string',
                Rule::in(['DNI', 'Pasaporte', 'Carnet', 'Cedula']), // Validar solo los valores permitidos
            ],
            'given_name' => [
                'required',
                'string',
                'max:80',
                'regex:/^[a-zA-Z\s]+$/', // Solo letras y espacios
            ],
            'paternal_last_name' => [
                'required',
                'string',
                'max:50',
                'regex:/^[a-zA-Z\s]+$/', // Solo letras y espacios
            ],
            'maternal_last_name' => [
                'required',
                'string',
                'max:50',
                'regex:/^[a-zA-Z\s]+$/', // Solo letras y espacios
            ],
            'phone_number' => [
                'nullable',
                'string',
                'max:15',
                'regex:/^\+?\d{7,15}$/', // Validar formato de número telefónico
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
            'id.required' => 'El ID del encuestador es obligatorio.',
            'id.size' => 'El ID del encuestador debe tener exactamente 36 caracteres.',
            'id.unique' => 'El ID del encuestador ya está en uso.',
            'identity_document.required' => 'El tipo de documento de identidad es obligatorio.',
            'identity_document.in' => 'El tipo de documento de identidad no es válido.',
            'given_name.required' => 'El nombre del encuestador es obligatorio.',
            'given_name.max' => 'El nombre del encuestador no debe exceder los 80 caracteres.',
            'given_name.regex' => 'El nombre del encuestador solo puede contener letras y espacios.',
            'paternal_last_name.required' => 'El apellido paterno del encuestador es obligatorio.',
            'paternal_last_name.max' => 'El apellido paterno no debe exceder los 50 caracteres.',
            'paternal_last_name.regex' => 'El apellido paterno solo puede contener letras y espacios.',
            'maternal_last_name.required' => 'El apellido materno del encuestador es obligatorio.',
            'maternal_last_name.max' => 'El apellido materno no debe exceder los 50 caracteres.',
            'maternal_last_name.regex' => 'El apellido materno solo puede contener letras y espacios.',
            'phone_number.max' => 'El número telefónico no debe exceder los 15 caracteres.',
            'phone_number.regex' => 'El número telefónico debe ser válido.',
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
            'id' => 'ID del encuestador',
            'identity_document' => 'documento de identidad',
            'given_name' => 'nombre',
            'paternal_last_name' => 'apellido paterno',
            'maternal_last_name' => 'apellido materno',
            'phone_number' => 'número de teléfono',
        ];
    }
}
