<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class OwnerMiddleware
{
    /*
    |--------------------------------------------------------------------------
    | OWNER / TENANT PANEL MIDDLEWARE
    |--------------------------------------------------------------------------
    | Protege el panel administrativo del negocio:
    |
    | /admin/*
    |
    | Permite ingresar únicamente a usuarios autenticados que pertenezcan
    | a un negocio y tengan uno de estos roles:
    |
    | - owner
    | - admin
    | - employee
    |
    | No permite:
    |
    | - super_admin
    | - usuarios sin tenant_id
    | - usuarios con tenant_id inválido
    |--------------------------------------------------------------------------
    */

    public function handle(Request $request, Closure $next): Response
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDAR USUARIO AUTENTICADO
        |--------------------------------------------------------------------------
        */

        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDAR ROL DEL PANEL DEL NEGOCIO
        |--------------------------------------------------------------------------
        */

        $allowedRoles = [
            'owner',
            'admin',
            'employee',
        ];

        if (!in_array($user->role, $allowedRoles, true)) {
            abort(403, 'Acceso no autorizado. Solo usuarios del negocio pueden ingresar.');
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDAR QUE EL USUARIO TENGA NEGOCIO ASIGNADO
        |--------------------------------------------------------------------------
        */

        if (empty($user->tenant_id)) {
            abort(403, 'Este usuario no tiene un negocio asignado.');
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDAR QUE EL NEGOCIO EXISTA
        |--------------------------------------------------------------------------
        | Esto requiere que el modelo User tenga la relación:
        |
        | public function tenant()
        | {
        |     return $this->belongsTo(Tenant::class);
        | }
        |--------------------------------------------------------------------------
        */

        $tenant = $user->tenant;

        if (!$tenant) {
            abort(403, 'El negocio asignado a este usuario no existe.');
        }

        /*
        |--------------------------------------------------------------------------
        | COMPARTIR TENANT ACTUAL EN LA REQUEST
        |--------------------------------------------------------------------------
        | Esto permite usarlo luego en controladores:
        |
        | $request->attributes->get('tenant_id')
        | $request->attributes->get('tenant')
        |--------------------------------------------------------------------------
        */

        $request->attributes->set('tenant_id', $tenant->id);
        $request->attributes->set('tenant', $tenant);

        /*
        |--------------------------------------------------------------------------
        | COMPARTIR TENANT GLOBALMENTE EN LAS VISTAS
        |--------------------------------------------------------------------------
        | Esto permite usar $currentTenant en:
        |
        | layouts/admin.blade.php
        | admin/dashboard.blade.php
        | admin/products/index.blade.php
        | admin/orders/index.blade.php
        |--------------------------------------------------------------------------
        */

        View::share('currentTenant', $tenant);

        return $next($request);
    }
}