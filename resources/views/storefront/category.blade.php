@extends('storefront.layouts.storefront')

@section('title', $category->name . ' — Yasser Elettronica')

@section('content')

    {{-- ===================================================
    HEADER CATÉGORIE
    =================================================== --}}
    <div class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-14">
            {{-- Breadcrumb --}}
            <nav class="text-sm text-gray-400 mb-4">
                <a href="{{ route('storefront.home') }}" class="hover:text-white transition">Home</a>
                <span class="mx-2">/</span>
                <span class="text-white font-medium">{{ $category->name }}</span>
            </nav>
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight mb-2">
                {{ $category->name }}
            </h1>
            @if($category->description)
                <p class="text-gray-300 mt-2 max-w-2xl text-base">{{ $category->description }}</p>
            @endif
            <p class="text-[#3B2ECA] text-sm mt-3 font-bold bg-[#3B2ECA]/20 inline-block px-3 py-1 rounded-full">
                {{ $products->total() }} {{ $products->total() === 1 ? 'prodotto trovato' : 'prodotti trovati' }}
            </p>
        </div>
    </div>

    {{-- ===================================================
    LAYOUT PRINCIPALE : FILTRI + GRIGLIA PRODOTTI
    =================================================== --}}
    <section class="bg-gray-50 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 items-start">

                {{-- =========================================
                COLONNA SINISTRA — FILTRI
                ========================================= --}}
                <aside class="lg:col-span-1">
                    <form method="GET" action="{{ route('storefront.category', $category->slug) }}"
                        class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 sticky top-4">

                        <h2 class="text-sm font-extrabold text-gray-900 uppercase tracking-widest mb-5 flex items-center gap-2">
                            <svg class="w-4 h-4 text-[#3B2ECA]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                            </svg>
                            Filtri
                        </h2>

                        {{-- Filtre: Marca --}}
                        @if($brands->isNotEmpty())
                            <div class="mb-6">
                                <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-3">Marca</h3>
                                <div class="space-y-2">
                                    @foreach($brands as $brand)
                                        <label for="brand-{{ $brand->id }}"
                                            class="flex items-center gap-2.5 cursor-pointer group">
                                            <input
                                                type="checkbox"
                                                id="brand-{{ $brand->id }}"
                                                name="brands[]"
                                                value="{{ $brand->id }}"
                                                {{ in_array($brand->id, request('brands', [])) ? 'checked' : '' }}
                                                class="w-4 h-4 rounded border-gray-300 text-[#3B2ECA] focus:ring-[#3B2ECA] focus:ring-2 transition">
                                            <span class="text-sm text-gray-700 group-hover:text-[#3B2ECA] font-medium transition">
                                                {{ $brand->name }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <hr class="border-gray-100 mb-6">
                        @endif

                        {{-- Filtre: Condizione --}}
                        <div class="mb-6">
                            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-3">Condizione</h3>
                            <div class="space-y-2">
                                @foreach(['new' => 'Nuovo', 'refurbished' => 'Ricondizionato', 'used' => 'Usato'] as $value => $label)
                                    <label for="condition-{{ $value }}" class="flex items-center gap-2.5 cursor-pointer group">
                                        <input
                                            type="radio"
                                            id="condition-{{ $value }}"
                                            name="condition"
                                            value="{{ $value }}"
                                            {{ request('condition') === $value ? 'checked' : '' }}
                                            class="w-4 h-4 border-gray-300 text-[#3B2ECA] focus:ring-[#3B2ECA] transition">
                                        <span class="text-sm text-gray-700 group-hover:text-[#3B2ECA] font-medium transition">
                                            {{ $label }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Bottoni --}}
                        <button type="submit"
                            class="w-full bg-gray-900 hover:bg-[#3B2ECA] text-white font-bold py-2.5 rounded-xl transition text-sm">
                            Applica Filtri
                        </button>
                        @if(request()->hasAny(['brands', 'condition']))
                            <a href="{{ route('storefront.category', $category->slug) }}"
                                class="w-full block text-center text-sm text-gray-400 hover:text-red-500 mt-3 transition">
                                ✕ Rimuovi filtri
                            </a>
                        @endif

                    </form>
                </aside>

                {{-- =========================================
                COLONNA DESTRA — GRIGLIA PRODOTTI
                ========================================= --}}
                <div class="lg:col-span-3">

                    {{-- Nessun risultato --}}
                    @if($products->isEmpty())
                        <div class="text-center py-24 bg-white rounded-2xl border border-gray-200">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <p class="text-lg font-semibold text-gray-400">Nessun prodotto trovato.</p>
                            <p class="text-sm text-gray-400 mt-1">Prova a modificare o rimuovere i filtri applicati.</p>
                            <a href="{{ route('storefront.category', $category->slug) }}"
                                class="mt-5 inline-block text-[#3B2ECA] font-bold hover:underline text-sm">
                                Rimuovi tutti i filtri →
                            </a>
                        </div>

                    @else
                        {{-- Griglia prodotti --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                            @foreach($products as $product)
                                @php
                                    $mainImage  = $product->images->firstWhere('is_main', true) ?? $product->images->first();
                                    $price      = number_format($product->price_cents / 100, 2, ',', '.');
                                    $condBadge  = match($product->condition ?? 'new') {
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
            </div>
        </div>
    </section>

@endsection