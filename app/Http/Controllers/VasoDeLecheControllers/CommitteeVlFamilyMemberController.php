<?php

namespace App\Http\Controllers\VasoDeLecheControllers;

use App\Http\Controllers\Controller;
use App\Models\VasoDeLecheModels\CommitteeVlFamilyMember;
use App\Http\Requests\VasoDeLecheRequests\CommitteeVlFamilyMembers\IndexCommitteeVlFamilyMemberRequest;
use App\Http\Requests\VasoDeLecheRequests\CommitteeVlFamilyMembers\ShowCommitteeVlFamilyMemberRequest;
use App\Http\Requests\VasoDeLecheRequests\CommitteeVlFamilyMembers\CreateCommitteeVlFamilyMemberRequest;
use App\Http\Requests\VasoDeLecheRequests\CommitteeVlFamilyMembers\StoreCommitteeVlFamilyMemberRequest;
use App\Http\Requests\VasoDeLecheRequests\CommitteeVlFamilyMembers\EditCommitteeVlFamilyMemberRequest;
use App\Http\Requests\VasoDeLecheRequests\CommitteeVlFamilyMembers\UpdateCommitteeVlFamilyMemberRequest;
use App\Http\Requests\VasoDeLecheRequests\CommitteeVlFamilyMembers\DestroyCommitteeVlFamilyMemberRequest;

use App\Models\VasoDeLecheModels\Committee;
use App\Models\VasoDeLecheModels\VlFamilyMember;

class CommitteeVlFamilyMemberController extends Controller
{
    /**
     * Muestra una lista de los miembros familiares asignados a comités.
     *
     * @param IndexCommitteeVlFamilyMemberRequest $request
     * @return \Illuminate\View\View
     */
    public function index(IndexCommitteeVlFamilyMemberRequest $request, $committee_id)
    {
        // Obtener todos los miembros de la familia asociados al comité específico
        $committeeVlFamilyMembers = CommitteeVlFamilyMember::where('committee_id', $committee_id)
            ->with(['vlFamilyMember.vlMinors']) // Cargar los menores de edad relacionados
            ->get();

        return view('areas.VasoDeLecheViews.CommitteeVlFamilyMembers.index', compact('committeeVlFamilyMembers'));
    }

    /**
     * Muestra el formulario para crear un nuevo miembro familiar en un comité.
     *
     * @param CreateCommitteeVlFamilyMemberRequest $request
     * @return \Illuminate\View\View
     */
    public function create(CreateCommitteeVlFamilyMemberRequest $request)
    {
        // Obtener los comités desde el modelo Committee
        $committees = Committee::all();

        // Obtener los miembros de la familia desde el modelo VlFamilyMember
        $vlFamilyMembers = VlFamilyMember::all();

        // Definir las opciones para el campo 'status' en el controlador
        $statusOptions = [
            1 => 'Activo',
            0 => 'Inactivo',
        ];

        return view('areas.VasoDeLecheViews.CommitteeVlFamilyMembers.create', compact('committees', 'vlFamilyMembers', 'statusOptions'));
    }

    /**
     * Almacena un nuevo miembro familiar asignado a un comité en la base de datos.
     *
     * @param StoreCommitteeVlFamilyMemberRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCommitteeVlFamilyMemberRequest $request)
    {
        // Convertir el valor de 'status' a booleano
        $status = $request->status == '1' ? true : false;

        // Crear el nuevo registro con los valores validados y el valor de 'status' convertido
        CommitteeVlFamilyMember::create([
            'committee_id' => $request->committee_id,
            'vl_family_member_id' => $request->vl_family_member_id,
            'change_date' => $request->change_date,
            'description' => $request->description,
            'status' => $status, // Guardamos el valor booleano
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('committee_vl_family_members.index')->with('success', 'Miembro familiar del comité creado correctamente.');
    }


    /**
     * Muestra los detalles de un miembro familiar específico asignado a un comité.
     *
     * @param ShowCommitteeVlFamilyMemberRequest $request
     * @param CommitteeVlFamilyMember $committeeVlFamilyMember
     * @return \Illuminate\View\View
     */
    public function show(ShowCommitteeVlFamilyMemberRequest $request, CommitteeVlFamilyMember $committeeVlFamilyMember)
    {
        return view('areas.VasoDeLecheViews.CommitteeVlFamilyMembers.show', compact('committeeVlFamilyMember'));
    }

    /**
     * Muestra el formulario para editar la información de un miembro familiar asignado a un comité.
     *
     * @param EditCommitteeVlFamilyMemberRequest $request
     * @param CommitteeVlFamilyMember $committeeVlFamilyMember
     * @return \Illuminate\View\View
     */
    public function edit(EditCommitteeVlFamilyMemberRequest $request, CommitteeVlFamilyMember $committeeVlFamilyMember)
    {
        return view('areas.VasoDeLecheViews.CommitteeVlFamilyMembers.edit', compact('committeeVlFamilyMember'));
    }

    /**
     * Actualiza los datos de un miembro familiar asignado a un comité en la base de datos.
     *
     * @param UpdateCommitteeVlFamilyMemberRequest $request
     * @param CommitteeVlFamilyMember $committeeVlFamilyMember
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCommitteeVlFamilyMemberRequest $request, CommitteeVlFamilyMember $committeeVlFamilyMember)
    {
        $committeeVlFamilyMember->update($request->validated());
        return redirect()->route('committee_vl_family_members.index')->with('success', 'Miembro familiar del comité actualizado correctamente.');
    }

    /**
     * Elimina un miembro familiar asignado a un comité de la base de datos.
     *
     * @param DestroyCommitteeVlFamilyMemberRequest $request
     * @param CommitteeVlFamilyMember $committeeVlFamilyMember
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DestroyCommitteeVlFamilyMemberRequest $request, CommitteeVlFamilyMember $committeeVlFamilyMember)
    {
        $committeeVlFamilyMember->delete();
        return redirect()->route('committee-vl-family-members.index')->with('success', 'Miembro familiar del comité eliminado correctamente.');
    }
}
