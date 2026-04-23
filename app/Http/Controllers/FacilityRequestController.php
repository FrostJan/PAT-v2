<?php

namespace App\Http\Controllers;

use App\Enums\Department;
use App\Http\Requests\StoreFacilityRequest;
use App\Models\ActivityPurpose;
use App\Models\FacilityRequest;
use App\Services\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class FacilityRequestController extends Controller
{
    public function index(Request $request): Response
    {
        Gate::authorize('viewAny', FacilityRequest::class);

        $user = $request->user();

        $requests = FacilityRequest::query()
            ->with(['activityPurpose', 'user:id,name,email'])
            ->when(! $user->can('request.view.any'), fn ($q) => $q->where('user_id', $user->id))
            ->latest('date_filed')
            ->get()
            ->map(fn (FacilityRequest $r) => $this->transform($r));

        return Inertia::render('requests/index', [
            'requests' => $requests,
            'canApprove' => $user->can('request.approve'),
        ]);
    }

    public function create(): Response
    {
        Gate::authorize('create', FacilityRequest::class);

        return Inertia::render('requests/create', [
            'activityPurposes' => ActivityPurpose::orderBy('name')->get(['id', 'name']),
            'departments' => Department::values(),
        ]);
    }

    public function store(StoreFacilityRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $user = $request->user();

        $attachmentPath = null;
        $attachmentName = null;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $attachmentName = $file->getClientOriginalName();
            $attachmentPath = $file->store('requests/'.$user->id, 's3');
        }

        $facilityRequest = FacilityRequest::create([
            ...$data,
            'user_id' => $user->id,
            'attachment_path' => $attachmentPath,
            'attachment_original_name' => $attachmentName,
        ]);

        AuditLogger::record('request.created', $facilityRequest, [
            'department' => $facilityRequest->department,
        ]);

        return redirect()
            ->route('requests.index')
            ->with('status', 'Request submitted successfully.');
    }

    public function show(FacilityRequest $facilityRequest): Response
    {
        Gate::authorize('view', $facilityRequest);

        $facilityRequest->load(['activityPurpose', 'user:id,name,email', 'decidedBy:id,name']);

        return Inertia::render('requests/show', [
            'request' => $this->transform($facilityRequest, withFullDetails: true),
        ]);
    }

    protected function transform(FacilityRequest $r, bool $withFullDetails = false): array
    {
        $attachmentUrl = $r->attachment_path
            ? Storage::disk('s3')->temporaryUrl($r->attachment_path, now()->addMinutes(10))
            : null;

        $base = [
            'id' => $r->id,
            'department' => $r->department,
            'division' => $r->division,
            'activity_purpose' => $r->activityPurpose?->name,
            'attendees' => $r->attendees,
            'date_filed' => $r->date_filed?->toDateString(),
            'date_needed' => $r->date_needed?->toDateString(),
            'time_needed_start' => $r->time_needed_start?->format('H:i'),
            'time_needed_end' => $r->time_needed_end?->format('H:i'),
            'person_in_charge' => $r->person_in_charge,
            'contact_number' => $r->contact_number,
            'status' => $r->status?->value,
            'user' => $r->user ? ['id' => $r->user->id, 'name' => $r->user->name, 'email' => $r->user->email] : null,
            'attachment_url' => $attachmentUrl,
            'attachment_name' => $r->attachment_original_name,
        ];

        if ($withFullDetails) {
            $base['services'] = $r->services;
            $base['classification'] = $r->classification;
            $base['decided_by'] = $r->decidedBy ? ['id' => $r->decidedBy->id, 'name' => $r->decidedBy->name] : null;
            $base['decided_at'] = $r->decided_at?->toIso8601String();
        }

        return $base;
    }
}
