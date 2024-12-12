<?php

namespace App\Http\Controllers\AreaDeLaMujerControllers;

use App\Models\AreaDeLaMujerModels\Violence;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViolenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $violences = Violence::all();
        return view('areas.AreaDeLaMujerViews.Violences.index', compact('violences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('areas.AreaDeLaMujerViews.Violences.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kind_violence' => 'required|string|max:70',
            'description' => 'required|string',
        ]);

        Violence::create($request->all());

        return redirect()->route('violences.index')->with('success', 'Violencia creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Violence $violence)
    {
        return view('areas.AreaDeLaMujerViews.Violences.show', compact('violence'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Violence $violence)
    {
        return view('areas.AreaDeLaMujerViews.Violences.edit', compact('violence'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Violence $violence)
    {
        $request->validate([
            'kind_violence' => 'required|string|max:70',
            'description' => 'required|string',
        ]);

        $violence->update($request->all());

        return redirect()->route('violences.index')->with('success', 'Violencia actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Violence $violence)
    {
        $violence->delete();

        return redirect()->route('violences.index')->with('success', 'Violencia eliminada exitosamente.');
    }
}
