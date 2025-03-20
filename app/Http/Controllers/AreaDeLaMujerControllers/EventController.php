<?php

namespace App\Http\Controllers\AreaDeLaMujerControllers;

use App\Models\AreaDeLaMujerModels\Event;
use App\Http\Controllers\Controller;
use App\Http\Requests\AreaDeLaMujerRequests\Events\StoreEventRequest;
use App\Http\Requests\AreaDeLaMujerRequests\Events\UpdateEventRequest;
use App\Models\AreaDeLaMujerModels\Program;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class EventController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('ver BD');
        $search = $request->input('search');

        $events = Event::with('program')
            ->where('name', 'like', "%$search%")
            ->orWhere('place', 'like', "%$search%")
            ->paginate(10);

        return view('areas.AreaDeLaMujerViews.Events.index', compact('events'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('crear');
        $programs = Program::all();
        return view('areas.AreaDeLaMujerViews.Events.create', compact('programs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        Event::create($request->validated());
        return redirect()->route('events.index')->with('success', 'Evento creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $this->authorize('ver detalles');
        return view('areas.AreaDeLaMujerViews.Events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $this->authorize('editar');
        $programs = Program::all();
        return view('areas.AreaDeLaMujerViews.Events.edit', compact('event', 'programs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->validated());
        return redirect()->route('events.index')->with('success', 'Evento actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $this->authorize('eliminar');
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Evento eliminado con éxito.');
    }
}
