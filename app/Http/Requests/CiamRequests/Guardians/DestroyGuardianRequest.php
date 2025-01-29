<?php

namespace App\Http\Requests\CiamRequests\Guardians;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

/**
 * Form Request para eliminar un guardian.
 */
class DestroyGuardianRequest extends FormRequest
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
            // Asegurar que el ID existe en la tabla guardians
            'id' => 'required|exists:guardians,id',
        ];
    }

    /**
     * Realiza validaciones adicionales después de pasar las reglas.
     */
    protected function passedValidation()
    {
        // Verificar si el guardian está asociado con algún adulto mayor
        $guardianId = $this->input('id');
        $isAssociated = DB::table('elderly_adults_guardians')
            ->where('guardian_id', $guardianId)
            ->exists();

        if ($isAssociated) {
            abort(403, 'No se puede eliminar este guardian porque está asociado con uno o más adultos mayores.');
        }
    }

    /**
     * Obtener los mensajes de validación personalizados.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'id.required' => 'El ID del guardian es obligatorio.',
            'id.exists' => 'El guardian seleccionado no existe en el sistema.',
        ];
    }
}
