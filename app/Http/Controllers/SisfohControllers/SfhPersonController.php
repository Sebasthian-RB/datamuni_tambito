<?php

namespace App\Http\Controllers\SisfohControllers;

use App\Models\SisfohModels\SfhPerson;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Http\Requests\SisfohRequests\SfhPeople\IndexSfhPersonRequest;
use App\Http\Requests\SisfohRequests\SfhPeople\ShowSfhPersonRequest;
use App\Http\Requests\SisfohRequests\SfhPeople\CreateSfhPersonRequest;
use App\Http\Requests\SisfohRequests\SfhPeople\StoreSfhPersonRequest;
use App\Http\Requests\SisfohRequests\SfhPeople\EditSfhPersonRequest;
use App\Http\Requests\SisfohRequests\SfhPeople\UpdateSfhPersonRequest;
use App\Http\Requests\SisfohRequests\SfhPeople\DestroySfhPersonRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class SfhPersonController extends Controller
{

    use AuthorizesRequests;
    /**
     * Grados académicos disponibles.
     *
     * @var array
     */
    private $degrees;

    /**
     * Constructor para inicializar la variable global.
     */
    public function __construct()
    {
        $this->degrees = [
            'INICIAL',
            'NINGUNO_NIVEL_LETRADO',
            'PRIMARIA COMPLETA',
            'PRIMARIA-1ER GRADO',
            'PRIMARIA-2DO GRADO',
            'PRIMARIA-3ER GRADO',
            'PRIMARIA-4TO GRADO',
            'PRIMARIA-5TO GRADO',
            'PRIMARIA-6TO GRADO',
            'PRIMARIA INCOMPLETA',
            'SECUNDARIA COMPLETA',
            'SECUNDARIA-1ER AÑO',
            'SECUNDARIA-2DO AÑO',
            'SECUNDARIA-3ER AÑO',
            'SECUNDARIA-4TO AÑO',
            'SECUNDARIA-5TO AÑO',
            'SECUNDARIA INCOMPLETA',
            'SUPERIOR COMPLETA',
            'SUPERIOR-1ER AÑO',
            'SUPERIOR-2DO AÑO',
            'SUPERIOR-3ER AÑO',
            'SUPERIOR-4TO AÑO',
            'SUPERIOR-5TO AÑO',
            'SUPERIOR-6TO AÑO',
            'SUPERIOR-7MO AÑO',
            'SUPERIOR-8VO AÑO',
            'SUPERIOR INCOMPLETA',
            'ILETRADO/SIN INSTRUCCION',
            'TECNICA COMPLETA',
            'TECNICA-1ER AÑO',
            'TECNICA-2DO AÑO',
            'TECNICA-3ER AÑO',
            'TECNICA-4TO AÑO',
            'TECNICA-5TO AÑO',
            'TECNICA IMCOMPLETA',
            'EDUCACION ESPECIAL'
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(IndexSfhPersonRequest $request)
    {
        $this->authorize('ver BD');
        // Validar la solicitud si es necesario
        $validated = $request->validated();
        
        // Obtener todos los registros de personas
        $people = SfhPerson::all();
        
        
        // Retornar la vista con la lista de personas
        return view('areas.SisfohViews.SfhPeople.index', compact('people'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateSfhPersonRequest $request)
    {
        $this->authorize('crear');
        // Retornar la vista para crear una persona
        // Pasar los grados académicos a la vista
        $degrees = $this->degrees;
        return view('areas.SisfohViews.SfhPeople.create', compact('degrees'));  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSfhPersonRequest $request)
    {
        // Validar la solicitud si es necesario
        $validated = $request->validated();
        
        // Crear una nueva persona con los datos validados
        $person = SfhPerson::create($request->all());

        // Redirigir a la lista de personas con un mensaje de éxito
        return redirect()->route('sfh_people.index')->with('success', 'Persona creada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowSfhPersonRequest $request, SfhPerson $sfhPerson)
    {
        $this->authorize('ver detalles');
        // Validar la solicitud si es necesario
        $validated = $request->validated();
        
        // Retornar la vista para mostrar los detalles de una persona
        return view('areas.SisfohViews.SfhPeople.show', compact('sfhPerson'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EditSfhPersonRequest $request, SfhPerson $sfhPerson)
    {
        $this->authorize('editar');
        // Validar la solicitud si es necesario
        $validated = $request->validated();
        
        // Pasar los grados académicos a la vista junto con la persona a editar
        $degrees = $this->degrees;

        // Mostrar el formulario de edición
        return view('areas.SisfohViews.SfhPeople.edit', compact('sfhPerson', 'degrees'));

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSfhPersonRequest $request, SfhPerson $sfhPerson)
    {
        // Validar la solicitud si es necesario
        $validated = $request->validated();
        
        // Actualizar los datos de la persona
        $sfhPerson->update($request->all());

        // Redirigir a la lista de personas con un mensaje de éxito
        return redirect()->route('sfh_people.index')->with('success', 'Persona actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroySfhPersonRequest $request, SfhPerson $sfhPerson)
    {
        $this->authorize('eliminar');
        // Validar la solicitud si es necesario
        $validated = $request->validated();
        
        // Eliminar la persona
        $sfhPerson->delete();

        // Redirigir a la lista de personas con un mensaje de éxito
        return redirect()->route('sfh_people.index')->with('success', 'Persona eliminada con éxito.');
    }
}

