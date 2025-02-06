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

    /**
     * Realiza validaciones adicionales antes de proceder con la eliminación.
     */
    protected function passedValidation()
    {
        $elderlyAdultId = $this->route('elderly_adult');

        // Verificar si el adulto mayor tiene un guardián asignado
        $hasGuardian = DB::table('elderly_adults')
            ->where('id', $elderlyAdultId)
            ->whereNotNull('guardian_id')
            ->exists();

        if ($hasGuardian) {
            abort(403, 'No se puede eliminar este adulto mayor porque tiene un guardián asignado.');
        }
    }
}
