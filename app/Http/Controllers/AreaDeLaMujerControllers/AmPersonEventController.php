<?php

namespace App\Http\Controllers\AreaDeLaMujerControllers;

use App\Models\AreaDeLaMujerModels\AmPersonEvent;
use App\Http\Controllers\Controller;
use App\Models\AreaDeLaMujerModels\AmPerson;
use App\Models\AreaDeLaMujerModels\Event;
use Illuminate\Http\Request;

class AmPersonEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los registros de la tabla intermedia con relaciones
        $personEvents = AmPersonEvent::with(['amPerson', 'event'])->get();

        return view('areas.AreaDeLaMujerViews.AmPersonEvents.index', compact('personEvents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener personas y eventos disponibles
        $people = AmPerson::all();
        $events = Event::all();

        return view('areas.AreaDeLaMujerViews.AmPersonEvents.create', compact('people', 'events'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validaciones
        $request->validate([
            'am_person_id' => 'required|exists:am_people,id',
            'event_id' => 'required|exists:events,id',
            'status' => 'required|in:Asistió,No Asistió,Justificado',
        ]);

        // Crear un nuevo registro
        AmPersonEvent::create($request->all());

        return redirect()->route('am_person_events.index')->with('success', 'Registro creado correctamente.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(AmPersonEvent $amPersonEvent)
    {
        // Mostrar el detalle del registro con relaciones
        $amPersonEvent->load(['amPerson', 'event']);

        return view('areas.AreaDeLaMujerViews.AmPersonEvents.show', compact('amPersonEvent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AmPersonEvent $amPersonEvent)
    {
        // Obtener personas y eventos para mostrar en el formulario de edición
        $people = AmPerson::all();
        $events = Event::all();

        return view('areas.AreaDeLaMujerViews.AmPersonEvents.edit', compact('amPersonEvent', 'people', 'events'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AmPersonEvent $amPersonEvent)
    {
        // Validaciones
        $request->validate([
            'am_person_id' => 'required|exists:am_people,id',
            'event_id' => 'required|exists:events,id',
            'status' => 'required|in:Asistió,No Asistió,Justificado',
        ]);

        // Actualizar el registro
        $amPersonEvent->update($request->all());

        return redirect()->route('am_person_events.index')->with('success', 'Registro actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AmPersonEvent $amPersonEvent)
    {
        // Eliminar el registro
        $amPersonEvent->delete();

        return redirect()->route('am_person_events.index')->with('success', 'Registro eliminado correctamente.');
    }
}
