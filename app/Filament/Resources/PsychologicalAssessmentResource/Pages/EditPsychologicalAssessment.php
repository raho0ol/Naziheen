<?php

namespace App\Filament\Resources\PsychologicalAssessmentResource\Pages;

use App\Filament\Resources\PsychologicalAssessmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPsychologicalAssessment extends EditRecord
{
    protected static string $resource = PsychologicalAssessmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
