<?php

namespace App\Filament\Admin\Resources\ProductResource\Pages;

use App\Filament\Admin\Resources\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
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
