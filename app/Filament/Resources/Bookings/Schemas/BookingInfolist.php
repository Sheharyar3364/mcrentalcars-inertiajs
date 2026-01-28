<?php

namespace App\Filament\Resources\Bookings\Schemas;

use App\Models\Booking;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BookingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('booking_number'),
                TextEntry::make('user.name')
                    ->label('User'),
                TextEntry::make('vehicle.id')
                    ->label('Vehicle'),
                TextEntry::make('pickupLocation.name')
                    ->label('Pickup location'),
                TextEntry::make('returnLocation.name')
                    ->label('Return location'),
                TextEntry::make('pickup_date')
                    ->dateTime(),
                TextEntry::make('return_date')
                    ->dateTime(),
                TextEntry::make('total_days')
                    ->numeric(),
                TextEntry::make('daily_rate')
                    ->numeric(),
                TextEntry::make('base_price')
                    ->money(),
                TextEntry::make('insurance_cost')
                    ->money(),
                TextEntry::make('extras_cost')
                    ->money(),
                TextEntry::make('delivery_fee')
                    ->numeric(),
                TextEntry::make('discount_amount')
                    ->numeric(),
                TextEntry::make('taxes')
                    ->numeric(),
                TextEntry::make('total_price')
                    ->money(),
                TextEntry::make('currency'),
                TextEntry::make('insurance_type'),
                TextEntry::make('driver_name'),
                TextEntry::make('driver_email'),
                TextEntry::make('driver_phone'),
                TextEntry::make('driver_license_number'),
                TextEntry::make('driver_license_country'),
                TextEntry::make('status'),
                TextEntry::make('payment_status'),
                TextEntry::make('special_requests')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('cancellation_reason')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('cancelled_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('actual_pickup_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('actual_return_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('mileage_start')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('mileage_end')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('fuel_level_start')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('fuel_level_end')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Booking $record): bool => $record->trashed()),
            ]);
    }
}
