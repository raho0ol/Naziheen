<?php

namespace App\Filament\Resources\FinancialAidResource\Pages;

use App\Filament\Resources\FinancialAidResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFinancialAids extends ListRecords
{
    protected static string $resource = FinancialAidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
