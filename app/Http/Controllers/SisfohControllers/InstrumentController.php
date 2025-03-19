<?php

namespace App\Http\Controllers\SisfohControllers;

use App\Models\SisfohModels\Instrument;
use App\Http\Controllers\Controller;
use App\Http\Requests\SisfohRequests\Instruments\IndexInstrumentRequest;
use App\Http\Requests\SisfohRequests\Instruments\ShowInstrumentRequest;
use App\Http\Requests\SisfohRequests\Instruments\CreateInstrumentRequest;
use App\Http\Requests\SisfohRequests\Instruments\StoreInstrumentRequest;
use App\Http\Requests\SisfohRequests\Instruments\EditInstrumentRequest;
use App\Http\Requests\SisfohRequests\Instruments\UpdateInstrumentRequest;
use App\Http\Requests\SisfohRequests\Instruments\DestroyInstrumentRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class InstrumentController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(IndexInstrumentRequest $request)
    {
        $this->authorize('ver BD');
        $instruments = Instrument::all();
        return view('areas.SisfohViews.Instruments.index', compact('instruments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateInstrumentRequest $request)
    {
        $this->authorize('crear');
        return view('areas.SisfohViews.Instruments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInstrumentRequest $request)
    {
        $validated = $request->validated();
        $instrument = Instrument::create($validated);

        return redirect()->route('instruments.index')
            ->with('success', 'Instrumento creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowInstrumentRequest $request, Instrument $instrument)
    {
        $this->authorize('ver detalles');
        return view('areas.SisfohViews.Instruments.show', compact('instrument'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EditInstrumentRequest $request, Instrument $instrument)
    {
        $this->authorize('editar');
        return view('areas.SisfohViews.Instruments.edit', compact('instrument'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInstrumentRequest $request, Instrument $instrument)
    {
        $validated = $request->validated();
        $instrument->update($validated);

        return redirect()->route('instruments.index')
            ->with('success', 'Instrumento actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyInstrumentRequest $request, Instrument $instrument)
    {
        $this->authorize('eliminar');
        $instrument->delete();

        return redirect()->route('instruments.index')
            ->with('success', 'Instrumento eliminado con éxito.');
    }
}