<?php

namespace App\Filament\Resources\Makes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MakeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('Make Name'))
                    ->required()
                    ->maxLength(255),

            ]);
    }
}
