@extends('storefront.layouts.storefront')
@section('title', 'Politica di Rimborso e Resi — Yasser Elettronica')

@section('content')

    {{-- ===== HERO ===== --}}
    <section class="bg-gradient-to-br from-[#3B2ECA] to-[#1e1b6b] text-white py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span
                class="inline-block bg-white/10 text-white text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-5">
                I tuoi diritti
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-white leading-tight mb-4">
                Politica di Rimborso e Resi
            </h1>
            <p class="text-indigo-200 text-base">Acquista in tutta tranquillità — reso gratuito entro 14 giorni
                dall'acquisto</p>
        </div>
    </section>

    {{-- ===== HIGHLIGHTS ===== --}}
    <section class="bg-gray-50 border-b border-gray-100 py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid sm:grid-cols-3 gap-6">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 text-center">
                    <span class="text-3xl mb-3 block">📦</span>
                    <p class="font-bold text-gray-900 mb-1">Reso entro 14 giorni</p>
                    <p class="text-xs text-gray-500">Dal giorno di ricezione del prodotto</p>
                </div>
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 text-center">
                    <span class="text-3xl mb-3 block">💳</span>
                    <p class="font-bold text-gray-900 mb-1">Rimborso completo</p>
                    <p class="text-xs text-gray-500">Entro 5–10 giorni lavorativi</p>
                </div>
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 text-center">
                    <span class="text-3xl mb-3 block">🛡️</span>
                    <p class="font-bold text-gray-900 mb-1">Prodotti difettosi</p>
                    <p class="text-xs text-gray-500">Sostituzione o rimborso immediato</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== CONTENUTO ===== --}}
    <section class="bg-white py-14">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-8 text-gray-700 leading-relaxed text-sm">

                <div>
                    <h2 class="text-xl font-extrabold text-gray-950 tracking-tight mb-3">1. Diritto di Recesso</h2>
                    <p>Ai sensi del Codice del Consumo italiano (D.Lgs. 206/2005) e della Direttiva Europea 2011/83/UE, hai
                        il diritto di recedere dal contratto di acquisto entro <strong>14 giorni</strong> senza dover
                        fornire alcuna giustificazione.</p>
                    <p class="mt-2">Il periodo di recesso decorre dal giorno in cui tu (o un terzo da te designato)
                        acquisisci il possesso fisico dei beni ordinati.</p>
                </div>

                <div>
                    <h2 class="text-xl font-extrabold text-gray-950 tracking-tight mb-3">2. Come Effettuare un Reso</h2>
                    <p class="mb-3">Per esercitare il diritto di recesso, segui questi semplici passaggi:</p>
                    <ol class="list-decimal pl-5 space-y-2">
                        <li>Invia una email a <a href="mailto:resi@yasserelettronica.it"
                                class="text-[#3B2ECA] hover:underline">resi@yasserelettronica.it</a> indicando il numero
                            d'ordine e il motivo del reso (facoltativo).</li>
                        <li>Riceverai entro 24 ore un'email di conferma con le istruzioni e l'etichetta di reso prepagata.
                        </li>
                        <li>Imballa il prodotto nella confezione originale (o in una equivalente), includi tutti gli
                            accessori e documenti originali.</li>
                        <li>Consegna il pacco al corriere indicato nella email di conferma.</li>
                        <li>Una volta ricevuto e verificato il prodotto, procederemo al rimborso entro 5–10 giorni
                            lavorativi.</li>
                    </ol>
                </div>

                <div>
                    <h2 class="text-xl font-extrabold text-gray-950 tracking-tight mb-3">3. Condizioni per il Reso</h2>
                    <p class="mb-2">Per essere accettato, il prodotto restituito deve:</p>
                    <ul class="list-disc pl-5 space-y-1">
                        <li>Essere in condizioni integre, non danneggiato e non manomesso</li>
                        <li>Essere nella confezione originale (o equivalente) con tutti gli accessori inclusi</li>
                        <li>Non presentare segni evidenti di utilizzo prolungato</li>
                        <li>Essere restituito entro <strong>14 giorni</strong> dalla comunicazione del recesso</li>
                    </ul>
                    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mt-4">
                        <p class="text-xs font-semibold text-amber-800">⚠️ Nota: I prodotti sigillati (es. software,
                            contenuti digitali) non sono restituibili se il sigillo è stato rotto, salvo difetti di
                            conformità.</p>
                    </div>
                </div>

                <div>
                    <h2 class="text-xl font-extrabold text-gray-950 tracking-tight mb-3">4. Rimborso</h2>
                    <p>Il rimborso viene effettuato utilizzando lo stesso metodo di pagamento utilizzato per l'acquisto
                        originale, salvo diverso accordo. Non è previsto alcun costo aggiuntivo per il rimborso.</p>
                    <p class="mt-2">I tempi di rimborso dipendono dal metodo di pagamento:</p>
                    <ul class="list-disc pl-5 mt-2 space-y-1">
                        <li><strong>Carta di credito/debito:</strong> 5–10 giorni lavorativi</li>
                        <li><strong>PayPal:</strong> 3–5 giorni lavorativi</li>
                        <li><strong>Bonifico bancario:</strong> 5–7 giorni lavorativi</li>
                        <li><strong>Contrassegno:</strong> rimborso tramite bonifico entro 10 giorni lavorativi</li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-xl font-extrabold text-gray-950 tracking-tight mb-3">5. Prodotti Difettosi o Non
                        Conformi</h2>
                    <p>In caso di prodotto difettoso o non conforme alla descrizione, hai diritto alla riparazione,
                        sostituzione, riduzione del prezzo o rimborso completo ai sensi della garanzia legale di conformità
                        (art. 130 D.Lgs. 206/2005). Contattaci immediatamente a <a
                            href="mailto:assistenza@yasserelettronica.it"
                            class="text-[#3B2ECA] hover:underline">assistenza@yasserelettronica.it</a> allegando foto del
                        prodotto e del difetto riscontrato.</p>
                </div>

                <div>
                    <h2 class="text-xl font-extrabold text-gray-950 tracking-tight mb-3">6. Eccezioni al Diritto di Recesso
                    </h2>
                    <p class="mb-2">Ai sensi dell'art. 59 del Codice del Consumo, il diritto di recesso non si applica a:
                    </p>
                    <ul class="list-disc pl-5 space-y-1">
                        <li>Beni confezionati su misura o chiaramente personalizzati</li>
                        <li>Beni che rischiano di deteriorarsi rapidamente</li>
                        <li>Contenuti digitali forniti su supporto non materiale la cui esecuzione sia già iniziata</li>
                        <li>Software con sigillo di garanzia rimosso</li>
                    </ul>
                </div>

                <div class="bg-[#3B2ECA]/5 border border-[#3B2ECA]/20 rounded-2xl p-5">
                    <h3 class="font-bold text-[#3B2ECA] mb-2">Hai bisogno di aiuto?</h3>
                    <p class="text-sm text-gray-600">Il nostro team di supporto è pronto ad assisterti. Contattaci su
                        <a href="mailto:resi@yasserelettronica.it"
                            class="text-[#3B2ECA] font-semibold hover:underline">resi@yasserelettronica.it</a>
                        oppure chiama il <a href="tel:+390212345678"
                            class="text-[#3B2ECA] font-semibold hover:underline">+39 02 1234 5678</a> (Lun–Sab,
                        09:00–18:00).
                    </p>
                </div>

            </div>
        </div>
    </section>

@endsection