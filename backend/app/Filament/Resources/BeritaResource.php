<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeritaResource\Pages;
use App\Models\Berita;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\TextInput;
use Filament\Schemas\Components\Textarea;
use Filament\Schemas\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BeritaResource extends Resource
{
    protected static ?string $model = Berita::class;
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationLabel = 'Berita & Media';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')->required()->maxLength(255),
                TextInput::make('slug')->required()->maxLength(255),
                TextInput::make('kategori')->default('Korporat'),
                Textarea::make('ringkasan'),
                Textarea::make('isi'),
                Toggle::make('status_publish')->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('kategori'),
                Tables\Columns\IconColumn::make('status_publish')->boolean(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBeritas::route('/'),
            'create' => Pages\CreateBerita::route('/create'),
            'edit' => Pages\EditBerita::route('/{record}/edit'),
        ];
    }
}
