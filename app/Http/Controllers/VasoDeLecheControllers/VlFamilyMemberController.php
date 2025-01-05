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
        $vlFamilyMembers = VlFamilyMember::all();

        return view('areas.VasoDeLecheViews.VlFamilyMembers.index', compact('vlFamilyMembers'));
    }

    /**
     * Muestra el formulario para crear un nuevo miembro familiar.
     *
     * @param CreateVlFamilyMemberRequest $request
     * @return \Illuminate\View\View
     */
    public function create(CreateVlFamilyMemberRequest $request)
    {
        $identityDocumentTypes = [
            'DNI' => 'DNI',
            'Carnet de Extranjería' => 'Carnet de Extranjería',
            'Otro' => 'Otro',
        ];

        return view('areas.VasoDeLecheViews.VlFamilyMembers.create', compact('identityDocumentTypes'));
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

        return redirect()
            ->route('vl_family_members.index')
            ->with('success', 'Miembro familiar creado correctamente.');
    }

    /**
     * Muestra los detalles de un miembro familiar específico.
     *
     * @param ShowVlFamilyMemberRequest $request
     * @param VlFamilyMember $vlFamilyMember
     * @return \Illuminate\View\View
     */
    public function show(ShowVlFamilyMemberRequest $request, VlFamilyMember $vlFamilyMember)
    {
        return view('areas.VasoDeLecheViews.VlFamilyMembers.show', compact('vlFamilyMember'));
    }

    /**
     * Muestra el formulario para editar un miembro familiar existente.
     *
     * @param EditVlFamilyMemberRequest $request
     * @param VlFamilyMember $vlFamilyMember
     * @return \Illuminate\View\View
     */
    public function edit(EditVlFamilyMemberRequest $request, VlFamilyMember $vlFamilyMember)
    {
        $identityDocumentTypes = [
            'DNI' => 'DNI',
            'Carnet de Extranjería' => 'Carnet de Extranjería',
            'Otro' => 'Otro',
        ];

        return view('areas.VasoDeLecheViews.VlFamilyMembers.edit', compact('vlFamilyMember', 'identityDocumentTypes'));
    }

    /**
     * Actualiza un miembro familiar existente en la base de datos.
     *
     * @param UpdateVlFamilyMemberRequest $request
     * @param VlFamilyMember $vlFamilyMember
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateVlFamilyMemberRequest $request, VlFamilyMember $vlFamilyMember)
    {
        $vlFamilyMember->update($request->validated());

        return redirect()
            ->route('vl_family_members.index')
            ->with('success', 'Miembro familiar actualizado correctamente.');
    }

    /**
     * Elimina un miembro familiar de la base de datos.
     *
     * @param DestroyVlFamilyMemberRequest $request
     * @param VlFamilyMember $vlFamilyMember
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DestroyVlFamilyMemberRequest $request, VlFamilyMember $vlFamilyMember)
    {
        $vlFamilyMember->delete();

        return redirect()
            ->route('vl_family_members.index')
            ->with('success', 'Miembro familiar eliminado correctamente.');
    }
}
