<?php

namespace App\Http\Controllers\VasoDeLecheControllers;

use App\Models\VasoDeLecheModels\Committee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommitteeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $committees = Committee::paginate(15);

        return view('areas.VasoDeLecheViews.Committees.index', compact('committees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('areas.VasoDeLecheViews.Committees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommittee $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Committee $committee)
    {
        return view('areas.VasoDeLecheViews.Committees.show', compact('committee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Committee $committee)
    {
        return view('areas.VasoDeLecheViews.Committees.edit', compact('committees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Committee $committee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Committee $committee)
    {
        try 
        {
            // Intentamos eliminar el comité de la base de datos
            $committee->delete();

            // Si la eliminación fue exitosa, redirigimos con un mensaje de éxito
            return redirect()->route('committees.index')->with('success', 'Comité eliminado correctamente');
        } 
        catch (\Exception $e) 
        {
            // Si ocurre un error, se captura la excepción y redirige con un mensaje de error
            return redirect()->route('committees.index')->with('error', 'No se pudo eliminar el comité');
        }
    }
}
