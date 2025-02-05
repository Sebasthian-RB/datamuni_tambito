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

use Illuminate\Support\Carbon;

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
        $committee = Committee::findOrFail($committee_id);

        $committeeVlFamilyMembers = CommitteeVlFamilyMember::where('committee_id', $committee_id)
            ->with(['vlFamilyMember.vlMinors'])
            ->get();

        return view('areas.VasoDeLecheViews.CommitteeVlFamilyMembers.index', compact('committee', 'committeeVlFamilyMembers'));
    }


    /**
     * Muestra el formulario para crear un nuevo miembro familiar en un comité.
     *
     * @param CreateCommitteeVlFamilyMemberRequest $request
     * @return \Illuminate\View\View
     */
    public function create(CreateCommitteeVlFamilyMemberRequest $request, $committee_id)
    {
        // Obtener el comité específico
        $committee = Committee::findOrFail($committee_id);

        // Obtener los comités desde el modelo Committee
        $committees = Committee::all();

        // Obtener los miembros de la familia desde el modelo VlFamilyMember
        $vlFamilyMembers = VlFamilyMember::all();

        // Definir las opciones para el campo 'status' en el controlador
        $statusOptions = [
            1 => 'Activo',
            0 => 'Inactivo',
        ];

        $identityDocumentTypes = [
            'DNI' => 'DNI',
            'Carnet de Extranjería' => 'Carnet de Extranjería',
            'Otro' => 'Otro',
        ];

        return view('areas.VasoDeLecheViews.CommitteeVlFamilyMembers.create', compact('committee', 'committees', 'vlFamilyMembers', 'statusOptions', 'identityDocumentTypes'));
    }

    /**
     * Almacena un nuevo miembro familiar asignado a un comité en la base de datos.
     *
     * @param StoreCommitteeVlFamilyMemberRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCommitteeVlFamilyMemberRequest $request)
    {
        // Verificar que los datos obligatorios estén presentes
        if (!$request->has('committee_id') || !$request->has('vl_family_member_id')) {
            return redirect()->back()->with('error', 'Faltan datos necesarios para continuar.');
        }
        
        // Buscar si el familiar ya pertenece a otro comité activo
        $existingMember = CommitteeVlFamilyMember::where('vl_family_member_id', $request->vl_family_member_id)
            ->where('status', 1)
            ->first();

        // Si ya existe y el usuario no ha confirmado, guardar los datos en la sesión correctamente
        if ($existingMember && !$request->has('confirm_update')) {
            session()->flash('confirmation_needed', true);
            session()->flash('existing_member_id', $request->vl_family_member_id);
            session()->flash('committee_id', $request->committee_id);
            session()->flash('description', $request->description ?? '');
            session()->flash('change_date', $request->change_date ?? now()->toDateTimeString());

            return redirect()->back()->withInput();
        }

        // Si el usuario confirmó, cambiar los registros anteriores a estado inactivo (status = 0)
        if ($existingMember && $request->has('confirm_update')) {
            // Verifica que la actualización se haya realizado correctamente
            $updated = CommitteeVlFamilyMember::where('vl_family_member_id', $request->vl_family_member_id)
                ->update(['status' => 0]);
        
            if (!$updated) {
                return redirect()->back()->with('error', 'Error al actualizar el estado del miembro anterior.');
            }
        }

        // Crear el nuevo registro con status activo
        $committeeMember = CommitteeVlFamilyMember::create([
            'committee_id' => $request->committee_id,
            'vl_family_member_id' => $request->vl_family_member_id,
            'change_date' => $request->change_date ?? now(),
            'description' => $request->description ?? '',
            'status' => 1, // Activo por defecto
        ]);

        if (!$committeeMember) {
            return redirect()->back()->with('error', 'No se pudo guardar el miembro en la base de datos.');
        }

        // Limpiar la sesión después de la confirmación
        session()->forget(['confirmation_needed', 'existing_member_id', 'committee_id', 'description', 'change_date']);

        return redirect()->route('committee_vl_family_members.index', ['committee_id' => $request->committee_id])
                        ->with('success', 'Miembro agregado correctamente.');
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
