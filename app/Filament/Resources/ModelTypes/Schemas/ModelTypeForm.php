<?php

namespace App\Filament\Resources\ModelTypes\Schemas;

use Dom\Text;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ModelTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('Model Type Name'))
                    ->required()
                    ->maxLength(255),


                Select::make('make_id')
                    ->relationship(
                        name: 'make',
                        titleAttribute: 'name'
                    )
                    ->required()
                    ->preload()

            ]);
    }
}
