<?php

namespace App\Http\Controllers\AreaDeLaMujerControllers;

use App\Models\AreaDeLaMujerModels\Program;
use App\Http\Controllers\Controller;
use App\Http\Requests\AreaDeLaMujerRequests\Programs\StoreProgramRequest;
use App\Http\Requests\AreaDeLaMujerRequests\Programs\UpdateProgramRequest;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $programs = Program::where('name', 'like', "%$search%")
            ->paginate(10);

        return view('areas.AreaDeLaMujerViews.Programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('areas.AreaDeLaMujerViews.Programs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProgramRequest $request)
    {

        Program::create($request->validated());
        return redirect()->route('programs.index')->with('success', 'Programa creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        return view('areas.AreaDeLaMujerViews.Programs.show', compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        return view('areas.AreaDeLaMujerViews.Programs.edit', compact('program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProgramRequest $request, Program $program)
    {

        $program->update($request->validated());
        return redirect()->route('programs.index')->with('success', 'Programa actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('programs.index')->with('success', 'Programa eliminado con éxito.');
    }
}
