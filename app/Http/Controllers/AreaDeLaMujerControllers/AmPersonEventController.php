<?php

namespace App\Http\Controllers\AreaDeLaMujerControllers;

use App\Models\AreaDeLaMujerModels\AmPersonEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\AreaDeLaMujerRequests\AmPersonEvents\StoreAmPersonEventRequest;
use App\Http\Requests\AreaDeLaMujerRequests\AmPersonEvents\UpdateAmPersonEventRequest;
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
    public function store(StoreAmPersonEventRequest $request)
    {

        // Crea un nuevo registro utilizando los datos validados.
        AmPersonEvent::create($request->validated());

        return redirect()->route('am_person_events.index')->with('success', 'Registro creado correctamente.');
    
    }

     /**
     * Muestra el detalle de un registro específico.
     *
     * @param AmPersonEvent $amPersonEvent
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
     * Actualiza un registro en la base de datos.
     *
     * @param UpdateAmPersonEventRequest $request
     * @param AmPersonEvent $amPersonEvent
     */
    public function update(UpdateAmPersonEventRequest $request, AmPersonEvent $amPersonEvent)
    {

        // Actualiza el registro utilizando los datos validados.
        $amPersonEvent->update($request->validated());

        return redirect()->route('am_person_events.index')->with('success', 'Registro actualizado correctamente.');
    }

     /**
     * Elimina un registro de la base de datos.
     *
     * @param AmPersonEvent $amPersonEvent
     */
    public function destroy(AmPersonEvent $amPersonEvent)
    {
        // Eliminar el registro
        $amPersonEvent->delete();

        return redirect()->route('am_person_events.index')->with('success', 'Registro eliminado correctamente.');
    }
}
