@extends('storefront.layouts.storefront')

@section('title',
    $keyword
        ? 'Ricerca: "' . $keyword . '" — Yasser Elettronica'
        : 'Cerca un prodotto — Yasser Elettronica'
)

@section('content')

    {{-- ===================================================
    HEADER RICERCA
    =================================================== --}}
    <div class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-14">
            <nav class="text-sm text-gray-400 mb-4">
                <a href="{{ route('storefront.home') }}" class="hover:text-white transition">Home</a>
                <span class="mx-2">/</span>
                <span class="text-white font-medium">Ricerca</span>
            </nav>

            @if($keyword)
                <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight mb-2">
                    Risultati per: <span class="text-[#3B2ECA]">"{{ $keyword }}"</span>
                </h1>
                <p class="text-[#3B2ECA] text-sm mt-3 font-bold bg-[#3B2ECA]/20 inline-block px-3 py-1 rounded-full">
                    {{ $products->total() }} {{ $products->total() === 1 ? 'prodotto trovato' : 'prodotti trovati' }}
                </p>
            @else
                <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight mb-2">
                    Cerca un prodotto
                </h1>
                <p class="text-gray-300 mt-2 text-base">Digita un nome nella barra di ricerca in alto.</p>
            @endif
        </div>
    </div>

    {{-- ===================================================
    GRIGLIA RISULTATI
    =================================================== --}}
    <section class="bg-gray-50 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Nessun risultato --}}
            @if($products->isEmpty())
                <div class="text-center py-24 bg-white rounded-2xl border border-gray-200">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <p class="text-lg font-semibold text-gray-500">
                        @if($keyword)
                            Nessun prodotto trovato per <strong>"{{ $keyword }}"</strong>.
                        @else
                            Inserisci un termine di ricerca per trovare i prodotti.
                        @endif
                    </p>
                    <a href="{{ route('storefront.home') }}"
                        class="mt-5 inline-block text-[#3B2ECA] font-bold hover:underline text-sm">
                        ← Torna alla Home
                    </a>
                </div>

            @else
                {{-- Griglia prodotti --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                    @foreach($products as $product)
                        @php
                            $mainImage = $product->images->firstWhere('is_main', true) ?? $product->images->first();
                            $price     = number_format($product->price_cents / 100, 2, ',', '.');
                            $condBadge = match($product->condition ?? 'new') {
                                'refurbished' => ['text' => 'Ricondizionato', 'class' => 'bg-blue-500'],
                                'used'        => ['text' => 'Usato',          'class' => 'bg-gray-600'],
                                default       => ['text' => 'Nuovo',          'class' => 'bg-green-500'],
                            };
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
                                {{-- Badge condizione --}}
                                <span class="absolute top-2 right-2 text-white text-xs font-bold px-2 py-1 rounded shadow-sm z-10 {{ $condBadge['class'] }}">
                                    {{ $condBadge['text'] }}
                                </span>
                                {{-- Badge stock --}}
                                @if($product->stock_qty === 0)
                                    <span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">Esaurito</span>
                                @elseif($product->stock_qty < 5)
                                    <span class="absolute top-2 left-2 bg-orange-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">Ultimi pezzi</span>
                                @endif
                            </div>

                            {{-- Info --}}
                            <div class="p-4 flex flex-col flex-1">
                                @if($product->brand?->name)
                                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wide mb-1">{{ $product->brand->name }}</p>
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

                {{-- Pagination --}}
                <div class="mt-10">
                    {{ $products->links() }}
                </div>
            @endif

        </div>
    </section>

@endsection
