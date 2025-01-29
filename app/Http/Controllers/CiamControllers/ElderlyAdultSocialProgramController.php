<?php

namespace App\Http\Controllers\CiamControllers;

use App\Http\Controllers\Controller;
use App\Models\CiamModels\ElderlyAdult;
use App\Models\CiamModels\ElderlyAdultSocialProgram;
use App\Models\CiamModels\SocialProgram;
use Illuminate\Http\Request;

class ElderlyAdultSocialProgramController extends Controller
{
    /**
     * Muestra una lista de todas las relaciones entre adultos mayores y programas sociales.
     */
    public function index()
    {
        $relations = ElderlyAdultSocialProgram::with(['elderlyAdult', 'socialProgram'])->get();
        return view('areas.CiamViews.ElderlyAdultsSocialPrograms.index', compact('relations'));
    }

    /**
     * Muestra el formulario para crear una nueva relación.
     */
    public function create()
    {
        $elderlyAdults = ElderlyAdult::all();
        $socialPrograms = SocialProgram::all();
        return view('elderly_adult_social_programs.create', compact('elderlyAdults', 'socialPrograms'));
    }

    /**
     * Almacena una nueva relación en la base de datos.
     */
    public function store(Request $request)
    {
        // Validación de los campos
        $request->validate([
            'elderly_adults_id' => 'required|exists:elderly_adults,id',
            'social_programs_id' => 'required|exists:social_programs,id',
        ]);

        // Crear la nueva relación
        ElderlyAdultSocialProgram::create($request->all());

        // Redirigir al índice con un mensaje de éxito
        return redirect()->route('elderly_adult_social_programs.index')
            ->with('success', 'Relación creada exitosamente.');
    }

    /**
     * Muestra los detalles de una relación específica.
     */
    public function show(ElderlyAdultSocialProgram $elderlyAdultSocialProgram)
    {
        return view('elderly_adult_social_programs.show', compact('elderlyAdultSocialProgram'));
    }

    /**
     * Muestra el formulario para editar una relación existente.
     */
    public function edit(ElderlyAdultSocialProgram $elderlyAdultSocialProgram)
    {
        $elderlyAdults = ElderlyAdult::all();
        $socialPrograms = SocialProgram::all();
        return view('elderly_adult_social_programs.edit', compact('elderlyAdultSocialProgram', 'elderlyAdults', 'socialPrograms'));
    }

    /**
     * Actualiza una relación existente en la base de datos.
     */
    public function update(Request $request, ElderlyAdultSocialProgram $elderlyAdultSocialProgram)
    {
        // Validación de los campos
        $request->validate([
            'elderly_adults_id' => 'required|exists:elderly_adults,id',
            'social_programs_id' => 'required|exists:social_programs,id',
        ]);

        // Actualizar los datos
        $elderlyAdultSocialProgram->update($request->all());

        // Redirigir al índice con un mensaje de éxito
        return redirect()->route('elderly_adult_social_programs.index')
            ->with('success', 'Relación actualizada exitosamente.');
    }

    /**
     * Elimina una relación específica de la base de datos.
     */
    public function destroy(ElderlyAdultSocialProgram $elderlyAdultSocialProgram)
    {
        $elderlyAdultSocialProgram->delete();

        // Redirigir al índice con un mensaje de éxito
        return redirect()->route('elderly_adult_social_programs.index')
            ->with('success', 'Relación eliminada exitosamente.');
    }
}
