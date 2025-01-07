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
        'violenceStats' => $violenceStats,
        'totalViolences' => $totalViolences,
        'recentViolences' => $recentViolences,
        'totalUniquePersons' => $totalUniquePersons, // Este dato es para mostrar en el dashboard   
    ]);
}

}
