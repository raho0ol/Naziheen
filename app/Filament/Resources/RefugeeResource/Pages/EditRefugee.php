<?php

namespace App\Filament\Resources\RefugeeResource\Pages;

use App\Filament\Resources\RefugeeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRefugee extends EditRecord
{
    protected static string $resource = RefugeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
