<?php

namespace App\Http\Controllers\CiamControllers;

use App\Http\Controllers\Controller;
use App\Models\CiamModels\ElderlyAdult;
use App\Models\CiamModels\Guardian;
use App\Models\CiamModels\SocialProgram;
use App\Models\CiamModels\PrivateInsurance;
use App\Models\CiamModels\Location;
use App\Models\CiamModels\PublicInsurance;
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
     * Muestra una lista de todos los adultos mayores con sus relaciones necesarias.
     */
    public function index(IndexElderlyAdultRequest $request): View
    {
        $elderlyAdults = ElderlyAdult::with(['guardians', 'socialPrograms', 'privateInsurances', 'publicInsurance', 'location'])->get();
        return view('areas.CiamViews.ElderlyAdults.index', compact('elderlyAdults'));
    }

    /**
     * Muestra el formulario para crear un nuevo adulto mayor con las opciones de relaciones.
     */
    public function create(CreateElderlyAdultRequest $request): View
    {
        $locations = Location::all();
        $publicInsurances = PublicInsurance::all();
        $guardians = Guardian::all();
        $socialPrograms = SocialProgram::all();
        $privateInsurances = PrivateInsurance::all();

        return view('areas.CiamViews.ElderlyAdults.create', compact('locations', 'publicInsurances', 'guardians', 'socialPrograms', 'privateInsurances'));
    }

    /**
     * Almacena un nuevo adulto mayor en la base de datos y sus relaciones.
     */
    public function store(StoreElderlyAdultRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            // Crear el adulto mayor
            $elderlyAdult = ElderlyAdult::create($request->validated());

            // Relacionar las entidades (si existen en la solicitud)
            $elderlyAdult->guardians()->sync($request->input('guardian_ids', []));
            $elderlyAdult->socialPrograms()->sync($request->input('social_program_ids', []));
            $elderlyAdult->privateInsurances()->sync($request->input('private_insurance_ids', []));

            DB::commit();
            return redirect()->route('elderly_adults.index')->with('success', 'Adulto mayor creado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ocurrió un error al crear el adulto mayor.');
        }
    }

    /**
     * Muestra los detalles de un adulto mayor con sus relaciones.
     */
    public function show(ShowElderlyAdultRequest $request, ElderlyAdult $elderlyAdult): View
    {
        $elderlyAdult->load(['guardians', 'socialPrograms', 'privateInsurances', 'publicInsurance', 'location']);
        return view('areas.CiamViews.ElderlyAdults.show', compact('elderlyAdult'));
    }

    /**
     * Muestra el formulario para editar un adulto mayor con datos pre-cargados.
     */
    public function edit(EditElderlyAdultRequest $request, ElderlyAdult $elderlyAdult): View
    {
        $locations = Location::all();
        $publicInsurances = PublicInsurance::all();
        $guardians = Guardian::all();
        $socialPrograms = SocialProgram::all();
        $privateInsurances = PrivateInsurance::all();

        return view('areas.CiamViews.ElderlyAdults.edit', compact('elderlyAdult', 'locations', 'publicInsurances', 'guardians', 'socialPrograms', 'privateInsurances'));
    }

    /**
     * Actualiza los datos de un adulto mayor y sus relaciones.
     */
    public function update(UpdateElderlyAdultRequest $request, ElderlyAdult $elderlyAdult): RedirectResponse
    {
        try {
            DB::beginTransaction();

            // Actualizar los datos del adulto mayor
            $elderlyAdult->update($request->validated());

            // Actualizar relaciones
            $elderlyAdult->guardians()->sync($request->input('guardian_ids', []));
            $elderlyAdult->socialPrograms()->sync($request->input('social_program_ids', []));
            $elderlyAdult->privateInsurances()->sync($request->input('private_insurance_ids', []));

            DB::commit();
            return redirect()->route('elderly_adults.index')->with('success', 'Adulto mayor actualizado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar el adulto mayor.');
        }
    }

    /**
     * Elimina un adulto mayor de la base de datos y limpia sus relaciones.
     */
    public function destroy(DestroyElderlyAdultRequest $request, ElderlyAdult $elderlyAdult): RedirectResponse
    {
        try {
            DB::beginTransaction();

            // Eliminar relaciones antes de eliminar el adulto mayor
            $elderlyAdult->guardians()->detach();
            $elderlyAdult->socialPrograms()->detach();
            $elderlyAdult->privateInsurances()->detach();

            // Eliminar el registro del adulto mayor
            $elderlyAdult->delete();

            DB::commit();
            return redirect()->route('elderly_adults.index')->with('success', 'Adulto mayor eliminado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ocurrió un error al eliminar el adulto mayor.');
        }
    }
}
