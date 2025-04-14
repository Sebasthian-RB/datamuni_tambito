<?php

namespace App\Http\Controllers\OmapedControllers;

use App\Http\Controllers\Controller;
use App\Models\OmapedModels\OmPerson;
use App\Models\OmapedModels\PsychologicalDiagnosis;
use Illuminate\Http\Request;

class PsychologicalDiagnosisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diagnoses = PsychologicalDiagnosis::all();
        return view('areas.OmapedViews.psychological_diagnoses.index', compact('diagnoses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $people = OmPerson::all();
        return view('areas.OmapedViews.psychological_diagnoses.create', compact('people'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validamos los datos del formulario
        $validated = $request->validate([
            'om_person_id'        => 'required|exists:om_people,id',
            'diagnosis'           => 'nullable|string',
            'recommended_sessions' => 'required|integer|min:1',
            'diagnosis_date'      => 'required|date',
        ]);

        // Creamos el diagnóstico con los datos validados
        $diagnosis = PsychologicalDiagnosis::create($validated);

        // Redireccionamos al index con un mensaje de éxito
        return redirect()->route('psychological-diagnoses.index')
            ->with('success', 'Diagnóstico creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PsychologicalDiagnosis $psychologicalDiagnosis)
    {
        return view('areas.OmapedViews.psychological_diagnoses.show', compact('psychologicalDiagnosis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PsychologicalDiagnosis $psychologicalDiagnosis)
    {
        $people = OmPerson::all();
        return view('areas.OmapedViews.psychological_diagnoses.edit', compact('psychologicalDiagnosis','people'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PsychologicalDiagnosis $psychologicalDiagnosis)
    {
        // Validamos los datos del formulario de edición
        $validated = $request->validate([
            'om_person_id'        => 'required|exists:om_people,id',
            'diagnosis'           => 'nullable|string',
            'recommended_sessions' => 'required|integer|min:1',
            'diagnosis_date'      => 'required|date',
        ]);

        // Actualizamos el diagnóstico con los datos validados
        $psychologicalDiagnosis->update($validated);

        // Redireccionamos al index con un mensaje de éxito
        return redirect()->route('psychological-diagnoses.index')
            ->with('success', 'Diagnóstico actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PsychologicalDiagnosis $psychologicalDiagnosis)
    {
        // Eliminamos el diagnóstico
        $psychologicalDiagnosis->delete();

        // Redireccionamos al index con un mensaje de éxito
        return redirect()->route('psychological-diagnoses.index')
            ->with('success', 'Diagnóstico eliminado correctamente.');
    }
}
