<?php

namespace App\Filament\Resources\PusatUnduhanResource\Pages;

use App\Filament\Resources\PusatUnduhanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPusatUnduhan extends EditRecord
{
    protected static string $resource = PusatUnduhanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
