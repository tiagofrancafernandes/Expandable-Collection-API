<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Seed roles and permissions required by the platform.
     */
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'projects.read',
            'projects.create',
            'projects.update',
            'projects.delete',
            'collections.read',
            'collections.create',
            'collections.update',
            'collections.delete',
        ];

        foreach ($permissions as $permissionName) {
            Permission::findOrCreate($permissionName, 'web');
        }

        $superAdminRole = Role::findOrCreate('super-admin', 'web');
        $tenantRole = Role::findOrCreate('tenant-user', 'web');

        $superAdminRole->syncPermissions(Permission::all());
        $tenantRole->syncPermissions([
            'projects.read',
            'projects.create',
            'projects.update',
            'projects.delete',
            'collections.read',
            'collections.create',
            'collections.update',
            'collections.delete',
        ]);
    }
}
