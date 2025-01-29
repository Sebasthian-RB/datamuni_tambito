<?php

namespace App\Http\Controllers\CiamControllers;

use App\Http\Controllers\Controller;
use App\Models\CiamModels\ElderlyAdultPrivateInsurance;
use App\Models\CiamModels\ElderlyAdult;
use App\Models\CiamModels\PrivateInsurance;
use Illuminate\Http\Request;

class ElderlyAdultPrivateInsuranceController extends Controller
{
    /**
     * Muestra una lista de las relaciones entre adultos mayores y seguros privados.
     */
    public function index()
    {
        // Obtener todas las relaciones con los datos relacionados de adultos mayores y seguros privados
        $relations = ElderlyAdultPrivateInsurance::with(['elderlyAdult', 'privateInsurance'])->get();

        return view('areas.CiamViews.ElderlyAdultsPrivateInsurances.index', compact('relations'));
    }

    /**
     * Muestra el formulario para crear una nueva relación.
     */
    public function create()
    {
        // Obtener datos necesarios para los selects
        $elderlyAdults = ElderlyAdult::all();
        $privateInsurances = PrivateInsurance::all();

        return view('elderly_adult_private_insurances.create', compact('elderlyAdults', 'privateInsurances'));
    }

    /**
     * Almacena una nueva relación en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'elderly_adults_id' => 'required|exists:elderly_adults,id',
            'private_insurances_id' => 'required|exists:private_insurances,id',
        ]);

        // Crear la nueva relación
        ElderlyAdultPrivateInsurance::create($request->all());

        // Redirigir al índice con mensaje de éxito
        return redirect()->route('elderly_adult_private_insurances.index')->with('success', 'Relación creada exitosamente.');
    }

    /**
     * Muestra los detalles de una relación específica.
     */
    public function show(ElderlyAdultPrivateInsurance $elderlyAdultPrivateInsurance)
    {
        return view('elderly_adult_private_insurances.show', compact('elderlyAdultPrivateInsurance'));
    }

    /**
     * Muestra el formulario para editar una relación existente.
     */
    public function edit(ElderlyAdultPrivateInsurance $elderlyAdultPrivateInsurance)
    {
        // Obtener datos necesarios para los selects
        $elderlyAdults = ElderlyAdult::all();
        $privateInsurances = PrivateInsurance::all();

        return view('elderly_adult_private_insurances.edit', compact('elderlyAdultPrivateInsurance', 'elderlyAdults', 'privateInsurances'));
    }

    /**
     * Actualiza una relación en la base de datos.
     */
    public function update(Request $request, ElderlyAdultPrivateInsurance $elderlyAdultPrivateInsurance)
    {
        // Validar los datos del formulario
        $request->validate([
            'elderly_adults_id' => 'required|exists:elderly_adults,id',
            'private_insurances_id' => 'required|exists:private_insurances,id',
        ]);

        // Actualizar la relación
        $elderlyAdultPrivateInsurance->update($request->all());

        // Redirigir al índice con mensaje de éxito
        return redirect()->route('elderly_adult_private_insurances.index')->with('success', 'Relación actualizada exitosamente.');
    }

    /**
     * Elimina una relación de la base de datos.
     */
    public function destroy(ElderlyAdultPrivateInsurance $elderlyAdultPrivateInsurance)
    {
        // Eliminar la relación
        $elderlyAdultPrivateInsurance->delete();

        // Redirigir al índice con mensaje de éxito
        return redirect()->route('elderly_adult_private_insurances.index')->with('success', 'Relación eliminada exitosamente.');
    }
}
