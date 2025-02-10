<?php

namespace App\Http\Controllers\CiamControllers;

use App\Http\Controllers\Controller;
use App\Models\CiamModels\ElderlyAdult;
use App\Models\CiamModels\Guardian;
use App\Http\Requests\CiamRequests\ElderlyAdults\IndexElderlyAdultRequest;
use App\Http\Requests\CiamRequests\ElderlyAdults\CreateElderlyAdultRequest;
use App\Http\Requests\CiamRequests\ElderlyAdults\StoreElderlyAdultRequest;
use App\Http\Requests\CiamRequests\ElderlyAdults\ShowElderlyAdultRequest;
use App\Http\Requests\CiamRequests\ElderlyAdults\EditElderlyAdultRequest;
use App\Http\Requests\CiamRequests\ElderlyAdults\UpdateElderlyAdultRequest;
use App\Http\Requests\CiamRequests\ElderlyAdults\DestroyElderlyAdultRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class ElderlyAdultController extends Controller
{
    /**
     * Muestra una lista de todos los adultos mayores con su guardián asociado.
     */
    public function index(IndexElderlyAdultRequest $request): View
    {
        $elderlyAdults = ElderlyAdult::with('guardian')->get();
        return view('areas.CiamViews.ElderlyAdults.index', compact('elderlyAdults'));
    }

    /**
     * Muestra el formulario para crear un nuevo adulto mayor.
     */
    public function create(CreateElderlyAdultRequest $request): View
    {
        $guardians = Guardian::all();
        return view('areas.CiamViews.ElderlyAdults.create', compact('guardians'));
    }

    /**
     * Almacena un nuevo adulto mayor en la base de datos.
     */
    public function store(StoreElderlyAdultRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $elderlyAdult = ElderlyAdult::create($request->validated());

            DB::commit();
            return redirect()->route('elderly_adults.index')->with('success', 'Adulto mayor creado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ocurrió un error al crear el adulto mayor.');
        }
    }

    /**
     * Muestra los detalles de un adulto mayor.
     */
    public function show(ShowElderlyAdultRequest $request, ElderlyAdult $elderlyAdult): View
    {
        return view('areas.CiamViews.ElderlyAdults.show', compact('elderlyAdult'));
    }

    /**
     * Muestra el formulario para editar un adulto mayor.
     */
    public function edit(EditElderlyAdultRequest $request, ElderlyAdult $elderlyAdult): View
    {
        $guardians = Guardian::all();
        return view('areas.CiamViews.ElderlyAdults.edit', compact('elderlyAdult', 'guardians'));
    }

    /**
     * Actualiza los datos de un adulto mayor.
     */
    public function update(UpdateElderlyAdultRequest $request, ElderlyAdult $elderlyAdult): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $elderlyAdult->update($request->validated());

            DB::commit();
            return redirect()->route('elderly_adults.index')->with('success', 'Adulto mayor actualizado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar el adulto mayor.');
        }
    }

    /**
     * Elimina un adulto mayor de la base de datos.
     */
    public function destroy(DestroyElderlyAdultRequest $request, ElderlyAdult $elderlyAdult): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $elderlyAdult->delete();
            DB::commit();
            return redirect()->route('elderly_adults.index')->with('success', 'Adulto mayor eliminado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ocurrió un error al eliminar el adulto mayor.');
        }
    }
}
