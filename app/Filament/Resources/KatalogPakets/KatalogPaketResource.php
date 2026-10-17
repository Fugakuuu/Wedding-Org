<?php

namespace App\Filament\Resources\KatalogPakets;

use App\Filament\Resources\KatalogPakets\Pages\CreateKatalogPaket;
use App\Filament\Resources\KatalogPakets\Pages\EditKatalogPaket;
use App\Filament\Resources\KatalogPakets\Pages\ListKatalogPakets;
use App\Filament\Resources\KatalogPakets\Schemas\KatalogPaketForm;
use App\Filament\Resources\KatalogPakets\Tables\KatalogPaketsTable;
use App\Models\KatalogPaket;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KatalogPaketResource extends Resource
{
    protected static ?string $model = KatalogPaket::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return KatalogPaketForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KatalogPaketsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListKatalogPakets::route('/'),
            'create' => CreateKatalogPaket::route('/create'),
            'edit' => EditKatalogPaket::route('/{record}/edit'),
        ];
    }
}
