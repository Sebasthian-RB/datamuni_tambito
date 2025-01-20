<?php

namespace App\Http\Controllers\OmapedControllers;

use App\Http\Controllers\Controller;
use App\Models\OmapedModels\Disability;
use Illuminate\Http\Request;

class DisabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las discapacidades
        $disabilities = Disability::all();
        return view('disabilities.index', compact('disabilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar formulario para registrar una nueva discapacidad
        return view('disabilities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar datos de entrada
        $data = $request->validate([
            'certificate_number' => 'required|string|max:255|unique:disabilities',
            'organization' => 'nullable|string|max:255',
            'diagnosis' => 'nullable|string|max:255',
            'disability_type' => 'required|string|max:255',
            'severity_level' => 'required|string|max:255',
            'required_support' => 'nullable|string|max:255',
            'used_support' => 'nullable|string|max:255',
            'health_insurance' => 'nullable|string|max:255',
            'sisfoh' => 'nullable|boolean',
            'issuance_date' => 'required|date',
            'expiration_date' => 'nullable|date|after_or_equal:issuance_date',
        ]);

        // Crear nueva discapacidad
        Disability::create($data);

        return redirect()->route('disabilities.index')->with('success', 'Discapacidad registrada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Disability $disability)
    {
        // Mostrar detalles de una discapacidad
        return view('disabilities.show', compact('disability'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Disability $disability)
    {
        // Mostrar formulario para editar una discapacidad
        return view('disabilities.edit', compact('disability'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Disability $disability)
    {
        // Validar datos de entrada
        $data = $request->validate([
            'certificate_number' => 'required|string|max:255|unique:disabilities,certificate_number,' . $disability->id,
            'organization' => 'nullable|string|max:255',
            'diagnosis' => 'nullable|string|max:255',
            'disability_type' => 'required|string|max:255',
            'severity_level' => 'required|string|max:255',
            'required_support' => 'nullable|string|max:255',
            'used_support' => 'nullable|string|max:255',
            'health_insurance' => 'nullable|string|max:255',
            'sisfoh' => 'nullable|boolean',
            'issuance_date' => 'required|date',
            'expiration_date' => 'nullable|date|after_or_equal:issuance_date',
        ]);

        // Actualizar discapacidad
        $disability->update($data);

        return redirect()->route('disabilities.index')->with('success', 'Discapacidad actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Disability $disability)
    {
        // Eliminar discapacidad
        $disability->delete();
        return redirect()->route('disabilities.index')->with('success', 'Discapacidad eliminada con éxito.');
    }
}
