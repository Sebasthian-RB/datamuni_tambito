<?php

namespace App\Http\Controllers\OmapedControllers;

use App\Http\Controllers\Controller;
use App\Models\OmapedModels\OmDwelling;
use Illuminate\Http\Request;

class OmDwellingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las viviendas
        $dwellings = OmDwelling::all();
        return view('om_dwellings.index', compact('dwellings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar formulario para registrar una nueva vivienda
        return view('om_dwellings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar datos de entrada
        $data = $request->validate([
            'exact_location' => 'required|string|max:255',
            'reference' => 'nullable|string|max:255',
            'annex_sector' => 'nullable|string|max:255',
            'water_electric_supply' => 'required|string|in:Agua,Luz,Agua y Luz',
            'housing_type' => 'required|string|max:255',
            'housing_condition' => 'required|string|max:255',
            'num_residents' => 'required|integer|min:1',
        ]);

        // Crear nueva vivienda
        OmDwelling::create($data);

        return redirect()->route('om_dwellings.index')->with('success', 'Vivienda registrada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(OmDwelling $omDwelling)
    {
        // Mostrar detalles de una vivienda
        return view('om_dwellings.show', compact('omDwelling'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OmDwelling $omDwelling)
    {
        // Mostrar formulario para editar una vivienda
        return view('om_dwellings.edit', compact('omDwelling'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OmDwelling $omDwelling)
    {
        // Validar datos de entrada
        $data = $request->validate([
            'exact_location' => 'required|string|max:255',
            'reference' => 'nullable|string|max:255',
            'annex_sector' => 'nullable|string|max:255',
            'water_electric_supply' => 'required|string|in:Agua,Luz,Agua y Luz',
            'housing_type' => 'required|string|max:255',
            'housing_condition' => 'required|string|max:255',
            'num_residents' => 'required|integer|min:1',
        ]);

        // Actualizar vivienda
        $omDwelling->update($data);

        return redirect()->route('om_dwellings.index')->with('success', 'Vivienda actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OmDwelling $omDwelling)
    {
        // Eliminar vivienda
        $omDwelling->delete();
        return redirect()->route('om_dwellings.index')->with('success', 'Vivienda eliminada con éxito.');
    }
}