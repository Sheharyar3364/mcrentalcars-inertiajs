<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            // 1. FOUNDATION DATA (no dependencies)

            RegionSeeder::class,          // ← Regions (EU, UAE, UK)
            RoleSeeder::class,            // ← Roles (admin, customer, corporate_admin)
            // 2. REFERENCE DATA (depends on regions)
            CategorySeeder::class,        // ← Categories (Economy, SUV, Luxury, etc.)
            LocationSeeder::class,        // ← Locations (Paris CDG, Dubai DXB, etc.)
            OrganizationSeeder::class,    // ← Organizations (Corporate clients) ✅ ADDED

            // 3. MAIN DATA (depends on previous seeders)
            VehicleSeeder::class,         // ← Vehicles (Renault, Mercedes, Toyota, Tesla)

            // 4. OPTIONAL: Sample data for testing
            // UserSeeder::class,         // ← Sample users with organizations
            // BookingSeeder::class,      // ← Sample bookings
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
