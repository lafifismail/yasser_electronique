<?php

namespace App\Filament\Admin\Resources\Orders\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label('User')
                    ->placeholder('-'),
                TextEntry::make('guest_name')
                    ->placeholder('-'),
                TextEntry::make('guest_email')
                    ->placeholder('-'),
                TextEntry::make('guest_phone')
                    ->placeholder('-'),
                TextEntry::make('shipping_street')
                    ->placeholder('-'),
                TextEntry::make('shipping_city')
                    ->placeholder('-'),
                TextEntry::make('shipping_postal_code')
                    ->placeholder('-'),
                TextEntry::make('shipping_province')
                    ->placeholder('-'),
                TextEntry::make('notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('discount_cents')
                    ->numeric(),
                TextEntry::make('status'),
                TextEntry::make('subtotal_cents')
                    ->numeric(),
                TextEntry::make('vat_cents')
                    ->numeric(),
                TextEntry::make('shipping_cents')
                    ->numeric(),
                TextEntry::make('total_cents')
                    ->numeric(),
                TextEntry::make('billingAddress.id')
                    ->label('Billing address')
                    ->placeholder('-'),
                TextEntry::make('shippingAddress.id')
                    ->label('Shipping address')
                    ->placeholder('-'),
                TextEntry::make('customer_type'),
                TextEntry::make('codice_fiscale')
                    ->placeholder('-'),
                TextEntry::make('partita_iva')
                    ->placeholder('-'),
                TextEntry::make('sdi_code')
                    ->placeholder('-'),
                TextEntry::make('pec_email')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
