<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PusatUnduhanResource\Pages;
use App\Models\PusatUnduhan;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\TextInput;
use Filament\Schemas\Components\Textarea;
use Filament\Schemas\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PusatUnduhanResource extends Resource
{
    protected static ?string $model = PusatUnduhan::class;
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-document-arrow-down';
    protected static ?string $navigationLabel = 'Pusat Unduhan';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')->required()->maxLength(255),
                TextInput::make('kategori')->default('Holding'),
                Textarea::make('deskripsi'),
                TextInput::make('file_path')->required(),
                TextInput::make('ukuran_file'),
                TextInput::make('versi')->default('1.0'),
                Toggle::make('status_publish')->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('kategori'),
                Tables\Columns\TextColumn::make('versi'),
                Tables\Columns\IconColumn::make('status_publish')->boolean(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPusatUnduhans::route('/'),
            'create' => Pages\CreatePusatUnduhan::route('/create'),
            'edit' => Pages\EditPusatUnduhan::route('/{record}/edit'),
        ];
    }
}
