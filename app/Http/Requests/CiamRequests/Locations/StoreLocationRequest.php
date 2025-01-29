<?php

namespace App\Http\Requests\CiamRequests\Locations;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para crear una ubicación.
 * Aquí se definen las reglas de validación para la creación de ubicaciones.
 */
class StoreLocationRequest extends FormRequest
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
            'id' => [
                'required',
                'string',
                'max:6', // Máximo 6 caracteres para el ID
                'unique:locations,id', // El ID debe ser único en la tabla locations
                'regex:/^\d+$/', // El ID debe ser un número entero
            ],
            'department' => [
                'required',
                'string',
                'max:15', // Máximo 15 caracteres para el departamento
            ],
            'province' => [
                'required',
                'string',
                'max:30', // Máximo 30 caracteres para la provincia
            ],
            'district' => [
                'required',
                'string',
                'max:50', // Máximo 50 caracteres para el distrito
                Rule::unique('locations')->where(function ($query) {
                    return $query
                        ->where('department', $this->input('department'))
                        ->where('province', $this->input('province'))
                        ->where('district', $this->input('district'));
                }),

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
            'id.required' => 'El ID de la ubicación es obligatorio.',
            'id.unique' => 'El ID de la ubicación ya está registrado.',
            'id.max' => 'El ID no debe exceder los 6 caracteres.',
            'id.regex' => 'El ID debe ser un número entero.',
            'department.required' => 'El nombre del departamento es obligatorio.',
            'department.max' => 'El nombre del departamento no debe exceder los 15 caracteres.',
            'province.required' => 'El nombre de la provincia es obligatorio.',
            'province.max' => 'El nombre de la provincia no debe exceder los 30 caracteres.',
            'district.required' => 'El nombre del distrito es obligatorio.',
            'district.max' => 'El nombre del distrito no debe exceder los 50 caracteres.',
            'district.unique' => 'Ya existe una localidad con esta combinación de departamento, provincia y distrito.',

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
            'id' => 'ID de ubicación',
            'department' => 'departamento',
            'province' => 'provincia',
            'district' => 'distrito',
        ];
    }
}
