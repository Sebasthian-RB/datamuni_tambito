<?php

namespace App\Http\Controllers\OmapedControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\OmapedRequests\Disability\StoreDisabilityRequest;
use App\Http\Requests\OmapedRequests\Disability\UpdateDisabilityRequest;
use App\Models\OmapedModels\Disability;
use Illuminate\Http\Request;

class DisabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Obtener el valor de búsqueda
    $search = $request->input('search');

    // Consultar discapacidades con filtro opcional por N° de certificado, diagnóstico o tipo de discapacidad
    $disabilities = Disability::when($search, function ($query) use ($search) {
        $query->where('certificate_number', 'LIKE', "%{$search}%")
              ->orWhere('diagnosis', 'LIKE', "%{$search}%")
              ->orWhere('disability_type', 'LIKE', "%{$search}%");
    })->paginate(10); // Manteniendo la paginación

    return view('areas.OmapedViews.Disabilities.index', compact('disabilities'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar formulario para registrar una nueva discapacidad
        return view('areas.OmapedViews.Disabilities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDisabilityRequest $request)
    {
        $disability = Disability::create($request->validated());

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'disability' => [
                    'id' => $disability->id,
                    'certificate_number' => $disability->certificate_number
                ],
                'message' => '¡Discapacidad registrada exitosamente!'
            ]);
        }

        return redirect()->route('disabilities.index')->with('success', '¡Discapacidad creada exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Disability $disability)
    {
        // Mostrar detalles de una discapacidad
        return view('areas.OmapedViews.Disabilities.show', compact('disability'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Disability $disability)
    {
        // Mostrar formulario para editar una discapacidad
        return view('areas.OmapedViews.Disabilities.edit', compact('disability'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDisabilityRequest $request, Disability $disability)
    {
        $disability->update($request->validated());
        return redirect()->route('disabilities.index')->with('success', '¡Discapacidad actualizada exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Disability $disability)
    {
        // Eliminar discapacidad
        $disability->delete();
        return redirect()->route('disabilities.index')->with('success', 'Discapacidad eliminada con éxito.');
    }
}
