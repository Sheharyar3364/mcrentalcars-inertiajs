<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\Region;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $euRegion = Region::where('code', 'eu')->first();
        $uaeRegion = Region::where('code', 'uae')->first();
        $ukRegion = Region::where('code', 'uk')->first();

        $organizations = [
            // EU Corporate Clients
            [
                'workos_id' => 'org_01HTEST001',
                'name' => 'Tech Innovators SAS',
                'domain' => 'techinnovators.fr',
                'type' => 'corporate',
                'contact_email' => 'fleet@techinnovators.fr',
                'phone' => '+33 1 45 67 89 00',
                'billing_address' => '15 Avenue des Champs-Élysées, 75008 Paris, France',
                'tax_id' => 'FR12345678901',
                'region_id' => $euRegion->id,
                'is_active' => true,
            ],
            [
                'workos_id' => 'org_01HTEST002',
                'name' => 'European Consulting Group',
                'domain' => 'ecgroup.eu',
                'type' => 'corporate',
                'contact_email' => 'admin@ecgroup.eu',
                'phone' => '+33 1 55 44 33 22',
                'billing_address' => '100 Rue de la Paix, 75002 Paris, France',
                'tax_id' => 'FR98765432109',
                'region_id' => $euRegion->id,
                'is_active' => true,
            ],

            // UAE Corporate Clients
            [
                'workos_id' => 'org_01HTEST003',
                'name' => 'Dubai Innovation Hub LLC',
                'domain' => 'dubaihub.ae',
                'type' => 'corporate',
                'contact_email' => 'operations@dubaihub.ae',
                'phone' => '+971 4 123 4567',
                'billing_address' => 'Dubai Internet City, Building 10, Dubai, UAE',
                'tax_id' => 'AE100123456700003',
                'region_id' => $uaeRegion->id,
                'is_active' => true,
            ],
            [
                'workos_id' => 'org_01HTEST004',
                'name' => 'Emirates Business Solutions',
                'domain' => 'emiratesbiz.ae',
                'type' => 'corporate',
                'contact_email' => 'fleet@emiratesbiz.ae',
                'phone' => '+971 4 987 6543',
                'billing_address' => 'Sheikh Zayed Road, Emirates Towers, Dubai, UAE',
                'tax_id' => 'AE100987654300003',
                'region_id' => $uaeRegion->id,
                'is_active' => true,
            ],

            // UK Corporate Client
            [
                'workos_id' => 'org_01HTEST005',
                'name' => 'London Tech Ventures Ltd',
                'domain' => 'londontech.co.uk',
                'type' => 'corporate',
                'contact_email' => 'transport@londontech.co.uk',
                'phone' => '+44 20 7946 0958',
                'billing_address' => '1 Canary Wharf, London E14 5AB, United Kingdom',
                'tax_id' => 'GB123456789',
                'region_id' => $ukRegion?->id ?? $euRegion->id,
                'is_active' => true,
            ],

            // Individual Organization (default for non-corporate users)
            [
                'workos_id' => null,
                'name' => 'Individual Customers',
                'domain' => null,
                'type' => 'individual',
                'contact_email' => 'support@mccarrental.com',
                'phone' => null,
                'billing_address' => null,
                'tax_id' => null,
                'region_id' => $euRegion->id,
                'is_active' => true,
            ],
        ];

        foreach ($organizations as $org) {
            Organization::updateOrCreate(
                ['workos_id' => $org['workos_id']],
                $org
            );
        }

        $this->command->info('✅ Organizations seeded successfully!');
        $this->command->info('   • Corporate organizations: 5');
        $this->command->info('   • Individual organization: 1');
    }
}
