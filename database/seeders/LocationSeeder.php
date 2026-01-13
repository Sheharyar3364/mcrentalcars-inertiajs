<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Region;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $euRegion = Region::where('code', 'eu')->first();
        $uaeRegion = Region::where('code', 'uae')->first();

        $locations = [
            // EU Locations
            [
                'name' => [
                    'en' => 'Paris Charles de Gaulle Airport',
                    'ar' => 'مطار باريس شارل ديغول',
                    'fr' => 'Aéroport Paris Charles de Gaulle'
                ],
                'code' => 'CDG',
                'type' => 'airport',
                'address' => '95700 Roissy-en-France',
                'city' => 'Paris',
                'country' => 'France',
                'latitude' => 49.0097,
                'longitude' => 2.5479,
                'phone' => '+33 1 70 36 39 50',
                'region_id' => $euRegion->id,
            ],
            [
                'name' => [
                    'en' => 'Paris City Center',
                    'ar' => 'وسط باريس',
                    'fr' => 'Centre-ville de Paris'
                ],
                'code' => 'PAR',
                'type' => 'city_center',
                'address' => '1 Avenue des Champs-Élysées',
                'city' => 'Paris',
                'country' => 'France',
                'latitude' => 48.8566,
                'longitude' => 2.3522,
                'phone' => '+33 1 45 67 89 10',
                'region_id' => $euRegion->id,
            ],

            // UAE Locations
            [
                'name' => [
                    'en' => 'Dubai International Airport',
                    'ar' => 'مطار دبي الدولي',
                    'fr' => 'Aéroport international de Dubaï'
                ],
                'code' => 'DXB',
                'type' => 'airport',
                'address' => 'Dubai Airport Road',
                'city' => 'Dubai',
                'country' => 'UAE',
                'latitude' => 25.2532,
                'longitude' => 55.3657,
                'phone' => '+971 4 224 5555',
                'region_id' => $uaeRegion->id,
            ],
            [
                'name' => [
                    'en' => 'Dubai Downtown',
                    'ar' => 'وسط مدينة دبي',
                    'fr' => 'Centre-ville de Dubaï'
                ],
                'code' => 'DDT',
                'type' => 'city_center',
                'address' => 'Sheikh Zayed Road',
                'city' => 'Dubai',
                'country' => 'UAE',
                'latitude' => 25.1972,
                'longitude' => 55.2744,
                'phone' => '+971 4 567 8910',
                'region_id' => $uaeRegion->id,
            ],
            [
                'name' => [
                    'en' => 'Abu Dhabi International Airport',
                    'ar' => 'مطار أبو ظبي الدولي',
                    'fr' => 'Aéroport international d\'Abu Dhabi'
                ],
                'code' => 'AUH',
                'type' => 'airport',
                'address' => 'Abu Dhabi Airport Road',
                'city' => 'Abu Dhabi',
                'country' => 'UAE',
                'latitude' => 24.4330,
                'longitude' => 54.6511,
                'phone' => '+971 2 505 5555',
                'region_id' => $uaeRegion->id,
            ],
        ];

        foreach ($locations as $location) {
            Location::firstOrCreate(
                ['code' => $location['code']],
                $location
            );
        }
    }
}
