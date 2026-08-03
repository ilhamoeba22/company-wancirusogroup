<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UnitUsahaResource\Pages;
use App\Models\UnitUsaha;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\TextInput;
use Filament\Schemas\Components\Textarea;
use Filament\Schemas\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UnitUsahaResource extends Resource
{
    protected static ?string $model = UnitUsaha::class;
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Unit Usaha';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_unit')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Textarea::make('deskripsi_umum'),
                Textarea::make('keunggulan'),
                Textarea::make('target_pasar'),
                TextInput::make('urutan_tampil')
                    ->numeric()
                    ->default(0),
                Toggle::make('status_publish')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_unit')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('urutan_tampil')->sortable(),
                Tables\Columns\IconColumn::make('status_publish')->boolean(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUnitUsahas::route('/'),
            'create' => Pages\CreateUnitUsaha::route('/create'),
            'edit' => Pages\EditUnitUsaha::route('/{record}/edit'),
        ];
    }
}
