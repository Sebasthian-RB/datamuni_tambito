<?php

namespace App\Http\Requests\OmapedRequests\OmPerson;

use Illuminate\Foundation\Http\FormRequest;

class StoreOmPersonRequest extends FormRequest
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
                'dni' => 'required|digits:8|unique:om_people,dni',
                'birth_date' => 'required|date',
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
            'paternal_last_name.required' => 'El apellido paterno es obligatorio.',
            'maternal_last_name.required' => 'El apellido materno es obligatorio.',
            'given_name.required' => 'El nombre es obligatorio.',
            'marital_status.required' => 'El estado civil es obligatorio.',
            'marital_status.in' => 'El estado civil debe ser uno de los valores permitidos.',
            'dni.required' => 'El DNI es obligatorio.',
            'dni.digits' => 'El DNI debe tener exactamente 8 dígitos.',
            'dni.unique' => 'El DNI ya está registrado.',
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
