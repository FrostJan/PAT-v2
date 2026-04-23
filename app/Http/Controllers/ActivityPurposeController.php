<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityPurposeRequest;
use App\Models\ActivityPurpose;
use App\Services\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class ActivityPurposeController extends Controller
{
    public function index(): Response
    {
        Gate::authorize('manage', ActivityPurpose::class);

        return Inertia::render('activity-purposes/index', [
            'activityPurposes' => ActivityPurpose::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function store(StoreActivityPurposeRequest $request): RedirectResponse
    {
        $purpose = ActivityPurpose::create($request->validated());
        AuditLogger::record('activity-purpose.created', $purpose, ['name' => $purpose->name]);

        return back()->with('status', 'Activity purpose added.');
    }

    public function update(StoreActivityPurposeRequest $request, ActivityPurpose $activityPurpose): RedirectResponse
    {
        $activityPurpose->update($request->validated());
        AuditLogger::record('activity-purpose.updated', $activityPurpose, ['name' => $activityPurpose->name]);

        return back()->with('status', 'Activity purpose updated.');
    }

    public function destroy(ActivityPurpose $activityPurpose): RedirectResponse
    {
        Gate::authorize('manage', ActivityPurpose::class);
        AuditLogger::record('activity-purpose.deleted', $activityPurpose, ['name' => $activityPurpose->name]);
        $activityPurpose->delete();

        return back()->with('status', 'Activity purpose deleted.');
    }
}
