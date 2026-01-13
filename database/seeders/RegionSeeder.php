<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        $regions = [
            [
                'code' => 'eu',
                'name' => 'Europe',
                'currency' => 'EUR',
                'timezone' => 'Europe/Paris',
            ],
            [
                'code' => 'uae',
                'name' => 'United Arab Emirates',
                'currency' => 'AED',
                'timezone' => 'Asia/Dubai',
            ],
            [
                'code' => 'uk',
                'name' => 'United Kingdom',
                'currency' => 'GBP',
                'timezone' => 'Europe/London',
            ],
        ];

        foreach ($regions as $region) {
            Region::firstOrCreate(
                ['code' => $region['code']],
                $region
            );
        }
    }
}
