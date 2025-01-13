<?php

namespace App\Http\Controllers\AreaDeLaMujerControllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\AreaDeLaMujerModels\Event;
use App\Models\AreaDeLaMujerModels\Intervention;
use App\Models\AreaDeLaMujerModels\Violence;
use Illuminate\Http\Request;

class AmDashboardController extends Controller
{
    public function index()
{
    // Total de Eventos
    $totalEvents = DB::table('events')->count();

    // Estadísticas por Estado de Eventos
    $eventStatusStats = DB::table('events')
        ->select('status', DB::raw('COUNT(id) as count'))
        ->groupBy('status')
        ->get();

    // Últimos eventos registrados (ordenados por fecha de creación)
    $recentEvents = DB::table('events')
    ->select('name', 'place', 'start_date', 'status')
    ->orderBy('created_at', 'desc')
    ->limit(5) // Cambiar a la cantidad que desees mostrar
    ->get();

    // Total de intervenciones
    $totalInterventions = DB::table('interventions')->count();

    // Total de personas únicas participando en intervenciones
    $totalUniquePersonsInInterventions = DB::table('am_person_interventions')
        ->select('am_person_id')
        ->distinct()
        ->count();

    // Cantidad de intervenciones por estado
    $interventionStatusStats = DB::table('am_person_interventions')
        ->select('status', DB::raw('COUNT(id) as count'))
        ->groupBy('status')
        ->get();

     // Últimas relaciones entre intervenciones y personas
     $recentPersonInterventions = DB::table('am_person_interventions')
     ->join('am_people', 'am_person_interventions.am_person_id', '=', 'am_people.id')
     ->join('interventions', 'am_person_interventions.intervention_id', '=', 'interventions.id')
     ->select(
         'am_people.given_name',
         'am_people.paternal_last_name',
         'am_people.maternal_last_name',
         'interventions.appointment',
         'interventions.appointment_date',
         'am_person_interventions.status'
     )
     ->orderBy('am_person_interventions.created_at', 'desc')
     ->limit(5)
     ->get();

    // Consulta para el gráfico: Cantidad de personas por tipo de violencia
    $violenceStats = DB::table('am_person_violences')
        ->join('violences', 'am_person_violences.violence_id', '=', 'violences.id')
        ->select('violences.kind_violence', DB::raw('COUNT(DISTINCT am_person_violences.am_person_id) as person_count'))
        ->groupBy('violences.kind_violence')
        ->get();

    // Contar el total de violencias registradas
    $totalViolences = DB::table('am_person_violences')->count();
            
    // Consulta para obtener las últimas violencias registradas
    $recentViolences = DB::table('violences')
    ->orderBy('created_at', 'desc')  // Ordenamos por la fecha de creación
    ->limit(5)  // Limitar a las últimas 5 violencias
    ->get();
    
    // Total de personas únicas registradas en la tabla relacional
    $totalUniquePersons = DB::table('am_person_violences')
        ->distinct('am_person_id')
        ->count('am_person_id');

    // Pasar los datos a la vista
    return view('areas.AreaDeLaMujerViews.ADLMDashboard', [
        'totalEvents' => $totalEvents,
        'recentEvents' => $recentEvents,
        'violenceStats' => $violenceStats,
        'totalViolences' => $totalViolences,
        'recentViolences' => $recentViolences,
        'eventStatusStats' => $eventStatusStats,
        'totalUniquePersons' => $totalUniquePersons,   
        'totalInterventions' => $totalInterventions,
        'interventionStatusStats' => $interventionStatusStats,
        'recentPersonInterventions' => $recentPersonInterventions,
        'totalUniquePersonsInInterventions' => $totalUniquePersonsInInterventions,
        // El orden de todo es para que se vea bonito en escalerita (Personame Sebas)
    ]);
}

}
