<?php

namespace App\Http\Requests\VasoDeLecheRequests\VlMinors;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Form Request para almacenar un nuevo menor.
 * Aquí se definen las reglas de validación para crear un nuevo menor.
 */
class StoreVlMinorRequest extends FormRequest
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
            'CNV' => 12,
            default => 8, 
        };

        return [
            'id' => [
                'required',
                'string',
                'min:' . $this->maxIdLength, 
                'max:' . $this->maxIdLength, // Aplica la longitud dinámica para el id
                'unique:vl_minors,id', //El id debe ser único
                'regex:/^\d+$/', // El id debe ser un número entero
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
                'regex:/^[A-Za-záéíóúüñÑÜ\s\'-]+$/', // Permitido: letras (con acentos, ñ, ü) y espacios
            ],
            'paternal_last_name' => [
                'required',
                'string',
                'max:50',
                'regex:/^[A-Za-záéíóúüñÑÜ\s\'-]+$/', // Permitido: letras (con acentos, ñ, ü) y espacios
            ],
            'maternal_last_name' => [
                'nullable', // Permitido nulo
                'string',
                'max:50',
                'regex:/^[A-Za-záéíóúüñÑÜ\s\'-]+$/', // Permitido: letras (con acentos, ñ, ü) y espacios
            ],
            'birth_date' => [
                'required',
                'date',
                'before_or_equal:today', // La fecha de nacimiento debe ser antes o igual al día de hoy.
                'after_or_equal:' . now()->subYears(120)->toDateString(), // Asegura que la fecha no sea mayor a 120 años atrás.
            ],
            'sex_type' => [
                'required',
                'boolean',
            ],
            'registration_date' => [
                'required',
                'date',
            ],
            'withdrawal_date' => [
                'nullable',
                'date',
                // Validación de que la fecha de retiro es posterior a la fecha de registro, si es proporcionada
                function ($attribute, $value, $fail) {
                    // Si la fecha de retiro está presente, se valida que sea posterior a la fecha de registro
                    if ($value && $this->input('registration_date') && $value < $this->input('registration_date')) {
                        $fail('La fecha de retiro debe ser posterior a la fecha de registro.');
                    }
                },
            ],
            'address' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑüÜ\s\.,\'\-\/\(\)\[\]:;]+$/'
            ],
            'dwelling_type' => [
                'nullable',
                'in:Propio,Alquilado',
            ],
            'education_level' => [
                'nullable',
                'in:Ninguno,Inicial,Primaria,Secundaria,Técnico,Superior',
            ],
            'condition' => [
                'required',
                'in:Gest.,Lact.,Anc.',
            ],
            'disability' => [
                'nullable',
                'boolean',
            ],
            'status' => [
                'required',
                'boolean',
            ],
            'vl_family_member_id' => [
                'required',
                'string',
                'exists:vl_family_members,id',
            ],
            'kinship' => [
                'required',
                'string',
                'max:100',
                'in:Hijo(a),Socio(a)',
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
            'id.required' => 'El campo ID es obligatorio.',
            'id.string' => 'El ID debe ser una cadena de texto.',
            'id.min' => 'El ID debe tener al menos ' . $this->maxIdLength . ' caracteres.',
            'id.max' => "El ID no debe exceder los {$this->maxIdLength} caracteres.",
            'id.unique' => 'El ID ya está registrado en el sistema.',
            'id.regex' => 'El ID debe ser un número entero.',
    
            'identity_document.required' => 'El documento de identidad es obligatorio.',
            'identity_document.string' => 'El documento de identidad debe ser una cadena de texto.',
            'identity_document.max' => 'El documento de identidad no debe exceder los 80 caracteres.',
            'identity_document.regex' => 'El documento de identidad solo debe contener letras, números y espacios.',
    
            'given_name.required' => 'El nombre del menor es obligatorio.',
            'given_name.string' => 'El nombre del menor debe ser una cadena de texto.',
            'given_name.max' => 'El nombre del menor no debe exceder los 80 caracteres.',
            'given_name.regex' => 'El nombre del menor solo debe contener letras, espacios, apóstrofes y guiones.',
    
            'paternal_last_name.required' => 'El apellido paterno es obligatorio.',
            'paternal_last_name.string' => 'El apellido paterno debe ser una cadena de texto.',
            'paternal_last_name.max' => 'El apellido paterno no debe exceder los 50 caracteres.',
            'paternal_last_name.regex' => 'El apellido paterno solo debe contener letras, espacios, apóstrofes y guiones.',
    
            'maternal_last_name.required' => 'El apellido materno es obligatorio.',
            'maternal_last_name.string' => 'El apellido materno debe ser una cadena de texto.',
            'maternal_last_name.max' => 'El apellido materno no debe exceder los 50 caracteres.',
            'maternal_last_name.regex' => 'El apellido materno solo debe contener letras, espacios, apóstrofes y guiones.',
    
            'birth_date.required' => 'La fecha de nacimiento es obligatoria.',
            'birth_date.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'birth_date.before_or_equal' => 'La fecha de nacimiento no puede ser una fecha futura.',
            'birth_date.after_or_equal' => 'La fecha de nacimiento debe ser al menos 120 años atrás.',
    
            'sex_type.required' => 'El sexo es obligatorio.',
            'sex_type.boolean' => 'El sexo debe ser un valor booleano (verdadero o falso).',
    
            'registration_date.required' => 'La fecha de registro es obligatoria.',
            'registration_date.date' => 'La fecha de registro debe ser una fecha válida.',
    
            'withdrawal_date.date' => 'La fecha de retiro debe ser una fecha válida.',
            'withdrawal_date.after_or_equal' => 'La fecha de retiro debe ser posterior a la fecha de registro.',
    
            'address.required' => 'La dirección es obligatoria.',
            'address.string' => 'La dirección debe ser una cadena de texto.',
            'address.max' => 'La dirección no debe exceder los 255 caracteres.',
            'address.regex' => 'El campo solo puede contener letras (mayúsculas y minúsculas) del alfabeto español, números, espacios, y los siguientes caracteres especiales: punto, coma, apóstrofe, guion, barra, paréntesis, corchetes, dos puntos y punto y coma.',

            'dwelling_type.required' => 'El tipo de vivienda es obligatorio.',
            'dwelling_type.in' => 'El tipo de vivienda debe ser "Propio" o "Alquilado".',
    
            'education_level.nullable' => 'El nivel educativo es opcional.',
            'education_level.in' => 'El nivel educativo debe ser uno de los siguientes: Ninguno, Inicial, Primaria, Secundaria, Técnico, Superior.',
    
            'condition.required' => 'La condición es obligatoria.',
            'condition.in' => 'La condición debe ser una de las siguientes: Gest., Lact., Anc.',
    
            'disability.required' => 'El campo discapacidad es obligatorio.',
            'disability.boolean' => 'El campo discapacidad debe ser un valor booleano (verdadero o falso).',
    
            'status.required' => 'El estado es obligatorio.',
            'status.boolean' => 'El estado debe ser un valor booleano (verdadero o falso).',
    
            'vl_family_member_id.required' => 'El miembro de familia relacionado es obligatorio.',
            'vl_family_member_id.string' => 'El ID del miembro de familia debe ser una cadena de texto.',
            'vl_family_member_id.exists' => 'El miembro de familia seleccionado no existe en el sistema.',
    
            'kinship.required' => 'El parentesco con el familiar es obligatorio.',
            'kinship.string' => 'El parentesco con el familiar debe ser una cadena de texto.',
            'kinship.max' => 'El parentesco con el familiar no debe exceder los 100 caracteres.',
            'kinship.in' => 'El parentesco debe ser uno de los siguientes: Hijo(a), Socio(a).',
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
            'identity_document' => 'documento de identidad',
            'given_name' => 'nombre del menor',
            'paternal_last_name' => 'apellido paterno',
            'maternal_last_name' => 'apellido materno',
            'birth_date' => 'fecha de nacimiento',
            'sex_type' => 'sexo',
            'registration_date' => 'fecha de registro',
            'withdrawal_date' => 'fecha de retiro',
            'address' => 'dirección',
            'dwelling_type' => 'tipo de vivienda',
            'education_level' => 'nivel educativo',
            'condition' => 'condición',
            'disability' => 'discapacidad',
            'status' => 'estado',
            'vl_family_member_id' => 'miembro de familia relacionado',
            'kinship' => 'parentesco',
        ];
    }
}
