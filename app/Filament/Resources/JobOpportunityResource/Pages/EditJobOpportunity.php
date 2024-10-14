<?php

namespace App\Filament\Resources\JobOpportunityResource\Pages;

use App\Filament\Resources\JobOpportunityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJobOpportunity extends EditRecord
{
    protected static string $resource = JobOpportunityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
