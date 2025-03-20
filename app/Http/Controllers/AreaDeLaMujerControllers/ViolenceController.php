<?php

namespace App\Http\Controllers\AreaDeLaMujerControllers;

use App\Models\AreaDeLaMujerModels\Violence;
use App\Http\Controllers\Controller;
use App\Http\Requests\AreaDeLaMujerRequests\AmPersonViolences\StoreViolenceRequest as AmPersonViolencesStoreViolenceRequest;
use App\Http\Requests\AreaDeLaMujerRequests\Violences\StoreViolenceRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ViolenceController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('ver BD');
        $violences = Violence::paginate(10);
        return view('areas.AreaDeLaMujerViews.Violences.index', compact('violences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('crear');
        return view('areas.AreaDeLaMujerViews.Violences.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreViolenceRequest $request)
    {
        Violence::create($request->validated());

        return redirect()->route('violences.index')->with('success', 'Violencia creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Violence $violence)
    {
        $this->authorize('ver detalles');
        return view('areas.AreaDeLaMujerViews.Violences.show', compact('violence'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Violence $violence)
    {
        $this->authorize('editar');
        return view('areas.AreaDeLaMujerViews.Violences.edit', compact('violence'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreViolenceRequest $request, Violence $violence)
    {

        $violence->update($request->validated());

        return redirect()->route('violences.index')->with('success', 'Violencia actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Violence $violence)
    {
        $this->authorize('eliminar');
        $violence->delete();

        return redirect()->route('violences.index')->with('success', 'Violencia eliminada exitosamente.');
    }
}
