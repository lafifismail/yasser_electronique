<?php

namespace App\Filament\Admin\Resources\Orders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            // ──────────────────────────────────────────
            // SEZIONE 1 — Dati Cliente
            // ──────────────────────────────────────────
            Section::make('👤 Dati Cliente')
                ->icon('heroicon-o-user')
                ->columns(2)
                ->schema([
                    TextInput::make('guest_name')
                        ->label('Nome e Cognome')
                        ->disabled()
                        ->dehydrated(false),

                    TextInput::make('guest_email')
                        ->label('Email')
                        ->disabled()
                        ->dehydrated(false),

                    TextInput::make('guest_phone')
                        ->label('Telefono')
                        ->disabled()
                        ->dehydrated(false),

                    TextInput::make('codice_fiscale')
                        ->label('Codice Fiscale / P.IVA')
                        ->disabled()
                        ->dehydrated(false),
                ]),

            // ──────────────────────────────────────────
            // SEZIONE 2 — Indirizzo di Spedizione
            // ──────────────────────────────────────────
            Section::make('🚚 Indirizzo di Spedizione')
                ->icon('heroicon-o-map-pin')
                ->columns(3)
                ->schema([
                    TextInput::make('shipping_street')
                        ->label('Via e Civico')
                        ->disabled()
                        ->dehydrated(false)
                        ->columnSpan(2),

                    TextInput::make('shipping_postal_code')
                        ->label('CAP')
                        ->disabled()
                        ->dehydrated(false),

                    TextInput::make('shipping_city')
                        ->label('Città')
                        ->disabled()
                        ->dehydrated(false)
                        ->columnSpan(2),

                    TextInput::make('shipping_province')
                        ->label('Provincia')
                        ->disabled()
                        ->dehydrated(false),

                    Textarea::make('notes')
                        ->label('Note')
                        ->disabled()
                        ->dehydrated(false)
                        ->columnSpanFull()
                        ->rows(2),
                ]),

            // ──────────────────────────────────────────
            // SEZIONE 3 — Stato Ordine (MODIFICABILE)
            // ──────────────────────────────────────────
            Section::make('📋 Gestione Ordine')
                ->icon('heroicon-o-adjustments-horizontal')
                ->columns(2)
                ->schema([
                    Select::make('status')
                        ->label('Stato')
                        ->required()
                        ->options([
                            'pending' => '⏳ In Attesa',
                            'paid' => '✅ Pagato',
                            'processing' => '🔧 In Lavorazione',
                            'shipped' => '📦 Spedito',
                            'delivered' => '🏠 Consegnato',
                            'cancelled' => '❌ Annullato',
                            'refunded' => '↩️ Rimborsato',
                        ])
                        ->native(false),

                    TextInput::make('customer_type')
                        ->label('Tipo Cliente')
                        ->disabled()
                        ->dehydrated(false),
                ]),

            // ──────────────────────────────────────────
            // SEZIONE 4 — Riepilogo Economico (read-only)
            // ──────────────────────────────────────────
            Section::make('💶 Riepilogo Economico')
                ->icon('heroicon-o-calculator')
                ->columns(4)
                ->schema([
                    TextInput::make('subtotal_cents')
                        ->label('Subtotale')
                        ->formatStateUsing(fn($state) => number_format(($state ?? 0) / 100, 2, ',', '.') . ' €')
                        ->disabled()
                        ->dehydrated(false),

                    TextInput::make('discount_cents')
                        ->label('Sconto')
                        ->formatStateUsing(fn($state) => '- ' . number_format(($state ?? 0) / 100, 2, ',', '.') . ' €')
                        ->disabled()
                        ->dehydrated(false),

                    TextInput::make('shipping_cents')
                        ->label('Spedizione')
                        ->formatStateUsing(fn($state) => number_format(($state ?? 0) / 100, 2, ',', '.') . ' €')
                        ->disabled()
                        ->dehydrated(false),

                    TextInput::make('total_cents')
                        ->label('TOTALE')
                        ->formatStateUsing(fn($state) => number_format(($state ?? 0) / 100, 2, ',', '.') . ' €')
                        ->disabled()
                        ->dehydrated(false),
                ]),

        ]);
    }
}
