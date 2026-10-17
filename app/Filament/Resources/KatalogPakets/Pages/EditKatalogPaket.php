<?php

namespace App\Filament\Resources\KatalogPakets\Pages;

use App\Filament\Resources\KatalogPakets\KatalogPaketResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKatalogPaket extends EditRecord
{
    protected static string $resource = KatalogPaketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
