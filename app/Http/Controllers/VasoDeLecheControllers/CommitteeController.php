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

use App\Models\VasoDeLecheModels\Sector;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommitteeController extends Controller
{
    use AuthorizesRequests;

    /**
     * Muestra una lista de todos los comités.
     *
     * @param IndexCommitteeRequest $request
     * @return \Illuminate\View\View
     */
    public function index(IndexCommitteeRequest $request)
    {
        // Verificación de permiso
        $this->authorize('ver BD');

        // Obtener parámetro de búsqueda validado
        $validated = $request->validated();
        $searchName = $validated['search_name'] ?? null;

        // Consulta base con eager loading
        $committees = Committee::with('sector')
            ->when($searchName, function($query) use ($searchName) {
                return $query->where('name', 'LIKE', "%{$searchName}%");
            })
            ->orderBy('name')
            ->paginate(15)
            ->appends(['search_name' => $searchName]);

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
        // Verificación de permiso
        $this->authorize('crear');

        // Obtener los sectores desde el modelo Sector
        $sectors = Sector::all();  // O la consulta adecuada para obtener los sectores

        //Definir los Núcleos Urbanos
        $urbanCores = ['Urbano', 'Rural'];

        // Pasar los sectores a la vista
        return view('areas.VasoDeLecheViews.Committees.create', compact('sectors', 'urbanCores'));
    }

    /**
     * Almacena un comité recién creado en la base de datos.
     *
     * @param StoreCommitteeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCommitteeRequest $request)
    {
        // Verificación de permiso
        $this->authorize('crear');

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
        // Verificación de permiso
        $this->authorize('ver detalles');

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
        // Verificación de permiso
        $this->authorize('editar');
        
        // Obtener todos los sectores para pasarlos a la vista
        $sectors = Sector::all();

        // Verificar si hay sectores disponibles
        if ($sectors->isEmpty()) {
            return redirect()->route('committees.index')->withErrors('No hay sectores disponibles para asociar.');
        }

        //Definir los Núcleos Urbanos
        $urbanCores = ['Urbano', 'Rural'];

        return view('areas.VasoDeLecheViews.Committees.edit', compact('committee', 'sectors', 'urbanCores'));    
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
        // Verificación de permiso
        $this->authorize('editar');

        // Validar los datos de la solicitud
        $data = $request->validated();

        // Actualizar el comité con los nuevos datos (sin ejecutar todavía)
        $committee->fill($data); // Llenamos los datos pero no lo actualizamos aún

        // Verificar si hay cambios antes de proceder
        if (!$committee->isDirty()) {
            return redirect()->route('committees.index')->with('info', 'No se realizaron cambios.');
        }

        // Si hay cambios, actualizamos el comité
        $committee->save();

        // Redirigir con el mensaje de éxito
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
        // Verificación de permiso
        $this->authorize('eliminar');

        $committee->delete();
        return redirect()->route('committees.index')->with('success', 'Comité eliminado correctamente.');
    }
}
