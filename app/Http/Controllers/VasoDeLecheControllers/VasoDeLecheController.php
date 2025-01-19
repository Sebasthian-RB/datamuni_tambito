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
        // Inicializa la consulta de los comités con su relación de sector
        $committees = Committee::with('sector');

        // Filtrar por sector si el parámetro está presente
        if ($request->has('sector') && $request->sector != '') {
            $committees->where('sector_id', $request->sector);
        }

        // Filtrar por nombre del comité si el parámetro está presente
        if ($request->has('committee_name') && $request->committee_name != '') {
            $committees->where('name', 'like', '%' . $request->committee_name . '%');
        }

        // Paginamos los resultados
        $committees = $committees->paginate(16);

        // Obtener todos los sectores disponibles para el filtro (si lo necesitas)
        $sectors = Sector::all();

        // Pasar los datos a la vista
        return view('areas.VasoDeLecheViews.index', compact(
            'committees', 'sectors'
        ));
    }
}
