<?php

namespace App\Http\Controllers\VasoDeLecheControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\VasoDeLecheRequests\IndexVasoDeLecheRequest;
use App\Models\VasoDeLecheModels\Committee;
use App\Models\VasoDeLecheModels\Product;
use App\Models\VasoDeLecheModels\Sector;
use App\Models\VasoDeLecheModels\VlFamilyMember;
use App\Models\VasoDeLecheModels\VlMinor;

class VasoDeLecheController extends Controller
{
    /**
     * Muestra una lista de todos los comités.
     *
     * @param IndexCommitteeRequest $request
     * @return \Illuminate\View\View
     */
    public function index(IndexVasoDeLecheRequest $request)
    {
        // Recuperar los parámetros de filtrado desde la solicitud
        $name = $request->input('name'); // Puede ser nombre o ID de comité
        $president = $request->input('president');
        $urbanCore = $request->input('urban_core');
        $minBeneficiariesCount = $request->input('min_beneficiaries_count'); // Rango mínimo
        $maxBeneficiariesCount = $request->input('max_beneficiaries_count'); // Rango máximo
        $sectorId = $request->input('sector_id');

        // Inicializa la consulta de los comités con las relaciones necesarias
        $committees = Committee::with(['sector', 'vlFamilyMembers.vlMinors']);

        // Aplicar filtro por nombre o ID de comité
        if ($name) {
            // Filtrar por nombre o ID de comité
            $committees->where(function ($query) use ($name) {
                $query->where('name', 'like', "%$name%")
                      ->orWhere('id', $name); // Permitir filtrar por ID
            });
        }

        // Filtrar por presidente de comité
        $committees->where(function ($query) use ($president) {
            $query->where('president', 'like', "%$president%");
        });


        // Aplicar filtro por núcleo urbano
        if ($urbanCore) {
            $committees->where('urban_core', $urbanCore);
        }

        // Aplicar filtro por rango de beneficiarios (menores de edad)
        if ($minBeneficiariesCount || $maxBeneficiariesCount) {
            $committees->whereHas('vlFamilyMembers.vlMinors', function ($query) use ($minBeneficiariesCount, $maxBeneficiariesCount) {
                // Aplicar filtros directamente al conteo de menores de edad
                if ($minBeneficiariesCount && $maxBeneficiariesCount) {
                    $query->havingRaw('COUNT(*) BETWEEN ? AND ?', [$minBeneficiariesCount, $maxBeneficiariesCount]);
                } elseif ($minBeneficiariesCount) {
                    $query->havingRaw('COUNT(*) >= ?', [$minBeneficiariesCount]);
                } elseif ($maxBeneficiariesCount) {
                    $query->havingRaw('COUNT(*) <= ?', [$maxBeneficiariesCount]);
                }
            }, '>=', $minBeneficiariesCount ?? 0); // Validación inicial por si solo hay mínimo
        }

        // Aplicar filtro por sector
        if ($sectorId) {
            $committees->where('sector_id', $sectorId);
        }

        // Paginamos los resultados
        $committees = $committees->paginate(12);

        // Agregar la cantidad de menores de edad a cada comité
        foreach ($committees as $committee) {
            $committee->minors_count = $committee->vlFamilyMembers->sum(function ($familyMember) {
                return $familyMember->vlMinors->count();
            });
        }

        // Obtener todos los sectores disponibles para el filtro
        $sectors = Sector::all();

        // Definir los núcleos urbanos
        $urbanCores = ['Urbano', 'Rural'];

        // Pasar los datos a la vista
        return view('areas.VasoDeLecheViews.index', compact(
            'committees', 'sectors', 'urbanCores'
        ));
    }
}
