<?php

namespace App\Http\Controllers\OmapedControllers;

use App\Http\Controllers\Controller;
use App\Models\OmapedModels\OmPerson;
use Illuminate\Http\Request;

class OmPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las personas con sus relaciones (si es necesario)
        $people = OmPerson::with(['dwelling', 'disability', 'caregiver'])->get();
        return view('om_people.index', compact('people'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar formulario para registrar una nueva persona
        return view('om_people.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar datos de entrada
        $data = $request->validate([
            'registration_date' => 'required|date',
            'paternal_last_name' => 'required|string|max:255',
            'maternal_last_name' => 'required|string|max:255',
            'given_name' => 'required|string|max:255',
            'civil_status' => 'nullable|string|max:50',
            'dni' => 'required|string|max:8|unique:om_people',
            'birth_date' => 'required|date',
            'age' => 'required|integer',
            'gender' => 'required|string|max:10',
            'phone' => 'nullable|string|max:15',
            'education_level' => 'nullable|string|max:100',
            'occupation' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'observation' => 'nullable|string',
            'autonomy_record' => 'nullable|string',
            'social_program' => 'nullable|string',
            'dwelling_id' => 'nullable|integer|exists:om_dwellings,id',
            'disability_id' => 'nullable|integer|exists:disabilities,id',
            'caregiver_id' => 'nullable|integer|exists:caregivers,id',
        ]);

        // Crear nueva persona
        OmPerson::create($data);

        return redirect()->route('om_people.index')->with('success', 'Persona registrada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(OmPerson $omPerson)
    {
        // Mostrar los detalles de una persona
        return view('om_people.show', compact('omPerson'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OmPerson $omPerson)
    {
        // Mostrar formulario para editar una persona
        return view('om_people.edit', compact('omPerson'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OmPerson $omPerson)
    {
        // Validar datos de entrada
        $data = $request->validate([
            'registration_date' => 'required|date',
            'paternal_last_name' => 'required|string|max:255',
            'maternal_last_name' => 'required|string|max:255',
            'given_name' => 'required|string|max:255',
            'civil_status' => 'nullable|string|max:50',
            'dni' => 'required|string|max:8|unique:om_people,dni,' . $omPerson->id,
            'birth_date' => 'required|date',
            'age' => 'required|integer',
            'gender' => 'required|string|max:10',
            'phone' => 'nullable|string|max:15',
            'education_level' => 'nullable|string|max:100',
            'occupation' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'observation' => 'nullable|string',
            'autonomy_record' => 'nullable|string',
            'social_program' => 'nullable|string',
            'dwelling_id' => 'nullable|integer|exists:om_dwellings,id',
            'disability_id' => 'nullable|integer|exists:disabilities,id',
            'caregiver_id' => 'nullable|integer|exists:caregivers,id',
        ]);

        // Actualizar persona
        $omPerson->update($data);

        return redirect()->route('om_people.index')->with('success', 'Persona actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OmPerson $omPerson)
    {
        // Eliminar persona
        $omPerson->delete();
        return redirect()->route('om_people.index')->with('success', 'Persona eliminada con éxito.');
    }
}