<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tenant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Throwable;

class CartController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | MOSTRAR PÁGINA CHECKOUT
    |--------------------------------------------------------------------------
    */

    public function checkoutPage(Request $request): View
    {
        $tenant = null;

        /*
        |--------------------------------------------------------------------------
        | LEER TENANT DESDE QUERY STRING
        |--------------------------------------------------------------------------
        | Ejemplo:
        | /checkout?tenant=pizza-hot
        |--------------------------------------------------------------------------
        */

        if ($request->filled('tenant')) {
            $tenant = Tenant::query()
                ->where('slug', $request->query('tenant'))
                ->first();

            if ($tenant) {
                $request->session()->put('checkout_tenant_slug', $tenant->slug);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | LEER TENANT DESDE SESIÓN
        |--------------------------------------------------------------------------
        */

        if (!$tenant && $request->session()->has('checkout_tenant_slug')) {
            $tenant = Tenant::query()
                ->where('slug', $request->session()->get('checkout_tenant_slug'))
                ->first();
        }

        return view('tenant.checkout', [
            'tenant' => $tenant,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | PROCESAR CHECKOUT
    |--------------------------------------------------------------------------
    */

    public function checkout(Request $request): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDAR DATOS
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'tenant_slug' => [
                'required',
                'string',
                'exists:tenants,slug',
            ],

            'customer_name' => [
                'required',
                'string',
                'max:255',
            ],

            'customer_phone' => [
                'required',
                'string',
                'max:30',
            ],

            'customer_email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'address' => [
                'required',
                'string',
                'max:1000',
            ],

            'google_maps_link' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'notes' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'payment_method' => [
                'required',
                'string',
                'in:cash,qr,card,transfer',
            ],

            'cart_items' => [
                'required',
                'string',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | BUSCAR NEGOCIO
        |--------------------------------------------------------------------------
        */

        $tenant = Tenant::query()
            ->where('slug', $validated['tenant_slug'])
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | DECODIFICAR CARRITO
        |--------------------------------------------------------------------------
        */

        $cartItems = json_decode($validated['cart_items'], true);

        if (!is_array($cartItems) || count($cartItems) === 0) {
            return back()
                ->withInput()
                ->withErrors([
                    'cart_items' => 'El carrito está vacío.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | NORMALIZAR PRODUCTOS
        |--------------------------------------------------------------------------
        */

        $normalizedItems = $this->normalizeCartItems($cartItems);

        if (count($normalizedItems) === 0) {
            return back()
                ->withInput()
                ->withErrors([
                    'cart_items' => 'No se encontraron productos válidos en el carrito.',
                ]);
        }

        try {
            /*
            |--------------------------------------------------------------------------
            | CREAR PEDIDO
            |--------------------------------------------------------------------------
            */

            $result = DB::transaction(function () use ($tenant, $validated, $normalizedItems) {
                return $this->createOrderWithItems(
                    tenant: $tenant,
                    validated: $validated,
                    normalizedItems: $normalizedItems
                );
            });
        } catch (Throwable $exception) {
            report($exception);

            return back()
                ->withInput()
                ->withErrors([
                    'checkout' => 'No se pudo procesar el pedido. Verifica los productos e intenta nuevamente.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | GENERAR WHATSAPP
        |--------------------------------------------------------------------------
        */

        $message = $this->buildWhatsAppMessage(
            tenant: $tenant,
            order: $result['order'],
            items: $result['items']
        );

        $whatsappUrl = $this->buildWhatsAppUrl(
            phone: $tenant->whatsapp_number,
            message: $message
        );

        return redirect()->away($whatsappUrl);
    }

    /*
    |--------------------------------------------------------------------------
    | NORMALIZAR CARRITO
    |--------------------------------------------------------------------------
    */

    private function normalizeCartItems(array $cartItems): array
    {
        $items = [];

        foreach ($cartItems as $item) {
            if (!isset($item['id'])) {
                continue;
            }

            $productId = (int) $item['id'];

            if ($productId <= 0) {
                continue;
            }

            $quantity = isset($item['quantity'])
                ? (int) $item['quantity']
                : 1;

            $quantity = max(1, $quantity);

            if (isset($items[$productId])) {
                $items[$productId]['quantity'] += $quantity;
            } else {
                $items[$productId] = [
                    'product_id' => $productId,
                    'quantity' => $quantity,
                ];
            }
        }

        return array_values($items);
    }

    /*
    |--------------------------------------------------------------------------
    | CREAR ORDER Y ORDER_ITEMS
    |--------------------------------------------------------------------------
    */

    private function createOrderWithItems(Tenant $tenant, array $validated, array $normalizedItems): array
    {
        $subtotal = 0;

        $itemsForOrder = [];

        /*
        |--------------------------------------------------------------------------
        | VALIDAR PRODUCTOS DESDE BASE DE DATOS
        |--------------------------------------------------------------------------
        */

        foreach ($normalizedItems as $item) {
            $product = Product::query()
                ->where('tenant_id', $tenant->id)
                ->where('id', $item['product_id'])
                ->where('is_available', true)
                ->first();

            if (!$product) {
                continue;
            }

            $quantity = (int) $item['quantity'];

            $price = $this->resolveProductPrice($product);

            $lineSubtotal = $price * $quantity;

            $subtotal += $lineSubtotal;

            $itemsForOrder[] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'quantity' => $quantity,
                'price' => $price,
                'subtotal' => $lineSubtotal,
            ];
        }

        if (count($itemsForOrder) === 0) {
            throw new \RuntimeException('No hay productos disponibles para procesar el pedido.');
        }

        $deliveryFee = 0;

        $total = $subtotal + $deliveryFee;

        /*
        |--------------------------------------------------------------------------
        | INSERTAR ORDER
        |--------------------------------------------------------------------------
        */

        $orderId = DB::table('orders')->insertGetId([
            'tenant_id' => $tenant->id,
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'customer_email' => $validated['customer_email'] ?? null,
            'address' => $validated['address'],
            'google_maps_link' => $validated['google_maps_link'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'subtotal' => $subtotal,
            'delivery_fee' => $deliveryFee,
            'total' => $total,
            'payment_method' => $validated['payment_method'],
            'payment_status' => 'pending',
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | INSERTAR ORDER ITEMS
        |--------------------------------------------------------------------------
        */

        foreach ($itemsForOrder as $item) {
            DB::table('order_items')->insert([
                'order_id' => $orderId,
                'product_id' => $item['product_id'],
                'product_name' => $item['product_name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['subtotal'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $order = DB::table('orders')
            ->where('id', $orderId)
            ->first();

        return [
            'order' => $order,
            'items' => $itemsForOrder,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RESOLVER PRECIO DEL PRODUCTO
    |--------------------------------------------------------------------------
    */

    private function resolveProductPrice(Product $product): float
    {
        /*
        |--------------------------------------------------------------------------
        | Si tu modelo Product tiene accessor final_price, lo usa.
        | Si no existe, usa price directamente.
        |--------------------------------------------------------------------------
        */

        if (isset($product->final_price) && is_numeric($product->final_price)) {
            return (float) $product->final_price;
        }

        return (float) $product->price;
    }

    /*
    |--------------------------------------------------------------------------
    | CONSTRUIR MENSAJE WHATSAPP
    |--------------------------------------------------------------------------
    */

    private function buildWhatsAppMessage(Tenant $tenant, object $order, array $items): string
    {
        $text = "🛒 NUEVO PEDIDO - {$tenant->name}\n\n";

        $text .= "👤 Cliente: {$order->customer_name}\n";
        $text .= "📞 Teléfono: {$order->customer_phone}\n\n";

        $text .= "📍 Dirección:\n{$order->address}\n\n";

        if (!empty($order->google_maps_link)) {
            $text .= "🗺 Google Maps:\n{$order->google_maps_link}\n\n";
        }

        if (!empty($order->notes)) {
            $text .= "📝 Notas:\n{$order->notes}\n\n";
        }

        $text .= "🧾 Pedido:\n";

        foreach ($items as $item) {
            $lineSubtotal = number_format((float) $item['subtotal'], 2);

            $text .= "- {$item['product_name']} x{$item['quantity']} = Bs {$lineSubtotal}\n";
        }

        $text .= "\n";

        $text .= "💰 Subtotal: Bs " . number_format((float) $order->subtotal, 2) . "\n";
        $text .= "🛵 Delivery: Bs " . number_format((float) $order->delivery_fee, 2) . "\n";
        $text .= "✅ Total: Bs " . number_format((float) $order->total, 2) . "\n\n";

        $text .= "💳 Método de pago: " . $this->paymentMethodLabel($order->payment_method) . "\n";
        $text .= "📌 Estado: Pendiente\n\n";

        $text .= "Pedido generado desde FoodLink.";

        return $text;
    }

    /*
    |--------------------------------------------------------------------------
    | URL WHATSAPP
    |--------------------------------------------------------------------------
    */

    private function buildWhatsAppUrl(string $phone, string $message): string
    {
        $cleanPhone = preg_replace('/\D+/', '', $phone);

        /*
        |--------------------------------------------------------------------------
        | Bolivia: si tiene 8 dígitos, agregar 591
        |--------------------------------------------------------------------------
        */

        if (strlen($cleanPhone) === 8) {
            $cleanPhone = '591' . $cleanPhone;
        }

        return 'https://wa.me/' . $cleanPhone . '?text=' . urlencode($message);
    }

    /*
    |--------------------------------------------------------------------------
    | LABEL MÉTODO DE PAGO
    |--------------------------------------------------------------------------
    */

    private function paymentMethodLabel(string $paymentMethod): string
    {
        return match ($paymentMethod) {
            'cash' => 'Efectivo',
            'qr' => 'QR',
            'card' => 'Tarjeta',
            'transfer' => 'Transferencia',
            default => 'No especificado',
        };
    }
}