<?php

namespace App\Http\Controllers;

use App\Enums\RequestStatus;
use App\Http\Requests\UpdateApprovalRequest;
use App\Models\CalendarEvent;
use App\Models\FacilityRequest;
use App\Services\AuditLogger;
use App\Support\DepartmentColor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class ApprovalController extends Controller
{
    public function index(Request $request): Response
    {
        Gate::authorize('approve', FacilityRequest::class);

        $requests = FacilityRequest::query()
            ->with(['activityPurpose', 'user:id,name,email'])
            ->latest('date_filed')
            ->get()
            ->map(fn (FacilityRequest $r) => [
                'id' => $r->id,
                'department' => $r->department,
                'activity_purpose' => $r->activityPurpose?->name,
                'date_filed' => $r->date_filed?->toDateString(),
                'date_needed' => $r->date_needed?->toDateString(),
                'person_in_charge' => $r->person_in_charge,
                'status' => $r->status?->value,
                'user' => $r->user ? ['name' => $r->user->name, 'email' => $r->user->email] : null,
                'attachment_name' => $r->attachment_original_name,
            ]);

        return Inertia::render('approvals/index', [
            'requests' => $requests,
        ]);
    }

    public function update(UpdateApprovalRequest $request, FacilityRequest $facilityRequest): RedirectResponse
    {
        $status = RequestStatus::from($request->validated('status'));
        $user = $request->user();

        DB::transaction(function () use ($facilityRequest, $status, $user) {
            $facilityRequest->update([
                'status' => $status,
                'decided_by' => $user->id,
                'decided_at' => now(),
            ]);

            $facilityRequest->calendarEvent()->delete();

            if ($status === RequestStatus::Approved) {
                CalendarEvent::create([
                    'facility_request_id' => $facilityRequest->id,
                    'user_id' => $facilityRequest->user_id,
                    'name' => $facilityRequest->department,
                    'start_date' => $facilityRequest->date_needed,
                    'end_date' => $facilityRequest->date_needed,
                    'color' => DepartmentColor::for($facilityRequest->department),
                ]);
            }

            AuditLogger::record('request.'.$status->value, $facilityRequest, [
                'department' => $facilityRequest->department,
            ]);
        });

        return back()->with('status', 'Request '.$status->value.'.');
    }
}
