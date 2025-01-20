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
            'marital_status' => 'nullable|string|max:50',
            'dni' => 'required|string|max:8|unique:om_people,dni,' . $this->route('omPerson'),
            'birth_date' => 'required|date',
            'age' => 'required|integer',
            'gender' => 'required|string|max:10',
            'phone' => 'nullable|string|max:15',
            'email' => 'nullable|string|email|max:150',
            'education_level' => 'nullable|string|max:100',
            'occupation' => 'nullable|string|max:100',
            'health_insurance' => 'nullable|string|max:50',
            'sisfoh' => 'nullable|boolean',
            'employment_status' => 'nullable|string|max:100',
            'pension_status' => 'nullable|string|max:100',
            'om_dwelling_id' => 'required|integer|exists:om_dwellings,id',
            'disability_id' => 'nullable|integer|exists:disabilities,id',
            'personal_assistance_need' => 'nullable|string|max:255',
            'autonomy_notes' => 'nullable|string|max:255',
            'caregiver_id' => 'nullable|integer|exists:caregivers,id',
            'observations' => 'nullable|string|max:255',
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
            'dni.required' => 'El DNI es obligatorio.',
            'dni.unique' => 'El DNI ya está registrado en el sistema.',
            'dni.max' => 'El DNI debe tener un máximo de 8 caracteres.',
            'om_dwelling_id.required' => 'La vivienda es obligatoria.',
            'om_dwelling_id.exists' => 'La vivienda seleccionada no existe en el sistema.',
            'disability_id.exists' => 'El certificado de discapacidad seleccionado no existe.',
            'age.required' => 'La edad es obligatoria.',
            'age.integer' => 'La edad debe ser un número entero.',
            'gender.required' => 'El sexo es obligatorio.',
            'gender.string' => 'El sexo debe ser una cadena de texto.',
            'phone.max' => 'El teléfono no puede superar los 15 caracteres.',
            'email.email' => 'El correo electrónico debe ser un correo electrónico válido.',
            'email.max' => 'El correo electrónico no puede superar los 150 caracteres.',
            'education_level.max' => 'El nivel educativo no puede superar los 100 caracteres.',
            'occupation.max' => 'La ocupación no puede superar los 100 caracteres.',
            'health_insurance.max' => 'El seguro de salud no puede superar los 50 caracteres.',
            'sisfoh.boolean' => 'El valor de SISFOH debe ser un valor booleano (true/false).',
            'employment_status.max' => 'El estado laboral no puede superar los 100 caracteres.',
            'pension_status.max' => 'El estado de la pensión no puede superar los 100 caracteres.',
            'personal_assistance_need.max' => 'La necesidad de asistencia personal no puede superar los 255 caracteres.',
            'autonomy_notes.max' => 'Las notas sobre autonomía no pueden superar los 255 caracteres.',
            'observations.max' => 'Las observaciones no pueden superar los 255 caracteres.',
        ];
    }
}
