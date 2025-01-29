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
     *
     * @param IndexGuardianRequest $request
     * @return \Illuminate\View\View
     */
    public function index(IndexGuardianRequest $request)
    {
        $guardians = Guardian::all();

        return view('areas.CiamViews.Guardians.index', compact('guardians'));
    }

    /**
     * Muestra el formulario para crear un nuevo guardián.
     *
     * @param CreateGuardianRequest $request
     * @return \Illuminate\View\View
     */
    public function create(CreateGuardianRequest $request)
    {
        $documentTypes = ['DNI', 'Pasaporte', 'Carnet', 'Cedula'];

        return view('areas.CiamViews.Guardians.create', compact('documentTypes'));
    }

    /**
     * Almacena un nuevo guardián en la base de datos.
     *
     * @param StoreGuardianRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreGuardianRequest $request)
    {
        Guardian::create($request->validated());

        return redirect()->route('guardians.index')->with('success', 'Guardián creado con éxito.');
    }

    /**
     * Muestra los detalles de un guardián específico.
     *
     * @param ShowGuardianRequest $request
     * @param Guardian $guardian
     * @return \Illuminate\View\View
     */
    public function show(ShowGuardianRequest $request, Guardian $guardian)
    {
        return view('areas.CiamViews.Guardians.show', compact('guardian'));
    }

    /**
     * Muestra el formulario para editar un guardián existente.
     *
     * @param EditGuardianRequest $request
     * @param Guardian $guardian
     * @return \Illuminate\View\View
     */
    public function edit(EditGuardianRequest $request, Guardian $guardian)
    {
        $documentTypes = ['DNI', 'Pasaporte', 'Carnet', 'Cedula'];

        return view('areas.CiamViews.Guardians.edit', compact('guardian', 'documentTypes'));
    }

    /**
     * Actualiza un guardián existente en la base de datos.
     *
     * @param UpdateGuardianRequest $request
     * @param Guardian $guardian
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateGuardianRequest $request, Guardian $guardian)
    {
        try {
            // Validar los datos incluyendo el ID
            $validatedData = $request->validate([
                'id' => 'required|string|max:36|unique:guardians,id,' . $guardian->id,
                'document_type' => 'required|in:DNI,Pasaporte,Carnet,Cedula',
                'given_name' => 'required|string|max:50',
                'paternal_last_name' => 'required|string|max:50',
                'maternal_last_name' => 'required|string|max:50',
                'phone_number' => 'nullable|string|max:15',
            ]);

            // Actualizar los datos del guardián
            $guardian->update($validatedData);

            // Redirigir con un mensaje de éxito
            return redirect()->route('guardians.index')->with('success', 'Datos del guardián actualizados correctamente.');
        } catch (\Exception $e) {
            // Manejar errores inesperados
            return redirect()->route('guardians.edit', $guardian->id)->with('error', 'Ocurrió un error al actualizar el guardián. Intente nuevamente.');
        }
    }



    /**
     * Elimina un guardián de la base de datos.
     *
     * @param DestroyGuardianRequest $request
     * @param Guardian $guardian
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DestroyGuardianRequest $request, Guardian $guardian)
    {
        $guardian->delete();

        return redirect()->route('guardians.index')->with('success', 'Guardián eliminado con éxito.');
    }
}
