<?php

namespace App\Http\Controllers\OmapedControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\OmapedRequests\Caregiver\StoreCaregiverRequest;
use App\Http\Requests\OmapedRequests\Caregiver\UpdateCaregiverRequest;
use App\Models\OmapedModels\Caregiver;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class CaregiverController extends Controller
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

        // Consultar cuidadores con filtro opcional por nombre o DNI
        $caregivers = Caregiver::when($search, function ($query) use ($search) {
            $query->where('full_name', 'LIKE', "%{$search}%")
                ->orWhere('dni', 'LIKE', "%{$search}%");
        })->paginate(10); // Manteniendo la paginación de 10 registros

        return view('areas.OmapedViews.Caregivers.index', compact('caregivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('crear');
        // Mostrar formulario para registrar un nuevo cuidador
        return view('areas.OmapedViews.Caregivers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCaregiverRequest $request)
    {
        $this->authorize('crear');
        // Crear un nuevo cuidador con los datos validados
        $caregiver = Caregiver::create($request->validated());

        // Retornar respuesta en formato JSON para AJAX
        return response()->json([
            'success' => true,
            'message' => '¡Cuidador registrado exitosamente!',
            'caregiver' => [
                'id' => $caregiver->id,
                'full_name' => $caregiver->full_name
            ]
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Caregiver $caregiver)
    {
        $this->authorize('ver detalles');
        // Mostrar detalles de un cuidador
        return view('areas.OmapedViews.Caregivers.show', compact('caregiver'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Caregiver $caregiver)
    {
        $this->authorize('editar');
        // Mostrar formulario para editar un cuidador

        return view('areas.OmapedViews.Caregivers.edit', compact('caregiver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCaregiverRequest $request, Caregiver $caregiver)
    {
        $this->authorize('editar');
        // Validar datos de entrada
        $caregiver->update($request->validated());
        return redirect()->route('caregivers.index')->with('success', '¡Cuidador actualizado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Caregiver $caregiver)
    {
        $this->authorize('eliminar');
        // Eliminar cuidador
        $caregiver->delete();

        return redirect()->route('caregivers.index')->with('success', 'Cuidador eliminado con éxito.');
    }
}
