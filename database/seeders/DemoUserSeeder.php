<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@pat-v2.local'],
            [
                'name' => 'Admin Messi',
                'password' => Hash::make('password'),
                'active' => true,
            ],
        );
        $admin->syncRoles(Role::Admin->value);

        $dept = User::updateOrCreate(
            ['email' => 'department@pat-v2.local'],
            [
                'name' => 'Department Office',
                'password' => Hash::make('password'),
                'active' => true,
            ],
        );
        $dept->syncRoles(Role::DepartmentOffice->value);

        $student = User::updateOrCreate(
            ['email' => 'student@pat-v2.local'],
            [
                'name' => 'Juan Cruz',
                'password' => Hash::make('password'),
                'active' => true,
            ],
        );
        $student->syncRoles(Role::Student->value);
    }
}
