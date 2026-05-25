<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SUPER ADMIN DASHBOARD
    |--------------------------------------------------------------------------
    | Panel principal del administrador global del sistema.
    |--------------------------------------------------------------------------
    */

    public function index(): View
    {
        $stats = [
            'tenants' => Tenant::count(),
            'users' => User::count(),
            'products' => Product::count(),
            'orders' => Order::count(),
        ];

        $latestTenants = Tenant::latest()
            ->take(5)
            ->get();

        $latestUsers = User::latest()
            ->take(5)
            ->get();

        return view('super-admin.dashboard', compact(
            'stats',
            'latestTenants',
            'latestUsers'
        ));
    }
}