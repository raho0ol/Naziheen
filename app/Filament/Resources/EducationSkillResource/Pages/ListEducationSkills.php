<?php

namespace App\Filament\Resources\EducationSkillResource\Pages;

use App\Filament\Resources\EducationSkillResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEducationSkills extends ListRecords
{
    protected static string $resource = EducationSkillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
