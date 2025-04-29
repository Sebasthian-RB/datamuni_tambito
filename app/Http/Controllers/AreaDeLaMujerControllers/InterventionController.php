<?php

namespace App\Http\Controllers\AreaDeLaMujerControllers;

use App\Models\AreaDeLaMujerModels\Intervention;
use App\Http\Controllers\Controller;
use App\Http\Requests\AreaDeLaMujerRequests\AmPersonInterventions\StoreAmPersonInterventionsRequest;
use App\Http\Requests\AreaDeLaMujerRequests\Interventions\StoreInterventionRequest;
use App\Http\Requests\AreaDeLaMujerRequests\Interventions\UpdateInterventionRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class InterventionController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('ver BD');
        $interventions = Intervention::paginate(10);
        return view('areas.AreaDeLaMujerViews.Interventions.index', compact('interventions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('crear');
        return view('areas.AreaDeLaMujerViews.Interventions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInterventionRequest $request)
    {
        $this->authorize('crear');
        // Crear la intervención con datos validados
        $intervention = Intervention::create($request->validated());

        // Verificar si la solicitud es AJAX
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Intervención creada correctamente.',
                'data' => $intervention
            ]);
        }

        // Redirección tradicional si no es una solicitud AJAX
        return redirect()->route('interventions.index')->with('success', 'Intervención creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Intervention $intervention)
    {
        $this->authorize('ver detalles');
        return view('areas.AreaDeLaMujerViews.Interventions.show', compact('intervention'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Intervention $intervention)
    {
        $this->authorize('editar');
        return view('areas.AreaDeLaMujerViews.Interventions.edit', compact('intervention'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInterventionRequest $request, Intervention $intervention)
    {
        $this->authorize('editar');
        $intervention->update($request->validated());

        return redirect()->route('interventions.index')->with('success', 'Intervención actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Intervention $intervention)
    {
        $this->authorize('eliminar');
        $intervention->delete();
        return redirect()->route('interventions.index')->with('success', 'Intervención eliminada correctamente.');
    }
}
