<?php

namespace App\Http\Controllers\AreaDeLaMujerControllers;

use App\Models\AreaDeLaMujerModels\Event;
use App\Http\Controllers\Controller;
use App\Models\AreaDeLaMujerModels\Program;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('program')->get();
        return view('areas.AreaDeLaMujerViews.Events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programs = Program::all();
        return view('areas.AreaDeLaMujerViews.Events.create', compact('programs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string',
            'place' => 'required|string|max:150',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:Pendiente,Finalizado,En proceso,Cancelado',
            'program_id' => 'required|exists:programs,id',
        ]);

        Event::create($request->all());
        return redirect()->route('events.index')->with('success', 'Evento creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('areas.AreaDeLaMujerViews.Events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $programs = Program::all();
        return view('areas.AreaDeLaMujerViews.Events.edit', compact('event', 'programs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string',
            'place' => 'required|string|max:150',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:Pendiente,Finalizado,En proceso,Cancelado',
            'program_id' => 'required|exists:programs,id',
        ]);

        $event->update($request->all());
        return redirect()->route('events.index')->with('success', 'Evento actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Evento eliminado con éxito.');
    }
}
