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
| LANDING PAGE / EMBUDO DE VENTAS
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
| GET  -> formulario
| POST -> guardar negocio
|--------------------------------------------------------------------------
*/

Route::get('/register', [HomeController::class, 'register'])
    ->name('register');

Route::post('/register-business', [RegisterController::class, 'store'])
    ->name('register.business');

/*
|--------------------------------------------------------------------------
| CHECKOUT
|--------------------------------------------------------------------------
| GET  -> mostrar formulario checkout
| POST -> procesar pedido
|--------------------------------------------------------------------------
*/

Route::get('/checkout', [CartController::class, 'checkoutPage'])
    ->name('checkout.page');

Route::post('/checkout', [CartController::class, 'checkout'])
    ->name('checkout');

/*
|--------------------------------------------------------------------------
| PANEL ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {

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
| MULTI-TENANT STORE
|--------------------------------------------------------------------------
| ⚠️ SIEMPRE AL FINAL
|--------------------------------------------------------------------------
| IMPORTANTE:
| /{slug} puede capturar TODAS las rutas dinámicas.
| Por eso SIEMPRE debe ir al final.
|--------------------------------------------------------------------------
*/

Route::middleware('tenant')->group(function () {

    Route::get('/{slug}', [TenantController::class, 'show'])
        ->name('tenant.show');

});