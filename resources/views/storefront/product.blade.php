@extends('storefront.layouts.storefront')
@section('title', $product->name . ' — Yasser Électronique')

@section('content')
    @php
        $mainImage = $product->images->firstWhere('is_main', true) ?? $product->images->first();
        $price = number_format($product->price_cents / 100, 2, ',', ' ');
    @endphp

    {{-- ✅ Flash succès ajout panier --}}
    @if(session('cart_success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-800 text-sm font-medium px-6 py-4 flex items-center gap-3">
            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            {{ session('cart_success') }}
            <a href="{{ route('storefront.cart.index') }}" class="ml-auto underline font-bold hover:text-green-900 transition">Vai al carrello →</a>
        </div>
    @endif

    {{-- BREADCRUMB --}}
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 text-sm text-gray-400">
            <a href="{{ route('storefront.home') }}" class="hover:text-[#3B2ECA] transition">Accueil</a>
            @if($product->category)
                <span class="mx-2">/</span>
                <a href="{{ route('storefront.category', $product->category->slug) }}"
                    class="hover:text-[#3B2ECA] transition">{{ $product->category->name }}</a>
            @endif
            <span class="mx-2">/</span>
            <span class="text-gray-900 font-medium">{{ $product->name }}</span>
        </div>
    </div>

    {{-- CORPS PRINCIPAL --}}
    <div class="bg-gray-50 py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- CARTE PRODUIT --}}
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">

                    {{-- ====== GALERIE ====== --}}
                    <div class="p-6 md:p-8 border-b lg:border-b-0 lg:border-r border-gray-100">
                        {{-- Image principale --}}
                        <div class="aspect-square bg-gray-50 rounded-xl overflow-hidden mb-4 border border-gray-100">
                            @if($mainImage)
                                <img id="main-img"
                                    src="{{ Str::startsWith($mainImage->path, 'http') ? $mainImage->path : asset('storage/' . $mainImage->path) }}"
                                    alt="{{ $mainImage->alt ?? $product->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-200">
                                    <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Miniatures --}}
                        @if($product->images->count() > 1)
                            <div class="grid grid-cols-5 gap-2">
                                @foreach($product->images as $img)
                                    @php $src = Str::startsWith($img->path, 'http') ? $img->path : asset('storage/' . $img->path); @endphp
                                    <button onclick="document.getElementById('main-img').src='{{ $src }}'"
                                        class="aspect-square bg-gray-100 rounded-lg overflow-hidden border-2 border-transparent hover:border-[#3B2ECA] focus:border-[#3B2ECA] focus:outline-none transition">
                                        <img src="{{ $src }}" alt="{{ $img->alt ?? '' }}" class="w-full h-full object-cover">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- ====== INFOS ====== --}}
                    <div class="p-6 md:p-8 flex flex-col">

                        {{-- Marque + Catégorie --}}
                        <div class="flex flex-wrap items-center gap-2 mb-4">
                            @if($product->brand)
                                <span
                                    class="bg-[#3B2ECA]/10 text-[#2A1FA8] text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full">
                                    {{ $product->brand->name }}
                                </span>
                            @endif
                            @if($product->category)
                                <a href="{{ route('storefront.category', $product->category->slug) }}"
                                    class="text-xs text-gray-400 hover:text-[#3B2ECA] border border-gray-200 px-3 py-1 rounded-full transition">
                                    {{ $product->category->name }}
                                </a>
                            @endif
                        </div>

                        {{-- Nom --}}
                        <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 leading-tight mb-5">
                            {{ $product->name }}
                        </h1>

                        {{-- PRIX + BADGE URGENZA --}}
                        <div class="mb-6 pb-6 border-b border-gray-100">
                            <div class="flex items-baseline gap-2 mb-2">
                                <span class="text-4xl md:text-5xl font-black text-[#3B2ECA]">{{ $price }}</span>
                                <span class="text-xl font-black text-[#3B2ECA]">€</span>
                                <span class="text-sm text-gray-400 ml-1">IVA inclusa</span>
                            </div>
                            {{-- Badge scarsità --}}
                            @if($product->stock_qty > 0 && $product->stock_qty < 5)
                                <div class="flex items-center gap-2 text-red-600 font-bold text-sm mt-2">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    🔥 Affrettati! Solo <span class="underline mx-1">{{ $product->stock_qty }} pezzi</span>
                                    rimasti in magazzino.
                                </div>
                            @elseif($product->stock_qty <= 0)
                                <div
                                    class="inline-flex items-center gap-2 bg-gray-100 text-gray-500 text-sm font-bold px-3 py-1.5 rounded-full mt-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Esaurito — Non disponibile
                                </div>
                            @endif
                        </div>

                        {{-- Badges --}}
                        <div class="flex flex-wrap gap-2 mb-6">
                            @if($product->stock_qty > 0)
                                <span
                                    class="flex items-center gap-1.5 bg-green-50 text-green-700 border border-green-200 text-xs font-semibold px-3 py-1.5 rounded-full">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                    En stock ({{ $product->stock_qty }})
                                </span>
                            @else
                                <span
                                    class="flex items-center gap-1.5 bg-red-50 text-red-600 border border-red-200 text-xs font-semibold px-3 py-1.5 rounded-full">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                    Rupture de stock
                                </span>
                            @endif
                            @if($product->condition)
                                <span
                                    class="bg-blue-50 text-blue-700 border border-blue-200 text-xs font-semibold px-3 py-1.5 rounded-full capitalize">
                                    {{ $product->condition }}
                                </span>
                            @endif
                            @if($product->warranty_months)
                                <span
                                    class="bg-purple-50 text-purple-700 border border-purple-200 text-xs font-semibold px-3 py-1.5 rounded-full">
                                    🔒 {{ $product->warranty_months }} mois garantie
                                </span>
                            @endif
                        </div>

                        {{-- Description courte --}}
                        @if($product->short_description)
                            <p class="text-gray-500 text-sm leading-relaxed mb-6 border-l-4 border-[#3B2ECA] pl-4">
                                {{ $product->short_description }}
                            </p>
                        @endif

                        {{-- CTA --}}
                        <div class="mt-auto">
                            @if($product->stock_qty > 0)
                                <form action="{{ route('storefront.cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="flex items-center gap-3 mb-3">
                                        <label for="quantity" class="text-sm font-semibold text-gray-600">Qtà:</label>
                                        <select id="quantity" name="quantity"
                                            class="border border-gray-300 text-sm rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#EAB308] focus:border-[#EAB308] focus:outline-none">
                                            @for($i = 1; $i <= min(10, $product->stock_qty); $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <button type="submit"
                                        class="w-full bg-[#EAB308] hover:bg-yellow-600 text-white font-extrabold text-base px-8 py-4 rounded-xl shadow-lg shadow-yellow-100 transition-all hover:scale-[1.02] active:scale-95">
                                        🛒 Aggiungi al Carrello
                                    </button>
                                </form>
                            @else
                                <button disabled
                                    class="w-full bg-gray-200 text-gray-400 font-bold text-base px-8 py-4 rounded-xl cursor-not-allowed select-none">
                                    Prodotto Esaurito
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- ====== DESCRIPTION + ATTRIBUTS ====== --}}
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Description complète --}}
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                    <h2 class="text-lg font-bold text-gray-900 mb-5 pb-3 border-b border-gray-100">
                        📄 Description du produit
                    </h2>
                    @if($product->description)
                        <div class="prose prose-sm max-w-none text-gray-600 leading-relaxed">
                            {!! $product->description !!}
                        </div>
                    @else
                        <p class="text-gray-400 italic text-sm">Aucune description disponible.</p>
                    @endif
                </div>

                {{-- Caractéristiques techniques --}}
                @if($product->attributes->isNotEmpty())
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                        <h2 class="text-lg font-bold text-gray-900 mb-5 pb-3 border-b border-gray-100">
                            ⚙️ Caractéristiques
                        </h2>
                        <dl class="space-y-0">
                            @foreach($product->attributes as $attr)
                                <div class="flex justify-between items-start py-2.5 border-b border-gray-50 last:border-0 gap-3">
                                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide shrink-0 capitalize">
                                        {{ str_replace('_', ' ', $attr->attribute_key) }}
                                    </dt>
                                    <dd class="text-sm font-semibold text-gray-900 text-right">
                                        {{ $attr->value }}
                                    </dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>
                @endif
            </div>

        </div>
    </div>

    {{-- ====================================================
    SEZIONE — PRODOTTI CORRELATI (Cross-selling)
    ==================================================== --}}
    @if($relatedProducts->isNotEmpty())
    <section class="bg-white border-t border-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <span class="block text-[#3B2ECA] text-xs font-bold uppercase tracking-widest mb-1">Scopri di più</span>
                <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight text-gray-950">
                    Potrebbe piacerti anche&hellip;
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach($relatedProducts as $related)
                    @php
                        $relMainImage = $related->images->firstWhere('is_main', true) ?? $related->images->first();
                        $relPrice     = number_format($related->price_cents / 100, 2, ',', '.');
                        $relCondition = match($related->condition ?? 'new') {
                            'refurbished' => ['text' => 'Ricondizionato', 'class' => 'bg-blue-500'],
                            'used'        => ['text' => 'Usato',          'class' => 'bg-gray-600'],
                            default       => ['text' => 'Nuovo',          'class' => 'bg-green-500'],
                        };
                    @endphp
                    <a href="{{ route('storefront.product', $related->slug) }}"
                        class="group bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col">

                        {{-- Immagine --}}
                        <div class="relative w-full aspect-square bg-white overflow-hidden flex items-center justify-center p-4 border-b border-gray-100">
                            @if($relMainImage)
                                <img src="{{ Str::startsWith($relMainImage->path, 'http') ? $relMainImage->path : asset('storage/' . $relMainImage->path) }}"
                                    alt="{{ $relMainImage->alt ?? $related->name }}"
                                    class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-200">
                                    <svg class="w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                            {{-- Badge condizione (coin haut droit) --}}
                            <span class="absolute top-2 right-2 text-white text-xs font-bold px-2 py-1 rounded shadow-sm z-10 {{ $relCondition['class'] }}">
                                {{ $relCondition['text'] }}
                            </span>
                            {{-- Badge stock (coin haut gauche) --}}
                            @if($related->stock_qty === 0)
                                <span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">Esaurito</span>
                            @elseif($related->stock_qty < 5)
                                <span class="absolute top-2 left-2 bg-orange-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">Ultimi pezzi</span>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="p-4 flex flex-col flex-1">
                            @if($related->brand?->name)
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wide mb-1">{{ $related->brand->name }}</p>
                            @endif
                            <h3 class="font-semibold text-sm text-gray-900 leading-snug line-clamp-2 group-hover:text-[#3B2ECA] transition mb-3">
                                {{ $related->name }}
                            </h3>
                            <div class="mt-auto">
                                <p class="text-xl font-black text-[#3B2ECA] mb-3">{{ $relPrice }} €</p>
                                <span class="w-full block text-center bg-[#3B2ECA] hover:bg-[#2A1FA8] text-white font-bold py-2.5 rounded-xl transition-colors text-sm">
                                    Acquista
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
    </section>
    @endif

@endsection
