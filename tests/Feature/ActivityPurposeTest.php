<?php

use App\Enums\Role;
use App\Models\User;
use Database\Seeders\RoleSeeder;

beforeEach(function () {
    $this->seed(RoleSeeder::class);
});

it('admin can CRUD activity purposes', function () {
    $admin = User::factory()->create();
    $admin->assignRole(Role::Admin->value);

    $this->actingAs($admin)->post('/activity-purposes', ['name' => 'New purpose'])->assertRedirect();
    $this->assertDatabaseHas('activity_purposes', ['name' => 'New purpose']);

    $id = \App\Models\ActivityPurpose::where('name', 'New purpose')->value('id');
    $this->actingAs($admin)->patch("/activity-purposes/{$id}", ['name' => 'Renamed'])->assertRedirect();
    $this->assertDatabaseHas('activity_purposes', ['name' => 'Renamed']);

    $this->actingAs($admin)->delete("/activity-purposes/{$id}")->assertRedirect();
    $this->assertDatabaseMissing('activity_purposes', ['id' => $id]);
});

it('non-admins cannot manage activity purposes', function () {
    $dept = User::factory()->create();
    $dept->assignRole(Role::DepartmentOffice->value);

    $this->actingAs($dept)->get('/activity-purposes')->assertForbidden();
    $this->actingAs($dept)->post('/activity-purposes', ['name' => 'x'])->assertForbidden();
});
