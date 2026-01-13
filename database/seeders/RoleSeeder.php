<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create permissions
        $permissions = [
            'manage-vehicles',
            'manage-bookings',
            'manage-users',
            'manage-organizations',
            'view-reports',
            'approve-reviews',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $customer = Role::firstOrCreate(['name' => 'customer']);

        $corporateAdmin = Role::firstOrCreate(['name' => 'corporate_admin']);
        $corporateAdmin->givePermissionTo(['manage-bookings', 'view-reports']);
    }
}
