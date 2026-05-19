<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTAR PRODUCTOS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $tenant = Auth::user()->tenant;

        $products = Product::where('tenant_id', $tenant->id)
            ->with('category')
            ->latest()
            ->get();

        return view('admin.products.index', compact('products'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM CREAR PRODUCTO
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $tenant = Auth::user()->tenant;

        $categories = Category::where('tenant_id', $tenant->id)
            ->latest()
            ->get();

        return view('admin.products.create', compact('categories'));
    }

    /*
    |--------------------------------------------------------------------------
    | GUARDAR PRODUCTO
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $tenant = Auth::user()->tenant;

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Guardar imagen
        |--------------------------------------------------------------------------
        */

        $imagePath = null;

        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')
                ->store('products', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Crear producto
        |--------------------------------------------------------------------------
        */

        Product::create([
            'tenant_id' => $tenant->id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
            'is_available' => true,
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Producto creado correctamente');
    }

    /*
    |--------------------------------------------------------------------------
    | MOSTRAR PRODUCTO
    |--------------------------------------------------------------------------
    */

    public function show(Product $product)
    {
        $this->authorizeProduct($product);

        return view('admin.products.show', compact('product'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM EDITAR
    |--------------------------------------------------------------------------
    */

    public function edit(Product $product)
    {
        $this->authorizeProduct($product);

        $tenant = Auth::user()->tenant;

        $categories = Category::where('tenant_id', $tenant->id)
            ->latest()
            ->get();

        return view('admin.products.edit', compact(
            'product',
            'categories'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR PRODUCTO
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, Product $product)
    {
        $this->authorizeProduct($product);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Actualizar imagen
        |--------------------------------------------------------------------------
        */

        $imagePath = $product->image;

        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')
                ->store('products', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Actualizar producto
        |--------------------------------------------------------------------------
        */

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
            'is_available' => $request->has('is_available'),
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Producto actualizado correctamente');
    }

    /*
    |--------------------------------------------------------------------------
    | ELIMINAR PRODUCTO
    |--------------------------------------------------------------------------
    */

    public function destroy(Product $product)
    {
        $this->authorizeProduct($product);

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Producto eliminado correctamente');
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDAR PROPIEDAD DEL PRODUCTO
    |--------------------------------------------------------------------------
    */

    private function authorizeProduct(Product $product)
    {
        $tenant = Auth::user()->tenant;

        if ($product->tenant_id !== $tenant->id) {
            abort(403);
        }
    }
}