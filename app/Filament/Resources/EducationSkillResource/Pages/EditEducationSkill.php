<?php

namespace App\Filament\Resources\EducationSkillResource\Pages;

use App\Filament\Resources\EducationSkillResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEducationSkill extends EditRecord
{
    protected static string $resource = EducationSkillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
