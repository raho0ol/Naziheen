<?php

namespace App\Filament\Resources\SpecialNeedResource\Pages;

use App\Filament\Resources\SpecialNeedResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSpecialNeed extends EditRecord
{
    protected static string $resource = SpecialNeedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
