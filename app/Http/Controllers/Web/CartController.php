<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Mostrar página checkout
     */
    public function checkoutPage()
    {
        return view('tenant.checkout');
    }

    /**
     * Procesar checkout
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'address' => 'required',
        ]);

        return back()->with('success', 'Pedido enviado correctamente');
    }
}