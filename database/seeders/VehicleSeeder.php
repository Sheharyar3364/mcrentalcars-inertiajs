<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use App\Models\Category;
use App\Models\Location;
use App\Models\Region;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $euRegion = Region::where('code', 'eu')->first();
        $uaeRegion = Region::where('code', 'uae')->first();

        $economyCategory = Category::where('slug', 'economy')->first();
        $suvCategory = Category::where('slug', 'suv')->first();
        $luxuryCategory = Category::where('slug', 'luxury')->first();
        $electricCategory = Category::where('slug', 'electric')->first();

        $parisLocation = Location::where('code', 'PAR')->first();
        $dubaiLocation = Location::where('code', 'DDT')->first();

        $vehicles = [
            // EU Fleet
            [
                'category_id' => $economyCategory->id,
                'location_id' => $parisLocation->id,
                'region_id' => $euRegion->id,
                'make' => 'Renault',
                'model' => 'Clio',
                'year' => 2024,
                'license_plate' => 'FR-123-AB',
                'vin' => 'VF1CLJZE123456789',
                'color' => 'White',
                'transmission' => 'manual',
                'fuel_type' => 'petrol',
                'seats' => 5,
                'doors' => 5,
                'engine_size' => 1.0,
                'mileage' => 5000,
                'features' => ['Bluetooth', 'USB', 'Air Conditioning'],
                'images' => ['/images/vehicles/renault-clio.jpg'],
                'currency' => 'EUR',
                'daily_rate' => 35.00,
                'weekly_discount_percent' => 10.00,
                'monthly_discount_percent' => 20.00,
                'insurance_daily_premium' => 10.00,
                'insurance_daily_comprehensive' => 20.00,
                'security_deposit' => 500.00,
                'status' => 'available',
                'is_featured' => false,
            ],
            [
                'category_id' => $luxuryCategory->id,
                'location_id' => $parisLocation->id,
                'region_id' => $euRegion->id,
                'make' => 'Mercedes-Benz',
                'model' => 'E-Class',
                'year' => 2024,
                'license_plate' => 'FR-456-CD',
                'vin' => 'WDD2130421A123456',
                'color' => 'Black',
                'transmission' => 'automatic',
                'fuel_type' => 'diesel',
                'seats' => 5,
                'doors' => 4,
                'engine_size' => 2.0,
                'mileage' => 2000,
                'features' => ['GPS', 'Leather Seats', 'Sunroof', 'Premium Sound', 'Heated Seats'],
                'images' => ['/images/vehicles/mercedes-e-class.jpg'],
                'currency' => 'EUR',
                'daily_rate' => 120.00,
                'weekly_discount_percent' => 15.00,
                'monthly_discount_percent' => 25.00,
                'insurance_daily_premium' => 25.00,
                'insurance_daily_comprehensive' => 45.00,
                'security_deposit' => 1500.00,
                'status' => 'available',
                'is_featured' => true,
            ],

            // UAE Fleet
            [
                'category_id' => $suvCategory->id,
                'location_id' => $dubaiLocation->id,
                'region_id' => $uaeRegion->id,
                'make' => 'Toyota',
                'model' => 'Land Cruiser',
                'year' => 2024,
                'license_plate' => 'DXB-A-12345',
                'vin' => 'JTEBU5JR123456789',
                'color' => 'Pearl White',
                'transmission' => 'automatic',
                'fuel_type' => 'petrol',
                'seats' => 7,
                'doors' => 5,
                'engine_size' => 3.5,
                'mileage' => 8000,
                'features' => ['GPS', '4WD', 'Leather Seats', 'Parking Sensors', 'Cruise Control'],
                'images' => ['/images/vehicles/toyota-land-cruiser.jpg'],
                'currency' => 'AED',
                'daily_rate' => 750.00,
                'weekly_discount_percent' => 12.00,
                'monthly_discount_percent' => 22.00,
                'insurance_daily_premium' => 50.00,
                'insurance_daily_comprehensive' => 100.00,
                'security_deposit' => 3000.00,
                'status' => 'available',
                'is_featured' => true,
            ],
            [
                'category_id' => $electricCategory->id,
                'location_id' => $dubaiLocation->id,
                'region_id' => $uaeRegion->id,
                'make' => 'Tesla',
                'model' => 'Model 3',
                'year' => 2024,
                'license_plate' => 'DXB-B-67890',
                'vin' => '5YJ3E1EA123456789',
                'color' => 'Midnight Silver',
                'transmission' => 'automatic',
                'fuel_type' => 'electric',
                'seats' => 5,
                'doors' => 4,
                'engine_size' => 0.0,
                'mileage' => 1500,
                'features' => ['Autopilot', 'Premium Audio', 'Glass Roof', 'Wireless Charging'],
                'images' => ['/images/vehicles/tesla-model-3.jpg'],
                'currency' => 'AED',
                'daily_rate' => 500.00,
                'weekly_discount_percent' => 15.00,
                'monthly_discount_percent' => 25.00,
                'insurance_daily_premium' => 30.00,
                'insurance_daily_comprehensive' => 60.00,
                'security_deposit' => 2000.00,
                'status' => 'available',
                'is_featured' => true,
            ],
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::firstOrCreate(
                ['vin' => $vehicle['vin']],
                $vehicle
            );
        }
    }
}
