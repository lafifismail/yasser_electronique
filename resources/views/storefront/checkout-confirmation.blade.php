@extends('storefront.layouts.storefront')

@section('title', 'Ordine Confermato #' . $order->id . ' — Yasser Elettronica')

@section('content')

    {{-- ===================================================
    HERO CONFERMA
    =================================================== --}}
    <div class="bg-gradient-to-br from-[#3B2ECA] to-indigo-900 text-white">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
            {{-- Icona successo --}}
            <div
                class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6 ring-4 ring-white/30">
                <svg class="w-10 h-10 text-[#EAB308]" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold mb-3">Grazie, {{ Str::beforeLast($order->guest_name, ' ') }}!
            </h1>
            <p class="text-indigo-200 text-lg mb-2">Il tuo ordine è stato ricevuto con successo.</p>
            <p class="text-white/60 text-sm">Una conferma è in arrivo a <strong
                    class="text-white">{{ $order->guest_email }}</strong></p>
            <div
                class="mt-6 inline-block bg-white/10 border border-white/20 rounded-xl px-6 py-3 text-sm font-mono font-bold tracking-widest">
                Ordine # {{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
            </div>
        </div>
    </div>

    {{-- ===================================================
    DETTAGLI ORDINE
    =================================================== --}}
    <section class="bg-gray-50 py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Articoli ordinati --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h2
                    class="text-sm font-extrabold text-gray-900 uppercase tracking-widest mb-5 pb-4 border-b border-gray-100">
                    📦 Articoli Ordinati
                </h2>
                <div class="space-y-3">
                    @foreach($order->items as $item)
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm font-semibold text-gray-900">{{ $item->name }}</p>
                                <p class="text-xs text-gray-400">{{ number_format($item->unit_price_cents / 100, 2, ',', '.') }}
                                    € × {{ $item->qty }}</p>
                            </div>
                            <p class="text-sm font-black text-gray-900">
                                {{ number_format($item->line_total_cents / 100, 2, ',', '.') }} €
                            </p>
                        </div>
                    @endforeach
                </div>
                <div class="border-t border-gray-100 mt-4 pt-4 space-y-2">
                    <div class="flex justify-between text-sm text-gray-500">
                        <span>Subtotale</span>
                        <span
                            class="font-semibold text-gray-900">{{ number_format($order->subtotal_cents / 100, 2, ',', '.') }}
                            €</span>
                    </div>
                    @if($order->discount_cents > 0)
                        <div class="flex justify-between text-sm text-green-600 font-semibold">
                            <span>Sconto applicato</span>
                            <span>- {{ number_format($order->discount_cents / 100, 2, ',', '.') }} €</span>
                        </div>
                    @endif
                    <div class="flex justify-between text-sm text-gray-500">
                        <span>Spedizione</span>
                        <span class="text-green-600 font-semibold">Gratuita</span>
                    </div>
                    <div class="flex justify-between items-baseline pt-2 border-t border-gray-100 mt-2">
                        <span class="text-base font-bold text-gray-800 uppercase tracking-wide">TOTALE</span>
                        <span class="text-2xl font-black text-[#EAB308]">
                            {{ number_format($order->total_cents / 100, 2, ',', '.') }} €
                        </span>
                    </div>
                </div>
            </div>

            {{-- Indirizzo di spedizione --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h2
                    class="text-sm font-extrabold text-gray-900 uppercase tracking-widest mb-4 pb-4 border-b border-gray-100">
                    🚚 Consegna a
                </h2>
                <div class="text-sm text-gray-700 space-y-1">
                    <p class="font-bold text-gray-900">{{ $order->guest_name }}</p>
                    <p>{{ $order->shipping_street }}</p>
                    <p>{{ $order->shipping_postal_code }} {{ $order->shipping_city }} ({{ $order->shipping_province }})</p>
                    <p class="text-gray-400">📞 {{ $order->guest_phone }}</p>
                    @if($order->notes)
                        <p class="mt-2 text-gray-500 italic">Note: {{ $order->notes }}</p>
                    @endif
                </div>
            </div>

            {{-- Status --}}
            <div class="bg-[#3B2ECA]/5 border border-[#3B2ECA]/20 rounded-2xl p-5 text-center">
                <p class="text-sm text-gray-600">
                    🕐 Il tuo ordine è in stato
                    <span class="font-extrabold text-[#3B2ECA] uppercase">Pending</span>.
                    Ti contatteremo entro <strong>24 ore</strong> per confermare disponibilità e modalità di pagamento.
                </p>
            </div>

            {{-- CTA --}}
            <div class="text-center pt-2">
                <a href="{{ route('storefront.home') }}"
                    class="inline-block bg-[#3B2ECA] hover:bg-[#2A1FA8] text-white font-extrabold px-10 py-4 rounded-xl transition text-base">
                    ← Continua lo Shopping
                </a>
            </div>

        </div>
    </section>

@endsection