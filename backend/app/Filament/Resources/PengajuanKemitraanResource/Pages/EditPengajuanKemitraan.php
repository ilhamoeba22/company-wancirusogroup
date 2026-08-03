<?php

namespace App\Filament\Resources\PengajuanKemitraanResource\Pages;

use App\Filament\Resources\PengajuanKemitraanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengajuanKemitraan extends EditRecord
{
    protected static string $resource = PengajuanKemitraanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
