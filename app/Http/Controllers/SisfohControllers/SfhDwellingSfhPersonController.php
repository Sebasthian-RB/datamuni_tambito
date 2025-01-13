<?php

namespace App\Http\Controllers\SisfohControllers;

use App\Models\SisfohModels\SfhDwellingSfhPerson;
use App\Http\Controllers\Controller;
use App\Http\Requests\SisfohRequests\SfhDwellingSfhPeople\IndexSfhDwellingSfhPersonRequest;
use App\Http\Requests\SisfohRequests\SfhDwellingSfhPeople\ShowSfhDwellingSfhPersonRequest;
use App\Http\Requests\SisfohRequests\SfhDwellingSfhPeople\CreateSfhDwellingSfhPersonRequest;
use App\Http\Requests\SisfohRequests\SfhDwellingSfhPeople\StoreSfhDwellingSfhPersonRequest;
use App\Http\Requests\SisfohRequests\SfhDwellingSfhPeople\EditSfhDwellingSfhPersonRequest;
use App\Http\Requests\SisfohRequests\SfhDwellingSfhPeople\UpdateSfhDwellingSfhPersonRequest;
use App\Http\Requests\SisfohRequests\SfhDwellingSfhPeople\DestroySfhDwellingSfhPersonRequest;

class SfhDwellingSfhPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexSfhDwellingSfhPersonRequest $request)
    {
        // Lógica para obtener la lista de SfhDwellingSfhPerson
        $sfhPersons = SfhDwellingSfhPerson::all(); // Puedes agregar paginación o filtros si es necesario

        return view('areas.SisfohViews.SfhDwellingSfhPerson.index', compact('sfhPersons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateSfhDwellingSfhPersonRequest $request)
    {
        // Lógica para mostrar el formulario de creación
        return view('areas.SisfohViews.SfhDwellingSfhPerson.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSfhDwellingSfhPersonRequest $request)
    {
        // Validar los datos
        $validated = $request->validated();

        // Crear un nuevo registro en la base de datos
        SfhDwellingSfhPerson::create($validated);

        // Redirigir o devolver la respuesta
        return redirect()->route('areas.SisfohViews.SfhDwellingSfhPerson.index')->with('success', 'Persona añadida a la vivienda con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(SfhDwellingSfhPerson $sfhDwellingSfhPerson, ShowSfhDwellingSfhPersonRequest $request)
    {
        // Mostrar los detalles del SfhDwellingSfhPerson
        return view('areas.SisfohViews.SfhDwellingSfhPerson.show', compact('sfhDwellingSfhPerson'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SfhDwellingSfhPerson $sfhDwellingSfhPerson, EditSfhDwellingSfhPersonRequest $request)
    {
        // Mostrar el formulario de edición
        return view('areas.SisfohViews.SfhDwellingSfhPerson.edit', compact('sfhDwellingSfhPerson'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSfhDwellingSfhPersonRequest $request, SfhDwellingSfhPerson $sfhDwellingSfhPerson)
    {
        // Validar los datos
        $validated = $request->validated();

        // Actualizar el registro en la base de datos
        $sfhDwellingSfhPerson->update($validated);

        // Redirigir o devolver la respuesta
        return redirect()->route('areas.SisfohViews.SfhDwellingSfhPerson.index')->with('success', 'Persona de vivienda actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SfhDwellingSfhPerson $sfhDwellingSfhPerson, DestroySfhDwellingSfhPersonRequest $request)
    {
        // Eliminar el registro
        $sfhDwellingSfhPerson->delete();

        // Redirigir o devolver la respuesta
        return redirect()->route('areas.SisfohViews.SfhDwellingSfhPerson.index')->with('success', 'Persona eliminada de la vivienda con éxito');
    }
}
