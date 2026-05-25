<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))

    /*
    |--------------------------------------------------------------------------
    | ROUTING
    |--------------------------------------------------------------------------
    */

    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )

    /*
    |--------------------------------------------------------------------------
    | MIDDLEWARE ALIASES
    |--------------------------------------------------------------------------
    | Laravel 12 ya no usa app/Http/Kernel.php.
    | Los alias de middleware se registran aquí.
    |--------------------------------------------------------------------------
    */

    ->withMiddleware(function (Middleware $middleware): void {

        $middleware->alias([

            /*
            |--------------------------------------------------------------------------
            | TIENDA PÚBLICA MULTITENANT
            |--------------------------------------------------------------------------
            | Se usa para rutas públicas como:
            |
            | /pizza-imperial
            | /mundo-tecnologia
            | /moda-urbana
            |
            | Su función es resolver el negocio mediante el slug.
            |--------------------------------------------------------------------------
            */

            'tenant' => \App\Http\Middleware\TenantMiddleware::class,

            /*
            |--------------------------------------------------------------------------
            | SUPER ADMIN
            |--------------------------------------------------------------------------
            | Se usa para:
            |
            | /super-admin/*
            |
            | Solo debe permitir usuarios con:
            | role = super_admin
            |--------------------------------------------------------------------------
            */

            'super_admin' => \App\Http\Middleware\AdminMiddleware::class,

            /*
            |--------------------------------------------------------------------------
            | ALIAS TEMPORAL DE COMPATIBILIDAD
            |--------------------------------------------------------------------------
            | Mantengo este alias para evitar errores si en web.php todavía tienes:
            |
            | middleware(['auth', 'admin'])
            |
            | Pero lo recomendable será usar:
            |
            | middleware(['auth', 'super_admin'])
            |--------------------------------------------------------------------------
            */

            'admin' => \App\Http\Middleware\AdminMiddleware::class,

            /*
            |--------------------------------------------------------------------------
            | PANEL DEL NEGOCIO / OWNER
            |--------------------------------------------------------------------------
            | Se usa para:
            |
            | /admin/*
            |
            | Debe permitir:
            | owner
            | admin
            | employee
            |
            | Además debe verificar que el usuario tenga tenant_id.
            |--------------------------------------------------------------------------
            */

            'owner' => \App\Http\Middleware\OwnerMiddleware::class,

            /*
            |--------------------------------------------------------------------------
            | ALIAS SEMÁNTICO OPCIONAL
            |--------------------------------------------------------------------------
            | Este alias es más claro para el futuro:
            |
            | tenant_user = usuario que pertenece a un negocio.
            |--------------------------------------------------------------------------
            */

            'tenant_user' => \App\Http\Middleware\OwnerMiddleware::class,
        ]);
    })

    /*
    |--------------------------------------------------------------------------
    | EXCEPTIONS
    |--------------------------------------------------------------------------
    */

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })

    ->create();