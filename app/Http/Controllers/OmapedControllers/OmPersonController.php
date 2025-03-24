<?php

namespace App\Http\Controllers\OmapedControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\OmapedRequests\OmPerson\StoreOmPersonRequest;
use App\Http\Requests\OmapedRequests\OmPerson\UpdateOmPersonRequest;
use App\Models\OmapedModels\Caregiver;
use App\Models\OmapedModels\Disability;
use App\Models\OmapedModels\OmDwelling;
use App\Models\OmapedModels\OmPerson;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class OmPersonController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('ver BD');
        // Obtener todas las personas con sus relaciones (si es necesario)
        $people = OmPerson::with(['dwelling', 'disability', 'caregiver'])->paginate(6);
        return view('areas.OmapedViews.OmPeople.index', compact('people'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('crear');
        $dwellings = OmDwelling::all();
        $disabilities = Disability::all();
        $caregivers = Caregiver::all();
        return view('areas.OmapedViews.OmPeople.create', compact('dwellings', 'disabilities', 'caregivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOmPersonRequest $request)
    {
        // Obtener los datos validados
        $validatedData = $request->validated();

        // Convertir la fecha al formato correcto
        $validatedData['registration_date'] = \Carbon\Carbon::parse($request->registration_date)->format('Y-m-d H:i:s');

        // Guardar en la base de datos
        OmPerson::create($validatedData);

        return redirect()->route('om-people.index')->with('success', 'Persona registrada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(OmPerson $omPerson)
    {
        $this->authorize('ver detalles');
        // Mostrar los detalles de una persona
        return view('areas.OmapedViews.OmPeople.show', compact('omPerson'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OmPerson $omPerson)
    {
        $this->authorize('editar');
        // Mostrar formulario para editar una persona
        $dwellings = OmDwelling::all();
        $disabilities = Disability::all();
        $caregivers = Caregiver::all();
        return view('areas.OmapedViews.OmPeople.edit', compact('omPerson', 'dwellings', 'disabilities', 'caregivers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOmPersonRequest $request, OmPerson $omPerson)
    {
        $validatedData = $request->validated();

        // Convertir fecha y hora correctamente
        if ($request->has('registration_date')) {
            $validatedData['registration_date'] = \Carbon\Carbon::parse($request->registration_date)->format('Y-m-d H:i:s');
        }
        // Actualizar la persona en la base de datos
        $omPerson->update($validatedData);

        return redirect()->route('om-people.index')->with('success', 'Persona actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OmPerson $omPerson)
    {
        $this->authorize('eliminar');
        // Eliminar persona
        $omPerson->delete();
        return redirect()->route('om-people.index')->with('success', 'Persona eliminada con éxito.');
    }
}
