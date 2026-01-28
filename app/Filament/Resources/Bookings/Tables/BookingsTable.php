<?php

namespace App\Filament\Resources\Bookings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class BookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('booking_number')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->searchable(),
                TextColumn::make('vehicle.id')
                    ->searchable(),
                TextColumn::make('pickupLocation.name')
                    ->searchable(),
                TextColumn::make('returnLocation.name')
                    ->searchable(),
                TextColumn::make('pickup_date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('return_date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('total_days')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('daily_rate')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('base_price')
                    ->money()
                    ->sortable(),
                TextColumn::make('insurance_cost')
                    ->money()
                    ->sortable(),
                TextColumn::make('extras_cost')
                    ->money()
                    ->sortable(),
                TextColumn::make('delivery_fee')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('discount_amount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('taxes')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_price')
                    ->money()
                    ->sortable(),
                TextColumn::make('currency')
                    ->searchable(),
                TextColumn::make('insurance_type')
                    ->searchable(),
                TextColumn::make('driver_name')
                    ->searchable(),
                TextColumn::make('driver_email')
                    ->searchable(),
                TextColumn::make('driver_phone')
                    ->searchable(),
                TextColumn::make('driver_license_number')
                    ->searchable(),
                TextColumn::make('driver_license_country')
                    ->searchable(),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('payment_status')
                    ->searchable(),
                TextColumn::make('cancelled_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('actual_pickup_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('actual_return_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('mileage_start')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('mileage_end')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('fuel_level_start')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('fuel_level_end')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
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
