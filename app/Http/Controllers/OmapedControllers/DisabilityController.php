<?php

namespace App\Http\Controllers\OmapedControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\OmapedRequests\Disability\StoreDisabilityRequest;
use App\Http\Requests\OmapedRequests\Disability\UpdateDisabilityRequest;
use App\Models\OmapedModels\Disability;
use Illuminate\Http\Request;

class DisabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las discapacidades
        $disabilities = Disability::all();
        return view('areas.OmapedViews.Disabilities.index', compact('disabilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar formulario para registrar una nueva discapacidad
        return view('areas.OmapedViews.Disabilities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDisabilityRequest $request)
    {
        Disability::create($request->validated());
        return redirect()->route('disabilities.index')->with('success', '¡Discapacidad creada exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Disability $disability)
    {
        // Mostrar detalles de una discapacidad
        return view('areas.OmapedViews.Disabilities.show', compact('disability'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Disability $disability)
    {
        // Mostrar formulario para editar una discapacidad
        return view('areas.OmapedViews.Disabilities.edit', compact('disability'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDisabilityRequest $request, Disability $disability)
    {
        $disability->update($request->validated());
        return redirect()->route('disabilities.index')->with('success', '¡Discapacidad actualizada exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Disability $disability)
    {
        // Eliminar discapacidad
        $disability->delete();
        return redirect()->route('disabilities.index')->with('success', 'Discapacidad eliminada con éxito.');
    }
}
