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

use App\Models\SisfohModels\SfhPerson; // Asumiendo que tienes un modelo relacionado para las personas

class SfhRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequestRequest $request)
    {
        $requests = SfhRequest::with('sfhPerson')->get(); // Cargar las solicitudes con la persona relacionada
        return view('areas.SisfohViews.Requests.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateRequestRequest $request)
    {
        // Obtener las personas relacionadas con las solicitudes (si es necesario)
        $people = SfhPerson::all();

        return view('areas.SisfohViews.Requests.create', compact('people'));  // Devolver vista para crear solicitud
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequestRequest $request)
    {
        $validated = $request->validated();  // Validar los datos
        SfhRequest::create($validated);  // Crear una nueva solicitud

        return redirect()->route('sfh_requests.index')->with('success', 'Solicitud creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SfhRequest $sfhRequest, ShowRequestRequest $request)
    {
        // Formatear las fechas para que estén en formato 'Y-m-d' antes de mostrar la solicitud
        $sfhRequest->date = $sfhRequest->date ? $sfhRequest->date->format('Y-m-d') : null;

        return view('areas.SisfohViews.Requests.show', compact('sfhRequest'));  // Devolver vista con los detalles de la solicitud
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SfhRequest $sfhRequest, EditRequestRequest $request)
    {
        // Formatear las fechas antes de pasarlas a la vista
        $sfhRequest->date = $sfhRequest->date ? $sfhRequest->date->format('Y-m-d') : null;

        // Obtener las personas relacionadas
        $people = SfhPerson::all();

        return view('areas.SisfohViews.Requests.edit', compact('sfhRequest', 'people'));  // Devolver vista para editar la solicitud
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequestRequest $request, SfhRequest $sfhRequest)
    {
        $validated = $request->validated();  // Validar los datos
        $sfhRequest->update($validated);  // Actualizar la solicitud existente

        // Formatear las fechas después de la actualización, si es necesario
        $sfhRequest->date = $sfhRequest->date ? \Carbon\Carbon::parse($sfhRequest->date)->format('Y-m-d') : null;

        return redirect()->route('sfh_requests.index')->with('success', 'Solicitud actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SfhRequest $sfhRequest, DestroyRequestRequest $request)
    {
        $sfhRequest->delete();  // Eliminar la solicitud

        return redirect()->route('sfh_requests.index')->with('success', 'Solicitud eliminada exitosamente.');
    }
}
