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
| LANDING / EMBUDO DE VENTAS
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/partners', [HomeController::class, 'partners'])->name('partners');

Route::get('/register', [HomeController::class, 'register'])->name('register');


/*
|--------------------------------------------------------------------------
| CHECKOUT (ENVÍA A WHATSAPP)
|--------------------------------------------------------------------------
*/

Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');


/*
|--------------------------------------------------------------------------
| PANEL ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // CRUD productos
    Route::resource('/products', ProductController::class);

    // Pedidos
    Route::get('/orders', [OrderController::class, 'index'])
        ->name('admin.orders');
});


/*
|--------------------------------------------------------------------------
| TIENDA (MULTI-TENANT)
|--------------------------------------------------------------------------
| ⚠️ SIEMPRE AL FINAL
|--------------------------------------------------------------------------
*/

Route::middleware('tenant')->group(function () {

    Route::get('/{slug}', [TenantController::class, 'show'])
        ->name('tenant.show');

});