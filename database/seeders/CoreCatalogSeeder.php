<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CoreCatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Idempotent : utilise updateOrCreate sur les slugs/SKUs.
     */
    public function run(): void
    {
        // =====================================================
        // 1. CATÉGORIES
        // =====================================================
        $cats = [];
        $categoryData = [
            ['name' => 'Smartphone', 'slug' => 'smartphone'],
            ['name' => 'PC & Informatica', 'slug' => 'pc-informatica'],
            ['name' => 'Audio & Cuffie', 'slug' => 'audio-cuffie'],
            ['name' => 'Smartwatch', 'slug' => 'smartwatch'],
            ['name' => 'TV & Home Cinema', 'slug' => 'tv-home-cinema'],
            ['name' => 'Accessori', 'slug' => 'accessori'],
        ];

        foreach ($categoryData as $c) {
            $cats[$c['slug']] = Category::updateOrCreate(
                ['slug' => $c['slug']],
                ['name' => $c['name'], 'is_active' => true]
            );
        }

        // =====================================================
        // 2. MARQUES
        // =====================================================
        $brands = [];
        $brandNames = ['Apple', 'Samsung', 'Xiaomi', 'Sony', 'HP', 'Lenovo', 'LG', 'Bose'];

        foreach ($brandNames as $name) {
            $slug = Str::slug($name);
            $brands[$slug] = Brand::updateOrCreate(
                ['slug' => $slug],
                ['name' => $name, 'is_active' => true]
            );
        }

        // =====================================================
        // 3. PRODUITS
        // =====================================================
        $products = [

            // ── Smartphone ──────────────────────────────────

            [
                'sku' => 'IP13-128-BLK',
                'category' => 'smartphone',
                'brand' => 'apple',
                'name' => 'Apple iPhone 13 128GB',
                'condition' => 'refurbished',
                'warranty_months' => 12,
                'price_cents' => 49900,
                'vat_rate' => 22.00,
                'stock_qty' => 5,
                'short_description' => 'iPhone 13 ricondizionato grado A — 128GB, nero mezzanotte.',
                'description' => '
                    <h3>Apple iPhone 13 128GB — Ricondizionato Grado A</h3>
                    <p>Acquista il potente iPhone 13 a un prezzo imbattibile. Ricondizionato professionalmente, controllato e certificato dal nostro team tecnico.</p>
                    <ul>
                        <li>📱 Display Super Retina XDR OLED da 6,1"</li>
                        <li>⚡ Chip Apple A15 Bionic — prestazioni al top</li>
                        <li>📷 Doppia fotocamera posteriore da 12MP con modalità cinematografica</li>
                        <li>🔋 Batteria con capacità min. 85%</li>
                        <li>🛡️ Garanzia 12 mesi inclusa</li>
                    </ul>
                    <p><strong>Condizione:</strong> Ricondizionato Grado A — nessun graffio visibile, come nuovo.</p>
                ',
                'attributes' => [
                    ['attribute_key' => 'storage', 'value' => '128 GB'],
                    ['attribute_key' => 'ram', 'value' => '4 GB'],
                    ['attribute_key' => 'colore', 'value' => 'Mezzanotte'],
                    ['attribute_key' => 'display', 'value' => '6,1" OLED'],
                ],
            ],

            [
                'sku' => 'SGS23U-256-PHM',
                'category' => 'smartphone',
                'brand' => 'samsung',
                'name' => 'Samsung Galaxy S23 Ultra 256GB',
                'condition' => 'new',
                'warranty_months' => 24,
                'price_cents' => 89900,
                'vat_rate' => 22.00,
                'stock_qty' => 8,
                'short_description' => 'Galaxy S23 Ultra nuovo — 256GB, Phantom Black.',
                'description' => '
                    <h3>Samsung Galaxy S23 Ultra — Il Re degli Android</h3>
                    <p>Il Galaxy S23 Ultra ridefinisce i confini della produttività mobile con la sua S Pen integrata e una fotocamera da 200MP.</p>
                    <ul>
                        <li>📸 Fotocamera principale da 200MP con zoom ottico 10x</li>
                        <li>✏️ S Pen integrata per note e disegni precisi</li>
                        <li>⚡ Processore Snapdragon 8 Gen 2 for Galaxy</li>
                        <li>💡 Display Dynamic AMOLED 2X da 6,8" 120Hz</li>
                        <li>🔋 Batteria da 5000mAh con ricarica rapida 45W</li>
                    </ul>
                    <p><strong>Condizione:</strong> Nuovo con sigillo originale e garanzia Samsung Italia 24 mesi.</p>
                ',
                'attributes' => [
                    ['attribute_key' => 'storage', 'value' => '256 GB'],
                    ['attribute_key' => 'ram', 'value' => '12 GB'],
                    ['attribute_key' => 'colore', 'value' => 'Phantom Black'],
                    ['attribute_key' => 'display', 'value' => '6,8" Dynamic AMOLED 120Hz'],
                ],
            ],

            [
                'sku' => 'XIA13T-256-BLU',
                'category' => 'smartphone',
                'brand' => 'xiaomi',
                'name' => 'Xiaomi 13T Pro 256GB',
                'condition' => 'new',
                'warranty_months' => 24,
                'price_cents' => 59900,
                'vat_rate' => 22.00,
                'stock_qty' => 12,
                'short_description' => 'Xiaomi 13T Pro nuovo — fotocamera Leica, 256GB.',
                'description' => '
                    <h3>Xiaomi 13T Pro — Fotocamera Leica, Performance Flagship</h3>
                    <p>Il Xiaomi 13T Pro è il flagship killer per eccellenza: prestazioni da top di gamma a un prezzo aggressivo.</p>
                    <ul>
                        <li>📸 Tripla fotocamera Leica da 50MP + 50MP ultrawide + tele 50MP</li>
                        <li>⚡ MediaTek Dimensity 9200+ — velocità assoluta</li>
                        <li>🖥️ Display AMOLED 6,67" 144Hz con Dolby Vision</li>
                        <li>🔋 Batteria da 5000mAh con ricarica HyperCharge 120W</li>
                        <li>🛡️ Garanzia ufficiale Xiaomi Italia 24 mesi</li>
                    </ul>
                ',
                'attributes' => [
                    ['attribute_key' => 'storage', 'value' => '256 GB'],
                    ['attribute_key' => 'ram', 'value' => '12 GB'],
                    ['attribute_key' => 'colore', 'value' => 'Alpine Blue'],
                    ['attribute_key' => 'display', 'value' => '6,67" AMOLED 144Hz'],
                ],
            ],

            // ── PC & Informatica ────────────────────────────

            [
                'sku' => 'MBA-M1-256-SIL',
                'category' => 'pc-informatica',
                'brand' => 'apple',
                'name' => 'Apple MacBook Air M1 256GB',
                'condition' => 'refurbished',
                'warranty_months' => 12,
                'price_cents' => 75000,
                'vat_rate' => 22.00,
                'stock_qty' => 4,
                'short_description' => 'MacBook Air M1 ricondizionato — 8GB RAM, 256GB SSD.',
                'description' => '
                    <h3>Apple MacBook Air M1 — Velocità Silenziosa</h3>
                    <p>Il MacBook Air con chip M1 è uno dei laptop più efficienti mai prodotti: silenzioso, leggero e con un\'autonomia incredibile.</p>
                    <ul>
                        <li>⚡ Chip Apple M1 — CPU 8-core, GPU 7-core</li>
                        <li>🖥️ Display Retina da 13,3" con True Tone</li>
                        <li>💾 8GB RAM unificata — 256GB SSD velocissimo</li>
                        <li>🔋 Autonomia fino a 18 ore dichiarate</li>
                        <li>🔇 Design ultrasottile senza ventola — silenzioso al 100%</li>
                    </ul>
                    <p><strong>Condizione:</strong> Ricondizionato Grado A — revisione completa e garanzia 12 mesi.</p>
                ',
                'attributes' => [
                    ['attribute_key' => 'storage', 'value' => '256 GB SSD'],
                    ['attribute_key' => 'ram', 'value' => '8 GB'],
                    ['attribute_key' => 'processore', 'value' => 'Apple M1'],
                    ['attribute_key' => 'display', 'value' => '13,3" Retina'],
                ],
            ],

            [
                'sku' => 'LTP-T490-512-SIL',
                'category' => 'pc-informatica',
                'brand' => 'lenovo',
                'name' => 'Lenovo ThinkPad T490 512GB',
                'condition' => 'refurbished',
                'warranty_months' => 12,
                'price_cents' => 35000,
                'vat_rate' => 22.00,
                'stock_qty' => 6,
                'short_description' => 'ThinkPad T490 ricondizionato — Intel i5, 16GB RAM, 512GB SSD.',
                'description' => '
                    <h3>Lenovo ThinkPad T490 — Affidabilità Business al Miglior Prezzo</h3>
                    <p>Il ThinkPad T490 è il laptop business per eccellenza: robusto, veloce e con una tastiera leggendaria per la produttività.</p>
                    <ul>
                        <li>⚡ Intel Core i5-8365U quad-core</li>
                        <li>💾 16GB RAM DDR4 — 512GB SSD NVMe</li>
                        <li>🖥️ Display FHD 14" anti-riflesso</li>
                        <li>🔋 Autonomia fino a 12 ore con dual batteria</li>
                        <li>🛡️ Certificazione MIL-STD-810 — estrema robustezza</li>
                    </ul>
                    <p><strong>Condizione:</strong> Ricondizionato professionale con SSD nuovo installato.</p>
                ',
                'attributes' => [
                    ['attribute_key' => 'storage', 'value' => '512 GB SSD NVMe'],
                    ['attribute_key' => 'ram', 'value' => '16 GB DDR4'],
                    ['attribute_key' => 'processore', 'value' => 'Intel Core i5-8365U'],
                    ['attribute_key' => 'display', 'value' => '14" FHD IPS'],
                ],
            ],

            // ── Audio & Cuffie ───────────────────────────────

            [
                'sku' => 'SNY-WH1000XM5-BLK',
                'category' => 'audio-cuffie',
                'brand' => 'sony',
                'name' => 'Sony WH-1000XM5',
                'condition' => 'new',
                'warranty_months' => 24,
                'price_cents' => 29900,
                'vat_rate' => 22.00,
                'stock_qty' => 10,
                'short_description' => 'Sony WH-1000XM5 — Cuffie wireless con ANC leader di mercato.',
                'description' => '
                    <h3>Sony WH-1000XM5 — Il Miglior Noise Cancelling al Mondo</h3>
                    <p>Le WH-1000XM5 dominano il mercato delle cuffie premium con una riduzione del rumore senza precedenti e un audio Hi-Res certificato.</p>
                    <ul>
                        <li>🔇 Noise Cancelling adattivo con 8 microfoni + 2 processori dedicati</li>
                        <li>🎵 Audio Hi-Res — supporto LDAC 990kbps</li>
                        <li>🔋 Autonomia 30 ore con ANC attivo</li>
                        <li>📞 Multipoint Bluetooth — collega 2 dispositivi contemporaneamente</li>
                        <li>🗣️ Speak-to-Chat — si mette in pausa quando parli</li>
                    </ul>
                    <p><strong>Condizione:</strong> Nuovo con garanzia Sony Italia 24 mesi.</p>
                ',
                'attributes' => [
                    ['attribute_key' => 'connettività', 'value' => 'Bluetooth 5.2'],
                    ['attribute_key' => 'autonomia', 'value' => '30 ore'],
                    ['attribute_key' => 'colore', 'value' => 'Nero'],
                    ['attribute_key' => 'anc', 'value' => 'Sì — Multilivello adattivo'],
                ],
            ],

            [
                'sku' => 'APP-AIRPODSPRO2-WHT',
                'category' => 'audio-cuffie',
                'brand' => 'apple',
                'name' => 'Apple AirPods Pro 2ª gen.',
                'condition' => 'new',
                'warranty_months' => 12,
                'price_cents' => 22900,
                'vat_rate' => 22.00,
                'stock_qty' => 15,
                'short_description' => 'AirPods Pro 2 con ANC e chip H2 — audio immersivo.',
                'description' => '
                    <h3>Apple AirPods Pro 2ª Generazione — Suono Capolavoro</h3>
                    <p>Con il chip H2, gli AirPods Pro 2 portano la cancellazione attiva del rumore a un livello superiore, con Spatial Audio personalizzato e trasparenza adattiva.</p>
                    <ul>
                        <li>🔇 ANC 2x più efficace della generazione precedente</li>
                        <li>🎵 Spatial Audio con tracciamento dinamico della testa</li>
                        <li>🔋 6 ore di ascolto (30 ore totali con custodia)</li>
                        <li>💧 IPX4 — resistente all\'acqua e al sudore</li>
                        <li>⌚ Compatibile MagSafe e Apple Watch</li>
                    </ul>
                    <p><strong>Condizione:</strong> Nuovo con sigillo originale Apple.</p>
                ',
                'attributes' => [
                    ['attribute_key' => 'chip', 'value' => 'Apple H2'],
                    ['attribute_key' => 'autonomia', 'value' => '6h (30h con custodia)'],
                    ['attribute_key' => 'resistenza', 'value' => 'IPX4'],
                    ['attribute_key' => 'connettività', 'value' => 'Bluetooth 5.3'],
                ],
            ],

            // ── TV & Home Cinema ─────────────────────────────

            [
                'sku' => 'SAM-UHD55-2023',
                'category' => 'tv-home-cinema',
                'brand' => 'samsung',
                'name' => 'Samsung Crystal UHD 55" 2023',
                'condition' => 'new',
                'warranty_months' => 24,
                'price_cents' => 45000,
                'vat_rate' => 22.00,
                'stock_qty' => 7,
                'short_description' => 'Smart TV Samsung 55" Crystal 4K UHD — HDR, Tizen OS.',
                'description' => '
                    <h3>Samsung Crystal UHD 55" — 4K con Crystal Processor</h3>
                    <p>Immagini 4K brillanti, colori vividi e un sistema operativo intelligente per il tuo intrattenimento in casa.</p>
                    <ul>
                        <li>🖥️ Display Crystal UHD 4K da 55"</li>
                        <li>⚡ Processore Crystal 4K — upscaling automatico</li>
                        <li>🎮 Gaming Mode con input lag ridotto al minimo</li>
                        <li>🔊 Sistema audio Dolby Digital Plus — 20W</li>
                        <li>📱 Smart TV Tizen — Netflix, Prime, Disney+ integrati</li>
                    </ul>
                    <p><strong>Condizione:</strong> Nuovo con garanzia Samsung Italia 24 mesi.</p>
                ',
                'attributes' => [
                    ['attribute_key' => 'risoluzione', 'value' => '4K UHD (3840x2160)'],
                    ['attribute_key' => 'dimensione', 'value' => '55"'],
                    ['attribute_key' => 'sistema', 'value' => 'Tizen OS'],
                    ['attribute_key' => 'hdr', 'value' => 'HDR10+'],
                ],
            ],

            // ── Smartwatch ───────────────────────────────────

            [
                'sku' => 'APW-S8-41-MID',
                'category' => 'smartwatch',
                'brand' => 'apple',
                'name' => 'Apple Watch Series 8 41mm',
                'condition' => 'used',
                'warranty_months' => 6,
                'price_cents' => 32000,
                'vat_rate' => 22.00,
                'stock_qty' => 3,
                'short_description' => 'Apple Watch Series 8 usato — GPS, cassa alluminio mezzanotte.',
                'description' => '
                    <h3>Apple Watch Series 8 — Il Tuo Compagno di Salute</h3>
                    <p>Apple Watch Series 8 monitora la tua salute e ti mantiene connesso con un design elegante e funzionalità avanzate.</p>
                    <ul>
                        <li>❤️ Sensore di temperatura corporea + ECG + SpO2</li>
                        <li>💥 Rilevamento incidenti stradali (novità Series 8)</li>
                        <li>🏃 GPS integrato — allenamenti precisi senza iPhone</li>
                        <li>💧 Resistente all\'acqua fino a 50 metri (WR50)</li>
                        <li>🔋 Autonomia 18 ore</li>
                    </ul>
                    <p><strong>Condizione:</strong> Usato — cassa in ottime condizioni, cinturino sostituito, batteria 90%.</p>
                ',
                'attributes' => [
                    ['attribute_key' => 'dimensione', 'value' => '41mm'],
                    ['attribute_key' => 'gps', 'value' => 'Sì — integrato'],
                    ['attribute_key' => 'resistenza', 'value' => 'WR50 — 50 metri'],
                    ['attribute_key' => 'colore', 'value' => 'Mezzanotte'],
                ],
            ],

        ];

        // =====================================================
        // 4. INSERTION (idempotente)
        // =====================================================
        foreach ($products as $data) {
            $product = Product::updateOrCreate(
                ['sku' => $data['sku']],
                [
                    'category_id' => $cats[$data['category']]->id,
                    'brand_id' => $brands[$data['brand']]->id,
                    'name' => $data['name'],
                    'slug' => Str::slug($data['name']),
                    'condition' => $data['condition'],
                    'warranty_months' => $data['warranty_months'],
                    'price_cents' => $data['price_cents'],
                    'vat_rate' => $data['vat_rate'],
                    'stock_qty' => $data['stock_qty'],
                    'is_active' => true,
                    'short_description' => $data['short_description'],
                    'description' => trim($data['description']),
                ]
            );

            // Nettoyer les images et attributs existants
            $product->images()->delete();
            $product->attributes()->delete();

            // Insérer les attributs
            foreach ($data['attributes'] as $i => $attr) {
                ProductAttribute::create([
                    'product_id' => $product->id,
                    'attribute_key' => $attr['attribute_key'],
                    'value' => $attr['value'],
                    'sort_order' => $i,
                ]);
            }
        }

        $this->command->info('✅ CoreCatalogSeeder : ' . count($categoryData) . ' catégories, ' . count($brandNames) . ' marques, ' . count($products) . ' produits insérés avec succès.');
    }
}
