<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

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
| CONTROLADORES ADMIN / OWNER
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
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
| No usamos /register porque Laravel Breeze ya usa esa ruta.
|--------------------------------------------------------------------------
*/

Route::get('/register-business', [HomeController::class, 'register'])
    ->name('register.business.form');

Route::post('/register-business', [RegisterController::class, 'store'])
    ->name('register.business');

/*
|--------------------------------------------------------------------------
| CHECKOUT PÚBLICO
|--------------------------------------------------------------------------
*/

Route::get('/checkout', [CartController::class, 'checkoutPage'])
    ->name('checkout.page');

Route::post('/checkout', [CartController::class, 'checkout'])
    ->name('checkout');

/*
|--------------------------------------------------------------------------
| DASHBOARD PUENTE
|--------------------------------------------------------------------------
| Laravel Breeze redirige después del login a route('dashboard').
| Esta ruta decide si el usuario va al Super Admin o al panel del negocio.
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function (Request $request) {

    $user = $request->user();

    if (!$user) {
        return redirect()->route('login');
    }

    /*
    |--------------------------------------------------------------------------
    | SUPER ADMIN
    |--------------------------------------------------------------------------
    */

    if ($user->role === 'super_admin') {
        return redirect()->route('super.admin.dashboard');
    }

    /*
    |--------------------------------------------------------------------------
    | USUARIOS DEL NEGOCIO
    |--------------------------------------------------------------------------
    */

    $tenantRoles = [
        'owner',
        'admin',
        'employee',
    ];

    if (in_array($user->role, $tenantRoles, true)) {

        if (empty($user->tenant_id)) {

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->withErrors([
                    'email' => 'Tu usuario no tiene un negocio asignado. Contacta al administrador.',
                ]);
        }

        return redirect()->route('admin.dashboard');
    }

    /*
    |--------------------------------------------------------------------------
    | ROL NO AUTORIZADO
    |--------------------------------------------------------------------------
    */

    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()
        ->route('login')
        ->withErrors([
            'email' => 'Tu usuario no tiene permisos para acceder al sistema.',
        ]);

})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| PERFIL DE USUARIO
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
| PANEL DEL NEGOCIO / OWNER
|--------------------------------------------------------------------------
| Middleware:
| auth  = usuario autenticado.
| owner = usuario con role permitido y tenant_id asignado.
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'owner'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | REDIRECCIÓN BASE
        |--------------------------------------------------------------------------
        */

        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        })->name('home');

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD DEL NEGOCIO
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | CATEGORÍAS
        |--------------------------------------------------------------------------
        */

        Route::resource('categories', CategoryController::class)
            ->except(['show'])
            ->names('categories');

        /*
        |--------------------------------------------------------------------------
        | ATAJO PARA CREAR CATEGORÍA DESDE CREACIÓN DE PRODUCTO
        |--------------------------------------------------------------------------
        | Esta ruta sirve para que desde:
        | /admin/products/create
        |
        | puedas mandar al usuario a:
        | /admin/categories/create
        |
        | y luego volver a crear producto.
        |--------------------------------------------------------------------------
        */

        Route::get('/products/create/category', function () {
            return redirect()->route('admin.categories.create', [
                'redirect_to' => route('admin.products.create'),
            ]);
        })->name('products.create.category');

        /*
        |--------------------------------------------------------------------------
        | PRODUCTOS
        |--------------------------------------------------------------------------
        */

        Route::resource('products', ProductController::class)
            ->names('products');

        /*
        |--------------------------------------------------------------------------
        | PEDIDOS
        |--------------------------------------------------------------------------
        */

        Route::get('/orders', [OrderController::class, 'index'])
            ->name('orders');
    });

/*
|--------------------------------------------------------------------------
| SUPER ADMIN
|--------------------------------------------------------------------------
| Middleware:
| auth  = usuario autenticado.
| admin = solo role super_admin.
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('super-admin')
    ->name('super.admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | REDIRECCIÓN BASE SUPER ADMIN
        |--------------------------------------------------------------------------
        */

        Route::get('/', function () {
            return redirect()->route('super.admin.dashboard');
        })->name('home');

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD SUPER ADMIN
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', function () {

            if (View::exists('super-admin.dashboard')) {
                return view('super-admin.dashboard');
            }

            return response('SUPER ADMIN DASHBOARD');

        })->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | NEGOCIOS
        |--------------------------------------------------------------------------
        */

        Route::get('/businesses', function () {

            if (View::exists('super-admin.businesses.index')) {
                return view('super-admin.businesses.index');
            }

            return response('SUPER ADMIN - NEGOCIOS');

        })->name('businesses');

        /*
        |--------------------------------------------------------------------------
        | USUARIOS
        |--------------------------------------------------------------------------
        */

        Route::get('/users', function () {

            if (View::exists('super-admin.users.index')) {
                return view('super-admin.users.index');
            }

            return response('SUPER ADMIN - USUARIOS');

        })->name('users');

        /*
        |--------------------------------------------------------------------------
        | REPORTES
        |--------------------------------------------------------------------------
        */

        Route::get('/reports', function () {

            if (View::exists('super-admin.reports.index')) {
                return view('super-admin.reports.index');
            }

            return response('SUPER ADMIN - REPORTES');

        })->name('reports');
    });

/*
|--------------------------------------------------------------------------
| AUTH ROUTES - LARAVEL BREEZE
|--------------------------------------------------------------------------
| Login, logout, register, forgot password, reset password.
| Debe ir antes del slug dinámico /{slug}.
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| TIENDA PÚBLICA MULTI-TENANT
|--------------------------------------------------------------------------
| IMPORTANTE:
| Esta ruta debe ir SIEMPRE AL FINAL porque /{slug}
| puede capturar cualquier URL.
|--------------------------------------------------------------------------
*/

Route::middleware('tenant')->group(function () {

    Route::get('/{slug}', [TenantController::class, 'show'])
        ->name('tenant.show');
});