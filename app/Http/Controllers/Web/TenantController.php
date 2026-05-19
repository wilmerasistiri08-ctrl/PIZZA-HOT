<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Tenant;

class TenantController extends Controller
{
    /**
     * Mostrar tienda del negocio
     */
    public function show(string $slug)
    {
        /*
        |--------------------------------------------------------------------------
        | Buscar tenant por slug
        |--------------------------------------------------------------------------
        */

        $tenant = Tenant::where('slug', $slug)
            ->with([
                'categories',
                'products' => function ($query) {
                    $query->where('is_available', true)
                        ->latest();
                }
            ])
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Categorías del negocio
        |--------------------------------------------------------------------------
        */

        $categories = $tenant->categories;

        /*
        |--------------------------------------------------------------------------
        | Productos disponibles
        |--------------------------------------------------------------------------
        */

        $products = $tenant->products;

        /*
        |--------------------------------------------------------------------------
        | Retornar vista
        |--------------------------------------------------------------------------
        */

        return view('tenant.show', [
            'tenant' => $tenant,
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}