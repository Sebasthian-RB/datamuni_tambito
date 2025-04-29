<?php

namespace App\Http\Controllers\VasoDeLecheControllers;

use App\Http\Controllers\Controller;
use App\Models\VasoDeLecheModels\Product;
use App\Http\Requests\VasoDeLecheRequests\Products\IndexProductRequest;
use App\Http\Requests\VasoDeLecheRequests\Products\ShowProductRequest;
use App\Http\Requests\VasoDeLecheRequests\Products\CreateProductRequest;
use App\Http\Requests\VasoDeLecheRequests\Products\StoreProductRequest;
use App\Http\Requests\VasoDeLecheRequests\Products\EditProductRequest;
use App\Http\Requests\VasoDeLecheRequests\Products\UpdateProductRequest;
use App\Http\Requests\VasoDeLecheRequests\Products\DestroyProductRequest;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests;

    /**
     * Muestra una lista de todos los productos.
     *
     * @param IndexProductRequest $request
     * @return \Illuminate\View\View
     */
    public function index(IndexProductRequest $request)
    {
        // Verificación de permiso
        $this->authorize('ver BD');

        $products = Product::paginate(10);
        return view('areas.VasoDeLecheViews.Products.index', compact('products'));
    }

    /**
     * Muestra el formulario para crear un nuevo producto.
     *
     * @param CreateProductRequest $request
     * @return \Illuminate\View\View
     */
    public function create(CreateProductRequest $request)
    {
        // Verificación de permiso
        $this->authorize('crear');
        
        return view('areas.VasoDeLecheViews.Products.create');
    }

    /**
     * Almacena un producto recién creado en la base de datos.
     *
     * @param StoreProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreProductRequest $request)
    {
        // Verificación de permiso
        $this->authorize('crear');
        
        Product::create($request->validated());
        return redirect()->route('products.index')->with('success', 'Producto creado correctamente.');
    }

    /**
     * Muestra los detalles de un producto específico.
     *
     * @param ShowProductRequest $request
     * @param Product $product
     * @return \Illuminate\View\View
     */
    public function show(ShowProductRequest $request, Product $product)
    {
        // Verificación de permiso
        $this->authorize('ver detalles');
        
        return view('areas.VasoDeLecheViews.Products.show', compact('product'));
    }

    /**
     * Muestra el formulario para editar un producto existente.
     *
     * @param EditProductRequest $request
     * @param Product $product
     * @return \Illuminate\View\View
     */
    public function edit(EditProductRequest $request, Product $product)
    {
        // Verificación de permiso
        $this->authorize('editar');
        
        return view('areas.VasoDeLecheViews.Products.edit', compact('product'));
    }

    /**
     * Actualiza un producto existente en la base de datos.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        // Verificación de permiso
        $this->authorize('editar');
        
        // Validar los datos de la solicitud
        $data = $request->validated();
    
        // Verificar si los datos realmente han cambiado
        $isDirty = false;
        foreach ($data as $key => $value) {
            if ($product->$key !== $value) {
                $isDirty = true;
                break;
            }
        }
    
        // Si no hay cambios, redirigir con el mensaje de "No se realizaron cambios"
        if (!$isDirty) {
            return redirect()->route('products.index')->with('info', 'No se realizaron cambios.');
        }
    
        // Actualizar el producto solo si los datos han cambiado
        $product->update($data);
    
        // Redirigir con el mensaje de éxito
        return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente.');
    }    

    /**
     * Elimina un producto de la base de datos.
     *
     * @param DestroyProductRequest $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DestroyProductRequest $request, Product $product)
    {
        // Verificación de permiso
        $this->authorize('eliminar');
        
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado correctamente.');
    }
}
