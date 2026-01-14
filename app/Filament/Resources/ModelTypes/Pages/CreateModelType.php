<?php

namespace App\Filament\Resources\ModelTypes\Pages;

use App\Filament\Resources\ModelTypes\ModelTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateModelType extends CreateRecord
{
    protected static string $resource = ModelTypeResource::class;
}
