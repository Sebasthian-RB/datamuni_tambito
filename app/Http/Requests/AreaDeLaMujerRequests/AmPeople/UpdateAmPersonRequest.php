<?php

namespace App\Http\Requests\AreaDeLaMujerRequests\AmPeople;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAmPersonRequest extends FormRequest
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

        $rules = [
            
            'identity_document' => 'required|string|in:DNI,Pasaporte,Carnet,Cedula',
            'given_name' => 'required|string|max:50',
            'paternal_last_name' => 'required|string|max:50',
            'maternal_last_name' => 'required|string|max:50',
            'address' => 'nullable|string|max:255',
            'sex_type' => 'required|boolean',
            'phone_number' => 'nullable|regex:/^\d{9}$/',
            'attendance_date' => 'required|date',
        ];


        return $rules;
    }

    public function messages()
    {
        return [
            'id.required' => 'El campo ID es obligatorio.',
            'id.unique' => 'El ID ya está en uso. Por favor, elija otro.',
            'identity_document.required' => 'Debe seleccionar un tipo de documento.',
            'identity_document.in' => 'El tipo de documento seleccionado no es válido.',
            'phone_number.regex' => 'El número de teléfono debe tener exactamente 9 dígitos.',
        ];
    }
}
