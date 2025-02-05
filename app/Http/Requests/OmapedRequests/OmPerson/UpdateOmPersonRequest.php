<?php

namespace App\Http\Requests\OmapedRequests\OmPerson;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOmPersonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'registration_date' => 'required|date',
            'paternal_last_name' => 'required|string|max:100',
            'maternal_last_name' => 'required|string|max:100',
            'given_name' => 'required|string|max:100',
            'marital_status' => 'required|in:Soltero,Casado,Divorciado,Viudo,Unión libre',
            'dni' => 'required|numeric|digits:8',
            'birth_date' => [
                'required',
                'date',
                'before_or_equal:today'
            ],
            'age' => 'required|integer|min:0',
            'gender' => 'required|in:Masculino,Femenino,Otro',
            'phone' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:150',
            'education_level' => 'nullable|string|max:150',
            'occupation' => 'nullable|string|max:150',
            'health_insurance' => 'nullable|in:SIS,EsSalud,Seguro Privado,Ninguno',
            'sisfoh' => 'nullable|boolean',
            'employment_status' => 'nullable|in:Activo,Inactivo,Pensionista',
            'pension_status' => 'nullable|in:Pensionado,No Pensionado',
            'om_dwelling_id' => 'nullable|exists:om_dwellings,id',
            'disability_id' => 'nullable|exists:disabilities,id',
            'caregiver_id' => 'nullable|exists:caregivers,id',
            'personal_assistance_need' => 'nullable|string',
            'autonomy_notes' => 'nullable|string',
            'observations' => 'nullable|string',
        ];
    }

    /**
     * Obtiene los mensajes de validación personalizados.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'registration_date.required' => 'La fecha de inscripción es obligatoria.',
            'registration_date.date' => 'La fecha de inscripción debe ser una fecha válida.',

            'paternal_last_name.required' => 'El apellido paterno es obligatorio.',
            'paternal_last_name.max' => 'El apellido paterno no debe exceder los 100 caracteres.',

            'maternal_last_name.required' => 'El apellido materno es obligatorio.',
            'maternal_last_name.max' => 'El apellido materno no debe exceder los 100 caracteres.',

            'given_name.required' => 'El nombre es obligatorio.',
            'given_name.max' => 'El nombre no debe exceder los 100 caracteres.',

            'marital_status.required' => 'El estado civil es obligatorio.',
            'marital_status.in' => 'Seleccione un estado civil válido.',

            'dni.required' => 'El DNI es obligatorio.',
            'dni.digits' => 'El DNI debe tener exactamente 8 dígitos.',
            'dni.unique' => 'Este DNI ya está registrado en el sistema.',

            'birth_date.required' => 'La fecha de nacimiento es obligatoria.',
            'birth_date.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'birth_date.before_or_equal' => 'La fecha de nacimiento no puede ser futura.',

            'age.required' => 'La edad es obligatoria.',
            'age.integer' => 'La edad debe ser un número entero.',
            'age.min' => 'La edad no puede ser negativa.',

            'gender.required' => 'El género es obligatorio.',
            'gender.in' => 'Seleccione un género válido.',

            'phone.max' => 'El teléfono no debe exceder los 15 caracteres.',

            'email.email' => 'Ingrese un correo electrónico válido.',
            'email.max' => 'El correo no debe exceder los 150 caracteres.',

            'education_level.max' => 'El nivel educativo no debe exceder los 150 caracteres.',

            'occupation.max' => 'La ocupación no debe exceder los 150 caracteres.',

            'health_insurance.in' => 'Seleccione un tipo de seguro válido.',

            'sisfoh.boolean' => 'El valor de SISFOH debe ser Sí o No.',

            'employment_status.in' => 'Seleccione un estado laboral válido.',

            'pension_status.in' => 'Seleccione un estado de pensión válido.',

            'om_dwelling_id.exists' => 'La vivienda seleccionada no existe.',

            'disability_id.exists' => 'La discapacidad seleccionada no existe.',

            'caregiver_id.exists' => 'El cuidador seleccionado no existe.',

            'personal_assistance_need.string' => 'El campo de asistencia personal debe ser texto.',

            'autonomy_notes.string' => 'Las notas de autonomía deben ser texto.',

            'observations.string' => 'Las observaciones deben ser texto.'
        ];
    }
}
