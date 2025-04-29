<?php

namespace App\Http\Controllers\AreaDeLaMujerControllers;

use App\Models\AreaDeLaMujerModels\AmPersonViolence;
use App\Http\Controllers\Controller;
use App\Http\Requests\AreaDeLaMujerRequests\AmPersonViolences\StoreAmPersonViolenceRequest;
use App\Http\Requests\AreaDeLaMujerRequests\AmPersonViolences\UpdateAmPersonViolenceRequest;
use App\Models\AreaDeLaMujerModels\AmPerson;
use App\Models\AreaDeLaMujerModels\Violence;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class AmPersonViolenceController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('ver BD');
        $search = $request->input('search');

        $amPersonViolences = AmPersonViolence::with(['amPerson', 'violence'])
            ->whereHas('amPerson', function ($query) use ($search) {
                if ($search) {
                    $query->where('given_name', 'like', "%$search%")
                        ->orWhere('paternal_last_name', 'like', "%$search%");
                }
            })
            ->paginate(10);

        return view('areas.AreaDeLaMujerViews.AmPersonViolences.index', compact('amPersonViolences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('crear');
        $amPersons = AmPerson::all();
        $violences = Violence::all();
        return view('areas.AreaDeLaMujerViews.AmPersonViolences.create', compact('amPersons', 'violences'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAmPersonViolenceRequest $request)
    {
        $this->authorize('crear');
        AmPersonViolence::create($request->validated());
        return redirect()->route('am_person_violences.index')->with('success', 'Relación creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AmPersonViolence $amPersonViolence)
    {
        $this->authorize('ver detalles');
        return view('areas.AreaDeLaMujerViews.AmPersonViolences.show', compact('amPersonViolence'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AmPersonViolence $amPersonViolence)
    {
        $this->authorize('editar');
        $amPersons = AmPerson::all();
        $violences = Violence::all();
        return view('areas.AreaDeLaMujerViews.AmPersonViolences.edit', compact('amPersonViolence', 'amPersons', 'violences'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAmPersonViolenceRequest $request, AmPersonViolence $amPersonViolence)
    {
        $this->authorize('editar');
        $amPersonViolence->update($request->validated());
        return redirect()->route('am_person_violences.index')->with('success', 'Relación actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AmPersonViolence $amPersonViolence)
    {
        $this->authorize('eliminar');
        $amPersonViolence->delete();

        return redirect()->route('am_person_violences.index')->with('success', 'Relación eliminada exitosamente.');
    }
}
