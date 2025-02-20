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
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;



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

        // dd($request->all()); // 🔴 Esto mostrará TODOS los datos enviados en la vista antes de guardar en la BD

        try {
            DB::beginTransaction();

            // Verifica si existe social_program y conviértelo en un string separado por comas
            $data = $request->all();
            $data['social_program'] = isset($data['social_program']) ? implode(', ', $data['social_program']) : null;

            // Guarda los datos en la BD
            ElderlyAdult::create($data);

            DB::commit();
            return redirect()->route('elderly_adults.index')->with('success', 'Adulto mayor creado correctamente.');
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error('Error al guardar el adulto mayor: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Hubo un problema al guardar los datos.']);
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

        $data = $request->all();
        $data['social_program'] = isset($request->social_program) ? implode(', ', $request->social_program) : null;
        $elderlyAdult->update($data);

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
