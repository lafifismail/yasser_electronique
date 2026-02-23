@extends('storefront.layouts.storefront')
@section('title', 'Informativa sulla Privacy — Yasser Elettronica')

@section('content')

    {{-- ===== HERO ===== --}}
    <section class="bg-gradient-to-br from-[#3B2ECA] to-[#1e1b6b] text-white py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span
                class="inline-block bg-white/10 text-white text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-5">
                Documento legale
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-white leading-tight mb-4">
                Informativa sulla Privacy
            </h1>
            <p class="text-indigo-200 text-base">Ultimo aggiornamento: {{ date('d/m/Y') }} — ai sensi del Regolamento UE
                2016/679 (GDPR)</p>
        </div>
    </section>

    {{-- ===== CONTENUTO ===== --}}
    <section class="bg-white py-14">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-gray max-w-none space-y-8 text-gray-700 leading-relaxed text-sm">

                <div class="bg-[#3B2ECA]/5 border border-[#3B2ECA]/20 rounded-2xl p-5 mb-8">
                    <p class="text-sm text-gray-700">
                        La presente Informativa descrive le modalità di trattamento dei dati personali degli utenti che
                        consultano e utilizzano il sito web <strong>yasserelettronica.it</strong>, gestito da <strong>Yasser
                            Elettronica</strong>, con sede in Via della Tecnologia, 42 — 20124 Milano (MI), P.IVA IT
                        00000000000.
                    </p>
                </div>

                <div>
                    <h2 class="text-xl font-extrabold text-gray-950 tracking-tight mb-3">1. Titolare del Trattamento</h2>
                    <p>Il Titolare del Trattamento è <strong>Yasser Elettronica</strong>, raggiungibile all'indirizzo email
                        <a href="mailto:privacy@yasserelettronica.it"
                            class="text-[#3B2ECA] hover:underline">privacy@yasserelettronica.it</a>.</p>
                </div>

                <div>
                    <h2 class="text-xl font-extrabold text-gray-950 tracking-tight mb-3">2. Dati Trattati e Finalità</h2>
                    <p class="mb-3">Raccogliamo e trattiamo le seguenti categorie di dati personali:</p>
                    <ul class="list-disc pl-5 space-y-2">
                        <li><strong>Dati di navigazione:</strong> indirizzo IP, tipo di browser, pagine visitate, orario di
                            accesso — raccolti in modo automatico per finalità statistiche e di sicurezza.</li>
                        <li><strong>Dati forniti volontariamente:</strong> nome, cognome, indirizzo email, numero di
                            telefono, indirizzo di spedizione, forniti durante la registrazione, l'acquisto o la
                            compilazione del modulo di contatto.</li>
                        <li><strong>Dati di pagamento:</strong> gestiti in modo sicuro tramite provider certificati PCI-DSS.
                            Yasser Elettronica non memorizza i dati della carta di credito.</li>
                    </ul>
                    <p class="mt-3">Le finalità del trattamento sono: gestione degli ordini e spedizioni, supporto clienti,
                        invio di comunicazioni commerciali (previo consenso), adempimento di obblighi legali e fiscali.</p>
                </div>

                <div>
                    <h2 class="text-xl font-extrabold text-gray-950 tracking-tight mb-3">3. Base Giuridica del Trattamento
                    </h2>
                    <p>Il trattamento è fondato sulle seguenti basi giuridiche ai sensi dell'art. 6 GDPR:</p>
                    <ul class="list-disc pl-5 mt-2 space-y-1">
                        <li>Esecuzione di un contratto (ordini di acquisto).</li>
                        <li>Adempimento di obblighi legali (fatturazione, contabilità).</li>
                        <li>Legittimo interesse del Titolare (prevenzione frodi, sicurezza).</li>
                        <li>Consenso dell'interessato (newsletter, marketing).</li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-xl font-extrabold text-gray-950 tracking-tight mb-3">4. Conservazione dei Dati</h2>
                    <p>I dati personali sono conservati per il tempo strettamente necessario al raggiungimento delle
                        finalità per cui sono stati raccolti e nel rispetto dei termini di conservazione imposti dalla legge
                        (ex.: 10 anni per i documenti fiscali). I dati per finalità di marketing sono conservati fino alla
                        revoca del consenso.</p>
                </div>

                <div>
                    <h2 class="text-xl font-extrabold text-gray-950 tracking-tight mb-3">5. Comunicazione e Diffusione</h2>
                    <p>I dati non vengono ceduti a terzi a fini commerciali. Possono essere comunicati a soggetti terzi
                        esclusivamente per l'erogazione dei servizi acquistati (es. corrieri, provider di pagamento) oppure
                        su richiesta dell'autorità giudiziaria.</p>
                </div>

                <div>
                    <h2 class="text-xl font-extrabold text-gray-950 tracking-tight mb-3">6. Cookie</h2>
                    <p>Il sito utilizza cookie tecnici necessari al funzionamento e, previo consenso, cookie analitici e di
                        profilazione. Per maggiori informazioni consulta la nostra <strong>Cookie Policy</strong>
                        accessibile dal banner al primo accesso al sito.</p>
                </div>

                <div>
                    <h2 class="text-xl font-extrabold text-gray-950 tracking-tight mb-3">7. Diritti dell'Interessato</h2>
                    <p class="mb-2">Ai sensi degli artt. 15–22 GDPR, hai il diritto di:</p>
                    <ul class="list-disc pl-5 space-y-1">
                        <li>Accedere ai tuoi dati personali (<em>diritto di accesso</em>)</li>
                        <li>Ottenerne la rettifica o l'aggiornamento</li>
                        <li>Richiederne la cancellazione (<em>diritto all'oblio</em>)</li>
                        <li>Opporti al trattamento o richiederne la limitazione</li>
                        <li>Richiedere la portabilità dei dati</li>
                        <li>Revocare il consenso in qualsiasi momento</li>
                    </ul>
                    <p class="mt-3">Per esercitare i tuoi diritti, invia una richiesta a: <a
                            href="mailto:privacy@yasserelettronica.it"
                            class="text-[#3B2ECA] hover:underline">privacy@yasserelettronica.it</a>. Hai altresì il diritto
                        di proporre reclamo al Garante per la Protezione dei Dati Personali (<a
                            href="https://www.garanteprivacy.it" target="_blank"
                            class="text-[#3B2ECA] hover:underline">www.garanteprivacy.it</a>).</p>
                </div>

                <div>
                    <h2 class="text-xl font-extrabold text-gray-950 tracking-tight mb-3">8. Modifiche alla Presente
                        Informativa</h2>
                    <p>Yasser Elettronica si riserva il diritto di modificare la presente Informativa in qualsiasi momento.
                        Le modifiche saranno pubblicate su questa pagina con indicazione della data di aggiornamento. Si
                        invita a consultarla periodicamente.</p>
                </div>

            </div>
        </div>
    </section>

@endsection