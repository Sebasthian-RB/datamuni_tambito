<?php

namespace App\Http\Controllers\SisfohControllers;

use App\Http\Controllers\Controller;
use App\Models\SisfohModels\Enumerator;

use App\Http\Requests\SisfohRequests\Enumerators\IndexEnumeratorRequest;
use App\Http\Requests\SisfohRequests\Enumerators\ShowEnumeratorRequest;
use App\Http\Requests\SisfohRequests\Enumerators\CreateEnumeratorRequest;
use App\Http\Requests\SisfohRequests\Enumerators\StoreEnumeratorRequest;
use App\Http\Requests\SisfohRequests\Enumerators\EditEnumeratorRequest;
use App\Http\Requests\SisfohRequests\Enumerators\UpdateEnumeratorRequest;
use App\Http\Requests\SisfohRequests\Enumerators\DestroyEnumeratorRequest;

class EnumeratorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexEnumeratorRequest $request)
    {
        // Recupera todos los encuestadores de la base de datos
        $enumerators = Enumerator::all(); 

        // Retorna la vista con los encuestadores
        return view('areas.SisfohViews.Enumerators.index', compact('enumerators'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateEnumeratorRequest $request)
    {
        // Retorna la vista de crear un nuevo encuestador
        return view('areas.SisfohViews.Enumerators.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEnumeratorRequest $request)
    {
        // Valida y crea un nuevo encuestador
        $data = $request->validated();  // Obtiene los datos validados
        Enumerator::create($data);  // Crea un nuevo encuestador

        // Redirige a la lista de encuestadores con un mensaje de éxito
        return redirect()->route('areas.SisfohViews.Enumerators.index')->with('success', 'Encuestador creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Enumerator $enumerator, ShowEnumeratorRequest $request)
    {
        // Muestra los detalles de un encuestador específico
        return view('sisfoh.enumerators.show', compact('enumerator'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enumerator $enumerator, EditEnumeratorRequest $request)
    {
        // Muestra el formulario de edición de un encuestador
        return view('sisfoh.enumerators.edit', compact('enumerator'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEnumeratorRequest $request, Enumerator $enumerator)
    {
        // Valida y actualiza el encuestador
        $data = $request->validated();  // Obtiene los datos validados
        $enumerator->update($data);  // Actualiza el encuestador

        // Redirige a la vista de detalles con un mensaje de éxito
        return redirect()->route('enumerators.show', $enumerator)->with('success', 'Encuestador actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enumerator $enumerator, DestroyEnumeratorRequest $request)
    {
        // Elimina el encuestador
        $enumerator->delete();

        // Redirige a la lista de encuestadores con un mensaje de éxito
        return redirect()->route('enumerators.index')->with('success', 'Encuestador eliminado con éxito.');
    }
}
