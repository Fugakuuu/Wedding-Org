<?php

namespace App\Filament\Resources\KatalogPakets\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class KatalogPaketsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Nama_paket')
                    ->searchable(),
                TextColumn::make('Harga')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('Kategori')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('Admin'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
