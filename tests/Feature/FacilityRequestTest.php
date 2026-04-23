<?php

use App\Enums\Role;
use App\Models\ActivityPurpose;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->seed(RoleSeeder::class);
});

function makeUser(Role $role): User
{
    $user = User::factory()->create();
    $user->assignRole($role->value);

    return $user;
}

it('lets a student submit a facility request', function () {
    Storage::fake('s3');

    $student = makeUser(Role::Student);
    $purpose = ActivityPurpose::create(['name' => 'Seminars']);

    $response = $this->actingAs($student)->post('/requests', [
        'activity_purpose_id' => $purpose->id,
        'department' => 'College of Computer Studies',
        'division' => 'Division A',
        'attendees' => 30,
        'date_filed' => '2026-04-23',
        'date_needed' => '2026-05-01',
        'time_needed_start' => '09:00',
        'time_needed_end' => '12:00',
        'person_in_charge' => 'Juan Cruz',
        'contact_number' => '09123456789',
        'services' => ['pat' => true, 'emc_room' => false, 'tv_room' => false],
        'classification' => [
            'institutional' => true,
            'curricular' => false,
            'co_curricular' => false,
            'extra_curricular' => false,
            'outside_group' => false,
        ],
        'attachment' => UploadedFile::fake()->create('req.pdf', 100, 'application/pdf'),
    ]);

    $response->assertRedirect('/requests');

    $this->assertDatabaseHas('facility_requests', [
        'user_id' => $student->id,
        'department' => 'College of Computer Studies',
        'status' => 'pending',
    ]);
});

it('blocks students from hitting approvals', function () {
    $student = makeUser(Role::Student);

    $this->actingAs($student)->get('/approvals')->assertForbidden();
});

it('hides other users requests from a student list', function () {
    $student = makeUser(Role::Student);
    $other = makeUser(Role::Student);
    $purpose = ActivityPurpose::create(['name' => 'Party']);

    \App\Models\FacilityRequest::create(baseRow($other->id, $purpose->id, 'College of Education'));
    \App\Models\FacilityRequest::create(baseRow($student->id, $purpose->id, 'College of Arts and Sciences'));

    $response = $this->actingAs($student)->get('/requests');
    $response->assertOk();
    $response->assertInertia(
        fn ($page) => $page
            ->component('requests/index')
            ->has('requests', 1)
            ->where('requests.0.department', 'College of Arts and Sciences'),
    );
});

it('forbids a student from viewing another users request', function () {
    $student = makeUser(Role::Student);
    $other = makeUser(Role::Student);
    $purpose = ActivityPurpose::create(['name' => 'Symposium']);
    $req = \App\Models\FacilityRequest::create(baseRow($other->id, $purpose->id, 'College of Maritime'));

    $this->actingAs($student)->get("/requests/{$req->id}")->assertForbidden();
});

function baseRow(int $userId, int $purposeId, string $department): array
{
    return [
        'user_id' => $userId,
        'activity_purpose_id' => $purposeId,
        'department' => $department,
        'division' => 'x',
        'attendees' => 5,
        'date_filed' => '2026-04-23',
        'date_needed' => '2026-05-01',
        'time_needed_start' => '09:00:00',
        'time_needed_end' => '12:00:00',
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
    ];
}
