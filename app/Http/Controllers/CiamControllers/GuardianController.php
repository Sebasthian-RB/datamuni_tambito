<?php

namespace App\Http\Controllers\CiamControllers;

use App\Http\Controllers\Controller;
use App\Models\CiamModels\Guardian;
use App\Http\Requests\CiamRequests\Guardians\IndexGuardianRequest;
use App\Http\Requests\CiamRequests\Guardians\ShowGuardianRequest;
use App\Http\Requests\CiamRequests\Guardians\CreateGuardianRequest;
use App\Http\Requests\CiamRequests\Guardians\StoreGuardianRequest;
use App\Http\Requests\CiamRequests\Guardians\EditGuardianRequest;
use App\Http\Requests\CiamRequests\Guardians\UpdateGuardianRequest;
use App\Http\Requests\CiamRequests\Guardians\DestroyGuardianRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class GuardianController extends Controller
{

    use AuthorizesRequests;

    /**
     * Muestra una lista de todos los guardianes.
     */
    public function index(IndexGuardianRequest $request)
    {
        $this->authorize('ver BD');
        $guardians = Guardian::all();
        return view('areas.CiamViews.Guardians.index', compact('guardians'));
    }

    /**
     * Muestra el formulario para crear un nuevo guardián.
     */
    public function create(CreateGuardianRequest $request)
    {
        $this->authorize('crear');
        $documentTypes = ['DNI', 'Pasaporte', 'Carnet', 'Cedula'];
        return view('areas.CiamViews.Guardians.create', compact('documentTypes'));
    }

    /**
     * Almacena un nuevo guardián en la base de datos.
     */
    public function store(StoreGuardianRequest $request)
    {
        $data = $request->validated();

        // Si la relación es "Otro", asignar el valor de `other_relationship`
        if ($data['relationship'] === 'Otro') {
            $data['relationship'] = $request->input('other_relationship');
        }

        Guardian::create($data);

        return redirect()->route('guardians.index')->with('success', 'Guardián creado con éxito.');
    }

    /**
     * Muestra los detalles de un guardián específico.
     */
    public function show(ShowGuardianRequest $request, Guardian $guardian)
    {
        $this->authorize('ver detalles');
        return view('areas.CiamViews.Guardians.show', compact('guardian'));
    }

    /**
     * Muestra el formulario para editar un guardián.
     */
    public function edit(EditGuardianRequest $request, Guardian $guardian)
    {
        $this->authorize('editar');
        $documentTypes = ['DNI', 'Pasaporte', 'Carnet', 'Cedula'];
        return view('areas.CiamViews.Guardians.edit', compact('guardian', 'documentTypes'));
    }

    /**
     * Actualiza un guardián en la base de datos.
     */
    public function update(UpdateGuardianRequest $request, Guardian $guardian)
    {
        $data = $request->validated();

        // Si la relación es "Otro", asignar el valor de `other_relationship`
        if ($data['relationship'] === 'Otro') {
            $data['relationship'] = $request->input('other_relationship');
        }

        $guardian->update($data);

        return redirect()->route('guardians.index')->with('success', 'Datos del guardián actualizados correctamente.');
    }

    /**
     * Elimina un guardián de la base de datos.
     */
    public function destroy(DestroyGuardianRequest $request, Guardian $guardian)
    {
        $this->authorize('eliminar');

        try {
            DB::beginTransaction();

            // Desasignar adultos mayores
            $guardian->elderlyAdults()->update(['guardian_id' => null]);

            // Eliminar el guardián
            $guardian->delete();

            DB::commit();

            return redirect()->route('guardians.index')
                ->with('success', 'Guardián eliminado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error eliminando guardián: ' . $e->getMessage());
            return back()->with('error', 'Error al eliminar el guardián');
        }
    }
}
