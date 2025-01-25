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
            'dni' => 'required|digits:8', // Validación simple sin unicidad
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
            'paternal_last_name.required' => 'El apellido paterno es obligatorio.',
            'maternal_last_name.required' => 'El apellido materno es obligatorio.',
            'given_name.required' => 'El nombre es obligatorio.',
            'marital_status.required' => 'El estado civil es obligatorio.',
            'marital_status.in' => 'El estado civil debe ser uno de los valores permitidos.',
            'dni.required' => 'El DNI es obligatorio.',
            'dni.digits' => 'El DNI debe tener exactamente 8 dígitos.',
            'birth_date.required' => 'La fecha de nacimiento es obligatoria.',
            'age.required' => 'La edad es obligatoria.',
            'age.integer' => 'La edad debe ser un número entero.',
            'gender.required' => 'El género es obligatorio.',
            'gender.in' => 'El género debe ser Masculino, Femenino u Otro.',
            'email.email' => 'El correo electrónico no tiene un formato válido.',
            'om_dwelling_id.exists' => 'La vivienda seleccionada no existe.',
            'disability_id.exists' => 'La discapacidad seleccionada no existe.',
            'caregiver_id.exists' => 'El cuidador seleccionado no existe.',
        ];
    }
}
