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

use App\Models\VasoDeLecheModels\Committee;
use App\Models\VasoDeLecheModels\Product;
use App\Models\VasoDeLecheModels\VlFamilyMember;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class VlFamilyMemberProductController extends Controller
{
    use AuthorizesRequests;

    /**
     * Muestra una lista de productos asignados a los miembros familiares.
     *
     * @param IndexVlFamilyMemberProductRequest $request
     * @return \Illuminate\View\View
     */
    public function index(IndexVlFamilyMemberProductRequest $request, $committee_id)
    {
        // Verificación de permiso
        $this->authorize('ver BD');

        $committee = Committee::findOrFail($committee_id);

        // Obtiene los familiares que pertenecen al comité y tienen status = 1
        $vlFamilyMembers = VlFamilyMember::whereHas('committees', function ($query) use ($committee_id) {
            $query->where('committee_id', $committee_id)
                ->where('committee_vl_family_members.status', 1);
        })->with('products') // Carga los productos aunque no tengan
        ->get();

        // Obtener las asignaciones de productos a los familiares del comité
        $vlFamilyMemberProducts = VlFamilyMemberProduct::whereHas('vlFamilyMember.committees', function ($query) use ($committee_id) {
            $query->where('committee_id', $committee_id)
                ->where('committee_vl_family_members.status', 1);
        })->get();

        return view('areas.VasoDeLecheViews.VlFamilyMemberProducts.index', compact('committee', 'vlFamilyMembers', 'vlFamilyMemberProducts'));
    }

    /**
     * Muestra el formulario para asignar un producto a un miembro familiar.
     *
     * @param CreateVlFamilyMemberProductRequest $request
     * @return \Illuminate\View\View
     */
    public function create(CreateVlFamilyMemberProductRequest $request, $committee_id)
    {
        // Verificación de permiso
        $this->authorize('crear');
        
        // Obtener solo miembros familiares activos del comité específico
        $vlFamilyMembers = VlFamilyMember::whereHas('committees', function($query) use ($committee_id) {
            $query->where('committee_id', $committee_id)
                  ->where('committee_vl_family_members.status', 1); 
        })->get();

        $products = Product::all(); // Asegúrate de importar el modelo
        
        return view('areas.VasoDeLecheViews.VlFamilyMemberProducts.create', [
            'vlFamilyMembers' => $vlFamilyMembers,
            'products' => $products,
            'committee_id' => $committee_id
        ]);
    }

    /**
     * Asigna un nuevo producto a un miembro familiar en la base de datos.
     *
     * @param StoreVlFamilyMemberProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreVlFamilyMemberProductRequest $request)
    {
        // Verificación de permiso
        $this->authorize('crear');
        
        // Los datos ya incluyen committee_id gracias al campo oculto
        $validatedData = $request->validated();
        
        // Crear el registro
        VlFamilyMemberProduct::create($validatedData);

        // Obtener committee_id directamente del request (sin validar)
        $committee_id = $request->input('committee_id');
        
        // Redireccionar
        return redirect()->route('vl_family_member_products.index', [
            'committee_id' => $committee_id ])->with('success', 'Producto asignado correctamente');
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
        // Verificación de permiso
        $this->authorize('ver detalles');
        
        return view('areas.VasoDeLecheViews.VlFamilyMemberProducts.show', compact('vlFamilyMemberProduct'));
    }

    /**
     * Muestra el formulario para editar un producto asignado a un miembro familiar.
     *
     * @param EditVlFamilyMemberProductRequest $request
     * @param VlFamilyMemberProduct $vlFamilyMemberProduct
     * @return \Illuminate\View\View
     */
    public function edit(EditVlFamilyMemberProductRequest $request, VlFamilyMemberProduct $vlFamilyMemberProduct, $committee_id)
    {
        // Verificación de permiso
        $this->authorize('editar');
        
        // Obtener solo miembros familiares activos del comité específico
        $vlFamilyMembers = VlFamilyMember::whereHas('committees', function($query) use ($committee_id) {
            $query->where('committee_id', $committee_id)
                ->where('committee_vl_family_members.status', 1); 
        })->get();

        $products = Product::all();
        
        return view('areas.VasoDeLecheViews.VlFamilyMemberProducts.edit', [
            'familyMemberProduct' => $vlFamilyMemberProduct, // Cambiado a familyMemberProduct
            'vlFamilyMembers' => $vlFamilyMembers,
            'products' => $products,
            'committee_id' => $committee_id
        ]);
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
        // Verificación de permiso
        $this->authorize('editar');
        
        // Los datos ya incluyen committee_id gracias al campo oculto
        $validatedData = $request->validated();
        
        // Actualizar el registro
        $vlFamilyMemberProduct->update($validatedData);

        // Obtener committee_id directamente del request (sin validar)
        $committee_id = $request->input('committee_id');
        
        // Redireccionar
        return redirect()->route('vl_family_member_products.index', [
            'committee_id' => $committee_id ])->with('success', 'Producto asignado al miembro familiar actualizado correctamente.');
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
        // Verificación de permiso
        $this->authorize('eliminar');
        
        // Obtener committee_id directamente del request (sin validar)
        $committee_id = $request->input('committee_id');

        $vlFamilyMemberProduct->delete();
        return redirect()->route('vl_family_member_products.index', [
            'committee_id' => $committee_id ])->with('success', 'Producto asignado al miembro familiar eliminado correctamente.');
    }
}
