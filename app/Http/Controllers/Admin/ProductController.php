<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTAR PRODUCTOS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $products = Product::latest()->get();

        return view('admin.products.index', compact('products'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM CREAR PRODUCTO
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    /*
    |--------------------------------------------------------------------------
    | GUARDAR PRODUCTO
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'tenant_id' => 'required',
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        Product::create([
            'tenant_id' => $request->tenant_id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request->image,
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
        return view('admin.products.show', compact('product'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM EDITAR
    |--------------------------------------------------------------------------
    */

    public function edit(Product $product)
    {
        $categories = Category::all();

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
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request->image,
            'is_available' => $request->has('is_available'),
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Producto actualizado');
    }

    /*
    |--------------------------------------------------------------------------
    | ELIMINAR PRODUCTO
    |--------------------------------------------------------------------------
    */

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Producto eliminado');
    }
}