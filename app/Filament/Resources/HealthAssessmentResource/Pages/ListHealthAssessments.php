<?php

namespace App\Filament\Resources\HealthAssessmentResource\Pages;

use App\Filament\Resources\HealthAssessmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHealthAssessments extends ListRecords
{
    protected static string $resource = HealthAssessmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
