<?php

namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CalendarController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('dashboard');
    }

    public function events(Request $request): JsonResponse
    {
        $user = $request->user();

        $events = CalendarEvent::query()
            ->with('facilityRequest:id,department')
            ->when(! $user->can('request.view.any'), fn ($q) => $q->where('user_id', $user->id))
            ->get()
            ->map(fn (CalendarEvent $e) => [
                'event_id' => $e->id,
                'request_id' => $e->facility_request_id,
                'user_id' => $e->user_id,
                'title' => $e->name,
                'start' => $e->start_date->toDateString(),
                'end' => $e->end_date->copy()->addDay()->toDateString(),
                'color' => $e->color,
                'allDay' => true,
            ]);

        return response()->json([
            'data' => $events,
        ]);
    }
}
