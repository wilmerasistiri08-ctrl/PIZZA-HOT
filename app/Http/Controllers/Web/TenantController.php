<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\View\View;

class TenantController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | MOSTRAR TIENDA PÚBLICA DEL NEGOCIO
    |--------------------------------------------------------------------------
    | Ruta:
    | /{slug}
    |
    | Ejemplos:
    | /pizza-imperial
    | /mundo-tecnologia
    |--------------------------------------------------------------------------
    */

    public function show(string $slug): View
    {
        /*
        |--------------------------------------------------------------------------
        | BUSCAR NEGOCIO POR SLUG
        |--------------------------------------------------------------------------
        | Cargamos el negocio y validamos que exista.
        |--------------------------------------------------------------------------
        */

        $tenant = Tenant::query()
            ->where('slug', $slug)
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | OBTENER CATEGORÍAS ACTIVAS DEL NEGOCIO
        |--------------------------------------------------------------------------
        | Cada negocio solo debe mostrar sus propias categorías.
        |--------------------------------------------------------------------------
        */

        $categories = $tenant->categories()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | OBTENER PRODUCTOS DISPONIBLES DEL NEGOCIO
        |--------------------------------------------------------------------------
        | Cada negocio solo debe mostrar sus propios productos.
        |--------------------------------------------------------------------------
        */

        $products = $tenant->products()
            ->with('category')
            ->where('is_available', true)
            ->orderByDesc('featured')
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | PRODUCTOS DESTACADOS
        |--------------------------------------------------------------------------
        | Esto sirve para mostrar una sección premium en la tienda.
        |--------------------------------------------------------------------------
        */

        $featuredProducts = $tenant->products()
            ->with('category')
            ->where('is_available', true)
            ->where('featured', true)
            ->latest()
            ->take(6)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | RETORNAR VISTA
        |--------------------------------------------------------------------------
        */

        return view('tenant.show', [
            'tenant' => $tenant,
            'categories' => $categories,
            'products' => $products,
            'featuredProducts' => $featuredProducts,
        ]);
    }
}