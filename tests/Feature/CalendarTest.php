<?php

use App\Enums\Role;
use App\Models\ActivityPurpose;
use App\Models\CalendarEvent;
use App\Models\FacilityRequest;
use App\Models\User;
use Database\Seeders\RoleSeeder;

beforeEach(function () {
    $this->seed(RoleSeeder::class);
});

function calendarUser(Role $role): User
{
    $user = User::factory()->create();
    $user->assignRole($role->value);

    return $user;
}

it('scopes events to the current user when not privileged', function () {
    $purpose = ActivityPurpose::create(['name' => 'Seminars']);
    $student = calendarUser(Role::Student);
    $other = calendarUser(Role::Student);

    foreach ([$student->id, $other->id] as $uid) {
        $req = FacilityRequest::create([
            'user_id' => $uid,
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
            'status' => 'approved',
        ]);
        CalendarEvent::create([
            'facility_request_id' => $req->id,
            'user_id' => $uid,
            'name' => 'Event '.$uid,
            'start_date' => '2026-05-10',
            'end_date' => '2026-05-10',
            'color' => '#aaaaaa',
        ]);
    }

    $response = $this->actingAs($student)->getJson('/calendar/events');
    $response->assertOk();
    $response->assertJsonCount(1, 'data');
});

it('returns all events for department office', function () {
    $purpose = ActivityPurpose::create(['name' => 'Party']);
    $dept = calendarUser(Role::DepartmentOffice);
    $s1 = calendarUser(Role::Student);
    $s2 = calendarUser(Role::Student);

    foreach ([$s1->id, $s2->id] as $uid) {
        $req = FacilityRequest::create([
            'user_id' => $uid,
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
            'status' => 'approved',
        ]);
        CalendarEvent::create([
            'facility_request_id' => $req->id,
            'user_id' => $uid,
            'name' => 'E',
            'start_date' => '2026-05-10',
            'end_date' => '2026-05-10',
            'color' => '#aaaaaa',
        ]);
    }

    $response = $this->actingAs($dept)->getJson('/calendar/events');
    $response->assertJsonCount(2, 'data');
});
