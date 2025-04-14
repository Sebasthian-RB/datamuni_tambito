<?php

namespace App\Http\Controllers\OmapedControllers;

use App\Http\Controllers\Controller;
use App\Models\OmapedModels\PsychologicalDiagnosis;
use App\Models\OmapedModels\PsychologicalSession;
use Illuminate\Http\Request;

class PsychologicalSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessions = PsychologicalSession::all();
        return view('areas.OmapedViews.psychological_sessions.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $diagnoses = PsychologicalDiagnosis::with('person')->get();
        return view('areas.OmapedViews.psychological_sessions.create', compact('diagnoses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'diagnosis_id'       => 'required|exists:psychological_diagnoses,id',
            'session_number'     => 'required|integer|min:1',
            'scheduled_date'     => 'required|date',
            'attendance_status'  => 'nullable|in:Asistió,No asistió,Justificó',
            'description'        => 'nullable|string',
        ]);
        
        PsychologicalSession::create($validated);
        return redirect()->route('psychological-sessions.index')
            ->with('success', 'Sesión creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PsychologicalSession $psychologicalSession)
    {
        return view('areas.OmapedViews.psychological_sessions.show', compact('psychologicalSession'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PsychologicalSession $psychologicalSession)
    {
        $diagnoses = PsychologicalDiagnosis::all();
        return view('areas.OmapedViews.psychological_sessions.edit', compact('psychologicalSession', 'diagnoses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PsychologicalSession $psychologicalSession)
    {
        $validated = $request->validate([
            'diagnosis_id'       => 'required|exists:psychological_diagnoses,id',
            'session_number'     => 'required|integer|min:1',
            'scheduled_date'     => 'required|date',
            'attendance_status'  => 'nullable|in:Asistió,No asistió,Justificó',
            'description'        => 'nullable|string',
        ]);
        
        $psychologicalSession->update($validated);
        return redirect()->route('psychological-sessions.index')
            ->with('success', 'Sesión actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PsychologicalSession $psychologicalSession)
    {
        $psychologicalSession->delete();
        return redirect()->route('psychological-sessions.index')
            ->with('success', 'Sesión eliminada correctamente.');
    }
}
