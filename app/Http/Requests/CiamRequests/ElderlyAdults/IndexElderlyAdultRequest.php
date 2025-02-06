<?php

namespace App\Http\Requests\CiamRequests\ElderlyAdults;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para listar adultos mayores con soporte de filtros, ordenación y paginación.
 */
class IndexElderlyAdultRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     */
    public function authorize(): bool
    {
        return true; // Permitir acceso a cualquier usuario autenticado.
    }

    /**
     * Reglas de validación para los parámetros de filtrado y ordenación.
     */
    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'max:255'], // Permitir búsqueda por nombre, documento, etc.
            'sort_by' => ['nullable', 'in:id,document_type,given_name,paternal_last_name,birth_date,state'], // Campos permitidos para ordenar
            'order' => ['nullable', 'in:asc,desc'], // Orden ascendente o descendente
            'per_page' => ['nullable', 'integer', 'min:5', 'max:100'], // Definir límites seguros para paginación
        ];
    }

    /**
     * Mensajes de error personalizados para validaciones.
     */
    public function messages(): array
    {
        return [
            'search.max' => 'El criterio de búsqueda no puede exceder los 255 caracteres.',
            'sort_by.in' => 'El campo de ordenación seleccionado no es válido.',
            'order.in' => 'El tipo de orden debe ser "asc" o "desc".',
            'per_page.integer' => 'El número de resultados por página debe ser un número entero.',
            'per_page.min' => 'Debe mostrar al menos 5 registros por página.',
            'per_page.max' => 'No se pueden mostrar más de 100 registros por página.',
        ];
    }

    /**
     * Personalizar los nombres de los atributos en los mensajes de error.
     */
    public function attributes(): array
    {
        return [
            'search' => 'búsqueda',
            'sort_by' => 'campo de ordenación',
            'order' => 'orden de clasificación',
            'per_page' => 'resultados por página',
        ];
    }
}
