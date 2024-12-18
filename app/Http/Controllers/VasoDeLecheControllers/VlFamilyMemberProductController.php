<?php

namespace App\Http\Controllers\VasoDeLecheControllers;

use App\Http\Controllers\Controller;
use App\Models\VasoDeLecheModels\VlFamilyMemberProduct;
use App\Http\Requests\VasoDeLecheRequests\VlFamilyMemberProducts\IndexVlFamilyMemberProductRequest;
use App\Http\Requests\VasoDeLecheRequests\VlFamilyMemberProducts\ShowVlFamilyMemberProductRequest;
use App\Http\Requests\VasoDeLecheRequests\VlFamilyMemberProducts\CreateVlFamilyMemberProductRequest;
use App\Http\Requests\VasoDeLecheRequests\VlFamilyMemberProducts\StoreVlFamilyMemberProductRequest;
use App\Http\Requests\VasoDeLecheRequests\VlFamilyMemberProducts\EditVlFamilyMemberProductRequest;
use App\Http\Requests\VasoDeLecheRequests\VlFamilyMemberProducts\UpdateVlFamilyMemberProductRequest;
use App\Http\Requests\VasoDeLecheRequests\VlFamilyMemberProducts\DestroyVlFamilyMemberProductRequest;

class VlFamilyMemberProductController extends Controller
{
    /**
     * Muestra una lista de productos asignados a los miembros familiares.
     *
     * @param IndexVlFamilyMemberProductRequest $request
     * @return \Illuminate\View\View
     */
    public function index(IndexVlFamilyMemberProductRequest $request)
    {
        $vlFamilyMemberProducts = VlFamilyMemberProduct::all();
        return view('areas.VasoDeLecheViews.VlFamilyMemberProducts.index', compact('vlFamilyMemberProducts'));
    }

    /**
     * Muestra el formulario para asignar un producto a un miembro familiar.
     *
     * @param CreateVlFamilyMemberProductRequest $request
     * @return \Illuminate\View\View
     */
    public function create(CreateVlFamilyMemberProductRequest $request)
    {
        return view('areas.VasoDeLecheViews.VlFamilyMemberProducts.create');
    }

    /**
     * Asigna un nuevo producto a un miembro familiar en la base de datos.
     *
     * @param StoreVlFamilyMemberProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreVlFamilyMemberProductRequest $request)
    {
        VlFamilyMemberProduct::create($request->validated());
        return redirect()->route('vl-family-member-products.index')->with('success', 'Producto asignado al miembro familiar creado correctamente.');
    }

    /**
     * Muestra los detalles de un producto específico asignado a un miembro familiar.
     *
     * @param ShowVlFamilyMemberProductRequest $request
     * @param VlFamilyMemberProduct $vlFamilyMemberProduct
     * @return \Illuminate\View\View
     */
    public function show(ShowVlFamilyMemberProductRequest $request, VlFamilyMemberProduct $vlFamilyMemberProduct)
    {
        return view('areas.VasoDeLecheViews.VlFamilyMemberProducts.show', compact('vlFamilyMemberProduct'));
    }

    /**
     * Muestra el formulario para editar un producto asignado a un miembro familiar.
     *
     * @param EditVlFamilyMemberProductRequest $request
     * @param VlFamilyMemberProduct $vlFamilyMemberProduct
     * @return \Illuminate\View\View
     */
    public function edit(EditVlFamilyMemberProductRequest $request, VlFamilyMemberProduct $vlFamilyMemberProduct)
    {
        return view('areas.VasoDeLecheViews.VlFamilyMemberProducts.edit', compact('vlFamilyMemberProduct'));
    }

    /**
     * Actualiza los datos de un producto asignado a un miembro familiar en la base de datos.
     *
     * @param UpdateVlFamilyMemberProductRequest $request
     * @param VlFamilyMemberProduct $vlFamilyMemberProduct
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateVlFamilyMemberProductRequest $request, VlFamilyMemberProduct $vlFamilyMemberProduct)
    {
        $vlFamilyMemberProduct->update($request->validated());
        return redirect()->route('vl-family-member-products.index')->with('success', 'Producto asignado al miembro familiar actualizado correctamente.');
    }

    /**
     * Elimina un producto asignado a un miembro familiar de la base de datos.
     *
     * @param DestroyVlFamilyMemberProductRequest $request
     * @param VlFamilyMemberProduct $vlFamilyMemberProduct
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DestroyVlFamilyMemberProductRequest $request, VlFamilyMemberProduct $vlFamilyMemberProduct)
    {
        $vlFamilyMemberProduct->delete();
        return redirect()->route('vl-family-member-products.index')->with('success', 'Producto asignado al miembro familiar eliminado correctamente.');
    }
}
