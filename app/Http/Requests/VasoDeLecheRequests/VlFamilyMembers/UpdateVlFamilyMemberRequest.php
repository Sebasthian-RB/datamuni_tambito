<?php

namespace App\Http\Requests\VasoDeLecheRequests\VlFamilyMembers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Form Request para actualizar un miembro familiar.
 * Aquí se definen las reglas de validación para la actualización de miembros familiares.
 */
class UpdateVlFamilyMemberRequest extends FormRequest
{
    // Propiedad temporal para almacenar el maxIdLength
    private $maxIdLength;

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
        // Se obtiene el tipo de documento de identidad.
        $identityDocument = $this->input('identity_document'); 

        // Definir el tamaño máximo de id utilizando el operador match
        $this->maxIdLength = match ($identityDocument) {
            'DNI' => 8,
            'Carnet de Extranjería' => 20,
            'Otro' => 30,
            default => 8, 
        };

        return [
            'id' => [
                'required',
                'string',
                'max:' . $this->maxIdLength, // Aplica la longitud dinámica para el id
                Rule::unique('vl_family_members', 'id')->ignore($this->route('vl_family_member')), // Usar ignore para excluir el ID actual
            ],
            'identity_document' => [
                'required',
                'string',
                'max:80',
            ],
            'given_name' => [
                'required',
                'string',
                'max:80',
            ],
            'paternal_last_name' => [
                'required',
                'string',
                'max:50',
            ],
            'maternal_last_name' => [
                'required',
                'string',
                'max:50',
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
            'id.required' => 'El número de documento de identidad es obligatorio.',
            'id.unique' => 'El número de documento de identidad ya está registrado.',
            'id.max' => "El número de documento de identidad no debe exceder los {$this->maxIdLength} caracteres.",
            'identity_document.required' => 'El tipo de documento de identidad es obligatorio.',
            'identity_document.max' => 'El tipo de documento de identidad no debe exceder los 80 caracteres.',
            'given_name.required' => 'El nombre es obligatorio.',
            'given_name.max' => 'El nombre no debe exceder los 80 caracteres.',
            'paternal_last_name.required' => 'El apellido paterno es obligatorio.',
            'paternal_last_name.max' => 'El apellido paterno no debe exceder los 50 caracteres.',
            'maternal_last_name.required' => 'El apellido materno es obligatorio.',
            'maternal_last_name.max' => 'El apellido materno no debe exceder los 50 caracteres.',
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
            'id' => 'número de documento de identidad',
            'identity_document' => 'tipo de documento de identidad',
            'given_name' => 'nombre',
            'paternal_last_name' => 'apellido paterno',
            'maternal_last_name' => 'apellido materno',
        ];
    }
}