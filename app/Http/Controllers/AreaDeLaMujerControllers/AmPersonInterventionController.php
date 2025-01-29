<?php

namespace App\Http\Controllers\AreaDeLaMujerControllers;

use App\Models\AreaDeLaMujerModels\AmPersonIntervention;
use App\Http\Controllers\Controller;
use App\Http\Requests\AreaDeLaMujerRequests\AmPersonInterventions\StoreAmPersonInterventionsRequest;
use App\Http\Requests\AreaDeLaMujerRequests\AmPersonInterventions\UpdateAmPersonInterventionsRequest;
use App\Models\AreaDeLaMujerModels\AmPerson;
use App\Models\AreaDeLaMujerModels\Intervention;
use Illuminate\Http\Request;

class AmPersonInterventionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $amPersonInterventions = AmPersonIntervention::with(['amPerson', 'intervention'])->paginate(10);
        return view('areas.AreaDeLaMujerViews.AmPersonInterventions.index', compact('amPersonInterventions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $amPersons = AmPerson::all();
        $interventions = Intervention::all();
        return view('areas.AreaDeLaMujerViews.AmPersonInterventions.create', compact('amPersons', 'interventions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAmPersonInterventionsRequest $request)
    {
        AmPersonIntervention::create($request->validated());
        return redirect()->route('am_person_interventions.index')->with('success', 'Relación creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AmPersonIntervention $amPersonIntervention)
    {
        return view('areas.AreaDeLaMujerViews.AmPersonInterventions.show', compact('amPersonIntervention'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AmPersonIntervention $amPersonIntervention)
    {
        $amPersons = AmPerson::all();
        $interventions = Intervention::all();
        return view('areas.AreaDeLaMujerViews.AmPersonInterventions.edit', compact('amPersonIntervention', 'amPersons', 'interventions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAmPersonInterventionsRequest $request, AmPersonIntervention $amPersonIntervention)
    {
        $amPersonIntervention->update($request->validated());
        return redirect()->route('am_person_interventions.index')->with('success', 'Relación actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AmPersonIntervention $amPersonIntervention)
    {
        $amPersonIntervention->delete();
        return redirect()->route('am_person_interventions.index')->with('success', 'Relación eliminada correctamente.');
    }
}
