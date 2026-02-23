@extends('storefront.layouts.storefront')
@section('title', 'Yasser Elettronica — Smartphone, PC & High-Tech in Italia')

@section('content')

    {{-- ============================================================
    SEZIONE 1 — HERO BANNER
    ============================================================ --}}
    <section class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-14">
            <div class="max-w-2xl">
                <span
                    class="inline-block bg-[#3B2ECA]/10 text-[#2A1FA8] text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-5">
                    ⚡ Prezzi Imbattibili — Spedizione in Tutta Italia
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-gray-900 leading-tight mb-5">
                    La Migliore Tecnologia<br>
                    al <span class="text-[#3B2ECA]">Miglior Prezzo</span>
                </h1>
                <p class="text-gray-500 text-lg md:text-xl leading-relaxed mb-8 max-w-xl">
                    Smartphone, computer, audio e accessori — marchi premium
                    selezionati per te, consegnati rapidamente ovunque in Italia.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#ultimi-arrivi"
                        class="inline-flex items-center justify-center gap-2 bg-[#3B2ECA] hover:bg-[#2A1FA8] text-white font-bold text-base px-8 py-3.5 rounded-xl shadow-lg shadow-indigo-200 transition-all duration-200">
                        Scopri le Offerte
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                    @if($categories->isNotEmpty())
                        <a href="{{ route('storefront.category', $categories->first()->slug) }}"
                            class="inline-flex items-center justify-center border-2 border-gray-200 hover:border-[#3B2ECA] text-gray-700 hover:text-[#3B2ECA] font-semibold text-base px-8 py-3.5 rounded-xl transition-all duration-200">
                            {{ $categories->first()->name }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
    SEZIONE 2 — GARANZIE (TRUST BADGES)
    ============================================================ --}}
    <section class="bg-gray-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                @php
                    $badges = [
                        ['icon' => '🚚', 'title' => 'Spedizione Rapida', 'desc' => 'In tutta Italia'],
                        ['icon' => '🔒', 'title' => 'Pagamento 100% Sicuro', 'desc' => 'Carte, bonifico, contrassegno'],
                        ['icon' => '⚙️', 'title' => 'Garanzia fino a 24 Mesi', 'desc' => 'Su tutti i prodotti'],
                        ['icon' => '🎧', 'title' => 'Assistenza Clienti', 'desc' => '7 giorni su 7'],
                    ];
                @endphp
                @foreach($badges as $b)
                    <div
                        class="flex flex-col items-center text-center p-5 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
                        <span class="text-3xl mb-3">{{ $b['icon'] }}</span>
                        <p class="font-bold text-sm text-gray-900">{{ $b['title'] }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ $b['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================================
    SEZIONE 3 — NAVIGAZIONE PER CATEGORIE
    ============================================================ --}}
    @if($categories->isNotEmpty())
        <section class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                <h2 class="text-lg font-bold text-gray-900 mb-6 text-center">Esplora le Categorie</h2>
                <div class="flex flex-wrap justify-center gap-5">
                    @php
                        $catIcons = ['📱', '💻', '🎧', '📷', '🖥️', '⌚', '🎮', '🔌'];
                    @endphp
                    @foreach($categories as $i => $cat)
                        <a href="{{ route('storefront.category', $cat->slug) }}"
                            class="group flex flex-col items-center gap-2 w-20 md:w-24">
                            <div
                                class="w-16 h-16 md:w-20 md:h-20 rounded-full bg-[#3B2ECA]/10 border-2 border-[#3B2ECA]/20 group-hover:border-[#3B2ECA] group-hover:bg-[#3B2ECA]/20 flex items-center justify-center transition-all duration-200 shadow-sm">
                                <span class="text-2xl md:text-3xl">{{ $catIcons[$i % count($catIcons)] }}</span>
                            </div>
                            <span
                                class="text-xs font-semibold text-gray-700 group-hover:text-[#3B2ECA] text-center leading-tight transition">
                                {{ $cat->name }}
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ============================================================
    SEZIONE 4 — OFFERTE LAMPO (PROMO BANNER)
    ============================================================ --}}
    <section class="bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 md:py-16">
            <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                <div>
                    <span
                        class="inline-block bg-[#3B2ECA] text-gray-900 text-xs font-black uppercase tracking-widest px-3 py-1 rounded-full mb-4">
                        ⚡ Offerte Lampo
                    </span>
                    <h2 class="text-3xl md:text-4xl font-black text-white leading-tight mb-2">
                        Le Migliori Offerte del Momento
                    </h2>
                    <p class="text-gray-400 text-base md:text-lg">
                        Fino al <span class="text-[#3B2ECA] font-bold">-40%</span> su una selezione di prodotti high-tech.
                    </p>
                </div>
                <a href="#ultimi-arrivi"
                    class="flex-shrink-0 inline-flex items-center gap-2 bg-[#3B2ECA] hover:bg-[#2A1FA8] text-white font-bold px-8 py-3.5 rounded-xl transition shadow-lg whitespace-nowrap">
                    Scopri di più
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ============================================================
    SEZIONE 5 — ULTIMI ARRIVI (8 PRODOTTI)
    ============================================================ --}}
    <section id="ultimi-arrivi" class="bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="flex items-end justify-between mb-8">
                <div>
                    <span class="block text-[#3B2ECA] text-xs font-bold uppercase tracking-widest mb-1">Novità</span>
                    <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight text-gray-950">Ultimi Arrivi</h2>
                </div>
                <span class="text-sm text-gray-400 hidden sm:block">{{ $latestProducts->count() }} prodotti</span>
            </div>

            @if($latestProducts->isEmpty())
                <div class="text-center py-16 text-gray-400">
                    <p>Nessun prodotto disponibile al momento.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach($latestProducts as $product)
                        @php
                            $mainImage = $product->images->firstWhere('is_main', true) ?? $product->images->first();
                            $price = number_format($product->price_cents / 100, 2, ',', '.');
                        @endphp
                        <a href="{{ route('storefront.product', $product->slug) }}"
                            class="group bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col">

                            {{-- Immagine --}}
                            <div class="relative w-full aspect-square bg-white overflow-hidden flex items-center justify-center p-4 border-b border-gray-100">
                                @if($mainImage)
                                    <img src="{{ Str::startsWith($mainImage->path, 'http') ? $mainImage->path : asset('storage/' . $mainImage->path) }}"
                                        alt="{{ $mainImage->alt ?? $product->name }}"
                                        class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-105">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-200">
                                        <svg class="w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif

                                {{-- Badge Condizione --}}
                                @php
                                    $condition = $product->condition ?? 'new';
                                    $conditionLabel = match($condition) {
                                        'refurbished' => ['text' => 'Ricondizionato', 'class' => 'bg-blue-500'],
                                        'used'        => ['text' => 'Usato',          'class' => 'bg-gray-600'],
                                        default       => ['text' => 'Nuovo',           'class' => 'bg-green-500'],
                                    };
                                @endphp
                                <span class="absolute top-2 right-2 text-white text-xs font-bold px-2 py-1 rounded shadow-sm z-10 {{ $conditionLabel['class'] }}">
                                    {{ $conditionLabel['text'] }}
                                </span>

                                {{-- Badge Stock --}}
                                @if($product->stock_qty === 0)
                                    <span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">Esaurito</span>
                                @elseif($product->stock_qty < 5)
                                    <span class="absolute top-2 left-2 bg-orange-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">Ultimi pezzi</span>
                                @endif
                            </div>

                                {{-- Info --}}
                                <div class="p-4 flex flex-col flex-1">
                                    @if($product->brand?->name)
                                        <p class="text-xs text-gray-400 font-medium uppercase tracking-wide mb-1">
                                            {{ $product->brand->name }}</p>
                                    @endif
                                    <h3 class="font-semibold text-sm text-gray-900 leading-snug line-clamp-2 group-hover:text-[#3B2ECA] transition mb-3">
                                        {{ $product->name }}
                                    </h3>
                                    <div class="mt-auto">
                                        <p class="text-xl font-black text-[#3B2ECA] mb-3">{{ $price }} €</p>
                                        <span class="w-full block text-center bg-[#3B2ECA] hover:bg-[#2A1FA8] text-white font-bold py-2.5 rounded-xl transition-colors text-sm">
                                            Acquista
                                        </span>
                                    </div>
                                </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- ============================================================
    SEZIONE 6 — I NOSTRI TOP BRAND
    ============================================================ --}}
    <section class="bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h2 class="text-center text-xl md:text-2xl font-extrabold tracking-tight text-gray-950 mb-2">I Nostri Top Brand</h2>
            <p class="text-center text-sm text-gray-400 mb-8">Prodotti ufficiali dei migliori marchi al mondo</p>

            <div class="grid grid-cols-3 md:grid-cols-5 gap-4 md:gap-6 items-center">
                @php
                    $brands = [
                        ['name' => 'Apple', 'emoji' => ''],
                        ['name' => 'Samsung', 'emoji' => ''],
                        ['name' => 'Xiaomi', 'emoji' => ''],
                        ['name' => 'Sony', 'emoji' => ''],
                        ['name' => 'LG', 'emoji' => ''],
                    ];
                @endphp
                @foreach($brands as $brand)
                    <div
                        class="flex items-center justify-center h-16 md:h-20 bg-gray-50 border border-gray-200 rounded-2xl px-4 hover:border-[#3B2ECA] hover:shadow-md transition-all duration-200 cursor-pointer">
                        <span class="text-lg md:text-xl font-black text-gray-600 tracking-tight uppercase">
                            {{ $brand['name'] }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================================
    SEZIONE 6b — RECENSIONI CLIENTI (Social Proof)
    ============================================================ --}}
    <section class="bg-gray-50 border-t border-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Intestazione --}}
            <div class="text-center mb-12">
                <span class="block text-[#3B2ECA] text-xs font-bold uppercase tracking-widest mb-2">Recensioni</span>
                <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight text-gray-950 mb-3">
                    Cosa dicono i nostri clienti
                </h2>
                <p class="text-gray-500 text-base max-w-xl mx-auto">
                    Scopri perché migliaia di italiani scelgono Yasser Elettronica.
                </p>
            </div>

            {{-- Griglia recensioni (dati statici — nessuna variabile PHP) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                {{-- Recensione 1 — Marco R. --}}
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 p-6 flex flex-col gap-4">
                    {{-- Stelle --}}
                    <div class="flex gap-0.5">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-[#EAB308]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    {{-- Testo --}}
                    <p class="text-sm text-gray-600 leading-relaxed italic flex-1">
                        "Spedizione rapidissima e prodotto perfetto. Ho acquistato un iPhone 13 ricondizionato ed è praticamente nuovo. Batteria al 100%. Consigliatissimo!"
                    </p>
                    {{-- Autore --}}
                    <div class="flex items-center gap-3 pt-2 border-t border-gray-100">
                        <div class="w-9 h-9 rounded-full bg-[#3B2ECA]/10 flex items-center justify-center text-[#3B2ECA] font-black text-sm flex-shrink-0">M</div>
                        <div>
                            <p class="text-sm font-bold text-gray-900">Marco R.</p>
                            <span class="inline-flex items-center gap-1 text-xs text-green-600 font-semibold">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z" clip-rule="evenodd"/></svg>
                                Acquirente verificato
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Recensione 2 — Giulia F. --}}
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 p-6 flex flex-col gap-4">
                    <div class="flex gap-0.5">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-[#EAB308]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed italic flex-1">
                        "Prezzi imbattibili rispetto ai grandi negozi fisici. Il servizio clienti ha risposto subito a un mio dubbio sulla garanzia. Comprerò sicuramente ancora."
                    </p>
                    <div class="flex items-center gap-3 pt-2 border-t border-gray-100">
                        <div class="w-9 h-9 rounded-full bg-[#3B2ECA]/10 flex items-center justify-center text-[#3B2ECA] font-black text-sm flex-shrink-0">G</div>
                        <div>
                            <p class="text-sm font-bold text-gray-900">Giulia F.</p>
                            <span class="inline-flex items-center gap-1 text-xs text-green-600 font-semibold">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z" clip-rule="evenodd"/></svg>
                                Acquirente verificato
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Recensione 3 — Alessandro T. --}}
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 p-6 flex flex-col gap-4">
                    <div class="flex gap-0.5">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-[#EAB308]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed italic flex-1">
                        "Ottima esperienza. Il PC portatile è arrivato imballato alla perfezione. Funziona benissimo e ho risparmiato oltre 200€."
                    </p>
                    <div class="flex items-center gap-3 pt-2 border-t border-gray-100">
                        <div class="w-9 h-9 rounded-full bg-[#3B2ECA]/10 flex items-center justify-center text-[#3B2ECA] font-black text-sm flex-shrink-0">A</div>
                        <div>
                            <p class="text-sm font-bold text-gray-900">Alessandro T.</p>
                            <span class="inline-flex items-center gap-1 text-xs text-green-600 font-semibold">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z" clip-rule="evenodd"/></svg>
                                Acquirente verificato
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ============================================================
    SEZIONE 7 — FAQ (DOMANDE FREQUENTI)
    ============================================================ --}}
    <section class="bg-white border-t border-gray-100">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="text-center mb-10">
                <span class="block text-[#3B2ECA] text-xs font-bold uppercase tracking-widest mb-2">FAQ</span>
                <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight text-gray-950">
                    Hai dei dubbi? Ti rispondiamo noi.
                </h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Card 1 --}}
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300">
                    <span class="text-2xl mb-4 block">🛡️</span>
                    <h3 class="font-bold text-gray-900 mb-2 text-sm">
                        I prodotti hanno una garanzia?
                    </h3>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        Sì, tutti i nostri prodotti includono una garanzia da 12 a 24 mesi per offrirti la massima tranquillità.
                    </p>
                </div>

                {{-- Card 2 --}}
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300">
                    <span class="text-2xl mb-4 block">📦</span>
                    <h3 class="font-bold text-gray-900 mb-2 text-sm">
                        Posso restituire il prodotto?
                    </h3>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        Certamente. Hai 14 giorni di tempo per cambiare idea e restituire l'articolo gratuitamente.
                    </p>
                </div>

                {{-- Card 3 --}}
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300">
                    <span class="text-2xl mb-4 block">🔒</span>
                    <h3 class="font-bold text-gray-900 mb-2 text-sm">
                        I pagamenti sono sicuri?
                    </h3>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        Al 100%. Utilizziamo protocolli crittografati avanzati per proteggere ogni tua transazione.
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{-- ============================================================
    SEZIONE 8 — NEWSLETTER (LEAD MAGNET)
    ============================================================ --}}
    <section class="bg-gray-50 border-t border-gray-100">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
            <span class="text-2xl mb-4 block">🎁</span>
            <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight text-gray-950 mb-2">
                Ricevi <span class="text-[#3B2ECA]">10€ di sconto</span> sul tuo primo ordine
            </h2>
            <p class="text-gray-500 mb-8">
                Iscriviti alla newsletter e approfitta subito dello sconto per acquisti superiori a 200€.
            </p>
            <form class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto" onsubmit="return false;">
                <input type="email" placeholder="la.tua@email.it"
                    class="flex-1 px-4 py-3 border border-gray-300 rounded-xl text-sm focus:outline-none focus:border-[#3B2ECA] focus:ring-2 focus:ring-[#3B2ECA]/20 transition">
                <button type="submit"
                    class="bg-[#3B2ECA] hover:bg-[#2A1FA8] text-white font-bold px-6 py-3 rounded-xl transition shadow-md whitespace-nowrap">
                    Iscrivimi
                </button>
            </form>
            <p class="text-xs text-gray-400 mt-4">Nessuno spam. Disiscrizione con un click.</p>
        </div>
    </section>

@endsection