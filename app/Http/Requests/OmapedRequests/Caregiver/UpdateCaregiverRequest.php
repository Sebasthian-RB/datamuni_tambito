<?php

namespace App\Http\Requests\OmapedRequests\Caregiver;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCaregiverRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:200',
            'relationship' => 'required|string|max:100',
            'dni' => [
                'required',
                'string',
                'size:8',
                Rule::unique('caregivers', 'dni')->ignore($this->route('caregiver')->id),
            ],
            'phone' => 'nullable|string|max:15',
        ];
    }
    
    /**
     * Get the custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'full_name.required' => 'El nombre completo del cuidador es obligatorio.',
            'full_name.string' => 'El nombre completo debe ser una cadena de texto.',
            'full_name.max' => 'El nombre completo no debe exceder los 200 caracteres.',
            'relationship.required' => 'El parentesco es obligatorio.',
            'relationship.string' => 'El parentesco debe ser una cadena de texto.',
            'relationship.max' => 'El parentesco no debe exceder los 100 caracteres.',
            'dni.required' => 'El DNI es obligatorio.',
            'dni.string' => 'El DNI debe ser una cadena de texto.',
            'dni.max' => 'El DNI no debe exceder los 8 caracteres.',
            'dni.unique' => 'Este DNI ya ha sido registrado para otro cuidador.',
            'phone.string' => 'El teléfono debe ser una cadena de texto.',
            'phone.max' => 'El teléfono no debe exceder los 15 caracteres.',
        ];
    }
}
