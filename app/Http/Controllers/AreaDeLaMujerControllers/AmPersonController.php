<?php

namespace App\Http\Controllers\AreaDeLaMujerControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AreaDeLaMujerModels\AmPerson;
use Illuminate\Support\Facades\Validator;

class AmPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recuperamos todas las personas
        $people = AmPerson::all();
        return view('areas.AreaDeLaMujerViews.AmPersons.index', compact('people'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar formulario de creación
        return view('areas.AreaDeLaMujerViews.AmPersons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validaciones de los datos de la persona
        $validator = Validator::make($request->all(), [
            'id' => 'required|string|max:36',
            'identity_document' => ['required', 'string', 'in:DNI,Pasaporte,Carnet,Cedula'],
            'given_name' => 'required|string|max:50',
            'paternal_last_name' => 'required|string|max:50',
            'maternal_last_name' => 'required|string|max:50',
            'address' => 'nullable|string|max:255',
            'sex_type' => 'required|boolean',
            'phone_number' => 'nullable|string|max:50',
            'attendance_date' => 'required|date',
        ]);

        // Si la validación falla, retorna los errores
        if ($validator->fails()) {
            return redirect()->route('am_people.create')
                ->withErrors($validator)
                ->withInput();
        }

        // Guardamos la nueva persona con los datos proporcionados
        $person = new AmPerson([
            'id' => $request->id, // El ID es proporcionado manualmente por el usuario
            'identity_document' => $request->identity_document,
            'given_name' => $request->given_name,
            'paternal_last_name' => $request->paternal_last_name,
            'maternal_last_name' => $request->maternal_last_name,
            'address' => $request->address,
            'sex_type' => $request->sex_type,
            'phone_number' => $request->phone_number,
            'attendance_date' => $request->attendance_date,
        ]);

        $person->save();

        return redirect()->route('am_people.index')->with('success', 'Persona creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AmPerson $amPerson)
    {
         // Mostrar los detalles de una persona
         return view('areas.AreaDeLaMujerViews.AmPersons.show', compact('amPerson'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AmPerson $amPerson)
    {
        // Mostrar formulario de edición
        return view('areas.AreaDeLaMujerViews.AmPersons.edit', compact('amPerson'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AmPerson $amPerson)
    {
        // Inicializar reglas de validación para los campos comunes
    $rules = [
        'identity_document' => ['required', 'string', 'in:DNI,Pasaporte,Carnet,Cedula'],
        'given_name' => 'required|string|max:50',
        'paternal_last_name' => 'required|string|max:50',
        'maternal_last_name' => 'required|string|max:50',
        'address' => 'nullable|string|max:255',
        'sex_type' => 'required|boolean',
        'phone_number' => 'nullable|string|max:50',
        'attendance_date' => 'required|date',
    ];

    // Validación dinámica del campo 'id' según el tipo de documento
    if ($request->identity_document == 'DNI') {
        $rules['id'] = 'required|string|size:8'; // Para DNI, debe tener exactamente 8 caracteres
    } elseif ($request->identity_document == 'Pasaporte') {
        $rules['id'] = 'required|string|max:20'; // Para Pasaporte, hasta 20 caracteres
    } elseif ($request->identity_document == 'Cedula') {
        $rules['id'] = 'required|string|max:20'; // Para Cedula, hasta 20 caracteres
    } else {
        $rules['id'] = 'required|string|max:50'; // Para otros documentos, hasta 50 caracteres
    }

    // Realizar la validación
    $validator = Validator::make($request->all(), $rules);

        // Si la validación falla, retorna los errores
        if ($validator->fails()) {
            return redirect()->route('am_people.edit', $amPerson->id)
                ->withErrors($validator)
                ->withInput();
        }
        // Actualizamos la persona con los datos proporcionados
        $amPerson->update([
            'id' => $request->id,  // Aquí se actualiza el ID manualmente
            'identity_document' => $request->identity_document,
            'given_name' => $request->given_name,
            'paternal_last_name' => $request->paternal_last_name,
            'maternal_last_name' => $request->maternal_last_name,
            'address' => $request->address,
            'sex_type' => $request->sex_type,
            'phone_number' => $request->phone_number,
            'attendance_date' => $request->attendance_date,
        ]);

        return redirect()->route('am_people.index')->with('success', 'Persona actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AmPerson $amPerson)
    {
        // Eliminar la persona
        $amPerson->delete();

        return redirect()->route('am_people.index')->with('success', 'Persona eliminada correctamente.');
    }
}
