<?php

namespace App\Http\Controllers\CiamControllers;

use App\Http\Controllers\Controller;
use App\Models\CiamModels\Location;
use App\Http\Requests\CiamRequests\Locations\IndexLocationRequest;
use App\Http\Requests\CiamRequests\Locations\ShowLocationRequest;
use App\Http\Requests\CiamRequests\Locations\CreateLocationRequest;
use App\Http\Requests\CiamRequests\Locations\StoreLocationRequest;
use App\Http\Requests\CiamRequests\Locations\EditLocationRequest;
use App\Http\Requests\CiamRequests\Locations\UpdateLocationRequest;
use App\Http\Requests\CiamRequests\Locations\DestroyLocationRequest;

class LocationController extends Controller
{
    /**
     * Muestra una lista de todas las localidades.
     *
     * @param IndexLocationRequest $request
     * @return \Illuminate\View\View
     */
    public function index(IndexLocationRequest $request)
    {
        $locations = Location::all();
        return view('areas.CiamViews.Locations.index', compact('locations'));
    }

    /**
     * Muestra el formulario para crear una nueva localidad.
     *
     * @param CreateLocationRequest $request
     * @return \Illuminate\View\View
     */
    public function create(CreateLocationRequest $request)
    {
        return view('areas.CiamViews.Locations.create');
    }

    /**
     * Almacena una nueva localidad en la base de datos.
     *
     * @param StoreLocationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreLocationRequest $request)
    {
        $newLocation = Location::create($request->validated());

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Localidad creada correctamente.',
                'id' => $newLocation->id
            ]);
        }

        return redirect()
            ->route('locations.index')
            ->with('success', 'Localidad creada correctamente.');
    }

    /**
     * Muestra los detalles de una localidad específica.
     *
     * @param ShowLocationRequest $request
     * @param Location $location
     * @return \Illuminate\View\View
     */
    public function show(ShowLocationRequest $request, Location $location)
    {
        return view('areas.CiamViews.Locations.show', compact('location'));
    }

    /**
     * Muestra el formulario para editar una localidad existente.
     *
     * @param EditLocationRequest $request
     * @param Location $location
     * @return \Illuminate\View\View
     */
    public function edit(EditLocationRequest $request, Location $location)
    {
        return view('areas.CiamViews.Locations.edit', compact('location'));
    }

    /**
     * Actualiza una localidad existente en la base de datos.
     *
     * @param UpdateLocationRequest $request
     * @param Location $location
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
        $location->update($request->validated());

        return redirect()
            ->route('locations.index')
            ->with('success', 'Localidad actualizada correctamente.');
    }

    /**
     * Elimina una localidad de la base de datos.
     *
     * @param DestroyLocationRequest $request
     * @param Location $location
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DestroyLocationRequest $request, Location $location)
    {
        $location->delete();

        return redirect()
            ->route('locations.index')
            ->with('success', 'Localidad eliminada correctamente.');
    }
}
