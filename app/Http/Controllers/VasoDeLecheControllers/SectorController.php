<?php

namespace App\Http\Controllers\VasoDeLecheControllers;

use App\Http\Controllers\Controller;
use App\Models\VasoDeLecheModels\Sector;

use App\Http\Requests\VasoDeLecheRequests\Sectors\IndexSectorRequest;
use App\Http\Requests\VasoDeLecheRequests\Sectors\ShowSectorRequest;
use App\Http\Requests\VasoDeLecheRequests\Sectors\CreateSectorRequest;
use App\Http\Requests\VasoDeLecheRequests\Sectors\StoreSectorRequest;
use App\Http\Requests\VasoDeLecheRequests\Sectors\EditSectorRequest;
use App\Http\Requests\VasoDeLecheRequests\Sectors\UpdateSectorRequest;
use App\Http\Requests\VasoDeLecheRequests\Sectors\DestroySectorRequest;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SectorController extends Controller
{
    use AuthorizesRequests;

    /**
     * Muestra una lista de todos los sectores.
     *
     * @param IndexSectorRequest $request
     * @return \Illuminate\View\View
     */
    public function index(IndexSectorRequest $request)
    {
        // Verificación de permiso
        $this->authorize('ver BD');

        $sectors = Sector::paginate(10);
        return view('areas.VasoDeLecheViews.Sectors.index', compact('sectors'));
    }

    /**
     * Muestra el formulario para crear un nuevo sector.
     *
     * @param CreateSectorRequest $request
     * @return \Illuminate\View\View
     */
    public function create(CreateSectorRequest $request)
    {
        // Verificación de permiso
        $this->authorize('crear');
        
        return view('areas.VasoDeLecheViews.Sectors.create');
    }

    /**
     * Almacena un sector recién creado en la base de datos.
     *
     * @param StoreSectorRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSectorRequest $request)
    {
        // Verificación de permiso
        $this->authorize('crear');
        
        Sector::create($request->validated());
        return redirect()->route('sectors.index')->with('success', 'Sector creado correctamente.');
    }

    /**
     * Muestra los detalles de un sector específico.
     *
     * @param ShowSectorRequest $request
     * @param Sector $sector
     * @return \Illuminate\View\View
     */
    public function show(ShowSectorRequest $request, Sector $sector)
    {
        // Verificación de permiso
        $this->authorize('ver detalles');
        
        return view('areas.VasoDeLecheViews.Sectors.show', compact('sector'));
    }

    /**
     * Muestra el formulario para editar un sector existente.
     *
     * @param EditSectorRequest $request
     * @param Sector $sector
     * @return \Illuminate\View\View
     */
    public function edit(EditSectorRequest $request, Sector $sector)
    {
        // Verificación de permiso
        $this->authorize('editar');
        
        return view('areas.VasoDeLecheViews.Sectors.edit', compact('sector'));
    }

    /**
     * Actualiza un sector existente en la base de datos.
     *
     * @param UpdateSectorRequest $request
     * @param Sector $sector
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSectorRequest $request, Sector $sector)
    {
        // Verificación de permiso
        $this->authorize('editar');
        
        // Validar los datos de la solicitud
        $data = $request->validated();

        // Verificar si los datos realmente han cambiado
        $isDirty = false;
        foreach ($data as $key => $value) {
            if ($sector->$key !== $value) {
                $isDirty = true;
                break;
            }
        }

        // Si no hay cambios, redirigir con el mensaje de "No se realizaron cambios"
        if (!$isDirty) {
            return redirect()->route('sectors.index')->with('info', 'No se realizaron cambios.');
        }

        // Actualizar el sector solo si los datos han cambiado
        $sector->update($data);

        // Redirigir con el mensaje de éxito
        return redirect()->route('sectors.index')->with('success', 'Sector actualizado correctamente.');
    }

    /**
     * Elimina un sector de la base de datos.
     *
     * @param DestroySectorRequest $request
     * @param Sector $sector
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DestroySectorRequest $request, Sector $sector)
    {
        // Verificación de permiso
        $this->authorize('eliminar');
        
        $sector->delete();
        return redirect()->route('sectors.index')->with('success', 'Sector eliminado correctamente.');
    }
}
