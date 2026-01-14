<?php

namespace App\Filament\Resources\ModelTypes\Pages;

use App\Filament\Resources\ModelTypes\ModelTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListModelTypes extends ListRecords
{
    protected static string $resource = ModelTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
