<?php

namespace App\Filament\Resources\FamilyRelationResource\Pages;

use App\Filament\Resources\FamilyRelationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFamilyRelations extends ListRecords
{
    protected static string $resource = FamilyRelationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
