<?php

namespace App\Http\Controllers\VasoDeLecheControllers;

use App\Http\Controllers\Controller;
use App\Models\VasoDeLecheModels\VlMinor;
use App\Http\Requests\VasoDeLecheRequests\VlMinors\IndexVlMinorRequest;
use App\Http\Requests\VasoDeLecheRequests\VlMinors\ShowVlMinorRequest;
use App\Http\Requests\VasoDeLecheRequests\VlMinors\CreateVlMinorRequest;
use App\Http\Requests\VasoDeLecheRequests\VlMinors\StoreVlMinorRequest;
use App\Http\Requests\VasoDeLecheRequests\VlMinors\EditVlMinorRequest;
use App\Http\Requests\VasoDeLecheRequests\VlMinors\UpdateVlMinorRequest;
use App\Http\Requests\VasoDeLecheRequests\VlMinors\DestroyVlMinorRequest;

class VlMinorController extends Controller
{
    /**
     * Muestra una lista de todos los menores.
     *
     * @param IndexVlMinorRequest $request
     * @return \Illuminate\View\View
     */
    public function index(IndexVlMinorRequest $request)
    {
        $vlMinors = VlMinor::all();
        return view('areas.VasoDeLecheViews.Minors.index', compact('vlMinors'));
    }

    /**
     * Muestra el formulario para crear un nuevo menor.
     *
     * @param CreateVlMinorRequest $request
     * @return \Illuminate\View\View
     */
    public function create(CreateVlMinorRequest $request)
    {
        return view('areas.VasoDeLecheViews.Minors.create');
    }

    /**
     * Almacena un menor recién creado en la base de datos.
     *
     * @param StoreVlMinorRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreVlMinorRequest $request)
    {
        // Validación de datos y creación del registro
        VlMinor::create($request->validated());

        // Redirección con mensaje de éxito
        return redirect()->route('vl-minors.index')->with('success', 'Menor registrado correctamente.');
    }

    /**
     * Muestra los detalles de un menor específico.
     *
     * @param ShowVlMinorRequest $request
     * @param VlMinor $vlMinor
     * @return \Illuminate\View\View
     */
    public function show(ShowVlMinorRequest $request, VlMinor $vlMinor)
    {
        return view('areas.VasoDeLecheViews.Minors.show', compact('vlMinor'));
    }

    /**
     * Muestra el formulario para editar un menor existente.
     *
     * @param EditVlMinorRequest $request
     * @param VlMinor $vlMinor
     * @return \Illuminate\View\View
     */
    public function edit(EditVlMinorRequest $request, VlMinor $vlMinor)
    {
        return view('areas.VasoDeLecheViews.Minors.edit', compact('vlMinor'));
    }

    /**
     * Actualiza un menor existente en la base de datos.
     *
     * @param UpdateVlMinorRequest $request
     * @param VlMinor $vlMinor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateVlMinorRequest $request, VlMinor $vlMinor)
    {
        // Validación de datos y actualización del registro
        $vlMinor->update($request->validated());

        // Redirección con mensaje de éxito
        return redirect()->route('vl-minors.index')->with('success', 'Datos del menor actualizados correctamente.');
    }

    /**
     * Elimina un menor de la base de datos.
     *
     * @param DestroyVlMinorRequest $request
     * @param VlMinor $vlMinor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DestroyVlMinorRequest $request, VlMinor $vlMinor)
    {
        $vlMinor->delete();
        return redirect()->route('vl-minors.index')->with('success', 'Menor eliminado correctamente.');
    }
}
