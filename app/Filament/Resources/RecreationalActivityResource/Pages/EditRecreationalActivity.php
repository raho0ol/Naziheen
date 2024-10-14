<?php

namespace App\Filament\Resources\RecreationalActivityResource\Pages;

use App\Filament\Resources\RecreationalActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRecreationalActivity extends EditRecord
{
    protected static string $resource = RecreationalActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
