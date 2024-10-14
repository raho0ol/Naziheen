<?php

namespace App\Filament\Resources\HealthAssessmentResource\Pages;

use App\Filament\Resources\HealthAssessmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHealthAssessment extends EditRecord
{
    protected static string $resource = HealthAssessmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
