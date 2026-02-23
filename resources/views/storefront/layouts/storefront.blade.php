<!DOCTYPE html>
<html lang="it" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Yasser Elettronica')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="bg-gray-50 text-gray-900 flex flex-col min-h-screen" style="font-family:'Inter',sans-serif">

    {{-- ===== TOP BAR ===== --}}
    <div class="bg-gray-900 text-white text-xs py-2 text-center px-4">
        🚚 Spedizione gratuita per ordini superiori a 50€
        <span class="mx-3 opacity-40">|</span>
        🛡️ Reso facile entro 14 giorni
    </div>

    {{-- ===== HEADER ===== --}}
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Riga principale: Logo + Search + Carrello + Burger --}}
            <div class="flex items-center gap-4 py-3">

                {{-- Logo SOLO (niente testo) --}}
                <a href="{{ route('storefront.home') }}" class="flex-shrink-0">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Yasser Elettronica"
                        class="h-20 md:h-32 w-auto object-contain">
                </a>

                {{-- Barra di ricerca centrale (Desktop) --}}
                <div class="flex-1 hidden sm:flex items-center">
                    <form action="{{ route('storefront.search') }}" method="GET"
                        class="flex w-full max-w-2xl mx-auto border border-gray-300 rounded-xl overflow-hidden focus-within:border-[#3B2ECA] focus-within:ring-2 focus-within:ring-[#3B2ECA]/20 transition">
                        <input type="text" name="q" value="{{ request('q') }}"
                            placeholder="Cerca smartphone, PC, accessori..."
                            class="flex-1 pl-5 py-3 text-sm bg-white focus:outline-none placeholder-gray-400">
                        <button type="submit"
                            class="bg-[#3B2ECA] hover:bg-[#2A1FA8] text-white font-bold px-5 py-3 transition text-sm flex items-center gap-2 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Cerca
                        </button>
                    </form>
                </div>

                {{-- Destra: Carrello + Burger --}}
                <div class="flex items-center gap-2 flex-shrink-0 ml-auto sm:ml-0">
                    <a href="{{ route('storefront.cart.index') }}"
                        class="relative flex items-center gap-1.5 px-3 py-2 text-sm font-semibold text-[#3B2ECA] hover:text-[#2A1FA8] transition"
                        aria-label="Carrello">
                        <span class="relative">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6h11M10 21a1 1 0 100-2 1 1 0 000 2zm7 0a1 1 0 100-2 1 1 0 000 2z" />
                            </svg>
                            @php $cartCount = collect(session('cart', []))->sum('quantity'); @endphp
                            @if($cartCount > 0)
                                <span
                                    class="absolute -top-2 -right-2 bg-[#EAB308] text-white text-xs font-extrabold w-5 h-5 rounded-full flex items-center justify-center leading-none shadow">
                                    {{ $cartCount > 99 ? '99+' : $cartCount }}
                                </span>
                            @endif
                        </span>
                        <span class="hidden md:inline font-bold">Carrello</span>
                    </a>
                    <button id="burger" class="md:hidden p-2 text-gray-600 hover:text-[#3B2ECA] transition"
                        aria-label="Menù">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Barra ricerca mobile --}}
            <div class="sm:hidden pb-3">
                <form action="{{ route('storefront.search') }}" method="GET"
                    class="flex border border-gray-300 rounded-xl overflow-hidden focus-within:border-[#3B2ECA] transition">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cerca prodotti..."
                        class="flex-1 pl-4 py-2.5 text-sm bg-white focus:outline-none placeholder-gray-400">
                    <button type="submit" class="bg-[#3B2ECA] hover:bg-[#2A1FA8] text-white font-bold px-4 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>

            {{-- Navigation links --}}
            <nav class="hidden md:flex items-center gap-1 border-t border-gray-100 py-2">
                <a href="{{ route('storefront.home') }}"
                    class="px-4 py-1.5 text-sm font-semibold rounded-lg transition
                          {{ request()->routeIs('storefront.home') ? 'text-[#3B2ECA]' : 'text-gray-700 hover:text-[#3B2ECA]' }}">
                    Home
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('storefront.category', $cat->slug) }}"
                        class="px-4 py-1.5 text-sm font-semibold rounded-lg transition
                                              {{ request()->is('categorie/' . $cat->slug) ? 'text-[#3B2ECA]' : 'text-gray-700 hover:text-[#3B2ECA]' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </nav>
        </div>

        {{-- Menu mobile --}}
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 px-4 pb-4 pt-2 space-y-1">
            <a href="{{ route('storefront.home') }}"
                class="block px-4 py-2 rounded-lg text-sm font-semibold text-gray-800 hover:bg-indigo-50 hover:text-[#3B2ECA] transition">
                Home
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('storefront.category', $cat->slug) }}"
                    class="block px-4 py-2 rounded-lg text-sm font-semibold text-gray-800 hover:bg-indigo-50 hover:text-[#3B2ECA] transition">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
    </header>

    {{-- ===== MAIN ===== --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- ===== FOOTER ===== --}}
    <footer class="bg-gray-900 text-gray-400">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">

                {{-- Colonna 1 : Brand --}}
                <div class="sm:col-span-2 lg:col-span-1">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Yasser Elettronica"
                        class="h-12 mb-4 brightness-0 invert opacity-80">
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Il tuo specialista in elettronica e high-tech. Qualità, prezzi imbattibili e servizio eccellente
                        in tutta Italia.
                    </p>
                </div>

                {{-- Colonna 2 : Link Utili (Categorie) --}}
                <div>
                    <h3 class="text-white font-bold mb-4 text-xs uppercase tracking-widest">Link Utili</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('storefront.home') }}" class="hover:text-[#3B2ECA] transition">Home</a>
                        </li>
                        @foreach($categories as $cat)
                            <li>
                                <a href="{{ route('storefront.category', $cat->slug) }}"
                                    class="hover:text-[#3B2ECA] transition">{{ $cat->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Colonna 3 : Supporto --}}
                <div>
                    <h3 class="text-white font-bold mb-4 text-xs uppercase tracking-widest">Supporto</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('storefront.about') }}" class="hover:text-[#3B2ECA] transition">Chi
                                Siamo</a></li>
                        <li><a href="{{ route('storefront.refund') }}" class="hover:text-[#3B2ECA] transition">Politica
                                di Rimborso</a></li>
                        <li><a href="{{ route('storefront.privacy') }}" class="hover:text-[#3B2ECA] transition">Privacy
                                Policy</a></li>
                        <li><a href="{{ route('storefront.contact') }}"
                                class="hover:text-[#3B2ECA] transition">Contattaci</a></li>
                    </ul>
                </div>

                {{-- Colonna 4 : Contatti --}}
                <div>
                    <h3 class="text-white font-bold mb-4 text-xs uppercase tracking-widest">Contatti</h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start gap-2">
                            <span class="mt-0.5">📧</span>
                            <a href="mailto:info@yasserelettronica.it"
                                class="hover:text-[#3B2ECA] transition break-all">info@yasserelettronica.it</a>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-0.5">📞</span>
                            <a href="tel:+390212345678" class="hover:text-[#3B2ECA] transition">+39 02 1234 5678</a>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-0.5">📍</span>
                            <span>Via della Tecnologia, 42<br>20124 Milano (MI)</span>
                        </li>
                    </ul>
                </div>

            </div>
            <div
                class="border-t border-gray-800 mt-10 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-gray-600">
                <span>&copy; {{ date('Y') }} Yasser Elettronica — Tutti i diritti riservati.</span>
                <span class="flex gap-4">
                    <a href="{{ route('storefront.privacy') }}" class="hover:text-[#3B2ECA] transition">Privacy
                        Policy</a>
                    <a href="{{ route('storefront.refund') }}" class="hover:text-[#3B2ECA] transition">Resi &amp;
                        Rimborsi</a>
                </span>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('burger').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
    });
    </script>
    @stack('scripts')
</body>

</html>