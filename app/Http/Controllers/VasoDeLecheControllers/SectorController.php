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

class SectorController extends Controller
{
    /**
     * Muestra una lista de todos los sectores.
     *
     * @param IndexSectorRequest $request
     * @return \Illuminate\View\View
     */
    public function index(IndexSectorRequest $request)
    {
        $sectors = Sector::all();
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
        $sector->update($request->validated());
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
        $sector->delete();
        return redirect()->route('sectors.index')->with('success', 'Sector eliminado correctamente.');
    }
}
