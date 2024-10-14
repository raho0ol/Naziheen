<?php

namespace App\Filament\Resources\VocationalTrainingResource\Pages;

use App\Filament\Resources\VocationalTrainingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVocationalTrainings extends ListRecords
{
    protected static string $resource = VocationalTrainingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
