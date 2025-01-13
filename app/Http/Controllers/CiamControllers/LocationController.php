<?php

namespace App\Http\Controllers\CiamControllers;

use App\Http\Controllers\Controller;
use App\Models\CiamModels\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Mostrar una lista de todas las ubicaciones.
     */
    public function index()
    {
        // Obtenemos todas las ubicaciones
        $locations = Location::all();

        // Retornamos la vista de índice con las ubicaciones
        return view('areas.CiamViews.Locations.index', compact('locations'));
    }

    /**
     * Mostrar el formulario para crear una nueva ubicación.
     */
    public function create()
    {
        // Retornamos la vista del formulario para crear una nueva ubicación
        return view('locations.create');
    }

    /**
     * Almacenar una nueva ubicación en la base de datos.
     */
    public function store(Request $request)
    {
        // Validamos los datos enviados desde el formulario
        $request->validate([
            'location_name' => 'required|string|max:255',
            'region' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
        ]);

        // Creamos una nueva ubicación con los datos validados
        Location::create($request->all());

        // Redirigimos al índice con un mensaje de éxito
        return redirect()->route('locations.index')->with('success', 'Ubicación creada exitosamente.');
    }

    /**
     * Mostrar los detalles de una ubicación específica.
     */
    public function show(Location $location)
    {
        // Retornamos la vista de detalles de la ubicación
        return view('locations.show', compact('location'));
    }

    /**
     * Mostrar el formulario para editar una ubicación existente.
     */
    public function edit(Location $location)
    {
        // Retornamos la vista del formulario para editar la ubicación
        return view('locations.edit', compact('location'));
    }

    /**
     * Actualizar una ubicación existente en la base de datos.
     */
    public function update(Request $request, Location $location)
    {
        // Validamos los datos enviados desde el formulario
        $request->validate([
            'location_name' => 'required|string|max:255',
            'region' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
        ]);

        // Actualizamos la ubicación con los datos validados
        $location->update($request->all());

        // Redirigimos al índice con un mensaje de éxito
        return redirect()->route('locations.index')->with('success', 'Ubicación actualizada exitosamente.');
    }

    /**
     * Eliminar una ubicación específica de la base de datos.
     */
    public function destroy(Location $location)
    {
        // Eliminamos la ubicación
        $location->delete();

        // Redirigimos al índice con un mensaje de éxito
        return redirect()->route('locations.index')->with('success', 'Ubicación eliminada exitosamente.');
    }
}
