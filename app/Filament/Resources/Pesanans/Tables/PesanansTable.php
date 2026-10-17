<?php

namespace App\Filament\Resources\Pesanans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PesanansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Pesanan_id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('paket.Nama_paket')
                    ->label('Paket')
                    ->searchable(),
                TextColumn::make('Nama_pemesan')
                    ->searchable(),
                TextColumn::make('Email_pemesan')
                    ->searchable(),
                TextColumn::make('Tanggal_acara')
                    ->date()
                    ->sortable(),
                TextColumn::make('Status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'confirmed',
                        'danger' => 'cancelled',
                        'gray' => 'completed',
                    ]),
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
