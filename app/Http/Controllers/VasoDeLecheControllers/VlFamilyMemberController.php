<?php

namespace App\Http\Controllers\VasoDeLecheControllers;

use App\Http\Controllers\Controller;
use App\Models\VasoDeLecheModels\VlFamilyMember;
use App\Http\Requests\VasoDeLecheRequests\VlFamilyMembers\IndexVlFamilyMemberRequest;
use App\Http\Requests\VasoDeLecheRequests\VlFamilyMembers\ShowVlFamilyMemberRequest;
use App\Http\Requests\VasoDeLecheRequests\VlFamilyMembers\CreateVlFamilyMemberRequest;
use App\Http\Requests\VasoDeLecheRequests\VlFamilyMembers\StoreVlFamilyMemberRequest;
use App\Http\Requests\VasoDeLecheRequests\VlFamilyMembers\EditVlFamilyMemberRequest;
use App\Http\Requests\VasoDeLecheRequests\VlFamilyMembers\UpdateVlFamilyMemberRequest;
use App\Http\Requests\VasoDeLecheRequests\VlFamilyMembers\DestroyVlFamilyMemberRequest;

class VlFamilyMemberController extends Controller
{
    /**
     * Muestra una lista de todos los miembros familiares.
     *
     * @param IndexVlFamilyMemberRequest $request
     * @return \Illuminate\View\View
     */
    public function index(IndexVlFamilyMemberRequest $request)
    {
        $familyMembers = VlFamilyMember::all();
        return view('areas.VasoDeLecheViews.FamilyMembers.index', compact('familyMembers'));
    }

    /**
     * Muestra el formulario para crear un nuevo miembro familiar.
     *
     * @param CreateVlFamilyMemberRequest $request
     * @return \Illuminate\View\View
     */
    public function create(CreateVlFamilyMemberRequest $request)
    {
        return view('areas.VasoDeLecheViews.FamilyMembers.create');
    }

    /**
     * Almacena un miembro familiar recién creado en la base de datos.
     *
     * @param StoreVlFamilyMemberRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreVlFamilyMemberRequest $request)
    {
        VlFamilyMember::create($request->validated());
        return redirect()->route('family_members.index')->with('success', 'Miembro familiar creado correctamente.');
    }

    /**
     * Muestra los detalles de un miembro familiar específico.
     *
     * @param ShowVlFamilyMemberRequest $request
     * @param VlFamilyMember $familyMember
     * @return \Illuminate\View\View
     */
    public function show(ShowVlFamilyMemberRequest $request, VlFamilyMember $familyMember)
    {
        return view('areas.VasoDeLecheViews.FamilyMembers.show', compact('familyMember'));
    }

    /**
     * Muestra el formulario para editar un miembro familiar existente.
     *
     * @param EditVlFamilyMemberRequest $request
     * @param VlFamilyMember $familyMember
     * @return \Illuminate\View\View
     */
    public function edit(EditVlFamilyMemberRequest $request, VlFamilyMember $familyMember)
    {
        return view('areas.VasoDeLecheViews.FamilyMembers.edit', compact('familyMember'));
    }

    /**
     * Actualiza un miembro familiar existente en la base de datos.
     *
     * @param UpdateVlFamilyMemberRequest $request
     * @param VlFamilyMember $familyMember
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateVlFamilyMemberRequest $request, VlFamilyMember $familyMember)
    {
        $familyMember->update($request->validated());
        return redirect()->route('family_members.index')->with('success', 'Miembro familiar actualizado correctamente.');
    }

    /**
     * Elimina un miembro familiar de la base de datos.
     *
     * @param DestroyVlFamilyMemberRequest $request
     * @param VlFamilyMember $familyMember
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DestroyVlFamilyMemberRequest $request, VlFamilyMember $familyMember)
    {
        $familyMember->delete();
        return redirect()->route('family_members.index')->with('success', 'Miembro familiar eliminado correctamente.');
    }
}
