<?php

namespace App\Filament\Resources\UnitUsahaResource\Pages;

use App\Filament\Resources\UnitUsahaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUnitUsaha extends EditRecord
{
    protected static string $resource = UnitUsahaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
