<?php

namespace App\Filament\Resources\ModelTypes;

use App\Filament\Resources\ModelTypes\Pages\CreateModelType;
use App\Filament\Resources\ModelTypes\Pages\EditModelType;
use App\Filament\Resources\ModelTypes\Pages\ListModelTypes;
use App\Filament\Resources\ModelTypes\Schemas\ModelTypeForm;
use App\Filament\Resources\ModelTypes\Tables\ModelTypesTable;
use App\Models\ModelType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ModelTypeResource extends Resource
{
    protected static ?string $model = ModelType::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-tag';

    protected static string|UnitEnum|null $navigationGroup = 'Fleet Management';


    public static function form(Schema $schema): Schema
    {
        return ModelTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ModelTypesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListModelTypes::route('/'),
            'create' => CreateModelType::route('/create'),
            'edit' => EditModelType::route('/{record}/edit'),
        ];
    }
}
