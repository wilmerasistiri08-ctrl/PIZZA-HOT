<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::count();
        $revenue = Order::sum('total');

        return view('admin.dashboard', compact('orders', 'revenue'));
    }
}