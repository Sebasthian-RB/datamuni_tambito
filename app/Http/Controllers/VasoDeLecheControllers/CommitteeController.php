<?php

namespace App\Http\Controllers\VasoDeLecheControllers;

use App\Http\Controllers\Controller;
use App\Models\VasoDeLecheModels\Committee;
use App\Http\Requests\VasoDeLecheRequests\Committees\IndexCommitteeRequest;
use App\Http\Requests\VasoDeLecheRequests\Committees\ShowCommitteeRequest;
use App\Http\Requests\VasoDeLecheRequests\Committees\CreateCommitteeRequest;
use App\Http\Requests\VasoDeLecheRequests\Committees\StoreCommitteeRequest;
use App\Http\Requests\VasoDeLecheRequests\Committees\EditCommitteeRequest;
use App\Http\Requests\VasoDeLecheRequests\Committees\UpdateCommitteeRequest;
use App\Http\Requests\VasoDeLecheRequests\Committees\DestroyCommitteeRequest;

class CommitteeController extends Controller
{
    /**
     * Muestra una lista de todos los comités.
     *
     * @param IndexCommitteeRequest $request
     * @return \Illuminate\View\View
     */
    public function index(IndexCommitteeRequest $request)
    {
        $committees = Committee::all();
        return view('areas.VasoDeLecheViews.Committees.index', compact('committees'));
    }

    /**
     * Muestra el formulario para crear un nuevo comité.
     *
     * @param CreateCommitteeRequest $request
     * @return \Illuminate\View\View
     */
    public function create(CreateCommitteeRequest $request)
    {
        return view('areas.VasoDeLecheViews.Committees.create');
    }

    /**
     * Almacena un comité recién creado en la base de datos.
     *
     * @param StoreCommitteeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCommitteeRequest $request)
    {
        Committee::create($request->validated());
        return redirect()->route('committees.index')->with('success', 'Comité creado correctamente.');
    }

    /**
     * Muestra los detalles de un comité específico.
     *
     * @param ShowCommitteeRequest $request
     * @param Committee $committee
     * @return \Illuminate\View\View
     */
    public function show(ShowCommitteeRequest $request, Committee $committee)
    {
        return view('areas.VasoDeLecheViews.Committees.show', compact('committee'));
    }

    /**
     * Muestra el formulario para editar un comité existente.
     *
     * @param EditCommitteeRequest $request
     * @param Committee $committee
     * @return \Illuminate\View\View
     */
    public function edit(EditCommitteeRequest $request, Committee $committee)
    {
        return view('areas.VasoDeLecheViews.Committees.edit', compact('committee'));
    }

    /**
     * Actualiza un comité existente en la base de datos.
     *
     * @param UpdateCommitteeRequest $request
     * @param Committee $committee
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCommitteeRequest $request, Committee $committee)
    {
        $committee->update($request->validated());
        return redirect()->route('committees.index')->with('success', 'Comité actualizado correctamente.');
    }

    /**
     * Elimina un comité de la base de datos.
     *
     * @param DestroyCommitteeRequest $request
     * @param Committee $committee
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DestroyCommitteeRequest $request, Committee $committee)
    {
        $committee->delete();
        return redirect()->route('committees.index')->with('success', 'Comité eliminado correctamente.');
    }
}
