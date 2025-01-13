<?php

namespace App\Http\Controllers\SisfohControllers;

use App\Models\SisfohModels\SfhPerson;
use App\Http\Controllers\Controller;
use App\Http\Requests\SisfohRequests\SfhPeople\IndexSfhPersonRequest;
use App\Http\Requests\SisfohRequests\SfhPeople\ShowSfhPersonRequest;
use App\Http\Requests\SisfohRequests\SfhPeople\CreateSfhPersonRequest;
use App\Http\Requests\SisfohRequests\SfhPeople\StoreSfhPersonRequest;
use App\Http\Requests\SisfohRequests\SfhPeople\EditSfhPersonRequest;
use App\Http\Requests\SisfohRequests\SfhPeople\UpdateSfhPersonRequest;
use App\Http\Requests\SisfohRequests\SfhPeople\DestroySfhPersonRequest;

class SfhPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexSfhPersonRequest $request)
    {
        // Validar la solicitud si es necesario
        $validated = $request->validated();
        
        // Obtener todos los registros de personas
        $people = SfhPerson::all();
        
        // Retornar la vista con la lista de personas
        return view('areas.SisfohViews.SfhPeople.index', compact('people'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateSfhPersonRequest $request)
    {
        // Validar la solicitud si es necesario
        $validated = $request->validated();
        
        // Retornar la vista para crear una persona
        return view('areas.SisfohViews.SfhPeople.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSfhPersonRequest $request)
    {
        // Validar la solicitud si es necesario
        $validated = $request->validated();
        
        // Crear una nueva persona con los datos validados
        $person = SfhPerson::create($request->all());

        // Redirigir a la lista de personas con un mensaje de éxito
        return redirect()->route('areas.SisfohViews.SfhPeople.index')->with('success', 'Persona creada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowSfhPersonRequest $request, SfhPerson $sfhPerson)
    {
        // Validar la solicitud si es necesario
        $validated = $request->validated();
        
        // Retornar la vista para mostrar los detalles de una persona
        return view('areas.SisfohViews.SfhPeople.show', compact('sfhPerson'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EditSfhPersonRequest $request, SfhPerson $sfhPerson)
    {
        // Validar la solicitud si es necesario
        $validated = $request->validated();
        
        // Retornar la vista para editar una persona
        return view('areas.SisfohViews.SfhPeople.edit', compact('sfhPerson'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSfhPersonRequest $request, SfhPerson $sfhPerson)
    {
        // Validar la solicitud si es necesario
        $validated = $request->validated();
        
        // Actualizar los datos de la persona
        $sfhPerson->update($request->all());

        // Redirigir a la lista de personas con un mensaje de éxito
        return redirect()->route('areas.SisfohViews.SfhPeople.index')->with('success', 'Persona actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroySfhPersonRequest $request, SfhPerson $sfhPerson)
    {
        // Validar la solicitud si es necesario
        $validated = $request->validated();
        
        // Eliminar la persona
        $sfhPerson->delete();

        // Redirigir a la lista de personas con un mensaje de éxito
        return redirect()->route('areas.SisfohViews.SfhPeople.index')->with('success', 'Persona eliminada con éxito.');
    }
}

