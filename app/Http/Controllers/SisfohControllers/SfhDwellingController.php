<?php

namespace App\Http\Controllers\SisfohControllers;

use App\Models\SisfohModels\SfhDwelling;
use App\Http\Controllers\Controller;
use App\Http\Requests\SisfohRequests\SfhDwellings\IndexSfhDwellingRequest;
use App\Http\Requests\SisfohRequests\SfhDwellings\ShowSfhDwellingRequest;
use App\Http\Requests\SisfohRequests\SfhDwellings\CreateSfhDwellingRequest;
use App\Http\Requests\SisfohRequests\SfhDwellings\StoreSfhDwellingRequest;
use App\Http\Requests\SisfohRequests\SfhDwellings\EditSfhDwellingRequest;
use App\Http\Requests\SisfohRequests\SfhDwellings\UpdateSfhDwellingRequest;
use App\Http\Requests\SisfohRequests\SfhDwellings\DestroySfhDwellingRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SfhDwellingController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(IndexSfhDwellingRequest $request)
    {
        $this->authorize('ver BD');
        // Lógica para obtener la lista de SfhDwellings
        $sfhDwellings = SfhDwelling::all(); // Puedes agregar paginación o filtros si es necesario

        return view('areas.SisfohViews.SfhDwellings.index', compact('sfhDwellings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateSfhDwellingRequest $request)
    {
        $this->authorize('crear');
        // Lógica para mostrar el formulario de creación
        return view('areas.SisfohViews.SfhDwellings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSfhDwellingRequest $request)
    {
        // Validar los datos
        $validated = $request->validated();

        // Crear un nuevo registro en la base de datos
        SfhDwelling::create($validated);

        // Redirigir o devolver la respuesta
        return redirect()->route('sfh_dwelling.index')->with('success', 'Vivienda creada con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(SfhDwelling $sfhDwelling, ShowSfhDwellingRequest $request)
    {
        $this->authorize('ver detalles');
        // Mostrar los detalles del SfhDwelling
        return view('areas.SisfohViews.SfhDwellings.show', compact('sfhDwelling'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SfhDwelling $sfhDwelling, EditSfhDwellingRequest $request)
    {
        $this->authorize('editar');
        // Mostrar el formulario de edición
        return view('areas.SisfohViews.SfhDwellings.edit', compact('sfhDwelling'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSfhDwellingRequest $request, SfhDwelling $sfhDwelling)
    {
        // Validar los datos
        $validated = $request->validated();

        // Actualizar el registro en la base de datos
        $sfhDwelling->update($validated);

        // Redirigir o devolver la respuesta
        return redirect()->route('sfh_dwelling.index')->with('success', 'Vivienda actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SfhDwelling $sfhDwelling, DestroySfhDwellingRequest $request)
    {
        $this->authorize('eliminar');
        // Eliminar el registro
        $sfhDwelling->delete();

        // Redirigir o devolver la respuesta
        return redirect()->route('sfh_dwelling.index')->with('success', 'Vivienda eliminada con éxito');
    }
}
