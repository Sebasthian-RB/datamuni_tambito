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

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class VlFamilyMemberController extends Controller
{
    use AuthorizesRequests;

    /**
     * Muestra una lista de todos los miembros familiares.
     *
     * @param IndexVlFamilyMemberRequest $request
     * @return \Illuminate\View\View
     */
    public function index(IndexVlFamilyMemberRequest $request)
    {
        // Verificación de permiso
        $this->authorize('ver BD');

        $searchId = $request->input('search_id');
    
        $vlFamilyMembers = VlFamilyMember::when($searchId, function($query) use ($searchId) {
                // Convertir el ID a cadena y buscar coincidencias parciales
                return $query->where(DB::raw('CAST(id AS CHAR)'), 'LIKE', "%{$searchId}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('areas.VasoDeLecheViews.VlFamilyMembers.index', 
            compact('vlFamilyMembers', 'searchId'));
    }

    /**
     * Muestra el formulario para crear un nuevo miembro familiar.
     *
     * @param CreateVlFamilyMemberRequest $request
     * @return \Illuminate\View\View
     */
    public function create(CreateVlFamilyMemberRequest $request)
    {
        // Verificación de permiso
        $this->authorize('crear');
        
        $identityDocumentTypes = [
            'DNI' => 'DNI',
            'Carnet de Extranjería' => 'Carnet de Extranjería',
            'Pasaporte' => 'Pasaporte',
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
        // Verificación de permiso
        $this->authorize('crear');
        
        // Creamos el miembro de la familia
        $newFamilyMember = VlFamilyMember::create($request->validated());
        // Si la solicitud es AJAX, devolvemos una respuesta JSON
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Miembro familiar creado correctamente.',
                'id' => $newFamilyMember->id,
                'identity_document' => $newFamilyMember->identity_document,
                'given_name' => $newFamilyMember->given_name,
                'paternal_last_name' => $newFamilyMember->paternal_last_name,
                'maternal_last_name' => $newFamilyMember->maternal_last_name,
                'minors' => [] // Si no hay menores, devolvemos un array vacío
            ]);
        }

        // Si no es AJAX, redirigimos como siempre
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
        // Verificación de permiso
        $this->authorize('ver detalles');
        
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
        // Verificación de permiso
        $this->authorize('editar');
        
        $identityDocumentTypes = [
            'DNI' => 'DNI',
            'Carnet de Extranjería' => 'Carnet de Extranjería',
            'Pasaporte' => 'Pasaporte',
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
        // Verificación de permiso
        $this->authorize('editar');
        
        // Validar los datos de la solicitud
        $data = $request->validated();

        // Actualizar el miembro de la familia con los nuevos datos (sin ejecutar todavía)
        $vlFamilyMember->fill($data); // Llenamos los datos pero no lo actualizamos aún

        // Verificar si hay cambios antes de proceder
        if (!$vlFamilyMember->isDirty()) {
            return redirect()->route('vl_family_members.index')->with('info', 'No se realizaron cambios.');
        }

        // Si hay cambios, actualizamos el miembro de la familia
        $vlFamilyMember->save();

        // Redirigir con el mensaje de éxito
        return redirect()->route('vl_family_members.index')->with('success', 'Miembro de familia actualizado correctamente.');
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
        // Verificación de permiso
        $this->authorize('eliminar');
        
        $vlFamilyMember->delete();

        return redirect()
            ->route('vl_family_members.index')
            ->with('success', 'Miembro familiar eliminado correctamente.');
    }
}
