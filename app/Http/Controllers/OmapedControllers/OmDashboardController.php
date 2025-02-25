<?php

namespace App\Http\Controllers\OmapedControllers;

use App\Http\Controllers\Controller;
use App\Models\OmapedModels\Caregiver;
use App\Models\OmapedModels\Disability;
use App\Models\OmapedModels\OmDwelling;
use App\Models\OmapedModels\OmPerson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OmDashboardController extends Controller
{
    public function index()
    {
        // Métricas principales
        $totalPersonas = OmPerson::count();

        // Otras métricas
        $metrics = [
            'certificados' => Disability::count(),
            'cuidadores' => Caregiver::count(),
            'viviendas' => OmDwelling::count(),
        ];

        // Estadísticas de discapacidad
        $discapacidad = [
            'leve' => Disability::where('severity_level', 'Leve')->count(),
            'moderado' => Disability::where('severity_level', 'Moderado')->count(),
            'severo' => Disability::where('severity_level', 'Severo')->count()
        ];

        // Seguros de salud
        $seguros = OmPerson::select('health_insurance', DB::raw('count(*) as total'))
            ->whereIn('health_insurance', ['SIS', 'EsSalud', 'Seguro Privado', 'Ninguno'])
            ->groupBy('health_insurance')
            ->get()
            ->mapWithKeys(fn($item) => [$item->health_insurance => $item->total])
            ->toArray();

        // Forzar estructura completa
        $seguros = array_merge([
            'SIS' => 0,
            'EsSalud' => 0,
            'Seguro Privado' => 0,
            'Ninguno' => 0
        ], $seguros);

        // Géneros
        $generos = OmPerson::select('gender', DB::raw('count(*) as total'))
            ->whereIn('gender', ['Masculino', 'Femenino'])
            ->groupBy('gender')
            ->get()
            ->mapWithKeys(fn($item) => [$item->gender => $item->total])
            ->toArray();
            $generos = array_merge([
                'Masculino' => 0,
                'Femenino' => 0
            ], $generos);
            
        return view('areas.OmapedViews.OMDashboard', compact(
            'totalPersonas',
            'metrics',
            'discapacidad',
            'seguros',
            'generos'
        ));
    }
}
