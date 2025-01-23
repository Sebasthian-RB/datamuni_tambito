<?php

namespace App\Http\Requests\OmapedRequests\OmDwelling;

use Illuminate\Foundation\Http\FormRequest;

class StoreOmDwellingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'exact_location' => 'required|string|max:255', // Localización exacta
            'reference' => 'nullable|string|max:500', // Referencia de la vivienda (opcional)
            'annex_sector' => 'nullable|string|max:255', // Anexo/Sector (opcional)
            'water_electricity' => 'required|string|in:Agua,Luz,Agua y Luz,Ninguno', // Suministro de agua y/o luz
            'type' => 'required|string|max:50', // Tipo de vivienda
            'ownership_status' => 'required|string|in:Propia,Alquilada,Prestada', // Situación de la vivienda
            'permanent_occupants' => 'required|integer|min:1', // Número de personas viviendo permanentemente
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
            'exact_location.required' => 'La localización exacta de la vivienda es obligatoria.',
            'reference.string' => 'La referencia de la vivienda debe ser una cadena de texto.',
            'water_electricity.required' => 'El suministro de agua y/o luz es obligatorio.',
            'water_electricity.in' => 'El suministro de agua y/o luz debe ser uno de los siguientes: Agua, Luz, Agua y Luz, Ninguno.',
            'dwelling_type.required' => 'El tipo de vivienda es obligatorio.',
            'ownership_status.required' => 'La situación de la vivienda es obligatoria.',
            'ownership_status.in' => 'La situación de la vivienda debe ser: Propia, Alquilada o Prestada.',
            'permanent_occupants.required' => 'El número de personas viviendo permanentemente es obligatorio.',
            'permanent_occupants.integer' => 'El número de personas debe ser un valor numérico.',
            'permanent_occupants.min' => 'El número de personas viviendo permanentemente debe ser al menos 1.',
        ];
    }
}
