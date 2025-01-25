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

use App\Models\SisfohModels\Enumerator;
use App\Models\SisfohModels\SfhRequest;
use Carbon\Carbon;
class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexVisitRequest $request)
    {
        $visits = Visit::all()->map(function ($visit) {
            $visit->visit_date = Carbon::parse($visit->visit_date)->format('Y-m-d'); // Formatear la fecha
            return $visit;
        });
        return view('areas.SisfohViews.Visits.index', compact('visits')); // Devolver vista con las visitas
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateVisitRequest $request)
    {
        $enumerators = Enumerator::all(); // Obtener todos los encuestadores
        $requests = SfhRequest::all(); // Obtener todas las solicitudes relacionadas
        return view('areas.SisfohViews.Visits.create', compact('enumerators', 'requests')); // Devolver vista para crear visita
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVisitRequest $request)
    {
        $validated = $request->validated(); // Validar los datos
        // Crear una nueva visita
        Visit::create([
            'enumerator_id' => $validated['enumerator_id'],
            'sfh_requests_id' => $validated['sfh_requests_id'],
            'visit_date' => $validated['visit_date'],  // Asegúrate de incluir otros campos
            'status' => $validated['status'],          // Agrega otros campos si es necesario
            'observations' => $validated['observations'], // Si tienes este campo
        ]);

        return redirect()->route('visits.index')->with('success', 'Visita creada exitosamente.');
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
        $enumerators = Enumerator::all(); // Obtener todos los encuestadores
        $requests = SfhRequest::all(); // Obtener todas las solicitudes relacionadas

        return view('areas.SisfohViews.Visits.edit', compact('visit', 'enumerators', 'requests')); // Devolver vista para editar la visita
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVisitRequest $request, Visit $visit)
    {
        $validated = $request->validated(); // Validar los datos
        // Actualizar la visita existente
        $visit->update([
            'enumerator_id' => $validated['enumerator_id'],
            'sfh_requests_id' => $validated['sfh_requests_id'],
            'visit_date' => $validated['visit_date'],  // Asegúrate de incluir otros campos
            'status' => $validated['status'],          // Agrega otros campos si es necesario
            'observations' => $validated['observations'], // Si tienes este campo
        ]);

        return redirect()->route('visits.index')->with('success', 'Visita actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visit $visit, DestroyVisitRequest $request)
    {
        $visit->delete(); // Eliminar la visita

        return redirect()->route('visits.index')->with('success', 'Visita eliminada exitosamente.');
    }
}