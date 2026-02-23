@extends('storefront.layouts.storefront')
@section('title', 'Contattaci — Yasser Elettronica')

@section('content')

    {{-- ===== HERO ===== --}}
    <section class="bg-gradient-to-br from-[#3B2ECA] to-[#1e1b6b] text-white py-16 md:py-24">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span
                class="inline-block bg-white/10 text-white text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-5">
                Siamo a tua disposizione
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-white leading-tight mb-6">
                Contattaci
            </h1>
            <p class="text-lg md:text-xl text-indigo-200 max-w-2xl mx-auto leading-relaxed">
                Hai una domanda, un dubbio o un problema? Il nostro team di supporto è pronto ad aiutarti 7 giorni su 7.
            </p>
        </div>
    </section>

    {{-- ===== CONTATTI + FORM ===== --}}
    <section class="bg-gray-50 py-16 md:py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-10">

                {{-- Info contatti --}}
                <div class="space-y-6">
                    <div>
                        <span class="block text-[#3B2ECA] text-xs font-bold uppercase tracking-widest mb-2">I nostri
                            recapiti</span>
                        <h2 class="text-3xl font-extrabold tracking-tight text-gray-950 mb-4">Come raggiungerci</h2>
                        <p class="text-gray-500 leading-relaxed">
                            Puoi contattarci via email, telefono o passare direttamente in negozio. Siamo disponibili du
                            lunedì al sabato dalle 9:00 alle 18:00.
                        </p>
                    </div>

                    <div class="space-y-4">
                        {{-- Email --}}
                        <div class="flex items-start gap-4 bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                            <span class="text-2xl">📧</span>
                            <div>
                                <p class="text-sm font-bold text-gray-900 mb-0.5">Email</p>
                                <a href="mailto:info@yasserelettronica.it"
                                    class="text-[#3B2ECA] text-sm font-medium hover:underline">
                                    info@yasserelettronica.it
                                </a>
                                <p class="text-xs text-gray-400 mt-1">Risposta entro 24 ore lavorative</p>
                            </div>
                        </div>

                        {{-- Telefono --}}
                        <div class="flex items-start gap-4 bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                            <span class="text-2xl">📞</span>
                            <div>
                                <p class="text-sm font-bold text-gray-900 mb-0.5">Telefono</p>
                                <a href="tel:+390212345678" class="text-[#3B2ECA] text-sm font-medium hover:underline">
                                    +39 02 1234 5678
                                </a>
                                <p class="text-xs text-gray-400 mt-1">Lun – Sab, 09:00 – 18:00</p>
                            </div>
                        </div>

                        {{-- Indirizzo --}}
                        <div class="flex items-start gap-4 bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                            <span class="text-2xl">📍</span>
                            <div>
                                <p class="text-sm font-bold text-gray-900 mb-0.5">Sede</p>
                                <p class="text-sm text-gray-600">Via della Tecnologia, 42</p>
                                <p class="text-sm text-gray-600">20124 Milano (MI), Italia</p>
                                <p class="text-xs text-gray-400 mt-1">P.IVA: IT 00000000000</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Formulaire de contact (factice) --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
                    <h3 class="text-xl font-extrabold text-gray-950 mb-6">Inviaci un messaggio</h3>
                    <form class="space-y-5" onsubmit="return false;">
                        <div class="grid sm:grid-cols-2 gap-5">
                            <div>
                                <label for="contact-nome"
                                    class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Nome</label>
                                <input id="contact-nome" type="text" placeholder="Mario"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#3B2ECA] focus:ring-2 focus:ring-[#3B2ECA]/20 transition">
                            </div>
                            <div>
                                <label for="contact-cognome"
                                    class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Cognome</label>
                                <input id="contact-cognome" type="text" placeholder="Rossi"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#3B2ECA] focus:ring-2 focus:ring-[#3B2ECA]/20 transition">
                            </div>
                        </div>
                        <div>
                            <label for="contact-email"
                                class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Email</label>
                            <input id="contact-email" type="email" placeholder="mario.rossi@email.it"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#3B2ECA] focus:ring-2 focus:ring-[#3B2ECA]/20 transition">
                        </div>
                        <div>
                            <label for="contact-oggetto"
                                class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Oggetto</label>
                            <select id="contact-oggetto"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm text-gray-700 focus:outline-none focus:border-[#3B2ECA] focus:ring-2 focus:ring-[#3B2ECA]/20 transition bg-white">
                                <option>Informazioni su un prodotto</option>
                                <option>Stato del mio ordine</option>
                                <option>Reso o rimborso</option>
                                <option>Assistenza tecnica</option>
                                <option>Altro</option>
                            </select>
                        </div>
                        <div>
                            <label for="contact-messaggio"
                                class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Messaggio</label>
                            <textarea id="contact-messaggio" rows="5" placeholder="Descrivi la tua richiesta..."
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#3B2ECA] focus:ring-2 focus:ring-[#3B2ECA]/20 transition resize-none"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full bg-[#3B2ECA] hover:bg-[#2A1FA8] text-white font-bold py-3.5 rounded-xl transition shadow-lg shadow-indigo-200 text-sm">
                            Invia il messaggio →
                        </button>
                        <p class="text-xs text-gray-400 text-center">Risponderemo entro 24 ore lavorative. I tuoi dati sono
                            trattati in conformità con la nostra
                            <a href="{{ route('storefront.privacy') }}" class="text-[#3B2ECA] hover:underline">Privacy
                                Policy</a>.
                        </p>
                    </form>
                </div>

            </div>
        </div>
    </section>

@endsection