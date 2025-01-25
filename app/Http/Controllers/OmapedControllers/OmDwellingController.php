<?php

namespace App\Http\Controllers\OmapedControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\OmapedRequests\OmDwelling\StoreOmDwellingRequest;
use App\Http\Requests\OmapedRequests\OmDwelling\UpdateOmDwellingRequest;
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
        return view('areas.OmapedViews.OmDwellings.index', compact('dwellings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar formulario para registrar una nueva vivienda
        return view('areas.OmapedViews.OmDwellings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOmDwellingRequest $request)
    {
        // Crear nueva vivienda
        OmDwelling::create($request->validated());
        return redirect()->route('om-dwellings.index')->with('success', '¡Vivienda creada exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(OmDwelling $omDwelling)
    {
        // Mostrar detalles de una vivienda
        return view('areas.OmapedViews.OmDwellings.show', compact('omDwelling'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OmDwelling $omDwelling)
    {
        // Mostrar formulario para editar una vivienda
        return view('areas.OmapedViews.OmDwellings.edit', compact('omDwelling'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOmDwellingRequest $request, OmDwelling $omDwelling)
    {
        $omDwelling->update($request->validated());
        return redirect()->route('om-dwellings.index')->with('success', '¡Vivienda actualizada exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OmDwelling $omDwelling)
    {
        // Eliminar vivienda
        $omDwelling->delete();
        return redirect()->route('om-dwellings.index')->with('success', 'Vivienda eliminada con éxito.');
    }
}