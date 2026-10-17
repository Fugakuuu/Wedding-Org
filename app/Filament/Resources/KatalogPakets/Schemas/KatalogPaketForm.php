<?php

namespace App\Filament\Resources\KatalogPakets\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class KatalogPaketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('Nama_paket')
                    ->required(),
                TextInput::make('Harga')
                    ->required()
                    ->numeric(),
                Textarea::make('Dekripsi_pkt')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('Kategori')
                    ->default(null),
                Hidden::make('Admin_id')
                    ->default(Auth::id()),
            ]);
    }
}
