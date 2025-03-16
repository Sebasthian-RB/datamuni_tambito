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

use App\Models\VasoDeLecheModels\VlFamilyMember;

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
        $vlMinors = VlMinor::paginate(15);
        return view('areas.VasoDeLecheViews.VlMinors.index', compact('vlMinors'));
    }

    /**
     * Muestra el formulario para crear un nuevo menor.
     *
     * @param CreateVlMinorRequest $request
     * @return \Illuminate\View\View
     */
    public function create(CreateVlMinorRequest $request)
    {
        // Definir las opciones disponibles para los selects
        $documentTypes = ['DNI', 'Pasaporte', 'Cédula de Extranjería'];  //Para el menor de edad
        $identityDocumentTypes = [
            'DNI' => 'DNI',
            'Carnet de Extranjería' => 'Carnet de Extranjería',
            'Otro' => 'Otro',
        ]; // Para el familiar (agregar)
        $sexTypes = [
            0 => 'Femenino',
            1 => 'Masculino',
        ];
        $educationLevels = ['Ninguno', 'Inicial', 'Primaria', 'Secundaria', 'Técnico', 'Superior'];
        $conditions = ['Gest.', 'Lact.', 'Anc.'];
        $disabilities = [
            0 => 'No',
            1 => 'Sí',
        ];
        $dwellingTypes = ['Propio', 'Alquilado'];

        $kinships = ['Hijo(a)', 'Socio(a)'];

        $status = [
            0 => 'No',
            1 => 'Sí',
        ];

        // Obtener los miembros familiares
        $vlFamilyMembers = VlFamilyMember::all();

        // Pasar todas las variables a la vista
        return view('areas.VasoDeLecheViews.VlMinors.create', compact(
            'documentTypes',
            'sexTypes',
            'educationLevels',
            'conditions',
            'disabilities',
            'dwellingTypes',
            'vlFamilyMembers',
            'kinships', 
            'status',
            'identityDocumentTypes'
        ));
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

        // Si es una solicitud AJAX, retorna JSON
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Menor creado correctamente.',
            ]);
        }

        // Redirección con mensaje de éxito
        return redirect()->route('vl_minors.index')->with('success', 'Menor registrado correctamente.');
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
        return view('areas.VasoDeLecheViews.VlMinors.show', compact('vlMinor'));
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
        // Aquí se definen las opciones disponibles para los selects
        $documentTypes = ['DNI', 'Pasaporte', 'Cédula de Extranjería'];  //Para el menor de edad
        $identityDocumentTypes = [
            'DNI' => 'DNI',
            'Carnet de Extranjería' => 'Carnet de Extranjería',
            'Otro' => 'Otro',
        ]; // Para el familiar (agregar)
        $sexTypes = [
            0 => 'Femenino',
            1 => 'Masculino',
        ];
        $educationLevels = ['Ninguno', 'Inicial', 'Primaria', 'Secundaria', 'Técnico', 'Superior'];
        $conditions = ['Gest.', 'Lact.', 'Anc.'];
        $disabilities = [
            0 => 'No',
            1 => 'Sí',
        ];
        $dwellingTypes = ['Propio', 'Alquilado'];

        $kinships = ['Hijo(a)', 'Socio(a)'];

        $status = [
            0 => 'No',
            1 => 'Sí',
        ];

        // Obtener los miembros familiares
        $vlFamilyMembers = VlFamilyMember::all();

        // Formatear las fechas en el formato adecuado 'Y-m-d'
        $vlMinor->birth_date = $vlMinor->birth_date ? $vlMinor->birth_date->format('Y-m-d') : null;
        $vlMinor->registration_date = $vlMinor->registration_date ? $vlMinor->registration_date->format('Y-m-d') : null;
        $vlMinor->withdrawal_date = $vlMinor->withdrawal_date ? $vlMinor->withdrawal_date->format('Y-m-d') : null;

        // Pasar todas las variables a la vista
        return view('areas.VasoDeLecheViews.VlMinors.edit', compact(
            'documentTypes',
            'sexTypes',
            'educationLevels',
            'conditions',
            'disabilities',
            'dwellingTypes',
            'vlFamilyMembers',
            'kinships',
            'status',
            'identityDocumentTypes',
            'vlMinor'
        ));
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
        // Validar los datos de la solicitud
        $data = $request->validated();

        // Actualizar el menor con los nuevos datos (sin ejecutar todavía)
        $vlMinor->fill($data); // Llenamos los datos pero no lo actualizamos aún

        // Verificar si hay cambios antes de proceder
        if (!$vlMinor->isDirty()) {
            return redirect()->route('vl_minors.index')->with('info', 'No se realizaron cambios.');
        }

        // Si hay cambios, actualizamos los datos del menor
        $vlMinor->save();

        // Redirigir con el mensaje de éxito
        return redirect()->route('vl_minors.index')->with('success', 'Datos del menor actualizados correctamente.');
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
        return redirect()->route('vl_minors.index')->with('success', 'Menor eliminado correctamente.');
    }
}
