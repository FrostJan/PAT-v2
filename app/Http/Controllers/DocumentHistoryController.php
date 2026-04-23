<?php

namespace App\Http\Controllers;

use App\Enums\RequestStatus;
use App\Models\FacilityRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class DocumentHistoryController extends Controller
{
    public function index(): Response
    {
        Gate::authorize('approve', FacilityRequest::class);

        $requests = FacilityRequest::query()
            ->with(['activityPurpose', 'user:id,name'])
            ->where('status', RequestStatus::Approved)
            ->latest('date_needed')
            ->get()
            ->map(fn (FacilityRequest $r) => [
                'id' => $r->id,
                'department' => $r->department,
                'activity_purpose' => $r->activityPurpose?->name,
                'date_needed' => $r->date_needed?->toDateString(),
                'time_needed_start' => $r->time_needed_start?->format('H:i'),
                'time_needed_end' => $r->time_needed_end?->format('H:i'),
                'person_in_charge' => $r->person_in_charge,
                'contact_number' => $r->contact_number,
                'user' => $r->user?->name,
                'attachment_url' => $r->attachment_path
                    ? Storage::disk('s3')->temporaryUrl($r->attachment_path, now()->addMinutes(10))
                    : null,
                'attachment_name' => $r->attachment_original_name,
            ]);

        return Inertia::render('document-history/index', [
            'requests' => $requests,
        ]);
    }
}
