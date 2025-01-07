<?php

namespace App\Http\Controllers\CiamControllers;

use App\Models\ElderlyAdult;
use Illuminate\Http\Request;

class ElderlyAdultController extends Controller
{
    /**
     * Mostrar una lista de adultos mayores.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $elderlyAdults = ElderlyAdult::with('guardians', 'socialPrograms', 'privateInsurances')->get();
        return view('elderly_adults.index', compact('elderlyAdults'));
    }

    /**
     * Mostrar el formulario para crear un nuevo adulto mayor.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('elderly_adults.create');
    }

    /**
     * Almacenar un nuevo adulto mayor en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|string|max:36|unique:elderly_adults',
            'document_type' => 'required|in:DNI,Pasaporte,Carnet,Cedula',
            'given_name' => 'required|string|max:50',
            'paternal_last_name' => 'required|string|max:50',
            'maternal_last_name' => 'required|string|max:50',
            'birth_date' => 'required|date',
            'address' => 'nullable|string|max:255',
            'reference' => 'nullable|string|max:255',
            'sex_type' => 'required|boolean',
            'phone_number' => 'nullable|string|max:50',
            'type_of_disability' => 'nullable|in:Visual,Motriz,Mental',
            'household_members' => 'nullable|integer',
            'permanent_attention' => 'nullable|boolean',
            'observation' => 'nullable|string',
        ]);

        ElderlyAdult::create($validated);

        return redirect()->route('elderly_adults.index')->with('success', 'Adulto mayor creado exitosamente');
    }

    /**
     * Mostrar un adulto mayor específico.
     *
     * @param  string  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $elderlyAdult = ElderlyAdult::with('guardians', 'socialPrograms', 'privateInsurances')->find($id);

        if (!$elderlyAdult) {
            return redirect()->route('elderly_adults.index')->with('error', 'Adulto mayor no encontrado');
        }

        return view('elderly_adults.show', compact('elderlyAdult'));
    }

    /**
     * Mostrar el formulario para editar un adulto mayor.
     *
     * @param  string  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $elderlyAdult = ElderlyAdult::find($id);

        if (!$elderlyAdult) {
            return redirect()->route('elderly_adults.index')->with('error', 'Adulto mayor no encontrado');
        }

        return view('elderly_adults.edit', compact('elderlyAdult'));
    }

    /**
     * Actualizar un adulto mayor específico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'document_type' => 'in:DNI,Pasaporte,Carnet,Cedula',
            'given_name' => 'string|max:50',
            'paternal_last_name' => 'string|max:50',
            'maternal_last_name' => 'string|max:50',
            'birth_date' => 'date',
            'address' => 'nullable|string|max:255',
            'reference' => 'nullable|string|max:255',
            'sex_type' => 'boolean',
            'phone_number' => 'nullable|string|max:50',
            'type_of_disability' => 'nullable|in:Visual,Motriz,Mental',
            'household_members' => 'nullable|integer',
            'permanent_attention' => 'nullable|boolean',
            'observation' => 'nullable|string',
        ]);

        $elderlyAdult = ElderlyAdult::find($id);

        if (!$elderlyAdult) {
            return redirect()->route('elderly_adults.index')->with('error', 'Adulto mayor no encontrado');
        }

        $elderlyAdult->update($validated);

        return redirect()->route('elderly_adults.index')->with('success', 'Adulto mayor actualizado exitosamente');
    }

    /**
     * Eliminar un adulto mayor específico.
     *
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $elderlyAdult = ElderlyAdult::find($id);

        if (!$elderlyAdult) {
            return redirect()->route('elderly_adults.index')->with('error', 'Adulto mayor no encontrado');
        }

        $elderlyAdult->delete();

        return redirect()->route('elderly_adults.index')->with('success', 'Adulto mayor eliminado exitosamente');
    }
}
