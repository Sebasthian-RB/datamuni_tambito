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
        $existingIds = ElderlyAdult::pluck('id')->toArray(); // Obtener todos los IDs existentes
        return view('areas.CiamViews.ElderlyAdults.create', compact('guardians', 'existingIds'));
    }

    /**
     * Almacena un nuevo adulto mayor en la base de datos.
     */
    public function store(StoreElderlyAdultRequest $request): RedirectResponse
    {

        // dd($request->all()); // 🔴 Esto mostrará TODOS los datos enviados en la vista antes de guardar en la BD

        try {
            DB::beginTransaction();

            // Obtén los datos validados
            $data = $request->validated();

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
        $existingIds = ElderlyAdult::where('id', '!=', $elderlyAdult->id)->pluck('id')->toArray(); // Excluir el ID actual

        return view('areas.CiamViews.ElderlyAdults.edit', compact('elderlyAdult', 'guardians', 'existingIds'));
    }

    /**
     * Actualiza los datos de un adulto mayor.
     */
    public function update(UpdateElderlyAdultRequest $request, ElderlyAdult $elderlyAdult): RedirectResponse
    {
        try {
            DB::beginTransaction();

            // Obtén los datos validados
            $data = $request->validated();

            // Actualizar los datos en la BD
            $elderlyAdult->update($data);

            DB::commit();
            return redirect()->route('elderly_adults.index')->with('success', 'Adulto mayor actualizado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar el adulto mayor: ' . $e->getMessage());
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

            // Verificar si el adulto mayor tiene un guardián asignado
            if ($elderlyAdult->guardian_id !== null) {
                // Desasignar al guardián
                $elderlyAdult->guardian_id = null;
                $elderlyAdult->save();

                // Mostrar un mensaje de advertencia
                session()->flash('warning', 'El guardián ha sido desasignado de este adulto mayor.');
            }

            // Eliminar al adulto mayor
            $elderlyAdult->delete();

            DB::commit();

            // Redirigir con un mensaje de éxito
            return redirect()->route('elderly_adults.index')->with([
                'success' => 'Adulto mayor eliminado correctamente.',
                'success_type' => 'delete', // Identificador para el tipo de éxito
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            // Redirigir con un mensaje de error
            return redirect()->back()->with('error', 'No se pudo eliminar el adulto mayor.');
        }
    }
}
