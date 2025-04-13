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

        // Obtener los miembros de la familia desde el modelo VlFamilyMember
        $vlFamilyMembers = VlFamilyMember::with('vlMinors')->get();        

        // Definir las opciones para el campo 'status' en el controlador
        $statusOptions = [
            1 => 'Activo',
            0 => 'Inactivo',
        ];

        // Definir las opciones disponibles para los selects
        $documentTypes = ['DNI', 'CNV', 'Pasaporte', 'Carnet de Extranjería', 'Otro'];  //Para el menor de edad
        $identityDocumentTypes = [
            'DNI' => 'DNI',
            'Carnet de Extranjería' => 'Carnet de Extranjería',
            'Pasaporte' => 'Pasaporte',
            'Otro' => 'Otro',
        ]; // Para el familiar (agregar)
        
        
        $educationLevels = ['Ninguno', 'Inicial', 'Primaria', 'Secundaria', 'Técnico', 'Superior', 'Educación Especial'];
        
        $conditions = ['Menor de 1 año', 'Niño de 1 a 6 años', 'Niño de 7 a 13 años', 'Madre gestante', 'Madre lactante', 'Anciano', 'Discapacitado', 'Persona con TBC'];
        
        $dwellingTypes = ['Propio', 'Alquilado', 'Cedido', 'Vivienda Social', 'Otros'];

        $kinships = ['Hijo(a)', 'Nieto(a)', 'Sobrino(a)', 'Hermano(a)', 'Primo(a)', 'Socio(a)', 'Otro Familiar'];

        $sisfohClassifications = ['No Pobre', 'Pobre', 'Pobre Extremo'];

        $hasSisfoh = [
            '0' => 'No',
            '1' => 'Sí',
        ];
        
        $sexTypes = [
            1 => 'Masculino',
            0 => 'Femenino',
        ];

        $disabilities = [
            1 => 'Sí',
            0 => 'No',
        ];

        return view('areas.VasoDeLecheViews.CommitteeVlFamilyMembers.create', compact(
            'committee', 
            'vlFamilyMembers', 
            'statusOptions', 
            'documentTypes',
            'identityDocumentTypes',
            'educationLevels',
            'conditions',
            'dwellingTypes',
            'kinships',
            'sexTypes', 
            'disabilities',
            'sisfohClassifications'
        ));
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
        // Obtener el comité específico
        $committee = $committeeVlFamilyMember->committee;

        // Obtener los miembros de la familia desde el modelo VlFamilyMember
        $vlFamilyMembers = VlFamilyMember::with('vlMinors')->get();        

        // Definir las opciones para el campo 'status' en el controlador
        $statusOptions = [
            1 => 'Activo',
            0 => 'Inactivo',
        ];

        // Definir las opciones disponibles para los selects
        $documentTypes = ['DNI', 'CNV', 'Pasaporte', 'Carnet de Extranjería', 'Otro'];  //Para el menor de edad
        $identityDocumentTypes = [
            'DNI' => 'DNI',
            'Carnet de Extranjería' => 'Carnet de Extranjería',
            'Pasaporte' => 'Pasaporte',
            'Otro' => 'Otro',
        ]; // Para el familiar (agregar)
       
        $educationLevels = ['Ninguno', 'Inicial', 'Primaria', 'Secundaria', 'Técnico', 'Superior', 'Educación Especial'];
        
        $conditions = ['Menor de 1 año', 'Niño de 1 a 6 años', 'Niño de 7 a 13 años', 'Madre gestante', 'Madre lactante', 'Anciano', 'Discapacitado', 'Persona con TBC'];
        
        $dwellingTypes = ['Propio', 'Alquilado', 'Cedido', 'Vivienda Social', 'Otros'];

        $kinships = ['Hijo(a)', 'Nieto(a)', 'Sobrino(a)', 'Hermano(a)', 'Primo(a)', 'Socio(a)', 'Otro Familiar'];

        $sisfohClassifications = ['No Pobre', 'Pobre', 'Pobre Extremo'];

        $hasSisfoh = [
            '0' => 'No',
            '1' => 'Sí',
        ];
                
        $sexTypes = [
            1 => 'Masculino',
            0 => 'Femenino',
        ];

        $disabilities = [
            1 => 'Sí',
            0 => 'No',
        ];

        return view('areas.VasoDeLecheViews.CommitteeVlFamilyMembers.edit', compact(
            'committeeVlFamilyMember',
            'committee', 
            'vlFamilyMembers', 
            'statusOptions', 
            'documentTypes',
            'identityDocumentTypes',
            'educationLevels',
            'conditions',
            'dwellingTypes',
            'kinships',
            'sexTypes', 
            'disabilities',
            'sisfohClassifications'    
        ));
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

        return redirect()->route('committee_vl_family_members.index', [
            'committee_id' => $committeeVlFamilyMember->committee_id
        ])->with('success', 'Miembro familiar del comité actualizado correctamente.');
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
        $committeeId = $committeeVlFamilyMember->committee_id; 
        
        $committeeVlFamilyMember->delete();

        return redirect()->route('committee_vl_family_members.index', [
            'committee_id' => $committeeId
        ])->with('success', 'Miembro familiar del comité eliminado correctamente.');
    }
}
