<?php

namespace App\Http\Controllers\VasoDeLecheControllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\VasoDeLecheRequests\IndexVasoDeLecheDashboardRequest;
use App\Models\VasoDeLecheModels\Committee;
use App\Models\VasoDeLecheModels\Product;
use App\Models\VasoDeLecheModels\Sector;
use App\Models\VasoDeLecheModels\VlFamilyMember;
use App\Models\VasoDeLecheModels\VlMinor;
use App\Models\VasoDeLecheModels\CommitteeVlFamilyMember;

class VasoDeLecheDashboardController extends Controller
{
    /**
     * Muestra una lista de todos los comités.
     *
     * @param IndexVasoDeLecheDashboardRequest $request
     * @return \Illuminate\View\View
     */
    public function index(IndexVasoDeLecheDashboardRequest $request)
    {
        // Estadísticas principales
        $stats = [
            'activeMinors' => VlMinor::where('status', true)->count(),
            'families' => VlFamilyMember::count(),
            'committees' => Committee::count(),
            'products' => Product::count()
        ];

        // Distribución por sector (consulta optimizada)
        $sectorDistribution = DB::table('sectors')
            ->select('sectors.name', DB::raw('COUNT(vl_minors.id) as total'))
            ->join('committees', 'sectors.id', '=', 'committees.sector_id')
            ->join('committee_vl_family_members', 'committees.id', '=', 'committee_vl_family_members.committee_id')
            ->join('vl_family_members', 'committee_vl_family_members.vl_family_member_id', '=', 'vl_family_members.id')
            ->join('vl_minors', 'vl_family_members.id', '=', 'vl_minors.vl_family_member_id')
            ->where('vl_minors.status', true)
            ->groupBy('sectors.id', 'sectors.name')
            ->get();

        // Datos para gráficos
        $chartData = [
            'sectors' => $sectorDistribution->pluck('name'),
            'sectorCounts' => $sectorDistribution->pluck('total'),
            'conditions' => VlMinor::where('status', true)
                ->select('condition', DB::raw('COUNT(*) as total'))
                ->groupBy('condition')
                ->get()
        ];

        // Últimos registros
        $latestRecords = [
            'minors' => VlMinor::with(['vlFamilyMember.committees.sector'])
                ->where('status', true)
                ->latest()
                ->limit(5)
                ->get(),
            
            'committeeChanges' => CommitteeVLFamilyMember::with([
                'vlFamilyMember', 
                'committee.sector'
            ])->latest('change_date')
            ->limit(5)
            ->get()
        ];


        // Obtener comités para el select2
        $committees = Committee::with('sector')->get();

        // Manejar solicitud AJAX para estadísticas de comité
        if($request->ajax() && $request->has('committee_id')) {
            return $this->getCommitteeStats($request->committee_id);
        }

        return view('areas.VasoDeLecheViews.Dashboard.index', compact('stats', 'chartData', 'latestRecords' , 'committees'));
    }

    private function getCommitteeStats($committeeId)
    {
        $committee = Committee::with(['sector', 'vlFamilyMembers.vlMinors'])->find($committeeId);

        $stats = [
            'total_beneficiarios' => $committee->vlFamilyMembers->flatMap->vlMinors->where('status', true)->count(),
            'total_miembros' => $committee->vlFamilyMembers->count(),
            'age_distribution' => [
                'under7' => $committee->vlFamilyMembers->flatMap->vlMinors
                    ->where('status', true)
                    ->filter(fn($m) => now()->diffInYears($m->birth_date) < 7)
                    ->count(),
                'over7' => $committee->vlFamilyMembers->flatMap->vlMinors
                    ->where('status', true)
                    ->filter(fn($m) => now()->diffInYears($m->birth_date) >= 7)
                    ->count()
            ],
            'condition_distribution' => $committee->vlFamilyMembers->flatMap->vlMinors
                ->where('status', true)
                ->groupBy('condition')
                ->map->count()
        ];

        return response()->json($stats);
    }
}
