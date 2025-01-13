<?php

namespace App\Http\Controllers\SisfohControllers;

use App\Models\SisfohModels\SfhRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\SisfohRequests\Requests\IndexRequestRequest;
use App\Http\Requests\SisfohRequests\Requests\ShowRequestRequest;
use App\Http\Requests\SisfohRequests\Requests\CreateRequestRequest;
use App\Http\Requests\SisfohRequests\Requests\StoreRequestRequest;
use App\Http\Requests\SisfohRequests\Requests\EditRequestRequest;
use App\Http\Requests\SisfohRequests\Requests\UpdateRequestRequest;
use App\Http\Requests\SisfohRequests\Requests\DestroyRequestRequest;

class SfhRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequestRequest $request)
    {
        $requests = SfhRequest::all();  // Obtener todas las solicitudes
        return view('areas.SisfohViews.Requests.index', compact('requests'));  // Devolver vista con las solicitudes
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateRequestRequest $request)
    {
        return view('areas.SisfohViews.Requests.create');  // Devolver vista para crear solicitud
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequestRequest $request)
    {
        $validated = $request->validated();  // Validar los datos
        SfhRequest::create($validated);  // Crear una nueva solicitud

        return redirect()->route('areas.SisfohViews.Requests.index')->with('success', 'Solicitud creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SfhRequest $sfhRequest, ShowRequestRequest $request)
    {
        return view('areas.SisfohViews.Requests.show', compact('sfhRequest'));  // Devolver vista con los detalles de la solicitud
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SfhRequest $sfhRequest, EditRequestRequest $request)
    {
        return view('areas.SisfohViews.Requests.edit', compact('sfhRequest'));  // Devolver vista para editar la solicitud
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequestRequest $request, SfhRequest $sfhRequest)
    {
        $validated = $request->validated();  // Validar los datos
        $sfhRequest->update($validated);  // Actualizar la solicitud existente

        return redirect()->route('areas.SisfohViews.Requests.index')->with('success', 'Solicitud actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SfhRequest $sfhRequest, DestroyRequestRequest $request)
    {
        $sfhRequest->delete();  // Eliminar la solicitud

        return redirect()->route('areas.SisfohViews.Requests.index')->with('success', 'Solicitud eliminada exitosamente.');
    }
}
