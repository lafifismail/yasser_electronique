<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    // ----------------------------------------------------------
    // POST /carrello/aggiungi
    // ----------------------------------------------------------
    public function add(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'integer|min:1|max:99',
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = (int) $request->input('quantity', 1);

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price_cents' => $product->price_cents,
                'quantity' => $quantity,
                'image' => optional($product->images()->orderBy('sort_order')->first())->path,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('cart_success', "\"{$product->name}\" aggiunto al carrello!");
    }

    // ----------------------------------------------------------
    // GET /carrello
    // ----------------------------------------------------------
    public function index(): View
    {
        $cart = session()->get('cart', []);
        $discountPercent = (int) session()->get('discount', 0);

        $subtotal = collect($cart)->sum(fn($item) => $item['price_cents'] * $item['quantity']);
        $discountAmount = (int) round(($subtotal * $discountPercent) / 100);
        $total = $subtotal - $discountAmount;

        $categories = \App\Models\Category::where('is_active', true)
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        return view('storefront.cart', compact('cart', 'subtotal', 'discountAmount', 'total', 'discountPercent', 'categories'));
    }

    // ----------------------------------------------------------
    // PATCH /carrello/aggiorna
    // ----------------------------------------------------------
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        $id = $request->input('product_id');
        $quantity = (int) $request->input('quantity');

        if (session()->has("cart.{$id}")) {
            session()->put("cart.{$id}.quantity", $quantity);
        }

        return redirect()->route('storefront.cart.index')
            ->with('cart_success', 'Quantità aggiornata.');
    }

    // ----------------------------------------------------------
    // DELETE /carrello/rimuovi
    // ----------------------------------------------------------
    public function remove(Request $request): RedirectResponse
    {
        $id = $request->input('product_id');

        session()->forget("cart.{$id}");

        // Se il carrello è ora vuoto, rimuovi anche lo sconto
        if (empty(session()->get('cart', []))) {
            session()->forget('discount');
        }

        return redirect()->route('storefront.cart.index')
            ->with('cart_success', 'Articolo rimosso dal carrello.');
    }

    // ----------------------------------------------------------
    // POST /carrello/sconto
    // ----------------------------------------------------------
    public function applyDiscount(Request $request): RedirectResponse
    {
        $request->validate(['promo_code' => 'required|string|max:50']);

        $code = strtoupper(trim($request->input('promo_code')));

        // Codici validi (facilmente estendibile)
        $validCodes = [
            'WELCOME10' => 10,
        ];

        if (array_key_exists($code, $validCodes)) {
            session()->put('discount', $validCodes[$code]);
            return redirect()->route('storefront.cart.index')
                ->with('cart_success', "Codice sconto \"{$code}\" applicato! -{$validCodes[$code]}% di sconto.");
        }

        return redirect()->route('storefront.cart.index')
            ->withErrors(['promo_code' => "Codice sconto \"{$code}\" non valido o scaduto."]);
    }
}
