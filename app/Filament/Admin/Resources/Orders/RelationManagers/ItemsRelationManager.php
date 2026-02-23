<?php

namespace App\Filament\Admin\Resources\Orders\RelationManagers;

use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $title = 'Articoli dell\'Ordine';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('sku')
                ->required()
                ->maxLength(100),
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('qty')
                ->required()
                ->numeric()
                ->minValue(1),
            TextInput::make('unit_price_cents')
                ->required()
                ->numeric()
                ->label('Prezzo Unitario (centesimi)'),
            TextInput::make('vat_rate')
                ->required()
                ->numeric()
                ->label('IVA %')
                ->default(22),
            TextInput::make('line_total_cents')
                ->required()
                ->numeric()
                ->label('Totale Riga (centesimi)'),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->defaultSort('id', 'asc')
            ->columns([
                TextColumn::make('sku')
                    ->label('SKU')
                    ->badge()
                    ->color('gray')
                    ->copyable(),
                TextColumn::make('name')
                    ->label('Prodotto')
                    ->searchable()
                    ->limit(40),
                TextColumn::make('qty')
                    ->label('Qtà')
                    ->alignCenter()
                    ->badge()
                    ->color('info'),
                TextColumn::make('unit_price_cents')
                    ->label('Prezzo Unit.')
                    ->getStateUsing(fn($record) => number_format($record->unit_price_cents / 100, 2, ',', '.') . ' €')
                    ->alignRight(),
                TextColumn::make('vat_rate')
                    ->label('IVA')
                    ->getStateUsing(fn($record) => $record->vat_rate . '%')
                    ->alignCenter()
                    ->color('gray'),
                TextColumn::make('line_total_cents')
                    ->label('Totale Riga')
                    ->getStateUsing(fn($record) => number_format($record->line_total_cents / 100, 2, ',', '.') . ' €')
                    ->alignRight()
                    ->weight(\Filament\Support\Enums\FontWeight::Bold)
                    ->color('primary'),
            ])
            ->paginated(false);
    }
}
