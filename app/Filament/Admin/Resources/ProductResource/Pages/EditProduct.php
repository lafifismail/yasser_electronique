<?php

namespace App\Filament\Admin\Resources\ProductResource\Pages;

use App\Filament\Admin\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Convertir price_cents en price_eur pour l'affichage
        if (isset($data['price_cents'])) {
            $data['price_eur'] = $data['price_cents'] / 100;
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Assurer que price_cents est défini
        if (!isset($data['price_cents']) && isset($data['price_eur'])) {
            $data['price_cents'] = (int) round((float) $data['price_eur'] * 100);
        }

        // Retirer price_eur car ce n'est pas une colonne DB
        unset($data['price_eur']);

        return $data;
    }
}
