<?php

namespace App\Http\Controllers\SisfohControllers;

use App\Models\SisfohModels\Visit;
use App\Http\Controllers\Controller;
use App\Http\Requests\SisfohRequests\Visits\IndexVisitRequest;
use App\Http\Requests\SisfohRequests\Visits\ShowVisitRequest;
use App\Http\Requests\SisfohRequests\Visits\CreateVisitRequest;
use App\Http\Requests\SisfohRequests\Visits\StoreVisitRequest;
use App\Http\Requests\SisfohRequests\Visits\EditVisitRequest;
use App\Http\Requests\SisfohRequests\Visits\UpdateVisitRequest;
use App\Http\Requests\SisfohRequests\Visits\DestroyVisitRequest;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexVisitRequest $request)
    {
        $visits = Visit::all(); // Obtener todas las visitas
        return view('areas.SisfohViews.Visits.index', compact('visits')); // Devolver vista con las visitas
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateVisitRequest $request)
    {
        return view('areas.SisfohViews.Visits.create'); // Devolver vista para crear visita
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVisitRequest $request)
    {
        $validated = $request->validated(); // Validar los datos
        Visit::create($validated); // Crear una nueva visita

        return redirect()->route('areas.SisfohViews.Visits.index')->with('success', 'Visita creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Visit $visit, ShowVisitRequest $request)
    {
        return view('areas.SisfohViews.Visits.show', compact('visit')); // Devolver vista con los detalles de la visita
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visit $visit, EditVisitRequest $request)
    {
        return view('areas.SisfohViews.Visits.edit', compact('visit')); // Devolver vista para editar la visita
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVisitRequest $request, Visit $visit)
    {
        $validated = $request->validated(); // Validar los datos
        $visit->update($validated); // Actualizar la visita existente

        return redirect()->route('areas.SisfohViews.Visits.index')->with('success', 'Visita actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visit $visit, DestroyVisitRequest $request)
    {
        $visit->delete(); // Eliminar la visita

        return redirect()->route('areas.SisfohViews.Visits.index')->with('success', 'Visita eliminada exitosamente.');
    }
}