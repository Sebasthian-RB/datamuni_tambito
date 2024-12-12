<?php

namespace App\Http\Controllers\AreaDeLaMujerControllers;

use App\Models\AreaDeLaMujerModels\Intervention;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InterventionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $interventions = Intervention::all();
        return view('areas.AreaDeLaMujerViews.Interventions.index', compact('interventions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('areas.AreaDeLaMujerViews.Interventions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'appointment' => 'required|string',
            'derivation' => 'nullable|string',
            'appointment_date' => 'required|date',
        ]);

        Intervention::create($validated);

        return redirect()->route('interventions.index')->with('success', 'Intervención creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Intervention $intervention)
    {
        return view('areas.AreaDeLaMujerViews.Interventions.show', compact('intervention'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Intervention $intervention)
    {
        return view('areas.AreaDeLaMujerViews.Interventions.edit', compact('intervention'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Intervention $intervention)
    {
        $validated = $request->validate([
            'appointment' => 'required|string',
            'derivation' => 'nullable|string',
            'appointment_date' => 'required|date',
        ]);

        $intervention->update($validated);

        return redirect()->route('interventions.index')->with('success', 'Intervención actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Intervention $intervention)
    {
        $intervention->delete();
        return redirect()->route('interventions.index')->with('success', 'Intervención eliminada correctamente.');
    }
}
