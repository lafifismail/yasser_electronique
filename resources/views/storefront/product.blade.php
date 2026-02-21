@extends('storefront.layouts.storefront')
@section('title', $product->name . ' — Yasser Électronique')

@section('content')
    @php
        $mainImage = $product->images->firstWhere('is_main', true) ?? $product->images->first();
        $price = number_format($product->price_cents / 100, 2, ',', ' ');
    @endphp

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

                        {{-- PRIX --}}
                        <div class="flex items-baseline gap-2 mb-6 pb-6 border-b border-gray-100">
                            <span class="text-4xl md:text-5xl font-black text-[#3B2ECA]">{{ $price }}</span>
                            <span class="text-xl font-black text-[#3B2ECA]">€</span>
                            <span class="text-sm text-gray-400 ml-1">TTC</span>
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
                            <button
                                class="w-full bg-[#3B2ECA] hover:bg-[#2A1FA8] text-white font-bold text-base px-8 py-4 rounded-xl shadow-lg shadow-yellow-100 transition cursor-not-allowed">
                                🛒 Ajouter au panier
                                <span class="block text-xs font-normal opacity-70 mt-0.5">(Fonctionnalité bientôt
                                    disponible)</span>
                            </button>
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

@endsection