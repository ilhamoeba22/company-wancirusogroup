<?php

namespace App\Filament\Resources\InvestorRequestResource\Pages;

use App\Filament\Resources\InvestorRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInvestorRequests extends ListRecords
{
    protected static string $resource = InvestorRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
