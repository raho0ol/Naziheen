<?php

namespace App\Filament\Resources\VocationalTrainingResource\Pages;

use App\Filament\Resources\VocationalTrainingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVocationalTraining extends EditRecord
{
    protected static string $resource = VocationalTrainingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
