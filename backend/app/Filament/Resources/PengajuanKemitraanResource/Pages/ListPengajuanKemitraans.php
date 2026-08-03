<?php

namespace App\Filament\Resources\PengajuanKemitraanResource\Pages;

use App\Filament\Resources\PengajuanKemitraanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengajuanKemitraans extends ListRecords
{
    protected static string $resource = PengajuanKemitraanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
