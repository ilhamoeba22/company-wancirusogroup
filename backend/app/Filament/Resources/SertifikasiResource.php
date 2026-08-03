<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SertifikasiResource\Pages;
use App\Models\Sertifikasi;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\TextInput;
use Filament\Schemas\Components\Textarea;
use Filament\Schemas\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SertifikasiResource extends Resource
{
    protected static ?string $model = Sertifikasi::class;
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Sertifikasi';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_sertifikasi')->required()->maxLength(255),
                TextInput::make('diterbitkan_oleh')->required()->maxLength(255),
                TextInput::make('tahun')->maxLength(50),
                Textarea::make('deskripsi'),
                Toggle::make('tampil_publik')->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_sertifikasi')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('diterbitkan_oleh'),
                Tables\Columns\TextColumn::make('tahun'),
                Tables\Columns\IconColumn::make('tampil_publik')->boolean(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSertifikasis::route('/'),
            'create' => Pages\CreateSertifikasi::route('/create'),
            'edit' => Pages\EditSertifikasi::route('/{record}/edit'),
        ];
    }
}
