<?php

use App\Enums\Role;
use App\Models\ActivityPurpose;
use App\Models\FacilityRequest;
use App\Models\User;
use Database\Seeders\RoleSeeder;

beforeEach(function () {
    $this->seed(RoleSeeder::class);
});

function approvalUser(Role $role): User
{
    $user = User::factory()->create();
    $user->assignRole($role->value);

    return $user;
}

it('creates a calendar event when a department office approves', function () {
    $dept = approvalUser(Role::DepartmentOffice);
    $student = approvalUser(Role::Student);
    $purpose = ActivityPurpose::create(['name' => 'Seminars']);

    $req = FacilityRequest::create([
        'user_id' => $student->id,
        'activity_purpose_id' => $purpose->id,
        'department' => 'College of Computer Studies',
        'division' => 'x',
        'attendees' => 10,
        'date_filed' => '2026-04-23',
        'date_needed' => '2026-05-10',
        'time_needed_start' => '09:00:00',
        'time_needed_end' => '11:00:00',
        'person_in_charge' => 'x',
        'contact_number' => '123',
        'services' => ['pat' => true, 'emc_room' => false, 'tv_room' => false],
        'classification' => [
            'institutional' => true,
            'curricular' => false,
            'co_curricular' => false,
            'extra_curricular' => false,
            'outside_group' => false,
        ],
        'status' => 'pending',
    ]);

    $this->actingAs($dept)
        ->patch("/requests/{$req->id}/status", ['status' => 'approved'])
        ->assertRedirect();

    expect($req->fresh()->status->value)->toBe('approved');
    $this->assertDatabaseHas('calendar_events', [
        'facility_request_id' => $req->id,
        'name' => 'College of Computer Studies',
    ]);
    $this->assertDatabaseHas('audit_logs', [
        'event' => 'request.approved',
    ]);
});

it('removes calendar event when flipping from approved to declined', function () {
    $dept = approvalUser(Role::DepartmentOffice);
    $student = approvalUser(Role::Student);
    $purpose = ActivityPurpose::create(['name' => 'Party']);

    $req = FacilityRequest::create([
        'user_id' => $student->id,
        'activity_purpose_id' => $purpose->id,
        'department' => 'College of Education',
        'division' => 'x',
        'attendees' => 10,
        'date_filed' => '2026-04-23',
        'date_needed' => '2026-05-10',
        'time_needed_start' => '09:00:00',
        'time_needed_end' => '11:00:00',
        'person_in_charge' => 'x',
        'contact_number' => '123',
        'services' => ['pat' => true, 'emc_room' => false, 'tv_room' => false],
        'classification' => [
            'institutional' => true,
            'curricular' => false,
            'co_curricular' => false,
            'extra_curricular' => false,
            'outside_group' => false,
        ],
        'status' => 'pending',
    ]);

    $this->actingAs($dept)->patch("/requests/{$req->id}/status", ['status' => 'approved']);
    $this->actingAs($dept)->patch("/requests/{$req->id}/status", ['status' => 'declined']);

    $this->assertDatabaseMissing('calendar_events', [
        'facility_request_id' => $req->id,
    ]);
    expect($req->fresh()->status->value)->toBe('declined');
});

it('students cannot approve', function () {
    $student = approvalUser(Role::Student);
    $purpose = ActivityPurpose::create(['name' => 'Party']);

    $req = FacilityRequest::create([
        'user_id' => $student->id,
        'activity_purpose_id' => $purpose->id,
        'department' => 'College of Computer Studies',
        'division' => 'x',
        'attendees' => 5,
        'date_filed' => '2026-04-23',
        'date_needed' => '2026-05-01',
        'time_needed_start' => '09:00:00',
        'time_needed_end' => '11:00:00',
        'person_in_charge' => 'x',
        'contact_number' => '123',
        'services' => ['pat' => false, 'emc_room' => false, 'tv_room' => false],
        'classification' => [
            'institutional' => true,
            'curricular' => false,
            'co_curricular' => false,
            'extra_curricular' => false,
            'outside_group' => false,
        ],
        'status' => 'pending',
    ]);

    $this->actingAs($student)
        ->patch("/requests/{$req->id}/status", ['status' => 'approved'])
        ->assertForbidden();
});
