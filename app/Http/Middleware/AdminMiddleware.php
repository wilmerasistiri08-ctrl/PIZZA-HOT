<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /*
    |--------------------------------------------------------------------------
    | SUPER ADMIN MIDDLEWARE
    |--------------------------------------------------------------------------
    | Protege las rutas exclusivas del Super Administrador.
    |
    | Solo permite ingresar a usuarios autenticados con:
    |
    | role = super_admin
    |
    | Rutas protegidas:
    | /super-admin/*
    |--------------------------------------------------------------------------
    */

    public function handle(Request $request, Closure $next): Response
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDAR SESIÓN
        |--------------------------------------------------------------------------
        */

        if (!$request->user()) {
            return redirect()->route('login');
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDAR ROL SUPER ADMIN
        |--------------------------------------------------------------------------
        */

        if ($request->user()->role !== 'super_admin') {
            abort(403, 'Acceso no autorizado. Solo el super administrador puede ingresar.');
        }

        return $next($request);
    }
}