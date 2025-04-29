<?php

namespace App\Http\Controllers\AreaDeLaMujerControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AreaDeLaMujerRequests\AmPeople\StoreAmPersonRequest;
use App\Http\Requests\AreaDeLaMujerRequests\AmPeople\UpdateAmPersonRequest;
use App\Models\AreaDeLaMujerModels\AmPerson;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;

class AmPersonController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('ver BD');

        $query = AmPerson::query();

        if ($request->has('search')) {
            $search = $request->input('search');
    
            // Si el valor es un número, busca también por ID
            if (is_numeric($search)) {
                $query->where('id', $search);
            } else {
                $query->where('identity_document', 'like', "%$search%")
                      ->orWhere('given_name', 'like', "%$search%")
                      ->orWhere('paternal_last_name', 'like', "%$search%")
                      ->orWhere('maternal_last_name', 'like', "%$search%");
            }
        }
        // Recuperamos todas las personas
        $people = $query->paginate(15);
        return view('areas.AreaDeLaMujerViews.AmPersons.index', compact('people'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('crear');
        // Mostrar formulario de creación
        return view('areas.AreaDeLaMujerViews.AmPersons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAmPersonRequest $request)
    {
        $this->authorize('crear');
        // Crear la nueva persona con los datos validados
        $person = AmPerson::create($request->validated());

        // Retornar la persona creada como JSON
        return response()->json([
            'id' => $person->id,
            'given_name' => $person->given_name,
            'paternal_last_name' => $person->paternal_last_name,
            'maternal_last_name' => $person->maternal_last_name,
            'success' => true,
            'message' => 'Persona creada correctamente.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(AmPerson $amPerson)
    {
        $this->authorize('ver detalles');
        // Mostrar los detalles de una persona
        return view('areas.AreaDeLaMujerViews.AmPersons.show', compact('amPerson'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AmPerson $amPerson)
    {
        $this->authorize('editar');
        // Mostrar formulario de edición
        return view('areas.AreaDeLaMujerViews.AmPersons.edit', compact('amPerson'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAmPersonRequest $request, AmPerson $amPerson)
    {
        $this->authorize('editar');
        $amPerson->update($request->validated());

        return redirect()->route('am_people.index')->with('success', 'Persona actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AmPerson $amPerson)
    {
        $this->authorize('eliminar');
        // Eliminar la persona
        $amPerson->delete();

        return redirect()->route('am_people.index')->with('success', 'Persona eliminada correctamente.');
    }
}
