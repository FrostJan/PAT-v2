<?php

namespace Database\Seeders;

use App\Enums\Role as RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'request.create',
            'request.view.own',
            'request.view.any',
            'request.approve',
            'activity-purpose.manage',
            'audit-log.view',
            'summary.view',
            'document-history.view',
        ];

        foreach ($permissions as $name) {
            Permission::firstOrCreate(['name' => $name, 'guard_name' => 'web']);
        }

        $admin = Role::firstOrCreate(['name' => RoleEnum::Admin->value, 'guard_name' => 'web']);
        $admin->syncPermissions($permissions);

        $deptOffice = Role::firstOrCreate(['name' => RoleEnum::DepartmentOffice->value, 'guard_name' => 'web']);
        $deptOffice->syncPermissions([
            'request.view.any',
            'request.approve',
            'summary.view',
            'document-history.view',
        ]);

        $student = Role::firstOrCreate(['name' => RoleEnum::Student->value, 'guard_name' => 'web']);
        $student->syncPermissions([
            'request.create',
            'request.view.own',
        ]);
    }
}
