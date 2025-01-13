<?php

namespace App\Http\Controllers\CiamControllers;

use App\Http\Controllers\Controller;
use App\Models\CiamModels\PrivateInsurance;
use Illuminate\Http\Request;

class PrivateInsuranceController extends Controller
{
    /**
     * Mostrar una lista de todos los seguros privados.
     */
    public function index()
    {
        // Obtener todos los seguros privados
        $privateInsurances = PrivateInsurance::all();

        // Retornar la vista con los datos
        return view('areas.CiamViews.PrivateInsurances.index', compact('privateInsurances'));
    }

    /**
     * Mostrar el formulario para crear un nuevo seguro privado.
     */
    public function create()
    {
        // Retornar la vista del formulario de creación
        return view('private_insurances.create');
    }

    /**
     * Guardar un nuevo seguro privado en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'id' => 'required|string|max:12|unique:private_insurances',
            'private_insurances_name' => 'required|string|max:255',
        ]);

        // Crear un nuevo seguro privado
        PrivateInsurance::create($validatedData);

        // Redirigir al índice con un mensaje de éxito
        return redirect()->route('private_insurances.index')
            ->with('success', 'Seguro privado creado exitosamente.');
    }

    /**
     * Mostrar los detalles de un seguro privado específico.
     */
    public function show(PrivateInsurance $privateInsurance)
    {
        // Retornar la vista con los detalles del seguro privado
        return view('private_insurances.show', compact('privateInsurance'));
    }

    /**
     * Mostrar el formulario para editar un seguro privado existente.
     */
    public function edit(PrivateInsurance $privateInsurance)
    {
        // Retornar la vista del formulario de edición
        return view('private_insurances.edit', compact('privateInsurance'));
    }

    /**
     * Actualizar un seguro privado en la base de datos.
     */
    public function update(Request $request, PrivateInsurance $privateInsurance)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'id' => 'required|string|max:12|unique:private_insurances,id,' . $privateInsurance->id,
            'private_insurances_name' => 'required|string|max:255',
        ]);

        // Actualizar el seguro privado
        $privateInsurance->update($validatedData);

        // Redirigir al índice con un mensaje de éxito
        return redirect()->route('private_insurances.index')
            ->with('success', 'Seguro privado actualizado exitosamente.');
    }

    /**
     * Eliminar un seguro privado de la base de datos.
     */
    public function destroy(PrivateInsurance $privateInsurance)
    {
        // Eliminar el seguro privado
        $privateInsurance->delete();

        // Redirigir al índice con un mensaje de éxito
        return redirect()->route('private_insurances.index')
            ->with('success', 'Seguro privado eliminado exitosamente.');
    }
}
