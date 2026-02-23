<?php

namespace App\Filament\Admin\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([

                // ID Ordine
                TextColumn::make('id')
                    ->label('#')
                    ->formatStateUsing(fn($state) => str_pad($state, 6, '0', STR_PAD_LEFT))
                    ->sortable()
                    ->searchable()
                    ->weight(\Filament\Support\Enums\FontWeight::Bold)
                    ->color('primary'),

                // Data ordine
                TextColumn::make('created_at')
                    ->label('Data')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                // Nome cliente
                TextColumn::make('guest_name')
                    ->label('Cliente')
                    ->searchable()
                    ->description(fn($record) => $record->guest_email)
                    ->limit(25),

                // Città + Provincia
                TextColumn::make('shipping_city')
                    ->label('Città')
                    ->description(fn($record) => $record->shipping_province)
                    ->toggleable(),

                // Stato con badge colorato
                TextColumn::make('status')
                    ->label('Stato')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'paid' => 'success',
                        'processing' => 'info',
                        'shipped' => 'primary',
                        'delivered' => 'success',
                        'cancelled' => 'danger',
                        'refunded' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'pending' => 'In Attesa',
                        'paid' => 'Pagato',
                        'processing' => 'In Lavorazione',
                        'shipped' => 'Spedito',
                        'delivered' => 'Consegnato',
                        'cancelled' => 'Annullato',
                        'refunded' => 'Rimborsato',
                        default => ucfirst($state),
                    })
                    ->sortable(),

                // Subtotale
                TextColumn::make('subtotal_cents')
                    ->label('Subtotale')
                    ->getStateUsing(fn($record) => number_format($record->subtotal_cents / 100, 2, ',', '.') . ' €')
                    ->alignRight()
                    ->toggleable(isToggledHiddenByDefault: true),

                // Sconto
                TextColumn::make('discount_cents')
                    ->label('Sconto')
                    ->getStateUsing(fn($record) => $record->discount_cents > 0
                        ? '- ' . number_format($record->discount_cents / 100, 2, ',', '.') . ' €'
                        : '—')
                    ->alignRight()
                    ->color('success')
                    ->toggleable(isToggledHiddenByDefault: true),

                // Totale (sempre visibile)
                TextColumn::make('total_cents')
                    ->label('Totale')
                    ->getStateUsing(fn($record) => number_format($record->total_cents / 100, 2, ',', '.') . ' €')
                    ->alignRight()
                    ->weight(\Filament\Support\Enums\FontWeight::ExtraBold)
                    ->color('warning')
                    ->sortable(),

            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Stato')
                    ->options([
                        'pending' => 'In Attesa',
                        'paid' => 'Pagato',
                        'processing' => 'In Lavorazione',
                        'shipped' => 'Spedito',
                        'delivered' => 'Consegnato',
                        'cancelled' => 'Annullato',
                        'refunded' => 'Rimborsato',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
