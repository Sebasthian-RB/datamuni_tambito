<?php

namespace App\Http\Controllers\AreaDeLaMujerControllers;

use App\Models\AreaDeLaMujerModels\AmPersonEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\AreaDeLaMujerRequests\AmPersonEvents\StoreAmPersonEventRequest;
use App\Http\Requests\AreaDeLaMujerRequests\AmPersonEvents\UpdateAmPersonEventRequest;
use App\Models\AreaDeLaMujerModels\AmPerson;
use App\Models\AreaDeLaMujerModels\Event;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class AmPersonEventController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('ver BD');

        $query = AmPersonEvent::with(['amPerson', 'event']);
    
        // Filtro por nombre o DNI
        if ($request->has('search') && !empty($request->input('search'))) {
            $search = $request->input('search');
            $query->whereHas('amPerson', function ($q) use ($search) {
                $q->where('given_name', 'like', "%$search%")
                  ->orWhere('paternal_last_name', 'like', "%$search%")
                  ->orWhere('maternal_last_name', 'like', "%$search%")
                  ->orWhere('identity_document', 'like', "%$search%");
            });
        }
    
        // Filtro por evento
        if ($request->has('event') && !empty($request->input('event'))) {
            $query->where('event_id', $request->input('event'));
        }
    
        // Obtener los registros con paginación
        $personEvents = $query->paginate(10);
    
        // Obtener todos los eventos para el filtro
        $events = Event::all();
    
        return view('areas.AreaDeLaMujerViews.AmPersonEvents.index', compact('personEvents', 'events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('crear');
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
        $this->authorize('crear');
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
        $this->authorize('ver detalles');
        // Mostrar el detalle del registro con relaciones
        $amPersonEvent->load(['amPerson', 'event']);

        return view('areas.AreaDeLaMujerViews.AmPersonEvents.show', compact('amPersonEvent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AmPersonEvent $amPersonEvent)
    {
        $this->authorize('editar');
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
        $this->authorize('editar');
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
        $this->authorize('eliminar');
        // Eliminar el registro
        $amPersonEvent->delete();

        return redirect()->route('am_person_events.index')->with('success', 'Registro eliminado correctamente.');
    }
}
