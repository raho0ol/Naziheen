<?php

namespace App\Filament\Resources\RecreationalActivityResource\Pages;

use App\Filament\Resources\RecreationalActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRecreationalActivities extends ListRecords
{
    protected static string $resource = RecreationalActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
