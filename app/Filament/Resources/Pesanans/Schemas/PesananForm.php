<?php

namespace App\Filament\Resources\Pesanans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PesananForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('Paket_id')
                    ->relationship('paket', 'Nama_paket')
                    ->required()
                    ->disabled(fn ($record) => $record !== null),
                TextInput::make('Nama_pemesan')
                    ->required()
                    ->disabled(fn ($record) => $record !== null),
                TextInput::make('Email_pemesan')
                    ->required()
                    ->disabled(fn ($record) => $record !== null),
                TextInput::make('No_WA')
                    ->default(null)
                    ->disabled(fn ($record) => $record !== null),
                DatePicker::make('Tanggal_acara')
                    ->required()
                    ->disabled(fn ($record) => $record !== null),
                Textarea::make('Catatan')
                    ->default(null)
                    ->columnSpanFull()
                    ->disabled(fn ($record) => $record !== null),
                Select::make('Status')
                    ->required()
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                        'completed' => 'Completed',
                    ])
                    ->default('pending'),
            ]);
    }
}
