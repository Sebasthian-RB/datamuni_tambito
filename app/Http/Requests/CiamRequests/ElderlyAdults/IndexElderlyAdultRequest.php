<?php

namespace App\Http\Requests\CiamRequests\ElderlyAdults;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para listar adultos mayores.
 * Verifica permisos y permite filtrar registros en el futuro.
 */
class IndexElderlyAdultRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     */
    public function authorize(): bool
    {
        return true; // Permitir acceso a cualquier usuario autorizado.
    }

    /**
     * Reglas de validación (Opcionales para filtros en el futuro).
     */
    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'max:255'], // Para búsqueda de nombre, documento, etc.
            'sort_by' => ['nullable', 'in:id,document_type,given_name,birth_date'], // Campos permitidos para ordenar
            'order' => ['nullable', 'in:asc,desc'], // Orden de clasificación (ascendente o descendente)
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'], // Cantidad de resultados por página
        ];
    }
}
