<?php

namespace App\Http\Controllers\AreaDeLaMujerControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AreaDeLaMujerRequests\AmPeople\StoreAmPersonRequest;
use App\Http\Requests\AreaDeLaMujerRequests\AmPeople\UpdateAmPersonRequest;
use App\Models\AreaDeLaMujerModels\AmPerson;
use Illuminate\Support\Facades\Validator;

class AmPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recuperamos todas las personas
        $people = AmPerson::all();
        return view('areas.AreaDeLaMujerViews.AmPersons.index', compact('people'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar formulario de creación
        return view('areas.AreaDeLaMujerViews.AmPersons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAmPersonRequest $request)
    {
        AmPerson::create($request->validated());
        return redirect()->route('am_people.index')->with('success', 'Persona creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AmPerson $amPerson)
    {
         // Mostrar los detalles de una persona
         return view('areas.AreaDeLaMujerViews.AmPersons.show', compact('amPerson'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AmPerson $amPerson)
    {
        // Mostrar formulario de edición
        return view('areas.AreaDeLaMujerViews.AmPersons.edit', compact('amPerson'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAmPersonRequest $request, AmPerson $amPerson)
    {
        $amPerson->update($request->validated());
        return redirect()->route('am_people.index')->with('success', 'Persona actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AmPerson $amPerson)
    {
        // Eliminar la persona
        $amPerson->delete();

        return redirect()->route('am_people.index')->with('success', 'Persona eliminada correctamente.');
    }
}
