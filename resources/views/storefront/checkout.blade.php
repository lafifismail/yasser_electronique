@extends('storefront.layouts.storefront')

@section('title', 'Checkout — Yasser Elettronica')

@section('content')

    {{-- ===================================================
    HEADER
    =================================================== --}}
    <div class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-10">
            <nav class="text-sm text-gray-400 mb-3">
                <a href="{{ route('storefront.home') }}" class="hover:text-white transition">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('storefront.cart.index') }}" class="hover:text-white transition">Carrello</a>
                <span class="mx-2">/</span>
                <span class="text-white font-medium">Checkout</span>
            </nav>
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">📦 Completa l'ordine</h1>
            <p class="text-gray-400 mt-2 text-sm">Nessun account richiesto — acquisto come ospite</p>
        </div>
    </div>

    {{-- ===================================================
    CORPO
    =================================================== --}}
    <section class="bg-gray-50 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Errori validazione globali --}}
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 text-sm px-5 py-4 rounded-xl mb-6">
                    <p class="font-bold mb-2">Correggi i seguenti errori:</p>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('storefront.checkout.place') }}" method="POST" novalidate>
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                    {{-- =========================================
                    COLONNA SINISTRA — FORM DATI
                    ========================================= --}}
                    <div class="lg:col-span-2 space-y-6">

                        {{-- Dati personali --}}
                        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                            <h2
                                class="text-base font-extrabold text-gray-900 uppercase tracking-widest mb-5 pb-4 border-b border-gray-100 flex items-center gap-2">
                                <span class="text-[#3B2ECA]">①</span> Dati personali
                            </h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="guest_name"
                                        class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-1.5">
                                        Nome e Cognome <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="guest_name" name="guest_name" value="{{ old('guest_name') }}"
                                        class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#3B2ECA] focus:border-[#3B2ECA] focus:outline-none @error('guest_name') border-red-400 bg-red-50 @enderror"
                                        placeholder="Mario Rossi">
                                    @error('guest_name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="guest_email"
                                        class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-1.5">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" id="guest_email" name="guest_email" value="{{ old('guest_email') }}"
                                        class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#3B2ECA] focus:border-[#3B2ECA] focus:outline-none @error('guest_email') border-red-400 bg-red-50 @enderror"
                                        placeholder="mario@email.com">
                                    @error('guest_email')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="guest_phone"
                                        class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-1.5">
                                        Telefono <span class="text-red-500">*</span>
                                    </label>
                                    <input type="tel" id="guest_phone" name="guest_phone" value="{{ old('guest_phone') }}"
                                        class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#3B2ECA] focus:border-[#3B2ECA] focus:outline-none @error('guest_phone') border-red-400 bg-red-50 @enderror"
                                        placeholder="+39 333 123 4567">
                                    @error('guest_phone')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Codice Fiscale / P.IVA (opzionale) --}}
                                <div class="sm:col-span-2">
                                    <label for="codice_fiscale"
                                        class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-1.5">
                                        Codice Fiscale o Partita IVA
                                        <span class="text-gray-400 font-normal normal-case tracking-normal">(opzionale — per
                                            ricevere fattura)</span>
                                    </label>
                                    <input type="text" id="codice_fiscale" name="codice_fiscale"
                                        value="{{ old('codice_fiscale') }}"
                                        class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#3B2ECA] focus:border-[#3B2ECA] focus:outline-none uppercase"
                                        placeholder="RSSMRA80A01H501U oppure 12345678901" style="text-transform:uppercase">
                                    <p class="text-gray-400 text-xs mt-1">📄 Se inserito, riceverai fattura elettronica
                                        all'email indicata.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Indirizzo di spedizione --}}
                        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                            <h2
                                class="text-base font-extrabold text-gray-900 uppercase tracking-widest mb-5 pb-4 border-b border-gray-100 flex items-center gap-2">
                                <span class="text-[#3B2ECA]">②</span> Indirizzo di Spedizione
                            </h2>
                            <div class="space-y-4">
                                <div>
                                    <label for="shipping_street"
                                        class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-1.5">
                                        Via e Numero Civico <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="shipping_street" name="shipping_street"
                                        value="{{ old('shipping_street') }}"
                                        class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#3B2ECA] focus:border-[#3B2ECA] focus:outline-none @error('shipping_street') border-red-400 bg-red-50 @enderror"
                                        placeholder="Via Roma, 42">
                                    @error('shipping_street')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <div class="sm:col-span-1">
                                        <label for="shipping_postal_code"
                                            class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-1.5">
                                            CAP <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="shipping_postal_code" name="shipping_postal_code"
                                            value="{{ old('shipping_postal_code') }}" maxlength="5"
                                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#3B2ECA] focus:border-[#3B2ECA] focus:outline-none @error('shipping_postal_code') border-red-400 bg-red-50 @enderror"
                                            placeholder="20124">
                                        @error('shipping_postal_code')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="sm:col-span-1">
                                        <label for="shipping_city"
                                            class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-1.5">
                                            Città <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="shipping_city" name="shipping_city"
                                            value="{{ old('shipping_city') }}"
                                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#3B2ECA] focus:border-[#3B2ECA] focus:outline-none @error('shipping_city') border-red-400 bg-red-50 @enderror"
                                            placeholder="Milano">
                                        @error('shipping_city')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="sm:col-span-1">
                                        <label for="shipping_province"
                                            class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-1.5">
                                            Provincia <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="shipping_province" name="shipping_province"
                                            value="{{ old('shipping_province') }}" maxlength="2"
                                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#3B2ECA] focus:border-[#3B2ECA] focus:outline-none @error('shipping_province') border-red-400 bg-red-50 @enderror"
                                            placeholder="MI" style="text-transform:uppercase">
                                        @error('shipping_province')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Note aggiuntive --}}
                        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                            <h2
                                class="text-base font-extrabold text-gray-900 uppercase tracking-widest mb-5 pb-4 border-b border-gray-100 flex items-center gap-2">
                                <span class="text-[#3B2ECA]">③</span> Note Aggiuntive
                                <span
                                    class="text-xs font-normal text-gray-400 normal-case tracking-normal">(opzionale)</span>
                            </h2>
                            <textarea id="notes" name="notes" rows="3"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#3B2ECA] focus:border-[#3B2ECA] focus:outline-none resize-none placeholder-gray-400"
                                placeholder="Istruzioni per la consegna, piano, citofono...">{{ old('notes') }}</textarea>
                        </div>

                    </div>

                    {{-- =========================================
                    COLONNA DESTRA — RIEPILOGO (sticky)
                    ========================================= --}}
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 sticky top-24">
                            <h2
                                class="text-base font-extrabold text-gray-900 uppercase tracking-widest mb-5 pb-4 border-b border-gray-100">
                                Il tuo Ordine
                            </h2>

                            {{-- Lista articoli --}}
                            <div class="space-y-3 mb-5">
                                @foreach($cart as $item)
                                    <div class="flex justify-between text-sm text-gray-700">
                                        <span class="font-medium truncate max-w-[60%]">
                                            {{ $item['name'] }}
                                            <span class="text-gray-400 text-xs">×{{ $item['quantity'] }}</span>
                                        </span>
                                        <span class="font-bold flex-shrink-0">
                                            {{ number_format(($item['price_cents'] * $item['quantity']) / 100, 2, ',', '.') }} €
                                        </span>
                                    </div>
                                @endforeach
                            </div>

                            <div class="border-t border-gray-100 pt-4 space-y-3">
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Subtotale</span>
                                    <span
                                        class="font-semibold text-gray-900">{{ number_format($subtotal / 100, 2, ',', '.') }}
                                        €</span>
                                </div>
                                @if($discountPercent > 0)
                                    <div class="flex justify-between text-sm text-green-600 font-semibold">
                                        <span>Sconto -{{ $discountPercent }}%</span>
                                        <span>- {{ number_format($discountAmount / 100, 2, ',', '.') }} €</span>
                                    </div>
                                @endif
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Spedizione</span>
                                    <span class="text-green-600 font-semibold">Gratuita</span>
                                </div>
                            </div>

                            <div class="border-t border-gray-200 mt-4 pt-4 flex justify-between items-baseline">
                                <span class="text-base font-bold text-gray-700 uppercase tracking-wide">TOTALE</span>
                                <span class="text-2xl font-black text-[#EAB308]">
                                    {{ number_format($total / 100, 2, ',', '.') }} €
                                </span>
                            </div>

                            {{-- ✅ GDPR Checkbox — OBBLIGATORIA --}}
                            <div class="mt-5 p-4 bg-gray-50 rounded-xl border border-gray-200">
                                <label for="accept_terms" class="flex items-start gap-3 cursor-pointer">
                                    <input type="checkbox" id="accept_terms" name="accept_terms" value="1" required
                                        class="mt-0.5 w-4 h-4 flex-shrink-0 rounded border-gray-300 text-[#3B2ECA] focus:ring-[#3B2ECA] cursor-pointer @error('accept_terms') border-red-400 @enderror">
                                    <span class="text-xs text-gray-600 leading-relaxed">
                                        Ho letto e accetto i
                                        <a href="{{ route('storefront.privacy') }}" target="_blank"
                                            class="text-[#3B2ECA] font-bold hover:underline">Termini e Condizioni</a>
                                        e l'<a href="{{ route('storefront.privacy') }}" target="_blank"
                                            class="text-[#3B2ECA] font-bold hover:underline">Informativa sulla Privacy</a>.
                                        <span class="text-red-500 font-bold">*</span>
                                    </span>
                                </label>
                                @error('accept_terms')
                                    <p class="text-red-500 text-xs mt-2 pl-7">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                class="w-full bg-[#EAB308] hover:bg-yellow-600 text-white font-extrabold py-4 rounded-xl mt-4 transition text-base shadow-lg shadow-yellow-100 hover:scale-[1.02] active:scale-95 transform">
                                🔐 Conferma l'Ordine
                            </button>

                            {{-- Badge SSL + Metodi di pagamento --}}
                            <div class="mt-5 pt-4 border-t border-gray-100">
                                <div class="flex items-center justify-center gap-1.5 text-green-700 text-xs font-bold mb-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    Pagamento sicuro 100% — Crittografia SSL
                                </div>
                                {{-- Loghi metodi di pagamento (SVG inline) --}}
                                <div class="flex items-center justify-center gap-3 flex-wrap">
                                    {{-- Visa --}}
                                    <div class="bg-white border border-gray-200 rounded-lg px-3 py-1.5 flex items-center">
                                        <svg viewBox="0 0 48 16" class="h-5 w-auto" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <text x="0" y="13" font-family="Arial" font-weight="bold" font-size="14"
                                                fill="#1A1F71">VISA</text>
                                        </svg>
                                    </div>
                                    {{-- Mastercard --}}
                                    <div
                                        class="bg-white border border-gray-200 rounded-lg px-2 py-1.5 flex items-center gap-0.5">
                                        <div class="w-5 h-5 rounded-full bg-[#EB001B] opacity-90"></div>
                                        <div class="w-5 h-5 rounded-full bg-[#F79E1B] opacity-90 -ml-2"></div>
                                    </div>
                                    {{-- PayPal --}}
                                    <div class="bg-white border border-gray-200 rounded-lg px-3 py-1.5 flex items-center">
                                        <svg viewBox="0 0 60 18" class="h-5 w-auto" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <text x="0" y="13" font-family="Arial" font-weight="bold" font-size="13"
                                                fill="#003087">Pay</text>
                                            <text x="24" y="13" font-family="Arial" font-weight="bold" font-size="13"
                                                fill="#009cde">Pal</text>
                                        </svg>
                                    </div>
                                    {{-- Bonifico --}}
                                    <div class="bg-white border border-gray-200 rounded-lg px-3 py-1.5">
                                        <span class="text-xs font-bold text-gray-500">🏦 Bonifico</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 text-center">
                                <a href="{{ route('storefront.cart.index') }}"
                                    class="text-xs text-[#3B2ECA] hover:underline">
                                    ← Torna al carrello
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </section>

@endsection