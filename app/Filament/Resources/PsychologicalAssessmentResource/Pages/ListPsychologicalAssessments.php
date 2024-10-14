<?php

namespace App\Filament\Resources\PsychologicalAssessmentResource\Pages;

use App\Filament\Resources\PsychologicalAssessmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPsychologicalAssessments extends ListRecords
{
    protected static string $resource = PsychologicalAssessmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
