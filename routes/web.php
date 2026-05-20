<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CONTROLADORES WEB
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\TenantController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\RegisterController;

/*
|--------------------------------------------------------------------------
| CONTROLADORES ADMIN
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;

/*
|--------------------------------------------------------------------------
| CONTROLADORES AUTH / PERFIL
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| LANDING PAGE
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

/*
|--------------------------------------------------------------------------
| PARTNERS
|--------------------------------------------------------------------------
*/

Route::get('/partners', [HomeController::class, 'partners'])
    ->name('partners');

/*
|--------------------------------------------------------------------------
| REGISTRO DE NEGOCIOS
|--------------------------------------------------------------------------
| IMPORTANTE:
| NO usar /register porque Breeze ya usa esa ruta.
| Por eso usamos /register-business
|--------------------------------------------------------------------------
*/

Route::get('/register-business', [HomeController::class, 'register'])
    ->name('register.business.form');

Route::post('/register-business', [RegisterController::class, 'store'])
    ->name('register.business');

/*
|--------------------------------------------------------------------------
| CHECKOUT
|--------------------------------------------------------------------------
*/

Route::get('/checkout', [CartController::class, 'checkoutPage'])
    ->name('checkout.page');

Route::post('/checkout', [CartController::class, 'checkout'])
    ->name('checkout');

/*
|--------------------------------------------------------------------------
| PERFIL USUARIO
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| PANEL ADMIN
|--------------------------------------------------------------------------
| SOLO USUARIOS AUTENTICADOS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->prefix('admin')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        /*
        |--------------------------------------------------------------------------
        | PRODUCTOS
        |--------------------------------------------------------------------------
        */

        Route::resource('/products', ProductController::class);

        /*
        |--------------------------------------------------------------------------
        | PEDIDOS
        |--------------------------------------------------------------------------
        */

        Route::get('/orders', [OrderController::class, 'index'])
            ->name('admin.orders');
    });

/*
|--------------------------------------------------------------------------
| RUTAS AUTH (LARAVEL BREEZE)
|--------------------------------------------------------------------------
| LOGIN
| LOGOUT
| REGISTER
| PASSWORD RESET
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| MULTI TENANT STORE
|--------------------------------------------------------------------------
| ⚠️ SIEMPRE AL FINAL
|--------------------------------------------------------------------------
| IMPORTANTE:
| /{slug} captura cualquier ruta dinámica.
| Debe ir DESPUÉS de auth.php
|--------------------------------------------------------------------------
*/

Route::middleware('tenant')->group(function () {

    Route::get('/{slug}', [TenantController::class, 'show'])
        ->name('tenant.show');
});
