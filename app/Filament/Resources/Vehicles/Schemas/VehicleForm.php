<?php

namespace App\Filament\Resources\Vehicles\Schemas;

use App\Models\Location;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class VehicleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship(
                        name: 'category',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn($query) => $query->orderBy('sort_order')
                    )->label(__('Category'))
                    ->searchable()
                    ->required()
                    ->preload(),

                Select::make('region_id')
                    ->relationship('region', 'code')
                    ->label(__('Region'))
                    ->searchable()
                    ->required()
                    ->preload(),

                Select::make('location_id')
                    ->relationship(
                        name: 'location',
                        titleAttribute: 'name',
                        // This ensures the dropdown is sorted by the translated name in the current locale
                        modifyQueryUsing: fn(Builder $query) => $query->orderBy('name->' . app()->getLocale())
                    )
                    ->getOptionLabelFromRecordUsing(fn(Location $record) => $record->getTranslation('name', app()->getLocale()))
                    ->label(__('Location'))
                    ->searchable(['name->en', 'name->ar', 'name->fr'])
                    ->preload()

            ]);
    }
}
