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
            'Carnet de Extranjería' => 9, 
            'Pasaporte' => 20, 
            'Otro' => 20, 
            default => 8, 
        };

        return [
            'id' => [
                'required',
                'string',
                $identityDocument == 'Otro' ? 'max:' . $this->maxIdLength : 'min:' . $this->maxIdLength, 
                'max:' . ($identityDocument == 'Otro' ? 20 : $this->maxIdLength), // Para 'Otro' solo max, y para otros documentos min/max igual
                Rule::unique('vl_family_members', 'id')->ignore($this->route('vl_family_member')), // Usar ignore para excluir el ID actual
                'regex:/^' . ($identityDocument == 'Pasaporte' || $identityDocument == 'Otro' ? '[A-Za-z0-9]+' : '\d+') . '$/',  // Alfanumérico para Pasaporte y Otro, numérico solo para otros documentos
            ],
            'identity_document' => [
                'required',
                'string',
                'max:80',
                'regex:/^[A-Za-záéíóúüñÑÜ0-9\s]+$/', // Permitido: letras (con acentos, ñ, ü), números y espacios
            ],
            'given_name' => [
                'required',
                'string',
                'max:80',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s\'-]+$/', // Permite letras, espacios, acentos, ñ y diéresis
            ],
            'paternal_last_name' => [
                'required',
                'string',
                'max:50',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s\'-]+$/', // Permite letras, espacios, acentos, ñ y diéresis
            ],
            'maternal_last_name' => [
                'nullable',
                'string',
                'max:50',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s\'-]+$/', // Permite letras, espacios, acentos, ñ y diéresis
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
        $identityDocument = $this->input('identity_document'); 

        return [
            'id' => [
                'required' => 'El campo ID es obligatorio.',
                'string' => 'El ID debe ser una cadena de texto.',
                'id.min' => 'El ID debe tener al menos ' . $this->maxIdLength . ' caracteres.',
                'id.max' => "El ID no debe exceder los {$this->maxIdLength} caracteres.",
                'unique' => 'El ID ya ha sido registrado, debe ser único.',
                'id.regex' => match ($identityDocument) {
                    'Pasaporte' => 'El ID debe ser alfanumérico.',
                    'Otro' => 'El ID debe ser alfanumérico.',
                    default => 'El ID debe ser un número entero.',
                },
            ],
            
            'identity_document' => [
                'required' => 'El tipo de documento de identidad es obligatorio.',
                'string' => 'El tipo de documento de identidad debe ser una cadena de texto.',
                'max' => 'El tipo de documento de identidad no debe exceder los 80 caracteres.',
                'regex' => 'El documento de identidad solo debe contener letras, números y espacios.',
            ],
        
            'given_name' => [
                'required' => 'El nombre es obligatorio.',
                'string' => 'El nombre debe ser una cadena de texto.',
                'max' => 'El nombre no debe exceder los 80 caracteres.',
                'regex' => 'El nombre solo puede contener letras y espacios.',
            ],
        
            'paternal_last_name' => [
                'required' => 'El apellido paterno es obligatorio.',
                'string' => 'El apellido paterno debe ser una cadena de texto.',
                'max' => 'El apellido paterno no debe exceder los 50 caracteres.',
                'regex' => 'El apellido paterno solo puede contener letras y espacios.',
            ],
        
            'maternal_last_name' => [
                'nullable' => 'El apellido materno es opcional.',
                'string' => 'El apellido materno debe ser una cadena de texto.',
                'max' => 'El apellido materno no debe exceder los 50 caracteres.',
                'regex' => 'El apellido materno solo puede contener letras y espacios.',
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