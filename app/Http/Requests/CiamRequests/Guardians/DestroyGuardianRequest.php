<?php

namespace App\Http\Requests\CiamRequests\Guardians;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\CiamModels\Guardian;

/**
 * Form Request para eliminar un guardián.
 */
class DestroyGuardianRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para esta acción.
     */
    public function authorize(): bool
    {
        return true; // Permitir acceso a usuarios autorizados
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            // No es necesario validar el 'id' aquí porque ya viene del modelo enlazado en la ruta
        ];
    }

    /**
     * Validación después de aplicar las reglas.
     */
    protected function passedValidation()
    {
        // Obtener el guardián desde la ruta
        $guardian = $this->route('guardian');

        // Verificar si el guardián está asociado con algún adulto mayor
        if ($guardian->elderlyAdults()->exists()) {
            abort(403, 'No se puede eliminar este guardián porque está asociado con uno o más adultos mayores.');
        }
    }
}
