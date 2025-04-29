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
            'products' => Product::where('year', date('Y'))->count()
        ];

        // Distribución por sector (consulta optimizada)
        $sectorDistribution = DB::table('sectors')
            ->select('sectors.name', DB::raw('COUNT(DISTINCT vl_minors.id) as total')) // Solo contar menores activos e ignora los repetidos
            ->join('committees', 'sectors.id', '=', 'committees.sector_id')
            ->join('committee_vl_family_members', function ($join) {
                $join->on('committees.id', '=', 'committee_vl_family_members.committee_id')
                    ->where('committee_vl_family_members.status', 1); // Solo familiares activos en el comité
            })
            ->join('vl_family_members', 'committee_vl_family_members.vl_family_member_id', '=', 'vl_family_members.id')
            ->join('vl_minors', 'vl_family_members.id', '=', 'vl_minors.vl_family_member_id')
            ->where('vl_minors.status', 1)  // Solo contar menores activos
            ->groupBy('sectors.id', 'sectors.name')
            ->get();


        // Menores por condición agrupados por núcleo urbano (Urbano/Rural)
        $urbanRuralDistribution = DB::table('vl_minors')
            ->select(
                'committees.urban_core',
                'vl_minors.condition',
                DB::raw('COUNT(DISTINCT vl_minors.id) as total')
            )
            ->join('vl_family_members', 'vl_minors.vl_family_member_id', '=', 'vl_family_members.id')
            ->join('committee_vl_family_members', function($join) {
                $join->on('vl_family_members.id', '=', 'committee_vl_family_members.vl_family_member_id')
                    ->where('committee_vl_family_members.status', true); // Solo relaciones activas
            })
            ->join('committees', 'committee_vl_family_members.committee_id', '=', 'committees.id')
            ->where('vl_minors.status', true)
            ->groupBy('committees.urban_core', 'vl_minors.condition')
            ->get()
            ->groupBy('urban_core');

        // Estadísticas SISFOH
        $currentYear = date('Y');
        $sisfohStats = [
            'total' => [
                'antiguos' => VlMinor::where('created_at', '<', "{$currentYear}-01-01")
                    ->where('status', true)
                    ->count(),
                'nuevos' => VlMinor::whereYear('created_at', $currentYear)
                    ->where('status', true)
                    ->count()
            ],
            'con_dni' => [
                'antiguos' => VlMinor::where('created_at', '<', "{$currentYear}-01-01")
                    ->where('status', true)
                    ->where('identity_document', 'DNI') // Solo verifica si el DNI está registrado
                    ->count(),
                'nuevos' => VlMinor::whereYear('created_at', $currentYear)
                    ->where('status', true)
                    ->where('identity_document', 'DNI') // Solo verifica si el DNI está registrado
                    ->count()
            ],
            'con_sisfoh' => [
                'antiguos' => VlMinor::where('created_at', '<', "{$currentYear}-01-01")
                    ->where('status', true)
                    ->where('has_sisfoh', true) // Asegura que el registro tenga SISFOH
                    ->count(),
                'nuevos' => VlMinor::whereYear('created_at', $currentYear)
                    ->where('status', true)
                    ->where('has_sisfoh', true) // Asegura que el registro tenga SISFOH
                    ->count()
            ]
        ];

        // Datos para gráficos
        $chartData = [
            'sectors' => $sectorDistribution->pluck('name'),
            'sectorCounts' => $sectorDistribution->pluck('total'),
            'conditions' => VlMinor::where('status', true)
                ->select('condition', DB::raw('COUNT(*) as total'))
                ->groupBy('condition')
                ->get(),
            'urbanCoreConditions' => $urbanRuralDistribution,
            'sisfohStats' => $sisfohStats
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

        return view('areas.VasoDeLecheViews.Dashboard.index', compact('stats', 'chartData', 'latestRecords' , 'committees', 'sisfohStats'));
    }

    private function getCommitteeStats($committeeId)
    {
        // Cargar el comité con los familiares activos y sus menores activos
        $committee = Committee::with([
            'sector', 
            'vlFamilyMembers' => function ($query) {
                $query->where('status', 1) // Solo familiares con status activo
                    ->with(['vlMinors' => function ($query) {
                        $query->where('status', 1); // Solo menores con status activo
                    }]);
            }
        ])->find($committeeId);
        
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
                ->map->count(),
            'urban_core' => $committee->urban_core 
        ];

        return response()->json($stats);
    }
}
