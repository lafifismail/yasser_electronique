@extends('storefront.layouts.storefront')
@section('title', 'Chi Siamo — Yasser Elettronica')

@section('content')

    {{-- ===== HERO ===== --}}
    <section class="bg-gradient-to-br from-[#3B2ECA] to-[#1e1b6b] text-white py-16 md:py-24">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span
                class="inline-block bg-white/10 text-white text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-5">
                La nostra storia
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-white leading-tight mb-6">
                Chi Siamo
            </h1>
            <p class="text-lg md:text-xl text-indigo-200 max-w-2xl mx-auto leading-relaxed">
                Yasser Elettronica è il punto di riferimento per l'elettronica di consumo in Italia. Tecnologia, qualità e
                passione al servizio dei nostri clienti.
            </p>
        </div>
    </section>

    {{-- ===== STORIA ===== --}}
    <section class="bg-white py-16 md:py-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="block text-[#3B2ECA] text-xs font-bold uppercase tracking-widest mb-2">La nostra
                        storia</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight text-gray-950 mb-5">
                        Nati dalla passione per la tecnologia
                    </h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Fondata con l'obiettivo di rendere l'alta tecnologia accessibile a tutti, <strong>Yasser
                            Elettronica</strong> opera nel mercato italiano dell'elettronica di consumo con una selezione
                        rigorosa di prodotti di qualità ai prezzi più competitivi.
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Il nostro catalogo comprende smartphone, computer, tablet, audio, accessori e molto altro, scelti
                        tra i migliori brand mondiali: Apple, Samsung, Xiaomi, Sony, e tanti altri marchi affidabili.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        Ogni prodotto venduto sul nostro store è ufficiale, garantito e spedito rapidamente in tutta Italia.
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-[#3B2ECA]/5 border border-[#3B2ECA]/20 rounded-2xl p-6 text-center">
                        <p class="text-4xl font-black text-[#3B2ECA] mb-1">500+</p>
                        <p class="text-sm font-semibold text-gray-600">Prodotti in catalogo</p>
                    </div>
                    <div class="bg-[#3B2ECA]/5 border border-[#3B2ECA]/20 rounded-2xl p-6 text-center">
                        <p class="text-4xl font-black text-[#3B2ECA] mb-1">10K+</p>
                        <p class="text-sm font-semibold text-gray-600">Clienti soddisfatti</p>
                    </div>
                    <div class="bg-[#3B2ECA]/5 border border-[#3B2ECA]/20 rounded-2xl p-6 text-center">
                        <p class="text-4xl font-black text-[#3B2ECA] mb-1">24h</p>
                        <p class="text-sm font-semibold text-gray-600">Spedizioni rapide</p>
                    </div>
                    <div class="bg-[#3B2ECA]/5 border border-[#3B2ECA]/20 rounded-2xl p-6 text-center">
                        <p class="text-4xl font-black text-[#3B2ECA] mb-1">24M</p>
                        <p class="text-sm font-semibold text-gray-600">Garanzia prodotti</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== VALORI ===== --}}
    <section class="bg-gray-50 border-t border-gray-100 py-16 md:py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="block text-[#3B2ECA] text-xs font-bold uppercase tracking-widest mb-2">I nostri valori</span>
                <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight text-gray-950">
                    Perché scegliere Yasser Elettronica?
                </h2>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $values = [
                        ['icon' => '🏆', 'title' => 'Qualità Garantita', 'desc' => 'Solo prodotti ufficiali e certificati, selezionati con cura tra i migliori brand del mondo.'],
                        ['icon' => '💰', 'title' => 'Prezzi Competitivi', 'desc' => 'Monitoriamo costantemente il mercato per offrirti sempre il miglior prezzo possibile.'],
                        ['icon' => '🚚', 'title' => 'Spedizione Veloce', 'desc' => 'Consegniamo in tutta Italia in tempi rapidi, con tracking in tempo reale del tuo ordine.'],
                        ['icon' => '🎧', 'title' => 'Supporto Dedicato', 'desc' => 'Il nostro team è a tua disposizione 7 giorni su 7 per qualsiasi necessità prima e dopo l\'acquisto.'],
                    ];
                @endphp
                @foreach($values as $v)
                    <div
                        class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                        <span class="text-3xl mb-4 block">{{ $v['icon'] }}</span>
                        <h3 class="text-base font-bold text-gray-900 mb-2">{{ $v['title'] }}</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">{{ $v['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== CTA ===== --}}
    <section class="bg-white border-t border-gray-100 py-14 text-center">
        <div class="max-w-xl mx-auto px-4">
            <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight text-gray-950 mb-4">
                Hai domande? Siamo qui per te.
            </h2>
            <p class="text-gray-500 mb-6">Contattaci per qualsiasi informazione sui nostri prodotti o servizi.</p>
            <a href="{{ route('storefront.contact') }}"
                class="inline-flex items-center gap-2 bg-[#3B2ECA] hover:bg-[#2A1FA8] text-white font-bold px-8 py-3.5 rounded-xl shadow-lg shadow-indigo-200 transition-all duration-200">
                Contattaci
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </section>

@endsection