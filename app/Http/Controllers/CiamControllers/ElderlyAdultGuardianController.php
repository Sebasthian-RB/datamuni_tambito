<?php

namespace App\Http\Controllers\CiamControllers;

use App\Http\Controllers\Controller;
use App\Models\CiamModels\ElderlyAdult;
use App\Models\CiamModels\Guardian;
use App\Models\CiamModels\ElderlyAdultGuardian;
use Illuminate\Http\Request;

class ElderlyAdultGuardianController extends Controller
{
    /**
     * Muestra una lista de todas las relaciones entre Adultos Mayores y Guardianes.
     */
    public function index()
    {
        // Obtiene todas las relaciones entre adultos mayores y guardianes
        $relations = ElderlyAdultGuardian::with(['elderlyAdult', 'guardian'])->get();
        return view('areas.CiamViews.ElderlyAdultsGuardians.index', compact('relations'));
    }

    /**
     * Muestra el formulario para crear una nueva relación.
     */
    public function create()
    {
        // Obtiene todos los adultos mayores y guardianes para las opciones del formulario
        $elderlyAdults = ElderlyAdult::all();
        $guardians = Guardian::all();
        return view('elderly_adult_guardians.create', compact('elderlyAdults', 'guardians'));
    }

    /**
     * Almacena una nueva relación en la base de datos.
     */
    public function store(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'elderly_adults_id' => 'required|exists:elderly_adults,id',
            'guardians_id' => 'required|exists:guardians,id',
        ]);

        // Crea la nueva relación
        ElderlyAdultGuardian::create($request->all());

        // Redirige al índice con un mensaje de éxito
        return redirect()->route('elderly_adult_guardians.index')->with('success', 'Relación creada correctamente.');
    }

    /**
     * Muestra los detalles de una relación específica.
     */
    public function show(ElderlyAdultGuardian $elderlyAdultGuardian)
    {
        return view('elderly_adult_guardians.show', compact('elderlyAdultGuardian'));
    }

    /**
     * Muestra el formulario para editar una relación existente.
     */
    public function edit(ElderlyAdultGuardian $elderlyAdultGuardian)
    {
        // Obtiene todos los adultos mayores y guardianes para las opciones del formulario
        $elderlyAdults = ElderlyAdult::all();
        $guardians = Guardian::all();
        return view('elderly_adult_guardians.edit', compact('elderlyAdultGuardian', 'elderlyAdults', 'guardians'));
    }

    /**
     * Actualiza una relación en la base de datos.
     */
    public function update(Request $request, ElderlyAdultGuardian $elderlyAdultGuardian)
    {
        // Valida los datos del formulario
        $request->validate([
            'elderly_adults_id' => 'required|exists:elderly_adults,id',
            'guardians_id' => 'required|exists:guardians,id',
        ]);

        // Actualiza la relación existente
        $elderlyAdultGuardian->update($request->all());

        // Redirige al índice con un mensaje de éxito
        return redirect()->route('elderly_adult_guardians.index')->with('success', 'Relación actualizada correctamente.');
    }

    /**
     * Elimina una relación de la base de datos.
     */
    public function destroy(ElderlyAdultGuardian $elderlyAdultGuardian)
    {
        // Elimina la relación
        $elderlyAdultGuardian->delete();

        // Redirige al índice con un mensaje de éxito
        return redirect()->route('elderly_adult_guardians.index')->with('success', 'Relación eliminada correctamente.');
    }
}
