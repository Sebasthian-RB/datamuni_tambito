<?php

namespace App\Http\Requests\CiamRequests\ElderlyAdults;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use App\Models\CiamModels\ElderlyAdult;

/**
 * Form Request para la eliminación de un adulto mayor.
 * Se asegura de que el adulto mayor no tenga relaciones activas antes de eliminarlo.
 */
class DestroyElderlyAdultRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     */
    public function authorize(): bool
    {
        return true; // Se puede cambiar si hay roles específicos
    }

    /**
     * Reglas de validación para la eliminación.
     */
    public function rules(): array
    {
        return [];
    }
}
