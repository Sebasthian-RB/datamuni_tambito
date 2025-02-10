<?php

namespace App\Http\Controllers\SisfohControllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SfhDashboardController extends Controller
{
    public function index()
    {
        // 📌 Total de Visitas Registradas
        $totalVisits = DB::table('visits')->count();

        // 📊 Estadísticas por Estado de Visita
        $visitStatusStats = DB::table('visits')
            ->select('status', DB::raw('COUNT(id) as count'))
            ->groupBy('status')
            ->get();

        // 🔍 Últimas visitas registradas
        $recentVisits = DB::table('visits')
            ->join('enumerators', 'visits.enumerator_id', '=', 'enumerators.id')
            ->select('visits.visit_date', 'visits.status', 'enumerators.given_name as enumerator')
            ->orderBy('visits.created_at', 'desc')
            ->limit(5)
            ->get();

        // 🎯 Total de Instrumentos Aplicados
        $totalInstrumentsApplied = DB::table('instrument_visits')->count();

        // 📌 Cantidad de Instrumentos Aplicados por Tipo
        $instrumentTypeStats = DB::table('instrument_visits')
            ->join('instruments', 'instrument_visits.instrument_id', '=', 'instruments.id')
            ->select('instruments.type_instruments', DB::raw('COUNT(instrument_visits.id) as count'))
            ->groupBy('instruments.type_instruments')
            ->get();

        // 📑 Últimos Instrumentos Aplicados
        $recentInstrumentsApplied = DB::table('instrument_visits')
            ->join('instruments', 'instrument_visits.instrument_id', '=', 'instruments.id')
            ->join('visits', 'instrument_visits.visit_id', '=', 'visits.id')
            ->select('instruments.name_instruments', 'instrument_visits.application_date', 'visits.visit_date')
            ->orderBy('instrument_visits.created_at', 'desc')
            ->limit(5)
            ->get();

        // 📌 Total de Solicitudes de Ayuda
        $totalRequests = DB::table('sfh_requests')->count();

        // 📊 Cantidad de Solicitudes por Fecha (Año/Mes)
        $requestDateStats = DB::table('sfh_requests')
            ->select(DB::raw('YEAR(request_date) as year, MONTH(request_date) as month, COUNT(id) as count'))
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get()
            ->map(function ($r) {
                $r->formatted_date = $r->year . '-' . str_pad($r->month, 2, '0', STR_PAD_LEFT);
                return $r;
            });

        // 🔍 Últimas Solicitudes Registradas
        $recentRequests = DB::table('sfh_requests')
            ->select('sfh_requests.id', 'sfh_requests.request_date', 'sfh_requests.description', 'sfh_requests.sfh_person_id')
            ->orderBy('sfh_requests.request_date', 'desc')
            ->limit(5)
            ->get();

        // 👨‍👩‍👧‍👦 Total de Personas Únicas Asociadas a Viviendas
        $totalUniquePersonsInDwellings = DB::table('sfh_dwelling_sfh_people')
            ->distinct('sfh_person_id')
            ->count('sfh_person_id');

        // 🏠 Cantidad de Viviendas Activas e Inactivas
        $dwellingStatusStats = DB::table('sfh_dwelling_sfh_people')
            ->select('status', DB::raw('COUNT(id) as count'))
            ->groupBy('status')
            ->get();

        // 📊 Pasar datos a la vista
        return view('areas.SisfohViews.SfhDashboard', [
            'totalVisits' => $totalVisits,
            'visitStatusStats' => $visitStatusStats,
            'recentVisits' => $recentVisits,
            'totalInstrumentsApplied' => $totalInstrumentsApplied,
            'instrumentTypeStats' => $instrumentTypeStats,
            'recentInstrumentsApplied' => $recentInstrumentsApplied,
            'totalRequests' => $totalRequests,
            'requestDateStats' => $requestDateStats,
            'recentRequests' => $recentRequests,
            'totalUniquePersonsInDwellings' => $totalUniquePersonsInDwellings,
            'dwellingStatusStats' => $dwellingStatusStats,
        ]);
    }
}
