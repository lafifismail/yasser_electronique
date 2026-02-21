@extends('storefront.layouts.storefront')

@section('title', $category->name . ' — Catalogue')

@section('content')

    {{-- ===== HEADER CATÉGORIE ===== --}}
    <div class="bg-brand-dark text-white py-10 md:py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Breadcrumb --}}
            <nav class="text-sm text-gray-400 mb-3">
                <a href="{{ route('storefront.home') }}" class="hover:text-brand-gold transition">Accueil</a>
                <span class="mx-2">/</span>
                <span class="text-white font-medium">{{ $category->name }}</span>
            </nav>
            <h1 class="text-3xl md:text-4xl font-extrabold">{{ $category->name }}</h1>
            @if($category->description)
                <p class="text-gray-300 mt-2 max-w-2xl">{{ $category->description }}</p>
            @endif
            <p class="text-brand-gold text-sm mt-3 font-bold">
                {{ $products->total() }} produit(s) trouvé(s)
            </p>
        </div>
    </div>

    {{-- ===== GRILLE PRODUITS ===== --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        @if($products->isEmpty())
            <div class="text-center py-24 text-gray-400">
                <svg class="w-16 h-16 mx-auto mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <p class="text-lg">Aucun produit disponible dans cette catégorie.</p>
                <a href="{{ route('storefront.home') }}" class="mt-4 inline-block text-indigo-500 hover:underline">
                    Retour à l'accueil
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                    @php
                        $mainImage = $product->images->firstWhere('is_main', true) ?? $product->images->first();
                        $price = number_format($product->price_cents / 100, 2, ',', ' ');
                    @endphp
                    <a href="{{ route('storefront.product', $product->slug) }}"
                        class="group bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-brand-gold/40 transition-all duration-300 overflow-hidden flex flex-col">
                        {{-- Image --}}
                        <div class="relative aspect-square bg-gray-100 overflow-hidden">
                            @if($mainImage)
                                <img src="{{ Str::startsWith($mainImage->path, 'http') ? $mainImage->path : asset('storage/' . $mainImage->path) }}"
                                    alt="{{ $mainImage->alt ?? $product->name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                            @if($product->stock_qty === 0)
                                <span
                                    class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">Rupture</span>
                            @elseif($product->stock_qty < 5)
                                <span
                                    class="absolute top-2 left-2 bg-orange-400 text-white text-xs font-bold px-2 py-0.5 rounded-full">Dernières
                                    pièces</span>
                            @endif
                        </div>
                        {{-- Info --}}
                        <div class="p-4 flex flex-col flex-1">
                            <p class="text-xs text-gray-400 mb-1">{{ $product->brand?->name ?? '' }}</p>
                            <h3
                                class="font-semibold text-gray-900 text-sm leading-snug mb-auto line-clamp-2 group-hover:text-indigo-700 transition">
                                {{ $product->name }}
                            </h3>
                            <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between">
                                <span class="text-xl font-black text-brand-gold">{{ $price }} €</span>
                                <span
                                    class="text-xs text-brand-gold font-semibold opacity-0 group-hover:opacity-100 transition">Voir
                                    →</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-12 flex justify-center">
                {{ $products->links() }}
            </div>
        @endif
    </section>

@endsection