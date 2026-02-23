@extends('storefront.layouts.storefront')

@section('title', 'Carrello — Yasser Elettronica')

@section('content')

    {{-- ===================================================
    HEADER
    =================================================== --}}
    <div class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-10">
            <nav class="text-sm text-gray-400 mb-3">
                <a href="{{ route('storefront.home') }}" class="hover:text-white transition">Home</a>
                <span class="mx-2">/</span>
                <span class="text-white font-medium">Carrello</span>
            </nav>
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">
                🛒 Il tuo Carrello
            </h1>
        </div>
    </div>

    {{-- ===================================================
    CORPO PRINCIPALE
    =================================================== --}}
    <section class="bg-gray-50 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- ===================== PANIER VIDE ===================== --}}
            @if(empty($cart))
                <div class="text-center py-24 bg-white rounded-2xl border border-gray-200 shadow-sm">
                    <svg class="w-20 h-20 mx-auto mb-6 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6h11M10 21a1 1 0 100-2 1 1 0 000 2zm7 0a1 1 0 100-2 1 1 0 000 2z" />
                    </svg>
                    <p class="text-xl font-bold text-gray-400 mb-2">Il tuo carrello è vuoto.</p>
                    <p class="text-sm text-gray-400 mb-8">Esplora i nostri prodotti e trova quello che fa per te.</p>
                    <a href="{{ route('storefront.home') }}"
                        class="inline-block bg-[#3B2ECA] hover:bg-[#2A1FA8] text-white font-bold px-8 py-3 rounded-xl transition text-sm">
                        ← Continua lo shopping
                    </a>
                </div>

                {{-- ===================== PANIER AVEC ARTICLES ===================== --}}
            @else
                {{-- Flash message (succès ou erreur) --}}
                @if(session('cart_success'))
                    <div
                        class="bg-green-50 border border-green-200 text-green-800 text-sm font-medium px-4 py-3 rounded-xl mb-6 flex items-center gap-2">
                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ session('cart_success') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                    {{-- =========================================
                    COLONNA SINISTRA — ARTICOLI
                    ========================================= --}}
                    <div class="lg:col-span-2 space-y-4">
                        @foreach($cart as $item)
                            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 flex gap-5">

                                {{-- Immagine --}}
                                <div
                                    class="w-24 h-24 flex-shrink-0 bg-gray-50 rounded-xl overflow-hidden border border-gray-100 flex items-center justify-center p-2">
                                    @if($item['image'])
                                        <img src="{{ Str::startsWith($item['image'], 'http') ? $item['image'] : asset('storage/' . $item['image']) }}"
                                            alt="{{ $item['name'] }}" class="w-full h-full object-contain">
                                    @else
                                        <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    @endif
                                </div>

                                {{-- Info + Azioni --}}
                                <div class="flex-1 min-w-0">
                                    <a href="{{ route('storefront.product', $item['slug']) }}"
                                        class="font-bold text-gray-900 hover:text-[#3B2ECA] transition text-sm leading-snug line-clamp-2 block mb-1">
                                        {{ $item['name'] }}
                                    </a>
                                    <p class="text-xl font-black text-[#3B2ECA] mb-3">
                                        {{ number_format($item['price_cents'] / 100, 2, ',', '.') }} €
                                    </p>

                                    <div class="flex flex-wrap items-center gap-3">
                                        {{-- Aggiorna quantità --}}
                                        <form action="{{ route('storefront.cart.update') }}" method="POST"
                                            class="flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                            <label for="qty-{{ $item['product_id'] }}"
                                                class="text-xs text-gray-500 font-medium">Qtà:</label>
                                            <select id="qty-{{ $item['product_id'] }}" name="quantity"
                                                class="border border-gray-300 text-sm rounded-lg px-2 py-1.5 focus:ring-2 focus:ring-[#3B2ECA] focus:border-[#3B2ECA] focus:outline-none">
                                                @for($i = 1; $i <= 10; $i++)
                                                    <option value="{{ $i }}" {{ $item['quantity'] == $i ? 'selected' : '' }}>{{ $i }}
                                                    </option>
                                                @endfor
                                            </select>
                                            <button type="submit"
                                                class="text-xs font-bold text-[#3B2ECA] hover:text-[#2A1FA8] border border-[#3B2ECA] px-3 py-1.5 rounded-lg transition hover:bg-[#3B2ECA] hover:text-white">
                                                Aggiorna
                                            </button>
                                        </form>

                                        {{-- Rimuovi --}}
                                        <form action="{{ route('storefront.cart.remove') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                            <button type="submit"
                                                class="text-xs font-semibold text-red-500 hover:text-red-700 transition flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Rimuovi
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                {{-- Subtotale articolo --}}
                                <div class="hidden sm:flex items-center flex-shrink-0 text-right">
                                    <p class="text-base font-black text-gray-900">
                                        {{ number_format(($item['price_cents'] * $item['quantity']) / 100, 2, ',', '.') }} €
                                    </p>
                                </div>
                            </div>
                        @endforeach

                        {{-- Link continua shopping --}}
                        <div class="pt-2">
                            <a href="{{ route('storefront.home') }}"
                                class="text-sm text-[#3B2ECA] hover:underline font-medium flex items-center gap-1">
                                ← Continua lo shopping
                            </a>
                        </div>
                    </div>

                    {{-- =========================================
                    COLONNA DESTRA — RIEPILOGO ORDINE (sticky)
                    ========================================= --}}
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 sticky top-24">
                            <h2
                                class="text-base font-extrabold text-gray-900 uppercase tracking-widest mb-5 pb-4 border-b border-gray-100">
                                Riepilogo Ordine
                            </h2>

                            {{-- Codice Sconto --}}
                            <div class="mb-5">
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Codice Sconto</p>

                                {{-- Promo code errors --}}
                                @if($errors->has('promo_code'))
                                    <div
                                        class="bg-red-50 border border-red-200 text-red-700 text-xs font-medium px-3 py-2 rounded-lg mb-2 flex items-center gap-2">
                                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $errors->first('promo_code') }}
                                    </div>
                                @endif

                                @if($discountPercent > 0)
                                    <div
                                        class="bg-green-50 border border-green-200 text-green-700 text-xs font-bold px-3 py-2 rounded-lg mb-2 flex items-center gap-2">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Sconto -{{ $discountPercent }}% applicato!
                                    </div>
                                @else
                                    <form action="{{ route('storefront.cart.discount') }}" method="POST" class="flex gap-2">
                                        @csrf
                                        <input type="text" name="promo_code" placeholder="WELCOME10"
                                            class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#3B2ECA] focus:border-[#3B2ECA] focus:outline-none placeholder-gray-300 uppercase"
                                            style="text-transform:uppercase">
                                        <button type="submit"
                                            class="bg-gray-900 hover:bg-[#3B2ECA] text-white font-bold px-4 py-2 rounded-lg text-xs transition flex-shrink-0">
                                            Applica
                                        </button>
                                    </form>
                                @endif
                            </div>

                            <div class="border-t border-gray-100 pt-4 space-y-3">
                                {{-- Subtotale --}}
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Subtotale</span>
                                    <span class="font-semibold text-gray-900">
                                        {{ number_format($subtotal / 100, 2, ',', '.') }} €
                                    </span>
                                </div>

                                {{-- Sconto --}}
                                @if($discountPercent > 0)
                                    <div class="flex justify-between text-sm text-green-600 font-semibold">
                                        <span>Sconto -{{ $discountPercent }}%</span>
                                        <span>- {{ number_format($discountAmount / 100, 2, ',', '.') }} €</span>
                                    </div>
                                @endif

                                {{-- Spedizione --}}
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Spedizione</span>
                                    <span class="text-green-600 font-semibold">Gratuita</span>
                                </div>
                            </div>

                            {{-- Totale --}}
                            <div class="border-t border-gray-200 mt-4 pt-4 flex justify-between items-baseline">
                                <span class="text-base font-bold text-gray-700 uppercase tracking-wide">Totale</span>
                                <span class="text-2xl font-black text-[#EAB308]">
                                    {{ number_format($total / 100, 2, ',', '.') }} €
                                </span>
                            </div>

                            {{-- CTA Checkout --}}
                            <a href="{{ route('storefront.checkout') }}"
                                class="w-full block text-center bg-[#EAB308] hover:bg-yellow-600 text-white font-extrabold py-4 rounded-xl mt-6 transition text-base shadow-lg shadow-yellow-100">
                                Procedi al Checkout →
                            </a>
                            <p class="text-center text-xs text-gray-400 mt-3">
                                🔒 Pagamento sicuro · Reso entro 14 giorni
                            </p>
                        </div>
                    </div>

                </div>
            @endif

        </div>
    </section>

@endsection