<?php

namespace App\Http\Controllers\OmapedControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\OmapedRequests\OmDwelling\StoreOmDwellingRequest;
use App\Http\Requests\OmapedRequests\OmDwelling\UpdateOmDwellingRequest;
use App\Models\OmapedModels\OmDwelling;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class OmDwellingController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('ver BD');
        // Obtener el valor de búsqueda
        $search = $request->input('search');

        // Consultar viviendas con filtro opcional por localización o referencia
        $dwellings = OmDwelling::when($search, function ($query) use ($search) {
            $query->where('exact_location', 'LIKE', "%{$search}%")
                ->orWhere('reference', 'LIKE', "%{$search}%");
        })->paginate(10); // Manteniendo la paginación

        return view('areas.OmapedViews.OmDwellings.index', compact('dwellings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('crear');
        // Mostrar formulario para registrar una nueva vivienda
        return view('areas.OmapedViews.OmDwellings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOmDwellingRequest $request)
    {
        $this->authorize('crear');
        $dwelling = OmDwelling::create($request->validated());

        if ($request->ajax()) { // Cambiar de wantsJson() a ajax()
            return response()->json([
                'success' => true,
                'dwelling' => $dwelling
            ]);
        }

        return redirect()->route('om-dwellings.index')
            ->with('success', '¡Vivienda creada exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(OmDwelling $omDwelling)
    {
        $this->authorize('ver detalles');
        // Mostrar detalles de una vivienda
        return view('areas.OmapedViews.OmDwellings.show', compact('omDwelling'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OmDwelling $omDwelling)
    {
        $this->authorize('editar');
        // Mostrar formulario para editar una vivienda
        return view('areas.OmapedViews.OmDwellings.edit', compact('omDwelling'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOmDwellingRequest $request, OmDwelling $omDwelling)
    {
        $this->authorize('editar');
        $omDwelling->update($request->validated());
        return redirect()->route('om-dwellings.index')->with('success', '¡Vivienda actualizada exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OmDwelling $omDwelling)
    {
        $this->authorize('eliminar');
        // Eliminar vivienda
        $omDwelling->delete();
        return redirect()->route('om-dwellings.index')->with('success', 'Vivienda eliminada con éxito.');
    }
}
