<?php

namespace App\Http\Controllers\CiamControllers;

use App\Http\Controllers\Controller;
use App\Models\CiamModels\Guardian;
use Illuminate\Http\Request;

class GuardianController extends Controller
{
    /**
     * Muestra una lista de todos los guardianes.
     */
    public function index()
    {
        // Obtiene todos los guardianes de la base de datos
        $guardians = Guardian::all();

        // Retorna la vista 'index' con la lista de guardianes
        return view('areas.CiamViews.Guardians.index', compact('guardians'));
    }

    /**
     * Muestra el formulario para crear un nuevo guardián.
     */
    public function create()
    {
        // Retorna la vista 'create' para un nuevo guardián
        return view('guardians.create');
    }

    /**
     * Almacena un nuevo guardián en la base de datos.
     */
    public function store(Request $request)
    {
        // Valida los datos recibidos
        $validatedData = $request->validate([
            'id' => 'required|string|max:36|unique:guardians,id',
            'document_type' => 'required|in:DNI,Pasaporte,Carnet,Cedula',
            'given_name' => 'required|string|max:50',
            'paternal_last_name' => 'required|string|max:50',
            'maternal_last_name' => 'required|string|max:50',
            'phone_number' => 'nullable|string|max:50',
        ]);

        // Crea un nuevo guardián con los datos validados
        Guardian::create($validatedData);

        // Redirige al listado con un mensaje de éxito
        return redirect()->route('guardians.index')->with('success', 'Guardián creado con éxito.');
    }

    /**
     * Muestra los detalles de un guardián específico.
     */
    public function show($id)
    {
        // Busca al guardián por su ID
        $guardian = Guardian::findOrFail($id);

        // Retorna la vista 'show' con los datos del guardián
        return view('guardians.show', compact('guardian'));
    }

    /**
     * Muestra el formulario para editar un guardián existente.
     */
    public function edit($id)
    {
        // Busca al guardián por su ID
        $guardian = Guardian::findOrFail($id);

        // Retorna la vista 'edit' con los datos del guardián
        return view('guardians.edit', compact('guardian'));
    }

    /**
     * Actualiza un guardián existente en la base de datos.
     */
    public function update(Request $request, $id)
    {
        // Valida los datos recibidos
        $validatedData = $request->validate([
            'document_type' => 'required|in:DNI,Pasaporte,Carnet,Cedula',
            'given_name' => 'required|string|max:50',
            'paternal_last_name' => 'required|string|max:50',
            'maternal_last_name' => 'required|string|max:50',
            'phone_number' => 'nullable|string|max:50',
        ]);

        // Busca al guardián por su ID y actualiza sus datos
        $guardian = Guardian::findOrFail($id);
        $guardian->update($validatedData);

        // Redirige al listado con un mensaje de éxito
        return redirect()->route('guardians.index')->with('success', 'Guardián actualizado con éxito.');
    }

    /**
     * Elimina un guardián de la base de datos.
     */
    public function destroy($id)
    {
        // Busca al guardián por su ID y lo elimina
        $guardian = Guardian::findOrFail($id);
        $guardian->delete();

        // Redirige al listado con un mensaje de éxito
        return redirect()->route('guardians.index')->with('success', 'Guardián eliminado con éxito.');
    }
}
