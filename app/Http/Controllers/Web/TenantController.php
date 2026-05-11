<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Tenant;

class TenantController extends Controller
{
    public function show($slug)
    {
        /*
        |--------------------------------------------------------------------------
        | Buscar negocio por slug
        |--------------------------------------------------------------------------
        */

        $tenant = Tenant::where('slug', $slug)
            ->with([
                'categories',
                'products'
            ])
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Obtener categorías
        |--------------------------------------------------------------------------
        */

        $categories = $tenant->categories;

        /*
        |--------------------------------------------------------------------------
        | Obtener productos disponibles
        |--------------------------------------------------------------------------
        */

        $products = $tenant->products()
            ->where('is_available', true)
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Retornar vista
        |--------------------------------------------------------------------------
        */

        return view('tenant.show', compact(
            'tenant',
            'categories',
            'products'
        ));
    }
}