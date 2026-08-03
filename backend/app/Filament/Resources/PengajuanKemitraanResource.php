<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengajuanKemitraanResource\Pages;
use App\Models\PengajuanKemitraan;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\TextInput;
use Filament\Schemas\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PengajuanKemitraanResource extends Resource
{
    protected static ?string $model = PengajuanKemitraan::class;
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationLabel = 'Pesan Kemitraan';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_pengirim')->required(),
                TextInput::make('perusahaan')->required(),
                TextInput::make('email')->email()->required(),
                TextInput::make('telepon')->required(),
                TextInput::make('unit_usaha_dituju'),
                Textarea::make('pesan')->required(),
                TextInput::make('status')->default('Baru'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_pengirim')->searchable(),
                Tables\Columns\TextColumn::make('perusahaan')->searchable(),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('unit_usaha_dituju'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengajuanKemitraans::route('/'),
            'create' => Pages\CreatePengajuanKemitraan::route('/create'),
            'edit' => Pages\EditPengajuanKemitraan::route('/{record}/edit'),
        ];
    }
}
