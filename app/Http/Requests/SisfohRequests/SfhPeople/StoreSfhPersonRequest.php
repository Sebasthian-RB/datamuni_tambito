<?php

namespace App\Http\Requests\SisfohRequests\SfhPeople;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para crear una persona.
 * Aquí se definen las reglas de validación para la creación de las personas.
 */

class StoreSfhPersonRequest extends FormRequest
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
            'id' => 'required|string|size:36|unique:sfh_people,id', // El ID debe tener 36 caracteres y ser único en la tabla sfh_people
            'identity_document' => 'required|in:DNI,Pasaporte,Carnet,Cedula', // Solo estos tipos de documento son permitidos
            'given_name' => 'required|string|max:80', // El nombre no puede exceder los 80 caracteres
            'paternal_last_name' => 'required|string|max:50', // El apellido paterno no puede exceder los 50 caracteres
            'maternal_last_name' => 'required|string|max:50', // El apellido materno no puede exceder los 50 caracteres
            'marital_status' => 'nullable|in:Soltero(a),Casado(a),Divorciado(a),Viudo(a)', // Estado civil con opciones limitadas
            'birth_date' => 'nullable|date|before:today', // La fecha de nacimiento debe ser anterior al día de hoy
            'sex_type' => 'required|boolean', // El sexo debe ser un valor booleano (0 o 1)
            'phone_number' => 'nullable|string|regex:/^[0-9]{9}$/', // El teléfono debe tener 9 dígitos
            'nationality' => 'nullable|string|max:100', // La nacionalidad no puede exceder los 100 caracteres
            'degree' => 'required|in:INICIAL,NINGUNO_NIVEL_LETRADO,PRIMARIA COMPLETA,PRIMARIA-1ER GRADO,PRIMARIA-2DO GRADO,PRIMARIA-3ER GRADO,PRIMARIA-4TO GRADO,PRIMARIA-5TO GRADO,PRIMARIA-6TO GRADO,PRIMARIA INCOMPLETA,SECUNDARIA COMPLETA,SECUNDARIA-1ER AÑO,SECUNDARIA-2DO AÑO,SECUNDARIA-3ER AÑO,SECUNDARIA-4TO AÑO,SECUNDARIA-5TO AÑO,SECUNDARIA INCOMPLETA,SUPERIOR COMPLETA,SUPERIOR-1ER AÑO,SUPERIOR-2DO AÑO,SUPERIOR-3ER AÑO,SUPERIOR-4TO AÑO,SUPERIOR-5TO AÑO,SUPERIOR-6TO AÑO,SUPERIOR-7MO AÑO,SUPERIOR-8VO AÑO,SUPERIOR INCOMPLETA,ILETRADO/SIN INSTRUCCION,TECNICA COMPLETA,TECNICA-1ER AÑO,TECNICA-2DO AÑO,TECNICA-3ER AÑO,TECNICA-4TO AÑO,TECNICA-5TO AÑO,TECNICA IMCOMPLETA,EDUCACION ESPECIAL', // Grado académico con valores posibles
            'occupation' => 'nullable|string|max:100', // Ocupación con longitud máxima de 100 caracteres
            'sfh_category' => 'required|in:No pobre,Pobre,Pobre extremo', // Categoría SISFOH, valores permitidos
        ];
    }

    /**
     * Define los nombres personalizados para los atributos.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'id' => 'identificador',
            'identity_document' => 'documento de identidad',
            'given_name' => 'nombre',
            'paternal_last_name' => 'apellido paterno',
            'maternal_last_name' => 'apellido materno',
            'marital_status' => 'estado civil',
            'birth_date' => 'fecha de nacimiento',
            'sex_type' => 'sexo',
            'phone_number' => 'número de teléfono',
            'nationality' => 'nacionalidad',
            'degree' => 'grado académico',
            'occupation' => 'ocupación',
            'sfh_category' => 'categoría SISFOH',
        ];
    }

    /**
     * Define los mensajes personalizados de error.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'id.required' => 'El :attribute es obligatorio.',
            'id.size' => 'El :attribute debe tener exactamente 36 caracteres.',
            'id.unique' => 'El :attribute ya existe en la base de datos.',
            'identity_document.required' => 'El :attribute es obligatorio.',
            'identity_document.in' => 'El :attribute debe ser uno de los siguientes valores: DNI, Pasaporte, Carnet, Cedula.',
            'given_name.required' => 'El :attribute es obligatorio.',
            'given_name.max' => 'El :attribute no puede tener más de 80 caracteres.',
            'paternal_last_name.required' => 'El :attribute es obligatorio.',
            'paternal_last_name.max' => 'El :attribute no puede tener más de 50 caracteres.',
            'maternal_last_name.required' => 'El :attribute es obligatorio.',
            'maternal_last_name.max' => 'El :attribute no puede tener más de 50 caracteres.',
            'marital_status.in' => 'El :attribute debe ser uno de los siguientes valores: Soltero(a), Casado(a), Divorciado(a), Viudo(a).',
            'birth_date.date' => 'El :attribute debe ser una fecha válida.',
            'birth_date.before' => 'El :attribute debe ser anterior a la fecha actual.',
            'sex_type.required' => 'El :attribute es obligatorio.',
            'sex_type.boolean' => 'El :attribute debe ser 0 (femenino) o 1 (masculino).',
            'phone_number.regex' => 'El :attribute debe contener exactamente 9 dígitos.',
            'degree.required' => 'El :attribute es obligatorio.',
            'degree.in' => 'El :attribute no es válido.',
            'sfh_category.required' => 'La :attribute es obligatoria.',
            'sfh_category.in' => 'La :attribute debe ser uno de los siguientes valores: No pobre, Pobre, Pobre extremo.',
        ];
    }
}
