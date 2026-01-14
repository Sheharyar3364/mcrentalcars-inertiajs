<?php

namespace App\Filament\Resources\Vehicles\Tables;

use Dom\Text;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class VehiclesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('make')->label(__('Make'))->searchable()->sortable(),
                TextColumn::make('model')->label(__('Model'))->searchable()->sortable(),
                TextColumn::make('year')->label(__('Year'))->sortable(),
                TextColumn::make('license_plate')->label(__('License Plate'))->searchable()->sortable(),
                TextColumn::make('vin')->label(__('VIN'))->searchable()->sortable(),
                TextColumn::make('status')->label(__('Status'))->sortable(),
                TextColumn::make('daily_rate')
                    ->label(__('Daily Rate'))
                    ->sortable()
                    ->formatStateUsing(function ($state, $record) {
                        $currency = match (strtolower($record->region?->code)) {
                            'uae'       => 'AED',
                            'uk'        => 'GBP',
                            'eu'        => 'EUR',
                            default     => 'EUR',
                        };

                        return $currency . ' ' . number_format($state, 2);
                    }),

                TextColumn::make('region.code')->label(__('Region'))->sortable()
                    ->formatStateUsing(function ($state) {
                        return strtoupper($state);
                    })
                    ->searchable(),
                TextColumn::make('location.name')->label(__('Location'))->sortable()->searchable(),
                TextColumn::make('category.name')->label(__('Category'))->sortable()->searchable(),
                TextColumn::make('created_at')->label(__('Created At'))->dateTime()->sortable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
