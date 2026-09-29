<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PusatUnduhanResource\Pages;
use App\Models\PusatUnduhan;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class PusatUnduhanResource extends Resource
{
    protected static ?string $model = PusatUnduhan::class;
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-arrow-down-tray';
    protected static ?string $navigationLabel = 'Pusat Unduhan & Dokumen';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->label('Judul Dokumen / Brosur')
                    ->required()
                    ->maxLength(255),
                TextInput::make('kategori')
                    ->label('Kategori')
                    ->default('Brosur Perusahaan')
                    ->required()
                    ->maxLength(100),
                Textarea::make('deskripsi')
                    ->label('Deskripsi Singkat'),
                FileUpload::make('file_path')
                    ->label('Upload File Dokumen / PDF')
                    ->disk('public')
                    ->directory('dokumen')
                    ->maxSize(51200), // Max 50MB
                TextInput::make('ukuran_file')
                    ->label('Ukuran File (Otomatis/Manual)')
                    ->placeholder('Misal: 3.4 MB'),
                TextInput::make('versi')
                    ->label('Versi')
                    ->default('1.0'),
                Toggle::make('status_publish')
                    ->label('Publikasikan')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kategori')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('versi')
                    ->sortable(),
                Tables\Columns\IconColumn::make('status_publish')
                    ->label('Status Aktif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Unggah')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                EditAction::make(),
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
