<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('booking_number')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('vehicle_id')
                    ->relationship('vehicle', 'make')
                    ->searchable()
                    ->required()
                    ->preload(),
                Select::make('pickup_location_id')
                    ->relationship(
                        name: 'pickupLocation',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn($query) =>
                        $query->orderByName()
                    )
                    ->required(),

                // Select::make('return_location_id')
                //     ->relationship('returnLocation', 'name')
                //     ->required(),

                Select::make('return_location_id')
                    ->relationship(
                        name: 'returnLocation',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn($query) =>
                        $query->orderByName()
                    )
                    ->required(),

                DateTimePicker::make('pickup_date')
                    ->required(),
                DateTimePicker::make('return_date')
                    ->required(),
                TextInput::make('total_days')
                    ->required()
                    ->numeric(),
                TextInput::make('daily_rate')
                    ->required()
                    ->numeric(),
                TextInput::make('base_price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('insurance_cost')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->prefix('$'),
                TextInput::make('extras_cost')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->prefix('$'),
                TextInput::make('delivery_fee')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('discount_amount')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('taxes')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('total_price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('currency')
                    ->required()
                    ->default('EUR'),
                TextInput::make('insurance_type')
                    ->required()
                    ->default('basic'),
                TextInput::make('extras'),
                TextInput::make('driver_name')
                    ->required(),
                TextInput::make('driver_email')
                    ->email()
                    ->required(),
                TextInput::make('driver_phone')
                    ->tel()
                    ->required(),
                TextInput::make('driver_license_number')
                    ->required(),
                TextInput::make('driver_license_country')
                    ->required(),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
                TextInput::make('payment_status')
                    ->required()
                    ->default('unpaid'),
                Textarea::make('special_requests')
                    ->columnSpanFull(),
                Textarea::make('cancellation_reason')
                    ->columnSpanFull(),
                DateTimePicker::make('cancelled_at'),
                DateTimePicker::make('actual_pickup_at'),
                DateTimePicker::make('actual_return_at'),
                TextInput::make('mileage_start')
                    ->numeric(),
                TextInput::make('mileage_end')
                    ->numeric(),
                TextInput::make('fuel_level_start')
                    ->numeric(),
                TextInput::make('fuel_level_end')
                    ->numeric(),
            ]);
    }
}
