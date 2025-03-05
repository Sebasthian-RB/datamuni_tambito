<?php

namespace App\Http\Requests\VasoDeLecheRequests\VlFamilyMembers;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para crear un miembro familiar.
 * Aquí se definen las reglas de validación para la creación de miembros familiares.
 */
class StoreVlFamilyMemberRequest extends FormRequest
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
                'unique:vl_family_members,id', //El id debe ser único
                'regex:/^\d+$/', // El id debe ser un número entero
            ],
            'identity_document' => [
                'required',
                'string',
                'max:80',
                'in:DNI,Carnet de Extranjería,Otro',
            ],
            'given_name' => [
                'required',
                'string',
                'max:80',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/', // Permite letras, espacios, acentos, ñ y diéresis
            ],
            'paternal_last_name' => [
                'required',
                'string',
                'max:50',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/', // Permite letras, espacios, acentos, ñ y diéresis
            ],
            'maternal_last_name' => [
                'nullable',
                'string',
                'max:50',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/', // Permite letras, espacios, acentos, ñ y diéresis
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
            'id' => [
                'required' => 'El campo ID es obligatorio.',
                'string' => 'El ID debe ser una cadena de texto.',
                'max' => 'El ID no debe exceder los ' . $this->maxIdLength . ' caracteres.',
                'unique' => 'El ID ya ha sido registrado, debe ser único.',
                'regex' => 'El ID debe contener solo números.',
            ],
            
            'identity_document' => [
                'required' => 'El tipo de documento de identidad es obligatorio.',
                'string' => 'El tipo de documento de identidad debe ser una cadena de texto.',
                'max' => 'El tipo de documento de identidad no debe exceder los 80 caracteres.',
                'in' => 'El tipo de documento de identidad debe ser uno de los siguientes: DNI, Carnet de Extranjería, Otro.',
            ],
        
            'given_name' => [
                'required' => 'El nombre es obligatorio.',
                'string' => 'El nombre debe ser una cadena de texto.',
                'max' => 'El nombre no debe exceder los 80 caracteres.',
                'regex' => 'El nombre solo puede contener letras, espacios, acentos, ñ y diéresis.',
            ],
        
            'paternal_last_name' => [
                'required' => 'El apellido paterno es obligatorio.',
                'string' => 'El apellido paterno debe ser una cadena de texto.',
                'max' => 'El apellido paterno no debe exceder los 50 caracteres.',
                'regex' => 'El apellido paterno solo puede contener letras, espacios, acentos, ñ y diéresis.',
            ],
        
            'maternal_last_name' => [
                'nullable' => 'El apellido materno es opcional.',
                'string' => 'El apellido materno debe ser una cadena de texto.',
                'max' => 'El apellido materno no debe exceder los 50 caracteres.',
                'regex' => 'El apellido materno solo puede contener letras, espacios, acentos, ñ y diéresis.',
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
            'id' => 'número de documento de identidad',
            'identity_document' => 'tipo de documento de identidad',
            'given_name' => 'nombre',
            'paternal_last_name' => 'apellido paterno',
            'maternal_last_name' => 'apellido materno',
        ];
    }
}
