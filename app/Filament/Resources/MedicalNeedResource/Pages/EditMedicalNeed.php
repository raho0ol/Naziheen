<?php

namespace App\Filament\Resources\MedicalNeedResource\Pages;

use App\Filament\Resources\MedicalNeedResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMedicalNeed extends EditRecord
{
    protected static string $resource = MedicalNeedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
