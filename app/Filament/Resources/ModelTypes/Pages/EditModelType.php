<?php

namespace App\Filament\Resources\ModelTypes\Pages;

use App\Filament\Resources\ModelTypes\ModelTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditModelType extends EditRecord
{
    protected static string $resource = ModelTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
