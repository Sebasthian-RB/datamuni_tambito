<?php

namespace App\Http\Controllers\OmapedControllers;

use App\Http\Controllers\Controller;
use App\Models\OmapedModels\Caregiver;
use App\Models\OmapedModels\Disability;
use App\Models\OmapedModels\OmDwelling;
use App\Models\OmapedModels\OmPerson;
use Illuminate\Http\Request;

class OmDashboardController extends Controller
{
    public function index()
    {

        $totalPersonas = OmPerson::count();
        $totalCertificados = Disability::count();
        $totalCuidadores = Caregiver::count();
        $totalViviendas = OmDwelling::count();
        $personasSinSeguro = OmPerson::where('health_insurance', 'Ninguno')->count();
        $leve = Disability::where('severity_level', 'Leve')->count();
        $moderado = Disability::where('severity_level', 'Moderado')->count();
        $severo = Disability::where('severity_level', 'Severo')->count();

        return view('areas.OmapedViews.OMDashboard', compact(
            'totalPersonas',
            'totalCertificados',
            'totalCuidadores',
            'totalViviendas',
            'personasSinSeguro',
            'leve',
            'moderado',
            'severo'
        ));
    }
}
