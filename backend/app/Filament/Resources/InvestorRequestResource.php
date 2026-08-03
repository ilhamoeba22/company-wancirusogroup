<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvestorRequestResource\Pages;
use App\Models\InvestorRequest;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\TextInput;
use Filament\Schemas\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InvestorRequestResource extends Resource
{
    protected static ?string $model = InvestorRequest::class;
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'Permintaan Investor';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_pemohon')->required(),
                TextInput::make('perusahaan')->required(),
                TextInput::make('jabatan')->required(),
                TextInput::make('email')->email()->required(),
                TextInput::make('telepon')->required(),
                Textarea::make('tujuan')->required(),
                TextInput::make('status')->default('Baru'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_pemohon')->searchable(),
                Tables\Columns\TextColumn::make('perusahaan')->searchable(),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('telepon'),
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
            'index' => Pages\ListInvestorRequests::route('/'),
            'create' => Pages\CreateInvestorRequest::route('/create'),
            'edit' => Pages\EditInvestorRequest::route('/{record}/edit'),
        ];
    }
}
