<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class TenantMiddleware
{
    /*
    |--------------------------------------------------------------------------
    | TENANT MIDDLEWARE
    |--------------------------------------------------------------------------
    | Este middleware se usa para las tiendas públicas:
    |
    | /pizza-imperial
    | /mundo-tecnologia
    | /moda-urbana
    |
    | Su trabajo es identificar el negocio por slug y dejarlo disponible
    | para controladores, vistas y servicios.
    |--------------------------------------------------------------------------
    */

    public function handle(Request $request, Closure $next): Response
    {
        /*
        |--------------------------------------------------------------------------
        | OBTENER SLUG DESDE LA RUTA
        |--------------------------------------------------------------------------
        */

        $slug = $request->route('slug');

        /*
        |--------------------------------------------------------------------------
        | SI NO HAY SLUG, CONTINUAR
        |--------------------------------------------------------------------------
        */

        if (!$slug) {
            return $next($request);
        }

        /*
        |--------------------------------------------------------------------------
        | BUSCAR NEGOCIO
        |--------------------------------------------------------------------------
        */

        $tenant = Tenant::query()
            ->where('slug', $slug)
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | GUARDAR TENANT EN EL CONTENEDOR DE LARAVEL
        |--------------------------------------------------------------------------
        | Esto permite usar:
        |
        | app('currentTenant')
        |--------------------------------------------------------------------------
        */

        app()->instance('currentTenant', $tenant);

        /*
        |--------------------------------------------------------------------------
        | COMPARTIR TENANT CON TODAS LAS VISTAS
        |--------------------------------------------------------------------------
        | Esto permite usar en Blade:
        |
        | $currentTenant
        |--------------------------------------------------------------------------
        */

        View::share('currentTenant', $tenant);

        /*
        |--------------------------------------------------------------------------
        | CONTINUAR REQUEST
        |--------------------------------------------------------------------------
        */

        return $next($request);
    }
}