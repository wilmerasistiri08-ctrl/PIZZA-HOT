<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function checkout(Request $request)
    {
        $tenant = app('tenant');

        $text = "🧾 *Pedido*\n\n";

        foreach ($request->cart as $item) {
            $text .= "- {$item['name']} x{$item['qty']}\n";
        }

        $text .= "\n👤 {$request->name}";
        $text .= "\n📍 {$request->address}";
        $text .= "\n🗺️ {$request->maps}";

        $url = "https://wa.me/591{$tenant->whatsapp_number}?text=" . urlencode($text);

        return redirect($url);
    }
}