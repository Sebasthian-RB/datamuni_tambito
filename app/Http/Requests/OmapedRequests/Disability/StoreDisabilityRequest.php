<?php

namespace App\Http\Requests\OmapedRequests\Disability;

use Illuminate\Foundation\Http\FormRequest;

class StoreDisabilityRequest extends FormRequest
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
            'certificate_number' => 'required|string|max:100|unique:disabilities', // Número de certificado
            'certificate_issue_date' => 'required|date', // Fecha de emisión del certificado
            'certificate_expiry_date' => 'nullable|date|after_or_equal:certificate_issue_date', // Fecha de caducidad
            'organization_name' => 'required|string|max:255', // Organización
            'diagnosis' => 'required|string|max:255', // Diagnóstico
            'disability_type' => 'required|string|max:100', // Tipo de discapacidad
            'severity_level' => 'required|in:Leve,Moderado,Severo', // Nivel de gravedad
            'required_support_devices' => 'nullable|string|max:500', // Dispositivos de apoyo que requiere
            'used_support_devices' => 'nullable|string|max:500', // Dispositivos de apoyo que utiliza
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
            'certificate_number.required' => 'El número de certificado de discapacidad es obligatorio.',
            'certificate_number.unique' => 'El número de certificado ya ha sido registrado.',
            'certificate_issue_date.required' => 'La fecha de emisión del certificado es obligatoria.',
            'certificate_issue_date.date' => 'La fecha de emisión debe ser una fecha válida.',
            'certificate_expiry_date.date' => 'La fecha de caducidad debe ser una fecha válida.',
            'certificate_expiry_date.after_or_equal' => 'La fecha de caducidad debe ser posterior o igual a la fecha de emisión.',
            'organization_name.required' => 'El nombre de la organización es obligatorio.',
            'organization_name.string' => 'El nombre de la organización debe ser una cadena de texto.',
            'organization_name.max' => 'El nombre de la organización no debe exceder los 255 caracteres.',
            'diagnosis.required' => 'El diagnóstico es obligatorio.',
            'diagnosis.string' => 'El diagnóstico debe ser una cadena de texto.',
            'disability_type.required' => 'El tipo de discapacidad es obligatorio.',
            'disability_type.string' => 'El tipo de discapacidad debe ser una cadena de texto.',
            'severity_level.required' => 'El nivel de gravedad es obligatorio.',
            'severity_level.in' => 'El nivel de gravedad debe ser: Leve, Moderado o Severo.',
            'required_support_devices.string' => 'Los dispositivos de apoyo requeridos deben ser una cadena de texto.',
            'used_support_devices.string' => 'Los dispositivos de apoyo utilizados deben ser una cadena de texto.',
        ];
    }
}
