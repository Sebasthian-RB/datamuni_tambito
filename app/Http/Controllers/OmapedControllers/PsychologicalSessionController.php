<?php

namespace App\Http\Controllers\OmapedControllers;

use App\Http\Controllers\Controller;
use App\Models\OmapedModels\PsychologicalDiagnosis;
use App\Models\OmapedModels\PsychologicalSession;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PsychologicalSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index(Request $request)
{
    $query = PsychologicalSession::with(['diagnosis.person'])
        ->latest('scheduled_date');

    // Filtro por nombre
    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;
        $query->whereHas('diagnosis.person', function($q) use ($search) {
            $q->where('given_name', 'like', "%$search%")
              ->orWhere('paternal_last_name', 'like', "%$search%")
              ->orWhere('maternal_last_name', 'like', "%$search%");
        });
    }

    // Filtro por rango de fechas
    if ($request->has('date_range') && !empty($request->date_range)) {
        try {
            $dates = explode(' - ', $request->date_range);
            $startDate = Carbon::createFromFormat('d/m/Y', $dates[0])->startOfDay();
            $endDate = Carbon::createFromFormat('d/m/Y', $dates[1])->endOfDay();
            
            $query->whereBetween('scheduled_date', [$startDate, $endDate]);
        } catch (\Exception $e) {
            // Manejar error de formato de fecha
        }
    }

    $sessions = $query->paginate(15);

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
