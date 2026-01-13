<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->label('Name')->required()->maxLength(255),
                TextInput::make('email')->label('Email')->email()->required()->maxLength(255)->unique(),
                DatePicker::make('date_of_birth')->label('Date of Birth')->nullable(),
                TextInput::make('driver_license_number')->label('Driver License Number')->nullable()->maxLength(100),
                TextInput::make('driver_license_country')->label('Driver License Country')->nullable()->maxLength(100),
                DatePicker::make('driver_license_expiry')->label('Driver License Expiry')->nullable(),
                TextInput::make('preferred_language')->label('Preferred Language')->maxLength(5)->default('en'),
                TextInput::make('preferred_currency')->label('Preferred Currency')->maxLength(3)->default('EUR'),
                TextInput::make('workos_id')->label('WorkOS ID')->required()->unique()->maxLength(255),
                Select::make('region_id')->label('Region')->relationship('region', 'code')->nullable(),
                Select::make('organization_id')->label('Organization')->relationship('organization', 'name')->nullable(),
            ]);
    }
}
