<?php

namespace App\Http\Controllers\CiamControllers;

use App\Http\Controllers\Controller;
use App\Models\CiamModels\PublicInsurance;
use Illuminate\Http\Request;

class PublicInsuranceController extends Controller
{
    /**
     * Muestra una lista de todos los seguros públicos.
     */
    public function index()
    {
        $publicInsurances = PublicInsurance::all(); // Obtiene todos los registros
        return view('areas.CiamViews.PublicInsurances.index', compact('publicInsurances')); // Envía los datos a la vista
    }

    /**
     * Muestra el formulario para crear un nuevo seguro público.
     */
    public function create()
    {
        return view('public_insurances.create'); // Devuelve la vista para crear
    }

    /**
     * Guarda un nuevo seguro público en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos enviados por el formulario
        $validated = $request->validate([
            'id' => 'required|string|max:8|unique:public_insurances,id', // ID único con máximo de 8 caracteres
            'public_insurances_name' => 'required|in:SIS,ESSALUD', // Solo acepta "SIS" o "ESSALUD"
        ]);

        // Crear el nuevo registro
        PublicInsurance::create($validated);

        // Redirige a la lista con un mensaje de éxito
        return redirect()->route('public_insurances.index')->with('success', 'Seguro público creado exitosamente.');
    }

    /**
     * Muestra los detalles de un seguro público específico.
     */
    public function show(PublicInsurance $publicInsurance)
    {
        return view('public_insurances.show', compact('publicInsurance')); // Envía el registro a la vista
    }

    /**
     * Muestra el formulario para editar un seguro público específico.
     */
    public function edit(PublicInsurance $publicInsurance)
    {
        return view('public_insurances.edit', compact('publicInsurance')); // Envía el registro a la vista
    }

    /**
     * Actualiza un seguro público específico en la base de datos.
     */
    public function update(Request $request, PublicInsurance $publicInsurance)
    {
        // Validar los datos enviados por el formulario
        $validated = $request->validate([
            'id' => 'required|string|max:8|unique:public_insurances,id,' . $publicInsurance->id, // ID único pero excluyendo el actual
            'public_insurances_name' => 'required|in:SIS,ESSALUD', // Solo acepta "SIS" o "ESSALUD"
        ]);

        // Actualizar el registro
        $publicInsurance->update($validated);

        // Redirige a la lista con un mensaje de éxito
        return redirect()->route('public_insurances.index')->with('success', 'Seguro público actualizado exitosamente.');
    }

    /**
     * Elimina un seguro público específico de la base de datos.
     */
    public function destroy(PublicInsurance $publicInsurance)
    {
        $publicInsurance->delete(); // Elimina el registro

        // Redirige a la lista con un mensaje de éxito
        return redirect()->route('public_insurances.index')->with('success', 'Seguro público eliminado exitosamente.');
    }
}
