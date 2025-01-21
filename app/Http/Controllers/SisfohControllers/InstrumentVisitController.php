<?php

namespace App\Http\Controllers\SisfohControllers;

use App\Models\SisfohModels\InstrumentVisit;
use App\Http\Controllers\Controller;
use App\Http\Requests\SisfohRequests\InstrumentVisits\IndexInstrumentVisitRequest;
use App\Http\Requests\SisfohRequests\InstrumentVisits\ShowInstrumentVisitRequest;
use App\Http\Requests\SisfohRequests\InstrumentVisits\CreateInstrumentVisitRequest;
use App\Http\Requests\SisfohRequests\InstrumentVisits\StoreInstrumentVisitRequest;
use App\Http\Requests\SisfohRequests\InstrumentVisits\EditInstrumentVisitRequest;
use App\Http\Requests\SisfohRequests\InstrumentVisits\UpdateInstrumentVisitRequest;
use App\Http\Requests\SisfohRequests\InstrumentVisits\DestroyInstrumentVisitRequest;

class InstrumentVisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexInstrumentVisitRequest $request)
    {
        // Lógica para obtener la lista de InstrumentVisits
        $instrumentVisits = InstrumentVisit::all(); // Puedes agregar paginación o filtros si es necesario

        return view('areas.SisfohViews.InstrumentVisit.index', compact('instrumentVisits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateInstrumentVisitRequest $request)
    {
        // Lógica para mostrar el formulario de creación
        return view('areas.SisfohViews.InstrumentVisit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInstrumentVisitRequest $request)
    {
        // Validar los datos
        $validated = $request->validated();

        // Crear un nuevo registro en la base de datos
        InstrumentVisit::create($validated);

        // Redirigir o devolver la respuesta
        return redirect()->route('instrument_visits.index')->with('success', 'Instrumento/Visita creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(InstrumentVisit $instrumentVisit, ShowInstrumentVisitRequest $request)
    {
        // Mostrar los detalles del InstrumentVisit
        return view('areas.SisfohViews.InstrumentVisit.show', compact('instrumentVisit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InstrumentVisit $instrumentVisit, EditInstrumentVisitRequest $request)
    {
        // Mostrar el formulario de edición
        return view('areas.SisfohViews.InstrumentVisit.edit', compact('instrumentVisit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInstrumentVisitRequest $request, InstrumentVisit $instrumentVisit)
    {
        // Validar los datos
        $validated = $request->validated();

        // Actualizar el registro en la base de datos
        $instrumentVisit->update($validated);

        // Redirigir o devolver la respuesta
        return redirect()->route('instrument_visits.index')->with('success', 'Instrumento/Visita actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InstrumentVisit $instrumentVisit, DestroyInstrumentVisitRequest $request)
    {
        // Eliminar el registro
        $instrumentVisit->delete();

        // Redirigir o devolver la respuesta
        return redirect()->route('instrument_visits.index')->with('success', 'Instrumento/Visita eliminado con éxito');
    }
}
