<?php

namespace App\Http\Controllers\OmapedControllers;

use App\Http\Controllers\Controller;
use App\Models\OmapedModels\PsychologicalDiagnosis;
use App\Models\OmapedModels\PsychologicalSession;
use Illuminate\Http\Request;

class PsychologyDashboardController extends Controller
{
    public function index(Request $request)
{
    // Rango de fechas opcional
    $start = $request->input('start_date');
    $end = $request->input('end_date');

    // Total de personas únicas derivadas a psicología
    $uniquePeopleCount = PsychologicalDiagnosis::distinct('om_person_id')->count('om_person_id');

    // Total de sesiones registradas (filtradas por fecha si aplica)
    $sessionsQuery = PsychologicalSession::query();
    if ($start && $end) {
        $sessionsQuery->whereBetween('scheduled_date', [$start, $end]);
    }
    $totalSessions = $sessionsQuery->count();

    // Agrupar sesiones por fecha
    $sessionsByDate = PsychologicalSession::selectRaw('DATE(scheduled_date) as date, COUNT(*) as total')
        ->when($start && $end, fn($q) => $q->whereBetween('scheduled_date', [$start, $end]))
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

    return view('areas.OmapedViews.OMPSYDashboard', compact(
        'uniquePeopleCount',
        'totalSessions',
        'sessionsByDate',
        'start',
        'end'
    ));
}
}
