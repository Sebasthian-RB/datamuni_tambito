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

class GuardianController extends Controller
{
    /**
     * Muestra una lista de todos los guardianes.
     */
    public function index(IndexGuardianRequest $request)
    {
        $guardians = Guardian::all();
        return view('areas.CiamViews.Guardians.index', compact('guardians'));
    }

    /**
     * Muestra el formulario para crear un nuevo guardián.
     */
    public function create(CreateGuardianRequest $request)
    {
        $documentTypes = ['DNI', 'Pasaporte', 'Carnet', 'Cedula'];
        return view('areas.CiamViews.Guardians.create', compact('documentTypes'));
    }

    /**
     * Almacena un nuevo guardián en la base de datos.
     */
    public function store(StoreGuardianRequest $request)
    {
        Guardian::create($request->validated());
        return redirect()->route('guardians.index')->with('success', 'Guardián creado con éxito.');
    }

    /**
     * Muestra los detalles de un guardián específico.
     */
    public function show(ShowGuardianRequest $request, Guardian $guardian)
    {
        return view('areas.CiamViews.Guardians.show', compact('guardian'));
    }

    /**
     * Muestra el formulario para editar un guardián.
     */
    public function edit(EditGuardianRequest $request, Guardian $guardian)
    {
        $documentTypes = ['DNI', 'Pasaporte', 'Carnet', 'Cedula'];
        return view('areas.CiamViews.Guardians.edit', compact('guardian', 'documentTypes'));
    }

    /**
     * Actualiza un guardián en la base de datos.
     */
    public function update(UpdateGuardianRequest $request, Guardian $guardian)
    {
        $guardian->update($request->validated());
        return redirect()->route('guardians.index')->with('success', 'Datos del guardián actualizados correctamente.');
    }

    /**
     * Elimina un guardián de la base de datos.
     */
    public function destroy(DestroyGuardianRequest $request, Guardian $guardian)
    {
        // Validar si el guardián tiene adultos mayores asignados
        if ($guardian->elderlyAdults()->exists()) {
            return redirect()->route('guardians.index')->with('error', 'No se puede eliminar este guardián porque tiene adultos mayores asignados.');
        }

        $guardian->delete();
        return redirect()->route('guardians.index')->with('success', 'Guardián eliminado con éxito.');
    }
}
