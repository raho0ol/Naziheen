<?php

namespace App\Filament\Resources\JobOpportunityResource\Pages;

use App\Filament\Resources\JobOpportunityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJobOpportunities extends ListRecords
{
    protected static string $resource = JobOpportunityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
