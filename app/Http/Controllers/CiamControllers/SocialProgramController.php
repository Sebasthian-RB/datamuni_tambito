<?php

namespace App\Http\Controllers\CiamControllers;

use App\Http\Controllers\Controller;
use App\Models\CiamModels\SocialProgram;
use Illuminate\Http\Request;

class SocialProgramController extends Controller
{
    /**
     * Mostrar una lista de todos los programas sociales.
     */
    public function index()
    {
        // Obtener todos los programas sociales
        $socialPrograms = SocialProgram::all();

        // Retornar la vista del índice con los programas sociales
        return view('areas.CiamViews.SocialPrograms.index', compact('socialPrograms'));
    }

    /**
     * Mostrar el formulario para crear un nuevo programa social.
     */
    public function create()
    {
        // Retornar la vista para crear un programa social
        return view('social_programs.create');
    }

    /**
     * Almacenar un nuevo programa social en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos enviados por el formulario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:social_programs,name',
        ]);

        // Crear un nuevo programa social con los datos validados
        SocialProgram::create($validatedData);

        // Redirigir al índice con un mensaje de éxito
        return redirect()->route('social_programs.index')->with('success', 'Programa social creado exitosamente.');
    }

    /**
     * Mostrar los detalles de un programa social específico.
     */
    public function show(SocialProgram $socialProgram)
    {
        // Retornar la vista para mostrar los detalles del programa social
        return view('social_programs.show', compact('socialProgram'));
    }

    /**
     * Mostrar el formulario para editar un programa social existente.
     */
    public function edit(SocialProgram $socialProgram)
    {
        // Retornar la vista para editar el programa social
        return view('social_programs.edit', compact('socialProgram'));
    }

    /**
     * Actualizar un programa social específico en la base de datos.
     */
    public function update(Request $request, SocialProgram $socialProgram)
    {
        // Validar los datos enviados por el formulario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:social_programs,name,' . $socialProgram->id,
        ]);

        // Actualizar el programa social con los datos validados
        $socialProgram->update($validatedData);

        // Redirigir al índice con un mensaje de éxito
        return redirect()->route('social_programs.index')->with('success', 'Programa social actualizado exitosamente.');
    }

    /**
     * Eliminar un programa social específico de la base de datos.
     */
    public function destroy(SocialProgram $socialProgram)
    {
        // Eliminar el programa social
        $socialProgram->delete();

        // Redirigir al índice con un mensaje de éxito
        return redirect()->route('social_programs.index')->with('success', 'Programa social eliminado exitosamente.');
    }
}
