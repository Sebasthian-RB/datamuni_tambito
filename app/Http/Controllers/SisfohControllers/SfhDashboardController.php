<?php

namespace App\Http\Controllers\SisfohControllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SfhDashboardController extends Controller
{
    public function index(Request $request)
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

        // 📌 Total de Solicitudes de Ayuda
        $totalRequests = DB::table('sfh_requests')->count();

        // 📊 Cantidad de Solicitudes por Fecha (Año/Mes)
        $requestDateStats = DB::table('sfh_requests')
            ->select(DB::raw('YEAR(request_date) as year, MONTH(request_date) as month, COUNT(id) as count'))
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'asc')
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

        // 📊 Obtener todos los años disponibles para el selector
        $years = DB::table('sfh_requests')
            ->select(DB::raw('DISTINCT YEAR(request_date) as year'))
            ->orderBy('year', 'desc')
            ->pluck('year');

        // 📊 Pasar datos a la vista
        return view('areas.SisfohViews.SfhDashboard', [
            'totalVisits' => $totalVisits,
            'visitStatusStats' => $visitStatusStats,
            'recentVisits' => $recentVisits,
            'totalRequests' => $totalRequests,
            'requestDateStats' => $requestDateStats,
            'recentRequests' => $recentRequests,
            'years' => $years, // Pasamos los años a la vista
        ]);
    }
}
