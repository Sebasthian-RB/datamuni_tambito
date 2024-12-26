<?php

namespace App\Http\Controllers\AreaDeLaMujerControllers;

use App\Models\AreaDeLaMujerModels\AmPersonViolence;
use App\Http\Controllers\Controller;
use App\Http\Requests\AreaDeLaMujerRequests\AmPersonViolences\StoreAmPersonViolenceRequest;
use App\Http\Requests\AreaDeLaMujerRequests\AmPersonViolences\UpdateAmPersonViolenceRequest;
use App\Models\AreaDeLaMujerModels\AmPerson;
use App\Models\AreaDeLaMujerModels\Violence;
use Illuminate\Http\Request;

class AmPersonViolenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $amPersonViolences = AmPersonViolence::with(['amPerson', 'violence'])->get();
        return view('areas.AreaDeLaMujerViews.AmPersonViolences.index', compact('amPersonViolences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $amPersons = AmPerson::all();
        $violences = Violence::all();
        return view('areas.AreaDeLaMujerViews.AmPersonViolences.create', compact('amPersons', 'violences'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAmPersonViolenceRequest $request)
    {
        AmPersonViolence::create($request->validated());
        return redirect()->route('am_person_violences.index')->with('success', 'Relación creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AmPersonViolence $amPersonViolence)
    {
        return view('areas.AreaDeLaMujerViews.AmPersonViolences.show', compact('amPersonViolence'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AmPersonViolence $amPersonViolence)
    {
        $amPersons = AmPerson::all();
        $violences = Violence::all();
        return view('areas.AreaDeLaMujerViews.AmPersonViolences.edit', compact('amPersonViolence', 'amPersons', 'violences'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAmPersonViolenceRequest $request, AmPersonViolence $amPersonViolence)
    {
        $amPersonViolence->update($request->validated());
        return redirect()->route('am_person_violences.index')->with('success', 'Relación actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AmPersonViolence $amPersonViolence)
    {
        $amPersonViolence->delete();

        return redirect()->route('am_person_violences.index')->with('success', 'Relación eliminada exitosamente.');
    }
}
