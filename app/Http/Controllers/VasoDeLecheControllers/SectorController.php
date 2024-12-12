<?php

namespace App\Http\Controllers\VasoDeLecheControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VasoDeLecheModels\Sector;
use Illuminate\Support\Facades\Validator;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recuperar todos los sectores
        $sectors = Sector::all();
        return view('areas.VasoDeLecheViews.Sectors.index', compact('sectors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar formulario de creación
        return view('areas.VasoDeLecheViews.Sectors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'responsible_person' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('sectors.create')
                ->withErrors($validator)
                ->withInput();
        }

        // Crear un nuevo sector
        Sector::create($request->only(['name', 'description', 'responsible_person']));

        return redirect()->route('sectors.index')->with('success', 'Sector creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sector $sector)
    {
        // Mostrar detalles de un sector
        return view('areas.VasoDeLecheViews.Sectors.show', compact('sector'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sector $sector)
    {
        // Mostrar formulario de edición
        return view('areas.VasoDeLecheViews.Sectors.edit', compact('sector'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sector $sector)
    {
        // Validar los datos del formulario
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'responsible_person' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('sectors.edit', $sector->id)
                ->withErrors($validator)
                ->withInput();
        }

        // Actualizar el sector
        $sector->update($request->only(['name', 'description', 'responsible_person']));

        return redirect()->route('sectors.index')->with('success', 'Sector actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sector $sector)
    {
        // Eliminar el sector
        $sector->delete();

        return redirect()->route('sectors.index')->with('success', 'Sector eliminado correctamente.');
    }
}
