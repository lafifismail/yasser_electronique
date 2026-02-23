<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    // ----------------------------------------------------------
    // GET /checkout
    // ----------------------------------------------------------
    public function showForm(): View
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            abort(redirect()->route('storefront.cart.index'));
        }

        $discountPercent = (int) session()->get('discount', 0);
        $subtotal = collect($cart)->sum(fn($item) => $item['price_cents'] * $item['quantity']);
        $discountAmount = (int) round(($subtotal * $discountPercent) / 100);
        $total = $subtotal - $discountAmount;

        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        return view('storefront.checkout', compact(
            'cart',
            'subtotal',
            'discountAmount',
            'discountPercent',
            'total',
            'categories'
        ));
    }

    // ----------------------------------------------------------
    // POST /checkout
    // ----------------------------------------------------------
    public function place(Request $request): RedirectResponse
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('storefront.cart.index')
                ->with('cart_error', 'Il tuo carrello è vuoto.');
        }

        $data = $request->validate([
            'guest_name' => 'required|string|max:120',
            'guest_email' => 'required|email|max:180',
            'guest_phone' => 'required|string|max:30',
            'shipping_street' => 'required|string|max:200',
            'shipping_city' => 'required|string|max:100',
            'shipping_postal_code' => 'required|string|max:10',
            'shipping_province' => 'required|string|max:2',
            'notes' => 'nullable|string|max:1000',
            'codice_fiscale' => 'nullable|string|max:20',
            'accept_terms' => 'required|accepted',
        ]);

        $discountPercent = (int) session()->get('discount', 0);
        $subtotal = collect($cart)->sum(fn($item) => $item['price_cents'] * $item['quantity']);
        $discountAmount = (int) round(($subtotal * $discountPercent) / 100);
        $total = $subtotal - $discountAmount;

        // Créer la commande
        $order = Order::create([
            'user_id' => null,
            'status' => 'pending',
            'customer_type' => 'b2c',
            'subtotal_cents' => $subtotal,
            'vat_cents' => 0,
            'shipping_cents' => 0,
            'discount_cents' => $discountAmount,
            'total_cents' => $total,
            'guest_name' => $data['guest_name'],
            'guest_email' => $data['guest_email'],
            'guest_phone' => $data['guest_phone'],
            'shipping_street' => $data['shipping_street'],
            'shipping_city' => $data['shipping_city'],
            'shipping_postal_code' => $data['shipping_postal_code'],
            'shipping_province' => strtoupper($data['shipping_province']),
            'notes' => $data['notes'] ?? null,
            'codice_fiscale' => isset($data['codice_fiscale']) ? strtoupper($data['codice_fiscale']) : null,
        ]);

        // Inserire gli articoli
        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'sku' => $product?->sku ?? 'N/A',
                'name' => $item['name'],
                'qty' => $item['quantity'],
                'unit_price_cents' => $item['price_cents'],
                'vat_rate' => 22.00,
                'line_total_cents' => $item['price_cents'] * $item['quantity'],
            ]);

            // Decrementa lo stock
            if ($product) {
                $product->decrement('stock_qty', $item['quantity']);
            }
        }

        // Svuota il carrello e il codice sconto
        session()->forget(['cart', 'discount']);

        return redirect()->route('storefront.checkout.confirmation', $order->id);
    }

    // ----------------------------------------------------------
    // GET /checkout/conferma/{order}
    // ----------------------------------------------------------
    public function confirmation(Order $order): View
    {
        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        return view('storefront.checkout-confirmation', compact('order', 'categories'));
    }
}
